<?php
	//加载本页面专属css样式
	$this->Html->css(array('select2_metro','DT_bootstrap','fullcalendar'),array('block'=>'cssInHead','inline'=>false));
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
<div class="search_area">
    <?php
        echo $this->Form->create('',array('method'=>"post",'accept-charset'=>"utf-8","url"=>array('controller'=>'Roles','action'=>'index',)));
    ?>

    <label class='search_condition'>　关键字 </label>

    <?php
    echo $this->Form->input('name',array('placeholder'=>'关键字搜索','class'=>"span2
    m-wrap",'div'=>false,'label'=>false));
    ?>

    <a style="margin-right: 10px;" href="/Roles/add" class="btn blue pull-right"><i class="icon-plus"></i> 添加</a>
    <button style="margin-right: 10px;" type="submit" class="btn blue pull-right"><i class="icon-search"></i> 搜索
    </button>
    <?php echo $this->Form->end();?>
</div>

<?php echo $this->Session->flash(); ?>

<div class="portlet box blue">

    <div class="portlet-title">

        <div class="caption"><i class="icon-globe"></i><?php echo $title_for_layout; ?></div>
        <div class="tools">
            <span onclick="location.reload();" style="cursor: pointer;color: white;font-size: 15px">刷新</span>
        </div>
    </div>
    <div class="portlet-body">

        <table class="table-bordered table table-hover">

            <thead>

            <tr>
                <th>角色名称</th>
                <th>角色描述</th>
                <th>最近操作时间</th>
                <th>管理</th>
            </tr>

            </thead>

            <tbody>
            <?php if(!empty($roles)):?>
            <?php foreach($roles as $role):?>
            <tr>
                <td><?php echo $role['Role']['role_name'];?></td>
                <td><?php echo $role['Role']['role_describle'];?></td>
                <td><?php echo $role['Role']['modified'];?></td>
                <td>
                    <a class="btn green mini" href="/Roles/rol_edit/<?php echo $role['Role']['id'];?>">编辑</a>
                    <a class="btn yellow mini" href="/Roles/rol_detail/<?php echo $role['Role']['id'];?>">详情</a>
                    <?php
                        echo $this->Form->postLink('删除 ',array('action'=>'del','?'=>array('role'=>$role['Role']['id'])),array('class'=>'btn red mini','style'=>'margin-left:5px','confirm'=>'删除后不可恢复! 确定删除该角色？'));
                    ?>
                </td>
            </tr>
            <?php endforeach;?>
            <?php else:?>
            <tr>
                <td colspan="100" style="color: red;text-align: center">暂无相关数据</td>
            </tr>
            <?php endif;?>
            </tbody>

        </table>

    </div>

</div>

<div class="pagination" style="text-align: center;">
    <ul>
        <?php
            //echo $this->Paginator->counter('共 {:pages} 页 共 {:count} 条记录');
            echo $this->Paginator->first('首页',array('tag'=>'li','separator'=>false,));
            echo $this->Paginator->prev('‹',array('tag'=>'li','separator'=>false,'disabledTag'=>'a'));
            echo $this->Paginator->numbers(array('tag'=>'li','separator'=>false,'currentClass'=>'active','currentTag'=>'a'));
            echo $this->Paginator->next('›',array('tag'=>'li','separator'=>false,'disabledTag'=>'a'));
            echo $this->Paginator->last('末页',array('tag'=>'li','separator'=>false));
        ?>
    </ul>
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
echo $this->Html->script("table-advanced");
?>
<script>

    jQuery(document).ready(function () {

        App.init();

        TableAdvanced.init();

    });


</script>