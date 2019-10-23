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
class User extends Base {

    /**
     * 登陆
     * @param type $passwod
     * @param type $name
     */
    public function login($passwod, $name) {
        $user_data = Db('user')->where(['username' => $name])->field('pwd,id,status')->find();
        if (empty($user_data)) {
            $this->buildFailed('账号不存在'); //统一报错
        }
        if (!check_passwd_encrypt($passwod, $user_data['pwd'])) {
            $this->buildFailed('密码错误');
        }
        if ($user_data['status'] != '1') {
            $this->buildFailed('你的账号已经被冻结');
        }
        $update = [
            'login_time' => time(),
            'login_ip' => ip2long($this->request->ip()),
        ];
        $user_sign_type = config('user_sign_type');
        if ($user_sign_type == 'token') {
            $update['token'] = md5(uniqid() . $user_data['id'] . time());
            $return_data['token'] = $update['token'];
        } elseif ($user_sign_type == 'session') {
            session('user_id', $user_data['id']);
            $return_data = [];
        } else {
            $this->buildFailed('系统user_sign_type错误', ReturnCode::SYS_ERR);
        }
        $res = Db('user')->where(['id' => $user_data['id']])->update($update);
        if ($res) {
            $this->buildSuccess($return_data);
        } else {
            $this->buildFailed('登入失败', ReturnCode::SYS_ERR);
        }
    }

    /**
     * 注册
     * @param type $username 会员
     * @param type $pwd 密码
     * @param type $code 验证码
     * @param type $reffer_code 推荐人码
     * @param type $agent_code 代理码
     */
    public function reg($username, $pwd, $code, $reffer_code, $agent_code, $wx_account, $account_name, $check_code = false) {
        //基本验证
        if (!check_is_mobile($username)) {
            $this->buildFailed("手机号格式有误", ReturnCode::FAIL);
        }

        //用户已处理
        $_user = Db::name('User')->field('id,username,node')->where(array('username' => $username))->find();
        if ($_user) {
            $this->buildFailed("手机号已存在", ReturnCode::FAIL);
        }
       // $wx_account = trim($wx_account);
       // if (empty($wx_account)) {
       //     $this->buildFailed("微信号有误", ReturnCode::FAIL);
      //  }
        //验证微信号唯一
        $_user_profile = Db::name('UserProfile')->field('id')->where(['wx_account' => $wx_account])->find();
     //   if ($_user_profile) {
     //       $this->buildFailed("微信号已存在", ReturnCode::FAIL);
     //   }

        if ($check_code) {
            if (!check_phone_code($username, $code, 'registe')) {
                $this->buildFailed("验证码有误，测试阶段为123456", ReturnCode::FAIL);
            }
        }


        if (!check_pwd_format($pwd)) {
            $this->buildFailed("密码格式有误", ReturnCode::FAIL);
        }

        //判断是否有上级
        $invite_id = 0;
        $agent_pid = 0;
        $invite_node = '';
        if (empty($agent_code) && empty($reffer_code)) {
            $this->buildFailed("请填写推荐人", ReturnCode::FAIL);
        } elseif (!empty($agent_code)) {
            //验证是否是有效的代理人
            $agent_data = Db::name('member')->where(['code' => $agent_code])->find();
            if (empty($agent_data)) {
                $this->buildFailed("代理人有误", ReturnCode::FAIL);
            }
            if ($agent_data['status'] != '1') {
                $this->buildFailed("代理人被禁用", ReturnCode::FAIL);
            }
            $agent_pid = $agent_data['id'];
        } elseif (!empty($reffer_code)) {
            $reffer_info = Db::name('User')->field('code,id,level,agent_pid,node')->where(array('code' => $reffer_code))->find();
            if (!$reffer_info) {
                $this->buildFailed("邀请码填写有误", ReturnCode::FAIL);
            }

            //获取会员等级标志
            $can_reg = Db::name('Level')->where(['level' => $reffer_info['level']])->value('can_reg');
            if ($can_reg != 1) {
                $this->buildFailed("邀请码有误", ReturnCode::FAIL);
            }

            //获取对应的代理
            $agent_pid = $reffer_info['agent_pid'];
            $invite_id = $reffer_info['id'];
            $invite_node = $reffer_info['node'];
        }

        $data['username'] = $username;
        $data['pwd'] = passwd_encrypt($pwd);
        $data['invite_id'] = intval($invite_id);
        $data['agent_pid'] = intval($agent_pid);
        $data['login_time'] = TIME_NOW;
        $data['login_ip'] = ip2long($this->request->ip());
        $data['create_time'] = TIME_NOW;
        $data['update_time'] = TIME_NOW;
        $data['code'] = create_user_code(); //todo

        $user_id = Db::name('User')->insertGetId($data);
        if ($user_id > 0) {
            $node = create_user_node($user_id, $invite_node);
            Db::name('User')->where(['id' => $user_id])->update(['node' => $node]);
            $_data['agent_pid'] = intval($agent_pid);
            $_data['user_id'] = $user_id;
            $_data['wx_account'] = strval($wx_account);
            $_data['account_name'] = strval($account_name);
            Db::name('UserProfile')->insert($_data);

            //判断最低等级
            $level = 1;
            $level_info = Db::name('Level')->field('score')->where(['level' => $level])->find();
            $send_score = intval($level_info['score']);
            if ($send_score > 0) {
                //赠送糖果
                $score_data = [
                    'user_id' => $user_id,
                    'score_amount' => $send_score,
                    'type' => 'reg',
                    'note' => '注册赠送糖果哦'
                ];
                change_score($score_data);
            }

            $this->buildSuccess(array(), "注册成功", ReturnCode::SUCCESS);
            
        } else {
            $this->buildFailed("系统繁忙，请稍后再试", ReturnCode::FAIL);
        }
    }

    /**
     * 找回密码
     * @param type $username
     * @param type $pwd
     * @param type $code
     */
    public function find_pwd($username, $pwd, $code) {

        if (!check_is_mobile($username)) {
            $this->buildFailed("手机号格式有误", ReturnCode::FAIL);
        }

        //验证验证码
        if (!check_phone_code($username, $code, 'find_pwd')) {
            $this->buildFailed("验证码有误", ReturnCode::FAIL);
        }

        //用户有误
        $user = Db::name('User')->field('id')->where(array('username' => $username))->find();
        if (!$user) {
            $this->buildFailed("会员不存在", ReturnCode::FAIL);
        }

        if (!check_pwd_format($pwd)) {
            $this->buildFailed("密码格式有误", ReturnCode::FAIL);
        }

        //修改密码
        $data = array();
        $data['update_time'] = TIME_NOW;
        $data['pwd'] = passwd_encrypt($pwd);
        $res = Db::name('User')->where(array('id' => $user['id']))->update($data);
        if ($res) {
            $this->buildSuccess(array(), "修改成功", ReturnCode::SUCCESS);
        } else {
            $this->buildFailed("系统繁忙，请稍后再试", ReturnCode::FAIL);
        }
    }
    /**
     * 上传收款凭证
     * @param type $username
     * @param type $pwd
     * @param type $code
     */
    public function save_collection($account, $code,$image,$username) {

        //验证验证码
        /*if (!check_phone_code($username, $code, 'collection')) {
            $mes['code']=1;
            $mes['msg']='验证码有误';
            return $mes;
        }*/
        $user = Db::name('User')->field('id')->where(array('username' => $username))->find();
        $user_collection = Db::name('user_collection')->where(array('uid' => $user['id']))->find();
        if(empty($user_collection)){
            $data = array();
            $data['uid'] = $user['id'];
            $data['user_account'] = $account;
            $data['user_erwei'] = $image;
            $data['add_time'] = time();
            $res = Db::name('user_collection')->insertGetId($data);
        }else{
            $data = array();
            $data['user_account'] = $account;
            $data['user_erwei'] = $image;
            $data['update_time']=time();
            $res = Db::name('user_collection')->where(array('uid' => $user['id']))->update($data);
        }
        if ($res) {
            $mes['code']=0;
            $mes['msg']='操作成功';
            return $mes;
        } else {
            $mes['code']=1;
            $mes['msg']='系统繁忙，请稍后再试';
            return $mes;
        }
    }

    /**
     * 获取会员信息
     * @param type $param
     */
    public function getUserInfo($user_id) {

        $user = Db::name('User')->field('id,username,status,money,create_time,invite_id,code,level')->where(['id' => $user_id])->find();
        if (empty($user)) {
            $this->buildFailed('会员信息获取失败');
        }
        $head_icon = '';
        $nickname = '';
        $profile_info = Db::name('UserProfile')->field('user_id,nickname,head_icon')->where(['user_id' => $user_id])->find(); //nickname
        if ($profile_info) {
            $head_icon = isset($profile_info['head_icon']) && !empty($profile_info['head_icon']) ? $profile_info['head_icon'] : '';
            $nickname = isset($profile_info['nickname']) ? $profile_info['nickname'] : '';
        }

        $invite_id = 0;
        $p_username = '';
        $p_code = '';
        if ($user['invite_id'] > 0) {
            $p_user = Db::name('User')->field('id,username,code')->where(['id' => $user_id])->find();
            if ($p_user) {
                $invite_id = $user['invite_id'];
                $p_username = $user['username'];
                $p_code = $user['code'];
            }
        }

        $data = array();
        //获取会员信息
        $data['nickname'] = ''; //昵称
        $data['user_id'] = $user['id']; //昵称
        $data['username'] = $user['username']; //手机号
        $data['status'] = $user['status']; //状态（1-正常，0-冻结）
        $data['money'] = $user['money']; //余额
        $data['head_icon'] = get_split_image_url($head_icon); //头像
        $data['code'] = $user['code']; //推广号
        $data['create_time'] = date('Y-m-d H:i', $user['create_time']); //注册时间

        $data['invite_id'] = $invite_id; //上级id
        $data['p_username'] = $p_username; //上级手机号
        $data['p_code'] = $p_code; //上级手机号
        $data['can_reg'] = Db::name('level')->where(['level' => $user['level']])->value('can_reg');
        $data['level_name'] = Db::name('level')->where(['level' => $user['level']])->value('name');
        $this->buildSuccess($data, "获取成功", ReturnCode::SUCCESS);
    }

    /**
     * 获取会员资料
     * @param type $param
     */
    public function getProfile($user_id, $show_type = 0) {

        $user = Db::name('User')->field('id,username,status,money,create_time,invite_id,code,level,node,score,score_amount')->where(['id' => $user_id])->find();
        if (empty($user)) {
            $this->buildFailed('会员信息获取失败');
        }
        $head_icon = '';
        $sex = 0;
        $wx_picture = '';
        $wx_account = '';
        $account_name = '';
        $nickname = '';
        $age = 0;
        $profession = '';
        $profile_info = Db::name('UserProfile')->field('user_id,sex,wx_account,account_name,head_icon,nickname,wx_picture_id,age,profession')->where(['user_id' => $user_id])->find(); //nickname
        if ($profile_info) {
            $head_icon = isset($profile_info['head_icon']) && !empty($profile_info['head_icon']) ? $profile_info['head_icon'] : '';
            $wx_account = isset($profile_info['wx_account']) ? $profile_info['wx_account'] : '';
            $wx_picture = isset($profile_info['wx_picture_id']) && !empty($profile_info['wx_picture_id']) ? $profile_info['wx_picture_id'] : '';
            $nickname = isset($profile_info['nickname']) ? $profile_info['nickname'] : '';
            $account_name = isset($profile_info['account_name']) ? $profile_info['account_name'] : '';
            $sex = isset($profile_info['sex']) ? $profile_info['sex'] : 0;
            $age = isset($profile_info['age']) ? $profile_info['age'] : 0;
            $profession = isset($profile_info['profession']) ? strval($profile_info['profession']) : '';
        }

        $invite_id = 0;
        $p_username = '';
        $p_code = '';
        if ($user['invite_id'] > 0) {
            $p_user = Db::name('User')->field('id,username,code')->where(['id' => $user_id])->find();
            if ($p_user) {
                $invite_id = $user['invite_id'];
                $p_username = $user['username'];
                $p_code = $user['code'];
            }
        }

        $data = array();
        //获取会员信息
        $data['nickname'] = $nickname; //昵称
        $data['user_id'] = $user['id']; //昵称
        $data['username'] = $user['username']; //手机号
        $data['score'] = intval($user['score']); //手机号
        $data['score_amount'] = intval($user['score_amount']); //手机号
        $data['head_icon'] = get_split_image_url($head_icon); //头像
        $data['code'] = $user['code']; //推广号
        $data['sex'] = $sex; //性别：0未知，1-男，2-女
        $data['wx_picture'] = get_split_image_url($wx_picture, 'big'); //微信图片
        $data['wx_account'] = $wx_account; //微信号
        $data['account_name'] = $account_name; //真实姓名
        $data['invite_id'] = $invite_id; //上级id
        $data['p_username'] = $p_username; //上级手机号
        $data['p_code'] = $p_code; //上级手机号
        $data['can_reg'] = Db::name('level')->where(['level' => $user['level']])->value('can_reg');
        $data['level_name'] = Db::name('level')->where(['level' => $user['level']])->value('name');

        $data['show_type'] = intval($show_type);
        $data['age'] = $age;
        $data['profession'] = $profession;
        if ($show_type == 1) {//统计信息
            $team_num_v = $this->logicUp->getUserTeamNum($user['node'], 2);
            $wait_verify_upgrade = Db::name('ApplyRecord')->where(['up_user_id' => $user_id, 'status' => 0])->count();
            $count_info['team_num_v'] = intval($team_num_v);
            $team_num = $this->logicUp->getUserTeamNum($user['node'], 0);
            $count_info['team_num'] = intval($team_num);
            $count_info['wait_verify_upgrade'] = intval($wait_verify_upgrade);

            $is_signed = $this->logicSignUser->isSign($user_id); //是否已签到
            $count_info['is_signed'] = $is_signed ? 1 : 0;
            $data['count_info'] = $count_info;
        }

        $this->buildSuccess($data, "获取成功", ReturnCode::SUCCESS);
    }

    /**
     * 修改登陆密码
     * @param type $user_id 会员
     * @param type $old_pwd 旧密码
     * @param type $new_pwd 新密码
     */
    public function editPwd($user_id, $old_pwd, $new_pwd) {

        //获取会员信息
        $user = Db::name('User')->field('id,username,pwd')->where(['id' => $user_id])->find();
        if (empty($user)) {
            $this->buildFailed('会员信息获取失败');
        }

        if (!$old_pwd || !check_passwd_encrypt($old_pwd, $user['pwd'])) {
            $this->buildFailed('原密码有误');
        }

        //判断新密码
        if (!check_pwd_format($new_pwd)) {
            $this->buildFailed("密码格式有误", ReturnCode::FAIL);
        }

        //修改密码
        $data = array();
        $data['update_time'] = TIME_NOW;
        $data['pwd'] = passwd_encrypt($new_pwd);
        $res = Db::name('User')->where(array('id' => $user['id']))->update($data);
        if ($res) {
            $this->buildSuccess(array(), "修改成功", ReturnCode::SUCCESS);
        } else {
            $this->buildFailed("系统繁忙，请稍后再试", ReturnCode::FAIL);
        }
    }

    /**
     * 修改昵称
     * @param type $user_id 会员id
     * @param type $nickname 修改昵称
     */
    public function editNickname($user_id, $nickname) {
        //获取会员信息
        $user = Db::name('User')->field('id')->where(['id' => $user_id])->find();
        if (empty($user)) {
            $this->buildFailed('会员信息获取失败');
        }

        //昵称验证
        if (!check_nickname_format($nickname)) {
            $this->buildFailed("密码格式有误", ReturnCode::FAIL);
        }

        //对昵称进行处理-todo

        $data = array();
        $data['update_time'] = TIME_NOW;
        $data['nickname'] = $nickname;
        $res = Db::name('UserProfile')->where(array('user_id' => $user['id']))->update($data);
        if ($res) {
            $this->buildSuccess(array(), "修改成功", ReturnCode::SUCCESS);
        } else {
            $this->buildFailed("系统繁忙，请稍后再试", ReturnCode::FAIL);
        }
    }

    /**
     * 修改昵称
     * @param type $user_id 会员id
     * @param type $nickname 修改微信号
     */
    public function editWxAccount($user_id, $wx_account) {
        //获取会员信息
        $user = Db::name('User')->field('id')->where(['id' => $user_id])->find();
        if (empty($user)) {
            $this->buildFailed('会员信息获取失败');
        }

        $data = array();
        $data['update_time'] = TIME_NOW;
        $data['wx_account'] = $wx_account;
        $res = Db::name('UserProfile')->where(array('user_id' => $user['id']))->update($data);
        if ($res) {
            $this->buildSuccess(array(), "修改成功", ReturnCode::SUCCESS);
        } else {
            $this->buildFailed("系统繁忙，请稍后再试", ReturnCode::FAIL);
        }
    }

    /**
     * 更新会员资料
     * @param type $param
     */
    public function editProfile($user_id, $profile) {

        //获取会员信息
        $user = Db::name('User')->field('id')->where(['id' => $user_id])->find();
        if (empty($user)) {
            $this->buildFailed('会员信息获取失败');
        }
        if (isset($profile['sex']) && !in_array($profile['sex'], [1, 2, 0])) {
            $this->buildFailed('性别有误');
        }

        if (isset($profile['age']) && ($profile['age'] > 250 || $profile['age'] < 1)) {
            $profile['age'] = intval($profile['age']);
            $this->buildFailed('年龄有误');
        }

        if (isset($profile['profession']) && mb_strlen($profile['profession']) > 15) {
            $profile['profession'] = trim($profile['profession']);
            $this->buildFailed('职业字数过长,不可超过10个字');
        }
        $data = $profile;
        $data['update_time'] = TIME_NOW;
        $res = Db::name('UserProfile')->where(array('user_id' => $user['id']))->update($data);
        if ($res) {
            $this->buildSuccess(array(), "修改成功", ReturnCode::SUCCESS);
        } else {
            $this->buildFailed("系统繁忙，请稍后再试", ReturnCode::FAIL);
        }
    }

    /**
     * 获取分享信息
     * @param type $param
     */
    public function getShareInfo($user_id) {
        $user = Db::name('User')->field('code')->where(['id' => $user_id])->find();
        if (empty($user)) {
            $this->buildFailed('会员信息获取失败');
        }

        $data['share_link'] = create_share_url($user['code']);
        $data['code'] = $user['code'];
        $data['share_qrcode'] = 'http://' . $_SERVER['HTTP_HOST'] . '/api.php/tool/qr.html?data=' . $data['share_link'];
        $this->buildSuccess($data, "获取成功", ReturnCode::SUCCESS);
    }

    /**
     * 查看下级列表
     */
    public function getChildList($user_id, $p, $pagesize) {

        $where = ' invite_id= ' . intval($user_id);

        $start = ($p - 1) * $pagesize;
        $_list = Db::name("User u")->field('u.username,u.level,u.code,up.head_icon,up.account_name,up.wx_picture_id,up.wx_account,u.id AS user_id,up.nickname,u.create_time')->where($where)
                        ->join('__USER_PROFILE__ up', 'up.user_id = u.id')->limit($start . ',' . $pagesize)->order('create_time DESC')->select();
        $list = [];
        $level_data = $this->get_level_data();
        if (is_array($_list)) {
            foreach ($_list as $key => $val) {
                $list[$key]['user_id'] = $val['user_id'];
                $list[$key]['username'] = $val['username'];
                $list[$key]['head_icon'] = get_split_image_url($val['head_icon']);
                $list[$key]['nickname'] = strval($val['nickname']);
                $list[$key]['create_time'] = date("Y-m-d H:i", $val['create_time']);
                $list[$key]['wx_picture'] = !empty($val['wx_picture_id']) ? get_split_image_url($val['wx_picture_id']) : '';
                $list[$key]['wx_account'] = strval($val['wx_account']);
                $list[$key]['account_name'] = strval($val['account_name']);
                $list[$key]['code'] = strval($val['code']);
                $list[$key]['level'] = $level_data[$val['level']];
            }
        }
        $data['list'] = $list;
        $node = Db::name('user')->where(['id' => $user_id])->value('node');
        $data['count'] = $this->logicUp->getUserTeamNum($node, 1);
        $data['one_plus'] = $this->logicUp->getUserTeamNum($node, 2);
        $this->buildSuccess($data, '获取成功');
    }

    public function get_level_data() {

        $data = Db::name('level')->field('level,name')->select();
        $tmp = [];
        foreach ($data as $key => $value) {
            $tmp[$value['level']] = $value['name'];
        }
        return $tmp;
    }

    /**
     * 查看下级列表
     */
    public function getTeamList($user_id, $s_user_id, $p, $pagesize) {

        $where = ' invite_id= ' . intval($s_user_id);

        $start = ($p - 1) * $pagesize; //->limit($start . ',' . $pagesize)
        $_list = Db::name("User u")->field('u.username,up.head_icon,u.id AS user_id,up.nickname,u.create_time')->where($where)
                        ->join('__USER_PROFILE__ up', 'up.user_id = u.id')->order('create_time DESC')->select();
        $list = [];
        if (is_array($_list)) {
            foreach ($_list as $key => $val) {
                $list[$key]['user_id'] = $val['user_id'];
                $list[$key]['username'] = $val['username'];
                $list[$key]['head_icon'] = get_split_image_url($val['head_icon']);
                $list[$key]['nickname'] = strval($val['nickname']);
                $list[$key]['create_time'] = date("Y-m-d H:i", $val['create_time']);
            }
        }
        $data['list'] = $list;
        $this->buildSuccess($data, '获取成功');
    }

    /**
     * 
     * @param type $code 会员code
     * @param type $phone手机号码
     * @param type $pwd密码
     * @param type $wx_account微信账号
     * @param type $account_name用户姓名
     */
    public function help_reg($code, $phone, $pwd, $wx_account, $account_name) {

        $code_user = Db::name('user')->where(['code' => $code])->find();
        if (!$code_user || $code_user['status'] != 1) {
            $this->buildFailed('推荐码有误');
        }
        $can_reg = Db::name('level')->where(['level' => $code_user['level']])->value('can_reg');
        if ($can_reg != '1') {
            $this->buildFailed('你没有注册权限');
        }
        //用户已处理
        $_user = Db::name('User')->field('id,username')->where(array('username' => $phone))->find();
        if ($_user) {
            $this->buildFailed("手机号已存在", ReturnCode::FAIL);
        }
        if (!check_pwd_format($pwd)) {
            $this->buildFailed("密码格式有误", ReturnCode::FAIL);
        }
        Db::startTrans();
        $agent_pid = intval($code_user['agent_pid']);
        $data['username'] = $phone;
        $data['pwd'] = passwd_encrypt($pwd);
        $data['invite_id'] = intval($code_user['id']);
        $data['agent_pid'] = $agent_pid;
        $data['login_time'] = TIME_NOW;
        $data['login_ip'] = ip2long($this->request->ip());
        $data['create_time'] = TIME_NOW;
        $data['update_time'] = TIME_NOW;
        $code = create_user_code(); //todo
        if (!$code) {
            $this->buildFailed("系统繁忙，请稍后再试", ReturnCode::FAIL);
        }
        $data['code'] = $code; //todo
        $user_id = Db::name('User')->insertGetId($data);

        $node = create_user_node($user_id, $code_user['node']);
        Db::name('User')->where(['id' => $user_id])->update(['node' => $node]);
        $_data['user_id'] = $user_id;
        $_data['wx_account'] = $wx_account;
        $_data['account_name'] = $account_name;
        $_data['create_time'] = TIME_NOW;
        $_data['update_time'] = TIME_NOW;
        $_data['agent_pid'] = $agent_pid;
        $_data['nickname'] = $account_name;
        $_data['sex'] = 0;
        $_data['wx_picture_id'] = 0;
        $res2 = Db::name('UserProfile')->insert($_data);

        if ($user_id && $res2) {
            Db::commit();
            $this->buildSuccess(array(), "注册成功", ReturnCode::SUCCESS);
        } else {
            Db::rollback();
            $this->buildFailed("系统繁忙，请稍后再试", ReturnCode::FAIL);
        }
    }

}
