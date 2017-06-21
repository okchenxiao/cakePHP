<?php
App::uses('AppController','Controller');

class AuthoritiesController extends AppController
{
	//列表页
	public function index()
	{
		$this->set('title_for_layout',$this->getTitleName());
		$this->set("daohang",$this->getTitleUrl());
	}

	/**
	 * Ajax获取角色列表 列表页面
	 */
	public function getlist(){
		$this->Authority->unbindAll();
		$k = $_POST['key'];
		if (is_numeric($k)) {
			$cate = $this->Authority->find('all',array('fields'=>array("Authority.id","Authority.pid","Authority.auth_describle","Authority.auth_name")));
			echo json_encode($cate);
		}
		die();
	}

	public function add()
	{
		$this->set("daohang",$this->getTitleUrl());
		$this->set("Authoritielist",$this->getAuthorities());
		$this->set('title_for_layout',$this->getTitleName());
		if($this->request->is('post'))
		{
			$this->Authority->create();
			if($this->Authority->save($this->request->data))
			{
				$this->Flash->set('添加成功 !',array('element' => 'alert_success'));
				return $this->redirect('/Authorities/index');
			}
			$this->Flash->set('添加失败 !',array('element' => 'alert_fail'));
			return $this->redirect('/Authorities/index');
		}
	}

	//异步修改
	public function editAuthoritieName(){
		$this->autoRender=false;
		$this->Authority->unbindAll();
		if ($this->request->is('ajax') && isset($_POST['key']) && is_numeric($_POST['key'])) {
			$this->Authority->id = $_POST['key'];
			$arr = explode(",", $_POST['name']);
			$data['Authority']['auth_name'] = $arr[1];
			$data['Authority']['auth_describle'] = $arr[0];
			if ($this->Authority->save($data)) {
				return 1;
			}
		}
		return 2;
	}

	//异步删除
	public function delById(){
		$this->Authority->unbindAll();
		$this->autoRender=false;
		if ($this->request->is('ajax') && isset($_POST['key']) && is_numeric($_POST['key'])) {
			if($this->Authority->delete($_POST['key'])){
				return 1;
			}
		}
		return 2;
	}

	//获得所有权限
	public function getAuthorities(){

		$cate = $this->Authority->find('all',array("fields"=>array("id","auth_describle","pid")));
		$menu = self::unlimitedForLayer($cate,$pid=0);
		return $menu;
		die;

	}

	//重组无限极分类
	Static  function unlimitedForLayer($cate,$pid=0){
		$arr = array();//要压入值的新数组
		foreach($cate as $v){
			if($v['Authority']['pid'] == $pid){
				$v['Authority']['child'] = self::unlimitedForLayer($cate,$v['Authority']['id']);
				$arr[] = $v['Authority'];
			}
		}
		return $arr;
	}

}