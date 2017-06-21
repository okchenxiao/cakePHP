<?php
App::uses('AppController', 'Controller');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
class UsersController extends AppController
{

    public $uses = array('User', 'Role');

    //用户列表
    public function index()
    {
        $this->set("daohang", $this->getTitleUrl());//面包屑导航栏数据
        $this->set('title_for_layout', $this->getTitleName());//页面title标签内容
        $condition=array();
        if($this->request->is('post')){
            $condition=$this->search($this->request->data['User']);
        }
        $this->paginate = array(
            'conditions'=>$condition,
            'order' => array('User.modified' => 'DESC'),
            'limit' => 15
        );
        $this->set('users', $this->paginate());
    }

    //搜索条件
    public function search($data)
    {
        $name=trim($data['name']);
        $is_login=trim($data['is_login']);
        $begin=trim($data['begin']);
        $end=trim($data['end']);
        $condition=array();
        if($name!='') {
            $condition['OR']['User.loginname LIKE']="%$name%";
            $condition['OR']['User.username LIKE']="%$name%";
        }
        if($is_login!=''){
            $condition['User.is_login']=$is_login;
        }
        if($begin!=''){
            $condition['User.modified >=']=$begin.' 00:00:00';
        }
        if($end!=''){
            $condition['User.modified <=']=$end.' 23:59:59';
        }
        return $condition;
    }

    /**
     * 删除.必须为post请求
     */
    public function del()
    {
        $this->autoRender=false;
        if($this->request->is('post') && isset($_GET['user'])){
            $id=$_GET['user'];
            if ($this->User->delete($id,false)) {
                $this->Flash->set('删除成功 !',array('element' => 'alert_success'));
                return $this->redirect('/Users/index');
            }
            $this->Flash->set('删除失败 !',array('element' => 'alert_fail'));
        }
        return $this->redirect('/Users/index');
    }

    /**
     * 禁用或激活
     */
    public function is_login()
    {
        $this->autoRender=false;
        if($this->request->is('post') && isset($_GET['is_login']) && isset($_GET['user'])) {
            $is_login=$_GET['is_login'];
            $this->User->id=$_GET['user'];
            $save=0;
            $r_name='禁用';
            if($is_login=='0'){
                $save=1;
                $r_name='激活';
            }
            if ($this->User->saveField('is_login',$save)) {
                $this->Flash->set($r_name.'成功 !',array('element' => 'alert_success'));
                return $this->redirect('/Users/index');
            }
            $this->Flash->set($r_name.'失败 !',array('element' => 'alert_fail'));
        }
        return $this->redirect('/Users/index');
    }

    //登录页面
    public function login()
    {
        $this->set('title_for_layout', '登陆');
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirectUrl());
            }
        }
    }

    //注销操作
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    //添加用户
    public function add()
    {
        $this->set("daohang", $this->getTitleUrl());
        $this->set('title_for_layout', $this->getTitleName());

        $rolelist = $this->Role->role_list();
        $this->set("roles", $rolelist);

        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Flash->set('添加用户成功 !',array('element' => 'alert_success'));
                return $this->redirect('/Users/index');
            }
            $this->Flash->set('添加用户失败 !',array('element' => 'alert_fail'));
            return $this->redirect('/Users/index');
        }
    }

    //验证登录名是否已使用
    public function loginNameExits()
    {
        if ($this->User->loginNameExits2($_POST['name'])) {
            echo 1;
        } else {
            echo 0;
        }
        die();
    }

    //个人中心
    public function usercenter()
    {
        $userid = $this->Auth->User('id');
        $info = $this->User->get_center_info($userid);
        $this->set('info', $info);
    }

    //个人中心修改数据
    public function center_edit()
    {
        if ($this->request->is('post')) {
            $this->User->id=$this->Auth->User('id');
            if($this->User->save($this->request->data)){
                $this->Flash->set('修改成功 !',array('element' => 'alert_success'));
                return $this->redirect('/Users/usercenter');
            }
            $this->Flash->set('修改失败 !',array('element' => 'alert_fail'));
        }
        return $this->redirect('/Users/usercenter');
    }

    //个人中心修改头像上传照片
    public function change_avatar()
    {
        if ($this->request->is('post')) {
            if(empty($this->request->data)){
                $this->Flash->set('你并没有上传图片 !',array('element' => 'alert_fail'));
                return $this->redirect('/Users/usercenter');
            }
            $oldname=$this->request->data['img_name'];
            $img_source=$this->request->data['img_source'];
            //创建文件
            $dir_path=WWW_ROOT.'img/user_avatar';
            $ext=strrchr($oldname,'.');
            $dir = new Folder($dir_path,true,0777);
            $file_name=$dir_path.'/'.date('YmdHis').uniqid().rand('1000','9999').$ext;
            $new_file=new File($file_name, true, 0777);
            $new_file->append(base64_decode($img_source));
            $new_file->close();
            $path=str_replace('\\','/',str_replace(WWW_ROOT,'/',$file_name));
            $this->User->id=$this->Auth->User('id');
            if ($this->User->saveField('face',$path)) {
                $this->Flash->set('头像修改成功 !',array('element' => 'alert_success'));
                return $this->redirect('/Users/usercenter');
            }
            $this->Flash->set('头像修改失败 !',array('element' => 'alert_fail'));
        }
        return $this->redirect('/Users/usercenter');
    }

    //个人中心修改密码
    public function change_password()
    {
        $this->autoRender=false;
        if ($this->request->is('post')) {
            //验证密码是否为6~12位
            $now_len=strlen($this->request->data['User']['nowpassword']);
            $pwd_len=strlen($this->request->data['User']['password']);
            $new_len=strlen($this->request->data['User']['newpassword']);
            if($new_len>12||$new_len<6||$now_len>12||$now_len<6||$pwd_len>12||$pwd_len<6){
                $this->Flash->set('输入的密码必须为6~12位字符 !',array('element' => 'alert_fail'));
                return $this->redirect('/Users/usercenter');
            }
            $id=$this->Auth->User('id');
            $hash=new BlowfishPasswordHasher();//获得原密码  加密对比
            $oldpwd=$this->User->field('User.password',array('User.id'=>$id));
            if (!$hash->check($this->request->data['User']['nowpassword'],$oldpwd)) {
                $this->Flash->set('当前密码输入不正确 !',array('element' => 'alert_fail'));
                return $this->redirect('/Users/usercenter');
            }
            if($this->request->data['User']['password']!=$this->request->data['User']['newpassword']){
                $this->Flash->set('两次输入密码不一致 !',array('element' => 'alert_fail'));
                return $this->redirect('/Users/usercenter');
            }
            $save['User']=array('id'=>$id,'password'=>$this->request->data['User']['password']);
            if ($this->User->save($save)) {//Model会自动将密码加密
                $this->Flash->set('密码修改成功 !',array('element' => 'alert_success'));
                return $this->redirect('/Users/usercenter');
            }
            $this->Flash->set('密码修改失败 !',array('element' => 'alert_fail'));
        }
        return $this->redirect('/Users/usercenter');
    }

    ////////////////////////下面没搞,用的上再说//////////////////////////

    public function forgetpassword()
    {
        $this->set('title_for_layout', '忘记密码');

        if ($this->request->is('post')) {
            $this->User->set($this->request->data);
            $this->User->validator()->remove('email', 'unique');
            if ($this->User->validates()) {
                $data = $this->User->find('first', array(
                        'conditions' => array('email' => $this->data['User']['email']),
                        'fields' => array('id', 'email', 'username', 'name')
                    )
                );
                // pr($data);
                if (!empty($data)) {
                    $email = $data['User']['email'];
                    $user_id = $data['User']['id'];
                    $username = $data['User']['username'];
                    $Code = md5(time());

                    $passwordHasher = new BlowfishPasswordHasher();
                    $validate_Code = $passwordHasher->hash($Code);

                    /*将加密验证码密文存入数据库*/
                    $this->User->unbindModel(array('belongsTo' => array('Role')));
                    if ($this->User->updateAll(array('validate_code' => "'" . $validate_Code . "'", 'validate_time' => time()), array('id' => $user_id))) {
                        return $this->send_validate_email($email, $user_id, $username, $Code);
                    }
                } else {
                    return $this->flash('输入的邮件地址不存在', 'forgetpassword', 1);
                }
            }
        }

    }

    private function send_validate_email($email, $user_id, $username, $validate_Code)
    {
        App::uses('CakeEmail', 'Network/Email');

        $Cakemail = new CakeEmail();
        /*初始化邮箱设置*/
        $Cakemail->helpers(array('Html'));
        $Cakemail->config('smtp');

        /*设置邮件模板和格式*/
        $Cakemail->template('forgetpassword');
        $Cakemail->emailFormat('html');

        /*为邮箱中的变量赋值*/
        $Cakemail->viewVars(array('id' => $user_id, 'validate_Code' => $validate_Code, 'username' => $username));

        /*设置邮件接收者和主题*/
        $Cakemail->to($email);
        $Cakemail->subject('密码找回');

        /*发送邮件*/
        if ($Cakemail->send()) {
            return $this->flash('邮件发送成功,注意查收。该邮件半小时内有效', 'forgetpassword', 1);
        } else {
            return $this->flash('邮件发送失败,检查邮件地址是否为有效地址', 'forgetpassword', 1);
        }

    }

    public function validate_email($user_id, $validate_Code)
    {

        $this->set('title_for_layout', '密码找回');

        if (isset($user_id)) {
            $this->User->unbindModel(array('belongsTo' => array('Role')));
            $code = $this->User->find('first', array(
                    'conditions' => array('id' => $user_id),
                    'fields' => array('validate_code', 'validate_time')
                )
            );
        }

        $check_time = (time() - $code['User']['validate_time']) / 60;
        if ($check_time < 30) {
            if (!empty($code)) {
                $code = $code['User']['validate_code'];

                $passwordHasher = new BlowfishPasswordHasher();

                if ($passwordHasher->check($validate_Code, $code)) {
                    $this->Session->write('user_id', $user_id);
                    $this->set('user_id', $user_id);
                    return $this->render('modifiy_password');
                }
            }
        }

        return $this->flash('信息验证失败,请重新获取验证邮件', 'forgetpassword', 1);
    }

}
