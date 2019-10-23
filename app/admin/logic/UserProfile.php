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
 * 会员资料逻辑
 */
class UserProfile extends AdminBase {

    /**
     * 获取会员资料列表
     */
    public function getProfileList($where = [], $field = 'u.*,r.username,b.nickname as bnickname', $order = '', $paginate = DB_LIST_ROWS) {      
        $this->modelUserProfile->alias('u');
        $join = [
            [SYS_DB_PREFIX . 'member b', 'u.agent_pid = b.id', 'LEFT'],
            [SYS_DB_PREFIX . 'user r', 'u.user_id = r.id', 'LEFT'],
        ];
        if (!is_administrator()) {
            $where['u.agent_pid'] = MEMBER_ID;
        } else {
            
        }


        $this->modelUserProfile->join = $join;

        return $this->modelUserProfile->getList($where, $field, $order, $paginate);
    }

    public function getWhere($data = []) {       
        $where = [];

        !empty($data['search_data']) && $where['u.username'] = ['like', '%' . $data['search_data'] . '%'];

        return $where;
    }
    
    public function getUserProfileEdit($data = []){
        
        $validate_result = $this->validateUserProfile->scene('edit')->check($data);
        
        if (!$validate_result) {
            
            return [RESULT_ERROR, $this->validateUserProfile->getError()];
        }
          if (!is_administrator()) {
            $where['id'] = $data['id'];
            $info = $this->getUserProfileInfo($where);
            if ($info->agent_pid != MEMBER_ID) {
                return [RESULT_ERROR, '你没有权限操作'];
            }
        }
        
        $url = url('profileList');
        
        $result = $this->modelUserProfile->setInfo($data);
        
        $handle_text = empty($data['id']) ? '新增' : '编辑';
        
        $result && action_log($handle_text, '会员资料' . $handle_text . 'id:' . $data['id']);
        
        return $result ? [RESULT_SUCCESS, '操作成功',$url] : [RESULT_ERROR, $this->modelUserProfile->getError()];
        
    }
    
    /**
     * 获取单挑记录信息
     */
    public function getUserProfileInfo($where = []) {
        return $this->modelUserProfile->getInfo($where);
    }
}
