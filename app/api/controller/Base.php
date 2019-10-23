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

use app\common\controller\ControllerBase;
use app\common\logic\ReturnCode;

/**
 * 演示控制器
 */
class Base extends ControllerBase {

    public function buildSuccess($data, $msg = '操作成功', $code = ReturnCode::SUCCESS) {
        $return = [
            'code' => $code,
            'msg' => $msg,
            'data' => $data
        ];
        $this->ajaxReturn($return);
    }

    public function buildFailed($msg, $code = ReturnCode::FAIL, $data = []) {
        $return = [
            'code' => $code,
            'msg' => $msg,
            'data' => $data
        ];
        $this->ajaxReturn($return);
    }

    /**
     * Ajax方式返回数据到客户端
     * @access protected
     * @param mixed $data 要返回的数据
     * @param String $type AJAX返回数据格式
     * @return void
     */
    protected function ajaxReturn($data, $type = '') {
        if (empty($type))
            $type = 'JSON';
        switch (strtoupper($type)) {
            case 'JSON' :
                // 返回JSON数据格式到客户端 包含状态信息
                header('Content-Type:application/json; charset=utf-8');
                exit(json_encode($data,JSON_UNESCAPED_UNICODE));
            case 'XML' :
                // 返回xml格式数据
                header('Content-Type:text/xml; charset=utf-8');
                exit(xml_encode($data));
            case 'JSONP':
                // 返回JSON数据格式到客户端 包含状态信息
                header('Content-Type:application/json; charset=utf-8');
                $handler = isset($_GET[C('VAR_JSONP_HANDLER')]) ? $_GET[C('VAR_JSONP_HANDLER')] : C('DEFAULT_JSONP_HANDLER');
                exit($handler . '(' . json_encode($data) . ');');
            case 'EVAL' :
                // 返回可执行的js脚本
                header('Content-Type:text/html; charset=utf-8');
                exit($data);
            default :
                // 用于扩展其他返回格式数据
                Hook::listen('ajax_return', $data);
        }
    }

    public function getUserId() {
        $type = config('user_sign_type');
        if ($type == 'token') {
            $token = $this->request->post('token');
            if (empty($token)) {
                $this->buildFailed('缺少token', ReturnCode::RELOGIN);
            }
            $user_id = Db('user')->where('token', $token)->value('id');
        } elseif ($type == 'session') {
            $user_id = session('user_id');
        } else {
            $this->buildFailed('验证类型错误');
        }
        if (empty($user_id)) {
            $this->buildFailed('请重新登入', '0020');
        } else {
            return $user_id;
        }
    }

    public function check_empty($base, $post) {
        foreach ($base as $key => $val) {
            if (!isset($post[$key]) || empty($post[$key])) {
                $this->buildFailed($val, ReturnCode::NULL_STRING);
            }
        }
    }

}
