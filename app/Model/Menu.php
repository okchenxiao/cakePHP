<?php
App::uses('AppModel', 'Model');

class Menu extends AppModel
{
    public $useTable = 'menus';

    //获取标题
    public function getTitlePids($name)
    {

        //通过传送过来的菜单路径 反查数据库中该路径的ID
        $id = $this->find("first", array("conditions" => array("Menu.path" => $name), "fields" => array("id")));

        $id = isset($id['Menu']['id']) ? $id['Menu']['id'] : 0;

        //查询表中所有菜单id和父级id
        $cate = $this->find("all", array("fields" => array("Menu.id", "Menu.pid", "Menu.path", "Menu.name"), 'order' => "sort asc,id desc"));

        //通过子集id查询属于该id的所有父级ID
        $menus = self::getParents($cate, $id);

        //构造需要i的字符串
        $str = "<li><i class='icon-home'></i><a href='/Index/index'>首页</a> <i class='icon-angle-right'></i></li>";

        foreach ($menus as $key => $menu) {
            if ($menu['Menu']['path'] == '') {
                $str .= "<li><a >" . $menu['Menu']['name'] . "</a>";
            } else {
                $str .= "<li><a href='" . $menu['Menu']['path'] . "'>" . $menu['Menu']['name'] . "</a>";
            }

            if ($key != count($menus) - 1) {

                $str .= "<i class='icon-angle-right'></i>";

            }

            $str .= "</li>";
        }
        return $str;
    }


    /*
    * 通过儿子，找到他的所有父亲
    */
    static public function getParents($cate, $id)
    {
        $arr = array();
        foreach ($cate as $v) {
            if ($v['Menu']['id'] == $id) {
                $arr[] = $v;
                $arr = array_merge(self::getParents($cate, $v['Menu']['pid']), $arr);
            }
        }
        return $arr;
    }


    //通过路径获取标题
    Public function getTitleName($name)
    {

        //通过传送过来的菜单路径 反查数据库中该路径的ID
        $name = $this->find("first", array("conditions" => array("Menu.path" => $name), "fields" => array("id", "name")));

        return (isset($name['Menu']['name']) ? $name['Menu']['name'] : "");
    }
}