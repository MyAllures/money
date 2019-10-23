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
 * 课程
 */
class Lesson extends AdminBase
{
    /**
     * 课程列表
     */
    public function lessonList($data=[])
    {   
        !empty($data['search_data']) && $where['name'] = ['like', '%'.$data['search_data'].'%'];
        $list=db('lesson')
                ->where($where)
                ->paginate(10);
        return $list;
    }
    /**
     * 课程详情
     */
    public function lessonInfo($data)
    {   
        $info = $this->modelLesson->getInfo($where['id']=$data);
        return $info;
    }
    /**
     * 课程添加
     */
    public function lessonAdd($data=[]){
        $url=url('lessonAdd');
        $validate_result = $this->validateLesson->scene('add')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateLogin->getError()];
        }
        $add=[
            'name'=>$data['name'],
            'describe'=>$data['describe'],
            'money'=>$data['money'],
            'status'=>$data['status'],
            'time_limit'=>$data['time_limit'],
            'create_time'=>time(),
        ];
        $result=db('lesson')->insert($add);
        return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, '添加失败，请填写正确'];
    }
    /**
     * 课程修改
     */
    public function lessonEdit($data=[]){
        $url=url('lessonList');
        $validate_result = $this->validateLesson->scene('edit')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateLesson->getError()];
        }
        $add=[
            'name'=>$data['name'],
            'describe'=>$data['describe'],
            'money'=>$data['money'],
            'status'=>$data['status'],
            'time_limit'=>$data['time_limit'],
            'update_time'=>time(),
        ];
        $result=db('lesson')->where(['id'=>$data['id']])->update($add);
        return $result ? [RESULT_SUCCESS, '修改成功', $url] : [RESULT_ERROR, '修改失败，请填写正确'];
    }
}
