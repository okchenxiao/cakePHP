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
        echo $this->Form->create('',array('method'=>"post",'accept-charset'=>"utf-8","url"=>array('controller'=>'Users','action'=>'index',)));
    ?>

    <label class='search_condition'>　关键字 </label>

    <?php
    echo $this->Form->input('name',array('placeholder'=>'用户名/姓名关键字','class'=>"span2
    m-wrap",'div'=>false,'label'=>false));
    ?>

    &nbsp;&nbsp;

    <label class='search_condition'> 账号状态 </label>
    <?php
    echo $this->Form->select('is_login',array('1'=>'正常','0'=>'禁用'),array('class'=>"span2
    m-wrap",'empty'=>'全部','div'=>false,'label'=>false));
    ?>

    &nbsp;&nbsp;

    <label class='search_condition'> 最近登录时间 </label>
    <?php
    $controltime = 'yyyy-MM-dd';
    echo $this->Form->input('begin',array('type'=>'text','id'=>'start_time','class'=>"m-wrap span",'maxlength'=>"30",'placeholder'=>"开始时间",'div'=>false,'label'=>false,'onclick'=>"WdatePicker({dateFmt:'$controltime'})",'style'=>'width:120px','readonly'=>'readonly'));
    ?>

    <label class='search_condition'> -- </label>
    <?php
    $controltime = 'yyyy-MM-dd';
    echo $this->Form->input('end',array('type'=>'text','id'=>'start_time','class'=>"m-wrap span",'maxlength'=>"30",'placeholder'=>"结束时间",'div'=>false,'label'=>false,'onclick'=>"WdatePicker({dateFmt:'$controltime'})",'style'=>'width:120px','readonly'=>'readonly'));
    ?>
    <a style="margin-right: 10px;" href="/Users/add" class="btn blue pull-right"><i class="icon-plus"></i> 添加</a>
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
                <th>用户名</th>
                <th>姓名</th>
                <th>性别</th>
                <th>出身日期</th>
                <th>电话</th>
                <th>E-mail</th>
                <th>账号状态</th>
                <th>最后登录IP</th>
                <th>最后登录时间</th>
                <th>管理</th>
            </tr>

            </thead>

            <tbody>
            <?php if(!empty($users)):?>
            <?php foreach($users as $user):?>
            <tr>
                <td><?php echo $user['User']['loginname'];?></td>
                <td><?php echo $user['User']['username'];?></td>
                <td><?php if($user['User']['sex']==1){echo '男';}else{echo '女';}?></td>
                <td><?php echo $user['User']['birthday'];?></td>
                <td><?php echo $user['User']['telphone'];?></td>
                <td><?php echo $user['User']['email'];?></td>
                <td><?php if($user['User']['is_login']==1){echo '正常';}else{echo '禁用';}?></td>
                <td><?php echo $user['User']['last_login_ip'];?></td>
                <td><?php echo $user['User']['last_login_time'];?></td>
                <td>
                    <?php
                        echo $this->Form->postLink('删除 ',array('action'=>'del','?'=>array('user'=>$user['User']['id'])),array('class'=>'btn red mini','style'=>'margin-left:5px','confirm'=>'删除后不可恢复! 确定删除该用户？'));
                    if($user['User']['is_login']==1){
                        echo $this->Form->postLink(' 禁用',array('action'=>'is_login','?'=>array('user'=>$user['User']['id'],'is_login'=>$user['User']['is_login'])),array('class'=>'btn yellow mini','style'=>'margin-left:5px','confirm'=>'确定要禁用该用户？'));
                    }
                    if($user['User']['is_login']==0){
                        echo $this->Form->postLink(' 激活',array('action'=>'is_login','?'=>array('user'=>$user['User']['id'],'is_login'=>$user['User']['is_login'])),array('class'=>'btn yellow mini','style'=>'margin-left:5px','confirm'=>'确定要激活该用户？'));
                    }
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
echo $this->Html->script("/js/calendar/WdatePicker.js");
echo $this->Html->script("table-advanced");
?>
<script>

    jQuery(document).ready(function () {

        App.init();

        TableAdvanced.init();

    });


</script>