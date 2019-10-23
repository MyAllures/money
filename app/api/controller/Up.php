<?php

namespace app\api\controller;

use app\api\controller\Base;
use think\Cache;

/**
 * 升级控制器
 */
class Up extends Base {

    /**
     * 申请升级
     */
    public function apply() {
        $post = $this->request->post();
        $user_id = $this->getUserId();
        $up_type = isset($post['up_type'])?intval($post['up_type']):0;
        if($up_type<0){
            $this->buildFailed('升级要求类型有误');
        }
        $this->logicUp->apply($user_id,$up_type);
    }
    
    /**
     * 判断是否可以申请
     */
    public function getApplyInfo() {
        $post = $this->request->post();
        $user_id = $this->getUserId();
        $this->logicUp->getApplyInfo($user_id);
    }
    
    /**
     * 申请列表
     */
    public function applyList() {
        $post = $this->request->post();
        $user_id = $this->getUserId();
        $p = isset($post['p']) ? intval($post['p']) : 1;
        $pagesize = isset($post['pagesize']) ? intval($post['pagesize']) : 10;
        if ($p < 1) {
            $p = 1;
        }
        if ($pagesize < 1) {
            $pagesize = 10;
        }
        $state = isset($post['state']) ? strval($post['state']) :'valid';
        $all_states = ['all','valid','wait','finish','cancel','history'];
        if(!in_array($state, $all_states)){
            $this->buildFailed('状态类型有误');
        }
        $keywords = isset($post['keywords']) ? strval($post['keywords']) :'';
        $this->logicUp->applyList($user_id,$state,$keywords,$p,$pagesize);
    }
    
    /**
     * 审核列表
     */
    public function verifyList() {
        $post = $this->request->post();
        $user_id = $this->getUserId();
        $p = isset($post['p']) ? intval($post['p']) : 1;
        $pagesize = isset($post['pagesize']) ? intval($post['pagesize']) : 10;
        if ($p < 1) {
            $p = 1;
        }
        if ($pagesize < 1) {
            $pagesize = 10;
        }
        $state = isset($post['state']) ? strval($post['state']) :'valid';
        $all_states = ['all','valid','wait','finish','cancel','history'];
        if(!in_array($state, $all_states)){
            $this->buildFailed('状态类型有误');
        }
        $keywords = isset($post['keywords']) ? strval($post['keywords']) :'';
        $this->logicUp->verifyList($user_id,$state,$keywords,$p,$pagesize);
    }
    
    /**
     * 审核申请
     */
    public function verify() {
        $user_id = $this->getUserId();
        $post = $this->request->post();
        $base = [
            'apply_id' => '申请记录id不能为空',
            'verify_status' => '审核状态不能为空',
        ];
        $this->check_empty($base, $post);
        $note = isset($post['note']) ? $post['note'] : '';
        $this->logicUp->verify($user_id, $post['apply_id'], $post['verify_status'],$note);
    }
    
    /**
     * 投诉
     */
    public function complain() {
        $user_id = $this->getUserId();
        $post = $this->request->post();
        $base = [
            'apply_id' => '升级记录id不能为空',
            'title' => '标题不能为空',
            'content' => '内容不能为空',
        ];
        $this->check_empty($base, $post);
        
        $title = isset($post['title'])?trim($post['title']):'';
        $content = isset($post['content'])?trim($post['content']):'';
        $img_ids = isset($_POST['img_ids'])?trim($_POST['img_ids']):'';
        $apply_id = isset($post['apply_id'])?intval($post['apply_id']):'';
        $ids = '';
        
        $img_ids = htmlspecialchars_decode($img_ids);
        $img = json_decode($img_ids,true);
        if(!empty($img_ids) && !is_array($img)){
            
            if(empty($img)){
                $this->buildFailed('图片上传有误');
            }
        }
        if(count($img)>0){
            if(count($img)>8){//图片过多
                $this->buildFailed('图片过多');
            }
        }
        if($apply_id<=0){
            $this->buildFailed('升级记录不存在');
        }
        $this->logicUp->complain($user_id, $apply_id, $title,$content,$img);
        
    }

    /**
     * 撤销投诉
     */
    public function cancelComplain() {
        $user_id = $this->getUserId();
        $post = $this->request->post();
        $base = [
            'apply_id' => '升级记录id不能为空',
        ];
        $this->check_empty($base, $post);
        $apply_id = isset($post['apply_id'])?intval($post['apply_id']):0;
        if($apply_id<=0){
            $this->buildFailed('升级记录不存在');
        }
        $this->logicUp->cancelComplain($user_id, $apply_id);
    }
    
    /**
     * 获取投诉信息
     */
    public function getComplainInfo() {
        $user_id = $this->getUserId();
        $post = $this->request->post();
        $base = [
            'apply_id' => '升级记录id不能为空',
        ];
        $this->check_empty($base, $post);
        $apply_id = isset($post['apply_id'])?intval($post['apply_id']):0;
        if($apply_id<=0){
            $this->buildFailed('升级记录不存在');
        }
        $this->logicUp->getComplainInfo($user_id, $apply_id);
    }
}
