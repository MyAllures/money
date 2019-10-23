<?php
namespace app\admin\controller;
use think\Db;
/**
 * 等级管理控制器
 */
class Debt extends AdminBase {

    /**
     * 获取负债记录列表
     *
     */
    public function debtList() {

        $res = Db::name('zcplan')
      ->alias("a") //取一个别名
      //与category表进行关联，取名i，并且a表的categoryid字段等于category表的id字段
      ->join('user_card i', 'a.uid = i.uid')
      //想要的字段
      ->field('a.Id,a.account,a.name,i.user_name,a.create_time,a.status,a.imgurl ')
	  ->order('create_time desc')
      //查询
      ->paginate(15);
	  
	  
        $this->assign('debtInfo', $res);
        return $this->fetch('debt_list');
		
		
		/*$where = $this->logicUser->getWhere($this->param);
        
        $list = $this->logicUser->getUserList($where);        
        
        $level = $this->logicLevel->getLevelData($this->param);
        
        $this->assign('list', $list);
        
        $this->assign('status', $status);
        
        $this->assign('level', $level);
        
        return $this->fetch('user_list');*/
    }

    /**
     * 审核通过负债申请 方法
     *
     */
    public function editDebt($ids=0){
        return $this->jump($this->logicDebt->shenhe($ids));
    }

    /**
     * 驳回负债申请 方法
     */
    public function refuse($ids){
        return $this->jump($this->logicDebt->nopass($ids));
    }

}
