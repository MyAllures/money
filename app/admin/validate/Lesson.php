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
 * 课程
 */
class Lesson extends AdminBase
{
    
    // 验证规则
    protected $rule =   [
        
        'name'      => 'require|unique:Lesson',
        'money'      => 'require',
        'describe'      => 'require',
        'time_limit'  => 'require',
    ];
    
    // 验证提示
    protected $message  =   [
        
        'name.require'      => '课程名称不能为空',
        'name.unique'       => '课程名称已存在',
        'money.require'      => '金额不能为空',
        'describe.require'      => '描述不能为空',
        'time_limit.require'      => '课程时长不能为空',
    ];

    // 应用场景
    protected $scene = [
        
        'add'       =>  ['name','money','describe','time_limit'],
        'edit'       =>  ['name','money','describe','time_limit'],
    ];
}
