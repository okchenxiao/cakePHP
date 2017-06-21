<?php 
	//加载本页面专属css样式
	$this->Html->css('login-soft',array('block'=>'cssInHead','inline'=>false));
	//加载公共头部文件
	echo $this->element('theme1/CommonLoginHead');

 ?>
<body class="login">
	<div class="logo">
		<?php //echo $this->Html->image("logo-big.png") ?>
	</div>


	<div class="content">
		<?php echo $this->Form->create('User',array('class'=>'form-vertical'));?>

			<h3 class="form-title">登录</h3>
			<div class="control-group">
				<div class="controls">
					<div class="input-icon left">
						<i class="icon-user"></i>
						<?php echo $this->Form->input('loginname',array('label'=>false,'placeholder'=>'账号','class'=>'span6 m-wrap popovers','type'=>'text'));?>
					</div>
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<div class="input-icon left">
						<i class="icon-lock"></i>
						<?php echo $this->Form->input('password',array('label'=>false,'placeholder'=>'密码','class'=>'span6 m-wrap popovers','type'=>'password'));?>
					</div>
				</div>
			</div>
			<div class="form-actions">

				<button type="submit" class="btn blue btn-block">
				登录<i class="m-icon-swapright m-icon-white"></i>
				</button>      
			</div>
			<div class="forget-password">
				<h4>忘记密码 ?</h4>
				<p>
					别担心，请点击 <a href="<?php echo $this->Html->url('/Users/forgetpassword');?>" id="forget-password">这里</a> 重新设置你的密码。
				</p>
			</div>
			<div class="create-account">
				<p></p>
			</div>
			</form>
	</div>

</body>
<?php 
	//加载登陆界面公共页脚
	echo $this->element('theme1/CommonLoginFooter'); 	
 ?>
<?php 
	//加载公共js文件
	echo $this->element('theme1/CommonJs'); 
?>
<?php
	//加载本页面专属js文件
	echo $this->Html->script(array('jquery.validate.min','jquery.backstretch.min'));
 ?>
<?php 
	//app.js为公用js文件
	echo $this->Html->script("app");
	//加载自定义本页面js文件
	echo $this->Html->script("login-soft");
 ?>
	<script>
		jQuery(document).ready(function() {     
		  App.init();
		  Login.init();
		});

	</script>

</body>
</html>