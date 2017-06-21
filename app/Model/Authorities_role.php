<?php
App::uses('AppModel','Model');

class Authorities_role extends AppModel
{

	public $useTable = 'authorities_roles';

    public function getlist($id){
        return $list = $this->find("all",array("conditions"=>array("role_id"=>$id),"fields"=>array("authority_id")));
    }
} 