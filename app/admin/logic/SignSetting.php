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

use think\Db;

/**
 * 会员逻辑
 */
class SignSetting extends AdminBase {

    public function get_setting() {
        if (!is_administrator()) {
            return -1;
        }
        return Db::name('sign_setting')->where(['name' => 'is_send', 'agent_pid' => 0])->value('value');
    }

    public function is_send() {
        return [
            '1' => '开启',
            '0' => '关闭',
        ];
    }

    public function setis_send($param) {
        if (!isset($param['is_send'])) {
            return [RESULT_ERROR, '参数错误~'];
        }
        $is_send = $param['is_send'];
        $result = Db::name('sign_setting')->where(['name' => 'is_send', 'agent_pid' => 0])->update(['value' => $is_send]);
        return $result ? [RESULT_SUCCESS, '修改成功'] : [RESULT_ERROR, '修改失败'];
    }

}
