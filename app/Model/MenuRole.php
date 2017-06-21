<?php

App::uses('AppModel','Model');

class MenuRole extends AppModel
{
    public $useTable = 'menu_roles';

    public function getlist($id)
    {
        return $list = $this->find("all", array("conditions" => array("role_id" => $id), "fields" => array("menu_id")));
    }
}

?> 