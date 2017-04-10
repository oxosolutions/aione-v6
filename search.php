<?php get_header(); ?>
	<div id="content" <?php Aione()->layout->add_class( 'content_class' ); ?> <?php Aione()->layout->add_style( 'content_style' ); ?>>
		<?php if ( have_posts() && strlen( trim(get_search_query()) ) != 0 ) : ?>
		
		<?php
		if ( Aione()->theme_options[ 'search_new_search_position' ] == 'bottom' ) {
			get_template_part( 'templates/blog', 'layout' );
		?>
			<div class="oxo-clearfix"></div>
		<?php
		}
		?>
		
		<?php if ( Aione()->theme_options[ 'search_new_search_position' ] != 'hidden' ) : ?>
		<div class="search-page-search-form search-page-search-form-<?php echo Aione()->theme_options[ 'search_new_search_position' ]; ?>">
			<?php
			// Render the post title
			echo aione_render_post_title( 0, FALSE, __( 'Need a new search?', 'Aione' ) ); ?>
			<p><?php echo __('If you didn\'t find what you were looking for, try a new search!', 'Aione'); ?></p>
			<form class="searchform seach-form" role="search" method="get" action="<?php echo home_url( '/' ); ?>">
				<div class="search-table">
					<div class="search-field">
						<input type="text" value="" name="s" class="s" placeholder="<?php _e( 'Search ...', 'Aione' ); ?>"/>
					</div>
					<div class="search-button">
						<input type="submit" class="searchsubmit" value="&#xf002;" />
					</div>
				</div>
			</form>
		</div>
		<?php endif; ?>
		<?php
		if ( Aione()->theme_options[ 'search_new_search_position' ] == 'top' || Aione()->theme_options[ 'search_new_search_position' ] == 'hidden' ) {
			get_template_part( 'templates/blog', 'layout' );
		}
		?>
	<?php else: ?>
	<div class="post-content">
		<?php
			$title = __( 'Couldn\'t find what you\'re looking for!', 'Aione' );
			echo Aione()->template->title_template( $title );
		?>
		<div class="error-page">
			<div class="oxo-columns oxo-columns-3">
				<div class="oxo-column col-lg-4 col-md-4 col-sm-4">
					<h1 class="oops"><?php _e( 'Oops!', 'Aione' ); ?></h1>
				</div>
				<div class="oxo-column col-lg-4 col-md-4 col-sm-4 useful-links">
					<h3><?php _e( 'Here are some useful links:', 'Aione' ); ?></h3>
					<?php					
						if ( Aione()->settings->get( 'checklist_circle' ) ) {
							$circle_class = 'circle-yes';
						} else {
							$circle_class = 'circle-no';
						}
						wp_nav_menu( array( 'theme_location' => '404_pages', 'depth' => 1, 'container' => false, 'menu_class' => 'error-menu list-icon list-icon-arrow ' . $circle_class, 'echo' => 1 ) );
					?>
				</div>
				<div class="oxo-column col-lg-4 col-md-4 col-sm-4">
					<h3><?php _e( 'Try again', 'Aione' ); ?></h3>
					<p><?php _e('If you want to rephrase your query, here is your chance:', 'Aione' ); ?></p>
					<?php echo get_search_form( false ); ?>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>
	</div>
	<?php do_action( 'oxo_after_content' ); ?>
<?php get_footer();

// Omit closing PHP tag to avoid "Headers already sent" issues.
