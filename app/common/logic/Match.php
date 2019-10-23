<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\common\logic;

use think\Db;

/**
 * Description of Match
 *
 * @author Administrator
 */
class Match {

    //put your code here
    /**
     * 主动添加记录
     * @param type $order_id
     * @return boolean
     */
    public $msg = '';

    public function initiative($order_id) {
        $order_data = Db::name('order')->where(['id' => $id])->find();
        if ($order_data) {
            return false;
        }
        $insert = [
            'user_id' => $order_data['user_id'],
            'agent_pid' => $order_data['agent_pid'],
            'order_id' => $order_id,
            'match_num' => '1', //如果需要后期修改
            'match_num_ready' => 0,
            'status' => '0',
            'create_time' => time(),
            'update_time' => time(),
        ];
        return Db::name('match_initiative')->insertGetId($insert);
    }

    /**
     * 订单完成添加记录
     */
    public function passive($order_id) {
        $order_data = Db::name('order')->where(['id' => $id])->find();
        if ($order_data) {
            return false;
        }
        $insert = [
            'user_id' => $order_data['user_id'],
            'agent_pid' => $order_data['agent_pid'],
            'order_id' => $order_id,
            'match_num' => '1', //如果需要后期修改
            'match_num_ready' => 0,
            'status' => '0',
            'create_time' => time(),
            'update_time' => time(),
        ];

        return Db::name('match_passive')->insertGetId($insert);
    }

    /**
     * 添加匹配记录
     * @param type $passive_id
     * @param type $initiative_id
     * @param type $agent_pid
     * @return boolean
     */
    public function match_record($passive_id, $initiative_id, $agent_pid) {
        if (empty($passive_id) || empty($initiative_id) || empty($agent_pid)) {
            return false;
        }
        $insert = [
            'match_initiative_id' => $initiative_id,
            'match_passive_id' => $passive_id,
            'status' => 0,
            'create_time' => time(),
            'update_time' => time(),
            'agent_pid' => $agent_pid
        ];
        return Db::name('match_record')->insertGetId($insert);
    }

    /**
     * 匹配操作
     * @param type $record_id 记录id
     * @param type $user_id 会员id
     * @param type $job 过程 1完成，2待确认收款 ，3失败撤销
     */
    public function deal_check($record_id, $job, $user_id = 0) {
        if ($job == 2) {//2待确认收款 ，主动人操作
            if (empty($user_id)) {
                $this->msg = '会员id不为空';
                return false;
            }
            $record_data = Db::name('match_record')->where(['id' => $record_id])->find();
            if (empty($record_data)) {
                $this->msg = '匹配记录不存在';
                return false;
            }
            $match_initiative_id = $record_data['match_initiative_id'];
            $match_initiative = Db::name('match_initiative')->where(['id' => $match_initiative_id])->find();
            if (empty($match_initiative)) {
                $this->msg = '主动匹配记录不存在';
                return false;
            }
            if ($match_initiative['user_id'] != $user_id) {
                $this->msg = '你无权操作';
                return false;
            }
            $res = Db::name('match_record')->where(['id' => $record_id])->update(['status' => '2', 'update_time' => time()]);
            if ($res) {
                return true;
            } else {
                $this->msg = '系统错误稍后再试';
                return false;
            }
        } elseif ($job == 1) {
            //1完成，被动人操作
            if (empty($user_id)) {
                $this->msg = '会员id不为空';
                return false;
            }
            $record_data = Db::name('match_record')->where(['id' => $record_id])->find();
            if (empty($record_data)) {
                $this->msg = '匹配记录不存在';
                return false;
            }
            $match_passive_id = $record_data['match_passive_id'];
            $match_initiative_id = $record_data['match_initiative_id'];
            $match_passive = Db::name('match_passive')->where(['id' => $match_passive_id])->find();
            if (empty($match_passive)) {
                $this->msg = '被动匹配记录不存在';
                return false;
            }
            if ($match_passive['user_id'] != $user_id) {
                $this->msg = '你无权操作';
                return false;
            }
            $match_initiative = Db::name('match_initiative')->where(['id' => $match_initiative_id])->find();
            if (empty($match_initiative)) {
                $this->msg = '主动匹配记录不存在';
                return false;
            }
            $time = time();

            $initiative_match_num_success = $match_initiative['match_num_success'] + 1; //成功人数+1
            $initiative_match_num = $match_initiative['match_num']; //成功人数+1
            $update_initiative = [];
            $update_initiative['update_time'] = $time;
            $update_initiative['match_nun_success'] = $initiative_match_num_success;
            if ($initiative_match_num == $initiative_match_num_success) { //主动匹完成
                $update_initiative['status'] = 1;
            }

            $passive_match_num_success = $match_passive['match_num_success'] + 1; //成功人数+1
            $passive_match_num = $match_passive['match_num'] + 1; //成功人数+1
            $update_passive = [];
            $update_passive['update_time'] = $time;
            $update_passive['match_nun_success'] = $passive_match_num_success;
            if ($passive_match_num == $passive_match_num_success) { //被动完成
                $update_passive['status'] = 1;
            }

            Db::startTrans(); //开启事务
            $res1 = Db::name('match_record')->where(['id' => $record_id])->update(['status' => '1', 'update_time' => time()]); //匹配记录更新
            $res2 = Db::name('match_initiative')->where(['id' => $match_initiative_id])->update($update_initiative); //主动地订单更新
            $res3 = Db::name('match_passive')->where(['id' => $match_passive_id])->update($update_passive); //被动订单更新
            if ($res1 && $res2 && $res3) {
                Db::commit(); //事务提交
                return true;
            } else {
                Db::rollback();
                $this->msg = '系统错误稍后再试';
                return false;
            }
        } elseif ($job == '3') {
            //3失败撤销,系统操作
            $record_data = Db::name('match_record')->where(['id' => $record_id])->find();
            if (empty($record_data)) {
                $this->msg = '匹配记录不存在';
                return false;
            }
            $match_passive_id = $record_data['match_passive_id'];
            $match_initiative_id = $record_data['match_initiative_id'];
            $match_passive = Db::name('match_passive')->where(['id' => $match_passive_id])->find();
            $user_id = $match_passive['user_id'];
            if (empty($match_passive)) {
                $this->msg = '被动匹配记录不存在';
                return false;
            }

            $match_initiative = Db::name('match_initiative')->where(['id' => $match_initiative_id])->find();
            if (empty($match_initiative)) {
                $this->msg = '主动匹配记录不存在';
                return false;
            }
            $time = time();


            $update_initiative = [];
            $update_initiative['update_time'] = $time;
            $update_initiative['status'] = '0'; //重新匹配
            $update_initiative['match_num_fail'] = $match_initiative['match_num_fail'] + 1;

            $update_passive = [];
            $update_passive['update_time'] = $time;
            $update_passive['status'] = 3; //把这个失败
            $update_passive['match_num_fail'] = $match_passive['match_num_fail'] + 1;

            Db::startTrans(); //开启事务
            $res1 = Db::name('match_record')->where(['id' => $record_id])->update(['status' => '3', 'update_time' => $time]); //匹配记录更新
            $res2 = Db::name('match_initiative')->where(['id' => $match_initiative_id])->update($update_initiative);
            $res3 = Db::name('match_passive')->where(['id' => $match_passive_id])->update($update_passive);
            $res4 = Db::name('user')->where(['id' => $user_id])->update(['stauts' => '2', 'token' => '', 'update_time' => $time]); //封号 token模式
            if ($res1 && $res2 && $res3 && $res4) {
                Db::commit(); //事务提交
                return true;
            } else {
                Db::rollback();
                $this->msg = '系统错误稍后再试';
                return false;
            }
        } else {
            $this->msg = '类型错误';
            return false;
        }
    }

    /**
     * 匹配
     * @param type $match_initiative，主动订单列表
     */
    public function matching($match_initiative) {
        $agent_pid = $match_initiative['agent_pid'];
        $initiative_id = $match_initiative['id'];
        $user_id = $match_initiative['user_id'];
        $limit = $match_initiative['match_num'] - $match_initiative['match_num_ready'] + $match_initiative['match_nun_fail'];
        if ($limit <= 0) {
            $this->msg = '该主动订单已经完成匹配';
            return false;
        }
        //查询好友的id
        $friend_list = $this->get_friend_list($user_id);
        ////查找被动订单，创建时间升序
        $match_passives = Db::name('match_passive')->where(['status' => '0', 'agent_pid' => $agent_pid, 'user_id' => ['not in', $friend_list]])->find();
        if (empty($match_passives)) {
            $this->msg = '未有被动订单可以匹配';
            return false;
        }
        $friend_user_id = $match_passives['user_id'];
        $limit2 = $match_passives['match_num'] - $match_passives['match_num_ready'] + $match_passives['match_nun_fail'];
        $match_passive_id = $match_passives['id'];

        $time = time();
        $update_initiative['update_time'] = $time;
        $update_initiative['match_num_ready'] = $match_initiative['match_num_ready'] + 1;
        if ($limit == 1) {//主动完成
            $update_initiative['status'] = '2'; //等待付款完成
        }

        $update_passives['update_time'] = $time;
        $update_passives['match_num_ready'] = $match_passives['match_num_ready'] + 1;
        if ($limit2 <= 1) {//被动完成
            $update_passives['status'] = '2'; //等待付款完成
        }
        Db::startTrans(); //开启事务
        $res1 = $this->match_record($match_passive_id, $initiative_id, $agent_pid); //更新好
        $res2 = Db::name('match_initiative')->where(['id' => $initiative_id])->update($update_initiative); //更新主动订单
        $res3 = Db::name('match_passive')->where(['id' => $match_passive_id])->update($update_passives); //更新被动的订单
        $res4 = $this->add_friend($user_id, $friend_user_id); //互相添加好友
        $res5 = $this->add_friend($friend_user_id, $user_id); //互相添加好友
        //加好友
        if ($res1 && $res2 && $res3 && $res4 && $res5) {
            Db::commit(); //事务提交
            return true;
        } else {
            Db::rollback();
            $this->msg = '系统错误稍后再试';
            return false;
        }
        /*
         * 确定被动订单是否完成 完成改变订单状态
         * 确定主动订单是否完成 完成改变订单状态
         */
        // 确定是否改变状态  主动状态  被动状态，人数变动
    }

    /**
     * 获取好友列表
     */
    public function get_friend_list($user_id) {
        return Db::name('friend')->where(['user_id' => $user_id, 'status' => '1'])->column('friend_user_id');
    }

    /**
     * 添加好友
     * @param type $user_id
     * @param type $friend_user_id
     * @return type
     */
    public function add_friend($user_id, $friend_user_id) {
        $add = [
            'user_id' => $user_id,
            'friend_user_id' => $friend_user_id,
            'nick_name' => '',
            'status' => '1',
            'add_type' => '2',
            'from_type' => '1',
            'create_time' => time(),
            'update_time' => time()
        ];
        return Db::name('friend')->insert($add);
    }

    /**
     * 查找任务
     */
    public function find_matching_lists() {

        return $data = Db::name('match_initiative')->where(['status' => 0])->limit(100)->select();
    }

    /**
     * 执行任务
     */
    public function do_matching() {
        $data = $this->find_matching_lists();
        if (empty($data)) {
            echo '没有数据' . PHP_EOL;
        }
        foreach ($data as $value) {
            $res = $this->matching($value);
            echo $this->msg . PHP_EOL . '<br>';
        }
    }

}
