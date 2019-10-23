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

namespace app\index\controller;
require_once ROOT_PATH."/public/vendor/qiniu/php-sdk/autoload.php";

use think\Controller;
use think\Db;
// 引入鉴权类
use Qiniu\Auth;

// 引入上传类
use Qiniu\Storage\UploadManager;
/**
 * 前端首页控制器
 */
class Upload extends Controller
{
    
    // 首页
    public function index($cid = 0)
    {
        return $this->fetch();
    }
    public function saveBase64Image(){
	   $base64_image_content=input('file');
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)){
                  //图片后缀
                  $type = $result[2];
                  //保存位置--图片名
                  $image_name=date('His').str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT).".".$type;
                  $image_file_path = '/upload/picture/'.date('Ymd');
                  $image_file = ROOT_PATH.'public'.$image_file_path;
                  $imge_real_url = $image_file.'/'.$image_name;
                  $imge_web_url = $image_file_path.'/'.$image_name;
					//
					$imageName = $this->qiniuUpload($image_name, $base64_image_content);
					if ($imageName) {
						$data['code'] = 0;
						$data['imageName']=$image_name;
						$data['url'] = 'http://pzd0kgtjz.bkt.clouddn.com/'.$image_name;
						$data['msg'] = '保存成功';
					} else {
						$data['code']=1;
						$data['imgageName']='';
						$data['url']='';
						$data['msg']='图片保存失败！';
					}
					//
                  // if (!file_exists($image_file)){
                    // mkdir($image_file, 0700);
                    // fopen($image_file.'\\'.$image_name, "w");
                  // }
                  //解码
                  // $decode=base64_decode(str_replace($result[1], '', $base64_image_content));
                  // if (file_put_contents($imge_real_url, $decode)){
                        // $data['code']=0;
                        // $data['imageName']=$image_name;
                        // $data['url']='http://'.$_SERVER['HTTP_HOST'].$imge_web_url;
                        // $data['msg']='保存成功！';
                  // }else{
                    // $data['code']=1;
                    // $data['imgageName']='';
                    // $data['url']='';
                    // $data['msg']='图片保存失败！';
                  // }
        }else{
            $data['code']=1;
            $data['imgageName']='';
            $data['url']='';
            $data['msg']='base64图片格式有误！';
        }       
        return $data;
    }
	
	protected function qiniuUpload($fileName, $path){
		// 需要填写你的 Access Key 和 Secret Key
		$accessKey = 'igxupJ4-ETI4Vr3GZNLDBqclpi7Jr7ocWrZBAVIe';
		$secretKey = 'Y0tXSTzC89l70kDcx3M75GhT1QIN-GDb21XCr3e1';

		// 构建鉴权对象
		$auth = new Auth($accessKey, $secretKey);

		// 要上传的空间
		$bucket = 'youqianhuan2019';

		// 生成上传 Token
		$token = $auth->uploadToken($bucket);
		

		// 初始化 UploadManager 对象并进行文件的上传。
		$uploadMgr = new UploadManager();

		// 调用 UploadManager 的 putFile 方法进行文件的上传。
		list($ret, $err) = $uploadMgr->putFile($token, $fileName, $path);
		if ($err !== null) {
			return false;
		} else {
			return $ret[key];
		}
	}
	
	public function getdata(){
		$res = Db('user')->where(['token' =>input('token')])->find();
		$arr = Db('zcplan')->where(['uid' =>$res['id']])->select();
		$arr_plan = Db('zcplan_list')->where(['uid' =>$res['id']])->select();
        $user_parent_plan= Db('zcplan_plan')->where(['uid' =>$res['id']])->select();
        $outStr='';
		if(!empty($arr_plan)){
            foreach ($arr_plan as $k=>$v){

                if($v['demand']>0){
                    $count_money=$v['demand'];
                }else{
                    $count_money=0;
                    $user_down_plan= Db('zcplan_plan')->where(['phase' =>$v['id'],'pay_status'=>1,'get_uid'=>$res['id']])->select();
                    foreach ($user_down_plan as $ks=>$vs){
                        $count_money+=intval($vs['money']);
                    }
                }
				if($count_money<=$v['set_demand']){
					$jind=bcmul(bcdiv($count_money,$v['set_demand'],4),100,2);
				}
				if($count_money>$v['set_demand']){
					$jind=bcmul(bcdiv($count_money,$v['set_demand'],0),100,2);
				}
				//var_dump($jind);
				//EXIT;
                $outStr.='<div style="display:flex;flex-direction: row;padding:0.6em 0.4em">';
                $outStr.='<div style="font-size:14px;width:18%;margin-left:4px">第'.$v['phase'].'阶段</div>';
                $outStr.='<div style="width:60%">';
                $outStr.='<div  style="width:100%;margin-top:4px;height:12px;border:2px solid #35BFFD;border-radius:10px">';
                $outStr.='<div class="progress-bar" style="width:'.$jind.'%;height:10px;background-color: #35BFFD;margin: -1px 0 0 -1px"></div>';
                $outStr.='</div>';
                $outStr.='</div>';
                if($jind>0){
                    $outStr.='<div style="font-size:15px;width:20%;padding-left:1%"><a href="pay_list.html" style="color: #35BFFD;">去确认</a></div>';
                }else{
                    $outStr.='<div style="font-size:15px;width:20%;padding-left:1%">'.$v['demand'].'/'.$v['set_demand'].'</div>';
                }
                $outStr.='</div>';
            }
        }
		if(empty($user_parent_plan)){
		    $user_parent_plan=null;
        }
		$level=$res['level']+1;
		//添加升级
		//$result=$this->addPlanUserParent2($res['invite_id'],$res['id'],$level);
		
        $user_upgrade_sure= Db('zcplan_plan')->where(['uid' =>$res['id'],'type'=>2,'level'=>$level])->find();
        $user_parent_plan_sure= Db('zcplan_plan')->where(['uid' =>$res['id'],'status'=>1,'type'=>1])->select();
		$count_sure=count($user_parent_plan_sure);
		$data['code']=1;
		$data['data']=$arr;
		$data['user']=$res;
		$data['msg']='success';
		$data['text']=$outStr;
		$data['user_parent_plan']=$user_parent_plan;
		$data['up']=$user_upgrade_sure;
		$data['count_sure']=$count_sure;
		return $data;
	}
	//上传众筹
	public function save(){
        $res = Db('user')->where(['token' =>input('token')])->find();
        $user_plan= Db('zcplan')->where(['uid' =>$res['id'],'type'=>input('type')])->find();
        if(empty($user_plan)){
            $data = ['name' => input('name'),'account' => input('price'),'type' => input('type'),'imgurl' => input('image'),'create_time' => time(), 'uid' => $res['id'],];
            $result=Db::name('zcplan')->insertGetId($data);
        }else{
            $data = ['account' => input('price'),'imgurl' => input('image'),'update_time' => time(),'status'=>0];
            $result=Db::name('zcplan')->where(['Id'=>$user_plan['Id']])->update($data);
        }


		if($result){
			 $data['code']=0;
			 $data['msg']='提交成功';
        }else{
            $data['code']=1;
            $data['msg']='提交失败';
        };
		return $data;
	}
	public function getshoukuandata(){
		$res = Db('user')->where(['token' =>input('token')])->find();
		//var_dump($res);
		$arr = Db('user_profile')->where(['user_id' =>$res['id']])->find();
		$data['code']=1;
		
		$data['data']=$arr;
		$data['data']['account_name']=$res['username'];
		$data['msg']='success';
		return $data;
	}
	public function shoukuansave(){
		
		$res = Db('user')->where(['token' =>input('token')])->find();
		$arr = Db('user_profile')->where(['user_id' =>$res['id']])->find();
		//var_dump($res);
		//var_dump($arr);
		if($arr){
			$result=Db::name('user_profile')->where('user_id', $res['id'])->update(['shoukuan_pic' => input('code_url')]);
		}
		else{
		$data = ['account_name' => input('username'), 'shoukuan_pic' => input('code_url'), 'update_time' => time(),];
		$result=Db::name('user_profile')->insertGetId($data);
		}
		//var_dump($result);die();
		if($result){
			 $this->success('保存成功', '/ls_xls/public/my_setting.html');
		};
	}
	// 存用户身份认证
	public function saleUser(){
        $res = Db('user')->where(['token' =>input('token')])->find();
        $data = array();
        $data['uid']=$res['id'];
        $data['user_name'] = input('realname');
        $data['user_card']    = input('number');
        $data['user_positive']    = input('just');
        $data['user_reverse']    = input('back');
        $data['add_time']    = time();
        if(input('realname')==''){
            $datas['code']=1;
            $datas['msg']='请输入姓名';
            return $datas;
        }
        $status=$this->checkIdCard(input('number'));
        if(!$status){
            $datas['code']=1;
            $datas['msg']='身份证输入错误';
            return $datas;
        }
        if(input('just')==NULL){
            $datas['code']=1;
            $datas['msg']='请上传身份证正面';
            return $datas;
        }
        if(input('back')==NULL){
            $datas['code']=1;
            $datas['msg']='请上传身份证反面';
            return $datas;
        }
        $user_card = Db('user_card')->where(['uid' =>$res['id']])->find();
        if(empty($user_card)){
            $result=Db::name('user_card')->insertGetId($data);
        }else{
            $data_up['user_name'] = input('realname');
            $data_up['user_card']    = input('number');
            $data_up['user_positive']    = input('just');
            $data_up['user_reverse']    = input('back');
            $data_up['add_time']    = time();
            $data_up['status']=0;
            $result=Db::name('user_card')->where(['uid'=>$res['id']])->update($data_up);
        }
        if($result){
            $datas['code']=0;
            $datas['msg']='提交成功';
        }else{
            $datas['code']=1;
            $datas['msg']='提交失败';
        };
        return $datas;
    }
    //验证身份证号码
    function checkIdCard($idcard){
      // 只能是18位
      if(strlen($idcard)!=18){
        return false;
       }
        // 取出本体码
        $idcard_base = substr($idcard, 0, 17);
        // 取出校验码
        $verify_code = substr($idcard, 17, 1);
        // 加权因子
        $factor = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
        // 校验码对应值
        $verify_code_list = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
        // 根据前17位计算校验码
        $total = 0;
        for($i=0; $i<17; $i++){
            $total += substr($idcard_base, $i, 1)*$factor[$i];
        }
        // 取模
        $mod = $total % 11;
        // 比较校验码
        if($verify_code == $verify_code_list[$mod]){
           return true;
        }else{
           return false;
        }
    }
    //获取用户实名信息
    public function getUserCard(){
        $res = Db('user')->where(['token' =>input('token')])->find();
        $user_card = Db('user_card')->where(['uid' =>$res['id']])->find();
        if(empty($user_card)){
            $data['code']=2;
            $data['msg']='未认证';
        }else{
            if($user_card['status']==0){
                $data['code']=1;
                $data['msg']='认证中';
            }elseif($user_card['status']==2){
                $data['code']=0;
                $data['msg']='已驳回';
            }else{
                $data['code']=1;
                $data['msg']='已认证';
            }
        }
        return $data;
    }
    //获取用户收款账号信息
    public function getUserCollection(){
        $res = Db('user')->where(['token' =>input('token')])->find();
        $user_collection = Db::name('user_collection')->where(array('uid' => $res['id']))->find();
        if(empty($user_collection)){
            $data['code']=2;
            $data['msg']='未设置';
        }else{
            $data['code']=1;
            $data['msg']='已设置';

        }
        return $data;
    }
    //获取用户信息 实名信息 收款账号信息
    public function getUserMess(){
        $res = Db('user')->where(['token' =>input('token')])->find();
        $user_collection = Db::name('user_collection')->where(array('uid' => $res['id']))->find();
        $user_card = Db('user_card')->where(['uid' =>$res['id']])->find();
//        $res['username']=substr($res['username'], 0, 3).'****'.substr($res['username'], 7);
        $data['user']=$res;
        $data['user_collection']=$user_collection;
        $data['user_card']=$user_card;
        return $data;
    }
    //获取我的好友 --带html
    public function getMyFriend(){
        $res = Db('user')->where(['token' =>input('token')])->find();
        $firend = Db('user')->where(['invite_id' =>$res['id']])->select();
        $text='';
        if(!empty($firend)){
            foreach ($firend as $k=>$v){
                $user_card = Db('user_card')->where(['uid' =>$v['id']])->find();
                if(!empty($user_card)){
                    $firend[$k]['rel_name']=$user_card['user_name'];
                }
            }
            foreach ($firend as $k=>$v){
                $text.='<div style="display:flex;flex-direction: row;font-size: 14px;border-bottom: 1px solid #4e4e4e;width: 100%">';
                    $text.='<div style="width: 20%;">';
                        if($v['img']!=null){

                        }else{
                            $text.='<img style="width: 1rem; height: 1rem; border-radius: 50%;margin: 16px 0 0 16px;" src="images/logo.png" />';
                        }
                    $text.='</div>';
                        if($v['rel_name']!=null){
                            $text.='<p style="margin: 26px 0 20px 0px;font-size: 16px;color: white;width: 26%">'.$v['rel_name'].'</p>';
                        }else{
                            $text.='<p style="margin: 26px 0 20px 0px;font-size: 16px;color: white;width: 26%">未实名</p>';
                        }
                    $text.='<p style="margin: 26px 0 20px 0px;color: #b5b0b0;width: 25%">'.$v['username'].'</p>';
                    $text.='<p style="margin: 26px 0 20px 0px;color: gray;width: 28%;text-align: center">'.date('Y-m-d',$v['create_time']).'</p>';
                $text.='</div>';
            }
        }else{
            $text.='<div class="no_cont">';
                $text.='<img src="images/empty_img.png" alt=""><p>暂无相关数据</p>';
            $text.='</div>';
        }


       return $text;
    }
    //获取用户是否实名
    public function getUserIsSm(){
        $res = Db('user')->where(['token' =>input('token')])->find();
        $user_card = Db('user_card')->where(['uid' =>$res['id']])->find();
        if(empty($user_card)){
            $data['code']=0;
            $data['msg']='请先进行实名认证';
            return $data;
        }else{
            if($user_card['status']==0){
                $data['code']=0;
                $data['msg']='请先进行实名认证';
                return $data;
            }else{
                $data['code']=1;
                $data['msg']='已认证';
                return $data;
            }
        }

    }
    //获取用户是否上传收款信息
    public function getUserIsCollection(){
        $res = Db('user')->where(['token' =>input('token')])->find();
        $user_card = Db('user_collection')->where(['uid' =>$res['id']])->find();
        $user_collection = Db('user_card')->where(['uid' =>$res['id']])->find();
        if(empty($user_card) && empty($user_collection)){
            $data['code']=0;
            $data['msg']='请先实名认证及设置收款方式';

        }else{
            if(empty($user_card) && !empty($user_collection)){
                $data['code']=0;
                $data['msg']='请先实名认证';
            }else{
                if($user_card['status']==0){
                    $data['code']=0;
                    $data['msg']='等待审核，通过后可众筹';
                }else{
                    $data['code']=1;
                    $data['msg']='已认证';
                }
            }
            if(empty($user_collection) && !empty($user_card)){
                $data['code']=0;
                $data['msg']='请先设置收款方式';
            }else{
                $data['code']=1;
                $data['msg']='已设置';
            }
            if(!empty($user_collection) && !empty($user_card)){
                $data['code']=1;
                $data['msg']='已设置';
            }

        }
        return $data;

    }
    //获取用户激活债务计划（上级+9级）--页面1
    public function getUserPlan(){
        $res = Db('user')->where(['token' =>input('token')])->find();
        $user_parent_plan= Db('zcplan_plan')->where(['uid' =>$res['id']])->select();
        $outStr='';
        $total=0;
        foreach ($user_parent_plan as $k=>$v){
            if($v['pay_img']!='' && $v['status']==1){
                $total+=1;
            }
            $outStr.='<div style="display: flex;flex-direction: row;height: 60px;background-color: #343c6d;width: 100%;border-bottom: 1px solid #535358;">';
                if($v['get_avater']==''){
                    $outStr.=' <img src="images/logo.png" id="parent_img" style="width: 40px;height: 40px;border-radius: 20px;margin: 10px">';
                }else{
                    $outStr.=' <img src="'.$v['get_avater'].'" id="parent_img" style="width: 40px;height: 40px;border-radius: 20px;margin: 10px">';
                }
                if($v['get_user_name']==''){
                    $outStr.='<p style="font-size: 14px;color: white;line-height: 40px;width:20%;margin: 10px;" id="parent_name"></p>';
                }else{
                    $outStr.='<p style="font-size: 14px;color: white;line-height: 40px;width:20%;margin: 10px;" id="parent_name">'.$v['get_user_name'].'</p>';
                }
                $outStr.='<p style="font-size: 14px;color: #35BFFD;line-height: 40px;width: 20%;margin: 10px;">￥'.$v['money'].'</p>';
                $outStr.='<p style="margin: 10px 10px 10px 40px;width: 24%">';
                if($v['pay_status']==1){
                    if($v['status']==1) {
                        $outStr .= '<a onclick="gotoPay(' . $v['id'] . ')" style="display: block; padding: .35rem; color: #bacbea; font-size: .41rem; background: url(images/icon_more.png) no-repeat 96% center;background-size: .24rem auto;">已确认</a>';
                    }else{
                        $outStr .= '<a onclick="gotoPay(' . $v['id'] . ')" style="display: block; padding: .35rem; color: #bacbea; font-size: .41rem; background: url(images/icon_more.png) no-repeat 96% center;background-size: .24rem auto;">待确认</a>';
                    }
                }else{
                    $outStr.='<a onclick="gotoPay('.$v['id'].')" style="display: block; padding: .35rem; color: #bacbea; font-size: .41rem; background: url(images/icon_more.png) no-repeat 96% center;background-size: .24rem auto;">未付款</a>';
                }
                $outStr.='</p>';
            $outStr.='</div>';
        }
        $user_down = Db('user')->where(['invite_id' =>$res['id']])->limit(0,3)->select();
        $outStr.='<div style="font-size: 16px;color: #bacbe8;margin: 20px 0 10px 10px;">寻找还款人任务(<span>0</span>/3)</div>';
        foreach ($user_down as $k=>$v){
            $v['username']=substr($v['username'], 0, 3).'****'.substr($v['username'], 7);
            $outStr.='<div style="display: flex;flex-direction: row;height: 60px;background-color: #343c6d;width: 100%;border-bottom: 1px solid #535358;">';
                    $outStr.='<img src="images/logo.png" style="width: 40px;height: 40px;border-radius: 20px;margin: 10px">';
                    $outStr.='<p style="font-size: 14px;color: #35BFFD;line-height: 40px;width: 54%;margin: 10px;text-align: center">'.$v['username'].'</p>';
                    $outStr.='<p style="font-size: 14px;color: #BACBEA;line-height: 40px;width: 28%;margin: 10px;">未激活债务</p>';
            $outStr.='</div>';
        }
        $data['total']=$total;
        $data['list']=$outStr;
        return $data;
    }
    //获取用户激活债务计划（上级+9级）--页面2
    public function getUserPlanT(){
        $res = Db('user')->where(['token' =>input('token')])->find();
        $user_parent_plan= Db('zcplan_plan')->where(['uid' =>$res['id'],'type'=>1])->select();
        $outStr='';
        foreach ($user_parent_plan as $k=>$v){
            $v['get_user_card']=substr($v['get_user_card'], 0, 4).'**********'.substr($v['get_user_card'], 14);
            $outStr.='<div style="width: 90%;margin: 50px auto;background-color:#343c6d;height: 100px">';
                if($v['get_user_name']==''){
                    $outStr.='<div style="font-size: 15px;padding: 10px;color: #808a9c;">姓名：<span id="parent_names"></span></div>';
                }else{
                    $outStr.='<div style="font-size: 15px;padding: 10px;color: #808a9c;">姓名：<span id="parent_names">'.$v['get_user_name'].'</span></div>';
                }
                $outStr.='<div style="font-size: 15px;padding:0 0 28px 10px;color: #808a9c;">身份证：<span id="parent_cards">'.$v['get_user_card'].'</span></div>';
                $outStr.='<div style="display: flex;flex-direction: row;background-color: #49497b;">';
                    $outStr.='<div style="font-size: 14px;margin: 10px;color: #808a9c;">借款金额：<span style="color: #35BFFD">'.$v['money'].'</span></div>';
                    if($v['pay_status']==1){
                        if($v['status']==1){
                            $outStr.='<div onclick="gotoPay('.$v['id'].')" style="margin-left: 34%;"><button style="width: 80px;height: 26px;background-color: #35BFFD;border-radius: 4px;">已确认</button></div>';
                        }else{
                            $outStr.='<div onclick="gotoPay('.$v['id'].')" style="margin-left: 34%;"><button style="width: 80px;height: 26px;background-color: #35BFFD;border-radius: 4px;">待确认</button></div>';
                        }
                    }else{
                        $outStr.='<div onclick="gotoPay('.$v['id'].')" style="margin-left: 34%;"><button style="width: 80px;height: 26px;background-color: #35BFFD;border-radius: 4px;">未打款</button></div>';
                    }
                $outStr.='</div>';
            $outStr.='</div>';
        }
        $data['list']=$outStr;
        return $data;
    }
    //点击激活后插入债务信息（上级+9级） ---上级
    public function addPlanUser(){
        $res = Db('user')->where(['token' =>input('token')])->find();
        if($res['level']<10){
            $upLevel=$res['level']+1;
        }else{
            $upLevel=$res['level'];
        }
        $user_parent_plan= Db('zcplan_plan')->where(['uid' =>$res['id']])->find();
        if(empty($user_parent_plan)){
            $result=$this->addPlanUserParent($res['invite_id'],$res['id'],$upLevel);
            if($result){
                $status=$this->addPlanUserUp9($res['invite_id'],$res['id'],$upLevel);
                return $status;
            }
        }
        return 1;

    }
    //点击激活后插入债务信息--找上级（已激活）
    public function addPlanUserParent($invite_id,$id,$upLevel){
        $user_parent = Db('user')->where(['id' =>$invite_id])->field('id,invite_id,username,level,activate')->find();
        if($user_parent['activate']==1){
            $user_parent_card = Db('user_card')->where(['uid' =>$invite_id])->field('user_name,user_card')->find();
            $user_parent_collection= Db('user_collection')->where(['uid' =>$invite_id])->field('user_account,user_erwei')->find();
            $user_plan= Db('zcplan')->where(['uid' =>$invite_id])->find();
            $user_plan_list= Db('zcplan_list')->where(['zcplan_id' =>$user_plan['Id']])->select();
            $plan=0;
            foreach ($user_plan_list as $k=>$v){
                if(($v['demand']==0 || $v['demand']<$v['set_demand']) && $v['status']==1){
                    $plan=$v['id'];
                }
            }
            $data=array();
            $data['uid']=$id;
            $data['get_uid']=$user_parent['id'];
            $data['get_avater']='';
            $data['get_user_name']=$user_parent_card['user_name'];
            $data['get_user_card']=$user_parent_card['user_card'];
            $data['get_erwei']=$user_parent_collection['user_erwei'];
            $data['get_account']=$user_parent_collection['user_account'];
            $data['money']=200;
            $data['type']=1;
            $data['add_time']=time();
            $data['phase']=$plan;
            $data['level']=$upLevel;
            $result=Db::name('zcplan_plan')->insertGetId($data);
            return $result;
        }else{
            $user=$this->addPlanUserParent($user_parent['invite_id'],$id);
            return $user;
        }
    }
	
	 //点击激活后插入债务信息--找上级（已激活）
    public function addPlanUserParent2($invite_id,$id,$upLevel){
        $user_parent = Db('user')->where(['id' =>$invite_id])->field('id,invite_id,username,level,activate')->find();
        //查找记录
		$user_parent_plan= Db('zcplan_plan')->where(['uid' =>$res['id'],'type'=>2,'level'=>$upLevel])->find();
		
		if(count($user_parent_plan)==0){
			if($user_parent['activate']==1){
				$user_parent_card = Db('user_card')->where(['uid' =>$invite_id])->field('user_name,user_card')->find();
				$user_parent_collection= Db('user_collection')->where(['uid' =>$invite_id])->field('user_account,user_erwei')->find();
				$user_plan= Db('zcplan')->where(['uid' =>$invite_id])->find();
				$user_plan_list= Db('zcplan_list')->where(['zcplan_id' =>$user_plan['Id']])->select();
				$plan=0;
				foreach ($user_plan_list as $k=>$v){
					if(($v['demand']==0 || $v['demand']<$v['set_demand']) && $v['status']==1){
						$plan=$v['id'];
					}
				}
				$data=array();
				$data['uid']=$id;
				$data['get_uid']=$user_parent['id'];
				$data['get_avater']='';
				$data['get_user_name']=$user_parent_card['user_name'];
				$data['get_user_card']=$user_parent_card['user_card'];
				$data['get_erwei']=$user_parent_collection['user_erwei'];
				$data['get_account']=$user_parent_collection['user_account'];
				$data['money']=200;
				$data['type']=2;
				$data['add_time']=time();
				$data['phase']=$plan;
				$data['level']=$upLevel;
				$result=Db::name('zcplan_plan')->insertGetId($data);
				return $result;
			}else{
				$user=$this->addPlanUserParent2($user_parent['invite_id'],$id);
				return $user;
			}
		}
    }
    //点击激活后插入债务信息（上级+9级） ---找9级
    public function addPlanUserUp9($invite_id,$id,$upLevel){
        $res = Db('user')->where(['id' =>$invite_id])->field('id,invite_id,username,level')->find();

        if($res['level']==10){
            $user_parent_card = Db('user_card')->where(['uid' =>$invite_id])->field('user_name,user_card')->find();
            $user_parent_collection= Db('user_collection')->where(['uid' =>$invite_id])->field('user_account,user_erwei')->find();
            $user_plan= Db('zcplan')->where(['uid' =>$invite_id])->find();
            $user_plan_list= Db('zcplan_list')->where(['zcplan_id' =>$user_plan['Id']])->select();
            $plan=0;
            foreach ($user_plan_list as $k=>$v){
                if(($v['demand']==0 || $v['demand']<$v['set_demand']) && $v['status']==1){
                    $plan=$v['id'];
                }
            }
            $data=array();
            $data['uid']=$id;
            $data['get_uid']=$res['id'];
            $data['get_avater']='';
            $data['get_user_name']=$user_parent_card['user_name'];
            $data['get_user_card']=$user_parent_card['user_card'];
            $data['get_erwei']=$user_parent_collection['user_erwei'];
            $data['get_account']=$user_parent_collection['user_account'];
            $data['money']=200;
            $data['type']=1;
            $data['add_time']=time();
            $data['phase']=$plan;
            $data['level']=$upLevel;
            $result=Db::name('zcplan_plan')->insertGetId($data);
            return $result;
        }else{
            $user=$this->addPlanUserUp9($res['invite_id'],$id);
            return $user;
        }

    }
    //获取用户下级
    public function getUserDown(){
        $res = Db('user')->where(['token' =>input('token')])->find();
        $user_down = Db('user')->where(['invite_id' =>$res['id']])->field('id,invite_id,username,level,create_time')->select();
        if(!empty($user_down)){
            foreach ($user_down as $k=>$v){
                $user_down[$k]['create_time']=date('Y-m-d H:i:s',$v['create_time']);
                $user_down_card = Db('user_card')->where(['uid' =>$v['id']])->field('user_name,user_card')->find();
                if(!empty($user_down_card)){
                    $user_down[$k]['user_name']=$user_down_card['user_name'];
                    $user_down[$k]['user_card']=$user_down_card['user_card'];
                }

            }
        }
        $data['total']=count($user_down)>3?3:count($user_down);
        $data['down_list']=$user_down;
        return $data;
    }
    //获取已激活下级
    public function getIsJhUser(){
        $res = Db('user')->where(['token' =>input('token')])->find();
        $user_down = Db('user')->where(['invite_id' =>$res['id'],'activate'=>1])->field('id,username')->select();
        $level=$res['level'];
        $up_down=0;
        switch ($level){
            case 2:
                $up_down=3;
                break;
            case 3:
                $up_down=9;
                break;
            case 4:
                $up_down=27;
                break;
            case 5:
                $up_down=81;
                break;
            case 6:
                $up_down=243;
                break;
            case 7:
                $up_down=729;
                break;
            case 8:
                $up_down=2187;
                break;
            case 9:
                $up_down=6561;
                break;
        }
		//var_dump($user_down);
		//exit;
        if(empty($user_down)){
            $data['code']=0;
            $data['msg']='你的激活下线不满'.$up_down.'个(0/'.$up_down.')，请邀请好友激活';
        }if(count($user_down)<$up_down){
            $data['code']=0;
            $data['msg']='你的激活下线不满'.$up_down.'个('.count($user_down).'/'.$up_down.')，请邀请好友激活';
        }else{
            $data['code']=1;
            $data['msg']='你的激活下线已满'.$up_down.'个('.count($user_down).'/'.$up_down.')，是否申请升级';
        }
        return $data;
    }
    //通过id  获取当前债务信息
    public function getPayMess(){
        $user_parent_plan= Db('zcplan_plan')->where(['id' =>input('pay_id')])->find();
        $user= Db('user')->where(['id' =>$user_parent_plan['uid']])->find();
        $user_parent_plan['get_user_card']=substr($user_parent_plan['get_user_card'], 0, 4).'**********'.substr($user_parent_plan['get_user_card'], 14);
        $user_parent_plan['token']=$user['token'];
        return $user_parent_plan;
    }
    //上传债务信息
    public function payPlan(){
        $user_parent_plan= Db('zcplan_plan')->where(['id' =>input('pay_id')])->find();
        if(empty($user_parent_plan)){
            $data['code']=0;
            $data['msg']='该付款订单不存在，请刷新';
            return $data;
        }else{
            if($user_parent_plan['pay_status']==1){
                $data['code']=0;
                $data['msg']='该付款订单已提交信息，等待审核';
                return $data;

            }
            if($user_parent_plan['status']==1){
                $data['code']=0;
                $data['msg']='该付款订单已通过审核，无需提交';
                return $data;
            }

            $data_plan=array();
            $data_plan['pay_img']=input('pay_img');
            $data_plan['get_time']=time();
            $data_plan['pay_status']=1;
            $result=Db::name('zcplan_plan')->where(['id'=>input('pay_id')])->update($data_plan);
            if($result){
                $data['code']=1;
                $data['msg']='提交成功';
            }else{
                $data['code']=0;
                $data['msg']='提交失败';
            };
            $data['type']=$user_parent_plan['type'];
            return $data;
        }
    }
    public function getPayList(){
        $res = Db('user')->where(['token' =>input('token')])->find();
        $user_parent_plan= Db('zcplan_plan')->where(['get_uid' =>$res['id']])->order('pay_status ASC')->select();
        $outStr='';
        foreach ($user_parent_plan as $k=>$v){
            $user = Db('user')->where(['id' =>$v['uid']])->find();
            $user_card = Db('user_card')->where(['uid' =>$v['uid']])->field('user_name,user_card')->find();

            $outStr.='<div style="display: flex;flex-direction: row;height: 60px;background-color: #343c6d;width: 100%;border-bottom: 1px solid #535358;">';
            if($user['avater']==''){
                $outStr.=' <img src="images/logo.png" id="parent_img" style="width: 40px;height: 40px;border-radius: 20px;margin: 10px">';
            }else{
                $outStr.=' <img src="'.$user['avater'].'" id="parent_img" style="width: 40px;height: 40px;border-radius: 20px;margin: 10px">';
            }
            if($user_card['user_name']==''){
                $outStr.='<p style="font-size: 14px;color: white;line-height: 40px;width:20%;margin: 10px;" id="parent_name"></p>';
            }else{
                $outStr.='<p style="font-size: 14px;color: white;line-height: 40px;width:20%;margin: 10px;" id="parent_name">'.$user_card['user_name'].'</p>';
            }
            $outStr.='<p style="font-size: 14px;color: #35BFFD;line-height: 40px;width: 20%;margin: 10px;">￥'.$v['money'].'</p>';
            $outStr.='<p style="margin: 10px 10px 10px 40px;width: 24%">';
            if($v['pay_status']==1){
                if($v['status']==1) {
                    $outStr .= '<a onclick="gotoPay(' . $v['id'] . ')" style="display: block; padding: .35rem; color: #35BFFD; font-size: .41rem; background: url(images/icon_more.png) no-repeat 96% center;background-size: .24rem auto;">已收款</a>';
                }else{
                    $outStr .= '<a onclick="gotoPay(' . $v['id'] . ')" style="display: block; padding: .35rem; color: #bacbea; font-size: .41rem; background: url(images/icon_more.png) no-repeat 96% center;background-size: .24rem auto;">已打款</a>';
                }
            }else{
                $outStr.='<a onclick="gotoPay('.$v['id'].')" style="display: block; padding: .35rem; color: #bacbea; font-size: .41rem; background: url(images/icon_more.png) no-repeat 96% center;background-size: .24rem auto;">未打款</a>';
            }
            $outStr.='</p>';
            $outStr.='</div>';
        }
        return $outStr;
    }
    //确认打款信息
    public function Confirm_receipt(){


        $user_plan= Db('zcplan_plan')->where(['id' =>input('plan_id')])->find();
        if(empty($user_plan)){
            $data['code']=0;
            $data['msg']='该付款订单不存在，请刷新';
            return $data;
        }else{
            if($user_plan['status']==1){
                $data['code']=0;
                $data['msg']='已确认收款';
                return $data;
            }
            $data_plan=array();
            $data_plan['status']=1;
            $result_plan=Db::name('zcplan_plan')->where(['id'=>input('plan_id')])->update($data_plan);

            if($user_plan['type']==2){
                $user_next_plan= Db('zcplan_list')->where(['uid' =>$user_plan['uid'],'status'=>0])->find();
				$data_1['level']=$user_plan['level'];
				Db::name('user')->where(['id'=>$user_plan['uid']])->update($data_1);//新增
                if(!empty($user_next_plan)){
                    $a=Db::name('zcplan_list')->where(['id'=>$user_next_plan['id']])->update(array('status'=>1));
                }
            }else{
                $where=array();
                $where['id']=array('neq',input('plan_id'));
                $where['uid']=array('eq',$user_plan['uid']);
                $user_other_plan= Db('zcplan_plan')->where($where)->find();
                if($user_other_plan['status']==1){
                    Db::name('user')->where(['id'=>$user_plan['uid']])->update(array('activate'=>1,'level'=>2));
                }
            }

            $user_plan_list= Db('zcplan_list')->where(['id' =>$user_plan['phase']])->find();
            $data_plan_list=array();
            $data_plan_list['demand']=$user_plan_list['demand']+$user_plan['money'];

            if($user_plan_list['demand']==$user_plan_list['set_demand']){
                $data_plan_list['status']=2;
            }
            if($result_plan){
                $result=Db::name('zcplan_list')->where(['id'=>$user_plan['phase']])->update($data_plan_list);
                if($result){
                    $data['code']=1;
                    $data['msg']='收款成功';
                }else{
                    $data['code']=0;
                    $data['msg']='收款失败';
                };
            }else{
                $data['code']=0;
                $data['msg']='收款失败';
            }

            return $data;
        }
    }
    //插入升级信息
    public function addUpgradeMess(){
        $res = Db('user')->where(['token' =>input('token')])->find();
        if($res['level']<10){
            $upLevel=$res['level']+1;
        }else{
            $upLevel=$res['level'];
        }
        $user_parent_plan= Db('zcplan_plan')->where(['uid' =>$res['id'],'type'=>2,'level'=>$upLevel])->find();
        $user_parent = Db('user')->where(['id' =>$res['invite_id']])->field('id,invite_id,username,level,activate')->find();
        $user_parent_up = Db('user')->where(['id' =>$user_parent['invite_id']])->field('id,invite_id,username,level,activate')->find();
        if(empty($user_parent_plan)){
			
            if($user_parent_up['level']==$upLevel){
				
                $user_parent_card = Db('user_card')->where(['uid' =>$user_parent_up['invite_id']])->field('user_name,user_card')->find();
                $user_parent_collection= Db('user_collection')->where(['uid' =>$user_parent_up['invite_id']])->field('user_account,user_erwei')->find();
                $user_plan= Db('zcplan')->where(['uid' =>$user_parent_up['invite_id']])->find();
                $user_plan_list= Db('zcplan_list')->where(['zcplan_id' =>$user_plan['Id']])->select();
                $plan=0;
                foreach ($user_plan_list as $k=>$v){
                    if(($v['demand']==0 || $v['demand']<$v['set_demand']) && $v['status']==1){
                        $plan=$v['id'];
                    }
                }
                $data=array();
                $data['uid']=$res['id'];
                $data['get_uid']=$user_parent_up['id'];
                $data['get_avater']='';
                $data['get_user_name']=$user_parent_card['user_name'];
                $data['get_user_card']=$user_parent_card['user_card'];
                $data['get_erwei']=$user_parent_collection['user_erwei'];
                $data['get_account']=$user_parent_collection['user_account'];
                $data['money']=200;
                $data['type']=2;
                $data['add_time']=time();
                $data['phase']=$plan;
                $data['level']=$upLevel;
                $result=Db::name('zcplan_plan')->insertGetId($data);
            }else{
				
                //$result=$this->addUpUserParent($user_parent_up['invite_id'],$res['id'],$upLevel);
				$result=$this->addUpUserParent($user_parent['id'],$res['id'],$upLevel);
				
            }
            if($result){
                $datas['code']=1;
            }else{
                $datas['code']=0;
            }
        }else{
            $datas['code']=0;
        }
        return $datas;
    }
    public function addUpUserParent($invite_id,$id,$level){
        $user_parent = Db('user')->where(['id' =>$invite_id])->field('id,invite_id,username,level,activate')->find();
        $user_parent_plan= Db('zcplan_plan')->where(['uid' =>$id,'type'=>2,'level'=>$level])->find();
        if(empty($user_parent_plan)){
           /* var_dump($user_parent['invite_id']);
			var_dump($id);
			var_dump($level);
			var_dump($user_parent['level']);
			exit; */
			if($level<10){

                $user_parent_card = Db('user_card')->where(['uid' =>$invite_id])->field('user_name,user_card')->find();
                $user_parent_collection= Db('user_collection')->where(['uid' =>$invite_id])->field('user_account,user_erwei')->find();
                $user_plan= Db('zcplan')->where(['uid' =>$invite_id])->find();
                $user_plan_list= Db('zcplan_list')->where(['zcplan_id' =>$user_plan['Id']])->select();
                $plan=0;
                foreach ($user_plan_list as $k=>$v){
                    if(($v['demand']==0 || $v['demand']<$v['set_demand']) && $v['status']==1){
                        $plan=$v['id'];
                    }
                }
                $data=array();
                $data['uid']=$id;
                $data['get_uid']=$user_parent['id'];
                $data['get_avater']='';
                $data['get_user_name']=$user_parent_card['user_name'];
                $data['get_user_card']=$user_parent_card['user_card'];
                $data['get_erwei']=$user_parent_collection['user_erwei'];
                $data['get_account']=$user_parent_collection['user_account'];
                $data['money']=200;
                $data['type']=2;
                $data['add_time']=time();
                $data['phase']=$plan;
                $data['level']=$level;
                $result=Db::name('zcplan_plan')->insertGetId($data);
                return $result;
            }else{
				
                $user=$this->addUpUserParent($user_parent['invite_id'],$id,$level);
                return $user;
            }
        }else{
            return false;
        }

    }
    //获取升级信息
    public function getUpgradeMess(){
        $res = Db('user')->where(['token' =>input('token')])->find();
        $user_parent_plan= Db('zcplan_plan')->where(['uid' =>$res['id'],'type'=>2])->select();
        $outStr='';
        foreach ($user_parent_plan as $k=>$v){
            $v['get_user_card']=substr($v['get_user_card'], 0, 4).'**********'.substr($v['get_user_card'], 14);
            $outStr.='<div style="width: 90%;margin: 50px auto;background-color:#343c6d;height: 100px">';
            if($v['get_user_name']==''){
                $outStr.='<div style="font-size: 15px;padding: 10px;color: #808a9c;">姓名：<span id="parent_names"></span></div>';
            }else{
                $outStr.='<div style="font-size: 15px;padding: 10px;color: #808a9c;">姓名：<span id="parent_names">'.$v['get_user_name'].'</span></div>';
            }
            $outStr.='<div style="font-size: 15px;padding:0 0 28px 10px;color: #808a9c;">身份证：<span id="parent_cards">'.$v['get_user_card'].'</span></div>';
            $outStr.='<div style="display: flex;flex-direction: row;background-color: #49497b;">';
            $outStr.='<div style="font-size: 14px;margin: 10px;color: #808a9c;">借款金额：<span style="color: #35BFFD">'.$v['money'].'</span></div>';
            if($v['pay_status']==1){
                if($v['status']==1){
                    $outStr.='<div onclick="gotoPay('.$v['id'].')" style="margin-left: 34%;"><button style="width: 80px;height: 26px;background-color: #35BFFD;border-radius: 4px;">已确认</button></div>';
                }else{
                    $outStr.='<div onclick="gotoPay('.$v['id'].')" style="margin-left: 34%;"><button style="width: 80px;height: 26px;background-color: #35BFFD;border-radius: 4px;">待确认</button></div>';
                }
            }else{
                $outStr.='<div onclick="gotoPay('.$v['id'].')" style="margin-left: 34%;"><button style="width: 80px;height: 26px;background-color: #35BFFD;border-radius: 4px;">未打款</button></div>';
            }
            $outStr.='</div>';
            $outStr.='</div>';
        }
        $data['list']=$outStr;
        return $data;
    }
}
