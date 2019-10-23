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

namespace app\api\controller;

use app\api\controller\Base;
use think\Db;
use think\Cache;

/**
 * 演示控制器
 */
class Tool extends Base {

    public function head() {
        $user_id = $this->getUserId();
        $File = new \app\common\logic\File();
        $result = $File->pictureUpload();
        if (!$result) {
            $this->buildFailed('上传失败');
        }
        $picture_id = $result['id'];
        $rs = Db::name('user_profile')->where(['user_id' => $user_id])->update(['head_icon' => $picture_id]);
        if (!$rs) {
            $this->buildFailed('上传失败');
        }
        $url = get_picture_url($picture_id);
        $this->buildSuccess(['url' => 'http://' . $_SERVER['HTTP_HOST'] . $url]);
    }

    public function wx_head() {
        $user_id = $this->getUserId();
        $File = new \app\common\logic\File();
        $result = $File->pictureUpload();
        if (!$result) {
            $this->buildFailed('上传失败');
        }
        $picture_id = $result['id'];
        $rs = Db::name('user_profile')->where(['user_id' => $user_id])->update(['wx_picture_id' => $picture_id]);
        if (!$rs) {
            $this->buildFailed('上传失败!');
        }
        $url = get_picture_url($picture_id);
        $this->buildSuccess(['url' => 'http://' . $_SERVER['HTTP_HOST'] . $url]);
    }

    public function img_upload() {
        $user_id = $this->getUserId();
        $File = new \app\common\logic\File();
        $result = $File->pictureUpload();
        if (!$result) {
            $this->buildFailed('上传失败');
        }

        $picture_id = $result['id'];
        $url = get_picture_url($picture_id);

        $this->buildSuccess(['url' => 'http://' . $_SERVER['HTTP_HOST'] . $url, 'id' => $result['sha1']]);
    }

    public function message() {
        $user_id = $this->getUserId();
        $message = Cache::get('sys:message');
        if (empty($message)) {
            $message = Db('message')->order('create_time desc')->field('content')->limit(30)->select();
            Cache::set('sys:message', $message, 300);
        }
        $this->buildSuccess(['list' => $message]);
    }

    public function suggestion() {
        $user_id = $this->getUserId();
        $post = $this->request->post();
        $base = [
            'title' => '反馈标题不能为空',
            'type' => '类型不为空'
        ];
        $this->check_empty($base, $post);
        $img_ids = explode(',', $post['img_ids']);
        
        $user_id = $this->getUserId();
        $agent_pid = Db::name('User')->where(['id'=>$user_id])->value('agent_pid');
        
        $ids = Db::name('picture')->where(['sha1' => ['in', $img_ids]])->column('id');
        $add = [
            'user_id' => $user_id,
            'img_ids' => implode(',', $ids),
            'content' => $post['content'],
            'title' => $post['title'],
            'create_time' => time(),
            'update_time' => time(),
            'status' => '0',
            'type' => $post['type'],
            'agent_pid' => intval($agent_pid),
        ];
        $res = Db::name('suggestion')->insert($add);
        if ($res) {
            $this->buildSuccess([], '提交成功');
        } else {
            $this->buildFailed('操作失败，稍后再试');
        }
    }

    public function suggestion_list() {
        $user_id = $this->getUserId();
        $post = $this->request->post();
        $base = [
            'type' => '类型不为空'
        ];
        $this->check_empty($base, $post);
        $p = isset($post['p']) ? intval($post['p']) : 1;
        if ($p < 1) {
            $p = 1;
        }
        $pagesize = isset($post['pagesize']) ? intval($post['pagesize']) : 10;
        if ($pagesize < 1) {
            $pagesize = 10;
        }
        $this->logicSuggestion->suggestion_list($user_id,$post['type'], $p, $pagesize);
    }

    public function suggestion_detils() {

        $user_id = $this->getUserId();
        $post = $this->request->post();
        $id = $post['id'];
        $this->logicSuggestion->suggestion_details($user_id, $id);
    }

    /**
     * 首页信息
     */
    public function index_msg() {
        $this->buildFailed('此接口停用');
        $user_id = $this->getUserId();
        $data = [
            'total_exchange' => config('total_exchange'),
            'profit' => config('profit'),
            'num' => config('num'),
            'runtime' => Sec2Time(config('web_start'), date('Y-m-d')),
        ];
        $this->buildSuccess($data);
    }
    
     public function qr() {
        if (empty($_GET['data'])) {
            die();
        }
        $qr = new \phpqrcode\phpqrcode();
        ob_end_clean();
        $qr->png($_GET['data']);
    }

}
