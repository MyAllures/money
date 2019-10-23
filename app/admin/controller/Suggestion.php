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
 * 意见反馈控制器
 */
class Suggestion extends AdminBase
{
    
    /**
     * 意见反馈列表
     */
    public function suggestionList()
    {
        $status = [
            '0' => '待审核',
            '1' => '已处理',
            '2' => '处理失败',
        ];
        
        $type = [
            '1' => '建议',
            '2' => '投诉',
        ];
        $data = $this->param;
        $search_type = $data['search_type'];
        
        $where = $this->logicSuggestion->getWhere($this->param);
        
        $list = $this->logicSuggestion->getSuggestionList($where);        

        $this->assign('list', $list);
        
        $this->assign('status', $status);
        $this->assign('search_type', $search_type);
        
        $this->assign('type', $type);
        
        return $this->fetch('suggestion_list');
    }
      
    
    /**
    * 意见反馈编辑
    */
    public function suggestionEdit(){
        
        $status = [
            '0' => '待审核',
            '1' => '已处理',
            '2' => '处理失败',
        ]; 
        
        $type = [
            '1' => '建议',
            '2' => '投诉',
        ];
        
        IS_POST && $this->jump($this->logicSuggestion->getSuggestionEdit($this->param));
        $data=$this->param;
        $where['id']=$data['id'];
        
        $info = $this->logicSuggestion->getSuggestionInfo(['s.id' => $data['id']], 's.*,u.username');
        
        $getImg = $this->logicSuggestion->getImgs($this->param);
        
//        !empty($info) && $info['img_ids_array'] = str2arr($info['img_ids']);
        
        $this->assign('status', $status);
        
        $this->assign('info', $info);
        
        $this->assign('getImg', $getImg);
        
        $this->assign('type', $type);
       
        return $this->fetch('suggestion_edit');
    }
    
    
    
    
    /**
     * 数据状态设置
     */
    public function setStatus()
    {
        
        $this->jump($this->logicAdminBase->setStatus('Article', $this->param));
    }
}
