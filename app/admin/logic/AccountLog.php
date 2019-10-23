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
 * 资金记录逻辑
 */
class AccountLog extends AdminBase {

    /**
     * 获取资金记录列表
     */
    public function getAccountlogList($where = [], $field = 'a.*,r.username as ousername,u.username as tusername', $order = '', $paginate = DB_LIST_ROWS) {      
        $this->modelAccountLog->alias('a');
        $join = [
//            [SYS_DB_PREFIX . 'member b', 'u.agent_pid = b.id', 'LEFT'],
            [SYS_DB_PREFIX . 'user r', 'a.user_id = r.id', 'LEFT'],
            [SYS_DB_PREFIX . 'user u', 'a.to_user_id = u.id', 'LEFT'],
        ];
//        if (!is_administrator()) {
//            $where['u.agent_pid'] = MEMBER_ID;
//        } else {
//            
//        }


        $this->modelAccountLog->join = $join;

        return $this->modelAccountLog->getList($where, $field, $order, $paginate);
    }

    public function getWhere($data = []) {       
        $where = [];

        !empty($data['search_data']) && $where['u.username'] = ['like', '%' . $data['search_data'] . '%'];

        return $where;
    }
    
    public function getUserEdit($data = []){
        
        $validate_result = $this->validateAccountLog->scene('edit')->check($data);
        
        if (!$validate_result) {
            
            return [RESULT_ERROR, $this->validateAccountLog->getError()];
        }
        
        
        $url = url('userList');
        
        $result = $this->modelAccountLog->setInfo($data);
        
        $handle_text = empty($data['id']) ? '新增' : '编辑';
        
        $result && action_log($handle_text, '资金记录' . $handle_text . 'id:' . $data['id']);
        
        return $result ? [RESULT_SUCCESS, '操作成功',$url] : [RESULT_ERROR, $this->modelUser->getError()];
        
    }
    
    /**
     * 获取单挑记录信息
     */
    public function getUserInfo($where = []) {
        return $this->modelAccountLog->getInfo($where);
    }
    
    /**
     * 获取API数据类型选项
     */
    public function getApiDataOption()
    {
    
        $api_data_type_option  = parse_config_array('api_data_type_option');
        
        $options = '';

        foreach ($api_data_type_option as $k => $v)
        {
            $options .= "<option value='".$k."'>".$v."</option>";
        }

        return $options;
    }
}
