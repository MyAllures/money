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
// 扩展函数文件，系统研发过程中需要的函数建议放在此处，与框架相关函数分离
use think\Cache;

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
 * 验证银行卡号是否正确
 * @param type $bank_no 银行卡号
 * @param type $type 0是验证所有银行卡，1储蓄卡，2-信用卡，默认0。当前仅支持 所有银行卡号
 * @return boolean $flag  true成功 false 失败
 */
function check_bank_no($bank_no, $type = 0) {
    $type = 0;

    $arr_no = str_split($card_number);
    $last_n = $arr_no[count($arr_no) - 1];
    krsort($arr_no);
    $i = 1;
    $total = 0;
    foreach ($arr_no as $n) {
        if ($i % 2 == 0) {
            $ix = $n * 2;
            if ($ix >= 10) {
                $nx = 1 + ($ix % 10);
                $total += $nx;
            } else {
                $total += $ix;
            }
        } else {
            $total += $n;
        }
        $i++;
    }
    $total -= $last_n;
    $x = 10 - ($total % 10);
    if ($x == $last_n) {
        return true;
    } else {
        return false;
    }
}

/**
 * 图片地址区分处理
 */
function get_split_image_url($image_url, $type = 'small') {

    if ($image_url == null or $image_url == '') {
        return (string) $image_url;
    }

    if (strpos($image_url, 'http') === false) {
        $image_url = 'http://' . $_SERVER['HTTP_HOST'] . get_picture_url($image_url, $type);
    }

    return $image_url;
}

/**
 * 获取完整的地址
 * @param string $image_url
 * @param string $default 默认图片，暂时没有启用
 * @return string
 */
function get_all_url($image_url, $default = '') {

    $image_url = trim($image_url);
    if (empty($image_url)) {
        return (string) $image_url;
    }

    if (strpos($image_url, 'http') === false) {
        $root_url = get_file_root_path();
        $image_url = 'http://' . $_SERVER['HTTP_HOST'] . $root_url . $image_url;
    }

    return $image_url;
}

/**
 * 验证昵称
 * @param type $str
 */
function check_nickname_format($str) {
    return true;
}

/**
 * 账户余额变动
 * @param array $_data 数据
 *               user_id 会员id 必填
 *               amount 金额（变动值） 必填
 *               type 变动类型 必填
 *               to_user_id 对方会员id 非必填
 *               order_no 订单号 非必填
 *               note 备注 非必填
 * @param  boolean $is_trans  外部是否已经完成事务，true|1 已完成，false,0未完成，其他信息 默认事务，如果不需要事务传1
 * @return boolean $flag 状态（true-成功，false-失败）
 */
function change_money($_data = [], $is_trans = 0) {
    return model('common/Account', 'logic')->changeMoney($_data, $is_trans);
}

/**
 * 变动积分
 * @param array $_data 数据
 *               user_id 会员id 必填
 *               score 积分（变动值）非必填 （与积分冻结必填其一）
 *               score_amount 积分冻结（变动值） 非必填 （与积分必填其一）
 *               type 变动类型 必填
 *               to_user_id 对方会员id 非必填
 *               order_no 订单号 非必填
 *               note 备注 非必填
 * @param  boolean $is_trans  外部是否已经完成事务，true|1 已完成，false,0未完成，其他信息 默认事务，如果不需要事务传1
 * @return boolean $flag 状态（true-成功，false-失败）
 */
function change_score($_data = [], $is_trans = 0) {
    return model('common/Account', 'logic')->changeScore($_data, $is_trans);
}

/**
 * 
 * @param type $param
 */
function get_trade_icon($type) {
    $path = 'static/module/common/img/icon';
    switch ($type) {
        case 'cash':
        case 'cash_fail':
            $url = $path . '/cash.png';
            break;
        case 'team_profit':
            $url = $path . '/profit.png';
            break;
        default:
            $url = $path . '/trade.png';
            break;
    }
    $url = get_all_url($url);
    return $url;
}

/**
 * 创建订单号
 * @param type $type
 */
function create_order_no($type = '') {

    $str = '';
    if ($type == 'cash') {
        $str = 'TX' . date('YmdHi') . rand(1000, 9999);
    }
    return $str;
}

/**
 * 创建分享注册链接
 * @param type $code
 */
function create_share_url($reffer_code = '', $agent_code = '') {

    $code = 'http://' . $_SERVER['HTTP_HOST'] . "/ls_xls/public/yq/sign.html?reffer_code=" . $reffer_code . "&agent_code=" . $agent_code;

    return $code;
}

/**
 * 发送短信（纯发送短信）
 * @param type $phone 手机号
 * @param type $content 内容
 * @param type $type 短信类型（系统默认短信类型）
 * @return type
 */
function send_sms($phone, $content, $type = '') {
    return logic('common/Sms')->sms_send($phone, $content, $type);
}

/**
 * 开始并发控制 
 * @param type $cache_name 唯一缓存 名称
 * @param int  $expire_time 过期时间
 */
function start_concurrent($cache_name, $expire_time) {
    $prefix = 'ddddddd';
    $expire_time = intval($expire_time);
    if ($expire_time <= 0) {
        return false;
    }
    $cache_name = $prefix . $cache_name;

    $cache_data = Cache::get($cache_name);
    if (!empty($cache_data)) {
        return false;
    }
    $res = Cache::set($cache_name, '1', $expire_time);
    if ($res) {
        return true;
    } else {
        return false;
    }
}

/**
 * 去掉并发控制
 */
function end_concurrent($cache_name) {
    $prefix = 'ddddddd';
    $cache_name = $prefix . $cache_name;
    Cache::set($cache_name, NULL);
}
