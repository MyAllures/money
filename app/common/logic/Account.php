<?php

/**
 * 会员账户
 * @author      zjb
 * @datetime 2018-12-26 15:40:38
 */

namespace app\common\logic;

use Think\Db;

class Account extends LogicBase {

    /**
     * 账户余额变动
     * @param array $_data 数据
     *               user_id 会员id 必填
     *               amount 金额（变动值） 必填
     *               type 变动类型 必填
     *               to_user_id 对方会员id 非必填
     *               order_no 订单号 非必填
     *               note 备注 非必填
     * @param  boolean $is_trans  外部是否已经完成事务，true|1 已完成，false,0未完成，其他信息 默认事务，如果不需要事务传1
     * @return boolean $flag 状态（true-成功，false-失败）
     */
    public function changeMoney($_data = [], $is_trans = 0) {
        $amount = round(floor($_data['amount'] * 100) / 100, 2);
        $user_id = $_data['user_id']; //会员
        $type = strval($_data['type']); //变动类型
        $order_no = strval($_data['order_no']); //订单号
        $note = strval($_data['note']);
        $to_user_id = $_data['to_user_id']?intval($_data['to_user_id']):0;
        if ($amount == 0) {
            return true;
        }

        if ($amount > 0) {
            $income_type = 1;
        } else {
            $income_type = 2;
        }

        if (!$is_trans) {
            Db::startTrans(); //开启事务
        }
        //添加变动记录
        $data = [
            'user_id' => $user_id,
            'income_type' => $income_type,
            'amount' => $amount,
            'type' => $type,
            'note' => $note,
            'to_user_id' => $to_user_id,
            'order_no' => $order_no,
            'create_time' => TIME_NOW,
        ];
        $res_back = Db::name('AccountLog')->insert($data);

        $_update_data = [
            'money' => ['exp', '`money`+(' . $amount . ')'],
        ];
        //更新会员的账户
        $res_user = Db::name('User')->where(['id' => $user_id])->update($_update_data);

        if ($res_back && $res_user) {
            if (!$is_trans)
                Db::commit(); //事务提交
            return true;
        }else {
            if (!$is_trans)
                Db::rollback(); //事务回滚
            return false;
        }
    }
    

    /**
     * 变动积分
     * @param array $_data 数据
     *               user_id 会员id 必填
     *               score 积分（变动值）非必填 （与积分冻结必填其一）
     *               score_amount 积分冻结（变动值） 非必填 （与积分必填其一）
     *               type 变动类型 必填
     *               to_user_id 对方会员id 非必填
     *               order_no 订单号 非必填
     *               note 备注 非必填
     * @param  boolean $is_trans  外部是否已经完成事务，true|1 已完成，false,0未完成，其他信息 默认事务，如果不需要事务传1
     * @return boolean $flag 状态（true-成功，false-失败）
     */
    function changeScore($_data = [], $is_trans = 0) {
        
        $user_id = intval($_data['user_id']); //会员
        $type = strval($_data['type']); //变动类型
        $order_no = strval($_data['order_no']); //订单号
        $note = strval($_data['note']);
        $to_user_id = $_data['to_user_id']?intval($_data['to_user_id']):0;

        $score = intval($_data['score']);
        $score_amount = intval($_data['score_amount']);
        if($user_id<0){
            return false;
        }
        if ($score_amount == 0 && $score==0) {
            return true;
        }

        if (!$is_trans) {
            Db::startTrans(); //开启事务
        }
        //添加变动记录
        $data = [
            'user_id' => $user_id,
            'score' => $score,
            'score_amount' => $score_amount,
            'type' => $type,
            'note' => $note,
            'to_user_id' => $to_user_id,
            'order_no' => $order_no,
            'create_time' => TIME_NOW,
        ];
        $res_back = Db::name('ScoreLog')->insert($data);

        $_update_data = [
            'score' => ['exp', '`score`+(' . $score . ')'],
            'score_amount' => ['exp', '`score_amount`+(' . $score_amount . ')']
        ];
        //更新会员的账户
        $res_user = Db::name('User')->where(['id' => $user_id])->update($_update_data);

        if ($res_back && $res_user) {
            if (!$is_trans)
                Db::commit(); //事务提交
            return true;
        }else {
            if (!$is_trans)
                Db::rollback(); //事务回滚
            return false;
        }
    }
}
