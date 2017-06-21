<?php
App::uses('AppModel', 'Model');

class Authority extends AppModel
{
    public $validate = array(
        'auth_describle' => array(
            'unique' => array(
                'rule' => 'isUnique',
                'message' => '权限已经存在'
            )
        )
    );
}