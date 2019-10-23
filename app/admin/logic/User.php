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
class User extends AdminBase {

    /**
     * 获取会员列表
     */
    public function getUserList($where = [], $field = 'u.*,b.nickname,r.username as rusername', $order = 'u.id desc', $paginate = DB_LIST_ROWS) {
        $this->modelUser->alias('u');
        $join = [
                [SYS_DB_PREFIX . 'member b', 'u.agent_pid = b.id', 'LEFT'],
                [SYS_DB_PREFIX . 'user r', 'u.invite_id = r.id', 'LEFT'],
        ];
//        if (!is_administrator()) {
//            $where['u.agent_pid'] = MEMBER_ID;
//        } else {
//            
//        }


        $this->modelUser->join = $join;

        return $this->modelUser->getList($where, $field, $order, $paginate);
    }

    public function getWhere($data = []) {
        $where = [];

        !empty($data['search_data']) && $where['r.username'] = ['like', '%' . $data['search_data'] . '%'];
        !empty($data['search_name']) && $where['u.username'] = ['like', '%' . $data['search_name'] . '%'];

        if (!is_administrator()) {
            $where['u.agent_pid'] = MEMBER_ID;
        }

        return $where;
    }

    public function getUserEdit($data = []) {
        if ($data['pwd'] != '') {
            $data['pwd'] = sha1($data['pwd']);
        } else {
            $where['id'] = $data['id'];
            $userinfo = $this->getUserInfo($where);
            $data['pwd'] = $userinfo['pwd'];
        }
        preg_match("/^1[3456789]\d{9}$/", $data['username'], $mobiles);
        if (empty($mobiles[0])) {
            return [RESULT_ERROR, '你输入的手机号格式不正确'];
        }
        $validate_result = $this->validateUser->scene('edit')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateUser->getError()];
        }
        if (!is_administrator()) {
            $where['id'] = $data['id'];
            $info = $this->logicUser->getUserInfo($where);
            if ($info->agent_pid != MEMBER_ID) {
                return [RESULT_ERROR, '你没有权限操作'];
            }
        }

        $url = url('userList');

        $result = $this->modelUser->setInfo($data);

        $handle_text = empty($data['id']) ? '新增' : '编辑';

        $result && action_log($handle_text, '会员' . $handle_text . 'id:' . $data['id']);

        return $result ? [RESULT_SUCCESS, '操作成功', $url] : [RESULT_ERROR, $this->modelUser->getError()];
    }

    /**
     * 获取单挑记录信息
     */
    public function getUserInfo($where = []) {
        return $this->modelUser->getInfo($where);
    }

    public function getUserLevel() {
        $level = Db::name('level')->column('name', 'level');
        return $level;
    }

    /**
     * 注册
     * @param type $username 会员
     * @param type $pwd 密码
     * @param type $code 验证码
     * @param type $reffer_code 推荐人码
     * @param type $agent_code 代理码
     */
    public function register($param, $ip) {
        //基本验证
        $username = $param['username'];
        $pwd = $param['password'];
        $account_name = $param['account_name'];
        if (empty($username)) {
            return [RESULT_ERROR, '请输入手机号码'];
        }
        if (empty($account_name)) {
            return [RESULT_ERROR, '请输入姓名'];
        }
        if (empty($pwd)) {
            return [RESULT_ERROR, '请输入密码'];
        }
        $wx_account = trim($param['wx_account']);
        if (empty($wx_account)) {
            return [RESULT_ERROR, '请输入微信号码'];
        }
        if (!$this->check_is_mobile($username)) {
            return [RESULT_ERROR, '手机号格式有误'];
        }
        //用户已处理
        $_user = Db::name('User')->field('id,username,node')->where(array('username' => $username))->find();
        if ($_user) {
            return [RESULT_ERROR, '手机号已存在'];
        }
        if (empty($wx_account)) {
            return [RESULT_ERROR, '微信号有误'];
        }
        //验证微信号唯一
        $_user_profile = Db::name('UserProfile')->field('id')->where(['wx_account' => $wx_account])->find();
        if ($_user_profile) {
            return [RESULT_ERROR, '微信号已存在'];
        }

        //判断是否有上级
        $invite_id = 0;
        $agent_pid = MEMBER_ID;
        $invite_node = '';

        if (!empty($param['invite_user'])) {
            $invite_user = Db::name('user')->where(['agent_pid' => MEMBER_ID, 'username' => $param['invite_user']])->find();
            if (empty($invite_user)) {
                return [RESULT_ERROR, '上级不存在'];
            }
            $invite_id = $invite_user['id'];
            $invite_node = $invite_user['node'];
        }
        Db::startTrans();
        if (empty($param['level'])) {
            $param['level'] = 1;
        }
        $data['level'] = intval($param['level']);
        $data['username'] = $username;
        $data['pwd'] = $this->passwd_encrypt($pwd);
        $data['invite_id'] = intval($invite_id);
        $data['agent_pid'] = intval($agent_pid);
        $data['login_time'] = TIME_NOW;
        $data['login_ip'] = ip2long($ip);
        $data['create_time'] = TIME_NOW;
        $data['update_time'] = TIME_NOW;
        $data['code'] = $this->create_user_code(); //todo
        $user_id = Db::name('User')->insertGetId($data);
        if ($user_id > 0) {
            $node = $this->create_user_node($user_id, $invite_node);
            Db::name('User')->where(['id' => $user_id])->update(['node' => $node]);
            $_data['user_id'] = $user_id;
            $_data['agent_pid'] = intval($agent_pid);
            $_data['wx_account'] = strval($wx_account);
            $res2 = Db::name('UserProfile')->insert($_data);
            if ($res2) {
                Db::commit();
                $url = '';
                return [RESULT_SUCCESS, '操作成功', $url];
            } else {
                Db::rollback();
                return [RESULT_ERROR, '系统繁忙，请稍后再试'];
            }
        } else {
            Db::rollback();
            return [RESULT_ERROR, '系统繁忙，请稍后再试'];
        }
    }

    /**
     * 是否是正确的手机号
     * @param type $mobile 手机号
     * @return boolean
     */
    function check_is_mobile($mobile) {
        if (!is_numeric($mobile)) {
            return false;
        }
        return preg_match('#^1[\d]{10}$#', $mobile) ? true : false;
    }

    /**
     * 密码加密方式
     * @param type $password
     * @return type
     */
    function passwd_encrypt($password) {

//    return sha1(md5($password));
        return sha1($password);
    }

    /**
     * 创建用户的关系节点
     * @param type $user_id
     * @param type $p_node
     */
    function create_user_node($user_id, $p_node = '') {
        $user_id = intval($user_id);
        if ($user_id <= 0) {
            return '';
        }
        $node = strval($user_id);
        $pre_node = '';
        if ($p_node) {
            $p_node_arr = explode('-', $p_node);
            if (!in_array($user_id, $p_node_arr)) {//防止循环链
                $pre_node = $p_node . '-';
            }
        }
        $node = $pre_node . $node;
        return $node;
    }

    /**
     * 创建用户的唯一标志
     * @param type $user_id
     */
    public function create_user_code() {
        $pre_len = 8;
        $next_len = 0;
        $length = 10;
        $code = '';
        $t = 0;
        while ($length--) {
            if ($pre_len > 0) {
                $pre = $this->createRandstr($pre_len, '1,3');
            }
            if ($next_len > 0) {
                $next = $this->createRandstr($next_len, 3);
            }
            $code .= $pre;
            $code .= $next;
            if (!$code) {
                break;
            }
            $info = Db::name('User')->field('code')->where(['code' => $code])->find();
            if ($info) {
                $code = '';
                continue;
            }
            break;
        }

        if ($code) {
            return $code;
        } else {
            return '';
        }
    }

    /**
     * 创建随机数
     * @param type $length 长度
     * @param type $str_type 0：全部， 以,隔开（1：表示大写；2：表示小写；3表示数字）1
     * @return type
     */
    public function createRandstr($length, $str_type = '0') {
        $chars1 = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $chars2 = "abcdefghijklmnopqrstuvwxyz";
        $chars3 = "0123456789";
        $types = explode(',', $str_type);
        $chars = '';
        foreach ($types as $key => $val) {
            if ($val == 1) {
                $chars .= $chars1;
            } elseif ($val == 2) {
                $chars .= $chars2;
            } elseif ($val == 3) {
                $chars .= $chars3;
            }
        }

        if (empty($chars)) {
            $chars = $chars1 . $chars2 . $chars3;
        }
        $chars_len = strlen($chars);
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, $chars_len - 1), 1);
        }
        return $str;
    }

}
