<?php

namespace sms\ttsms;
/**
 * 天天短信
 * @author zjb
 */
class Ttsms {

    private $config;

    public function __construct($config) {
        $this->config = $config;
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
     * 天天发送短信
     * @param type $phone
     */
    public function send($phone, $content) {
        $msg = $content;
        if(strpos($phone,"+")!==0){
            $phone = "+86".$phone;
        }
        $data = array(
            'src' => $this->config['src'], // 你的用户名, 必须有值
            'pwd' => $this->config['pwd'], // 你的密码, 必须有值
            'ServiceID' => 'SEND', //固定，不需要改变
            'dest' => $phone, // 你的目的号码【收短信的电话号码】, 必须有值
            'sender' => '', // 你的原号码,可空【大部分国家原号码带不过去，只有少数国家支持透传，所有一般为空】
            'codec' => '8', // 编码方式， 与msg中encodeHexStr 对应
            // codec=8 Unicode 编码,  3 ISO-8859-1, 0 ASCII
            'msg' => $this->encodeHexStr(8, $msg) // 编码短信内容
        );
        $uri = "http://210.51.190.233:8085/mt/mt3.ashx"; // 接口地址
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $uri);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $return = curl_exec($ch); //$return  返回结果，如果是以 “-” 开头的为发送失败，请查看错误代码，否则为MSGID
        curl_close($ch);
      
        write_log('sms_tt', ['data' => $data, 'return' => $return]);
        $res = $this->result_deal($return);
        return $res;
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
