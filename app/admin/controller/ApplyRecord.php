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
 * 升级管理控制器
 */
class ApplyRecord extends AdminBase
{
    
    /**
     * 升级管理列表
     */
    public function applyRecordList()
    {
        
        $status = [
            '0' => '发起申请',
            '1' => '同意',
            '2' => '撤销',
        ];

        $status_complain = [
            '0' => '未投诉',
            '1' => '已投诉',
            '2' => '已撤诉',
        ];
        
        $where = $this->logicApplyRecord->getWhere($this->param);
        
        $list = $this->logicApplyRecord->getApplyRecordList($where);  
        
        $level = $this->logicLevel->getLevelData($this->param);
        
        $this->assign('level', $level);
        
        $this->assign('list', $list);
        
        $this->assign('status', $status);
        
        $this->assign('status_complain', $status_complain);
        
        return $this->fetch('apply_record_list');
    }
    
    /**
    * 升级管理编辑
    */
    public function complainEdit(){
        
        IS_POST && $this->jump($this->logicApplyRecord->getComplainEdit($this->param));
        $data=$this->param;
        $where['id']=$data['id'];
        
        
//        if($data['id'] == ''){
//            
//        }
//        var_dump($data);die;
        
        $info = $this->logicApplyRecord->getComplainInfo(['c.id' => $data['id']], 'c.*');
        
        $getImg = $this->logicApplyRecord->getImgs($this->param);
        
//        !empty($info) && $info['img_ids_array'] = str2arr($info['img_ids']);
        
        
        $this->assign('info', $info);
        
        $this->assign('getImg', $getImg);
       
        return $this->fetch('apply_record_edit');
    }
    
    
    /**
     * 数据状态设置
     */
    public function setStatus()
    {
        
        $this->jump($this->logicAdminBase->setStatus('Article', $this->param));
    }
}
