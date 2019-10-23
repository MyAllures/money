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
 * 等级管理控制器
 */
class Level extends AdminBase {

    /**
     * 等级管理列表
     */
    public function levelList() {
        $type = [
            '1' => '普通会员',
            '2' => '特殊',
        ];

        $is_end = [
            '0' => '未上限',
            '1' => '上限',
        ];

        $can_reg = [
            '0' => '不能',
            '1' => '能',
        ];

        $where = $this->logicLevel->getWhere($this->param);

        $list = $this->logicLevel->getLevelList($where);

        $level = $this->logicLevel->getLevelData($this->param);

        $this->assign('level', $level);

        $this->assign('list', $list);

        $this->assign('type', $type);

        $this->assign('is_end', $is_end);

        $this->assign('can_reg', $can_reg);

        return $this->fetch('level_list');
    }

    /**
     * 等级管理编辑
     */
    public function levelEdit() {

        $is_end = [
            '0' => '未上限',
            '1' => '上限',
        ];

        $can_reg = [
            '0' => '不能',
            '1' => '能',
        ];

        IS_POST && $this->jump($this->logicLevel->getLevelEdit($this->param));
        $data = $this->param;
        $where['id'] = $data['id'];
        $info = $this->logicLevel->getLevelInfo($where);

        $this->assign('is_end', $is_end);

        $this->assign('can_reg', $can_reg);

        $this->assign('info', $info);

        return $this->fetch('level_edit');
    }

    /**
     * 数据状态设置
     */
    public function setStatus() {

        $this->jump($this->logicAdminBase->setStatus('Article', $this->param));
    }

    public function sign_setting() {
        IS_POST && $this->jump($this->logicSignSetting->setis_send($this->param));
        $is_send = $this->logicSignSetting->get_setting();
        $is_send_arr = $this->logicSignSetting->is_send();
        $this->assign('is_send', $is_send);
        $this->assign('is_send_arr', $is_send_arr);
        return $this->fetch('sign_setting');
    }

}
