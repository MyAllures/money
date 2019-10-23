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
use think\Cache;
use think\Db;

/**
 * 演示控制器
 */
class Sms extends Base {

    /**
     * 登入
     */
    public function send() {
        $post = $this->request->post();
        $base = [
            'phone' => '手机号码必填',
            'type' => '类型不能为空',
        ];
        $this->check_empty($base, $post);
        $phone = $post['phone'];
        $type = $post['type'];
        if (!in_array($type, ['find_pwd','registe','collection'])) {
            $this->buildFailed('类型错误');
        }
        if (!check_is_mobile($phone)) {
            $this->buildFailed('手机号码错误');
        }
        if (in_array($type, ['find_pwd'])) {
            $data = Db::name('user')->where(['username' => $phone, 'status' => '1'])->find();
            if (empty($data)) {
                $this->buildFailed('发送失败');
            }
        }elseif (in_array($type, ['registe'])) {
            $data = Db::name('user')->where(['username' => $phone, 'status' => '1'])->find();
            if (!empty($data)) {
                $this->buildFailed('用户已被注册');
            }
        }elseif (in_array($type, ['collection'])) {
            $data = Db::name('user')->where(['username' => $phone, 'status' => '1'])->find();
            if (empty($data)) {
                $this->buildFailed('发送失败');
            }
        }

        $this->logicSms->send($phone, $type);
    }

    /**
     * 注册
     */
    public function reg() {
        $post = $this->request->post();
        $base = [
            'username' => '用户名不能为空',
            'pwd' => '密码不能为空',
            'code' => '短信验证码不能为空',
        ];
        $this->check_empty($base, $post);
        //注册逻辑
        $reffer_code = isset($post['reffer_code']) ? $post['reffer_code'] : '';
        $agent_pid = isset($post['agent_pid']) ? $post['agent_pid'] : '';
        $this->logicUser->reg($post['username'], $post['pwd'], $post['code'], $reffer_code, $agent_pid);
    }

    /**
     * 获取会员信息
     */
    public function get_user_msg() {
        $user_id = $this->getUserId();
        $user_data = Db('User')->where(['user_id' => $user_id])->find();
        if (empty($user_data)) {
            $this->buildFailed('会员信息获取失败');
        }
    }

    /**
     * 找回密码
     * @param type $param
     */
    public function find_pwd() {
        $post = $this->request->post();
        $base = [
            'phone' => '手机号不能为空',
            'code' => '短信验证码不能为空',
            'pwd' => '新密码',
        ];
        $this->check_empty($base, $post);

        $this->logicUser->find_pwd($post['phone'], $post['pwd'], $post['code']);
    }

}
