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
use think\Db;
/**
 * 会员控制器
 */
class User extends AdminBase
{
    
    /**
     * 会员列表
     */
    public function userList()
    {
        $status = [
            '0' => '无效',
            '1' => '正常',
            '2' => '封号',
        ];
        $where = $this->logicUser->getWhere($this->param);
        
        $list = $this->logicUser->getUserList($where);        
        
        $level = $this->logicLevel->getLevelData($this->param);
        
        $this->assign('list', $list);
        
        $this->assign('status', $status);
        
        $this->assign('level', $level);
        
        return $this->fetch('user_list');
    }
      
    /**
     * 会员添加
     */
    public function userAdd() {

        IS_POST && $this->jump($this->logicUser->getUserEdit($this->param));

        return $this->fetch('user_edit');
    }
    
    /**
    * 会员编辑
    */
    public function userEdit(){
        
        $status = [
            '1' => '正常',
            '2' => '封号',
        ]; 
        $level = $this->logicUser->getUserLevel($this->param);
        IS_POST && $this->jump($this->logicUser->getUserEdit($this->param));
        $data=$this->param;
        $where['id']=$data['id'];
        $info = $this->logicUser->getUserInfo($where);    
               
        $this->assign('status', $status);
        $this->assign('level', $level);
        
        $this->assign('info', $info);
       
        return $this->fetch('user_edit');
    }
    
    
    
    
    /**
     * 数据状态设置
     */
    public function setStatus()
    {
        
        $this->jump($this->logicAdminBase->setStatus('Article', $this->param));
    }
    
    
      /**
     * 注册初始会员
     */
    public function register() {      
        IS_POST && $this->jump($this->logicUser->register($this->param,$this->request->ip()));
        $level = $this->logicUser->getUserLevel($this->param);
        $this->assign('level', $level);
        return $this->fetch('register');
    }

    /**
     *  实名认证列表
     */
    public function authentication(){


        $list=Db::name('user_card')->order('add_time desc')->paginate(15);
        $this->assign('list', $list);
        return $this->fetch('authentication_list');
    }


    public function authshenhe($id=0){
        $url = url('authentication');
        $result=Db::name('user_card')->where(['id' => $id])->update(['status' => 1,'shenhe_time'=>time()]);
        //var_dump($result);
        
        $this->redirect('user/authentication');
        //return $result ? [RESULT_SUCCESS, '审核成功', $url] : [RESULT_ERROR, '审核失败', $url];
    }
    public function authnopass($id=0){
        $url = url('authentication');
        $result=Db::name('user_card')->where(['id' => $id])->update(['status' => 2,'shenhe_time'=>time()]);
         $this->redirect('user/authentication');
        //return $result ? [RESULT_SUCCESS, '驳回成功', $url] : [RESULT_ERROR, '驳回失败', $url];
    }
}
