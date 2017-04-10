<?php

// Render the content of the portfolio page
while ( have_posts() ): the_post();

	ob_start();
	post_class( 'oxo-portfolio-page-content' );
	$post_classes = ob_get_clean();

	echo sprintf( '<div id="post-%s" %s>', get_the_ID(), $post_classes );
		// Render the rich snippets
		echo aione_render_rich_snippets_for_pages();

		// Render the featured images
		echo aione_featured_images_for_pages();

		// Portfolio page content
		echo '<div class="post-content">';
			the_content();
			aione_link_pages();
		echo '</div>';
	echo '</div>';

	// Set the ID of the portfolio page as variable to have it in the posts loop
	$current_page_id = $post->ID;

	// Get the page template slug for later check for text layouts
	$current_page_template = str_replace( '.php', '', get_page_template_slug( $current_page_id ) );

	// Get the boxed/unboxed setting for text layouts
	if ( strpos( $current_page_template, 'text' ) ) {
		$current_page_text_layout = oxo_get_option( 'portfolio_text_layout', 'portfolio_text_layout', $current_page_id );
	} else {
		$current_page_text_layout = 'unboxed';
	}

endwhile;

// Check if we have paged content
$paged = 1;
if(  is_front_page() ) {
	if ( get_query_var( 'page' ) ) {
		$paged = get_query_var( 'page' );
	}
} else {
	if ( get_query_var( 'paged') ) {
		$paged = get_query_var( 'paged');
	}
}

// Initialize the args that will be needed for th portfolio posts query
$args = array(
	'post_type' 		=> 'aione_portfolio',
	'paged' 			=> $paged,
	'posts_per_page' 	=> Aione()->theme_options[ 'portfolio_items' ],
);

// If placeholder images are disabled, add the _thumbnail_id meta key to the query to only retrieve posts with featured images
if ( ! Aione()->theme_options[ 'featured_image_placeholder' ] ) {
	$args['meta_key'] = '_thumbnail_id';
}

// Get the categories set by user to be included
$categories_to_display_ids = oxo_get_page_option( 'portfolio_category', get_the_ID() );

// If "All categories" was selected in page options, clear that array entry
if ( is_array( $categories_to_display_ids ) &&
	 $categories_to_display_ids[0] == 0
) {
	unset( $categories_to_display_ids[0] );
	$categories_to_display_ids = array_values( $categories_to_display_ids );
}

// If no categories are chosen or "All categories", we need to load all available categories
$show_all_categories = FALSE;

if ( ! is_array( $categories_to_display_ids ) ||
	count( $categories_to_display_ids ) == 0
) {
	$show_all_categories = TRUE;

	$terms = get_terms( 'portfolio_category' );

	if ( ! is_array( $categories_to_display_ids ) ) {
		$categories_to_display_ids = array();
	}

	foreach ( $terms as $term ) {
		$categories_to_display_ids[] = $term->term_id;
	}
}

// Get the category slugs and names
$categories_to_display_slugs_names = array();
if ( is_array( $categories_to_display_ids ) &&
	count( $categories_to_display_ids ) > 0
) {
	foreach ( $categories_to_display_ids as $category_id ) {

		$category_object = get_term( $category_id, 'portfolio_category' );

		// Only add the category to the slugs and names array if they have posts assigned to them
		if ( $category_object->count > 0 ) {
			$categories_to_display_slugs_names[$category_object->slug] = $category_object->name;
		}
	}
}

// Sort the category slugs alphabetically
if ( is_array( $categories_to_display_slugs_names ) &&
	! function_exists( 'TO_activated' )
) {
	asort( $categories_to_display_slugs_names );
}

// Add the correct term ids to the args array
if ( $categories_to_display_ids ){
	$args['tax_query'][] = array(
		'taxonomy' => 'portfolio_category',
		'field' => 'id',
		'terms' => $categories_to_display_ids
	);
}

// Retrieve the portfolio posts that fit the arguments
$portfolio_posts_to_display = new WP_Query( $args );

// Check if the page is passowrd protected
if ( ! post_password_required( $current_page_id ) ) {

	// Check if we can display filters
	if ( is_array( $categories_to_display_slugs_names ) &&
		! empty( $categories_to_display_slugs_names ) &&
		oxo_get_page_option( 'portfolio_filters', $current_page_id ) != 'no'
	) {

		// First add the "All" filter then loop through all chosen categories
		echo '<ul class="oxo-filters clearfix">';

			// Check if the "All" filter should be displayed
			if ( oxo_get_page_option( 'portfolio_filters', $current_page_id ) == 'yes' ) {
				echo sprintf( '<li class="oxo-filter oxo-filter-all oxo-active"><a data-filter="*" href="#">%s</a></li>', apply_filters( 'aione_portfolio_all_filter_name', __( 'All', 'Aione' ) ) );

				$first_filter = FALSE;
			} else {
				$first_filter = TRUE;
			}

			foreach ( $categories_to_display_slugs_names as $category_tax_slug => $category_tax_name ) {
				// Set the first category filter to active, if the all filter isn't shown
				$active_class = '';
				if ( $first_filter ) {
					$active_class = ' oxo-active';
					$first_filter = FALSE;
				}

				echo sprintf( '<li class="oxo-filter oxo-hidden%s"><a data-filter=".%s" href="#">%s</a></li>', $active_class, urldecode( $category_tax_slug ), $category_tax_name );
			}
		echo '</ul>';
	}

	// Get the correct featured image size
	$post_featured_image_size = aione_get_portfolio_image_size( $current_page_id );
	$post_featured_image_size_dimensions = aione_get_image_size_dimensions( $post_featured_image_size );

	// Set picture size as data attribute; needed for resizing placeholders
	$data_picture_size = 'auto';
	if ( $post_featured_image_size != 'full' ) {
		$data_picture_size = 'fixed';
	}

	echo sprintf( '<div class="oxo-portfolio-wrapper" data-picturesize="%s" data-pages="%s">', $data_picture_size, $portfolio_posts_to_display->max_num_pages );

		// For non one column layouts check if column spacing is used, and if, how big it is,
		$custom_colulmn_spacing = FALSE;
		if ( ! strpos( $current_page_template, 'one' ) ) {
			// Page option set
			if ( oxo_get_page_option( 'portfolio_column_spacing', $current_page_id ) != NULL ) {
				$custom_colulmn_spacing = TRUE;
				$column_spacing = oxo_get_page_option( 'portfolio_column_spacing', $current_page_id ) / 2;

				echo sprintf( '<style type="text/css">.oxo-portfolio-wrapper{margin: 0 %spx;}.oxo-portfolio-wrapper .oxo-col-spacing{padding:%spx;}</style>', ( -1 ) * $column_spacing, $column_spacing );
			// Page option not set, but theme option
			} else if( Aione()->theme_options[ 'portfolio_column_spacing' ] ) {
				$custom_colulmn_spacing = TRUE;
				$column_spacing = Aione()->theme_options[ 'portfolio_column_spacing' ] / 2;

				echo sprintf( '<style type="text/css">.oxo-portfolio-wrapper{margin: 0 %spx;}.oxo-portfolio-wrapper .oxo-col-spacing{padding:%spx;}</style>', ( -1 ) * $column_spacing, $column_spacing );
			}
		}

		// Loop through all the posts retrieved through our query based on chosen categories
		while ( $portfolio_posts_to_display->have_posts() ) : $portfolio_posts_to_display->the_post();

			// Set the post permalink correctly; this is important for prev/next navigation on single portfolio pages
			if ( $categories_to_display_ids &&
				 ! $show_all_categories
			) {
				$post_permalink = oxo_add_url_parameter( get_permalink(), 'portfolioID', $current_page_id );
			} else {
				$post_permalink = get_permalink();
			}

			// Include the post categories as css classes for later useage with filters
			$post_classes = '';
			$post_categories = get_the_terms( $post->ID, 'portfolio_category' );

			if ( $post_categories ) {
				foreach ( $post_categories as $post_category ) {
					$post_classes .= urldecode( $post_category->slug ) . ' ';
				}
			}

			// Add the col-spacing class if needed
			if ( $custom_colulmn_spacing ) {
				$post_classes .= 'oxo-col-spacing';
			}

			// Add correct post class for image orientation
			if ( $post_featured_image_size == 'full' ) {
				$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );

				$post_classes .= ' ' . aione_get_image_orientation_class( $featured_image );
			}

			// Render the portfolio post
			echo sprintf( '<div class="oxo-portfolio-post post-%s %s">', get_the_ID(), $post_classes );

				// Open oxo-portfolio-content-wrapper for text layouts
				if ( strpos( $current_page_template, 'text' ) ) {
					echo '<div class="oxo-portfolio-content-wrapper">';
				}

					// Render the video set in page options if no featured image is present
					if ( ! has_post_thumbnail() &&
						 oxo_get_page_option( 'video', $post->ID )
					) {

						// For the portfolio one column layout we need a fixed max-width
						if ( $current_page_template == 'portfolio-one-column' ) {
							$video_max_width = '540px';
						// For all other layouts get the calculated max-width from the image size
						} else {
							$video_max_width = $post_featured_image_size_dimensions['width'];
						}

						printf( '<div class="oxo-image-wrapper oxo-video" style="max-width:%s;">', $video_max_width );
							echo oxo_get_page_option( 'video', $post->ID );
						echo '</div>';
					// On every other other layout render the featured image
					} else {

						$featured_image_markup = aione_render_first_featured_image_markup( $post->ID, $post_featured_image_size, $post_permalink, TRUE );

						/* Preparing real masonry
						if ( has_post_thumbnail()
						) {
							$featured_image_markup = str_replace( '"oxo-image-wrapper"', sprintf( '"oxo-image-wrapper" style="background-image: url(%s);"', $featured_image[0] ), $featured_image_markup );
						}
						*/

						echo $featured_image_markup;
					}

					// If we don't have a text layout and not a one column layout only render rich snippets
					if ( ! strpos( $current_page_template, 'text' ) &&
						 ! strpos( $current_page_template, 'one' )
					) {
						echo aione_render_rich_snippets_for_pages();
					// If we have a text layout render its contents
					} else {
						echo '<div class="oxo-portfolio-content">';
							// Render the post title
							echo aione_render_post_title( $post->ID );

							// Render the post categories
							echo sprintf( '<h4>%s</h4>', get_the_term_list( $post->ID, 'portfolio_category', '', ', ', '') );
							echo aione_render_rich_snippets_for_pages( false );

							$post_content = '';
							ob_start();
							/**
							 * aione_portfolio_post_content hook
							 *
							 * @hooked aione_get_portfolio_content - 10 (outputs the post content)
							 */
							do_action( 'aione_portfolio_post_content', $current_page_id );
							$post_content = ob_get_clean();

							// For boxed layouts add a content separator if there is a post content
							if ( $current_page_text_layout == 'boxed' &&
								 $post_content
							) {
								echo '<div class="oxo-content-sep"></div>';
							}

							echo '<div class="oxo-post-content">';

								// Echo the post content
								echo $post_content;

								// On one column layouts render the "Learn More" and "View Project" buttons
								if ( strpos( $current_page_template, 'one' ) ) {
									echo '<div class="oxo-portfolio-buttons">';
										// Render "Learn More" button
										echo sprintf( '<a href="%s" class="oxo-button oxo-button-small oxo-button-default oxo-button-%s oxo-button-%s">%s</a>',
													  $post_permalink, strtolower( Aione()->settings->get( 'button_shape' ) ), strtolower( Aione()->settings->get( 'button_type' ) ), __( 'Learn More', 'Aione' ) );

										// Render the "View Project" button only is a project url was set
										if ( oxo_get_page_option( 'project_url', $post->ID ) ) {
											echo sprintf( '<a href="%s" class="oxo-button oxo-button-small oxo-button-default oxo-button-%s oxo-button-%s">%s</a>', oxo_get_page_option( 'project_url', $post->ID ),
														  strtolower( Aione()->settings->get( 'button_shape' ) ), strtolower( Aione()->settings->get( 'button_type' ) ), __( ' View Project', 'Aione' ) );
										}
									echo '</div>';
								}

							echo '</div>'; // end post-content

							// On unboxed one column layouts render a separator at the bottom of the post
							if ( strpos( $current_page_template, 'one' ) &&
								 $current_page_text_layout == 'unboxed'
							) {
								echo '<div class="oxo-clearfix"></div>';
								echo '<div class="oxo-separator sep-double"></div>';
							}

						echo '</div>'; // end portfolio-content
					} // end template check

				// Close oxo-portfolio-content-wrapper for text layouts
				if ( strpos( $current_page_template, 'text' ) ) {
					echo '</div>';
				}

			echo '</div>'; // end portfolio-post
		endwhile;
	echo '</div>'; // end portfolio-wrapper

	// If infinite scroll with "load more" button is used
	if ( Aione()->theme_options[ 'grid_pagination_type' ] == 'load_more_button' ) {
		echo sprintf( '<div class="oxo-load-more-button oxo-clearfix">%s</div>', apply_filters( 'aione_load_more_posts_name', __( 'Load More Posts', 'Aione' ) ) );
	}

	// Render the pagination
	oxo_pagination( $portfolio_posts_to_display->max_num_pages, $range = 2, $portfolio_posts_to_display );

	wp_reset_query();

} // password check

// Omit closing PHP tag to avoid "Headers already sent" issues.
