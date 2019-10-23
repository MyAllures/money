<?php
// +---------------------------------------------------------------------+
// | OneBase    | [ WE CAN DO IT JUST THINK ]                            |
// +---------------------------------------------------------------------+
// | Licensed   | http://www.apache.org/licenses/LICENSE-2.0 )           |
// +---------------------------------------------------------------------+
// | Author     | Bigotry <3162875@qq.com>                               |
// +---------------------------------------------------------------------+
// | Repository | https://gitee.com/Bigotry/OneBase                      |
// +---------------------------------------------------------------------+

namespace app\admin\controller;

/**
 * 提现控制器
 */
class Withdraw extends AdminBase
{
    
    /**
     * 提现列表
     */
    public function withdrawList()
    {
        $status = [
            '0' => '申请中',
            '1' => '审核成功',
            '2' => '审核失败',
        ];
        
        $where = $this->logicWithdraw->getWhere($this->param);
        
        $list = $this->logicWithdraw->getWithdrawList($where);        
        
        $this->assign('list', $list);
        
        $this->assign('status', $status);
        
        return $this->fetch('withdraw_list');
    }
      
    /**
     * 提现添加
     */
    public function userAdd() {

        IS_POST && $this->jump($this->logicWithdraw->getUserEdit($this->param));

        return $this->fetch('user_edit');
    }
    
    /**
    * 提现编辑
    */
    public function withdrawEdit(){
        
        $status = [
            '0' => '申请中',
            '1' => '审核成功',
            '2' => '审核失败',
        ]; 
        
        IS_POST && $this->jump($this->logicWithdraw->getUserEdit($this->param));
        $data=$this->param;
        $where['id']=$data['id'];
        $info = $this->logicWithdraw->getUserInfo($where);    
               
        $this->assign('status', $status);
        
        $this->assign('info', $info);
       
        return $this->fetch('withdraw_edit');
    }
    
    /**
     * 审核弹窗
     */
    public function docheck() {
        
        $this->view->engine->layout(false);
          
        $data=$this->param;
        
        $where['id']=$data['id'];
        
        $info = $this->logicWithdraw->getWithdrawData($where);   
        
        IS_POST && $this->jump($this->logicWithdraw->getUserEdit($this->param));
        
        $this->assign('info', $info);
        
        return $this->fetch('docheck');
    }
    
    
    /**
     * 数据状态设置
     */
    public function setStatus()
    {
        
        $this->jump($this->logicAdminBase->setStatus('Article', $this->param));
    }
}
