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

namespace app\api\logic;

use \app\api\controller\Base;
use app\common\logic\ReturnCode;
use think\Cache;
use think\Db;

/**
 * 会员逻辑
 */
class Common extends Base {

    /**
     * 获取最新一条信息
     * @param type $param
     */
    public function getlastNotice() {
        $user_id = $this->getUserId();
        $agent_pid = Db::name('User')->where(['id'=>$user_id])->value('agent_pid');
        $cache_data = cache_data($agent_pid);
        $article_category = ($cache_data['article_category']);
        $article = ($cache_data['article']);
        $category_detail = query_array($article_category, 'name', config('index_article_category'));
        $gsgg_data = query_array($article, 'category_id', $category_detail['id']);
        $data = [
            'name' => $gsgg_data['name'],
            'describe' => $gsgg_data['describe'],
            'update_time' => date('Y-m-d', $gsgg_data['update_time']),
            'content' => htmlspecialchars_decode($gsgg_data['content']),
        ];
        $this->buildSuccess(['list' => $data], '获取成功');
    }

    /**
     * 
     * @param type $passwod
     * @param type $name
     */
    public function getNotice($p, $pagesize) {
        $user_id = $this->getUserId();
        $agent_pid = Db::name('User')->where(['id'=>$user_id])->value('agent_pid');
        $cache_data = cache_data($agent_pid);
        $article_category = ($cache_data['article_category']);
        $article = ($cache_data['article']);
        $category_detail = query_array($article_category, 'name', config('index_article_category'));
        $gsgg_data = query_array_all($article, 'category_id', $category_detail['id']);
        $data = array_pages($gsgg_data, $p, $pagesize);

        foreach ($data as $key => $value) {
            $data[$key]['time'] = date('Y-m-d H:i:s', $value['update_time']);
            unset($data[$key]['content']);
            unset($data[$key]['cover_id']);
            unset($data[$key]['file_id']);
            unset($data[$key]['category_id']);
            unset($data[$key]['img_ids']);
            unset($data[$key]['update_time']);
            unset($data[$key]['create_time']);
            unset($data[$key]['status']);
            unset($data[$key]['member_id']);
        }
        $this->buildSuccess(['list' => $data], '获取成功');
    }

    public function article_detail($id) {
        $user_id = $this->getUserId();
        $agent_pid = Db::name('User')->where(['id'=>$user_id])->value('agent_pid');
        $cache_data = cache_data($agent_pid);
        $article = ($cache_data['article']);
        $detail = query_array($article, 'id', $id);
        if (empty($detail)) {
            $this->buildFailed('文章未找到');
        } else {
            $url = get_picture_url($detail['cover_id']);
            $detail['cover_url'] = 'http://' . $_SERVER['HTTP_HOST'] . $url;
            $detail['time'] = date('Y-m-d H:i:s', $detail['update_time']);
            unset($detail['file_id']);
            unset($detail['member_id']);
            unset($detail['status']);
            unset($detail['category_id']);
            unset($detail['create_time']);
            unset($detail['cover_id']);
            unset($detail['update_time']);
            $detail['content'] = htmlspecialchars_decode($detail['content']);
            $this->buildSuccess($detail);
        }
    }

    public function bank_list($name = '') {
        if (empty($name)) {
            $bank_data = Cache::get('bank_data');
            if (empty($bank_data)) {
                $bank_data = Db('bank')->where(['is_select' => '1'])->field('bank_id,bank_name')->select();
                Cache::set('bank_data', $bank_data, 3600);
            }
        } else {
            $bank_data = Db('bank')->where(['is_select' => '1', 'bank_name' => ['like', '%' . $name . '%']])->field('bank_id,bank_name')->select();
        }
        $this->buildSuccess(['list' => $bank_data]);
    }

    public function lesson($p, $pagesize) {
        $offset = ($p - 1) * $pagesize;
        $data = Db('lesson')->where(['status' => '1'])->field('money,name,time_limit,id,describe')->limit($offset, $pagesize)->select();
        $this->buildSuccess(['list' => $data]);
    }

}
