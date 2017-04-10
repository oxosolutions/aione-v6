<?php

class Aione_Portfolio {

	/**
	 * The class constructor
	 */
	public function __construct() {
		add_filter( 'oxo_content_class', array( $this, 'set_portfolio_single_width' ) );
		add_filter( 'oxo_content_class', array( $this, 'set_portfolio_page_template_classes' ) );
		add_filter( 'pre_get_posts', array( $this, 'set_post_filters' ) );
	}

	/**
	 * Modify the query (using the 'pre_get_posts' filter)
	 */
	public function set_post_filters( $query ) {

		if ( ! is_admin() && $query->is_main_query() && ( is_tax( 'portfolio_category' ) || is_tax( 'portfolio_skills' ) || is_tax( 'portfolio_tags' ) ) ) {
			$query->set( 'posts_per_page', Aione()->theme_options[ 'portfolio_items' ] );
		}

		return $query;

	}

	/**
	 * Set portfolio width and assign a class to the content div
	 */
	public function set_portfolio_single_width( $classes ) {
		if( is_singular( 'aione_portfolio') ) {
			if ( oxo_get_option( Aione()->theme_options['portfolio_featured_image_width'], 'width', Aione::c_pageID() ) == 'half' ) {
				$portfolio_width = 'half';
			} else {
				$portfolio_width = 'full';
			}
			if ( ! Aione()->theme_options[ 'portfolio_featured_images' ] &&
				$portfolio_width == 'half'
			) {
				$portfolio_width = 'full';
			}

			$classes[] = 'portfolio-' . $portfolio_width;
		}

		return $classes;
	}

	/**
	 * Set portfolio page template classes
	 */
	public function set_portfolio_page_template_classes( $classes ) {
		if(
			is_page_template( 'portfolio-one-column.php') ||
			is_page_template( 'portfolio-two-column.php') ||
			is_page_template( 'portfolio-three-column.php') ||
			is_page_template( 'portfolio-four-column.php') ||
			is_page_template( 'portfolio-five-column.php') ||
			is_page_template( 'portfolio-six-column.php') ||
			is_page_template( 'portfolio-one-column-text.php') ||
			is_page_template( 'portfolio-two-column-text.php') ||
			is_page_template( 'portfolio-three-column-text.php') ||
			is_page_template( 'portfolio-four-column-text.php') ||
			is_page_template( 'portfolio-five-column-text.php') ||
			is_page_template( 'portfolio-six-column-text.php') ||
			is_page_template( 'portfolio-grid.php')
		) {
			$classes[] = aione_get_portfolio_classes( Aione::c_pageID() );
		}

		return $classes;
	}

}

// Omit closing PHP tag to avoid "Headers already sent" issues.
