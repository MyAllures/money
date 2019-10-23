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
use think\Cache;
use think\Db;

function cache_data($member_id=0) {
    $cache['article'] = Cache::get('article'.'_'.$member_id);
    if (empty($cache['article'])) {
        $cache['article'] = Db('article')->where(['status' => '1'])->where(['member_id'=>$member_id])->order('update_time desc')->select();
        Cache::set('article', $cache['article'], 3600);
    }

    $cache['article_category'] = Cache::get('article_category');
    if (empty($cache['article_category'])) {
        $cache['article_category'] = Db('article_category')->select();
        Cache::set('article_category', $cache['article_category'], 3600);
    }

    return $cache;
}

/**
 * 获取缓存数据中某个Key的数据
 * @param unknown $data 数组
 * @param unknown $key 查找的键名
 * @param unknown $val 查找的键值
 * @return Ambigous <multitype:, unknown>
 */
function query_array($data, $key, $val) {
    $db = array();
    for ($i = 0; $i < count($data); $i++) {
        if ($data[$i][$key] == $val) {
            $db = $data[$i];
            break;
        }
    }
    return $db;
}

/**
 * 获取缓存数据中某个Key的数据
 * @param unknown $data 数组
 * @param unknown $key 查找的键名
 * @param unknown $val 查找的键值
 * @return Ambigous <multitype:, unknown>
 */
function query_array_all($data, $key, $val) {
    $db = array();
    for ($i = 0; $i < count($data); $i++) {
        if ($data[$i][$key] == $val) {
            $db[] = $data[$i];
            // break;
        }
    }
    return $db;
}

/**
 * 获取缓存数据中某个Key的数据
 * @param unknown $data 数组
 * @param unknown $key 查找的键名
 * @param unknown $val 查找的键值
 * @return Ambigous <multitype:, unknown>
 */
function query_array_compare($data, $key, $val, $condition = '=') {

    $db = array();
    for ($i = 0; $i < count($data); $i++) {
        switch ($condition) {
            case '=':if ($data[$i][$key] == $val) {
                    $db = $data[$i];
                    return $db;
                } break;
            case '>': if ($data[$i][$key] > $val) {
                    $db = $data[$i];
                    return $db;
                } break;
            case '>=': if ($data[$i][$key] >= $val) {
                    $db = $data[$i];
                    return $db;
                } break;
            case '<': if ($data[$i][$key] < $val) {
                    $db = $data[$i];
                    return $db;
                } break;
            case '<=': if ($data[$i][$key] <= $val) {
                    $db = $data[$i];
                    return $db;
                } break;
        }
    }
    return $db;
}

/**
 * 转化系统参数字典
 * @param unknown $data 参数数组
 * @return multitype:NULL 一维数组
 */
function sytem_array($data) {
    $db = array();
    for ($i = 0; $i < count($data); $i++) {
        $db[$data[$i]['name']] = $data[$i]['value'];
    }
    return $db;
}

/**
 * 数组分页
 * @param unknown $array 要分页的数组
 * @param unknown $page 当前页码 （String）
 * @param unknown $page_count 每页显示数量
 * @return number 分页的数组
 */
function array_pages($array, $page, $page_count) {
    $len = count($array);
    if (empty($page))
        $page = '1';
    $index = intval($page);

    if ($len <= $page_count) {
        if ($index > 1) {
            return null;
        } else {
            return $array;
        }
    } else {
        $pp = intval($len / $page_count);
        $yy = intval($len % $page_count);
        if ($yy > 0)
            $pp = $pp + 1;
        if ($index > $pp) {
            return null;
        } else {
            $str_num = ($index - 1) * $page_count;
            if ($index == $pp) {
                if ($yy > 0) {
                    $end_num = $str_num + $yy;
                } else {
                    $end_num = $str_num + $page_count;
                }
            } else {
                $end_num = $str_num + $page_count;
            }
            $list = array();
            $n = 0;
            for ($i = $str_num; $i < $end_num; $i++) {
                $list[$n] = $array[$i];
                $n++;
            }
            return $list;
        }
    }
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
 * 验证密码
 * @param type $pwd 原始密码
 * @param type $encrypt_pwd 加密密码
 * @return boolean 验证结果 true-成功 false-失败
 */
function check_passwd_encrypt($pwd, $encrypt_pwd) {

    if (!$pwd) {
        return false;
    }

    if (passwd_encrypt($pwd) == $encrypt_pwd) {
        return true;
    }
    return false;
}

/**
 * 验证手机号
 * @param type $phone
 * @param type $code
 * @param type $type
 */
function check_phone_code($phone, $code, $type) {
    return logic('common/Sms')->checkSendCode($type, $phone, $code);
}

/**
 * 发送验证码
 * @param type $phone 手机号
 * @param type $type 类型
 */
function send_phone_code($phone, $type) {
    return logic('common/Sms')->send($phone, $type);
}

/**
 * 验证密码格式
 * @param type $pwd
 */
function check_pwd_format($pwd) {
    return true;
}

/**
 * 
 * @param type $bg开始
 * @param type $now结束
 * @return string
 */
function Sec2Time($bg, $now) {
    $time = strtotime($now) - strtotime($bg);
    if (is_numeric($time)) {
        $value = array(
            "years" => 0, "days" => 0, "hours" => 0,
            "minutes" => 0, "seconds" => 0,
        );
        if ($time >= 31556926) {
            $value["years"] = floor($time / 31556926);
            $time = ($time % 31556926);
        }
        if ($time >= 86400) {
            $value["days"] = floor($time / 86400);
            $time = ($time % 86400);
        }
        if ($time >= 3600) {
            $value["hours"] = floor($time / 3600);
            $time = ($time % 3600);
        }
        if ($time >= 60) {
            $value["minutes"] = floor($time / 60);
            $time = ($time % 60);
        }
        $value["seconds"] = floor($time);
        // $t=$value["years"] ."年". $value["days"] ."天"." ". $value["hours"] ."小时". $value["minutes"] ."分".$value["seconds"]."秒";
        $t = $value["years"] . "年" . $value["days"] . "天";
        Return $t;
    } else {
        return (bool) FALSE;
    }
}

/**
 * 创建随机数
 * @param type $length 长度
 * @param type $str_type 0：全部， 以,隔开（1：表示大写；2：表示小写；3表示数字）1
 * @return type
 */
function createRandstr($length, $str_type = '0') {
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
function create_user_code() {
    $pre_len = 3;
    $next_len = 6;
    $length = 10;
    $code = '';
    $t = 0;
    while ($length--) {
        if ($pre_len > 0) {
            $pre = createRandstr($pre_len, '1');
        }
        if ($next_len > 0) {
            $next = createRandstr($next_len, '3');
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
 * 手机号码中间4位****号代替
 * @param type $phone
 * @return type
 */
function phone_replace($phone) {
    return substr_replace($phone, '****', 3, 4);
}
