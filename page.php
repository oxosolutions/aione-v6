<?php get_header(); ?>
	<div id="content" <?php Aione()->layout->add_style( 'content_style' ); ?>>
		<?php		
		$show_content_top = Aione()->theme_content['show_content_top']; 
		$content_top = Aione()->theme_content['content_top']; 
		
		if( get_post_meta( $post->ID, 'pyre_show_content_top', true ) == 'no' ){
			$show_content_top = 1;
		}
		if( get_post_meta( $post->ID, 'pyre_show_content_top', true ) == 'yes' ){
			$show_content_top = 0;
		}
		?>
		<?php if($show_content_top){ ?>

				<?php if($content_top){ ?>
					<!-- content above page-->
					<div class="page-content-above">
						<?php echo $content_top; ?>
					</div>
					<!-- end of content above page -->
				<?php } ?>

		<?php } ?>
		
		<?php
		while( have_posts() ): the_post();
		?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php echo aione_render_rich_snippets_for_pages(); ?>
			<?php if( ! post_password_required($post->ID) ): // 1 ?>
			<?php if(!Aione()->theme_options[ 'featured_images_pages' ] ): // 2 ?>
			<?php
			if( aione_number_of_featured_images() > 0 || get_post_meta( $post->ID, 'pyre_video', true ) ): // 3
			?>
			<div class="oxo-flexslider flexslider post-slideshow">
				<ul class="slides">
					<?php if(get_post_meta($post->ID, 'pyre_video', true)): ?>
					<li>
						<div class="full-video">
							<?php echo get_post_meta($post->ID, 'pyre_video', true); ?>
						</div>
					</li>
					<?php endif; ?>
					<?php if( has_post_thumbnail() && get_post_meta( $post->ID, 'pyre_show_first_featured_image', true ) != 'yes' ): ?>
					<?php $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
					<?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
					<?php $attachment_data = wp_get_attachment_metadata(get_post_thumbnail_id()); ?>
					<li>
						<a href="<?php echo $full_image[0]; ?>" rel="prettyPhoto[gallery<?php the_ID(); ?>]" title="<?php echo get_post_field('post_excerpt', get_post_thumbnail_id()); ?>" data-title="<?php echo get_post_field('post_title', get_post_thumbnail_id()); ?>" data-caption="<?php echo get_post_field('post_excerpt', get_post_thumbnail_id()); ?>"><img src="<?php echo $attachment_image[0]; ?>" alt="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); ?>" /></a>
					</li>
					<?php endif; ?>
					<?php
					$i = 2;
					while($i <= Aione()->theme_options[ 'posts_slideshow_number' ]):
					$attachment_new_id = kd_mfi_get_featured_image_id('featured-image-'.$i, 'page');
					if($attachment_new_id):
					?>
					<?php $attachment_image = wp_get_attachment_image_src($attachment_new_id, 'full'); ?>
					<?php $full_image = wp_get_attachment_image_src($attachment_new_id, 'full'); ?>
					<?php $attachment_data = wp_get_attachment_metadata($attachment_new_id); ?>
					<li>
						<a href="<?php echo $full_image[0]; ?>" rel="prettyPhoto[gallery<?php the_ID(); ?>]" title="<?php echo get_post_field('post_excerpt', $attachment_new_id); ?>" data-title="<?php echo get_post_field( 'post_title', $attachment_new_id ); ?>" data-caption="<?php echo get_post_field('post_excerpt', $attachment_new_id ); ?>"><img src="<?php echo $attachment_image[0]; ?>" alt="<?php echo get_post_meta($attachment_new_id, '_wp_attachment_image_alt', true); ?>" /></a>
					</li>
					<?php endif; $i++; endwhile; ?>
				</ul>
			</div>
			<?php endif; // 3 ?>
			<?php endif; // 2 ?>
			<?php endif; // 1 password check ?>
			<div class="post-content">
				<?php the_content(); ?>
				<?php aione_link_pages(); ?>
			</div>
			<?php if( ! post_password_required($post->ID) ): ?>
			<?php if(class_exists('WooCommerce')): ?>
			<?php
			$woo_thanks_page_id = get_option('woocommerce_thanks_page_id');
			if( ! get_option('woocommerce_thanks_page_id') ) {
				$is_woo_thanks_page = false;
			} else {
				$is_woo_thanks_page = is_page( get_option( 'woocommerce_thanks_page_id' ) );
			}
			?>
			<?php if(Aione()->theme_options[ 'comments_pages' ] && !is_cart() && !is_checkout() && !is_account_page() && ! $is_woo_thanks_page ): ?>
				<?php
				wp_reset_query();
				comments_template();
				?>
			<?php endif; ?>
			<?php else: ?>
			<?php if(Aione()->theme_options[ 'comments_pages' ]): ?>
				<?php
				wp_reset_query();
				comments_template();
				?>
			<?php endif; ?>
			<?php endif; ?>
			<?php endif; // password check ?>
		</div>
		<?php endwhile; ?>
		<?php wp_reset_query(); ?>
		
		<?php 
		$show_content_bottom = Aione()->theme_content['show_content_bottom']; 
		$content_bottom = Aione()->theme_content['content_bottom']; 
		
		if( get_post_meta( $post->ID, 'pyre_show_content_bottom', true ) == 'no' ){
			$show_content_bottom = 1;
		}
		if( get_post_meta( $post->ID, 'pyre_show_content_bottom', true ) == 'yes' ){
			$show_content_bottom = 0;
		}
		?>
		<?php if($show_content_bottom){ ?>
			
				<?php if($content_bottom){ ?>
					<!-- content below page-->
					<div class="page-content-below">
						<?php echo $content_bottom; ?>
					</div>
					<!-- end of content below page -->
				<?php } ?>
			
		<?php } ?>
	</div>
	<?php do_action( 'oxo_after_content' ); ?>
<?php get_footer();

// Omit closing PHP tag to avoid "Headers already sent" issues.
