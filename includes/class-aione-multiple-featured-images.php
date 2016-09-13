<?php

class Aione_Multiple_Featured_Images {

	public function __construct() {
		if( is_admin() ) {
			add_action( 'after_setup_theme', array( $this, 'generate' ) );
		}
	}

	public function generate() {
		$post_types = array(
			'post',
			'page',
			'aione_portfolio',
		);

		if ( ! class_exists( 'kdMultipleFeaturedImages' ) ) {
			return;
		}

		$i = 2;

		while ( $i <= Aione()->theme_options[ 'posts_slideshow_number' ] ) {

			foreach ( $post_types as $post_type ) {
				new kdMultipleFeaturedImages( array(
					'id'         => 'featured-image-' . $i,
					'post_type'  => $post_type,
					'labels'     => array(
						'name'   => sprintf( __( 'Featured image %s', 'Aione' ), $i ),
						'set'	 => sprintf( __( 'Set featured image %s', 'Aione' ), $i ),
						'remove' => sprintf( __( 'Remove featured image %s', 'Aione' ), $i ),
						'use'    => sprintf( __( 'Use as featured image %s', 'Aione' ), $i ),
					)
				) );
			}

			$i++;

		}

	}

}

// Omit closing PHP tag to avoid "Headers already sent" issues.
