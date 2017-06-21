<?php
App::uses('AppController', 'Controller');

class UeditorController extends AppController 
{
	public $components = array('Ueditor');
	public function run(){
		$this->autoRender=false;
		return $this->Ueditor->run();
	}
}