<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>

<body>
	<div class="wrap"><div class="wrap-main wrap-center">
		<header class="header anim" id="header">
			<div class="header-in wrap-center fx-row fx-middle">
				<div class="btn-menu hidden"><span class="far fa-bars"></span></div>
				<?php echo get_custom_logo(); ?>
				<?php 
					wp_nav_menu( array (
						'menu'            => 'Меню шапки', 
						'container'       => '', 
						'container_class' => '', 
						'container_id'    => '',
						'menu_class'      => 'header-menu fx-row fx-center fx-1 to-mob', 
						'menu_id'         => '',
						'echo'            => true,
						'fallback_cb'     => '',
						'before'          => '',
						'after'           => '',
						'link_before'     => '',
						'link_after'      => '',
						'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'depth'           => 0,
						'walker'          => '',
					) );
				 ?>
				<div class="header-btn js-search anim"><span class="far fa-search"></span></div>
				
			</div>
		</header>
		
		<!-- END HEADER -->
		
		<div>  
	        <div class="content wrap-center">