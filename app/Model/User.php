<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel
{
    public $belongsTo = array(
        'Role' => array(
            'className' => 'Role',
            'foreignKey' => 'role_id',
            'fields' => array('Role.id', 'Role.role_name')
        ),
    );

    //保存数据前,密码加密
    public function beforeSave($options = array())
    {

        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new BlowfishPasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }
        return true;
    }

    public function get_email($user_id)
    {
        $this->id = $user_id;
        $email = $this->field('email');
        if (!empty($email)) {
            return $email;
        }
        return null;
    }

    //个人中心获取数据
    public function get_center_info($userid)
    {
        $info = $this->find('first', array(
                'conditions' => array('User.id' => $userid)
            )
        );
        if (!empty($info)) {
            return $info;
        }
        return null;
    }


    //添加用户时验证用户名是否已存在
    public function loginNameExits2($name)
    {

        $data = $this->find("count", array("conditions" => array("User.loginname" => $name)));
        if ($data != 0) {
            return true;
        } else {
            return false;
        }
    }

}