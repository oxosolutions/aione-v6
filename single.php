<?php get_header(); ?>
	<div id="content" <?php Aione()->layout->add_style( 'content_style' ); ?>>
		<?php if( ( ! Aione()->theme_options[ 'blog_pn_nav' ] && get_post_meta($post->ID, 'pyre_post_pagination', true) != 'no' ) ||
				  ( Aione()->theme_options[ 'blog_pn_nav' ] && get_post_meta($post->ID, 'pyre_post_pagination', true) == 'yes' ) ): ?>
		<div class="single-navigation clearfix">
			<?php previous_post_link('%link', __('Previous', 'Aione')); ?>
			<?php next_post_link('%link', __('Next', 'Aione')); ?>
		</div>
		<?php endif; ?>
		<?php while( have_posts() ): the_post(); 
		// Authenication Required
		//$authenication_required = get_post_meta( $post->ID, 'pyre_enable_authenication', true );
		
		?>
		<div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
			<?php
			$full_image = '';
			if( ! post_password_required($post->ID) ): // 1
			if(Aione()->theme_options[ 'featured_images_single' ]): // 2
			if( aione_number_of_featured_images() > 0 || get_post_meta( $post->ID, 'pyre_video', true ) ): // 3
			?>
			<div class="oxo-flexslider flexslider oxo-flexslider-loading post-slideshow oxo-post-slideshow">
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
						<?php if( ! Aione()->theme_options[ 'status_lightbox' ] && ! Aione()->theme_options[ 'status_lightbox_single' ] ): ?>
						<a href="<?php echo $full_image[0]; ?>" data-rel="iLightbox[gallery<?php the_ID(); ?>]" title="<?php echo get_post_field('post_excerpt', get_post_thumbnail_id()); ?>" data-title="<?php echo get_post_field('post_title', get_post_thumbnail_id()); ?>" data-caption="<?php echo get_post_field('post_excerpt', get_post_thumbnail_id()); ?>"><img src="<?php echo $attachment_image[0]; ?>" alt="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); ?>" /></a>
						<?php else: ?>
						<img src="<?php echo $attachment_image[0]; ?>" alt="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); ?>" />
						<?php endif; ?>
					</li>
					<?php endif; ?>
					<?php
					$i = 2;
					while($i <= Aione()->theme_options[ 'posts_slideshow_number' ]):
					$attachment_new_id = kd_mfi_get_featured_image_id('featured-image-'.$i, 'post');
					if($attachment_new_id):
					?>
					<?php $attachment_image = wp_get_attachment_image_src($attachment_new_id, 'full'); ?>
					<?php $full_image = wp_get_attachment_image_src($attachment_new_id, 'full'); ?>
					<?php $attachment_data = wp_get_attachment_metadata($attachment_new_id); ?>
					<li>
						<?php if( ! Aione()->theme_options[ 'status_lightbox' ] && ! Aione()->theme_options[ 'status_lightbox_single' ] ): ?>
						<a href="<?php echo $full_image[0]; ?>" data-rel="iLightbox[gallery<?php the_ID(); ?>]" title="<?php echo get_post_field('post_excerpt', $attachment_new_id); ?>" data-title="<?php echo get_post_field( 'post_title', $attachment_new_id ); ?>" data-caption="<?php echo get_post_field('post_excerpt', $attachment_new_id ); ?>"><img src="<?php echo $attachment_image[0]; ?>" alt="<?php echo get_post_meta($attachment_new_id, '_wp_attachment_image_alt', true); ?>" /></a>
						<?php else: ?>
						<img src="<?php echo $attachment_image[0]; ?>" alt="<?php echo get_post_meta($attachment_new_id, '_wp_attachment_image_alt', true); ?>" />
						<?php endif; ?>
					</li>
					<?php endif; $i++; endwhile; ?>
				</ul>
			</div>
			<?php endif; // 3 ?>
			<?php endif; // 2 ?>
			<?php endif; // 1 ?>
			<?php if(Aione()->theme_options[ 'blog_post_title' ]): ?>
			<?php echo aione_render_post_title( $post->ID, FALSE, '', '2' ); ?>
			<?php elseif( ! Aione()->theme_options[ 'disable_date_rich_snippet_pages' ] ): ?>
			<span class="entry-title" style="display: none;"><?php the_title(); ?></span>
			<?php endif; ?>
			<div class="post-content">
				<?php the_content(); ?>
				<?php aione_link_pages(); ?>
			</div>
			<?php if( ! post_password_required($post->ID) ): ?>
			<?php echo aione_render_post_metadata( 'single' ); ?>
			<?php aione_render_social_sharing(); ?>
			<?php if( ( Aione()->theme_options[ 'author_info' ] && get_post_meta($post->ID, 'pyre_author_info', true) != 'no' ) ||
					  ( ! Aione()->theme_options[ 'author_info' ] && get_post_meta($post->ID, 'pyre_author_info', true) == 'yes' ) ): ?>
			<div class="about-author">
				<?php
					ob_start();
					the_author_posts_link();
					$title = sprintf( '%s %s', __( 'About the Author:', 'Aione' ), ob_get_clean() );
					echo Aione()->template->title_template( $title, '3' );
				?>
				<div class="about-author-container">
					<div class="avatar">
						<?php echo get_avatar(get_the_author_meta('email'), '72'); ?>
					</div>
					<div class="description">
						<?php the_author_meta("description"); ?>
					</div>
				</div>
			</div>
			<?php endif; ?>

			<?php
			// Render Related Posts
			echo aione_render_related_posts();
			?>

			<?php if( ( Aione()->theme_options[ 'blog_comments' ] && get_post_meta($post->ID, 'pyre_post_comments', true ) != 'no' ) ||
					  ( ! Aione()->theme_options[ 'blog_comments' ] && get_post_meta($post->ID, 'pyre_post_comments', true) == 'yes' ) ): ?>
				<?php
				wp_reset_query();
				comments_template();
				?>
			<?php endif; ?>
			<?php endif; ?>
		</div>
		<?php endwhile; ?>
		<?php wp_reset_query(); ?>
	</div>
	<?php do_action( 'oxo_after_content' ); ?>
<?php get_footer();

// Omit closing PHP tag to avoid "Headers already sent" issues.
