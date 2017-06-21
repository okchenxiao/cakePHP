<?php 
	//加载本页面专属css样式
$this->Html->css(array('bootstrap-fileupload','chosen','profile'),array('block'=>'cssInHead','inline'=>false));
//加载公共头部文件
echo $this->element('theme1/CommonHead');
echo $this->element('theme1/CommonLeft');

?>
<style>
    #uniform-UserSex1+label{
        display: inline-block;
        margin-right: 10px;
        margin-left: 2px;
        padding-top: 5px;
    }
    #uniform-UserSex2+label{
        display: inline-block;
        margin-right: 10px;
        margin-left: 2px;
        padding-top: 5px;
    }
</style>
<!-- BEGIN PAGE TITLE & BREADCRUMB-->

<h3 class="page-title">

    个人中心
    <small>个人资料</small>

</h3>

<ul class="breadcrumb">

    <li>

        <i class="icon-home"></i>

        <a href="<?php echo $this->Html->url('/Index/index');?>">首页</a>

        <i class="icon-angle-right"></i>

    </li>

    <li><a href="#">个人中心</a></li>

</ul>

<?php echo $this->Session->flash(); ?>

<div class="row-fluid profile">

    <div class="span12">

        <!--BEGIN TABS-->

        <div class="tabbable tabbable-custom tabbable-full-width">

            <ul class="nav nav-tabs">

                <li class="active"><a href="#tab_1_1" data-toggle="tab">概述</a></li>

                <li><a href="#tab_1_2" data-toggle="tab">个人简介</a></li>

                <li><a href="#tab_1_3" data-toggle="tab">帐户资料</a></li>

                <!--<li><a href="#tab_1_4" data-toggle="tab">项目</a></li>-->

            </ul>

            <div class="tab-content">

                <div class="tab-pane row-fluid active" id="tab_1_1">

                    <ul class="unstyled profile-nav span3">

                        <li><?php
                                $img='/image/profile-img.png';
                                if($info['User']['face']!=''){
                                    $img=$info['User']['face'];
                                }
                                echo $this->Html->image($img);
                            ?>
                        </li>
                    </ul>

                    <div class="span9">

                        <div class="row-fluid">

                            <div class="span8 profile-info">

                                <h1><?php echo $info['User']['username'];?></h1>

                                <p><i class="icon-windows"></i> 个人简介：<?php echo $info['User']['describe'];?></p>
                                <p><i class="icon-calendar"></i> 生日：<?php echo $info['User']['birthday'];?></p>

                            </div>

                        </div>

                    </div>
                </div>

                <!--end tab-pane-->

                <div class="tab-pane profile-classic row-fluid" id="tab_1_2">

                    <div class="span2"><?php
                        $img='/image/profile-img.png';
                        if($info['User']['face']!=''){
                            $img=$info['User']['face'];
                        }
                        echo $this->Html->image($img);
                    ?>
                    </div>

                    <ul class="unstyled span10">

                        <li><span>姓名:</span> <?php echo $info['User']['username']?></li>

                        <li><span>性别:</span> <?php if($info['User']['sex']==1){echo '男';}else{echo '女';} ?></li>

                        <li><span>生日:</span> <?php echo $info['User']['birthday']?></li>

                        <li><span>电话:</span> <?php echo $info['User']['telphone']?></li>

                        <li><span>Email:</span> <?php echo $info['User']['email']?></li>

                        <li><span>用户角色:</span> <?php echo $info['Role']['role_name']?></li>

                        <li><span>自我介绍:</span> <?php echo $info['User']['describe']?></li>

                    </ul>

                </div>

                <!--tab_1_2-->

                <div class="tab-pane row-fluid profile-account" id="tab_1_3">

                    <div class="row-fluid">

                        <div class="span12">

                            <div class="span3">

                                <ul class="ver-inline-menu tabbable margin-bottom-10">

                                    <li class="active">

                                        <a data-toggle="tab" href="#tab_1-1">

                                            <i class="icon-cog"></i>

                                            个人信息

                                        </a>

                                        <span class="after"></span>

                                    </li>

                                    <li class=""><a data-toggle="tab" href="#tab_2-2"><i class="icon-picture"></i> 更改头像</a>
                                    </li>

                                    <li class=""><a data-toggle="tab" href="#tab_3-3"><i class="icon-lock"></i> 修改密码</a>
                                    </li>

                                </ul>

                            </div>

                            <div class="span9">

                                <div class="tab-content">

                                    <div id="tab_1-1" class="tab-pane active">

                                        <div style="height: auto;" id="accordion1-1" class="accordion collapse">

                                            <?php echo $this->Form->create('',array('url'=>'center_edit','id'=>'center_edit'));?>

                                            <label class="control-label">姓名</label>
                                            <?php echo $this->Form->input('username',array('label'=>false,'class'=>'m-wrap
                                            span8','required'=>true,'value'=>$info['User']['username']));?>

                                            <label class="control-label">性别</label>

                                            <?php echo $this->Form->radio('sex',array('1'=>' 男 ','2'=>' 女'),array('value'=>$info['User']['sex'],'class'=>"m-wrap span8",'legend'=>false));?>

                                            <label class="control-label">生日</label>

                                            <?php
                                                $controltime = 'yyyy-MM-dd';
                                                echo $this->Form->input('birthday',array('type'=>'text','value'=>$info['User']['birthday'],'required'=>true,'class'=>"m-wrap span8",'placeholder'=>"出生日期",'div'=>false,'label'=>false,'onclick'=>"WdatePicker({dateFmt:'$controltime'})",'readonly'=>'readonly'));
                                            ?>


                                            <label class="control-label">电话</label>

                                            <?php echo $this->Form->input('telphone',array('label'=>false,'class'=>'m-wrap
                                            span8','required'=>true,'value'=>$info['User']['telphone']));?>

                                            <label class="control-label">Email</label>

                                            <?php echo $this->Form->input('email',array('label'=>false,'class'=>'m-wrap
                                            span8','required'=>true,'value'=>$info['User']['email']));?>

                                            <label class="control-label">自我介绍</label>

                                            <?php echo $this->
                                            Form->input('describe',array('label'=>false,'type'=>'textarea','class'=>'m-wrap
                                            span8','value'=>$info['User']['describe']));?>
                                            <div class="submit-btn">

                                                <?php echo $this->Form->end(array('label'=>'确认修改','class'=>'btn green'));?>
                                            </div>
                                        </div>

                                    </div>

                                    <div id="tab_2-2" class="tab-pane">

                                        <div style="height: auto;" id="accordion2-2" class="accordion collapse">

                                            <?php echo $this->Form->create('',array('url'=>'change_avatar','id'=>'change_avatar','enctype'=>'multipart/form-data'));?>

                                            <div class="controls">

                                                <div id="show_img" style="max-width: 400px;">
                                                    <?php
                                                        $img='/image/profile-img.png';
                                                        if($info['User']['face']!=''){
                                                        $img=$info['User']['face'];
                                                        }
                                                        echo $this->Html->image($img,array('style'=>"max-width: 400px;max-height: 300px;"));
                                                    ?>

                                                </div>

                                            </div>

                                            <div class="space10"></div>

                                            <div class="fileupload fileupload-new" data-provides="fileupload">

                                                <div class="input-append">

                                                    <span class="btn btn-file">

                                                        <span class="upload-new">选择文件</span>
                                                        <input type="file" id="upload_ava" accept="image/jpeg,image/gif,image/png,image/jpg"/>
                                                    </span>

                                                </div>

                                            </div>

                                            <div class="clearfix"></div>

                                            <div class="controls">

                                                <span class="label label-important">温馨提示!</span>

                                                <span>建议图片尺寸最好为正方形!</span>

                                            </div>

                                            <div class="space10"></div>

                                            <div class="submit-btn">

                                                <?php echo $this->Form->end(array('label'=>'确认修改','class'=>'btn green up_img_btn'));?>

                                            </div>

                                            </form>

                                        </div>

                                    </div>

                                    <div id="tab_3-3" class="tab-pane">

                                        <div style="height: auto;" id="accordion3-3" class="accordion collapse">

                                            <?php echo $this->Form->create('',array('url'=>'change_password','id'=>'change_password'));?>

                                            <label class="control-label">当前密码</label>

                                            <?php echo $this->Form->input('nowpassword',array('label'=>false,'class'=>'m-wrap
                                            span8','type'=>'password','required'=>true));?>

                                            <label class="control-label">新密码</label>

                                            <?php echo $this->Form->input('password',array('label'=>false,'class'=>'m-wrap
                                            span8','type'=>'password','required'=>true));?>

                                            <label class="control-label">确认密码</label>

                                            <?php echo $this->Form->input('newpassword',array('label'=>false,'class'=>'m-wrap
                                            span8','type'=>'password','required'=>true));?>

                                            <div class="submit-btn">

                                                <?php echo $this->Form->end(array('label'=>'确认修改','class'=>'btn green'));?>

                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>

                            <!--end span9-->

                        </div>

                    </div>

                </div>

                <!--end tab-pane-->

                <!--<div class="tab-pane" id="tab_1_4">-->

                    <!--<div class="row-fluid add-portfolio">-->

                        <!--<div class="pull-left">-->

                            <!--<span>本周售出502项</span>-->

                        <!--</div>-->

                        <!--<div class="pull-left">-->

                            <!--<a href="#" class="btn icn-only green">添加新项目 <i-->
                                    <!--class="m-icon-swapright m-icon-white"></i></a>-->

                        <!--</div>-->

                    <!--</div>-->

                    <!--&lt;!&ndash;end add-portfolio&ndash;&gt;-->

                    <!--<div class="row-fluid portfolio-block">-->

                        <!--<div class="span5 portfolio-text">-->

                            <!--<?php echo $this->Html->image("logo_metronic.jpg") ?>-->

                            <!--<div class="portfolio-text-info">-->

                                <!--<h4>该反应的模板</h4>-->

                                <!--<p>现象出现持续存在瑕疵的范德萨发大水富富打死辅导费是否发的发的第三方</p>-->

                            <!--</div>-->

                        <!--</div>-->

                        <!--<div class="span5" style="overflow:hidden;">-->

                            <!--<div class="portfolio-info">-->

                                <!--今日销售额-->

                                <!--<span>187</span>-->

                            <!--</div>-->

                            <!--<div class="portfolio-info">-->

                                <!--总销售额-->

                                <!--<span>1789</span>-->

                            <!--</div>-->

                            <!--<div class="portfolio-info">-->

                                <!--盈利-->

                                <!--<span>$37.240</span>-->

                            <!--</div>-->

                        <!--</div>-->

                        <!--<div class="span2 portfolio-btn">-->

                            <!--<a href="#" class="btn bigicn-only"><span>管理</span></a>-->

                        <!--</div>-->

                    <!--</div>-->

                    <!--&lt;!&ndash;end row-fluid&ndash;&gt;-->

                    <!--<div class="row-fluid portfolio-block">-->

                        <!--<div class="span5 portfolio-text">-->

                            <!--<?php echo $this->Html->image("logo_azteca.jpg") ?>-->

                            <!--<div class="portfolio-text-info">-->

                                <!--<h4>Metronic - Responsive Template</h4>-->

                                <!--<p>Lorem ipsum dolor sit consectetuer adipiscing elit.</p>-->

                            <!--</div>-->

                        <!--</div>-->

                        <!--<div class="span5">-->

                            <!--<div class="portfolio-info">-->

                                <!--今日销售额-->

                                <!--<span>24</span>-->

                            <!--</div>-->

                            <!--<div class="portfolio-info">-->

                                <!--总销售额-->

                                <!--<span>660</span>-->

                            <!--</div>-->

                            <!--<div class="portfolio-info">-->

                                <!--盈利-->

                                <!--<span>$7.060</span>-->

                            <!--</div>-->

                        <!--</div>-->

                        <!--<div class="span2 portfolio-btn">-->

                            <!--<a href="#" class="btn bigicn-only"><span>管理</span></a>-->

                        <!--</div>-->

                    <!--</div>-->

                    <!--&lt;!&ndash;end row-fluid&ndash;&gt;-->

                    <!--<div class="row-fluid portfolio-block">-->

                        <!--<div class="span5 portfolio-text">-->

                            <!--<?php echo $this->Html->image("logo_conquer.jpg") ?>-->

                            <!--<div class="portfolio-text-info">-->

                                <!--<h4>Metronic - Responsive Template</h4>-->

                                <!--<p>Lorem ipsum dolor sit consectetuer adipiscing elit.</p>-->

                            <!--</div>-->

                        <!--</div>-->

                        <!--<div class="span5" style="overflow:hidden;">-->

                            <!--<div class="portfolio-info">-->

                                <!--今日销售额-->

                                <!--<span>24</span>-->

                            <!--</div>-->

                            <!--<div class="portfolio-info">-->

                                <!--总销售额-->

                                <!--<span>975</span>-->

                            <!--</div>-->

                            <!--<div class="portfolio-info">-->

                                <!--盈利-->

                                <!--<span>$21.700</span>-->

                            <!--</div>-->

                        <!--</div>-->

                        <!--<div class="span2 portfolio-btn">-->

                            <!--<a href="#" class="btn bigicn-only"><span>管理</span></a>-->

                        <!--</div>-->

                    <!--</div>-->

                    <!--&lt;!&ndash;end row-fluid&ndash;&gt;-->

                <!--</div>-->

                <!--end tab-pane-->

            </div>

        </div>

        <!--END TABS-->

    </div>

</div>

<!-- END PAGE CONTENT-->

</div>

<!-- END PAGE CONTAINER-->

</div>

<!-- END PAGE -->

</div>

<!-- END CONTAINER -->

<!-- BEGIN FOOTER -->

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
echo $this->Html->script(array('bootstrap-fileupload','chosen.jquery.min'));
?>

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<?php 
	//app.js为公用js文件
echo $this->Html->script("app");
//加载自定义本页面js文件
echo $this->Html->script("/js/calendar/WdatePicker.js");
?>
<!-- END PAGE LEVEL SCRIPTS -->

<script>

    jQuery(document).ready(function () {

        // initiate layout and plugins

        App.init();

    });

    //修改个人资料提交表单数据时
    $('#center_edit').submit(function(){
        var birthday=$('#UserBirthday').val();
        var tel=$('#UserTelphone').val();
        var reg_phone=/^(13\d|14[579]|15\d|17[01235678]|18\d)\d{8}$/i;
        if(birthday==''){
            alert('请选择出生日期');return false;
        }
        if(!reg_phone.test(tel)){
            alert('请输入正确的手机号码');return false;
        }
    });

    //上传头像 图片压缩
    //图片显示区域  上传区域
    var imgArea = $("#show_img");
    //触发选择控件
    $("#upload_ava").change(function(){
        var _this = $(this)[0],
                _file = _this.files[0],
                fileType = _file.type;
        var img_name=_file.name;
        if(/image\/\w+/.test(fileType)){
            var fileReader = new FileReader();
            fileReader.readAsDataURL(_file);
            fileReader.onload = function(event){
                var result = event.target.result;   //返回的dataURL
                var image = new Image();
                image.src = result;
                image.onload = function(){  //创建一个image对象，给canvas绘制使用
                    var cvs = document.createElement('canvas');
                    var scale = 1;
                    if(this.width > 500 || this.height > 500){  //1000只是示例，可以根据具体的要求去设定
                        if(this.width > this.height){
                            scale = 500 / this.width;
                        }else{
                            scale = 500 / this.height;
                        }
                    }
                    cvs.width = this.width*scale;
                    cvs.height = this.height*scale;     //计算等比缩小后图片宽高
                    var ctx = cvs.getContext('2d');
                    ctx.drawImage(this, 0, 0, cvs.width, cvs.height);
                    var newImageData = cvs.toDataURL(fileType, 0.8);   //重新生成图片，<span style="font-family: Arial, Helvetica, sans-serif;">fileType为用户选择的图片类型</span>
                    $('#show_img').children().remove();
                    imgArea.append('<img style="max-width: 400px;max-height: 300px;" src="'+ newImageData +'">');
                    var sendData = newImageData.replace("data:"+fileType+";base64,",'');
                    imgArea.append('<input type="hidden" name="img_name" value="'+img_name+'"/>');
                    imgArea.append('<input type="hidden" name="img_source" value="'+sendData+'"/>');
                }
            }
        }else{
            alert('请选择图片格式文件!');
        }
    });

    //表单的提交事件
    $('.up_img_btn').click(function(){
        if(imgArea.find('input').length==0){
            alert('你并没有过任何修改!');
            return false;
        }
    });

</script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>