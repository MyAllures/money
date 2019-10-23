<?php
/**
 * 前台会员
 * @author zjb
 * @datetime 2018-12-26 09:33:08
 */
namespace app\api\model;
use app\common\model\ModelBase;

/**
 * 前台会员模型
 */
class User extends ModelBase
{
    
    /**
     * 密码修改器
     */
    public function getBaseInfoByCode($code)
    {
        if(empty($code)){
            return false;
        }
        
        $info = $this->getInfo(array('code'=>$code), 'id,username,agent_pid');
        
        return $info;
    }
}
