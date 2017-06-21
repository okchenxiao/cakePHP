<?php 
	//加载公共头部文件
echo $this->element('theme1/CommonHead');
echo $this->element('theme1/CommonLeft');

?>
<style>
    .is_show label{
        display: inline-block;
        margin-right: 10px;
        margin-left: 2px;
        padding-top: 5px;
    }
</style>
<h3 class="page-title">
    <?php echo $title_for_layout ?>
    <small><?php echo $title_for_layout ?></small>
</h3>
<ul class="breadcrumb">
    <?php echo $daohang; ?>
</ul>

<div class="row-fluid">
    <div class="span12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="icon-reorder"></i><?php echo $title_for_layout ?></div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                    <a href="javascript:;" class="reload"></a>
                </div>
            </div>
            <div class="portlet-body form">
                <?php echo $this->Form->create('',array('class'=>'form-horizontal'));?>
                <div class="control-group">
                    <label class="control-label">icon标签名</label>

                    <div class="controls">
                        <?php echo $this->Form->input('icon',array('label'=>false,'class'=>'span6 m-wrap
                        popovers','data-content'=>'此处填入菜单名前的图标属性名'));?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">菜单名</label>

                    <div class="controls">
                        <?php echo $this->Form->input('name',array('label'=>false,'class'=>'span6 m-wrap
                        popovers','data-content'=>'此处填入菜单名'));?>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">路径</label>

                    <div class="controls">
                        <?php echo $this->Form->input('path',array('label'=>false,'class'=>'span6 m-wrap
                        popovers','data-content'=>'此处填写菜单路径(例：/User/index)'));?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">父级菜单</label>

                    <div class="controls">
                        <select class="span6 selects" data-placeholder="Choose a Category" tabindex="1"
                                name="data[Menu][pid]">
                            <option value="0">请选择</option>
                            <?php foreach($menulist as $key=>$menu) :?>
                            <option value="<?php echo $menu['id']?>"><?php echo $menu['name']?></option>
                            <?php if (count($menu['child']) > 0) :
                            foreach($menu['child'] as $ke=>$me) : ?>
                            <option value="<?php echo $me['id']?>">
                                &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $me['name']?></option>
                            <?php if (count($me['child']) > 0) :
                            foreach($me['child'] as $k=>$m) : ?>
                            <option value="<?php echo $m['id']?>" disabled>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $m['name']?></option>
                            <?php  endforeach;
											  endif; ?>
                            <?php  endforeach;
									  endif; ?>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">排序</label>

                    <div class="controls">
                        <?php echo $this->Form->input('sort',array('label'=>false,'class'=>'span6 m-wrap
                        popovers','type'=>'text',"value"=>10));?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">显示</label>

                    <div class="controls is_show">

                        <?php echo $this->Form->radio('is_show',array('1'=>' 是 ','2'=>' 否'),array('default'=>'1','class'=>"m-wrap span6",'legend'=>false));?>

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