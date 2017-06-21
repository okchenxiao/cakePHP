<?php
App::uses('AppModel', 'Model');

class Role extends AppModel
{

    public $validate = array(
        'role_name' => array(
            'unique' => array(
                'rule' => 'isUnique',
                'message' => '角色已经存在')
        )
    );

    public $hasAndBelongsToMany = array(
        'Authority' => array(
            'className' => 'Authority',
            'joinTable' => 'authorities_roles',
            'foreignKey' => 'role_id',
            'associationForeignKey' => 'authority_id',
            'unique' => true,
        ),
        'Menu' => array(
            'className' => 'Menu',
            'joinTable' => 'menu_roles',
            'foreignKey' => 'role_id',
            'associationForeignKey' => 'menu_id',
            'unique' => true
        )
    );

    public function get_role()
    {
        $this->unbindModel(array('hasAndBelongsToMany' => array('Authority')));
        $role = $this->find('all', array(
            'conditions' => array(),
            'fields' => array('Role.id', 'Role.role_name')));
        if (!empty($role)) {
            return $role;
        }
        return null;
    }

    public function get_auth_list($role_id)
    {
        $list = $this->find('first', array(
                'conditions' => array('id' => $role_id),
                'fields' => array('Role.id')
            )
        );
        if (!empty($list)) {
            return $list['Authority'];
        }
        return null;
    }

    //获取角色列表
    public function role_list()
    {
        $this->unbindModel(array('hasAndBelongsToMany' => array('Authority')));
        return $this->find("list", array('fields' => array("Role.id", "Role.role_name")));
    }
} 