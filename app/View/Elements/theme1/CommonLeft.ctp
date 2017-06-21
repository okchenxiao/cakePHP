	<!-- BEGIN CONTAINER -->

	<div class="page-container">

		<!-- BEGIN SIDEBAR -->

		<div class="page-sidebar nav-collapse collapse">

			<!-- BEGIN SIDEBAR MENU -->        

			<ul class="page-sidebar-menu">

				<li>

					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->

					<div class="sidebar-toggler hidden-phone"></div>

					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->

				</li>

				<li>

					<!-- BEGIN RESPONSIVE QUICK SEARCH FORM 开始响应快速搜索表单-->

					<form class="sidebar-search">

						<div class="input-box">



						</div>

					</form>

					<!-- END RESPONSIVE QUICK SEARCH FORM -->

				</li>

				<li class="start menu menu0 active">

					<a href="<?php echo $this->Html->url('/Index', true); ?>" onclick="setmenus(0)">

						<i class="icon-home"></i> 

						<span class="title">首页</span>

						<span class="selected"></span>

					</a>
				</li>
<?php 
	if ($menus): 

		foreach($menus as $k=>$menu) : 
				
			echo "<li class='menu menu".($k+1)."'>";

			if ($menu['path']) :
?>
			<a href="<?php echo $this->Html->url($menu['path'], true); ?>" onclick="setmenus(<?php echo ($k+1) ?>)">
			<i class="<?php echo $menu['icon']?>"></i> 

					<span class="title"><?php echo $menu['name']?></span>

					

					<span class="selected"></span>
		<?php else : ?>
					<a class="active" href="javascript:;">
					<i class="<?php echo $menu['icon']?>"></i> 

					<span class="title"><?php echo $menu['name']?></span>

					<span class="arrow "></span>

					<span class="selected"></span>
		<?php endif; ?>
					

					</a>
					<?php if(count($menu['child']) > 0) :?>
					<ul class="sub-menu">
					
						<?php foreach ($menu['child'] as $ke => $val) :?>
							<li class="second second<?php echo $ke?>">
							
								<?php 
									if (count($val['child']) > 0) :
								?>
								<a  href="javascript:;">
									<i class="<?php echo $val['icon']; ?>"></i>

									<?php echo $val['name']; ?>

									<span class="arrow"></span>
									<span class="selected"></span>
								</a>
								<ul class="sub-menu">
									<?php if (count($val['child']) > 0) : 
												foreach ($val['child'] as $ki => $v) :
									?>
									<li class="third third<?php echo $ki;?>"><a href="<?php echo $this->Html->url($v['path'], true); ?>" onclick="setmenus(<?php echo ($k+1)?>,<?php echo $ke;?>,<?php echo $ki;?>)"><i class="<?php echo $val['icon']; ?>"></i> <?php echo $v['name']; ?></a></li>
									<?php endforeach;endif;?>
								</ul>
								<?php else: ?>
								<a href="<?php echo $this->Html->url($val['path'], true); ?>" onclick="setmenus(<?php echo ($k+1)?>,<?php echo $ke?>)">
									<i class="<?php echo $val['icon']; ?>"></i><?php echo $val['name']; ?>
								</a>
							<?php 
								
								endif; ?>
							</li>
						<?php endforeach; ?>
					
					</ul>
					<?php endif; ?>
				</li>
<?php 	endforeach;
	else : "not menus";
	endif;
	unset($album);
?> 
			</ul>

			<!-- END SIDEBAR MENU -->

		</div>

		<!-- END SIDEBAR -->
		<!-- BEGIN PAGE -->

		<div class="page-content">

			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->

			<div id="portlet-config" class="modal hide">

				<div class="modal-header">

					<button data-dismiss="modal" class="close" type="button"></button>

					<h3>Portlet设置 </h3>

				</div>

				<div class="modal-body">

					<p>这里将是一个配置形式</p>

				</div>

			</div>

			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

			<!-- BEGIN PAGE CONTAINER-->        

			<div class="container-fluid">

				<!-- BEGIN PAGE HEADER-->

				<div class="row-fluid">

					<div class="span12">

