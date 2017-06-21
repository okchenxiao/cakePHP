<?php

App::uses('Controller', 'Controller');
App::uses('CakeSession', 'Model/Datasource');
App::import('Vendor', 'wechat/autoload');
use Overtrue\Wechat\Js;
use Overtrue\Wechat\Auth;
use Overtrue\Wechat\User;
class AppController extends Controller
{
    public $components = array('Wechat', 'Session');
    public $helpers = array('Html', 'Session', 'Form');

    public function beforeFilter()
    {
        $allows = array('wx_service','wx_menus');//允许访问的页面

        if (!in_array(strtolower($this->action), $allows)) {

            if (!CakeSession::check('user_info')) {
                $auth = new Auth($this->Wechat->config['wechat']['appid'], $this->Wechat->config['wechat']['secret']);
                $user_wx=$auth->authorize($to = null, $scope = 'snsapi_userinfo', $state = 'STATE');
                $userService = new User($this->Wechat->config['wechat']['appid'], $this->Wechat->config['wechat']['secret']);
                $user_msg=$userService->get($user_wx->openid);//根据openid获得用户信息
                $user_info=$this->object_to_array($user_msg);//对象转换为数组
                CakeSession::write('user_info', $user_info);
            } else {

            }
        }

        $js = new Js($this->Wechat->config['wechat']['appid'], $this->Wechat->config['wechat']['secret']);
        $js_local = $js->config(array('getLocation'));//jssdk配置
        $this->set('js_local', $js_local);
    }

    /**
     * 对象转数组
     * @param $obj
     * @return array
     */
    public function object_to_array($obj)
    {
        $arr = array();
        if(is_object($obj)||is_array($obj)){
            foreach ($obj as $key => $val) {
                $val = (is_array($val) || is_object($val)) ? $this->object_to_array($val) : $val;
                $arr[$key] = $val;
            }
        }
        return $arr;
    }

    /** 拼接为当前访问的url
     * @return string
     */
    public function current_url()
    {
        $after_bind = '/' . $this->name . '/' . $this->action;
        if(!empty($this->request->query)){
            $get_parm = '?';
            foreach ($this->request->query as $par_name => $par_val) {
                $get_parm .= $par_name . '=' . $par_val . '&';
            }
            $after_bind = '/' . $this->name . '/' . $this->action . $get_parm;
        }
        return $after_bind;
    }

}


