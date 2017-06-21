<?php
App::uses('AppController', 'Controller');

class RolesController extends AppController
{

    public $uses = array('Role', 'Authorities_role', "Authority", "MenuRole");

    //角色列表页
    public function index()
    {
        $this->set("daohang", $this->getTitleUrl());
        $this->set('title_for_layout', $this->getTitleName());
        $this->Role->unbindAll();
        $condition = array();
        if ($this->request->is('post')) {//有搜索条件
            $name = trim($this->request->data['Role']['name']);
            if ($name != '') {
                $condition['OR']['Role.role_name LIKE'] = "%$name%";
                $condition['OR']['Role.role_describle LIKE'] = "%$name%";
            }
        }
        $this->paginate = array(
            'conditions' => $condition,
            'fields' => array(),
            'order' => array('Role.modified' => 'DESC'),
            'limit' => 5
        );
        $this->set('roles', $this->paginate('Role'));

    }

    //添加角色
    public function add()
    {
        $this->set("daohang", $this->getTitleUrl());
        $this->set('title_for_layout', $this->getTitleName());
        if ($this->request->is('post')) {
            $this->Role->create();
            if ($this->Role->save($this->request->data)) {
                $this->Flash->set('添加成功 !', array('element' => 'alert_success'));
                return $this->redirect('/Roles/index');
            }
            $this->Flash->set('添加失败 !', array('element' => 'alert_fail'));
            return $this->redirect('/Roles/index');
        }

    }

    /**
     * 删除.必须为post请求
     */
    public function del()
    {
        $this->autoRender = false;
        if ($this->request->is('post') && isset($_GET['role'])) {
            $id = $_GET['role'];
            if ($this->Role->delete($id, false)) {
                $this->Flash->set('删除成功 !', array('element' => 'alert_success'));
                return $this->redirect('/Roles/index');
            }
            $this->Flash->set('删除失败 !', array('element' => 'alert_fail'));
        }
        return $this->redirect('/Roles/index');
    }

    /**
     * Ajax获取角色列表
     */
    public function ajaxGetList()
    {
        $this->Role->unbindAll();
        $this->autoRender = false;
        if ($this->request->is('ajax') && isset($_POST['key']) && is_numeric($_POST['key'])) {
            $cate = $this->Role->find('all', array("conditions" => array("Role.id >" => 1), 'fields' => array("Role.id", "Role.role_name")));
            return json_encode($cate);
        }
        return 0;
    }

//给角色赋予权限
    public function auth()
    {
        $this->set("daohang", $this->getTitleUrl());
    }

    //获取权限列表
    public function getRol_Authlist()
    {
        $this->autoRender = false;
        if ($this->request->is('ajax') && isset($_POST['key']) && is_numeric($_POST['key'])) {
            $auth = $this->Role->Authority->find('all');
            return json_encode($auth);
        }
        return 0;
    }

    //存入关联关系
    public function setRol_Auth()
    {
        $this->autoRender = false;
        if ($this->request->is('ajax') && isset($_POST['key']) && isset($_POST['value'])) {
            $roleId = $_POST['key'];
            $authorityIdlist = trim($_POST['value'], ",");

            $data['Role']['id'] = $roleId;
            $data['Authority'] = explode(",", $authorityIdlist);
            if ($this->Role->saveAll($data, array('deep' => true))) {
                return 1;
            }
        }
        return 0;
    }

    //角色详情列表
    public function rol_detail($id = null)
    {
        if ($id == null) {
            return $this->redirect('/Roles/index');
        }
        $this->set("daohang", $this->getTitleUrl());
        $this->set('title_for_layout', $this->getTitleName());
        $detail = $this->Role->find('first', array(
                'conditions' => array('Role.id' => $id)
            )
        );
        $view_data['Role'] = $detail['Role'];
        $view_data['Auth'] = '';
        $view_data['Menu'] = '';
        if (!empty($detail['Authority'])) {//拼接已有权限
            foreach ($detail['Authority'] as $auth_r) {
                $view_data['Auth'] .= $auth_r['auth_describle'] . '　';
            }
        }
        if (!empty($detail['Menu'])) {//拼接可见菜单
            foreach ($detail['Menu'] as $menu_r) {
                if ($menu_r['is_show'] == 1) {
                    $view_data['Menu'] .= $menu_r['name'] . '　';
                }
            }
        }
        $this->set('detail', $view_data);
    }

    //角色编辑
    public function rol_edit($id = null)
    {
        if ($this->request->is('post')) {
            $data = $this->request->data;
            if ($this->Role->save($data)) {
                $this->Flash->set('编辑成功 !', array('element' => 'alert_success'));
                return $this->redirect('/Roles/index');
            }
            $this->Flash->set('编辑失败 !', array('element' => 'alert_fail'));
            return $this->redirect('/Roles/index');
        } else {
            if ($id == null) {
                return $this->redirect('/Roles/index');
            }
            $this->set("daohang", $this->getTitleUrl());
            $this->set('title_for_layout', $this->getTitleName());
            $this->Role->unbindAll();
            $edit = $this->Role->find('first', array(
                    'conditions' => array('Role.id' => $id)
                )
            );
            $this->set('edit', $edit);
        }
    }

    //获取默认权限以及权限列表
    public function getRolid_Menulist()
    {
        $this->autoRender=false;
        if($this->request->is('ajax') && isset($_POST['key'])){
            if ($_POST['key'] > 0) {
                $arr1 = $this->MenuRole->find("all", array("conditions" => array("role_id" => $_POST['key']), "fields" => array("menu_id")));
                $arr3 = array();
                for ($i = 0; $i < count($arr1); $i++) {
                    $arr3[] = $arr1[$i]['MenuRole']['menu_id'];
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

    //存入关联关系
    public function setRol_menu()
    {
        $this->autoRender=false;
        if($this->request->is('ajax') && isset($_POST['key']) && isset($_POST['value'])){
            $roleId = $_POST['key'];
            $authorityIdlist = trim($_POST['value'], ",");
            $data['Role']['id'] = $roleId;
            $data['Menu'] = explode(",", $authorityIdlist);
            if ($this->Role->saveAll($data, array('deep' => true))) {
                return 1;
            }
        }
        return 0;
    }


    //获取默认权限以及权限列表
    public function getRolid_Authlist()
    {
        $this->autoRender=false;
        if($this->request->is('ajax') && isset($_POST['key'])){
            if ($_POST['key'] > 0) {
                $arr1 = $this->Authorities_role->getlist($_POST['key']);
                $arr3 = array();
                for ($i = 0; $i < count($arr1); $i++) {
                    $arr3[] = $arr1[$i]['Authorities_role']['authority_id'];
                }
                $arr2 = $this->Role->Authority->find('all');
                $arr4 = array();

                for ($j = 0; $j < count($arr2); $j++) {
                    $arr4[] = $arr2[$j]['Authority'];
                }
                $data = array("arr1" => $arr3, "arr2" => $arr4);
                return json_encode($data);
            }
        }
        return 0;
    }
}