<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->

<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->

<!-- BEGIN HEAD -->

<head>

	<meta charset="utf-8" />

	<title><?php if(isset($title_for_layout) && $title_for_layout!=''){echo $title_for_layout;}else{echo '呵呵';}?></title>

	<meta content="width=device-width, initial-scale=1.0" name="viewport" />

	<meta content="" name="description" />

	<meta content="" name="author" />

	<link rel="shortcut icon" href="/favicon1.ico" />
<?php
	echo $this->element('theme1/CommonCss');
?>

</head>

<!-- END HEAD -->
<?php
	echo $this->element('theme1/CommonTop');
?>