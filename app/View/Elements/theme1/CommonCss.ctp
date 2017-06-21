<?php 
	//公共CSS样式
	echo $this->Html->css(array('search_area','bootstrap.min','bootstrap-responsive.min','font-awesome.min','style-metro','style','style-responsive'));
	echo $this->Html->css('default',array("id"=>"style_color"));
	echo $this->Html->css('uniform.default');
	// 在你的布局中
	echo $this->fetch('cssInHead');
?>