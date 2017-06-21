<?php
App::uses('Component', 'Controller');

class WechatComponent extends Component{
    public $config = array();
    public $wechat_config_file = '';

    public function initialize(Controller $controller) {
        date_default_timezone_set('PRC');
        $this->wechat_config_file = ROOT.DS.'wechat.ini.php';
        $config_arr = $this->get_parse_ini($this->wechat_config_file);
        $this->config = $config_arr;

        parent::initialize($controller);
    }

    public function get_parse_ini($file) {

        // if cannot open file, return false
        if (!is_file($file))
            return false;

        $ini = file($file);
        // var_dump($ini);

        // to hold the categories, and within them the entries
        $cats = array();

        foreach ($ini as $i) {
            if (@preg_match('/\[(.+)\]/', $i, $matches)) {
                $last = $matches[1];
            } elseif (@preg_match('/(.+)=(.+)/', $i, $matches)) {
                $cats[$last][trim($matches[1])] = trim($matches[2]);
            }
        }

        return $cats;

    }

    public function put_ini_file($file, $array, $i = 0){
          $str="";
          foreach ($array as $k => $v){
            if (is_array($v)){
              $str.=str_repeat(" ",$i*2)."[$k]\r\n";
              $str.=$this->put_ini_file("",$v, $i+1);
            }else
              $str.=str_repeat(" ",$i*2)."$k = $v\r\n";
          }
          
          $phpstr = "<?PHP die('这是配置文件,禁止访问!');\r\n/*\r\n".$str."*/\r\n?>";
          
        if($file){
            return file_put_contents($file,$phpstr);
        }else{
            return $str;
        }

    }

}