<?php 
	//加载公共头部文件
echo $this->element('theme1/CommonHead');
echo $this->element('theme1/CommonLeft');

?>
<style>
    .sex label{
        display: inline-block;
        margin-right: 10px;
        margin-left: 2px;
        padding-top: 5px;
    }
</style>

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
                <?php echo $this->Form->create('',array('class'=>'form-horizontal'));?>

                <div class="control-group">
                    <label class="control-label">登陆名</label>

                    <div class="controls">

                        <?php echo $this->Form->input('loginname',array('label'=>false,'class'=>'span6 m-wrap
                        popovers',"onchange" =>"javascript:loginNameExits(this.value)",'placeholder'=>'请输入6~12位字符的登录名','id'=>'loginNameExits1',"maxlength"=>12,"minlength"=>6,"required"=>true));?>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">密　码</label>

                    <div class="controls">
                        <?php echo $this->Form->input('password',array('label'=>false,'class'=>'span6 m-wrap
                        popovers','placeholder'=>'请输入6~12位登录密码','type'=>'password',"required"=>true));?>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">姓　名</label>

                    <div class="controls">

                        <?php echo $this->Form->input('username',array('label'=>false,'class'=>'span6 m-wrap
                        popovers','placeholder'=>'请输入用户姓名',"required"=>true));?>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">性　别</label>

                    <div class="controls sex">

                        <?php echo $this->Form->radio('sex',array('1'=>' 男 ','2'=>' 女'),array('default'=>'1','class'=>"m-wrap span6",'legend'=>false));?>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">出生日期</label>

                    <div class="controls">

                        <?php
                            $controltime = 'yyyy-MM-dd';
                            echo $this->Form->input('birthday',array('type'=>'text','required'=>true,'class'=>"m-wrap span6",'placeholder'=>"用户出生日期",'div'=>false,'label'=>false,'onclick'=>"WdatePicker({dateFmt:'$controltime'})",'readonly'=>'readonly'));
                        ?>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">邮　箱</label>

                    <div class="controls">

                        <?php echo $this->Form->input('email',array('label'=>false,'class'=>'span6 m-wrap
                        popovers','type'=>'email','placeholder'=>'请输入用户邮箱',"required"=>true));?>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">电　话</label>

                    <div class="controls">

                        <?php echo $this->Form->input('telphone',array('label'=>false,'class'=>'span6 m-wrap
                        popovers','placeholder'=>'请输入用户电话',"required"=>true));?>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">角色</label>

                    <div class="controls" style="margin-bottom: 10px;">
                        <select class="span6 selects" tabindex="1" name="data[User][role_id]">
                            <option value="0">请选择角色</option>
                            <?php if(!empty($roles)):?>
                            <?php foreach($roles as $rid=>$rname) :?>
                                <option value="<?php echo $rid;?>"><?php echo $rname;?></option>
                            <?php endforeach;?>
                            <?php endif;?>
                        </select>
                    </div>
                    <!--<span id="error_msg" style="color: red;margin-left: 180px;"></span>-->
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
echo $this->Html->script("/js/calendar/WdatePicker.js");
?>
<script>
    jQuery(document).ready(function () {

        App.init();

    });

    //验证登录名
    function loginNameExits(name) {

        var string = name;
        var pattern = /^\w+$/i;
        var arr = string.match(pattern);

        if (arr == null||name.length<6||name.length>12) {
            alert("请输入6~12位字符的登录名。");
            $("#loginNameExits1").focus().attr("value", '');
            return false;
        }

        $.ajax("/Users/loginNameExits", {
            method: 'POST',
            dataType: 'json',
            data: {'name': name},
            success: function (e) {
                if (e == 1) {
                    alert("该登陆名称已存在，请使用另外的登陆名称。");
                    $("#loginNameExits1").focus().attr("value", '');
                }

            },
            error: function () {
                alert("该登陆名称已存在! 请使用另外的登陆名称。");
            }
        });
    }

    //提交前验证数据
    $('#UserAddForm').submit(function(){
        var pwd=$('#UserPassword').val();
        var birthday=$('#UserBirthday').val();
        var tel=$('#UserTelphone').val();
        var role=$('.selects').val();
        var reg_phone=/^(13\d|14[579]|15\d|17[01235678]|18\d)\d{8}$/i;
        if(pwd.length<6 || pwd.length>12){
            alert("请输入6~12位登录密码");return false;
        }
        if(birthday==''){
            alert('请选择出生日期');return false;
        }
        if(!reg_phone.test(tel)){
            alert('请输入正确的手机号码');return false;
        }
        if(role==0){
            alert('请选择角色');return false;
        }
    });
</script>

