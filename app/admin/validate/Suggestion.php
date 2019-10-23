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
 * 意见反馈验证器
 */
class Suggestion extends AdminBase
{
    
    // 验证规则
    protected $rule =   [
        'status'          => 'require',
        
    ];

    // 验证提示
    protected $message  =   [
        'status.require'        => '状态不能为空',
        
    ];
    
    // 应用场景
    protected $scene = [
        'edit'  =>  ['status'],
    ];
}
