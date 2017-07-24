<div id="sidebar" <?php Aione()->layout->add_class( 'sidebar_1_class' ); ?> <?php Aione()->layout->add_style( 'sidebar_1_style' ); ?>>
	
	<?php 
	$show_sidebar1_top_content = Aione()->theme_content['show_sidebar1_top_content'];
	$sidebar1_top_content = Aione()->theme_content['sidebar1_top_content']; 
	
	if( get_post_meta( $post->ID, 'pyre_show_sidebar1_top_content', true ) == 'no' ){
		$show_sidebar1_top_content = 1;
	}
	if( get_post_meta( $post->ID, 'pyre_show_sidebar1_top_content', true ) == 'yes' ){
		$show_sidebar1_top_content = 0;
	}
	?>
	<?php if($show_sidebar1_top_content){ ?>
		
			<?php if($sidebar1_top_content){ ?>
			    <!-- content content above sidebar1-->
				<div class="sidebar1-top-content">
					<?php echo $sidebar1_top_content; ?>
				</div>
				<!-- end of content content above sidebar1 -->
			<?php } ?>
		
	<?php } ?>
	
	<?php
	if (
		! Aione()->template->has_sidebar() ||
		'left' == Aione()->layout->sidebars['position'] ||
		( 'right' == Aione()->layout->sidebars['position'] && ! Aione()->template->double_sidebars() )
	) {
		echo aione_display_sidenav( Aione::c_pageID() );
		

		if ( class_exists( 'Tribe__Events__Main' ) && is_singular( 'tribe_events' ) ) {
			do_action( 'tribe_events_single_event_before_the_meta' );
			tribe_get_template_part( 'modules/meta' );
			do_action( 'tribe_events_single_event_after_the_meta' );
		}
	}

	if( isset( Aione()->layout->sidebars['sidebar_1'] ) && Aione()->layout->sidebars['sidebar_1'] ) {
		generated_dynamic_sidebar( Aione()->layout->sidebars['sidebar_1'] );
	}
	?>
</div>
