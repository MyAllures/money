<?php

namespace app\api\logic;

use \app\api\controller\Base;
use app\common\logic\ReturnCode;
use think\Db;

/**
 * 会员账户逻辑
 */
class Account extends Base {

    /**
     * 获取自资金记录
     * @param type $user_id 会员id
     * @param type $ob_type 类型
     * @param type $p 页数
     * @param type $pagesiz 每页显示
     */
    public function getLog($user_id,$ob_type,$p,$pagesiz,$show_type='detail') {
    
        //获取用户的信息
        $user_info = array();
        if($show_type == 'detail'){
            $user = Db::name('User')->field('id,money,username')->where(['id' => $user_id])->find();
            $user_info['money'] = $user['money'];
            $user_info['user_id'] = $user['id'];
            $user_info['username'] = $user['username'];
        }
        
        $where = ' user_id= '.intval($user_id);
        switch ($ob_type) {
            case 1:
                $where .= " AND income_type=1 AND `type` NOT IN ('cash','cash_fail') ";

                break;
            case 2:
                 $where .= " AND income_type=2 AND `type` NOT IN ('cash','cash_fail') ";

                break;
            case 3:
                $where .= " AND `type` IN ('cash','cash_fail') ";

                break;
            case 0:
                break;

            default:
                $where .= " AND id=-1 ";
                break;
        }
        
        $types = [
            'public'=>'消费',
            'transfer_out'=>'转出',
            'transfer_in'=>'转入',
            'cash'=>'提现',
            'cash_fail'=>'提现退款',
            'team_profit'=>'团队奖励',
        ];
        
        $start = ($p - 1) * $pagesize;
        $_list= Db::name("AccountLog")->where($where)->limit($start . ',' . $pagesize)->select();
        $list = [];
        if(is_array($_list)){
            foreach($_list as $key=>$val){
                $list[$key]['icon'] = get_trade_icon($val['type']);
                $list[$key]['type'] = $val['type'];
                $list[$key]['amount'] = strval($val['amount']);
                $list[$key]['to_user_id'] = intval($val['to_user_id']);
                $list[$key]['type_name'] = $types[$val['type']];
                $list[$key]['note'] = isset($val['note'])?strval($val['note']):'';
                $list[$key]['order_no'] = isset($val['order_no'])?strval($val['order_no']):'';
                $list[$key]['create_time'] = date("Y-m-d H:i",$val['create_time']);
            }
        }

        $data['show_type'] = $show_type;
        $data['list'] = $list;
        if($show_type == 'detail'){
            $data['user_info'] = $user_info;
        }
        $this->buildSuccess($data,'获取成功');
    }
    
    /**
     * 转账
     * @param type $user_id 会员
     * @param type $to_username 转账对象
     * @param type $money 转账金额
     * @param type $user_note 备注
     * 
     */
    public function tranfer($user_id,$to_username,$money,$pwd='',$user_note='') {
        
        $user = Db::name('User')->field('id,username,status,money,pwd')->where(['id' => $user_id])->find();
        if (empty($user)) {
            $this->buildFailed('会员信息获取失败');
        }
        
        //验证金额
        $money = floatval($money);
        $money = round($money,2);
         //验证会员是否有误
        $to_user = Db::name('User')->field('id,username')->where(array('username'=>$to_username))->find();
        if(!is_array($to_user) || !$to_user){
            $this->buildFailed('转账对象错误');
        }
        
        //转账对象限制
        if($to_user['id']==$user['id']){
            $this->buildFailed('不能转给自己');
        }
        
        if($money<0.01){
            $this->buildFailed('转账金额过低');
        }
        
        $min_money = 0.02;
        $max_money = 1000;
        if($min_money>0 && $money<$min_money){
            $this->buildFailed('最低转账金额'.$min_money.'元');
        }
        if($max_money>0 && $money>$max_money){
            $this->buildFailed('最高转账金额'.$max_money.'元');
        }
        
        //判断余额是否充足
        if($user['money']<$money){
            $this->buildFailed('余额不足');
        }
        
        //登陆密码
        if(!check_passwd_encrypt($pwd, $user['pwd'])){
            $this->buildFailed('登陆密码有误');
        }
        
        $_money = -1 * $money;
        //转账处理
        $from_note = '转账';
        if($user_note){
            $from_note.',备注【'.$user_note.'】';
        }
     
        Db::startTrans(); //开启事务
        //转出
        $from_data = [
            'user_id'=>$user['id'],
            'amount'=>$_money,
            'type'=>'transfer_out',
            'to_user_id'=>$to_user['id'],
            'note'=>$from_note,
        ];
        $from_res = change_money($from_data,1);
        
        //转入
        $to_note = "转账";
        $to_data = [
            'user_id'=>$to_user['id'],
            'amount'=>$money,
            'type'=>'transfer_in',
            'to_user_id'=>$user['id'],
            'note'=>$to_note,
        ];
        $to_res = change_money($to_data,1);
        
        if($from_res && $to_res){
            Db::commit(); //事务提交
            $this->buildSuccess([], '转账成功', ReturnCode::SUCCESS);
        }else{
            Db::rollback();
            $this->buildFailed('转账失败，请稍后再试');
        }
        
    }
    
    /**
     * 提现申请
     */
    public function cashApply($user_id,$money,$bank_id,$account_no,$account_name,$user_note='') {
        
        $user = Db::name('User')->field('id,username,status,money,pwd')->where(['id' => $user_id])->find();
        if (empty($user)) {
            $this->buildFailed('会员信息获取失败');
        }
       
        //验证银行有效
        $bank_id = intval($bank_id);
        if($bank_id<=0){
            $this->buildFailed('银行有误');
        }
        $bank_info = Db::name('Bank')->where(['bank_id'=>$bank_id,'is_select'=>1])->find();
        if(empty($bank_info)){
            $this->buildFailed('银行有误');
        }
      
        //验证银行卡号
        if(!check_bank_no($account_no)){
//            $this->buildFailed('银行卡号有误');
        }
        
         //验证金额
        $money = floatval($money);
        $money = round($money,2);
        
        //提现设置
        $min_money = 10;//最低提现金额，0表示不限
        $max_money = 0;//单笔最高提现金额，0表示不限
        $mutil_money = 10;//单笔提现限制倍数
        $fee_type = 0;//手续费收取方式，0固定值，1比例
        $fee_value = 0;//固定手续费，如果手续费为固定值
        $fee_rate = 2;//手续费比例。(%)如果手续费是比例则如果为2，则为2%
        $amount = round($data["amount"],2);
        
        if($min_money>0 && $min_money>$money){
            $this->buildFailed('金额不可低于'.$min_money.'元');
        }
        if($max_money>0 && $max_money<$money){
            $this->buildFailed('金额不可高于'.$max_money.'元');
        }
        if($mutil_money>0 && $money%$mutil_money!=0){
            $this->buildFailed('金额必须为'.$mutil_money.'的倍数');
        }
        
        if($fee_type==1){//按比例计算
            $fee = round($money * $fee_rate/100,2);
        }else{
            $fee = $fee_value;
        }
        if($fee>0){
            $fee = round(ceil($fee*100)/100,2);
        }else{
            $fee = 0;
        }
        
        //todo
        //每天提现次数
        //每天提现总额
        
        //判断是否余额不足
        if($user['money']<$money){
            $this->buildFailed('余额不足');
        }
        $real_money = $money - $fee;
        
        //提现记录
        $order_no = create_order_no('cash');
        
        Db::startTrans();
        $cash_data = [
            'user_id'=>$user_id,
            'order_no'=>$order_no,
            'money'=>$money,
            'real_money'=>$real_money,
            'fee'=>$fee,
            'user_note'=>strval($user_note),
            'create_time'=>TIME_NOW,
            'update_time'=>TIME_NOW,
        ];
        $cash_id = Db::name('Withdraw')->insert($cash_data);
        
        //扣除金额
        $note = "提现";
        if($user_note){
            $note .= '，备注【'.$user_note.'】';
        }
        $change_data = [
            'user_id'=>$user_id,
            'amount'=>-1*$money,
            'type'=>'cash',
            'order_no'=>$order_no,
            'note'=>$note,
        ];
        $change_res = change_money($change_data,1);
        if($cash_id && $change_res){
            Db::commit(); //事务提交
            $this->buildSuccess([], '申请提现成功，等待后台管理员审核', ReturnCode::SUCCESS);
        }else{
             Db::rollback();
            $this->buildFailed('提现失败，请稍后再试');
        }

    }
}
