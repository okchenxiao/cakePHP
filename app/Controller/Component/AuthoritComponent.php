<?php
App::uses('Component', 'Controller');
App::uses('Role','Model');

class AuthoritComponent extends Component
{
	private $role;
	private $auth_base = array('login','logout'); //被允许的最基本权限
	private $key       = null;                            //保存在Session中使用的键名
	public  $current_name  = null;                        //当前访问的控制器名称
	public  $current_allow = array();                     //当前控制器被允许访问的方法列表
	public  $auth_list = array();                         //用户被允许的权限列表
	private $notallow  = 'NOTALLOW';                      //禁止访问
	private $ajax      = 'ajax';
	private $request   = array();
	private $_methods  = array();
	public  $action    = '';
	public  $components= array('Session');


	function __construct(ComponentCollection $collection, $settings = array())
	{
        $this->role = new Role();
        parent::__construct($collection, $settings);
	}


	// Called before the Controller::beforeFilter().
	public function initialize(Controller $controller) 
	{   
		$appClass = get_parent_class($controller);
		$appMethods  = get_class_methods($appClass);
		$parentMethods = get_class_methods('Controller');

		$customMethods = array_diff($appMethods, $parentMethods);
		$this->_methods = array_diff($controller->methods, $customMethods);
        
        $this->current_name = strtolower($controller->name);
		$this->request = $controller->request;
		$this->set_key();
		$this->set_current_allow_list();
		 //pr("Now Controller's name");
		 //pr($controller->name);
		 //pr("Now Controller's Methods");
		 //pr($this->_methods);
		// pr("Allow methods list");
		 //pr($this->current_allow);
		// pr("Now url");
		// var_dump($this->request->url);
		// var_dump($this->is_save());
		// pr($_SESSION);
		
		
	}

    // Called after the Controller::beforeFilter() and before the controller action
	public function startup(Controller $controller) 
	{
		$this->action = $controller->request->params['action'];
		// var_dump($_SESSION['Auth']);
		if (@$_SESSION['Auth']['User']['role_id'] != 1) {
			// exit();
			if(!$this->check_current_allow())
			{
				if(!$this->is_allow($controller))
				{
		            // $controller->redirect('/index/index');
		            // echo "<script>alert('很遗憾您没有权限访问该菜单。');</script>";
		            // $controller->redirect($controller->referer());
		            $controller->flash('很遗憾您没有权限访问该菜单。',$controller->referer());
				}
			}	
		}
		
	}

	// Called before the Controller::beforeRender(), and before
    //the view class is loaded, and before Controller::render()
	public function beforeRender(Controller $controller) 
	{

	}

    // Called after Controller::render() and before the output is printed to the browser.
	public function shutdown(Controller $controller) 
	{

	}

	private function set_key()
	{
		$userid = $this->Session->read('Auth.User.id');
		$this->key = md5($userid.'authlist');
	}
    
    /*获取并设置用户权限信息*/
	private function set_auth_list()
	{
		$role_id = $this->Session->read('Auth.User.role_id');
		if(empty($this->auth_list))
		{
			$list = $this->role->get_auth_list($role_id);
            if(!empty($list))
            {
            	// var_dump($list);exit();
            	foreach($list as $auth)
				{
					if($auth['pid'] == 0)
					{
						continue;
					}
					$lis = $this->deal_auth_list($auth['auth_name']);
					$cname = strtolower($this->get_current_deal_controller($lis));

					//如果已经存在改控制器信息
					if($this->controller_auth_is_exist($cname))
					{
						//存在的信息如果不是表示拥有全部权限，则合并权限信息
						if(!$this->is_all_authority($cname))
						{  
							if($this->check_all_in_lis($lis[$cname]))
							{
								$lis[$cname][0] = 'all'; 
								$this->auth_list = array_merge($this->auth_list,$lis);
							}
							else
							{
								$merge = array_merge($this->auth_list[$cname],$lis[$cname]);
								$this->auth_list[$cname] = $merge;
							}	
						}
					}
					else
					{
						$this->auth_list = array_merge($this->auth_list,$lis);
					}
				}
            }
            $this->save_auth_list();
		}
	}

	/*获取当前处理的权限信息的控制器名称*/
	private function get_current_deal_controller($list = array())
	{
		if(!empty($list))
		{
			$contoller = array_keys($list);
			$controller_name= $contoller['0'];
			return $controller_name;
		}
		return null;
	}

	/**
	*检查权限列表中是否已经有当前要加入权限信息列表的控制器的权限信息
	*参数   $name :  要加入权限信息列表的控制器名称
	**/
	private function controller_auth_is_exist($controller_name)
	{
		if(array_key_exists($controller_name, $this->auth_list))
		{
			return true;
		}
		return false;
	}

	/*检查已经存在的权限信息列表中是否拥有该控制器所有权限*/
	private function is_all_authority($controllername)
	{
		if(array_key_exists($controllername, $this->auth_list))
		{
			if(in_array('all',$this->auth_list[$controllername]))
			{
				return true;
			}
		}
		return false;
	}

	/*检查将要写入权限信息列表的信息中是否包含了该控制器的全部权限的信息*/
	private function check_all_in_lis($lis)
	{
		if(in_array('all',$lis))
		{
			return true;
		}
		return false;
	}
	
    /*获取用户权限列表*/
	private function get_authlist()
	{
		if(!$this->is_save())
		{
			$this->set_auth_list();
		}
		$authlist = $this->Session->read('Auth.User.'.$this->key);
		if(!empty($authlist))
		{
			$controller_list = array_map('strtolower',array_keys($authlist));
			if(in_array($this->current_name,$controller_list))
			{
				return $authlist[$this->current_name];
			}
		}
		return 	$this->notallow; 
	}
    
    /*将数据库读取的权限字符串解析为数组*/
	private function deal_auth_list($authstr)
	{
        $autharray = explode('/', $authstr);
        if(!empty($autharray))
        {
        	$contr_key = strtolower($autharray[0]);
        	$list[$contr_key] = null;
        	foreach($autharray as $auth)
        	{
        		if($auth != $autharray[0])
        		{
        			if(!empty($auth))
        			{
        				$list[$contr_key][] =  $auth;
        			}
        		}
        	}
        	return $list;
        }
        return null;
	}
    
    /*保存用户权限列表到Session*/
	private function save_auth_list()
	{
		if(!empty($this->auth_list))
		{
			$this->Session->write('Auth.User.'.$this->key,$this->auth_list);
		}
	}

    /*检查用户权限是否解析*/
	private function is_save()
	{
		$authlist = $this->Session->read('Auth.User.'.$this->key);
		if(!empty($authlist))
		{
			return true;
		}
		return false;
	}
    
    /*获取当前控制器被允许访问的方法列表*/
	private function set_current_allow_list()
	{
		$allow = $this->get_authlist();
		// var_dump($allow);
		if($allow == $this->notallow)
		{
			$this->current_allow = $this->auth_base;
			return true;
		}

		if($this->check_all_in_lis($allow))
		{
           $this->current_allow = 'ALL';
           return true;
		}
		else
		{
			$this->current_allow = array_merge($allow,$this->auth_base);
			return true;
		}
	}
    
    /*检查当前控制器的权限如果为ALL则表示拥有该控制器所有权限*/
	private function check_current_allow()
	{
		if($this->current_allow == 'ALL')
		{
			return true;
		}
		return false;
	}
    
    /*检查用户是否有权限访问当前方法*/
	private function is_allow($controller)
	{
		if($this->is_ajax($controller))
		{
			return true;
		}
		if(!in_array($this->action, array_map('strtolower',$this->current_allow)))
		{
             return false;
		}
		return true;
	}

	private function is_ajax($controller)
	{
		if($controller->request->is('ajax'))
		{
			return true;
		}
		return false;
	}
}
