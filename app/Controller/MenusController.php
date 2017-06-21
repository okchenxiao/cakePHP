<?php

App::uses('AppController', 'Controller');


class MenusController extends AppController
{
    //列表页
    public function index()
    {
        $this->set("daohang", $this->getTitleUrl());
        $this->set("title_for_layout", $this->getTitleName());
    }

    //异步获取菜单列表数据
    public function ajaxChildMenuList()
    {
        $this->autoRender=false;
        if ($this->request->is('ajax') && isset($_POST['key']) && is_numeric($_POST['key'])) {
            $cate = $this->Menu->find('all', array('order'=>array('sort DESC','id DESC'),'conditions' => array('Menu.is_show' => 1), 'fields' => array("Menu.id", "Menu.pid", "Menu.name", "Menu.path")));
            return json_encode($cate);
        }
        return 0;
    }

    //异步修改
    public function ajaxEditMenuName()
    {
        $this->autoRender=false;
        if ($this->request->is('ajax') && isset($_POST['key']) && is_numeric($_POST['key'])) {
            $this->Menu->id = $_POST['key'];
            $data['Menu']['name'] = $_POST['name'];
            if ($this->Menu->save($data)) {
                return 1;
            }
        }
        return 2;
    }

    //异步删除
    Public function ajaxDelById()
    {
        $this->autoRender=false;
        if ($this->request->is('ajax') && isset($_POST['key']) && is_numeric($_POST['key'])) {
            if ($this->Menu->delete($_POST['key'])) {
                return 1;
            }
        }
        return 2;
    }

    /**
     * 添加菜单
     */
    public function add()
    {
        $this->set("daohang", $this->getTitleUrl());
        $this->set('menulist', $this->getMenus());
        $this->set('title_for_layout', $this->getTitleName());
        if ($this->request->is('post')) {
            if ($this->Menu->save($this->request->data)) {
                $this->Flash->set('添加成功 !',array('element' => 'alert_success'));
                return $this->redirect('/Menus/index');
            }
            $this->Flash->set('添加失败 !',array('element' => 'alert_fail'));
            return $this->redirect('/Menus/index');
        }
    }

    //获得菜单下拉列表
    public function getMenus($role_id=1)
    {
        $this->loadModel("MenuRole");

        if ($role_id == 1) {
            $conditionsId = "";
        } else {
            $role_menus = $this->MenuRole->findAllByRoleId($role_id);
            if (!empty($role_menus)) {
                foreach ($role_menus as $key => $val) {
                    $conditionsId[] = $val["MenuRole"]['menu_id'];
                }
            } else {
                $conditionsId = "";
            }
        }
        $cate = array();
        if ($conditionsId!='') {
            $cate = $this->Menu->find('all', array('order'=>array('sort ASC','id ASC'),'conditions' => array('Menu.is_show' => 1, "id" => $conditionsId)));
        } else {
            $cate = $this->Menu->find('all', array('order'=>array('sort ASC','id ASC'),'conditions' => array('Menu.is_show' => 1)));
        }

        $menu = self::unlimitedForLayer($cate, $pid = 0);
        return $menu;
        die;
    }

    //重组无限极分类
    Static function unlimitedForLayer($cate, $pid = 0)
    {
        $arr = array();//要压入值的新数组
        foreach ($cate as $v) {
            if ($v['Menu']['pid'] == $pid) {
                $v['Menu']['child'] = self::unlimitedForLayer($cate, $v['Menu']['id']);
                $arr[] = $v['Menu'];
            }
        }
        return $arr;
    }

    //获取导航标题
    public function getTitlePidList($name)
    {
        return $pids = $this->Menu->getTitlePids($name);
        die();
    }

    //获取标题
    public function getTitleNames($name)
    {
        return $names = $this->Menu->getTitleName($name);
        die();
    }

    //角色菜单设置
    public function rol_menu()
    {
        $this->set("daohang", $this->getTitleUrl());
    }


    //获取菜单列表
    public function getRol_Menulist()
    {
        $this->autoRender=false;
        if ($this->request->is('ajax') && isset($_POST['key']) && is_numeric($_POST['key'])) {
            $auth = $this->Menu->find('all', array("conditions" => "is_show=1"));
            return json_encode($auth);
        }
        return 0;
    }

    //获取默认权限以及权限列表
    public function getRolid_Menulist()
    {
        $this->autoRender=false;
        if ($this->request->is('ajax') && isset($_POST['key']) && is_numeric($_POST['key'])) {
            if ($_POST['key'] > 0) {
                $this->loadModel('MenuRole');
                $arr1 = $this->MenuRole->getlist($_POST['key']);
                $arr3 = array();
                for ($i = 0; $i < count($arr1); $i++) {
                    $arr3[] = $arr1[$i]['Menus_role']['menu_id'];
                }
                $arr2 = $this->Role->Menu->find('all');
                $arr4 = array();

                for ($j = 0; $j < count($arr2); $j++) {
                    $arr4[] = $arr2[$j]['Menu'];
                }
                $data = array("arr1" => $arr3, "arr2" => $arr4);
                return json_encode($data);
            }
        }
        return 0;
    }
}