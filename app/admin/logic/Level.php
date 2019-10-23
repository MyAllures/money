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
use Think\Db;
/**
 * 等级管理逻辑
 */
class Level extends AdminBase {

    /**
     * 获取等级管理列表
     */
    public function getLevelList($where = [], $field = 'e.*', $order = '', $paginate = DB_LIST_ROWS) {      
        $this->modelLevel->alias('e');
        $join = [
//            [SYS_DB_PREFIX . 'level l', 'a.up_level = l.level', 'LEFT'],
        ];
//        if (!is_administrator()) {
//            $where['u.agent_pid'] = MEMBER_ID;
//        } else {
//            
//        }


        $this->modelLevel->join = $join;

        return $this->modelLevel->getList($where, $field, $order, $paginate);
    }

    public function getWhere($data = []) {       
        $where = [];

        !empty($data['search_data']) && $where['a.order_no'] = ['like', '%' . $data['search_data'] . '%'];

        return $where;
    }
    
    /**
     * 获取等级信息
     */
    public function getLevelData($data =[]){
        
        $data = db('level')->column('name','level');

        return $data;
    }
    
    /**
     * 等级编辑
     */
    public function getLevelEdit($data = []) {

        if (!is_administrator()) {
            $where['id'] = $data['id'];
            $info = $this->logicLevel->getLevelInfo($where);
            if ($info->agent_pid != MEMBER_ID) {
                return [RESULT_ERROR, '你没有权限操作'];
            }
        }

        $url = url('levelList');

        $result = $this->modelLevel->setInfo($data);

        $handle_text = empty($data['id']) ? '新增' : '编辑';

        $result && action_log($handle_text, '会员' . $handle_text . 'id:' . $data['id']);

        return $result ? [RESULT_SUCCESS, '操作成功', $url] : [RESULT_ERROR, $this->modelLevel->getError()];
    }
    
    /**
     * 获取单挑记录信息
     */
    public function getLevelInfo($where = []) {
        return $this->modelLevel->getInfo($where);
    }
}
