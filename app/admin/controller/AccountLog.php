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

namespace app\admin\controller;

/**
 * 资金记录控制器
 */
class AccountLog extends AdminBase
{
    
    /**
     * 资金记录列表
     */
    public function accountlogList(){
        $where = $this->logicAccountLog->getWhere($this->param);
        $list = $this->logicAccountLog->getAccountlogList($where);
        $account_log_type = parse_config_array('account_log_type');
        $income_type = parse_config_array('income_type');
        $this->assign('list', $list);
        $this->assign('account_log_type', $account_log_type);
        $this->assign('income_type', $income_type);
        return $this->fetch('accountlog_list');
    }

    /**
     * 数据状态设置
     */
    public function setStatus(){
        $this->jump($this->logicAdminBase->setStatus('Article', $this->param));
    }
}
