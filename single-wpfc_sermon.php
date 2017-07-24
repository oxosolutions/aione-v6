<?php get_header(); ?>
	<?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
	<div id="content" <?php Aione()->layout->add_class( 'content_class' ); ?> <?php Aione()->layout->add_style( 'content_style' ); ?>>
		<?php if(!Aione()->theme_options[ 'blog_pn_nav' ]): ?>
		<div class="single-navigation clearfix">
			<?php previous_post_link('%link', __('Previous', 'Aione')); ?>
			<?php next_post_link('%link', __('Next', 'Aione')); ?>
		</div>
		<?php endif; ?>
		<?php if(have_posts()): the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
			<?php
			$full_image = '';
			if( ! post_password_required($post->ID) ): // 1
			if(Aione()->theme_options[ 'featured_images_single' ]): // 2
			if( aione_number_of_featured_images() > 0 || get_post_meta( $post->ID, 'pyre_video', true ) ): // 3
			?>
			<div class="oxo-flexslider flexslider oxo-flexslider-loading oxo-post-slideshow post-slideshow">
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
					<?php $attachment_data = wp_get_attachment_metadata(get_post_thumbnail_id()); ?>
					<li>
						<?php if( ! Aione()->theme_options[ 'status_lightbox' ] && ! Aione()->theme_options[ 'status_lightbox_single' ] ): ?>
						<a href="<?php echo $full_image[0]; ?>" rel="prettyPhoto[gallery<?php the_ID(); ?>]" title="<?php echo get_post_field('post_excerpt', get_post_thumbnail_id()); ?>" data-title="<?php echo get_post_field('post_title', get_post_thumbnail_id()); ?>" data-caption="<?php echo get_post_field('post_excerpt', get_post_thumbnail_id()); ?>"><img src="<?php echo $attachment_image[0]; ?>" alt="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); ?>" /></a>
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
					<?php $attachment_data = wp_get_attachment_metadata($attachment_new_id); ?>>
					<li>
						<?php if( ! Aione()->theme_options[ 'status_lightbox' ] && ! Aione()->theme_options[ 'status_lightbox_single' ] ): ?>
						<a href="<?php echo $full_image[0]; ?>" rel="prettyPhoto[gallery<?php the_ID(); ?>]" title="<?php echo get_post_field('post_excerpt', $attachment_new_id); ?>" data-title="<?php echo get_post_field( 'post_title', $attachment_new_id ); ?>" data-caption="<?php echo get_post_field('post_excerpt', $attachment_new_id ); ?>"><img src="<?php echo $attachment_image[0]; ?>" alt="<?php echo get_post_meta($attachment_new_id, '_wp_attachment_image_alt', true); ?>" /></a>
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
			<?php echo aione_render_post_title( $post->ID, FALSE ); ?>
			<?php elseif( ! Aione()->theme_options[ 'disable_date_rich_snippet_pages' ] ): ?>
			<span class="entry-title" style="display: none;"><?php the_title(); ?></span>
			<?php endif; ?>
			<div class="post-content">
				<?php echo aione_get_sermon_content(); ?>
				<?php aione_link_pages(); ?>
			</div>
			<?php if( ! post_password_required($post->ID) ): ?>
			<?php echo aione_render_post_metadata( 'single' ); ?>
			<?php if( Aione()->theme_options[ 'social_sharing_box' ] ):

				$sharingbox_soical_icon_options = array (
					'sharingbox'		=> 'yes',
					'icon_colors' 		=> Aione()->theme_options[ 'sharing_social_links_icon_color' ],
					'box_colors' 		=> Aione()->theme_options[ 'sharing_social_links_box_color' ],
					'icon_boxed' 		=> Aione()->theme_options[ 'sharing_social_links_boxed' ],
					'icon_boxed_radius' => Aione()->theme_options[ 'sharing_social_links_boxed_radius' ],
					'tooltip_placement'	=> Aione()->theme_options[ 'sharing_social_links_tooltip_placement' ],
                	'linktarget'        => Aione()->theme_options[ 'social_icons_new' ],
					'title'				=> wp_strip_all_tags(get_the_title( $post->ID ), true),
					'description'		=> wp_strip_all_tags(get_the_title( $post->ID ), true),
					'link'				=> get_permalink( $post->ID ),
					'pinterest_image'	=> ($full_image) ? $full_image[0] : '',
				);
				?>
				<div class="oxo-sharing-box oxo-single-sharing-box share-box">
					<h4><?php echo __('Share This Story, Choose Your Platform!', 'Aione'); ?></h4>
					<?php echo $social_icons->render_social_icons( $sharingbox_soical_icon_options ); ?>
				</div>
			<?php endif; ?>
			<?php if(Aione()->theme_options[ 'author_info' ]): ?>
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

			<?php if(Aione()->theme_options[ 'blog_comments' ]): ?>
				<?php
				wp_reset_query();
				comments_template();
				?>
			<?php endif; ?>
			<?php endif; ?>
		</div>
		<?php endif; ?>
	</div>
	<?php do_action( 'oxo_after_content' ); ?>
<?php get_footer();

// Omit closing PHP tag to avoid "Headers already sent" issues.
