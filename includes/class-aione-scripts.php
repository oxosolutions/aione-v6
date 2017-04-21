<?php

class Aione_Scripts {

    /**
     * The class construction
     */
    public function __construct() {

        if ( ! is_admin() && ! in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) ) ) {
        	add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        	add_action( 'script_loader_tag', array( $this, 'add_async' ), 10, 2 );
        }

        add_action( 'admin_head', array( $this, 'admin_css' ) );

    }

    public function enqueue_scripts() {

		global $wp_styles, $woocommerce;

		$theme_info = wp_get_theme();

		wp_enqueue_script( 'jquery', false, array(), $theme_info->get( 'Version' ), true );

        // the comment-reply script
		if ( is_singular() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

        if ( function_exists( 'novagallery_shortcode' ) ) {
			wp_deregister_script( 'novagallery_modernizr' );
		}

		if ( function_exists( 'ccgallery_shortcode' ) ) {
			wp_deregister_script( 'ccgallery_modernizr' );
		}

		if ( ! Aione()->theme_options[ 'status_gmap' ] ) {
			$map_api = 'http' . ( ( is_ssl() ) ? 's' : '' ) . '://maps.googleapis.com/maps/api/js?language=' . substr( get_locale(), 0, 2 );
			wp_register_script( 'google-maps-api', $map_api, array(), $theme_info->get( 'Version' ), false );
			wp_register_script( 'google-maps-infobox', 'http' . ( ( is_ssl() ) ? 's' : '' ) . '://google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/src/infobox_packed.js', array(), $theme_info->get( 'Version' ), false );
		}

		// Fix for WPML + Woocommerce
		// https://gist.github.com/mharis/8555367b1be5c2247a44
		if( class_exists( 'WooCommerce' ) && class_exists( 'SitePress' ) ) {
			wp_deregister_script( 'wc-cart-fragments' );
			wp_register_script( 'wc-cart-fragments', get_template_directory_uri() . '/assets/js/wc-cart-fragments.js', array( 'jquery', 'jquery-cookie' ), $theme_info->get( 'Version' ), true );
		}

		if ( Aione()->theme_options[ 'dev_mode' ] ) {

			$main_js = get_template_directory_uri() . '/assets/js/theme.js';
			wp_deregister_script( 'bootstrap' );
			wp_register_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'bootstrap' );

			wp_deregister_script( 'cssua' );
			wp_register_script( 'cssua', get_template_directory_uri() . '/assets/js/cssua.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'cssua' );

			wp_deregister_script( 'jquery.easyPieChart' );
			wp_register_script( 'jquery.easyPieChart', get_template_directory_uri() . '/assets/js/jquery.easyPieChart.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'jquery.easyPieChart' );

			wp_deregister_script( 'excanvas' );
			wp_register_script( 'excanvas', get_template_directory_uri() . '/assets/js/excanvas.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'excanvas' );

			wp_deregister_script( 'Froogaloop' );
			wp_register_script( 'Froogaloop', get_template_directory_uri() . '/assets/js/Froogaloop.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'Froogaloop' );

			wp_deregister_script( 'imagesLoaded' );
			wp_register_script( 'imagesLoaded', get_template_directory_uri() . '/assets/js/imagesLoaded.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'imagesLoaded' );

			wp_deregister_script( 'jquery.infinitescroll' );
			wp_register_script( 'jquery.infinitescroll', get_template_directory_uri() . '/assets/js/jquery.infinitescroll.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'jquery.infinitescroll' );

			wp_deregister_script( 'isotope' );
			wp_register_script( 'isotope', get_template_directory_uri() . '/assets/js/isotope.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'isotope' );

			wp_deregister_script( 'jquery.appear' );
			wp_register_script( 'jquery.appear', get_template_directory_uri() . '/assets/js/jquery.appear.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'jquery.appear' );

			wp_deregister_script( 'jquery.touchSwipe' );
			wp_register_script( 'jquery.touchSwipe', get_template_directory_uri() . '/assets/js/jquery.touchSwipe.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'jquery.touchSwipe' );

			wp_deregister_script( 'jquery.carouFredSel' );
			wp_register_script( 'jquery.carouFredSel', get_template_directory_uri() . '/assets/js/jquery.carouFredSel.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'jquery.carouFredSel' );

			wp_deregister_script( 'jquery.countTo' );
			wp_register_script( 'jquery.countTo', get_template_directory_uri() . '/assets/js/jquery.countTo.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'jquery.countTo' );

			wp_deregister_script( 'jquery.countdown' );
			wp_register_script( 'jquery.countdown', get_template_directory_uri() . '/assets/js/jquery.countdown.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'jquery.countdown' );

			wp_deregister_script( 'jquery.cycle' );
			wp_register_script( 'jquery.cycle', get_template_directory_uri() . '/assets/js/jquery.cycle.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'jquery.cycle' );

			wp_deregister_script( 'jquery.easing' );
			wp_register_script( 'jquery.easing', get_template_directory_uri() . '/assets/js/jquery.easing.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'jquery.easing' );

			wp_deregister_script( 'jquery.elasticslider' );
			wp_register_script( 'jquery.elasticslider', get_template_directory_uri() . '/assets/js/jquery.elasticslider.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'jquery.elasticslider' );

			wp_deregister_script( 'jquery.fitvids' );
			wp_register_script( 'jquery.fitvids', get_template_directory_uri() . '/assets/js/jquery.fitvids.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'jquery.fitvids' );

			wp_deregister_script( 'jquery.flexslider' );
			wp_register_script( 'jquery.flexslider', get_template_directory_uri() . '/assets/js/jquery.flexslider.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'jquery.flexslider' );

			wp_deregister_script( 'jquery.oxo_maps' );
			wp_register_script( 'jquery.oxo_maps', get_template_directory_uri() . '/assets/js/jquery.oxo_maps.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'jquery.oxo_maps' );

			wp_deregister_script( 'jquery.hoverflow' );
			wp_register_script( 'jquery.hoverflow', get_template_directory_uri() . '/assets/js/jquery.hoverflow.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'jquery.hoverflow' );

			wp_deregister_script( 'jquery.hoverIntent' );
			wp_register_script( 'jquery.hoverIntent', get_template_directory_uri() . '/assets/js/jquery.hoverIntent.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'jquery.hoverIntent' );

			wp_deregister_script( 'jquery.placeholder' );
			wp_register_script( 'jquery.placeholder', get_template_directory_uri() . '/assets/js/jquery.placeholder.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'jquery.placeholder' );

			wp_deregister_script( 'jquery.toTop' );
			wp_register_script( 'jquery.toTop', get_template_directory_uri() . '/assets/js/jquery.toTop.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'jquery.toTop' );

			wp_deregister_script( 'jquery.waypoints' );
			wp_register_script( 'jquery.waypoints', get_template_directory_uri() . '/assets/js/jquery.waypoints.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'jquery.waypoints' );

			wp_deregister_script( 'modernizr' );
			wp_register_script( 'modernizr', get_template_directory_uri() . '/assets/js/modernizr.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'modernizr' );

			wp_deregister_script( 'jquery.requestAnimationFrame' );
			wp_register_script( 'jquery.requestAnimationFrame', get_template_directory_uri() . '/assets/js/jquery.requestAnimationFrame.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'jquery.requestAnimationFrame' );

			wp_deregister_script( 'jquery.mousewheel' );
			wp_register_script( 'jquery.mousewheel', get_template_directory_uri() . '/assets/js/jquery.mousewheel.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'jquery.mousewheel' );

			if ( ! Aione()->theme_options['status_lightbox' ] ) {
				wp_deregister_script( 'ilightbox.packed' );
				wp_register_script( 'ilightbox.packed', get_template_directory_uri() . '/assets/js/ilightbox.js', array(), $theme_info->get( 'Version' ), true );
				wp_enqueue_script( 'ilightbox.packed' );
			}

			wp_deregister_script( 'aione-lightbox' );
			wp_register_script( 'aione-lightbox', get_template_directory_uri() . '/assets/js/aione-lightbox.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'aione-lightbox' );

			wp_deregister_script( 'aione-header' );
			wp_register_script( 'aione-header', get_template_directory_uri() . '/assets/js/aione-header.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'aione-header' );

			wp_deregister_script( 'aione-select' );
			wp_register_script( 'aione-select', get_template_directory_uri() . '/assets/js/aione-select.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'aione-select' );

			wp_deregister_script( 'aione-parallax' );
			wp_register_script( 'aione-parallax', get_template_directory_uri() . '/assets/js/aione-parallax.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'aione-parallax' );

			wp_deregister_script( 'aione-video-bg' );
			wp_register_script( 'aione-video-bg', get_template_directory_uri() . '/assets/js/aione-video-bg.js', array(), $theme_info->get( 'Version' ), true );
			wp_enqueue_script( 'aione-video-bg' );

			if ( class_exists( 'WooCommerce' ) ) {
				wp_dequeue_script('aione-woocommerce');
				wp_register_script( 'aione-woocommerce', get_template_directory_uri() . '/assets/js/aione-woocommerce.js' , array( 'jquery' ), $theme_info->get( 'Version' ), true );
				wp_enqueue_script( 'aione-woocommerce' );
			}
			if ( function_exists( 'is_bbpress' ) && is_bbpress() ) {
				wp_dequeue_script('aione-bbpress');
				wp_register_script( 'aione-bbpress', get_template_directory_uri() . '/assets/js/aione-bbpress.js' , array( 'jquery' ), $theme_info->get( 'Version' ), true );
				wp_enqueue_script( 'aione-bbpress' );
			}

			if ( class_exists( 'Tribe__Events__Main' ) && ( tribe_is_event() || is_events_archive() ) ) {
				wp_dequeue_script('aione-events');
				wp_register_script( 'aione-events', get_template_directory_uri() . '/assets/js/aione-events.js' , array( 'jquery' ), $theme_info->get( 'Version' ), true );
				wp_enqueue_script( 'aione-events' );
			}

			if ( ! Aione()->theme_options[ 'smooth_scrolling' ] ) {
				wp_dequeue_script('jquery.nicescroll');
				wp_register_script( 'jquery.nicescroll', get_template_directory_uri() . '/assets/js/jquery.nicescroll.js' , array( 'jquery' ), $theme_info->get( 'Version' ), true );
				wp_enqueue_script( 'jquery.nicescroll' );

				wp_dequeue_script('aione-nicescroll');
				wp_register_script( 'aione-nicescroll', get_template_directory_uri() . '/assets/js/aione-nicescroll.js' , array( 'jquery' ), $theme_info->get( 'Version' ), true );
				wp_enqueue_script( 'aione-nicescroll' );
			}

		} else {

			$main_js = get_template_directory_uri() . '/assets/js/main.min.js';

		}

		wp_deregister_script( 'aione' );
		wp_register_script( 'aione', $main_js, array(), $theme_info->get( 'Version' ), true );
		wp_enqueue_script( 'aione' );

		$smoothHeight = ( 'auto' == get_post_meta( $this->page_id(), 'pyre_fimg_width', true ) && 'half' == get_post_meta( $this->page_id(), 'pyre_width', true ) ) ? 'true' : 'false';

		if ( get_post_meta( 'auto' == $this->page_id(), 'pyre_fimg_width', true ) && 'half' == get_post_meta( $this->page_id(), 'pyre_width', true ) ) {
			$flex_smoothHeight = 'true';
		} else {
			$flex_smoothHeight = ( Aione()->theme_options[ 'slideshow_smooth_height' ] ) ? 'true' : 'false';
		}

		$db_vars = Aione()->settings->get_all();

		$db_vars['slideshow_autoplay'] = ( ! Aione()->theme_options[ 'slideshow_autoplay' ] ) ? false : true;
		$db_vars['slideshow_speed']    = ( ! Aione()->theme_options[ 'slideshow_speed' ] ) ? 7000 : Aione()->theme_options[ 'slideshow_speed' ];

		$language_code = ( defined( 'ICL_SITEPRESS_VERSION' ) && defined('ICL_LANGUAGE_CODE' ) ) ? ICL_LANGUAGE_CODE : '';

		$current_page_template = get_page_template_slug( $this->page_id() );
		$portfolio_image_size  = aione_get_portfolio_image_size( $this->page_id() );
		$isotope_type          = ( $portfolio_image_size == 'full' ) ? 'masonry' : 'fitRows';

		if( is_archive() ) {

			$portfolio_layout_setting = strtolower( Aione()->theme_options[ 'portfolio_archive_layout' ] );
            $isotope_type = ( Aione()->theme_options[ 'portfolio_featured_image_size' ] == 'full' || strpos( $portfolio_layout_setting, 'grid' ) ) ? 'masonry' : 'fitRows';

		}

        $layout = ( get_post_meta($this->page_id(), 'pyre_page_bg_layout', true) == 'boxed' || get_post_meta($this->page_id(), 'pyre_page_bg_layout', true) == 'wide' ) ? get_post_meta( $this->page_id(), 'pyre_page_bg_layout', true ) : Aione()->theme_content['layout'];

        $aione_rev_styles = ( 'no' == get_post_meta( $this->page_id(), 'pyre_aione_rev_styles', true ) || ( ! Aione()->theme_options[ 'aione_rev_styles' ] && 'yes' != get_post_meta( $this->page_id(), 'pyre_aione_rev_styles', true ) ) ) ? 1 : 0;
		
		$aione_font_option = Aione()->theme_options[ 'typography_body' ];
		
		$local_variables = array(
			'admin_ajax'					=> admin_url( 'admin-ajax.php' ),
			'admin_ajax_nonce'				=> wp_create_nonce( 'aione_admin_ajax' ),
			'protocol'						=> is_ssl(),
			'theme_url' 					=> get_template_directory_uri(),
			'dropdown_goto' 				=> __( 'Go to...', 'Aione' ),
			'mobile_nav_cart' 				=> __( 'Shopping Cart', 'Aione' ),
			'page_smoothHeight' 			=> $smoothHeight,
			'flex_smoothHeight' 			=> $flex_smoothHeight,
			'language_flag' 				=> $language_code,
			'infinite_blog_finished_msg' 	=> '<em>' . __( 'All posts displayed.', 'Aione' ) . '</em>',
			'infinite_finished_msg'			=> '<em>' . __( 'All items displayed.', 'Aione' ) . '</em>',
			'infinite_blog_text' 			=> '<em>' . __( 'Loading the next set of posts...', 'Aione' ) . '</em>',
			'portfolio_loading_text' 		=> '<em>' . __( 'Loading Portfolio Items...', 'Aione' ) . '</em>',
			'faqs_loading_text' 			=> '<em>' . __( 'Loading FAQ Items...', 'Aione' ) . '</em>',
			'order_actions' 				=>  __( 'Details' , 'Aione' ),
			'aione_rev_styles'				=> $aione_rev_styles,
			'aione_styles_dropdowns'		=> Aione()->settings->get( 'aione_styles_dropdowns' ),
			'blog_grid_column_spacing'		=> Aione()->theme_options[ 'blog_grid_column_spacing' ],
			'blog_pagination_type'			=> Aione()->theme_options[ 'blog_pagination_type' ],
			'body_font_size'				=> $aione_font_option['font-size'],
			'carousel_speed'				=> Aione()->settings->get( 'carousel_speed' ),
			'content_break_point'			=> oxo_strip_unit( Aione()->settings->get( 'content_break_point' ) ),			
			'custom_icon_image_retina'		=> Aione()->theme_options[ 'custom_icon_image_retina' ],
			'disable_mobile_animate_css'	=> Aione()->theme_options[ 'disable_mobile_animate_css' ],
			'disable_mobile_image_hovers'	=> Aione()->theme_options[ 'disable_mobile_image_hovers' ],
			'portfolio_pagination_type'		=> Aione()->theme_options[ 'grid_pagination_type' ],
			'form_bg_color'					=> Aione()->settings->get( 'form_bg_color' ),
			'header_transparency'			=> ( ( ( 1 > Aione()->theme_options['header_bg_color'] && ! get_post_meta( $this->page_id(), 'pyre_header_bg_opacity', true ) ) || ( '' != get_post_meta( $this->page_id(), 'pyre_header_bg_opacity', true ) && 1 > get_post_meta( $this->page_id(), 'pyre_header_bg_opacity', true ) ) ) ) ? 1 : 0,
			'header_padding_bottom'			=> Aione()->theme_options[ 'margin_header_bottom' ],
			'header_padding_top'			=> Aione()->theme_options[ 'margin_header_top' ],
			'header_position'				=> Aione()->theme_options[ 'header_position' ],
			'header_sticky'					=> Aione()->theme_options[ 'header_sticky' ],
			'header_sticky_tablet'			=> Aione()->theme_options[ 'header_sticky_tablet' ],
			'header_sticky_mobile'			=> Aione()->theme_options[ 'header_sticky_mobile' ],
			'header_sticky_type2_layout'	=> Aione()->theme_options[ 'header_sticky_type2_layout' ],
			'sticky_header_shrinkage'		=> Aione()->settings->get( 'header_sticky_shrinkage' ),
			'is_responsive' 				=> Aione()->theme_options[ 'responsive' ],
			'is_ssl'						=> is_ssl() ? 'true' : 'false',
			'isotope_type'					=> $isotope_type,
			'layout_mode'					=> strtolower( $layout ),
			'lightbox_animation_speed'		=> Aione()->theme_options[ 'lightbox_animation_speed' ],
			'lightbox_arrows'				=> Aione()->theme_options[ 'lightbox_arrows' ],
			'lightbox_autoplay'				=> Aione()->theme_options[ 'lightbox_autoplay' ],
			'lightbox_behavior'				=> Aione()->theme_options[ 'lightbox_behavior' ],
			'lightbox_desc'					=> Aione()->theme_options[ 'lightbox_desc' ],
			'lightbox_deeplinking'			=> Aione()->theme_options[ 'lightbox_deeplinking' ],
			'lightbox_gallery'				=> Aione()->theme_options[ 'lightbox_gallery' ],
			'lightbox_opacity'				=> Aione()->theme_options[ 'lightbox_opacity' ],
			'lightbox_path'					=> Aione()->theme_options[ 'lightbox_path' ],
			'lightbox_post_images'			=> Aione()->theme_options[ 'lightbox_post_images' ],
			'lightbox_skin'					=> Aione()->theme_options[ 'lightbox_skin' ],
			'lightbox_slideshow_speed'		=> Aione()->theme_options[ 'lightbox_slideshow_speed' ],
			'lightbox_social'				=> Aione()->theme_options[ 'lightbox_social' ],
			'lightbox_title'				=> Aione()->theme_options[ 'lightbox_title' ],
			'lightbox_video_height'			=> oxo_strip_unit( Aione()->theme_options[ 'lightbox_video_height' ] ),
			'lightbox_video_width'			=> oxo_strip_unit( Aione()->theme_options[ 'lightbox_video_width' ] ),
			'logo_alignment'				=> Aione()->theme_options[ 'logo_alignment' ],
			'logo_margin_bottom'			=> Aione()->settings->get( 'margin_logo_bottom' ),
			'logo_margin_top'				=> Aione()->settings->get( 'margin_logo_top' ),
			'megamenu_max_width'			=> Aione()->settings->get( 'megamenu_max_width' ),
			'mobile_menu_design'			=> Aione()->theme_options[ 'mobile_menu_design' ],
			'nav_height'					=> Aione()->theme_options[ 'nav_height' ],
			'nav_highlight_border'			=> ( Aione()->settings->get( 'nav_highlight_border' ) ) ? Aione()->settings->get( 'nav_highlight_border' ) : '0',
			'page_title_fading'				=> Aione()->theme_options[ 'page_title_fading' ],
			'pagination_video_slide'		=> Aione()->theme_options[ 'pagination_video_slide' ],
			'related_posts_speed'			=> Aione()->theme_options[ 'related_posts_speed' ],
			'retina_icon_height'			=> Aione()->theme_options[ 'retina_icon_height' ],
			'retina_icon_width'				=> Aione()->theme_options[ 'retina_icon_width' ],
			'submenu_slideout'				=> Aione()->settings->get( 'mobile_nav_submenu_slideout' ),
			'side_header_break_point'		=> oxo_strip_unit( Aione()->settings->get( 'side_header_break_point' ) ),
			'sidenav_behavior'				=> Aione()->theme_options[ 'sidenav_behavior' ],
			'site_width'					=> Aione()->theme_content['site_width'],
			'slider_position'				=> ( get_post_meta( $this->page_id(), 'pyre_slider_position', true ) && get_post_meta( $this->page_id(), 'pyre_slider_position', true ) != 'default' ) ? get_post_meta( $this->page_id(), 'pyre_slider_position', true ) : strtolower( Aione()->theme_options[ 'slider_position' ] ),
			'slideshow_autoplay'			=> Aione()->theme_options[ 'slideshow_autoplay' ],
			'slideshow_speed'				=> Aione()->theme_options[ 'slideshow_speed' ],
			'smooth_scrolling'				=> Aione()->theme_options[ 'smooth_scrolling' ],
			'status_lightbox'				=> Aione()->theme_options[ 'status_lightbox' ],
			'status_totop_mobile'			=> Aione()->theme_options[ 'status_totop_mobile' ],
			'status_vimeo'					=> Aione()->theme_options[ 'status_vimeo' ],
			'status_yt'						=> Aione()->theme_options[ 'status_yt' ],
			'submenu_slideout' 				=> Aione()->settings->get( 'mobile_nav_submenu_slideout' ),
			'testimonials_speed' 			=> Aione()->settings->get( 'testimonials_speed' ),
			'tfes_animation' 				=> Aione()->theme_options[ 'tfes_animation' ],
			'tfes_autoplay' 				=> Aione()->theme_options[ 'tfes_autoplay' ],
			'tfes_interval' 				=> Aione()->theme_options[ 'tfes_interval' ],
			'tfes_speed' 					=> Aione()->theme_options[ 'tfes_speed' ],
			'tfes_width' 					=> Aione()->theme_options[ 'tfes_width' ],
			'title_style_type'				=> Aione()->settings->get( 'title_style_type' ),
			'typography_responsive'			=> Aione()->settings->get( 'typography_responsive' ),
			'typography_sensitivity'		=> Aione()->settings->get( 'typography_sensitivity' ),
			'typography_factor'				=> Aione()->settings->get( 'typography_factor' ),
			'woocommerce_shop_page_columns'	=> Aione()->theme_options[ 'woocommerce_shop_page_columns' ]
		);

		if ( class_exists( 'WooCommerce' ) ) {
			if ( version_compare( $woocommerce->version, '2.3', '>=' ) ) {
				$local_variables['woocommerce_23'] = true;
			}
		}

		$local_variables['side_header_width'] = ( 'top' != Aione()->theme_options[ 'header_position' ] ) ? str_replace( 'px', '', Aione()->theme_options[ 'side_header_width' ] ) : '0';

		wp_localize_script( 'aione', 'js_local_vars', $local_variables );

        $header_demo = ( is_page( 'header-2' ) || is_page( 'header-3' ) || is_page( 'header-4' ) || is_page( 'header-5' ) ) ? true : false;

		if ( 'None' != Aione()->settings->get( 'google_body' ) && Aione()->settings->get( 'google_body' ) ) {
			$gfont[urlencode( Aione()->settings->get( 'google_body' ) )] = urlencode( Aione()->settings->get( 'google_body' ) );
		}

		if ( 'None' != Aione()->settings->get( 'google_nav' ) && Aione()->settings->get( 'google_nav' ) && Aione()->settings->get( 'google_nav' ) != Aione()->settings->get( 'google_body' ) ) {
			$gfont[urlencode( Aione()->settings->get( 'google_nav' ) )] = urlencode( Aione()->settings->get( 'google_nav' ) );
		}

		if ( 'None' != Aione()->settings->get( 'google_headings' ) && Aione()->settings->get( 'google_headings' ) && Aione()->settings->get( 'google_headings' ) != Aione()->settings->get( 'google_body' ) && Aione()->settings->get( 'google_headings' ) != Aione()->settings->get( 'google_nav' ) ) {
			$gfont[urlencode( Aione()->settings->get( 'google_headings' ) )] = urlencode( Aione()->settings->get( 'google_headings' ) );
		}

		if ( 'None' != Aione()->settings->get( 'google_footer_headings' ) && Aione()->settings->get( 'google_footer_headings' ) && Aione()->settings->get( 'google_footer_headings' ) != Aione()->settings->get( 'google_body' ) && Aione()->settings->get( 'google_footer_headings' ) != Aione()->settings->get( 'google_nav' ) && Aione()->settings->get( 'google_footer_headings' ) != Aione()->settings->get( 'google_headings' ) ) {
			$gfont[urlencode( Aione()->settings->get( 'google_footer_headings' ) )] = urlencode( Aione()->settings->get( 'google_footer_headings' ) );
		}

		if ( 'None' != Aione()->settings->get( 'google_footer_headings' ) && Aione()->settings->get( 'google_footer_headings' ) && Aione()->settings->get( 'google_footer_headings' ) != Aione()->settings->get( 'google_body' ) && Aione()->settings->get( 'google_footer_headings' ) != Aione()->settings->get( 'google_nav' ) && Aione()->settings->get( 'google_footer_headings' ) != Aione()->settings->get( 'google_headings' ) ) {
			$gfont[urlencode( Aione()->settings->get( 'google_footer_headings' ) )] = urlencode( Aione()->settings->get( 'google_footer_headings' ) );
		}

		if ( 'None' != Aione()->settings->get( 'google_button' ) && Aione()->settings->get( 'google_button' ) && Aione()->settings->get( 'google_button' ) != Aione()->settings->get( 'google_body' ) && Aione()->settings->get( 'google_button' ) != Aione()->settings->get( 'google_nav' ) && Aione()->settings->get( 'google_button' ) != Aione()->settings->get( 'google_headings' ) && Aione()->settings->get( 'google_button' ) != Aione()->settings->get( 'google_footer_headings' ) ) {
			$gfont[ urlencode( Aione()->settings->get( 'google_button' ) ) ] = urlencode( Aione()->settings->get( 'google_button' ) );
		}

		if ( isset( $gfont ) && $gfont ) {

			$font_families = '';
			$font_settings = explode( '&', Aione()->settings->get( 'gfont_settings' ) );
			$font_styles   = $font_subsets = '';

			if ( is_array( $font_settings ) ) {
				$font_styles = $font_settings[0];

				if ( 1 < count( $font_settings ) ) {
					$font_subsets = $font_settings[1];
				}
			}
			foreach( $gfont as $g_font ) {
				$font_families .= sprintf( '%s:%s|', $g_font, urlencode( $font_styles ) );
			}

			$font_families = ( $font_subsets ) ? sprintf( '%s&%s', rtrim( $font_families, '|' ), $font_subsets ) : $font_families = rtrim( $font_families, '|' );

			wp_enqueue_style( 'aione-google-fonts', 'http' . ( ( is_ssl() ) ? 's' : '' ) . '://fonts.googleapis.com/css?family=' . $font_families, array(), '' );

		}

		wp_enqueue_style( 'aione-stylesheet', get_stylesheet_uri(), array(), $theme_info->get( 'Version' ) );

		wp_enqueue_style( 'aione-shortcodes', get_template_directory_uri() . '/shortcodes.css', array(), $theme_info->get( 'Version' ) );
		$wp_styles->add_data( 'aione-shortcodes', 'conditional', 'lte IE 9' );

		if ( ! Aione()->theme_options[ 'status_fontawesome' ] ) {
			wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/fonts/fontawesome/font-awesome.css', array(), $theme_info->get( 'Version' ) );
			wp_enqueue_style( 'aione-IE-fontawesome', get_template_directory_uri() . '/assets/fonts/fontawesome/font-awesome.css', array(), $theme_info->get( 'Version' ) );
			$wp_styles->add_data( 'aione-IE-fontawesome', 'conditional', 'lte IE 9' );
		}

		wp_enqueue_style( 'aione-IE8', get_template_directory_uri() . '/assets/css/ie8.css', array(), $theme_info->get( 'Version' ) );
		$wp_styles->add_data( 'aione-IE8', 'conditional', 'lte IE 8' );

		wp_enqueue_style( 'aione-IE', get_template_directory_uri() . '/assets/css/ie.css', array(), $theme_info->get( 'Version' ) );
		$wp_styles->add_data( 'aione-IE', 'conditional', 'IE' );

		wp_deregister_style( 'woocommerce-layout' );
		wp_deregister_style( 'woocommerce-smallscreen' );
		wp_deregister_style( 'woocommerce-general' );

		if ( ! Aione()->theme_options[ 'status_lightbox' ] ) {
			wp_enqueue_style( 'aione-iLightbox', get_template_directory_uri() . '/ilightbox.css', array(), $theme_info->get( 'Version' ) );
		}

		if ( ! Aione()->theme_options[ 'use_animate_css' ] ) {
			wp_enqueue_style( 'aione-animations', get_template_directory_uri() . '/animations.css', array(), $theme_info->get( 'Version' ) );
		}

		if ( class_exists( 'WooCommerce' ) ) {
			wp_enqueue_style( 'aione-woocommerce', get_template_directory_uri() . '/assets/css/woocommerce.css', array(), $theme_info->get( 'Version' ) );
		}

		if ( class_exists( 'bbPress' ) ) {
			wp_enqueue_style( 'aione-bbpress', get_template_directory_uri() . '/assets/css/bbpress.css', array(), $theme_info->get( 'Version' ) );
		}

		if ( ! Aione()->theme_options[ 'status_lightbox' ] && class_exists( 'WooCommerce' ) ) {
			wp_dequeue_script( 'prettyPhoto' );
			wp_dequeue_script( 'prettyPhoto-init' );
			wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
		}

		if ( is_rtl() ) {
			wp_enqueue_style( 'aione-rtl', get_template_directory_uri() . '/assets/css/rtl.css', array(), $theme_info->get( 'Version' ) );
		}

    }

    /**
     * Add admin CSS
     */
    public function admin_css() {

        $theme_info = wp_get_theme();
        echo '<link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/framework/assets/css/admin_css.css?vesion=' . $theme_info->get( 'Version' ) . '">';
        echo '<style type="text/css">.widget input { border-color: #DFDFDF !important; }</style>';

    }

    /**
     * Get the current page ID
     */
    public function page_id() {

        $id = get_queried_object_id();

        if ( ( get_option( 'show_on_front' ) && get_option( 'page_for_posts' ) && is_home()) || ( get_option( 'page_for_posts' ) && is_archive() && ! is_post_type_archive() ) ) {
            $id = get_option('page_for_posts');
        } elseif ( class_exists( 'WooCommerce' ) && ( is_shop() || is_tax( 'product_cat' ) || is_tax( 'product_tag' ) ) ) {
            $id = get_option( 'woocommerce_shop_page_id' );
		}

        return $id;

    }

    /**
     * Add async to aione javascript file for performance
     */
    function add_async( $tag, $handle ) {
		if( $handle == 'aione' ) {
			return preg_replace( "/(><\/[a-zA-Z][^0-9](.*)>)$/", " async $1 ", $tag );
		} else {
			return $tag;
		}
    }

}

// Omit closing PHP tag to avoid "Headers already sent" issues.
