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
 * 提现逻辑
 */
class Withdraw extends AdminBase {

    /**
     * 获取会员列表
     */
    public function getWithdrawList($where = [], $field = 'w.*,b.nickname,u.username', $order = '', $paginate = DB_LIST_ROWS) {      
        $this->modelWithdraw->alias('w');
        $join = [
            [SYS_DB_PREFIX . 'member b', 'w.admin_id = b.id', 'LEFT'],
            [SYS_DB_PREFIX . 'user u', 'w.user_id = u.id', 'LEFT'],
        ];
//        if (!is_administrator()) {
//            $where['w.admin_id'] = MEMBER_ID;
//        } else {
//            
//        }


        $this->modelWithdraw->join = $join;

        return $this->modelWithdraw->getList($where, $field, $order, $paginate);
    }

    public function getWhere($data = []) {       
        $where = [];

        !empty($data['search_data']) && $where['u.username'] = ['like', '%' . $data['search_data'] . '%'];

        return $where;
    }
    
    public function getUserEdit($data = []){
        
//        $validate_result = $this->validateWithdraw->scene('edit')->check($data);
//        
//        if (!$validate_result) {
//            
//            return [RESULT_ERROR, $this->validateWithdraw->getError()];
//        }
        
        $data['update_time'] = time();
        
        if($data['method'] == 'confirm'){
            
            $data['status'] = 1;    
        }
        if($data['method'] == 'cancel'){
            
            $data['status'] = 2;
        }
        
        $url = url('withdrawList');
        
        $result = $this->modelWithdraw->setInfo($data);
        
        $handle_text = empty($data['id']) ? '新增' : '编辑';
        
        $result && action_log($handle_text, '提现' . $handle_text . 'id:' . $data['id']);
        
        return $result ? [RESULT_SUCCESS, '操作成功',$url] : [RESULT_ERROR, $this->modelWithdraw->getError()];
        
    }
    
    /**
     * 获取单挑记录信息
     */
    public function getWithdrawInfo($where = []) {
        return $this->modelWithdraw->getInfo($where);
    }
    
    
    /**
     * 获取提现信息
     */
    public function getWithdrawData($data = []) {
        
        $this->modelWithdraw->alias('w');
        $join = [
            [SYS_DB_PREFIX . 'member b', 'w.admin_id = b.id', 'LEFT'],
            [SYS_DB_PREFIX . 'user u', 'w.user_id = u.id', 'LEFT'],
        ];
        $this->modelWithdraw->join = $join;
        $where['w.id'] = $data['id'];
        return $this->modelWithdraw->getInfo($where, 'w.*,b.nickname,u.username');
        
    }
}
