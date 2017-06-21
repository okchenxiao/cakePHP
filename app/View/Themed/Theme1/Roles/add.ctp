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

                <?php echo $this->Form->create('Role',array('class'=>'form-horizontal'));?>
                <div class="control-group">
                    <label class="control-label">角色名称</label>

                    <div class="controls">
                        <?php echo $this->Form->input('role_name',array('label'=>false,'class'=>'span6 m-wrap
                        popovers','placeholder'=>'请输入角色名称','required'=>true));?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">角色描述</label>

                    <div class="controls">
                        <?php echo $this->Form->input('role_describle',array('label'=>false,'class'=>'span6 m-wrap
                        popovers','placeholder'=>'请输入角色说明','required'=>true));?>
                    </div>
                </div>
                <div class="form-actions" style="padding-left: 290px;">

                    <button type="submit" class="btn blue"><i class="icon-ok"></i> 确认添加</button>

                </div>

                <?php echo $this->Form->end();?>
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