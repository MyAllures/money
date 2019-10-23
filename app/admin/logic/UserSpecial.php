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
 * 特殊会员
 */
class UserSpecial extends AdminBase {

    public function userspecialList($data = []) {
        !empty($data['search_data']) && $where['u.username'] = ['like', '%' . $data['search_data'] . '%'];

        $this->modelUserSpecial->alias('m');

        $join = [
                [SYS_DB_PREFIX . 'user u', 'm.user_id = u.id', 'LEFT'],
        ];
        $field = 'm.id,m.user_id,m.create_time,m.status,m.update_time,u.username';
        $where['m.' . DATA_STATUS_NAME] = ['neq', DATA_DELETE];

        if (!is_administrator()) {
            $where['m.agent_pid'] = MEMBER_ID;
        }

        $this->modelUserSpecial->join = $join;

        return $this->modelUserSpecial->getList($where, $field, $order, $paginate);
    }

    /**
     * 课程添加
     */
    public function userspecialAdd($data = []) {
        $url = url('userspecialList');

        if (is_administrator()) {
            return [RESULT_ERROR, '代理才有权限操作'];
        }
        $user = db('user')->where(['username' => $data['username'], 'agent_pid' => MEMBER_ID])->find();
        $r = db('user_special')->where(['user_id' => $user['id']])->value('user_id');
        if ($r) {
            return [RESULT_ERROR, '该用户已经添加过了'];
        }
        if (!$user) {
            return [RESULT_ERROR, '没有该用户'];
        }
        $add = [
            'user_id' => $user['id'],
            'status' => 1,
            'create_time' => time(),
            'agent_pid' => MEMBER_ID,
        ];
        $result = db('user_special')->insert($add);
        return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, '添加失败，请重试'];
    }

}
