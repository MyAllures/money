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
use think\Db;

/**
 * 会员逻辑
 */
class Suggestion extends Base {

    public function suggestion_list($user_id, $type, $p, $pagesize) {
        $offset = ($p - 1) * $pagesize;
        $data = Db('suggestion')->where(['user_id' => $user_id, 'type' => $type])->field('id,title,create_time,status')->limit($offset, $pagesize)->select();
        $status_arr = $this->status_arr();
        foreach ($data as $key => $value) {
            $data[$key]['status_name'] = $status_arr[$value['status']];
            $data[$key]['create_time'] = date('Y-m-d H:i:s', $value['create_time']);
        }
        $this->buildSuccess(['list' => $data]);
    }

    public function suggestion_details($user_id, $id) {
        $data = Db('suggestion')->where(['user_id' => $user_id, 'id' => $id])->find();
        if (empty($data)) {
            $this->buildFailed('数据不存在');
        }
        $img_ids = $data['img_ids'];
        $img_ids = explode(',', $img_ids);
        $tmp = [];
        foreach ($img_ids as $key => $value) {
            $url = get_picture_url($value);
            $tmp[] = 'http://' . $_SERVER['HTTP_HOST'] . $url;
        }
        $status_arr = $this->status_arr();
        $data['img_url'] = $tmp;
        $data['create_time'] = date('Y-m-d H:i:s');
        $data['status_name'] = $status_arr[$data['status']];
        $data['note'] = strval($data['note']);
        unset($data['img_ids']);
        unset($data['user_id']);
        unset($data['update_time']);
        $this->buildSuccess($data);
    }

    public function status_arr() {
        return [
            '0' => '等待处理',
            '1' => '处理成功',
            '2' => '处理失败',
        ];
    }

}
