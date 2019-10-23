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
class Debt extends AdminBase {

    /**
     * 获取债务信息
     */
    public function getData($data =[]){
        $data = db('zcplan')->where('status = 0')->column();
        return $data;
    }

    public function shenhe($id=0){
        $url = url('debtList');
        $planInfo = db('zcplan')->where('Id',$id)->find();
        if ($planInfo['status'] == 1) {
            return [RESULT_SUCCESS, '已经审核过了', $url];
        }

        $levels = Db::name('level')->where(['status'=> ['=',1],'money'=>['>',0]])->select();
        $zcplan_list = db('zcplan_list')->where('zcplan_id',$planInfo['Id'])->find();

        $su = array(2 => '一', 3 => '二', 4 => '三', 5 => '四', 6 => '五', 7 => '六', 8 => '七', 9 => '八', 10 => '九',);



        if (!$zcplan_list) {
            $data = [];
            $money = 0;
            $end = 0;
            foreach ($levels as &$level) {
                $status=0;
                if (($money + $level['money']) <= $planInfo['account']) {
                    $money = $money + $level['money'];
                    if($level['level']==2){
                        $status=1;
                    }
                    array_push($data,[
                        'uid' => $planInfo['uid'],
                        'zcplan_id' => $planInfo['Id'],
                        'type' => $level['type'],
                        'phase' => $su[$level['level']],
                        'set_demand' => $level['money'],
                        'standard_money' => $level['money'],
                        'all_count' => $planInfo['account'],
                        'add_time' => time(),
                        'status'=>$status
                    ]);
                }else{
                    if (!$end) {
                        array_push($data,[
                            'uid' => $planInfo['uid'],
                            'zcplan_id' => $planInfo['Id'],
                            'type' => $level['type'],
                            'phase' => $su[$level['level']],
                            'set_demand' => $planInfo['account'] - $money,
                            'standard_money' => $level['money'],
                            'all_count' => $planInfo['account'],
                            'add_time' => time(),
                            'status'=>$status
                        ]);
                        $end = 1;
                    }
                }
            }
            Db::name('zcplan_list')->insertAll($data);
        }

        $result=Db::name('zcplan')->where(['id' => $id])->update(['status' => 1]);
        return $result ? [RESULT_SUCCESS, '审核成功', $url] : [RESULT_ERROR, '审核失败', $url];
    }
	
	public function nopass($id=0){
        $url = url('debtList');
        $planInfo = db('zcplan')->where('Id',$id)->find();
        if ($planInfo['status'] == 2) {
            return [RESULT_SUCCESS, '已经驳回过了', $url];
        }
        $result=Db::name('zcplan')->where(['id' => $id])->update(['status' => 2]);
        return $result ? [RESULT_SUCCESS, '驳回成功', $url] : [RESULT_ERROR, '驳回失败', $url];
    }


    /**
     *  生成众筹计划
     */
    public function plan( $total=7500000,$level){
        $total=7500000;
        $a='';
        $p1=3*200;
        $p2=3*200*3;
        $p3=3*200*9;
        $p4=3*200*27;
        $p5=3*200*81;
        $p6=3*200*243;
        $p7=3*200*729;
        $p8=3*200*2187;
        $p9=3*200*6561;
        if($p1>$total){
            $a.='plan1--'.$total.'--';
        }else{
            $a.='plan1--'.$p1.'--';
            $total-=$p1;
            if($p2>$total){
                $a.='plan2--'.$total.'--';
            }else{
                $a.='plan2--'.$p2.'--';
                $total-=$p2;
                if($p3>$total){
                    $a.='plan3--'.$total.'--';
                }else{
                    $a.='plan3--'.$p3.'--';
                    $total-=$p3;
                    if($p4>$total){
                        $a.='plan4--'.$total.'--';
                    }else{
                        $a.='plan4--'.$p4.'--';
                        $total-=$p4;
                        if($p5>$total){
                            $a.='plan5--'.$total.'--';
                        }else{
                            $a.='plan5--'.$p5.'--';
                            $total-=$p5;
                            if($p6>$total){
                                $a.='plan6--'.$total.'--';
                            }else{
                                $a.='plan6--'.$p6.'--';
                                $total-=$p6;
                                if($p7>$total){
                                    $a.='plan7--'.$total.'--';
                                }else{
                                    $a.='plan7--'.$p7.'--';
                                    $total-=$p7;
                                    if($p8>$total){
                                        $a.='plan8--'.$total.'--';
                                    }else{
                                        $a.='plan8--'.$p8.'--';
                                        $total-=$p8;
                                        if($p9>$total){
                                            $a.='plan9--'.$total.'--';
                                        }else{
                                            $a.='plan9--'.$total.'--';
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $a;
    }


    /**
     * 获取债务申请列表
     */
    public function getDebtList($where = [], $field = 'e.*', $order = '', $paginate = DB_LIST_ROWS) {
        $this->modelZcplan->alias('e');
        $join = [
            [SYS_DB_PREFIX . 'level l', 'a.up_level = l.level', 'LEFT'],
        ];
//        if (!is_administrator()) {
//            $where['u.agent_pid'] = MEMBER_ID;
//        } else {
//
//        }


        $this->modelLevel->join = $join;

        return $this->modelLevel->getList($where, $field, $order, $paginate);
    }

//    public function getWhere($data = []) {
//        $where = [];
//
//        !empty($data['search_data']) && $where['a.order_no'] = ['like', '%' . $data['search_data'] . '%'];
//
//        return $where;
//    }
//
//
//
//    /**
//     * 等级编辑
//     */
//    public function getLevelEdit($data = []) {
//
//        if (!is_administrator()) {
//            $where['id'] = $data['id'];
//            $info = $this->logicLevel->getLevelInfo($where);
//            if ($info->agent_pid != MEMBER_ID) {
//                return [RESULT_ERROR, '你没有权限操作'];
//            }
//        }
//
//        $url = url('levelList');
//
//        $result = $this->modelLevel->setInfo($data);
//
//        $handle_text = empty($data['id']) ? '新增' : '编辑';
//
//        $result && action_log($handle_text, '会员' . $handle_text . 'id:' . $data['id']);
//
//        return $result ? [RESULT_SUCCESS, '操作成功', $url] : [RESULT_ERROR, $this->modelLevel->getError()];
//    }
//
//    /**
//     * 获取单挑记录信息
//     */
//    public function getLevelInfo($where = []) {
//        return $this->modelLevel->getInfo($where);
//    }
}
