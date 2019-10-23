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
 * 提现验证器
 */
class Withdraw extends AdminBase
{
    
    // 验证规则
    protected $rule =   [
        'fee'          => 'require',
        'note'         => 'require',
        
    ];

    // 验证提示
    protected $message  =   [
        'fee.require'        => '费率不能为空',
        'note.require'       => '备注不能为空',
        
    ];
    
    // 应用场景
    protected $scene = [
        'edit'  =>  ['fee','note'],
    ];
}
