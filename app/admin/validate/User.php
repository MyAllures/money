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
 * 会员验证器
 */
class User extends AdminBase
{
    
    // 验证规则
    protected $rule =   [
        'username'        => 'require|number',
        'status'          => 'require',
        
    ];

    // 验证提示
    protected $message  =   [
        'username.require'      => '会员名称不能为空',
        'username.number'       => '会员名称(手机号)必须为数字',
        'status.require'        => '状态不能为空',
        
    ];
    
    // 应用场景
    protected $scene = [
        'edit'  =>  ['username','status'],
    ];
}
