<?php
namespace app\api\controller;

use app\api\controller\Base;
use think\Cache;

/**
 * 会员账户控制器
 */
class Account extends Base {

    /**
     * 获取资金记录列表
     */
    public function getLog() {
        $user_id = $this->getUserId();
        $p = isset($post['p'])?intval($post['p']):1;
        $pagesize = isset($post['pagesiz'])?intval($post['pagesiz']):10;
        if($p<1){
            $p = 1;
        }
        if($pagesize<1){
            $pagesize = 10;
        }
        $ob_type = isset($post['ob_type'])?intval($post['ob_type']):0;
        $show_type = isset($post['show_type']) && $post['show_type'] == 'list'?'list':'detail';
        $this->logicAccount->getLog($user_id,$ob_type,$p,$pagesiz,$show_type);
    }
    
    /**
     * 转账
     */
    public function tranfer() {
        $user_id = $this->getUserId();
        
        $post = $this->request->post();
        $base = [
            'to_username' => '转账对象不能为空',
            'money' => '转账金额不能为空',
            'pwd' => '请输入登陆密码',
        ];
        $this->check_empty($base, $post);
        $user_note = isset($post['user_note'])?$post['user_note']:'';
        $this->logicAccount->tranfer($user_id,$post['to_username'],$post['money'],$post['pwd'],$user_note);
        
    }
    
    /**
     * 提现
     */
    public function cash() {
        $user_id = $this->getUserId();
        
        $post = $this->request->post();
        $base = [
            'bank_id' => '请选择提现银行',
            'account_no' => '银行卡号不能为空',
            'account_name' => '银行账户不能为空',
            'money' => '提现金额不能为空',
        ];
        $this->check_empty($base, $post);
        $user_note = isset($post['user_note'])?$post['user_note']:'';
      
        $this->logicAccount->cashApply($user_id,$post['money'],$post['bank_id'],$post['account_no'],$post['account_name'],$user_note);
        
    }
    
    
}
