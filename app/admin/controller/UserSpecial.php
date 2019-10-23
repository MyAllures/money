<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\admin\controller;

/**
 * Description of UserSpecial
 *  特殊会员资料
 * @author Administrator
 */
class UserSpecial extends AdminBase{
    //put your code here
    public function userspecialList(){
        $this->assign('list',$this->logicUserSpecial->userspecialList($this->param));
        $this->assign('status',$status=['1'=>'开启','0'=>'关闭']);
        return $this->fetch('userspecial_list');
    }
    /**
     * 课程添加
     */
    public function userspecialAdd(){
        IS_POST && $this->jump($this->logicUserSpecial->userspecialAdd($this->param));
        return $this->fetch('userspecial_add');
    }
    /**
     * 数据状态设置
     */
    public function setStatus()
    {
        
        $this->jump($this->logicAdminBase->setStatus('UserSpecial', $this->param));
    }
}
