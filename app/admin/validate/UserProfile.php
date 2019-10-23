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

namespace app\admin\validate;

/**
 * 会员资料验证器
 */
class UserProfile extends AdminBase
{
    
    // 验证规则
    protected $rule =   [
        'wx_account'          => 'require',
        
    ];

    // 验证提示
    protected $message  =   [
        'wx_account.require'        => '微信号不能为空',
        
    ];
    
    // 应用场景
    protected $scene = [
        'edit'  =>  ['wx_account'],
    ];
}
