<?php 
	//加载本页面专属css样式
	$this->Html->css(array('jquery.ztree/zTreeStyle'),array('block'=>'cssInHead','inline'=>false));
//加载公共头部文件
echo $this->element('theme1/CommonHead');
echo $this->element('theme1/CommonLeft');

?>

<!-- BEGIN PAGE TITLE & BREADCRUMB-->
<SCRIPT type="text/javascript">
    <!--
    var setting = {
        edit: {
            enable: true,
            showRemoveBtn: true,
            removeTitle: setRemoveTitle,
            showRenameBtn: true,
            renameTitle: setRenameTitle
        },
        data: {
            simpleData: {
                enable: true
            }
        },
        callback: {
            beforeDrag: beforeDrag,
            beforeRename: zTreeBeforeRename,
            beforeRemove: zTreeBeforeRemove,
            onRemove: zTreeOnRemove
        }
    };


    function beforeDrag(treeId, treeNodes) {
        return false;
    }

    //删除前提示
    function zTreeBeforeRemove(treeId, treeNode) {
        if (confirm("温馨提示：删除后不可恢复，是否执行删除操作？")) {
            return true;
        }

        return false;
    }

    //删除后执行
    function zTreeOnRemove(event, treeId, treeNode) {
        $.post("<?php echo $this->Html->url('/Menus/ajaxDelById')?>", {"key": treeNode.id}, function (e) {
            if (e == 1) {
                alert("删除成功!");
            } else if (e == 2) {
                alert("删除失败!刷新后重试!");
            }
        });
    }


    //修改成功后执行
    function zTreeBeforeRename(treeId, treeNode, newName, isCancel) {

        $.post("<?php echo $this->Html->url('/Menus/ajaxEditMenuName')?>", {"key": treeNode.id,"name": newName}, function (e) {
            if (e == 1) {
                alert("编辑成功!");
            } else if (e == 2) {
                alert("编辑失败!");
                //取消 zTree 的编辑名称状态，恢复该节点原有名称
                var treeObj = $.fn.zTree.getZTreeObj("tree");
                treeObj.cancelEditName();
            }
        }, "html");

    }

    function setRenameTitle(treeId, treeNode) {
        return treeNode.isParent ? "编辑父节点名称" : "编辑子节点名称";
    }

    function setRemoveTitle(treeId, treeNode) {
        return treeNode.isParent ? "删除父节点" : "删除子节点";
    }
    //-->
</SCRIPT>
<h3 class="page-title">

    <?php echo $title_for_layout; ?>
    <small><?php echo $title_for_layout; ?></small>

</h3>

<ul class="breadcrumb">

    <?php echo $daohang; ?>
</ul>

<?php echo $this->Session->flash(); ?>

<div class="row-fluid">

    <div class="span12">

        <div class="portlet box grey">

            <div class="portlet-title">

                <div class="caption"><i class="icon-comments"></i><?php echo $title_for_layout; ?></div>

                <div class="tools">
                    <a href="<?php echo $this->Html->url('/Menus/add');?>" class="btn yellow mini"><i class="icon-plus"></i>添加</a>
                    <a href="javascript:;" class="collapse"></a>
                    <a href="javascript:;" class="reload"></a>
                </div>

            </div>

            <div class="portlet-body fuelux">

                <ul id="tree" class="ztree" style="overflow:auto;"></ul>

            </div>

        </div>

    </div>

</div>


<?php 
	//加载公共页脚文件
	echo $this->element('theme1/CommonFooter');
?>

<!-- END FOOTER -->

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->

<!-- BEGIN CORE PLUGINS -->

<?php 
	//加载公共js文件
	echo $this->element('theme1/CommonJs');
?>
<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->

<?php 
	//加载本页面专属js文件
	echo $this->Html->script(array('jquery.ztree/jquery.ztree.core','jquery.ztree/jquery.ztree.excheck','jquery.ztree/jquery.ztree.exedit'));
?>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<?php 
	//app.js为公用js文件
	echo $this->Html->script("app");
//加载自定义本页面js文件
?>

<!-- END PAGE LEVEL SCRIPTS -->

<script>

    jQuery(document).ready(function () {

        App.init();

        var zNodestr;
        $.post("<?php echo $this->Html->url('/Menus/ajaxChildMenuList')?>", {"key": 1}, function (e) {
            zNodestr = "[";
            for (var i = e.length - 1; i >= 0; i--) {
                if (e[i]['Menu']['pid'] == 0) {
                    zNodestr += "{id:" + e[i]['Menu']['id'] + ", pId:" + e[i]['Menu']['pid'] + ", name:'" + e[i]['Menu']['name'] + "', open:false}";
                } else {
                    zNodestr += "{id:" + e[i]['Menu']['id'] + ", pId:" + e[i]['Menu']['pid'] + ", name:'" + e[i]['Menu']['name'] + "', file:'" + e[i]['Menu']['path'] + "'}";

                }
                if (i >= 1) {
                    zNodestr += ",";
                }
            }
            zNodestr += "]";

            var zNodes = eval('(' + zNodestr + ')');
            var t = $("#tree");
            t = $.fn.zTree.init(t, setting, zNodes);

        }, "json");


    });

</script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>