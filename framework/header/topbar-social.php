<?php global $theme_options, $social_icons; ?>
<div class="oxo-social-links-header topbar-item">
	<div class="oxo-social-networks">
	
	<?php $social_sorter = Aione()->theme_options['social_sorter']; 
		foreach($social_sorter as $keys => $values){ 
		$social_icon_name = str_replace( '_link', '', $keys );
			if($values){
		?>
			<a class="oxo-social-network-icon oxo-tooltip oxo-<?php echo $values; ?> oxo-icon-<?php echo $values; ?>" href="http://<?php echo $values; ?>" target="_blank"><i class="fa fa-<?php echo $social_icon_name;?>" aria-hidden="true"></i></a>
		<?php 
			}
		} 
		?>
	
	</div>
</div>
<div id="social-links-separator" class='topbar-item'></div>
