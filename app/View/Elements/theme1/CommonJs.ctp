	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time)开始（底部，加载JavaScript JavaScript这将减少页面加载时间 -->

	<!-- BEGIN CORE PLUGINS 核心插件 -->
<?php 
	echo $this->Html->script(array(/*'jquery-1.10.1.min',*/'jQuery-2.2.4.min','jquery-migrate-1.2.1.min','jquery-ui-1.10.1.custom.min','bootstrap.min'));
?>
	<!--[if lt IE 9]>
<?php 
	echo $this->Html->script(array('excanvas.min','respond.min'));
?>
	<![endif]-->   
<?php
	echo $this->Html->script(array('jquery.slimscroll.min','jquery.blockui.min','jquery.cookie.min','jquery.uniform.min','jquerysession',"app"));
?>