<?php

/**
 * Format of the $css array:
 * $css['media-query']['element']['property'] = value
 *
 * If no media query is required then set it to 'global'
 *
 * If we want to add multiple values for the same property then we have to make it an array like this:
 * $css[media-query][element]['property'][] = value1
 * $css[media-query][element]['property'][] = value2
 *
 * Multiple values defined as an array above will be parsed separately.
 */
function aione_dynamic_css_array() {

	global $wp_version;

	$c_pageID = Aione::c_pageID();

	$isiPad = (bool) strpos( $_SERVER['HTTP_USER_AGENT'], 'iPad' );

	$css = array();

	$site_width = (int) Aione()->theme_options['site_width'];

	// The site width WITH units appended
	if ( false === strpos( Aione()->theme_options['site_width'], '%' ) && false === strpos( Aione()->theme_options['site_width'], 'px' ) ) {
		$site_width_with_units = Aione_Sanitize::size( Aione()->theme_options['site_width'] . 'px' );
	} else {
		$site_width_with_units = Aione_Sanitize::size( Aione()->theme_options['site_width'] );
	}
	// The site width as an integer value (WITHOUT units appended)
	$site_width_without_units = (int) Aione_Sanitize::size( Aione()->theme_options['site_width'] );

	// Is the site width a percent value?
	$site_width_percent = ( false !== strpos( Aione()->theme_options['site_width'], '%' ) ) ? true : false;

	$theme_info = wp_get_theme();
	if ( $theme_info->parent_theme ) {
		$template_dir = basename( get_template_directory() );
		$theme_info   = wp_get_theme( $template_dir );
	}

	$css['global']['.' . $theme_info->get( 'Name' ) . "_" . str_replace( '.', '', $theme_info->get( 'Version' ) )]['color'] = 'green';

	if ( ! Aione()->theme_options[ 'responsive' ] ) {
		$css['global']['.ua-mobile #wrapper']['width']    = '100% !important';
		$css['global']['.ua-mobile #wrapper']['overflow'] = 'hidden !important';
	}

	$side_header_width = ( 'top' == Aione()->theme_options[ 'header_position' ] ) ? 0 : intval( Aione()->theme_options[ 'side_header_width' ] );

	if ( version_compare( $wp_version, '4.3.1', '<=' ) ) {
		// tweak the comment-form CSS for WordPress versions < 4.4
		$css['global']['#comment-input']['margin-bottom'] = '13px';
	}

	if ( class_exists( 'WooCommerce' ) ) {

		if ( 'horizontal' == Aione()->theme_options[ 'woocommerce_product_tab_design' ] ) {

			$css['global']['.woocommerce-tabs > .tabs']['width']         = '100%';
			$css['global']['.woocommerce-tabs > .tabs']['margin']        = '0px';
			$css['global']['.woocommerce-tabs > .tabs']['border-bottom'] = '1px solid #dddddd';

			$css['global']['.woocommerce-tabs > .tabs li']['float'] = 'left';

			$css['global']['.woocommerce-tabs > .tabs li a']['border']  = 'none !important';
			$css['global']['.woocommerce-tabs > .tabs li a']['padding'] = '10px 20px';

			$css['global']['.woocommerce-tabs > .tabs .active']['border'] = '1px solid #dddddd';
			$css['global']['.woocommerce-tabs > .tabs .active']['height'] = '40px';

			$css['global']['.woocommerce-tabs > .tabs .active:hover a']['cursor'] = 'default';

			$css['global']['.woocommerce-tabs .entry-content']['float']      = 'left';
			$css['global']['.woocommerce-tabs .entry-content']['margin']     = '0px';
			$css['global']['.woocommerce-tabs .entry-content']['width']      = '100%';
			$css['global']['.woocommerce-tabs .entry-content']['border-top'] = 'none';

		}

		if ( '' != Aione()->theme_options[ 'timeline_bg_color'] && 'transparent' != Aione()->theme_options[ 'timeline_bg_color' ] ) {
			$css['global']['.products .product-list-view']['padding-left']  = '20px';
			$css['global']['.products .product-list-view']['padding-right'] = '20px';
		}
		
		$elements = array(
			'.oxo-item-in-cart .oxo-rollover-content .oxo-rollover-title',
			'.oxo-item-in-cart .oxo-rollover-content .oxo-rollover-categories',
			'.oxo-item-in-cart .oxo-rollover-content .price',
			'.oxo-carousel-title-below-image .oxo-item-in-cart .oxo-rollover-content .oxo-product-buttons',
			'.products .product .oxo-item-in-cart .oxo-rollover-content .oxo-product-buttons'
		);			
		$css['global'][aione_implode( $elements )]['display'] = 'none';		

		if ( Aione()->theme_options[ 'woocommerce_product_box_design' ] == 'clean' ) {
			$css['global']['.oxo-woo-product-design-clean .products .product-details-container']['text-align'] = 'center';
			$css['global']['.oxo-woo-product-design-clean .products .oxo-rollover .star-rating']['margin'] = '0 auto';
			$css['global']['.oxo-woo-product-design-clean .products .oxo-rollover .star-rating span:before, .oxo-woo-product-design-clean .products .oxo-rollover .star-rating:before']['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'image_rollover_icon_color' ], Aione()->settings->get_default( 'image_rollover_icon_color' ) );
			$css['global']['.oxo-woo-product-design-clean .products .oxo-product-buttons a, .oxo-woo-slider .oxo-product-buttons a']['padding'] = '0';
			$css['global']['.oxo-woo-product-design-clean .products .oxo-product-buttons a:before, .oxo-woo-product-design-clean .products .oxo-product-buttons a:after, .oxo-woo-slider .oxo-product-buttons a:before, .oxo-woo-slider .oxo-product-buttons a:after']['display'] = 'none';
			$css['global']['.oxo-woo-product-design-clean .products .oxo-rollover-content .oxo-product-buttons a, .oxo-woo-slider .oxo-product-buttons a']['display'] = 'inline';
			$css['global']['.oxo-woo-product-design-clean .products .oxo-rollover-content .oxo-product-buttons a, .oxo-woo-slider .oxo-product-buttons a']['letter-spacing'] = '1px';
			$css['global']['.oxo-woo-product-design-clean .products .oxo-rollover-content .oxo-product-buttons a, .oxo-woo-slider .oxo-product-buttons a']['float'] = 'none';
			$css['global']['.oxo-woo-product-design-clean .products .oxo-rollover-content .oxo-product-buttons, .oxo-woo-slider .oxo-product-buttons']['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'image_rollover_text_color' ], Aione()->settings->get_default( 'image_rollover_text_color' ) );
			$css['global']['.oxo-woo-product-design-clean .products .oxo-rollover-content .oxo-product-buttons, .oxo-woo-slider .oxo-product-buttons']['text-transform'] = 'uppercase';
			$css['global']['.oxo-woo-product-design-clean .products .oxo-rollover-content .oxo-product-buttons,.oxo-woo-slider .oxo-product-buttons']['margin-top'] = '10px';
			$css['global']['.oxo-woo-product-design-clean .products .oxo-rollover-content .oxo-product-buttons a, .oxo-woo-slider .oxo-product-buttons a']['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'image_rollover_text_color' ], Aione()->settings->get_default( 'image_rollover_text_color' ) );
			$css['global']['.oxo-woo-product-design-clean .products .oxo-rollover-content .oxo-product-buttons .wc-forward, .oxo-woo-slider .oxo-product-buttons .wc-forward']['display'] = 'none';
			$css['global']['.oxo-woo-product-design-clean .products .oxo-rollover-content .oxo-product-buttons a:hover, .oxo-woo-slider .oxo-product-buttons a:hover']['opacity'] = '0.6';
			$css['global']['.oxo-woo-product-design-clean .products .oxo-rollover-content .oxo-rollover-linebreak, .oxo-woo-slider .oxo-product-buttons .oxo-rollover-linebreak']['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'image_rollover_text_color' ], Aione()->settings->get_default( 'image_rollover_text_color' ) );
			$css['global']['.oxo-woo-product-design-clean .products .oxo-rollover-content .oxo-rollover-linebreak, .oxo-woo-slider .oxo-product-buttons .oxo-rollover-linebreak']['margin'] = '0 10px';
			$css['global']['.oxo-woo-slider .oxo-product-buttons .oxo-rollover-linebreak']['display'] = 'inline-block';

			$css['global']['.oxo-clean-product-image-wrapper']['position'] = 'relative';
			$css['global']['.oxo-clean-product-image-wrapper .cart-loading']['position'] = 'relative';
			$css['global']['.oxo-clean-product-image-wrapper .cart-loading']['text-transform'] = 'uppercase';
			$css['global']['.oxo-clean-product-image-wrapper .cart-loading']['width'] = '100%';
			$css['global']['.oxo-clean-product-image-wrapper .cart-loading']['margin'] = '0';
			$css['global']['.oxo-clean-product-image-wrapper .cart-loading']['height'] = '100%';
			$css['global']['.oxo-clean-product-image-wrapper .cart-loading']['line-height'] = 'normal';
			$css['global']['.oxo-clean-product-image-wrapper .cart-loading i']['margin-bottom'] = '5px';
			$css['global']['.oxo-clean-product-image-wrapper .cart-loading i']['display'] = 'block';
			$css['global']['.oxo-clean-product-image-wrapper .cart-loading i']['font-size'] = '32px';
			$css['global']['.oxo-clean-product-image-wrapper .cart-loading i']['line-height'] = 'normal';
			$css['global']['.oxo-clean-product-image-wrapper .cart-loading']['font-size'] = '14px';
			$css['global']['.oxo-clean-product-image-wrapper .cart-loading']['top'] = '0';
			$css['global']['.oxo-clean-product-image-wrapper .cart-loading']['bottom'] = 'auto';
			$css['global']['.oxo-clean-product-image-wrapper .cart-loading']['right'] = 'auto';
			$css['global']['.oxo-clean-product-image-wrapper .cart-loading']['left'] = '0';
			$css['global']['.oxo-clean-product-image-wrapper .cart-loading']['border-radius'] = '0';
			$css['global']['.oxo-clean-product-image-wrapper .cart-loading .view-cart']['display'] = 'none';
			$css['global']['.oxo-clean-product-image-wrapper.oxo-item-in-cart .cart-loading .view-cart']['display'] = 'block';
			$css['global']['#wrapper .oxo-clean-product-image-wrapper .cart-loading']['background-color'] = 'transparent';
			$css['global']['.oxo-clean-product-image-wrapper .cart-loading:hover *']['opacity'] = '0.6';
			
			
			$elements = array(
				'.oxo-item-in-cart .oxo-rollover-content .star-rating', 
			);			
			$css['global'][aione_implode( $elements )]['display'] = 'none';


			$css['global']['.oxo-woo-product-design-clean .products .price']['font-style'] = 'italic';
			if( isset( $_SERVER['QUERY_STRING'] ) ) {
				parse_str( $_SERVER['QUERY_STRING'], $params );
				if( isset ( $params['product_view'] ) ){
					$product_view = $params['product_view'];
					if( $product_view == 'list' ){
						$css['global']['.oxo-woo-product-design-clean .products .product-list-view .product-details-container']['text-align'] = 'left';
						$css['global']['.oxo-woo-product-design-clean .products .product-list-view .product-excerpt-container']['text-align'] = 'left';
						$css['global']['.oxo-woo-product-design-clean .products .product-list-view .onsale']['top'] = '70px';
						$css['global']['.oxo-clean-product-image-wrapper']['display'] = 'inline-block';
						$css['global']['.oxo-clean-product-image-wrapper']['width'] = '23%';
						$css['global']['.oxo-clean-product-image-wrapper']['max-width'] = '23%';
						$css['global']['.oxo-clean-product-image-wrapper']['float'] = 'left';
						$css['global']['.oxo-clean-product-image-wrapper']['margin-right'] = '2%';
						$css['global']['.oxo-woo-product-design-clean .products .price']['font-style'] = 'normal';
					}
				}
			}
			$css['global']['.oxo-woo-slider .oxo-carousel-title-below-image .oxo-carousel-title']['text-align'] = 'center';
			$css['global']['.oxo-woo-slider .oxo-carousel-title-below-image .oxo-carousel-meta']['text-align'] = 'center';
			$css['global']['.oxo-woo-slider .oxo-carousel-title-on-rollover .oxo-rollover-linebreak']['display'] = 'none';
		}

		// Make the single product page layout reflect the single image size in Woo settings
		if ( is_product() ) {
			$post_image = get_the_post_thumbnail( get_the_ID(), apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );

			if ( $post_image ) {
				preg_match( '@width="([^"]+)"@' , $post_image, $match );

				if ( $match[1] != '500' ) {

					$shop_single_image_size = wc_get_image_size( 'shop_single' );

					$css['global']['.product .images']['width'] = $shop_single_image_size['width'] . 'px';
					$css['global']['.product .summary.entry-summary']['margin-left'] = $shop_single_image_size['width'] + 30 . 'px';
				}
			}
		}

	}

	$elements = array(
		'html',
		//'body',
		'html body.custom-background',
	);
	if ( class_exists( 'WooCommerce' ) ) {
		$elements[] = '.woocommerce-tabs > .tabs .active a';
	}
	$css['global'][aione_implode( $elements )]['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'content_bg_color' ], Aione()->settings->get_default( 'content_bg_color' ) );

	if ( 'Wide' == Aione()->theme_options['layout'] ) {
		$css['global'][aione_implode( $elements )]['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'content_bg_color' ], Aione()->settings->get_default( 'content_bg_color' ) );
	} elseif ( 'Boxed' == Aione()->theme_options['layout'] ) {
		$css['global'][aione_implode( $elements )]['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'bg_color' ], Aione()->settings->get_default( 'bg_color' ) );
	}

	if ( ! $site_width_percent ) {

		$elements = array(
			'#main',
			'.oxo-secondary-header',
			'.sticky-header .sticky-shadow',
			'.tfs-slider .slide-content-container',
			'.header-v4 #small-nav',
			'.header-v5 #small-nav',
			'.oxo-footer-copyright-area',
			'.oxo-footer-widget-area',
			'#slidingbar',
			'.oxo-page-title-bar',
		);
		$css['global'][aione_implode( $elements )]['padding-left']  = '30px';
		$css['global'][aione_implode( $elements )]['padding-right'] = '30px';

		$elements = array(
			'.width-100 .nonhundred-percent-fullwidth',
			'.width-100 .oxo-section-separator',
		);


		if ( get_post_meta( $c_pageID, 'pyre_hundredp_padding', true ) || get_post_meta( $c_pageID, 'pyre_hundredp_padding', true ) == '0' ) {
			$css['global'][aione_implode( $elements )]['padding-left']  = Aione_Sanitize::size( get_post_meta( $c_pageID, 'pyre_hundredp_padding', true ) ) . '';
			$css['global'][aione_implode( $elements )]['padding-right'] = Aione_Sanitize::size( get_post_meta( $c_pageID, 'pyre_hundredp_padding', true ) ) . '';
		} elseif ( Aione()->theme_options[ 'hundredp_padding' ] || Aione()->theme_options[ 'hundredp_padding' ] == '0' ) {
			$css['global'][aione_implode( $elements )]['padding-left']  = Aione_Sanitize::size( Aione()->theme_options[ 'hundredp_padding' ] ) . '';
			$css['global'][aione_implode( $elements )]['padding-right'] = Aione_Sanitize::size( Aione()->theme_options[ 'hundredp_padding' ] ) . '';
		}

		$elements = array(
			'.width-100 .fullwidth-box',
			'.width-100 .oxo-section-separator',
		);

		if ( get_post_meta( $c_pageID, 'pyre_hundredp_padding', true ) || get_post_meta( $c_pageID, 'pyre_hundredp_padding', true ) == '0' ) {
			$css['global'][aione_implode( $elements )]['margin-left']  = '-' . Aione_Sanitize::size( get_post_meta( $c_pageID, 'pyre_hundredp_padding', true ) ) . '!important';
			$css['global'][aione_implode( $elements )]['margin-right'] = '-' . Aione_Sanitize::size( get_post_meta( $c_pageID, 'pyre_hundredp_padding', true ) ) . '!important';
		} elseif ( Aione()->theme_options[ 'hundredp_padding' ] || Aione()->theme_options( 'hundredp_padding' ) == '0' ) {
			$css['global'][aione_implode( $elements )]['margin-left']  = '-' . Aione_Sanitize::size( Aione()->theme_options[ 'hundredp_padding' ] ) . '!important';
			$css['global'][aione_implode( $elements )]['margin-right'] = '-' . Aione_Sanitize::size( Aione()->theme_options[ 'hundredp_padding' ] ) . '!important';
		}

	}

	$css['global']['.oxo-mobile-menu-design-modern .oxo-mobile-nav-holder li a']['padding-left']  = '30px';
	$css['global']['.oxo-mobile-menu-design-modern .oxo-mobile-nav-holder li a']['padding-right'] = '30px';

	$css['global']['.oxo-mobile-menu-design-modern .oxo-mobile-nav-holder .oxo-mobile-nav-item .oxo-open-submenu']['padding-right'] = '35px';

	$css['global']['.oxo-mobile-menu-design-modern .oxo-mobile-nav-holder .oxo-mobile-nav-item a']['padding-left']  = '30px';
	$css['global']['.oxo-mobile-menu-design-modern .oxo-mobile-nav-holder .oxo-mobile-nav-item a']['padding-right'] = '30px';
	$css['global']['.oxo-mobile-menu-design-modern .oxo-mobile-nav-holder .oxo-mobile-nav-item li a']['padding-left'] = '39px';
	$css['global']['.oxo-mobile-menu-design-modern .oxo-mobile-nav-holder .oxo-mobile-nav-item li li a']['padding-left'] = '48px';
	$css['global']['.oxo-mobile-menu-design-modern .oxo-mobile-nav-holder .oxo-mobile-nav-item li li li a']['padding-left'] = '57px';
	$css['global']['.oxo-mobile-menu-design-modern .oxo-mobile-nav-holder .oxo-mobile-nav-item li li li li a']['padding-left'] = '66px';

	$elements = array(
		'a:hover',
		'.tooltip-shortcode',
		'.event-is-recurring:hover'
	);
	$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options['primary_color'], Aione()->settings->get_default( 'primary_color' ) );

	$elements = array(
		'.oxo-login-box a:hover',
		'.oxo-footer-widget-area ul li a:hover',
		'.oxo-footer-widget-area .widget li a:hover:before',
		'.oxo-footer-widget-area .oxo-tabs-widget .tab-holder .news-list li .post-holder a:hover',
		'.oxo-footer-widget-area .oxo-accordian .panel-title a:hover',
		'#slidingbar-area ul li a:hover',
		'#slidingbar-area .oxo-accordian .panel-title a:hover',
		'.oxo-filters .oxo-filter.oxo-active a',
		'.project-content .project-info .project-info-box a:hover',
		'#main .post h2 a:hover',
		'#main .about-author .title a:hover',
		'span.dropcap',
		'.oxo-footer-widget-area a:hover',
		'.slidingbar-area a:hover',
		'.slidingbar-area .widget li a:hover:before',
		'.oxo-copyright-notice a:hover',
		'.oxo-content-widget-area .widget_categories li a:hover',
		'.oxo-content-widget-area .widget li a:hover',
		'.oxo-date-and-formats .oxo-format-box i',
		'h5.toggle:hover a',
		'.tooltip-shortcode',
		'.content-box-percentage',
		'.oxo-popover',
		'.more a:hover:after',
		'.oxo-read-more:hover:after',
		'.pagination-prev:hover:before',
		'.pagination-next:hover:after',
		'.single-navigation a[rel=prev]:hover:before',
		'.single-navigation a[rel=next]:hover:after',
		'.oxo-content-widget-area .widget li a:hover:before',
		'.oxo-content-widget-area .widget_nav_menu li a:hover:before',
		'.oxo-content-widget-area .widget_categories li a:hover:before',
		'.oxo-content-widget-area .widget .recentcomments:hover:before',
		'.oxo-content-widget-area .widget_recent_entries li a:hover:before',
		'.oxo-content-widget-area .widget_archive li a:hover:before',
		'.oxo-content-widget-area .widget_pages li a:hover:before',
		'.oxo-content-widget-area .widget_links li a:hover:before',
		'.side-nav .arrow:hover:after',
		'#wrapper .jtwt .jtwt_tweet a:hover',
		'.star-rating:before',
		'.star-rating span:before',
		'#wrapper .oxo-widget-area .current_page_item > a',
		'#wrapper .oxo-widget-area .current-menu-item > a',
		'#wrapper .oxo-widget-area .current_page_item > a:before',
		'#wrapper .oxo-widget-area .current-menu-item > a:before',
		'.side-nav ul > li.current_page_item > a',
		'.side-nav li.current_page_ancestor > a',
		'.oxo-accordian .panel-title a:hover',
		'.price ins .amount',
		'.price > .amount',
	);
	if ( is_rtl() ) {
		$elements[] = '.rtl .more a:hover:before';
		$elements[] = '.rtl .oxo-read-more:hover:before';
	}
	if ( class_exists( 'GFForms' ) ) {
		$elements[] = '.gform_wrapper span.ginput_total';
		$elements[] = '.gform_wrapper span.ginput_product_price';
		$elements[] = '.ginput_shipping_price';
	}
	if ( class_exists( 'bbPress' ) ) {
		$elements[] = '.bbp-pagination .bbp-pagination-links .pagination-prev:hover:before';
		$elements[] = '.bbp-pagination .bbp-pagination-links .pagination-next:hover:after';
		$elements[] = '.bbp-topics-front ul.super-sticky a:hover';
		$elements[] = '.bbp-topics ul.super-sticky a:hover';
		$elements[] = '.bbp-topics ul.sticky a:hover';
		$elements[] = '.bbp-forum-content ul.sticky a:hover';

	}
	if ( class_exists( 'WooCommerce' ) ) {
		$elements[] = '.woocommerce .address .edit:hover:after';
		$elements[] = '.woocommerce-tabs .tabs a:hover .arrow:after';
		$elements[] = '.woocommerce-pagination .prev:hover';
		$elements[] = '.woocommerce-pagination .next:hover';
		$elements[] = '.woocommerce-pagination .prev:hover:before';
		$elements[] = '.woocommerce-pagination .next:hover:after';
		$elements[] = '.woocommerce-tabs .tabs li.active a';
		$elements[] = '.woocommerce-tabs .tabs li.active a .arrow:after';
		$elements[] = '.woocommerce-side-nav li.active a';
		$elements[] = '.woocommerce-side-nav li.active a:after';
		$elements[] = '.my_account_orders .order-actions a:hover:after';
		$elements[] = '.aione-order-details .shop_table.order_details tfoot tr:last-child .amount';
		$elements[] = '#wrapper .cart-checkout a:hover';
		$elements[] = '#wrapper .cart-checkout a:hover:before';
		$elements[] = '.widget_shopping_cart_content .total .amount';
		$elements[] = '.widget_layered_nav li a:hover:before';
		$elements[] = '.widget_product_categories li a:hover:before';
		$elements[] = '.my_account_orders .order-number a';
		$elements[] = '.shop_table .product-subtotal .amount';
		$elements[] = '.cart_totals .order-total .amount';
		$elements[] = '.checkout .shop_table tfoot .order-total .amount';
		$elements[] = '#final-order-details .mini-order-details tr:last-child .amount';
		$elements[] = '.oxo-carousel-title-below-image .oxo-carousel-meta .price .amount';
		//$elements[] = '.oxo-woo-product-design-clean .products .oxo-rollover-content .oxo-product-buttons a:hover';
		//$elements[] = '.oxo-woo-product-design-clean .products .oxo-rollover-content .cart-loading a:hover';
	}
	if( class_exists( 'Tribe__Events__Main' ) ) {
		$elements[] = '.tribe-events-gmap:hover:before';
		$elements[] = '.tribe-events-gmap:hover:after';
		$elements[] = '.tribe-events-nav-previous a:hover:before, .tribe-events-nav-previous a:hover:after';
		$elements[] = '.tribe-events-nav-next a:hover:before, .tribe-events-nav-next a:hover:after';
		$elements[] = '#tribe-events-content .tribe-events-sub-nav li a:hover';
		$elements[] = '.tribe-mini-calendar-event .list-date .list-dayname';
		$elements[] = '#tribe_events_filters_wrapper .tribe_events_slider_val';
	}
	$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options['primary_color'], Aione()->settings->get_default( 'primary_color' ) );

	$elements = array(
		'.oxo-accordian .panel-title a:hover .fa-oxo-box'
	);
	$css['global'][aione_implode( $elements )]['background-color'] = Aione_Sanitize::color( Aione()->theme_options['primary_color'], Aione()->settings->get_default( 'primary_color' ) ) . ' !important';
	$css['global'][aione_implode( $elements )]['border-color']     = Aione_Sanitize::color( Aione()->theme_options['primary_color'], Aione()->settings->get_default( 'primary_color' ) ) . ' !important';

	$css['global']['.oxo-content-widget-area .oxo-image-wrapper .oxo-rollover .oxo-rollover-content a:hover']['color'] = '#333333';

	$elements = array( '.star-rating:before', '.star-rating span:before' );
	$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options['primary_color'], Aione()->settings->get_default( 'primary_color' ) );

	$elements = array( '.tagcloud a:hover', '#slidingbar-area .tagcloud a:hover', '.oxo-footer-widget-area .tagcloud a:hover' );
	$css['global'][aione_implode( $elements )]['color']       = '#FFFFFF';
	$css['global'][aione_implode( $elements )]['text-shadow'] = 'none';

	$elements = array(
		'.reading-box',
		'.oxo-filters .oxo-filter.oxo-active a',
		'#wrapper .oxo-tabs-widget .tab-holder .tabs li.active a',
		'#wrapper .post-content blockquote',
		'.progress-bar-content',
		'.pagination .current',
		'.pagination a.inactive:hover',
		'.oxo-hide-pagination-text .pagination-prev:hover',
		'.oxo-hide-pagination-text .pagination-next:hover',
		'#nav ul li > a:hover',
		'#sticky-nav ul li > a:hover',
		'.tagcloud a:hover',
		'#wrapper .oxo-tabs.classic .nav-tabs > li.active .tab-link:hover',
		'#wrapper .oxo-tabs.classic .nav-tabs > li.active .tab-link:focus',
		'#wrapper .oxo-tabs.classic .nav-tabs > li.active .tab-link',
		'#wrapper .oxo-tabs.vertical-tabs.classic .nav-tabs > li.active .tab-link'
	);
	if ( class_exists( 'bbPress' ) ) {
		$elements[] = '.bbp-pagination .bbp-pagination-links .current';
		$elements[] = '.bbp-topic-pagination .page-numbers:hover';
		$elements[] = '#bbpress-forums div.bbp-topic-tags a:hover';
		$elements[] = '.oxo-hide-pagination-text .bbp-pagination .bbp-pagination-links .pagination-prev:hover';
		$elements[] = '.oxo-hide-pagination-text .bbp-pagination .bbp-pagination-links .pagination-next:hover';
	}
	if ( class_exists( 'WooCommerce' ) ) {
		$elements[] = '.woocommerce-pagination .page-numbers.current';
		$elements[] = '.woocommerce-pagination .page-numbers:hover';
		$elements[] = '.woocommerce-pagination .current';
	}
	$css['global'][aione_implode( $elements )]['border-color'] = Aione_Sanitize::color( Aione()->theme_options['primary_color'], Aione()->settings->get_default( 'primary_color' ) );

	$css['global']['#wrapper .side-nav li.current_page_item a']['border-right-color'] = Aione_Sanitize::color( Aione()->theme_options['primary_color'], Aione()->settings->get_default( 'primary_color' ) );
	$css['global']['#wrapper .side-nav li.current_page_item a']['border-left-color']  = Aione_Sanitize::color( Aione()->theme_options['primary_color'], Aione()->settings->get_default( 'primary_color' ) );

	$elements = array(
		'.oxo-accordian .panel-title .active .fa-oxo-box',
		'ul.circle-yes li:before',
		'.circle-yes ul li:before',
		'.progress-bar-content',
		'.pagination .current',
		'.oxo-date-and-formats .oxo-date-box',
		'.table-2 table thead',
		'.tagcloud a:hover',
		'#toTop:hover',
		'#wrapper .search-table .search-button input[type="submit"]:hover',
		'ul.arrow li:before',
	);
	if ( class_exists( 'bbPress' ) ) {
		$elements[] = '.bbp-pagination .bbp-pagination-links .current';
		//$elements[] = '#bbpress-forums div.bbp-topic-tags a:hover';
	}
	if ( class_exists( 'WooCommerce' ) ) {
		$elements[] = '.onsale';
		$elements[] = '.woocommerce-pagination .current';
		$elements[] = '.woocommerce .social-share li a:hover i';
		$elements[] = '.price_slider_wrapper .ui-slider .ui-slider-range';
		$elements[] = '.cart-loading';
		$elements[] = 'p.demo_store';
		$elements[] = '.aione-myaccount-data .digital-downloads li:before';
		$elements[] = '.aione-thank-you .order_details li:before';
		$elements[] = '.oxo-content-widget-area .widget_layered_nav li.chosen';
		$elements[] = '.oxo-content-widget-area .widget_layered_nav_filters li.chosen';
	}
	if ( class_exists( 'Tribe__Events__Main' ) ) {
		$elements[] = '.tribe-events-calendar thead th';
		$elements[] = '.tribe-events-calendar td.tribe-events-present div[id*=tribe-events-daynum-]';
		$elements[] = '.tribe-events-calendar td.tribe-events-present div[id*=tribe-events-daynum-]>a';
		$elements[] = '#tribe-events-content .tribe-events-tooltip h4';
		$elements[] = '.tribe-events-list-separator-month';
		$elements[] = '.tribe-mini-calendar-event .list-date';
	}
	$css['global'][aione_implode( $elements )]['background-color'] = Aione_Sanitize::color( Aione()->theme_options['primary_color'], Aione()->settings->get_default( 'primary_color' ) );

	if ( class_exists( 'WooCommerce' ) ) {
		$css['global']['.woocommerce .social-share li a:hover i']['border-color'] = Aione_Sanitize::color( Aione()->theme_options['primary_color'], Aione()->settings->get_default( 'primary_color' ) );
	}

	if ( class_exists( 'bbPress' ) ) {
		$elements = array(
			'.bbp-topics-front ul.super-sticky',
			'.bbp-topics ul.super-sticky',
			'.bbp-topics ul.sticky',
			'.bbp-forum-content ul.sticky'
		);
		$css['global'][aione_implode( $elements )]['background-color'] = '#ffffe8';
		$css['global'][aione_implode( $elements )]['opacity']          = '1';
	}

	if ( Aione()->theme_options[ 'slidingbar_widgets' ] ) {

		if ( Aione()->theme_options[ 'slidingbar_bg_color' ] ) {

			$color = Aione()->theme_options[ 'slidingbar_bg_color' ];
			if( ! $color ) {
				$color = Aione()->settings->get_default( 'slidingbar_bg_color' );
			}
			$rgb   = oxo_hex2rgb( $color['color'] );
			$rgba  = 'rgba( ' . $rgb[0] . ',' . $rgb[1] . ',' . $rgb[2] . ',' . $color['opacity'] . ')';

			$css['global']['#slidingbar']['background-color'][] = Aione_Sanitize::color( $color['color'] );
			$css['global']['#slidingbar']['background-color'][] = Aione_Sanitize::color( $rgba );

			$css['global']['.sb-toggle-wrapper']['border-top-color'][] = $color['color'];
			$css['global']['.sb-toggle-wrapper']['border-top-color'][] = $rgba;

			$css['global']['#wrapper #slidingbar-area .oxo-tabs-widget .tab-holder .tabs li']['border-color'][] = $color['color'];
			$css['global']['#wrapper #slidingbar-area .oxo-tabs-widget .tab-holder .tabs li']['border-color'][] = $rgba;

			if ( Aione()->theme_options[ 'slidingbar_top_border' ] ) {

				$css['global']['#slidingbar-area']['border-bottom'][] = '3px solid ' . $color['color'];
				$css['global']['#slidingbar-area']['border-bottom'][] = '3px solid ' . $rgba;

				$css['global']['.oxo-header-wrapper']['margin-top']   = '3px';
				$css['global']['.admin-bar p.demo_store']['padding-top'] = '13px';

			}

			if ( ( ( 'Boxed' == Aione()->theme_options['layout'] && 'default' == get_post_meta( $c_pageID, 'pyre_page_bg_layout', true ) ) || 'boxed' == get_post_meta( $c_pageID, 'pyre_page_bg_layout', true ) ) && 'top' != Aione()->theme_options[ 'header_position' ] ) {
				$elements = array(
					'.side-header-right #slidingbar-area',
					'.side-header-left #slidingbar-area'
				);
				$css['global'][aione_implode( $elements )]['top'] = 'auto';
			}

		}

	}

	$elements = array(
		//'#main',
		'#wrapper',
		'.oxo-separator .icon-wrapper',
		'html',
		//'body',
		'#sliders-container',
		'#oxo-gmap-container'
	);
	if ( class_exists( 'bbPress' ) ) {
		$elements[] = '.bbp-arrow';
	}
	if ( class_exists( 'WooCommerce' ) ) {
		$elements[] = '.woocommerce-tabs > .tabs .active a';
	}
	$css['global'][aione_implode( $elements )]['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'content_bg_color' ], Aione()->settings->get_default( 'content_bg_color' ) );

	//$css['global']['.oxo-footer-widget-area']['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'footer_bg_color' ], Aione()->settings->get_default( 'footer_bg_color' ) );

	$css['global']['#wrapper .oxo-footer-widget-area .oxo-tabs-widget .tab-holder .tabs li']['border-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'footer_bg_color' ], Aione()->settings->get_default( 'footer_bg_color' ) );

	$css['global']['.oxo-footer-widget-area']['border-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'footer_border_color' ], Aione()->settings->get_default( 'footer_border_color' ) );

	//$css['global']['.oxo-footer-copyright-area']['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'copyright_bg_color' ], Aione()->settings->get_default( 'copyright_bg_color' ) );
	$css['global']['.oxo-footer-copyright-area']['border-color']     = Aione_Sanitize::color( Aione()->theme_options[ 'copyright_border_color' ], Aione()->settings->get_default( 'copyright_border_color' ) );

	$css['global']['.sep-boxed-pricing .panel-heading']['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'pricing_box_color' ], Aione()->settings->get_default( 'pricing_box_color' ) );
	$css['global']['.sep-boxed-pricing .panel-heading']['border-color']     = Aione_Sanitize::color( Aione()->theme_options[ 'pricing_box_color' ], Aione()->settings->get_default( 'pricing_box_color' ) );

	$elements = array(
		'.oxo-pricing-table .panel-body .price .integer-part',
		'.oxo-pricing-table .panel-body .price .decimal-part',
		'.full-boxed-pricing.oxo-pricing-table .standout .panel-heading h3'
	);
	$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'pricing_box_color' ], Aione()->settings->get_default( 'pricing_box_color' ) );

$image_rollover_opacity               = ( Aione()->theme_options[ 'image_gradient_top_color'] ) ? Aione()->theme_options[ 'image_gradient_top_color'] : 1;
	$image_rollover_gradient_top_color    = Aione()->theme_options[ 'image_gradient_top_color'];
	if( ! $image_rollover_gradient_top_color ) {
		$image_rollover_gradient_top_color = Aione()->settings->get_default( 'image_gradient_top_color' );
	}
	$image_rollover_gradient_bottom_color = Aione()->theme_options[ 'image_gradient_bottom_color' ];
	if( ! $image_rollover_gradient_bottom_color ) {
		$image_rollover_gradient_bottom_color = Aione()->settings->get_default( 'image_gradient_bottom_color' );
	}

	if ( '' != $image_rollover_gradient_top_color ) {
		$image_rollover_gradient_top       = oxo_hex2rgb( $image_rollover_gradient_top_color );
		$image_rollover_gradient_top_color = 'rgba(' . $image_rollover_gradient_top[0] . ',' . $image_rollover_gradient_top[1] . ',' . $image_rollover_gradient_top[2] . ',' . $image_rollover_opacity . ')';
	}

	if ( '' != $image_rollover_gradient_bottom_color ) {
		$image_rollover_gradient_bottom       = oxo_hex2rgb( $image_rollover_gradient_bottom_color );
		$image_rollover_gradient_bottom_color = 'rgba(' . $image_rollover_gradient_bottom[0] . ',' . $image_rollover_gradient_bottom[1] . ',' . $image_rollover_gradient_bottom[2] . ',' . $image_rollover_opacity . ')';
	}

	$css['global']['.oxo-image-wrapper .oxo-rollover']['background-image'][] = 'linear-gradient(top, ' . Aione_Sanitize::color( $image_rollover_gradient_top_color ) . ' 0%, ' . Aione_Sanitize::color( $image_rollover_gradient_bottom_color ) . ' 100%)';
	$css['global']['.oxo-image-wrapper .oxo-rollover']['background-image'][] = '-webkit-gradient(linear, left top, left bottom, color-stop(0, ' . Aione_Sanitize::color( $image_rollover_gradient_top_color ) . '), color-stop(1, ' . Aione_Sanitize::color( $image_rollover_gradient_bottom_color ) . '))';
	$css['global']['.oxo-image-wrapper .oxo-rollover']['background-image'][] = 'filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=' . Aione_Sanitize::color( Aione()->theme_options[ 'image_gradient_top_color'], Aione()->settings->get_default( 'image_gradient_top_color', 'color' ) ) . ', endColorstr=' .  Aione_Sanitize::color( Aione()->theme_options[ 'image_gradient_bottom_color' ], Aione()->settings->get_default( 'image_gradient_bottom_color' ) ) . '), progid: DXImageTransform.Microsoft.Alpha(Opacity=0)';

	$css['global']['.no-cssgradients .oxo-image-wrapper .oxo-rollover']['background'] =  Aione_Sanitize::color( Aione()->theme_options[ 'image_gradient_top_color'], Aione()->settings->get_default( 'image_gradient_top_color', 'color' ) );

	$css['global']['.oxo-image-wrapper:hover .oxo-rollover']['filter'] = 'progid:DXImageTransform.Microsoft.gradient(startColorstr=' . Aione_Sanitize::color( Aione()->theme_options[ 'image_gradient_top_color'], Aione()->settings->get_default( 'image_gradient_top_color', 'color' ) ) . ', endColorstr=' . Aione_Sanitize::color( Aione()->theme_options[ 'image_gradient_bottom_color' ], Aione()->settings->get_default( 'image_gradient_bottom_color' ) ) . '), progid: DXImageTransform.Microsoft.Alpha(Opacity=100)';

	$button_gradient_top_color          = ( ! Aione()->theme_options[ 'button_gradient_top_color' ] )          ? 'transparent' : Aione_Sanitize::color( Aione()->theme_options[ 'button_gradient_top_color' ] );
	$button_gradient_bottom_color       = ( ! Aione()->theme_options[ 'button_gradient_bottom_color' ] )       ? 'transparent' : Aione_Sanitize::color( Aione()->theme_options[ 'button_gradient_bottom_color' ] );
	$button_accent_color                = ( ! Aione()->theme_options[ 'button_accent_color' ] )                ? 'transparent' : Aione_Sanitize::color( Aione()->theme_options[ 'button_accent_color' ] );
	$button_gradient_top_hover_color    = ( ! Aione()->theme_options[ 'button_gradient_top_color_hover' ] )    ? 'transparent' : Aione_Sanitize::color( Aione()->theme_options[ 'button_gradient_top_color_hover' ] );
	$button_gradient_bottom_hover_color = ( ! Aione()->theme_options[ 'button_gradient_bottom_color_hover' ] ) ? 'transparent' : Aione_Sanitize::color( Aione()->theme_options[ 'button_gradient_bottom_color_hover' ] );
	$button_accent_hover_color          = ( ! Aione()->theme_options[ 'button_accent_hover_color' ] )          ? 'transparent' : Aione_Sanitize::color( Aione()->theme_options[ 'button_accent_hover_color' ] );

	$elements = array(
		'.oxo-portfolio-one .oxo-button',
		'#main .comment-submit',
		'#reviews input#submit',
		'.comment-form input[type="submit"]',
		'.button-default',
		'.oxo-button-default',
		'.button.default',
		'.post-password-form input[type="submit"]',
		'.ticket-selector-submit-btn[type=submit]'
	);
	if ( class_exists( 'GFForms' ) ) {
		$elements[] = '.gform_wrapper .gform_button';
		$elements[] = '.gform_wrapper .button';
		$elements[] = '.gform_page_footer input[type="button"]';
	}
	if ( defined( 'WPCF7_PLUGIN' ) ) {
		$elements[] = '.wpcf7-form input[type="submit"]';
		$elements[] = '.wpcf7-submit';
	}
	if ( class_exists( 'bbPress' ) ) {
		$elements[] = '.bbp-submit-wrapper .button';
		$elements[] = '#bbp_user_edit_submit';
	}
	if ( class_exists( 'WooCommerce' ) ) {
		$elements[] = '.price_slider_amount button';
		$elements[] = '.woocommerce .single_add_to_cart_button';
		$elements[] = '.woocommerce button.button';
		$elements[] = '.woocommerce .shipping-calculator-form .button';
		$elements[] = '.woocommerce .checkout #place_order';
		$elements[] = '.woocommerce .checkout_coupon .button';
		$elements[] = '.woocommerce .login .button';
		$elements[] = '.woocommerce .register .button';
		$elements[] = '.woocommerce .aione-order-details .order-again .button';
		$elements[] = '.woocommerce .aione-order-details .order-again .button';
		$elements[] = '.woocommerce .lost_reset_password input[type="submit"]';
	}
	if( class_exists( 'Tribe__Events__Main' ) ) {
		$elements[] = '#tribe-bar-form .tribe-bar-submit input[type=submit]';
		$elements[] = '#tribe-events .tribe-events-button';
		$elements[] = '#tribe_events_filter_control #tribe_events_filters_toggle';
		$elements[] = '#tribe_events_filter_control #tribe_events_filters_reset';
	}
	$css['global'][aione_implode( $elements )]['background']         = $button_gradient_top_color;
	$css['global'][aione_implode( $elements )]['color']              = $button_accent_color;
	if ( $button_gradient_top_color != $button_gradient_bottom_color ) {
		$css['global'][aione_implode( $elements )]['background-image'][] = '-webkit-gradient( linear, left bottom, left top, from( ' . $button_gradient_bottom_color . ' ), to( ' . $button_gradient_top_color . ' ) )';
		$css['global'][aione_implode( $elements )]['background-image'][] = 'linear-gradient( to top, ' . $button_gradient_bottom_color . ', ' . $button_gradient_top_color . ' )';
	}
	if ( Aione()->theme_options[ 'button_shape' ] != 'Pill' ) {
		$css['global'][aione_implode( $elements )]['filter']             = 'progid:DXImageTransform.Microsoft.gradient(startColorstr=' . $button_gradient_top_color . ', endColorstr=' . $button_gradient_bottom_color . ')';
	}
	$css['global'][aione_implode( $elements )]['transition']         = 'all .2s';

	$elements = array(
		'.no-cssgradients .oxo-portfolio-one .oxo-button',
		'.no-cssgradients #main .comment-submit',
		'.no-cssgradients #reviews input#submit',
		'.no-cssgradients .comment-form input[type="submit"]',
		'.no-cssgradients .button-default',
		'.no-cssgradients .oxo-button-default',
		'.no-cssgradients .button.default',
		'.no-cssgradients .post-password-form input[type="submit"]',
		'.no-cssgradients .ticket-selector-submit-btn[type="submit"]',
		'.link-type-button-bar .oxo-read-more'
	);
	if ( class_exists( 'GFForms' ) ) {
		$elements[] = '.no-cssgradients .gform_wrapper .gform_button';
		$elements[] = '.no-cssgradients .gform_wrapper .button';
		$elements[] = '.no-cssgradients .gform_page_footer input[type="button"]';
	}
	if ( defined( 'WPCF7_PLUGIN' ) ) {
		$elements[] = '.no-cssgradients .wpcf7-form input[type="submit"]';
		$elements[] = '.no-cssgradients .wpcf7-submit';
	}
	if ( class_exists( 'bbPress' ) ) {
		$elements[] = '.no-cssgradients .bbp-submit-wrapper .button';
		$elements[] = '.no-cssgradients #bbp_user_edit_submit';
	}
	if ( class_exists( 'WooCommerce' ) ) {
		$elements[] = '.no-cssgradients .price_slider_amount button';
		$elements[] = '.no-cssgradients .woocommerce .single_add_to_cart_button';
		$elements[] = '.no-cssgradients .woocommerce button.button';
		$elements[] = '.no-cssgradients .woocommerce .shipping-calculator-form .button';
		$elements[] = '.no-cssgradients .woocommerce .checkout #place_order';
		$elements[] = '.no-cssgradients .woocommerce .checkout_coupon .button';
		$elements[] = '.no-cssgradients .woocommerce .login .button';
		$elements[] = '.no-cssgradients .woocommerce .register .button';
		$elements[] = '.no-cssgradients .woocommerce .aione-order-details .order-again .button';
		$elements[] = '.no-cssgradients .woocommerce .lost_reset_password input[type="submit"]';
	}
	if( class_exists( 'Tribe__Events__Main' ) ) {
		$elements[] = '.no-cssgradients #tribe-bar-form .tribe-bar-submit input[type=submit]';
		$elements[] = '.no-cssgradients #tribe-events .tribe-events-button';
		$elements[] = '.no-cssgradients #tribe_events_filter_control #tribe_events_filters_toggle';
		$elements[] = '.no-cssgradients #tribe_events_filter_control #tribe_events_filters_reset';
	}
	$css['global'][aione_implode( $elements )]['background'] = $button_gradient_top_color;

	$elements = array(
		'.oxo-portfolio-one .oxo-button:hover',
		'#main .comment-submit:hover',
		'#reviews input#submit:hover',
		'.comment-form input[type="submit"]:hover',
		'.button-default:hover',
		'.oxo-button-default:hover',
		'.button.default:hover',
		'.post-password-form input[type="submit"]:hover',
		'.ticket-selector-submit-btn[type="submit"]:hover',
	);
	if ( class_exists( 'GFForms' ) ) {
		$elements[] = '.gform_wrapper .gform_button:hover';
		$elements[] = '.gform_wrapper .button:hover';
		$elements[] = '.gform_page_footer input[type="button"]:hover';
	}
	if ( defined( 'WPCF7_PLUGIN' ) ) {
		$elements[] = '.wpcf7-form input[type="submit"]:hover';
		$elements[] = '.wpcf7-submit:hover';
	}
	if ( class_exists( 'bbPress' ) ) {
		$elements[] = '.bbp-submit-wrapper .button:hover';
		$elements[] = '#bbp_user_edit_submit:hover';
	}
	if ( class_exists( 'WooCommerce' ) ) {
		$elements[] = '.price_slider_amount button:hover';
		$elements[] = '.woocommerce .single_add_to_cart_button:hover';
		$elements[] = '.woocommerce .shipping-calculator-form .button:hover';
		$elements[] = '.woocommerce .checkout #place_order:hover';
		$elements[] = '.woocommerce .checkout_coupon .button:hover';
		$elements[] = '.woocommerce .login .button:hover';
		$elements[] = '.woocommerce .register .button:hover';
		$elements[] = '.woocommerce .aione-order-details .order-again .button:hover';
		$elements[] = '.woocommerce .lost_reset_password input[type="submit"]:hover';
	}
	if( class_exists( 'Tribe__Events__Main' ) ) {
		$elements[] = '#tribe-bar-form .tribe-bar-submit input[type=submit]:hover';
		$elements[] = '#tribe-events .tribe-events-button:hover';
		$elements[] = '#tribe_events_filter_control #tribe_events_filters_toggle:hover';
		$elements[] = '#tribe_events_filter_control #tribe_events_filters_reset:hover';
	}
	$css['global'][aione_implode( $elements )]['background'] = $button_gradient_top_hover_color;
	$css['global'][aione_implode( $elements )]['color'] = $button_accent_hover_color;
	if ( $button_gradient_top_hover_color != $button_gradient_bottom_hover_color ) {
		$css['global'][aione_implode( $elements )]['background-image'][] = '-webkit-gradient( linear, left bottom, left top, from( ' . $button_gradient_bottom_hover_color . ' ), to( ' . $button_gradient_top_hover_color . ' ) )';
		$css['global'][aione_implode( $elements )]['background-image'][] = 'linear-gradient( to top, ' . $button_gradient_bottom_hover_color . ', ' . $button_gradient_top_hover_color . ' )';
	}
	if ( Aione()->theme_options[ 'button_shape' ] != 'Pill' ) {
		$css['global'][aione_implode( $elements )]['filter'] = 'progid:DXImageTransform.Microsoft.gradient(startColorstr=' . $button_gradient_top_hover_color . ', endColorstr=' . $button_gradient_bottom_hover_color . ')';
	}
	$elements = array(
		'.no-cssgradients .oxo-portfolio-one .oxo-button:hover',
		'.no-cssgradients #main .comment-submit:hover',
		'.no-cssgradients #reviews input#submit:hover',
		'.no-cssgradients .comment-form input[type="submit"]:hover',
		'.no-cssgradients .button-default:hover',
		'.no-cssgradients .oxo-button-default:hover',
		'.no-cssgradinets .button.default:hover',
		'.no-cssgradinets .post-password-form input[type="submit"]:hover',
		'.no-cssgradients .ticket-selector-submit-btn[type="submit"]:hover',
	);
	if ( class_exists( 'GFForms' ) ) {
		$elements[] = '.no-cssgradients .gform_wrapper .gform_button:hover';
		$elements[] = '.no-cssgradients .gform_wrapper .button:hover';
		$elements[] = '.no-cssgradients .gform_page_footer input[type="button"]:hover';
	}
	if ( defined( 'WPCF7_PLUGIN' ) ) {
		$elements[] = '.no-cssgradients .wpcf7-form input[type="submit"]:hover';
		$elements[] = '.no-cssgradients .wpcf7-submit:hover';
	}
	if ( class_exists( 'bbPress' ) ) {
		$elements[] = '.no-cssgradients .bbp-submit-wrapper .button:hover';
		$elements[] = '.no-cssgradients #bbp_user_edit_submit:hover';
	}
	if ( class_exists( 'WooCommerce' ) ) {
		$elements[] = '.no-cssgradients .price_slider_amount button:hover';
		$elements[] = '.no-cssgradients .woocommerce .single_add_to_cart_button:hover';
		$elements[] = '.no-cssgradients .woocommerce .shipping-calculator-form .button:hover';
		$elements[] = '.no-cssgradients .woocommerce .checkout #place_order:hover';
		$elements[] = '.no-cssgradients .woocommerce .checkout_coupon .button:hover';
		$elements[] = '.no-cssgradients .woocommerce .login .button:hover';
		$elements[] = '.no-cssgradients .woocommerce .register .button:hover';
		$elements[] = '.no-cssgradients .woocommerce .aione-order-details .order-again .button:hover';
		$elements[] = '.no-cssgradients .woocommerce .lost_reset_password input[type="submit"]:hover';
	}
	if( class_exists( 'Tribe__Events__Main' ) ) {
		$elements[] = '.no-cssgradients #tribe-bar-form .tribe-bar-submit input[type=submit]:hover';
		$elements[] = '.no-cssgradients #tribe-events .tribe-events-button:hover';
		$elements[] = '.no-cssgradients #tribe_events_filter_control #tribe_events_filters_toggle:hover';
		$elements[] = '.no-cssgradients #tribe_events_filter_control #tribe_events_filters_reset:hover';
	}
	$css['global'][aione_implode( $elements )]['background'] = $button_gradient_top_hover_color . ' !important';

	$elements = array(
		'.link-type-button-bar .oxo-read-more',
		'.link-type-button-bar .oxo-read-more:after',
		'.link-type-button-bar .oxo-read-more:before'
	);

	$css['global'][aione_implode( $elements )]['color'] = $button_accent_color;

	$elements = array(
		'.link-type-button-bar .oxo-read-more:hover',
		'.link-type-button-bar .oxo-read-more:hover:after',
		'.link-type-button-bar .oxo-read-more:hover:before',
		'.link-type-button-bar.link-area-box:hover .oxo-read-more',
		'.link-type-button-bar.link-area-box:hover .oxo-read-more:after',
		'.link-type-button-bar.link-area-box:hover .oxo-read-more:before'
	);

	$css['global'][aione_implode( $elements )]['color'] = $button_accent_color . ' !important';

	$elements = array(
		'.oxo-image-wrapper .oxo-rollover .oxo-rollover-link',
		'.oxo-image-wrapper .oxo-rollover .oxo-rollover-gallery'
	);
	$css['global'][aione_implode( $elements )]['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'image_rollover_text_color' ], Aione()->settings->get_default( 'image_rollover_text_color' ) );

	$elements = array(
		'.oxo-rollover .oxo-rollover-content .oxo-rollover-title',
		'.oxo-image-wrapper .oxo-rollover .oxo-rollover-content .oxo-rollover-title a',
		'.oxo-image-wrapper .oxo-rollover .oxo-rollover-content .oxo-rollover-categories',
		'.oxo-image-wrapper .oxo-rollover .oxo-rollover-content .oxo-rollover-categories a',
		'.oxo-image-wrapper .oxo-rollover .oxo-rollover-content a',
		'.oxo-image-wrapper .oxo-rollover .oxo-rollover-content .price *',
		'.oxo-image-wrapper .oxo-rollover .oxo-rollover-content .oxo-product-buttons a:before',
	);
	$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'image_rollover_text_color' ], Aione()->settings->get_default( 'image_rollover_text_color' ) );

	$css['global']['.oxo-page-title-bar']['border-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'page_title_border_color' ], Aione()->settings->get_default( 'page_title_border_color' ) );

	if ( 'transparent' == Aione()->theme_options[ 'page_title_border_color' ] ) {
		$css['global']['.oxo-page-title-bar']['border'] = 'none';
	}

	/*
	if ( Aione()->theme_options[ 'footerw_bg_image' ] ) {

		$css['global']['.oxo-footer-widget-area']['background-image']    = 'url("' . Aione_Sanitize::css_asset_url( Aione()->theme_options[ 'footerw_bg_image' ] ) . '")';
		$css['global']['.oxo-footer-widget-area']['background-repeat']   = esc_attr( Aione()->theme_options[ 'footerw_bg_repeat' ] );
		$css['global']['.oxo-footer-widget-area']['background-position'] = esc_attr( Aione()->theme_options[ 'footerw_bg_pos' ] );

		if ( Aione()->theme_options[ 'footerw_bg_full' ] ) {

			$css['global']['.oxo-footer-widget-area']['background-attachment'] = 'scroll';
			$css['global']['.oxo-footer-widget-area']['background-position']   = 'center center';
			$css['global']['.oxo-footer-widget-area']['background-size']       = 'cover';

		}

	}
	*/

	if ( in_array( Aione()->theme_options[ 'footer_special_effects' ], array( 'footer_area_bg_parallax', 'footer_sticky_with_parallax_bg_image'  ) ) ) {
		$css['global']['.oxo-footer-widget-area']['background-attachment'] = 'fixed';
		$css['global']['.oxo-footer-widget-area']['background-position']   = 'top center';
	}

	if ( Aione()->theme_options[ 'footer_special_effects' ] == 'footer_parallax_effect' ) {
		$elements = array(
			'#sliders-container',
			'#oxo-gmap-container',
			'.oxo-page-title-bar',
			'#main'
		);

		$css['global'][aione_implode( $elements )]['position']  = 'relative';
		$css['global'][aione_implode( $elements )]['z-index']   = '1';
	}

	if ( Aione()->theme_options[ 'footer_sticky_height' ] && ( in_array( Aione()->theme_options[ 'footer_special_effects' ], array( 'footer_sticky', 'footer_sticky_with_parallax_bg_image' ) ) ) ) {
		$elements = array( 'html', 'body', '#boxed-wrapper', '#wrapper' );
		$css['global'][aione_implode( $elements )]['height']     = '100%';
		$css['global']['.above-footer-wrapper']['min-height']    = '100%';
		$css['global']['.above-footer-wrapper']['margin-bottom'] = (int) Aione()->theme_options[ 'footer_sticky_height' ] * ( -1 ) . 'px';
		$css['global']['.above-footer-wrapper:after']['content'] = '""';
		$css['global']['.above-footer-wrapper:after']['display'] = 'block';
		$css['global']['.above-footer-wrapper:after']['height']  = Aione_Sanitize::size( Aione()->theme_options[ 'footer_sticky_height' ] );
		//$css['global']['.oxo-footer']['height']               = Aione_Sanitize::size( Aione()->theme_options[ 'footer_sticky_height' ] );

	}


	$css['global']['.oxo-footer-widget-area']['padding-top']    = Aione_Sanitize::size( Aione()->theme_options[ 'footer_area_top_padding' ] );
	$css['global']['.oxo-footer-widget-area']['padding-bottom'] = Aione_Sanitize::size( Aione()->theme_options[ 'footer_area_bottom_padding' ] );

	$elements = array(
		'.oxo-footer-widget-area > .oxo-row',
		'.oxo-footer-copyright-area > .oxo-row'
	);
	$css['global'][aione_implode( $elements )]['padding-left']  = Aione_Sanitize::size( Aione()->theme_options[ 'footer_area_left_padding' ] );
	$css['global'][aione_implode( $elements )]['padding-right'] = Aione_Sanitize::size( Aione()->theme_options[ 'footer_area_right_padding' ] );

	if ( Aione()->theme_options[ 'footer_100_width' ] ) {
		$elements = array(
			'.layout-wide-mode .oxo-footer-widget-area > .oxo-row',
			'.layout-wide-mode .oxo-footer-copyright-area > .oxo-row',
		);
		$css['global'][aione_implode( $elements )]['max-width'] = '100% !important';
	}
	
	$elements = array(
		'.pagebottom_content',
	);
	$css['global'][aione_implode( $elements )]['max-width'] = $site_width_with_units;
	$css['global'][aione_implode( $elements )]['margin'] = '0 auto';
	$css['global'][aione_implode( $elements )]['border-top'] = '1px solid #d7d7d7';
	
	
	if ( Aione()->theme_content[ 'pagebottom_content_100_width' ] ) {
		$elements = array(
			'.pagebottom_content',
		);
		$css['global'][aione_implode( $elements )]['max-width'] = '100% !important';
	}
	
	$elements = array(
		'.pagetop-content',
	);
	$css['global'][aione_implode( $elements )]['max-width'] = $site_width_with_units;
	$css['global'][aione_implode( $elements )]['margin'] = '0 auto';
	
	
	if ( Aione()->theme_content[ 'pagetop_content_100_width' ] ) {
		$elements = array(
			'.pagetop-content',
		);
		$css['global'][aione_implode( $elements )]['max-width'] = '100% !important';
	}
	
	$elements = array(
		'.page-content-above',
	);
	$css['global'][aione_implode( $elements )]['border-bottom'] = '1px solid #666';
	
	$elements = array(
		'.page-content-below',
	);
	$css['global'][aione_implode( $elements )]['border-top'] = '1px solid #666';
	
	$elements = array(
		'.sidebar1-top-content',
	);
	$css['global'][aione_implode( $elements )]['border-bottom'] = '1px solid #666';
	$css['global'][aione_implode( $elements )]['margin-bottom'] = '15px';
	
	$elements = array(
		'.sidebar2-top-content',
	);
	$css['global'][aione_implode( $elements )]['border-bottom'] = '1px solid #666';
	$css['global'][aione_implode( $elements )]['margin-bottom'] = '15px';
	

	$css['global']['.oxo-footer-copyright-area']['padding-top']    = Aione_Sanitize::size( Aione()->theme_options[ 'copyright_top_padding' ] );
	$css['global']['.oxo-footer-copyright-area']['padding-bottom'] = Aione_Sanitize::size( Aione()->theme_options[ 'copyright_bottom_padding' ] );

	if ( strpos( Aione()->theme_options[ 'footer_special_effects' ], 'footer_sticky' ) !== FALSE || strpos( Aione()->theme_options[ 'footer_special_effects' ], 'footer_sticky_with_parallax_bg_image' ) !== FALSE ) {
			$elements = array(
				'.oxo-footer',
			);
		$css['global'][aione_implode( $elements )]['position'] = 'fixed';
        $css['global'][aione_implode( $elements )]['bottom'] = '0';
        $css['global'][aione_implode( $elements )]['width'] = '100%';			
	}
	
	
	$css['global']['.fontawesome-icon.circle-yes']['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'icon_circle_color' ], Aione()->settings->get_default( 'icon_circle_color' ) );
	$elements = array(
		'.fontawesome-icon.circle-yes',
		'.content-box-shortcode-timeline'
	);
	$css['global'][aione_implode( $elements )]['border-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'icon_border_color' ], Aione()->settings->get_default( 'icon_border_color' ) );

	$elements = array(
		'.fontawesome-icon',
		'.fontawesome-icon.circle-yes',
		'.post-content .error-menu li:before',
		'.post-content .error-menu li:after',
	);
	if ( class_exists( 'WooCommerce' ) ) {
		$elements[] = '.aione-myaccount-data .digital-downloads li:before';
		$elements[] = '.aione-myaccount-data .digital-downloads li:after';
		$elements[] = '.aione-thank-you .order_details li:before';
		$elements[] = '.aione-thank-you .order_details li:after';
	}
	$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'icon_color' ], Aione()->settings->get_default( 'icon_color' ) );

	$elements = array(
		'.oxo-title .title-sep',
		'.oxo-title.sep-underline',
		'.product .product-border'
	);
	$css['global'][aione_implode( $elements )]['border-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'title_border_color' ], Aione()->settings->get_default( 'title_border_color' ) );

	if ( class_exists( 'Tribe__Events__Main') ) {
		$css['global']['.tribe-events-single .related-posts .oxo-title .title-sep']['border-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'ec_border_color' ], Aione()->settings->get_default( 'ec_border_color' ) );
	}
	

	$elements = array( '.review blockquote q', '.post-content blockquote', '.checkout .payment_methods .payment_box' );
	$css['global'][aione_implode( $elements )]['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'testimonial_bg_color' ], Aione()->settings->get_default( 'testimonial_bg_color' ) );

	$css['global']['.oxo-testimonials .author:after']['border-top-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'testimonial_bg_color' ], Aione()->settings->get_default( 'testimonial_bg_color' ) );

	$elements = array( '.review blockquote q', '.post-content blockquote' );
	$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'testimonial_text_color' ], Aione()->settings->get_default( 'testimonial_text_color' ) );

	$is_custom_font = ( null !== Aione()->theme_options[ 'custom_font_woff' ] && Aione()->theme_options[ 'custom_font_woff' ] ) &&
							( null !== Aione()->theme_options[ 'custom_font_ttf' ] && Aione()->theme_options[ 'custom_font_ttf' ] ) &&
							( null !== Aione()->theme_options[ 'custom_font_svg' ] && Aione()->theme_options[ 'custom_font_svg' ] ) &&
							( null !== Aione()->theme_options[ 'custom_font_eot' ] && Aione()->theme_options[ 'custom_font_eot' ] );

	if ( $is_custom_font ) {
		$css['global']['@font-face']['font-family'] = 'MuseoSlab500Regular';
		$css['global']['@font-face']['src'][]       = 'url("' . Aione_Sanitize::css_asset_url( Aione()->theme_options[ 'custom_font_eot' ] ) . '")';
		$css['global']['@font-face']['src'][]       = 'url("' . Aione_Sanitize::css_asset_url( Aione()->theme_options[ 'custom_font_eot' ] ) . '?#iefix") format("eot"), url("' . Aione_Sanitize::css_asset_url( Aione()->theme_options[ 'custom_font_woff' ] ) . '") format("woff"), url("' . Aione_Sanitize::css_asset_url( Aione()->theme_options[ 'custom_font_ttf' ] ) . '") format("truetype"), url("' . Aione_Sanitize::css_asset_url( Aione()->theme_options[ 'custom_font_svg' ] ). '#MuseoSlab500Regular") format("svg")';
		$css['global']['@font-face']['font-weight'] = '400';
		$css['global']['@font-face']['font-style']  = 'normal';
	}

	$font = '';
	$nav_font = '';
	$footer_headings_font = '';
	$button_font = '';
	
	$aione_font_option = Aione()->theme_options[ 'typography_body' ];

	if ( 'None' != Aione()->theme_options[ 'google_body' ] ) {
		$font = "'" . Aione()->theme_options[ 'google_body' ] . "', Arial, Helvetica, sans-serif";
	} elseif ( 'Select Font' != $aione_font_option['font-family'] ) {
		$font = $aione_font_option['font-family'];
	}

	$elements = array(
		'body',
		'#nav ul li ul li a',
		'#sticky-nav ul li ul li a',
		'.more',
		'.aione-container h3',
		'.meta .oxo-date',
		'.review blockquote q',
		'.review blockquote div strong',
		'.project-content .project-info h4',
		'.post-content blockquote',
		'.oxo-load-more-button',
		'.ei-title h3',
		'.comment-form input[type="submit"]',
		'.oxo-page-title-bar h3',
		'.oxo-blog-shortcode .oxo-timeline-date',
		'.oxo-image-wrapper .oxo-rollover .oxo-rollover-content .oxo-rollover-title',
		'.oxo-image-wrapper .oxo-rollover .oxo-rollover-content .oxo-rollover-categories',
		'.oxo-image-wrapper .oxo-rollover .oxo-rollover-content a',
		'.oxo-image-wrapper .oxo-rollover .oxo-rollover-content .price',
		'#wrapper #nav ul li ul li > a',
		'#wrapper #sticky-nav ul li ul li > a',
		'.ticket-selector-submit-btn[type="submit"]',
	);
	if ( class_exists( 'GFForms' ) ) {
		$elements[] = '.gform_wrapper .gform_button';
		$elements[] = '.gform_wrapper .button';
		$elements[] = '.gform_page_footer input[type="button"]';
	}
	if ( defined( 'WPCF7_PLUGIN' ) ) {
		$elements[] = '.wpcf7-form input[type="submit"]';
	}
	if ( class_exists( 'bbPress' ) ) {
		$elements[] = '#bbp_user_edit_submit';
		$elements[] = '.bbp-search-results .bbp-forum-title h3';
		$elements[] = '.bbp-search-results .bbp-topic-title h3';
	}
	if ( class_exists( 'WooCommerce' ) ) {
		$elements[] = '.woocommerce-success-message .button';
		$elements[] = '.woocommerce .single_add_to_cart_button';
		$elements[] = '.woocommerce button.button';
		$elements[] = '.woocommerce .shipping-calculator-form .button';
		$elements[] = '.woocommerce .checkout #place_order';
		$elements[] = '.woocommerce .checkout_coupon .button';
		$elements[] = '.woocommerce .login .button';
		$elements[] = '.woocommerce .register .button';
		$elements[] = '.widget.woocommerce .product-title';
	}
	if( class_exists( 'Tribe__Events__Main') ) {
		$elements[] = '#tribe-bar-form label';
		$elements[] = '.tribe-bar-disabled #tribe-bar-form label';
		$elements[] = '.tribe-events-tooltip p.entry-summary';
		$elements[] = '.tribe-events-tooltip .tribe-events-event-body';
		$elements[] = '#tribe_events_filter_control a';
		$elements[] = '#tribe_events_filters_wrapper .tribe-events-filters-label';
		$elements[] = '#tribe_events_filters_wrapper .tribe-events-filters-group-heading';
		$elements[] = '#tribe_events_filters_wrapper .tribe-events-filters-content > label';
	}
	$css['global'][aione_implode( $elements )]['font-family'] = $font;
	$css['global'][aione_implode( $elements )]['font-weight'] = esc_attr( Aione()->theme_options[ 'font_weight_body' ] );

	if ( 'None' != Aione()->theme_options[ 'google_nav' ] ) {
		$nav_font = "'" . Aione()->theme_options[ 'google_nav' ] . "', Arial, Helvetica, sans-serif";
	} elseif ( 'Select Font' != Aione()->theme_options[ 'standard_nav' ] ) {
		$nav_font = Aione()->theme_options[ 'standard_nav' ];
	}

	if ( $is_custom_font ) {
		$nav_font =  '\'MuseoSlab500Regular\', Arial, Helvetica, sans-serif';
	}

	$elements = array(
		'.aione-container h3',
		'.review blockquote div strong',
		'.oxo-footer-widget-area h3',
		'.oxo-footer-widget-area .widget-title',
		'#slidingbar-area h3',
		'.project-content .project-info h4',
		'.oxo-load-more-button',
		'.comment-form input[type="submit"]',
		'.ticket-selector-submit-btn[type="submit"]',
	);
	if ( class_exists( 'GFForms' ) ) {
		$elements[] = '.gform_wrapper .gform_button';
		$elements[] = '.gform_wrapper .button';
		$elements[] = '.gform_page_footer input[type="button"]';
	}
	if ( defined( 'WPCF7_PLUGIN' ) ) {
		$elements[] = '.wpcf7-form input[type="submit"]';
	}
	if ( class_exists( 'bbPress' ) ) {
		$elements[] = '#bbp_user_edit_submit';
	}
	if ( class_exists( 'WooCommerce' ) ) {
		$elements[] = '.woocommerce .single_add_to_cart_button';
		$elements[] = '.woocommerce button.button';
		$elements[] = '.woocommerce .shipping-calculator-form .button';
		$elements[] = '.woocommerce .checkout #place_order';
		$elements[] = '.woocommerce .checkout_coupon .button';
		$elements[] = '.woocommerce .login .button';
		$elements[] = '.woocommerce .register .button';
		$elements[] = '.woocommerce .aione-order-details .order-again .button';
	}
	if( class_exists( 'Tribe__Events__Main' ) ) {
		$elements[] = '#tribe-bar-form .tribe-bar-submit input[type=submit]';
		$elements[] = '#tribe-events .tribe-events-button';
		$elements[] = '#tribe_events_filter_control #tribe_events_filters_toggle';
		$elements[] = '#tribe_events_filter_control #tribe_events_filters_reset';
	}
	$css['global'][aione_implode( $elements )]['font-weight'] = 'bold';

	$elements = array(
		'.meta .oxo-date',
		'.review blockquote q',
		'.post-content blockquote',
	);
	$css['global'][aione_implode( $elements )]['font-style'] = 'italic';

	$css['global']['.side-nav li a']['font-family'] = $nav_font;
	$css['global']['.side-nav li a']['font-weight'] = esc_attr( Aione()->theme_options[ 'font_weight_menu' ] );

	if ( ! $is_custom_font && 'None' != Aione()->theme_options[ 'google_headings' ] ) {
		$headings_font = "'" . Aione()->theme_options[ 'google_headings' ] . "', Arial, Helvetica, sans-serif";
	} elseif ( ! $is_custom_font && 'Select Font' != Aione()->theme_options[ 'standard_headings' ] ) {
		$headings_font = Aione()->theme_options[ 'standard_headings' ];
	} else {
		$headings_font = false;
	}

	if ( $headings_font ) {

		$elements = array(
			'#main .reading-box h2',
			'#main h2',
			'.oxo-header-tagline',
			'.oxo-page-title-bar h1',
			'.oxo-image-wrapper .oxo-rollover .oxo-rollover-content .oxo-rollover-title',
			'.oxo-image-wrapper .oxo-rollover .oxo-rollover-content .oxo-rollover-title a',
			'#main .post h2',
			'.oxo-content-widget-area .widget h4',
			'#wrapper .oxo-tabs-widget .tab-holder .tabs li a',
			'.share-box h4',
			'.project-content h3',
			'.oxo-author .oxo-author-title',
			'.oxo-pricing-table .title-row',
			'.oxo-pricing-table .pricing-row',
			'.oxo-person .person-desc .person-author .person-author-wrapper',
			'.oxo-accordian .panel-title',
			'.oxo-accordian .panel-heading a',
			'.oxo-tabs .nav-tabs  li .oxo-tab-heading',
			'.oxo-carousel-title',
			'.post-content h1',
			'.post-content h2',
			'.post-content h3',
			'.post-content h4',
			'.post-content h5',
			'.post-content h6',
			'.ei-title h2',
			'table th',
			'.main-flex .slide-content h2',
			'.main-flex .slide-content h3',
			'.oxo-modal .modal-title',
			'.popover .popover-title',
			'.oxo-flip-box .flip-box-heading-back',
			'.oxo-header-tagline',
			'.oxo-title h3',
			'.oxo-countdown-heading',
			'.oxo-countdown-subheading',
		);
		if ( class_exists( 'WooCommerce' ) ) {
			$elements[] = '.woocommerce-success-message .msg';
			$elements[] = '.product-title';
			$elements[] = '.cart-empty';
			$elements[] = '.woocommerce-tabs h2';
			$elements[] = '.single-product .woocommerce-tabs h3';
		}
		if( class_exists( 'Tribe__Events__Main' ) ) {
			$elements[] = '.sidebar .tribe-events-single-section-title';
		}
		$css['global'][aione_implode( $elements )]['font-family'] = $headings_font;

		$css['global']['.project-content .project-info h4']['font-family'] = $headings_font;

	}

	$elements = array(
		'#main .reading-box h2',
		'#main h2',
		'.oxo-header-tagline',
		'.oxo-page-title-bar h1',
		'.oxo-image-wrapper .oxo-rollover .oxo-rollover-content .oxo-rollover-title',
		'.oxo-image-wrapper .oxo-rollover .oxo-rollover-content .oxo-rollover-title a',
		'#main .post h2',
		'.oxo-content-widget-area .widget h4',
		'#wrapper .oxo-tabs-widget .tab-holder .tabs li a',
		'.share-box h4',
		'.project-content h3',
		'.oxo-author .oxo-author-title',
		'.oxo-pricing-table .title-row',
		'.oxo-pricing-table .pricing-row',
		'.oxo-person .person-desc .person-author .person-author-wrapper',
		'.oxo-accordian .panel-title',
		'.oxo-accordian .panel-heading a',
		'.oxo-tabs .nav-tabs  li .oxo-tab-heading',
		'.oxo-carousel-title',
		'.post-content h1',
		'.post-content h2',
		'.post-content h3',
		'.post-content h4',
		'.post-content h5',
		'.post-content h6',
		'.ei-title h2',
		'table th',
		'.main-flex .slide-content h2',
		'.main-flex .slide-content h3',
		'.oxo-modal .modal-title',
		'.popover .popover-title',
		'.oxo-flip-box .flip-box-heading-back',
		'.oxo-header-tagline',
		'.oxo-title h3',
	);
	if ( class_exists( 'WooCommerce' ) ) {
		$elements[] = '.woocommerce-success-message .msg';
		$elements[] = '.product-title';
		$elements[] = '.cart-empty';
		$elements[] = '.single-product .woocommerce-tabs h3';
	}
	if( class_exists( 'Tribe__Events__Main' ) ) {
		$elements[] = '.sidebar .tribe-events-single-section-title';
		$elements[] = '#tribe_events_filters_wrapper .tribe-events-filters-label';
	}
	$css['global'][aione_implode( $elements )]['font-weight'] = esc_attr( Aione()->theme_options[ 'font_weight_headings' ] );

	if ( 'None' != Aione()->theme_options[ 'google_footer_headings' ] ) {
		$footer_headings_font = "'" . Aione()->theme_options[ 'google_footer_headings' ] . "', Arial, Helvetica, sans-serif";
	} elseif ( 'Select Font' != Aione()->theme_options[ 'standard_footer_headings' ] ) {
		$footer_headings_font = Aione()->theme_options[ 'standard_footer_headings' ];
	}

	$elements = array( '.oxo-footer-widget-area h3', '.oxo-footer-widget-area .widget-title', '#slidingbar-area h3', '#slidingbar-area .widget-title' );
	$css['global'][aione_implode( $elements )]['font-family'] = $footer_headings_font;
	$css['global'][aione_implode( $elements )]['font-weight'] = esc_attr( Aione()->theme_options[ 'font_weight_footer_headings' ] );
	
	$aione_font_option = Aione()->theme_options[ 'typography_body' ];
	
	if ( $aione_font_option['font-size'] ) {

		$elements = array(
			'body',
			'.oxo-widget-area .slide-excerpt h2',
			'.jtwt .jtwt_tweet',
			'.oxo-content-widget-area .jtwt .jtwt_tweet'
		);

		if ( class_exists( 'bbPress' ) ) {
			$elements[] = '#bbpress-forums li.bbp-body ul.forum';
			$elements[] = '#bbpress-forums li.bbp-body ul.topic';
			$elements[] = '#bbpress-forums div.bbp-topic-author';
			$elements[] = '#bbpress-forums div.bbp-reply-author';
			$elements[] = '#bbpress-forums div.bbp-author-role';
			$elements[] = '#bbpress-forums div.bbp-reply-entry';
			$elements[] = '#bbpress-forums .bbp-user-section';
		}

		$css['global'][aione_implode( $elements )]['font-size']   = intval( $aione_font_option['font-size'] ) . 'px';
		$css['global'][aione_implode( $elements )]['line-height'] = round( $aione_font_option['font-size'] * 1.5 ) . 'px';

		$elements = array(
			'.project-content .project-info h4',
			'.oxo-footer-widget-area ul',
			'#slidingbar-area ul',
			'.oxo-tabs-widget .tab-holder .news-list li .post-holder a',
			'.oxo-tabs-widget .tab-holder .news-list li .post-holder .meta'
		);
		if ( class_exists( 'GFForms' ) ) {
			$elements[] = '.gform_wrapper label';
			$elements[] = '.gform_wrapper .gfield_description';
		}
		if( class_exists( 'Tribe__Events__Main') ) {
			$elements[] = '#tribe-bar-form label';
			$elements[] = '.tribe-bar-disabled #tribe-bar-form label';
			$elements[] = '.tribe-events-tooltip .duration';
			$elements[] = '.tribe-events-tooltip p.entry-summary';
			$elements[] = '.tribe-events-tooltip .tribe-event-duration';
			$elements[] = '.tribe-events-tooltip .tribe-events-event-body';
			$elements[] = '#tribe_events_filters_wrapper .tribe-events-filters-label';
		}
		$css['global'][aione_implode( $elements )]['font-size']   = intval( $aione_font_option['font-size'] ) . 'px';
		$css['global'][aione_implode( $elements )]['line-height'] = round( $aione_font_option['font-size'] * 1.5 ) . 'px';

		$elements = array(
			'.counter-box-content',
			'.oxo-alert',
			'.oxo-progressbar .sr-only',
			'.post-content blockquote',
			'.review blockquote q',
			'.oxo-blog-layout-timeline .oxo-timeline-date',
		);

		if ( class_exists( 'WooCommerce' ) ) {
			$elements[] = '.widget.woocommerce .product-title';
		}

		if( class_exists( 'Tribe__Events__Main') ) {
			$elements[] = '#tribe_events_filter_control a';
			$elements[] = '#tribe_events_filters_wrapper .tribe-events-filters-group-heading';
			$elements[] = '#tribe_events_filters_wrapper .tribe-events-filters-content > label';
		}
		$css['global'][aione_implode( $elements )]['font-size'] = intval( $aione_font_option['font-size'] ) . 'px';

	}
	
	$aione_font_option = Aione()->theme_options[ 'typography_body' ];

	if ( $aione_font_option['line-height'] ) {
		$elements = array(
			'body',
			'.oxo-widget-area .slide-excerpt h2',
			'.post-content blockquote',
			'.review blockquote q',
			'.project-content .project-info h4',
			'.oxo-accordian .panel-body',
			'#side-header .oxo-contact-info',
			'#side-header .header-social .top-menu'
		);

		if ( class_exists( 'WooCommerce' ) ) {
			$elements[] = '.widget.woocommerce .product-title';
		}

		if( class_exists( 'Tribe__Events__Main') ) {
			$elements[] = '#tribe-bar-form label';
			$elements[] = '.tribe-bar-disabled #tribe-bar-form label';
			$elements[] = '.tribe-events-tooltip .duration';
			$elements[] = '.tribe-events-tooltip p.entry-summary';
			$elements[] = '.tribe-events-tooltip .tribe-event-duration';
			$elements[] = '.tribe-events-tooltip .tribe-events-event-body';
		}
		$css['global'][aione_implode( $elements )]['line-height'] = intval( $aione_font_option['line-height'] ) . 'px';
	}

	if ( Aione()->theme_options[ 'breadcrumbs_font_size' ] ) {
		$elements = array(
			'.oxo-page-title-bar .oxo-breadcrumbs',
			'.oxo-page-title-bar .oxo-breadcrumbs li',
			'.oxo-page-title-bar .oxo-breadcrumbs li a'
		);
		$css['global'][aione_implode( $elements )]['font-size'] = intval( Aione()->theme_options[ 'breadcrumbs_font_size' ] ) . 'px';
	}

	if ( Aione()->theme_options[ 'side_nav_font_size' ] ) {
		$css['global']['.side-nav li a']['font-size'] = intval( Aione()->theme_options[ 'side_nav_font_size' ] ) . 'px';
	}

	if ( Aione()->theme_options[ 'sidew_font_size' ] ) {
		$elements = array(
			'.sidebar .widget h4'
		);
		$css['global'][aione_implode( $elements )]['font-size'] = intval( Aione()->theme_options[ 'sidew_font_size' ] ) . 'px';
	}

	if ( class_exists( 'Tribe__Events__Main' ) ) {
		if ( Aione()->theme_options[ 'ec_sidew_font_size' ] ) {
			$elements = array(
				'.single-tribe_events .sidebar .widget h4'
			);
			$elements[] = '.single-tribe_events .sidebar .tribe-events-single-section-title';
			$css['global'][aione_implode( $elements )]['font-size'] = intval( Aione()->theme_options[ 'ec_sidew_font_size' ] ) . 'px';
		}

		if ( Aione()->theme_options[ 'ec_text_font_size' ] ) {
			$elements = array(
				'.single-tribe_events .sidebar',
				'.single-tribe_events .tribe-events-event-meta'
			);
			$css['global'][aione_implode( $elements )]['font-size'] = intval( Aione()->theme_options[ 'ec_text_font_size' ] ) . 'px';
		}
	}
	if ( Aione()->theme_options[ 'slidingbar_font_size' ] ) {
		$elements = array(
			'#slidingbar-area h3',
			'#slidingbar-area .widget-title'
		);
		$css['global'][aione_implode( $elements )]['font-size']   = intval( Aione()->theme_options[ 'slidingbar_font_size' ] ) . 'px';
		$css['global'][aione_implode( $elements )]['line-height'] = intval( Aione()->theme_options[ 'slidingbar_font_size' ] ) . 'px';
	}
	
	$footer_aione_font_size = Aione()->theme_options['typography_footer_title'];

	if ( $footer_aione_font_size['font-size'] ) {
		$elements = array(
			'.oxo-footer-widget-area h3',
			'.oxo-footer-widget-area .widget-title'
		);
		$css['global'][aione_implode( $elements )]['font-size']   = intval( $footer_aione_font_size['font-size'] ) . 'px';
	}
	if ( $footer_aione_font_size['line-height'] ) {
		$elements = array(
			'.oxo-footer-widget-area h3',
			'.oxo-footer-widget-area .widget-title'
		);
		$css['global'][aione_implode( $elements )]['line-height'] = intval( $footer_aione_font_size['line-height'] ) . 'px';
	}
	
	if ( $footer_aione_font_size['font-family'] ) {
		$elements = array(
			'.oxo-footer-widget-area h3',
			'.oxo-footer-widget-area .widget-title'
		);
		$css['global'][aione_implode( $elements )]['font-family']   = $footer_aione_font_size['font-family'];
	}
	
	$copyright_aione_font_size = Aione()->theme_options['typography_copyright_title'];

	if ( $copyright_aione_font_size['font-size'] ) {
		$css['global']['.oxo-copyright-notice']['font-size'] = intval( $copyright_aione_font_size['font-size'] ) . 'px';
	}
	if ( $copyright_aione_font_size['line-height'] ) {
		$css['global']['.oxo-copyright-notice']['line-height'] = intval( $copyright_aione_font_size['line-height'] ) . 'px';
	}
	if ( $copyright_aione_font_size['font-family'] ) {
		$css['global']['.oxo-copyright-notice']['font-family'] = $copyright_aione_font_size['font-family'];
	}

	$elements = array(
		'#main .oxo-row',
		'.oxo-footer-widget-area .oxo-row',
		'#slidingbar-area .oxo-row',
		'.oxo-footer-copyright-area .oxo-row',
		'.oxo-page-title-row',
		'.tfs-slider .slide-content-container .slide-content'
	);
	$css['global'][aione_implode( $elements )]['max-width'] = $site_width_with_units;

	if ( ! Aione()->theme_options[ 'responsive' ] ) {

		if ( 'top' == Aione()->theme_options[ 'header_position' ] ) {
			$elements = array( 'html', 'body' );
			$css['global'][aione_implode( $elements )]['overflow-x'] = 'hidden';
		} else {
			$css['global']['.ua-mobile #wrapper']['width'] = 'auto !important';
		}

		$media_query = '@media screen and (max-width: ' . intval( Aione()->theme_options[ 'side_header_break_point' ] ) . 'px)';
		$css[$media_query]['.fullwidth-box']['background-attachment'] = 'scroll !important';
		$css[$media_query]['.no-mobile-totop .to-top-container']['display'] = 'none';
		$css[$media_query]['.no-mobile-slidingbar #slidingbar-area']['display'] = 'none';

		$media_query = '@media screen and (max-width: ' . intval( Aione()->theme_options[ 'side_header_break_point' ] - 18 ) . 'px)';
		$elements = array( 'body.admin-bar #wrapper #slidingbar-area', '.admin-bar p.demo_store' );
		$css[$media_query][aione_implode( $elements )]['top'] = '46px';
		$css[$media_query]['body.body_blank.admin-bar']['top'] = '45px';
		$css[$media_query]['html #wpadminbar']['z-index']  = '99999 !important';
		$css[$media_query]['html #wpadminbar']['position'] = 'fixed !important';
	}
	
	$h1_aione_font_option = Aione()->theme_options[ 'typography_h1' ];

	if ( $h1_aione_font_option['font-size'] ) {
		$css['global']['#main .post-content h1']['font-size']   = intval( $h1_aione_font_option['font-size'] ) . 'px';
	}
	if ( $h1_aione_font_option['line-height'] ) {
		$css['global']['#main .post-content h1']['line-height'] = intval( $h1_aione_font_option['font-size'] ) . 'px';
	}
	if ( $h1_aione_font_option['font-family'] ) {
		$css['global']['#main .post-content h1']['font-family']   = $h1_aione_font_option['font-family'];
	}

	$elements = array(
		'#wrapper .post-content h2',
		'#wrapper .oxo-title h2',
		'#wrapper #main .post-content .oxo-title h2',
		'#wrapper .title h2',
		'#wrapper #main .post-content .title h2',
		'#wrapper  #main .post h2',
		'#wrapper  #main .post h2',
		'#main .oxo-portfolio h2',
		'h2.entry-title'
	);
	if ( class_exists( 'WooCommerce' ) ) {
		$elements[] = '#wrapper .woocommerce .checkout h3';
		$elements[] = '.woocommerce-tabs h2';
	}

	if ( class_exists( 'bbPress' ) ) {
		$elements[] = '#bbpress-forums #bbp-user-wrapper h2.entry-title';
	}
	
	$h2_aione_font_option = Aione()->theme_options[ 'typography_h2' ];
	
	if ( $h2_aione_font_option['font-family'] ) {
		$css['global'][aione_implode( $elements )]['font-family']   = $h2_aione_font_option['font-family'];
	}

	if ( $h2_aione_font_option['font-size'] ) {
		$css['global'][aione_implode( $elements )]['font-size']   = intval( $h2_aione_font_option['font-size'] ) . 'px';
	}
	if ( $h2_aione_font_option['line-height'] ) {
		$css['global'][aione_implode( $elements )]['line-height'] = round( intval( $h2_aione_font_option['line-height'] ) * 1.5 ) . 'px';

		$elements = array(
			'#wrapper .post-content h2',
			'#wrapper .oxo-title h2',
			'#wrapper #main .post-content .oxo-title h2',
			'#wrapper .title h2',
			'#wrapper #main .post-content .title h2',
			'#wrapper #main .post h2',
			'#main .oxo-portfolio h2',
			'h2.entry-title'
		);
		if ( class_exists( 'WooCommerce' ) ) {
			$elements[] = '#wrapper  .woocommerce .checkout h3';
			$elements[] = '.cart-empty';
			$elements[] = '.woocommerce-tabs h2';
		}
		$css['global'][aione_implode( $elements )]['line-height'] = intval( $h2_aione_font_option['line-height'] ) . 'px';
	}
	$elements = array(
		'#wrapper #main .post > h2.entry-title',
		'#wrapper #main .oxo-post-content > .blog-shortcode-post-title',
		'#wrapper #main .oxo-post-content > h2.entry-title',
		'#wrapper #main .oxo-portfolio-content > h2.entry-title',
		'#wrapper .oxo-events-shortcode .oxo-events-meta h2'
	);
	if ( class_exists( 'WooCommerce' ) ) {
		$elements[] = '.single-product .product .product_title';
	}
	if ( Aione()->theme_options[ 'post_titles_font_size' ] ) {
		$css['global'][aione_implode( $elements )]['font-size']   = intval( Aione()->theme_options[ 'post_titles_font_size' ] ) . 'px';
	}
	if ( Aione()->theme_options[ 'post_titles_font_lh' ] ) {
		$css['global'][aione_implode( $elements )]['line-height'] = intval( Aione()->theme_options[ 'post_titles_font_lh' ] ) . 'px';
	}

	if ( Aione()->theme_options[ 'post_titles_extras_font_size' ] ) {
		$elements = array(
			'#wrapper #main .about-author .oxo-title h3',
			'#wrapper #main #comments .oxo-title h3',
			'#wrapper #main #respond .oxo-title h3',
			'#wrapper #main .related-posts .oxo-title h3',
			'#wrapper #main .related.products .oxo-title h3'
		);
		if ( class_exists( 'WooCommerce' ) ) {
			$elements[] = '.single-product .woocommerce-tabs h3';
		}
		$css['global'][aione_implode( $elements )]['font-size'] = intval( Aione()->theme_options[ 'post_titles_extras_font_size' ] ) . 'px';
		$css['global'][aione_implode( $elements )]['line-height'] = round( intval( Aione()->theme_options[ 'post_titles_extras_font_size' ] ) * 1.5 ) . 'px';
	}
	
	$h3_aione_font_option = Aione()->theme_options[ 'typography_h3' ];
	
	if ( $h3_aione_font_option['font-family'] ) {

		$elements = array(
			'.post-content h3',
			'.project-content h3',
			'.oxo-person .person-author-wrapper .person-name',
		);
		if ( class_exists( 'WooCommerce' ) ) {
			$elements[] = '.product-title';
		}
		if( class_exists( 'Tribe__Events__Main' ) ) {
			$elements[] = '.single-tribe_events .oxo-events-featured-image .recurringinfo .tribe-events-divider, .single-tribe_events .oxo-events-featured-image .recurringinfo .tribe-events-cost';
		}
		$css['global'][aione_implode( $elements )]['font-family'] = $h3_aione_font_option['font-family'];

		$elements = array( '.oxo-modal .modal-title' );
		if ( class_exists( 'WooCommerce' ) ) {
			$elements[] = 'p.demo_store';
		}
		$css['global'][aione_implode( $elements )]['font-family'] = $h3_aione_font_option['font-family'];

	}

	if ( $h3_aione_font_option['font-size'] ) {

		$elements = array(
			'.post-content h3',
			'.project-content h3',
			'.oxo-person .person-author-wrapper .person-name',
		);
		if ( class_exists( 'WooCommerce' ) ) {
			$elements[] = '.product-title';
		}
		if( class_exists( 'Tribe__Events__Main' ) ) {
			$elements[] = '.single-tribe_events .oxo-events-featured-image .recurringinfo .tribe-events-divider, .single-tribe_events .oxo-events-featured-image .recurringinfo .tribe-events-cost';
		}
		$css['global'][aione_implode( $elements )]['font-size'] = intval( $h3_aione_font_option['font-size'] ) . 'px';

		$elements = array( '.oxo-modal .modal-title' );
		if ( class_exists( 'WooCommerce' ) ) {
			$elements[] = 'p.demo_store';
		}
		$css['global'][aione_implode( $elements )]['font-size'] = intval( $h3_aione_font_option['font-size'] ) . 'px';

	}

	if ( $h3_aione_font_option['line-height'] ) {

		$css['global'][aione_implode( $elements )]['line-height'] = round( intval( $h3_aione_font_option['line-height'] ) * 1.5 ) . 'px';

		$elements = array(
			'.post-content h3',
			'.project-content h3',
			'.oxo-person .person-author-wrapper .person-name',
		);
		if ( class_exists( 'WooCommerce' ) ) {
			$elements[] = '.product-title';
		}
		$css['global'][aione_implode( $elements )]['line-height'] = intval( $h3_aione_font_option['line-height'] ) . 'px';

	}
	
	$h4_aione_font_option = Aione()->theme_options[ 'typography_h4' ];
	
	if ( $h4_aione_font_option['font-family'] ) {

		$elements = array(
			'.post-content h4',
			'.oxo-portfolio-post .oxo-portfolio-content h4',
			'.oxo-rollover .oxo-rollover-content .oxo-rollover-title',
			'.oxo-person .person-author-wrapper .person-title',
			'.oxo-carousel-title'
		);
		$css['global'][aione_implode( $elements )]['font-family'] = $h4_aione_font_option['font-family'];

		$elements = array(
			'#wrapper .oxo-tabs-widget .tab-holder .tabs li a',
			'.person-author-wrapper',
			'.popover .popover-title',
			'.oxo-flip-box .flip-box-heading-back'
		);
		$css['global'][aione_implode( $elements )]['font-family'] = $h4_aione_font_option['font-family'];

		$elements = array(
			'.oxo-widget-area .oxo-accordian .panel-title',
			'.oxo-accordian .panel-title',
			'.oxo-sharing-box h4',
			'.oxo-tabs .nav-tabs > li .oxo-tab-heading',
		);
		$css['global'][aione_implode( $elements )]['font-family'] = $h4_aione_font_option['font-family'];

	}

	if ( $h4_aione_font_option['font-size'] ) {

		$elements = array(
			'.post-content h4',
			'.oxo-portfolio-post .oxo-portfolio-content h4',
			'.oxo-rollover .oxo-rollover-content .oxo-rollover-title',
			'.oxo-person .person-author-wrapper .person-title',
			'.oxo-carousel-title'
		);
		$css['global'][aione_implode( $elements )]['font-size'] = intval( $h4_aione_font_option['font-size'] ) . 'px';

		$elements = array(
			'#wrapper .oxo-tabs-widget .tab-holder .tabs li a',
			'.person-author-wrapper',
			'.popover .popover-title',
			'.oxo-flip-box .flip-box-heading-back'
		);
		$css['global'][aione_implode( $elements )]['font-size'] = intval( $h4_aione_font_option['font-size'] ) . 'px';

		$elements = array(
			'.oxo-widget-area .oxo-accordian .panel-title',
			'.oxo-accordian .panel-title',
			'.oxo-sharing-box h4',
			'.oxo-tabs .nav-tabs > li .oxo-tab-heading',
		);
		$css['global'][aione_implode( $elements )]['font-size'] = intval( $h4_aione_font_option['font-size'] ) . 'px';

	}

	if ( $h4_aione_font_option['line-height'] ) {
		$css['global'][aione_implode( $elements )]['line-height'] = round( intval( $h4_aione_font_option['line-height'] ) * 1.5 ) . 'px';

		$elements = array(
			'.post-content h4',
			'.oxo-portfolio-post .oxo-portfolio-content h4',
			'.oxo-rollover .oxo-rollover-content .oxo-rollover-title',
			'.oxo-person .person-author-wrapper .person-title',
			'.oxo-carousel-title'
		);
		$css['global'][aione_implode( $elements )]['line-height'] = intval( $h4_aione_font_option['line-height'] ) . 'px';

	}

	if ( Aione()->theme_options[ 'h5_font_size' ] ) {
		$css['global']['.post-content h5']['font-size']   = intval( Aione()->theme_options[ 'h5_font_size' ] ) . 'px';
	}

	if ( Aione()->theme_options[ 'h5_font_lh' ] ) {
		$css['global']['.post-content h5']['line-height'] = intval( Aione()->theme_options[ 'h5_font_lh' ] ) . 'px';
	}

	if ( Aione()->theme_options[ 'h6_font_size' ] ) {
		$css['global']['.post-content h6']['font-size']   = intval( Aione()->theme_options[ 'h6_font_size' ] ) . 'px';
	}

	if ( Aione()->theme_options[ 'h6_font_lh' ] ) {
		$css['global']['.post-content h6']['line-height'] = intval( Aione()->theme_options[ 'h6_font_lh' ] ) . 'px';
	}

	if ( Aione()->theme_options[ 'es_title_font_size' ] ) {
		$css['global']['.ei-title h2']['font-size']   = intval( Aione()->theme_options[ 'es_title_font_size' ] ) . 'px';
		$css['global']['.ei-title h2']['line-height'] = round( Aione()->theme_options[ 'es_title_font_size' ] * 1.5 ) . 'px';
	}

	if ( Aione()->theme_options[ 'es_caption_font_size' ] ) {
		$css['global']['.ei-title h3']['font-size']   = intval( Aione()->theme_options[ 'es_caption_font_size' ] ) . 'px';
		$css['global']['.ei-title h3']['line-height'] = round( intval( Aione()->theme_options[ 'es_caption_font_size' ] ) * 1.5 ) . 'px';
	}

	if ( Aione()->theme_options[ 'meta_font_size' ] ) {

		$elements = array(
			'.oxo-image-wrapper .oxo-rollover .oxo-rollover-content .oxo-rollover-categories',
			'.oxo-image-wrapper .oxo-rollover .oxo-rollover-content .oxo-rollover-categories a',
			'.oxo-recent-posts .columns .column .meta',
			'.oxo-carousel-meta',
			'.oxo-single-line-meta',
			'#wrapper .oxo-events-shortcode .oxo-events-meta h4'
		);

		if ( class_exists( 'bbPress' ) ) {
			$elements[] = '#bbpress-forums li.bbp-body ul.forum .bbp-forum-freshness';
			$elements[] = '#bbpress-forums li.bbp-body ul.topic .bbp-topic-freshness';
			$elements[] = '#bbpress-forums .bbp-forum-info .bbp-forum-content';
			$elements[] = '#bbpress-forums p.bbp-topic-meta';
			$elements[] = '.bbp-pagination-count';
			$elements[] = '#bbpress-forums div.bbp-topic-author .oxo-reply-id';
			$elements[] = '#bbpress-forums div.bbp-reply-author .oxo-reply-id';
			$elements[] = '#bbpress-forums .bbp-reply-header .bbp-meta';
			$elements[] = '#bbpress-forums span.bbp-admin-links a';
			$elements[] = '#bbpress-forums span.bbp-admin-links';
			$elements[] = '#bbpress-forums .bbp-topic-content ul.bbp-topic-revision-log';
			$elements[] = '#bbpress-forums .bbp-reply-content ul.bbp-topic-revision-log';
			$elements[] = '#bbpress-forums .bbp-reply-content ul.bbp-reply-revision-log';
		}

		$css['global'][aione_implode( $elements )]['font-size']   = intval( Aione()->theme_options[ 'meta_font_size' ] ) . 'px';
		$css['global'][aione_implode( $elements )]['line-height'] = round( intval( Aione()->theme_options[ 'meta_font_size' ] ) * 1.5 ) . 'px';

		$elements = array(
			'.oxo-meta',
			'.oxo-meta-info',
			'.oxo-recent-posts .columns .column .meta',
			'.post .single-line-meta',
			'.oxo-carousel-meta'
		);
		$css['global'][aione_implode( $elements )]['font-size'] = intval( Aione()->theme_options[ 'meta_font_size' ] ) . 'px';

	}

	if ( Aione()->theme_options[ 'woo_icon_font_size' ] ) {

		$elements = array(
			'.oxo-image-wrapper .oxo-rollover .oxo-rollover-content .oxo-product-buttons a',
			'.product-buttons a'
		);
		$css['global'][aione_implode( $elements )]['font-size']   = intval( Aione()->theme_options[ 'woo_icon_font_size' ] ) . 'px';
		$css['global'][aione_implode( $elements )]['line-height'] = round( intval( Aione()->theme_options[ 'woo_icon_font_size' ] ) * 1.5 ) . 'px';

	}

	if ( Aione()->theme_options[ 'pagination_font_size' ] ) {

		$elements = array(
			'.pagination',
			'.page-links',
			'.pagination .pagination-next',
			'.pagination .pagination-prev',
		);
		if ( class_exists( 'WooCommerce' ) ) {
			$elements[] = '.woocommerce-pagination';
			$elements[] = '.woocommerce-pagination .next';
			$elements[] = '.woocommerce-pagination .prev';
		}

		if ( class_exists( 'bbPress' ) ) {
			$elements[] = '.bbp-pagination .bbp-pagination-links';
			$elements[] = '.bbp-pagination .bbp-pagination-links .pagination-prev';
			$elements[] = '.bbp-pagination .bbp-pagination-links .pagination-next';
		}

		$css['global'][aione_implode( $elements )]['font-size'] = intval( Aione()->theme_options[ 'pagination_font_size' ] ) . 'px';
	}

	$elements = array(
		'body',
		'.post .post-content',
		'.post-content blockquote',
		'#wrapper .oxo-tabs-widget .tab-holder .news-list li .post-holder .meta',
		'.oxo-content-widget-area .jtwt',
		'#wrapper .meta',
		'.review blockquote div',
		'.search input',
		'.project-content .project-info h4',
		'.title-row',
		'.oxo-rollover .price .amount',
		'.quantity .qty',
		'.quantity .minus',
		'.quantity .plus',
		'.oxo-blog-timeline-layout .oxo-timeline-date',
		'.oxo-content-widget-area .widget_nav_menu li',
		'.oxo-content-widget-area .widget_categories li',
		'.oxo-content-widget-area .widget_meta li',
		'.oxo-content-widget-area .widget .recentcomments',
		'.oxo-content-widget-area .widget_recent_entries li',
		'.oxo-content-widget-area .widget_archive li',
		'.oxo-content-widget-area .widget_pages li',
		'.oxo-content-widget-area .widget_links li',
	);

	if ( class_exists( 'bbPress' ) ) {
		$elements[] = '.bbp-search-results .bbp-forum-title h3';
		$elements[] = '.bbp-search-results .bbp-topic-title h3';
	}

	if ( class_exists( 'WooCommerce' ) ) {
		$elements[] = '.oxo-content-widget-area .widget_product_categories li';
		$elements[] = '.oxo-content-widget-area .widget_layered_nav li';
	}
	if( class_exists( 'Tribe__Events__Main' ) ) {
		$elements[] = '.tribe-mini-calendar th';
	}
	$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'body_text_color' ], Aione()->settings->get_default( 'body_text_color' ) );

	$elements = array(
		'.post-content h1',
		'.title h1',
		'.oxo-post-content h1'
	);
	if ( class_exists( 'WooCommerce' ) ) {
		$elements[] = '.woocommerce-success-message .msg';
		$elements[] = '.woocommerce-message';
	}
	$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'h1_color' ], Aione()->settings->get_default( 'h1_color' ) );

	$elements = array(
		'#main .post h2',
		'.post-content h2',
		'.oxo-title h2',
		'.title h2',
		'.search-page-search-form h2',
		'.cart-empty',
		'.oxo-post-content h2'
	);
	if ( class_exists( 'WooCommerce' ) ) {
		$elements[] = '.woocommerce-tabs h2';
		$elements[] = '.woocommerce h2';
		$elements[] = '.woocommerce .checkout h3';
		$elements[] = '.woocommerce-tabs h2';
	}
	$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'h2_color' ], Aione()->settings->get_default( 'h2_color' ) );

	$elements = array(
		'.post-content h3',
		'.project-content h3',
		'.oxo-title h3',
		'.title h3',
		'.person-author-wrapper span',
		'.product-title',
		'.oxo-post-content h3',
	);
	if ( class_exists( 'WooCommerce' ) ) {
		$elements[] = '.single-product .woocommerce-tabs h3';
	}
	$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'h3_color' ], Aione()->settings->get_default( 'h3_color' ) );

	$elements = array(
		'.post-content h4',
		'.project-content .project-info h4',
		'.share-box h4',
		'.oxo-title h4',
		'.title h4',
		'.oxo-content-widget-area .widget h4',
		'#wrapper .oxo-tabs-widget .tab-holder .tabs li a',
		'.oxo-accordian .panel-title a',
		'.oxo-carousel-title',
		'.oxo-tabs .nav-tabs > li .oxo-tab-heading',
		'.oxo-post-content h4'
	);
	$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'h4_color' ], Aione()->settings->get_default( 'h4_color' ) );

	$elements = array(
		'.post-content h5',
		'.oxo-title h5',
		'.title h5',
		'.oxo-post-content h5'
	);
	$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'h5_color' ], Aione()->settings->get_default( 'h5_color' ) );

	$elements = array(
		'.post-content h6',
		'.oxo-title h6',
		'.title h6',
		'.oxo-post-content h6'
	);
	$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'h6_color' ], Aione()->settings->get_default( 'h6_color' ) );

	$elements = array( '.oxo-page-title-bar h1', '.oxo-page-title-bar h3' );
	$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'page_title_color' ], Aione()->settings->get_default( 'page_title_color' ) );

	$css['global']['.sep-boxed-pricing .panel-heading h3']['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'sep_pricing_box_heading_color' ], Aione()->settings->get_default( 'sep_pricing_box_heading_color' ) );

	$css['global']['.full-boxed-pricing.oxo-pricing-table .panel-heading h3']['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'full_boxed_pricing_box_heading_color' ], Aione()->settings->get_default( 'full_boxed_pricing_box_heading_color' ) );

	$elements = array(
		'body a',
		'body a:before',
		'body a:after',
		'.single-navigation a[rel="prev"]:before',
		'.single-navigation a[rel="next"]:after',
		'.project-content .project-info .project-info-box a',
		'.oxo-content-widget-area .widget li a',
		'.oxo-content-widget-area .widget li a:before',
		'.oxo-content-widget-area .widget .recentcomments',
		'.oxo-content-widget-area .widget_categories li',
		'#main .post h2 a',
		'.about-author .title a',
		'.shop_attributes tr th',
		'.oxo-rollover a',
		'.oxo-load-more-button',

	);

	if ( class_exists( 'bbPress' ) ) {
		$elements[] = '.bbp-forum-header a.bbp-forum-permalink';
		$elements[] = '.bbp-topic-header a.bbp-topic-permalink';
		$elements[] = '.bbp-reply-header a.bbp-reply-permalink';
	}

	if ( class_exists( 'WooCommerce' ) ) {
		$elements[] = '.oxo-woo-featured-products-slider .price .amount';
		$elements[] = 'z.my_account_orders thead tr th';
		$elements[] = '.shop_table thead tr th';
		$elements[] = '.cart_totals table th';
		$elements[] = '.checkout .shop_table tfoot th';
		$elements[] = '.checkout .payment_methods label';
		$elements[] = '#final-order-details .mini-order-details th';
		$elements[] = '#main .product .product_title';
		$elements[] = '.shop_table.order_details tr th';
		$elements[] = '.widget_layered_nav li.chosen a';
		$elements[] = '.widget_layered_nav li.chosen a:before';
		$elements[] = '.widget_layered_nav_filters li.chosen a';
		$elements[] = '.widget_layered_nav_filters li.chosen a:before';
	}

	if( class_exists( 'Tribe__Events__Main' ) ) {
		$elements[] = '#tribe-events-content .tribe-events-sub-nav li a';
		$elements[] = '.event-is-recurring';
	}

	$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'link_color' ], Aione()->settings->get_default( 'link_color' ) );

	if ( class_exists( 'bbPress' ) ) {
		$link_color_rgb = oxo_hex2rgb( Aione_Sanitize::color( Aione()->theme_options[ 'link_color' ], Aione()->settings->get_default( 'link_color' ) ) );
		$link_color_hover = 'rgba(' . $link_color_rgb[0] . ',' . $link_color_rgb[1] . ',' . $link_color_rgb[2] . ',0.8)';

		$css['global']['#bbpress-forums #bbp-single-user-details #bbp-user-navigation li.current a:hover']['color'] = $link_color_hover;
	}

	$css['global']['body #toTop:before']['color'] = '#fff';

	if( class_exists( 'Tribe__Events__Main' ) ) {
		$elements = array(
			'.single-tribe_events .sidebar a',
			'.single-tribe_events .oxo-content-widget-area .widget li a',
			'.single-tribe_events .oxo-content-widget-area .widget li a:before',
			'.single-tribe_events .oxo-content-widget-area .widget li a:after'
		);
		$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'ec_sidebar_link_color' ], Aione()->settings->get_default( 'ec_sidebar_link_color' ) );

		$elements = array(
			'.single-tribe_events .sidebar a:hover',
			'.single-tribe_events .oxo-content-widget-area .widget li a:hover',
			'.single-tribe_events .oxo-content-widget-area .widget li a:hover:before',
			'.single-tribe_events .oxo-content-widget-area .widget li a:hover:after'
		);
		$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options['primary_color'], Aione()->settings->get_default( 'primary_color' ) );
	}

	$elements = array(
		'.oxo-page-title-bar .oxo-breadcrumbs',
		'.oxo-page-title-bar .oxo-breadcrumbs a'
	);
	$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'breadcrumbs_text_color' ], Aione()->settings->get_default( 'breadcrumbs_text_color' ) );

	$elements = array(
		'#slidingbar-area h3',
		'#slidingbar-area .oxo-title > *',
		'#slidingbar-area .widget-title'
	);
	$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'slidingbar_headings_color' ], Aione()->settings->get_default( 'slidingbar_headings_color' ) );

	$elements = array(
		'#slidingbar-area',
		'#slidingbar-area .oxo-column',
		'#slidingbar-area .jtwt',
		'#slidingbar-area .jtwt .jtwt_tweet'
	);
	$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'slidingbar_text_color' ], Aione()->settings->get_default( 'slidingbar_text_color' ) );

	$elements = array(
		'.slidingbar-area a',
		'.slidingbar-area .widget li a:before',
		' #slidingbar-area .jtwt .jtwt_tweet a',
		'#wrapper #slidingbar-area .oxo-tabs-widget .tab-holder .tabs li a',
		'#slidingbar-area .oxo-accordian .panel-title a'
	);
	$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'slidingbar_link_color' ], Aione()->settings->get_default( 'slidingbar_link_color' ) );

	$elements = array(
		'.sidebar .widget h4',
		'.sidebar .widget .heading h4'
	);
	$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'sidebar_heading_color' ], Aione()->settings->get_default( 'sidebar_heading_color' ) );

	if ( class_exists( 'Tribe__Events__Main' ) ) {
		$elements = array(
			'.single-tribe_events .sidebar .widget h4',
			'.single-tribe_events .sidebar .widget .heading h4',
			'.single-tribe_events .sidebar .tribe-events-single-section-title'
		);
		$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'ec_sidebar_heading_color' ], Aione()->settings->get_default( 'ec_sidebar_heading_color' ) );

		$elements = array(
			'.single-tribe_events .sidebar'
		);
		$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'ec_sidebar_text_color' ], Aione()->settings->get_default( 'ec_sidebar_text_color' ) );

		$elements = array(
			'.single-tribe_events .oxo-content-widget-area .widget_nav_menu li',
			'.single-tribe_events .oxo-content-widget-area .widget_meta li',
			'.single-tribe_events .oxo-content-widget-area .widget_recent_entries li',
			'.single-tribe_events .oxo-content-widget-area .widget_archive li',
			'.single-tribe_events .oxo-content-widget-area .widget_pages li',
			'.single-tribe_events .oxo-content-widget-area .widget_links li',
			'.single-tribe_events .oxo-content-widget-area .widget li a',
			'.single-tribe_events .oxo-content-widget-area .widget .recentcomments',
			'.single-tribe_events .oxo-content-widget-area .widget_categories li',
			'.single-tribe_events #wrapper .oxo-tabs-widget .tab-holder',
			'.single-tribe_events .sidebar .tagcloud a',
			'.single-tribe_events .sidebar .tribe-events-meta-group dd',
			'.single-tribe_events .sidebar .tribe-mini-calendar-event',
			'.single-tribe_events .sidebar .tribe-events-list-widget ol li',
			'.single-tribe_events .sidebar .tribe-events-venue-widget li'
		);
		$css['global'][aione_implode( $elements )]['border-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'ec_sidebar_divider_color' ], Aione()->settings->get_default( 'ec_sidebar_divider_color' ) );
	}

	$elements = array(
		'.sidebar .widget .widget-title',
		'.sidebar .widget .heading .widget-title'
	);
	$css['global'][aione_implode( $elements )]['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'sidebar_widget_bg_color' ], Aione()->settings->get_default( 'sidebar_widget_bg_color' ) );

	if( Aione()->theme_options[ 'sidebar_widget_bg_color' ] != 'transparent' && Aione()->theme_options[ 'sidebar_widget_bg_color' ] ) {
		$css['global'][aione_implode( $elements )]['padding'] = '9px 15px';
	}

	if ( class_exists( 'Tribe__Events__Main' ) ) {
		$elements = array(
			'.single-tribe_events .sidebar .widget .widget-title',
			'.single-tribe_events .sidebar .widget .heading .widget-title',
			'.single-tribe_events .sidebar .tribe-events-single-section-title'
		);
		$css['global'][aione_implode( $elements )]['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'ec_sidebar_widget_bg_color' ], Aione()->settings->get_default( 'ec_sidebar_widget_bg_color' ) );

		if( Aione()->theme_options[ 'ec_sidebar_widget_bg_color' ] != 'transparent' && Aione()->theme_options[ 'ec_sidebar_widget_bg_color' ] ) {
			$css['global'][aione_implode( $elements )]['padding'] = '9px 15px';
		}
	}
	
	$elements = array(
		'.oxo-secondary-header .oxo-alignleft',
		'.oxo-secondary-header .oxo-alignright',
		'.oxo-header-wrapper .oxo-secondary-header a'
	);
	$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'topbar_text_color' ] );

	$elements = array(
		'.oxo-footer-widget-area h3',
		'.oxo-footer-widget-area .widget-title',
		'.oxo-footer-widget-column .product-title'
	);
	$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'footer_headings_color' ], Aione()->settings->get_default( 'footer_headings_color' ) );

	$elements = array(
		'.oxo-footer-widget-area',
		'.oxo-footer-widget-area article.col',
		'.oxo-footer-widget-area .jtwt',
		'.oxo-footer-widget-area .jtwt .jtwt_tweet',
		'.oxo-copyright-notice'
	);
	$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'footer_text_color' ], Aione()->settings->get_default( 'footer_text_color' ) );

	$elements = array(
		'.oxo-footer-widget-area a',
		'.oxo-footer-widget-area .widget li a:before',
		'.oxo-footer-widget-area .jtwt .jtwt_tweet a',
		'#wrapper .oxo-footer-widget-area .oxo-tabs-widget .tab-holder .tabs li a',
		'.oxo-footer-widget-area .oxo-tabs-widget .tab-holder .news-list li .post-holder a',
		'.oxo-copyright-notice a',
		'.oxo-footer-widget-area .oxo-accordian .panel-title a'
	);
	$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'footer_link_color' ], Aione()->settings->get_default( 'footer_link_color' ) );

	$css['global']['.ei-title h2']['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'es_title_color' ], Aione()->settings->get_default( 'es_title_color' ) );
	$css['global']['.ei-title h3']['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'es_caption_color' ], Aione()->settings->get_default( 'es_caption_color' ) );

	$elements = array(
		'.sep-single',
		'.sep-double',
		'.sep-dashed',
		'.sep-dotted',
		'.search-page-search-form',
		'.ls-aione',
		'.aione-skin-rev',
		'.es-carousel-wrapper.oxo-carousel-small .es-carousel ul li img',
		'.oxo-accordian .oxo-panel',
		'.progress-bar',
		'#small-nav',
		'.oxo-filters',
		'.single-navigation',
		'.project-content .project-info .project-info-box',
		'.post .oxo-meta-info',
		'.oxo-blog-layout-grid .post .post-wrapper',
		'.oxo-blog-layout-grid .post .oxo-content-sep',
		'.oxo-portfolio .oxo-portfolio-boxed .oxo-portfolio-post-wrapper',
		'.oxo-portfolio .oxo-portfolio-boxed .oxo-content-sep',
		'.oxo-portfolio-one .oxo-portfolio-boxed .oxo-portfolio-post-wrapper',
		'.oxo-blog-layout-grid .post .flexslider',
		'.oxo-layout-timeline .post',
		'.oxo-layout-timeline .post .oxo-content-sep',
		'.oxo-layout-timeline .post .flexslider',
		'.oxo-timeline-date',
		'.oxo-timeline-arrow',
		'.oxo-counters-box .oxo-counter-box .counter-box-border',
		'tr td',
		'.table',
		'.table > thead > tr > th',
		'.table > tbody > tr > th',
		'.table > tfoot > tr > th',
		'.table > thead > tr > td',
		'.table > tbody > tr > td',
		'.table > tfoot > tr > td',
		'.table-1 table',
		'.table-1 table th',
		'.table-1 tr td',
		'.tkt-slctr-tbl-wrap-dv table',
		'.tkt-slctr-tbl-wrap-dv tr td',
		'.table-2 table thead',
		'.table-2 tr td',
		'.oxo-content-widget-area .widget li a',
		'.oxo-content-widget-area .widget .recentcomments',
		'.oxo-content-widget-area .widget_categories li',
		'#wrapper .oxo-tabs-widget .tab-holder',
		'.commentlist .the-comment',
		'.side-nav',
		'#wrapper .side-nav li a',
		'h5.toggle.active + .toggle-content',
		'#wrapper .side-nav li.current_page_item li a',
		'.tabs-vertical .tabset',
		'.tabs-vertical .tabs-container .tab_content',
		'.oxo-tabs.vertical-tabs.clean .nav-tabs li .tab-link',
		'.pagination a.inactive',
		'.oxo-hide-pagination-text .pagination-prev',
		'.oxo-hide-pagination-text .pagination-next',
		'.page-links a',
		'.oxo-author .oxo-author-social',
		'.side-nav li a',
		'.price_slider_wrapper',
		'.tagcloud a',
		'.oxo-content-widget-area .widget_nav_menu li',
		'.oxo-content-widget-area .widget_meta li',
		'.oxo-content-widget-area .widget_recent_entries li',
		'.oxo-content-widget-area .widget_archive li',
		'.oxo-content-widget-area .widget_pages li',
		'.oxo-content-widget-area .widget_links li',
		'#customer_login_box',
		'.chzn-container-single .chzn-single',
		'.chzn-container-single .chzn-single div',
		'.chzn-drop',
		'.input-radio',
		'.panel.entry-content',
		'.quantity',
		'.quantity .minus',
		'.quantity .qty',
		'#reviews li .comment-text',
		'#customer_login .col-1',
		'#customer_login .col-2',
		'#customer_login h2',
	);
	if ( is_rtl() ) {
		$elements[] = '.rtl .side-nav';
	}
	if ( class_exists( 'bbPress' ) ) {
		$elements[] = '.bbp-pagination .bbp-pagination-links a.inactive';
		$elements[] = '.bbp-topic-pagination .page-numbers';
		$elements[] = '.widget.widget.widget_display_replies ul li';
		$elements[] = '.widget.widget_display_topics ul li';
		$elements[] = '.widget.widget_display_views ul li';
		$elements[] = '.widget.widget_display_stats dt';
		$elements[] = '.widget.widget_display_stats dd';
		$elements[] = '.bbp-pagination-links span.dots';
		$elements[] = '.oxo-hide-pagination-text .bbp-pagination .bbp-pagination-links .pagination-prev';
		$elements[] = '.oxo-hide-pagination-text .bbp-pagination .bbp-pagination-links .pagination-next';
	}
	if ( class_exists( 'WooCommerce' ) ) {
		$elements[] = '.oxo-body .aione_myaccount_user';
		$elements[] = '.oxo-body .myaccount_user_container span';
		$elements[] = '.woocommerce-pagination .page-numbers';
		$elements[] = '.woo-tabs-horizontal .woocommerce-tabs > .tabs li';
		$elements[] = '.woo-tabs-horizontal .woocommerce-tabs > .tabs';
		$elements[] = '.woo-tabs-horizontal .woocommerce-tabs > .wc-tab';
		$elements[] = '.oxo-body .woocommerce-side-nav li a';
		$elements[] = '.oxo-body .woocommerce-content-box';
		$elements[] = '.oxo-body .woocommerce-content-box h2';
		$elements[] = '.oxo-body .woocommerce .address h4';
		$elements[] = '.oxo-body .woocommerce-tabs .tabs li a';
		$elements[] = '.oxo-body .woocommerce .social-share';
		$elements[] = '.oxo-body .woocommerce .social-share li';
		$elements[] = '.oxo-body .woocommerce-success-message';
		$elements[] = '.oxo-body .woocommerce .cross-sells';
		$elements[] = '.oxo-body .woocommerce-message';
		$elements[] = '.oxo-body .woocommerce .checkout #customer_details .col-1';
		$elements[] = '.oxo-body .woocommerce .checkout #customer_details .col-2';
		$elements[] = '.oxo-body .woocommerce .checkout h3';
		$elements[] = '.oxo-body .woocommerce .cross-sells h2';
		$elements[] = '.oxo-body .woocommerce .addresses .title';
		$elements[] = '.oxo-content-widget-area .widget_product_categories li';
		$elements[] = '.widget_product_categories li';
		$elements[] = '.widget_layered_nav li';
		$elements[] = '.oxo-content-widget-area .product_list_widget li';
		$elements[] = '.oxo-content-widget-area .widget_layered_nav li';
		$elements[] = '.oxo-body .my_account_orders tr';
		$elements[] = '.side-nav-left .side-nav';
		$elements[] = '.oxo-body .shop_table tr';
		$elements[] = '.oxo-body .cart_totals .total';
		$elements[] = '.oxo-body .checkout .shop_table tfoot';
		$elements[] = '.oxo-body .shop_attributes tr';
		$elements[] = '.oxo-body .cart-totals-buttons';
		$elements[] = '.oxo-body .cart_totals';
		$elements[] = '.oxo-body .woocommerce-shipping-calculator';
		$elements[] = '.oxo-body .coupon';
		$elements[] = '.oxo-body .cart_totals h2';
		$elements[] = '.oxo-body .woocommerce-shipping-calculator h2';
		$elements[] = '.oxo-body .coupon h2';
		$elements[] = '.oxo-body .order-total';
		$elements[] = '.oxo-body .woocommerce .cart-empty';
		$elements[] = '.oxo-body .woocommerce .return-to-shop';
		$elements[] = '.oxo-body .aione-order-details .shop_table.order_details tfoot';
		$elements[] = '#final-order-details .mini-order-details tr:last-child';
		$elements[] = '.oxo-body .order-info';
		if ( is_rtl() ) {
			$elements[] = '.rtl .woocommerce .social-share li';
		}
	}
	if( class_exists( 'Tribe__Events__Main' ) ) {
		$elements[] = '.sidebar .tribe-mini-calendar-event';
		$elements[] = '.sidebar .tribe-events-list-widget ol li';
		$elements[] = '.sidebar .tribe-events-venue-widget li';
		$elements[] = '.oxo-content-widget-area .tribe-mini-calendar-event';
		$elements[] = '.oxo-content-widget-area .tribe-events-list-widget ol li';
		$elements[] = '.oxo-content-widget-area .tribe-events-venue-widget li';
	}
	$css['global'][aione_implode( $elements )]['border-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'sep_color' ], Aione()->settings->get_default( 'sep_color' ) );

	$css['global']['.price_slider_wrapper .ui-widget-content']['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'sep_color' ], Aione()->settings->get_default( 'sep_color' ) );
	if ( class_exists( 'GFForms' ) ) {
		$css['global']['.gform_wrapper .gsection']['border-bottom'] = '1px dotted ' . Aione_Sanitize::color( Aione()->theme_options[ 'sep_color' ], Aione()->settings->get_default( 'sep_color' ) );
	}

	$load_more_bg_color_rgb = oxo_hex2rgb( Aione()->theme_options[ 'load_more_posts_button_bg_color' ] );
	$load_more_posts_button_bg_color_hover = 'rgba(' . $load_more_bg_color_rgb[0] . ',' . $load_more_bg_color_rgb[1] . ',' . $load_more_bg_color_rgb[2] . ',0.8)';

	$css['global']['.oxo-load-more-button']['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'load_more_posts_button_bg_color' ], Aione()->settings->get_default( 'load_more_posts_button_bg_color' ) );
	$css['global']['.oxo-load-more-button:hover']['background-color'] = Aione_Sanitize::color( $load_more_posts_button_bg_color_hover );

	$elements = array( '.quantity .minus', '.quantity .plus' );
	$css['global'][aione_implode( $elements )]['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'qty_bg_color' ], Aione()->settings->get_default( 'qty_bg_color' ) );

	$elements = array( '.quantity .minus:hover', '.quantity .plus:hover' );
	$css['global'][aione_implode( $elements )]['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'qty_bg_hover_color' ], Aione()->settings->get_default( 'qty_bg_hover_color' ) );

	$css['global']['.sb-toggle-wrapper .sb-toggle:after']['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'slidingbar_toggle_icon_color' ], Aione()->settings->get_default( 'slidingbar_toggle_icon_color' ) );

	$elements = array(
		'#slidingbar-area .widget_categories li a',
		'#slidingbar-area li.recentcomments',
		'#slidingbar-area ul li a',
		'#slidingbar-area .product_list_widget li',
		'#slidingbar-area .widget_recent_entries ul li'
	);
	$css['global'][aione_implode( $elements )]['border-bottom-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'slidingbar_divider_color' ], Aione()->settings->get_default( 'slidingbar_divider_color' ) );

	$elements = array(
		'#slidingbar-area .tagcloud a',
		'#wrapper #slidingbar-area .oxo-tabs-widget .tab-holder',
		'#wrapper #slidingbar-area .oxo-tabs-widget .tab-holder .news-list li',
		'#slidingbar-area .oxo-accordian .oxo-panel'
	);

	if ( class_exists( 'bbPress' ) ) {
		$elements[] = '#slidingbar-area .bbp-pagination .bbp-pagination-links a.inactive';
		$elements[] = '#slidingbar-area .bbp-topic-pagination .page-numbers';
		$elements[] = '#slidingbar-area .widget.widget.widget_display_replies ul li';
		$elements[] = '#slidingbar-area .widget.widget_display_topics ul li';
		$elements[] = '#slidingbar-area .widget.widget_display_views ul li';
		$elements[] = '#slidingbar-area .widget.widget_display_stats dt';
		$elements[] = '#slidingbar-area .widget.widget_display_stats dd';
	}

	if( class_exists( 'Tribe__Events__Main' ) ) {
		$elements[] = '#slidingbar-area .tribe-mini-calendar-event';
		$elements[] = '#slidingbar-area .tribe-events-list-widget ol li';
		$elements[] = '#slidingbar-area .tribe-events-venue-widget li';
	}
	$css['global'][aione_implode( $elements )]['border-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'slidingbar_divider_color' ], Aione()->settings->get_default( 'slidingbar_divider_color' ) );

	$elements = array(
		'.oxo-footer-widget-area .widget_categories li a',
		'.oxo-footer-widget-area li.recentcomments',
		'.oxo-footer-widget-area ul li a',
		'.oxo-footer-widget-area .product_list_widget li',
		'.oxo-footer-widget-area .tagcloud a',
		'#wrapper .oxo-footer-widget-area .oxo-tabs-widget .tab-holder',
		'#wrapper .oxo-footer-widget-area .oxo-tabs-widget .tab-holder .news-list li',
		'.oxo-footer-widget-area .widget_recent_entries li',
		'.oxo-footer-widget-area .oxo-accordian .oxo-panel',
	);

	if ( class_exists( 'bbPress' ) ) {
		$elements[] = '.oxo-footer-widget-area .bbp-pagination .bbp-pagination-links a.inactive';
		$elements[] = '.oxo-footer-widget-area .bbp-topic-pagination .page-numbers';
		$elements[] = '.oxo-footer-widget-area .widget.widget.widget_display_replies ul li';
		$elements[] = '.oxo-footer-widget-area .widget.widget_display_topics ul li';
		$elements[] = '.oxo-footer-widget-area .widget.widget_display_views ul li';
		$elements[] = '.oxo-footer-widget-area .widget.widget_display_stats dt';
		$elements[] = '.oxo-footer-widget-area .widget.widget_display_stats dd';
	}

	if( class_exists( 'Tribe__Events__Main' ) ) {
		$elements[] = '.oxo-footer-widget-area .tribe-mini-calendar-event';
		$elements[] = '.oxo-footer-widget-area .tribe-events-list-widget ol li';
		$elements[] = '.oxo-footer-widget-area .tribe-events-venue-widget li';
	}
	$css['global'][aione_implode( $elements )]['border-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'footer_divider_color' ], Aione()->settings->get_default( 'footer_divider_color' ) );

	$elements = array(
		'.input-text',
		'input[type="text"]',
		'textarea',
		'input.s',
		'#comment-input input',
		'#comment-textarea textarea',
		'.comment-form-comment textarea',
		'.post-password-form label input[type="password"]',
		'.main-nav-search-form input',
		'.search-page-search-form input',
		'.chzn-container-single .chzn-single',
		'.chzn-container .chzn-drop',
		'.aione-select-parent select',
		'.aione-select .select2-container .select2-choice',
		'.aione-select .select2-container .select2-choice2',
		'select',
		'#wrapper .search-table .search-field input'
	);
	if ( defined( 'ICL_SITEPRESS_VERSION' || class_exists( 'SitePress' ) ) ) {
		$elements[] = '#lang_sel_click a.lang_sel_sel';
		$elements[] = '#lang_sel_click ul ul a';
		$elements[] = '#lang_sel_click ul ul a:visited';
		$elements[] = '#lang_sel_click a';
		$elements[] = '#lang_sel_click a:visited';
	}
	if ( class_exists( 'GFForms' ) ) {
		$elements[] = '.gform_wrapper .gfield input[type="text"]';
		$elements[] = '.gform_wrapper .gfield input[type="email"]';
		$elements[] = '.gform_wrapper .gfield input[type="tel"]';
		$elements[] = '.gform_wrapper .gfield input[type="url"]';
		$elements[] = '.gform_wrapper .gfield input[type="number"]';
		$elements[] = '.gform_wrapper .gfield input[type="password"] input[type="number"]';
		$elements[] = '.gform_wrapper .gfield input[type="password"]';
		$elements[] = '.gform_wrapper .gfield_select[multiple=multiple]';
		$elements[] = '.gform_wrapper .gfield select';
		$elements[] = '.gform_wrapper .gfield textarea';
	}
	if ( defined( 'WPCF7_PLUGIN' ) ) {
		$elements[] = '.wpcf7-form .wpcf7-text';
		$elements[] = '.wpcf7-form .wpcf7-quiz';
		$elements[] = '.wpcf7-form .wpcf7-number';
		$elements[] = '.wpcf7-form textarea';
		$elements[] = '.wpcf7-form .wpcf7-select';
		$elements[] = '.wpcf7-captchar';
		$elements[] = '.wpcf7-form .wpcf7-date';
	}
	if ( class_exists( 'bbPress' ) ) {
		$elements[] = '#bbpress-forums .bbp-search-form #bbp_search';
		$elements[] = '.bbp-reply-form input#bbp_topic_tags';
		$elements[] = '.bbp-topic-form input#bbp_topic_title';
		$elements[] = '.bbp-topic-form input#bbp_topic_tags';
		$elements[] = '.bbp-topic-form select#bbp_stick_topic_select';
		$elements[] = '.bbp-topic-form select#bbp_topic_status_select';
		$elements[] = '#bbpress-forums div.bbp-the-content-wrapper textarea.bbp-the-content';
		$elements[] = '.bbp-login-form input';
	}
	if( class_exists( 'Tribe__Events__Main' ) ) {
		$elements[] = '#tribe-bar-form input[type=text]';
		$elements[] = '.tribe-bar-disabled #tribe-bar-form .tribe-bar-filters input[type=text]';
	}
	$css['global'][aione_implode( $elements )]['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'form_bg_color' ], Aione()->settings->get_default( 'form_bg_color' ) );

	$elements = array(
		'.aione-select-parent .select-arrow',
		'#wrapper .select-arrow',
	);
	if ( false !== strpos( Aione()->theme_options[ 'form_bg_color' ], 'rgba' ) ) {
		$select_arrow_bg = Aione_Sanitize::rgba_to_rgb( Aione()->theme_options[ 'form_bg_color' ] );
	} else {
		$select_arrow_bg = Aione_Sanitize::color( Aione()->theme_options[ 'form_bg_color' ], Aione()->settings->get_default( 'form_bg_color' ) );

	}
	$css['global'][aione_implode( $elements )]['background-color'] = $select_arrow_bg;


	$elements = array(
		'.input-text',
		'input[type="text"]',
		'textarea',
		'input.s',
		'input.s .placeholder',
		'#comment-input input',
		'#comment-textarea textarea',
		'#comment-input .placeholder',
		'#comment-textarea .placeholder',
		'.comment-form-comment textarea',
		'.post-password-form label input[type="password"]',
		'.aione-select .select2-container .select2-choice',
		'.aione-select .select2-container .select2-choice2',
		'select',
		'.main-nav-search-form input',
		'.search-page-search-form input',
		'.chzn-container-single .chzn-single',
		'.chzn-container .chzn-drop',
		'.aione-select-parent select',
		'#wrapper .search-table .search-field input'
	);
	if ( class_exists( 'GFForms' ) ) {
		$elements[] = '.gform_wrapper .gfield input[type="text"]';
		$elements[] = '.gform_wrapper .gfield input[type="email"]';
		$elements[] = '.gform_wrapper .gfield input[type="tel"]';
		$elements[] = '.gform_wrapper .gfield input[type="url"]';
		$elements[] = '.gform_wrapper .gfield input[type="number"]';
		$elements[] = '.gform_wrapper .gfield input[type="password"] input[type="number"]';
		$elements[] = '.gform_wrapper .gfield input[type="password"]';
		$elements[] = '.gform_wrapper .gfield_select[multiple=multiple]';
		$elements[] = '.gform_wrapper .gfield select';
		$elements[] = '.gform_wrapper .gfield textarea';
	}
	if ( defined( 'WPCF7_PLUGIN' ) ) {
		$elements[] = '.wpcf7-form .wpcf7-text';
		$elements[] = '.wpcf7-form .wpcf7-quiz';
		$elements[] = '.wpcf7-form .wpcf7-number';
		$elements[] = '.wpcf7-form textarea';
		$elements[] = '.wpcf7-form .wpcf7-select';
		$elements[] = '.wpcf7-select-parent .select-arrow';
		$elements[] = '.wpcf7-captchar';
		$elements[] = '.wpcf7-form .wpcf7-date';
	}
	if ( class_exists( 'bbPress' ) ) {
		$elements[] = '#bbpress-forums .bbp-search-form #bbp_search';
		$elements[] = '.bbp-reply-form input#bbp_topic_tags';
		$elements[] = '.bbp-topic-form input#bbp_topic_title';
		$elements[] = '.bbp-topic-form input#bbp_topic_tags';
		$elements[] = '.bbp-topic-form select#bbp_stick_topic_select';
		$elements[] = '.bbp-topic-form select#bbp_topic_status_select';
		$elements[] = '#bbpress-forums div.bbp-the-content-wrapper textarea.bbp-the-content';
		$elements[] = '.bbp-login-form input';
	}
	if( class_exists( 'Tribe__Events__Main' ) ) {
		$elements[] = '#tribe-bar-form input[type=text]';
		$elements[] = '.tribe-bar-disabled #tribe-bar-form .tribe-bar-filters input[type=text]';
	}
	$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'form_text_color' ], Aione()->settings->get_default( 'form_text_color' ) );

	$elements = array(
		'input#s::-webkit-input-placeholder',
		'#comment-input input::-webkit-input-placeholder',
		'.post-password-form label input[type="password"]::-webkit-input-placeholder',
		'#comment-textarea textarea::-webkit-input-placeholder',
		'.comment-form-comment textarea::-webkit-input-placeholder',
		'.input-text::-webkit-input-placeholder',
		'.searchform .s::-webkit-input-placeholder',
	);
	if( class_exists( 'Tribe__Events__Main' ) ) {
		$elements[] = '#tribe-bar-form input[type=text]::-webkit-input-placeholder';
		$elements[] = '.tribe-bar-disabled #tribe-bar-form .tribe-bar-filters input[type=text]::-webkit-input-placeholder';
	}

	$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'form_text_color' ], Aione()->settings->get_default( 'form_text_color' ) );

	$elements = array(
		'input#s:-moz-placeholder',
		'#comment-input input:-moz-placeholder',
		'.post-password-form label input[type="password"]:-moz-placeholder',
		'#comment-textarea textarea:-moz-placeholder',
		'.comment-form-comment textarea:-moz-placeholder',
		'.input-text:-moz-placeholder',
		'.searchform .s:-moz-placeholder',
	);
	if( class_exists( 'Tribe__Events__Main' ) ) {
		$elements[] = '#tribe-bar-form input[type=text]:-moz-placeholder';
		$elements[] = '.tribe-bar-disabled #tribe-bar-form .tribe-bar-filters input[type=text]:-moz-placeholder';
	}

	$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'form_text_color' ], Aione()->settings->get_default( 'form_text_color' ) );


	$elements = array(
		'input#s::-moz-placeholder',
		'#comment-input input::-moz-placeholder',
		'.post-password-form label input[type="password"]::-moz-placeholder',
		'#comment-textarea textarea::-moz-placeholder',
		'.comment-form-comment textarea::-moz-placeholder',
		'.input-text::-moz-placeholder',
		'.searchform .s::-moz-placeholder',
	);
	if( class_exists( 'Tribe__Events__Main' ) ) {
		$elements[] = '#tribe-bar-form input[type=text]::-moz-placeholder';
		$elements[] = '.tribe-bar-disabled #tribe-bar-form .tribe-bar-filters input[type=text]::-moz-placeholder';
	}

	$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'form_text_color' ], Aione()->settings->get_default( 'form_text_color' ) );


	$elements = array(
		'input#s:-ms-input-placeholder',
		'#comment-input input:-ms-input-placeholder',
		'.post-password-form label input[type="password"]::-ms-input-placeholder',
		'#comment-textarea textarea:-ms-input-placeholder',
		'.comment-form-comment textarea:-ms-input-placeholder',
		'.input-text:-ms-input-placeholder',
		'.searchform .s:-ms-input-placeholder',
	);
	if( class_exists( 'Tribe__Events__Main' ) ) {
		$elements[] = '#tribe-bar-form input[type=text]::-ms-input-placeholder';
		$elements[] = '.tribe-bar-disabled #tribe-bar-form .tribe-bar-filters input[type=text]::-ms-input-placeholder';
	}

	$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'form_text_color' ], Aione()->settings->get_default( 'form_text_color' ) );

	$elements = array(
		'.input-text',
		'input[type="text"]',
		'textarea',
		'input.s',
		'#comment-input input',
		'#comment-textarea textarea',
		'.comment-form-comment textarea',
		'.post-password-form label input[type="password"]',
		'.gravity-select-parent .select-arrow',
		'.select-arrow',
		'.main-nav-search-form input',
		'.search-page-search-form input',
		'.chzn-container-single .chzn-single',
		'.chzn-container .chzn-drop',
		'.aione-select-parent select',
		'.aione-select-parent .select-arrow',
		'select',
		'#wrapper .search-table .search-field input',
		'.aione-select .select2-container .select2-choice',
		'.aione-select .select2-container .select2-choice .select2-arrow',
		'.aione-select .select2-container .select2-choice2 .select2-arrow',
	);
	if ( defined( 'ICL_SITEPRESS_VERSION' || class_exists( 'SitePress' ) ) ) {
		$elements[] = '#lang_sel_click a.lang_sel_sel';
		$elements[] = '#lang_sel_click ul ul a';
		$elements[] = '#lang_sel_click ul ul a:visited';
		$elements[] = '#lang_sel_click a';
		$elements[] = '#lang_sel_click a:visited';
	}
	if ( class_exists( 'GFForms' ) ) {
		$elements[] = '.gform_wrapper .gfield input[type="text"]';
		$elements[] = '.gform_wrapper .gfield input[type="email"]';
		$elements[] = '.gform_wrapper .gfield input[type="tel"]';
		$elements[] = '.gform_wrapper .gfield input[type="url"]';
		$elements[] = '.gform_wrapper .gfield input[type="number"]';
		$elements[] = '.gform_wrapper .gfield input[type="password"] input[type="number"]';
		$elements[] = '.gform_wrapper .gfield input[type="password"]';
		$elements[] = '.gform_wrapper .gfield_select[multiple=multiple]';
		$elements[] = '.gform_wrapper .gfield select';
		$elements[] = '.gform_wrapper .gfield textarea';
	}
	if ( defined( 'WPCF7_PLUGIN' ) ) {
		$elements[] = '.wpcf7-form .wpcf7-text';
		$elements[] = '.wpcf7-form .wpcf7-quiz';
		$elements[] = '.wpcf7-form .wpcf7-number';
		$elements[] = '.wpcf7-form textarea';
		$elements[] = '.wpcf7-form .wpcf7-select';
		$elements[] = '.wpcf7-select-parent .select-arrow';
		$elements[] = '.wpcf7-captchar';
		$elements[] = '.wpcf7-form .wpcf7-date';
	}
	if ( class_exists( 'bbPress' ) ) {
		$elements[] = '#bbpress-forums .quicktags-toolbar';
		$elements[] = '#bbpress-forums .bbp-search-form #bbp_search';
		$elements[] = '.bbp-reply-form input#bbp_topic_tags';
		$elements[] = '.bbp-topic-form input#bbp_topic_title';
		$elements[] = '.bbp-topic-form input#bbp_topic_tags';
		$elements[] = '.bbp-topic-form select#bbp_stick_topic_select';
		$elements[] = '.bbp-topic-form select#bbp_topic_status_select';
		$elements[] = '#bbpress-forums div.bbp-the-content-wrapper textarea.bbp-the-content';
		$elements[] = '#wp-bbp_topic_content-editor-container';
		$elements[] = '#wp-bbp_reply_content-editor-container';
		$elements[] = '.bbp-login-form input';
		$elements[] = '#bbpress-forums .wp-editor-container';
		$elements[] = '#wp-bbp_topic_content-editor-container';
		$elements[] = '#wp-bbp_reply_content-editor-container';
	}
	if ( class_exists( 'WooCommerce' ) ) {
		$elements[] = '.woocommerce-checkout .select2-drop-active';
	}
	if( class_exists( 'Tribe__Events__Main' ) ) {
		$elements[] = '#tribe-bar-form input[type=text]';
		$elements[] = '.tribe-bar-disabled #tribe-bar-form .tribe-bar-filters input[type=text]';
	}
	$css['global'][aione_implode( $elements )]['border-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'form_border_color' ], Aione()->settings->get_default( 'form_border_color' ) );

	$elements = array(
		'.input-text:not(textarea)',
		'input[type="text"]',
		'input.s',
		'#comment-input input',
		'.post-password-form label input[type="password"]',
		'.main-nav-search-form input',
		'.search-page-search-form input',
		'.chzn-container-single .chzn-single',
		'.chzn-container .chzn-drop',
		'select',
		'.searchform .search-table .search-field input',
		'.aione-select-parent select',
		'.aione-select .select2-container .select2-choice',
	);

	if ( class_exists( 'GFForms' ) ) {
		$elements[] = '.gform_wrapper .gfield input[type="text"]';
		$elements[] = '.gform_wrapper .gfield input[type="email"]';
		$elements[] = '.gform_wrapper .gfield input[type="tel"]';
		$elements[] = '.gform_wrapper .gfield input[type="url"]';
		$elements[] = '.gform_wrapper .gfield input[type="number"]';
		$elements[] = '.gform_wrapper .gfield input[type="password"] input[type="number"]';
		$elements[] = '.gform_wrapper .gfield input[type="password"]';
		$elements[] = '.gform_wrapper .gfield_select[multiple=multiple]';
		$elements[] = '.gform_wrapper .gfield select';
	}
	if ( defined( 'WPCF7_PLUGIN' ) ) {
		$elements[] = '.wpcf7-form .wpcf7-text';
		$elements[] = '.wpcf7-form .wpcf7-quiz';
		$elements[] = '.wpcf7-form .wpcf7-number';
		$elements[] = '.wpcf7-form .wpcf7-select';
		$elements[] = '.wpcf7-captchar';
		$elements[] = '.wpcf7-form .wpcf7-date';
	}
	if ( class_exists( 'bbPress' ) ) {
		$elements[] = '#bbpress-forums .bbp-search-form #bbp_search';
		$elements[] = '.bbp-reply-form input#bbp_topic_tags';
		$elements[] = '.bbp-topic-form input#bbp_topic_title';
		$elements[] = '.bbp-topic-form input#bbp_topic_tags';
		$elements[] = '.bbp-topic-form select#bbp_stick_topic_select';
		$elements[] = '.bbp-topic-form select#bbp_topic_status_select';
		$elements[] = '.bbp-login-form input';
	}
	if ( class_exists( 'WooCommerce' ) ) {
		$elements[] = '.aione-shipping-calculator-form .aione-select-parent select';
		$elements[] = '.shipping-calculator-form .aione-select-parent select';
		$elements[] = '.cart-collaterals .form-row input';
		$elements[] = '.cart-collaterals .aione-select-parent input';
		$elements[] = '.cart-collaterals .woocommerce-shipping-calculator #calc_shipping_postcode';
		$elements[] = '.coupon .input-text';
		$elements[] = '.checkout .input-text:not(textarea)';
		$elements[] = '.woocommerce-checkout .select2-drop-active';
	}
	if( class_exists( 'Tribe__Events__Main' ) ) {
		$elements[] = '#tribe-bar-form input[type=text]';
		$elements[] = '.tribe-bar-disabled #tribe-bar-form .tribe-bar-filters input[type=text]';
	}

	$css['global'][aione_implode( $elements )]['height'] = Aione()->theme_options[ 'form_input_height' ];
	$css['global'][aione_implode( $elements )]['padding-top'] = '0';
	$css['global'][aione_implode( $elements )]['padding-bottom'] = '0';

	$elements = array(
		'.aione-select .select2-container .select2-choice .select2-arrow',
		'.aione-select .select2-container .select2-choice2 .select2-arrow',
		'.searchform .search-table .search-button input[type="submit"]',
	);

	$css['global'][aione_implode( $elements )]['height'] = Aione()->theme_options[ 'form_input_height' ];
	$css['global'][aione_implode( $elements )]['width'] = Aione()->theme_options[ 'form_input_height' ];
	$css['global'][aione_implode( $elements )]['line-height'] = Aione()->theme_options[ 'form_input_height' ];

	$css['global']['.select2-container .select2-choice > .select2-chosen']['line-height'] = Aione()->theme_options[ 'form_input_height' ];

	$elements = array( '.select-arrow', '.select2-arrow' );
	$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'form_border_color' ], Aione()->settings->get_default( 'form_border_color' ) );

	if ( class_exists( 'GFForms' ) ) {
		$css['global']['.gfield_time_ampm .gravity-select-parent']['width'] = 'auto !important';
		$css['global']['.gfield_time_ampm .gravity-select-parent select']['min-width'] = 'calc(' . Aione()->theme_options[ 'form_input_height' ] . '*2) !important';
	}

	$height_fraction = intval( Aione()->theme_options[ 'form_input_height' ] ) / 35;
	if ( 1 < $height_fraction ) {
		$css['global']['.oxo-main-menu .oxo-main-menu-search .oxo-custom-menu-item-contents']['width'] = 250 + 50 * $height_fraction . 'px';
	}

	if ( Aione()->theme_options[ 'aione_styles_dropdowns' ] ) {

		$css['global']['select']['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'form_border_color' ], Aione()->settings->get_default( 'form_border_color' ) );
		$css['global']['select']['color']            = Aione_Sanitize::color( Aione()->theme_options[ 'form_text_color' ], Aione()->settings->get_default( 'form_text_color' ) );
		$css['global']['select']['border']           = '1px solid ' . Aione_Sanitize::color( Aione()->theme_options[ 'form_border_color' ], Aione()->settings->get_default( 'form_border_color' ) );
		$css['global']['select']['font-size']        = '13px';
		$css['global']['select']['height']           = '35px';
		$css['global']['select']['text-indent']      = '5px';
		$css['global']['select']['width']            = '100%';

		$css['global']['select::-webkit-input-placeholder']['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'form_text_color' ], Aione()->settings->get_default( 'form_text_color' ) );
		$css['global']['select:-moz-placeholder']['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'form_text_color' ], Aione()->settings->get_default( 'form_text_color' ) );
	}



	if ( Aione()->theme_options[ 'page_title_font_size' ] ) {
		$css['global']['.oxo-page-title-bar h1']['font-size']   = intval( Aione()->theme_options[ 'page_title_font_size' ] ) . 'px';
	}
	$css['global']['.oxo-page-title-bar h1']['line-height']     = 'normal';

	if ( Aione()->theme_options[ 'page_title_subheader_font_size' ] ) {
		$css['global']['.oxo-page-title-bar h3']['font-size']   = intval( Aione()->theme_options[ 'page_title_subheader_font_size' ] ) . 'px';
		$css['global']['.oxo-page-title-bar h3']['line-height'] = intval( Aione()->theme_options[ 'page_title_subheader_font_size' ] ) + 12 . 'px';
	}

	if ( false !== strpos( Aione()->theme_options['site_width'], 'px' ) ) {
		$margin      = '80px';
		$half_margin = '40px';
	} else {
		$margin      = '6%';
		$half_margin = '3%';
	}

	/**
	 * Single-sidebar Layouts
	 */
	$sidebar_width = Aione()->theme_options[ 'sidebar_width' ];
	if ( false === strpos( $sidebar_width, 'px' ) && false === strpos( $sidebar_width, '%' ) ) {
		$sidebar_width = ( 100 > intval( $sidebar_width ) ) ? intval( $sidebar_width ) . '%' : intval( $sidebar_width ) . 'px';
	}
	$css['global']['body.has-sidebar #content']['width']       = 'calc(100% - ' . $sidebar_width . ' - ' . $margin . ')';
	$css['global']['body.has-sidebar #main .sidebar']['width'] = $sidebar_width;
	/**
	 * Double-Sidebar layouts
	 */
	$sidebar_2_1_width = Aione()->theme_options[ 'sidebar_2_1_width' ];
	
	if ( false === strpos( $sidebar_2_1_width, 'px' ) && false === strpos( $sidebar_2_1_width, '%' ) ) {
		$sidebar_2_1_width = ( 100 > intval( $sidebar_2_1_width ) ) ? intval( $sidebar_2_1_width ) . '%' : intval( $sidebar_2_1_width ) . 'px';
	}
	$sidebar_2_2_width = Aione()->theme_options[ 'sidebar_2_2_width' ];
	if ( false === strpos( $sidebar_2_2_width, 'px' ) && false === strpos( $sidebar_2_2_width, '%' ) ) {
		$sidebar_2_2_width = ( 100 > intval( $sidebar_2_2_width ) ) ? intval( $sidebar_2_2_width ) . '%' : intval( $sidebar_2_2_width ) . 'px';
	}
	$css['global']['body.has-sidebar.double-sidebars #content']['width']               = 'calc(100% - ' . $sidebar_2_1_width . ' - ' . $sidebar_2_2_width . ' - ' . $margin . ')';
	$css['global']['body.has-sidebar.double-sidebars #content']['margin-left']         = 'calc(' . $sidebar_2_1_width . ' + ' . $half_margin . ')';
	$css['global']['body.has-sidebar.double-sidebars #main #sidebar']['width']         = $sidebar_2_1_width;
	$css['global']['body.has-sidebar.double-sidebars #main #sidebar']['margin-left']   = 'calc(' . $half_margin . ' - (100% - ' . $sidebar_2_2_width . '))';
	$css['global']['body.has-sidebar.double-sidebars #main #sidebar-2']['width']       = $sidebar_2_2_width;
	$css['global']['body.has-sidebar.double-sidebars #main #sidebar-2']['margin-left'] = $half_margin;

	if ( class_exists( 'Tribe__Events__Main' ) ) {
		$sidebar_width = Aione()->theme_options[ 'ec_sidebar_width' ];
		if ( false !== strpos( $sidebar_width, 'px' ) && false !== strpos( $sidebar_width, '%' ) ) {
			$sidebar_width = ( 100 > intval( $sidebar_width ) ) ? intval( $sidebar_width ) . '%' : intval( $sidebar_width ) . 'px';
		}
		if ( tribe_get_option( 'tribeEventsTemplate', 'default' ) != '100-width.php' ) {
			$css['global']['.single-tribe_events #content']['width'] = 'calc(100% - ' . $sidebar_width . ' - ' . $margin . ')';
			$css['global']['.single-tribe_events #main .sidebar']['width'] = $sidebar_width;
		}
		/**
		 * Single-sidebar Layouts
		 */
		$css['global']['body.has-sidebar.single-tribe_events #content']['width']       = 'calc(100% - ' . $sidebar_width . ' - ' . $margin . ')';
		$css['global']['body.has-sidebar.single-tribe_events #main .sidebar']['width'] = $sidebar_width;
		/**
		 * Double-Sidebar layouts
		 */
		$sidebar_2_1_width = Aione()->theme_options[ 'ec_sidebar_2_1_width' ];
		if ( false === strpos( $sidebar_2_1_width, 'px' ) && false === strpos( $sidebar_2_1_width, '%' ) ) {
			$sidebar_2_1_width = ( 100 > intval( $sidebar_2_1_width ) ) ? intval( $sidebar_2_1_width ) . '%' : intval( $sidebar_2_1_width ) . 'px';
		}
		$sidebar_2_2_width = Aione()->theme_options[ 'ec_sidebar_2_2_width' ];
		if ( false === strpos( $sidebar_2_2_width, 'px' ) && false === strpos( $sidebar_2_2_width, '%' ) ) {
			$sidebar_2_2_width = ( 100 > intval( $sidebar_2_2_width ) ) ? intval( $sidebar_2_2_width ) . '%' : intval( $sidebar_2_2_width ) . 'px';
		}
		$css['global']['body.has-sidebar.double-sidebars.single-tribe_events #content']['width']               = 'calc(100% - ' . $sidebar_2_1_width . ' - ' . $sidebar_2_2_width . ' - ' . $margin . ')';
		$css['global']['body.has-sidebar.double-sidebars.single-tribe_events #content']['margin-left']         = 'calc(' . $sidebar_2_1_width . ' + ' . $half_margin . ')';
		$css['global']['body.has-sidebar.double-sidebars.single-tribe_events #main #sidebar']['width']         = $sidebar_2_1_width;
		$css['global']['body.has-sidebar.double-sidebars.single-tribe_events #main #sidebar']['margin-left']   = 'calc(' . $half_margin . ' - (100% - ' . $sidebar_2_2_width . '))';
		$css['global']['body.has-sidebar.double-sidebars.single-tribe_events #main #sidebar-2']['width']       = $sidebar_2_2_width;
		$css['global']['body.has-sidebar.double-sidebars.single-tribe_events #main #sidebar-2']['margin-left'] = $half_margin;
	}

	//$css['global']['#main .sidebar']['background-color'] = Aione()->theme_options[ 'sidebar_bg_color' ];
	$css['global']['#main .sidebar']['padding']          = Aione_Sanitize::size( Aione()->theme_options['sidebar_padding'] );

	if ( class_exists( 'Tribe__Events__Main' ) ) {
		$css['global']['.single-tribe_events #main .sidebar']['background-color'] = Aione()->theme_options[ 'ec_sidebar_bg_color' ];
		$css['global']['.single-tribe_events #main .sidebar']['padding']          = Aione_Sanitize::size( Aione()->theme_options[ 'ec_sidebar_padding' ] );
	}

	$css['global']['.oxo-accordian .panel-title a .fa-oxo-box']['background-color'] = Aione()->theme_options[ 'accordian_inactive_color' ];

	$css['global']['.progress-bar-content']['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'counter_filled_color' ], Aione()->settings->get_default( 'counter_filled_color' ) );
	$css['global']['.progress-bar-content']['border-color']     = Aione_Sanitize::color( Aione()->theme_options[ 'counter_filled_color' ], Aione()->settings->get_default( 'counter_filled_color' ) );

	$css['global']['.content-box-percentage']['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'counter_filled_color' ], Aione()->settings->get_default( 'counter_filled_color' ) );

	$css['global']['.progress-bar']['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'counter_unfilled_color' ], Aione()->settings->get_default( 'counter_unfilled_color' ) );
	$css['global']['.progress-bar']['border-color']     = Aione_Sanitize::color( Aione()->theme_options[ 'counter_unfilled_color' ], Aione()->settings->get_default( 'counter_unfilled_color' ) );

	$css['global']['#wrapper .oxo-date-and-formats .oxo-format-box, .tribe-mini-calendar-event .list-date .list-dayname']['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'dates_box_color' ], Aione()->settings->get_default( 'dates_box_color' ) );

	$elements = array(
		'.oxo-carousel .oxo-carousel-nav .oxo-nav-prev',
		'.oxo-carousel .oxo-carousel-nav .oxo-nav-next',
	);
	$css['global'][aione_implode( $elements )]['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'carousel_nav_color' ], Aione()->settings->get_default( 'carousel_nav_color' ) );

	$elements = aione_map_selector( $elements, ':hover' );
	$css['global'][aione_implode( $elements )]['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'carousel_hover_color' ], Aione()->settings->get_default( 'carousel_hover_color' ) );

	$elements = array(
		'.oxo-flexslider .flex-direction-nav .flex-prev',
		'.oxo-flexslider .flex-direction-nav .flex-next',
	);
	$css['global'][aione_implode( $elements )]['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'carousel_nav_color' ], Aione()->settings->get_default( 'carousel_nav_color' ) );

	$elements = aione_map_selector( $elements, ':hover' );
	$css['global'][aione_implode( $elements )]['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'carousel_hover_color' ], Aione()->settings->get_default( 'carousel_hover_color' ) );

	$css['global']['.content-boxes .col']['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'content_box_bg_color' ], Aione()->settings->get_default( 'content_box_bg_color' ) );

	$css['global']['#wrapper .oxo-content-widget-area .oxo-tabs-widget .tabs-container']['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'tabs_bg_color' ], Aione()->settings->get_default( 'tabs_bg_color' ) );
	$css['global']['body .oxo-content-widget-area .oxo-tabs-widget .tab-hold .tabs li']['border-right'] = '1px solid ' . Aione_Sanitize::color( Aione()->theme_options[ 'tabs_bg_color' ], Aione()->settings->get_default( 'tabs_bg_color' ) );
	if ( is_rtl() ) {
		$css['global']['body.rtl #wrapper .oxo-content-widget-area .oxo-tabs-widget .tab-hold .tabset li']['border-left-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'tabs_bg_color' ], Aione()->settings->get_default( 'tabs_bg_color' ) );
	}

	$elements = array(
		'body .oxo-content-widget-area .oxo-tabs-widget .tab-holder .tabs li a',
		'.oxo-content-widget-area .oxo-tabs-widget .tab-holder .tabs li a',
	);
	$css['global'][aione_implode( $elements )]['background']    = Aione_Sanitize::color( Aione()->theme_options[ 'tabs_inactive_color' ], Aione()->settings->get_default( 'tabs_inactive_color' ) );
	$css['global'][aione_implode( $elements )]['border-bottom'] = '0';
	$css['global'][aione_implode( $elements )]['color']         = Aione_Sanitize::color( Aione()->theme_options[ 'body_text_color' ], Aione()->settings->get_default( 'body_text_color' ) );

	$css['global']['body .oxo-content-widget-area .oxo-tabs-widget .tab-hold .tabs li a:hover']['background']    = Aione_Sanitize::color( Aione()->theme_options[ 'tabs_bg_color' ], Aione()->settings->get_default( 'tabs_bg_color' ) );
	$css['global']['body .oxo-content-widget-area .oxo-tabs-widget .tab-hold .tabs li a:hover']['border-bottom'] = '0';

	$elements = array(
		'body .oxo-content-widget-area .oxo-tabs-widget .tab-hold .tabs li.active a',
		'body .oxo-content-widget-area .oxo-tabs-widget .tab-holder .tabs li.active a'
	);
	$css['global'][aione_implode( $elements )]['background']       = Aione_Sanitize::color( Aione()->theme_options[ 'tabs_bg_color' ], Aione()->settings->get_default( 'tabs_bg_color' ) );
	$css['global'][aione_implode( $elements )]['border-bottom']    = '0';
	$css['global'][aione_implode( $elements )]['border-top-color'] = Aione_Sanitize::color( Aione()->theme_options['primary_color'], Aione()->settings->get_default( 'primary_color' ) );

	$elements = array(
		'#wrapper .oxo-content-widget-area .oxo-tabs-widget .tab-holder',
		'.oxo-content-widget-area .oxo-tabs-widget .tab-holder .news-list li',
	);
	$css['global'][aione_implode( $elements )]['border-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'tabs_border_color' ], Aione()->settings->get_default( 'tabs_border_color' ) );

	$css['global']['.oxo-single-sharing-box']['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'social_bg_color' ], Aione()->settings->get_default( 'social_bg_color' ) );
	if ( Aione()->theme_options[ 'social_bg_color' ] == 'transparent' ) {
		$css['global']['.oxo-single-sharing-box']['padding'] = '0';
	}

	$elements = array(
		'.oxo-blog-layout-grid .post .oxo-post-wrapper',
		'.oxo-blog-layout-timeline .post',
		'.oxo-portfolio.oxo-portfolio-boxed .oxo-portfolio-content-wrapper',
		'.products li.product',
		'.oxo-events-shortcode .oxo-layout-column'
	);
	$css['global'][aione_implode( $elements )]['background-color'] = Aione()->theme_options[ 'timeline_bg_color' ] ? Aione_Sanitize::color( Aione()->theme_options[ 'timeline_bg_color' ] ) : 'transparent';

	if ( Aione()->theme_options[ 'timeline_bg_color' ] != 'transparent' && Aione()->theme_options[ 'timeline_bg_color' ] ) {
		$css['global']['.oxo-events-shortcode .oxo-events-meta']['padding'] = '20px';
	}

	$elements = array(
		'.oxo-blog-layout-grid .post .flexslider',
		'.oxo-blog-layout-grid .post .oxo-post-wrapper',
		'.oxo-blog-layout-grid .post .oxo-content-sep',
		'.products li',
		'.product-details-container',
		'.product-buttons',
		'.product-buttons-container',
		'.product .product-buttons',
		'.oxo-blog-layout-timeline .oxo-timeline-line',
		'.oxo-blog-timeline-layout .post',
		'.oxo-blog-timeline-layout .post .oxo-content-sep',
		'.oxo-blog-timeline-layout .post .flexslider',
		'.oxo-blog-layout-timeline .post',
		'.oxo-blog-layout-timeline .post .oxo-content-sep',
		'.oxo-portfolio.oxo-portfolio-boxed .oxo-portfolio-content-wrapper',
		'.oxo-portfolio.oxo-portfolio-boxed .oxo-content-sep',
		'.oxo-blog-layout-timeline .post .flexslider',
		'.oxo-blog-layout-timeline .oxo-timeline-date',
		'.oxo-events-shortcode .oxo-layout-column',
		'.oxo-events-shortcode .oxo-events-thumbnail'
	);
	$css['global'][aione_implode( $elements )]['border-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'timeline_color' ], Aione()->settings->get_default( 'timeline_color' ) );

	$elements = array(
		'.oxo-blog-layout-timeline .oxo-timeline-circle',
		'.oxo-blog-layout-timeline .oxo-timeline-date',
		'.oxo-blog-timeline-layout .oxo-timeline-circle',
		'.oxo-blog-timeline-layout .oxo-timeline-date'
	);
	$css['global'][aione_implode( $elements )]['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'timeline_color' ], Aione()->settings->get_default( 'timeline_color' ) );

	$elements = array(
		'.oxo-timeline-icon',
		'.oxo-timeline-arrow:before',
		'.oxo-blog-timeline-layout .oxo-timeline-icon',
		'.oxo-blog-timeline-layout .oxo-timeline-arrow:before'
	);
	$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'timeline_color' ], Aione()->settings->get_default( 'timeline_color' ) );

	$elements = array(
		'div.indicator-hint'
	);
	if ( class_exists( 'bbPress' ) ) {
		$elements[] = '#bbpress-forums li.bbp-header';
		$elements[] = '#bbpress-forums div.bbp-reply-header';
		$elements[] = '#bbpress-forums #bbp-single-user-details #bbp-user-navigation li.current a';
		$elements[] = 'div.bbp-template-notice';
		$elements[] = '#bbpress-forums .bbp-search-results .bbp-forum-header';
		$elements[] = '#bbpress-forums .bbp-search-results .bbp-topic-header';

	}
	$css['global'][aione_implode( $elements )]['background'] = Aione_Sanitize::color( Aione()->theme_options[ 'bbp_forum_header_bg' ], Aione()->settings->get_default( 'bbp_forum_header_bg' ) );

	if ( class_exists( 'bbPress' ) ) {
		$elements = array(
			'#bbpress-forums .forum-titles li',
			'span.bbp-admin-links',
			'span.bbp-admin-links a',
			'.bbp-forum-header a.bbp-forum-permalink',
			'.bbp-reply-header a.bbp-reply-permalink',
			'.bbp-topic-header a.bbp-topic-permalink'
		);
		$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'bbp_forum_header_font_color' ] );

		$css['global']['#bbpress-forums .bbp-replies div.even']['background'] = 'transparent';
	}

	$elements = array( 'div.indicator-hint' );
	if ( class_exists( 'bbPress' ) ) {
		$elements[] = '#bbpress-forums ul.bbp-lead-topic';
		$elements[] = '#bbpress-forums ul.bbp-topics';
		$elements[] = '#bbpress-forums ul.bbp-forums';
		$elements[] = '#bbpress-forums ul.bbp-replies';
		$elements[] = '#bbpress-forums ul.bbp-search-results';
		$elements[] = '#bbpress-forums li.bbp-body ul.forum';
		$elements[] = '#bbpress-forums li.bbp-body ul.topic';
		$elements[] = '#bbpress-forums div.bbp-reply-content';
		$elements[] = '#bbpress-forums div.bbp-reply-header';
		$elements[] = '#bbpress-forums div.bbp-reply-author .bbp-reply-post-date';
		$elements[] = '#bbpress-forums div.bbp-topic-tags a';
		$elements[] = '#bbpress-forums #bbp-single-user-details';
		$elements[] = 'div.bbp-template-notice';
		$elements[] = '.bbp-arrow';
		$elements[] = '#bbpress-forums .bbp-search-results .bbp-forum-content';
		$elements[] = '#bbpress-forums .bbp-search-results .bbp-topic-content';
	}
	$css['global'][aione_implode( $elements )]['border-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'bbp_forum_border_color' ], Aione()->settings->get_default( 'bbp_forum_border_color' ) );

	if ( 'Dark' == Aione()->theme_options['scheme_type'] ) {

		$css['global']['.oxo-rollover .price .amount']['color'] = '#333333';
		$css['global']['.meta li']['border-color']   = Aione_Sanitize::color( Aione()->theme_options[ 'body_text_color' ], Aione()->settings->get_default( 'body_text_color' ) );
		$css['global']['.error_page .oops']['color'] = '#2F2F30';

		if ( class_exists( 'bbPress' ) ) {
			$elements = array( '.bbp-arrow', '#bbpress-forums .quicktags-toolbar' );
			$css['global'][aione_implode( $elements )]['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'content_bg_color' ], Aione()->settings->get_default( 'content_bg_color' ) );
		}

		$css['global']['#toTop']['background-color'] = '#111111';

		$css['global']['.chzn-container-single .chzn-single']['background-image'] = 'none';
		$css['global']['.chzn-container-single .chzn-single']['box-shadow']       = 'none';

		$elements = array( '.catalog-ordering a', '.order-dropdown > li:after', '.order-dropdown ul li a' );
		$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'form_text_color' ], Aione()->settings->get_default( 'form_text_color' ) );

		$elements = array(
			'.order-dropdown li',
			'.order-dropdown .current-li',
			'.order-dropdown > li:after',
			'.order-dropdown ul li a',
			'.catalog-ordering .order li a',
			'.order-dropdown li',
			'.order-dropdown .current-li',
			'.order-dropdown ul',
			'.order-dropdown ul li a',
			'.catalog-ordering .order li a'
		);
		$css['global'][aione_implode( $elements )]['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'form_bg_color' ], Aione()->settings->get_default( 'form_bg_color' ) );

		$elements = array(
			'.order-dropdown li:hover',
			'.order-dropdown .current-li:hover',
			'.order-dropdown ul li a:hover',
			'.catalog-ordering .order li a:hover'
		);
		$css['global'][aione_implode( $elements )]['background-color'] = '#29292A';

		if ( class_exists( 'bbPress' ) ) {

			$elements = array(
				'.bbp-topics-front ul.super-sticky',
				'.bbp-topics ul.super-sticky',
				'.bbp-topics ul.sticky',
				'.bbp-forum-content ul.sticky'
			);
			$css['global'][aione_implode( $elements )]['background-color'] = '#3E3E3E';

			$elements = array(
				'.bbp-topics-front ul.super-sticky a',
				'.bbp-topics ul.super-sticky a',
				'.bbp-topics ul.sticky a',
				'.bbp-forum-content ul.sticky a'
			);
			$css['global'][aione_implode( $elements )]['color'] = '#FFFFFF';

		}

		$elements = array(
			'.pagination-prev:before',
			'.pagination-next:after',
		);
		if ( class_exists( 'WooCommerce' ) ) {
			$elements[] = '.woocommerce-pagination .prev:before';
			$elements[] = '.woocommerce-pagination .next:after';
		}
		$css['global'][aione_implode( $elements )]['color'] = '#747474';

		$elements = array( '.table-1 table', '.tkt-slctr-tbl-wrap-dv table' );
		$css['global'][aione_implode( $elements )]['background-color']   = '#313132';
		$css['global'][aione_implode( $elements )]['box-shadow']         = '0 1px 3px rgba(0, 0, 0, 0.08), inset 0 0 0 1px rgba(62, 62, 62, 0.5)';

		$elements = array(
			'.table-1 table th',
			'.tkt-slctr-tbl-wrap-dv table th',
			'.table-1 tbody tr:nth-child(2n)',
			'.tkt-slctr-tbl-wrap-dv tbody tr:nth-child(2n)'
		);
		$css['global'][aione_implode( $elements )]['background-color'] = '#212122';

	}

	if ( Aione()->theme_options[ 'blog_grid_column_spacing' ] || '0' === Aione()->theme_options[ 'blog_grid_column_spacing' ] ) {

		$css['global']['#posts-container.oxo-blog-layout-grid']['margin'] = '-' . intval( Aione()->theme_options[ 'blog_grid_column_spacing' ] / 2 ) . 'px -' . intval( Aione()->theme_options[ 'blog_grid_column_spacing' ] / 2 ) . 'px 0 -' . intval( Aione()->theme_options[ 'blog_grid_column_spacing' ] / 2 ) . 'px';

		$css['global']['#posts-container.oxo-blog-layout-grid .oxo-post-grid']['padding'] = intval( Aione()->theme_options[ 'blog_grid_column_spacing' ] / 2 ) . 'px';

	}

	$css['global']['.quicktags-toolbar input']['background'][]     = 'linear-gradient(to top, ' . Aione_Sanitize::color( Aione()->theme_options[ 'content_bg_color' ], Aione()->settings->get_default( 'content_bg_color' ) ) . ', ' . Aione_Sanitize::color( Aione()->theme_options[ 'form_bg_color' ], Aione()->settings->get_default( 'form_bg_color' ) ) . ' ) #3E3E3E';
	$css['global']['.quicktags-toolbar input']['background-image'] = '-webkit-gradient( linear, left top, left bottom, color-stop(0, ' . Aione_Sanitize::color( Aione()->theme_options[ 'form_bg_color' ], Aione()->settings->get_default( 'form_bg_color' ) ) . '), color-stop(1, ' . Aione_Sanitize::color( Aione()->theme_options[ 'content_bg_color' ], Aione()->settings->get_default( 'content_bg_color' ) ) . '))';
	$css['global']['.quicktags-toolbar input']['filter']           = 'progid:DXImageTransform.Microsoft.gradient(startColorstr=' . Aione_Sanitize::color( Aione()->theme_options[ 'form_bg_color' ], Aione()->settings->get_default( 'form_bg_color' ) ) . ', endColorstr=' . Aione_Sanitize::color( Aione()->theme_options[ 'content_bg_color' ], Aione()->settings->get_default( 'content_bg_color' ) ) . '), progid: DXImageTransform.Microsoft.Alpha(Opacity=0)';
	$css['global']['.quicktags-toolbar input']['border']           = '1px solid ' . Aione_Sanitize::color( Aione()->theme_options[ 'form_border_color' ], Aione()->settings->get_default( 'form_border_color' ) );
	$css['global']['.quicktags-toolbar input']['color']            = Aione_Sanitize::color( Aione()->theme_options[ 'form_text_color' ], Aione()->settings->get_default( 'form_text_color' ) );

	$css['global']['.quicktags-toolbar input:hover']['background'] = Aione_Sanitize::color( Aione()->theme_options[ 'form_bg_color' ], Aione()->settings->get_default( 'form_bg_color' ) );

	if ( ! Aione()->theme_options[ 'image_rollover' ] ) {
		$css['global']['.oxo-rollover']['display'] = 'none';
	}

	if ( Aione()->theme_options[ 'image_rollover_direction' ] != 'left' ) {

		switch ( Aione()->theme_options[ 'image_rollover_direction' ] ) {

			case 'fade' :
				$image_rollover_direction_value = 'translateY(0%)';
				$image_rollover_direction_hover_value = '';

				$css['global']['.oxo-image-wrapper .oxo-rollover']['transition'] = 'opacity 0.5s ease-in-out';
				break;
			case 'right' :
				$image_rollover_direction_value       = 'translateX(100%)';
				$image_rollover_direction_hover_value = '';
				break;
			case 'bottom' :
				$image_rollover_direction_value       = 'translateY(100%)';
				$image_rollover_direction_hover_value = 'translateY(0%)';
				break;
			case 'top' :
				$image_rollover_direction_value       = 'translateY(-100%)';
				$image_rollover_direction_hover_value = 'translateY(0%)';
				break;
			case 'center_horiz' :
				$image_rollover_direction_value       = 'scaleX(0)';
				$image_rollover_direction_hover_value = 'scaleX(1)';
				break;
			case 'center_vertical' :
				$image_rollover_direction_value       = 'scaleY(0)';
				$image_rollover_direction_hover_value = 'scaleY(1)';
				break;
			default:
				$image_rollover_direction_value       = 'scaleY(0)';
				$image_rollover_direction_hover_value = 'scaleY(1)';
				break;
		}

		$css['global']['.oxo-image-wrapper .oxo-rollover']['transform'] = $image_rollover_direction_value;

		if ( '' != $image_rollover_direction_hover_value ) {
			$css['global']['.oxo-image-wrapper:hover .oxo-rollover']['transform'] = $image_rollover_direction_hover_value;
		}
	}

	$css['global']['.ei-slider']['width']  = Aione_Sanitize::size( Aione()->theme_options[ 'tfes_slider_width' ] );
	$css['global']['.ei-slider']['height'] = Aione_Sanitize::size( Aione()->theme_options[ 'tfes_slider_height' ] );

	/**
	 * Buttons
	 */

	$elements = array(
		'.button.default',
		'.oxo-button.oxo-button-default',
		'.post-password-form input[type="submit"]',
		'#comment-submit',
		'#reviews input#submit',
		'.ticket-selector-submit-btn[type="submit"]',
	);
	if ( class_exists( 'GFForms' ) ) {
		$elements[] = '.gform_wrapper .gform_button';
		$elements[] = '.gform_wrapper .button';
		$elements[] = '.gform_page_footer input[type="button"]';
	}
	if ( defined( 'WPCF7_PLUGIN' ) ) {
		$elements[] = '.wpcf7-form input[type="submit"]';
		$elements[] = '.wpcf7-submit';
	}
	if ( class_exists( 'bbPress' ) ) {
		$elements[] = '.bbp-submit-wrapper button';
		$elements[] = '.bbp-submit-wrapper .button';
		$elements[] = '#bbp_user_edit_submit';
	}
	if ( class_exists( 'WooCommerce' ) ) {
		$elements[] = '.woocommerce .checkout #place_order';
		$elements[] = '.woocommerce .single_add_to_cart_button';
		$elements[] = '.woocommerce button.button';
		$elements[] = '.woocommerce .login .button';
		$elements[] = '.woocommerce .register .button';
	}
	if( class_exists( 'Tribe__Events__Main' ) ) {
		$elements[] = '#tribe-bar-form .tribe-bar-submit input[type=submit]';
		$elements[] = '#tribe-events .tribe-events-button';
		$elements[] = '#tribe_events_filter_control #tribe_events_filters_toggle';
		$elements[] = '#tribe_events_filter_control #tribe_events_filters_reset';
	}
	$css['global'][aione_implode( $elements )]['border-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'button_accent_color' ], Aione()->settings->get_default( 'button_accent_color' ) );

	$elements = aione_map_selector( $elements, ':hover' );
	$css['global'][aione_implode( $elements )]['border-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'button_accent_hover_color' ], Aione()->settings->get_default( 'button_accent_hover_color' ) );

	$button_size = strtolower( esc_attr( Aione()->theme_options[ 'button_size' ] ) );

	$elements = array(
		'.button.default',
		'.oxo-button-default',
		'.post-password-form input[type="submit"]'
	);
	if ( class_exists( 'GFForms' ) ) {
		$elements[] = '.oxo-body #main .gform_wrapper .gform_button';
		$elements[] = '.oxo-body #main .gform_wrapper .button';
		$elements[] = '.oxo-body #main .gform_wrapper .gform_footer .gform_button';
	}
	if ( defined( 'WPCF7_PLUGIN' ) ) {
		$elements[] = '.wpcf7-form input[type="submit"]';
		$elements[] = '.wpcf7-submit';
	}
	if ( class_exists( 'WooCommerce' ) ) {
		$elements[] = '.woocommerce .checkout #place_order';
		$elements[] = '.woocommerce #wrapper .single_add_to_cart_button';
		$elements[] = '.woocommerce .aione-shipping-calculator-form .button';
	}
	if ( class_exists( 'Tribe__Events__Main' ) ) {
		$elements[] = '#tribe-events .tribe-events-button';
		$elements[] = '#tribe_events_filter_control #tribe_events_filters_toggle';
		$elements[] = '#tribe_events_filter_control #tribe_events_filters_reset';
	}

	switch ( $button_size ) {

		case 'small' :
			$css['global'][aione_implode( $elements )]['padding']     = '9px 20px';
			$css['global'][aione_implode( $elements )]['line-height'] = '14px';
			$css['global'][aione_implode( $elements )]['font-size']   = '12px';
			if ( '3d' == Aione()->theme_options[ 'button_type' ] ) {
				$css['global'][aione_implode( $elements )]['box-shadow'] = 'inset 0px 1px 0px #ffffff, 0px 2px 0px ' . Aione_Sanitize::color( Aione()->theme_options[ 'button_bevel_color' ], Aione()->settings->get_default( 'button_bevel_color' ) ) . ', 1px 4px 4px 2px rgba(0, 0, 0, 0.3)';
			}
			break;

		case 'medium' :
			$css['global'][aione_implode( $elements )]['padding']     = '11px 23px';
			$css['global'][aione_implode( $elements )]['line-height'] = '16px';
			$css['global'][aione_implode( $elements )]['font-size']   = '13px';
			if ( '3d' == Aione()->theme_options[ 'button_type' ] ) {
				$css['global'][aione_implode( $elements )]['box-shadow'] = 'inset 0px 1px 0px #ffffff, 0px 3px 0px ' . Aione_Sanitize::color( Aione()->theme_options[ 'button_bevel_color' ], Aione()->settings->get_default( 'button_bevel_color' ) ) . ', 1px 5px 5px 3px rgba(0, 0, 0, 0.3)';
			}
			break;

		case 'large' :
			$css['global'][aione_implode( $elements )]['padding']     = '13px 29px';
			$css['global'][aione_implode( $elements )]['line-height'] = '17px';
			$css['global'][aione_implode( $elements )]['font-size']   = '14px';
			if ( '3d' == Aione()->theme_options[ 'button_type' ] ) {
				$css['global'][aione_implode( $elements )]['box-shadow'] = 'inset 0px 1px 0px #ffffff, 0px 4px 0px ' . Aione_Sanitize::color( Aione()->theme_options[ 'button_bevel_color' ], Aione()->settings->get_default( 'button_bevel_color' ) ) . ', 1px 6px 6px 3px rgba(0, 0, 0, 0.3)';
			}
			break;

		case 'xlarge' :
			$css['global'][aione_implode( $elements )]['padding']     = '17px 40px';
			$css['global'][aione_implode( $elements )]['line-height'] = '21px';
			$css['global'][aione_implode( $elements )]['font-size']   = '18px';
			if ( '3d' == Aione()->theme_options[ 'button_type' ] ) {
				$css['global'][aione_implode( $elements )]['box-shadow'] = 'inset 0px 1px 0px #ffffff, 0px 5px 0px ' . Aione_Sanitize::color( Aione()->theme_options[ 'button_bevel_color' ], Aione()->settings->get_default( 'button_bevel_color' ) ) . ', 1px 7px 7px 3px rgba(0, 0, 0, 0.3)';
			}
			break;
		default : // Fallback to medium
			$css['global'][aione_implode( $elements )]['padding']     = '11px 23px';
			$css['global'][aione_implode( $elements )]['line-height'] = '16px';
			$css['global'][aione_implode( $elements )]['font-size']   = '13px';
			if ( '3d' == Aione()->theme_options[ 'button_type' ] ) {
				$css['global'][aione_implode( $elements )]['box-shadow'] = 'inset 0px 1px 0px #ffffff, 0px 3px 0px ' . Aione_Sanitize::color( Aione()->theme_options[ 'button_bevel_color' ], Aione()->settings->get_default( 'button_bevel_color' ) ) . ', 1px 5px 5px 3px rgba(0, 0, 0, 0.3)';
			}

	}

	$elements = array(
		'.button.default.button-3d.button-small',
		'.oxo-button.button-small.button-3d',
		'.ticket-selector-submit-btn[type="submit"]',
		'.oxo-button.oxo-button-3d.oxo-button-small'
	);
	$css['global'][aione_implode( $elements )]['box-shadow'] = 'inset 0px 1px 0px #ffffff, 0px 2px 0px ' . Aione_Sanitize::color( Aione()->theme_options[ 'button_bevel_color' ], Aione()->settings->get_default( 'button_bevel_color' ) ) . ', 1px 4px 4px 2px rgba(0, 0, 0, 0.3)';

	$elements = aione_map_selector( $elements, ':active' );
	$css['global'][aione_implode( $elements )]['box-shadow'] = 'inset 0px 1px 0px #ffffff, 0px 1px 0px ' . Aione_Sanitize::color( Aione()->theme_options[ 'button_bevel_color' ], Aione()->settings->get_default( 'button_bevel_color' ) ) . ', 1px 4px 4px 2px rgba(0, 0, 0, 0.3)';

	$elements = array(
		'.button.default.button-3d.button-medium',
		'.oxo-button.button-medium.button-3d',
		'.oxo-button.oxo-button-3d.oxo-button-medium'
	);
	$css['global'][aione_implode( $elements )]['box-shadow'] = 'inset 0px 1px 0px #ffffff, 0px 3px 0px ' . Aione_Sanitize::color( Aione()->theme_options[ 'button_bevel_color' ], Aione()->settings->get_default( 'button_bevel_color' ) ) . ', 1px 5px 5px 3px rgba(0, 0, 0, 0.3)';

	$elements = aione_map_selector( $elements, ':active' );
	$css['global'][aione_implode( $elements )]['box-shadow'] = 'inset 0px 1px 0px #ffffff, 0px 1px 0px ' . Aione_Sanitize::color( Aione()->theme_options[ 'button_bevel_color' ], Aione()->settings->get_default( 'button_bevel_color' ) ) . ', 1px 5px 5px 3px rgba(0, 0, 0, 0.3)';

	$elements = array(
		'.button.default.button-3d.button-large',
		'.oxo-button.button-large.button-3d',
		'.oxo-button.oxo-button-3d.oxo-button-large'
	);
	$css['global'][aione_implode( $elements )]['box-shadow'] = 'inset 0px 1px 0px #ffffff, 0px 4px 0px ' . Aione_Sanitize::color( Aione()->theme_options[ 'button_bevel_color' ], Aione()->settings->get_default( 'button_bevel_color' ) ) . ', 1px 5px 6px 3px rgba(0, 0, 0, 0.3)';

	$elements = aione_map_selector( $elements, ':active' );
	$css['global'][aione_implode( $elements )]['box-shadow'] = 'inset 0px 1px 0px #ffffff, 0px 1px 0px ' . Aione_Sanitize::color( Aione()->theme_options[ 'button_bevel_color' ], Aione()->settings->get_default( 'button_bevel_color' ) ) . ', 1px 6px 6px 3px rgba(0, 0, 0, 0.3)';

	$elements = array(
		'.button.default.button-3d.button-xlarge',
		'.oxo-button.button-xlarge.button-3d',
		'.oxo-button.oxo-button-3d.oxo-button-xlarge'
	);
	$css['global'][aione_implode( $elements )]['box-shadow'] = 'inset 0px 1px 0px #ffffff, 0px 5px 0px ' . Aione_Sanitize::color( Aione()->theme_options[ 'button_bevel_color' ], Aione()->settings->get_default( 'button_bevel_color' ) ) . ', 1px 7px 7px 3px rgba(0, 0, 0, 0.3)';

	$elements = aione_map_selector( $elements, ':active' );
	$css['global'][aione_implode( $elements )]['box-shadow'] = 'inset 0px 1px 0px #ffffff, 0px 2px 0px ' . Aione_Sanitize::color( Aione()->theme_options[ 'button_bevel_color' ], Aione()->settings->get_default( 'button_bevel_color' ) ) . ', 1px 7px 7px 3px rgba(0, 0, 0, 0.3)';

	if ( '3d' == Aione()->theme_options[ 'button_type' ] ) {

		$elements = array(
			'.button.default.small',
			'.oxo-button.oxo-button-default.oxo-button-small',
			'.post-password-form input[type="submit"]',
			'#reviews input#submit',
			'.ticket-selector-submit-btn[type="submit"]',
		);
		if ( class_exists( 'GFForms' ) ) {
			$elements[] = '.gform_page_footer input[type="button"]';
			$elements[] = '.gform_wrapper .gform_button';
			$elements[] = '.gform_wrapper .button';
		}
		if ( defined( 'WPCF7_PLUGIN' ) ) {
			$elements[] = '.wpcf7-form input[type="submit"].oxo-button-small';
			$elements[] = '.wpcf7-submit.oxo-button-small';
		}
		if ( class_exists( 'bbPress' ) ) {
			$elements[] = '.bbp-submit-wrapper .button';
			$elements[] = '#bbp_user_edit_submit';
		}
		if ( class_exists( 'WooCommerce' ) ) {
			$elements[] = '.woocommerce .login .button';
			$elements[] = '.woocommerce .register .button';
		}
		$css['global'][aione_implode( $elements )]['box-shadow'] = 'inset 0px 1px 0px #ffffff, 0px 2px 0px ' . Aione_Sanitize::color( Aione()->theme_options[ 'button_bevel_color' ], Aione()->settings->get_default( 'button_bevel_color' ) ) . ', 1px 4px 4px 2px rgba(0, 0, 0, 0.3)';

		$elements = aione_map_selector( $elements, ':active' );
		$css['global'][aione_implode( $elements )]['box-shadow'] = 'inset 0px 1px 0px #ffffff, 0px 1px 0px ' . Aione_Sanitize::color( Aione()->theme_options[ 'button_bevel_color' ], Aione()->settings->get_default( 'button_bevel_color' ) ) . ', 1px 4px 4px 2px rgba(0, 0, 0, 0.3)';

		$elements = array(
			'.button.default.medium',
			'.oxo-button.oxo-button-default.oxo-button-medium',
			'#comment-submit',
		);
		if ( defined( 'WPCF7_PLUGIN' ) ) {
			$elements[] = '.wpcf7-form input[type="submit"].oxo-button-medium';
			$elements[] = '.wpcf7-submit.oxo-button-medium';
		}
		if ( class_exists( 'bbPress' ) ) {
			$elements[] = '.bbp-submit-wrapper .button.button-medium';
		}
		if ( class_exists( 'WooCommerce' ) ) {
			$elements[] = '.woocommerce .checkout #place_order';
			$elements[] = '.woocommerce .single_add_to_cart_button';
			$elements[] = '.woocommerce button.button';
		}
		$css['global'][aione_implode( $elements )]['box-shadow'] = 'inset 0px 1px 0px #ffffff, 0px 3px 0px ' . Aione_Sanitize::color( Aione()->theme_options[ 'button_bevel_color' ], Aione()->settings->get_default( 'button_bevel_color' ) ) . ', 1px 5px 5px 3px rgba(0, 0, 0, 0.3)';

		$elements = aione_map_selector( $elements, ':active' );
		$css['global'][aione_implode( $elements )]['box-shadow'] = 'inset 0px 1px 0px #ffffff, 0px 1px 0px ' . Aione_Sanitize::color( Aione()->theme_options[ 'button_bevel_color' ], Aione()->settings->get_default( 'button_bevel_color' ) ) . ', 1px 5px 5px 3px rgba(0, 0, 0, 0.3)';

		$elements = array(
			'.button.default.large',
			'.oxo-button.oxo-button-default.oxo-button-large',
		);
		if ( defined( 'WPCF7_PLUGIN' ) ) {
			$elements[] = '.wpcf7-form input[type="submit"].oxo-button-large';
			$elements[] = '.wpcf7-submit.oxo-button-large';
		}
		if ( class_exists( 'bbPress' ) ) {
			$elements[] = '.bbp-submit-wrapper .button.button-large';
		}
		if ( class_exists( 'Tribe__Events__Main' ) ) {
			$elements[] = '#tribe-bar-form .tribe-bar-submit input[type=submit]';
		}
		$css['global'][aione_implode( $elements )]['box-shadow'] = 'inset 0px 1px 0px #ffffff, 0px 4px 0px ' . Aione_Sanitize::color( Aione()->theme_options[ 'button_bevel_color' ], Aione()->settings->get_default( 'button_bevel_color' ) ) . ', 1px 6px 6px 3px rgba(0, 0, 0, 0.3)';

		$elements = aione_map_selector( $elements, ':active' );
		$css['global'][aione_implode( $elements )]['box-shadow'] = 'inset 0px 1px 0px #ffffff, 0px 1px 0px ' . Aione_Sanitize::color( Aione()->theme_options[ 'button_bevel_color' ], Aione()->settings->get_default( 'button_bevel_color' ) ) . ', 1px 6px 6px 3px rgba(0, 0, 0, 0.3)';

		$elements = array(
			'.button.default.xlarge',
			'.oxo-button.oxo-button-default.oxo-button-xlarge',
		);
		if ( defined( 'WPCF7_PLUGIN' ) ) {
			$elements[] = '.wpcf7-form input[type="submit"].oxo-button-xlarge';
			$elements[] = '.wpcf7-submit.oxo-button-xlarge';
		}
		if ( class_exists( 'bbPress' ) ) {
			$elements[] = '.bbp-submit-wrapper .button.button-xlarge';
		}
		$css['global'][aione_implode( $elements )]['box-shadow'] = 'inset 0px 1px 0px #ffffff, 0px 5px 0px ' . Aione_Sanitize::color( Aione()->theme_options[ 'button_bevel_color' ], Aione()->settings->get_default( 'button_bevel_color' ) ) . ', 1px 7px 7px 3px rgba(0, 0, 0, 0.3)';

		$elements = aione_map_selector( $elements, ':active' );
		$css['global'][aione_implode( $elements )]['box-shadow'] = 'inset 0px 2px 0px #ffffff, 0px 2px 0px ' . Aione_Sanitize::color( Aione()->theme_options[ 'button_bevel_color' ], Aione()->settings->get_default( 'button_bevel_color' ) ) . ', 1px 7px 7px 3px rgba(0, 0, 0, 0.3)';

	}

	$elements = array(
		'.button.default',
		'.oxo-button',
		'.button-default',
		'.oxo-button-default',
		'.post-password-form input[type="submit"]',
		'#comment-submit',
		'#reviews input#submit',
	);
	if ( class_exists( 'GFForms' ) ) {
		$elements[] = '.gform_wrapper .gform_button';
		$elements[] = '.gform_wrapper .button';
		$elements[] = '.gform_page_footer input[type="button"]';
	}
	if ( defined( 'WPCF7_PLUGIN' ) ) {
		$elements[] = '.wpcf7-form input[type="submit"]';
		$elements[] = '.wpcf7-submit';
	}
	if ( class_exists( 'bbPress' ) ) {
		$elements[] = '.bbp-submit-wrapper .button';
		$elements[] = '#bbp_user_edit_submit';
	}
	if ( class_exists( 'WooCommerce' ) ) {
		$elements[] = '.woocommerce .checkout #place_order';
		$elements[] = '.woocommerce .single_add_to_cart_button';
		$elements[] = '.woocommerce button.button';
		$elements[] = '.woocommerce .login .button';
		$elements[] = '.woocommerce .register .button';
	}
	if ( class_exists( 'Tribe__Events__Main' ) ) {
		$elements[] = '#tribe-bar-form .tribe-bar-submit input[type=submit]';
	}
	$css['global'][aione_implode( $elements )]['border-width'] = Aione_Sanitize::size( Aione()->theme_options[ 'button_border_width' ] );
	$css['global'][aione_implode( $elements )]['border-style'] = 'solid';

	$elements = array(
		'.button.default:hover',
		'.oxo-button.button-default:hover',
		'.ticket-selector-submit-btn[type="submit"]'
	);
	$css['global'][aione_implode( $elements )]['border-width'] = Aione_Sanitize::size( Aione()->theme_options[ 'button_border_width' ] );
	$css['global'][aione_implode( $elements )]['border-style'] = 'solid';

	$css['global']['.oxo-menu-item-button .menu-text']['border-color'] =  Aione()->theme_options[ 'button_accent_color' ];
	$css['global']['.oxo-menu-item-button:hover .menu-text']['border-color'] =  Aione()->theme_options[ 'button_accent_hover_color' ];

	$elements = array(
		'.button.default',
		'.button-default',
		'.oxo-button-default',
		'.post-password-form input[type="submit"]',
		'#comment-submit',
		'#reviews input#submit',
		'.ticket-selector-submit-btn[type="submit"]',
	);
	if ( class_exists( 'GFForms' ) ) {
		$elements[] = '.gform_page_footer input[type="button"]';
		$elements[] = '.gform_wrapper .gform_button';
		$elements[] = '.gform_wrapper .button';
	}
	if ( defined( 'WPCF7_PLUGIN' ) ) {
		$elements[] = '.wpcf7-form input[type="submit"]';
		$elements[] = '.wpcf7-submit';
	}
	if ( class_exists( 'bbPress' ) ) {
		$elements[] = '.bbp-submit-wrapper .button';
		$elements[] = '#bbp_user_edit_submit';

	}
	if ( class_exists( 'WooCommerce' ) ) {
		$elements[] = '.woocommerce .checkout #place_order';
		$elements[] = '.woocommerce .single_add_to_cart_button';
		$elements[] = '.woocommerce button.button';
		$elements[] = '.woocommerce .aione-shipping-calculator-form .button';
		$elements[] = '.woocommerce .login .button';
		$elements[] = '.woocommerce .register .button';
	}
	if ( class_exists( 'Tribe__Events__Main' ) ) {
		$elements[] = '#tribe-bar-form .tribe-bar-submit input[type=submit]';
	}
	if ( 'Pill' == Aione()->theme_options[ 'button_shape' ] ) {
		$css['global'][aione_implode( $elements )]['border-radius'] = '25px';
	} elseif ( 'Square' == Aione()->theme_options[ 'button_shape' ] ) {
		$css['global'][aione_implode( $elements )]['border-radius'] = '0';
	} elseif ( 'Round' == Aione()->theme_options[ 'button_shape' ] ) {
		$css['global'][aione_implode( $elements )]['border-radius'] = '2px';
	}

	if ( 'yes' == Aione()->theme_options[ 'button_span' ] ) {
		$css['global'][aione_implode( $elements )]['width'] = '100%';

		if ( class_exists( 'WooCommerce' ) ) {
			$css['global']['.woocommerce #customer_login .col-1 .login .form-row']['float'] = 'none';
			$css['global']['.woocommerce #customer_login .col-1 .login .form-row']['margin-right'] = '0';
			$css['global']['.woocommerce #customer_login .col-1 .login .button']['margin'] = '0';
			$css['global']['.woocommerce #customer_login .login .inline']['float'] = 'left';
			$css['global']['.woocommerce #customer_login .login .inline']['margin-left'] = '0';
			$css['global']['.woocommerce #customer_login .login .lost_password']['float'] = 'right';
			$css['global']['.woocommerce #customer_login .login .lost_password']['margin-top'] = '10px';

			$css['global']['.oxo-login-box-submit']['float'] = 'none';
		}

		$css['global']['.oxo-reading-box-container .oxo-desktop-button']['width'] = 'auto';
	}

	$css['global']['.reading-box']['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'tagline_bg' ], Aione()->settings->get_default( 'tagline_bg' ) );

	$css['global']['.isotope .isotope-item']['transition-property'] = 'top, left, opacity';

	if ( Aione()->theme_options[ 'link_image_rollover' ] ) {
		$css['global']['.oxo-rollover .link-icon']['display'] = 'none !important';
	}

	if ( Aione()->theme_options[ 'zoom_image_rollover' ] ) {
		$css['global']['.oxo-rollover .gallery-icon']['display'] = 'none !important';
	}

	if ( Aione()->theme_options[ 'title_image_rollover' ] ) {
		$css['global']['.oxo-rollover .oxo-rollover-title']['display'] = 'none';
	}

	if ( Aione()->theme_options[ 'cats_image_rollover' ] ) {
		$css['global']['.oxo-rollover .oxo-rollover-categories']['display'] = 'none';
	}

	if ( class_exists( 'WooCommerce' ) ) {
		if ( Aione()->theme_options[ 'woocommerce_one_page_checkout' ] ) {

			$elements = array(
				'.woocommerce .checkout #customer_details .col-1',
				'.woocommerce .checkout #customer_details .col-2'
			);
			$css['global'][aione_implode( $elements )]['box-sizing']    = 'border-box';
			$css['global'][aione_implode( $elements )]['border']        = '1px solid';
			$css['global'][aione_implode( $elements )]['overflow']      = 'hidden';
			$css['global'][aione_implode( $elements )]['padding']       = '30px';
			$css['global'][aione_implode( $elements )]['margin-bottom'] = '30px';
			$css['global'][aione_implode( $elements )]['float']         = 'left';
			$css['global'][aione_implode( $elements )]['width']         = '48%';
			$css['global'][aione_implode( $elements )]['margin-right']  = '4%';

			if ( is_rtl() ) {

				$elements = array(
					'.rtl .woocommerce form.checkout #customer_details .col-1',
					'.rtl .woocommerce form.checkout #customer_details .col-2'
				);
				$css['global'][aione_implode( $elements )]['float'] = 'right';

				$css['global']['.rtl .woocommerce form.checkout #customer_details .col-1']['margin-left']  = '4%';
				$css['global']['.rtl .woocommerce form.checkout #customer_details .col-1']['margin-right'] = 0;

			}

			$elements = array(
				'.woocommerce form.checkout #customer_details .col-1',
				'.woocommerce form.checkout #customer_details .col-2',
			);
			$css['global'][aione_implode( $elements )]['border-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'sep_color' ], Aione()->settings->get_default( 'sep_color' ) );

			$css['global']['.woocommerce form.checkout #customer_details div:last-child']['margin-right'] = '0';

			$css['global']['.woocommerce form.checkout .aione-checkout-no-shipping #customer_details .col-1']['width']        = '100%';
			$css['global']['.woocommerce form.checkout .aione-checkout-no-shipping #customer_details .col-1']['margin-right'] = '0';
			$css['global']['.woocommerce form.checkout .aione-checkout-no-shipping #customer_details .col-2']['display']      = 'none';

		} else {

			$elements = array(
				'.woocommerce form.checkout .col-2',
				'.woocommerce form.checkout #order_review_heading',
				'.woocommerce form.checkout #order_review'
			);
			$css['global'][aione_implode( $elements )]['display'] = 'none';

		}

	}

	if ( Aione()->theme_options[ 'page_title_100_width' ] ) {
		$css['global']['.layout-wide-mode .oxo-page-title-row']['max-width'] = '100%';

		if ( Aione()->theme_options[ 'header_100_width' ] ) {
			$css['global']['.layout-wide-mode .oxo-page-title-row']['padding-left']  = Aione_Sanitize::size( Aione()->theme_options[ 'padding_header_left' ] );
			$css['global']['.layout-wide-mode .oxo-page-title-row']['padding-right'] = Aione_Sanitize::size( Aione()->theme_options[ 'padding_header_right' ] );
		}
	}

	if ( 'None' != Aione()->theme_options[ 'google_button' ] ) {
		$button_font = "'" . esc_attr( Aione()->theme_options[ 'google_button' ] ) . "', Arial, Helvetica, sans-serif";
	} elseif ( 'Select Font' != Aione()->theme_options[ 'standard_button' ] ) {
		$button_font = esc_attr( Aione()->theme_options[ 'standard_button' ] );
	}

	$elements = array(
		'.oxo-button',
		'.oxo-load-more-button',
		'.comment-form input[type="submit"]',
		'.ticket-selector-submit-btn[type="submit"]'
	);
	if ( class_exists( 'GFForms' ) ) {
		$elements[] = '.gform_wrapper .gform_button';
		$elements[] = '.gform_wrapper .button';
		$elements[] = '.gform_page_footer input[type="button"]';
	}
	if ( defined( 'WPCF7_PLUGIN' ) ) {
		$elements[] = '.wpcf7-form input[type="submit"]';
	}
	if ( class_exists( 'bbPress' ) ) {
		$elements[] = '.bbp-submit-wrapper .button';
		$elements[] = '#bbp_user_edit_submit';
	}
	if ( class_exists( 'WooCommerce' ) ) {
		$elements[] = '.woocommerce .single_add_to_cart_button';
		$elements[] = '.woocommerce button.button';
		$elements[] = '.woocommerce .shipping-calculator-form .button';
		$elements[] = '.woocommerce .checkout #place_order';
		$elements[] = '.woocommerce .checkout_coupon .button';
		$elements[] = '.woocommerce .login .button';
		$elements[] = '.woocommerce .register .button';
		$elements[] = '.woocommerce .aione-order-details .order-again .button';
	}
	$css['global'][aione_implode( $elements )]['font-family'] = $button_font;
	$css['global'][aione_implode( $elements )]['font-weight'] = esc_attr( Aione()->theme_options[ 'font_weight_button' ] );
	if ( Aione()->theme_options[ 'button_font_ls' ] ) {
		$css['global'][aione_implode( $elements )]['letter-spacing'] = intval( Aione()->theme_options[ 'button_font_ls' ] ) . 'px';
	}

	$elements = array(
		'.oxo-image-wrapper .oxo-rollover .oxo-rollover-link',
		'.oxo-image-wrapper .oxo-rollover .oxo-rollover-gallery'
	);
	if ( Aione()->theme_options[ 'icon_circle_image_rollover' ] ) {
		$css['global'][aione_implode( $elements )]['background'] = 'none';
		$css['global'][aione_implode( $elements )]['width']      = round( intval( Aione()->theme_options[ 'image_rollover_icon_size' ] ) * 0.5 + intval( Aione()->theme_options[ 'image_rollover_icon_size' ] ) ) . 'px';
		$css['global'][aione_implode( $elements )]['height']     = round( intval( Aione()->theme_options[ 'image_rollover_icon_size' ] ) * 0.5 + intval( Aione()->theme_options[ 'image_rollover_icon_size' ] ) ) . 'px';
	} else {
		$css['global'][aione_implode( $elements )]['width']      = round( intval( Aione()->theme_options[ 'image_rollover_icon_size' ] ) * 1.41 + intval( Aione()->theme_options[ 'image_rollover_icon_size' ] ) ) . 'px';
		$css['global'][aione_implode( $elements )]['height']     = round( intval( Aione()->theme_options[ 'image_rollover_icon_size' ] ) * 1.41 + intval( Aione()->theme_options[ 'image_rollover_icon_size' ] ) ) . 'px';
	}

	$elements = array(
		'.oxo-image-wrapper .oxo-rollover .oxo-rollover-link:before',
		'.oxo-image-wrapper .oxo-rollover .oxo-rollover-gallery:before'
	);
	if ( Aione()->theme_options[ 'image_rollover_icon_size' ] ) {
		$css['global'][aione_implode( $elements )]['font-size']   = intval( Aione()->theme_options[ 'image_rollover_icon_size' ] ) . 'px';
		$css['global'][aione_implode( $elements )]['margin-left'] = '-' . intval( Aione()->theme_options[ 'image_rollover_icon_size' ] / 2 ) . 'px';
		if ( Aione()->theme_options[ 'icon_circle_image_rollover' ] ) {
			$css['global'][aione_implode( $elements )]['line-height'] = round( intval( Aione()->theme_options[ 'image_rollover_icon_size' ] ) * 0.5 + intval( Aione()->theme_options[ 'image_rollover_icon_size' ] ) ) . 'px';
		} else {
			$css['global'][aione_implode( $elements )]['line-height'] = round( intval( Aione()->theme_options[ 'image_rollover_icon_size' ] ) * 1.41 + intval( Aione()->theme_options[ 'image_rollover_icon_size' ] ) ) . 'px';
		}
	}
	$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'image_rollover_icon_color' ], Aione()->settings->get_default( 'image_rollover_icon_color' ) );

	/**
	 * Headings
	 */
	$elements = array( 'h1', '.oxo-title-size-one' );
	$css['global'][aione_implode( $elements )]['margin-top']    = Aione_Sanitize::size( Aione()->theme_options[ 'h1_top_margin' ] . 'em' );
	$css['global'][aione_implode( $elements )]['margin-bottom'] = Aione_Sanitize::size( Aione()->theme_options[ 'h1_bottom_margin' ] . 'em' );
	if ( Aione()->theme_options[ 'h1_font_ls' ] ) {
		$css['global'][aione_implode( $elements )]['letter-spacing'] = intval( Aione()->theme_options[ 'h1_font_ls' ] ) . 'px';
	}

	$elements = array( 'h2', '.oxo-title-size-two' );
	$css['global'][aione_implode( $elements )]['margin-top']    = Aione_Sanitize::size( Aione()->theme_options[ 'h2_top_margin' ] . 'em' );
	$css['global'][aione_implode( $elements )]['margin-bottom'] = Aione_Sanitize::size( Aione()->theme_options[ 'h2_bottom_margin' ] . 'em' );
	if ( Aione()->theme_options[ 'h2_font_ls' ] ) {
		$css['global'][aione_implode( $elements )]['letter-spacing'] = intval( Aione()->theme_options[ 'h2_font_ls' ] ) . 'px';
	}

	$elements = array( 'h3', '.oxo-title-size-three' );
	$css['global'][aione_implode( $elements )]['margin-top']    = Aione_Sanitize::size( Aione()->theme_options[ 'h3_top_margin' ] . 'em' );
	$css['global'][aione_implode( $elements )]['margin-bottom'] = Aione_Sanitize::size( Aione()->theme_options[ 'h3_bottom_margin' ] . 'em' );
	if ( Aione()->theme_options[ 'h3_font_ls' ] ) {
		$css['global'][aione_implode( $elements )]['letter-spacing'] = intval( Aione()->theme_options[ 'h3_font_ls' ] ) . 'px';
	}

	$elements = array( 'h4', '.oxo-title-size-four' );
	$css['global'][aione_implode( $elements )]['margin-top']    = Aione_Sanitize::size( Aione()->theme_options[ 'h4_top_margin' ] . 'em' );
	$css['global'][aione_implode( $elements )]['margin-bottom'] = Aione_Sanitize::size( Aione()->theme_options[ 'h4_bottom_margin' ] . 'em' );
	if ( Aione()->theme_options[ 'h4_font_ls' ] ) {
		$css['global'][aione_implode( $elements )]['letter-spacing'] = intval( Aione()->theme_options[ 'h4_font_ls' ] ) . 'px';
	}

	$elements = array( 'h5', '.oxo-title-size-five' );
	$css['global'][aione_implode( $elements )]['margin-top']    = Aione_Sanitize::size( Aione()->theme_options[ 'h5_top_margin' ] . 'em' );
	$css['global'][aione_implode( $elements )]['margin-bottom'] = Aione_Sanitize::size( Aione()->theme_options[ 'h5_bottom_margin' ] . 'em' );
	if ( Aione()->theme_options[ 'h5_font_ls' ] ) {
		$css['global'][aione_implode( $elements )]['letter-spacing'] = intval( Aione()->theme_options[ 'h5_font_ls' ] ) . 'px';
	}

	$elements = array( 'h6', '.oxo-title-size-six' );
	$css['global'][aione_implode( $elements )]['margin-top']    = Aione_Sanitize::size( Aione()->theme_options[ 'h6_top_margin' ] . 'em' );
	$css['global'][aione_implode( $elements )]['margin-bottom'] = Aione_Sanitize::size( Aione()->theme_options[ 'h6_bottom_margin' ] . 'em' );
	if ( Aione()->theme_options[ 'h6_font_ls' ] ) {
		$css['global'][aione_implode( $elements )]['letter-spacing'] = intval( Aione()->theme_options[ 'h6_font_ls' ] ) . 'px';
	}

	/**
	 * HEADER IS NUMBER 5
	 */


	/**
	 * Header Styles
	 */
	$css['global']['.oxo-logo']['margin-top']    = Aione_Sanitize::size( Aione()->theme_options[ 'margin_logo_top' ] );
	$css['global']['.oxo-logo']['margin-right']  = Aione_Sanitize::size( Aione()->theme_options[ 'margin_logo_right' ] );
	$css['global']['.oxo-logo']['margin-bottom'] = Aione_Sanitize::size( Aione()->theme_options[ 'margin_logo_bottom' ] );
	$css['global']['.oxo-logo']['margin-left']   = Aione_Sanitize::size( Aione()->theme_options[ 'margin_logo_left' ] );

	if ( Aione()->theme_options[ 'header_shadow' ] ) {

		$elements = array(
			'.oxo-header-shadow:after',
			'body.side-header-left #side-header.header-shadow .side-header-border:before',
			'body.side-header-right #side-header.header-shadow .side-header-border:before'
		);
		$css['global'][aione_implode( $elements )]['content']        = '""';
		$css['global'][aione_implode( $elements )]['z-index']        = '99996';
		$css['global'][aione_implode( $elements )]['position']       = 'absolute';
		$css['global'][aione_implode( $elements )]['left']           = '0';
		$css['global'][aione_implode( $elements )]['top']            = '0';
		$css['global'][aione_implode( $elements )]['height']         = '100%';
		$css['global'][aione_implode( $elements )]['width']          = '100%';
		$css['global'][aione_implode( $elements )]['pointer-events'] = 'none';

		$elements = array(
			'.oxo-header-shadow .oxo-mobile-menu-design-classic',
			'.oxo-header-shadow .oxo-mobile-menu-design-modern'
		);
		$css['global'][aione_implode( $elements )]['box-shadow'] = '0px 10px 50px -2px rgba(0, 0, 0, 0.14)';
		$css['global']['body.side-header-left #side-header.header-shadow .side-header-border:before']['box-shadow'] = '10px 0px 50px -2px rgba(0, 0, 0, 0.14)';
		$css['global']['body.side-header-right #side-header.header-shadow .side-header-border:before']['box-shadow'] = '-10px 0px 50px -2px rgba(0, 0, 0, 0.14)';

		$elements = array(
			'.oxo-is-sticky:before',
			'.oxo-is-sticky:after'
		);
		$css['global'][aione_implode( $elements )]['display'] = 'none';

	}

	$css['global']['.oxo-header-wrapper .oxo-row']['padding-left']  = Aione_Sanitize::size( Aione()->theme_options[ 'padding_header_left' ] );
	$css['global']['.oxo-header-wrapper .oxo-row']['padding-right'] = Aione_Sanitize::size( Aione()->theme_options[ 'padding_header_right' ] );
	$css['global']['.oxo-header-wrapper .oxo-row']['max-width']     = $site_width_with_units;

	$elements = array(
		'.oxo-header-v2 .oxo-header',
		'.oxo-header-v3 .oxo-header',
		'.oxo-header-v4 .oxo-header',
		'.oxo-header-v5 .oxo-header',
	);
	
	$header_font_option = Aione()->theme_options[ 'typography_header' ];
	
	if ( $header_font_option['font-size'] ) {
		$css['global'][aione_implode( $elements )]['font-size'] = intval( $header_font_option['font-size'] ) . 'px';
	}
	
	if ( $header_font_option['line-height'] ) {
		$css['global'][aione_implode( $elements )]['line-height'] = round( intval( $header_font_option['font-size'] ) * 1.5 ) . 'px'; 
	}
	if ( $header_font_option['font-family'] ) {
		$css['global'][aione_implode( $elements )]['font-family'] = $header_font_option['font-family'];
	}
	
	$css['global'][aione_implode( $elements )]['border-bottom-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'header_border_color' ], Aione()->settings->get_default( 'header_border_color' ) );

	$css['global']['#side-header .oxo-secondary-menu-search-inner']['border-top-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'header_border_color' ], Aione()->settings->get_default( 'header_border_color' ) );

	$css['global']['.oxo-header .oxo-row']['padding-top']    = Aione_Sanitize::size( Aione()->theme_options[ 'margin_header_top' ] );
	$css['global']['.oxo-header .oxo-row']['padding-bottom'] = Aione_Sanitize::size( Aione()->theme_options[ 'margin_header_bottom' ] );

	//$css['global']['.oxo-secondary-header']['background-color']    = Aione_Sanitize::color( Aione()->theme_options[ 'header_top_bg_color' ], Aione()->settings->get_default( 'header_top_bg_color' ) );
	
	$topbar_font_option = Aione()->theme_options[ 'typography_topbar' ];
	
	if ( $topbar_font_option['font-family'] ) {
		$css['global']['.oxo-secondary-header']['font-family']     = $topbar_font_option['font-family'];
	}
	if ( $topbar_font_option['font-weight'] ) {
		$css['global']['.oxo-secondary-header']['font-weight']     = $topbar_font_option['font-weight'];
	}
	
	if ( $topbar_font_option['font-size'] ) {
		$css['global']['.oxo-secondary-header']['font-size']     = intval( $topbar_font_option['font-size'] ) . 'px';
	}
	if ( $topbar_font_option['line-height'] ) {
		$css['global']['.oxo-secondary-header']['line-height']     = intval( $topbar_font_option['line-height'] ) . 'px';
	}
	$css['global']['.oxo-secondary-header']['color']               = Aione_Sanitize::color( Aione()->theme_options[ 'snav_color' ], Aione()->settings->get_default( 'snav_color' ) );
	$css['global']['.oxo-secondary-header']['border-bottom-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'header_border_color' ], Aione()->settings->get_default( 'header_border_color' ) );

	$elements = array(
		'.oxo-secondary-header a',
		'.oxo-secondary-header a:hover'
	);
	$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'snav_color' ], Aione()->settings->get_default( 'snav_color' ) );

	$css['global']['.oxo-header-v2 .oxo-secondary-header']['border-top-color'] = Aione_Sanitize::color( Aione()->theme_options['primary_color'], Aione()->settings->get_default( 'primary_color' ) );

	$css['global']['.oxo-mobile-menu-design-modern .oxo-secondary-header .oxo-alignleft']['border-bottom-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'header_border_color' ], Aione()->settings->get_default( 'header_border_color' ) );

	$header_tagline_font_option = Aione()->theme_options[ 'typography_header_tagline' ];
	
	if ( $header_tagline_font_option['font-size'] ) {
		$css['global']['.oxo-header-tagline']['font-size'] = intval( $header_tagline_font_option['font-size'] ) . 'px';
		$css['global']['.oxo-header-tagline']['line-height']   = round( intval( $header_tagline_font_option['font-size'] ) * 1.5 ) . 'px';
	}
	if ( $header_tagline_font_option['font-family'] ) {
		$css['global']['.oxo-header-tagline']['font-family'] = $header_tagline_font_option['font-family'];
	}
	$css['global']['.oxo-header-tagline']['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'tagline_font_color' ], Aione()->settings->get_default( 'tagline_font_color' ) );

	$elements = array(
		'.oxo-secondary-main-menu',
		'.oxo-mobile-menu-sep'
	);
	$css['global'][aione_implode( $elements )]['border-bottom-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'header_border_color' ], Aione()->settings->get_default( 'header_border_color' ) );

	$css['global']['#side-header']['width']          = intval( $side_header_width ) . 'px';
	$css['global']['#side-header .side-header-background']['width']	= intval( $side_header_width ) . 'px';
	$css['global']['#side-header .side-header-border']['width']	= intval( $side_header_width ) . 'px';

	$css['global']['#side-header']['padding-top']    = Aione_Sanitize::size( Aione()->theme_options[ 'margin_header_top' ] );
	$css['global']['#side-header']['padding-bottom'] = Aione_Sanitize::size( Aione()->theme_options[ 'margin_header_bottom' ] );
	$css['global']['#side-header .side-header-border']['border-color']   = Aione_Sanitize::color( Aione()->theme_options[ 'header_border_color' ], Aione()->settings->get_default( 'header_border_color' ) );

	$css['global']['#side-header .side-header-content']['padding-left']  = Aione_Sanitize::size( Aione()->theme_options[ 'padding_header_left' ] );
	$css['global']['#side-header .side-header-content']['padding-right'] = Aione_Sanitize::size( Aione()->theme_options[ 'padding_header_left' ] );

	$css['global']['#side-header .oxo-main-menu > ul > li > a']['padding-left']               = Aione_Sanitize::size( Aione()->theme_options[ 'padding_header_left' ] );
	$css['global']['#side-header .oxo-main-menu > ul > li > a']['padding-right']              = Aione_Sanitize::size( Aione()->theme_options[ 'padding_header_right' ] );
	$css['global']['.side-header-left .oxo-main-menu > ul > li > a > .oxo-caret']['right'] = Aione_Sanitize::size( Aione()->theme_options[ 'padding_header_right' ] );
	$css['global']['.side-header-right .oxo-main-menu > ul > li > a > .oxo-caret']['left'] = Aione_Sanitize::size( Aione()->theme_options[ 'padding_header_left' ] );
	$css['global']['#side-header .oxo-main-menu > ul > li > a']['border-top-color']           = Aione_Sanitize::color( Aione()->theme_options[ 'header_border_color' ], Aione()->settings->get_default( 'header_border_color' ) );
	$css['global']['#side-header .oxo-main-menu > ul > li > a']['border-bottom-color']        = Aione_Sanitize::color( Aione()->theme_options[ 'header_border_color' ], Aione()->settings->get_default( 'header_border_color' ) );
	$css['global']['#side-header .oxo-main-menu > ul > li > a']['text-align']                 = esc_attr( Aione()->theme_options[ 'menu_text_align' ] );

	$elements = array(
		'#side-header .oxo-main-menu > ul > li.current-menu-ancestor > a',
		'#side-header .oxo-main-menu > ul > li.current-menu-item > a',
	);
	$css['global'][aione_implode( $elements )]['color']              = Aione_Sanitize::color( Aione()->theme_options[ 'menu_hover_first_color' ], Aione()->settings->get_default( 'menu_hover') );
	$css['global'][aione_implode( $elements )]['border-right-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'menu_hover_first_color' ], Aione()->settings->get_default( 'menu_hover_first_color' ) );
	$css['global'][aione_implode( $elements )]['border-left-color']  = Aione_Sanitize::color( Aione()->theme_options[ 'menu_hover_first_color' ], Aione()->settings->get_default( 'menu_hover_first_color' ) );

	$css['global']['body.side-header-left #side-header .oxo-main-menu > ul > li > ul']['left'] = intval( $side_header_width - 1 ) . 'px';

	$css['global']['body.side-header-left #side-header .oxo-main-menu .oxo-custom-menu-item-contents']['top']  = '0';
	$css['global']['body.side-header-left #side-header .oxo-main-menu .oxo-custom-menu-item-contents']['left'] = intval( $side_header_width - 1 ) . 'px';

	$css['global']['#side-header .oxo-main-menu .oxo-main-menu-search .oxo-custom-menu-item-contents']['border-top-width'] = '1px';
	$css['global']['#side-header .oxo-main-menu .oxo-main-menu-search .oxo-custom-menu-item-contents']['border-top-style'] = 'solid';

	$elements = array(
		'#side-header .side-header-content-1',
		'#side-header .side-header-content-2',
		'#side-header .oxo-secondary-menu > ul > li > a'
	);
	$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'header_top_menu_sub_color' ], Aione()->settings->get_default( 'header_top_menu_sub_color' ) );
	if ( $topbar_font_option['font-size'] ) {
		$css['global'][aione_implode( $elements )]['font-size'] = intval( $topbar_font_option['font-size'] ) . 'px';
	}
	
	if ( $topbar_font_option['line-height'] ) {
		$css['global'][aione_implode( $elements )]['line-height'] = round( intval( $topbar_font_option['font-size'] ) * 1.5 ) . 'px'; 
	}
	
	

	if ( Aione()->theme_options[ 'nav_highlight_border' ] ) {
		$elements = array(
			'.side-header-left #side-header .oxo-main-menu > ul > li.current-menu-ancestor > a',
			'.side-header-left #side-header .oxo-main-menu > ul > li.current-menu-item > a'
		);
		$css['global'][aione_implode( $elements )]['border-right-width'] = intval( Aione()->theme_options[ 'nav_highlight_border' ] ) . 'px';

		$elements = array(
			'.side-header-right #side-header .oxo-main-menu > ul > li.current-menu-ancestor > a',
			'.side-header-right #side-header .oxo-main-menu > ul > li.current-menu-item > a'
		);
		$css['global'][aione_implode( $elements )]['border-left-width'] = intval( Aione()->theme_options[ 'nav_highlight_border' ] ) . 'px';
	}

	$elements = array(
		'.side-header-right #side-header .oxo-main-menu ul .oxo-dropdown-menu .sub-menu li ul',
		'.side-header-right #side-header .oxo-main-menu ul .oxo-dropdown-menu .sub-menu',
		'.side-header-right #side-header .oxo-main-menu ul .oxo-menu-login-box .sub-menu',
		'.side-header-right #side-header .oxo-main-menu .oxo-menu-cart-items',
		'.side-header-right #side-header .oxo-main-menu .oxo-menu-login-box .oxo-custom-menu-item-contents'
	);
	$css['global'][aione_implode( $elements )]['left'] = '-' . Aione_Sanitize::size( Aione()->theme_options[ 'dropdown_menu_width' ] );

	$css['global']['.side-header-right #side-header .oxo-main-menu-search .oxo-custom-menu-item-contents']['left'] = '-250px';

	/**
	 * Main Menu Styles
	 */
	if ( Aione()->theme_options[ 'nav_padding' ] ) {
		$css['global']['.oxo-main-menu > ul > li']['padding-right'] = intval( Aione()->theme_options[ 'nav_padding' ] ) . 'px';
		
		if ( is_rtl() ) {
			$css['global']['.rtl .oxo-main-menu .oxo-last-menu-item']['padding-right'] = intval( Aione()->theme_options[ 'nav_padding' ] ) . 'px';
		}
	}
	if ( Aione()->theme_options[ 'nav_highlight_border' ] ) {
		$css['global']['.oxo-main-menu > ul > li > a']['border-top'] = intval( Aione()->theme_options[ 'nav_highlight_border' ] ) . 'px solid transparent';
	}

	if ( Aione()->theme_options[ 'nav_height' ] ) {
		$css['global']['.oxo-main-menu > ul > li > a']['height'] = intval( Aione()->theme_options[ 'nav_height' ] ) . 'px';
		$css['global']['.oxo-main-menu > ul > li > a']['line-height'] = intval( Aione()->theme_options[ 'nav_height' ] ) . 'px';
	}
	$css['global']['.oxo-main-menu > ul > li > a']['font-family'] = $nav_font;
	$css['global']['.oxo-main-menu > ul > li > a']['font-weight'] = esc_attr( Aione()->theme_options[ 'font_weight_menu' ] );

	$main_menu_font_option = Aione()->theme_options[ 'typography_header_main_menu' ];
	
	if ( $main_menu_font_option['font-size'] ) {
		$css['global']['.oxo-main-menu > ul > li > a']['font-size'] = intval( $main_menu_font_option['font-size'] ) . 'px';
		$css['global']['.oxo-megamenu-icon img']['max-height'] = intval( $main_menu_font_option['font-size'] ) . 'px';
	}
	
	if ( $main_menu_font_option['font-family'] ) {
		$css['global']['.oxo-main-menu > ul > li > a']['font-family'] = $main_menu_font_option['font-family'];
	}
	if ( $main_menu_font_option['font-weight'] ) {
		$css['global']['.oxo-main-menu > ul > li > a']['font-weight'] = intval( $main_menu_font_option['font-weight'] ) . 'px';
	}
	
	$elements = array(
		'.oxo-main-menu > ul > li > a',
		'.oxo-main-menu .oxo-widget-cart-counter > a:before',
	);
	$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'menu_first_color' ], Aione()->settings->get_default( 'menu_first_color' ) );

	if ( Aione()->theme_options[ 'menu_font_ls' ] ) {
		$css['global']['.oxo-main-menu > ul > li > a']['letter-spacing'] = intval( Aione()->theme_options[ 'menu_font_ls' ] ) . 'px';
	}
	$elements = array(
		'.oxo-main-menu > ul > li > a:hover',
		'.oxo-main-menu .oxo-widget-cart-counter > a:hover:before',
	);
	$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'menu_hover_first_color' ], Aione()->settings->get_default( 'menu_hover_first_color' ) );

	$css['global']['.oxo-main-menu > ul > li > a:hover']['border-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'menu_hover_first_color' ], Aione()->settings->get_default( 'menu_hover_first_color' ) );
	$css['global']['.oxo-main-menu > ul > .oxo-menu-item-button > a:hover']['border-color'] = 'transparent';
	$css['global']['.oxo-widget-cart-number']['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'menu_hover_first_color' ], Aione()->settings->get_default( 'menu_hover_first_color' ) );
	$css['global']['.oxo-widget-cart-counter a:hover:before']['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'menu_hover_first_color' ], Aione()->settings->get_default( 'menu_hover_first_color' ) );
	$css['global']['.oxo-widget-cart-number']['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'menu_first_color' ], Aione()->settings->get_default( 'menu_first_color' ) );

	$css['global']['#side-header .oxo-main-menu > ul > li > a']['height'] = 'auto';
	if ( Aione()->theme_options[ 'nav_height' ] ) {
		$css['global']['#side-header .oxo-main-menu > ul > li > a']['min-height'] = intval( Aione()->theme_options[ 'nav_height' ] ) . 'px';
	}

	$elements = array(
		'.oxo-main-menu .current_page_item > a',
		'.oxo-main-menu .current-menu-item > a',
		'.oxo-main-menu .current-menu-parent > a',
		'.oxo-main-menu .current-menu-ancestor > a'
	);
	$css['global'][aione_implode( $elements )]['color']        = Aione_Sanitize::color( Aione()->theme_options[ 'menu_hover_first_color' ], Aione()->settings->get_default( 'menu_hover_first_color' ) );
	$css['global'][aione_implode( $elements )]['border-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'menu_hover_first_color' ], Aione()->settings->get_default( 'menu_hover_first_color' ) );
	$css['global']['.oxo-main-menu > ul > .oxo-menu-item-button > a']['border-color'] = 'transparent';

	$elements = array(
		'.oxo-main-menu .oxo-main-menu-icon:after',
	);
	$css['global'][aione_implode( $elements )]['color']  = Aione_Sanitize::color( Aione()->theme_options[ 'menu_first_color' ], Aione()->settings->get_default( 'menu_first_color' ) );

	$elements = array(
		'.oxo-main-menu .oxo-menu-cart-link a:hover',
		'.oxo-main-menu .oxo-menu-cart-checkout-link a:hover',
		'.oxo-main-menu .oxo-menu-cart-link a:hover:before',
		'.oxo-main-menu .oxo-menu-cart-checkout-link a:hover:before',
	);
	$css['global'][aione_implode( $elements )]['color']  = Aione_Sanitize::color( Aione()->theme_options[ 'menu_hover_first_color' ], Aione()->settings->get_default( 'menu_hover_first_color' ) );

	if ( Aione()->theme_options[ 'nav_font_size' ] ) {
		$css['global']['.oxo-main-menu .oxo-main-menu-icon:after']['height'] = intval( Aione()->theme_options[ 'nav_font_size' ] ) . 'px';
		$css['global']['.oxo-main-menu .oxo-main-menu-icon:after']['width']  = intval( Aione()->theme_options[ 'nav_font_size' ] ) . 'px';
	}

	if ( Aione()->theme_options[ 'main_nav_icon_circle' ] ) {
		$css['global']['.oxo-main-menu .oxo-main-menu-icon:after']['border']  = '1px solid #333333';
		$css['global']['.oxo-main-menu .oxo-main-menu-icon:after']['padding'] = '5px';
	}

	$css['global']['.oxo-main-menu .oxo-main-menu-icon:hover']['border-color'] = 'transparent';

	$css['global']['.oxo-main-menu .oxo-main-menu-icon:hover:after']['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'menu_hover_first_color' ], Aione()->settings->get_default( 'menu_hover_first_color' ) );

	if ( Aione()->theme_options[ 'main_nav_icon_circle' ] ) {
		$css['global']['.oxo-main-menu .oxo-main-menu-icon:hover:after']['border'] = '1px solid ' . Aione_Sanitize::color( Aione()->theme_options[ 'menu_hover_first_color' ], Aione()->settings->get_default( 'menu_hover_first_color' ) );
	}

	$elements = array(
		'.oxo-main-menu .oxo-main-menu-search-open .oxo-main-menu-icon:after',
		'.oxo-main-menu .oxo-main-menu-icon-active:after'
	);
	$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'menu_hover_first_color' ], Aione()->settings->get_default( 'menu_hover_first_color' ) );

	if ( Aione()->theme_options[ 'main_nav_icon_circle' ] ) {
		$elements = array(
			'.oxo-main-menu .oxo-main-menu-search-open .oxo-main-menu-icon:after',
			'.oxo-main-menu .oxo-main-menu-icon-active:after'
		);
		$css['global'][aione_implode( $elements )]['border'] = '1px solid ' . Aione_Sanitize::color( Aione()->theme_options[ 'menu_hover_first_color' ], Aione()->settings->get_default( 'menu_hover_first_color' ) );
	}

	$css['global']['.oxo-main-menu .sub-menu']['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'menu_sub_bg_color' ], Aione()->settings->get_default( 'menu_sub_bg_color' ) );
	$css['global']['.oxo-main-menu .sub-menu, .oxo-main-menu .oxo-menu-cart-items, .oxo-main-menu .oxo-menu-login-box .oxo-custom-menu-item-contents']['width']            = Aione_Sanitize::size( Aione()->theme_options[ 'dropdown_menu_width' ] );
	$css['global']['.oxo-main-menu .sub-menu']['border-top']       = '3px solid ' . Aione_Sanitize::color( Aione()->theme_options[ 'menu_hover_first_color' ], Aione()->settings->get_default( 'menu_hover_first_color' ) );
	$css['global']['.oxo-main-menu .sub-menu']['font-family']      = $font;
	$css['global']['.oxo-main-menu .sub-menu']['font-weight']      = esc_attr( Aione()->theme_options[ 'font_weight_body' ] );
	if ( Aione()->theme_options[ 'megamenu_shadow' ] ) {
		$css['global']['.oxo-main-menu .sub-menu']['box-shadow']   = '1px 1px 30px rgba(0, 0, 0, 0.06)';
	}

	$css['global']['.oxo-main-menu .sub-menu ul']['left'] = Aione_Sanitize::size( Aione()->theme_options[ 'dropdown_menu_width' ] );
	$css['global']['.oxo-main-menu .sub-menu ul']['top']  = '-3px';

	if ( Aione()->theme_options[ 'mainmenu_dropdown_display_divider' ] ) {
		$css['global']['.oxo-main-menu .sub-menu li a']['border-bottom'] = '1px solid ' . Aione_Sanitize::color( Aione()->theme_options[ 'menu_sub_sep_color' ], Aione()->settings->get_default( 'menu_sub_sep_color' ) );
	} else {
		$css['global']['.oxo-main-menu .sub-menu li a']['border-bottom'] = 'none';
	}
	$css['global']['.oxo-main-menu .sub-menu li a']['padding-top']   	= Aione_Sanitize::size( Aione()->theme_options[ 'mainmenu_dropdown_vertical_padding' ] );
	$css['global']['.oxo-main-menu .sub-menu li a']['padding-bottom']	= Aione_Sanitize::size( Aione()->theme_options[ 'mainmenu_dropdown_vertical_padding' ] );
	$css['global']['.oxo-main-menu .sub-menu li a']['color']         	= Aione_Sanitize::color( Aione()->theme_options[ 'menu_sub_color' ], Aione()->settings->get_default( 'menu_sub_color' ) );
	$css['global']['.oxo-main-menu .sub-menu li a']['font-family']   	= $font;
	$css['global']['.oxo-main-menu .sub-menu li a']['font-weight']   	= esc_attr( Aione()->theme_options[ 'font_weight_body' ] );
	if ( Aione()->theme_options[ 'nav_dropdown_font_size' ] ) {
		$css['global']['.oxo-main-menu .sub-menu li a']['font-size']     = intval( Aione()->theme_options[ 'nav_dropdown_font_size' ] ) . 'px';
	}

	$css['global']['.oxo-main-menu .sub-menu li a:hover']['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'menu_bg_hover_color' ], Aione()->settings->get_default( 'menu_bg_hover_color' ) );

	$elements = array(
		'.oxo-main-menu .sub-menu .current_page_item > a',
		'.oxo-main-menu .sub-menu .current-menu-item > a',
		'.oxo-main-menu .sub-menu .current-menu-parent > a'
	);
	$css['global'][aione_implode( $elements )]['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'menu_bg_hover_color' ], Aione()->settings->get_default( 'menu_bg_hover_color' ) );

	$css['global']['.oxo-main-menu .oxo-custom-menu-item-contents']['font-family'] = $font;
	$css['global']['.oxo-main-menu .oxo-custom-menu-item-contents']['font-weight'] = esc_attr( Aione()->theme_options[ 'font_weight_body' ] );

	$elements = array(
		'.oxo-main-menu .oxo-main-menu-search .oxo-custom-menu-item-contents',
		'.oxo-main-menu .oxo-main-menu-cart .oxo-custom-menu-item-contents',
		'.oxo-main-menu .oxo-menu-login-box .oxo-custom-menu-item-contents'
	);
	$css['global'][aione_implode( $elements )]['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'menu_sub_bg_color' ], Aione()->settings->get_default( 'menu_sub_bg_color' ) );
	$css['global'][aione_implode( $elements )]['border-color']     = Aione_Sanitize::color( Aione()->theme_options[ 'menu_sub_sep_color' ], Aione()->settings->get_default( 'menu_sub_sep_color' ) );
	if( trim( Aione()->theme_options[ 'menu_sub_sep_color' ] ) == 'transparent' ) {
		$css['global'][aione_implode( $elements )]['border'] = '0';
	}

	if ( is_rtl() ) {
		$elements = array(
			'.rtl .oxo-header-v1 .oxo-main-menu > ul > li',
			'.rtl .oxo-header-v2 .oxo-main-menu > ul > li',
			'.rtl .oxo-header-v3 .oxo-main-menu > ul > li'
		);

		$css['global'][aione_implode( $elements )]['padding-right'] = '0';
		if ( Aione()->theme_options[ 'nav_padding' ] ) {
			$css['global'][aione_implode( $elements )]['padding-left'] = intval( Aione()->theme_options[ 'nav_padding' ] ) . 'px';
		}

		$css['global']['.rtl .oxo-main-menu .sub-menu ul']['left']  = 'auto';
		$css['global']['.rtl .oxo-main-menu .sub-menu ul']['right'] = Aione_Sanitize::size( Aione()->theme_options[ 'dropdown_menu_width' ] );

	}

	/**
	 * Secondary Menu Styles
	 */

	$css['global']['.oxo-secondary-menu > ul > li']['border-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'header_top_first_border_color' ], Aione()->settings->get_default( 'header_top_first_border_color' ) );

	if ( Aione()->theme_options[ 'sec_menu_lh' ] ) {
		$css['global']['.oxo-secondary-menu > ul > li > a']['height']      = intval( Aione()->theme_options[ 'sec_menu_lh' ] ) . 'px';
		$css['global']['.oxo-secondary-menu > ul > li > a']['line-height'] = intval( Aione()->theme_options[ 'sec_menu_lh' ] ) . 'px';
	}

	$css['global']['.oxo-secondary-menu .sub-menu, .oxo-secondary-menu .oxo-custom-menu-item-contents']['width'] = Aione_Sanitize::size( Aione()->theme_options[ 'topmenu_dropwdown_width' ] );
	$css['global']['.oxo-secondary-menu .oxo-secondary-menu-icon']['min-width'] = Aione_Sanitize::size( Aione()->theme_options[ 'topmenu_dropwdown_width' ] );
	$css['global']['.oxo-secondary-menu .sub-menu']['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'header_top_sub_bg_color' ], Aione()->settings->get_default( 'header_top_sub_bg_color' ) );
	$css['global']['.oxo-secondary-menu .sub-menu']['border-color']     = Aione_Sanitize::color( Aione()->theme_options[ 'header_top_menu_sub_sep_color' ], Aione()->settings->get_default( 'header_top_menu_sub_sep_color' ) );

	$css['global']['.oxo-secondary-menu .sub-menu a']['border-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'header_top_menu_sub_sep_color' ], Aione()->settings->get_default( 'header_top_menu_sub_sep_color' ) );
	$css['global']['.oxo-secondary-menu .sub-menu a']['color']        = Aione_Sanitize::color( Aione()->theme_options[ 'header_top_menu_sub_color' ], Aione()->settings->get_default( 'header_top_menu_sub_color' ) );

	$css['global']['.oxo-secondary-menu .sub-menu a:hover']['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'header_top_menu_bg_hover_color' ], Aione()->settings->get_default( 'header_top_menu_bg_hover_color' ) );
	$css['global']['.oxo-secondary-menu .sub-menu a:hover']['color']            = Aione_Sanitize::color( Aione()->theme_options[ 'header_top_menu_sub_hover_color' ], Aione()->settings->get_default( 'header_top_menu_sub_hover_color' ) );

	$css['global']['.oxo-secondary-menu > ul > li > .sub-menu .sub-menu']['left'] = Aione_Sanitize::size( Aione()->theme_options[ 'topmenu_dropwdown_width' ] );

	$css['global']['.oxo-secondary-menu .oxo-custom-menu-item-contents']['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'header_top_sub_bg_color' ], Aione()->settings->get_default( 'header_top_sub_bg_color' ) );
	$css['global']['.oxo-secondary-menu .oxo-custom-menu-item-contents']['border-color']     = Aione_Sanitize::color( Aione()->theme_options[ 'header_top_menu_sub_sep_color' ], Aione()->settings->get_default( 'header_top_menu_sub_sep_color' ) );
	$css['global']['.oxo-secondary-menu .oxo-custom-menu-item-contents']['color']            = Aione_Sanitize::color( Aione()->theme_options[ 'header_top_menu_sub_color' ], Aione()->settings->get_default( 'header_top_menu_sub_color' ) );

	$elements = array(
		'.oxo-secondary-menu .oxo-secondary-menu-icon',
		'.oxo-secondary-menu .oxo-secondary-menu-icon:hover'
	);
	$css['global'][aione_implode( $elements )]['color'] = Aione()->theme_options[ 'menu_first_color' ];

	$css['global']['.oxo-secondary-menu .oxo-menu-cart-items a']['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'header_top_menu_sub_color' ], Aione()->settings->get_default( 'header_top_menu_sub_color' ) );

	$css['global']['.oxo-secondary-menu .oxo-menu-cart-item a']['border-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'header_top_menu_sub_sep_color' ], Aione()->settings->get_default( 'header_top_menu_sub_sep_color' ) );

	$css['global']['.oxo-secondary-menu .oxo-menu-cart-item img']['border-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'sep_color' ], Aione()->settings->get_default( 'sep_color' ) );

	$css['global']['.oxo-secondary-menu .oxo-menu-cart-item a:hover']['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'header_top_menu_bg_hover_color' ], Aione()->settings->get_default( 'header_top_menu_bg_hover_color' ) );
	$css['global']['.oxo-secondary-menu .oxo-menu-cart-item a:hover']['color']            = Aione_Sanitize::color( Aione()->theme_options[ 'header_top_menu_sub_hover_color' ], Aione()->settings->get_default( 'header_top_menu_sub_hover_color' ) );

	if ( class_exists( 'WooCommerce' ) ) {
		$css['global']['.oxo-secondary-menu .oxo-menu-cart-checkout']['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'woo_cart_bg_color' ], Aione()->settings->get_default( 'woo_cart_bg_color' ) );

		$css['global']['.oxo-secondary-menu .oxo-menu-cart-checkout a:before']['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'header_top_menu_sub_color' ], Aione()->settings->get_default( 'header_top_menu_sub_color' ) );

		$elements = array(
			'.oxo-secondary-menu .oxo-menu-cart-checkout a:hover',
			'.oxo-secondary-menu .oxo-menu-cart-checkout a:hover:before'
		);
		$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'header_top_menu_sub_hover_color' ], Aione()->settings->get_default( 'header_top_menu_sub_hover_color' ) );
	}

	$css['global']['.oxo-secondary-menu-icon']['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'woo_cart_bg_color' ], Aione()->settings->get_default( 'woo_cart_bg_color' ) );
	$css['global']['.oxo-secondary-menu-icon']['color']            = Aione_Sanitize::color( Aione()->theme_options[ 'menu_first_color' ], Aione()->settings->get_default( 'menu_first_color' ) );

	$elements = array(
		'.oxo-secondary-menu-icon:before',
		'.oxo-secondary-menu-icon:after'
	);
	$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'menu_first_color' ], Aione()->settings->get_default( 'menu_first_color' ) );

	if ( is_rtl() ) {
		$css['global']['.rtl .oxo-secondary-menu > ul > li:first-child']['border-left'] = '1px solid ' . Aione_Sanitize::color( Aione()->theme_options[ 'header_top_first_border_color' ], Aione()->settings->get_default( 'header_top_first_border_color' ) );

		$css['global']['.rtl .oxo-secondary-menu > ul > li > .sub-menu .sub-menu']['left']  = 'auto';
		$css['global']['.rtl .oxo-secondary-menu > ul > li > .sub-menu .sub-menu']['right'] = Aione_Sanitize::size( Aione()->theme_options[ 'topmenu_dropwdown_width' ] );
	}

	if ( Aione()->theme_options[ 'sec_menu_lh' ] ) {
		$css['global']['.oxo-contact-info']['line-height'] = intval( Aione()->theme_options[ 'sec_menu_lh' ] ) . 'px';
	}

	/**
	 * Common Menu Styles
	 */

	if ( class_exists( 'WooCommerce' ) ) {
		if ( Aione()->theme_options[ 'woo_icon_font_size' ] ) {
			$css['global']['.oxo-menu-cart-items']['font-size']   = intval( Aione()->theme_options[ 'woo_icon_font_size' ] ) . 'px';
			$css['global']['.oxo-menu-cart-items']['line-height'] = round( intval( Aione()->theme_options[ 'woo_icon_font_size' ] ) * 1.5 ) . 'px';
		}

		$css['global']['.oxo-menu-cart-items a']['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'menu_sub_color' ], Aione()->settings->get_default( 'menu_sub_color' ) );

		$css['global']['.oxo-menu-cart-item a']['border-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'menu_sub_sep_color' ], Aione()->settings->get_default( 'menu_sub_sep_color' ) );

		$css['global']['.oxo-menu-cart-item img']['border-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'sep_color' ], Aione()->settings->get_default( 'sep_color' ) );

		$css['global']['.oxo-menu-cart-item a:hover']['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'menu_bg_hover_color' ], Aione()->settings->get_default( 'menu_bg_hover_color' ) );

		$css['global']['.oxo-menu-cart-checkout']['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'woo_cart_bg_color' ], Aione()->settings->get_default( 'woo_cart_bg_color' ) );

		$css['global']['.oxo-menu-cart-checkout a:before']['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'menu_sub_color' ], Aione()->settings->get_default( 'menu_sub_color' ) );

		$elements = array(
			'.oxo-menu-cart-checkout a:hover',
			'.oxo-menu-cart-checkout a:hover:before'
		);
		$elements['global']['color'] = Aione_Sanitize::color( Aione()->theme_options['primary_color'], Aione()->settings->get_default( 'primary_color' ) );
	}

	/**
	 * Megamenu Styles
	 */

	$css['global']['.oxo-megamenu-holder']['border-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'menu_hover_first_color' ], Aione()->settings->get_default( 'menu_hover_first_color' ) );

	$css['global']['.oxo-megamenu']['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'menu_sub_bg_color' ], Aione()->settings->get_default( 'menu_sub_bg_color' ) );
	if ( Aione()->theme_options[ 'megamenu_shadow' ] ) {
		$css['global']['.oxo-megamenu']['box-shadow'] = '1px 1px 30px rgba(0, 0, 0, 0.06)';
	}

	$css['global']['.oxo-megamenu-wrapper .oxo-megamenu-submenu']['border-color'] 				= Aione_Sanitize::color( Aione()->theme_options[ 'menu_sub_sep_color' ], Aione()->settings->get_default( 'menu_sub_sep_color' ) );
	$css['global']['.rtl .oxo-megamenu-wrapper .oxo-megamenu-submenu:last-child']['border-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'menu_sub_sep_color' ], Aione()->settings->get_default( 'menu_sub_sep_color' ) );


	$css['global']['.oxo-megamenu-wrapper .oxo-megamenu-submenu .sub-menu a']['padding-top']	 	= Aione_Sanitize::size( Aione()->theme_options[ 'megamenu_item_vertical_padding' ] );
	$css['global']['.oxo-megamenu-wrapper .oxo-megamenu-submenu .sub-menu a']['padding-bottom']	= Aione_Sanitize::size( Aione()->theme_options[ 'megamenu_item_vertical_padding' ] );
	if ( Aione()->theme_options[ 'megamenu_item_display_divider' ] ) {
		$css['global']['.oxo-megamenu-wrapper .oxo-megamenu-submenu .sub-menu a']['border-bottom'] = '1px solid ' . Aione_Sanitize::color( Aione()->theme_options[ 'menu_sub_sep_color' ], Aione()->settings->get_default( 'menu_sub_sep_color' ) );
		$css['global']['.oxo-megamenu-wrapper .oxo-megamenu-submenu > a']['border-bottom'] = '1px solid ' . Aione_Sanitize::color( Aione()->theme_options[ 'menu_sub_sep_color' ], Aione()->settings->get_default( 'menu_sub_sep_color' ) );
		$css['global']['#side-header .oxo-main-menu > ul .sub-menu > li:last-child > a']['border-bottom'] = '1px solid ' . Aione_Sanitize::color( Aione()->theme_options[ 'menu_sub_sep_color' ], Aione()->settings->get_default( 'menu_sub_sep_color' ) );
		$css['global']['.oxo-megamenu-wrapper .oxo-megamenu-submenu']['padding-bottom'] = '0';
		$css['global']['.oxo-megamenu-wrapper .oxo-megamenu-submenu-notitle']['padding-top'] = '0';
	}

	$css['global']['.oxo-megamenu-wrapper .oxo-megamenu-submenu > a:hover']['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'menu_bg_hover_color' ], Aione()->settings->get_default( 'menu_bg_hover_color' ) );
	$css['global']['.oxo-megamenu-wrapper .oxo-megamenu-submenu > a:hover']['color']            = Aione_Sanitize::color( Aione()->theme_options[ 'menu_sub_color' ], Aione()->settings->get_default( 'menu_sub_color' ) );
	$css['global']['.oxo-megamenu-wrapper .oxo-megamenu-submenu > a:hover']['font-family']      = $font;
	$css['global']['.oxo-megamenu-wrapper .oxo-megamenu-submenu > a:hover']['font-weight']      = esc_attr( Aione()->theme_options[ 'font_weight_body' ] );
	$css['global']['.oxo-megamenu-wrapper .oxo-megamenu-submenu > a:hover']['font-size']        = Aione_Sanitize::size( Aione()->theme_options[ 'nav_dropdown_font_size' ] );

	if ( $headings_font ) {
		$css['global']['.oxo-megamenu-title']['font-family'] = $headings_font;
	}
	$css['global']['.oxo-megamenu-title']['font-weight'] = esc_attr( Aione()->theme_options[ 'font_weight_headings' ] );
	$css['global']['.oxo-megamenu-title']['font-size']   = intval( Aione()->theme_options[ 'megamenu_title_size' ] ). 'px';
	$css['global']['.oxo-megamenu-title']['color']       = Aione_Sanitize::color( Aione()->theme_options[ 'menu_first_color' ], Aione()->settings->get_default( 'menu_first_color' ) );

	$css['global']['.oxo-megamenu-title a']['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'menu_first_color' ], Aione()->settings->get_default( 'menu_first_color' ) );

	$css['global']['.oxo-megamenu-bullet']['border-left-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'menu_sub_color' ], Aione()->settings->get_default( 'menu_sub_color' ) );

	if ( is_rtl() ) {
		$css['global']['.rtl .oxo-megamenu-bullet']['border-right-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'menu_sub_color' ], Aione()->settings->get_default( 'menu_sub_color' ) );
	}

	$css['global']['.oxo-megamenu-widgets-container']['color']       = Aione_Sanitize::color( Aione()->theme_options[ 'menu_sub_color' ], Aione()->settings->get_default( 'menu_sub_color' ) );
	$css['global']['.oxo-megamenu-widgets-container']['font-family'] = $font;
	$css['global']['.oxo-megamenu-widgets-container']['font-weight'] = esc_attr( Aione()->theme_options[ 'font_weight_body' ] );
	if ( Aione()->theme_options[ 'nav_dropdown_font_size' ] ) {
		$css['global']['.oxo-megamenu-widgets-container']['font-size'] = intval( Aione()->theme_options[ 'nav_dropdown_font_size' ] ) . 'px';
	}

	if ( is_rtl() ) {
		$css['global']['.rtl .oxo-megamenu-wrapper .oxo-megamenu-submenu .sub-menu ul']['right'] = 'auto';
	}

	/**
	 * Sticky Header Styles
	 */

	if ( '' != Aione()->theme_options[ 'header_sticky_bg_color'] ) {
		$rgba = oxo_hex2rgb( Aione()->theme_options[ 'header_sticky_bg_color'] );
		$sticky_header_bg = 'rgba(' . $rgba[0] . ',' . $rgba[1] . ',' . $rgba[2] . ',' . Aione()->theme_options[ 'header_sticky_opacity' ] . ')';
	}

	if ( isset( $sticky_header_bg ) ) {

		$elements = array(
			'.oxo-header-wrapper.oxo-is-sticky .oxo-header',
			//'.oxo-header-wrapper.oxo-is-sticky .oxo-secondary-main-menu'
		);
		$css['global'][aione_implode( $elements )]['background-color'] = Aione_Sanitize::color( $sticky_header_bg );

		$elements = array(
			'.no-rgba .oxo-header-wrapper.oxo-is-sticky .oxo-header',
			//'.no-rgba .oxo-header-wrapper.oxo-is-sticky .oxo-secondary-main-menu'
		);
		$css['global'][aione_implode( $elements )]['background-color'] = Aione_Sanitize::color( $sticky_header_bg );
		$css['global'][aione_implode( $elements )]['opacity']          = esc_attr( Aione()->theme_options[ 'header_sticky_opacity' ] );
		$css['global'][aione_implode( $elements )]['filter']           = 'progid: DXImageTransform.Microsoft.Alpha(Opacity=' . esc_attr( Aione()->theme_options[ 'header_sticky_bg_color'] ) * 100 . ')';

	}

	if ( Aione()->theme_options[ 'header_sticky_nav_padding' ] ) {
		$css['global']['.oxo-is-sticky .oxo-main-menu > ul > li']['padding-right'] = intval( Aione()->theme_options[ 'header_sticky_nav_padding' ] ) . 'px';
	}

	$css['global']['.oxo-is-sticky .oxo-main-menu > ul > li:last-child']['padding-right'] = '0';

	if ( Aione()->theme_options[ 'header_sticky_nav_padding' ] ) {
		$css['global']['.rtl .oxo-is-sticky .oxo-main-menu > ul > li:last-child']['padding-right'] = intval( Aione()->theme_options[ 'header_sticky_nav_padding' ] ) . 'px';
	} else {
		$css['global']['.rtl .oxo-is-sticky .oxo-main-menu > ul > li:last-child']['padding-right'] = intval( Aione()->theme_options[ 'nav_padding' ] ) . 'px';
	}

	if ( Aione()->theme_options[ 'header_sticky_nav_font_size' ] ) {
		$css['global']['.oxo-is-sticky .oxo-main-menu > ul > li > a']['font-size'] = intval( Aione()->theme_options[ 'header_sticky_nav_font_size' ] ) . 'px';
	}

	if ( is_rtl() ) {
		$elements = array(
			'.rtl .oxo-is-sticky .oxo-header-v1 .oxo-main-menu > ul > li',
			'.rtl .oxo-is-sticky .oxo-header-v2 .oxo-main-menu > ul > li',
			'.rtl .oxo-is-sticky .oxo-header-v3 .oxo-main-menu > ul > li',
		);
	
		$css['global'][aione_implode( $elements )]['padding-right'] = '0';
		if ( Aione()->theme_options[ 'header_sticky_nav_font_size' ] ) {
			$css['global']['.rtl .oxo-is-sticky .oxo-main-menu > ul > li']['padding-left'] = intval( Aione()->theme_options[ 'header_sticky_nav_padding' ] ) . 'px';
		}
		$css['global']['.rtl .oxo-is-sticky .oxo-main-menu > ul > li:last-child']['padding-left'] = '0';
		
	}

	/**
	 * Mobile Menu Styles
	 */

	$css['global']['.oxo-mobile-selector']['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'mobile_menu_background_color' ], Aione()->settings->get_default( 'mobile_menu_background_color' ) );
	$css['global']['.oxo-mobile-selector']['border-color']     = Aione_Sanitize::color( Aione()->theme_options[ 'mobile_menu_border_color' ], Aione()->settings->get_default( 'mobile_menu_border_color' ) );
	if ( Aione()->theme_options[ 'mobile_menu_font_size' ] ) {
		$css['global']['.oxo-mobile-selector']['font-size']    = intval( Aione()->theme_options[ 'mobile_menu_font_size' ] ) . 'px';
	}
	if ( Aione()->theme_options[ 'mobile_menu_nav_height' ] ) {
		$css['global']['.oxo-mobile-selector']['height']       = intval( Aione()->theme_options[ 'mobile_menu_nav_height' ] ) . 'px';
		$css['global']['.oxo-mobile-selector']['line-height']  = intval( Aione()->theme_options[ 'mobile_menu_nav_height' ] ) . 'px';
	}
	$css['global']['.oxo-mobile-selector']['color']            = Aione_Sanitize::color( Aione()->theme_options[ 'mobile_menu_font_color' ], Aione()->settings->get_default( 'mobile_menu_font_color' ) );

	$elements = array(
		'.oxo-selector-down',
	);
	if ( is_rtl() ) {
		$elements[] = '.rtl .oxo-selector-down';
	}
	if ( Aione()->theme_options[ 'mobile_menu_nav_height' ] ) {
		$css['global'][aione_implode( $elements )]['height']      = intval( Aione()->theme_options[ 'mobile_menu_nav_height' ] - 2 ) . 'px';
		$css['global'][aione_implode( $elements )]['line-height'] = intval( Aione()->theme_options[ 'mobile_menu_nav_height' ] - 2 ) . 'px';
	}
	$css['global'][aione_implode( $elements )]['border-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'mobile_menu_border_color' ], Aione()->settings->get_default( 'mobile_menu_border_color' ) );

	$elements = array(
		'.oxo-selector-down:before',
	);
	if ( is_rtl() ) {
		$elements[] = '.rtl .oxo-selector-down:before';
	}
	$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'mobile_menu_toggle_color' ], Aione()->settings->get_default( 'mobile_menu_toggle_color' ) );

	if ( 35 < Aione()->theme_options[ 'mobile_menu_font_size' ] ) {
		$css['global']['.oxo-selector-down']['font-size'] = '30px';
	}

	$elements = array(
		'.oxo-mobile-nav-holder > ul',
		'.oxo-mobile-menu-design-modern .oxo-mobile-nav-holder > ul'
	);
	$css['global'][aione_implode( $elements )]['border-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'mobile_menu_border_color' ], Aione()->settings->get_default( 'mobile_menu_border_color' ) );

	$css['global']['.oxo-mobile-nav-item .oxo-open-submenu']['color']            = Aione_Sanitize::color( Aione()->theme_options[ 'mobile_menu_font_color' ], Aione()->settings->get_default( 'mobile_menu_font_color' ) );
	$css['global']['.oxo-mobile-nav-item a']['color']            = Aione_Sanitize::color( Aione()->theme_options[ 'mobile_menu_font_color' ], Aione()->settings->get_default( 'mobile_menu_font_color' ) );
	if ( Aione()->theme_options[ 'mobile_menu_font_size' ] ) {
		$css['global']['.oxo-mobile-nav-item a']['font-size']    = intval( Aione()->theme_options[ 'mobile_menu_font_size' ] ) . 'px';
	}
	$css['global']['.oxo-mobile-nav-item a']['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'mobile_menu_background_color' ], Aione()->settings->get_default( 'mobile_menu_background_color' ) );
	$css['global']['.oxo-mobile-nav-item a']['border-color']     = Aione_Sanitize::color( Aione()->theme_options[ 'mobile_menu_border_color' ], Aione()->settings->get_default( 'mobile_menu_border_color' ) );
	if ( Aione()->theme_options[ 'mobile_menu_nav_height' ] ) {
		$css['global']['.oxo-mobile-nav-item a']['height']       = intval( Aione()->theme_options[ 'mobile_menu_nav_height' ] ) . 'px';
		$css['global']['.oxo-mobile-nav-item a']['line-height']  = intval( Aione()->theme_options[ 'mobile_menu_nav_height' ] ) . 'px';
	}

	$css['global']['.oxo-mobile-nav-item a:hover']['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'mobile_menu_hover_color' ], Aione()->settings->get_default( 'mobile_menu_hover_color' ) );

	$css['global']['.oxo-mobile-nav-item a:before']['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'mobile_menu_font_color' ], Aione()->settings->get_default( 'mobile_menu_font_color' ) );

	$css['global']['.oxo-mobile-current-nav-item > a']['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'mobile_menu_hover_color' ], Aione()->settings->get_default( 'mobile_menu_hover_color' ) );

	$css['global']['.oxo-mobile-menu-icons']['margin-top'] = Aione_Sanitize::size( Aione()->theme_options[ 'mobile_menu_icons_top_margin' ] );

	$css['global']['.oxo-mobile-menu-icons a']['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'mobile_menu_toggle_color' ], Aione()->settings->get_default( 'mobile_menu_toggle_color' ) );

	$css['global']['.oxo-mobile-menu-icons a:before']['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'mobile_menu_toggle_color' ], Aione()->settings->get_default( 'mobile_menu_toggle_color' ) );

	if ( Aione()->theme_options[ 'mobile_menu_font_size' ] ) {
		$css['global']['.oxo-open-submenu']['font-size']   = intval( Aione()->theme_options[ 'mobile_menu_font_size' ] ) . 'px';
	}
	if ( Aione()->theme_options[ 'mobile_menu_nav_height' ] ) {
		$css['global']['.oxo-open-submenu']['height']      = intval( Aione()->theme_options[ 'mobile_menu_nav_height' ] ) . 'px';
		$css['global']['.oxo-open-submenu']['line-height'] = intval( Aione()->theme_options[ 'mobile_menu_nav_height' ] ) . 'px';
	}

	if ( 30 < Aione()->theme_options[ 'mobile_menu_font_size' ] ) {
		$css['global']['.oxo-open-submenu']['font-size'] = '20px';
	}

	$css['global']['.oxo-open-submenu:hover']['color'] = Aione_Sanitize::color( Aione()->theme_options['primary_color'], Aione()->settings->get_default( 'primary_color' ) );

	/**
	 * Shortcodes
	 */
	if ( Aione()->theme_options[ 'content_box_title_size' ] ) {
		$css['global']['#wrapper .post-content .content-box-heading']['font-size']   = intval( Aione()->theme_options[ 'content_box_title_size' ] ) . 'px';
	}
	if ( Aione()->theme_options[ 'h2_font_lh' ] ) {
		$css['global']['#wrapper .post-content .content-box-heading']['line-height'] = intval( Aione()->theme_options[ 'h2_font_lh' ] ) . 'px';
	}
	if ( Aione()->theme_options[ 'content_box_title_color' ] ) {
		$css['global']['.post-content .content-box-heading']['color'] = Aione()->theme_options[ 'content_box_title_color' ];
	}
	if ( Aione()->theme_options[ 'content_box_body_color' ] ) {
		$css['global']['.oxo-content-boxes .content-container']['color'] = Aione()->theme_options[ 'content_box_body_color' ];
	}

	/**
	 * Social Links
	 */

	if ( Aione()->theme_options[ 'header_social_links_font_size' ] ) {
		$css['global']['.oxo-social-links-header .oxo-social-networks a']['font-size'] = intval( Aione()->theme_options[ 'header_social_links_font_size' ] ) . 'px';
	}
	if ( Aione()->theme_options[ 'header_social_links_icon_color'] ) {
		$css['global']['.oxo-social-links-header .oxo-social-networks a']['color'] = Aione()->theme_options[ 'header_social_links_icon_color'];
	}
	if ( Aione()->theme_options[ 'header_social_links_box_color' ] ) {
		$css['global']['.oxo-social-links-header .oxo-social-networks a']['border-color'] = Aione()->theme_options[ 'header_social_links_box_color'];
	}
	if ( Aione()->theme_options[ 'header_social_links_boxed' ] ) {
		$css['global']['.oxo-social-links-header .oxo-social-networks a']['border-width'] = '1px';
		$css['global']['.oxo-social-links-header .oxo-social-networks a']['border-style'] = 'solid';
	}
	if ( Aione()->theme_options[ 'header_social_links_boxed_radius' ] ) {
		$css['global']['.oxo-social-links-header .oxo-social-networks a']['border-radius'] = intval( Aione()->theme_options[ 'header_social_links_boxed_radius' ] ) . 'px';
	}
	if ( Aione()->theme_options[ 'header_social_links_boxed_padding' ] ) {
		$css['global']['.oxo-social-links-header .oxo-social-networks a']['padding'] = intval( Aione()->theme_options[ 'header_social_links_boxed_padding' ] ) . 'px'.' '.intval( Aione()->theme_options[ 'header_social_links_boxed_padding' ] )*2 . 'px';
	}
	if ( Aione()->theme_options[ 'footer_social_links_font_size' ] ) {
		$css['global']['.oxo-social-links-footer .oxo-social-networks a']['font-size'] = intval( Aione()->theme_options[ 'footer_social_links_font_size' ] ) . 'px';
	}
	if ( Aione()->theme_options[ 'footer_social_links_icon_color'] ) {
		$css['global']['.oxo-social-links-footer .oxo-social-networks a']['color'] = Aione()->theme_options[ 'footer_social_links_icon_color'];
	}
	if ( Aione()->theme_options[ 'footer_social_links_box_color' ] ) {
		$css['global']['.oxo-social-links-footer .oxo-social-networks a']['border-color'] = Aione()->theme_options[ 'footer_social_links_box_color'];
	}
	if ( Aione()->theme_options[ 'footer_social_links_boxed' ] ) {
		$css['global']['.oxo-social-links-footer .oxo-social-networks a']['border-width'] = '1px';
		$css['global']['.oxo-social-links-footer .oxo-social-networks a']['border-style'] = 'solid';
	}
	if ( Aione()->theme_options[ 'footer_social_links_boxed_radius' ] ) {
		$css['global']['.oxo-social-links-footer .oxo-social-networks a']['border-radius'] = intval( Aione()->theme_options[ 'footer_social_links_boxed_radius' ] ) . 'px';
	}
	if ( Aione()->theme_options[ 'footer_social_links_boxed_padding' ] ) {
		$css['global']['.oxo-social-links-footer .oxo-social-networks a']['padding'] = intval( Aione()->theme_options[ 'footer_social_links_boxed_padding' ] ) . 'px'.' '.intval( Aione()->theme_options[ 'footer_social_links_boxed_padding' ] )*2 . 'px';
	}
	if ( Aione()->theme_options[ 'sharing_social_links_font_size' ] ) {
		$css['global']['.oxo-sharing-box .oxo-social-networks a']['font-size'] = intval( Aione()->theme_options[ 'sharing_social_links_font_size' ] ) . 'px';
	}
	if ( Aione()->theme_options[ 'sharing_social_links_boxed_padding' ] ) {
		$css['global']['.oxo-sharing-box .oxo-social-networks a']['padding'] = intval( Aione()->theme_options[ 'sharing_social_links_boxed_padding' ] ) . 'px';
	}

	$elements = array(
		'.post-content .oxo-social-links .oxo-social-networks a',
		'.widget .oxo-social-links .oxo-social-networks a'
	);

	if ( Aione()->theme_options[ 'social_links_font_size' ] ) {
		$css['global'][aione_implode( $elements )]['font-size'] = intval( Aione()->theme_options[ 'social_links_font_size' ] ) . 'px';
	}

	$elements = array(
		'.post-content .oxo-social-links .oxo-social-networks.boxed-icons a',
		'.widget .oxo-social-links .oxo-social-networks.boxed-icons a'
	);

	if ( Aione()->theme_options[ 'social_links_boxed_padding' ] ) {
		$css['global'][aione_implode( $elements )]['padding'] = intval( Aione()->theme_options[ 'social_links_boxed_padding' ] ) . 'px';
	}

		/**
		 * Search Page / Error Page - Dynamic Styling
		 */
		if ( Aione()->theme_options[ 'checklist_icons_color' ] ) {
			$elements = array(
				'.oxo-body .error-menu li:before',
				'.oxo-body .error-menu li:after'
			);
		
			$css['global'][aione_implode( $elements )]['background-color'] = Aione()->theme_options[ 'checklist_circle_color' ];
			$css['global'][aione_implode( $elements )]['color'] = Aione()->theme_options[ 'checklist_icons_color' ];
		}

	if ( class_exists( 'WooCommerce' ) ) {

		/**
		 * Woocommerce - Dynamic Styling
		 */

		$css['global']['.product-images .crossfade-images']['background'] = Aione_Sanitize::color( Aione()->theme_options[ 'title_border_color' ], Aione()->settings->get_default( 'title_border_color' ) );

		$css['global']['.products .product-list-view']['border-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'sep_color' ], Aione()->settings->get_default( 'sep_color' ) );

		$elements = array(
			'.products .product-list-view .product-excerpt-container',
			'.products .product-list-view .product-details-container'
		);

		$css['global'][aione_implode( $elements )]['border-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'sep_color' ], Aione()->settings->get_default( 'sep_color' ) );

		$css['global']['.order-dropdown']['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'woo_dropdown_text_color' ], Aione()->settings->get_default( 'woo_dropdown_text_color' ) );

		$css['global']['.order-dropdown > li:after']['border-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'woo_dropdown_border_color' ], Aione()->settings->get_default( 'woo_dropdown_border_color' ) );

		$elements = array(
			'.order-dropdown a',
			'.order-dropdown a:hover'
		);
		$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'woo_dropdown_text_color' ], Aione()->settings->get_default( 'woo_dropdown_text_color' ) );

		$elements = array(
			'.order-dropdown .current-li',
			'.order-dropdown ul li a'
		);
		$css['global'][aione_implode( $elements )]['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'woo_dropdown_bg_color' ], Aione()->settings->get_default( 'woo_dropdown_bg_color' ) );
		$css['global'][aione_implode( $elements )]['border-color']     = Aione_Sanitize::color( Aione()->theme_options[ 'woo_dropdown_border_color' ], Aione()->settings->get_default( 'woo_dropdown_border_color' ) );

		$css['global']['.order-dropdown ul li a:hover']['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'woo_dropdown_text_color' ], Aione()->settings->get_default( 'woo_dropdown_text_color' ) );

		if ( Aione()->theme_options[ 'woo_dropdown_bg_color' ] ) {
			$css['global']['.order-dropdown ul li a:hover']['background-color'] = Aione_Sanitize::color( oxo_color_luminance( Aione()->theme_options[ 'woo_dropdown_bg_color' ], 0.1 ) );
		}

		$css['global']['.catalog-ordering .order li a']['color']            = Aione_Sanitize::color( Aione()->theme_options[ 'woo_dropdown_text_color' ], Aione()->settings->get_default( 'woo_dropdown_text_color' ) );
		$css['global']['.catalog-ordering .order li a']['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'woo_dropdown_bg_color' ], Aione()->settings->get_default( 'woo_dropdown_bg_color' ) );
		$css['global']['.catalog-ordering .order li a']['border-color']     = Aione_Sanitize::color( Aione()->theme_options[ 'woo_dropdown_border_color' ], Aione()->settings->get_default( 'woo_dropdown_border_color' ) );

		$css['global']['.oxo-grid-list-view']['border-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'woo_dropdown_border_color' ], Aione()->settings->get_default( 'woo_dropdown_border_color' ) );

		$css['global']['.oxo-grid-list-view li']['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'woo_dropdown_bg_color' ], Aione()->settings->get_default( 'woo_dropdown_bg_color' ) );
		$css['global']['.oxo-grid-list-view li']['border-color']     = Aione_Sanitize::color( Aione()->theme_options[ 'woo_dropdown_border_color' ], Aione()->settings->get_default( 'woo_dropdown_border_color' ) );

		$css['global']['.oxo-grid-list-view a']['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'woo_dropdown_text_color' ], Aione()->settings->get_default( 'woo_dropdown_text_color' ) );

		$css['global']['.oxo-grid-list-view li a:hover']['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'woo_dropdown_text_color' ], Aione()->settings->get_default( 'woo_dropdown_text_color' ) );

		if ( Aione()->theme_options[ 'woo_dropdown_bg_color' ] ) {
			$css['global']['.oxo-grid-list-view li a:hover']['background-color'] = Aione_Sanitize::color( oxo_color_luminance( Aione()->theme_options[ 'woo_dropdown_bg_color' ], 0.1 ) );
		}

		if ( Aione()->theme_options[ 'woo_dropdown_bg_color' ] ) {
			$css['global']['.oxo-grid-list-view li.active-view']['background-color'] = Aione_Sanitize::color( oxo_color_luminance( Aione()->theme_options[ 'woo_dropdown_bg_color' ], 0.05 ) );
		}

		if ( Aione()->theme_options[ 'woo_dropdown_text_color' ] ) {
			$css['global']['.oxo-grid-list-view li.active-view a i']['color'] = Aione_Sanitize::color( oxo_color_luminance( Aione()->theme_options[ 'woo_dropdown_text_color' ], 0.95 ) );
		}

		if ( is_rtl() ) {
			$woo_message_direction = 'right';
		} else {
			$woo_message_direction = 'left';
		}

		$elements = array(
			'.woocommerce-message:before',
			'.woocommerce-info:before'
		);
		$css['global'][aione_implode( $elements )]['margin-' . $woo_message_direction] = -1 * ( intval( $aione_font_option['font-size'] ) + 3 ) . 'px';

		$elements = array(
			'.woocommerce-message',
			'.woocommerce-info'
		);
		$css['global'][aione_implode( $elements )]['padding-' . $woo_message_direction] = intval( $aione_font_option['font-size'] ) + 3 . 'px';
	}

	if( class_exists( 'Tribe__Events__Main' ) ) {
		$elements = array(
			'.tribe-grid-allday .tribe-events-week-allday-single, .tribe-grid-allday .tribe-events-week-allday-single:hover, .tribe-grid-body .tribe-events-week-hourly-single',
			'.datepicker.dropdown-menu .datepicker-days table tr td.active:hover'
		);
		$color = Aione_Sanitize::color( Aione()->theme_options['primary_color'], Aione()->settings->get_default( 'primary_color' ) );
		$rgb = oxo_hex2rgb( $color );
		$rgba = 'rgba( ' . $rgb[0] . ',' . $rgb[1] . ',' . $rgb[2] . ',' . '0.7' . ')';
		$css['global'][aione_implode( $elements )]['background-color'] = $rgba;

		$elements = array(
			'.oxo-tribe-primary-info .tribe-events-list-event-title a',
			'.oxo-events-single-title-content',
			'.oxo-tribe-primary-info .tribe-events-list-event-title a',
			'.datepicker.dropdown-menu table tr td.day',
			'.datepicker.dropdown-menu table tr td span.month',
			'.tribe-events-venue-widget .tribe-venue-widget-thumbnail .tribe-venue-widget-venue-name',
			".tribe-mini-calendar div[id*='daynum-'] a, .tribe-mini-calendar div[id*='daynum-'] span",
		);
		$color = Aione_Sanitize::color( Aione()->theme_options['primary_color'], Aione()->settings->get_default( 'primary_color' ) );
		$rgb = oxo_hex2rgb( $color );
		$rgba = 'rgba( ' . $rgb[0] . ',' . $rgb[1] . ',' . $rgb[2] . ',' . '0.85' . ')';
		$css['global'][aione_implode( $elements )]['background-color'] = $rgba;

		$elements = array(
			'.tribe-events-list .tribe-events-event-cost',
			'.tribe-events-list .tribe-events-event-cost span',
			'.oxo-tribe-events-headline',
			'#tribe-events .tribe-events-day .tribe-events-day-time-slot h5',
			'.tribe-mobile-day-date',
			'.datepicker.dropdown-menu table thead tr:first-child',
			'.datepicker.dropdown-menu table thead tr:first-child th:hover',
			'.datepicker.dropdown-menu .datepicker-days table tr td.active',
			'.datepicker.dropdown-menu .datepicker-days table tr td:hover',
			'.tribe-grid-header',
			'.datepicker.dropdown-menu table tr td span.month.active',
			'.datepicker.dropdown-menu table tr td span.month:hover',
			'.tribe-grid-body .tribe-events-week-hourly-single:hover',
			'.tribe-events-venue-widget .tribe-venue-widget-venue-name',
			'.tribe-mini-calendar .tribe-mini-calendar-nav td',
			".tribe-mini-calendar div[id*='daynum-'] a:hover",
			'.tribe-mini-calendar td.tribe-events-has-events:hover a',
			'.oxo-body .tribe-mini-calendar td.tribe-events-has-events:hover a:hover',
			'.oxo-body .tribe-mini-calendar td.tribe-events-has-events a:hover',
			'.tribe-mini-calendar td.tribe-events-has-events.tribe-events-present a:hover',
			'.tribe-mini-calendar td.tribe-events-has-events.tribe-mini-calendar-today a:hover',
			".tribe-mini-calendar .tribe-mini-calendar-today div[id*='daynum-'] a",
			".tribe-mini-calendar .tribe-mini-calendar-today div[id*='daynum-'] a",
		);
		$css['global'][aione_implode( $elements )]['background-color'] = Aione_Sanitize::color( Aione()->theme_options['primary_color'], Aione()->settings->get_default( 'primary_color' ) );

		$elements = array(
			'.tribe-grid-header',
			'.tribe-events-grid .tribe-grid-header .tribe-grid-content-wrap .column',
			'.tribe-grid-allday .tribe-events-week-allday-single, .tribe-grid-allday .tribe-events-week-allday-single:hover, .tribe-grid-body .tribe-events-week-hourly-single, .tribe-grid-body .tribe-events-week-hourly-single:hover',
		);
		$css['global'][aione_implode( $elements )]['border-color'] = Aione_Sanitize::color( Aione()->theme_options['primary_color'], Aione()->settings->get_default( 'primary_color' ) );

		$elements = array(
			'.tribe-events-calendar thead th',
			'.tribe-events-calendar td.tribe-events-present div[id*=tribe-events-daynum-]',
			'.tribe-events-calendar td.tribe-events-present div[id*=tribe-events-daynum-]>a',
			'.tribe-events-calendar div[id*=tribe-events-daynum-]',
			'.tribe-events-calendar div[id*=tribe-events-daynum-] a',
			'.tribe-events-calendar td.tribe-events-past div[id*=tribe-events-daynum-]',
			'.tribe-events-calendar td.tribe-events-past div[id*=tribe-events-daynum-]>a',
			'#tribe-events-content .tribe-events-tooltip h4',
			'.tribe-events-list-separator-month',
			'.oxo-tribe-primary-info .tribe-events-list-event-title',
			'.oxo-tribe-primary-info .tribe-events-list-event-title a',
			'.tribe-events-list .tribe-events-event-cost',
			'#tribe-events .oxo-tribe-events-headline h3',
			'#tribe-events .oxo-tribe-events-headline h3 a',
			'#tribe-events .tribe-events-day .tribe-events-day-time-slot h5',
			'.tribe-mobile-day .tribe-mobile-day-date',
			'.datepicker.dropdown-menu table thead tr:first-child',
			'.datepicker.dropdown-menu table tr td.day',
			'.oxo-events-single-title-content h2',
			'.oxo-events-single-title-content h3',
			'.oxo-events-single-title-content span',
			'.tribe-grid-header',
			'.tribe-grid-allday .tribe-events-week-allday-single, .tribe-grid-allday .tribe-events-week-allday-single:hover, .tribe-grid-body .tribe-events-week-hourly-single, .tribe-grid-body .tribe-events-week-hourly-single:hover',
			'.datepicker.dropdown-menu .datepicker-days table tr td.active:hover',
			'.datepicker.dropdown-menu table tr td span.month',
			'.datepicker.dropdown-menu table tr td span.month.active:hover',
			'.recurringinfo',
			'.oxo-events-featured-image .event-is-recurring',
			'.oxo-events-featured-image .event-is-recurring:hover',
			'.oxo-events-featured-image .event-is-recurring a',
			'.tribe-events-venue-widget .tribe-venue-widget-venue-name, .tribe-events-venue-widget .tribe-venue-widget-venue-name a, #slidingbar-area .tribe-events-venue-widget .tribe-venue-widget-venue-name a',
			'.tribe-events-venue-widget .tribe-venue-widget-venue-name, .tribe-events-venue-widget .tribe-venue-widget-venue-name a:hover, #slidingbar-area .tribe-events-venue-widget .tribe-venue-widget-venue-name a:hover',
			'.tribe-mini-calendar .tribe-mini-calendar-nav td',
			".tribe-mini-calendar div[id*='daynum-'] a, .tribe-mini-calendar div[id*='daynum-'] span",
			"#slidingbar-area .tribe-mini-calendar div[id*='daynum-'] a",
			".tribe-mini-calendar div[id*='daynum-'] a:hover",
			'.tribe-mini-calendar .tribe-events-has-events:hover',
			'.tribe-mini-calendar .tribe-events-has-events:hover a',
			'.tribe-mini-calendar .tribe-events-has-events:hover a:hover',
			'.tribe-mini-calendar .tribe-events-has-events a:hover',
			'.tribe-mini-calendar .tribe-events-has-events.tribe-events-present a:hover',
			'.tribe-mini-calendar td.tribe-events-has-events.tribe-mini-calendar-today a:hover',
			'.tribe-mini-calendar .tribe-events-has-events.tribe-mini-calendar-today a',
			'.tribe-mini-calendar .tribe-events-has-events.tribe-mini-calendar-today a',
			".tribe-mini-calendar .tribe-events-othermonth.tribe-mini-calendar-today div[id*='daynum-'] a"
		);
		$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'primary_overlay_text_color' ], Aione()->settings->get_default( 'primary_overlay_text_color' ) );

		$elements = array(
			'#tribe-events .tribe-events-list .tribe-events-event-meta .author > div',
			'.oxo-body #tribe-events .tribe-events-list .tribe-events-event-meta .author > div:last-child',
			'.events-list #tribe-events-footer, .single-tribe_events #tribe-events-footer, #tribe-events #tribe-events-footer',
			'.tribe-grid-allday',
			'.tribe-events-grid .tribe-grid-content-wrap .column',
			'.tribe-week-grid-block div',
			'#tribe-events #tribe-geo-results .type-tribe_events:last-child',
			'.events-archive.events-gridview #tribe-events-content table .type-tribe_events',
			'.tribe-events-viewmore',
			'.oxo-events-before-title h2',
			'#tribe-events .tribe-events-list .type-tribe_events',
			'#tribe-events .tribe-events-list-separator-month+.type-tribe_events.tribe-events-first'
		);
		$css['global'][aione_implode( $elements )]['border-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'ec_border_color' ], Aione()->settings->get_default( 'ec_border_color' ) );

		$elements = array(
			'.tribe-bar-views-inner',
			'#tribe-bar-views .tribe-bar-views-list .tribe-bar-views-option a',
			'#tribe_events_filters_wrapper .tribe-events-filters-group-heading'
		);
		$css['global'][aione_implode( $elements )]['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'ec_bar_bg_color' ], Aione()->settings->get_default( 'ec_bar_bg_color' ) );

		$elements = array(
			'#tribe_events_filters_wrapper .tribe-events-filters-group-heading',
			'.tribe-events-filter-group',
			'.tribe-events-filter-group:after',
			'#tribe_events_filters_wrapper .tribe-events-filter-group label',
			'.tribe-events-filters-horizontal .tribe-events-filter-group:before',
			'.tribe-events-filters-horizontal .tribe-events-filter-group:after',
		);
		$css['global'][aione_implode( $elements )]['border-bottom-color'] = oxo_adjust_brightness( Aione_Sanitize::color( Aione()->theme_options[ 'ec_bar_bg_color' ], Aione()->settings->get_default( 'ec_bar_bg_color' ) ), -25 );

		$elements = array(
			'#tribe-bar-form',
			'#tribe-events-bar:before',
			'#tribe-events-bar:after',
			'#tribe-events-content-wrapper #tribe_events_filters_wrapper.tribe-events-filters-horizontal:before',
			'#tribe-events-content-wrapper #tribe_events_filters_wrapper.tribe-events-filters-horizontal:after',
			'#tribe-bar-collapse-toggle',
			'#tribe-bar-views .tribe-bar-views-list .tribe-bar-views-option a:hover',
			'#tribe-bar-views .tribe-bar-views-list .tribe-bar-views-option.tribe-bar-active a:hover',
			'#tribe-events-content-wrapper #tribe_events_filters_wrapper.tribe-events-filters-horizontal',
			'#tribe-events-content-wrapper #tribe_events_filters_wrapper.tribe-events-filters-vertical .tribe-events-filters-content',
			'#tribe-events-content-wrapper #tribe_events_filters_wrapper:before',
			'#tribe-events-content-wrapper #tribe_events_filters_wrapper:after',
			'.tribe-events-filter-group.tribe-events-filter-autocomplete',
			'.tribe-events-filter-group.tribe-events-filter-multiselect',
			'.tribe-events-filter-group.tribe-events-filter-range',
			'.tribe-events-filter-group.tribe-events-filter-select',
			'#tribe_events_filters_wrapper .tribe-events-filters-group-heading:hover',
			'#tribe_events_filters_wrapper .tribe-events-filter-group label',
			'#tribe_events_filters_wrapper .closed .tribe-events-filters-group-heading:hover'
		);
		$css['global'][aione_implode( $elements )]['background-color'] = oxo_adjust_brightness( Aione_Sanitize::color( Aione()->theme_options[ 'ec_bar_bg_color' ], Aione()->settings->get_default( 'ec_bar_bg_color' ) ), 10 );

		$elements = array(
			'.tribe-events-filters-horizontal .tribe-events-filter-group'
		);
		$css['global'][aione_implode( $elements )]['border-color'] = oxo_adjust_brightness( Aione_Sanitize::color( Aione()->theme_options[ 'ec_bar_bg_color' ], Aione()->settings->get_default( 'ec_bar_bg_color' ) ), -25 );

		$elements = array(
			'.tribe-events-filter-group:after'
		);
		$css['global'][aione_implode( $elements )]['border-bottom-color'] = oxo_adjust_brightness( Aione_Sanitize::color( Aione()->theme_options[ 'ec_bar_bg_color' ], Aione()->settings->get_default( 'ec_bar_bg_color' ) ), 10 );

		$elements = array(
			'#tribe-bar-form label',
			'.tribe-bar-disabled #tribe-bar-form label',
			'#tribe-bar-views .tribe-bar-views-list .tribe-bar-views-option a',
			'#tribe-bar-views .tribe-bar-views-list .tribe-bar-views-option a:hover',
			'#tribe-bar-views .tribe-bar-views-list .tribe-bar-views-option.tribe-bar-active a:hover',
			'#tribe_events_filters_wrapper .tribe-events-filters-label',
			'#tribe_events_filters_wrapper .tribe-events-filters-group-heading',
			'#tribe_events_filters_wrapper .tribe-events-filters-group-heading:after',
			'#tribe_events_filters_wrapper .tribe-events-filters-content > label',
			'#tribe_events_filters_wrapper label span'
		);
		$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'ec_bar_text_color' ], Aione()->settings->get_default( 'ec_bar_text_color' ) );

		$elements = array(
			'.tribe-events-calendar div[id*=tribe-events-daynum-]',
			'.tribe-events-calendar div[id*=tribe-events-daynum-] a',
			'.tribe-events-grid .tribe-grid-header .tribe-week-today'
		);
		$css['global'][aione_implode( $elements )]['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'ec_calendar_heading_bg_color' ], Aione()->settings->get_default( 'ec_calendar_heading_bg_color' ) );


		$elements = array(
			'#tribe-events-content .tribe-events-calendar td.tribe-events-othermonth',
			'.tribe-events-calendar td.tribe-events-past div[id*=tribe-events-daynum-]',
			'.tribe-events-calendar td.tribe-events-past div[id*=tribe-events-daynum-]>a'
		);
		$css['global'][aione_implode( $elements )]['background-color'] = oxo_adjust_brightness( Aione_Sanitize::color( Aione()->theme_options[ 'ec_calendar_heading_bg_color' ], Aione()->settings->get_default( 'ec_calendar_heading_bg_color' ) ), 40 );

		$elements = array(
			'#tribe-events-content .tribe-events-calendar td'
		);
		$css['global'][aione_implode( $elements )]['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'ec_calendar_bg_color' ], Aione()->settings->get_default( 'ec_calendar_bg_color' ) );


		$elements = array(
			'#tribe-events-content .tribe-events-calendar td.tribe-events-othermonth'
		);
		$css['global'][aione_implode( $elements )]['background-color'] = oxo_adjust_brightness( Aione_Sanitize::color( Aione()->theme_options[ 'ec_calendar_bg_color' ], Aione()->settings->get_default( 'ec_calendar_bg_color' ) ), 80 );

		$elements = array(
			'#tribe-events-content .tribe-events-calendar td.tribe-events-othermonth'
		);
		$css['global'][aione_implode( $elements )]['background-color'] = oxo_adjust_brightness( Aione_Sanitize::color( Aione()->theme_options[ 'ec_calendar_bg_color' ], Aione()->settings->get_default( 'ec_calendar_bg_color' ) ), 80 );

		$elements = array(
			'#tribe-events-content .tribe-events-calendar td',
			'#tribe-events-content table.tribe-events-calendar'
		);
		$css['global'][aione_implode( $elements )]['border-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'ec_border_color' ], Aione()->settings->get_default( 'ec_border_color' ) );

		$elements = array(
			'#tribe-events-content .tribe-events-calendar td:hover',
			'.tribe-week-today'
		);
		$css['global'][aione_implode( $elements )]['background-color'] = oxo_adjust_brightness( Aione_Sanitize::color( Aione()->theme_options[ 'ec_calendar_bg_color' ], Aione()->settings->get_default( 'ec_calendar_bg_color' ) ), 60 );

		$elements = array(
			'.tribe-grid-allday',
		);
		$css['global'][aione_implode( $elements )]['background-color'] = oxo_adjust_brightness( Aione_Sanitize::color( Aione()->theme_options[ 'ec_calendar_bg_color' ], Aione()->settings->get_default( 'ec_calendar_bg_color' ) ), 70 );

		$elements = array(
			'.recurring-info-tooltip',
			'#tribe-events-content .tribe-events-tooltip'
		);
		$css['global'][aione_implode( $elements )]['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'ec_tooltip_bg_color' ], Aione()->settings->get_default( 'ec_tooltip_bg_color' ) );

		$elements = array(
			'.tribe-events-tooltip:before',
			'.tribe-events-right .tribe-events-tooltip:before'
		);
		$css['global'][aione_implode( $elements )]['border-top-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'ec_tooltip_bg_color' ], Aione()->settings->get_default( 'ec_tooltip_bg_color' ) );

		$elements = array(
			'.tribe-grid-body .tribe-events-tooltip:before',
			'.tribe-grid-body .tribe-events-tooltip:after',
		);
		$css['global'][aione_implode( $elements )]['border-right-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'ec_tooltip_bg_color' ], Aione()->settings->get_default( 'ec_tooltip_bg_color' ) );

		$elements = array(
			'.tribe-grid-body .tribe-events-right .tribe-events-tooltip:before',
			'.tribe-grid-body .tribe-events-right .tribe-events-tooltip:after'
		);
		$css['global'][aione_implode( $elements )]['border-left-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'ec_tooltip_bg_color' ], Aione()->settings->get_default( 'ec_tooltip_bg_color' ) );

		$elements = array(
			'#tribe-events-content .tribe-events-tooltip'
		);
		$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'ec_tooltip_body_color' ], Aione()->settings->get_default( 'ec_tooltip_body_color' ) );

		$elements = array(
			'.tribe-countdown-timer',
			'.tribe-countdown-text'
		);
		$css['global'][aione_implode( $elements )]['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'countdown_background_color' ], Aione()->settings->get_default( 'countdown_background_color' ) );

		$elements = array(
			'.tribe-countdown-timer .tribe-countdown-number'
		);
		$css['global'][aione_implode( $elements )]['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'countdown_counter_box_color' ], Aione()->settings->get_default( 'countdown_counter_box_color' ) );

		$elements = array(
			'.tribe-countdown-timer .tribe-countdown-number .oxo-tribe-counterdown-over',
			'.tribe-countdown-timer .tribe-countdown-number .tribe-countdown-under',
		);
		$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'countdown_counter_text_color' ], Aione()->settings->get_default( 'countdown_counter_text_color' ) );

		$elements = array(
			'.tribe-events-countdown-widget .tribe-countdown-text, .tribe-events-countdown-widget .tribe-countdown-text a',
			'#slidingbar-area .tribe-events-countdown-widget .tribe-countdown-text, #slidingbar-area .tribe-events-countdown-widget .tribe-countdown-text a',
			'.tribe-events-countdown-widget .tribe-countdown-text, .tribe-events-countdown-widget .tribe-countdown-text a:hover',
			'#slidingbar-area .tribe-events-countdown-widget .tribe-countdown-text, #slidingbar-area .tribe-events-countdown-widget .tribe-countdown-text a:hover'
		);
		$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'countdown_heading_text_color' ], Aione()->settings->get_default( 'countdown_heading_text_color' ) );
	}

	if ( Aione()->theme_options[ 'responsive' ] ) {

		/* =================================================================================================
		Media Queries
		----------------------------------------------------------------------------------------------------
			00 Side Width / Layout Responsive Styles
				# General Styles
				# Grid System
			01 Side Header Responsive Styles
			02 Top Header Responsive Styles
			03 Mobile Menu Responsive Styles
			04 @media only screen and ( max-width: $content_break_point )
				# Layout
				# General Styles
				# Page Title Bar
				# Blog Layouts
				# Author Page - Info
				# Shortcodes
				# Events Calendar
				# Woocommerce
				# Not restructured mobile.css styles
			05 @media only screen and ( min-width: $content_break_point )
				# Shortcodes
			06 @media only screen and ( max-width: 640px )
				# Layout
				# General Styles
				# Page Title Bar
				# Blog Layouts
				# Footer Styles
				# Filters
				# Not restructured mobile.css styles
			07 @media only screen and ( min-device-width: 320px ) and ( max-device-width: 640px )
			08 @media only screen and ( max-width: 480px )
			09 media.css CSS
			10 iPad Landscape Responsive Styles
				# Footer Styles
			11 iPad Portrait Responsive Styles
				# Layout
				# Footer Styles
		================================================================================================= */

		$side_header_width = ( 'top' == Aione()->theme_options[ 'header_position' ] ) ? 0 : intval( Aione()->theme_options[ 'side_header_width' ] );


		/* Side Width / Layout Responsive Styles
		================================================================================================= */
		if ( ! $site_width_percent ) {

			// Site width without units (px)
			$site_width_media_query = '@media only screen and (max-width: ' . $site_width_with_units . ')';

			// Side Header + Site Width without units (px)
			$side_header_width_without_units = Aione_Sanitize::size( Aione()->theme_options[ 'side_header_width' ] );
			$side_header_fwc_breakpoint = $site_width_without_units + $side_header_width_without_units + 60;
			$site_header_and_width_media_query = '@media only screen and (max-width: ' . $side_header_fwc_breakpoint . 'px)';

			$hundred_perecent_width_padding = '';
			if ( ( Aione()->theme_options[ 'hundredp_padding' ] || Aione()->theme_options[ 'hundredp_padding' ] == '0' ) && ! get_post_meta( $c_pageID, 'pyre_hundredp_padding', true ) && ! ( get_post_meta( $c_pageID, 'pyre_hundredp_padding', true ) == '0' ) ) {
				$hundred_perecent_width_padding = Aione()->theme_options[ 'hundredp_padding' ];
			}
			if ( get_post_meta( $c_pageID, 'pyre_hundredp_padding', true ) || get_post_meta( $c_pageID, 'pyre_hundredp_padding', true ) == '0' ) {
				$hundred_perecent_width_padding = get_post_meta( $c_pageID, 'pyre_hundredp_padding', true );
			}

			if ( $hundred_perecent_width_padding ) {
				$elements = array(
					'.width-100 .nonhundred-percent-fullwidth',
					'.width-100 .oxo-section-separator'
				);
				$css[$site_width_media_query][aione_implode( $elements )]['padding-left']  = $hundred_perecent_width_padding . '!important';
				$css[$site_width_media_query][aione_implode( $elements )]['padding-right'] = $hundred_perecent_width_padding . '!important';

				$elements = array(
					'.width-100 .fullwidth-box',
					'.width-100 .oxo-section-separator'
				);
				$css[$site_width_media_query][aione_implode( $elements )]['margin-left']   = sprintf( '-%s!important', $hundred_perecent_width_padding );
				$css[$site_width_media_query][aione_implode( $elements )]['margin-right']  = sprintf( '-%s!important', $hundred_perecent_width_padding );
			}

			// For header left and right, we need to apply padding at:
			// Site width + side header width + 30px * 2 ( 30 extra for it not to jump so harshly )
			if( Aione()->theme_options[ 'header_position' ] == 'left' || Aione()->theme_options[ 'header_position' ] == 'right' ) {
				$elements = array(
					'.width-100 .nonhundred-percent-fullwidth',
					'.width-100 .oxo-section-separator'
				);
				$css[$site_header_and_width_media_query][aione_implode( $elements )]['padding-left']  = $hundred_perecent_width_padding . '!important';
				$css[$site_header_and_width_media_query][aione_implode( $elements )]['padding-right'] = $hundred_perecent_width_padding . '!important';
			}

		}

		// # Grid System

		$main_break_point = (int) Aione()->theme_options[ 'grid_main_break_point' ];
		if ( $main_break_point > 640 ) {
			$breakpoint_range = $main_break_point - 640;
		} else {
			$breakpoint_range = 360;
		}

		$breakpoint_interval = $breakpoint_range / 5;

		$six_columns_breakpoint = $main_break_point + $side_header_width;
		$five_columns_breakpoint = $six_columns_breakpoint - $breakpoint_interval;
		$four_columns_breakpoint = $five_columns_breakpoint - $breakpoint_interval;
		$three_columns_breakpoint = $four_columns_breakpoint - $breakpoint_interval;
		$two_columns_breakpoint = $three_columns_breakpoint - $breakpoint_interval;
		$one_column_breakpoint = $two_columns_breakpoint - $breakpoint_interval;

		$six_columns_media_query = '@media only screen and (min-width: ' . $five_columns_breakpoint . 'px) and (max-width: ' . $six_columns_breakpoint . 'px)';
		$five_columns_media_query = '@media only screen and (min-width: ' . $four_columns_breakpoint . 'px) and (max-width: ' . $five_columns_breakpoint . 'px)';
		$four_columns_media_query = '@media only screen and (min-width: ' . $three_columns_breakpoint . 'px) and (max-width: ' . $four_columns_breakpoint . 'px)';
		$three_columns_media_query = '@media only screen and (min-width: ' . $two_columns_breakpoint . 'px) and (max-width: ' . $three_columns_breakpoint . 'px)';
		$two_columns_media_query = '@media only screen and (max-width: ' . $two_columns_breakpoint . 'px)';
		$one_column_media_query = '@media only screen and (max-width: ' . $one_column_breakpoint . 'px)';

		$ipad_portrait_media_query = '@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: portrait)';

		// Six Column Breakpoint
		$elements = array(
			'.grid-layout-6 .oxo-post-grid',
			'.oxo-portfolio-six .oxo-portfolio-post'
		);
		$css[$six_columns_media_query][aione_implode( $elements )]['width']  = '20% !important';

		$elements = array(
			'.oxo-blog-layout-grid-5 .oxo-post-grid',
			'.oxo-portfolio-five .oxo-portfolio-post'
		);
		$css[$six_columns_media_query][aione_implode( $elements )]['width'] = '25% !important';

		// Five Column Breakpoint
		$elements = array(
			'.oxo-blog-layout-grid-6 .oxo-post-grid',
			'.oxo-portfolio-six .oxo-portfolio-post'
		);
		$css[$five_columns_media_query][aione_implode( $elements )]['width']  = '20% !important';

		$elements = array(
			'.oxo-blog-layout-grid-5 .oxo-post-grid',
			'.oxo-portfolio-five .oxo-portfolio-post'
		);
		$css[$five_columns_media_query][aione_implode( $elements )]['width'] = '33.3333333333% !important';

		$elements = array(
			'.oxo-blog-layout-grid-4 .oxo-post-grid',
			'.oxo-portfolio-four .oxo-portfolio-post'
		);
		$css[$five_columns_media_query][aione_implode( $elements )]['width'] = '33.3333333333% !important';

		// Four Column Breakpoint
		$elements = array(
			'.oxo-blog-layout-grid-6 .oxo-post-grid',
			'.oxo-portfolio-six .oxo-portfolio-post'
		);
		$css[$four_columns_media_query][aione_implode( $elements )]['width'] = '25% !important';

		$elements = array(
			'.oxo-blog-layout-grid-5 .oxo-post-grid',
			'.oxo-blog-layout-grid-4 .oxo-post-grid',
			'.oxo-blog-layout-grid-3 .oxo-post-grid',
			'.oxo-portfolio-five .oxo-portfolio-post',
			'.oxo-portfolio-four .oxo-portfolio-post',
			'.oxo-portfolio-three .oxo-portfolio-post',
			'.oxo-portfolio-masonry .oxo-portfolio-post'
		);
		$css[$four_columns_media_query][aione_implode( $elements )]['width'] = '50% !important';

		// Three Column Breakpoint
		$elements = array(
			'.oxo-blog-layout-grid-6 .oxo-post-grid',
			'.oxo-portfolio-six .oxo-portfolio-post'
		);
		$css[$three_columns_media_query][aione_implode( $elements )]['width'] = '33.33% !important';

		$elements = array(
			'.oxo-blog-layout-grid-5 .oxo-post-grid',
			'.oxo-blog-layout-grid-4 .oxo-post-grid',
			'.oxo-blog-layout-grid-3 .oxo-post-grid',
			'.oxo-portfolio-five .oxo-portfolio-post',
			'.oxo-portfolio-four .oxo-portfolio-post',
			'.oxo-portfolio-three .oxo-portfolio-post',
			'.oxo-portfolio-masonry .oxo-portfolio-post'
		);
		$css[$three_columns_media_query][aione_implode( $elements )]['width'] = '50% !important';

		// Two Column Breakpoint
		$elements = array(
			'.oxo-blog-layout-grid .oxo-post-grid',
			'.oxo-portfolio-post',
		);
		$css[$two_columns_media_query][aione_implode( $elements )]['width'] = '100% !important';

		$elements = array(
			'.oxo-blog-layout-grid-6 .oxo-post-grid',
			'.oxo-portfolio-six .oxo-portfolio-post'
		);
		$css[$two_columns_media_query][aione_implode( $elements )]['width'] = '50% !important';

		// One Column Breakpoint
		$elements = array(
			'.oxo-blog-layout-grid-6 .oxo-post-grid',
			'.oxo-portfolio-six .oxo-portfolio-post'
		);
		$css[$one_column_media_query][aione_implode( $elements )]['width'] = '100% !important';

		// iPad Portrait Column Breakpoint
		$elements = array(
			'.oxo-blog-layout-grid-6 .oxo-post-grid',
			'.oxo-portfolio-six .oxo-portfolio-post'
		);
		$css[$ipad_portrait_media_query][aione_implode( $elements )]['width'] = '33.3333333333% !important';

		$elements = array(
			'.oxo-blog-layout-grid-5 .oxo-post-grid',
			'.oxo-blog-layout-grid-4 .oxo-post-grid',
			'.oxo-blog-layout-grid-3 .oxo-post-grid',
			'.oxo-portfolio-five .oxo-portfolio-post',
			'.oxo-portfolio-four .oxo-portfolio-post',
			'.oxo-portfolio-three .oxo-portfolio-post',
			'.oxo-portfolio-masonry .oxo-portfolio-post'
		);
		$css[$ipad_portrait_media_query][aione_implode( $elements )]['width'] = '50% !important';


		/* Side Header Only Responsive Styles
		================================================================================================= */
		$side_header_media_query = '@media only screen and (max-width: ' . intval( Aione()->theme_options[ 'side_header_break_point' ] ) . 'px)';

		if( Aione()->theme_options['layout'] == 'Boxed' ) {
			$css[$side_header_media_query]['body.side-header #wrapper']['margin-left']  = 'auto !important';
			$css[$side_header_media_query]['body.side-header #wrapper']['margin-right'] = 'auto !important';
		} else {
			$css[$side_header_media_query]['body.side-header #wrapper']['margin-left']  = '0 !important';
			$css[$side_header_media_query]['body.side-header #wrapper']['margin-right'] = '0 !important';
		}

		$elements = array(
			'#side-header',
			'.layout-boxed-mode .side-header-wrapper',
			'.side-header-background'
		);
		$css[$side_header_media_query][aione_implode( $elements )]['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'mobile_header_bg_color' ], Aione()->settings->get_default( 'mobile_header_bg_color' ) );

		$css[$side_header_media_query]['#side-header']['position'] = 'static';
		$css[$side_header_media_query]['#side-header']['height']   = 'auto';
		$css[$side_header_media_query]['#side-header']['width']    = '100% !important';
		$css[$side_header_media_query]['#side-header']['padding']  = '20px 30px 20px 30px !important';
		$css[$side_header_media_query]['#side-header']['margin']   = '0 !important';

		$css[$side_header_media_query]['#side-header .side-header-background']['display']   = 'none';
		$css[$side_header_media_query]['#side-header .side-header-border']['display']   = 'none';

		$css[$side_header_media_query]['#side-header .side-header-wrapper']['padding-bottom'] = '0';
		$css[$side_header_media_query]['#side-header .side-header-wrapper']['position'] = 'relative';

		if ( is_rtl() ) {
			$css[$side_header_media_query]['body.rtl #side-header']['position'] = 'static !important';
		}

		$elements = array(
			'#side-header .header-social',
			'#side-header .header-v4-content'
		);
		$css[$side_header_media_query][aione_implode( $elements )]['display'] = 'none';

		$css[$side_header_media_query]['#side-header .oxo-logo']['margin'] = '0 !important';
		$css[$side_header_media_query]['#side-header .oxo-logo']['float']  = 'left';

		$css[$side_header_media_query]['#side-header .side-header-content']['padding'] = '0 !important';

		$css[$side_header_media_query]['#side-header.oxo-mobile-menu-design-classic .oxo-logo']['float']      = 'none';
		$css[$side_header_media_query]['#side-header.oxo-mobile-menu-design-classic .oxo-logo']['text-align'] = 'center';

		$elements = array(
			'body.side-header #wrapper #side-header.header-shadow .side-header-border:before',
			'body #wrapper .header-shadow:after'
		);
		$css[$side_header_media_query][aione_implode( $elements )]['position']   = 'static';
		$css[$side_header_media_query][aione_implode( $elements )]['height']     = 'auto';
		$css[$side_header_media_query][aione_implode( $elements )]['box-shadow'] = 'none';

		$elements = array(
			'#side-header .oxo-main-menu',
			'#side-header .side-header-content-1-2',
			'#side-header .side-header-content-3'
		);
		$css[$side_header_media_query][aione_implode( $elements )]['display'] = 'none';

		$css[$side_header_media_query]['#side-header .oxo-logo']['margin'] = '0';

		$css[$side_header_media_query]['#side-header.oxo-mobile-menu-design-classic .oxo-main-menu-container .oxo-mobile-nav-holder']['display']    = 'block';
		$css[$side_header_media_query]['#side-header.oxo-mobile-menu-design-classic .oxo-main-menu-container .oxo-mobile-nav-holder']['margin-top'] = '20px';

		$css[$side_header_media_query]['#side-header.oxo-mobile-menu-design-classic .oxo-main-menu-container .oxo-mobile-sticky-nav-holder']['display'] = 'none';

		$css[$side_header_media_query]['#side-header.oxo-mobile-menu-design-modern .oxo-logo']['float']  = 'left';
		$css[$side_header_media_query]['#side-header.oxo-mobile-menu-design-modern .oxo-logo']['margin'] = '0';

		$css[$side_header_media_query]['#side-header.oxo-mobile-menu-design-modern .oxo-logo-left']['float'] = 'left';

		$css[$side_header_media_query]['#side-header.oxo-mobile-menu-design-modern .oxo-logo-right']['float'] = 'right';

		$css[$side_header_media_query]['#side-header.oxo-mobile-menu-design-modern .oxo-logo-center']['float'] = 'left';

		$css[$side_header_media_query]['#side-header.oxo-mobile-menu-design-modern .oxo-mobile-menu-icons']['display'] = 'block';

		$css[$side_header_media_query]['#side-header.oxo-mobile-menu-design-modern .oxo-logo-menu-right .oxo-mobile-menu-icons']['float'] = 'left';
		$css[$side_header_media_query]['#side-header.oxo-mobile-menu-design-modern .oxo-logo-menu-right .oxo-mobile-menu-icons']['position'] = 'static';
		$css[$side_header_media_query]['#side-header.oxo-mobile-menu-design-modern .oxo-logo-menu-right .oxo-mobile-menu-icons a']['float'] = 'left';
		$css[$side_header_media_query]['#side-header.oxo-mobile-menu-design-modern .oxo-logo-menu-right .oxo-mobile-menu-icons :first-child']['margin-left'] = '0';

		$css[$side_header_media_query]['#side-header.oxo-mobile-menu-design-modern .oxo-logo-menu-left .oxo-mobile-menu-icons']['float'] = 'right';

		$css[$side_header_media_query]['#side-header.oxo-mobile-menu-design-modern .oxo-logo-menu-left .oxo-mobile-menu-icons a:last-child']['margin-left'] = '0';


		$elements = array(
			'#side-header.oxo-mobile-menu-design-modern .oxo-main-menu-container .oxo-mobile-nav-holder',
			'#side-header.oxo-mobile-menu-design-modern .side-header-wrapper > .oxo-secondary-menu-search'
		);

		$css[$side_header_media_query][aione_implode( $elements )]['padding-top']    = '20px';
		$css[$side_header_media_query][aione_implode( $elements )]['margin-left']    = '-30px';
		$css[$side_header_media_query][aione_implode( $elements )]['margin-right']   = '-30px';
		$css[$side_header_media_query][aione_implode( $elements )]['margin-bottom']  = '-20px';

		$css[$side_header_media_query]['#side-header.oxo-mobile-menu-design-modern .oxo-main-menu-container .oxo-mobile-nav-holder > ul']['display']       = 'block';
		$css[$side_header_media_query]['#side-header.oxo-mobile-menu-design-modern .oxo-main-menu-container .oxo-mobile-nav-holder > ul']['border-right']  = '0';
		$css[$side_header_media_query]['#side-header.oxo-mobile-menu-design-modern .oxo-main-menu-container .oxo-mobile-nav-holder > ul']['border-left']   = '0';
		$css[$side_header_media_query]['#side-header.oxo-mobile-menu-design-modern .oxo-main-menu-container .oxo-mobile-nav-holder > ul']['border-bottom'] = '0';


		$css[$side_header_media_query]['#side-header.oxo-is-sticky.oxo-sticky-menu-1 .oxo-mobile-nav-holder']['display'] = 'none';

		$css[$side_header_media_query]['#side-header.oxo-is-sticky.oxo-sticky-menu-1 .oxo-mobile-sticky-nav-holder']['display'] = 'none';


		/* Top Header Only Responsive Styles
		================================================================================================= */
		$mobile_header_media_query = '@media only screen and (max-width: ' . intval( Aione()->theme_options[ 'side_header_break_point' ] ) . 'px)';

		$css[$mobile_header_media_query]['.oxo-mobile-menu-design-modern .oxo-secondary-header']['padding'] = '0px';

		$css[$mobile_header_media_query]['.oxo-mobile-menu-design-modern .oxo-secondary-header .oxo-row']['padding-left']  = '0px';
		$css[$mobile_header_media_query]['.oxo-mobile-menu-design-modern .oxo-secondary-header .oxo-row']['padding-right'] = '0px';

		$css[$mobile_header_media_query]['.oxo-mobile-menu-design-modern .oxo-social-links-header']['max-width']  = '100%';
		$css[$mobile_header_media_query]['.oxo-mobile-menu-design-modern .oxo-social-links-header']['text-align'] = 'center';
		$css[$mobile_header_media_query]['.oxo-mobile-menu-design-modern .oxo-social-links-header']['margin-top'] = '10px';
		$css[$mobile_header_media_query]['.oxo-mobile-menu-design-modern .oxo-social-links-header']['margin-bottom'] = '8px';

		$css[$mobile_header_media_query]['.oxo-mobile-menu-design-modern .oxo-social-links-header a']['margin-right']  = '20px';
		$css[$mobile_header_media_query]['.oxo-mobile-menu-design-modern .oxo-social-links-header a']['margin-bottom'] = '5px';

		$css[$mobile_header_media_query]['.oxo-mobile-menu-design-modern .oxo-alignleft']['border-bottom'] = '1px solid transparent';

		$elements = array(
			'.oxo-mobile-menu-design-modern .oxo-alignleft',
			'.oxo-mobile-menu-design-modern .oxo-alignright'
		);
		$css[$mobile_header_media_query][aione_implode( $elements )]['width']      = '100%';
		$css[$mobile_header_media_query][aione_implode( $elements )]['float']      = 'none';
		$css[$mobile_header_media_query][aione_implode( $elements )]['display']    = 'block';


		$elements = array(
			'.oxo-body .oxo-mobile-menu-design-modern .oxo-secondary-header .oxo-alignleft',
			'.oxo-body .oxo-mobile-menu-design-modern .oxo-secondary-header .oxo-alignright'
		);
		$css[$mobile_header_media_query][aione_implode( $elements )]['text-align'] = 'center';

		$css[$mobile_header_media_query]['.oxo-mobile-menu-design-modern .oxo-secondary-menu > ul > li']['display']    				= 'inline-block';
		$css[$mobile_header_media_query]['.oxo-body .oxo-mobile-menu-design-modern .oxo-secondary-menu > ul > li']['float']      = 'none';
		$css[$mobile_header_media_query]['.oxo-mobile-menu-design-modern .oxo-secondary-menu > ul > li']['text-align'] 				= 'left';

		$css[$mobile_header_media_query]['.oxo-mobile-menu-design-modern .oxo-secondary-menu-cart']['border-right'] = '0';

		$css[$mobile_header_media_query]['.oxo-mobile-menu-design-modern .oxo-secondary-menu-icon']['background-color'] = 'transparent';
		$css[$mobile_header_media_query]['.oxo-mobile-menu-design-modern .oxo-secondary-menu-icon']['padding-left']     = '10px';
		$css[$mobile_header_media_query]['.oxo-mobile-menu-design-modern .oxo-secondary-menu-icon']['padding-right']    = '7px';
		$css[$mobile_header_media_query]['.oxo-mobile-menu-design-modern .oxo-secondary-menu-icon']['min-width']        = '100%';

		$css[$mobile_header_media_query]['.oxo-mobile-menu-design-modern .oxo-secondary-menu-icon:after']['display'] = 'none';

		$elements = array(
			'.oxo-mobile-menu-design-modern .oxo-secondary-menu .oxo-secondary-menu-icon',
			'.oxo-mobile-menu-design-modern .oxo-secondary-menu .oxo-secondary-menu-icon:hover',
			'.oxo-mobile-menu-design-modern .oxo-secondary-menu-icon:before'
		);
		$css[$mobile_header_media_query][aione_implode( $elements )]['color'] = Aione_Sanitize::color( Aione()->theme_options[ 'snav_color' ], Aione()->settings->get_default( 'snav_color' ) );

		$css[$mobile_header_media_query]['.oxo-mobile-menu-design-modern .oxo-header-tagline']['margin-top']  = '10px';
		$css[$mobile_header_media_query]['.oxo-mobile-menu-design-modern .oxo-header-tagline']['float']       = 'none';
		$css[$mobile_header_media_query]['.oxo-mobile-menu-design-modern .oxo-header-tagline']['line-height'] = '24px';

		/* Mobile Menu Responsive Styles
		================================================================================================= */
		$mobile_menu_media_query = '@media only screen and (max-width: ' . ( intval( $side_header_width ) + intval( Aione()->theme_options[ 'side_header_break_point' ] ) ) . 'px)';

		$css[$mobile_menu_media_query]['.oxo-mobile-menu-design-modern .oxo-secondary-header']['padding-left'] = '0 !important';
		$css[$mobile_menu_media_query]['.oxo-mobile-menu-design-modern .oxo-secondary-header']['padding-right'] = '0 !important';

		$css[$mobile_menu_media_query]['.oxo-header .oxo-row']['padding-left']  = '0';
		$css[$mobile_menu_media_query]['.oxo-header .oxo-row']['padding-right'] = '0';

		$elements = array(
			'.oxo-header-wrapper .oxo-header',
			//'.oxo-header-wrapper .oxo-secondary-main-menu'
		);
		$css[$mobile_menu_media_query][aione_implode( $elements )]['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'mobile_header_bg_color' ], Aione()->settings->get_default( 'mobile_header_bg_color' ) );

		$css[$mobile_menu_media_query]['.oxo-header-wrapper .oxo-row']['padding-left']  = '0';
		$css[$mobile_menu_media_query]['.oxo-header-wrapper .oxo-row']['padding-right'] = '0';
		$css[$mobile_menu_media_query]['.oxo-header-wrapper .oxo-row']['max-width'] = '100%';

		$elements = array(
			'.oxo-footer-widget-area > .oxo-row',
			'.oxo-footer-copyright-area > .oxo-row'
		);
		$css[$mobile_menu_media_query][aione_implode( $elements )]['padding-left']  = '0';
		$css[$mobile_menu_media_query][aione_implode( $elements )]['padding-right'] = '0';

		$css[$mobile_menu_media_query]['.oxo-secondary-header .oxo-row']['display'] = 'block';
		$css[$mobile_menu_media_query]['.oxo-secondary-header .oxo-alignleft']['margin-right'] = '0';
		$css[$mobile_menu_media_query]['.oxo-secondary-header .oxo-alignright']['margin-left'] = '0';
		$css[$mobile_menu_media_query]['body.oxo-body .oxo-secondary-header .oxo-alignright > *']['float'] = 'none';
		$css[$mobile_menu_media_query]['body.oxo-body .oxo-secondary-header .oxo-alignright .oxo-social-links-header .boxed-icons']['margin-bottom'] = '5px';

		$elements = array(
			'.oxo-mobile-menu-design-classic.oxo-header-v1 .oxo-header',
			'.oxo-mobile-menu-design-classic.oxo-header-v2 .oxo-header',
			'.oxo-mobile-menu-design-classic.oxo-header-v3 .oxo-header'
		);
		$css[$mobile_menu_media_query][aione_implode( $elements )]['padding-top']    = '20px';
		$css[$mobile_menu_media_query][aione_implode( $elements )]['padding-bottom'] = '20px';


		$css[$mobile_menu_media_query]['.oxo-header-v4 .oxo-logo']['display']  = 'block';
		$css[$mobile_menu_media_query]['.oxo-header-v4.oxo-mobile-menu-design-modern .oxo-logo .oxo-logo-link']['max-width']  = '75%';
		$css[$mobile_menu_media_query]['.oxo-header-v4.oxo-mobile-menu-design-modern .oxo-mobile-menu-icons']['position'] = 'absolute';

		$elements = array(
			'.oxo-mobile-menu-design-classic.oxo-header-v1 .oxo-logo',
			'.oxo-mobile-menu-design-classic.oxo-header-v2 .oxo-logo',
			'.oxo-mobile-menu-design-classic.oxo-header-v3 .oxo-logo',
			'.oxo-mobile-menu-design-classic.oxo-header-v1 .oxo-logo a',
			'.oxo-mobile-menu-design-classic.oxo-header-v2 .oxo-logo a',
			'.oxo-mobile-menu-design-classic.oxo-header-v3 .oxo-logo a'
		);
		$css[$mobile_menu_media_query][aione_implode( $elements )]['float']      = 'none';
		$css[$mobile_menu_media_query][aione_implode( $elements )]['text-align'] = 'center';
		$css[$mobile_menu_media_query][aione_implode( $elements )]['margin']     = '0 !important';

		$elements = array(
			'.oxo-mobile-menu-design-classic.oxo-header-v1 .oxo-main-menu',
			'.oxo-mobile-menu-design-classic.oxo-header-v2 .oxo-main-menu',
			'.oxo-mobile-menu-design-classic.oxo-header-v3 .oxo-main-menu'
		);
		$css[$mobile_menu_media_query][aione_implode( $elements )]['display'] = 'none';

		$elements = array(
			'.oxo-mobile-menu-design-classic.oxo-header-v1 .oxo-mobile-nav-holder',
			'.oxo-mobile-menu-design-classic.oxo-header-v2 .oxo-mobile-nav-holder',
			'.oxo-mobile-menu-design-classic.oxo-header-v3 .oxo-mobile-nav-holder'
		);
		$css[$mobile_menu_media_query][aione_implode( $elements )]['display']    = 'block';
		$css[$mobile_menu_media_query][aione_implode( $elements )]['margin-top'] = '20px';

		$css[$mobile_menu_media_query]['.oxo-mobile-menu-design-classic .oxo-secondary-header']['padding'] = '10px';

		$css[$mobile_menu_media_query]['.oxo-mobile-menu-design-classic .oxo-secondary-header .oxo-mobile-nav-holder']['margin-top'] = '0';

		$elements = array(
			'.oxo-mobile-menu-design-classic.oxo-header-v4 .oxo-header',
			'.oxo-mobile-menu-design-classic.oxo-header-v5 .oxo-header'
		);
		$css[$mobile_menu_media_query][aione_implode( $elements )]['padding-top']    = '20px';
		$css[$mobile_menu_media_query][aione_implode( $elements )]['padding-bottom'] = '20px';

		$elements = array(
			'.oxo-mobile-menu-design-classic.oxo-header-v4 .oxo-secondary-main-menu',
			'.oxo-mobile-menu-design-classic.oxo-header-v5 .oxo-secondary-main-menu'
		);
		$css[$mobile_menu_media_query][aione_implode( $elements )]['padding-top']    = '6px';
		$css[$mobile_menu_media_query][aione_implode( $elements )]['padding-bottom'] = '6px';

		$elements = array(
			'.oxo-mobile-menu-design-classic.oxo-header-v4 .oxo-main-menu',
			'.oxo-mobile-menu-design-classic.oxo-header-v5 .oxo-main-menu'
		);
		$css[$mobile_menu_media_query][aione_implode( $elements )]['display'] = 'none';

		$elements = array(
			'.oxo-mobile-menu-design-classic.oxo-header-v4 .oxo-mobile-nav-holder',
			'.oxo-mobile-menu-design-classic.oxo-header-v5 .oxo-mobile-nav-holder'
		);
		$css[$mobile_menu_media_query][aione_implode( $elements )]['display'] = 'block';

		$elements = array(
			'.oxo-mobile-menu-design-classic.oxo-header-v4 .oxo-logo',
			'.oxo-mobile-menu-design-classic.oxo-header-v5 .oxo-logo',
			'.oxo-mobile-menu-design-classic.oxo-header-v4 .oxo-logo a',
			'.oxo-mobile-menu-design-classic.oxo-header-v5 .oxo-logo a'
		);
		$css[$mobile_menu_media_query][aione_implode( $elements )]['float']      = 'none';
		$css[$mobile_menu_media_query][aione_implode( $elements )]['text-align'] = 'center';
		$css[$mobile_menu_media_query][aione_implode( $elements )]['margin']     = '0 !important';

		$elements = array(
			'.oxo-mobile-menu-design-classic.oxo-header-v4 .searchform',
			'.oxo-mobile-menu-design-classic.oxo-header-v5 .searchform'
		);
		$css[$mobile_menu_media_query][aione_implode( $elements )]['display']    = 'block';
		$css[$mobile_menu_media_query][aione_implode( $elements )]['float']      = 'none';
		$css[$mobile_menu_media_query][aione_implode( $elements )]['width']      = '100%';
		$css[$mobile_menu_media_query][aione_implode( $elements )]['margin']     = '0';
		$css[$mobile_menu_media_query][aione_implode( $elements )]['margin-top'] = '13px';

		$elements = array(
			'.oxo-mobile-menu-design-classic.oxo-header-v4 .search-table',
			'.oxo-mobile-menu-design-classic.oxo-header-v5 .search-table'
		);
		$css[$mobile_menu_media_query][aione_implode( $elements )]['width'] = '100%';

		$css[$mobile_menu_media_query]['.oxo-mobile-menu-design-classic.oxo-header-v4 .oxo-logo a']['float'] = 'none';

		$css[$mobile_menu_media_query]['.oxo-mobile-menu-design-classic.oxo-header-v4 .oxo-header-banner']['margin-top'] = '10px';

		$css[$mobile_menu_media_query]['.oxo-mobile-menu-design-classic.oxo-header-v4 .oxo-secondary-main-menu .searchform']['display'] = 'none';

		$css[$mobile_menu_media_query]['.oxo-mobile-menu-design-classic .oxo-alignleft']['margin-bottom'] = '10px';

		$elements = array(
			'.oxo-mobile-menu-design-classic .oxo-alignleft',
			'.oxo-mobile-menu-design-classic .oxo-alignright'
		);
		$css[$mobile_menu_media_query][aione_implode( $elements )]['float']       = 'none';
		$css[$mobile_menu_media_query][aione_implode( $elements )]['width']       = '100%';
		$css[$mobile_menu_media_query][aione_implode( $elements )]['line-height'] = 'normal';
		$css[$mobile_menu_media_query][aione_implode( $elements )]['display']     = 'block';

		$css[$mobile_menu_media_query]['.oxo-header-wrapper .oxo-mobile-menu-design-classic .oxo-contact-info']['text-align']  = 'center';
		$css[$mobile_menu_media_query]['.oxo-header-wrapper .oxo-mobile-menu-design-classic .oxo-contact-info']['line-height'] = 'normal';

		$css[$mobile_menu_media_query]['.oxo-header-wrapper .oxo-mobile-menu-design-classic .oxo-secondary-menu']['display'] = 'none';

		$css[$mobile_menu_media_query]['.oxo-header-wrapper .oxo-mobile-menu-design-classic .oxo-social-links-header']['max-width']     = '100%';
		$css[$mobile_menu_media_query]['.oxo-header-wrapper .oxo-mobile-menu-design-classic .oxo-social-links-header']['margin-top']    = '5px';
		$css[$mobile_menu_media_query]['.oxo-header-wrapper .oxo-mobile-menu-design-classic .oxo-social-links-header']['text-align']    = 'center';

		$css[$mobile_menu_media_query]['.oxo-header-wrapper .oxo-mobile-menu-design-classic .oxo-social-links-header a']['margin-bottom'] = '5px';

		$css[$mobile_menu_media_query]['.oxo-header-wrapper .oxo-mobile-menu-design-classic .oxo-header-tagline']['float']       = 'none';
		$css[$mobile_menu_media_query]['.oxo-header-wrapper .oxo-mobile-menu-design-classic .oxo-header-tagline']['text-align']  = 'center';
		$css[$mobile_menu_media_query]['.oxo-header-wrapper .oxo-mobile-menu-design-classic .oxo-header-tagline']['margin-top']  = '10px';
		$css[$mobile_menu_media_query]['.oxo-header-wrapper .oxo-mobile-menu-design-classic .oxo-header-tagline']['line-height'] = '24px';
		$css[$mobile_menu_media_query]['.oxo-header-wrapper .oxo-mobile-menu-design-classic .oxo-header-tagline']['margin-left'] = 'auto';
		$css[$mobile_menu_media_query]['.oxo-header-wrapper .oxo-mobile-menu-design-classic .oxo-header-tagline']['margin-right'] = 'auto';

		$css[$mobile_menu_media_query]['.oxo-header-wrapper .oxo-mobile-menu-design-classic .oxo-header-banner']['float']      = 'none';
		$css[$mobile_menu_media_query]['.oxo-header-wrapper .oxo-mobile-menu-design-classic .oxo-header-banner']['text-align'] = 'center';
		$css[$mobile_menu_media_query]['.oxo-header-wrapper .oxo-mobile-menu-design-classic .oxo-header-banner']['margin']     = '0 auto';
		$css[$mobile_menu_media_query]['.oxo-header-wrapper .oxo-mobile-menu-design-classic .oxo-header-banner']['width']      = '100%';
		$css[$mobile_menu_media_query]['.oxo-header-wrapper .oxo-mobile-menu-design-classic .oxo-header-banner']['margin-top'] = '20px';
		$css[$mobile_menu_media_query]['.oxo-header-wrapper .oxo-mobile-menu-design-classic .oxo-header-banner']['clear']      = 'both';

		$elements = array(
			'.oxo-mobile-menu-design-modern .ubermenu-responsive-toggle',
			'.oxo-mobile-menu-design-modern .ubermenu-sticky-toggle-wrapper'
		);
		$css[$mobile_menu_media_query][aione_implode( $elements )]['clear'] = 'both';

		$elements = array(
			'.oxo-mobile-menu-design-modern.oxo-header-v1 .oxo-main-menu',
			'.oxo-mobile-menu-design-modern.oxo-header-v2 .oxo-main-menu',
			'.oxo-mobile-menu-design-modern.oxo-header-v3 .oxo-main-menu',
			'.oxo-mobile-menu-design-modern.oxo-header-v4 .oxo-main-menu',
			'.oxo-mobile-menu-design-modern.oxo-header-v5 .oxo-main-menu'
		);
		$css[$mobile_menu_media_query][aione_implode( $elements )]['display'] = 'none';

		$elements = array(
			'.oxo-mobile-menu-design-modern.oxo-header-v1 .oxo-header',
			'.oxo-mobile-menu-design-modern.oxo-header-v2 .oxo-header',
			'.oxo-mobile-menu-design-modern.oxo-header-v3 .oxo-header',
			'.oxo-mobile-menu-design-modern.oxo-header-v4 .oxo-header',
			'.oxo-mobile-menu-design-modern.oxo-header-v5 .oxo-header'
		);
		$css[$mobile_menu_media_query][aione_implode( $elements )]['padding-top']    = '20px';
		$css[$mobile_menu_media_query][aione_implode( $elements )]['padding-bottom'] = '20px';

		$elements = aione_map_selector( $elements, ' .oxo-row' );
		$css[$mobile_menu_media_query][aione_implode( $elements )]['width'] = '100%';

		$elements = array(
			'.oxo-mobile-menu-design-modern.oxo-header-v1 .oxo-logo',
			'.oxo-mobile-menu-design-modern.oxo-header-v2 .oxo-logo',
			'.oxo-mobile-menu-design-modern.oxo-header-v3 .oxo-logo',
			'.oxo-mobile-menu-design-modern.oxo-header-v4 .oxo-logo',
			'.oxo-mobile-menu-design-modern.oxo-header-v5 .oxo-logo'
		);
		$css[$mobile_menu_media_query][aione_implode( $elements )]['margin'] = '0 !important';

		$elements = array(
			'.oxo-mobile-menu-design-modern.oxo-header-v1 .modern-mobile-menu-expanded .oxo-logo',
			'.oxo-mobile-menu-design-modern.oxo-header-v2 .modern-mobile-menu-expanded .oxo-logo',
			'.oxo-mobile-menu-design-modern.oxo-header-v3 .modern-mobile-menu-expanded .oxo-logo',
			'.oxo-mobile-menu-design-modern.oxo-header-v4 .modern-mobile-menu-expanded .oxo-logo',
			'.oxo-mobile-menu-design-modern.oxo-header-v5 .modern-mobile-menu-expanded .oxo-logo'
		);
		$css[$mobile_menu_media_query][aione_implode( $elements )]['margin-bottom'] = '20px !important';

		$elements = array(
			'.oxo-mobile-menu-design-modern.oxo-header-v1 .oxo-mobile-nav-holder',
			'.oxo-mobile-menu-design-modern.oxo-header-v2 .oxo-mobile-nav-holder',
			'.oxo-mobile-menu-design-modern.oxo-header-v3 .oxo-mobile-nav-holder',
			'.oxo-mobile-menu-design-modern.oxo-header-v4 .oxo-mobile-nav-holder',
			'.oxo-mobile-menu-design-modern.oxo-header-v5 .oxo-mobile-nav-holder'
		);
		$css[$mobile_menu_media_query][aione_implode( $elements )]['padding-top']   = '20px';
		$css[$mobile_menu_media_query][aione_implode( $elements )]['margin-left']   = '-30px';
		$css[$mobile_menu_media_query][aione_implode( $elements )]['margin-right']  = '-30px';
		$css[$mobile_menu_media_query][aione_implode( $elements )]['margin-bottom'] = 'calc(-20px - ' . Aione_Sanitize::get_value_with_unit( Aione()->theme_options[ 'margin_header_bottom' ] ) . ')';

		$elements = aione_map_selector( $elements, ' > ul' );
		$css[$mobile_menu_media_query][aione_implode( $elements )]['display'] = 'block';

		$elements = array(
			'.oxo-mobile-menu-design-modern.oxo-header-v1 .oxo-mobile-sticky-nav-holder',
			'.oxo-mobile-menu-design-modern.oxo-header-v2 .oxo-mobile-sticky-nav-holder',
			'.oxo-mobile-menu-design-modern.oxo-header-v3 .oxo-mobile-sticky-nav-holder',
			'.oxo-mobile-menu-design-modern.oxo-header-v4 .oxo-mobile-sticky-nav-holder',
			'.oxo-mobile-menu-design-modern.oxo-header-v5 .oxo-mobile-sticky-nav-holder'
		);
		$css[$mobile_menu_media_query][aione_implode( $elements )]['display'] = 'none';

		$elements = array(
			'.oxo-mobile-menu-design-modern.oxo-header-v1 .oxo-mobile-menu-icons',
			'.oxo-mobile-menu-design-modern.oxo-header-v2 .oxo-mobile-menu-icons',
			'.oxo-mobile-menu-design-modern.oxo-header-v3 .oxo-mobile-menu-icons',
			'.oxo-mobile-menu-design-modern.oxo-header-v4 .oxo-mobile-menu-icons',
			'.oxo-mobile-menu-design-modern.oxo-header-v5 .oxo-mobile-menu-icons'
		);
		$css[$mobile_menu_media_query][aione_implode( $elements )]['display'] = 'block';

		$css[$mobile_menu_media_query]['.oxo-mobile-menu-design-modern.oxo-header-v4 .oxo-logo a']['float'] = 'none';

		$css[$mobile_menu_media_query]['.oxo-mobile-menu-design-modern.oxo-header-v4 .oxo-logo .searchform']['float']   = 'none';
		$css[$mobile_menu_media_query]['.oxo-mobile-menu-design-modern.oxo-header-v4 .oxo-logo .searchform']['display'] = 'none';

		$css[$mobile_menu_media_query]['.oxo-mobile-menu-design-modern.oxo-header-v4 .oxo-header-banner']['margin-top'] = '10px';

		$css[$mobile_menu_media_query]['.oxo-mobile-menu-design-modern.oxo-header-v5.oxo-logo-center .oxo-logo']['float'] = 'left';

		if ( is_rtl() ) {
			$css[$mobile_menu_media_query]['.rtl .oxo-mobile-menu-design-modern.oxo-header-v5.oxo-logo-center .oxo-logo']['float'] = 'right';

			$css[$mobile_menu_media_query]['.rtl .oxo-mobile-menu-design-modern.oxo-header-v5.oxo-logo-center .oxo-mobile-menu-icons']['float'] = 'left';

			$css[$mobile_menu_media_query]['.rtl .oxo-mobile-menu-design-modern.oxo-header-v5.oxo-logo-center .oxo-mobile-menu-icons a']['float']        = 'left';
			$css[$mobile_menu_media_query]['.rtl .oxo-mobile-menu-design-modern.oxo-header-v5.oxo-logo-center .oxo-mobile-menu-icons a']['margin-left']  = '0';
			$css[$mobile_menu_media_query]['.rtl .oxo-mobile-menu-design-modern.oxo-header-v5.oxo-logo-center .oxo-mobile-menu-icons a']['margin-right'] = '15px';
		}

		$elements = array(
			'.oxo-mobile-menu-design-modern.oxo-header-v4 .oxo-mobile-nav-holder',
			'.oxo-mobile-menu-design-modern.oxo-header-v5 .oxo-mobile-nav-holder'
		);
		$css[$mobile_menu_media_query][aione_implode( $elements )]['padding-top']   = '0';
		$css[$mobile_menu_media_query][aione_implode( $elements )]['margin-left']   = '-30px';
		$css[$mobile_menu_media_query][aione_implode( $elements )]['margin-right']  = '-30px';
		$css[$mobile_menu_media_query][aione_implode( $elements )]['margin-bottom'] = '0';

		$elements = array(
			'.oxo-mobile-menu-design-modern.oxo-header-v4 .oxo-secondary-main-menu',
			'.oxo-mobile-menu-design-modern.oxo-header-v5 .oxo-secondary-main-menu'
		);
		$css[$mobile_menu_media_query][aione_implode( $elements )]['position'] = 'static';
		$css[$mobile_menu_media_query][aione_implode( $elements )]['border']   = '0';

		$elements = array(
			'.oxo-mobile-menu-design-modern.oxo-header-v4 .oxo-secondary-main-menu .oxo-mobile-nav-holder > ul',
			'.oxo-mobile-menu-design-modern.oxo-header-v5 .oxo-secondary-main-menu .oxo-mobile-nav-holder > ul'
		);
		$css[$mobile_menu_media_query][aione_implode( $elements )]['border'] = '0';

		$elements = array(
			'.oxo-mobile-menu-design-modern.oxo-header-v4 .oxo-secondary-main-menu .searchform',
			'.oxo-mobile-menu-design-modern.oxo-header-v5 .oxo-secondary-main-menu .searchform'
		);
		$css[$mobile_menu_media_query][aione_implode( $elements )]['float'] = 'none';

		$elements = array(
			'.oxo-is-sticky .oxo-mobile-menu-design-modern.oxo-header-v4 .oxo-sticky-header-wrapper',
			'.oxo-is-sticky .oxo-mobile-menu-design-modern.oxo-header-v5 .oxo-sticky-header-wrapper'
		);
		$css[$mobile_menu_media_query][aione_implode( $elements )]['position'] = 'fixed';
		$css[$mobile_menu_media_query][aione_implode( $elements )]['width']    = '100%';

		$elements = array(
			'.oxo-mobile-menu-design-modern.oxo-logo-right.oxo-header-v4 .oxo-logo',
			'.oxo-mobile-menu-design-modern.oxo-logo-right.oxo-header-v5 .oxo-logo'
		);
		$css[$mobile_menu_media_query][aione_implode( $elements )]['float'] = 'right';

		$elements = array(
			'.oxo-mobile-menu-design-modern.oxo-sticky-menu-only.oxo-header-v4 .oxo-secondary-main-menu',
			'.oxo-mobile-menu-design-modern.oxo-sticky-menu-only.oxo-header-v5 .oxo-secondary-main-menu'
		);
		$css[$mobile_menu_media_query][aione_implode( $elements )]['position'] = 'static';

		$elements = array(
			'.oxo-mobile-menu-design-classic.oxo-header-v1 .oxo-mobile-sticky-nav-holder',
			'.oxo-mobile-menu-design-classic.oxo-header-v2 .oxo-mobile-sticky-nav-holder',
			'.oxo-mobile-menu-design-classic.oxo-header-v3 .oxo-mobile-sticky-nav-holder',
			'.oxo-mobile-menu-design-classic.oxo-header-v4 .oxo-mobile-sticky-nav-holder',
			'.oxo-mobile-menu-design-classic.oxo-header-v5 .oxo-mobile-sticky-nav-holder',
			'.oxo-mobile-menu-design-modern.oxo-header-v1 .oxo-mobile-sticky-nav-holder',
			'.oxo-mobile-menu-design-modern.oxo-header-v2 .oxo-mobile-sticky-nav-holder',
			'.oxo-mobile-menu-design-modern.oxo-header-v3 .oxo-mobile-sticky-nav-holder',
			'.oxo-mobile-menu-design-modern.oxo-header-v4 .oxo-mobile-sticky-nav-holder',
			'.oxo-mobile-menu-design-modern.oxo-header-v5 .oxo-mobile-sticky-nav-holder'
		);
		$css[$mobile_menu_media_query][aione_implode( $elements )]['display'] = 'none';

		$elements = array(
			'.oxo-is-sticky .oxo-mobile-menu-design-classic.oxo-header-v1.oxo-sticky-menu-1 .oxo-mobile-nav-holder',
			'.oxo-is-sticky .oxo-mobile-menu-design-classic.oxo-header-v2.oxo-sticky-menu-1 .oxo-mobile-nav-holder',
			'.oxo-is-sticky .oxo-mobile-menu-design-classic.oxo-header-v3.oxo-sticky-menu-1 .oxo-mobile-nav-holder',
			'.oxo-is-sticky .oxo-mobile-menu-design-classic.oxo-header-v4.oxo-sticky-menu-1 .oxo-mobile-nav-holder',
			'.oxo-is-sticky .oxo-mobile-menu-design-classic.oxo-header-v5.oxo-sticky-menu-1 .oxo-mobile-nav-holder',
			'.oxo-is-sticky .oxo-mobile-menu-design-modern.oxo-header-v1.oxo-sticky-menu-1 .oxo-mobile-nav-holder',
			'.oxo-is-sticky .oxo-mobile-menu-design-modern.oxo-header-v2.oxo-sticky-menu-1 .oxo-mobile-nav-holder',
			'.oxo-is-sticky .oxo-mobile-menu-design-modern.oxo-header-v3.oxo-sticky-menu-1 .oxo-mobile-nav-holder',
			'.oxo-is-sticky .oxo-mobile-menu-design-modern.oxo-header-v4.oxo-sticky-menu-1 .oxo-mobile-nav-holder',
			'.oxo-is-sticky .oxo-mobile-menu-design-modern.oxo-header-v5.oxo-sticky-menu-1 .oxo-mobile-nav-holder'
		);
		$css[$mobile_menu_media_query][aione_implode( $elements )]['display'] = 'none';

		$elements = array(
			'.oxo-mobile-menu-design-classic .oxo-mobile-nav-item',
			'.oxo-mobile-menu-design-modern .oxo-mobile-nav-item',
			'.oxo-mobile-menu-design-classic .oxo-mobile-selector',
			'.oxo-mobile-menu-design-modern .oxo-mobile-selector'
		);

		if ( in_array( Aione()->theme_options[ 'mobile_menu_text_align' ], array( 'left', 'right', 'center' ) ) ) {
			$css[$mobile_menu_media_query][aione_implode( $elements )]['text-align'] = esc_attr( Aione()->theme_options[ 'mobile_menu_text_align' ] );
		}

		if ( 'right' == Aione()->theme_options[ 'mobile_menu_text_align' ] ) {

			$elements = array(
				'.oxo-mobile-menu-design-classic .oxo-selector-down',
				'.oxo-mobile-menu-design-modern .oxo-selector-down'
			);
			$css[$mobile_menu_media_query][aione_implode( $elements )]['left']               = '7px';
			$css[$mobile_menu_media_query][aione_implode( $elements )]['right']              = '0px';
			$css[$mobile_menu_media_query][aione_implode( $elements )]['border-left']        = '0px';
			$css[$mobile_menu_media_query][aione_implode( $elements )]['border-right-width'] = '1px';
			$css[$mobile_menu_media_query][aione_implode( $elements )]['border-right-style'] = 'solid';

			$elements = aione_map_selector( $elements, ':before' );
			$css[$mobile_menu_media_query][aione_implode( $elements )]['margin-left']  = '0';
			$css[$mobile_menu_media_query][aione_implode( $elements )]['margin-right'] = '12px';

			$elements = array(
				'.oxo-mobile-menu-design-classic .oxo-open-submenu',
				'.oxo-mobile-menu-design-modern .oxo-open-submenu'
			);
			$css[$mobile_menu_media_query][aione_implode( $elements )]['right'] = 'auto';
			$css[$mobile_menu_media_query][aione_implode( $elements )]['left']  = '0';

			$css[$mobile_menu_media_query]['.oxo-mobile-menu-design-modern .oxo-mobile-nav-holder .oxo-mobile-nav-item .oxo-open-submenu']['padding-left']  = '30px';
			$css[$mobile_menu_media_query]['.oxo-mobile-menu-design-modern .oxo-mobile-nav-holder .oxo-mobile-nav-item .oxo-open-submenu']['padding-right'] = '0';
			$css[$mobile_menu_media_query]['.oxo-mobile-menu-design-modern .oxo-mobile-nav-holder .oxo-mobile-nav-item a']['padding-left']  = '30px';
			$css[$mobile_menu_media_query]['.oxo-mobile-menu-design-modern .oxo-mobile-nav-holder .oxo-mobile-nav-item a']['padding-right'] = '30px';
			$css[$mobile_menu_media_query]['.oxo-mobile-menu-design-modern .oxo-mobile-nav-holder .oxo-mobile-nav-item li a']['padding-left']  = '0';
			$css[$mobile_menu_media_query]['.oxo-mobile-menu-design-modern .oxo-mobile-nav-holder .oxo-mobile-nav-item li a']['padding-right'] = '39px';
			$css[$mobile_menu_media_query]['.oxo-mobile-menu-design-modern .oxo-mobile-nav-holder .oxo-mobile-nav-item li li a']['padding-left']  = '0';
			$css[$mobile_menu_media_query]['.oxo-mobile-menu-design-modern .oxo-mobile-nav-holder .oxo-mobile-nav-item li li a']['padding-right'] = '48px';
			$css[$mobile_menu_media_query]['.oxo-mobile-menu-design-modern .oxo-mobile-nav-holder .oxo-mobile-nav-item li li li a']['padding-left']  = '0';
			$css[$mobile_menu_media_query]['.oxo-mobile-menu-design-modern .oxo-mobile-nav-holder .oxo-mobile-nav-item li li li a']['padding-right'] = '57px';
			$css[$mobile_menu_media_query]['.oxo-mobile-menu-design-modern .oxo-mobile-nav-holder .oxo-mobile-nav-item li li li li a']['padding-left']  = '0';
			$css[$mobile_menu_media_query]['.oxo-mobile-menu-design-modern .oxo-mobile-nav-holder .oxo-mobile-nav-item li li li li a']['padding-right'] = '66px';

		}

		if ( ( 'right' == Aione()->theme_options[ 'mobile_menu_text_align' ] && ! is_rtl() ) ||
			 ( 'right' != Aione()->theme_options[ 'mobile_menu_text_align' ] && is_rtl() )
		) {

			$elements = array(
				'.oxo-mobile-menu-design-classic .oxo-mobile-nav-holder li.oxo-mobile-nav-item a:before',
				'.oxo-mobile-menu-design-modern .oxo-mobile-nav-holder li.oxo-mobile-nav-item a:before'
			);
			$css[$mobile_menu_media_query][aione_implode( $elements )]['display'] = 'none';

			$elements = array(
				'.oxo-mobile-menu-design-classic .oxo-mobile-nav-holder li.oxo-mobile-nav-item li a',
				'.oxo-mobile-menu-design-modern .oxo-mobile-nav-holder li.oxo-mobile-nav-item li a'
			);
			$css[$mobile_menu_media_query][aione_implode( $elements )]['padding-right'] = '39px';

			$elements = aione_map_selector( $elements, ':after' );
			$css[$mobile_menu_media_query][aione_implode( $elements )]['content']      = '"-"';
			$css[$mobile_menu_media_query][aione_implode( $elements )]['margin-right'] = '0';
			$css[$mobile_menu_media_query][aione_implode( $elements )]['margin-left']  = '2px';

			$elements = array(
				'.oxo-mobile-menu-design-classic .oxo-mobile-nav-holder li.oxo-mobile-nav-item li li a',
				'.oxo-mobile-menu-design-modern .oxo-mobile-nav-holder li.oxo-mobile-nav-item li li a'
			);
			$css[$mobile_menu_media_query][aione_implode( $elements )]['padding-right'] = '48px';

			$elements = aione_map_selector( $elements, ':after' );
			$css[$mobile_menu_media_query][aione_implode( $elements )]['content']      = '"--"';
			$css[$mobile_menu_media_query][aione_implode( $elements )]['margin-right'] = '0';
			$css[$mobile_menu_media_query][aione_implode( $elements )]['margin-left']  = '2px';

			$elements = array(
				'.oxo-mobile-menu-design-classic .oxo-mobile-nav-holder li.oxo-mobile-nav-item li li li a',
				'.oxo-mobile-menu-design-modern .oxo-mobile-nav-holder li.oxo-mobile-nav-item li li li a'
			);
			$css[$mobile_menu_media_query][aione_implode( $elements )]['padding-right'] = '57px';

			$elements = aione_map_selector( $elements, ':after' );
			$css[$mobile_menu_media_query][aione_implode( $elements )]['content']      = '"---"';
			$css[$mobile_menu_media_query][aione_implode( $elements )]['margin-right'] = '0';
			$css[$mobile_menu_media_query][aione_implode( $elements )]['margin-left']  = '2px';

			$elements = array(
				'.oxo-mobile-menu-design-classic .oxo-mobile-nav-holder li.oxo-mobile-nav-item li li li li a',
				'.oxo-mobile-menu-design-modern .oxo-mobile-nav-holder li.oxo-mobile-nav-item li li li li a'
			);
			$css[$mobile_menu_media_query][aione_implode( $elements )]['padding-right'] = '66px';

			$elements = aione_map_selector( $elements, ':after' );
			$css[$mobile_menu_media_query][aione_implode( $elements )]['content']      = '"----"';
			$css[$mobile_menu_media_query][aione_implode( $elements )]['margin-right'] = '0';
			$css[$mobile_menu_media_query][aione_implode( $elements )]['margin-left']  = '2px';
		}

		$elements = array(
			'.oxo-is-sticky .oxo-mobile-menu-design-classic.oxo-header-v1.oxo-sticky-menu-1 .oxo-mobile-sticky-nav-holder',
			'.oxo-is-sticky .oxo-mobile-menu-design-classic.oxo-header-v2.oxo-sticky-menu-1 .oxo-mobile-sticky-nav-holder',
			'.oxo-is-sticky .oxo-mobile-menu-design-classic.oxo-header-v3.oxo-sticky-menu-1 .oxo-mobile-sticky-nav-holder',
			'.oxo-is-sticky .oxo-mobile-menu-design-classic.oxo-header-v4.oxo-sticky-menu-1 .oxo-mobile-sticky-nav-holder',
			'.oxo-is-sticky .oxo-mobile-menu-design-classic.oxo-header-v5.oxo-sticky-menu-1 .oxo-mobile-sticky-nav-holder'
		);
		$css[$mobile_menu_media_query][aione_implode( $elements )]['display'] = 'block';

		$css[$mobile_menu_media_query]['.oxo-mobile-menu-design-classic .oxo-mobile-nav-holder .oxo-secondary-menu-icon']['text-align'] = 'inherit';

		$elements = array(
			'.oxo-mobile-menu-design-classic .oxo-mobile-nav-holder .oxo-secondary-menu-icon:before',
			'.oxo-mobile-menu-design-classic .oxo-mobile-nav-holder .oxo-secondary-menu-icon:after'
		);
		$css[$mobile_menu_media_query][aione_implode( $elements )]['display'] = 'none';


		/* @media only screen and ( max-width: $content_break_point )
		================================================================================================= */
		$content_break_point_media_query = '@media only screen and (max-width: ' . intval( Aione()->theme_options[ 'content_break_point' ] ) . 'px)';
		$content_media_query = '@media only screen and (max-width: ' . ( intval( $side_header_width ) + intval( Aione()->theme_options[ 'content_break_point' ] ) ) . 'px)';
		$content_min_media_query = '@media only screen and (min-width: ' . ( intval( $side_header_width ) + intval( Aione()->theme_options[ 'content_break_point' ] ) ) . 'px)';

		// # Layout
		if ( ! Aione()->theme_options[ 'smooth_scrolling' ] ) {
			if ( Aione()->theme_options[ 'responsive' ] ) {
				$css[$content_min_media_query]['.no-overflow-y body']['padding-right'] = '9px';
				$css[$content_min_media_query]['.no-overflow-y #slidingbar-area']['right'] = '9px';
			}
		}

		$css[$content_media_query]['.no-overflow-y']['overflow-y'] = 'visible !important';

		// #content, .sidebar widths
		$css[$content_media_query]['#content']['width']       = '100% !important';
		$css[$content_media_query]['#content']['margin-left'] = '0px !important';
		$css[$content_media_query]['.sidebar']['width']       = '100% !important';
		$css[$content_media_query]['.sidebar']['float']       = 'none !important';
		$css[$content_media_query]['.sidebar']['margin-left'] = '0 !important';
		$css[$content_media_query]['.sidebar']['clear']       = 'both';


		$css[$content_media_query]['.oxo-layout-column']['margin-left']  = '0';
		$css[$content_media_query]['.oxo-layout-column']['margin-right'] = '0';

		$elements = array(
			'.oxo-layout-column:nth-child(5n)',
			'.oxo-layout-column:nth-child(4n)',
			'.oxo-layout-column:nth-child(3n)',
			'.oxo-layout-column:nth-child(2n)',
		);
		$css[$content_media_query][aione_implode( $elements )]['margin-left']  = '0';
		$css[$content_media_query][aione_implode( $elements )]['margin-right'] = '0';

		$css[$content_media_query]['.oxo-layout-column.oxo-spacing-no']['margin-bottom']	= '0';
		$css[$content_media_query]['.oxo-body .oxo-layout-column.oxo-spacing-no']['width']         	= '100%';

		$css[$content_media_query]['.oxo-body .oxo-layout-column.oxo-spacing-yes']['width'] 		= '100%';

		$elements = array(
			'.oxo-columns-5 .oxo-column:first-child',
			'.oxo-columns-4 .oxo-column:first-child',
			'.oxo-columns-3 .oxo-column:first-child',
			'.oxo-columns-2 .oxo-column:first-child',
			'.oxo-columns-1 .oxo-column:first-child'
		);
		$css[$content_media_query][aione_implode( $elements )]['margin-left'] = '0';

		$css[$content_media_query]['.oxo-columns .oxo-column']['width'] 	   = '100% !important';
		$css[$content_media_query]['.oxo-columns .oxo-column']['float']      = 'none';
		$css[$content_media_query]['.oxo-columns .oxo-column:not(.oxo-column-last)']['margin']     = '0 0 50px';
		$css[$content_media_query]['.oxo-columns .oxo-column']['box-sizing'] = 'border-box';

		if ( is_rtl() ) {
			$css[$content_media_query]['.rtl .oxo-column']['float'] = 'none';
		}

		$elements = array(
			'.col-sm-12',
			'.col-sm-6',
			'.col-sm-4',
			'.col-sm-3',
			'.col-sm-2',
			'.oxo-columns-5 .col-lg-2',
			'.oxo-columns-5 .col-md-2',
			'.oxo-columns-5 .col-sm-2',
			'.aione-container .columns .col',
			'.footer-area .oxo-columns .oxo-column',
			'#slidingbar-area .columns .col'
		);
		$css[$content_media_query][aione_implode( $elements )]['float'] = 'none';
		$css[$content_media_query][aione_implode( $elements )]['width'] = '100%';

		// # General Styles
		$css[$content_media_query]['.oxo-filters']['border-bottom'] = '0';

		$css[$content_media_query]['.oxo-body .oxo-filter']['float']         = 'none';
		$css[$content_media_query]['.oxo-body .oxo-filter']['margin']        = '0';
		$css[$content_media_query]['.oxo-body .oxo-filter']['border-bottom'] = '1px solid #E7E6E6';

		// Mobile Logo
		$elements = array(
			'.oxo-mobile-logo-1 .oxo-standard-logo',
			'#side-header .oxo-mobile-logo-1 .oxo-standard-logo'
		);
		$css[$mobile_header_media_query][aione_implode( $elements )]['display'] = 'none';

		$elements = array(
			'.oxo-mobile-logo-1 .oxo-mobile-logo-1x',
			'#side-header .oxo-mobile-logo-1 .oxo-mobile-logo-1x'
		);
		$css[$mobile_header_media_query][aione_implode( $elements )]['display'] = 'inline-block';

		$css[$content_media_query]['.oxo-secondary-menu-icon']['min-width'] = '100%';


		 // # Page Title Bar
		if ( 'auto' != Aione()->theme_options[ 'page_title_mobile_height' ] ) {

			$css[$content_media_query]['.oxo-body .oxo-page-title-bar']['padding-top']    = '5px';
			$css[$content_media_query]['.oxo-body .oxo-page-title-bar']['padding-bottom'] = '5px';
			$css[$content_media_query]['.oxo-body .oxo-page-title-bar']['min-height']     = intval( Aione()->theme_options[ 'page_title_mobile_height' ] ) - 10 . 'px';
			$css[$content_media_query]['.oxo-body .oxo-page-title-bar']['height']         = 'auto';

		} else {

			$css[$content_media_query]['.oxo-body .oxo-page-title-bar']['padding-top']    = '10px';
			$css[$content_media_query]['.oxo-body .oxo-page-title-bar']['padding-bottom'] = '10px';
			$css[$content_media_query]['.oxo-body .oxo-page-title-bar']['height']         = 'auto';
			$css[$content_media_query]['.oxo-page-title-row']['height'] = 'auto';

		}

		$elements = array(
			'.oxo-page-title-bar-left .oxo-page-title-captions',
			'.oxo-page-title-bar-right .oxo-page-title-captions',
			'.oxo-page-title-bar-left .oxo-page-title-secondary',
			'.oxo-page-title-bar-right .oxo-page-title-secondary'
		);
		$css[$content_media_query][aione_implode( $elements )]['display']     = 'block';
		$css[$content_media_query][aione_implode( $elements )]['float']       = 'none';
		$css[$content_media_query][aione_implode( $elements )]['width']       = '100%';
		$css[$content_media_query][aione_implode( $elements )]['line-height'] = 'normal';

		$css[$content_media_query]['.oxo-page-title-bar-left .oxo-page-title-secondary']['text-align'] = 'left';

		$css[$content_media_query]['.oxo-page-title-bar-left .searchform']['display']   = 'block';
		$css[$content_media_query]['.oxo-page-title-bar-left .searchform']['max-width'] = '100%';

		$css[$content_media_query]['.oxo-page-title-bar-right .oxo-page-title-secondary']['text-align'] = 'right';

		$css[$content_media_query]['.oxo-page-title-bar-right .searchform']['max-width'] = '100%';

		if ( ! Aione()->theme_options[ 'breadcrumb_mobile' ] ) {
			$css[$content_media_query]['.oxo-body .oxo-page-title-bar .oxo-breadcrumbs']['display'] = 'none';
		}

		if ( 'auto' != Aione()->theme_options[ 'page_title_mobile_height' ] ) {

			$css[$content_media_query]['.oxo-page-title-row']['display']    = 'table';
			$css[$content_media_query]['.oxo-page-title-row']['width']      = '100%';
			$css[$content_media_query]['.oxo-page-title-row']['min-height'] = intval( Aione()->theme_options[ 'page_title_mobile_height' ] ) - 20 . 'px';

			$css[$content_media_query]['.oxo-page-title-bar-center .oxo-page-title-row']['width'] = 'auto';

			$css[$content_media_query]['.oxo-page-title-wrapper']['display']        = 'table-cell';
			$css[$content_media_query]['.oxo-page-title-wrapper']['vertical-align'] = 'middle';
		}

		// # Blog Layouts
		// Blog medium alternate layout
		$elements = array(
			'.oxo-body .oxo-blog-layout-medium-alternate .oxo-post-content',
			'.oxo-body .oxo-blog-layout-medium-alternate .has-post-thumbnail .oxo-post-content'
		);
		$css[$content_media_query][aione_implode( $elements )]['float']       = 'none';
		$css[$content_media_query][aione_implode( $elements )]['clear']       = 'both';
		$css[$content_media_query][aione_implode( $elements )]['margin']      = '0';
		$css[$content_media_query][aione_implode( $elements )]['padding-top'] = '20px';


		// # Author Page - Info
		$css[$content_media_query]['.oxo-author .oxo-social-networks']['display'] = 'block';
		$css[$content_media_query]['.oxo-body .oxo-author .oxo-social-networks']['text-align'] = 'center';
		$css[$content_media_query]['.oxo-author .oxo-social-networks']['margin-top'] = '10px';

		$css[$content_media_query]['.oxo-author-tagline']['display']      = 'block';
		$css[$content_media_query]['.oxo-author-tagline']['float']      = 'none';
		$css[$content_media_query]['.oxo-author-tagline']['text-align'] = 'center';
		$css[$content_media_query]['.oxo-author-tagline']['max-width']  = '100%';


		// # Shortcodes
		$elements = array(
			'.oxo-content-boxes.content-boxes-clean-vertical .content-box-column',
			'.oxo-content-boxes.content-boxes-clean-horizontal .content-box-column'
		);
		$css[$content_media_query][aione_implode( $elements )]['border-right-width'] = '1px';

		$elements = array(
			'.oxo-content-boxes .content-box-shortcode-timeline'
		);
		$css[$content_media_query][aione_implode( $elements )]['display'] = 'none';

		$elements = array(
			'.oxo-countdown',
			'.oxo-countdown .oxo-countdown-heading-wrapper',
			'.oxo-countdown .oxo-countdown-counter-wrapper',
			'.oxo-countdown .oxo-countdown-link-wrapper'
		);
		 $css[$content_media_query][aione_implode( $elements )]['display'] = 'block';
		 $css[$content_media_query]['.oxo-countdown .oxo-countdown-heading-wrapper']['text-align'] = 'center';
		 $css[$content_media_query]['.oxo-countdown .oxo-countdown-counter-wrapper']['margin-top'] = '20px';
		 $css[$content_media_query]['.oxo-countdown .oxo-countdown-counter-wrapper']['margin-bottom'] = '10px';
		 $css[$content_media_query]['.oxo-countdown .oxo-dash-title']['display'] = 'block';
		 $css[$content_media_query]['.oxo-body .oxo-countdown .oxo-dash-title']['padding'] = '0';
		 $css[$content_media_query]['.oxo-countdown .oxo-dash-title']['font-size'] = '16px';
		 $css[$content_media_query]['.oxo-countdown .oxo-countdown-link-wrapper']['text-align'] = 'center';
		 

		// Tagline Box
		$css[$content_media_query]['.oxo-reading-box-container .reading-box.reading-box-center']['text-align'] = 'left';
		$css[$content_media_query]['.oxo-reading-box-container .reading-box.reading-box-right']['text-align'] = 'left';

		$css[$content_media_query]['.oxo-reading-box-container .oxo-desktop-button']['display'] = 'none';
		$css[$content_media_query]['.oxo-reading-box-container .oxo-mobile-button']['display'] = 'block';
		$css[$content_media_query]['.oxo-reading-box-container .oxo-mobile-button.continue-center']['display'] = 'block';		 


		// # Events Calendar
		if ( class_exists( 'Tribe__Events__Main' ) ) {
			$css[$content_media_query]['.tribe-events-single ul.tribe-related-events li']['margin-right'] = '0';
			$css[$content_media_query]['.tribe-events-single ul.tribe-related-events li']['width'] = '100%';
			$css[$content_break_point_media_query]['.tribe-bar-collapse #tribe-bar-collapse-toggle']['width'] = '59%';
		}

		$retina_media_query = '@media only screen and (max-width: ' . ( intval( Aione()->theme_options[ 'side_header_break_point' ] ) ) . 'px) and (-webkit-min-device-pixel-ratio: 1.5), only screen and (max-width: ' . ( intval( Aione()->theme_options[ 'side_header_break_point' ] ) ) . 'px) and (min-resolution: 144dpi), only screen and (max-width: ' . ( intval( Aione()->theme_options[ 'side_header_break_point' ] ) ) . 'px) and (min-resolution: 1.5dppx)';

		$elements = array(
			'.oxo-mobile-logo-1 .oxo-mobile-logo-1x',
			'#side-header .oxo-mobile-logo-1 .oxo-mobile-logo-1x'
		);
		$css[$retina_media_query][aione_implode( $elements )]['display'] = 'none';

		$elements = array(
			'.oxo-mobile-logo-1 .oxo-mobile-logo-2x',
			'#side-header .oxo-mobile-logo-1 .oxo-mobile-logo-2x'
		);
		$css[$retina_media_query][aione_implode( $elements )]['display'] = 'inline-block';

		// # WooCommerce
		if ( class_exists( 'WooCommerce' ) ) {
			if ( 'horizontal' == Aione()->theme_options[ 'woocommerce_product_tab_design' ] ) {


				$elements = array(
					'#wrapper .woocommerce-tabs .tabs',
					'#wrapper .woocommerce-tabs .panel'
				);


				$css[$content_media_query][aione_implode( $elements )]['float']        = 'none';
				$css[$content_media_query][aione_implode( $elements )]['margin-left']  = 'auto';
				$css[$content_media_query][aione_implode( $elements )]['margin-right'] = 'auto';
				$css[$content_media_query][aione_implode( $elements )]['width']        = '100% !important';

				$elements = array(
					'.woocommerce-tabs .tabs',
					'.woocommerce-side-nav'
				);
				$css[$content_media_query][aione_implode( $elements )]['margin-bottom'] = '25px';
				
				$css[$content_media_query]['.woocommerce-tabs > .tabs']['border'] = 'none';
				$css[$content_media_query]['.woocommerce-tabs > .wc-tab']['border-top'] = '1px solid';
				
				$css[$content_media_query]['.woocommerce-tabs > .tabs .active']['border-top'] = 'none';
				$css[$content_media_query]['.woocommerce-tabs > .tabs .active']['border-left'] = 'none';
				$css[$content_media_query]['.woocommerce-tabs > .tabs .active']['border-right'] = 'none';
				$css[$content_media_query]['.woocommerce-tabs > .tabs .active a']['background-color'] = 'transparent';
				$css[$content_media_query]['.woocommerce-tabs > .tabs li']['float'] = 'none';
				$css[$content_media_query]['.woocommerce-tabs > .tabs li']['border-bottom'] = '1px solid';
				$css[$content_media_query]['.woocommerce-tabs > .tabs li a']['padding'] = '10px 0';
			}
		}

		// # Not restructured mobile.css styles
		$css[$content_media_query]['#wrapper']['width'] = 'auto !important';

		$css[$content_media_query]['.create-block-format-context']['display'] = 'none';

		$css[$content_media_query]['.review']['float'] = 'none';
		$css[$content_media_query]['.review']['width'] = '100%';

		$elements = array(
			'.oxo-copyright-notice',
			'.oxo-body .oxo-social-links-footer'
		);
		$css[$content_media_query][aione_implode( $elements )]['display']    = 'block';
		$css[$content_media_query][aione_implode( $elements )]['text-align'] = 'center';

		$css[$content_media_query]['.oxo-social-links-footer']['width'] = 'auto';

		$css[$content_media_query]['.oxo-social-links-footer .oxo-social-networks']['display']    = 'inline-block';
		$css[$content_media_query]['.oxo-social-links-footer .oxo-social-networks']['float']      = 'none';
		$css[$content_media_query]['.oxo-social-links-footer .oxo-social-networks']['margin-top'] = '0';

		$css[$content_media_query]['.oxo-copyright-notice']['padding'] = '0 0 15px';

		$elements = array(
			'.oxo-copyright-notice:after',
			'.oxo-social-networks:after'
		);
		$css[$content_media_query][aione_implode( $elements )]['content'] = '""';
		$css[$content_media_query][aione_implode( $elements )]['display'] = 'block';
		$css[$content_media_query][aione_implode( $elements )]['clear']   = 'both';

		$elements = array(
			'.oxo-social-networks li',
			'.oxo-copyright-notice li'
		);
		$css[$content_media_query][aione_implode( $elements )]['float']   = 'none';
		$css[$content_media_query][aione_implode( $elements )]['display'] = 'inline-block';

		$css[$content_media_query]['.oxo-title']['margin-top']    = '0px !important';
		$css[$content_media_query]['.oxo-title']['margin-bottom'] = '20px !important';
		$css[$content_media_query]['.tfs-slider .oxo-title']['margin-bottom'] = '0 !important';


		$css[$content_media_query]['#main .cart-empty']['float']         = 'none';
		$css[$content_media_query]['#main .cart-empty']['text-align']    = 'center';
		$css[$content_media_query]['#main .cart-empty']['border-top']    = '1px solid';
		$css[$content_media_query]['#main .cart-empty']['border-bottom'] = 'none';
		$css[$content_media_query]['#main .cart-empty']['width']         = '100%';
		$css[$content_media_query]['#main .cart-empty']['line-height']   = 'normal !important';
		$css[$content_media_query]['#main .cart-empty']['height']        = 'auto !important';
		$css[$content_media_query]['#main .cart-empty']['margin-bottom'] = '10px';
		$css[$content_media_query]['#main .cart-empty']['padding-top']   = '10px';

		$css[$content_media_query]['#main .return-to-shop']['float']          = 'none';
		$css[$content_media_query]['#main .return-to-shop']['border-top']     = 'none';
		$css[$content_media_query]['#main .return-to-shop']['border-bottom']  = '1px solid';
		$css[$content_media_query]['#main .return-to-shop']['width']          = '100%';
		$css[$content_media_query]['#main .return-to-shop']['text-align']     = 'center';
		$css[$content_media_query]['#main .return-to-shop']['line-height']    = 'normal !important';
		$css[$content_media_query]['#main .return-to-shop']['height']         = 'auto !important';
		$css[$content_media_query]['#main .return-to-shop']['padding-bottom'] = '10px';

		if ( class_exists( 'WooCommerce' ) ) {

			$css[$content_media_query]['.woocommerce .checkout_coupon']['-webkit-justify-content'] = 'center';
			$css[$content_media_query]['.woocommerce .checkout_coupon']['-ms-justify-content'] = 'center';
			$css[$content_media_query]['.woocommerce .checkout_coupon']['justify-content'] = 'center';
			$css[$content_media_query]['.woocommerce .checkout_coupon']['-webkit-flex-wrap'] = 'wrap';
			$css[$content_media_query]['.woocommerce .checkout_coupon']['-ms-flex-wrap'] = 'wrap';
			$css[$content_media_query]['.woocommerce .checkout_coupon']['flex-wrap'] = 'wrap';

			$css[$content_media_query]['.woocommerce .checkout_coupon .promo-code-heading']['margin-bottom'] = '5px';

			$css[$content_media_query]['.woocommerce .checkout_coupon .coupon-contents']['margin']  = '0';
		}

		$css[$content_media_query]['#content.full-width']['margin-bottom'] = '0';

		$css[$content_media_query]['.sidebar .social_links .social li']['width']        = 'auto';
		$css[$content_media_query]['.sidebar .social_links .social li']['margin-right'] = '5px';

		$css[$content_media_query]['#comment-input']['margin-bottom'] = '0';

		$css[$content_media_query]['#comment-input input']['width']         = '100%';
		$css[$content_media_query]['#comment-input input']['float']         = 'none !important';
		$css[$content_media_query]['#comment-input input']['margin-bottom'] = '10px';

		$css[$content_media_query]['#comment-textarea textarea']['width'] = '100%';

		$css[$content_media_query]['.widget.facebook_like iframe']['width']     = '100% !important';
		$css[$content_media_query]['.widget.facebook_like iframe']['max-width'] = 'none !important';

		$css[$content_media_query]['.pagination']['margin-top'] = '40px';

		$css[$content_media_query]['.portfolio-one .portfolio-item .image']['float']         = 'none';
		$css[$content_media_query]['.portfolio-one .portfolio-item .image']['width']         = 'auto';
		$css[$content_media_query]['.portfolio-one .portfolio-item .image']['height']        = 'auto';
		$css[$content_media_query]['.portfolio-one .portfolio-item .image']['margin-bottom'] = '20px';

		$css[$content_media_query]['h5.toggle span.toggle-title']['width'] = '80%';

		$css[$content_media_query]['#wrapper .sep-boxed-pricing .panel-wrapper']['padding'] = '0';

		$elements = array(
			'#wrapper .full-boxed-pricing .column',
			'#wrapper .sep-boxed-pricing .column'
		);
		$css[$content_media_query][aione_implode( $elements )]['float']         = 'none';
		$css[$content_media_query][aione_implode( $elements )]['margin-bottom'] = '10px';
		$css[$content_media_query][aione_implode( $elements )]['margin-left']   = '0';
		$css[$content_media_query][aione_implode( $elements )]['width']         = '100%';

		$css[$content_media_query]['.share-box']['height'] = 'auto';

		$css[$content_media_query]['#wrapper .share-box h4']['float']       = 'none';
		$css[$content_media_query]['#wrapper .share-box h4']['line-height'] = '20px !important';
		$css[$content_media_query]['#wrapper .share-box h4']['margin-top']  = '0';
		$css[$content_media_query]['#wrapper .share-box h4']['padding']     = '0';

		$css[$content_media_query]['.share-box ul']['float']          = 'none';
		$css[$content_media_query]['.share-box ul']['overflow']       = 'hidden';
		$css[$content_media_query]['.share-box ul']['padding']        = '0 25px';
		$css[$content_media_query]['.share-box ul']['padding-bottom'] = '15px';
		$css[$content_media_query]['.share-box ul']['margin-top']     = '0px';

		$css[$content_media_query]['.project-content .project-description']['float'] = 'none !important';

		$css[$content_media_query]['.single-aione_portfolio .portfolio-half .project-content .project-description h3']['margin-top'] = '24px';

		$css[$content_media_query]['.project-content .oxo-project-description-details']['margin-bottom'] = '50px';

		$elements = array(
			'.project-content .project-description',
			'.project-content .project-info'
		);
		$css[$content_media_query][aione_implode( $elements )]['width'] = '100% !important';

		$css[$content_media_query]['.portfolio-half .flexslider']['width'] = '100% !important';

		$css[$content_media_query]['.portfolio-half .project-content']['width'] = '100% !important';

		$css[$content_media_query]['#style_selector']['display'] = 'none';

		$elements = array(
			'.ls-aione .ls-nav-prev',
			'.ls-aione .ls-nav-next'
		);
		$css[$content_media_query][aione_implode( $elements )]['display'] = 'none !important';

		$css[$content_media_query]['#footer .social-networks']['width']    = '100%';
		$css[$content_media_query]['#footer .social-networks']['margin']   = '0 auto';
		$css[$content_media_query]['#footer .social-networks']['position'] = 'relative';
		$css[$content_media_query]['#footer .social-networks']['left']     = '-11px';

		$css[$content_media_query]['.tab-holder .tabs']['height'] = 'auto !important';
		$css[$content_media_query]['.tab-holder .tabs']['width']  = '100% !important';

		$css[$content_media_query]['.shortcode-tabs .tab-hold .tabs li']['width'] = '100% !important';

		$elements = array(
			'body .shortcode-tabs .tab-hold .tabs li',
			'body.dark .sidebar .tab-hold .tabs li'
		);
		$css[$content_media_query][aione_implode( $elements )]['border-right'] = 'none !important';

		$css[$content_media_query]['.error-message']['line-height'] = '170px';
		$css[$content_media_query]['.error-message']['margin-top']  = '20px';

		$css[$content_media_query]['.error_page .useful_links']['width']        = '100%';
		$css[$content_media_query]['.error-page .useful_links']['padding-left'] = '0';

		$css[$content_media_query]['.oxo-google-map']['width']         = '100% !important';

		$css[$content_media_query]['.social_links_shortcode .social li']['width'] = '10% !important';

		$css[$content_media_query]['#wrapper .ei-slider']['width'] = '100% !important';

		$css[$content_media_query]['#wrapper .ei-slider']['height'] = '200px !important';

		$css[$content_media_query]['.progress-bar']['margin-bottom'] = '10px !important';

		$css[$content_media_query]['#wrapper .content-boxes-icon-boxed .content-wrapper-boxed']['min-height']     = 'inherit !important';
		$css[$content_media_query]['#wrapper .content-boxes-icon-boxed .content-wrapper-boxed']['padding-bottom'] = '20px';
		$css[$content_media_query]['#wrapper .content-boxes-icon-boxed .content-wrapper-boxed']['padding-left']   = '3%';
		$css[$content_media_query]['#wrapper .content-boxes-icon-boxed .content-wrapper-boxed']['padding-right']  = '3%';

		$elements = array(
			'#wrapper .content-boxes-icon-on-top .content-box-column',
			'#wrapper .content-boxes-icon-boxed .content-box-column'
		);
		$css[$content_media_query][aione_implode( $elements )]['margin-bottom'] = '55px';

		$css[$content_media_query]['.oxo-counters-box .oxo-counter-box']['margin-bottom'] = '20px';
		$css[$content_media_query]['.oxo-counters-box .oxo-counter-box']['padding']       = '0 15px';

		$css[$content_media_query]['.oxo-counters-box .oxo-counter-box:last-child']['margin-bottom'] = '0';

		$css[$content_media_query]['.popup']['display'] = 'none !important';

		$css[$content_media_query]['.share-box .social-networks']['text-align'] = 'left';

		if ( class_exists( 'WooCommerce' ) ) {
			$css[$content_media_query]['.oxo-body .products li']['width'] = '225px';

			$elements = array(
				'.products li',
				'#wrapper .catalog-ordering > ul',
				'#main .products li:nth-child(3n)',
				'#main .products li:nth-child(4n)',
				'#main .has-sidebar .products li',
				'.aione-myaccount-data .addresses .col-1',
				'.aione-myaccount-data .addresses .col-2',
				'.aione-customer-details .addresses .col-1',
				'.aione-customer-details .addresses .col-2'
			);

			$css[$content_media_query][aione_implode( $elements )]['float']        = 'none !important';
			$css[$content_media_query][aione_implode( $elements )]['margin-left']  = 'auto !important';
			$css[$content_media_query][aione_implode( $elements )]['margin-right'] = 'auto !important';

			$elements = array(
				'.aione-myaccount-data .addresses .col-1',
				'.aione-myaccount-data .addresses .col-2',
				'.aione-customer-details .addresses .col-1',
				'.aione-customer-details .addresses .col-2'
			);
			$css[$content_media_query][aione_implode( $elements )]['margin'] = '0 !important';
			$css[$content_media_query][aione_implode( $elements )]['width']  = '100%';

			$css[$content_media_query]['#wrapper .catalog-ordering']['margin-bottom'] = '50px';

			$css[$content_media_query]['#wrapper .orderby-order-container']['display'] = 'block';

			$css[$content_media_query]['#wrapper .order-dropdown > li:hover > ul']['display']  = 'block';
			$css[$content_media_query]['#wrapper .order-dropdown > li:hover > ul']['position'] = 'relative';
			$css[$content_media_query]['#wrapper .order-dropdown > li:hover > ul']['top']      = '0';

			$css[$content_media_query]['#wrapper .orderby-order-container']['margin']        = '0 auto';
			$css[$content_media_query]['#wrapper .orderby-order-container']['width']         = '225px';
			$css[$content_media_query]['#wrapper .orderby-order-container']['float']         = 'none';

			$css[$content_media_query]['#wrapper .orderby.order-dropdown']['width']        = '176px';

			$css[$content_media_query]['#wrapper .sort-count.order-dropdown']['display'] = 'block';
			$css[$content_media_query]['#wrapper .sort-count.order-dropdown']['width'] = '225px';

			$css[$content_media_query]['#wrapper .sort-count.order-dropdown ul a']['width'] = '225px';

			$css[$content_media_query]['#wrapper .catalog-ordering .order']['margin'] = '0';

			$css[$content_media_query]['.catalog-ordering .oxo-grid-list-view']['display'] = 'block';
			$css[$content_media_query]['.catalog-ordering .oxo-grid-list-view']['width'] = '78px';

			$elements = array(
				'.woocommerce #customer_login .login .form-row',
				'.woocommerce #customer_login .login .lost_password'
			);
			$css[$content_media_query][aione_implode( $elements )]['float'] = 'none';

			$elements = array(
				'.woocommerce #customer_login .login .inline',
				'.woocommerce #customer_login .login .lost_password'
			);
			$css[$content_media_query][aione_implode( $elements )]['display']     = 'block';
			$css[$content_media_query][aione_implode( $elements )]['margin-left'] = '0';

			$css[$content_media_query]['.aione-myaccount-data .my_account_orders .order-number']['padding-right'] = '8px';

			$css[$content_media_query]['.aione-myaccount-data .my_account_orders .order-actions']['padding-left'] = '8px';

			$css[$content_media_query]['.shop_table .product-name']['width'] = '35%';

			$css[$content_media_query]['form.checkout .shop_table tfoot th']['padding-right'] = '20px';

			$elements = array(
				'#wrapper .product .images',
				'#wrapper .product .summary.entry-summary',
				'#wrapper .woocommerce-tabs .tabs',
				'#wrapper .woocommerce-tabs .panel',
				'#wrapper .woocommerce-side-nav',
				'#wrapper .woocommerce-content-box',
				'#wrapper .shipping-coupon',
				'#wrapper .cart-totals-buttons',
				'#wrapper #customer_login .col-1',
				'#wrapper #customer_login .col-2',
				'#wrapper .woocommerce form.checkout #customer_details .col-1',
				'#wrapper .woocommerce form.checkout #customer_details .col-2'
			);
			$css[$content_media_query][aione_implode( $elements )]['float']        = 'none';
			$css[$content_media_query][aione_implode( $elements )]['margin-left']  = 'auto';
			$css[$content_media_query][aione_implode( $elements )]['margin-right'] = 'auto';
			$css[$content_media_query][aione_implode( $elements )]['width']        = '100% !important';

			$elements = array(
				'#customer_login .col-1',
				'.coupon'
			);
			$css[$content_media_query][aione_implode( $elements )]['margin-bottom'] = '20px';

			$css[$content_media_query]['.shop_table .product-thumbnail']['float'] = 'none';

			$css[$content_media_query]['.product-info']['margin-left'] = '0';
			$css[$content_media_query]['.product-info']['margin-top']  = '10px';

			$css[$content_media_query]['.product .entry-summary div .price']['float'] = 'none';

			$css[$content_media_query]['.product .entry-summary .woocommerce-product-rating']['float']       = 'none';
			$css[$content_media_query]['.product .entry-summary .woocommerce-product-rating']['margin-left'] = '0';

			$elements = array(
				'.woocommerce-tabs .tabs',
				'.woocommerce-side-nav'
			);
			$css[$content_media_query][aione_implode( $elements )]['margin-bottom'] = '25px';

			$css[$content_media_query]['.woocommerce-tabs .panel']['width']   = '91% !important';
			$css[$content_media_query]['.woocommerce-tabs .panel']['padding'] = '4% !important';

			$css[$content_media_query]['#reviews li .avatar']['display'] = 'none';

			$css[$content_media_query]['#reviews li .comment-text']['width']       = '90% !important';
			$css[$content_media_query]['#reviews li .comment-text']['margin-left'] = '0 !important';
			$css[$content_media_query]['#reviews li .comment-text']['padding']     = '5% !important';

			$css[$content_media_query]['html .woocommerce .woocommerce-container .social-share']['display'] = 'block';
			$css[$content_media_query]['.woocommerce-container .social-share']['overflow'] = 'hidden';

			$css[$content_media_query]['.woocommerce-container .social-share li']['display']       = 'block';
			$css[$content_media_query]['.woocommerce-container .social-share li']['float']         = 'left';
			$css[$content_media_query]['.woocommerce-container .social-share li']['margin']        = '0 auto';
			$css[$content_media_query]['.woocommerce-container .social-share li']['border-right']  = '0 !important';
			$css[$content_media_query]['.woocommerce-container .social-share li']['border-left']   = '0 !important';
			$css[$content_media_query]['.woocommerce-container .social-share li']['padding-left']  = '0 !important';
			$css[$content_media_query]['.woocommerce-container .social-share li']['padding-right'] = '0 !important';
			$css[$content_media_query]['.woocommerce-container .social-share li']['width']         = '50%';

			$css[$content_media_query]['.has-sidebar .woocommerce-container .social-share li']['width'] = '50%';

			$css[$content_media_query]['.myaccount_user_container span']['width']        = '100%';
			$css[$content_media_query]['.myaccount_user_container span']['float']        = 'none';
			$css[$content_media_query]['.myaccount_user_container span']['display']      = 'block';
			$css[$content_media_query]['.myaccount_user_container span']['padding']      = '5px 0px';
			$css[$content_media_query]['.myaccount_user_container span']['border-right'] = 0;

			$css[$content_media_query]['.myaccount_user_container span.username']['margin-top'] = '10px';

			$css[$content_media_query]['.myaccount_user_container span.view-cart']['margin-bottom'] = '10px';

			if ( is_rtl() ) {
				$css[$content_media_query]['.rtl .myaccount_user_container span']['border-left'] = '0';
			}

			$elements = array(
				'.shop_table .product-thumbnail img',
				'.shop_table .product-thumbnail .product-info',
				'.shop_table .product-thumbnail .product-info p'
			);
			$css[$content_media_query][aione_implode( $elements )]['float']   = 'none';
			$css[$content_media_query][aione_implode( $elements )]['width']   = '100%';
			$css[$content_media_query][aione_implode( $elements )]['margin']  = '0 !important';
			$css[$content_media_query][aione_implode( $elements )]['padding'] = '0';

			$css[$content_media_query]['.shop_table .product-thumbnail']['padding'] = '10px 0px';

			$css[$content_media_query]['.product .images']['margin-bottom'] = '30px';

			$css[$content_media_query]['#customer_login_box .button']['float']         = 'left';
			$css[$content_media_query]['#customer_login_box .button']['margin-bottom'] = '15px';

			$css[$content_media_query]['#customer_login_box .remember-box']['clear']   = 'both';
			$css[$content_media_query]['#customer_login_box .remember-box']['display'] = 'block';
			$css[$content_media_query]['#customer_login_box .remember-box']['padding'] = '0';
			$css[$content_media_query]['#customer_login_box .remember-box']['width']   = '125px';
			$css[$content_media_query]['#customer_login_box .remember-box']['float']   = 'left';

			$css[$content_media_query]['#customer_login_box .lost_password']['float'] = 'left';

		}

		if ( defined( 'WPCF7_PLUGIN' ) ) {

			$elements = array(
				'.wpcf7-form .wpcf7-text',
				'.wpcf7-form .wpcf7-quiz',
				'.wpcf7-form .wpcf7-number',
				'.wpcf7-form textarea'
			);
			$css[$content_media_query][aione_implode( $elements )]['float']      = 'none !important';
			$css[$content_media_query][aione_implode( $elements )]['width']      = '100% !important';
			$css[$content_media_query][aione_implode( $elements )]['box-sizing'] = 'border-box';

		}

		if ( class_exists( 'GFForms' ) ) {
			$elements = array(
				'.gform_wrapper .right_label input.medium',
				'.gform_wrapper .right_label select.medium',
				'.gform_wrapper .left_label input.medium',
				'.gform_wrapper .left_label select.medium'
			);
			$css[$content_media_query][aione_implode( $elements )]['width'] = '35% !important';
		}

		$elements = array(
			'.product .images #slider .flex-direction-nav',
			'.product .images #carousel .flex-direction-nav'
		);
		$css[$content_media_query][aione_implode( $elements )]['display'] = 'none !important';

		if ( class_exists( 'WooCommerce' ) ) {
			$elements = array(
				'.myaccount_user_container span.msg',
				'.myaccount_user_container span:last-child'
			);
			$css[$content_media_query][aione_implode( $elements )]['padding-left']  = '0 !important';
			$css[$content_media_query][aione_implode( $elements )]['padding-right'] = '0 !important';
		}

		$css[$content_media_query]['.fullwidth-box']['background-attachment'] = 'scroll !important';

		$css[$content_media_query]['#toTop']['bottom']        = '30px';
		$css[$content_media_query]['#toTop']['border-radius'] = '4px';
		$css[$content_media_query]['#toTop']['height']        = '40px';
		$css[$content_media_query]['#toTop']['z-index']       = '10000';

		$css[$content_media_query]['#toTop:before']['line-height'] = '38px';

		$css[$content_media_query]['#toTop:hover']['background-color'] = '#333333';

		$css[$content_media_query]['.no-mobile-totop .to-top-container']['display'] = 'none';

		$css[$content_media_query]['.no-mobile-slidingbar #slidingbar-area']['display'] = 'none';

		$css[$content_media_query]['.no-mobile-slidingbar.mobile-logo-pos-left .mobile-menu-icons']['margin-right'] = '0';

		if ( is_rtl() ) {
			$css[$content_media_query]['.rtl.no-mobile-slidingbar.mobile-logo-pos-right .mobile-menu-icons']['margin-left'] = '0';
		}

		$css[$content_media_query]['.tfs-slider .slide-content-container .btn']['min-height']    = '0 !important';
		$css[$content_media_query]['.tfs-slider .slide-content-container .btn']['padding-left']  = '30px';
		$css[$content_media_query]['.tfs-slider .slide-content-container .btn']['padding-right'] = '30px !important';
		$css[$content_media_query]['.tfs-slider .slide-content-container .btn']['height']        = '26px !important';
		$css[$content_media_query]['.tfs-slider .slide-content-container .btn']['line-height']   = '26px !important';

		$css[$content_media_query]['.oxo-soundcloud iframe']['width'] = '100%';

		$elements = array(
			'.ua-mobile .oxo-page-title-bar',
			'.ua-mobile .footer-area',
			'.ua-mobile body',
			'.ua-mobile #main'
		);
		$css[$content_media_query][aione_implode( $elements )]['background-attachment'] = 'scroll !important';

		if ( class_exists( 'RevSliderFront' ) ) {
			$css[$content_media_query]['.oxo-revslider-mobile-padding']['padding-left']  = '30px !important';
			$css[$content_media_query]['.oxo-revslider-mobile-padding']['padding-right'] = '30px !important';
		}

		// # Events Calendar
		if ( class_exists( 'Tribe__Events__Main' ) ) {
			if ( ! is_rtl() ) {
				$css[$content_media_query]['.tribe-events-single ul.tribe-related-events .tribe-related-events-thumbnail']['float'] = 'left';
				$css[$content_media_query]['.tribe-events-single ul.tribe-related-events li .tribe-related-event-info']['padding-left'] = '10px';
				$css[$content_media_query]['.tribe-events-single ul.tribe-related-events li .tribe-related-event-info']['padding-right'] = '0';
			}

			if ( ( Aione()->theme_options[ 'main_top_padding' ] || Aione()->theme_options[ 'main_top_padding' ] == '0' ) && ! get_post_meta( $c_pageID, 'pyre_main_top_padding', true ) && get_post_meta( $c_pageID, 'pyre_main_top_padding', true ) != '0') {
				$css['global']['.tribe-mobile #main']['padding-top'] = Aione_Sanitize::size( Aione()->theme_options[ 'main_top_padding' ] );
			} else 	if ( get_post_meta( $c_pageID, 'pyre_main_top_padding', true ) ) {
				$css['global']['.tribe-mobile #main']['padding-top'] = get_post_meta( $c_pageID, 'pyre_main_top_padding', true );
			} else {
				$css['global']['.tribe-mobile #main']['padding-top'] = '55px';
			}

			// Filter
			$elements = array(
				'#tribe-events-bar #tribe-bar-views .tribe-bar-views-inner label',
				'#tribe-events-bar #tribe-bar-views .tribe-bar-views-inner .tribe-bar-views-option a'
			);
			$css[$content_media_query][aione_implode( $elements )]['padding-left'] = '15px';
			$css[$content_media_query][aione_implode( $elements )]['padding-right'] = '15px';

			$elements = array(
				'#tribe-events-bar .tribe-bar-filters .tribe-bar-date-filter',
				'#tribe-events-bar .tribe-bar-filters .tribe-bar-search-filter',
				'#tribe-events-bar .tribe-bar-filters .tribe-bar-geoloc-filter',
				'#tribe-events-bar .tribe-bar-filters .tribe-bar-submit'
			);
			$css[$content_media_query][aione_implode( $elements )]['padding-left'] = '0';
			$css[$content_media_query][aione_implode( $elements )]['padding-right'] = '0';
			$css[$content_media_query][aione_implode( $elements )]['padding-top'] = '15px';
			$css[$content_media_query][aione_implode( $elements )]['padding-bottom'] = '15px';

			// Title and Navigation
			$css[$content_media_query]['#tribe-events-content #tribe-events-header']['margin-bottom'] = '30px';

			$elements = array(
				'.tribe-events-list .oxo-events-before-title',
				'.tribe-events-month .oxo-events-before-title',
				'.tribe-events-week .oxo-events-before-title',
				'.tribe-events-day .oxo-events-before-title',
			);
			$css[$content_media_query][aione_implode( $elements )]['height'] = '100px';
			$css[$content_media_query]['.tribe-events-list.tribe-events-map .oxo-events-before-title']['height'] = 'auto';

			$css[$content_media_query]['#tribe-events-content #tribe-events-header .tribe-events-sub-nav li']['margin-top'] = '-40px';

			// Events Archive

			// List View
			$css[$content_media_query]['.tribe-events-loop .tribe-events-event-meta']['padding'] = '0';
			$css[$content_media_query]['#tribe-events .tribe-events-list .tribe-events-event-meta .author > div']['display'] = 'block';
			$css[$content_media_query]['#tribe-events .tribe-events-list .tribe-events-event-meta .author > div']['border-right'] = 'none';
			$css[$content_media_query]['#tribe-events .tribe-events-list .tribe-events-event-meta .author > div']['width'] = '100%';

			$elements = array(
				'#tribe-events .tribe-events-list .oxo-tribe-primary-info',
				'#tribe-events .tribe-events-list .oxo-tribe-secondary-info',
				'#tribe-events .tribe-events-list .oxo-tribe-no-featured-image .oxo-tribe-events-headline'
			);
			$css[$content_media_query][aione_implode( $elements )]['width'] = '100%';

			$elements = array(
				'.tribe-events-list .tribe-events-venue-details',
				'.tribe-events-list .time-details'
			);
			$css[$content_media_query][aione_implode( $elements )]['margin'] = '0';

			// Month View
			$css[$content_media_query]['.tribe-events-calendar td.tribe-events-past div[id*="tribe-events-daynum-"] > a']['background'] = 'none';

			// Photo View
			$css[$content_media_query]['.tribe-events-list .time-details']['padding'] = '0';


			// Single Event Page
			$elements = array(
				'.oxo-events-featured-image .oxo-events-single-title-content h2',
				'.oxo-events-featured-image .oxo-events-single-title-content .tribe-events-schedule'
			);
			$css[$content_media_query][aione_implode( $elements )]['float'] = 'none';

			$elements = array(
				'#tribe-events .tribe-events-list .type-tribe_events .tribe-events-event-image'
			);
			$css[$content_media_query][aione_implode( $elements )]['display'] = 'none';

			$elements = array(
				'#tribe-events .tribe-events-list .type-tribe_events .oxo-tribe-events-event-image-responsive'
			);
			$css[$content_media_query][aione_implode( $elements )]['display'] = 'block';
		}

		if( class_exists( 'WooCommerce') ) {
			$css[$content_media_query]['.oxo-woo-slider .oxo-carousel-title-on-rollover .oxo-rollover-categories']['display'] = 'none';
			$css[$content_media_query]['.oxo-woo-slider .oxo-carousel-title-on-rollover .price']['display'] = 'none';
		}

		/* @media only screen and ( max-width: 640px )
		================================================================================================= */
		$six_fourty_media_query = '@media only screen and (max-width: ' . ( intval( $side_header_width ) + 640 ) . 'px)';


		// # General


		// # Page Title Bar
		$css[$six_fourty_media_query]['.oxo-body .oxo-page-title-bar']['max-height'] = 'none';

		$css[$six_fourty_media_query]['.oxo-body .oxo-page-title-bar h1']['margin'] = '0';

		$css[$six_fourty_media_query]['.oxo-body .oxo-page-title-secondary']['margin-top'] = '2px';


		// # Blog Layouts
		// Blog general styles
		$elements = array(
			'.oxo-blog-layout-large .oxo-meta-info .oxo-alignleft',
			'.oxo-blog-layout-medium .oxo-meta-info .oxo-alignleft',
			'.oxo-blog-layout-large .oxo-meta-info .oxo-alignright',
			'.oxo-blog-layout-medium .oxo-meta-info .oxo-alignright'
		);
		$css[$six_fourty_media_query][aione_implode( $elements )]['display'] = 'block';
		$css[$six_fourty_media_query][aione_implode( $elements )]['float']   = 'none';
		$css[$six_fourty_media_query][aione_implode( $elements )]['margin']  = '0';
		$css[$six_fourty_media_query][aione_implode( $elements )]['width']   = '100%';

		// Blog medium layout
		$css[$six_fourty_media_query]['.oxo-body .oxo-blog-layout-medium .oxo-post-slideshow']['float']  = 'none';
		$css[$six_fourty_media_query]['.oxo-body .oxo-blog-layout-medium .oxo-post-slideshow']['margin'] = '0 0 20px 0';
		$css[$six_fourty_media_query]['.oxo-body .oxo-blog-layout-medium .oxo-post-slideshow']['height'] = 'auto';
		$css[$six_fourty_media_query]['.oxo-body .oxo-blog-layout-medium .oxo-post-slideshow']['width']  = 'auto';

		// Blog large alternate layout
		$css[$six_fourty_media_query]['.oxo-blog-layout-large-alternate .oxo-date-and-formats']['margin-bottom'] = '55px';

		$css[$six_fourty_media_query]['.oxo-body .oxo-blog-layout-large-alternate .oxo-post-content']['margin'] = '0';

		// Blog medium alternate layout
		$css[$six_fourty_media_query]['.oxo-blog-layout-medium-alternate .has-post-thumbnail .oxo-post-slideshow']['display']      = 'inline-block';
		$css[$six_fourty_media_query]['.oxo-blog-layout-medium-alternate .has-post-thumbnail .oxo-post-slideshow']['float']        = 'none';
		$css[$six_fourty_media_query]['.oxo-blog-layout-medium-alternate .has-post-thumbnail .oxo-post-slideshow']['margin-right'] = '0';
		$css[$six_fourty_media_query]['.oxo-blog-layout-medium-alternate .has-post-thumbnail .oxo-post-slideshow']['max-width']    = '197px';

		// Blog grid layout
		$css[$six_fourty_media_query]['.oxo-blog-layout-grid .oxo-post-grid']['position'] = 'static';
		$css[$six_fourty_media_query]['.oxo-blog-layout-grid .oxo-post-grid']['width']    = '100%';

		// # Footer Styles
		if ( Aione()->theme_options[ 'footer_sticky_height' ] && ( in_array( Aione()->theme_options[ 'footer_special_effects' ], array( 'footer_sticky', 'footer_sticky_with_parallax_bg_image' ) ) ) ) {
			$elements = array( 'html', 'body', '#boxed-wrapper', '#wrapper' );
			$css[$six_fourty_media_query][aione_implode( $elements )]['height']     = 'auto';
			$css[$six_fourty_media_query]['.above-footer-wrapper']['min-height']    = 'none';
			$css[$six_fourty_media_query]['.above-footer-wrapper']['margin-bottom'] = '0';
			$css[$six_fourty_media_query]['.above-footer-wrapper:after']['height']  = 'auto';
			$css[$six_fourty_media_query]['.oxo-footer']['height']               = 'auto';
		}

		// # Not restructured mobile.css styles
		$elements = array(
			'.wooslider-direction-nav',
			'.wooslider-pauseplay',
			'.flex-direction-nav'
		);
		$css[$six_fourty_media_query][aione_implode( $elements )]['display'] = 'none';

		$css[$six_fourty_media_query]['.share-box ul li']['margin-bottom'] ='10px';
		$css[$six_fourty_media_query]['.share-box ul li']['margin-right']  ='15px';

		$css[$six_fourty_media_query]['.buttons a']['margin-right'] = '5px';

		$elements = array(
			'.ls-aione .ls-nav-prev',
			'.ls-aione .ls-nav-next'
		);
		$css[$six_fourty_media_query][aione_implode( $elements )]['display'] = 'none !important';

		$css[$six_fourty_media_query]['#wrapper .ei-slider']['width']  = '100% !important';
		$css[$six_fourty_media_query]['#wrapper .ei-slider']['height'] = '200px !important';

		$css[$six_fourty_media_query]['.progress-bar']['margin-bottom'] = '10px !important';

		$css[$six_fourty_media_query]['#wrapper .content-boxes-icon-boxed .content-wrapper-boxed']['min-height']     = 'inherit !important';
		$css[$six_fourty_media_query]['#wrapper .content-boxes-icon-boxed .content-wrapper-boxed']['padding-bottom'] = '20px';
		$css[$six_fourty_media_query]['#wrapper .content-boxes-icon-boxed .content-wrapper-boxed']['padding-left']   = '3% !important';
		$css[$six_fourty_media_query]['#wrapper .content-boxes-icon-boxed .content-wrapper-boxed']['padding-right']  = '3% !important';

		$elements = array(
			'#wrapper .content-boxes-icon-on-top .content-box-column',
			'#wrapper .content-boxes-icon-boxed .content-box-column'
		);
		$css[$six_fourty_media_query][aione_implode( $elements )]['margin-bottom'] = '55px';

		$css[$six_fourty_media_query]['#wrapper .content-boxes-icon-boxed .content-box-column .heading h2']['margin-top'] = '-5px';

		$css[$six_fourty_media_query]['#wrapper .content-boxes-icon-boxed .content-box-column .more']['margin-top'] = '12px';

		$css[$six_fourty_media_query]['.page-template-contact-php .oxo-google-map']['height'] = '270px !important';

		$css[$six_fourty_media_query]['.share-box .social-networks li']['margin-right'] = '20px !important';

		$css[$six_fourty_media_query]['.timeline-icon']['display'] = 'none !important';

		$css[$six_fourty_media_query]['.timeline-layout']['padding-top'] = '0 !important';

		$css[$six_fourty_media_query]['.oxo-counters-circle .counter-circle-wrapper']['display']      = 'block';
		$css[$six_fourty_media_query]['.oxo-counters-circle .counter-circle-wrapper']['margin-right'] = 'auto';
		$css[$six_fourty_media_query]['.oxo-counters-circle .counter-circle-wrapper']['margin-left']  = 'auto';

		$css[$six_fourty_media_query]['.post-content .wooslider .wooslider-control-thumbs']['margin-top'] = '-10px';

		$css[$six_fourty_media_query]['body .wooslider .overlay-full.layout-text-left .slide-excerpt']['padding'] = '20px !important';

		$css[$six_fourty_media_query]['.content-boxes-icon-boxed .col']['box-sizing'] = 'border-box';

		$css[$six_fourty_media_query]['.social_links_shortcode li']['height'] = '40px !important';

		$css[$six_fourty_media_query]['.products-slider .es-nav span']['transform'] = 'scale(0.5) !important';

		if ( class_exists( 'WooCommerce' ) ) {

			$css[$six_fourty_media_query]['.shop_table .product-quantity']['display'] = 'none';

			$css[$six_fourty_media_query]['.shop_table .filler-td']['display'] = 'none';

			$css[$six_fourty_media_query]['.my_account_orders .order-status']['display'] = 'none';

			$css[$six_fourty_media_query]['.my_account_orders .order-date']['display'] = 'none';

			$css[$six_fourty_media_query]['.my_account_orders .order-number time']['display']     = 'block !important';
			$css[$six_fourty_media_query]['.my_account_orders .order-number time']['font-size']   = '10px';
			$css[$six_fourty_media_query]['.my_account_orders .order-number time']['line-height'] = 'normal';

		}

		$css[$six_fourty_media_query]['.portfolio-masonry .portfolio-item']['width'] = '100% !important';

		if ( class_exists( 'bbPress' ) ) {

			$css[$six_fourty_media_query]['#bbpress-forums #bbp-single-user-details #bbp-user-avatar img.avatar']['width']  = '80px !important';
			$css[$six_fourty_media_query]['#bbpress-forums #bbp-single-user-details #bbp-user-avatar img.avatar']['height'] = '80px !important';

			$css[$six_fourty_media_query]['#bbpress-forums #bbp-single-user-details #bbp-user-avatar']['width'] = '80px !important';

			$css[$six_fourty_media_query]['#bbpress-forums #bbp-single-user-details #bbp-user-navigation']['margin-left'] = '110px !important';

			$css[$six_fourty_media_query]['#bbpress-forums #bbp-single-user-details #bbp-user-navigation .first-col']['width'] = '47% !important';

			$css[$six_fourty_media_query]['#bbpress-forums #bbp-single-user-details #bbp-user-navigation .second-col']['margin-left'] = '53% !important';
			$css[$six_fourty_media_query]['#bbpress-forums #bbp-single-user-details #bbp-user-navigation .second-col']['width']       = '47% !important';

		}

		$elements = array(
			'.table-1 table',
			'.tkt-slctr-tbl-wrap-dv table'
		);
		$css[$six_fourty_media_query][aione_implode( $elements )]['border-collapse'] = 'collapse';
		$css[$six_fourty_media_query][aione_implode( $elements )]['border-spacing']  = '0';
		$css[$six_fourty_media_query][aione_implode( $elements )]['width']           = '100%';

		$elements = array(
			'.table-1 td',
			'.table-1 th',
			'.tkt-slctr-tbl-wrap-dv td',
			'.tkt-slctr-tbl-wrap-dv th'
		);
		$css[$six_fourty_media_query][aione_implode( $elements )]['white-space'] = 'nowrap';

		$css[$six_fourty_media_query]['.table-2 table']['border-collapse'] = 'collapse';
		$css[$six_fourty_media_query]['.table-2 table']['border-spacing']  = '0';
		$css[$six_fourty_media_query]['.table-2 table']['width']           = '100%';

		$elements = array(
			'.table-2 td',
			'.table-2 th'
		);
		$css[$six_fourty_media_query][aione_implode( $elements )]['white-space'] = 'nowrap';

		$elements = array(
			'.page-title-bar',
			'.footer-area',
			'body',
			'#main'
		);
		$css[$six_fourty_media_query][aione_implode( $elements )]['background-attachment'] = 'scroll !important';

		$css[$six_fourty_media_query]['.tfs-slider[data-animation="slide"]']['height'] = 'auto !important';

		$css[$six_fourty_media_query]['#wrapper .share-box h4']['display']       = 'block';
		$css[$six_fourty_media_query]['#wrapper .share-box h4']['float']         = 'none';
		$css[$six_fourty_media_query]['#wrapper .share-box h4']['line-height']   = '20px !important';
		$css[$six_fourty_media_query]['#wrapper .share-box h4']['margin-top']    = '0';
		$css[$six_fourty_media_query]['#wrapper .share-box h4']['padding']       = '0';
		$css[$six_fourty_media_query]['#wrapper .share-box h4']['margin-bottom'] = '10px';

		$css[$six_fourty_media_query]['.oxo-sharing-box .oxo-social-networks']['float']      = 'none';
		$css[$six_fourty_media_query]['.oxo-sharing-box .oxo-social-networks']['display']    = 'block';
		$css[$six_fourty_media_query]['.oxo-sharing-box .oxo-social-networks']['width']      = '100%';
		$css[$six_fourty_media_query]['.oxo-sharing-box .oxo-social-networks']['text-align'] = 'left';

		$css[$six_fourty_media_query]['#content']['width']        = '100% !important';
		$css[$six_fourty_media_query]['#content']['margin-left'] = '0px !important';

		$css[$six_fourty_media_query]['.sidebar']['width']       = '100% !important';
		$css[$six_fourty_media_query]['.sidebar']['float']       = 'none !important';
		$css[$six_fourty_media_query]['.sidebar']['margin-left'] = '0 !important';
		$css[$six_fourty_media_query]['.sidebar']['clear']       = 'both';

		$css[$six_fourty_media_query]['.oxo-hide-on-mobile']['display'] = 'none';

		// Blog timeline layout

		$css[$six_fourty_media_query]['.oxo-blog-layout-timeline']['padding-top'] = '0';

		$css[$six_fourty_media_query]['.oxo-blog-layout-timeline .oxo-post-timeline']['float'] = 'none';
		$css[$six_fourty_media_query]['.oxo-blog-layout-timeline .oxo-post-timeline']['width'] = '100%';

		$css[$six_fourty_media_query]['.oxo-blog-layout-timeline .oxo-timeline-date']['margin-bottom'] = '0';
		$css[$six_fourty_media_query]['.oxo-blog-layout-timeline .oxo-timeline-date']['margin-top']    = '2px';

		$elements = array(
			'.oxo-timeline-icon',
			'.oxo-timeline-line',
			'.oxo-timeline-circle',
			'.oxo-timeline-arrow'
		);
		$css[$six_fourty_media_query][aione_implode( $elements )]['display'] = 'none';

		if ( class_exists( 'WooCommerce' ) ) {
			if ( Aione()->theme_options[ 'woocommerce_product_box_design' ] == 'clean' ) {
				$css[$six_fourty_media_query]['.oxo-woo-slider .oxo-clean-product-image-wrapper .oxo-product-buttons']['height'] = 'auto';
				$css[$six_fourty_media_query]['.oxo-woo-slider .oxo-clean-product-image-wrapper .oxo-product-buttons']['margin-top'] = '0';
				$css[$six_fourty_media_query]['.oxo-woo-slider .oxo-clean-product-image-wrapper .oxo-product-buttons *']['display'] = 'block';
				$css[$six_fourty_media_query]['.oxo-woo-slider .oxo-clean-product-image-wrapper .oxo-product-buttons *']['text-align'] = 'center';
				$css[$six_fourty_media_query]['.oxo-woo-slider .oxo-clean-product-image-wrapper .oxo-product-buttons *']['float'] = 'none !important';
				$css[$six_fourty_media_query]['.oxo-woo-slider .oxo-clean-product-image-wrapper .oxo-product-buttons *']['max-width'] = '100%';
				$css[$six_fourty_media_query]['.oxo-woo-slider .oxo-clean-product-image-wrapper .oxo-product-buttons *']['margin-top'] = '0';
			}
		}

		/* @media only screen and ( max-width: 480px )
		================================================================================================= */
		if ( class_exists( 'bbPress' ) ) {
			$four_eigthy_media_query = '@media only screen and (max-width: 480px)';

			$css[$four_eigthy_media_query]['#bbpress-forums .bbp-body div.bbp-reply-author']['width'] = '71% !important';
			$css[$four_eigthy_media_query]['.bbp-arrow']['display'] = 'none';
			$css[$four_eigthy_media_query]['div.bbp-submit-wrapper']['float'] = 'right !important';
		}

		if ( class_exists( 'GFForms' ) ) {
			$four_eigthy_media_query = '@media all and (max-width: 480px), all and (max-device-width: 480px)';

			$elements = array(
				'body.oxo-body .gform_wrapper .ginput_container',
				'body.oxo-body .gform_wrapper div.ginput_complex',
				'body.oxo-body .gform_wrapper div.gf_page_steps',
				'body.oxo-body .gform_wrapper div.gf_page_steps div',
				'body.oxo-body .gform_wrapper .ginput_container input.small',
				'body.oxo-body .gform_wrapper .ginput_container input.medium',
				'body.oxo-body .gform_wrapper .ginput_container input.large',
				'body.oxo-body .gform_wrapper .ginput_container select.small',
				'body.oxo-body .gform_wrapper .ginput_container select.medium',
				'body.oxo-body .gform_wrapper .ginput_container select.large',
				'body.oxo-body .gform_wrapper .ginput_container textarea.small',
				'body.oxo-body .gform_wrapper .ginput_container textarea.medium',
				'body.oxo-body .gform_wrapper .ginput_container textarea.large',
				'body.oxo-body .gform_wrapper .ginput_complex .ginput_right input[type="text"]',
				'body.oxo-body .gform_wrapper .ginput_complex .ginput_right input[type="url"]',
				'body.oxo-body .gform_wrapper .ginput_complex .ginput_right input[type="email"]',
				'body.oxo-body .gform_wrapper .ginput_complex .ginput_right input[type="tel"]',
				'body.oxo-body .gform_wrapper .ginput_complex .ginput_right input[type="number"]',
				'body.oxo-body .gform_wrapper .ginput_complex .ginput_right input[type="password"]',
				'body.oxo-body .gform_wrapper .ginput_complex .ginput_left input[type="text"]',
				'body.oxo-body .gform_wrapper .ginput_complex .ginput_left input[type="url"]',
				'body.oxo-body .gform_wrapper .ginput_complex .ginput_left input[type="email"]',
				'body.oxo-body .gform_wrapper .ginput_complex .ginput_left input[type="tel"]',
				'body.oxo-body .gform_wrapper .ginput_complex .ginput_left input[type="number"]',
				'body.oxo-body .gform_wrapper .ginput_complex .ginput_left input[type="password"]',
				'body.oxo-body .gform_wrapper .ginput_complex .ginput_full input[type="text"]',
				'body.oxo-body .gform_wrapper .ginput_complex .ginput_full input[type="url"]',
				'body.oxo-body .gform_wrapper .ginput_complex .ginput_full input[type="email"]',
				'body.oxo-body .gform_wrapper .ginput_complex .ginput_full input[type="tel"]',
				'body.oxo-body .gform_wrapper .ginput_complex .ginput_full input[type="number"]',
				'body.oxo-body .gform_wrapper .ginput_complex .ginput_full input[type="password"]',
				'body.oxo-body .gform_wrapper .ginput_complex .ginput_full select',
				'body.oxo-body .gform_wrapper input.gform_button.button',
				'body.oxo-body .gform_wrapper input[type="submit"]',
				'body.oxo-body .gform_wrapper .gfield_time_hour input',
				'body.oxo-body .gform_wrapper .gfield_time_minute input',
				'body.oxo-body .gform_wrapper .gfield_date_month input',
				'body.oxo-body .gform_wrapper .gfield_date_day input',
				'body.oxo-body .gform_wrapper .gfield_date_year input',
				'.gfield_time_ampm .gravity-select-parent',
				'body.oxo-body .gform_wrapper .ginput_complex input[type="text"]',
				'body.oxo-body .gform_wrapper .ginput_complex input[type="url"]',
				'body.oxo-body .gform_wrapper .ginput_complex input[type="email"]',
				'body.oxo-body .gform_wrapper .ginput_complex input[type="tel"]',
				'body.oxo-body .gform_wrapper .ginput_complex input[type="number"]',
				'body.oxo-body .gform_wrapper .ginput_complex input[type="password"]',
				'body.oxo-body .gform_wrapper .ginput_complex .gravity-select-parent',
				'body.oxo-body .gravity-select-parent'
			);
			$css[$four_eigthy_media_query][aione_implode( $elements )]['width'] = '100% !important';
			$elements = array(
				'.gform_wrapper .gform_page_footer input[type="button"]',
				'.gform_wrapper .gform_button',
				'.gform_wrapper .button'
			);
			$css[$four_eigthy_media_query][aione_implode( $elements )]['-webkit-box-sizing']  = 'border-box';
			$css[$four_eigthy_media_query][aione_implode( $elements )]['box-sizing'] = 'border-box';

		}

		/* @media only screen and (min-device-width: 320px) and (max-device-width: 640px)
		================================================================================================= */
		$three_twenty_six_fourty_media_query = '@media only screen and (min-device-width: 320px) and (max-device-width: 640px)';

		// # Layout
		$css[$three_twenty_six_fourty_media_query]['#wrapper']['width']      = 'auto !important';
		$css[$three_twenty_six_fourty_media_query]['#wrapper']['overflow-x'] = 'hidden !important';

		$css[$three_twenty_six_fourty_media_query]['.oxo-columns .oxo-column']['float']      = 'none';
		$css[$three_twenty_six_fourty_media_query]['.oxo-columns .oxo-column']['width']      = '100% !important';
		$css[$three_twenty_six_fourty_media_query]['.oxo-columns .oxo-column']['margin']     = '0 0 50px';
		$css[$three_twenty_six_fourty_media_query]['.oxo-columns .oxo-column']['box-sizing'] = 'border-box';

		$elements = array(
			'.footer-area .oxo-columns .oxo-column',
			'#slidingbar-area .oxo-columns .oxo-column'
		);
		$css[$three_twenty_six_fourty_media_query][aione_implode( $elements )]['float'] = 'left';
		$css[$three_twenty_six_fourty_media_query][aione_implode( $elements )]['width'] = '98% !important';

		$css[$three_twenty_six_fourty_media_query]['.fullwidth-box']['background-attachment'] = 'scroll !important';
		$css[$three_twenty_six_fourty_media_query]['.no-mobile-totop .to-top-container']['display'] = 'none';
		$css[$three_twenty_six_fourty_media_query]['.no-mobile-slidingbar #slidingbar-area']['display'] = 'none';

		$css[$three_twenty_six_fourty_media_query]['.review']['float'] = 'none';
		$css[$three_twenty_six_fourty_media_query]['.review']['width'] = '100%';

		$elements = array(
			'.social-networks',
			'.copyright'
		);
		$css[$three_twenty_six_fourty_media_query][aione_implode( $elements )]['float']      = 'none';
		$css[$three_twenty_six_fourty_media_query][aione_implode( $elements )]['padding']    = '0 0 15px';
		$css[$three_twenty_six_fourty_media_query][aione_implode( $elements )]['text-align'] = 'center';

		$elements = array(
			'.copyright:after',
			'.social-networks:after'
		);
		$css[$three_twenty_six_fourty_media_query][aione_implode( $elements )]['content'] = '""';
		$css[$three_twenty_six_fourty_media_query][aione_implode( $elements )]['display'] = 'block';
		$css[$three_twenty_six_fourty_media_query][aione_implode( $elements )]['clear']   = 'both';

		$elements = array(
			'.social-networks li',
			'.copyright li'
		);
		$css[$three_twenty_six_fourty_media_query][aione_implode( $elements )]['float']   = 'none';
		$css[$three_twenty_six_fourty_media_query][aione_implode( $elements )]['display'] = 'inline-block';

		$css[$three_twenty_six_fourty_media_query]['.continue']['display'] = 'none';

		$css[$three_twenty_six_fourty_media_query]['.mobile-button']['display'] = 'block !important';
		$css[$three_twenty_six_fourty_media_query]['.mobile-button']['float']   = 'none';

		$css[$three_twenty_six_fourty_media_query]['.title']['margin-top']    = '0px !important';
		$css[$three_twenty_six_fourty_media_query]['.title']['margin-bottom'] = '20px !important';

		$css[$three_twenty_six_fourty_media_query]['#content']['width']         = '100% !important';
		$css[$three_twenty_six_fourty_media_query]['#content']['float']         = 'none !important';
		$css[$three_twenty_six_fourty_media_query]['#content']['margin-left']   = '0 !important';
		$css[$three_twenty_six_fourty_media_query]['#content']['margin-bottom'] = '50px';

		$css[$three_twenty_six_fourty_media_query]['#content.full-width']['margin-bottom'] = '0';

		$css[$three_twenty_six_fourty_media_query]['.sidebar']['width'] = '100% !important';
		$css[$three_twenty_six_fourty_media_query]['.sidebar']['float'] = 'none !important';

		$css[$three_twenty_six_fourty_media_query]['.sidebar .social_links .social li']['width']        = 'auto';
		$css[$three_twenty_six_fourty_media_query]['.sidebar .social_links .social li']['margin-right'] = '5px';

		$css[$three_twenty_six_fourty_media_query]['#comment-input']['margin-bottom'] = '0';

		$css[$three_twenty_six_fourty_media_query]['#comment-input input']['width']         = '90%';
		$css[$three_twenty_six_fourty_media_query]['#comment-input input']['float']         = 'none !important';
		$css[$three_twenty_six_fourty_media_query]['#comment-input input']['margin-bottom'] = '10px';

		$css[$three_twenty_six_fourty_media_query]['#comment-textarea textarea']['width'] = '90%';

		$css[$three_twenty_six_fourty_media_query]['.widget.facebook_like iframe']['width']     = '100% !important';
		$css[$three_twenty_six_fourty_media_query]['.widget.facebook_like iframe']['max-width'] = 'none !important';

		$css[$three_twenty_six_fourty_media_query]['.pagination']['margin-top'] = '40px';

		$css[$three_twenty_six_fourty_media_query]['.portfolio-one .portfolio-item .image']['float']         = 'none';
		$css[$three_twenty_six_fourty_media_query]['.portfolio-one .portfolio-item .image']['width']         = 'auto';
		$css[$three_twenty_six_fourty_media_query]['.portfolio-one .portfolio-item .image']['height']        = 'auto';
		$css[$three_twenty_six_fourty_media_query]['.portfolio-one .portfolio-item .image']['margin-bottom'] = '20px';

		$css[$three_twenty_six_fourty_media_query]['h5.toggle span.toggle-title']['width'] = '80%';

		$css[$three_twenty_six_fourty_media_query]['#wrapper .sep-boxed-pricing .panel-wrapper']['padding'] = '0';

		$elements = array(
			'#wrapper .full-boxed-pricing .column',
			'#wrapper .sep-boxed-pricing .column'
		);
		$css[$three_twenty_six_fourty_media_query][aione_implode( $elements )]['float']         = 'none';
		$css[$three_twenty_six_fourty_media_query][aione_implode( $elements )]['margin-bottom'] = '10px';
		$css[$three_twenty_six_fourty_media_query][aione_implode( $elements )]['margin-left']   = '0';
		$css[$three_twenty_six_fourty_media_query][aione_implode( $elements )]['width']         = '100%';

		$css[$three_twenty_six_fourty_media_query]['.share-box']['height'] = 'auto';

		$css[$three_twenty_six_fourty_media_query]['#wrapper .share-box h4']['float']       = 'none';
		$css[$three_twenty_six_fourty_media_query]['#wrapper .share-box h4']['line-height'] = '20px !important';
		$css[$three_twenty_six_fourty_media_query]['#wrapper .share-box h4']['margin-top']  = '0';
		$css[$three_twenty_six_fourty_media_query]['#wrapper .share-box h4']['padding']     = '0';

		$css[$three_twenty_six_fourty_media_query]['.share-box ul']['float']          = 'none';
		$css[$three_twenty_six_fourty_media_query]['.share-box ul']['overflow']       ='hidden';
		$css[$three_twenty_six_fourty_media_query]['.share-box ul']['padding']        = '0 25px';
		$css[$three_twenty_six_fourty_media_query]['.share-box ul']['padding-bottom'] = '25px';
		$css[$three_twenty_six_fourty_media_query]['.share-box ul']['margin-top']     = '0px';

		$css[$three_twenty_six_fourty_media_query]['.project-content .project-description']['float'] = 'none !important';

		$css[$three_twenty_six_fourty_media_query]['.project-content .oxo-project-description-details']['margin-bottom'] = '50px';

		$elements = array(
			'.project-content .project-description',
			'.project-content .project-info'
		);
		$css[$three_twenty_six_fourty_media_query][aione_implode( $elements )]['width'] = '100% !important';

		$css[$three_twenty_six_fourty_media_query]['.portfolio-half .flexslider']['width'] = '100% !important';

		$css[$three_twenty_six_fourty_media_query]['.portfolio-half .project-content']['width'] = '100% !important';

		$css[$three_twenty_six_fourty_media_query]['#style_selector']['display'] = 'none';

		$elements = array(
			'.ls-aione .ls-nav-prev',
			'.ls-aione .ls-nav-next'
		);
		$css[$three_twenty_six_fourty_media_query][aione_implode( $elements )]['display'] = 'none !important';

		$css[$three_twenty_six_fourty_media_query]['#footer .social-networks']['width']    = '100%';
		$css[$three_twenty_six_fourty_media_query]['#footer .social-networks']['margin']   = '0 auto';
		$css[$three_twenty_six_fourty_media_query]['#footer .social-networks']['position'] = 'relative';
		$css[$three_twenty_six_fourty_media_query]['#footer .social-networks']['left']     = '-11px';

		$css[$three_twenty_six_fourty_media_query]['.recent-works-items a']['max-width'] = '64px';

		$elements = array(
			'.footer-area .flickr_badge_image img',
			'#slidingbar-area .flickr_badge_image img'
		);
		$css[$three_twenty_six_fourty_media_query][aione_implode( $elements )]['max-width'] = '64px';
		$css[$three_twenty_six_fourty_media_query][aione_implode( $elements )]['padding']   = '3px !important';

		$css[$three_twenty_six_fourty_media_query]['.tab-holder .tabs']['height'] = 'auto !important';
		$css[$three_twenty_six_fourty_media_query]['.tab-holder .tabs']['width']  = '100% !important';

		$css[$three_twenty_six_fourty_media_query]['.shortcode-tabs .tab-hold .tabs li']['width'] = '100% !important';

		$elements = array(
			'body .shortcode-tabs .tab-hold .tabs li',
			'body.dark .sidebar .tab-hold .tabs li'
		);
		$css[$three_twenty_six_fourty_media_query][aione_implode( $elements )]['border-right'] = 'none !important';

		$css[$three_twenty_six_fourty_media_query]['.error_page .useful_links']['width']        = '100%';
		$css[$three_twenty_six_fourty_media_query]['.error_page .useful_links']['padding-left'] = '0';

		$css[$three_twenty_six_fourty_media_query]['.oxo-google-map']['width']         = '100% !important';

		$css[$three_twenty_six_fourty_media_query]['.social_links_shortcode .social li']['width'] = '10% !important';

		$css[$three_twenty_six_fourty_media_query]['#wrapper .ei-slider']['width']  = '100% !important';
		$css[$three_twenty_six_fourty_media_query]['#wrapper .ei-slider']['height'] = '200px !important';

		$css[$three_twenty_six_fourty_media_query]['.progress-bar']['margin-bottom'] = '10px !important';

		$css[$three_twenty_six_fourty_media_query]['#wrapper .content-boxes-icon-boxed .content-wrapper-boxed']['min-height']     = 'inherit !important';
		$css[$three_twenty_six_fourty_media_query]['#wrapper .content-boxes-icon-boxed .content-wrapper-boxed']['padding-bottom'] = '20px';
		$css[$three_twenty_six_fourty_media_query]['#wrapper .content-boxes-icon-boxed .content-wrapper-boxed']['padding-left']   = '3% !important';
		$css[$three_twenty_six_fourty_media_query]['#wrapper .content-boxes-icon-boxed .content-wrapper-boxed']['padding-right']  = '3% !important';

		$elements = array(
			'#wrapper .content-boxes-icon-on-top .content-box-column',
			'#wrapper .content-boxes-icon-boxed .content-box-column'
		);
		$css[$three_twenty_six_fourty_media_query][aione_implode( $elements )]['margin-bottom'] = '55px';

		$css[$three_twenty_six_fourty_media_query]['.share-box .social-networks']['text-align'] = 'left';

		$css[$three_twenty_six_fourty_media_query]['#content']['width']       = '100% !important';
		$css[$three_twenty_six_fourty_media_query]['#content']['margin-left'] = '0px !important';

		$css[$three_twenty_six_fourty_media_query]['.sidebar']['width']       = '100% !important';
		$css[$three_twenty_six_fourty_media_query]['.sidebar']['float']       = 'none !important';
		$css[$three_twenty_six_fourty_media_query]['.sidebar']['margin-left'] = '0 !important';


		/* media.css CSS - to be split to the corresponding sections above
		================================================================================================= */
		$media_query = '@media only screen and (max-width: ' . ( intval( $side_header_width ) + 1000 ) . 'px)';

		$css[$media_query]['.no-csstransforms .sep-boxed-pricing .column']['margin-left'] = '1.5% !important';

		if ( class_exists( 'WooCommerce' ) ) {

			$media_query = '@media only screen and (max-width: ' . ( intval( $side_header_width ) + 965 ) . 'px)';


			$css[$media_query]['.coupon .input-text']['width'] = '100% !important';

			$css[$media_query]['.coupon .button']['margin-top'] = '20px';

			$media_query = '@media only screen and (max-width: ' . ( intval( $side_header_width ) + 900 ) . 'px)';

			$elements = array(
				'.woocommerce #customer_login .login .form-row',
				'.woocommerce #customer_login .login .lost_password'
			);
			$css[$media_query][aione_implode( $elements )]['float'] = 'none';

			$elements = array(
				'.woocommerce #customer_login .login .inline',
				'.woocommerce #customer_login .login .lost_password'
			);
			$css[$media_query][aione_implode( $elements )]['display']      = 'block';
			$css[$media_query][aione_implode( $elements )]['margin-left']  = '0';
			$css[$media_query][aione_implode( $elements )]['margin-right'] = '0';

		}

		$media_query = '@media only screen and (min-width: ' . intval( Aione()->theme_options[ 'side_header_break_point' ] ) . 'px)';

		$css[$media_query]['body.side-header-right.layout-boxed-mode #side-header']['position'] = 'absolute';
		$css[$media_query]['body.side-header-right.layout-boxed-mode #side-header']['top']      = '0';

		$css[$media_query]['body.side-header-right.layout-boxed-mode #side-header .side-header-wrapper']['position'] = 'absolute';



		$media_query = '@media screen and (max-width: ' . intval( Aione()->theme_options[ 'side_header_break_point' ] - 18 ) . 'px)';
		$elements = array(
			'body.admin-bar #wrapper #slidingbar-area',
			'body.layout-boxed-mode.side-header-right #slidingbar-area',
			'.admin-bar p.demo_store'
		);
		$css[$media_query][aione_implode( $elements )]['top'] = '46px';
		$css[$media_query]['body.body_blank.admin-bar']['top'] = '45px';
		$css[$media_query]['html #wpadminbar']['z-index']  = '99999 !important';
		$css[$media_query]['html #wpadminbar']['position'] = 'fixed !important';

		$media_query = '@media screen and (max-width: ' . intval( Aione()->theme_options[ 'side_header_break_point' ] - 32 ) . 'px)';
		$css[$media_query]['.oxo-tabs.vertical-tabs .tab-pane']['max-width'] = 'none !important';

		$media_query = '@media only screen and (min-device-width: 768px) and (max-device-width: 1024px)';
		$css[$media_query]['#wrapper .ei-slider']['width'] = '100%';

		$media_query = '@media only screen and (min-device-width: 320px) and (max-device-width: 480px)';
		$css[$media_query]['#wrapper .ei-slider']['width'] = '100%';


		/* iPad Landscape Responsive Styles
		================================================================================================= */
		$ipad_landscape_media_query = '@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: landscape)';

		// #Layout
		$css[$ipad_landscape_media_query]['.fullwidth-box']['background-attachment'] = 'scroll !important';

		if ( Aione()->theme_options[ 'mobile_nav_padding' ] ) {
			$css[$ipad_landscape_media_query]['.oxo-main-menu > ul > li']['padding-right'] = intval( Aione()->theme_options[ 'mobile_nav_padding' ] ) . 'px';
		}

		$css[$ipad_landscape_media_query]['#wrapper .oxo-page-title-bar']['height'] = Aione_Sanitize::size( Aione()->theme_options[ 'page_title_height' ] ) . ' !important';

		// # Footer Styles
		if ( Aione()->theme_options[ 'footer_sticky_height' ] && ( in_array( Aione()->theme_options[ 'footer_special_effects' ], array( 'footer_sticky', 'footer_sticky_with_parallax_bg_image' ) ) ) ) {
			$elements = array( 'html', 'body', '#boxed-wrapper', '#wrapper' );
			$css[$ipad_landscape_media_query][aione_implode( $elements )]['height']     = 'auto';
			$css[$ipad_landscape_media_query]['.above-footer-wrapper']['min-height']    = 'none';
			$css[$ipad_landscape_media_query]['.above-footer-wrapper']['margin-bottom'] = '0';
			$css[$ipad_landscape_media_query]['.above-footer-wrapper:after']['height']  = 'auto';
			$css[$ipad_landscape_media_query]['.oxo-footer']['height']               = 'auto';
		}

		if ( Aione()->theme_options[ 'footer_special_effects' ] == 'footer_area_bg_parallax' ) {

			$css[$ipad_landscape_media_query]['.oxo-footer-widget-area']['background-attachment'] = 'static';
			$css[$ipad_landscape_media_query]['.oxo-footer-widget-area']['margin']   = '0';

			$css[$ipad_landscape_media_query]['#main']['margin-bottom']   = '0';
		}


		$css[$ipad_landscape_media_query]['#wrapper .ei-slider']['width'] = '100%';
		$elements = array(
			'.fullwidth-box',
			'.page-title-bar',
			'.oxo-footer-widget-area',
			'body',
			'#main'
		);

		$css[$ipad_landscape_media_query][aione_implode( $elements )]['background-attachment'] = 'scroll !important';
		if ( Aione()->theme_options[ 'footerw_bg_image' ] && ( in_array( Aione()->theme_options[ 'footer_special_effects' ], array( 'footer_parallax_effect', 'footer_area_bg_parallax', 'footer_sticky_with_parallax_bg_image' ) ) ) ) {
			$css[$ipad_landscape_media_query]['.oxo-body #wrapper']['background-color'] = 'transparent';
		}

		if ( Aione()->theme_options[ 'footer_sticky_height' ] && ( in_array( Aione()->theme_options[ 'footer_special_effects' ], array( 'footer_sticky', 'footer_sticky_with_parallax_bg_image' ) ) ) ) {
			$elements = array( 'html', 'body', '#boxed-wrapper', '#wrapper' );
			$css[$ipad_landscape_media_query][aione_implode( $elements )]['height']     = 'auto';
			$css[$ipad_landscape_media_query]['.above-footer-wrapper']['min-height']    = 'none';
			$css[$ipad_landscape_media_query]['.above-footer-wrapper']['margin-bottom'] = '0';
			$css[$ipad_landscape_media_query]['.above-footer-wrapper:after']['height']  = 'auto';
			$css[$ipad_landscape_media_query]['.oxo-footer']['height']               = 'auto';
		}

		if ( Aione()->theme_options[ 'footer_special_effects' ] == 'footer_area_bg_parallax' ) {
			$css[$ipad_landscape_media_query]['.oxo-footer-widget-area']['background-attachment'] = 'static';
			$css[$ipad_landscape_media_query]['.oxo-footer-widget-area']['margin']   = '0';

			$css[$ipad_landscape_media_query]['#main']['margin-bottom']   = '0';
		}

		/* iPad Portrait Responsive Styles
		================================================================================================= */
		$ipad_portrait_media_query = '@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: portrait)';

		// # Layout
		if ( Aione()->theme_options[ 'footerw_bg_image' ] && ( in_array( Aione()->theme_options[ 'footer_special_effects' ], array( 'footer_parallax_effect', 'footer_area_bg_parallax', 'footer_sticky_with_parallax_bg_image' ) ) ) ) {
			$css[$ipad_portrait_media_query]['.oxo-body #wrapper']['background-color'] = 'transparent';
		}


		if ( Aione()->theme_options[ 'footer_sticky_height' ] && ( in_array( Aione()->theme_options[ 'footer_special_effects' ], array( 'footer_sticky', 'footer_sticky_with_parallax_bg_image' ) ) ) ) {
			$elements = array( 'html', 'body', '#boxed-wrapper', '#wrapper' );
			$css[$ipad_portrait_media_query][aione_implode( $elements )]['height']     = 'auto';
			$css[$ipad_portrait_media_query]['.above-footer-wrapper']['min-height']    = 'none';
			$css[$ipad_portrait_media_query]['.above-footer-wrapper']['margin-bottom'] = '0';
			$css[$ipad_portrait_media_query]['.above-footer-wrapper:after']['height']  = 'auto';
			$css[$ipad_portrait_media_query]['.oxo-footer']['height']               = 'auto';
		}

		if ( Aione()->theme_options[ 'footer_special_effects' ] == 'footer_area_bg_parallax' ) {
			$css[$ipad_portrait_media_query]['.oxo-footer-widget-area']['background-attachment'] = 'static';
			$css[$ipad_portrait_media_query]['.oxo-footer-widget-area']['margin']   = '0';

			$css[$ipad_portrait_media_query]['#main']['margin-bottom']   = '0';
		}

		$elements = array(
			'.oxo-columns-5 .oxo-column:first-child',
			'.oxo-columns-4 .oxo-column:first-child',
			'.oxo-columns-3 .oxo-column:first-child',
			'.oxo-columns-2 .oxo-column:first-child',
			'.oxo-columns-1 .oxo-column:first-child'
		);
		$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['margin-left'] = '0';

		$elements = array(
			'.oxo-column:nth-child(5n)',
			'.oxo-column:nth-child(4n)',
			'.oxo-column:nth-child(3n)',
			'.oxo-column:nth-child(2n)',
			'.oxo-column'
		);
		$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['margin-right'] = '0';

		$ipad_portrait[$ipad_portrait_media_query]['#wrapper']['width']      = 'auto !important';

		$ipad_portrait[$ipad_portrait_media_query]['.create-block-format-context']['display'] = 'none';

		$ipad_portrait[$ipad_portrait_media_query]['.columns .col']['float']      = 'none';
		$ipad_portrait[$ipad_portrait_media_query]['.columns .col']['width']      = '100% !important';
		$ipad_portrait[$ipad_portrait_media_query]['.columns .col']['margin']     = '0 0 20px';
		$ipad_portrait[$ipad_portrait_media_query]['.columns .col']['box-sizing'] = 'border-box';

		$ipad_portrait[$ipad_portrait_media_query]['.fullwidth-box']['background-attachment'] = 'scroll !important';

		if ( Aione()->theme_options[ 'mobile_nav_padding' ] ) {
			$ipad_portrait[$ipad_portrait_media_query]['.oxo-main-menu > ul > li']['padding-right'] = intval( Aione()->theme_options[ 'mobile_nav_padding' ] ) . 'px';
		}

		if ( ! Aione()->theme_options[ 'breadcrumb_mobile' ] ) {
			$ipad_portrait[$ipad_portrait_media_query]['.oxo-body .oxo-page-title-bar .oxo-breadcrumbs']['display'] = 'none';
		}

		// # Footer Styles
		if ( Aione()->theme_options[ 'footer_sticky_height' ] && ( in_array( Aione()->theme_options[ 'footer_special_effects' ], array( 'footer_sticky', 'footer_sticky_with_parallax_bg_image' ) ) ) ) {
			$elements = array( 'html', 'body', '#boxed-wrapper', '#wrapper' );
			$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['height']     = 'auto';
			$ipad_portrait[$ipad_portrait_media_query]['.above-footer-wrapper']['min-height']    = 'none';
			$ipad_portrait[$ipad_portrait_media_query]['.above-footer-wrapper']['margin-bottom'] = '0';
			$ipad_portrait[$ipad_portrait_media_query]['.above-footer-wrapper:after']['height']  = 'auto';
			$ipad_portrait[$ipad_portrait_media_query]['.oxo-footer']['height']               = 'auto';
		}

		if ( Aione()->theme_options[ 'footer_special_effects' ] == 'footer_area_bg_parallax' ) {
			$ipad_portrait[$ipad_portrait_media_query]['.oxo-footer-widget-area']['background-attachment'] = 'static';
			$css[$ipad_portrait_media_query]['.oxo-footer-widget-area']['margin']   = '0';

			$ipad_portrait[$ipad_portrait_media_query]['#main']['margin-bottom']   = '0';
		}

		$ipad_portrait[$ipad_portrait_media_query]['.review']['float'] = 'none';
		$ipad_portrait[$ipad_portrait_media_query]['.review']['width'] = '100%';

		$elements = array(
			'.oxo-social-networks',
			'.oxo-social-links-footer'
		);
		$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['display']    = 'block';
		$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['text-align'] = 'center';

		$ipad_portrait[$ipad_portrait_media_query]['.oxo-social-links-footer']['width'] = 'auto';

		$ipad_portrait[$ipad_portrait_media_query]['.oxo-social-links-footer .oxo-social-networks']['display'] = 'inline-block';
		$ipad_portrait[$ipad_portrait_media_query]['.oxo-social-links-footer .oxo-social-networks']['float']   = 'none';

		$ipad_portrait[$ipad_portrait_media_query]['.oxo-social-networks']['padding'] = '0 0 15px';

		$ipad_portrait[$ipad_portrait_media_query]['.oxo-author .oxo-author-ssocial .oxo-author-tagline']['float']      = 'none';
		$ipad_portrait[$ipad_portrait_media_query]['.oxo-author .oxo-author-ssocial .oxo-author-tagline']['text-align'] = 'center';
		$ipad_portrait[$ipad_portrait_media_query]['.oxo-author .oxo-author-ssocial .oxo-author-tagline']['max-width']  = '100%';

		$ipad_portrait[$ipad_portrait_media_query]['.oxo-author .oxo-author-ssocial .oxo-social-networks']['text-align'] = 'center';

		$ipad_portrait[$ipad_portrait_media_query]['.oxo-author .oxo-author-ssocial .oxo-social-networks .oxo-social-network-icon:first-child']['margin-left'] = '0';

		$ipad_portrait[$ipad_portrait_media_query]['.oxo-social-networks:after']['content'] = '""';
		$ipad_portrait[$ipad_portrait_media_query]['.oxo-social-networks:after']['display'] = 'block';
		$ipad_portrait[$ipad_portrait_media_query]['.oxo-social-networks:after']['clear']   = 'both';

		$ipad_portrait[$ipad_portrait_media_query]['.oxo-social-networks li']['float']   = 'none';
		$ipad_portrait[$ipad_portrait_media_query]['.oxo-social-networks li']['display'] = 'inline-block';

		$elements = array(
			'.oxo-reading-box-container .reading-box.reading-box-center',
			'.oxo-reading-box-container .reading-box.reading-box-right'
		);
		$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['text-align'] = 'left';

		$ipad_portrait[$ipad_portrait_media_query]['.oxo-reading-box-container .continue']['display'] = 'block';

		$ipad_portrait[$ipad_portrait_media_query]['.oxo-reading-box-container .mobile-button']['display'] = 'none';
		$ipad_portrait[$ipad_portrait_media_query]['.oxo-reading-box-container .mobile-button']['float']   = 'none';

		$ipad_portrait[$ipad_portrait_media_query]['.oxo-title']['margin-top']    = '0px !important';
		$ipad_portrait[$ipad_portrait_media_query]['.oxo-title']['margin-bottom'] = '20px !important';

		if ( class_exists( 'WooCommerce' ) ) {

			$ipad_portrait[$ipad_portrait_media_query]['#main .cart-empty']['float']         = 'none';
			$ipad_portrait[$ipad_portrait_media_query]['#main .cart-empty']['text-align']    = 'center';
			$ipad_portrait[$ipad_portrait_media_query]['#main .cart-empty']['border-top']    = '1px solid';
			$ipad_portrait[$ipad_portrait_media_query]['#main .cart-empty']['border-bottom'] = 'none';
			$ipad_portrait[$ipad_portrait_media_query]['#main .cart-empty']['width']         = '100%';
			$ipad_portrait[$ipad_portrait_media_query]['#main .cart-empty']['line-height']   = 'normal !important';
			$ipad_portrait[$ipad_portrait_media_query]['#main .cart-empty']['height']        = 'auto !important';
			$ipad_portrait[$ipad_portrait_media_query]['#main .cart-empty']['margin-bottom'] = '10px';
			$ipad_portrait[$ipad_portrait_media_query]['#main .cart-empty']['padding-top']   = '10px';

			$ipad_portrait[$ipad_portrait_media_query]['#main .return-to-shop']['float']          = 'none';
			$ipad_portrait[$ipad_portrait_media_query]['#main .return-to-shop']['border-top']     = 'none';
			$ipad_portrait[$ipad_portrait_media_query]['#main .return-to-shop']['border-bottom']  = '1px solid';
			$ipad_portrait[$ipad_portrait_media_query]['#main .return-to-shop']['width']          = '100%';
			$ipad_portrait[$ipad_portrait_media_query]['#main .return-to-shop']['text-align']     = 'center';
			$ipad_portrait[$ipad_portrait_media_query]['#main .return-to-shop']['line-height']    = 'normal !important';
			$ipad_portrait[$ipad_portrait_media_query]['#main .return-to-shop']['height']         = 'auto !important';
			$ipad_portrait[$ipad_portrait_media_query]['#main .return-to-shop']['padding-bottom'] = '10px';

			$ipad_portrait[$ipad_portrait_media_query]['.woocommerce .checkout_coupon .promo-code-heading']['display']       = 'block';
			$ipad_portrait[$ipad_portrait_media_query]['.woocommerce .checkout_coupon .promo-code-heading']['margin-bottom'] = '10px !important';
			$ipad_portrait[$ipad_portrait_media_query]['.woocommerce .checkout_coupon .promo-code-heading']['float']         = 'none';
			$ipad_portrait[$ipad_portrait_media_query]['.woocommerce .checkout_coupon .promo-code-heading']['text-align']    = 'center';

			$ipad_portrait[$ipad_portrait_media_query]['.woocommerce .checkout_coupon .coupon-contents']['display'] = 'block';
			$ipad_portrait[$ipad_portrait_media_query]['.woocommerce .checkout_coupon .coupon-contents']['float']   = 'none';
			$ipad_portrait[$ipad_portrait_media_query]['.woocommerce .checkout_coupon .coupon-contents']['margin']  = '0';

			$ipad_portrait[$ipad_portrait_media_query]['.woocommerce .checkout_coupon .coupon-input']['display']       = 'block';
			$ipad_portrait[$ipad_portrait_media_query]['.woocommerce .checkout_coupon .coupon-input']['width']         = 'auto !important';
			$ipad_portrait[$ipad_portrait_media_query]['.woocommerce .checkout_coupon .coupon-input']['float']         = 'none';
			$ipad_portrait[$ipad_portrait_media_query]['.woocommerce .checkout_coupon .coupon-input']['text-align']    = 'center';
			$ipad_portrait[$ipad_portrait_media_query]['.woocommerce .checkout_coupon .coupon-input']['margin-right']  ='0';
			$ipad_portrait[$ipad_portrait_media_query]['.woocommerce .checkout_coupon .coupon-input']['margin-bottom'] = '10px !important';

			$ipad_portrait[$ipad_portrait_media_query]['.woocommerce .checkout_coupon .coupon-button']['display']      = 'block';
			$ipad_portrait[$ipad_portrait_media_query]['.woocommerce .checkout_coupon .coupon-button']['margin-right'] = '0';
			$ipad_portrait[$ipad_portrait_media_query]['.woocommerce .checkout_coupon .coupon-button']['float']        = 'none';
			$ipad_portrait[$ipad_portrait_media_query]['.woocommerce .checkout_coupon .coupon-button']['text-align']   = 'center';

		}

		// Page Title Bar

		if ( 'auto' != Aione()->theme_options[ 'page_title_mobile_height' ] ) {

			$ipad_portrait[$ipad_portrait_media_query]['.oxo-body .oxo-page-title-bar']['height'] = Aione_Sanitize::size( Aione()->theme_options[ 'page_title_mobile_height' ] );

		} else {

			$ipad_portrait[$ipad_portrait_media_query]['.oxo-body .oxo-page-title-bar']['padding-top']    = '10px';
			$ipad_portrait[$ipad_portrait_media_query]['.oxo-body .oxo-page-title-bar']['padding-bottom'] = '10px';
			$ipad_portrait[$ipad_portrait_media_query]['.oxo-body .oxo-page-title-bar']['height']         = 'auto';

		}

		$elements = array(
			'.oxo-page-title-bar-left .oxo-page-title-captions',
			'.oxo-page-title-bar-right .oxo-page-title-captions',
			'.oxo-page-title-bar-left .oxo-page-title-secondary',
			'.oxo-page-title-bar-right .oxo-page-title-secondary'
		);
		$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['display']     = 'block';
		$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['float']       = 'none';
		$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['width']       = '100%';
		$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['line-height'] = 'normal';

		$ipad_portrait[$ipad_portrait_media_query]['.oxo-page-title-bar-left .oxo-page-title-secondary']['text-align'] = 'left';

		$ipad_portrait[$ipad_portrait_media_query]['.oxo-page-title-bar-left .searchform']['display']   = 'block';
		$ipad_portrait[$ipad_portrait_media_query]['.oxo-page-title-bar-left .searchform']['max-width'] = '100%';

		$ipad_portrait[$ipad_portrait_media_query]['.oxo-page-title-bar-right .oxo-page-title-secondary']['text-align'] = 'right';

		$ipad_portrait[$ipad_portrait_media_query]['.oxo-page-title-bar-right .searchform']['max-width'] = '100%';

		if ( 'auto' != Aione()->theme_options[ 'page_title_mobile_height' ] ) {

			$ipad_portrait[$ipad_portrait_media_query]['.oxo-page-title-row']['display']    = 'table';
			$ipad_portrait[$ipad_portrait_media_query]['.oxo-page-title-row']['width']      = '100%';
			$ipad_portrait[$ipad_portrait_media_query]['.oxo-page-title-row']['height']     = '100%';
			$ipad_portrait[$ipad_portrait_media_query]['.oxo-page-title-row']['min-height'] = intval( Aione()->theme_options[ 'page_title_mobile_height' ] ) - 20 . 'px';

			$ipad_portrait[$ipad_portrait_media_query]['.oxo-page-title-wrapper']['display']        = 'table-cell';
			$ipad_portrait[$ipad_portrait_media_query]['.oxo-page-title-wrapper']['vertical-align'] = 'middle';

		}

		if ( get_post_meta( $c_pageID, 'pyre_page_title_height', true ) ) {
			$ipad_portrait[$ipad_portrait_media_query]['#wrapper .oxo-page-title-bar']['height'] = Aione_Sanitize::size( get_post_meta( $c_pageID, 'pyre_page_title_height', true ) ) . ' !important';
		}

		$ipad_portrait[$ipad_portrait_media_query]['.products .product-list-view']['width']     = '100% !important';
		$ipad_portrait[$ipad_portrait_media_query]['.products .product-list-view']['min-width'] = '100% !important';

		$ipad_portrait[$ipad_portrait_media_query]['.sidebar .social_links .social li']['width']        = 'auto';
		$ipad_portrait[$ipad_portrait_media_query]['.sidebar .social_links .social li']['margin-right'] = '5px';

		$ipad_portrait[$ipad_portrait_media_query]['#comment-input']['margin-bottom'] = '0';

		$ipad_portrait[$ipad_portrait_media_query]['#comment-input input']['width']         = '90%';
		$ipad_portrait[$ipad_portrait_media_query]['#comment-input input']['float']         = 'none !important';
		$ipad_portrait[$ipad_portrait_media_query]['#comment-input input']['margin-bottom'] = '10px';

		$ipad_portrait[$ipad_portrait_media_query]['#comment-textarea textarea']['width'] = '90%';

		$ipad_portrait[$ipad_portrait_media_query]['.pagination']['margin-top'] = '40px';

		$ipad_portrait[$ipad_portrait_media_query]['.portfolio-one .portfolio-item .image']['float']         = 'none';
		$ipad_portrait[$ipad_portrait_media_query]['.portfolio-one .portfolio-item .image']['width']         = 'auto';
		$ipad_portrait[$ipad_portrait_media_query]['.portfolio-one .portfolio-item .image']['height']        = 'auto';
		$ipad_portrait[$ipad_portrait_media_query]['.portfolio-one .portfolio-item .image']['margin-bottom'] = '20px';

		$ipad_portrait[$ipad_portrait_media_query]['h5.toggle span.toggle-title']['width'] = '80%';

		$ipad_portrait[$ipad_portrait_media_query]['#wrapper .sep-boxed-pricing .panel-wrapper']['padding'] = '0';

		$elements = array(
			'#wrapper .full-boxed-pricing .column',
			'#wrapper .sep-boxed-pricing .column'
		);
		$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['float']         = 'none';
		$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['margin-bottom'] = '10px';
		$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['margin-left']   = '0';
		$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['width']         = '100%';

		$ipad_portrait[$ipad_portrait_media_query]['.share-box']['height'] = 'auto';

		$ipad_portrait[$ipad_portrait_media_query]['#wrapper .share-box h4']['float']       = 'none';
		$ipad_portrait[$ipad_portrait_media_query]['#wrapper .share-box h4']['line-height'] = '20px !important';
		$ipad_portrait[$ipad_portrait_media_query]['#wrapper .share-box h4']['padding']     = '0';

		$ipad_portrait[$ipad_portrait_media_query]['.share-box ul']['float']          = 'none';
		$ipad_portrait[$ipad_portrait_media_query]['.share-box ul']['overflow']       = 'hidden';
		$ipad_portrait[$ipad_portrait_media_query]['.share-box ul']['padding']        = '0 25px';
		$ipad_portrait[$ipad_portrait_media_query]['.share-box ul']['padding-bottom'] = '15px';
		$ipad_portrait[$ipad_portrait_media_query]['.share-box ul']['margin-top']     = '0px';

		$ipad_portrait[$ipad_portrait_media_query]['.project-content .project-description']['float'] = 'none !important';

		$ipad_portrait[$ipad_portrait_media_query]['.project-content .oxo-project-description-details']['margin-bottom'] = '50px';

		$elements = array(
			'.project-content .project-description',
			'.project-content .project-info'
		);
		$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['width'] = '100% !important';

		$ipad_portrait[$ipad_portrait_media_query]['.portfolio-half .flexslider']['width'] = '100%';

		$ipad_portrait[$ipad_portrait_media_query]['.portfolio-half .project-content']['width'] = '100% !important';

		$ipad_portrait[$ipad_portrait_media_query]['#style_selector']['display'] = 'none';

		$elements = array(
			'.portfolio-tabs',
			'.faq-tabs'
		);
		$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['height']              = 'auto';
		$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['border-bottom-width'] = '1px';
		$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['border-bottom-style'] = 'solid';

		$elements = array(
			'.portfolio-tabs li',
			'.faq-tabs li'
		);
		$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['float']         = 'left';
		$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['margin-right']  = '30px';
		$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['border-bottom'] = '0';

		$elements = array(
			'.ls-aione .ls-nav-prev',
			'.ls-aione .ls-nav-next'
		);
		$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['display'] = 'none !important';

		$elements = array(
			'nav#nav',
			'nav#sticky-nav'
		);
		$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['margin-right'] = '0';

		$ipad_portrait[$ipad_portrait_media_query]['#footer .social-networks']['width']    = '100%';
		$ipad_portrait[$ipad_portrait_media_query]['#footer .social-networks']['margin']   = '0 auto';
		$ipad_portrait[$ipad_portrait_media_query]['#footer .social-networks']['position'] = 'relative';
		$ipad_portrait[$ipad_portrait_media_query]['#footer .social-networks']['left']     = '-11px';

		$ipad_portrait[$ipad_portrait_media_query]['.tab-holder .tabs']['height'] = 'auto !important';
		$ipad_portrait[$ipad_portrait_media_query]['.tab-holder .tabs']['width']  = '100% !important';

		$ipad_portrait[$ipad_portrait_media_query]['.shortcode-tabs .tab-hold .tabs li']['width'] = '100% !important';

		$elements = array(
			'body .shortcode-tabs .tab-hold .tabs li',
			'body.dark .sidebar .tab-hold .tabs li'
		);
		$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['border-right'] = 'none !important';

		$ipad_portrait[$ipad_portrait_media_query]['.error-message']['line-height'] = '170px';
		$ipad_portrait[$ipad_portrait_media_query]['.error-message']['margin-top']  = '20px';

		$ipad_portrait[$ipad_portrait_media_query]['.error_page .useful_links']['width']        = '100%';
		$ipad_portrait[$ipad_portrait_media_query]['.error_page .useful_links']['padding-left'] = '0';

		$ipad_portrait[$ipad_portrait_media_query]['.oxo-google-map']['width']         = '100% !important';

		$ipad_portrait[$ipad_portrait_media_query]['.social_links_shortcode .social li']['width'] = '10% !important';

		$ipad_portrait[$ipad_portrait_media_query]['#wrapper .ei-slider']['width']  = '100% !important';
		$ipad_portrait[$ipad_portrait_media_query]['#wrapper .ei-slider']['height'] = '200px !important';

		$ipad_portrait[$ipad_portrait_media_query]['.progress-bar']['margin-bottom'] = '10px !important';

		$ipad_portrait[$ipad_portrait_media_query]['.oxo-blog-layout-medium-alternate .oxo-post-content']['float']      = 'none';
		$ipad_portrait[$ipad_portrait_media_query]['.oxo-blog-layout-medium-alternate .oxo-post-content']['width']      = '100% !important';
		$ipad_portrait[$ipad_portrait_media_query]['.oxo-blog-layout-medium-alternate .oxo-post-content']['margin-top'] = '20px';

		$ipad_portrait[$ipad_portrait_media_query]['#wrapper .content-boxes-icon-boxed .content-wrapper-boxed']['min-height']     = 'inherit !important';
		$ipad_portrait[$ipad_portrait_media_query]['#wrapper .content-boxes-icon-boxed .content-wrapper-boxed']['padding-bottom'] = '20px';
		$ipad_portrait[$ipad_portrait_media_query]['#wrapper .content-boxes-icon-boxed .content-wrapper-boxed']['padding-left']   = '3%';
		$ipad_portrait[$ipad_portrait_media_query]['#wrapper .content-boxes-icon-boxed .content-wrapper-boxed']['padding-right']  = '3%';

		$elements = array(
			'#wrapper .content-boxes-icon-on-top .content-box-column',
			'#wrapper .content-boxes-icon-boxed .content-box-column'
		);
		$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['margin-bottom'] = '55px';

		$ipad_portrait[$ipad_portrait_media_query]['.oxo-counters-box .oxo-counter-box']['margin-bottom'] = '20px';
		$ipad_portrait[$ipad_portrait_media_query]['.oxo-counters-box .oxo-counter-box']['padding']       = '0 15px';

		$ipad_portrait[$ipad_portrait_media_query]['.oxo-counters-box .oxo-counter-box:last-child']['margin-bottom'] = '0';

		$ipad_portrait[$ipad_portrait_media_query]['.popup']['display'] = 'none !important';

		$ipad_portrait[$ipad_portrait_media_query]['.share-box .social-networks']['text-align'] = 'left';

		if ( class_exists( 'WooCommerce' ) ) {

			$elements = array(
				'.catalog-ordering .order',
				'.aione-myaccount-data .addresses .col-1',
				'.aione-myaccount-data .addresses .col-2',
				'.aione-customer-details .addresses .col-1',
				'.aione-customer-details .addresses .col-2',
				'#wrapper .catalog-ordering > .oxo-grid-list-view'
			);
			$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['float']        = 'none !important';
			$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['margin-left']  = 'auto !important';
			$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['margin-right'] = 'auto !important';

			$elements = array(
				'.aione-myaccount-data .addresses .col-1',
				'.aione-myaccount-data .addresses .col-2',
				'.aione-customer-details .addresses .col-1',
				'.aione-customer-details .addresses .col-2'
			);
			$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['margin'] = '0 !important';
			$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['width']  = '100%';

			$css[$ipad_portrait_media_query]['#wrapper .catalog-ordering']['margin-bottom'] = '50px';

			$css[$ipad_portrait_media_query]['#wrapper .orderby-order-container']['display'] = 'block';

			$css[$ipad_portrait_media_query]['#wrapper .order-dropdown > li:hover > ul']['display']  = 'block';
			$css[$ipad_portrait_media_query]['#wrapper .order-dropdown > li:hover > ul']['position'] = 'relative';
			$css[$ipad_portrait_media_query]['#wrapper .order-dropdown > li:hover > ul']['top']      = '0';

			$css[$ipad_portrait_media_query]['#wrapper .orderby-order-container']['margin']        = '0 auto';
			$css[$ipad_portrait_media_query]['#wrapper .orderby-order-container']['width']         = '225px';
			$css[$ipad_portrait_media_query]['#wrapper .orderby-order-container']['float']         = 'none';

			$css[$ipad_portrait_media_query]['#wrapper .orderby.order-dropdown']['width']        = '176px';

			$css[$ipad_portrait_media_query]['#wrapper .sort-count.order-dropdown']['display'] = 'block';
			$css[$ipad_portrait_media_query]['#wrapper .sort-count.order-dropdown']['width'] = '225px';

			$css[$ipad_portrait_media_query]['#wrapper .sort-count.order-dropdown ul a']['width'] = '225px';

			$css[$ipad_portrait_media_query]['#wrapper .catalog-ordering .order']['margin'] = '0';

			$css[$ipad_portrait_media_query]['.catalog-ordering .oxo-grid-list-view']['display'] = 'block';
			$css[$ipad_portrait_media_query]['.catalog-ordering .oxo-grid-list-view']['width'] = '78px';

			$elements = array(
				'.products-2 li:nth-child(2n+1)',
				'.products-3 li:nth-child(3n+1)',
				'.products-4 li:nth-child(4n+1)',
				'.products-5 li:nth-child(5n+1)',
				'.products-6 li:nth-child(6n+1)'
			);
			$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['clear'] = 'none !important';

			$ipad_portrait[$ipad_portrait_media_query]['#main .products li:nth-child(3n+1)']['clear'] = 'both !important';

			$elements = array(
				'.products li',
				'#main .products li:nth-child(3n)',
				'#main .products li:nth-child(4n)'
			);
			$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['width']        = '32.3% !important';
			$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['float']        = 'left !important';
			$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['margin-right'] = '1% !important';

			$elements = array(
				'.woocommerce #customer_login .login .form-row',
				'.woocommerce #customer_login .login .lost_password'
			);
			$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['float'] = 'none';

			$elements = array(
				'.woocommerce #customer_login .login .inline',
				'.woocommerce #customer_login .login .lost_password'
			);
			$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['display']     = 'block';
			$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['margin-left'] = '0';

			$ipad_portrait[$ipad_portrait_media_query]['.aione-myaccount-data .my_account_orders .order-number']['padding-right'] = '8px';

			$ipad_portrait[$ipad_portrait_media_query]['.aione-myaccount-data .my_account_orders .order-actions']['padding-left'] = '8px';

			$ipad_portrait[$ipad_portrait_media_query]['.shop_table .product-name']['width'] = '35%';

			$elements = array(
				'#wrapper .woocommerce-side-nav',
				'#wrapper .woocommerce-content-box',
				'#wrapper .shipping-coupon',
				'#wrapper .cart_totals',
				'#wrapper #customer_login .col-1',
				'#wrapper #customer_login .col-2',
				'#wrapper .woocommerce form.checkout #customer_details .col-1',
				'#wrapper .woocommerce form.checkout #customer_details .col-2'
			);
			$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['float']        = 'none';
			$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['margin-left']  = 'auto';
			$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['margin-right'] = 'auto';
			$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['width']        = '100% !important';

			$elements = array(
				'#customer_login .col-1',
				'.coupon'
			);
			$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['margin-bottom'] = '20px';

			$ipad_portrait[$ipad_portrait_media_query]['.shop_table .product-thumbnail']['float'] = 'none';

			$ipad_portrait[$ipad_portrait_media_query]['.product-info']['margin-left'] = '0';
			$ipad_portrait[$ipad_portrait_media_query]['.product-info']['margin-top']  = '10px';

			$ipad_portrait[$ipad_portrait_media_query]['.product .entry-summary div .price']['float'] = 'none';

			$ipad_portrait[$ipad_portrait_media_query]['.product .entry-summary .woocommerce-product-rating']['float']       = 'none';
			$ipad_portrait[$ipad_portrait_media_query]['.product .entry-summary .woocommerce-product-rating']['margin-left'] = '0';

			$elements = array(
				'.woocommerce-tabs .tabs',
				'.woocommerce-side-nav'
			);
			$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['margin-bottom'] = '25px';

			$ipad_portrait[$ipad_portrait_media_query]['.woocommerce-tabs .panel']['width']   = '91% !important';
			$ipad_portrait[$ipad_portrait_media_query]['.woocommerce-tabs .panel']['padding'] = '4% !important';

			$ipad_portrait[$ipad_portrait_media_query]['#reviews li .avatar']['display'] = 'none';

			$ipad_portrait[$ipad_portrait_media_query]['#reviews li .comment-text']['width']       = '90% !important';
			$ipad_portrait[$ipad_portrait_media_query]['#reviews li .comment-text']['margin-left'] = '0 !important';
			$ipad_portrait[$ipad_portrait_media_query]['#reviews li .comment-text']['padding']     = '5% !important';

			$ipad_portrait[$ipad_portrait_media_query]['.woocommerce-container .social-share']['overflow'] = 'hidden';

			$ipad_portrait[$ipad_portrait_media_query]['.woocommerce-container .social-share li']['display']       = 'block';
			$ipad_portrait[$ipad_portrait_media_query]['.woocommerce-container .social-share li']['float']         = 'left';
			$ipad_portrait[$ipad_portrait_media_query]['.woocommerce-container .social-share li']['margin']        = '0 auto';
			$ipad_portrait[$ipad_portrait_media_query]['.woocommerce-container .social-share li']['border-right']  = '0 !important';
			$ipad_portrait[$ipad_portrait_media_query]['.woocommerce-container .social-share li']['border-left']   = '0 !important';
			$ipad_portrait[$ipad_portrait_media_query]['.woocommerce-container .social-share li']['padding-left']  = '0 !important';
			$ipad_portrait[$ipad_portrait_media_query]['.woocommerce-container .social-share li']['padding-right'] = '0 !important';
			$ipad_portrait[$ipad_portrait_media_query]['.woocommerce-container .social-share li']['width']         = '25%';

			$ipad_portrait[$ipad_portrait_media_query]['.has-sidebar .woocommerce-container .social-share li']['width'] = '50%';

			$ipad_portrait[$ipad_portrait_media_query]['.myaccount_user_container span']['width']        = '100%';
			$ipad_portrait[$ipad_portrait_media_query]['.myaccount_user_container span']['float']        = 'none';
			$ipad_portrait[$ipad_portrait_media_query]['.myaccount_user_container span']['display']      = 'block';
			$ipad_portrait[$ipad_portrait_media_query]['.myaccount_user_container span']['padding']      = '10px 0px';
			$ipad_portrait[$ipad_portrait_media_query]['.myaccount_user_container span']['border-right'] = '0';

			if ( is_rtl() ) {
				$ipad_portrait[$ipad_portrait_media_query]['.rtl .myaccount_user_container span']['border-left'] = '0';
			}

			$elements = array(
				'.shop_table .product-thumbnail img',
				'.shop_table .product-thumbnail .product-info',
				'.shop_table .product-thumbnail .product-info p'
			);
			$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['float']   = 'none';
			$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['width']   = '100%';
			$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['margin']  = '0 !important';
			$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['padding'] = '0';

			$ipad_portrait[$ipad_portrait_media_query]['.shop_table .product-thumbnail']['padding'] = '10px 0px';

			$ipad_portrait[$ipad_portrait_media_query]['.product .images']['margin-bottom'] = '30px';

			$ipad_portrait[$ipad_portrait_media_query]['#customer_login_box .button']['float']         = 'left';
			$ipad_portrait[$ipad_portrait_media_query]['#customer_login_box .button']['margin-bottom'] = '15px';

			$ipad_portrait[$ipad_portrait_media_query]['#customer_login_box .remember-box']['clear']   = 'both';
			$ipad_portrait[$ipad_portrait_media_query]['#customer_login_box .remember-box']['display'] = 'block';
			$ipad_portrait[$ipad_portrait_media_query]['#customer_login_box .remember-box']['padding'] = '0';
			$ipad_portrait[$ipad_portrait_media_query]['#customer_login_box .remember-box']['width']   = '125px';
			$ipad_portrait[$ipad_portrait_media_query]['#customer_login_box .remember-box']['float']   = 'left';

			$ipad_portrait[$ipad_portrait_media_query]['#customer_login_box .lost_password']['float'] = 'left';

			$elements = array(
				'#wrapper .product .images',
				'#wrapper .product .summary.entry-summary'
			);
			$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['width'] = '50% !important';
			$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['float'] = 'left !important';

			$ipad_portrait[$ipad_portrait_media_query]['#wrapper .product .summary.entry-summary']['width']       = '48% !important';
			$ipad_portrait[$ipad_portrait_media_query]['#wrapper .product .summary.entry-summary']['margin-left'] = '2% !important';

			$ipad_portrait[$ipad_portrait_media_query]['#wrapper .woocommerce-tabs .tabs']['width'] = '24% !important';
			$ipad_portrait[$ipad_portrait_media_query]['#wrapper .woocommerce-tabs .tabs']['float'] = 'left !important';

			$ipad_portrait[$ipad_portrait_media_query]['#wrapper .woocommerce-tabs .panel']['float']   = 'right !important';
			$ipad_portrait[$ipad_portrait_media_query]['#wrapper .woocommerce-tabs .panel']['width']   = '70% !important';
			$ipad_portrait[$ipad_portrait_media_query]['#wrapper .woocommerce-tabs .panel']['padding'] = '4% !important';

			$elements = array(
				'.product .images #slider .flex-direction-nav',
				'.product .images #carousel .flex-direction-nav'
			);
			$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['display'] = 'none !important';

			$elements = array(
				'.myaccount_user_container span.msg',
				'.myaccount_user_container span:last-child'
			);
			$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['padding-left']  = '0 !important';
			$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['padding-right'] = '0 !important';

		}

		$ipad_portrait[$ipad_portrait_media_query]['body #small-nav']['visibility'] = 'visible !important';

		$elements = array();
		if ( class_exists( 'GFForms' ) ) {
			$elements[] = '.gform_wrapper .ginput_complex .ginput_left';
			$elements[] = '.gform_wrapper .ginput_complex .ginput_right';
			$elements[] = '.gform_wrapper .gfield input[type="text"]';
			$elements[] = '.gform_wrapper .gfield textarea';
		}
		if ( defined( 'WPCF7_PLUGIN' ) ) {
			$elements[] = '.wpcf7-form .wpcf7-text';
			$elements[] = '.wpcf7-form .wpcf7-quiz';
			$elements[] = '.wpcf7-form .wpcf7-number';
			$elements[] = '.wpcf7-form textarea';
		}

		$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['float']      = 'none !important';
		$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['width']      = '100% !important';
		$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['box-sizing'] = 'border-box';

		$ipad_portrait[$ipad_portrait_media_query]['#nav-uber #megaMenu']['width'] = '100%';

		$ipad_portrait[$ipad_portrait_media_query]['.fullwidth-box']['background-attachment'] = 'scroll';

		$ipad_portrait[$ipad_portrait_media_query]['#toTop']['bottom']        = '30px';
		$ipad_portrait[$ipad_portrait_media_query]['#toTop']['border-radius'] = '4px';
		$ipad_portrait[$ipad_portrait_media_query]['#toTop']['height']        = '40px';
		$ipad_portrait[$ipad_portrait_media_query]['#toTop']['z-index']       = '10000';

		$ipad_portrait[$ipad_portrait_media_query]['#toTop:before']['line-height'] = '38px';

		$ipad_portrait[$ipad_portrait_media_query]['#toTop:hover']['background-color'] = '#333333';

		$ipad_portrait[$ipad_portrait_media_query]['.no-mobile-totop .to-top-container']['display'] = 'none';

		$ipad_portrait[$ipad_portrait_media_query]['.no-mobile-slidingbar #slidingbar-area']['display'] = 'none';

		$ipad_portrait[$ipad_portrait_media_query]['.tfs-slider .slide-content-container .btn']['min-height']    = '0 !important';
		$ipad_portrait[$ipad_portrait_media_query]['.tfs-slider .slide-content-container .btn']['padding-left']  = '20px';
		$ipad_portrait[$ipad_portrait_media_query]['.tfs-slider .slide-content-container .btn']['padding-right'] = '20px !important';
		$ipad_portrait[$ipad_portrait_media_query]['.tfs-slider .slide-content-container .btn']['height']        = '26px !important';
		$ipad_portrait[$ipad_portrait_media_query]['.tfs-slider .slide-content-container .btn']['line-height']   = '26px !important';

		$ipad_portrait[$ipad_portrait_media_query]['.oxo-soundcloud iframe']['width'] = '100%';

		$elements = array(
			'.oxo-columns-2 .oxo-column',
			'.oxo-columns-2 .oxo-flip-box-wrapper',
			'.oxo-columns-4 .oxo-column',
			'.oxo-columns-4 .oxo-flip-box-wrapper'
		);
		$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['width'] = '50% !important';
		$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['float'] = 'left !important';

		$elements = array(
			'.oxo-columns-2 .oxo-column:nth-of-type(3n)',
			'.oxo-columns-4 .oxo-column:nth-of-type(3n)',
			'.oxo-columns-2 .oxo-flip-box-wrapper:nth-of-type(3n)'
		);
		$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['clear'] = 'both';

		$elements = array(
			'.oxo-columns-3 .oxo-column',
			'.oxo-columns-3 .oxo-flip-box-wrapper',
			'.oxo-columns-5 .oxo-column',
			'.oxo-columns-5 .oxo-flip-box-wrapper',
			'.oxo-columns-6 .oxo-column',
			'.oxo-columns-6 .oxo-flip-box-wrapper',
			'.oxo-columns-5 .col-lg-2',
			'.oxo-columns-5 .col-md-2',
			'.oxo-columns-5 .col-sm-2'
		);
		$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['width'] = '33.33% !important';
		$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['float'] = 'left !important';

		$elements = array(
			'.oxo-columns-3 .oxo-column:nth-of-type(4n)',
			'.oxo-columns-3 .oxo-flip-box-wrapper:nth-of-type(4n)',
			'.oxo-columns-5 .oxo-column:nth-of-type(4n)',
			'.oxo-columns-5 .oxo-flip-box-wrapper:nth-of-type(4n)',
			'.oxo-columns-6 .oxo-column:nth-of-type(4n)',
			'.oxo-columns-6 .oxo-flip-box-wrapper:nth-of-type(4n)'
		);
		$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['clear'] = 'both';

		$elements = array(
			'.footer-area .oxo-column',
			'#slidingbar .oxo-column'
		);
		$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['margin-bottom'] = '40px';

		$elements = array(
			'.oxo-layout-column.oxo-one-sixth',
			'.oxo-layout-column.oxo-five-sixth',
			'.oxo-layout-column.oxo-one-fifth',
			'.oxo-layout-column.oxo-two-fifth',
			'.oxo-layout-column.oxo-three-fifth',
			'.oxo-layout-column.oxo-four-fifth',
			'.oxo-layout-column.oxo-one-fourth',
			'.oxo-layout-column.oxo-three-fourth',
			'.oxo-layout-column.oxo-one-third',
			'.oxo-layout-column.oxo-two-third',
			'.oxo-layout-column.oxo-one-half'
		);

		if( is_rtl() ) {
			$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['position']      = 'relative';
			$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['float']         = 'right';
			$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['margin-left']   = '4%';
			$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['margin-right']  = '0%';
			$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['margin-bottom'] = '20px';
		} else {
			$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['position']      = 'relative';
			$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['float']         = 'left';
			$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['margin-right']  = '4%';
			$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['margin-bottom'] = '20px';
		}

		$ipad_portrait[$ipad_portrait_media_query]['.oxo-layout-column.oxo-one-sixth']['width']    = '13.3333%';
		$ipad_portrait[$ipad_portrait_media_query]['.oxo-layout-column.oxo-five-sixth']['width']   = '82.6666%';
		$ipad_portrait[$ipad_portrait_media_query]['.oxo-layout-column.oxo-one-fifth']['width']    = '16.8%';
		$ipad_portrait[$ipad_portrait_media_query]['.oxo-layout-column.oxo-two-fifth']['width']    = '37.6%';
		$ipad_portrait[$ipad_portrait_media_query]['.oxo-layout-column.oxo-three-fifth']['width']  = '58.4%';
		$ipad_portrait[$ipad_portrait_media_query]['.oxo-layout-column.oxo-four-fifth']['width']   = '79.2%';
		$ipad_portrait[$ipad_portrait_media_query]['.oxo-layout-column.oxo-one-fourth']['width']   = '22%';
		$ipad_portrait[$ipad_portrait_media_query]['.oxo-layout-column.oxo-three-fourth']['width'] = '74%';
		$ipad_portrait[$ipad_portrait_media_query]['.oxo-layout-column.oxo-one-third']['width']    = '30.6666%';
		$ipad_portrait[$ipad_portrait_media_query]['.oxo-layout-column.oxo-two-third']['width']    = '65.3333%';
		$ipad_portrait[$ipad_portrait_media_query]['.oxo-layout-column.oxo-one-half']['width']     = '48%';

		// No spacing Columns

		$ipad_portrait[$ipad_portrait_media_query]['.oxo-layout-column.oxo-spacing-no']['margin-left']  = '0';
		$ipad_portrait[$ipad_portrait_media_query]['.oxo-layout-column.oxo-spacing-no']['margin-right'] = '0';

		$ipad_portrait[$ipad_portrait_media_query]['.oxo-layout-column.oxo-one-sixth.oxo-spacing-no']['width']    = '16.6666666667%';
		$ipad_portrait[$ipad_portrait_media_query]['.oxo-layout-column.oxo-five-sixth.oxo-spacing-no']['width']   = '83.333333333%';
		$ipad_portrait[$ipad_portrait_media_query]['.oxo-layout-column.oxo-one-fifth.oxo-spacing-no']['width']    = '20%';
		$ipad_portrait[$ipad_portrait_media_query]['.oxo-layout-column.oxo-two-fifth.oxo-spacing-no']['width']    = '40%';
		$ipad_portrait[$ipad_portrait_media_query]['.oxo-layout-column.oxo-three-fifth.oxo-spacing-no']['width']  = '60%';
		$ipad_portrait[$ipad_portrait_media_query]['.oxo-layout-column.oxo-four-fifth.oxo-spacing-no']['width']   = '80%';
		$ipad_portrait[$ipad_portrait_media_query]['.oxo-layout-column.oxo-one-fourth.oxo-spacing-no']['width']   = '25%';
		$ipad_portrait[$ipad_portrait_media_query]['.oxo-layout-column.oxo-three-fourth.oxo-spacing-no']['width'] = '75%';
		$ipad_portrait[$ipad_portrait_media_query]['.oxo-layout-column.oxo-one-third.oxo-spacing-no']['width']    = '33.33333333%';
		$ipad_portrait[$ipad_portrait_media_query]['.oxo-layout-column.oxo-two-third.oxo-spacing-no']['width']    = '66.66666667%';
		$ipad_portrait[$ipad_portrait_media_query]['.oxo-layout-column.oxo-one-half.oxo-spacing-no']['width']     = '50%';

		if( is_rtl() ) {
			$ipad_portrait[$ipad_portrait_media_query]['.oxo-layout-column.oxo-column-last']['clear'] = 'left';
		} else {
			$ipad_portrait[$ipad_portrait_media_query]['.oxo-layout-column.oxo-column-last']['clear'] = 'right';
		}
		$ipad_portrait[$ipad_portrait_media_query]['.oxo-layout-column.oxo-column-last']['zoom']         = '1';
		$ipad_portrait[$ipad_portrait_media_query]['.oxo-layout-column.oxo-column-last']['margin-left']  = '0';
		$ipad_portrait[$ipad_portrait_media_query]['.oxo-layout-column.oxo-column-last']['margin-right'] = '0';

		$ipad_portrait[$ipad_portrait_media_query]['.oxo-column.oxo-spacing-no']['margin-bottom'] = '0';
		$ipad_portrait[$ipad_portrait_media_query]['.oxo-column.oxo-spacing-no']['width']         = '100% !important';

		$elements = array(
			'.ua-mobile .page-title-bar',
			'.ua-mobile .oxo-footer-widget-area',
			'.ua-mobile body',
			'.ua-mobile #main'
		);
		$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['background-attachment'] = 'scroll !important';

		$elements = array(
			'.oxo-secondary-header .oxo-row',
			'.oxo-header .oxo-row',
			'.footer-area > .oxo-row',
			'#footer > .oxo-row',
			'#header-sticky .oxo-row'
		);
		$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['padding-left']  = '0px !important';
		$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['padding-right'] = '0px !important';

		$ipad_portrait[$ipad_portrait_media_query]['.error-message']['font-size'] = '130px';

		$elements = array(
			'.oxo-secondary-header .oxo-row',
			'.oxo-header .oxo-row',
			'.footer-area > .oxo-row',
			'#footer > .oxo-row'
		);
		$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['padding-left']  = '0px !important';
		$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['padding-right'] = '0px !important';

		$ipad_portrait[$ipad_portrait_media_query]['#wrapper .ei-slider']['width'] = '100%';
		$elements = array(
			'.fullwidth-box',
			'.page-title-bar',
			'.oxo-footer-widget-area',
			'body',
			'#main'
		);

		$ipad_portrait[$ipad_portrait_media_query][aione_implode( $elements )]['background-attachment'] = 'scroll !important';

		if ( get_post_meta( $c_pageID, 'pyre_fallback', true ) ) {
			$ipad_portrait[$ipad_portrait_media_query]['#sliders-container']['display'] = 'none';
			$ipad_portrait[$ipad_portrait_media_query]['#fallback-slide']['display'] = 'block';

		}

		// Filter for editing the iPad Portrait Media Query Styles
		$ipad_portrait = apply_filters( 'aione_ipad_portrait_styles', $ipad_portrait );
		$css = array_merge( $css, $ipad_portrait );

		// End iPad Portrait Media Query Styles

	}

	if ( ! Aione()->theme_options[ 'responsive' ] ) {

		$css['global']['.ua-mobile #wrapper']['width']    		= '100% !important';
		$css['global']['.ua-mobile #wrapper']['overflow'] 		= 'hidden !important';
		$css['global']['.ua-mobile #slidingbar-area']['width'] 	= $site_width_with_units;
		$css['global']['.ua-mobile #slidingbar-area']['left'] 	= '0';

	}

	// WPML Flag positioning on the main menu when header is on the Left/Right.
	if ( class_exists( 'SitePress' ) && 'top' != Aione()->theme_options[ 'header_position' ] ) {
		$css['global']['.oxo-main-menu > ul > li > a .iclflag']['margin-top'] = '14px !important';
	}

	/**
	 * IE11
	 */
	if ( strpos( false !== $_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0' ) ) {

		$elements = array(
			'.aione-select-parent .select-arrow',
			'.select-arrow',
		);
		if ( defined( 'WPCF7_PLUGIN' ) ) {
			$elements[] = '.wpcf7-select-parent .select-arrow';
		}

		$css['global'][aione_implode( $elements )]['height']      = '33px';
		$css['global'][aione_implode( $elements )]['line-height'] = '33px';

		$css['global']['.gravity-select-parent .select-arrow']['height']      = '24px';
		$css['global']['.gravity-select-parent .select-arrow']['line-height'] = '24px';

		if ( class_exists( 'GFForms' ) ) {
			$elements = array(
				'#wrapper .gf_browser_ie.gform_wrapper .button',
				'#wrapper .gf_browser_ie.gform_wrapper .gform_footer input.button'
			);
			$css['global'][aione_implode( $elements )]['padding'] = '0 20px';
		}

	}

	/**
	 * IE11 hack
	 */
	$media_query = '@media screen and (-ms-high-contrast: active), (-ms-high-contrast: none)';
	$elements = array(
		'.aione-select-parent .select-arrow',
		'.select-arrow',
	);
	if ( defined( 'WPCF7_PLUGIN' ) ) {
		'.wpcf7-select-parent .select-arrow';
	}

	$css['global'][aione_implode( $elements )]['height']      = '33px';
	$css['global'][aione_implode( $elements )]['line-height'] = '33px';

	$css[$media_query]['.gravity-select-parent .select-arrow']['height']      = '24px';
	$css[$media_query]['.gravity-select-parent .select-arrow']['line-height'] = '24px';

	if ( class_exists( 'GFForms' ) ) {
		$elements = array(
			'#wrapper .gf_browser_ie.gform_wrapper .button',
			'#wrapper .gf_browser_ie.gform_wrapper .gform_footer input.button',
		);
		$css[$media_query][aione_implode( $elements )]['padding'] = '0 20px';
	}

	$css[$media_query]['.oxo-imageframe, .imageframe-align-center']['font-size']   = '0px';
	$css[$media_query]['.oxo-imageframe, .imageframe-align-center']['line-height'] = 'normal';


	$hundredp_padding     = Aione()->theme_options[ 'hundredp_padding' ];
	$hundredp_padding_int = (int) $hundredp_padding;

	if ( get_post_meta( $c_pageID, 'pyre_hundredp_padding', true ) ) {
		$hundredp_padding     = get_post_meta( $c_pageID, 'pyre_hundredp_padding', true );
		$hundredp_padding_int = (int) $hundredp_padding;
	}
	
	$negative_margin = '-' . $hundredp_padding_int . 'px';
	
	if ( false !== strpos( $hundredp_padding, '%' ) ) {
		$fullwidth_max_width = 100 - 2 * $hundredp_padding_int;
		$negative_margin = '-' . $hundredp_padding_int / $fullwidth_max_width * 100 . '%';
	}

	if ( $site_width_percent) {

		$elements = array(
			'.oxo-secondary-header',
			'.header-v4 #small-nav',
			'.header-v5 #small-nav',
			'#main'
		);
		$css['global'][aione_implode( $elements )]['padding-left']  = '0px';
		$css['global'][aione_implode( $elements )]['padding-right'] = '0px';

		$elements = array(
			'#slidingbar .oxo-row',
			'#sliders-container .tfs-slider .slide-content-container',
			'#main .oxo-row',
			'.oxo-page-title-bar',
			'.oxo-header',
			'.oxo-footer-widget-area',
			'.oxo-footer-copyright-area',
			'.oxo-secondary-header .oxo-row'
		);
		$css['global'][aione_implode( $elements )]['padding-left']  = Aione_Sanitize::size( $hundredp_padding );
		$css['global'][aione_implode( $elements )]['padding-right'] = Aione_Sanitize::size( $hundredp_padding );

		$elements = array(
			'.fullwidth-box',
			'.fullwidth-box .oxo-row .oxo-full-width-sep'
		);
		$css['global'][aione_implode( $elements )]['margin-left']  = $negative_margin;
		$css['global'][aione_implode( $elements )]['margin-right'] = $negative_margin;

		$css['global']['#main.width-100 > .oxo-row']['padding-left']  = '0';
		$css['global']['#main.width-100 > .oxo-row']['padding-right'] = '0';

	}

	if ( 'Boxed' == Aione()->theme_options['layout'] ) {

		$elements = array( 'html', 'body' );

		$background_color = ( get_post_meta( $c_pageID, 'pyre_page_bg_color', true ) ) ? get_post_meta( $c_pageID, 'pyre_page_bg_color', true ) : Aione()->theme_options[ 'bg_color' ];
		$css['global'][aione_implode( $elements )]['background-color'] = Aione_Sanitize::color( $background_color );

		if ( get_post_meta( $c_pageID, 'pyre_page_bg', true ) ) {

			$css['global']['body']['background-image']  = 'url("' . Aione_Sanitize::css_asset_url( get_post_meta( $c_pageID, 'pyre_page_bg', true ) ) . '")';
			$css['global']['body']['background-repeat'] = get_post_meta( $c_pageID, 'pyre_page_bg_repeat', true );

			if ( 'yes' == get_post_meta( $c_pageID, 'pyre_page_bg_full', true ) ) {

				$css['global']['body']['background-attachment'] = 'fixed';
				$css['global']['body']['background-position']   = 'center center';
				$css['global']['body']['background-size']       = 'cover';

			}

		} elseif ( Aione()->theme_options[ 'bg_image' ] ) {

			$css['global']['body']['background-image']  = 'url("' . Aione_Sanitize::css_asset_url( Aione()->theme_options[ 'bg_image' ] ) . '")';
			$css['global']['body']['background-repeat'] = esc_attr( Aione()->theme_options[ 'bg_repeat' ] );

			if ( Aione()->theme_options[ 'bg_full' ] ) {

				$css['global']['body']['background-attachment'] = 'fixed';
				$css['global']['body']['background-position']   = 'center center';
				$css['global']['body']['background-size']       = 'cover';

			}

		}

		if ( Aione()->theme_options[ 'bg_pattern_option' ] && Aione()->theme_options[ 'bg_pattern' ] && ! ( get_post_meta( $c_pageID, 'pyre_page_bg_color', true ) || get_post_meta( $c_pageID, 'pyre_page_bg', true ) ) ) {

			$elements = array( 'html', 'body' );
			$css['global'][aione_implode( $elements )]['background-image']  = 'url("' . Aione_Sanitize::css_asset_url( get_template_directory_uri() . '/assets/images/patterns/' . Aione()->theme_options[ 'bg_pattern' ] . '.png' ) . '")';
			$css['global'][aione_implode( $elements )]['background-repeat'] = 'repeat';

		}

		$elements = array(
			'#wrapper',
			'.oxo-footer-parallax'
		);
		$css['global'][aione_implode( $elements )]['max-width'] = ( $site_width_percent ) ? $site_width_with_units : ( $site_width + 60 ) .  'px';
		$css['global'][aione_implode( $elements )]['margin']    = '0 auto';

		$css['global']['.wrapper_blank']['display'] = 'block';

		$media_query = '@media (min-width: 1014px)';
		$css[$media_query]['body #header-sticky.sticky-header']['width']  = ( $site_width_percent ) ? $site_width_with_units : ( $site_width + 60 ) .  'px';
		$css[$media_query]['body #header-sticky.sticky-header']['left']   = '0';
		$css[$media_query]['body #header-sticky.sticky-header']['right']  = '0';
		$css[$media_query]['body #header-sticky.sticky-header']['margin'] = '0 auto';

		if ( Aione()->theme_options[ 'responsive' ] && $site_width_percent ) {

			$elements = array(
				'#main .oxo-row',
				'.oxo-footer-widget-area .oxo-row',
				'#slidingbar-area .oxo-row',
				'.oxo-footer-copyright-area .oxo-row',
				'.oxo-page-title-row',
				'.oxo-secondary-header .oxo-row',
				'#small-nav .oxo-row',
				'.oxo-header .oxo-row'
			);
			$css['global'][aione_implode( $elements )]['max-width'] = 'none';
			$css['global'][aione_implode( $elements )]['padding']   = '0 10px';

		}

		if ( Aione()->theme_options[ 'responsive' ] ) {

			$media_query = '@media only screen and (min-width: 801px) and (max-width: 1014px)';
			$css[$media_query]['#wrapper']['width'] = 'auto';

			$media_query = '@media only screen and (min-device-width: 801px) and (max-device-width: 1014px)';
			$css[$media_query]['#wrapper']['width'] = 'auto';

		}

	}

	if ( 'Wide' == Aione()->theme_options['layout'] ) {

		$css['global']['#wrapper']['width']     = '100%';
		$css['global']['#wrapper']['max-width'] = 'none';

		$media_query = '@media only screen and (min-width: 801px) and (max-width: 1014px)';
		$css[$media_query]['#wrapper']['width'] = 'auto';

		$media_query = '@media only screen and (min-device-width: 801px) and (max-device-width: 1014px)';
		$css[$media_query]['#wrapper']['width'] = 'auto';

	}

	if ( 'boxed' == get_post_meta( $c_pageID, 'pyre_page_bg_layout', true ) ) {

		$elements = array( 'html', 'body' );

		$background_color = ( get_post_meta( $c_pageID, 'pyre_page_bg_color', true ) ) ? get_post_meta( $c_pageID, 'pyre_page_bg_color', true ) : Aione()->theme_options[ 'bg_color' ];
		$css['global'][aione_implode( $elements )]['background-color'] = Aione_Sanitize::color( $background_color );

		if ( get_post_meta( $c_pageID, 'pyre_page_bg', true ) ) {

			$css['global']['body']['background-image']  = 'url("' . Aione_Sanitize::css_asset_url( get_post_meta( $c_pageID, 'pyre_page_bg', true ) ) . '")';
			$css['global']['body']['background-repeat'] = get_post_meta( $c_pageID, 'pyre_page_bg_repeat', true );

			if ( 'yes' == get_post_meta( $c_pageID, 'pyre_page_bg_full', true ) ) {

				$css['global']['body']['background-attachment'] = 'fixed';
				$css['global']['body']['background-position']   = 'center center';
				$css['global']['body']['background-size']       = 'cover';

			}

		} elseif ( Aione()->theme_options[ 'bg_image' ] ) {

			$css['global']['body']['background-image']  = 'url("' . Aione_Sanitize::css_asset_url( Aione()->theme_options[ 'bg_image' ] ) . '")';
			$css['global']['body']['background-repeat'] = esc_attr( Aione()->theme_options[ 'bg_repeat' ] );

			if ( Aione()->theme_options[ 'bg_full' ] ) {

				$css['global']['body']['background-attachment'] = 'fixed';
				$css['global']['body']['background-position']   = 'center center';
				$css['global']['body']['background-size']       = 'cover';

			}

		}

		if ( Aione()->theme_options[ 'bg_pattern_option' ] && Aione()->theme_options[ 'bg_pattern' ] && ! ( get_post_meta( $c_pageID, 'pyre_page_bg_color', true ) || get_post_meta( $c_pageID, 'pyre_page_bg', true ) ) ) {

			$css['global']['body']['background-image']  = 'url("' . Aione_Sanitize::css_asset_url( get_template_directory_uri() . '/assets/images/patterns/' . Aione()->theme_options[ 'bg_pattern' ] . '.png' ) . '")';
			$css['global']['body']['background-repeat'] = 'repeat';

		}

		$elements = array( '#wrapper', '.oxo-footer-parallax' );
		$css['global'][aione_implode( $elements )]['width']     = ( $site_width_percent ) ? $site_width_with_units : ( $site_width + 60 ) .  'px';
		$css['global'][aione_implode( $elements )]['margin']    = '0 auto';
		$css['global'][aione_implode( $elements )]['max-width'] = '100%';

		$css['global']['.wrapper_blank']['display'] = 'block';

		$media_query = '@media (min-width: 1014px)';
		$css[$media_query]['body #header-sticky.sticky-header']['width']  = ( $site_width_percent ) ? $site_width_with_units : ( $site_width + 60 ) .  'px';
		$css[$media_query]['body #header-sticky.sticky-header']['left']   = '0';
		$css[$media_query]['body #header-sticky.sticky-header']['right']  = '0';
		$css[$media_query]['body #header-sticky.sticky-header']['margin'] = '0 auto';

		$media_query = '@media only screen and (min-width: 801px) and (max-width: 1014px)';
		$css[$media_query]['#wrapper']['width'] = 'auto';

		$media_query = '@media only screen and (min-device-width: 801px) and (max-device-width: 1014px)';
		$css[$media_query]['#wrapper']['width'] = 'auto';

	}

	if ( 'wide' == get_post_meta( $c_pageID, 'pyre_page_bg_layout', true ) ) {

		$css['global']['#wrapper']['width']     = '100%';
		$css['global']['#wrapper']['max-width'] = 'none';

		$media_query = '@media only screen and (min-width: 801px) and (max-width: 1014px)';
		$css[$media_query]['#wrapper']['width'] = 'auto';

		$media_query = '@media only screen and (min-device-width: 801px) and (max-device-width: 1014px)';
		$css[$media_query]['#wrapper']['width'] = 'auto';

		$css['global']['body #header-sticky.sticky-header']['width']  = '100%';
		$css['global']['body #header-sticky.sticky-header']['left']   = '0';
		$css['global']['body #header-sticky.sticky-header']['right']  = '0';
		$css['global']['body #header-sticky.sticky-header']['margin'] = '0 auto';

	}

	if ( get_post_meta( $c_pageID, 'pyre_page_bg', true ) || Aione()->theme_options[ 'bg_image' ] ) {
		$css['global']['html']['background'] = 'none';
	}
	
	$page_title_br_image = Aione()->theme_options[ 'page_title_bg' ];

	if ( get_post_meta ( $c_pageID, 'pyre_page_title_bar_bg', true ) ) {
		$css['global']['.oxo-page-title-bar']['background-image'] = 'url("' . Aione_Sanitize::css_asset_url( get_post_meta( $c_pageID, 'pyre_page_title_bar_bg', true ) ) . '")';
	} elseif( Aione()->theme_options[ 'page_title_bg' ] ) {
		$css['global']['.oxo-page-title-bar']['background-image'] = 'url("' .$page_title_br_image['url']. '")';
	}

	if ( get_post_meta( $c_pageID, 'pyre_page_title_bar_bg_color', true ) ) {
		$css['global']['.oxo-page-title-bar']['background-color'] = get_post_meta( $c_pageID, 'pyre_page_title_bar_bg_color', true );
	}

	if ( get_post_meta( $c_pageID, 'pyre_page_title_bar_borders_color', true ) ) {
		$css['global']['.oxo-page-title-bar']['border-color'] = get_post_meta( $c_pageID, 'pyre_page_title_bar_borders_color', true );
	}


	$elements = array( '#side-header', '.oxo-header' );
	if ( Aione()->theme_options[ 'header_bg_image' ] ) {

		$css['global']['#side-header']['background-image'] = 'url("' . Aione_Sanitize::css_asset_url( Aione()->theme_options[ 'header_bg_image' ] ) . '")';
		$css['global']['.oxo-header']['background-image'] = 'url("' . Aione_Sanitize::css_asset_url( Aione()->theme_options[ 'header_bg_image' ] ) . '")';

		if ( in_array( Aione()->theme_options[ 'header_bg_repeat' ], array( 'repeat-y', 'no-repeat' ) ) ) {
			$css['global'][aione_implode( $elements )]['background-position'] = 'center center';
		}
		$css['global'][aione_implode( $elements )]['background-repeat'] = esc_attr( Aione()->theme_options[ 'header_bg_repeat' ] );
		if ( Aione()->theme_options[ 'header_bg_full' ] ) {
			if ( 'top' == Aione()->theme_options[ 'header_position' ] ) {
				$css['global'][aione_implode( $elements )]['background-attachment'] = 'scroll';
			}
			$css['global'][aione_implode( $elements )]['background-position'] = 'center center';
			$css['global'][aione_implode( $elements )]['background-size']     = 'cover';
		}
		if ( Aione()->theme_options[ 'header_bg_parallax' ] && 'top' == Aione()->theme_options[ 'header_position' ] ) {
			$css['global'][aione_implode( $elements )]['background-attachment'] = 'fixed';
			$css['global'][aione_implode( $elements )]['background-position']   = 'top center';
		}

		$css['global']['.side-header-background']['background'] = 'none';
	}

	$elements = array(
		'.oxo-header',
		'#side-header',
		'.side-header-background',
		'.layout-boxed-mode .side-header-wrapper'
	);
	if ( get_post_meta( $c_pageID, 'pyre_header_bg_color', true ) ) {

		if ( '' != get_post_meta( $c_pageID, 'pyre_header_bg_opacity', true ) ) {
			$header_bg_opacity = get_post_meta( $c_pageID, 'pyre_header_bg_opacity', true );
		} elseif ( Aione()->theme_options[ 'header_bg_color' ] ) {
			$header_bg_opacity = Aione()->theme_options['header_bg_color'];
		} else {
			$header_bg_opacity = 1;
		}

		$header_bg_color_rgb = oxo_hex2rgb( get_post_meta( $c_pageID, 'pyre_header_bg_color', true ) );

		if ( get_post_meta( $c_pageID, 'pyre_header_bg_color', true ) ) {

			$css['global'][aione_implode( $elements )]['background-color'] = get_post_meta( $c_pageID, 'pyre_header_bg_color', true );

			if ( ( function_exists( 'is_shop' ) && is_shop() ) || ( ! is_archive() && ! is_404() && ! is_search() ) ) {
				$css['global'][aione_implode( $elements )]['background-color'] = 'rgba(' . $header_bg_color_rgb[0] . ',' . $header_bg_color_rgb[1] . ',' . $header_bg_color_rgb[2] . ',' . $header_bg_opacity . ')';
			}

		}

	} elseif ( Aione()->theme_options[ 'header_bg_color' ] ) {

		if ( '' != get_post_meta( $c_pageID, 'pyre_header_bg_opacity', true ) ) {
			$header_bg_opacity = get_post_meta( $c_pageID, 'pyre_header_bg_opacity', true );
		} elseif ( Aione()->theme_options[ 'header_bg_color' ] ) {
			$header_bg_opacity = Aione()->theme_options['header_bg_color'];
		} else {
			$header_bg_opacity = 1;
		}

		$header_bg_color_rgb = oxo_hex2rgb( Aione()->theme_options[ 'header_bg_color'] );

		if ( Aione()->theme_options[ 'header_bg_color'] ) {

			$css['global'][aione_implode( $elements )]['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'header_bg_color'], Aione()->settings->get_default( 'header_bg_color', 'color' ) );

			if ( ( function_exists( 'is_shop' ) && is_shop() ) || ( ! is_archive() && ! is_404() && ! is_search() ) ) {
				$css['global'][aione_implode( $elements )]['background-color'] = Aione_Sanitize::color( 'rgba(' . $header_bg_color_rgb[0] . ',' . $header_bg_color_rgb[1] . ',' . $header_bg_color_rgb[2] . ',' . $header_bg_opacity . ')' );
			}

		}

	}

	if ( Aione()->theme_options[ 'menu_h45_bg_color' ] ) {

		if ( '' != get_post_meta( $c_pageID, 'pyre_header_bg_opacity', true ) ) {
			$header_bg_opacity = get_post_meta( $c_pageID, 'pyre_header_bg_opacity', true );
		} elseif ( Aione()->theme_options[ 'menu_h45_bg_color' ] ) {
			$header_bg_opacity = Aione()->theme_options['header_bg_color'];
		} else {
			$header_bg_opacity = 1;
		}

		$header_bg_color_rgb = oxo_hex2rgb( Aione()->theme_options[ 'menu_h45_bg_color' ] );

		if ( Aione()->theme_options[ 'menu_h45_bg_color' ] ) {

			$css['global']['.oxo-secondary-main-menu']['background-color'] = Aione_Sanitize::color( Aione()->theme_options[ 'menu_h45_bg_color' ], Aione()->settings->get_default( 'menu_h45_bg_color' ) );

			if ( ! is_archive() || ( function_exists( 'is_shop' ) && is_shop() ) ) {
				$css['global']['.oxo-secondary-main-menu']['background-color'] = Aione_Sanitize::color( 'rgba(' . $header_bg_color_rgb[0] . ',' . $header_bg_color_rgb[1] . ',' . $header_bg_color_rgb[2] . ',' . $header_bg_opacity . ')' );
			}

		}

	}

	$elements = array( '.oxo-header', '#side-header' );

	if ( get_post_meta( $c_pageID, 'pyre_header_bg', true ) ) {

		$css['global'][aione_implode( $elements )]['background-image'] = 'url("' . Aione_Sanitize::css_asset_url( get_post_meta( $c_pageID, 'pyre_header_bg', true ) ) . '")';

		if ( in_array( get_post_meta( $c_pageID, 'pyre_header_bg_repeat', true ), array( 'repeat-y', 'no-repeat' ) ) ) {
			$css['global'][aione_implode( $elements )]['background-position'] = 'center center';
		}

		$css['global'][aione_implode( $elements )]['background-repeat'] = get_post_meta( $c_pageID, 'pyre_header_bg_repeat', true );

		if ( 'yes' == get_post_meta( $c_pageID, 'pyre_header_bg_full', true ) ) {

			if ( 'top' == Aione()->theme_options[ 'header_position' ] ) {
				$css['global'][aione_implode( $elements )]['background-attachment'] = 'fixed';
			}
			$css['global'][aione_implode( $elements )]['background-position'] = 'center center';
			$css['global'][aione_implode( $elements )]['background-size'] = 'cover';

		}

		if ( Aione()->theme_options[ 'header_bg_parallax' ] && 'top' == Aione()->theme_options[ 'header_position' ] ) {
			$css['global'][aione_implode( $elements )]['background-attachment'] = 'fixed';
			$css['global'][aione_implode( $elements )]['background-position']   = 'top center';
		}

		$css['global']['.side-header-background']['background'] = 'none';

	}

	if ( ( ( 1 > Aione()->theme_options['header_bg_color'] && ! get_post_meta( $c_pageID, 'pyre_header_bg_opacity', true ) ) || ( '' != get_post_meta( $c_pageID, 'pyre_header_bg_opacity', true ) && 1 > get_post_meta( $c_pageID, 'pyre_header_bg_opacity', true ) ) ) && ! is_search() && ! is_404() && ! is_author() && ( ! is_archive() || ( class_exists( 'WooCommerce') && is_shop() ) ) ) {

		$media_query = '@media only screen and (min-width: ' . intval( Aione()->theme_options[ 'side_header_break_point' ] ) . 'px)';
		$elements = array(
			'.oxo-header',
			'.oxo-secondary-header'
		);
		$css[$media_query][aione_implode( $elements )]['border-top'] = 'none';

		$elements = array(
			'.oxo-header-v1 .oxo-header',
			'.oxo-secondary-main-menu'
		);
		$css[$media_query][aione_implode( $elements )]['border'] = 'none';

		if ( 'boxed' == oxo_get_option( 'layout', 'page_bg_layout', $c_pageID ) ) {
			//$css[$media_query]['.oxo-header-wrapper']['position'] = 'absolute';
			//$css[$media_query]['.oxo-header-wrapper']['z-index']  = '10000';

			if ( $site_width_percent ) {
				$css[$media_query]['.oxo-header-wrapper']['width']    = $site_width_with_units;
			} else {
				$css[$media_query]['.oxo-header-wrapper']['width']		 = '100%';
				//$css[$media_query]['.oxo-header-wrapper']['max-width']    = ( $site_width + 60 ) . 'px';
			}

		} else {
			//$css[$media_query]['.oxo-header-wrapper']['position'] = 'absolute';
			$css[$media_query]['.oxo-header-wrapper']['left']     = '0';
			$css[$media_query]['.oxo-header-wrapper']['right']    = '0';
			$css[$media_query]['.oxo-header-wrapper']['z-index']  = '10000';

		}

	}

	/**
	 * If the header opacity is < 1, then do not display the header background image.
	 */
	if ( '' != get_post_meta( $c_pageID, 'pyre_header_bg_opacity', true ) ) {
		$header_bg_opacity = get_post_meta( $c_pageID, 'pyre_header_bg_opacity', true );
	} elseif ( Aione()->theme_options[ 'header_bg_color' ] ) {
		$header_bg_opacity = Aione()->theme_options['header_bg_color'];
	} else {
		$header_bg_opacity = 1;
	}

	if ( 1 > $header_bg_opacity ) {
		$elements = array(
			'.oxo-header',
			'#side-header',
		);
		$css['global'][aione_implode( $elements )]['background-image'] = '';
	}

	if ( 'no' == get_post_meta( $c_pageID, 'pyre_aione_rev_styles', true ) || ( ! Aione()->theme_options[ 'aione_rev_styles' ] && 'yes' != get_post_meta( $c_pageID, 'pyre_aione_rev_styles', true ) ) ) {

		$css['global']['.rev_slider_wrapper']['position'] = 'relative';

		if ( class_exists( 'RevSliderFront' ) ) {

			if ( ( '1' == Aione()->theme_options['header_bg_color'] && ! get_post_meta( $c_pageID, 'pyre_header_bg_opacity', true ) ) || ( get_post_meta( $c_pageID, 'pyre_header_bg_opacity', true ) && 1 == get_post_meta( $c_pageID, 'pyre_header_bg_opacity', true ) ) ) {

				$css['global']['.rev_slider_wrapper .shadow-left']['position']            = 'absolute';
				$css['global']['.rev_slider_wrapper .shadow-left']['pointer-events']      = 'none';
				$css['global']['.rev_slider_wrapper .shadow-left']['background-image']    = 'url("' . Aione_Sanitize::css_asset_url( get_template_directory_uri() . '/assets/images/shadow-top.png' ) . '")';
				$css['global']['.rev_slider_wrapper .shadow-left']['background-repeat']   = 'no-repeat';
				$css['global']['.rev_slider_wrapper .shadow-left']['background-position'] = 'top center';
				$css['global']['.rev_slider_wrapper .shadow-left']['height']              = '42px';
				$css['global']['.rev_slider_wrapper .shadow-left']['width']               = '100%';
				$css['global']['.rev_slider_wrapper .shadow-left']['top']                 = '0';
				$css['global']['.rev_slider_wrapper .shadow-left']['z-index']             = '99';

				$css['global']['.rev_slider_wrapper .shadow-left']['top'] = '-1px';

			}

			$css['global']['.rev_slider_wrapper .shadow-right']['position']            = 'absolute';
			$css['global']['.rev_slider_wrapper .shadow-right']['pointer-events']      = 'none';
			$css['global']['.rev_slider_wrapper .shadow-right']['background-image']    = 'url("' . Aione_Sanitize::css_asset_url( get_template_directory_uri() . '/assets/images/shadow-bottom.png' ) . '")';
			$css['global']['.rev_slider_wrapper .shadow-right']['background-repeat']   = 'no-repeat';
			$css['global']['.rev_slider_wrapper .shadow-right']['background-position'] = 'bottom center';
			$css['global']['.rev_slider_wrapper .shadow-right']['height']              = '32px';
			$css['global']['.rev_slider_wrapper .shadow-right']['width']               = '100%';
			$css['global']['.rev_slider_wrapper .shadow-right']['bottom']              = '0';
			$css['global']['.rev_slider_wrapper .shadow-right']['z-index']             = '99';

		}

		$css['global']['.aione-skin-rev']['border-top']    = '1px solid #d2d3d4';
		$css['global']['.aione-skin-rev']['border-bottom'] = '1px solid #d2d3d4';
		$css['global']['.aione-skin-rev']['box-sizing']    = 'content-box';

		$css['global']['.tparrows']['border-radius'] = '0';

		if ( class_exists( 'RevSliderFront' ) ) {

			$elements = array(
				'.rev_slider_wrapper .rev_slider .tp-leftarrow.tparrows',
				'.rev_slider_wrapper .rev_slider .tp-rightarrow.tparrows'
			);
			$css['global'][aione_implode( $elements )]['opacity']          = '0.8 !important';
			$css['global'][aione_implode( $elements )]['position']         = 'absolute';
			$css['global'][aione_implode( $elements )]['top']              = '50% !important';
			$css['global'][aione_implode( $elements )]['margin-top']       = '-31px !important';
			$css['global'][aione_implode( $elements )]['width']            = '63px !important';
			$css['global'][aione_implode( $elements )]['height']           = '63px !important';
			$css['global'][aione_implode( $elements )]['background']       = 'none';
			$css['global'][aione_implode( $elements )]['background-color'] = 'rgba(0, 0, 0, 0.5)';
			$css['global'][aione_implode( $elements )]['color']            = '#fff';
			$css['global'][aione_implode( $elements )]['border-radius']    = '0';


			$css['global']['.rev_slider_wrapper .rev_slider .tp-leftarrow.tparrows:before']['content']                = '"\e61e"';
			$css['global']['.rev_slider_wrapper .rev_slider .tp-leftarrow.tparrows:before']['-webkit-font-smoothing'] = 'antialiased';

			$css['global']['.rev_slider_wrapper .rev_slider .tp-rightarrow.tparrows:before']['content']                = '"\e620"';
			$css['global']['.rev_slider_wrapper .rev_slider .tp-rightarrow.tparrows:before']['-webkit-font-smoothing'] = 'antialiased';

			$elements = array(
				'.rev_slider_wrapper .rev_slider .tp-leftarrow.tparrows:before',
				'.rev_slider_wrapper .rev_slider .tp-rightarrow.tparrows:before'
			);
			$css['global'][aione_implode( $elements )]['position']    = 'absolute';
			$css['global'][aione_implode( $elements )]['padding']     = '0';
			$css['global'][aione_implode( $elements )]['width']       = '100%';
			$css['global'][aione_implode( $elements )]['line-height'] = '63px';
			$css['global'][aione_implode( $elements )]['text-align']  = 'center';
			$css['global'][aione_implode( $elements )]['font-size']   = '25px';
			$css['global'][aione_implode( $elements )]['font-family'] = "'icomoon'";

			$css['global']['.rev_slider_wrapper .rev_slider .tp-leftarrow.tparrows:before']['margin-left']  = '-2px';

			$css['global']['.rev_slider_wrapper .rev_slider .tp-rightarrow.tparrows:before']['margin-left'] = '-1px';

			$css['global']['.rev_slider_wrapper .rev_slider .tp-rightarrow.tparrows']['left']  = 'auto';
			$css['global']['.rev_slider_wrapper .rev_slider .tp-rightarrow.tparrows']['right'] = '0';

			$elements = array(
				'.no-rgba .rev_slider_wrapper .rev_slider .tp-leftarrow.tparrows',
				'.no-rgba .rev_slider_wrapper .rev_slider .tp-rightarrow.tparrows'
			);
			$css['global'][aione_implode( $elements )]['background-color'] = '#ccc';

			$elements = array(
				'.rev_slider_wrapper:hover .rev_slider .tp-leftarrow.tparrows',
				'.rev_slider_wrapper:hover .rev_slider .tp-rightarrow.tparrows'
			);
			$css['global'][aione_implode( $elements )]['display'] = 'block';
			$css['global'][aione_implode( $elements )]['opacity'] = '0.8 !important';

			$elements = array(
				'.rev_slider_wrapper .rev_slider .tp-leftarrow.tparrows:hover',
				'.rev_slider_wrapper .rev_slider .tp-rightarrow.tparrows:hover'
			);
			$css['global'][aione_implode( $elements )]['opacity'] = '1 !important';

			$css['global']['.rev_slider_wrapper .rev_slider .tp-leftarrow.tparrows']['background-position'] = '19px 19px';
			$css['global']['.rev_slider_wrapper .rev_slider .tp-leftarrow.tparrows']['left']                = '0';
			$css['global']['.rev_slider_wrapper .rev_slider .tp-leftarrow.tparrows']['margin-left']         = '0';
			$css['global']['.rev_slider_wrapper .rev_slider .tp-leftarrow.tparrows']['z-index']             = '100';

			$css['global']['.rev_slider_wrapper .rev_slider .tp-rightarrow.tparrows']['background-position'] = '29px 19px';
			$css['global']['.rev_slider_wrapper .rev_slider .tp-rightarrow.tparrows']['right']               = '0';
			$css['global']['.rev_slider_wrapper .rev_slider .tp-rightarrow.tparrows']['margin-left']         = '0';
			$css['global']['.rev_slider_wrapper .rev_slider .tp-rightarrow.tparrows']['z-index']             = '100';

			$elements = array(
				'.rev_slider_wrapper .rev_slider .tp-leftarrow.tparrows.hidearrows',
				'.rev_slider_wrapper .rev_slider .tp-rightarrow.tparrows.hidearrows'
			);
			$css['global'][aione_implode( $elements )]['opacity'] = '0';

			// Additional arrow styles
			$css['global']['.rev_slider_wrapper .rev_slider .tparrows.hades .tp-arr-allwrapper']['width']    = '63px';
			$css['global']['.rev_slider_wrapper .rev_slider .tparrows.hades .tp-arr-allwrapper']['height']    = '63px';

			$elements = array(
				'.rev_slider_wrapper .rev_slider .tp-leftarrow.tparrows.hebe:before',
				'.rev_slider_wrapper .rev_slider .tp-rightarrow.tparrows.hebe:before'
			);
			$css['global'][aione_implode( $elements )]['position']    = 'relative';
			$css['global'][aione_implode( $elements )]['width']       = 'auto';


			$elements = array(
				'.rev_slider_wrapper .rev_slider .tp-leftarrow.tparrows.zeus',
				'.rev_slider_wrapper .rev_slider .tp-rightarrow.tparrows.zeus'
			);
			$css['global'][aione_implode( $elements )]['min-width']    = '63px';
			$css['global'][aione_implode( $elements )]['min-height']    = '63px';

			$elements = array(
				'.rev_slider_wrapper .rev_slider .tp-leftarrow.tparrows.zeus .tp-title-wrap',
				'.rev_slider_wrapper .rev_slider .tp-rightarrow.tparrows.zeus .tp-title-wrap'
			);
			$css['global'][aione_implode( $elements )]['border-radius']    = '0';


			$elements = array(
				'.rev_slider_wrapper .rev_slider .tp-leftarrow.tparrows.metis',
				'.rev_slider_wrapper .rev_slider .tp-rightarrow.tparrows.metis'
			);
			$css['global'][aione_implode( $elements )]['padding']    = '0';
		}

		$css['global']['.tp-bullets .bullet.last']['clear'] = 'none';

	}

	if ( Aione()->theme_options[ 'content_bg_image' ] && ! get_post_meta( $c_pageID, 'pyre_wide_page_bg_color', true ) ) {

		$css['global']['#main']['background-image']  = 'url("' . Aione_Sanitize::css_asset_url( Aione()->theme_options[ 'content_bg_image' ] ) . '")';
		$css['global']['#main']['background-repeat'] = esc_attr( Aione()->theme_options[ 'content_bg_repeat' ] );

		if ( Aione()->theme_options[ 'content_bg_full' ] ) {

			$css['global']['#main']['background-attachment'] = 'fixed';
			$css['global']['#main']['background-position']   = 'center center';
			$css['global']['#main']['background-size']       = 'cover';

		}

	}

	if ( ( Aione()->theme_options[ 'main_top_padding' ] || Aione()->theme_options[ 'main_top_padding' ] == '0' ) && ( ( ! get_post_meta( $c_pageID, 'pyre_main_top_padding', true ) && get_post_meta( $c_pageID, 'pyre_main_top_padding', true ) !== '0' ) || ! $c_pageID ) ) {
		$css['global']['#main']['padding-top'] = Aione_Sanitize::size( Aione()->theme_options[ 'main_top_padding' ] );
	}

	if ( ( Aione()->theme_options[ 'main_bottom_padding' ] || Aione()->theme_options[ 'main_bottom_padding' ] == '0' ) && ( ( ! get_post_meta( $c_pageID, 'pyre_main_bottom_padding', true ) &&  get_post_meta( $c_pageID, 'pyre_main_bottom_padding', true ) !== '0' ) || ! $c_pageID ) ) {
		$css['global']['#main']['padding-bottom'] = Aione_Sanitize::size( Aione()->theme_options[ 'main_bottom_padding' ] );
	}

	if ( 'wide' == get_post_meta( $c_pageID, 'pyre_page_bg_layout', true ) && get_post_meta( $c_pageID, 'pyre_wide_page_bg_color', true ) ) {
		$elements = array( 'html', 'body', '#wrapper' );
		$css['global'][aione_implode( $elements )]['background-color'] = get_post_meta( $c_pageID, 'pyre_wide_page_bg_color', true );
	}

	if ( get_post_meta( $c_pageID, 'pyre_wide_page_bg_color', true ) ) {
		$elements = array(
			'#main',
			'#wrapper',
			'.oxo-separator .icon-wrapper',
		);
		if ( class_exists( 'bbPress' ) ) {
			$elements[] = '.bbp-arrow';
		}
		$css['global'][aione_implode( $elements )]['background-color'] = get_post_meta( $c_pageID, 'pyre_wide_page_bg_color', true );
	}

	if ( get_post_meta( $c_pageID, 'pyre_wide_page_bg', true ) ) {
		$elements = array(
			'.wrapper_blank #main',
			'#main'
		);
		$css['global'][aione_implode( $elements )]['background-image']  = 'url("' . Aione_Sanitize::css_asset_url( get_post_meta( $c_pageID, 'pyre_wide_page_bg', true ) ) . '")';
		$css['global'][aione_implode( $elements )]['background-repeat'] = get_post_meta( $c_pageID, 'pyre_wide_page_bg_repeat', true );

		if ( 'yes' == get_post_meta( $c_pageID, 'pyre_wide_page_bg_full', true ) ) {

			$css['global'][aione_implode( $elements )]['background-attachment'] = 'fixed';
			$css['global'][aione_implode( $elements )]['background-position']   = 'center center';
			$css['global'][aione_implode( $elements )]['background-size']       = 'cover';

		}

	}

	if ( get_post_meta( $c_pageID, 'pyre_main_top_padding', true ) || get_post_meta( $c_pageID, 'pyre_main_top_padding', true ) === '0' ) {
		$css['global']['#main']['padding-top'] = get_post_meta( $c_pageID, 'pyre_main_top_padding', true );
	}

	if ( get_post_meta( $c_pageID, 'pyre_main_bottom_padding', true ) || get_post_meta( $c_pageID, 'pyre_main_bottom_padding', true ) === '0' ) {
		$css['global']['#main']['padding-bottom'] = get_post_meta( $c_pageID, 'pyre_main_bottom_padding', true );
	}

	if ( get_post_meta( $c_pageID, 'pyre_sidebar_bg_color', true ) ) {
		$css['global']['#main .sidebar']['background-color'] = get_post_meta( $c_pageID, 'pyre_sidebar_bg_color', true );
	}

	if ( Aione()->theme_options[ 'page_title_bg_full' ] ) {
		$css['global']['.oxo-page-title-bar']['background-size'] = 'cover';
	}

	if ( 'yes' == get_post_meta( $c_pageID, 'pyre_page_title_bar_bg_full', true ) ) {
		$css['global']['.oxo-page-title-bar']['background-size'] = 'cover';
	} elseif ( 'no' == get_post_meta( $c_pageID, 'pyre_page_title_bar_bg_full', true ) ) {
		$css['global']['.oxo-page-title-bar']['background-size'] = 'auto';
	}

	if ( Aione()->theme_options[ 'page_title_bg_parallax' ] ) {
		$css['global']['.oxo-page-title-bar']['background-attachment'] = 'fixed';
		$css['global']['.oxo-page-title-bar']['background-position']   = 'top center';
	}

	if ( 'yes' == get_post_meta( $c_pageID, 'pyre_page_title_bg_parallax', true ) ) {
		$css['global']['.oxo-page-title-bar']['background-attachment'] = 'fixed';
		$css['global']['.oxo-page-title-bar']['background-position']   = 'top center';
	} elseif ( 'no' == get_post_meta( $c_pageID, 'pyre_page_title_bg_parallax', true ) ) {
		$css['global']['.oxo-page-title-bar']['background-attachment'] = 'scroll';
	}

	if ( get_post_meta( $c_pageID, 'pyre_page_title_height', true ) ) {
		$css['global']['.oxo-page-title-bar']['height'] = Aione_Sanitize::size( get_post_meta( $c_pageID, 'pyre_page_title_height', true ) );
	} elseif ( Aione()->theme_options[ 'page_title_height' ] ) {
		$css['global']['.oxo-page-title-bar']['height'] = Aione_Sanitize::size( Aione()->theme_options[ 'page_title_height' ] );
	}

	if ( is_single() && get_post_meta( $c_pageID, 'pyre_fimg_width', true ) ) {

		if ( 'auto' != get_post_meta( $c_pageID, 'pyre_fimg_width', true ) ) {
			$css['global']['#post-' . $c_pageID . ' .oxo-post-slideshow']['max-width'] = get_post_meta( $c_pageID, 'pyre_fimg_width', true );
		} else {
			$css['global']['.oxo-post-slideshow .flex-control-nav']['position']   = 'relative';
			$css['global']['.oxo-post-slideshow .flex-control-nav']['text-align'] = 'center';
			$css['global']['.oxo-post-slideshow .flex-control-nav']['margin-top'] = '10px';

			$css['global']['#post-' . $c_pageID . ' .oxo-post-slideshow img']['width'] = Aione_Sanitize::size( get_post_meta( $c_pageID, 'pyre_fimg_width', true ) );
		}

		$css['global']['#post-' . $c_pageID . ' .oxo-post-slideshow img']['max-width'] = Aione_Sanitize::size( get_post_meta( $c_pageID, 'pyre_fimg_width', true ) );
	}

	if ( is_single() && get_post_meta( $c_pageID, 'pyre_fimg_height', true ) ) {
		$elements = array(
			'#post-' . $c_pageID . ' .oxo-post-slideshow',
			'#post-' . $c_pageID . ' .oxo-post-slideshow img'
		);
		$css['global'][aione_implode( $elements )]['max-height'] = get_post_meta( $c_pageID, 'pyre_fimg_height', true );
		$css['global']['#post-' . $c_pageID . ' .oxo-post-slideshow .slides']['max-height'] = '100%';
	}
	
	$page_title_br_retina_image = Aione()->theme_options[ 'page_title_bg_retina' ];
	
	if ( get_post_meta( $c_pageID, 'pyre_page_title_bar_bg_retina', true ) ) {

		$media_query = '@media only screen and (-webkit-min-device-pixel-ratio: 1.5), only screen and (min-resolution: 144dpi), only screen and (min-resolution: 1.5dppx)';
		$css[$media_query]['.oxo-page-title-bar']['background-image'] = 'url("' . Aione_Sanitize::css_asset_url( get_post_meta( $c_pageID, 'pyre_page_title_bar_bg_retina', true ) ) . '")';
		$css[$media_query]['.oxo-page-title-bar']['background-size']  = 'cover';

	} elseif ( Aione()->theme_options[ 'page_title_bg_retina' ] ) {

		$media_query = '@media only screen and (-webkit-min-device-pixel-ratio: 1.5), only screen and (min-resolution: 144dpi), only screen and (min-resolution: 1.5dppx)';
		$css[$media_query]['.oxo-page-title-bar']['background-image'] = 'url("' . $page_title_br_retina_image['url'] . '")';
		$css[$media_query]['.oxo-page-title-bar']['background-size']  = 'cover';

	}

	if ( ( 'content_only' == Aione()->theme_options[ 'page_title_bar' ] && ( 'default' == get_post_meta( $c_pageID, 'pyre_page_title', true ) || ! get_post_meta( $c_pageID, 'pyre_page_title', true ) ) ) || 'yes_without_bar' == get_post_meta( $c_pageID, 'pyre_page_title', true ) ) {
		$css['global']['.oxo-page-title-bar']['background'] = 'none';
		$css['global']['.oxo-page-title-bar']['border']     = 'none';
	}

	$elements = array(
		'.width-100 .nonhundred-percent-fullwidth',
		'.width-100 .oxo-section-separator'
	);
	if ( get_post_meta( $c_pageID, 'pyre_hundredp_padding', true ) ) {
		$css['global'][aione_implode( $elements )]['margin-left']  = '-' . Aione_Sanitize::size( get_post_meta( $c_pageID, 'pyre_hundredp_padding', true ) );
		$css['global'][aione_implode( $elements )]['margin-right'] = '-' . Aione_Sanitize::size( get_post_meta( $c_pageID, 'pyre_hundredp_padding', true ) );
	} elseif ( Aione()->theme_options[ 'hundredp_padding' ] ) {
		$css['global'][aione_implode( $elements )]['margin-left']  = '-' . Aione_Sanitize::size( Aione()->theme_options[ 'hundredp_padding' ] );
		$css['global'][aione_implode( $elements )]['margin-right'] = '-' . Aione_Sanitize::size( Aione()->theme_options[ 'hundredp_padding' ] );
	}

	if ( (float) $wp_version < 3.8) {
		$css['global']['#wpadminbar *']['color'] = '#ccc';
		$elements = array(
			'#wpadminbar .hover a',
			'#wpadminbar .hover a span'
		);
		$css['global'][aione_implode( $elements )]['color'] = '#464646';
	}

	if ( class_exists( 'WooCommerce' ) ) {

		$css['global']['.woocommerce-invalid:after']['content']    = __( 'Please enter correct details for this required field.', 'Aione' );
		$css['global']['.woocommerce-invalid:after']['display']    = 'inline-block';
		$css['global']['.woocommerce-invalid:after']['margin-top'] = '7px';
		$css['global']['.woocommerce-invalid:after']['color']      = 'red';

	}

	if ( get_post_meta( $c_pageID, 'pyre_fallback', true ) ) {

		$media_query = '@media only screen and (max-width: 940px)';
		$css[$media_query]['#sliders-container']['display'] = 'none';
		$css[$media_query]['#fallback-slide']['display'] = 'block';
	}

	if ( Aione()->theme_options[ 'side_header_width' ] && 'no' != get_post_meta( get_queried_object_id(), 'pyre_display_header', true ) ) {

		$side_header_width = Aione_Sanitize::size( Aione()->theme_options[ 'side_header_width' ] );
		$side_header_width = (int) str_replace( 'px', '', $side_header_width );

		$elements = array(
			'body.side-header-left #wrapper',
			'.side-header-left .oxo-footer-parallax'
		);
		$css['global'][aione_implode( $elements )]['margin-left'] = Aione_Sanitize::size( Aione()->theme_options[ 'side_header_width' ] );

		$elements = array(
			'body.side-header-right #wrapper',
			'.side-header-right .oxo-footer-parallax'
		);
		$css['global'][aione_implode( $elements )]['margin-right'] = Aione_Sanitize::size( Aione()->theme_options[ 'side_header_width' ] );

		$elements = array(
			'body.side-header-left #side-header #nav > ul > li > ul',
			'body.side-header-left #side-header #nav .login-box',
			'body.side-header-left #side-header #nav .main-nav-search-form'
		);
		if ( class_exists( 'WooCommerce' ) ) {
			$elements[] = 'body.side-header-left #side-header #nav .cart-contents';
		}
		$css['global'][aione_implode( $elements )]['left'] = ( $side_header_width - 1 ) . 'px';

		if ( is_rtl() ) {
			$css['global']['body.rtl #boxed-wrapper']['position'] = 'relative';

			$css['global']['body.rtl.layout-boxed-mode.side-header-left #side-header']['position']    = 'absolute';
			$css['global']['body.rtl.layout-boxed-mode.side-header-left #side-header']['left']        = '0';
			$css['global']['body.rtl.layout-boxed-mode.side-header-left #side-header']['top']         = '0';
			$css['global']['body.rtl.layout-boxed-mode.side-header-left #side-header']['margin-left'] = '0px';

			$css['global']['body.rtl.side-header-left #side-header .side-header-wrapper']['position'] = 'fixed';
			$css['global']['body.rtl.side-header-left #side-header .side-header-wrapper']['width']    = Aione_Sanitize::size( Aione()->theme_options[ 'side_header_width' ] );
		}

		if ( 'Boxed' != Aione()->theme_options['layout'] && 'boxed' != get_post_meta( $c_pageID, 'pyre_page_bg_layout', true ) ) {

			$elements = array(
				'body.side-header-left #slidingbar .aione-row',
				'body.side-header-right #slidingbar .aione-row'
			);
			$css['global'][aione_implode( $elements )]['max-width'] = 'none';

		}

	}

	if ( ( ( 'Boxed' == Aione()->theme_options['layout'] && 'wide' != get_post_meta( $c_pageID, 'pyre_page_bg_layout', true ) ) || 'boxed' == get_post_meta( $c_pageID, 'pyre_page_bg_layout', true ) ) && 'top' != Aione()->theme_options[ 'header_position' ] ) {

		$css['global']['#boxed-wrapper']['min-height'] = '100vh';

		if ( ! $site_width_percent ) {

			$elements = array(
				'#boxed-wrapper',
				'.oxo-body .oxo-footer-parallax'
			);
			$css['global'][aione_implode( $elements )]['margin']    = '0 auto';
			$css['global'][aione_implode( $elements )]['max-width'] = Aione_Sanitize::size( ( $site_width_without_units + Aione()->theme_options[ 'side_header_width' ] + 60 ) . 'px' );

			$css['global']['#slidingbar-area .oxo-row']['max-width'] = intval( $site_width_without_units + Aione()->theme_options[ 'side_header_width' ] ) . 'px';

		} else {

			$elements = array(
				'#boxed-wrapper',
				'#slidingbar-area .oxo-row',
				'.oxo-footer-parallax'
			);
			$css['global'][aione_implode( $elements )]['margin']      = '0 auto';
			$css['global'][aione_implode( $elements )]['max-width'][] = 'calc(' . $site_width_with_units . ' + ' . Aione_Sanitize::size( Aione()->theme_options[ 'side_header_width' ] ) . ')';

			$css['global']['#wrapper']['max-width'] = 'none';

		}

		if ( 'left' == Aione()->theme_options[ 'header_position' ] ) {

			$css['global']['body.side-header-left #side-header']['left']        = 'auto';
			$css['global']['body.side-header-left #side-header']['margin-left'] = '-' . Aione_Sanitize::size( Aione()->theme_options[ 'side_header_width' ] );

			$css['global']['.side-header-left .oxo-footer-parallax']['margin'] = '0 auto';
			$css['global']['.side-header-left .oxo-footer-parallax']['padding-left'] = Aione_Sanitize::size( Aione()->theme_options[ 'side_header_width' ] );

		} else {

			$css['global']['#boxed-wrapper']['position'] = 'relative';

			$css['global']['body.admin-bar #wrapper #slidingbar-area']['top'] = '0';

			$css['global']['.side-header-right .oxo-footer-parallax']['margin'] = '0 auto';
			$css['global']['.side-header-right .oxo-footer-parallax']['padding-right'] = Aione_Sanitize::size( Aione()->theme_options[ 'side_header_width' ] );

			$media_query = '@media only screen and (min-width: ' . intval( Aione()->theme_options[ 'side_header_break_point' ] ) . 'px)';
			$css[$media_query]['body.side-header-right #side-header']['position'] = 'absolute';
			$css[$media_query]['body.side-header-right #side-header']['top']      = '0';

			$css[$media_query]['body.side-header-right #side-header .side-header-wrapper']['position'] = 'fixed';

		}

	}

	if ( is_page_template( 'contact.php' ) && Aione()->theme_options[ 'gmap_address' ] && ! Aione()->theme_options[ 'status_gmap' ] ) {

		$css['global']['.aione-google-map']['width']  = Aione_Sanitize::size( Aione()->theme_options[ 'gmap_width' ] );
		$css['global']['.aione-google-map']['margin'] = '0 auto';

		if ( '100%' != Aione()->theme_options[ 'gmap_width' ] ) {

			$margin_top = ( Aione()->theme_options[ 'gmap_topmargin' ] ) ? Aione_Sanitize::size( Aione()->theme_options[ 'gmap_topmargin' ] ) : '55px';
			$css['global']['.aione-google-map']['margin-top'] = Aione_Sanitize::size( $margin_top );

		}

		$gmap_height = ( Aione()->theme_options[ 'gmap_height' ] ) ? Aione()->theme_options[ 'gmap_height' ] : '415px';
		$css['global']['.aione-google-map']['height'] = $gmap_height;

	} elseif ( is_page_template( 'contact-2.php' ) && Aione()->theme_options[ 'gmap_address' ] && ! Aione()->theme_options[ 'status_gmap' ] ) {

		$css['global']['.aione-google-map']['margin']     = '0 auto';
		$css['global']['.aione-google-map']['margin-top'] = '55px';
		$css['global']['.aione-google-map']['height']     = '415px !important';
		$css['global']['.aione-google-map']['width']      = '940px !important';

	}

	if ( 'yes' == get_post_meta( $c_pageID, 'pyre_footer_100_width', true ) ) {

		$elements = array(
			'.layout-wide-mode .oxo-footer-widget-area > .oxo-row',
			'.layout-wide-mode .oxo-footer-copyright-area > .oxo-row'
		);
		$css['global'][aione_implode( $elements )]['max-width'] = '100% !important';

	} elseif ( 'no' == get_post_meta( $c_pageID, 'pyre_footer_100_width', true ) ) {

		$elements = array(
			'.layout-wide-mode .oxo-footer-widget-area > .oxo-row',
			'.layout-wide-mode .oxo-footer-copyright-area > .oxo-row'
		);
		$css['global'][aione_implode( $elements )]['max-width'] = $site_width_with_units . ' !important';

	}

	if ( get_post_meta( $c_pageID, 'pyre_page_title_font_color', true ) && '' != get_post_meta( $c_pageID, 'pyre_page_title_font_color', true ) ) {

		$elements = array(
			'.oxo-page-title-bar h1',
			'.oxo-page-title-bar h3'
		);
		$css['global'][aione_implode( $elements )]['color'] = Aione_Sanitize::color( get_post_meta( $c_pageID, 'pyre_page_title_font_color', true ) );

	}

	if ( get_post_meta( $c_pageID, 'pyre_page_title_text_size', true ) && '' != get_post_meta( $c_pageID, 'pyre_page_title_text_size', true ) ) {

		$css['global']['.oxo-page-title-bar h1']['font-size']   = Aione_Sanitize::size( get_post_meta( $c_pageID, 'pyre_page_title_text_size', true ) );
		$css['global']['.oxo-page-title-bar h1']['line-height'] = 'normal';

	}

	if ( get_post_meta( $c_pageID, 'pyre_page_title_custom_subheader_text_size', true ) && '' != get_post_meta( $c_pageID, 'pyre_page_title_custom_subheader_text_size', true) ) {

		$css['global']['.oxo-page-title-bar h3']['font-size']   = Aione_Sanitize::size( get_post_meta( $c_pageID, 'pyre_page_title_custom_subheader_text_size', true ) );
		if ( Aione()->theme_options[ 'page_title_subheader_font_size' ] ) {
			$css['global']['.oxo-page-title-bar h3']['line-height'] = ( intval( Aione()->theme_options[ 'page_title_subheader_font_size' ] + 12 ) ) . 'px';
		}

	}

	if ( 'yes' == get_post_meta( $c_pageID, 'pyre_page_title_100_width', true ) ) {
		$css['global']['.layout-wide-mode .oxo-page-title-row']['max-width'] = '100%';
	}

	$header_width = Aione_Sanitize::size( Aione()->theme_options[ 'header_100_width' ] );

	if ( 'yes' == get_post_meta( $c_pageID, 'pyre_header_100_width', true ) ) {
		$header_width = true;
	} elseif ( 'no' == get_post_meta( $c_pageID, 'pyre_header_100_width', true ) ) {
		$header_width = false;
	}

	if ( $header_width ) {
		$css['global']['.layout-wide-mode .oxo-header-wrapper .oxo-row']['max-width'] = '100%';
	}

	$button_text_color_brightness       = Aione_Sanitize::color( oxo_calc_color_brightness( Aione()->theme_options[ 'button_accent_color' ] ) );
	$button_hover_text_color_brightness = Aione_Sanitize::color( oxo_calc_color_brightness( Aione()->theme_options[ 'button_accent_hover_color' ] ) );

	$text_shadow_color = ( 140 < $button_hover_text_color_brightness ) ? '#333' : '#fff';

	if ( get_post_meta( $c_pageID, 'pyre_page_title_mobile_height', true ) ) {

		$media_query = '@media only screen and (max-width: ' . ( intval( $side_header_width ) + intval( Aione()->theme_options[ 'content_break_point' ] ) ) . 'px)';

		if ( 'auto' != get_post_meta( $c_pageID, 'pyre_page_title_mobile_height', true ) ) {

			$css[$media_query]['.oxo-body .oxo-page-title-bar']['height'] = Aione_Sanitize::size( get_post_meta( $c_pageID, 'pyre_page_title_mobile_height', true ) );

			$css[$media_query]['.oxo-page-title-row']['display'] = 'table';

			$css[$media_query]['.oxo-page-title-wrapper']['display']        = 'table-cell';
			$css[$media_query]['.oxo-page-title-wrapper']['vertical-align'] = 'middle';

		} else {

			$css[$media_query]['.oxo-body .oxo-page-title-bar']['padding-top']    = '10px';
			$css[$media_query]['.oxo-body .oxo-page-title-bar']['padding-bottom'] = '10px';
			$css[$media_query]['.oxo-body .oxo-page-title-bar']['height']         = 'auto';

		}

	}

	if ( Aione()->theme_options[ 'responsive' ] ) {
		$media_query = '@media only screen and (max-width: ' . intval( Aione()->theme_options[ 'side_header_break_point' ] ) . 'px)';
		$css[$media_query]['.oxo-contact-info']['padding']     = '1em 30px';
		$css[$media_query]['.oxo-contact-info']['line-height'] = '1.5em';
	}

	if ( ! Aione()->theme_options[ 'responsive' ] ) {
		$css['global']['body']['min-width']  = $site_width_with_units;

		if( ! $site_width_percent ) {
			$css['global']['html']['overflow-x'] = 'scroll';
			$css['global']['body']['overflow-x'] = 'scroll';
		}
	}

	$elements = array(
		'.oxo-flexslider .flex-direction-nav a',
		'.oxo-flexslider.flexslider-posts .flex-direction-nav a',
		'.oxo-flexslider.flexslider-posts-with-excerpt .flex-direction-nav a',
		'.oxo-flexslider.flexslider-attachments .flex-direction-nav a',
		'.oxo-slider-sc .flex-direction-nav a'
	);

	$carousel_elements = array(
		'.oxo-carousel .oxo-carousel-nav .oxo-nav-prev',
		'.oxo-carousel .oxo-carousel-nav .oxo-nav-next'
	);

	if( Aione()->theme_options[ 'slider_nav_box_width' ] ) {
		$css['global'][aione_implode( $elements )]['width'] = Aione_Sanitize::size( Aione()->theme_options[ 'slider_nav_box_width' ] );
		$css['global'][aione_implode( $carousel_elements )]['width'] = Aione_Sanitize::size( Aione()->theme_options[ 'slider_nav_box_width' ] );
	}

	if( Aione()->theme_options[ 'slider_nav_box_height' ] ) {
		$half_slider_nav_box_height = Aione_Sanitize::size( ( intval( Aione()->theme_options[ 'slider_nav_box_height' ] ) / 2 ) . 'px' );

		$css['global'][aione_implode( $elements )]['height'] = Aione_Sanitize::size( Aione()->theme_options[ 'slider_nav_box_height' ] );
		$css['global'][aione_implode( $elements )]['line-height'] = Aione_Sanitize::size( Aione()->theme_options[ 'slider_nav_box_height' ] );

		$css['global'][aione_implode( $carousel_elements )]['height'] = Aione_Sanitize::size( Aione()->theme_options[ 'slider_nav_box_height' ] );
		$css['global'][aione_implode( $carousel_elements )]['margin-top'] = '-' . $half_slider_nav_box_height;
	}

	$carousel_elements = array(
		'.oxo-carousel .oxo-carousel-nav .oxo-nav-prev:before',
		'.oxo-carousel .oxo-carousel-nav .oxo-nav-next:before'
	);


	if( Aione()->theme_options[ 'slider_nav_box_height' ] ) {
		$css['global'][aione_implode( $carousel_elements )]['line-height'] = Aione_Sanitize::size( Aione()->theme_options[ 'slider_nav_box_height' ] );
	}


	if( Aione()->theme_options[ 'slider_arrow_size' ] ) {
		$css['global'][aione_implode( $elements )]['font-size'] = Aione_Sanitize::size( Aione()->theme_options[ 'slider_arrow_size' ] );

		$css['global'][aione_implode( $carousel_elements )]['font-size'] = Aione_Sanitize::size( Aione()->theme_options[ 'slider_arrow_size' ] );
	}


	if( Aione()->theme_options[ 'pagination_box_padding' ] ) {
		$elements = array(
			'.pagination a.inactive',
			'.page-links a',
			'.woocommerce-pagination .page-numbers',
			'.bbp-pagination .bbp-pagination-links a.inactive',
			'.bbp-topic-pagination .page-numbers'
		);
		$css['global'][aione_implode( $elements )]['padding'] = Aione()->theme_options[ 'pagination_box_padding' ];

		$elements = array(
			'.pagination .current',
			'.page-links > .page-number',
			'.woocommerce-pagination .current',
			'.bbp-pagination .bbp-pagination-links .current'
		);
		$css['global'][aione_implode( $elements )]['padding'] = Aione()->theme_options[ 'pagination_box_padding' ];

		$elements = array(
			'.pagination .pagination-prev',
			'.woocommerce-pagination .prev',
			'.bbp-pagination .bbp-pagination-links .pagination-prev'
		);
		$css['global'][aione_implode( $elements )]['padding'] = Aione()->theme_options[ 'pagination_box_padding' ];

		$elements = array(
			'.pagination .pagination-next',
			'.woocommerce-pagination .next',
			'.bbp-pagination .bbp-pagination-links .pagination-next',
			'.bbp-pagination-links span.dots'
		);
		$css['global'][aione_implode( $elements )]['padding'] = Aione()->theme_options[ 'pagination_box_padding' ];
	}

	if( ! Aione()->theme_options[ 'pagination_text_display' ] ) {
		$elements = array(
			'.oxo-hide-pagination-text .page-text'
		);
		$css['global'][aione_implode( $elements )]['display'] = 'inline-block';
		$css['global'][aione_implode( $elements )]['text-indent'] = '-10000000px';

		$css['global']['.oxo-hide-pagination-text .pagination-prev, .oxo-hide-pagination-text .pagination-next']['border-width'] = '1px';
		$css['global']['.oxo-hide-pagination-text .pagination-prev, .oxo-hide-pagination-text .pagination-next']['border-style'] = 'solid';
		$css['global']['.oxo-hide-pagination-text .pagination-prev']['margin'] = '0';
		$css['global']['.oxo-hide-pagination-text .pagination-next']['margin-left'] = '5px';
		$css['global']['.oxo-hide-pagination-text .pagination-prev:before, .oxo-hide-pagination-text .pagination-next:after']['line-height'] = 'normal';
		$css['global']['.oxo-hide-pagination-text .pagination-prev:before, .oxo-hide-pagination-text .pagination-next:after']['position'] = 'relative';
		$css['global']['.oxo-hide-pagination-text .pagination-prev:before, .oxo-hide-pagination-text .pagination-next:after']['margin'] = '0';
		$css['global']['.oxo-hide-pagination-text .pagination-prev:before, .oxo-hide-pagination-text .pagination-next:after']['padding'] = '0';

		$css['global']['.oxo-hide-pagination-text .woocommerce-pagination .prev, .oxo-hide-pagination-text .woocommerce-pagination .next']['border-width'] = '1px';
		$css['global']['.oxo-hide-pagination-text .woocommerce-pagination .prev, .oxo-hide-pagination-text .woocommerce-pagination .next']['border-style'] = 'solid';
		$css['global']['.oxo-hide-pagination-text .woocommerce-pagination .prev']['margin'] = '0';
		$css['global']['.oxo-hide-pagination-text .woocommerce-pagination .next']['margin-left'] = '5px';
		$css['global']['.oxo-hide-pagination-text .woocommerce-pagination .prev:before, .oxo-hide-pagination-text .woocommerce-pagination .next:after']['line-height'] = 'normal';
		$css['global']['.oxo-hide-pagination-text .woocommerce-pagination .prev:before, .oxo-hide-pagination-text .woocommerce-pagination .next:after']['position'] = 'relative';
		$css['global']['.oxo-hide-pagination-text .woocommerce-pagination .prev:before, .oxo-hide-pagination-text .woocommerce-pagination .next:after']['margin'] = '0';
		$css['global']['.oxo-hide-pagination-text .woocommerce-pagination .prev:before, .oxo-hide-pagination-text .woocommerce-pagination .next:after']['padding'] = '0';

		$elements = array(
			'.oxo-hide-pagination-text  .bbp-pagination-links .page-text'
		);
		$css['global'][aione_implode( $elements )]['display'] = 'none';

		$css['global']['.oxo-hide-pagination-text .bbp-pagination-links .pagination-prev, .oxo-hide-pagination-text .bbp-pagination-links .pagination-next']['border-width'] = '1px';
		$css['global']['.oxo-hide-pagination-text .bbp-pagination-links .pagination-prev, .oxo-hide-pagination-text .bbp-pagination-links .pagination-next']['border-style'] = 'solid';
		$css['global']['.oxo-hide-pagination-text .bbp-pagination-links .pagination-prev']['margin'] = '0';
		$css['global']['.oxo-hide-pagination-text .bbp-pagination-links .pagination-next']['margin-left'] = '5px';
		$css['global']['.oxo-hide-pagination-text .bbp-pagination-links .pagination-prev:before, .oxo-hide-pagination-text .bbp-pagination-links .pagination-next:after']['line-height'] = 'normal';
		$css['global']['.oxo-hide-pagination-text .bbp-pagination-links .pagination-prev:before, .oxo-hide-pagination-text .bbp-pagination-links .pagination-next:after']['position'] = 'relative';
		$css['global']['.oxo-hide-pagination-text .bbp-pagination-links .pagination-prev:before, .oxo-hide-pagination-text .bbp-pagination-links .pagination-next:after']['margin'] = '0';
		$css['global']['.oxo-hide-pagination-text .bbp-pagination-links .pagination-prev:before, .oxo-hide-pagination-text .bbp-pagination-links .pagination-next:after']['padding'] = '0';
	}


	// Animations

	$css['@-webkit-keyframes aioneSonarEffect']['0%']['opacity']             = '0.3';
	$css['@-webkit-keyframes aioneSonarEffect']['40%']['opacity']            = '0.5';
	$css['@-webkit-keyframes aioneSonarEffect']['100%']['-webkit-transform'] = 'scale(1.5)';
	$css['@-webkit-keyframes aioneSonarEffect']['100%']['opacity']           = '0';

	$css['@-moz-keyframes aioneSonarEffect']['0%']['opacity']          = '0.3';
	$css['@-moz-keyframes aioneSonarEffect']['40%']['opacity']         = '0.5';
	$css['@-moz-keyframes aioneSonarEffect']['100%']['-moz-transform'] = 'scale(1.5)';
	$css['@-moz-keyframes aioneSonarEffect']['100%']['opacity']        = '0';

	$css['@keyframes aioneSonarEffect']['0%']['opacity']      = '0.3';
	$css['@keyframes aioneSonarEffect']['40%']['opacity']     = '0.5';
	$css['@keyframes aioneSonarEffect']['100%']['transform']  = 'scale(1.5)';
	$css['@keyframes aioneSonarEffect']['100%']['opacity']    = '0';

	return apply_filters( 'aione_dynamic_css_array', $css );

}

/**
 * Helper function.
 * Merge and combine the CSS elements
 */
function aione_implode( $elements = array() ) {

	// Make sure our values are unique
	$elements = array_unique( $elements );
	// Sort elements alphabetically.
	// This way all duplicate items will be merged in the final CSS array.
	sort( $elements );

	// Implode items and return the value.
	return implode( ',', $elements );

}

/**
 * Maps elements from dynamic css to the selector
 */
function aione_map_selector( $elements, $selector ) {
	$array = array();

	foreach( $elements as $element ) {
		$array[] = $element . $selector;
	}

	return $array;
}

/**
 * Function to implement background for theme sections
 */
function get_background( $selector ) {
	$output = "";
	//$output .= "== ".$selector." - ".implode(",", Aione()->theme_options['background_body_options']);
	$background_color = '';
	$background_image = Array();
	$background_repeat = Array();
	$background_clip = Array();
	$background_origin = Array();
	$background_size = Array();
	$background_attachment = Array();
	$background_position = Array();

	if(in_array("pattern2", Aione()->theme_options['background_'.$selector.'_options']) && Aione()->theme_options['background_'.$selector.'_pattern2']):
		$background_image[] = 'url('.Aione()->theme_options['background_'.$selector.'_pattern2'].')';
		$background_repeat[] = "repeat";
		$background_clip[] = "border-box";
		$background_origin[] = "border-box";
		$background_size[] = "auto";
		$background_attachment[] = "scroll";
		$background_position[] = "center top";
	endif;

	if(in_array("pattern1", Aione()->theme_options['background_'.$selector.'_options']) && Aione()->theme_options['background_'.$selector.'_pattern1']):
		$background_image[] = 'url('.Aione()->theme_options['background_'.$selector.'_pattern1'].')';
		$background_repeat[] = "repeat";
		$background_clip[] = "border-box";
		$background_origin[] = "border-box";
		$background_size[] = "auto";
		$background_attachment[] = "scroll";
		$background_position[] = "center top";
	endif;

	if(in_array("custom", Aione()->theme_options['background_'.$selector.'_options']) && Aione()->theme_options['background_'.$selector]['background-image']):
		$background_image[] = 'url('.Aione()->theme_options['background_'.$selector]['background-image'].')';
		$background_repeat[] = Aione()->theme_options['background_'.$selector]['background-repeat'];
		$background_clip[] = Aione()->theme_options['background_'.$selector]['background-clip'];
		$background_origin[] = Aione()->theme_options['background_'.$selector]['background-origin'];
		$background_size[] = Aione()->theme_options['background_'.$selector]['background-size'];
		$background_attachment[] = Aione()->theme_options['background_'.$selector]['background-attachment'];
		$background_position[] = Aione()->theme_options['background_'.$selector]['background-position'];
	endif;


	if(in_array("image", Aione()->theme_options['background_'.$selector.'_options']) && Aione()->theme_options['background_'.$selector.'_image']):
		$background_image[] = 'url('.Aione()->theme_options['background_'.$selector.'_image'].')';
		$background_repeat[] = Aione()->theme_options['background_'.$selector]['background-repeat'];
		$background_clip[] = Aione()->theme_options['background_'.$selector]['background-clip'];
		$background_origin[] = Aione()->theme_options['background_'.$selector]['background-origin'];
		$background_size[] = Aione()->theme_options['background_'.$selector]['background-size'];
		$background_attachment[] = Aione()->theme_options['background_'.$selector]['background-attachment'];
		$background_position[] = Aione()->theme_options['background_'.$selector]['background-position'];
	endif;

	if(in_array("gradient", Aione()->theme_options['background_'.$selector.'_options']) && Aione()->theme_options['background_'.$selector.'_gradient']):
		$background_image[] = 'linear-gradient('.Aione()->theme_options['background_'.$selector.'_gradient']['from'].', '.Aione()->theme_options['background_'.$selector.'_gradient']['to'].');';
		//$output .= "\r\n".'background: -webkit-linear-gradient('.Aione()->theme_options['background_'.$selector.'_gradient']['from'].', '.Aione()->theme_options['background_'.$selector.'_gradient']['to'].');';
		//$output .= "\r\n".'background: -o-linear-gradient('.Aione()->theme_options['background_'.$selector.'_gradient']['from'].', '.Aione()->theme_options['background_'.$selector.'_gradient']['to'].');';
		//$output .= "\r\n".'background: -moz-linear-gradient('.Aione()->theme_options['background_'.$selector.'_gradient']['from'].', '.Aione()->theme_options['background_'.$selector.'_gradient']['to'].');';
		//$output .= 'background-image:linear-gradient('.Aione()->theme_options['background_'.$selector.'_gradient']['from'].', '.Aione()->theme_options['background_'.$selector.'_gradient']['to'].');';
		$background_repeat[] = "no-repeat";
		$background_clip[] = "border-box";
		$background_origin[] = "border-box";
		$background_size[] = "auto";
		$background_attachment[] = "scroll";
		$background_position[] = "center top";
	endif;

	if(in_array("color", Aione()->theme_options['background_'.$selector.'_options']) && Aione()->theme_options['background_'.$selector.'_color']):
		$background_color = Aione()->theme_options['background_'.$selector.'_color'];
		if(Aione()->theme_options['background_'.$selector.'_color_alpha'] < 100){
			$background_color = oxo_hex2rgba( $background_color, Aione()->theme_options['background_'.$selector.'_color_alpha'] );
		}
	endif;

	$replace = array("tmb/");
	$background_image = str_replace($replace, "", implode(' , ',$background_image));

	$output .= "\r\n".'background-color :'.$background_color.';';
	if($background_image){
	$output .= "\r\n".'background-image :'.$background_image.';';
	$output .= "\r\n".'background-repeat :'.implode(' , ',$background_repeat).';';
	$output .= "\r\n".'background-clip :'.implode(' , ',$background_clip).';';
	$output .= "\r\n".'background-origin :'.implode(' , ',$background_origin).';';
	$output .= "\r\n".'background-size :'.implode(' , ',$background_size).';';
	$output .= "\r\n".'background-attachment :'.implode(' , ',$background_attachment).';';
	$output .= "\r\n".'background-position :'.implode(' , ',$background_position).';';
	}

	return $output;
}

/**
 * Function to generate CSS for backgrounds
 */
function get_background_css() {
	$output = "";
	 
	$output .= "\r\n".".oxo-body{";
	$output .= get_background('body');
	$output .= "}";
	
	$output .= "\r\n".".oxo-secondary-header{";
	$output .= get_background('topbar');
	$output .= "}";

	$output .= "\r\n".".oxo-header{";
	$output .= get_background('header');
	$output .= "}";
	
	$output .= "\r\n".".oxo-secondary-main-menu{";
	$output .= get_background('nav');
	$output .= "}";

	$output .= "\r\n"."#sliders-container{";
	$output .= get_background('slider');
	$output .= "}";

	$output .= "\r\n".".oxo-page-title-bar{";
	$output .= get_background('pagetitle');
	$output .= "}";

	$output .= "\r\n"."#main{";
	$output .= get_background('main');
	$output .= "}";
	
	$output .= "\r\n"."#content{";
	$output .= get_background('content');
	$output .= "}";
	
	$output .= "\r\n"."#sidebar{";
	$output .= get_background('left_sidebar');
	$output .= "}";
	
	$output .= "\r\n"."#sidebar-2{";
	$output .= get_background('right_sidebar');
	$output .= "}";
	
	$output .= "\r\n".".oxo-footer-widget-area{";
	$output .= get_background('footer');
	$output .= "}";
	
	$output .= "\r\n".".oxo-footer-copyright-area{";
	$output .= get_background('copyright');
	$output .= "}";
	
	return $output;
}

/**
 * Get the array of dynamically-generated CSS and convert it to a string.
 * Parses the array and adds prefixes for browser-support.
 */
function aione_dynamic_css_parser( $css ) {
	/**
	 * Prefixes
	 */
	foreach ( $css as $media_query => $elements ) {
		foreach ( $elements as $element => $style_array ) {
			foreach ( $style_array as $property => $value ) {
				// border-radius
				if ( 'border-radius' == $property ) {
					$css[$media_query][$element]['-webkit-border-radius'] = $value;
				}
				// box-shadow
				if ( 'box-shadow' == $property ) {
					$css[$media_query][$element]['-webkit-box-shadow'] = $value;
					$css[$media_query][$element]['-moz-box-shadow']    = $value;
				}
				// box-sizing
				elseif ( 'box-sizing' == $property ) {
					$css[$media_query][$element]['-webkit-box-sizing'] = $value;
					$css[$media_query][$element]['-moz-box-sizing']    = $value;
				}
				// text-shadow
				elseif ( 'text-shadow' == $property ) {
					$css[$media_query][$element]['-webkit-text-shadow'] = $value;
					$css[$media_query][$element]['-moz-text-shadow']    = $value;
				}
				// transform
				elseif ( 'transform' == $property ) {
					$css[$media_query][$element]['-webkit-transform'] = $value;
					$css[$media_query][$element]['-moz-transform']    = $value;
					$css[$media_query][$element]['-ms-transform']     = $value;
					$css[$media_query][$element]['-o-transform']      = $value;
				}
				// background-size
				elseif ( 'background-size' == $property ) {
					$css[$media_query][$element]['-webkit-background-size'] = $value;
					$css[$media_query][$element]['-moz-background-size']    = $value;
					$css[$media_query][$element]['-ms-background-size']     = $value;
					$css[$media_query][$element]['-o-background-size']      = $value;
				}
				// transition
				elseif ( 'transition' == $property ) {
					$css[$media_query][$element]['-webkit-transition'] = $value;
					$css[$media_query][$element]['-moz-transition']    = $value;
					$css[$media_query][$element]['-ms-transition']     = $value;
					$css[$media_query][$element]['-o-transition']      = $value;
				}
				// transition-property
				elseif ( 'transition-property' == $property ) {
					$css[$media_query][$element]['-webkit-transition-property'] = $value;
					$css[$media_query][$element]['-moz-transition-property']    = $value;
					$css[$media_query][$element]['-ms-transition-property']     = $value;
					$css[$media_query][$element]['-o-transition-property']      = $value;
				}
				// linear-gradient
				elseif ( is_array( $value ) ) {
					foreach ( $value as $subvalue ) {
						if ( false !== strpos( $subvalue, 'linear-gradient' ) ) {
							$css[$media_query][$element][$property][] = '-webkit-' . $subvalue;
							$css[$media_query][$element][$property][] = '-moz-' . $subvalue;
							$css[$media_query][$element][$property][] = '-ms-' . $subvalue;
							$css[$media_query][$element][$property][] = '-o-' . $subvalue;
						}
						// calc
						elseif ( 0 === stripos( $subvalue, 'calc' ) ) {
							$css[$media_query][$element][$property][] = '-webkit-' . $subvalue;
							$css[$media_query][$element][$property][] = '-moz-' . $subvalue;
							$css[$media_query][$element][$property][] = '-ms-' . $subvalue;
							$css[$media_query][$element][$property][] = '-o-' . $subvalue;
						}
					}
				}
			}
		}
	}

	/**
	 * Process the array of CSS properties and produce the final CSS
	 */
	$final_css = '';
	foreach ( $css as $media_query => $styles ) {

		$final_css .= ( 'global' != $media_query ) ? $media_query . '{' : '';

		foreach ( $styles as $style => $style_array ) {
			$final_css .= $style . '{';
				foreach ( $style_array as $property => $value ) {
					if ( is_array( $value ) ) {
						foreach ( $value as $sub_value ) {
							$final_css .= $property . ':' . $sub_value . ';';
						}
					} else {
						$final_css .= $property . ':' . $value . ';';
					}
				}
			$final_css .= '}';
		}

		$final_css .= ( 'global' != $media_query ) ? '}' : '';

	}
	
	//Custom CSS for each page
	$c_pageID = Aione::c_pageID();
	if ( '' != get_post_meta( $c_pageID, 'pyre_custom_css', true ) ) {
		$pyre_custom_css = get_post_meta( $c_pageID, 'pyre_custom_css', true );
		$final_css .= preg_replace('/\s+/', ' ',$pyre_custom_css);
	}

	return apply_filters( 'aione_dynamic_css', $final_css );

}

/**
 * Returns the dynamic CSS.
 * If possible, it also caches the CSS using WordPress transients
 *
 * @return  string  the dynamically-generated CSS.
 */
function aione_dynamic_css_cached() {
	/**
	 * Get the page ID
	 */
	$c_pageID = Aione()->dynamic_css->page_id();

	/**
	 * do we have WP_DEBUG set to true?
	 * If yes, then do not cache.
	 */
	$cache = ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ? false : true;
	/**
	 * If the dynamic_css_db_caching option is not set
	 * or set to off, then do not cache.
	 */
	$cache = ( $cache && ( null == Aione()->theme_options[ 'dynamic_css_db_caching' ] || ! Aione()->theme_options[ 'dynamic_css_db_caching' ] ) ) ? false : $cache;
	/**
	 * If we're compiling to file, then do not use transients for caching.
	 */
	/**
	 * Check if we're using file mode or inline mode.
	 * This simply checks the dynamic_css_compiler options.
	 */
	$mode = Aione_Dynamic_CSS::$mode;

	/**
	 * ALWAYS use 'inline' mode when in the customizer.
	 */
	global $wp_customize;
	if ( $wp_customize ) {
		$mode = 'inline';
	}

	$cache = ( $cache && 'file' == $mode ) ? false : $cache;

	if ( $cache ) {
		/**
		 * Build the transient name
		 */
		$transient_name = ( $c_pageID ) ? 'aione_dynamic_css_' . $c_pageID : 'aione_dynamic_css_global';

		/**
		 * Check if the dynamic CSS needs updating
		 * If it does, then calculate the CSS and then update the transient.
		 */
		if ( Aione_Dynamic_CSS::needs_update() ) {
			/**
			 * Get Backgrounds CSS
			 */
			$dynamic_css = get_background_css();
			/**
			 * Calculate the dynamic CSS
			 */
			$dynamic_css .= aione_dynamic_css_parser( aione_dynamic_css_array() );
			/**
			 * Append the user-entered dynamic CSS
			 */
			$dynamic_css .= Aione()->theme_content['custom_css'];
			/**
			* Append the user-entered dynamic CSS Mobile, Tablet, Phablet
			*/
			$dynamic_css .= " @media only screen and (max-width: 768px){ ". Aione()->theme_content['custom_css_phablet']."}";
			$dynamic_css .= " @media only screen and (max-width: 640px){ ". Aione()->theme_content['custom_css_tablet']."}";
			$dynamic_css .= " @media only screen and (max-width: 320px){ ". Aione()->theme_content['custom_css_mobile']."}";
			
			/**
			 * Set the transient for an hour
			 */
			set_transient( $transient_name, $dynamic_css, 60 * 60 );
		} else {
			/**
			 * Check if the transient exists.
			 * If it does not exist, then generate the CSS and update the transient.
			 */
			if ( false === ( $dynamic_css = get_transient( $transient_name ) ) ) {
				/**
				 * Get Backgrounds CSS
				 */
				$dynamic_css = get_background_css();
				/**
				* Calculate the dynamic CSS
				*/
				$dynamic_css .= aione_dynamic_css_parser( aione_dynamic_css_array() );
				/**
				* Append the user-entered dynamic CSS
				*/
				$dynamic_css .= Aione()->theme_content['custom_css'];
				/**
				* Append the user-entered dynamic CSS Mobile, Tablet, Phablet
				*/
				$dynamic_css .= " @media only screen and (max-width: 768px){ ". Aione()->theme_content['custom_css_phablet']."}";
				$dynamic_css .= " @media only screen and (max-width: 640px){ ". Aione()->theme_content['custom_css_tablet']."}";
				$dynamic_css .= " @media only screen and (max-width: 320px){ ". Aione()->theme_content['custom_css_mobile']."}";
				/**
				* Set the transient for an hour
				*/
				set_transient( $transient_name, $dynamic_css, 60 * 60 );
			}
		}

	} else {
		/**
		 * Get Backgrounds CSS
		 */
		$dynamic_css = get_background_css();
		/**
		* Calculate the dynamic CSS
		*/
		$dynamic_css .= aione_dynamic_css_parser( aione_dynamic_css_array() );
		/**
		* Append the user-entered dynamic CSS
		*/
		$dynamic_css .= Aione()->theme_content['custom_css'];
		/**
		* Append the user-entered dynamic CSS Mobile, Tablet, Phablet
		*/
		$dynamic_css .= " @media only screen and (max-width: 768px){ ". Aione()->theme_content['custom_css_phablet']."}";
		$dynamic_css .= " @media only screen and (max-width: 640px){ ". Aione()->theme_content['custom_css_tablet']."}";
		$dynamic_css .= " @media only screen and (max-width: 320px){ ". Aione()->theme_content['custom_css_mobile']."}";
	}

	return $dynamic_css;

}

// Omit closing PHP tag to avoid "Headers already sent" issues.
