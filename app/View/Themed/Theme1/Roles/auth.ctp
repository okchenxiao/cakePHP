<?php 
$this->Html->css(array('jquery.ztree/zTreeStyle'),array('block'=>'cssInHead','inline'=>false));
//加载公共头部文件
echo $this->element('theme1/CommonHead');
echo $this->element('theme1/CommonLeft');
?>
<SCRIPT type="text/javascript">
    var setting = {
        edit: {
            enable: true
        },
        data: {
            simpleData: {
                enable: true
            }
        },
        callback: {
            beforeDrag: beforeDrag,
            onClick: zTreeOnClick
        }
    };

    var setting2 = {
        edit: {
            enable: true
        },
        data: {
            simpleData: {
                enable: true
            }
        },
        check: {
            enable: true
        },
        callback: {
            beforeDrag: beforeDrag,
            beforeCheck: zTreeBeforeCheck
        }
    };


    function beforeDrag(treeId, treeNodes) {
        return false;
    }

    function zTreeOnClick(event, treeId, treeNode) {
        // alert(treeNode.tId + ", " + treeNode.name+ ", " + treeNode.id);
        //查找该角色默认的权限
        settree2(treeNode.id);
        $("#roleid").attr("href", "javascript:getCheckedNodes('" + treeNode.id + "')");
    }
    ;

    //取消全部勾选
    function canclechecked(data) {
        var treeObj = $.fn.zTree.getZTreeObj("tree2");
        treeObj.checkAllNodes(data);
    }

    function zTreeBeforeCheck(treeId, treeNode) {
        // return true;
    }

    function getCheckedNodes(data) {
        var treeObj = $.fn.zTree.getZTreeObj("tree2");
        // var nodes = treeObj.getChangeCheckedNodes();
        var nodes = treeObj.getCheckedNodes();
        // alert(nodes.length);
        var idstring = '';
        if (nodes.length < 1 || data < 1 || isNaN(data) == true) {
            alert("非法操作执行失败。");
        } else {
            for (var i = 0; i < nodes.length; i++) {
                if (i == 0) {
                    idstring += nodes[0].id;
                } else {
                    idstring += nodes[i].id;
                }

                if (i != nodes.length) {
                    idstring += ",";
                }
            }

            //执行写入数据库
            $.post("<?php echo $this->Html->url('/Roles/setRol_Auth');?>", {"key": data,"value": idstring}, function (e) {
                if (e == 1) {
                    alert("赋予权限操作成功");
                } else {
                    alert("操作失败，请重试。");
                }
            }, "html");
        }

    }
    function settree2(roleId) {

        if (roleId >= 1) {
            var zNodestr1 = '';
            var authid = '';
            $.post("<?php echo $this->Html->url('/Roles/getRolid_Authlist');?>", {"key": roleId}, function (e) {
                zNodestr1 = "[";
                var arr1 = e['arr1'];
                var arr2 = e['arr2'];
                for (var i = arr2.length - 1; i >= 0; i--) {
                    zNodestr1 += "{id:" + arr2[i]['id'] + ", pId:" + arr2[i]['pid'] + ", name:'" + arr2[i]['auth_describle'];
                    if (arr2[i]['pid'] == 0) {
                        if (arr2[i]['auth_name']) {
                            zNodestr1 += "," + arr2[i]['auth_name'] + "', open:false";
                        } else {
                            zNodestr1 += "', open:false";
                        }
                    } else {
                        if (arr2[i]['auth_name']) {
                            zNodestr1 += "," + arr2[i]['auth_name'] + "', file:''";
                        } else {
                            zNodestr1 += "', file:''";
                        }

                    }
                    for (var j = 0; j < arr1.length; j++) {
                        if (arr2[i]['id'] == arr1[j]) {
                            zNodestr1 += ", checked:true";
                        }
                    }
                    zNodestr1 += "}";
                    if (i >= 1) {
                        zNodestr1 += ",";
                    }
                }
                zNodestr1 += "]";

                var zNodes1 = eval('(' + zNodestr1 + ')');
                var tt = $("#tree2");
                tt = $.fn.zTree.init(tt, setting2, zNodes1);
            }, 'json');
        } else {
            var zNodestr2;
            $.post("<?php echo $this->Html->url('/Roles/getRol_Authlist');?>", {"key": 1}, function (e) {
                zNodestr2 = "[";
                for (var i = e.length - 1; i >= 0; i--) {
                    zNodestr2 += "{id:" + e[i]['Authority']['id'] + ", pId:" + e[i]['Authority']['pid'] + ", name:'" + e[i]['Authority']['auth_describle'];
                    if (e[i]['Authority']['pid'] == 0) {
                        if (e[i]['Authority']['auth_name']) {
                            zNodestr2 += "," + e[i]['Authority']['auth_name'] + "', open:false}";
                        } else {
                            zNodestr2 += "', open:false}";
                        }
                    } else {
                        if (e[i]['Authority']['auth_name']) {
                            zNodestr2 += "," + e[i]['Authority']['auth_name'] + "', file:''}";
                        } else {
                            zNodestr2 += "', file:''}";
                        }
                    }
                    if (i >= 1) {
                        zNodestr2 += ",";
                    }
                }
                zNodestr2 += "]";

                var zNodes2 = eval('(' + zNodestr2 + ')');
                var tt = $("#tree2");
                tt = $.fn.zTree.init(tt, setting2, zNodes2);

            }, "json");
        }
    }
</SCRIPT>
<h3 class="page-title">
    角色权限
    <small>给角色赋予权限</small>
</h3>
<ul class="breadcrumb">
    <?php echo $daohang; ?>
</ul>
<h4>权限赋予</h4>
<div class="row-fluid">
    <div class="span4">
        <div class="portlet box grey">
            <div class="portlet-title">
                <div class="caption"><i class="icon-cogs"></i>角色列表</div>
                <div class="tools">

                    <a href="javascript:;" class="collapse"></a>
                    <a href="javascript:;" class="reload"></a>
                </div>
            </div>
            <div class="portlet-body fuelux">

                <ul id="tree" class="ztree" style="overflow:auto;"></ul>

            </div>
        </div>
    </div>
    <div class="span8">
        <div class="portlet box grey">
            <div class="portlet-title">
                <div class="caption"><i class="icon-cogs"></i>权限赋予</div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                    <a href="javascript:;" class="reload"></a>
                </div>
            </div>
            <div class="portlet-body fuelux">
                <div id="checkvalues"></div>
                <ul id="tree2" class="ztree" style="overflow:auto;"></ul>
                <br>
                <hr>
                <div style="width:100%"><a class="btn blue" id="roleid" href="#"> 保 存 </a> <a class="btn green"
                                                                                              href="javascript:canclechecked(1)">
                    全 选 </a> <a class="btn red" href="javascript:canclechecked(0)"> 取 消 </a></div>
            </div>
        </div>
    </div>
</div>

<?php 
    //加载公共页脚文件
echo $this->element('theme1/CommonFooter');
?>
<?php 
    //加载公共js文件
echo $this->element('theme1/CommonJs');
?>
<?php 
    //加载本页面专属js文件
    echo $this->Html->script(array('jquery.ztree/jquery.ztree.core','jquery.ztree/jquery.ztree.excheck'));
?>
<?php 
    //app.js为公用js文件
echo $this->Html->script("app");
//加载自定义本页面js文件
?>
<script>

    jQuery(document).ready(function () {

        // initiate layout and plugins

        App.init();

        var zNodestr;
        $.post("<?php echo $this->Html->url('/Roles/ajaxGetList');?>", {"key": 1}, function (e) {
            zNodestr = "[";
            for (var i = e.length - 1; i >= 0; i--) {
                if (e[i]['Role']['pid'] == 0) {
                    zNodestr += "{id:" + e[i]['Role']['id'] + ", pId:" + e[i]['Role']['pid'] + ", name:'" + e[i]['Role']['role_name'] + "', open:false}";
                } else {
                    zNodestr += "{id:" + e[i]['Role']['id'] + ", pId:" + e[i]['Role']['pid'] + ", name:'" + e[i]['Role']['role_name'] + "', file:''}";

                }
                if (i >= 1) {
                    zNodestr += ",";
                }
                ;
            }
            ;
            zNodestr += "]";


            var zNodes = eval('(' + zNodestr + ')');
            var t = $("#tree");
            t = $.fn.zTree.init(t, setting, zNodes);


        }, "json");

        settree2(0);

    });
</script>