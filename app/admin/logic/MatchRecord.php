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
 * 匹配记录逻辑
 */
class MatchRecord extends AdminBase {

    /**
     * 获取匹配记录列表
     */
    public function getMatchRecordList($where = [], $field = 'm.*,b.nickname,u.username as ousername,r.username as tusername', $order = '', $paginate = DB_LIST_ROWS) {      
        $this->modelMatchRecord->alias('m');
        $join = [
            [SYS_DB_PREFIX . 'member b', 'm.agent_pid = b.id', 'LEFT'],
            [SYS_DB_PREFIX . 'match_passive p', 'm.match_passive_id = p.id', 'LEFT'],
            [SYS_DB_PREFIX . 'user u', 'u.id = p.user_id', 'LEFT'],
            [SYS_DB_PREFIX . 'match_initiative i', 'm.match_initiative_id = i.id', 'LEFT'],
            [SYS_DB_PREFIX . 'user r', 'r.id = i.user_id', 'LEFT'],
        ];
        if (!is_administrator()) {
            $where['m.agent_pid'] = MEMBER_ID;
        } else {
            
        }


        $this->modelMatchRecord->join = $join;

        return $this->modelMatchRecord->getList($where, $field, $order, $paginate);
    }
    /**
     * 获取查询条件
     */
    public function getWhere($data = []) {       
        $where = [];

        !empty($data['search_data']) && $where['u.ousername|r.tusername'] = ['like', '%' . $data['search_data'] . '%'];

        return $where;
    }
    
    /**
     * 获取匹配主动记录列表
     */
    public function getMatchInitiativeList($where = [], $field = 'm.*,b.nickname,u.username,o.order_no', $order = '', $paginate = DB_LIST_ROWS) {      
        $this->modelMatchInitiative->alias('m');
        $join = [
            [SYS_DB_PREFIX . 'member b', 'm.agent_pid = b.id', 'LEFT'],
            [SYS_DB_PREFIX . 'user u', 'm.user_id = u.id', 'LEFT'],
            [SYS_DB_PREFIX . 'order o', 'm.order_id = o.id', 'LEFT'],
        ];
        if (!is_administrator()) {
            $where['m.agent_pid'] = MEMBER_ID;
        } else {
            
        }


        $this->modelMatchInitiative->join = $join;

        return $this->modelMatchInitiative->getList($where, $field, $order, $paginate);
    }
    
    /**
     * 获取单挑记录信息
     */
    public function getUserInfo($where = []) {
        return $this->modelUserProfile->getInfo($where);
    }
}
