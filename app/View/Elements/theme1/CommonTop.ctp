<!-- BEGIN BODY -->

<body class="page-header-fixed">

	<!-- BEGIN HEADER -->

	<div class="header navbar navbar-inverse navbar-fixed-top">

		<!-- BEGIN TOP NAVIGATION BAR -->

		<div class="navbar-inner">

			<div class="container-fluid">

				<!-- BEGIN LOGO -->

				<a class="brand" href="<?php echo $this->Html->url('/Index', true); ?>">

				</a>

				<!-- END LOGO -->

				<ul class="nav pull-right">

					<li class="dropdown user">

						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<?php
								$img='/image/avatar1_small.jpg';
								if($this->Session->read('Auth.User.face')!=''){
									$img=$this->Session->read('Auth.User.face');
								}
								echo $this->Html->image($img,array('style'=>'max-width:29px;max-height:29px;'));
							?>

						<span class="username"><?php echo $_SESSION['Auth']['User']['username'];?></span>

						<i class="icon-angle-down"></i>

						</a>

						<ul class="dropdown-menu">

							<li><a href="<?php echo $this->Html->url('/Users/usercenter', true); ?>"><i class="icon-user"></i> 个人中心</a></li>
							<li><a href="<?php echo $this->Html->url('/Users/logout', true); ?>"><i class="icon-key"></i> 注销</a></li>

						</ul>

					</li>

					<!-- END USER LOGIN DROPDOWN -->

				</ul>

				<!-- END TOP NAVIGATION MENU --> 

			</div>

		</div>

		<!-- END TOP NAVIGATION BAR -->

	</div>

	<!-- END HEADER -->