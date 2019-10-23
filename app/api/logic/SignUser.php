<?php

namespace app\api\logic;

use \app\api\controller\Base;
use app\common\logic\ReturnCode;
use think\Db;

/**
 * 签到逻辑
 */
class SignUser extends Base {

    /**
     * 签到
     * @param type $user_id 会员id
     */
    public function sign($user_id,$day='') {
        if(!empty($day)){
            $day = date('Y-m-d');
        }
        
        $day = $day ? $day : date('Y-m-d');
        if ($day > date('Y-m-d')) {//不能提早签到
            $this->buildFailed('不能提早签到', ReturnCode::FAIL);
        }

        if ($this->isSign($user_id, $day)) {//已签到
            $this->buildFailed('已签到,不能重复签到', ReturnCode::FAIL);
        }
        
        //获取签到信息
        $user_info = Db::name('User')->field('id,score,score_amount,agent_pid')->where(['id' => $user_id])->find();
        if(!$user_info){
            $this->buildFailed('会员不存在', ReturnCode::FAIL);
        }
        $agent_pid = $user_info['agent_pid'];

        //获取签到信息
        $sign_info = Db::name('SignUser')->where(array('user_id' => $user_id))->find();

        //签到
        $yesterday = date('Y-m-d', strtotime('-1 day', strtotime($day)));
        $month = date('Y-m', strtotime($day));
        //更新签到信息
        if ($sign_info['last_sign_day'] == $yesterday) {//连续签名
            $continuous_times = $sign_info['continuous_times'] + 1; //连续次数
        } else {
            $continuous_times = 1; //连续次数
        }
        $history_times = $sign_info['history_times'] + 1; //历史次数
        $longest_times = $continuous_times > $sign_info['longest_times'] ? $continuous_times : $sign_info['longest_times']; //最高连续次数
        if ($sign_info['history_for_month'] == $month) {
            $history_for_month_times = $sign_info['history_for_month_times'] + 1; //
        } else {
            $history_for_month_times = 1;
        }
        $history_for_month = $month;

        //更新签到信息
        $_sign_info = array(
            'continuous_times' => $continuous_times,
            'history_times' => $history_times,
            'longest_times' => $longest_times,
            'last_sign_day' => $day,
            'history_for_month_times' => $history_for_month_times,
            'history_for_month' => $history_for_month,
        );

        //获取赠送的积分
        $_add = array(
            'user_id' => $user_id,
            'agent_pid' => $agent_pid,
            'continuous_times' => $continuous_times,
            'history_times' => $history_times,
            'longest_times' => $longest_times,
            'history_for_month_times' => $history_for_month_times,
            'update_time'=>TIME_NOW,
        );

        $score = $this->getScoreByAdd($_add);
        $score = intval($score);
        if($score>$user_info['score_amount']){
            $this->buildFailed('待解冻糖果不足', ReturnCode::FAIL);
        }
        
        $note = $score > 0 ? '签到送' . $score : '';

        //更新签到信息
        if (!$sign_info) {
            $_sign_info['user_id'] = $user_id;
            $_sign_info['create_time'] = TIME_NOW;
            Db::name('SignUser')->insert($_sign_info);
        } else {
            Db::name('SignUser')->where(['user_id' => $user_id])->update($_sign_info);
        }

        //添加签到记录
        $_sign_log = array(
            'user_id' => $user_id,
            'continuous_times' => $_sign_info['continuous_times'],
            'history_times' => $_sign_info['history_times'],
            'score' => $score,
            'sign_day' => $day,
            'note' => '签到送糖果' . $score,
            'create_time'=>TIME_NOW
        );
        Db::name('SignLog')->insert($_sign_log);

        $note = '签到解冻糖果';
        if ($score > 0) {//赠送积分处理
            $_add_score = array(
                'user_id' => $user_id,
                'agent_pid' => $agent_pid,
                'score' => $score,
                'note' => $note,
            );
            //赠送签到积分
            $this->addScoreAndLog($_add_score);
        }

        $_data = array(
            'continuous_times' => $continuous_times,
            'history_times' => $history_times,
            'longest_times' => $longest_times,
            'last_sign_day' => $day,
            'history_for_month_times' => $history_for_month_times
        );
        
        $this->buildSuccess([],'签到成功，当前累计签到' . $history_times . '天');
    }
    
    /**
     * 是否已经签到
     * @param type $param
     */
    public function isSign($user_id, $day='') {
        $where['user_id'] = $user_id;
        $sign_info = Db::name('SignUser')->where($where)->find();
        if (!$sign_info) {
            return false;
        }
        $today = $day ? $day : date('Y-m-d');
        if ($sign_info['last_sign_day'] != $today) {//未签名
            return false;
        }

        return true;
    }
    
    /**
     * 获取增赠积分
     * @param array $_data
     *                  user_id 会员id
     *                  agent_pid 代理id
     *                  continuous_times 连续签到次数
     *                  history_times 历史（累计）签到次数
     *                  longest_times 连续签到次数最多
     *                  history_for_month_times 当月签到次数
     * @return int $score 赠送的积分 （0-代表不赠送积分）
     */
    public function getScoreByAdd($_data) {
        //累计信息
        $user_id = $_data['user_id']; //会员id
        $agent_pid = $_data['agent_pid']; //子系统id
        $continuous_times = $_data['continuous_times']; //连续签到次数
        $history_times = $_data['history_times']; //历史（累计）签到次数
        $longest_times = $_data['longest_times']; //连续签到次数最多
        $history_for_month_times = $_data['history_for_month_times']; //当月签到次数

        //配置是否赠送积分
        $is_send = $this->getSetting('is_send',$agent_pid); //每日积分

        $score_each_day = $this->getSetting('score_each_day',$agent_pid);
        $score = intval($score_each_day);
        if ($is_send != 1) {//不赠送积分
            $score = 0;
            return $score;
        }

        //额外赠送积分
        $is_add = $this->getSetting('is_add',$agent_pid); //额外赠送积分
        if ($is_add != 1) {
            return $score;
        }
        
        $add_type = $this->getSetting('add_type',$agent_pid); //额外赠送积分
        $add_score = 0;
        switch ($add_type) {
            case 0://累计
                $add_setting_history = $this->getSetting('add_setting_history',$agent_pid);
                if (count($add_setting_history) > 0) {
                    //判断是否有金额
                    $new_setting = array();
                    foreach ($add_setting_history as $key => $val) {
                        $new_setting[$val['min_days']] = $val['score'];
                    }
                    //倒序排序
                    krsort($new_setting);
                    //判断应该赠送的积分
                    foreach ($new_setting as $min_days => $score_add) {
                        if ($history_times == $min_days && $score_add > 0) {
                            $add_score = $score_add;
                            break;
                        }
                    }
                }
                break;
            case 1://连续
                $add_setting_continue = $this->getSetting('add_setting_continue',$agent_pid);
                if (count($add_setting_continue) > 0) {
                    //判断是否有金额
                    $new_setting = array();
                    foreach ($add_setting_continue as $key => $val) {
                        $new_setting[$val['min_days']] = $val['score'];
                    }
                    //倒序排序
                    krsort($new_setting);
                    //判断应该赠送的积分
                    foreach ($new_setting as $min_days => $score_add) {
                        if ($continuous_times == $min_days && $score_add > 0) {
                            $add_score = $score_add;
                            break;
                        }
                    }
                }
                break;
            case 2://当月累计
                $add_setting_month = $this->getSetting('add_setting_month',$agent_pid);
                if (count($add_setting_month) > 0) {
                    //判断是否有金额
                    $new_setting = array();
                    foreach ($add_setting_month as $key => $val) {
                        $new_setting[$val['min_days']] = $val['score'];
                    }
                    //倒序排序
                    krsort($new_setting);
                    //判断应该赠送的积分
                    foreach ($new_setting as $min_days => $score_add) {
                        if ($history_for_month_times == $min_days && $score_add > 0) {
                            $add_score = $score_add;
                            break;
                        }
                    }
                }
                break;

            default:
                $add_score = 0;
                break;
        }

        $add_score = intval($add_score);
        $score += $add_score;
        return $score;
    }
    
    /**
     * 添加积分变动记录（暂未使用事务）
     * @param array $_data 数据
     *               agent_pid 子系统id 必填
     *               user_id 会员id 必填
     *               score 积分（变动值） 必填
     *               note 备注 非必填
     * @return boolean $flag 状态（true-成功，false-失败）
     */
    public function addScoreAndLog($_data) {
        $score = intval($_data['score']);
        $user_id = $_data['user_id'];
        $agent_pid = $_data['agent_pid'];
        
        $_score_data = array(
            'user_id'=>$user_id,
            'score'=>$score,
            'score_amount'=>-1*$score,
            'type'=>'user_sign',
            'note'=>$_data['note']
        );
        $res = change_score($_score_data);
        return $res;
    }
    
    /**
     * 获取配置
     * @param string $name 配置名称
     * @param string $agent_pid 代理
     * @return string|array $value
     */
    public function getSetting($name,$agent_pid) {

        $where['name'] = $name;
        $info = Db::name('SignSetting')->where($where)->find();
        if (!$info) {
            return null;
        }

        $value = null;
        switch ($info['type']) {
            case 'json':
                $value = json_decode($info['value'], true);
                break;
            case 'text':
                $value = $info['value'];
                break;
            default:
                $value = $info['value'];
                break;
        }
        
//        $value = cfg_sign($name, $config_id);
        

        return $value;
    }
    
    public function getInfo($user_id) {
        $_data = array(
            'continuous_times' => 0,
            'history_times' => 0,
            'last_sign_day' => '',
        );
        $where['user_id'] = $user_id;
        $info = Db::name('SignUser')->where($where)->find();
        if ($info) {
            $_data['continuous_times'] = intval($info['continuous_times']);
            $_data['history_times'] = intval($info['history_times']);
            $_data['last_sign_day'] = strval($info['last_sign_day']);
        }

        //查找近期7天内的签到情况
        $last_day = date('Y-m-d');
        $days = 7; //列举签到的天数
        $days -= 1;
        $first_day = date('Y-m-d', strtotime('-' . $days . ' day', strtotime($last_day)));

        //获取有签到的日期（签到记录）
        $log_where['user_id'] = $user_id;
        $log_where['sign_day'] = array('between', array($first_day, $last_day));
        $log_list = Db::name('SignLog')->where($log_where)->order('sign_day ASC')->select();
        $log_arr = array();
        if (count($log_list) > 0) {
            foreach ($log_list as $key => $val) {
                $log_arr[$val['sign_day']] = $val;
            }
        }

        //获取日期的签到信息
        $day_list = array();
        $now_day = $first_day;
        while ($now_day <= $last_day) {
            $day_list[] = array(
                'sign_day' => $now_day,
                'is_sign' => 0,
//                'score'=>0
            );
            $now_day = date('Y-m-d', strtotime('+1 day', strtotime($now_day)));
        }
        foreach ($day_list as $key => $val) {
            if ($log_arr[$val['sign_day']]) {//签到的日期
                $day_list[$key]['is_sign'] = 1;
//                $day_list[$key]['score'] = intval($log_arr[$val['sign_day']]['score']);
            }
        }
        $_data['back_score'] = strval(intval($user['back_score']));
        $_data['day_list'] = $day_list;
        $result['info'] = $_data;
        $this->buildSuccess($result, ReturnCode::SUCCESS);
    }
    
    public function getLog($user_id,$p,$pagesize) {
        
        $where['user_id'] = $user_id;
        $count = Db::name("SignLog")->where($where)->count();
        $limit = ($p - 1) * $pagesize . "," . $pagesize;
        $log_list = Db::name("SignLog")->field('score,sign_day,create_time,note')->where($where)->limit($limit)->order('create_time DESC')->select();
        foreach ($log_list as $key => $val) {
            $log_list[$key]['sign_day'] = $val['sign_day'] ? $val['sign_day'] : date('Y-m-d', $val['create_time']);
            $log_list[$key]['create_time'] = date('Y-m-d H:i', $val['create_time']);
        }

        $has_next = $count > $p * $pagesize ? 1 : 0;
        $data['has_next'] = $has_next;
        $data['list'] = $log_list;

        $this->buildSuccess($data);
    }
}
