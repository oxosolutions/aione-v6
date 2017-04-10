<?php get_header(); ?>
	<div id="content" <?php Aione()->layout->add_class( 'content_class' ); ?> <?php Aione()->layout->add_style( 'content_style' ); ?>>
		<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
		<?php query_posts($query_string.'&paged='.$paged); ?>
		<?php
		$nav_categories = '';
		if ( isset( $_GET['portfolioID'] ) ) {
			$portfolioID = $_GET['portfolioID'];
		} else {
			$portfolioID = '';
		}
		
		if ( isset( $_GET['categoryID'] ) ) {
			$categoryID = $_GET['categoryID'];
		} else {
			$categoryID = '';
		}
		$page_categories = get_post_meta( $portfolioID, 'pyre_portfolio_category', true );
		if ( $page_categories && is_array( $page_categories ) && $page_categories[0] !== '0' ) {
			$nav_categories = implode( ',', $page_categories );
		}

		if ( $categoryID ) {
			$nav_categories = $categoryID;
		}
		
		if ( ( ! Aione()->theme_options[ 'portfolio_pn_nav' ] && get_post_meta( $post->ID, 'pyre_post_pagination', true ) != 'no' ) ||
			 ( Aione()->theme_options[ 'portfolio_pn_nav' ] && get_post_meta( $post->ID, 'pyre_post_pagination', true ) == 'yes' ) ): ?>
			<div class="single-navigation clearfix">
				<?php
				if ( $portfolioID || $categoryID ) {
					$previous_post_link = oxo_previous_post_link_plus( array( 'format' => '%link', 'link' => __( 'Previous', 'Aione' ), 'in_same_tax' => 'portfolio_category', 'in_cats' => $nav_categories, 'return' => 'href' ) );
				} else {
					$previous_post_link = oxo_previous_post_link_plus( array( 'format' => '%link', 'link' => __( 'Previous', 'Aione' ), 'return' => 'href' ) );
				}

				if ( $previous_post_link ):
					if ( $portfolioID ) {
						$previous_post_link = oxo_add_url_parameter($previous_post_link, 'portfolioID', $portfolioID);
					} elseif( $categoryID ) { 
						$previous_post_link = oxo_add_url_parameter($previous_post_link, 'categoryID', $categoryID);
					}
					?>
					<a href="<?php echo $previous_post_link; ?>" rel="prev"><?php _e('Previous', 'Aione'); ?></a>
				<?php endif;
				if ( $portfolioID || $categoryID ) {
					$next_post_link = oxo_next_post_link_plus( array( 'format' => '%link', 'link' => __( 'Next', 'Aione' ), 'in_same_tax' => 'portfolio_category', 'in_cats' => $nav_categories, 'return' => 'href' ) );
				} else {
					$next_post_link = oxo_next_post_link_plus( array( 'format' => '%link', 'link' => __( 'Next', 'Aione' ), 'return' => 'href' ) );
				}

				if ( $next_post_link ):
					if( $portfolioID ) {
						$next_post_link = oxo_add_url_parameter( $next_post_link, 'portfolioID', $portfolioID );
					} elseif( $categoryID ) { 
						$next_post_link = oxo_add_url_parameter( $next_post_link, 'categoryID', $categoryID );
					}
					?>
					<a href="<?php echo $next_post_link; ?>" rel="next"><?php _e( 'Next', 'Aione' ); ?></a>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		
		<?php if(have_posts()): the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php
			$full_image = '';

			if( ! post_password_required($post->ID) ): // 1
			if( Aione()->theme_options[ 'portfolio_featured_images' ] ): // 2
			if( aione_number_of_featured_images() > 0 || get_post_meta( $post->ID, 'pyre_video', true ) ): // 3
			?>
			<div class="oxo-flexslider flexslider oxo-post-slideshow post-slideshow oxo-flexslider-loading">
				<ul class="slides">
					<?php if(get_post_meta($post->ID, 'pyre_video', true)): ?>
					<li>
						<div class="full-video">
							<?php echo get_post_meta($post->ID, 'pyre_video', true); ?>
						</div>
					</li>
					<?php endif; ?>
					<?php
					if ( has_post_thumbnail() &&
						 ( ! oxo_get_option( 'portfolio_disable_first_featured_image', 'show_first_featured_image', $post->ID ) ||  oxo_get_option( 'portfolio_disable_first_featured_image', 'show_first_featured_image', $post->ID )  == 'no' )
					):
					?>
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
					$attachment_new_id = kd_mfi_get_featured_image_id('featured-image-'.$i, 'aione_portfolio');
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
			<?php endif; // 2 portfolio single image theme option check ?>
			<?php endif; // 1 password check ?>
			<?php
			$project_desc_title_style = '';
			$project_desc_width_style = '';
			$project_details = FALSE;

			if ( oxo_get_option( 'portfolio_featured_image_width', 'width', $post->ID ) == 'half' ) {
				$portfolio_width = 'half';
			} else {
				$portfolio_width = 'full';
			}
			if ( ! Aione()->theme_options[ 'portfolio_featured_images' ] &&
				$portfolio_width == 'half'
			) {
				$portfolio_width = 'full';
			}

			if ( ! Aione()->theme_options[ 'portfolio_project_desc_title' ] ) ||
				   Aione()->theme_options[ 'portfolio_project_desc_title' ] )  == 'no'
			) {
				$project_desc_title_style = 'display:none;';
			}

			if ( $portfolio_width == 'full' &&
				 ( ! oxo_get_option( 'portfolio_project_details', 'project_details', $post->ID ) || oxo_get_option( 'portfolio_project_details', 'project_details', $post->ID )  == 'no' )
			) {
				$project_desc_width_style = ' width:100%;';
			}

			if ( Aione()->theme_options[ 'portfolio_project_details' ] ) == 'yes' ||
				 Aione()->theme_options[ 'portfolio_project_details' ] ) == '1'
			) {
				$project_details = TRUE;
			}

			?>
			<div class="project-content clearfix">
				<?php echo aione_render_rich_snippets_for_pages(); ?>
				<div class="project-description post-content<?php echo ( $project_details ) ? ' oxo-project-description-details' : ''; ?>" style="<?php echo $project_desc_width_style; ?>">
					<?php if ( ! post_password_required( $post->ID ) ): ?>
					<h3 style="<?php echo $project_desc_title_style; ?>"><?php echo __('Project Description', 'Aione') ?></h3>
					<?php endif; ?>
					<?php the_content(); ?>
				</div>
				<?php if( ! post_password_required($post->ID) && $project_details ): ?>
				<div class="project-info">
					<h3><?php echo __('Project Details', 'Aione'); ?></h3>
					<?php if(get_the_term_list($post->ID, 'portfolio_skills', '', '<br />', '')): ?>
					<div class="project-info-box">
						<h4><?php echo __('Skills Needed', 'Aione') ?>:</h4>
						<div class="project-terms">
							<?php echo get_the_term_list($post->ID, 'portfolio_skills', '', '<br />', ''); ?>
						</div>
					</div>
					<?php endif; ?>
					<?php if(get_the_term_list($post->ID, 'portfolio_category', '', '<br />', '')): ?>
					<div class="project-info-box">
						<h4><?php echo __('Categories', 'Aione') ?>:</h4>
						<div class="project-terms">
							<?php echo get_the_term_list($post->ID, 'portfolio_category', '', '<br />', ''); ?>
						</div>
					</div>
					<?php endif; ?>
					<?php if(get_the_term_list($post->ID, 'portfolio_tags', '', '<br />', '')): ?>
					<div class="project-info-box">
						<h4><?php echo __('Tags', 'Aione') ?>:</h4>
						<div class="project-terms">
							<?php echo get_the_term_list($post->ID, 'portfolio_tags', '', '<br />', ''); ?>
						</div>
					</div>
					<?php endif; ?>
					<?php if(get_post_meta($post->ID, 'pyre_project_url', true) && get_post_meta($post->ID, 'pyre_project_url_text', true)):
						$link_target = '';
						if ( Aione()->theme_options[ 'portfolio_link_icon_target' ] ) == '1' ||
							 Aione()->theme_options[ 'portfolio_link_icon_target' ] ) == 'yes'
						) {
							$link_target = ' target="_blank"';
						}
					?>
					<div class="project-info-box">
						<h4><?php echo __('Project URL', 'Aione') ?>:</h4>
						<span><a href="<?php echo get_post_meta($post->ID, 'pyre_project_url', true); ?>"<?php echo $link_target; ?>><?php echo get_post_meta($post->ID, 'pyre_project_url_text', true); ?></a></span>
					</div>
					<?php endif; ?>
					<?php if(get_post_meta($post->ID, 'pyre_copy_url', true) && get_post_meta($post->ID, 'pyre_copy_url_text', true)):
						$link_target = '';
						if ( Aione()->theme_options[ 'portfolio_link_icon_target' ] ) == '1' ||
							 Aione()->theme_options[ 'portfolio_link_icon_target' ] )  == 'yes'
						) {
							$link_target = ' target="_blank"';
						}
					?>
					<div class="project-info-box">
						<h4><?php echo __('Copyright', 'Aione'); ?>:</h4>
						<span><a href="<?php echo get_post_meta($post->ID, 'pyre_copy_url', true); ?>"<?php echo $link_target; ?>><?php echo get_post_meta($post->ID, 'pyre_copy_url_text', true); ?></a></span>
					</div>
					<?php endif; ?>
					<?php if(Aione()->theme_options[ 'portfolio_author' ]): ?>
					<div class="project-info-box<?php if( ! Aione()->theme_options[ 'disable_date_rich_snippet_pages' ] ) { echo ' vcard'; } ?>">
						<h4><?php echo __('By', 'Aione'); ?>:</h4><span<?php if( ! Aione()->theme_options[ 'disable_date_rich_snippet_pages' ] ) { echo ' class="fn"'; } ?>><?php the_author_posts_link(); ?></span>
					</div>
					<?php endif; ?>
				</div>
				<?php endif; ?>
			</div>
			<div class="portfolio-sep"></div>
			<?php if( ! post_password_required($post->ID) ): ?>
			<?php aione_render_social_sharing( 'portfolio' ); ?>

			<?php
			// Render Related Posts
			echo aione_render_related_posts( 'aione_portfolio' );
			?>

			<?php if(Aione()->theme_options[ 'portfolio_comments' ]): ?>
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
