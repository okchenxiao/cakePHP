<?php


/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package        app.Controller
 * @link        http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    public $helpers = array('Html', 'Session', 'Form','Flash');

    public $components = array(
        'Flash',
        'Ueditor',
        'Session',
        'Authorit',
        'Wechat',
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'Index',
                'action' => 'index'
            ),
            'logoutRedirect' => array(
                'controller' => 'Users',
                'action' => 'login'
            ),
            'authError' => '无访问权限，请先登录',
            'unauthorizedRedirect' => array(
                'controller' => "Users",
                'action' => 'login'
            ),
            'authenticate' => array(
                'Form' => array(
                    'userModel' => 'User',
                    'passwordHasher' => 'Blowfish',
                    'fields' => array('username' => 'loginname', "password" => "password"),
                    'userFields' => array('User.id', 'User.loginname', 'User.username', 'User.role_id', 'User.face')//规定要写入session的用户字段信息
                )
            )
        )
    );

    public function beforeFilter()
    {
        $this->Auth->allow('logout', 'login', 'forgetpassword', 'modifiy_password');
    }

    public function beforeRender()
    {
        App::uses('MenusController', 'Controller');
        $menu = new MenusController();
        $role_id = $this->Auth->user('role_id');
        $menus = $menu->getMenus($role_id);
        $this->set("menus", $menus);//左侧菜单数据

        $this->theme = 'Theme1';
    }

    public function getTitleUrl()
    {
        $urlName = '/'.$this->name.'/'.$this->action;
        App::uses('MenusController', 'Controller');
        $menu = new MenusController();
        $pid = $menu->getTitlePidList($urlName);

        return $pid;
    }

    public function getTitleName()
    {
        $urlName = '/'.$this->name.'/'.$this->action;
        App::uses('MenusController', 'Controller');
        $menu = new MenusController();
        $pid = $menu->getTitleNames($urlName);
        return $pid;
    }

}


