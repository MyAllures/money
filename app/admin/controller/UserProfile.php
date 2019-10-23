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
 * 会员资料控制器
 */
class UserProfile extends AdminBase
{
    
    /**
     * 会员资料列表
     */
    public function profileList()
    {
        $sex = [
            '0' => '未知',
            '1' => '男',
            '2' => '女',
        ];
        
        $where = $this->logicUserProfile->getWhere($this->param);
        
        $list = $this->logicUserProfile->getProfileList($where);        
        
        $this->assign('list', $list);
        
        $this->assign('sex', $sex);
        
        return $this->fetch('userprofile_list');
    }
      
    /**
    * 会员资料编辑
    */
    public function userProfileEdit(){
        
//        $status = [
//            '1' => '正常',
//            '2' => '封号',
//        ]; 
        
        IS_POST && $this->jump($this->logicUserProfile->getUserProfileEdit($this->param));
        $data=$this->param;
        $where['id']=$data['id'];
        $info = $this->logicUserProfile->getUserProfileInfo($where);    
               
//        $this->assign('status', $status);
        
        $this->assign('info', $info);
       
        return $this->fetch('userprofile_edit');
    }
    
    /**
     * 数据状态设置
     */
    public function setStatus()
    {
        
        $this->jump($this->logicAdminBase->setStatus('Article', $this->param));
    }
}
