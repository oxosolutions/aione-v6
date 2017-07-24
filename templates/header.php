<?php

if ( ! function_exists( 'aione_header_template' ) ) {
	/**
	 * Aione Header Template Function
	 * @param  string $slider_position Show header below or above slider
	 * @return void
	 */
	function aione_header_template( $slider_position = 'Below' ) {

		$page_id = get_queried_object_id();

		$reverse_position = ( 'Below' == $slider_position ) ? 'Above' : 'Below';

		$menu_text_align = '';

		$theme_option_slider_position = Aione()->theme_options[ 'slider_position' ];
		$page_option_slider_position  = oxo_get_page_option( 'slider_position', $page_id );

		if ( ( ! $theme_option_slider_position || ( $theme_option_slider_position == $slider_position && $page_option_slider_position != strtolower( $reverse_position ) ) || ( $theme_option_slider_position != $slider_position && $page_option_slider_position == strtolower( $slider_position ) ) ) && ! is_page_template( 'blank.php' ) && oxo_get_page_option( 'display_header', $page_id ) != 'no' && Aione()->theme_options [ 'header_position' ] == 'top' ) {
			$header_wrapper_class  = 'oxo-header-wrapper';
			//$header_wrapper_class .= ( Aione()->theme_options[ 'header_sticky' ] ) ? ' oxo-is-sticky' : '';
			$header_wrapper_class .= ( Aione()->settings->get( 'header_shadow' ) ) ? ' oxo-header-shadow' : '';
			$header_wrapper_class  = 'class="' . $header_wrapper_class . '"';
			//$header_wrapper_class  = sprintf( 'class="%s"', $header_wrapper_class );

			/**
			 * aione_before_header_wrapper hook
			 */
			do_action( 'aione_before_header_wrapper' );

			$sticky_header_logo = ( Aione()->theme_options[ 'sticky_header_logo' ] ) ? true : false;
			$mobile_logo        = ( Aione()->theme_options[ 'mobile_logo' ] ) ? true : false;

			$sticky_header_type2_layout = '';

			if ( in_array( Aione()->theme_options[ 'header_layout' ], array( 'v4', 'v5' ) ) ) {
				$sticky_header_type2_layout = ( 'menu_and_logo' == Aione()->theme_options[ 'header_sticky_type2_layout' ] ) ? ' oxo-sticky-menu-and-logo' : ' oxo-sticky-menu-only';
				$menu_text_align = 'oxo-header-menu-align-' . Aione()->theme_options[ 'menu_text_align' ];
			}
			?>
			<div <?php echo $header_wrapper_class; ?>>
				<div class="<?php echo sprintf( 'oxo-header-%s oxo-logo-%s oxo-sticky-menu-%s oxo-sticky-logo-%s oxo-mobile-logo-%s oxo-mobile-menu-design-%s%s %s', Aione()->theme_options[ 'header_layout' ], strtolower( Aione()->theme_options[ 'logo_alignment' ] ), has_nav_menu( 'sticky_navigation' ), $sticky_header_logo, $mobile_logo, strtolower( Aione()->theme_options[ 'mobile_menu_design' ] ), $sticky_header_type2_layout, $menu_text_align ); ?>">
					<?php
					/**
					 * aione_header hook
					 * @hooked aione_secondary_header - 10
					 * @hooked aione_header_1 - 20 (adds header content for header v1-v3)
					 * @hooked aione_header_2 - 20 (adds header content for header v4-v5)
					 */
					do_action( 'aione_header' );
				
					?>
				</div>
				<div class="oxo-clearfix"></div>
			</div>
			<?php
			/**
			 * aione_after_header_wrapper hook
			 */
			do_action( 'aione_after_header_wrapper' );
		}
	}
}

if ( ! function_exists( 'aione_side_header' ) ) {
	/**
	 * Aione Side Header Template Function
	 * @return void
	 */
	function aione_side_header() {
		$queried_object_id = get_queried_object_id();

		if ( ! is_page_template( 'blank.php' ) && 'no' != get_post_meta( $queried_object_id, 'pyre_display_header', true ) ) : ?>

			<?php
			/**
			 * aione_before_header_wrapper hook
			 */
			do_action( 'aione_before_header_wrapper' );

			$sticky_header_logo = ( Aione()->theme_options[ 'sticky_header_logo' ] ) ? true : false;
			$mobile_logo        = ( Aione()->theme_options[ 'mobile_logo' ] ) ? true : false;
			?>
			<div id="side-header-sticky"></div>
			<div id="side-header" class="clearfix oxo-mobile-menu-design-<?php echo strtolower( Aione()->theme_options[ 'mobile_menu_design' ] ); ?> oxo-sticky-logo-<?php echo $sticky_header_logo; ?> oxo-mobile-logo-<?php echo $mobile_logo; ?> oxo-sticky-menu-<?php echo has_nav_menu( 'sticky_navigation' ); ?><?php echo ( Aione()->settings->get( 'header_shadow' ) ) ? ' header-shadow' : ''; ?>">
				<div class="side-header-wrapper">
					<?php
					/**
					 * aione_header_inner_before
					 */
					do_action( 'aione_header_inner_before' );
					?>
					<?php $mobile_logo = ( Aione()->theme_options[ 'mobile_logo' ] ) ? true : false; ?>
					<div class="side-header-content oxo-logo-<?php echo strtolower( Aione()->theme_options[ 'logo_alignment' ] ); ?> oxo-mobile-logo-<?php echo $mobile_logo; ?>">
						<?php aione_logo(); ?>
					</div>
					
					<div class="oxo-main-menu-container oxo-logo-menu-<?php echo strtolower( Aione()->theme_options[ 'logo_alignment' ] ); ?>">
						<?php aione_main_menu(); ?>
					</div>

					<?php if ( 'Tagline And Search' == Aione()->theme_options[ 'header_v4_content' ] || 'Search' == Aione()->theme_options[ 'header_v4_content' ] ) : ?>
						<div class="oxo-secondary-menu-search">
							<div class="oxo-secondary-menu-search-inner"><?php get_search_form(); ?></div>
						</div>
					<?php endif; ?>

					<?php if ( 'Leave Empty' != Aione()->settings->get( 'header_left_content' ) || 'Leave Empty' != Aione()->settings->get( 'header_right_content' ) ) : ?>
						<?php $content_1 = aione_secondary_header_content( 'header_left_content' ); ?>
						<?php $content_2 = aione_secondary_header_content( 'header_right_content' ); ?>

						<div class="side-header-content side-header-content-1-2">
							<?php if ( $content_1 ) : ?>
								<div class="side-header-content-1 oxo-clearfix"><?php echo $content_1; ?></div>
							<?php endif; ?>
							<?php if ( $content_2 ) : ?>
								<div class="side-header-content-2 oxo-clearfix"><?php echo $content_2; ?></div>
							<?php endif; ?>
						</div>
					<?php endif; ?>
					
					<?php if ( 'None' != Aione()->theme_options[ 'header_v4_content' ] ) : ?>
						<div class="side-header-content side-header-content-3">
							<?php aione_header_content_3(); ?>
						</div>
					<?php endif; ?>

					<?php
					/**
					 * aione_header_inner_after
					 */
					do_action( 'aione_header_inner_after' );
					?>
				</div>
				<div class="side-header-background"></div>
				<div class="side-header-border"></div>
			</div>
			<?php
			/**
			 * aione_after_header_wrapper hook
			 */
			do_action( 'aione_after_header_wrapper' );
			?>
		<?php endif;
	}
}

$header_show_top_bar   =   Aione()->theme_options['header_show_top_bar'];

if($header_show_top_bar == 1){

	if ( ! function_exists( 'aione_secondary_header' ) ) {

		function aione_secondary_header() {
			if ( ! in_array( Aione()->theme_options[ 'header_layout' ], array( 'v2', 'v3', 'v4', 'v5' ) ) ) {
				return;
			}
			?>
			<?php if ( 'Leave Empty' != Aione()->settings->get( 'header_left_content' ) || 'Leave Empty' != Aione()->settings->get( 'header_right_content' ) ) : ?>
				<?php $content_1 = aione_secondary_header_content( 'header_left_content' ); ?>
				<?php $content_2 = aione_secondary_header_content( 'header_right_content' ); ?>

				<div class="oxo-secondary-header">
					<div class="oxo-row">
						<?php global $theme_options; ?>
							<div class="oxo-alignleft">
							<?php
							
								foreach($theme_options['topbar_left_content'] as $key=>$value){
									if($value){
										get_template_part("framework/header/topbar-$key");
									}
								}
							
							?>
							</div>
						
							<div class="oxo-alignright">
							<?php
							if(is_array($theme_options['topbar_right_content']) || $theme_options['topbar_right_content'] instanceof Traversable):
								foreach($theme_options['topbar_right_content'] as $key=>$value){
									if($value){
										get_template_part("framework/header/topbar-$key");
									}
								}
							endif;
							?>
							</div>
						
					</div>
				</div>
			<?php endif;
		}
	}
	add_action( 'aione_header', 'aione_secondary_header', 10 );
}

if ( ! function_exists( 'aione_header_1' ) ) {
	function aione_header_1() {
		if ( ! in_array( Aione()->theme_options[ 'header_layout' ], array( 'v1', 'v2', 'v3' ) ) ) {
			return;
		}
		?>
		<div class="oxo-header-sticky-height"></div>
		<div class="oxo-header">
			<div class="oxo-row">
	
				<?php get_template_part('framework/header/logo'); ?>
		
				<?php aione_main_menu(); ?>
			</div>
		</div>
		<?php
	}
}
add_action( 'aione_header', 'aione_header_1', 20 );

if ( ! function_exists( 'aione_header_2' ) ) {
	function aione_header_2() {
		if ( ! in_array( Aione()->theme_options[ 'header_layout' ], array( 'v4', 'v5' ) ) ) {
			return;
		}
		?>
		<div class="oxo-header-sticky-height"></div>
		<div class="oxo-sticky-header-wrapper"> <!-- start oxo sticky header wrapper -->
			<div class="oxo-header">
				<div class="oxo-row">
				    
						<div class="oxo-logo" data-margin-top="<?php echo intval( Aione()->theme_options[ 'margin_logo_top' ] ); ?>px" data-margin-bottom="<?php echo intval( Aione()->theme_options[ 'margin_logo_bottom' ] ); ?>px" data-margin-left="<?php echo intval( Aione()->theme_options[ 'margin_logo_left' ] ); ?>px" data-margin-right="<?php echo intval( Aione()->theme_options[ 'margin_logo_right' ] ); ?>px">
							<?php aione_logo(); ?>
						</div>
						<!--<div id="logo_text">
							<div id="site_title"><a id="site_name" href="<?php ?>"><?php //bloginfo( 'name' ); ?></a></div>
							<div id="site_description"><?php  //bloginfo( 'description' ); ?></div>
						</div>-->
					
					<?php echo aione_modern_menu(); ?>
				</div>
			</div>
			<?php
	}
}
add_action( 'aione_header', 'aione_header_2', 20 );

$header_show_navigation = Aione()->theme_options[ 'header_show_navigation' ];
if($header_show_navigation == 1){

	if ( ! function_exists( 'aione_secondary_main_menu' ) ) {
		function aione_secondary_main_menu() {
			if ( ! in_array( Aione()->theme_options[ 'header_layout' ], array( 'v4', 'v5' ) ) ) {
				return;
			}
			?>
			<div class="oxo-secondary-main-menu">
				<div class="oxo-row">
					<?php aione_main_menu(); ?>
					<?php if ( 'v4' == Aione()->theme_options[ 'header_layout' ] ) : ?>
						<?php $header_content_3 = Aione()->theme_options[ 'header_v4_content' ]; ?>
						<?php if ( 'Tagline And Search' == $header_content_3 ) : ?>
							<div class="oxo-secondary-menu-search"><?php echo get_search_form( false ); ?></div>
						<?php elseif ( 'Search' == $header_content_3 ) : ?>
							<div class="oxo-secondary-menu-search"><?php echo get_search_form( false ); ?></div>
						<?php endif; ?>
					<?php endif; ?>
				</div>
			</div>
		</div> <!-- end oxo sticky header wrapper -->
		<?php }
	}
}
add_action( 'aione_header', 'aione_secondary_main_menu', 30 );

 ?>
 
	<?php if ( ! function_exists( 'aione_logo' ) ) {
		
			function aione_logo() {
				/**
				 * No need to proceed any further if no logo is set
				 */
				if ( '' == Aione()->theme_options[ 'logo' ] && '' == Aione()->theme_options[ 'logo_retina' ] ) {
					return;
				}
				
			?>
				
				<?php
				/**
				 * aione_logo_prepend hook
				 */
				do_action( 'aione_logo_prepend' );
				?>
				<?php if ( Aione()->theme_options[ 'logo' ] ) :?>
				<?php $header_show_logo =  Aione()->theme_options['header_show_logo'];?> 
				<?php if($header_show_logo == 1){ ?>
						<a class="oxo-logo-link" href="<?php echo home_url(); ?>">
							<?php $logo_url = Aione_Sanitize::get_url_with_correct_scheme( Aione()->theme_options[ 'logo' ] ); ?>
							
							<?php if ( Aione()->theme_options[ 'retina_logo_width' ] && Aione()->theme_options[ 'retina_logo_height' ] ) : ?>
								<?php $logo_size['width']  = oxo_strip_unit( Aione()->theme_options[ 'retina_logo_width' ] ); ?>
								<?php $logo_size['height'] = oxo_strip_unit( Aione()->theme_options[ 'retina_logo_height' ] ); ?>
							<?php else : ?>
								<?php $logo_size['width']  = ''; ?>
								<?php $logo_size['height'] = ''; ?>
							<?php endif; ?>
							<?php $logo_style = 'style="max-height: ' . $logo_size['height'] . 'px; max-width:'.$logo_size['width'].'px;"'; ?>

							<img src="<?php echo $logo_url['url']; ?>" width="<?php echo $logo_size['width']; ?>" height="<?php echo $logo_size['height']; ?>" alt="" class="oxo-logo-1x oxo-standard-logo" <?php echo $logo_style; ?> />
							<?php $retina_logo = Aione()->theme_options[ 'logo_retina' ];?>
							<?php if ( $retina_logo ) : ?>
								<?php $retina_logo = Aione_Sanitize::get_url_with_correct_scheme( $retina_logo ); ?>
								<?php $style = 'style="max-height: ' . $logo_size['height'] . 'px; height: auto;"'; ?>
								<img src="<?php echo $retina_logo['url']; ?>" width="<?php echo $logo_size['width']; ?>" height="<?php echo $logo_size['height']; ?>" alt="<?php bloginfo('name'); ?>" <?php echo $style; ?> class="oxo-standard-logo oxo-logo-2x" />
							<?php else: ?>
								<img src="<?php echo $logo_url['url']; ?>" width="<?php echo $logo_size['width']; ?>" height="<?php echo $logo_size['height']; ?>" alt="<?php bloginfo('name'); ?>" class="oxo-standard-logo oxo-logo-2x" <?php echo $logo_style; ?> />
							<?php endif; ?>

							<!-- mobile logo -->
							<?php if ( Aione()->theme_options[ 'mobile_logo' ] ) : ?>
								<?php $mobile_logo = Aione_Sanitize::get_url_with_correct_scheme( Aione()->theme_options[ 'mobile_logo' ] ); ?>

								<img src="<?php echo $mobile_logo['url']; ?>" alt="<?php bloginfo( 'name' ); ?>" class="oxo-logo-1x oxo-mobile-logo-1x" />

								<?php $retina_logo = Aione()->theme_options[ 'mobile_logo_retina' ]; ?>
								<?php if ( $retina_logo ) : ?>
									<?php $retina_logo = Aione_Sanitize::get_url_with_correct_scheme( $retina_logo ); ?>
									<?php if ( Aione()->theme_options[ 'mobile_retina_logo_width' ] && Aione()->theme_options[ 'mobile_retina_logo_height' ] ) : ?>
										<?php $logo_size['width']  = oxo_strip_unit( Aione()->theme_options[ 'mobile_retina_logo_width' ] ); ?>
										<?php $logo_size['height'] = oxo_strip_unit( Aione()->theme_options[ 'mobile_retina_logo_height' ] ); ?>
									<?php else : ?>
										<?php $logo_size['width']  = ''; ?>
										<?php $logo_size['height'] = ''; ?>
									<?php endif; ?>
									<?php $style = 'style="max-height: ' . $logo_size['height'] . 'px; height: auto;"'; ?>

									<img src="<?php echo $retina_logo['url']; ?>" alt="<?php bloginfo('name'); ?>" <?php echo $style; ?> class="oxo-logo-2x oxo-mobile-logo-2x" />
								<?php else: ?>
									<img src="<?php echo $mobile_logo['url']; ?>" alt="<?php bloginfo( 'name' ); ?>" class="oxo-logo-2x oxo-mobile-logo-2x" />
								<?php endif; ?>
							<?php endif; ?>

							<!-- sticky header logo -->
							<?php if ( Aione()->theme_options[ 'sticky_header_logo' ] && ( in_array( Aione()->theme_options[ 'header_layout' ], array( 'v1', 'v2', 'v3' ) ) || ( ( in_array( Aione()->theme_options[ 'header_layout' ], array( 'v4', 'v5' ) ) && Aione()->theme_options[ 'header_sticky_type2_layout' ] == 'menu_and_logo' ) ) ) ) : ?>
								<?php $sticky_logo = Aione_Sanitize::get_url_with_correct_scheme( Aione()->theme_options[ 'sticky_header_logo' ] ); ?>
								<img src="<?php echo $sticky_logo['url']; ?>" alt="<?php bloginfo( 'name' ); ?>" class="oxo-logo-1x oxo-sticky-logo-1x" />
								<?php $retina_logo = Aione()->theme_options[ 'sticky_header_logo_retina' ]; ?>
								<?php if ( $retina_logo ) : ?>
									<?php $retina_logo = Aione_Sanitize::get_url_with_correct_scheme( $retina_logo ); ?>
									<?php if ( Aione()->theme_options[ 'sticky_retina_logo_width' ] && Aione()->theme_options[ 'sticky_retina_logo_height' ] ) : ?>
										<?php $logo_size['width']  = oxo_strip_unit( Aione()->theme_options[ 'sticky_retina_logo_width' ] ); ?>
										<?php $logo_size['height'] = oxo_strip_unit( Aione()->theme_options[ 'sticky_retina_logo_height' ] ); ?>
									<?php else : ?>
										<?php $logo_size['width']  = ''; ?>
										<?php $logo_size['height'] = ''; ?>
									<?php endif; ?>
									<?php $style = 'style="max-height: ' . $logo_size['height'] . 'px; height: auto;"'; ?>

									<img src="<?php echo $retina_logo['url']; ?>" alt="<?php bloginfo('name'); ?>" <?php echo $style; ?> class="oxo-logo-2x oxo-sticky-logo-2x" />
								<?php else : ?>
									<img src="<?php echo $sticky_logo['url']; ?>" alt="<?php bloginfo( 'name' ); ?>" class="oxo-logo-2x oxo-sticky-logo-2x" />
								<?php endif; ?>
							<?php endif; ?>
						</a>
					
			  <?php } ?>
				
				<?php endif; ?>
				<div id="logo_text">
					<?php $header_show_site_title =  Aione()->theme_options['header_show_site_title'];?> 
					<?php if($header_show_site_title == 1){?>
						<div id="site_title"><a id="site_name" href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a></div>
					<?php } ?>
					
					<?php $header_show_tagline =  Aione()->theme_options['header_show_tagline'];?> 
					<?php if($header_show_tagline == 1){?>
						<div id="site_description"><?php  bloginfo( 'description' ); ?></div>
					<?php } ?>
				</div>
				<?php
				/**
				 * aione_logo_append hook
				 * @hooked aione_header_content_3 - 10
				 */
				do_action( 'aione_logo_append' );
				?>
				<?php
			}
		}
	if ( ! function_exists( 'aione_main_menu' ) ) {
		function aione_main_menu() {
			wp_nav_menu( array(
				'theme_location'  => 'main_navigation',
				'depth'           => 5,
				'menu_class'      => 'oxo-menu',
				'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'fallback_cb'     => 'OxoCoreFrontendWalker::fallback',
				'walker'          => new OxoCoreFrontendWalker(),
				'container_class' => 'oxo-main-menu'
			) );

			if ( has_nav_menu( 'sticky_navigation' ) && ( ! function_exists( 'ubermenu_get_menu_instance_by_theme_location' ) || ( function_exists( 'ubermenu_get_menu_instance_by_theme_location' ) && ! ubermenu_get_menu_instance_by_theme_location( 'sticky_navigation' ) ) ) ) {
				wp_nav_menu( array(
					'theme_location'  => 'sticky_navigation',
					'depth'           => 5,
					'menu_class'      => 'oxo-menu',
					'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'fallback_cb'     => 'OxoCoreFrontendWalker::fallback',
					'walker'          => new OxoCoreFrontendWalker(),
					'container_class' => 'oxo-main-menu oxo-sticky-menu'
				) );
			}

			// Make sure mobile menu is not loaded when ubermenu is used
			if ( ! function_exists( 'ubermenu_get_menu_instance_by_theme_location' ) || ( function_exists( 'ubermenu_get_menu_instance_by_theme_location' ) && ! ubermenu_get_menu_instance_by_theme_location( 'main_navigation' ) ) ) {
				aione_mobile_main_menu();
			}
		}
	}


if ( ! function_exists( 'aione_default_menu_fallback' ) ) {
	function aione_default_menu_fallback( $args ) {
		return null;
	}
}

if ( ! function_exists( 'aione_contact_info' ) ) {
	function aione_contact_info() {
		$phone_number    = do_shortcode( Aione()->settings->get( 'header_number' ) );
		$email           = Aione()->settings->get( 'header_email' );
		$header_position = Aione()->theme_options[ 'header_position' ];

		$html = '';

		if ( $phone_number || $email ) {
			$html .= '<div class="oxo-contact-info">';
				$html .= $phone_number;
				if ( $phone_number && $email ) {
					if ( 'top' == $header_position ) {
						$html .= '<span class="oxo-header-separator">' . apply_filters( 'aione_header_separator', '|' ) .'</span>';
					} else {
						$html .= '<br />';
					}
				}
				$html .= sprintf( apply_filters( 'aione_header_contact_info_email', '<a href="mailto:%s">%s</a>' ), $email, $email );
			$html .= '</div>';
		}
		return $html;
	}
}

if ( ! function_exists( 'aione_secondary_nav' ) ) {
	function aione_secondary_nav() {
		if ( has_nav_menu( 'top_navigation' ) ) {
			return wp_nav_menu( array(
				'theme_location'  => 'top_navigation',
				'depth'           => 5,
				'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'container_class' => 'oxo-secondary-menu',
				'fallback_cb'     => 'OxoCoreFrontendWalker::fallback',
				'walker'          => new OxoCoreFrontendWalker(),
				'echo'            => false
			) );
		}
	}
}

if ( ! function_exists( 'aione_header_social_links' ) ) {
	function aione_header_social_links() {
		global $social_icons;

		$options = array(
			'position'          => 'header',
			'icon_colors'       => Aione()->theme_options[ 'header_social_links_icon_color'],
			'box_colors'        => Aione()->theme_options[ 'header_social_links_box_color' ],
			'icon_boxed'        => Aione()->theme_options[ 'header_social_links_boxed' ],
			'icon_boxed_radius' => intval( Aione()->theme_options[ 'header_social_links_boxed_radius' ] ) . 'px',
			'tooltip_placement' => Aione()->theme_options[ 'header_social_links_tooltip_placement' ],
			'linktarget'        => Aione()->theme_options[ 'social_icons_new' ]
		);

		$render_social_icons = $social_icons->render_social_icons( $options );
		$html = ( $render_social_icons ) ? '<div class="oxo-social-links-header">' . $render_social_icons . '</div>' : '';

		return $html;
	}
}

if ( ! function_exists( 'aione_secondary_header_content' ) ) {
	/**
	 * Get the secondary header content based on the content area
	 * @param  string $content_area Secondary header content area from theme optins
	 * @return string               Html for the content
	 */
	function aione_secondary_header_content( $content_area ) {
		if ( Aione()->settings->get( $content_area ) == 'Contact Info' ) {
			return aione_contact_info();
		} elseif ( Aione()->settings->get( $content_area ) == 'Social Links' ) {
			return aione_header_social_links();
		} elseif ( Aione()->settings->get( $content_area ) == 'Navigation' ) {
			$mobile_menu_wrapper = '';
			if ( has_nav_menu( 'top_navigation' ) ) {
				$mobile_menu_wrapper = '<div class="oxo-mobile-nav-holder"></div>';
			}
			return aione_secondary_nav() . $mobile_menu_wrapper;
		}
	}
}

if ( ! function_exists( 'aione_header_content_3' ) ) {
	function aione_header_content_3() {
		if ( 'v4' != Aione()->theme_options[ 'header_layout' ] && Aione()->theme_options[ 'header_position' ] == 'Top' ) {
			return;
		}

		$header_content_3 = Aione()->theme_options[ 'header_v4_content' ];
		$html = '';

		if ( 'Tagline' == $header_content_3 ) {
			$html .= aione_header_tagline();
		} elseif ( 'Tagline And Search' == $header_content_3 ) {
			if ( 'top' == Aione()->theme_options[ 'header_position' ] ) {
				if ( 'Right' == Aione()->theme_options[ 'logo_alignment' ] ) {
					$html .= aione_header_tagline();
					$html .= '<div class="oxo-secondary-menu-search">' . get_search_form( false ) . '</div>';
				} else {
					$html .= '<div class="oxo-secondary-menu-search">' . get_search_form( false ) . '</div>';
					$html .= aione_header_tagline();
				}
			} else {
				$html .= aione_header_tagline();
				$html .= '<div class="oxo-secondary-menu-search">' . get_search_form( false ) . '</div>';
			}
		} elseif ( 'Search' == $header_content_3 ) {
			$html .= '<div class="oxo-secondary-menu-search">' . get_search_form( false ) . '</div>';
		} elseif ( 'Banner' == $header_content_3 ) {
			$html .= aione_header_banner();
		}

		echo '<div class="oxo-header-content-3-wrapper">' . $html . '</div>';
	}
}
if ( Aione()->theme_options[ 'header_position' ] == 'top' ) {
	add_action( 'aione_logo_append', 'aione_header_content_3', 10 );
}


if ( ! function_exists( 'aione_header_banner' ) ) {
	function aione_header_banner() {
		return '<div class="oxo-header-banner">' . do_shortcode( Aione()->theme_options[ 'header_banner_code' ] ) . '</div>';
	}
}


	if ( ! function_exists( 'aione_header_tagline' ) ) {
		function aione_header_tagline() {
			return '<h3 class="oxo-header-tagline">' . do_shortcode( Aione()->theme_options['header_tagline'] ) . '</h3>';
		}
	}


if ( ! function_exists( 'aione_modern_menu' ) ) {
	function aione_modern_menu() {
		$html = '';

		if ( 'modern' == Aione()->theme_options[ 'mobile_menu_design' ] ) {
			$header_content_3 = Aione()->theme_options[ 'header_v4_content' ];

			$html .= '<div class="oxo-mobile-menu-icons">';
				// Make sure mobile menu toggle is not loaded when ubermenu is used
				if ( ! function_exists( 'ubermenu_get_menu_instance_by_theme_location' ) || ( function_exists( 'ubermenu_get_menu_instance_by_theme_location' ) && ! ubermenu_get_menu_instance_by_theme_location( 'main_navigation' ) ) ) {
					$html .= '<a href="#" class="oxo-icon oxo-icon-bars"></a>';
				}

				if ( ( 'v4' == Aione()->theme_options[ 'header_layout' ] || 'top' != Aione()->theme_options[ 'header_position' ] )  && ( 'Tagline And Search' == $header_content_3 || 'Search' == $header_content_3 ) ) {
					$html .= '<a href="#" class="oxo-icon oxo-icon-search"></a>';
				}
				if ( class_exists('WooCommerce') && Aione()->theme_options[ 'woocommerce_cart_link_main_nav' ] ) {
					$html .= '<a href="' . get_permalink( get_option( 'woocommerce_cart_page_id' ) ) . '" class="oxo-icon oxo-icon-shopping-cart"></a>';
				}
			$html .= '</div>';
		}
		return $html;
	}
}

if ( ! function_exists( 'aione_mobile_main_menu' ) ) {
	function aione_mobile_main_menu() {
		if ( 'Top' != Aione()->theme_options[ 'header_position' ] || ( ! in_array( Aione()->theme_options[ 'header_layout' ], array( 'v4', 'v5' ) ) ) ) {
			echo aione_modern_menu();
		}
		
		$mobile_menu_text_align = '';
		if ( 'right' == Aione()->theme_options[ 'mobile_menu_text_align' ] ) {
			$mobile_menu_text_align = ' oxo-mobile-menu-text-align-right';
		}
		
		printf( '<div class="oxo-mobile-nav-holder%s"></div>', $mobile_menu_text_align );

		if ( has_nav_menu( 'sticky_navigation' ) ) {
			printf( '<div class="oxo-mobile-nav-holder%s oxo-mobile-sticky-nav-holder"></div>', $mobile_menu_text_align );
		}
	}
}
// Omit closing PHP tag to avoid "Headers already sent" issues.