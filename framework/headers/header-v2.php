<?php global $theme_options; ?>
<div class="header-v2">
	 <?php get_template_part('framework/header/topbar'); ?>
	<header id="header">
		<div class="aione-row" style="padding-top:<?php echo $theme_options['margin_header_top']; ?>;padding-bottom:<?php echo $theme_options['margin_header_bottom']; ?>;">
			<?php get_template_part('framework/header/logo'); ?>   
			<?php 
			$header_show_navigation =$theme_options[ 'header_show_navigation' ];

			echo "header_show_navigation = ".$header_show_navigation;

			if($header_show_navigation): ?>

				<?php if($theme_options['ubermenu']): ?>
				<nav id="nav-uber">
				<?php else: ?>
				<nav id="nav" class="nav-holder">
				<?php endif; ?>
					<?php get_template_part('framework/headers/header-main-menu'); ?>
				</nav>
				<?php if(tf_checkIfMenuIsSetByLocation('main_navigation')): ?>
				<div class="mobile-nav-holder main-menu"></div>
				<?php 
				endif;

			endif;
			?>
		</div>
	</header>
</div>