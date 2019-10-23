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

/**
 * 演示控制器
 */
class User extends Base {

    /**
     * 登入
     */
    public function login() {
        $post = $this->request->post();
        $base = [
            'username' => '用户名不能为空',
            'pwd' => '密码不能为空',
        ];
        $this->check_empty($base, $post);
        $username = $post['username'];
        $pwd = $post['pwd'];
        $this->logicUser->login($pwd, $username);
    }

    /**
     * 注册
     */
    public function reg() {
        $check_code = false;//短信验证关闭 false,开启true
        $post = $this->request->post();
        $base = [
            'username' => '用户名不能为空',
            'pwd' => '密码不能为空',
        ];
        if ($check_code) {
            $base ['code'] = '短信验证码不能为空';
        }
        $this->check_empty($base, $post);
        //注册逻辑
        $reffer_code = isset($post['reffer_code']) ? $post['reffer_code'] : '';
        $agent_code = isset($post['agent_code']) ? $post['agent_code'] : '';
        $wx_account = isset($post['wx_account']) ? $post['wx_account'] : '';
        $account_name= isset($post['account_name']) ? $post['account_name'] : '';
        $this->logicUser->reg($post['username'], $post['pwd'], $post['code'], $reffer_code, $agent_code, $wx_account,$account_name,$check_code);
    }
        public function saveUserCollection(){
            if(input('receivables_account')==NULL){
                $datas['code']=1;
                $datas['msg']='请输入收款账号';
                return $datas;
            }
            /*if(input('code')==NULL){
                $datas['code']=1;
                $datas['msg']='请输入短信验证码';
                return $datas;
            }*/
            if(input('receivables_img')==NULL){
                $datas['code']=1;
                $datas['msg']='请上传收款二维码';
                return $datas;
            }
            $mes=$this->logicUser->save_collection(input('receivables_account'),input('code'),input('receivables_img'),input('phone'));
            return $mes;
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

    /**
     * 获取会员信息
     * @param type $param
     */
    public function getUserInfo() {
        $user_id = $this->getUserId();
        $this->logicUser->getUserInfo($user_id);
    }

    /**
     * 获取会员资料
     */
    public function getProfile() {
        $user_id = $this->getUserId();
        $post = $this->request->post();
        $show_type = $post['show_type'] == 1 ? 1 : 0;
        $this->logicUser->getProfile($user_id, $show_type);
    }

    /**
     * 修改会员密码（登陆）
     * @param type $param
     */
    public function editPwd() {
        $user_id = $this->getUserId();
        $post = $this->request->post();
        $base = [
            'old_pwd' => '原密码不能为空',
            'new_pwd' => '新密码不能为空',
        ];
        $this->check_empty($base, $post);
        $this->logicUser->editPwd($user_id, $post['old_pwd'], $post['new_pwd']);
    }

    /**
     * 修改昵称
     */
    public function editNickname() {
        $user_id = $this->getUserId();
        $post = $this->request->post();
        $base = [
            'nickname' => '昵称不能为空',
        ];
        $this->check_empty($base, $post);
        $nickname = isset($post['nickname']) ? $post['nickname'] : '';
        $this->logicUser->editNickname($user_id, $nickname);
    }

    /**
     * 修改微信账号
     * @param type $user_id 会员id
     * @param type $nickname 修改昵称
     */
    public function editWxAccount() {
        $user_id = $this->getUserId();
        $post = $this->request->post();
        $base = [
            'wx_account' => '微信号不能为空',
        ];
        $this->check_empty($base, $post);
        $wx_account = isset($post['wx_account']) ? $post['wx_account'] : '';
        $this->logicUser->editWxAccount($user_id, $wx_account);
    }

    /**
     * 更新会员资料
     */
    public function editProfile() {
        $user_id = $this->getUserId();
        $post = $this->request->post();
        $profile = [];
        if (isset($post['nickname'])) {
            $profile['nickname'] = $post['nickname'];
        }
        if (isset($post['sex'])) {
            $profile['sex'] = $post['sex'];
        }
        if (isset($post['head_icon'])) {
            $profile['head_icon'] = $post['head_icon'];
        }

        if (isset($post['wx_account'])) {
            $this->buildFailed('微信号不可修改');
            $profile['wx_account'] = $post['wx_account'];
        }
        if (isset($post['wx_picture'])) {
            $profile['wx_picture'] = $post['wx_picture'];
        }
        if (isset($post['age'])) {
            $profile['age'] = $post['age'];
        }
        if (isset($post['profession'])) {
            $profile['profession'] = $post['profession'];
        }

        $this->logicUser->editProfile($user_id, $profile);
    }

    /**
     * 获取分享链接
     */
    public function getShareInfo() {
        $user_id = $this->getUserId();
        $this->logicUser->getShareInfo($user_id);
    }

    public function getChildList() {
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
        $this->logicUser->getChildList($user_id, $p, $pagesize);
    }

    /**
     * 获取团队下级
     */
    public function getTeamList() {
        $post = $this->request->post();
        $user_id = $this->getUserId();
        $base = [
            's_user_id' => '会员id不能为空',
        ];
        $p = isset($post['p']) ? intval($post['p']) : 1;
        $pagesize = isset($post['pagesize']) ? intval($post['pagesize']) : 10;
        if ($p < 1) {
            $p = 1;
        }
        if ($pagesize < 1) {
            $pagesize = 10;
        }

        $this->logicUser->getTeamList($user_id, $post['s_user_id'], $p, $pagesize);
    }

    /**
     * 帮助注册
     */
    public function help_reg() {
        $user_id = $this->getUserId();
        $post = $this->request->post();
        $base = [
            'username' => '请填写手机号码',
            'wx_account' => '请填写微信账号',
            'pwd' => '请填密码',
            'chk_pwd' => '请填确认密码',
            'account_name' => '请填姓名',
            'code' => '请填推荐码',
        ];
        $this->check_empty($base, $post);
        $pwd = $post['pwd'];
        $chk_pwd = $post['chk_pwd'];
        $phone = $post['username'];
        $wx_account = $post['wx_account'];
        $account_name = $post['account_name'];
        $code = $post['code'];


        if (!check_is_mobile($phone)) {
            $this->buildFailed('手机号码格式不正确');
        }
        if ($pwd != $chk_pwd) {
            $this->buildFailed('两次密码不一致');
        }
        //检查手机号码是否正确
        //检查确认密码是否一样
        //1.检查帮忙注册权限
        //2.检查是否注册过
        $this->logicUser->help_reg($code, $phone, $pwd, $wx_account, $account_name);
    }

}
