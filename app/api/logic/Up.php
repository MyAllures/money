<?php

namespace app\api\logic;

use \app\api\controller\Base;
use app\common\logic\ReturnCode;
use think\Db;

/**
 * 升级逻辑
 */
class Up extends Base {

    /**
     * 申请升级
     */
    public function apply($user_id,$up_type=0) {
        $user = Db::name('User')->where(['id' => $user_id])->field('level,id AS user_id,status,node,agent_pid')->find();
        if (empty($user)) {
            $this->buildFailed('账号不存在');
        }

        if ($user['status'] != 1) {//封号
            $this->buildFailed('账号不存在');
        }
        $cache_key = 'apply_up'.$user_id.'_'.$up_type;
        $up_type= $up_type?$up_type:0;
        if(!start_concurrent('apply_up'.$user_id.'_'.$up_type,5)){
            $this->buildFailed('操作频繁，请稍后再试');
        }

        //判断是否可以申请
        $level = $user['level'];
        $level_before = $level;
        $result = $this->checkUpInfo($user,$up_type);
        if (!$result['up_user_id']) {
            end_concurrent($cache_key);
            $this->buildFailed('暂无商户提供，和管理员联系');
        }

        $up_user_id = $result['up_user_id'];
        $level_after = $result['level_after'];
        $money = $result['money'] > 0 ? $result['money'] : 0;
        //添加申请记录
        $order_no = 'UP' . date('YmdHi') . rand(1000, 9999);
        $agent_pid = intval($user['agent_pid']);
        $up_data = [
            'order_no' => $order_no,
            'user_id' => $user_id,
            'level_before' => $level_before,
            'level_after' => $level_after,
            'up_user_id' => $up_user_id,
            'status' => 0,
            'create_time' => TIME_NOW,
            'money' => $money,
            'update_time' => TIME_NOW,
            'agent_pid' => $agent_pid,
            'up_type' => $up_type,

        ];

        $res = Db::name('ApplyRecord')->insert($up_data);
        if ($res) {
            //此处可以发送短信通知 todo
            end_concurrent($cache_key);
            $this->buildSuccess([], '申请成功，等待商户的审核');
        } else {
            end_concurrent($cache_key);
            $this->buildFailed('系统繁忙，请稍后再试');
        }
    }

    /**
     * 判断是否可以申请
     * @param type $user 会员信息
     *                  user_id 会员id
     *                  level 会员等级
     *                  node 会员关系标志
     *                  agent_pid 所在代理
     * @return type
     */
    public function checkUpInfo($user, $up_type = 0) {
        $user_id = $user['user_id'];
        $level = $user['level'];

        $level_info = Db::name('Level')->where(['level' => $level, 'status' => 1])->find();
        if (!$level_info) {
            $this->buildFailed('等级有误,请联系管理员');
        }
        $level_before = $level;

        //当前等级是否可以进行升级
        if ($level_info['type'] != 1) {
            $this->buildFailed('私有账户不可申请升级');
        }
        if ($level_info['is_end'] == 1) {
            $this->buildFailed('您已经是最高等级了');
        }

        //判断等级 获取下一个等级
        $level_after_info = Db::name('Level')->where('level', '>', $level_before)->order('level ASC')->find();
        if (!$level_after_info) {
            $this->buildFailed('您已经是最高等级了');
        }
        if ($level_after_info['status'] != 1) {
            $this->buildFailed('该等级不能使用');
        }
//        if ($level_after_info['can_reg'] != 1) {//该等级不可升级
//            $this->buildFailed('该等级不可升级1');
//        }
        if ($level_after_info['type'] != 1) {//该等级不可升级
            $this->buildFailed('该等级不可升级2');
        }
        $level_after = $level_after_info['level'];
        if ($level_after <= $level_before) {
            $this->buildFailed('配置有误，请联系管理员');
        }

        //无需申请
        $type_level_info = array();
        $res = $this->get_all_other($level_after_info);
        foreach ($res['list'] as $key => $val) {
            if ($val['up_type'] == $up_type) {
                $type_level_info = $val;
                break;
            }
        }

        if (empty($type_level_info)) {
            $this->buildFailed('配置有误，请联系管理员');
        }

        //是否已经发起升级了
        $ar_info = Db::name('ApplyRecord')->field('id')->where(['user_id' => $user_id, 'level_before' => $level, 'up_type' => $up_type])->where('status', 'exp', 'IN (0,1)')->find();
        if ($ar_info) {
            $this->buildFailed('您申请已提交，请耐心等待商户审核');
        }

        //判断是否有直推人数要求
        $direct_num = ceil($type_level_info['direct_num']);
        if ($direct_num > 0) {//
            //获取会员团队人数
            $direct_level = $type_level_info['direct_level'] > 0 ? intval($type_level_info['direct_level']) : 0;
            $my_direct_num = $this->getUserDirectNum($user['user_id'], $direct_level);
            if ($my_direct_num < $direct_num) {
                $this->buildFailed('您直推人数需达到' . $direct_num . '个才可以申请升级哦');
            }
        }

        //判断是否可以发起升级
        $need_num = ceil($type_level_info['need_num']);
        if ($need_num > 0) {//
            //获取会员团队人数
            $team_level = $type_level_info['team_level'] > 0 ? intval($type_level_info['team_level']) : 0;
            $my_team_num = $this->getUserTeamNum($user['node'], $team_level);
            if ($my_team_num < $need_num) {
                $this->buildFailed('您团队人数需达到' . $need_num . '个才可以申请升级哦');
            }
        }

        $no_allow_same_up = config('no_allow_same_up'); //是否允许有相同的商户
        $do_puser = array();
        if ($no_allow_same_up == 1) {
            $p_user_list = Db::name('ApplyRecord')->field('DISTINCT(up_user_id)')->where(['user_id' => $user['user_id']])->where('status', 'exp', 'IN (0,1)')->select();
            $do_puser = array_column($p_user_list, 'up_user_id');
        }

        //查找商户id
        $up_user_id = $this->getUpUser($user, $type_level_info, $do_puser);
        if ($up_user_id <= 0) {
            $this->buildFailed('暂无商户提供，和管理员联系');
        }


        //此处可以判断是否上级重复的问题（待扩展）
        $result['up_user_id'] = $up_user_id;
        $result['level_after'] = $level_after;
        $result['level_before'] = $level_before;
        $result['money'] = $level_after_info['money'];
        return $result;
    }

    /**
     * 获取会员统计（团队）
     * @param type $node 会员id节点
     * @param type $level 最低等级要求
     * @return int
     */
    public function getUserTeamNum($node, $level = '0') {
        $num = Db::name('User')->where('level', '>=', $level)->where('node', 'like', $node . '-%')->count();
        return $num;
    }

    /**
     * 获取会员统计（直推）
     * @param type $user_id 会员id
     * @param type $level 最低等级要求
     * @return int
     */
    public function getUserDirectNum($user_id, $level = '0') {
        $num = Db::name('User')->where('invite_id', '=', $user_id)->where('level', '>=', $level)->count();
        return $num;
    }

    /**
     * 获取我的升级商户（待扩展：是否要求不重复的问题）
     * @param type $user
     *                  node 会员关系标志
     *                  user_id 会员id
     * @param type $level_info 等级信息
     *                  query_method //查找方式（0仅查找上级，1仅查找客服，2查找上级和客服）（-1表示与一致）
     *                  up_level_limit //上级找几层（0表示无限层，1是只找一层）（-1表示与一致）
     *                  up_num 商户相对会员的层级
     *                  up_level 商户的等级要求
     * @param type $all_puser 数组，不可重复的用户id 
     */
    public function getUpUser($user, $level_info, $do_puser = array()) {

        $up_user_id = 0;

        //可以由上级作为商户
        if ($level_info['query_method'] == 2 || $level_info['query_method'] == 0) { //可以查找上级
            if ($level_info['up_num'] > 0 && ($level_info['up_level'] < 100)) {//层数大于， 等级无要求
                $node = $user['node'];
                $up_users = explode('-', $node);
                $up_users = array_reverse($up_users);
                $floor_limit = $level_info['up_num'];
                $now_floor = 1;
                $up_level_num_limit = $level_info['up_level_limit'] > 0 ? intval($level_info['up_level_limit']) : 0; //查找层数 -1不查找上级 0不限 
                $now_up_level_num = 0; //当前查找层数
                $length = count($up_users);
                if ($length > 1) {//注意 $up_users的为自己，所以直接忽略数组第一个元素
                    for ($i = $floor_limit; $i < $length; $i++) {//查找某级上级
                        if ($up_level_num_limit > 0 && $now_up_level_num >= $up_level_num_limit) {
                            break;
                        }

                        $up_id = $up_users[$i];
                        //获取会员信息
                        $up_user_info = $this->getUserInfoByUp($up_id); //是否被封
                        if (!$up_user_info || $up_user_info['status'] != 1) {//用户不存在或者被封号
                            $now_up_level_num++;
                            continue;
                        }

                        //等级要求
                        if ($level_info['up_level'] > 0 && $up_user_info['level'] < $level_info['up_level']) {
                            $now_up_level_num++;
                            continue;
                        }

                        if (is_array($do_puser) && in_array($up_id, $do_puser)) {//已完成的用户，不可再作为商户
                            $now_up_level_num++;
                            continue;
                        }

                        //                    if ($up_user_info['agent_pid']!=$user['agent_pid']) {//上下等级出现异常
                        //                        break;
                        //                    }

                        $up_user_id = $up_id;
                        break;
                    }
                }
            }
        }

        //可以查找内部人员
        if (($level_info['query_method'] == 2 || $level_info['query_method'] == 1) && !$up_user_id) {//查找内部人员
            $up_user_id = $this->getUserSpecial($user['agent_pid']);
        }

        return $up_user_id;
    }

    /**
     * 获取会员信息(上级使用)
     */
    public function getUserInfoByUp($user_id) {
        //获取信息
        $user = Db::name('User')->field('id AS user_id,username,status,level,agent_pid')->where(['id' => $user_id])->find();
        return $user;
    }

    /**
     * 获取一个内部会员id
     */
    public function getUserSpecial($agent_pid = 0) {
        $user_id = 0;
        $num_limit = 100;
        $where = [];
        $agent_pid = intval($agent_pid);
        if ($agent_pid > 0) {
            $where['agent_pid'] = $agent_pid;
        } else {
            $where['agent_pid'] = 0;
        }
        $list = Db::name('UserSpecial')->field('user_id')->where(['status' => 1])->where($where)->order('update_time DESC')->limit($num_limit)->select();
        $length = count($list);
        if ($length > 0) {
            $index = mt_rand(0, $length - 1);
            $user_id = $list[$index]['user_id'];
        }
        $user_id = intval($user_id);
        return $user_id;
    }

    /**
     * 判断是否可以升级
     */
    public function getApplyInfo($user_id) {
        $user = Db::name('User')->where(['id' => $user_id])->field('level,id,status,node')->find();
        if (empty($user)) {
            $this->buildFailed('账号不存在');
        }
        //获取他的下一个等级
        $now_level = $user['level'];
        $now_info = Db::name('Level')->where(['status' => 1, 'type' => 1])->where('level', '=', $now_level)->find();
        $next_info = Db::name('Level')->where(['status' => 1, 'type' => 1])->where('level', '>', $now_level)->order('level ASC')->find();

        $apply_status = 1;
        //处理下最高等级的处理
        $next_info = Db::name('Level')->where(['status' => 1, 'type' => 1])->where('level', '>', $now_level)->order('level ASC')->find();
        if (empty($next_info)) {
            $apply_status = 2;
        }
        $up_list = [];
        if ($apply_status == 1 || $apply_status == 0) {
            $res = $this->get_all_other($next_info);
            $_list = $res['list'];
            foreach ($_list as $key => $value) {
                $apply_status = 1;
                $is_apply = 0;
                $info = Db::name('ApplyRecord')->field('id,level_after,up_user_id,money')->where(['user_id' => $user_id, 'level_after' => $next_info['level'], 'up_type' => $value['up_type']])->where('status', 'exp', 'IN (0,1)')->find();
                if ($info) {
                    $apply_status = 0;
                    $is_apply = 2; //
                    if ($info['status'] == 0) {
                        $is_apply = 1;
                    }
                }
                $apply_info = [];
                if ($is_apply == 1) {
                    $up_user_id = $info['up_user_id'];
                    $up_user_info = Db::name('User')->field('id,username,code')->where(['id' => $up_user_id])->find();
                    $up_user_profile = Db::name('UserProfile')->field('wx_account,shoukuan_pic,account_name,head_icon,wx_picture_id')->where(['user_id' => $up_user_id])->find();
                    $up_user['user_id'] = $up_user_id;
                    $up_user['phone'] = strval($up_user_info['username']);
                    $up_user['wx_account'] = strval($up_user_profile['wx_account']);
					$up_user['shoukuan_pic'] = $up_user_profile['shoukuan_pic'];
                    

                    $up_user['account_name'] = strval($up_user_profile['account_name']);
                    $up_user['code'] = strval($up_user_info['code']);
                    $up_user['head_icon'] = get_split_image_url($up_user_profile['head_icon']);
                    $up_user['wx_picture_id'] = get_split_image_url($up_user_profile['wx_picture_id']);

                    $apply_info['up_user'] = $up_user;

                }

                $up_info = array(
                    'money' => $value['money'], //费用
                    'up_type' => $value['up_type'], //费用
                    'up_num' => $value['up_num'], //直推下级人数
                    'up_level' => $value['up_level'], //商户等级要求
                    'level' => $next_info['level'], //升级后等级
                    'level_name' => $next_info['name'], //升级后等级名称
                    'level_now' => $now_info['level'], //当前等级
                    'level_name_now' => $now_info['name'], //当前等级名称
                    'apply_status' => 1, //申请状态 0不可以申请，1可申请
                    'is_apply' => $is_apply, //是否正在申请（0-未申请，1-申请）

                );
                if ($apply_info) {
                    $up_info['apply_info'] = $apply_info;
                }

                $up_list[] = $up_info;
            }
        }
        $apply_status_name = '未知';
        if ($apply_status == 1) {
            $apply_status_name = '可申请';
        } elseif ($apply_status == 2) {
            $apply_status_name = '恭喜您已经是最高等级了';
        } elseif ($apply_status == 0) {
            $apply_status_name = '不可申请';
        }
        $result_data['apply_status'] = $apply_status;
        $result_data['apply_status_name'] = $apply_status_name;
        $result_data['up_list'] = $up_list;
        $this->buildSuccess($result_data);
    }

    /**
     * 
     * @param type $level
     *                 money 金额
     *                 need_num 最低要求
     *                 up_num 查找向上层数
     *                 up_level 查找所在商户最低等级
     *                 up_level_limit 查找层以上层数
     *                 query_method 查找方式
     *                 need_type -1不要，0都完成，1完成其中1项
     *                 other_up (json格式)    
     */
    public function get_all_other($level) {

        $list = array();
        $need_type = 0;
        $list[] = array(
            'money' => $level['money'],
            'up_type' => 0,
            'need_num' => $level['need_num'],
            'team_level' => $level['team_level'],
            'direct_num' => $level['direct_num'],
            'direct_level' => $level['direct_level'],
            'query_method' => $level['query_method'],
            'up_num' => $level['up_num'],
            'up_level' => $level['up_level'],
            'up_level_limit' => $level['up_level_limit'],
        );
        $result['need_type'] = $need_type;
        $result['list'] = $list;

        if ($level['need_type'] < 0) {
            return $result;
        }
        if (empty($level['other_up'])) {
            return $result;
        }

        $other_up = json_decode($level['other_up'], true);
        if (empty($other_up)) {
            return $result;
        }
        $up_type = count($list);
        $other_up_list = $other_up['list'];
        foreach ($other_up_list as $key => $val) {
            $list[] = array(
                'money' => $val['money'] == -1 ? $level['money'] : $val['money'],
                'up_type' => $up_type,
                'need_num' => (isset($val['need_num']) && $val['need_num'] > -1) ? $val['need_num'] : $level['need_num'],
                'query_method' => $val['query_method'] == -1 ? $level['query_method'] : $val['query_method'],
                'up_num' => $val['up_num'] == -1 ? $level['up_num'] : $val['up_num'],
                'up_level' => $val['up_level'] == -1 ? $level['up_level'] : $val['up_level'],
                'up_level_limit' => $val['up_level_limit'] == -1 ? $level['up_level_limit'] : $val['up_level_limit'],
            );
            $up_type++;
        }
        $need_type = $other_up['need_type'] == 1 ? 1 : 0;
        $result['need_type'] = $need_type;
        $result['list'] = $list;
        return $result;
    }

    /**
     * 申请列表
     * @param type $user_id
     * @param type $state
     * @param type $p
     * @param type $pagesize
     */
    public function applyList($user_id, $state,$keywords='', $p=1, $pagesize=10) {
        $all_states = ['all', 'valid', 'wait', 'finish', 'cancel','history'];
        if (!in_array($state, $all_states)) {
            $this->buildFailed('状态类型有误');
        }
        
        $where['ar.user_id'] = $user_id;
        switch ($state) {
            case 'wait':
                $where['ar.status'] = 0;
                break;
            case 'finish':
                $where['ar.status'] = 1;
                break;
            case 'cancel':
                $where['ar.status'] = 2;
                break;
            case 'history':
                $where['ar.status'] = array('exp', 'IN (1,2)');
                break;
            case 'all':
                break;
            case 'valid':
            default:
                $where['ar.status'] = array('exp', 'IN (0,1)');
                break;
        }
        
        $offset = ($p - 1) * $pagesize;
        $field = 'ar.id,ar.order_no,ar.level_after,ar.level_before,ar.up_user_id,ar.money,ar.status,ar.status_complain,ar.create_time,ar.update_time,u.username,u.`code`,up.wx_account,up.account_name,up.head_icon,up.wx_picture_id';
        $ps = Db::name('ApplyRecord ar')->field($field)->join('__USER__ u','u.id=ar.up_user_id','LEFT')->join('__USER_PROFILE__ up','up.user_id=u.id','LEFT');
        $ps = $ps->where($where);
        
        if(!empty($keywords)){
            $ps = $ps->where('u.username|up.wx_account|u.code|up.account_name','like',"%".$keywords."%");
        }
        $_list = $ps->order('ar.create_time DESC')->limit($offset . ',' . $pagesize)->select();
;
        $status_names = ['0' => '待审核', '1' => '已完成', '2' => '已取消'];
        $status_complain_names = ['0' => '未投诉', '1' => '已投诉', '2' => '已撤销'];
        //获取某个等级的申请记录
        foreach ($_list as $key => $val) {
            $_list[$key]['create_time'] = date('Y-m-d H:i', $val['create_time']);
            if ($val['status'] > 0) {
                $_list[$key]['update_time'] = date('Y-m-d H:i', $val['update_time']);
            } else {
                $_list[$key]['update_time'] = '--';
            }

            $_list[$key]['status_name'] = $status_names[$val['status']];
            $level_after_name = Db::name('Level')->where(['level' => $val['level_after']])->value('name');
            $_list[$key]['level_after_name'] = strval($level_after_name);

            //获取商户信息
//            $up_user_info = Db::name('User')->field('id,username,code')->where(['id' => $val['up_user_id']])->find();
//            $up_user_profile = Db::name('UserProfile')->field('wx_account,account_name,head_icon')->where(['user_id' => $val['up_user_id']])->find();

            $_list[$key]['level_before'] = $val['level_before'];
            $level_before_name = Db::name('Level')->where(['level' => $val['level_before']])->value('name');
            $_list[$key]['level_before_name'] = strval($level_before_name);

            $up_user = [];
            $up_user['user_id'] = $val['up_user_id'];
            $up_user['phone'] = strval($val['username']);
            $up_user['wx_account'] = strval($val['wx_account']);
            $up_user['account_name'] = strval($val['account_name']);

            $up_user['code'] = strval($val['code']);
            $up_user['head_icon'] = get_split_image_url($val['head_icon']);
            $up_user['wx_picture_id'] = get_split_image_url($val['wx_picture_id']);


            unset($_list[$key]['username']);
            unset($_list[$key]['wx_account']);
            unset($_list[$key]['account_name']);
            unset($_list[$key]['head_icon']);
            unset($_list[$key]['code']);
            $_list[$key]['up_user'] = $up_user;
            $_list[$key]['status_complain_name'] = $status_complain_names[$val['status_complain']];
            unset($l_list[$key]['up_user_id']);
        }

        $data['list'] = $_list;
        $this->buildSuccess($data);
    }

    /**
     * 审核列表
     * @param type $user_id
     * @param type $state
     * @param type $p
     * @param type $pagesize
     */
    public function verifyList($user_id, $state,$keywords, $p, $pagesize) {
        $all_states = ['all', 'valid', 'wait', 'finish', 'cancel','history'];
        if (!in_array($state, $all_states)) {
            $this->buildFailed('状态类型有误');
        }
        $where['ar.up_user_id'] = $user_id;
        switch ($state) {
            case 'wait':
                $where['ar.status'] = 0;
                break;
            case 'finish':
                $where['ar.status'] = 1;
                break;
            case 'cancel':
                $where['ar.status'] = 2;
                break;
            case 'history':
                $where['ar.status'] = array('exp', 'IN (1,2)');
                break;
            case 'all':
                break;
            case 'valid':
            default:
                $where['ar.status'] = array('exp', 'IN (0,1)');
                break;
        }

        $offset = ($p - 1) * $pagesize;
        $field = 'ar.id,ar.order_no,ar.level_after,ar.level_before,ar.user_id,ar.money,ar.status,ar.status_complain,ar.create_time,ar.update_time,u.username,u.`code`,up.wx_account,up.account_name,up.head_icon';
        $ps = Db::name('ApplyRecord ar')->field($field)->join('__USER__ u','u.id=ar.user_id','LEFT')->join('__USER_PROFILE__ up','up.user_id=u.id','LEFT');
        $ps = $ps->where($where);
        
        if(!empty($keywords)){
            $ps = $ps->where('u.username|up.wx_account|u.code|up.account_name','like',"%".$keywords."%");
        }
        $_list = $ps->order('ar.create_time DESC')->limit($offset . ',' . $pagesize)->select();
        
        $status_names = ['0' => '待审核', '1' => '已完成', '2' => '已取消'];
        $status_complain_names = ['0' => '未投诉', '1' => '已投诉', '2' => '已撤销'];
        //获取某个等级的申请记录
        foreach ($_list as $key => $val) {
            $_list[$key]['create_time'] = date('Y-m-d H:i', $val['create_time']);
            $_list[$key]['status_name'] = $status_names[$val['status']];
            $level_after_name = Db::name('Level')->where(['level' => $val['level_after']])->value('name');
            $_list[$key]['level_after_name'] = strval($level_after_name);
             if ($val['status'] > 0) {
                $_list[$key]['update_time'] = date('Y-m-d H:i', $val['update_time']);
            } else {
                $_list[$key]['update_time'] = '--';
            }

            //获取商户信息
            $up_user_info = Db::name('User')->field('id,username,code')->where(['id' => $val['user_id']])->find();
            $up_user_profile = Db::name('UserProfile')->field('wx_account,account_name,head_icon')->where(['user_id' => $val['user_id']])->find();
            $_list[$key]['level_before'] = $val['level_before'];
            $level_before_name = Db::name('Level')->where(['level' => $val['level_before']])->value('name');
            $_list[$key]['level_before_name'] = strval($level_before_name);
            $_user = [];
            $_user['user_id'] = $val['user_id'];
            $_user['phone'] = strval($up_user_info['username']);
            $_user['wx_account'] = strval($up_user_profile['wx_account']);
            $_user['account_name'] = strval($up_user_profile['account_name']);
            $_user['code'] = strval($up_user_info['code']);
            $_user['head_icon'] = get_split_image_url($up_user_profile['head_icon']);
            $_user['wx_picture_id'] = get_split_image_url($up_user_profile['wx_picture_id']);

            $_list[$key]['status_complain_name'] = $status_complain_names[$val['status_complain']];
            $_list[$key]['apply_user'] = $_user;
            unset($_list[$key]['user_id']);
        }

        $data['list'] = $_list;
        $this->buildSuccess($data);
    }

    /**
     * 
     * @param type $param
     */
    public function verify($user_id, $apply_id, $verify_status, $note = '') {

        if ($verify_status != 1 && $verify_status != 2) {
            $this->buildFailed('审核状态有误');
        }

        //判断记录是否存在
        $ar_info = Db::name('ApplyRecord')->where(['id' => $apply_id, 'up_user_id' => $user_id])->find();
        if (!$ar_info) {
            $this->buildFailed('申请记录不存在');
        }

        if ($ar_info['status'] == 1) {
            $this->buildFailed('申请记录已完成，不可再审核');
        }
        if ($ar_info['status'] == 2) {
            $this->buildFailed('申请记录已取消，不可再审核');
        }
        if ($ar_info['status'] != 0) {
            $this->buildFailed('非法操作，不可审核');
        }

        if ($verify_status == 1) {//成功
            //todo -待处理事务 //更新状态
            //是否可以赠送积分
            $level_info = Db::name('Level')->where(['level' => $ar_info['level_after']])->find();
            $all_other = $this->get_all_other($level_info);
            $is_all = 0; //是否可以升级0 不可以 1可以升级
            if ($all_other['need_type'] == 1) {
                $is_all = 1;
            } else {
                $need_count = count($all_other['list']);
                $success_list = Db::name('ApplyRecord')->field('up_type')->where(['user_id' => $ar_info['user_id'], 'level_after' => $ar_info['level_after'], 'status' => 1])->group('up_type')->limit($need_count)->select();
                $success_count = count($success_list);
                if ($success_count >= $need_count - 1) {
                    $is_all = 1;
                }
            }

            if ($is_all == 1) {
                Db::startTrans();
                //会员升级
                $user_res = Db::name('User')->where(['id' => $ar_info['user_id']])->where('level', '<', $ar_info['level_after'])->update(['level' => $ar_info['level_after'], 'update_time' => TIME_NOW]);

                $apply_res = Db::name('ApplyRecord')->where(['id' => $ar_info['id']])->update(['status' => 1, 'verify_note' => strval($note), 'update_time' => TIME_NOW]);

                $score_res = true;

                $send_score = intval($level_info['score']);
                $level_after_name = $level_info['name'];
                if ($send_score > 0) {
                    $score_data = [
                        'user_id' => $ar_info['user_id'],
                        'score_amount' => $send_score,
                        'type' => 'upgrade',
                        'note' => '升级等级【' . $level_after_name . '】赠送糖果哦'
                    ];
                    $_score_res = change_score($score_data);
                    if (!$_score_res) {
                        $score_res = false;
                    }
                }

                if ($apply_res && $user_res && $score_res) {
                    Db::commit();

                    //获取会员信息
                    $user_info = Db::name('User')->field('username,code')->where(['id' => $ar_info['user_id']])->find();
                    $up_user_info = Db::name('User')->field('username,code')->where(['id' => $ar_info['up_user_id']])->find();
                    $username = $user_info['username'];

                    $content = '恭喜会员【' . phone_replace($username) . '】升级到【' . $level_after_name . '】';
                    $message_data = ['create_time' => TIME_NOW, 'content' => $content, 'agent_pid' => $ar_info['agent_pid'], 'type' => 1];
                    Db::name('Message')->insert($message_data);

                    //此处可以发送短信通知 todo
                    $msg = '恭喜您' . $username . '已成功升级到【' . $level_after_name . '】，审核商户【' . $up_user_info['code'] . '】';
                    send_sms($user_info['username'], $msg);
                    $this->buildSuccess([], '审核操作成功');
                } else {
                    Db::rollback();
                    $this->buildFailed('审核操作失败：系统繁忙，请稍后再试1');
                }
            } else {
                $apply_res = Db::name('ApplyRecord')->where(['id' => $ar_info['id']])->update(['status' => 1, 'verify_note' => strval($note), 'update_time' => TIME_NOW]);
                if ($apply_res) {
                    $this->buildSuccess([], '审核操作成功');
                } else {
                    $this->buildFailed('审核操作失败：系统繁忙，请稍后再试2');
                }
            }
        } else {//失败-取消
            $apply_res = Db::name('ApplyRecord')->where(['id' => $ar_info['id']])->update(['status' => 2, 'verify_note' => strval($note), 'update_time' => TIME_NOW]);
            if ($apply_res) {
                //此处可以发送短信通知 todo
                $user_info = Db::name('User')->field('username,code')->where(['id' => $ar_info['user_id']])->find();
                $up_user_info = Db::name('User')->field('username,code')->where(['id' => $ar_info['up_user_id']])->find();
                $level_after_name = Db::name('Level')->where(['level' => $ar_info['level_after']])->value('name');
                $username = $user_info['username'];
                $msg = '您' . $username . '升级到【' . $level_after_name . '】失败，请注意查看，审核商户【' . $up_user_info['code'] . '】';
                send_sms($user_info['username'], $msg);
                $this->buildSuccess([], '取消成功');
            } else {
                $this->buildFailed([], '取消失败：系统繁忙，请稍后再试');
            }
        }
    }

    /**
     * 升级投诉
     * @param type $user_id
     * @param type $apply_id
     * @param type $img
     */
    public function complain($user_id, $apply_id, $title, $content, $img = []) {
        $ids = [];
        if (count($img) > 0) {
            $ids = Db::name('picture')->where('sha1', 'in', $img)->column('id');
        }

        //判断是否已经
        $ar_info = Db::name('ApplyRecord')->field('id,status,status_complain,create_time')->where(['user_id' => $user_id, 'id' => $apply_id])->find();
        if (!$ar_info) {
            $this->buildFailed('升级记录不存在');
        }

        if ($ar_info['status_complain'] != 0) {
            $this->buildFailed('已投诉过，不可重复投诉');
        }

        //判断是否已经投诉过
        $complain = Db::name('Complain')->where(['apply_record_id' => $apply_id])->find();
        if ($complain) {
            $this->buildFailed('已投诉过，不可重复投诉');
        }

        //这个控制投诉时间 和状态
        if ($ar_info['status'] != 0 && $ar_recode['status'] != 2) {//未审核投诉
//            $this->buildFailed('当前不可投诉');
        }
        if ($ar_info['create_time'] + 7 * 86400 < TIME_NOW) {//超时投诉
            $this->buildFailed('已超过7日不可投诉，如有问题，请在意见箱中提出');
        }

        $add = [
            'apply_record_id' => $apply_id,
            'img_ids' => implode(',', $ids),
            'content' => $content,
            'title' => $title,
            'create_time' => TIME_NOW
        ];
        $res = Db::name('Complain')->insert($add);
        Db::name('ApplyRecord')->where(['id' => $ar_info['id']])->update(['status_complain' => 1, 'update_time' => TIME_NOW]);
        if ($res) {
            $this->buildSuccess([], '提交成功');
        } else {
            $this->buildFailed('操作失败，稍后再试');
        }
    }

    /**
     * 撤销投诉
     * @param type $user_id
     * @param type $apply_id
     */
    public function cancelComplain($user_id, $apply_id) {
        //判断是否已经
        $ar_info = Db::name('ApplyRecord')->field('id,status,status_complain,create_time')->where(['user_id' => $user_id, 'id' => $apply_id])->find();
        if (!$ar_info) {
            $this->buildFailed('升级记录不存在');
        }
        if ($ar_info['status_complain'] != 1) {
            $this->buildFailed('当前未投诉不可撤销');
        }

        $res = Db::name('ApplyRecord')->where(['id' => $ar_info['id']])->update(['status_complain' => 2, 'update_time' => TIME_NOW]);
        if ($res) {
            $this->buildSuccess([], '撤销成功');
        } else {
            $this->buildFailed('操作失败，稍后再试');
        }
    }

    /**
     * 获取投诉信息
     * @param type $user_id
     * @param type $apply_id
     */
    public function getComplainInfo($user_id, $apply_id) {
        //判断是否已经
        $ar_info = Db::name('ApplyRecord')->field('id,user_id,up_user_id,money,level_after,status,status_complain,create_time')->where(['id' => $apply_id])->find();
        if (!$ar_info) {
            $this->buildFailed('升级记录不存在');
        }

        $info['id'] = $ar_info['id'];
        $info['status'] = $ar_info['status'];
        $info['status_complain'] = $ar_info['status_complain'];
        $info['create_time'] = $ar_info['create_time'];
        $info['level_after'] = $ar_info['level_after'];
        $info['money'] = $ar_info['money'];
        $info['level_after_name'] = Db::name('Level')->where(['level' => $ar_info['level_after']])->value('name');

        //投诉详情
        if ($info['status_complain'] == 1 || $info['status_complain'] == 2) {
            $commlain = Db::name('Complain')->field('content,title,create_time,img_ids')->where('apply_record_id', $info['id'])->find();
            if (!$commlain) {
                $this->buildFailed('投诉信息有误');
            }
            $img_list = [];
            if ($commlain['img_ids']) {
                $img_arr = explode(',', $commlain['img_ids']);

                foreach ($img_arr as $key => $pid) {
                    if (!$pid) {
                        continue;
                    }
                    $img_list[] = get_split_image_url($pid);
                }
            }
            unset($commlain['img_ids']);
            $commlain['img_list'] = $img_list;
            $commlain['create_time'] = date('Y-m-d H:i', $commlain['create_time']);
        }

        //申请人
        $apply_user_info = Db::name('User')->field('id,username,code')->where(['id' => $ar_info['user_id']])->find();
        $apply_user_profile = Db::name('UserProfile')->field('wx_account,head_icon')->where(['user_id' => $ar_info['user_id']])->find();
        $_user = [];
        $_user['user_id'] = $ar_info['user_id'];
        $_user['phone'] = strval($apply_user_info['username']);
        $_user['wx_account'] = strval($apply_user_profile['wx_account']);
        $_user['code'] = strval($apply_user_info['code']);
        $_user['head_icon'] = get_split_image_url($apply_user_profile['head_icon']);

        //商户
        $up_user_info = Db::name('User')->field('id,username,code')->where(['id' => $ar_info['up_user_id']])->find();
        $up_user_profile = Db::name('UserProfile')->field('wx_account,head_icon')->where(['user_id' => $ar_info['up_user_id']])->find();
        $up_user = [];
        $up_user['user_id'] = $ar_info['up_user_id'];
        $up_user['phone'] = strval($up_user_info['username']);
        $up_user['wx_account'] = strval($up_user_profile['wx_account']);
        $up_user['code'] = strval($up_user_info['code']);
        $up_user['head_icon'] = get_split_image_url($up_user_profile['head_icon']);
                $up_user['wx_picture_id'] = get_split_image_url($up_user_profile['wx_picture_id']);


        $info['commlain'] = $commlain;
        $info['up_user'] = $up_user;
        $info['apply_user'] = $_user;
        $data = $info;
        $this->buildSuccess($info);
    }

}
