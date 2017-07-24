<!DOCTYPE html>
<?php global $woocommerce; 
$c_pageID = Aione::c_pageID();
?>
<html class="<?php echo ( ! Aione()->theme_options[ 'smooth_scrolling' ] ) ? 'no-overflow-y' : ''; ?>" <?php language_attributes(); ?>>
<head>
	<?php if ( isset( $_SERVER['HTTP_USER_AGENT'] ) && ( false !== strpos( $_SERVER['HTTP_USER_AGENT'], 'MSIE' ) ) ) : ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<?php endif; ?>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>


	<!--[if lte IE 8]>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/html5shiv.js"></script>
	<![endif]-->

	<?php $isiPad = (bool) strpos( $_SERVER['HTTP_USER_AGENT'],'iPad' ); ?>

	<?php
	$viewport = '';
	if ( Aione()->theme_options[ 'responsive' ] && $isiPad ) {
		$viewport = '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />';
	} else if( Aione()->theme_options[ 'responsive' ] ) {
		if ( Aione()->theme_options[ 'mobile_zoom' ] ) {
			$viewport .= '<meta name="viewport" content="width=device-width, initial-scale=1" />';
		} else {
			$viewport .= '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />';
		}
	}
	
	if(get_post_meta( $c_pageID, 'pyre_meta_description', true ) != '' && get_post_meta( $c_pageID, 'pyre_meta_description', true ) != false){
		$pyre_meta_description = get_post_meta( $c_pageID, 'pyre_meta_description', true );
		$viewport .= '<meta name="description" content="'.$pyre_meta_description.'">';
	}
	if(get_post_meta( $c_pageID, 'pyre_meta_keywords', true ) != '' &&get_post_meta( $c_pageID, 'pyre_meta_keywords', true ) != false){
		$pyre_meta_keywords = get_post_meta( $c_pageID, 'pyre_meta_keywords', true );
		$viewport .= '<meta name="keywords" content="'.$pyre_meta_keywords.'">';
	}

	$viewport = apply_filters( 'aione_viewport_meta', $viewport );
	echo $viewport;
	?>

	<?php if ( !empty(Aione()->theme_options[ 'favicon' ] )) : ?>
		<link rel="shortcut icon" href="<?php echo Aione()->theme_options[ 'favicon' ]['url']; ?>" type="image/x-icon" />
	<?php endif; ?>

	<?php if ( !empty(Aione()->theme_options[ 'iphone_icon' ] )) : ?>
		<!-- For iPhone -->
		<link rel="apple-touch-icon-precomposed" href="<?php echo Aione()->theme_options[ 'iphone_icon' ]['url']; ?>">
	<?php endif; ?>

	<?php if ( !empty(Aione()->theme_options[ 'iphone_icon_retina' ] )) : ?>
		<!-- For iPhone 4 Retina display -->
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo Aione()->theme_options[ 'iphone_icon_retina' ]['url']; ?>">
	<?php endif; ?>

	<?php if ( !empty(Aione()->theme_options[ 'ipad_icon' ]['url'] )) : ?>
		<!-- For iPad -->
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo Aione()->theme_options[ 'ipad_icon' ]['url']; ?>">
	<?php endif; ?>

	<?php if ( !empty(Aione()->theme_options[ 'ipad_icon_retina' ] )) : ?>
		<!-- For iPad Retina display -->
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo Aione()->theme_options[ 'ipad_icon_retina' ]['url']; ?>">
	<?php endif; ?>
	

	<?php wp_head(); ?>

	<?php

	$object_id = get_queried_object_id();
	$c_pageID  = Aione::c_pageID();
	?>

	<!--[if lte IE 8]>
	<script type="text/javascript">
	jQuery(document).ready(function() {
	var imgs, i, w;
	var imgs = document.getElementsByTagName( 'img' );
	for( i = 0; i < imgs.length; i++ ) {
		w = imgs[i].getAttribute( 'width' );
		imgs[i].removeAttribute( 'width' );
		imgs[i].removeAttribute( 'height' );
	}
	});
	</script>

	<script src="<?php //echo get_template_directory_uri(); ?>/assets/js/excanvas.js"></script>

	<![endif]-->

	<!--[if lte IE 9]>
	<script type="text/javascript">
	jQuery(document).ready(function() {

	// Combine inline styles for body tag
	jQuery('body').each( function() {
		var combined_styles = '<style type="text/css">';

		jQuery( this ).find( 'style' ).each( function() {
			combined_styles += jQuery(this).html();
			jQuery(this).remove();
		});

		combined_styles += '</style>';

		jQuery( this ).prepend( combined_styles );
	});
	});
	</script>

	<![endif]-->

	<script type="text/javascript">
		var doc = document.documentElement;
		doc.setAttribute('data-useragent', navigator.userAgent);
	</script>

	<?php //echo Aione()->settings->get( 'google_analytics' ); 
		echo Aione()->theme_content['google_analytics'];
	?>

	<?php //echo Aione()->settings->get( 'space_head' );
		echo Aione()->theme_content['space_head'];
	?>
</head>
<?php
$wrapper_class = '';


if ( is_page_template( 'blank.php' ) ) {
	$wrapper_class  = 'wrapper_blank';
}

if ( 'modern' == Aione()->theme_options[ 'mobile_menu_design' ] ) {
	$mobile_logo_pos = strtolower( Aione()->theme_options[ 'logo_alignment' ] );
	if ( 'center' == strtolower( Aione()->theme_options[ 'logo_alignment' ] ) ) {
		$mobile_logo_pos = 'left';
	}
}

?>
<body <?php body_class(); ?>>
	<?php do_action( 'aione_before_body_content' ); ?>
	<?php $boxed_side_header_right = false; ?>
	<?php if ( ( ( 'Boxed' == Aione()->theme_options['layout'] && ( 'default' == get_post_meta( $c_pageID, 'pyre_page_bg_layout', true ) || '' == get_post_meta( $c_pageID, 'pyre_page_bg_layout', true ) ) ) || 'boxed' == get_post_meta( $c_pageID, 'pyre_page_bg_layout', true ) ) && 'top' != Aione()->theme_options['header_position'] ) : ?>
		<?php if ( Aione()->theme_options[ 'slidingbar_widgets' ] && ! is_page_template( 'blank.php' ) && ( 'right' == Aione()->theme_options['header_position'] || 'left' == Aione()->theme_options['header_position'] ) ) : ?>
			<?php get_template_part( 'slidingbar' ); ?>
			<?php $boxed_side_header_right = true; ?>
		<?php endif; ?>
		<div id="boxed-wrapper">
	<?php endif; ?>
	<div id="wrapper" class="<?php echo $wrapper_class; ?>">
		<div id="home" style="position:relative;top:1px;"></div>
		<?php if ( Aione()->theme_options[ 'slidingbar_widgets' ] && ! is_page_template( 'blank.php' ) && ! $boxed_side_header_right ) : ?>
			<?php get_template_part( 'slidingbar' ); ?>
		<?php endif; ?>
		<?php if ( false !== strpos( Aione()->theme_options[ 'footer_special_effects' ], 'footer_sticky' ) ) : ?>
			<div class="above-footer-wrapper">
		<?php endif; ?>

		<?php aione_header_template( 'Below' ); ?>
		<?php if ( 'left' == Aione()->theme_options[ 'header_position' ] || 'right' == Aione()->theme_options[ 'header_position' ] ) : ?>
			<?php aione_side_header(); ?>
		<?php endif; ?>

		<div id="sliders-container">
			<?php
			if ( is_search() ) {
				$slider_page_id = '';
			} else {
				$slider_page_id = '';
				if ( ! is_home() && ! is_front_page() && ! is_archive() && isset( $object_id ) ) {
					$slider_page_id = $object_id;
				}
				if ( ! is_home() && is_front_page() && isset( $object_id ) ) {
					$slider_page_id = $object_id;
				}
				if ( is_home() && ! is_front_page() ) {
					$slider_page_id = get_option( 'page_for_posts' );
				}
				if ( class_exists( 'WooCommerce' ) && is_shop() ) {
					$slider_page_id = get_option( 'woocommerce_shop_page_id' );
				}
				
				if ( ( get_post_status( $slider_page_id ) == 'publish' && ! post_password_required() ) || 
					 ( get_post_status( $slider_page_id ) == 'private' && current_user_can( 'read_private_pages' ) ) 
				) {				
					aione_slider( $slider_page_id );
				}
			} ?>
		</div>
		<?php if ( get_post_meta( $slider_page_id, 'pyre_fallback', true ) ) : ?>
			<div id="fallback-slide">
				<img src="<?php echo get_post_meta( $slider_page_id, 'pyre_fallback', true ); ?>" alt="" />
			</div>
		<?php endif; ?>
		<?php aione_header_template( 'Above' ); ?>

		<?php if ( has_action( 'aione_override_current_page_title_bar' ) ) : ?>
			<?php do_action( 'aione_override_current_page_title_bar', $c_pageID ); ?>
		<?php else : ?>
			<?php aione_current_page_title_bar( $c_pageID ); ?>
		<?php endif; ?>

		<?php if ( is_page_template( 'contact.php' ) && Aione()->theme_options[ 'recaptcha_public' ] && Aione()->theme_options[ 'recaptcha_private' ] ) : ?>
			<script type="text/javascript">var RecaptchaOptions = { theme : '<?php echo Aione()->theme_options[ 'recaptcha_color_scheme' ]; ?>' };</script>
		<?php endif; ?>

		<?php if ( is_page_template( 'contact.php' ) && Aione()->theme_options[ 'gmap_address' ] && ! Aione()->theme_options[ 'status_gmap' ] ) : ?>
			<?php
			$map_popup             = ( ! Aione()->theme_options[ 'map_popup' ] )        ? 'yes' : 'no';
			$map_scrollwheel       = ( ! Aione()->theme_options[ 'map_scrollwheel' ] )  ? 'yes' : 'no';
			$map_scale             = ( ! Aione()->theme_options[ 'map_scale' ] )        ? 'yes' : 'no';
			$map_zoomcontrol       = ( ! Aione()->theme_options[ 'map_zoomcontrol' ] )  ? 'yes' : 'no';
			$address_pin           = ( ! Aione()->theme_options[ 'map_pin' ] )          ? 'yes' : 'no';
			$address_pin_animation = ( Aione()->settings->get( 'gmap_pin_animation' ) ) ? 'yes' : 'no';
			?>
			<div id="oxo-gmap-container">
				<?php echo Aione()->google_map->render_map( array( 'address' => Aione()->theme_options[ 'gmap_address' ], 'type' => Aione()->theme_options[ 'gmap_type' ], 'address_pin' => $address_pin, 'animation' => $address_pin_animation, 'map_style' => Aione()->theme_options[ 'map_styling' ], 'overlay_color' => Aione()->theme_options[ 'map_overlay_color' ], 'infobox' => Aione()->theme_options[ 'map_infobox_styling' ], 'infobox_background_color' => Aione()->theme_options[ 'map_infobox_bg_color' ], 'infobox_text_color' => Aione()->theme_options[ 'map_infobox_text_color' ], 'infobox_content' => htmlentities( Aione()->theme_options[ 'map_infobox_content' ] ), 'icon' => Aione()->theme_options[ 'map_custom_marker_icon' ], 'width' => Aione()->theme_options[ 'gmap_width' ], 'height' => Aione()->theme_options[ 'gmap_height' ], 'zoom' => Aione()->theme_options[ 'map_zoom_level' ], 'scrollwheel' => $map_scrollwheel, 'scale' => $map_scale, 'zoom_pancontrol' => $map_zoomcontrol, '"popup' => $map_popup ) ); ?>
			</div>
		<?php endif; ?>

		<?php if ( is_page_template( 'contact-2.php' ) && Aione()->theme_options[ 'gmap_address' ] && ! Aione()->theme_options[ 'status_gmap' ] ) : ?>
			<?php
			$map_popup             = ( Aione()->theme_options[ 'map_popup' ] )          ? 'yes' : 'no';
			$map_scrollwheel       = ( ! Aione()->theme_options[ 'map_scrollwheel' ] )  ? 'yes' : 'no';
			$map_scale             = ( ! Aione()->theme_options[ 'map_scale' ] )        ? 'yes' : 'no';
			$map_zoomcontrol       = ( ! Aione()->theme_options[ 'map_zoomcontrol' ] )  ? 'yes' : 'no';
			$address_pin_animation = ( Aione()->settings->get( 'gmap_pin_animation' ) ) ? 'yes' : 'no';
			?>
			<div id="oxo-gmap-container">
				<?php echo Aione()->google_map->render_map( array( 'address' => Aione()->theme_options[ 'gmap_address' ], 'type' => Aione()->theme_options[ 'gmap_type' ], 'map_style' => Aione()->theme_options[ 'map_styling' ], 'animation' => $address_pin_animation, 'overlay_color' => Aione()->theme_options[ 'map_overlay_color' ], 'infobox' => Aione()->theme_options[ 'map_infobox_styling' ], 'infobox_background_color' => Aione()->theme_options[ 'map_infobox_bg_color' ], 'infobox_text_color' => Aione()->theme_options[ 'map_infobox_text_color' ], 'infobox_content' => htmlentities( Aione()->theme_options[ 'map_infobox_content' ] ), 'icon' => Aione()->theme_options[ 'map_custom_marker_icon' ], 'width' => Aione()->theme_options[ 'gmap_width' ], 'height' => Aione()->theme_options[ 'gmap_height' ], 'zoom' => Aione()->theme_options[ 'map_zoom_level' ], 'scrollwheel' => $map_scrollwheel, 'scale' => $map_scale, 'zoom_pancontrol' => $map_zoomcontrol, '"popup' => $map_popup ) ); ?>
			</div>
		<?php endif; ?>
		<?php
		$main_css      = '';
		$row_css       = '';
		$main_class    = '';
		$page_template = '';

		if ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
			$custom_fields = get_post_custom_values( '_wp_page_template', $c_pageID );
			$page_template = ( is_array( $custom_fields ) && ! empty( $custom_fields ) ) ? $custom_fields[0] : '';
		}

		if ( get_post_type( $c_pageID ) == 'tribe_events' && tribe_get_option( 'tribeEventsTemplate', 'default' ) == '100-width.php' ) {
			$page_template = '100-width.php';
		}

		if (
			is_page_template( '100-width.php' ) ||
			is_page_template( 'blank.php' ) ||
			'100-width.php' == $page_template ||
			( ( '1' == oxo_get_option( 'portfolio_width_100', 'portfolio_width_100', $c_pageID ) || 'yes' == oxo_get_option( 'portfolio_width_100', 'portfolio_width_100', $c_pageID ) ) && ( 'aione_portfolio' == get_post_type( $c_pageID ) ) ) ||
			( ( '1' == oxo_get_option( 'blog_width_100', 'portfolio_width_100', $c_pageID ) || 'yes' == oxo_get_option( 'blog_width_100', 'portfolio_width_100', $c_pageID ) ) && ( 'post' == get_post_type( $c_pageID ) ) ) ||
			( 'yes' == oxo_get_page_option( 'portfolio_width_100', $c_pageID ) && ( 'post' != get_post_type( $c_pageID ) && 'aione_portfolio' != get_post_type( $c_pageID ) ) ) ||
			( aione_is_portfolio_template() && 'yes' == get_post_meta( $c_pageID, 'pyre_portfolio_width_100', true ) )
		) {
			$main_css = 'padding-left:0px;padding-right:0px;';
			if ( Aione()->settings->get( 'hundredp_padding' ) && ! get_post_meta( $c_pageID, 'pyre_hundredp_padding', true ) ) {
				$main_css = 'padding-left:' . Aione()->settings->get( 'hundredp_padding' ) . ';padding-right:' . Aione()->settings->get( 'hundredp_padding' );
			}
			if ( get_post_meta( $c_pageID, 'pyre_hundredp_padding', true ) ) {
				$main_css = 'padding-left:' . get_post_meta( $c_pageID, 'pyre_hundredp_padding', true ) . ';padding-right:' . get_post_meta( $c_pageID, 'pyre_hundredp_padding', true );
			}
			$row_css    = 'max-width:100%;';
			$main_class = 'width-100';
		}
		do_action( 'aione_before_main_container' );
		?>
		
		<?php 
		$show_pagetop_content = Aione()->theme_content['show_pagetop_content'];
		$pagetop_content = Aione()->theme_content['pagetop_content'];
		
		if( get_post_meta( $post->ID, 'pyre_show_pagetop_content', true ) == 'no' ){
			$show_pagetop_content = 1;
		}
		if( get_post_meta( $post->ID, 'pyre_show_pagetop_content', true ) == 'yes' ){
			$show_pagetop_content = 0;
		}
		?>
		<?php if($show_pagetop_content){ ?>
			
				<?php if($pagetop_content){ ?>
					<!-- content above main container -->
					<div class="pagetop-content">
						<?php echo do_shortcode($pagetop_content); ?>
					</div>
					<!-- end of content main container -->
				<?php } ?>
			
		<?php } ?>
			
		<div id="main" class="clearfix <?php echo $main_class; ?>" style="<?php echo $main_css; ?>">
			<div class="oxo-row" style="<?php echo $row_css; ?>">
