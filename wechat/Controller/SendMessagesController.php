<?php
App::uses('AppController', 'Controller');
/**
 * Created by Xiao.
 * Date: 2017/5/19
 * email: via_chen@126.com
 */
App::import('Vendor', 'alidayu/TopSdk');

class SendMessagesController extends AppController
{
    //发送短信
    public function send_sms()
    {
        $this->autoRender=false;
        if(!$this->request->is('ajax')){
            return $this->redirect($this->referer());
        }
        $phone=$this->request->data['phone'];//匹配号码是否正确
        $reg_phone='/^(13\d|14[579]|15\d|17[01235678]|18\d)\d{8}$/i';
        if(preg_match($reg_phone,$phone)==0){
            return json_encode(array('success'=>2,'msg'=>'请填写正确的电话号码!'));
        }
        $from=$this->request->data['from'];
        if($from=='bind_user'){
            $this->loadModel('WxUsers');
            //判断手机号是否已使用
            $is_use=$this->WxUsers->find('count',array('conditions'=>array('phone'=>$phone)));
            if($is_use!=0){
                return json_encode(array('success'=>2,'msg'=>'该号码已绑定用户!'));
            }
        }
        $code = date('s') . rand(1000, 9999);//随机验证码
        $phone = 13980969653;

//        $c = new TopClient;//下面是阿里大鱼短信接口
//        $c ->appkey = '23533290';
//        $c ->secretKey = 'e7d9120cc0a43ff69db60666732af8be';
//        $req = new AlibabaAliqinFcSmsNumSendRequest;
//        $req ->setSmsType( "normal" );//短信类型，传入值请填写normal,必填
//        $req ->setSmsFreeSignName( "在路上的爱哭鬼" );//签名
//        $req ->setSmsParam( "{\"code\":\"$code\"}" );//短信模板参数
//        $req ->setRecNum( $phone );//接收者手机
//        $req ->setSmsTemplateCode( "SMS_36385073" );//短信模板ID
//        $resp = $c ->execute( $req );
//        if (isset($resp->result) && $resp->result->err_code == 0 && $resp->result->success == true) {
//            $this->Session->write('verify_code', $code . '@' . (time() + 900));//验证码.拼装过期时间15分钟
//            return json_encode(array('success' => 1, 'msg' => '发送成功!请注意查收.'));//发送成功
//        } else {
//            if ($resp->code == 15 && $resp->sub_code == 'isv.MOBILE_NUMBER_ILLEGAL') {//发送失败:号码错误
//                return json_encode(array('success' => 2, 'msg' => '请填写正确的电话号码!'));
//            }
//            return json_encode(array('success' => 0, 'msg' => '网络繁忙!请刷新后重试!'));
//        }
    }

    //发送http请求
    public function request_by_curl($url)
    {
        // 初始化一个 cURL 对象
        $curl = curl_init();
        // 设置你需要抓取的URL
        curl_setopt($curl, CURLOPT_URL, $url);
        // 设置header 响应头是否输出
        curl_setopt($curl, CURLOPT_HEADER, 1);
        // 设置cURL 参数，要求结果保存到字符串中还是输出到屏幕上。
        // 1如果成功只将结果返回，不自动输出任何内容。如果失败返回FALSE
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        // 运行cURL，请求网页
        $data = curl_exec($curl);
        // 关闭URL请求
        curl_close($curl);
        // 显示获得的数据
        return $data;
    }
}