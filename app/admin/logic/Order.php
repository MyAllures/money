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

/**
 * 省市县三级联动小物件逻辑
 */
class Order extends AdminBase
{
    /**
     * 收益列表
     */
    public function orderList($data=[])
    {   
        if(MEMBER_ID != 1){
            $where['m.agent_pid']=MEMBER_ID;
        }
        !empty($data['search_data']) && $where['m.order_no|u.username'] = ['like', '%'.$data['search_data'].'%'];
        $list=db('order')
                ->alias('m')
                ->join(SYS_DB_PREFIX.'member b','m.agent_pid=b.id',LEFT)
                ->join(SYS_DB_PREFIX.'user u','m.user_id=u.id',LEFT)
                ->field('m.order_no,m.status,m.money,m.note,m.out_order_no,m.agent_pid,m.type,m.pay_type,m.create_time,m.update_time,u.username,b.username as user_name')
                ->where($where)
                ->paginate(10);
        return $list;
        
       
    }
    
}
