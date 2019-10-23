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
 * 升级管理逻辑
 */
class ApplyRecord extends AdminBase {

    /**
     * 获取升级管理列表
     */
    public function getApplyRecordList($where = [], $field = 'a.*,r.username as rusername,u.username as uusername', $order = 'a.id desc', $paginate = DB_LIST_ROWS) {
        $this->modelApplyRecord->alias('a');
        $join = [
//            [SYS_DB_PREFIX . 'level l', 'a.level_before = l.id', 'LEFT'],
//            [SYS_DB_PREFIX . 'level e', 'a.level_after = e.id', 'LEFT'],
                [SYS_DB_PREFIX . 'user r', 'a.user_id = r.id', 'LEFT'],
                [SYS_DB_PREFIX . 'user u', 'a.up_user_id = u.id', 'LEFT'],
        ];
//        if (!is_administrator()) {
//            $where['u.agent_pid'] = MEMBER_ID;
//        } else {
//            
//        }


        $this->modelApplyRecord->join = $join;

        return $this->modelApplyRecord->getList($where, $field, $order, $paginate);
    }

    public function getWhere($data = []) {
        $where = [];

        !empty($data['search_data']) && $where['a.order_no'] = ['like', '%' . $data['search_data'] . '%'];

        if (!is_administrator()) {
            $where['a.agent_pid'] = MEMBER_ID;
        }
        return $where;
    }

    /**
     * 升级管理编辑
     */
    public function getComplainEdit($data = []) {

//        $validate_result = $this->validateSuggestion>scene('edit')->check($data);
//        
//        if (!$validate_result) {
//            
//            return [RESULT_ERROR, $this->validateSuggestion->getError()];
//        }


        $url = url('applyRecordList');

        $result = $this->modelComplain->setInfo($data);

        $handle_text = empty($data['id']) ? '新增' : '编辑';

        $result && action_log($handle_text, '会员' . $handle_text . 'id:' . $data['id']);

        return $result ? [RESULT_SUCCESS, '操作成功', $url] : [RESULT_ERROR, $this->modelComplain->getError()];
    }

    /**
     * 获取图片
     */
    public function getImgs($data = []) {
        $imgs = Db('complain')->field('img_ids')->where(['id' => $data['id']])->find();
        $img_ids = explode(',', $imgs['img_ids']);
        foreach ($img_ids as $key => $val) {

            $img_ids[$key] = "http://" . $_SERVER['HTTP_HOST'] . get_picture_url($val);
        }
        return $img_ids;
    }

    /**
     * 获取单挑记录信息
     */
    public function getComplainInfo($where = [], $field = 'c.*') {
        $this->modelComplain->alias('c');

        $join = [
                [SYS_DB_PREFIX . 'apply_record a', 'c.apply_record_id = a.id'],
        ];

        $where['c.' . DATA_STATUS_NAME] = ['neq', DATA_DELETE];

        $this->modelComplain->join = $join;

        return $this->modelComplain->getInfo($where, $field);
    }

}
