<?php 
	//加载本页面专属css样式
	$this->Html->css('login-soft',array('block'=>'cssInHead','inline'=>false));
	//加载公共头部文件
	echo $this->element('theme1/CommonLoginHead');
 ?>
<!-- BEGIN BODY -->

<body class="login"><div class="logo">
		<?php echo $this->Html->image("logo-big.png") ?>
	</div>
	<div class="content">
		<!-- BEGIN LOGIN FORM -->
		<?php echo $this->Form->create('User',array('class'=>'form-vertical'));?>
			<h3 class="">忘记密码?</h3>
			<p>请输入您的E-mail账号，来重新设置您的密码。</p>
			<div class="control-group">
				<div class="controls">
					<div class="input-icon left">
						<i class="icon-envelope"></i>
						<?php echo $this->Form->input('email',array('label'=>false,'class'=>'span6 m-wrap popovers','type'=>'text'));?>
					</div>
				</div>
			</div>
			<div class="form-actions">
				<a class="btn" type="button"  id="back-btn" href="<?php echo $this->Html->url("/Users/login");?>" class="" id="forget-password"><i class="m-icon-swapleft"></i>返回</a>
				<button type="submit" class="btn blue pull-right">
				提交 <i class="m-icon-swapright m-icon-white"></i>
				</button>            
			</div>
		</form>
	</div>
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