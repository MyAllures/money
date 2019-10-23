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

namespace app\common\logic;

use \app\api\controller\Base;
//use app\common\logic\ReturnCode;
use think\Db;

/**
 * 发送短信逻辑
 */
class Sms extends Base {

    /**
     * 验证码验证
     * @param string $code_type 验证码类型
     * @param string $phone 手机号码
     * @param string $code 验证码
     * @return boolean true验证成功 false 验证失败
     */
    public function checkSendCode($code_type, $phone, $code) {

        if (!$phone || !$code) {
            $this->buildFailed('手机号或者短信验证码不能为空');
        }
        if (config('sms_is_test') == 1) {//测试验证码
            return true;
        }
        //验证有效性
        $code_log = Db::name('code_log')->where(array('account' => $phone, 'code_type' => $code_type))->order('create_time desc')->find();

        if (!$code_log) {//无此验证码
            $this->buildFailed('验证码不存在');
        }
        if ($code_log['expire_time'] > 0 && time() > $code_log['expire_time']) {//验证码过期
            $this->buildFailed('验证码过期');
        }
        if ($code_log['code'] != $code) {
            $this->buildFailed('验证码不正确');
        }
        return true;
    }

    public function send($phone, $code_type) {
        $set = Db::name('sms_set')->where(['status' => '1'])->find(); //这里可做缓存加速
        if (empty($set)) {
            $this->buildFailed('短信接口未配置');
        }
        $sms_type = $set['type'];
        if (empty($code_type)) {
            $this->buildFailed('类型不能为空');
        }
        $count = Db::name('CodeLog')->where(array('account' => $phone, 'code_type' => $code_type, 'create_time' => array('gt', time() - 3600 * config('sms_count_hour'))))->count(); //上次发送时间
        if ($count >= config('sms_count')) {
            $this->buildFailed('发送过于频繁，请稍后再试。');
        }
        $where_ip['ip'] = request()->ip();
        $where_ip['create_time'] = ['between', [time() - config('sms_count_ip_hour') * 3600, time()]];
        $count_ip = Db::name('CodeLog')->where($where_ip)->count();
        if ($count_ip >= config('sms_count_ip')) {
            $this->buildFailed('同一IP内发送过于频繁，请稍后再试。');
        }
        $config = json_decode($set['data'], true);
        if (!method_exists($this, $sms_type)) {
            $this->buildFailed('短信接口未实现');
        }
        if (config('sms_is_test') == '1') {
            $rand = config('sms_test_code');
            $this->send_succes($phone, $rand, $code_type);
        } else {
            $rand = rand(100000, 999999);
			
			
			
			
			
			
			
			
			$text="验证码：".$rand;
			$encoded_text = urlencode($text);
			$mobile = trim($phone);
			$statusStr = array(
			"0" => "短信发送成功",
			"-1" => "参数不全",
			"-2" => "服务器空间不支持,请确认支持curl或者fsocket，联系您的空间商解决或者更换空间！",
			"30" => "密码错误",
			"40" => "账号不存在",
			"41" => "余额不足",
			"42" => "帐户已过期",
			"43" => "IP地址限制",
			"50" => "内容含有敏感词"
			);
			$content=$text;//要发送的短信内容
			$phone = $mobile;//要发送短信的手机号码
			
			$sendurl="http://utf8.api.smschinese.cn/?Uid=364261002@qq.com&Key=a369841d8cd98f00b204&smsMob=".$phone."&smsText=".urlencode($content);

			
			$result =file_get_contents($sendurl);
			
			
			
			if($result=="1"){
				//成功
				$this->send_succes($phone, $rand, $code_type);
			}else{
				//失败
				$this->buildFailed('发送失败,稍后再试'.$result);
			}
			
			return;
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
            $res = $this->$sms_type($phone, $rand, $config); //返回格式{ status=true 成功，其他失败，rand=随机数}
            if ($res === true) {//成功
                $this->send_succes($phone, $rand, $code_type);
            } else {
                $this->buildFailed('发送失败,稍后再试');
            }
        }
    }

    /**
     * 
     * @param type $phone
     * @param type $code_type
     * @return array
     */
    public function send_succes($phone, $code_rand, $code_type) {
        $time = time();
        $expire_time = config('sms_expire_time');
        //添加发送记录
        $code_log_data = array(
            'account' => $phone,
            'code_type' => $code_type,
            //   'code' => $code_rand,
            'code' => $code_rand,
            'send_status' => intval($send_status),
            'create_time' => $time,
            'expire_time' => $time + $expire_time,
            'ip' => request()->ip(),
        );
        $res = Db::name('CodeLog')->insert($code_log_data);
        if (!$res) {
            $this->buildFailed('系统繁忙，请稍后再试');
        }
        $this->buildSuccess(['time' => $expire_time]);
    }

    public function encodeHexStr($dataCoding, $realStr) {
        if ($dataCoding == 15) {
            return strtoupper(bin2hex(iconv('UTF-8', 'GBK', $realStr)));
        } else if ($dataCoding == 3) {
            return strtoupper(bin2hex(iconv('UTF-8', 'ISO-8859-1', $realStr)));
        } else if ($dataCoding == 8) {
            return strtoupper(bin2hex(iconv('UTF-8', 'UCS-2BE', $realStr)));
        } else {
            return strtoupper(bin2hex(iconv('UTF-8', 'ASCII', $realStr)));
        }
    }

    /**
     * 发送短信
     * @param type $phone
     * @param type $content
     */
    public function sms_send($phone, $content, $type = '') {

        if(empty($phone)){
            return false;
        }
        if(!$content){
            return false;
        }
        
        //默认处理天天短信
        if (empty($type)) {
            $set = Db::name('sms_set')->where(['status' => '1'])->find();
        } else {
            $set = Db::name('sms_set')->where(['status' => '1', 'type' => $type])->find();
        }
        if (!$set) {
            return false; //没有这样的短信类型
        }

        $type = $set['type'];
        $config = json_decode($set['data'], true);
        $send_result = 0;
        $is_send = 0;
        if(config('sms_switch')==1){
            $is_send = 1;
        }
       
        //发送短信
        switch ($type) {
            case 'sms_tt':
                if (empty($config)) {
                    return false; //配置有误
                }
                //获取天天短信配置
                if($is_send == 1){
                    $set = Db::name('sms_set')->where(['status' => '1'])->find(); //这里可做缓存加速
                    $res = $this->sms_tt_send($phone, $content, $config);
                    if($res===true){
                        $send_result = 1;
                    }else{
                        $send_result = 2;
                    }                }
                break;
            default:
                break;
        }
        
        $is_success = false;
        if($send_result==0 || $send_result==1){
            $is_success = true;
        }

        //添加短信记录
        $data=[
            'phone'=>$phone,
            'content'=>$content,
            'status'=>$send_result ,
            'create_time'=>TIME_NOW
        ];
        $res_log = Db::name('SmsLog')->insert($data);
        if($res_log && $is_success){
            return true;
        }else{
            return false;
        }

        //发送短信
    }

    /**
     * 发送短信（天天短信）
     * @param type $phone
     * @param type $content
     * @param type $config
     */
    public function sms_tt_send($phone, $content, $config) {
        $Ttsms = new \sms\ttsms\Ttsms($config);
        $res = $Ttsms->send($phone, $content);
        if ($res === true) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 天天发送短信（验证码）
     * @param type $phone
     */
    public function sms_tt($phone, $rand, $config) {
        $msg = $config['msg'];
        $msg = str_replace('#code#', $rand, $msg);

        $res = $this->sms_tt_send($phone, $msg, $config);//发送天天短信内容
        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    public function result_deal($code) {
        switch ($code) {
            case "0":
                return true;
            case "-01":
                return false;
            case "-02":
                return false;
            case "-03":
                return false;
            case "-04":
                return false;
            case "-05":
                return false;
            case "-06":
                return false;
            case "-07":
                return false;
            case "-08":
                return false;
            case "-09":
                return false;
            case "-10":
                return false;
            case "-11":
                return false;
            case "-12":
                return false;
            case "-13":
                return false;
            case "-14":
                return false;
            case "-15":
                return false;
            case "-16":
                return false;
            case "-17":
                return false;
            case "-18":
                return false;
            case "-19":
                return false;
            case "-20":
                return false;
        }
        return true;
    }

}
