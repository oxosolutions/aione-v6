<?php
/**
 * Contains functions for Ajax Queries
 *
 * @author		OXOSolutions
 * @copyright	(c) Copyright by OXOSolutions
 * @link		http://oxosolutions.com
 * @package 	OxoFramework
 * @since		Version 1.0
 */

add_action( 'wp_ajax_oxo_cache_map', 'oxo_cache_map' );
add_action( 'wp_ajax_nopriv_oxo_cache_map', 'oxo_cache_map' );

function oxo_cache_map() {
	check_ajax_referer( 'aione_admin_ajax', 'security' );

	$addresses_to_cache = get_option( 'oxo_map_addresses' );

	foreach ( $_POST['addresses'] as $address ) {

		if ( isset( $address['latitude'] ) && isset( $address['longitude'] ) ) {
			$addresses_to_cache[trim( $address['address'] )] = array(
				'address'   => trim( $address['address'] ),
				'latitude'  => $address['latitude'],
				'longitude' => $address['longitude']
			);

			if ( isset( $address['geocoded_address'] ) && $address['geocoded_address'] ) {
				$addresses_to_cache[trim( $address['address'] )]['address'] = $address['geocoded_address'];
			}
		}

	}

	update_option( 'oxo_map_addresses', $addresses_to_cache );

	wp_die();

}

// Omit closing PHP tag to avoid "Headers already sent" issues.
