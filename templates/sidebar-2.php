<div id="sidebar-2" <?php Aione()->layout->add_class( 'sidebar_2_class' ); ?> <?php Aione()->layout->add_style( 'sidebar_2_style' ); ?>>
	<?php 
	$show_sidebar2_top_content = Aione()->theme_content['show_sidebar2_top_content'];
	$sidebar2_top_content = Aione()->theme_content['sidebar2_top_content'];

	if( get_post_meta( $post->ID, 'pyre_show_sidebar2_top_content', true ) == 'no' ){
		$show_sidebar2_top_content = 1;
	}
	if( get_post_meta( $post->ID, 'pyre_show_sidebar2_top_content', true ) == 'yes' ){
		$show_sidebar2_top_content = 0;
	}	
	?>
	<?php if($show_sidebar2_top_content){ ?>
	
			<?php if($sidebar2_top_content){ ?>
			    <!-- content content above sidebar2-->
				<div class="sidebar2-top-content">
					<?php echo $sidebar2_top_content; ?>
				</div>
				<!-- end of content content above sidebar2 -->
			<?php } ?>
		
	<?php } ?>
	
	<?php
	if ( 'right' == Aione()->layout->sidebars['position'] ) {
		echo aione_display_sidenav( Aione::c_pageID() );

		if ( class_exists( 'Tribe__Events__Main' ) && is_singular( 'tribe_events' ) ) {
			do_action( 'tribe_events_single_event_before_the_meta' );
			tribe_get_template_part( 'modules/meta' );
			do_action( 'tribe_events_single_event_after_the_meta' );
		}
	}

	if( isset( Aione()->layout->sidebars['sidebar_2'] ) && Aione()->layout->sidebars['sidebar_2'] ) {
		generated_dynamic_sidebar( Aione()->layout->sidebars['sidebar_2'] );
	}
	?>
</div>
