<?php 
//加载公共头部文件
echo $this->element('theme1/CommonHead');
echo $this->element('theme1/CommonLeft');

?>
<h3 class="page-title">
    <?php echo $title_for_layout; ?>
    <small><?php echo $title_for_layout; ?></small>
</h3>
<ul class="breadcrumb">
    <?php echo $daohang; ?>
</ul>

<div class="row-fluid">

    <div class="span12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="icon-reorder"></i><?php echo $title_for_layout; ?></div>
                <div class="tools">
                    <span onclick="location.reload();" style="cursor: pointer;color: white;font-size: 15px">刷新</span>
                </div>
            </div>
            <div class="portlet-body form">
                <table class="table-bordered table table-hover">
                    <?php if(!empty($detail)):?>
                    <tr>
                        <td>角色名称</td>
                        <td><?php echo $detail['Role']['role_name'];?></td>
                    </tr>
                    <tr>
                        <td>角色描述</td>
                        <td><?php echo $detail['Role']['role_describle'];?></td>
                    </tr>
                    <tr>
                        <td>最近操作时间</td>
                        <td><?php echo $detail['Role']['modified'];?></td>
                    </tr>
                    <tr>
                        <td>拥有权限</td>
                        <td><?php echo $detail['Auth'];?></td>
                    </tr>
                    <tr>
                        <td>可见菜单</td>
                        <td><?php echo $detail['Menu'];?></td>
                    </tr>
                    <?php else:?>
                    <tr>
                        <td colspan="100" style="color: red;text-align: center">暂无相关数据</td>
                    </tr>
                    <?php endif;?>
                </table>
                <div class="form-actions" style="text-align: center;padding-left: 0;">

                    <a href="/Roles/index" class="btn blue"><i class="icon-hand-left"></i> 返回列表</a>

                </div>
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
	//app.js为公用js文件
echo $this->Html->script("app");
?>
<script>

    jQuery(document).ready(function () {

        App.init();

    });

</script>