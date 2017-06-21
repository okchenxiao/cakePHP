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
                    <a href="javascript:;" class="collapse"></a>
                    <a href="javascript:;" class="reload"></a>
                </div>
            </div>
            <div class="portlet-body form">

                <?php echo $this->Form->create('',array('class'=>'form-horizontal'));?>

                <div class="control-group">
                    <label class="control-label">权限名称</label>

                    <div class="controls">
                        <?php echo $this->Form->input('auth_name',array('label'=>false,'class'=>'span6 m-wrap
                        popovers','required'=>false,'placeholder'=>'例:Index/index','data-content'=>'此处填入权限名称为控制器方法名称'));?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">权限描述</label>

                    <div class="controls">
                        <?php echo $this->Form->input('auth_describle',array('label'=>false,'class'=>'span6 m-wrap
                        popovers','required'=>true,'data-content'=>'此处填入权限中文说明'));?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">父级</label>

                    <div class="controls">
                        <select class="span6 selects" data-placeholder="Choose a Category" tabindex="1"
                                name="data[Authority][pid]">
                            <option value="0">请选择</option>
                            <?php foreach($Authoritielist as $key=>$auth) :?>
                                <option value="<?php echo $auth['id']?>"><?php echo $auth['auth_describle']?></option>
                                <?php if (count($auth['child']) > 0) : foreach($auth['child'] as $ke=>$me) : ?>
                                    <option value="<?php echo $me['id']?>">
                                    &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $me['auth_describle']?></option>
                                    <?php if (count($me['child']) > 0) : foreach($me['child'] as $k=>$m) : ?>
                                        <option value="<?php echo $m['id']?>" disabled>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $m['auth_describle']?></option>
                                    <?php  endforeach;endif; ?>
                                <?php  endforeach;endif; ?>
                            <?php endforeach;?>
                        </select>
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
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<?php 
	//app.js为公用js文件
echo $this->Html->script("app");
?>
<!-- END PAGE LEVEL SCRIPTS -->

<script>

    jQuery(document).ready(function () {

        App.init();

    });

</script>

<!-- END JAVASCRIPTS -->   
