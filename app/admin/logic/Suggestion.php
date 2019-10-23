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

namespace app\admin\logic;

use Think\Db;

/**
 * 意见反馈逻辑
 */
class Suggestion extends AdminBase {

    /**
     * 获取意见反馈列表
     */
    public function getSuggestionList($where = [], $field = 's.id,s.user_id,s.create_time,s.update_time,s.status,s.note,s.title,s.type,r.username', $order = 's.id desc', $paginate = DB_LIST_ROWS) {
        $this->modelSuggestion->alias('s');
        $join = [
//            [SYS_DB_PREFIX . 'member b', 'u.agent_pid = b.id', 'LEFT'],
                [SYS_DB_PREFIX . 'user r', 's.user_id = r.id', 'LEFT'],
        ];
        if (!is_administrator()) {
            $where['s.agent_pid'] = MEMBER_ID;
        } else {
            
        }


        $this->modelSuggestion->join = $join;

        return $this->modelSuggestion->getList($where, $field, $order, $paginate);
    }

    public function getWhere($data = []) {
        $where = [];

        !empty($data['search_type']) && $where['s.type'] = $data['search_type'];

        !empty($data['search_data']) && $where['r.username'] = ['like', '%' . $data['search_data'] . '%'];

        return $where;
    }

    /**
     * 意见反馈编辑
     */
    public function getSuggestionEdit($data = []) {

        if (!is_administrator()) {
            $where['s.id'] = $data['id'];
            $info = $this->getSuggestionInfo($where, 's.agent_pid');
            if ($info->agent_pid != MEMBER_ID) {
                return [RESULT_ERROR, '你没有权限操作'];
            }
        }

        $save = ['status' => $data['status'], 'note' => $data['note'], 'id' => $data['id']];

        $url = url('suggestionList');

        $result = $this->modelSuggestion->setInfo($save);

        $handle_text = empty($data['id']) ? '新增' : '编辑';

        $result && action_log($handle_text, '会员' . $handle_text . 'id:' . $save['id']);

        return $result ? [RESULT_SUCCESS, '操作成功', $url] : [RESULT_ERROR, $this->modelSuggestion->getError()];
    }

    /**
     * 获取图片
     */
    public function getImgs($data = []) {
        $imgs = Db('suggestion')->field('img_ids')->where(['id' => $data['id']])->find();
        $img_ids = explode(',', $imgs['img_ids']);
        foreach ($img_ids as $key => $val) {

            $img_ids[$key] = "http://" . $_SERVER['HTTP_HOST'] . get_picture_url($val);
        }
        return $img_ids;
    }

    /**
     * 获取单挑记录信息
     */
    public function getSuggestionInfo($where = [], $field = 's.*,u.username') {
        $this->modelSuggestion->alias('s');

        $join = [
                [SYS_DB_PREFIX . 'user u', 's.user_id = u.id'],
        ];

        $where['s.' . DATA_STATUS_NAME] = ['neq', DATA_DELETE];

        $this->modelSuggestion->join = $join;

        return $this->modelSuggestion->getInfo($where, $field);
    }

}
