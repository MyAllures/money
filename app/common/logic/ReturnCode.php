<?php

/**
 * 错误码统一维护

 */

namespace app\common\logic;

class ReturnCode {

    const SUCCESS = '0000'; //成功
    const FAIL = '0010'; //失败
    const NULL_STRING = '1000'; //缺少必要字段
    const RELOGIN = '0020'; //重新登入
    const SYS_ERR = '9999'; //系统错误

}
