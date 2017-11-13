<?php
App::uses('AppController', 'Controller');
use Overtrue\Wechat\Server;
use Overtrue\Wechat\Message;
use Overtrue\Wechat\Menu;
use Overtrue\Wechat\MenuItem;
class IndexController extends AppController
{
    //连接微信服务
    public function wx_service()
    {
        $this->autoRender=false;
        $server = new Server($this->Wechat->config['wechat']['appid'],$this->Wechat->config['wechat']['token']);
        //关注事件
        $server->on('event', 'subscribe', function ($event) {
            return Message::make('text')->content('此时此刻的你就是最好的你！');
        });

        //关键字回复,没有该关键字的则自动回复消息
        $server->on('message','text',function ($message) {
            return Message::make('text')->content('你那么美说什么都是对的~~~');
        });

        //菜单click点击事件
        $server->on('event', 'click', function ($click) {
            $keyword=$click->EventKey;
            switch($keyword){
                case 'about':
                    return Message::make('text')->content('我我我我我我我....');
                    break;
                default :
                    return Message::make('text')->content('啊.哈~迷路啦.');
                    break;
            }
        });
//        ob_clean();//接口配置时配置失败,打开试试!
        // 您可以直接echo 或者返回给框架
        return  $server->serve();
    }

    /**
     * 设置菜单
     * @throws \Overtrue\Wechat\Exception
     */
    public function wx_menus()
    {
        $menuService = new Menu($this->Wechat->config['wechat']['appid'],$this->Wechat->config['wechat']['secret']);
        $button = new MenuItem("我");

        $menus = array(
            new MenuItem("菜单一个", 'view',$this->Wechat->config['url']['wx_url'].'/Index/index'),
            new MenuItem("菜菜单单", 'view', $this->Wechat->config['url']['wx_url'].'/Index/index'),
            $button->buttons(array(
                new MenuItem('我的主页', 'view', $this->Wechat->config['url']['wx_url'].'/Index/index'),
                new MenuItem('关于我们', 'click', 'about'),
            )),
        );
        try {
            $menuService->set($menus);// 请求微信服务器
            echo '设置成功！';
        } catch (\Exception $e) {
            echo '设置失败：' . $e->getMessage();
        }
        $this->autoRender = false;
    }

    public function upload_apply_agent_file()
    {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            App::import('Vendor', 'UploaderFile');
            App::import('Vendor', 'ImageCompress');
            $upload_config = Array(
                'pathFormat' => '/webroot/apply_agent_file/{yyyy}{mm}{dd}/apply_agent_file_{time}{rand:6}',
                'maxSize' => 10240000,
                'allowFiles' => Array(".png", ".jpg", ".jpeg", ".gif", ".bmp"),
            );

            $uploader = new UploaderFile('project_img', $upload_config);

            $upload_info = $uploader->getFileInfo();


            if ($upload_info['state'] == 'SUCCESS') {
                $save_data = array();

                $save_data['wx_user_id'] = $this->request->data['agent_id'];
                $save_data['img_url'] = str_replace('/webroot/apply_agent_file/', '', $upload_info['url']);

                //缩略图
                $ImageCompress = new ImageCompress();
                $imgsrc = $upload_info['filePath'];
                $imgdst = dirname($upload_info['filePath']) . DS . 'icon' . DS . $upload_info['title'];
                if ($ImageCompress->run($imgsrc, $imgdst)) {
                    $save_data['img_icon_url'] = str_replace('/' . $upload_info['title'], '/icon/' . $upload_info['title'], $save_data['img_url']);
                }
                //缩略图_END


                $this->loadModel('Material');
                $this->Material->create();
                if ($id = $this->Material->save($save_data)) {
                    return json_encode(array('code' => 1, 'img_icon_url' => $save_data['img_icon_url'], 'id' => $id['Material']['id']));
                } else {
                    unlink(WWW_ROOT . 'apply_agent_file' . DS . $save_data['img_url']);
                    return json_encode(array('code' => 2, 'msg' => '上传失败'));
                }
            } else {
                return json_encode(array('code' => 2, 'msg' => '上传图片失败:【' . $upload_info['state'] . '】'));
            }

        }

    }

    public function index()
    {
        $user=$this->Session->read('user_info');

        debug($user);exit;
    }
}
