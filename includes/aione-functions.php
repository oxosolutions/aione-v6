<?php
/**
 * Contains all theme specific functions
 *
 * @author		OXOSolutions
 * @package		Aione
 * @since		Version 3.8
 */

// Do not allow directly accessing this file
if ( ! defined( 'ABSPATH' ) ) exit( 'Direct script access denied.' );

/**
 * Get the post (excerpt)
 *
 * @return void Content is directly echoed
 **/
if ( ! function_exists( 'aione_render_blog_post_content' ) ) {
	function aione_render_blog_post_content() {
		if ( is_search() && Aione()->theme_options[ 'search_excerpt' ] ) {
			return;
		}
		echo oxo_get_post_content();
	}
}
add_action( 'aione_blog_post_content', 'aione_render_blog_post_content', 10 );

/**
 * Get the portfolio post (excerpt)
 *
 * @return void Content is directly echoed
 **/
if ( ! function_exists( 'aione_render_portfolio_post_content' ) ) {
	function aione_render_portfolio_post_content( $page_id ) {
		echo oxo_get_post_content( $page_id, 'portfolio' );
	}
}
add_action( 'aione_portfolio_post_content', 'aione_render_portfolio_post_content', 10 );

/**
 * Render the HTML for the date box for large/medium alternate blog layouts
 *
 * @return void directly echoed HTML markup to display the date box
 **/
if ( ! function_exists( 'aione_render_blog_post_date' ) ) {
	function aione_render_blog_post_date() { ?>
		<div class="oxo-date-box">
			<span class="oxo-date"><?php echo get_the_time( Aione()->theme_options[ 'alternate_date_format_day' ] ); ?></span>
			<span class="oxo-month-year"><?php echo get_the_time( Aione()->theme_options[ 'alternate_date_format_month_year' ] ); ?></span>
		</div>
		<?php
	}
}
add_action( 'aione_blog_post_date_and_format', 'aione_render_blog_post_date', 10 );

/**
 * Render the HTML for the format box for large/medium alternate blog layouts
 *
 * @return void directly echoed HTML markup to display the format box
 **/
if ( ! function_exists( 'aione_render_blog_post_format' ) ) {
	function aione_render_blog_post_format() {
		switch ( get_post_format() ) {
			case 'gallery':
				$format_class = 'images';
				break;
			case 'link':
				$format_class = 'link';
				break;
			case 'image':
				$format_class = 'image';
				break;
			case 'quote':
				$format_class = 'quotes-left';
				break;
			case 'video':
				$format_class = 'film';
				break;
			case 'audio':
				$format_class = 'headphones';
				break;
			case 'chat':
				$format_class = 'bubbles';
				break;
			default:
				$format_class = 'pen';
				break;
		}
		?>
		<div class="oxo-format-box">
			<i class="oxo-icon-<?php echo $format_class; ?>"></i>
		</div>
		<?php
	}
}
add_action( 'aione_blog_post_date_and_format', 'aione_render_blog_post_format', 15 );

/**
 * Output author information on the author archive page
 *
 * @return void directly echos the author info HTML markup
 **/
if ( ! function_exists( 'aione_render_author_info' ) ) {
	function aione_render_author_info() {
		global $social_icons;

		// Initialize needed variables
		$author             = get_user_by( 'id', get_query_var( 'author' ) );
		$author_id          = $author->ID;
		$author_name        = get_the_author_meta( 'display_name', $author_id );
		$author_avatar      = get_avatar( get_the_author_meta( 'email', $author_id ), '82' );
		$author_description = get_the_author_meta( 'description', $author_id );
		$author_custom      = get_the_author_meta( 'author_custom', $author_id );

		// If no description was added by user, add some default text and stats
		if ( empty( $author_description ) ) {
			$author_description  = __( 'This author has not yet filled in any details.', 'Aione' );
			$author_description .= '<br />' . sprintf( __( 'So far %s has created %s blog entries.', 'Aione' ), $author_name, count_user_posts( $author_id ) );
		}
		?>
		<div class="oxo-author">
			<div class="oxo-author-avatar">
				<?php echo $author_avatar; ?>
			</div>
			<div class="oxo-author-info">
				<?php // Check if rich snippets are allowed ?>
				<?php if ( ! Aione()->theme_options[ 'disable_date_rich_snippet_pages' ] ) : ?>
					<h3 class="oxo-author-title vcard"><?php _e( 'About', 'Aione' ); ?> <span class="fn"><?php echo $author_name; ?> </span>
				<?php else : ?>
					<h3 class="oxo-author-title"><?php echo __( 'About', 'Aione' ) . ' ' . $author_name; ?>
				<?php endif; ?>

				<?php // If user can edit his profile, offer a link for it ?>
				<?php if ( current_user_can( 'edit_users' ) || get_current_user_id() == $author_id ) : ?>
					<span class="oxo-edit-profile">(<a href="<?php echo admin_url( 'profile.php?user_id=' . $author_id ); ?>"><?php _e( 'Edit profile', 'Aione' ); ?></a>)</span>
				<?php endif; ?>
				</h3>
				<?php echo $author_description; ?>
			</div>

			<div style="clear:both;"></div>

			<div class="oxo-author-social clearfix">
				<div class="oxo-author-tagline">
					<?php if ( $author_custom ) : ?>
						<?php echo $author_custom; ?>
					<?php endif; ?>
				</div>

				<?php

				// Get the social icons for the author set on his profile page
				$author_soical_icon_options = array (
					'authorpage'		=> 'yes',
					'author_id'			=> $author_id,
					'position'			=> 'author',
					'icon_colors' 		=> Aione()->settings->get( 'social_links_icon_color' ),
					'box_colors' 		=> Aione()->settings->get( 'social_links_box_color' ),
					'icon_boxed' 		=> Aione()->settings->get( 'social_links_boxed' ),
					'icon_boxed_radius' => Aione()->settings->get( 'social_links_boxed_radius' ),
					'tooltip_placement'	=> Aione()->settings->get( 'social_links_tooltip_placement' ),
					'linktarget'		=> Aione()->theme_options[ 'social_icons_new' ],
				);

				echo $social_icons->render_social_icons( $author_soical_icon_options );

				?>
			</div>
		</div>
		<?php
	}
}
add_action( 'aione_author_info', 'aione_render_author_info', 10 );

/**
 * Output the footer copyright notice
 *
 * @return void directly echos the footer copyright notice HTML markup
 **/
if ( ! function_exists( 'aione_render_footer_copyright_notice' ) ) {
	function aione_render_footer_copyright_notice() { ?>
		<div class="oxo-copyright-notice">
			<div><?php echo do_shortcode( Aione()->theme_options[ 'footer_text' ] ); ?></div>
		</div>
		<?php
	}
}
add_action( 'aione_footer_copyright_content', 'aione_render_footer_copyright_notice', 10 );

/**
 * Output the footer social icons
 *
 * @return void directly echos the footer footer social icons HTML markup
 **/
if ( ! function_exists( 'aione_render_footer_social_icons' ) ) {
	function aione_render_footer_social_icons() {
		global $social_icons;

		// Render the social icons
		if ( Aione()->theme_options[ 'icons_footer' ] ) : ?>
			<div class="oxo-social-links-footer">
				<?php

				$footer_soical_icon_options = array (
					'position'          => 'footer',
					'icon_colors'       => Aione()->theme_options[ 'footer_social_links_icon_color' ],
					'box_colors'        => Aione()->theme_options[ 'footer_social_links_box_color' ],
					'icon_boxed'        => Aione()->theme_options[ 'footer_social_links_boxed' ],
					'icon_boxed_radius' => Aione()->theme_options[ 'footer_social_links_boxed_radius' ],
					'tooltip_placement' => Aione()->theme_options[ 'footer_social_links_tooltip_placement' ],
					'linktarget'        => Aione()->theme_options[ 'social_icons_new' ],
				);

				echo $social_icons->render_social_icons( $footer_soical_icon_options ); ?>
			</div>
		<?php endif;
	}
}
//add_action( 'aione_footer_copyright_content', 'aione_render_footer_social_icons', 15 );

/**
 * Output the image rollover
 * @param  string 	$post_id 					ID of the current post
 * @param  string 	$permalink 					Permalink of current post
 * @param  boolean 	$display_woo_price 			Set to yes to show´woocommerce price tag for woo sliders
 * @param  boolean 	$display_woo_buttons		Set to yes to show the woocommerce "add to cart" and "show details" buttons
 * @param  string	$display_post_categories 	Controls if the post categories will be shown; "deafult": theme option setting; enable/disable otheriwse
 * @param  string	$display_post_title 		Controls if the post title will be shown; "deafult": theme option setting; enable/disable otheriwse
 * @param  string	$gallery_id 				ID of a special gallery the rollover "zoom" link should be connected to for lightbox
 *
 * @return void 	Directly echos the placeholder image HTML markup
 **/
if ( ! function_exists( 'aione_render_rollover' ) ) {
	function aione_render_rollover( $post_id, $post_permalink = '', $display_woo_price = false, $display_woo_buttons = false, $display_post_categories = 'default', $display_post_title = 'default', $gallery_id = '', $display_woo_rating = false ) {
		global $product, $woocommerce;

		// Retrieve the permalink if it is not set
		if ( ! $post_permalink ) {
			$post_permalink = get_permalink( $post_id );
		}

		// Check if theme options are used as base or if there is an override for post categories
		if ( 'enable' == $display_post_categories ) {
			$display_post_categories = true;
		} elseif ( 'disable' == $display_post_categories ) {
			$display_post_categories = false;
		} else {
			$display_post_categories = ! Aione()->theme_options[ 'cats_image_rollover' ];
		}

		// Check if theme options are used as base or if there is an override for post title
		if ( 'enable' == $display_post_title ) {
			$display_post_title = true;
		} elseif ( 'disable' == $display_post_title ) {
			$display_post_title = false;
		} else {
			$display_post_title = ! Aione()->theme_options[ 'title_image_rollover' ];
		}

		// Set the link on the link icon to a custom url if set in page options
		$icon_permalink = ( oxo_get_page_option( 'link_icon_url', $post_id ) != null ) ? oxo_get_page_option( 'link_icon_url', $post_id ) : $post_permalink;

		if ( '' == oxo_get_page_option( 'image_rollover_icons', $post_id ) || 'default' == oxo_get_page_option( 'image_rollover_icons', $post_id ) ) {
			if( ! Aione()->theme_options[ 'link_image_rollover' ] && ! Aione()->theme_options[ 'zoom_image_rollover' ] ) { // link + zoom
				$image_rollover_icons = 'linkzoom';
			} elseif( ! Aione()->theme_options[ 'link_image_rollover' ] && Aione()->theme_options[ 'zoom_image_rollover' ] ) { // link
				$image_rollover_icons = 'link';
			} elseif( Aione()->theme_options[ 'link_image_rollover' ] && ! Aione()->theme_options[ 'zoom_image_rollover' ] ) { // zoom
				$image_rollover_icons = 'zoom';
			} elseif( Aione()->theme_options[ 'link_image_rollover' ] && Aione()->theme_options[ 'zoom_image_rollover' ] ) { // link
				$image_rollover_icons = 'no';
			} else {
				$image_rollover_icons = 'linkzoom';
			}
		} else {
			$image_rollover_icons = oxo_get_page_option( 'image_rollover_icons', $post_id );
		}

		// Set the link target to blank if the option is set
		if ( 'yes' == oxo_get_page_option( 'link_icon_target', $post_id ) ||
			 'yes' == oxo_get_page_option( 'post_links_target', $post_id ) ||
			 ( 'aione_portfolio' == get_post_type() &&  Aione()->theme_options[ 'portfolio_link_icon_target' ] && 'default' == oxo_get_page_option( 'link_icon_target', $post_id ) )
		) {
			$link_target = ' target="_blank"';
		} else {
			$link_target = '';
		}

		?>
		<div class="oxo-rollover">
			<div class="oxo-rollover-content">

				<?php if ( 'no' != $image_rollover_icons && 'product' != get_post_type( $post_id ) ) : // Check if rollover icons should be displayed ?>

					<?php if ( 'zoom' != $image_rollover_icons ) : // If set, render the rollover link icon ?>
						<a class="oxo-rollover-link" href="<?php echo $icon_permalink; ?>"<?php echo $link_target; ?>>Permalink</a>
					<?php endif; ?>

					<?php if ( 'link' != $image_rollover_icons ) : // If set, render the rollover zoom icon ?>
						<?php

						// Get the image data
						$full_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );

						if ( ! is_array( $full_image ) ) {
							$full_image = array();
							$full_image[0] = '';
						}

						// If a video url is set in the post options, use it inside the lightbox
						if ( oxo_get_page_option( 'video_url', $post_id ) ) {
							$full_image[0] = oxo_get_page_option( 'video_url', $post_id );
						}
						?>

						<?php if ( 'linkzoom' == $image_rollover_icons || '' === $image_rollover_icons ) : // If both icons will be shown, add a separator ?>
							<div class="oxo-rollover-sep"></div>
						<?php endif; ?>

						<?php if ( $full_image[0] ) : // Render the rollover zoom icon if we have an image ?>
							<?php
							// Only show images of the clicked post
							if ( 'individual' == Aione()->theme_options[ 'lightbox_behavior' ] ) {
								$lightbox_content = aione_featured_images_lightbox( $post_id );
								$data_rel         = sprintf( 'iLightbox[gallery%s]', $post_id );
							// Show the first image of every post on the archive page
							} else {
								$lightbox_content = '';
								$data_rel         = sprintf( 'iLightbox[gallery%s]', $gallery_id );
							}
							?>
							<a class="oxo-rollover-gallery" href="<?php echo $full_image[0]; ?>" data-id="<?php echo $post_id; ?>" data-rel="<?php echo $data_rel; ?>" data-title="<?php echo get_post_field( 'post_title', get_post_thumbnail_id( $post_id ) ); ?>" data-caption="<?php echo get_post_field( 'post_excerpt', get_post_thumbnail_id( $post_id ) ); ?>">Gallery</a><?php echo $lightbox_content; ?>
						<?php endif; ?>
					<?php endif; ?>
				<?php endif; ?>

				<?php if ( $display_post_title ) : // Check if we should render the post title on the rollover ?>
					<h4 class="oxo-rollover-title"><a href="<?php echo $icon_permalink; ?>"<?php echo $link_target; ?>><?php echo get_the_title( $post_id ); ?></a></h4>
				<?php endif; ?>

				<?php

				// Check if we should render the post categories on the rollover
				if ( $display_post_categories ) {

					// Determine the correct taxonomy
					$post_taxonomy = '';
					if ( 'post' == get_post_type( $post_id ) ) {
						$post_taxonomy = 'category';
					} elseif ( 'aione_portfolio' == get_post_type( $post_id ) ) {
						$post_taxonomy = 'portfolio_category';
					} elseif ( 'product' == get_post_type( $post_id ) ) {
						$post_taxonomy = 'product_cat';
					}

					echo get_the_term_list( $post_id, $post_taxonomy, '<div class="oxo-rollover-categories">', ', ', '</div>' );
				}
				?>

				<?php
				if( class_exists( 'WooCommerce' ) && $woocommerce->cart ) {
					$items_in_cart = array();
					if ( $woocommerce->cart->get_cart() && is_array( $woocommerce->cart->get_cart() ) ) {
						foreach ( $woocommerce->cart->get_cart() as $cart ) {
							$items_in_cart[] = $cart['product_id'];
						}
					}

					$id      = get_the_ID();
					$in_cart = in_array( $id, $items_in_cart );
					if ( $in_cart ) {
						echo '<span class="cart-loading">' . '<a href="' . $woocommerce->cart->get_cart_url() .'">' . '<i class="oxo-icon-check-square-o"></i><span class="view-cart">' . __( 'View Cart', 'Aione' ) .'</span></a></span>';
					} else {
						echo '<span class="cart-loading">' . '<a href="' . $woocommerce->cart->get_cart_url() .'">' . '<i class="oxo-icon-spinner"></i><span class="view-cart">' . __( 'View Cart', 'Aione' ) .'</span></a></span>';
					}
				}
				?>

				<?php if ( $display_woo_rating ) : // Check if we should render the woo product price ?>
					<?php woocommerce_get_template( 'loop/rating.php' ); ?>
				<?php endif; ?>

				<?php if ( $display_woo_price ) : // Check if we should render the woo product price ?>
					<?php woocommerce_get_template( 'loop/price.php' ); ?>
				<?php endif; ?>

				<?php if ( $display_woo_buttons ) : // Check if we should render the woo "add to cart" and "details" buttons ?>
					<div class="oxo-product-buttons">
						<?php
						/**
						 * aione_woocommerce_buttons_on_rollover hook.
						 *
						 * @hooked OxoTemplateWoo::aione_woocommerce_template_loop_add_to_cart - 10 (outputs add to cart button)
						 * @hooked OxoTemplateWoo::aione_woocommerce_rollover_buttons_linebreak - 15 (outputs line break for the buttons, needed for clean version)
						 * @hooked OxoTemplateWoo::show_details_button - 20 (outputs the show details button)
						 */					
						do_action( 'aione_woocommerce_buttons_on_rollover' ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}
}
add_action( 'aione_rollover', 'aione_render_rollover', 10, 8 );

/**
 * Action to output a placeholder image
 * @param  string $featured_image_size 	Size of the featured image that should be emulated
 *
 * @return void 						Directly echos the placeholder image HTML markup
 **/
if ( ! function_exists( 'aione_render_placeholder_image' ) ) {
	function aione_render_placeholder_image( $featured_image_size = 'full' ) {
		global $_wp_additional_image_sizes;

		if ( in_array( $featured_image_size, array( 'full', 'fixed' ) ) ) {
			$height = apply_filters( 'aione_set_placeholder_image_height', '150' );
			$width  = '1500px';
		} else {
			@$height = $_wp_additional_image_sizes[$featured_image_size]['height'];
			@$width  = $_wp_additional_image_sizes[$featured_image_size]['width'] . 'px';
		 }
		 ?>
		 <div class="oxo-placeholder-image" data-origheight="<?php echo $height; ?>" data-origwidth="<?php echo $width; ?>" style="height:<?php echo $height; ?>px;width:<?php echo $width; ?>;"></div>
		 <?php
	}
}
add_action( 'aione_placeholder_image', 'aione_render_placeholder_image', 10 );

if ( ! function_exists( 'aione_render_first_featured_image_markup' ) ) {
	/**
	 * Render the full markup of the first featured image, incl. image wrapper and rollover
	 * @param  string 	$post_id 					ID of the current post
	 * @param  string 	$post_featured_image_size 	Size of the featured image
	 * @param  string 	$post_permalink 			Permalink of current post
	 * @param  boolean 	$display_placeholder_image  Set to true to show an image placeholder
	 * @param  boolean 	$display_woo_price  		Set to true to show WooCommerce prices
	 * @param  boolean 	$display_woo_buttons  		Set to true to show WooCommerce buttons	 
	 * @param  boolean	$display_post_categories 	Set to yes to show post categories on rollover
 	 * @param  string	$display_post_title 		Controls if the post title will be shown; "deafult": theme option setting; enable/disable otheriwse
 	 * @param  string	$type 						Type of element the featured image is for. "Related" for related posts is the only type in use so far
 	 * @param  string	$gallery_id 				ID of a special gallery the rollover "zoom" link should be connected to for lightbox
 	 * @param  string	$display_rollover 			yes|no|force_yes: no disables rollover; force_yes will force rollover even if the Theme Option is set to no
	 *
	 * @return string Full HTML markup of the first featured image
	 **/
	function aione_render_first_featured_image_markup( $post_id, $post_featured_image_size = '', $post_permalink = '', $display_placeholder_image = FALSE, $display_woo_price = FALSE, $display_woo_buttons = FALSE, $display_post_categories = 'default', $display_post_title = 'default', $type = '', $gallery_id = '', $display_rollover = 'yes', $display_woo_rating = FALSE ) {
		// Add a class for fixed image size, to restrict the image rollovers to the image width
		$image_size_class = '';
		if ( $post_featured_image_size != 'full' ) {
			$image_size_class = ' oxo-image-size-fixed';
		}
		if ( ( ! has_post_thumbnail( $post_id ) && get_post_meta( $post_id, 'pyre_video', true ) ) ||
			 ( is_home() && $post_featured_image_size == 'blog-large' )
		) {
			$image_size_class = '';
		}

		$html = '<div class="oxo-image-wrapper' . $image_size_class . '" aria-haspopup="true">';
			// Get the featured image
			ob_start();
			// If there is a featured image, display it
			if ( has_post_thumbnail( $post_id ) ) {
				echo get_the_post_thumbnail( $post_id, $post_featured_image_size );

			// Display a video if it is set
			} elseif ( get_post_meta( $post_id, 'pyre_video', true ) ) {
				?>
				<div class="full-video">
					<?php echo get_post_meta( $post_id, 'pyre_video', true ); ?>
				</div>
				<?php

			// If there is no featured image setup a placeholder
			} elseif ( $display_placeholder_image ) {
					/**
					 * aione_placeholder_image hook
					 *
					 * @hooked aione_render_placeholder_image - 10 (outputs the HTML for the placeholder image)
					 */
					do_action( 'aione_placeholder_image', $post_featured_image_size );
			}
			$featured_image = ob_get_clean();

			if ( $type == 'related' && $post_featured_image_size == 'fixed' && get_post_thumbnail_id( $post_id ) ) {
				$image = Oxo_Image_Resizer::image_resize( array(
					'width' => '500',
					'height' => '383',
					'url' =>  wp_get_attachment_url( get_post_thumbnail_id( $post_id ) ),
					'path' => get_attached_file( get_post_thumbnail_id( $post_id ) )
				) );

				$featured_image = sprintf( '<img src="%s" width="%s" height="%s" alt="%s" />', $image['url'], $image['width'], $image['height'], get_the_title( $post_id ) );
			}

			// If rollovers are enabled, add one to the image container
			if ( ( Aione()->theme_options[ 'image_rollover' ] && $display_rollover == 'yes' ) ||
				 $display_rollover == 'force_yes'
			) {
				$html .= $featured_image;

				ob_start();
				/**
				 * aione_rollover hook
				 *
				 * @hooked aione_render_rollover - 10 (outputs the HTML for the image rollover)
				 */
				do_action( 'aione_rollover', $post_id, $post_permalink, $display_woo_price, $display_woo_buttons, $display_post_categories, $display_post_title, $gallery_id, $display_woo_rating );
				$rollover = ob_get_clean();

				$html .= $rollover;

			// If rollovers are disabled, add post permalink to the featured image
			} else {
				$html .= sprintf( '<a href="%s">%s</a>', $post_permalink, $featured_image );
			}

		$html .= '</div>';

		return $html;
	}
}

if ( ! function_exists( 'aione_get_image_orientation_class' ) ) {
	/**
	 * Returns the image class according to aspect ratio
	 *
	 * @return string The image class
	 **/
	function aione_get_image_orientation_class( $attachment ) {

		$sixteen_to_nine_ratio = 1.77;
		$imgage_class = 'oxo-image-grid';

		if ( ! empty( $attachment[1] ) &&
			 ! empty( $attachment[2] )
		) {
			// Landscape
			if ( $attachment[1] / $attachment[2] > $sixteen_to_nine_ratio ) {
				$imgage_class = 'oxo-image-landscape';
			// Portrait
			} elseif ( $attachment[2] / $attachment[1] > $sixteen_to_nine_ratio ) {
				$imgage_class = 'oxo-image-portrait';
			}
		}

		return $imgage_class;
	}
}

if ( ! function_exists( 'aione_render_post_title' ) ) {
	/**
	 * Render the post title as linked h1 tag
	 *
	 * @return string The post title as linked h1 tag
	 **/
	function aione_render_post_title( $post_id = '', $linked = TRUE, $custom_title = '', $custom_size = '2' ) {

		$entry_title_class = '';

		// Add the entry title class if rich snippets are enabled
		if ( ! Aione()->theme_options[ 'disable_date_rich_snippet_pages' ] ) {
			$entry_title_class = ' class="entry-title"';
		}

		// If we have a custom title, use it
		if ( $custom_title ) {
			$title = $custom_title;
		// Otherwise get post title
		} else {
			$title = get_the_title( $post_id );
		}

		// If the post title should be linked at the markup
		if ( $linked ) {
			$link_target = '';
			if( oxo_get_page_option( 'link_icon_target', $post_id ) == 'yes' ||
				oxo_get_page_option( 'post_links_target', $post_id ) == 'yes' ) {
				$link_target = ' target="_blank"';
			}

			$title = sprintf( '<a href="%s"%s>%s</a>', get_permalink( $post_id ), $link_target, $title );
		}

		// Setup the HTML markup of the post title
		$html = sprintf( '<h%s%s>%s</h%s>', $custom_size, $entry_title_class, $title, $custom_size );


		return $html;
	}
}

if ( ! function_exists( 'aione_get_portfolio_classes' ) ) {
	/**
	 * Determine the css classes need for portfolio page content container
	 *
	 * @return string The classes separated with space
	 **/
	function aione_get_portfolio_classes( $post_id = '' ) {

		$classes = 'oxo-portfolio';

		// Get the page template slug without .php suffix
		$page_template = str_replace( '.php', '', get_page_template_slug( $post_id ) );

		// Add the text class, if a text layout is used
		if ( strpos( $page_template, 'text' ) ||
			 strpos( $page_template, 'one' )
		) {
			$classes .= ' oxo-portfolio-text';
		}

		// If one column text layout is used, add special class
		if ( strpos( $page_template, 'one' ) &&
			 ! strpos( $page_template, 'text' )
		) {
			$classes .= ' oxo-portfolio-one-nontext';
		}

		// For text layouts add the class for boxed/unboxed
		if ( strpos( $page_template, 'text' ) ) {

			$classes .= sprintf( ' oxo-portfolio-%s ', oxo_get_option( 'portfolio_text_layout', 'portfolio_text_layout', $post_id  ) );
			$page_template = str_replace( '-text', '', $page_template );
		}

		// Add the column class
		$page_template = str_replace( '-column', '', $page_template );
		$classes .= ' oxo-' . $page_template;

		return $classes;
	}
}

if( ! function_exists( 'aione_is_portfolio_template' ) ) {
	function aione_is_portfolio_template() {
		if ( is_page_template( 'portfolio-one-column-text.php' ) ||
			is_page_template( 'portfolio-one-column.php' ) ||
			is_page_template( 'portfolio-two-column.php' ) ||
			is_page_template( 'portfolio-two-column-text.php' ) ||
			is_page_template( 'portfolio-three-column.php' ) ||
			is_page_template( 'portfolio-three-column-text.php' ) ||
			is_page_template( 'portfolio-four-column.php' ) ||
			is_page_template( 'portfolio-four-column-text.php' ) ||
			is_page_template( 'portfolio-five-column.php' ) ||
			is_page_template( 'portfolio-five-column-text.php' ) ||
			is_page_template( 'portfolio-six-column.php' ) ||
			is_page_template( 'portfolio-six-column-text.php' ) ||
			is_page_template( 'portfolio-grid.php' )
		) {
			return true;
		}

		return false;
	}
}

if ( ! function_exists( 'aione_get_image_size_dimensions' ) ) {
	function aione_get_image_size_dimensions( $image_size = 'full' ) {
		global $_wp_additional_image_sizes;

		if ( $image_size == 'full' ) {
			$image_dimension = array( 'height' => 'auto', 'width' => '100%' );
		} else {
			$image_dimension = array( 'height' => $_wp_additional_image_sizes[$image_size]['height'] . 'px', 'width' => $_wp_additional_image_sizes[$image_size]['width'] . 'px' );
		}

		return $image_dimension;
	}
}

if ( ! function_exists( 'aione_get_portfolio_image_size' ) ) {
	function aione_get_portfolio_image_size( $current_page_id ) {

		if(  is_page_template( 'portfolio-one-column-text.php' ) ) {
			$custom_image_size = 'portfolio-full';
		} else if ( is_page_template( 'portfolio-one-column.php' ) ) {
			$custom_image_size = 'portfolio-one';
		} else if ( is_page_template( 'portfolio-two-column.php' ) ||
				   is_page_template( 'portfolio-two-column-text.php' )
		) {
			$custom_image_size = 'portfolio-two';
		} else if ( is_page_template( 'portfolio-three-column.php' ) ||
				   is_page_template( 'portfolio-three-column-text.php' )
		) {
			$custom_image_size = 'portfolio-three';
		} else if ( is_page_template( 'portfolio-four-column.php' ) ||
				   is_page_template( 'portfolio-four-column-text.php' )
		) {
			$custom_image_size = 'portfolio-four';
		} else if ( is_page_template( 'portfolio-five-column.php' ) ||
				   is_page_template( 'portfolio-five-column-text.php' )
		) {
			$custom_image_size = 'portfolio-five';
		} else if ( is_page_template( 'portfolio-six-column.php' ) ||
				   is_page_template( 'portfolio-six-column-text.php' )
		) {
			$custom_image_size = 'portfolio-six';
		} else {
			$custom_image_size = 'full';
		}

		if ( get_post_meta( $current_page_id, 'pyre_portfolio_featured_image_size', true ) == 'default' ||
			! get_post_meta( $current_page_id, 'pyre_portfolio_featured_image_size', true )
		) {
			if ( 'full' == Aione()->theme_options[ 'portfolio_featured_image_size' ] ) {
				$featured_image_size = 'full';
			} else {
				$featured_image_size = $custom_image_size;
			}
		} else if ( get_post_meta( $current_page_id, 'pyre_portfolio_featured_image_size', true ) == 'full' ) {
			$featured_image_size = 'full';
		} else {
			$featured_image_size = $custom_image_size;
		}

		if ( is_page_template( 'portfolio-grid.php' ) ) {
			$featured_image_size = 'full';
		}

		return $featured_image_size;
	}
}



if ( ! function_exists( 'aione_get_blog_layout' ) ) {
	/**
	 * Get the blog layout for the current page template
	 *
	 * @return string The correct layout name for the blog post class
	 **/
	function aione_get_blog_layout() {
		$theme_options_blog_var = '';

		if ( is_home() ) {
			$theme_options_blog_var = 'blog_layout';
		} elseif ( is_archive() || is_author() ) {
			$theme_options_blog_var = 'blog_archive_layout';
		} elseif ( is_search() ) {
			$theme_options_blog_var = 'search_layout';
		}

		$blog_layout = str_replace( ' ', '-', strtolower( Aione()->theme_options[ $theme_options_blog_var ] ) );

		return $blog_layout;
	}
}

if ( ! function_exists( 'aione_render_post_metadata' ) ) {
	/**
	 * Render the full meta data for blog archive and single layouts
	 * @param 	string $layout 	The blog layout (either single, standard, alternate or grid_timeline)
	 *
	 * @return 	string 			HTML markup to display the date and post format box
	 **/
	function aione_render_post_metadata( $layout, $settings = array() ) {

		$html = $author = $date = $metadata = '';

		if ( ! $settings ) {
			$settings['post_meta']          = Aione()->theme_options[ 'post_meta' ];
			$settings['post_meta_author']   = Aione()->theme_options[ 'post_meta_author' ];
			$settings['post_meta_date']     = Aione()->theme_options[ 'post_meta_date' ];
			$settings['post_meta_cats']     = Aione()->theme_options[ 'post_meta_cats' ];
			$settings['post_meta_tags']     = Aione()->theme_options[ 'post_meta_tags' ];
			$settings['post_meta_comments'] = Aione()->theme_options[ 'post_meta_comments' ];
		}

		// Check if meta data is enabled
		if ( ( $settings['post_meta'] && get_post_meta( get_queried_object_id(), 'pyre_post_meta', TRUE ) != 'no' ) ||
			 ( ! $settings['post_meta'] && get_post_meta( get_queried_object_id(), 'pyre_post_meta', TRUE ) == 'yes' ) ) {

			// For alternate, grid and timeline layouts return empty single-line-meta if all meta data for that position is disabled
			if ( ( $layout == 'alternate' || $layout == 'grid_timeline' ) &&
				$settings['post_meta_author'] &&
				$settings['post_meta_date'] &&
				$settings['post_meta_cats'] &&
				$settings['post_meta_tags'] &&
				$settings['post_meta_comments']
			) {
				return $html;
			}

			// Render author meta data
			if ( ! $settings['post_meta_author'] ) {
				ob_start();
				the_author_posts_link();
				$author_post_link = ob_get_clean();

				// Check if rich snippets are enabled
				if ( Aione()->theme_options[ 'disable_date_rich_snippet_pages' ] ) {
					$metadata .= sprintf( '%s <span>%s</span><span class="oxo-inline-sep">|</span>', __( 'By', 'Aione' ), $author_post_link );
				} else {
					$metadata .= sprintf( '%s <span class="vcard"><span class="fn">%s</span></span><span class="oxo-inline-sep">|</span>', __( 'By', 'Aione' ), $author_post_link );
				}
			// If author meta data won't be visible, render just the invisible author rich snippet
			} else {
				$author .= aione_render_rich_snippets_for_pages( FALSE, TRUE, FALSE );
			}

			// Render the updated meta data or at least the rich snippet if enabled
			if ( ! $settings['post_meta_date'] ) {
				$metadata .= aione_render_rich_snippets_for_pages( FALSE, FALSE, TRUE );
				$metadata .= sprintf( '<span>%s</span><span class="oxo-inline-sep">|</span>', get_the_time( Aione()->theme_options[ 'date_format' ] ) );
			} else {
				$date .= aione_render_rich_snippets_for_pages( FALSE, FALSE, TRUE );
			}

			// Render rest of meta data
			// Render categories
			if ( ! $settings['post_meta_cats'] ) {
				ob_start();
				the_category( ', ' );
				$categories = ob_get_clean();

				if ( $categories ) {
					if ( ! $settings['post_meta_tags'] ) {
						$metadata .=  __( 'Categories:', 'Aione' ) . ' ';
					}

					$metadata .= sprintf( '%s<span class="oxo-inline-sep">|</span>', $categories );
				}
			}

			// Render tags
			if ( ! $settings['post_meta_tags'] ) {
				ob_start();
				the_tags( '' );
				$tags = ob_get_clean();

				if( $tags ) {
					$metadata .= sprintf( '<span class="meta-tags">%s %s</span><span class="oxo-inline-sep">|</span>', __( 'Tags:', 'Aione' ), $tags );
				}
			}

			// Render comments
			if ( ! $settings['post_meta_comments'] && $layout != 'grid_timeline' ) {
				ob_start();
				comments_popup_link( __( '0 Comments', 'Aione' ), __( '1 Comment', 'Aione' ), '% ' . __( 'Comments', 'Aione' ) );
				$comments = ob_get_clean();
				$metadata .= sprintf( '<span class="oxo-comments">%s</span>', $comments );
			}

			// Render the HTML wrappers for the different layouts
			if ( $metadata ) {
				$metadata = $author . $date . $metadata;

				if ( $layout == 'single' ) {
					$html .= sprintf ( '<div class="oxo-meta-info"><div class="oxo-meta-info-wrapper">%s</div></div>', $metadata );
				} elseif ( $layout == 'alternate' ||
					$layout == 'grid_timeline'
				) {
					$html .= sprintf( '<p class="oxo-single-line-meta">%s</p>', $metadata );
				} else {
					$html .= sprintf( '<div class="oxo-alignleft">%s</div>', $metadata );
				}
			} else {
				$html .= $author . $date;
			}
		// Render author and updated rich snippets for grid and timeline layouts
		} else {
			if ( ! Aione()->theme_options[ 'disable_date_rich_snippet_pages' ] ) {
				$html .= aione_render_rich_snippets_for_pages( FALSE );
			}
		}

		return $html;
	}
}

if ( ! function_exists( 'aione_render_social_sharing' ) ) {
	function aione_render_social_sharing( $post_type = 'post' ) {
		global $social_icons;

		 if ( $post_type == 'post' ) {
		 	$setting_name = 'social_sharing_box';
		 } else {
		 	$setting_name = $post_type . '_social_sharing_box';
		 }

		if ( ( Aione()->settings->get( $setting_name ) && get_post_meta( get_the_ID(), 'pyre_share_box', true) != 'no' ) ||
			 ( ! Aione()->settings->get( $setting_name ) && get_post_meta( get_the_ID(), 'pyre_share_box', true) == 'yes' )
		) {

			$full_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );

			$sharingbox_soical_icon_options = array (
				'sharingbox'		=> 'yes',
				'icon_colors' 		=> Aione()->theme_options[ 'sharing_social_links_icon_color' ],
				'box_colors' 		=> Aione()->theme_options[ 'sharing_social_links_box_color' ],
				'icon_boxed' 		=> Aione()->theme_options[ 'sharing_social_links_boxed' ],
				'icon_boxed_radius' => Aione()->theme_options[ 'sharing_social_links_boxed_radius' ],
				'tooltip_placement'	=> Aione()->theme_options[ 'sharing_social_links_tooltip_placement' ],
				'linktarget'        => Aione()->theme_options[ 'social_icons_new' ],
				'title'				=> wp_strip_all_tags( get_the_title( get_the_ID() ), true ),
				'description'		=> Aione()->blog->get_content_stripped_and_excerpted( 55, get_the_content() ),
				'link'				=> get_permalink( get_the_ID() ),
				'pinterest_image'	=> ( $full_image ) ? $full_image[0] : '',
			);
			?>
			<div class="oxo-sharing-box oxo-single-sharing-box share-box">
				<h4><?php echo apply_filters( 'oxo_sharing_box_tagline', Aione()->theme_options[ 'sharing_social_tagline' ] ); ?></h4>
				<?php echo $social_icons->render_social_icons( $sharingbox_soical_icon_options ); ?>
			</div>
			<?php
		}
	}
}

if( ! function_exists( 'aione_render_related_posts' ) ) {
	/**
	 * Render related posts carousel
	 * @param  string $post_type 		The post type to determine correct related posts and headings
	 *
	 * @return string 					HTML markup to display related posts
	 **/
	function aione_render_related_posts( $post_type = 'post' ) {

		$html = '';

		// Set the needed variables according to post type
		if ( $post_type == 'post' ) {
			$theme_option_name = 'related_posts';
			$main_heading =  __( 'Related Posts', 'Aione' );
		} elseif ( $post_type == 'aione_portfolio' ) {
			$theme_option_name = 'portfolio_related_posts';
			$main_heading =  __( 'Related Projects', 'Aione' );
		}

		// Check if related posts should be shown
		if ( Aione()->theme_options[ 'portfolio_related_posts' ] == 'yes' ||
			 Aione()->theme_options[ 'portfolio_related_posts' ] == '1'
		) {
			if ( $post_type == 'post' ) {
				$related_posts = oxo_get_related_posts( get_the_ID(), Aione()->theme_options[ 'number_related_posts' ] );
			} elseif ( $post_type == 'aione_portfolio' ) {
				$related_posts = oxo_get_related_projects( get_the_ID(), Aione()->theme_options[ 'number_related_posts' ] );
			}

			// If there are related posts, display them
			if ( $related_posts->have_posts() ) {
				$html .= '<div class="related-posts single-related-posts">';
					ob_start();
					echo Aione()->template->title_template( $main_heading, '3' );
					$html .= ob_get_clean();

					// Get the correct image size
					if ( 'cropped' == Aione()->theme_options[ 'related_posts_image_size' ] ) {
						$featured_image_size = 'fixed';
						$data_image_size = 'fixed';
					} else {
						$featured_image_size = 'full';
						$data_image_size = 'auto';
					}

					// Set the meta content variable
					if ( 'title_on_rollover' == Aione()->theme_options[ 'related_posts_layout' ] ) {
						$data_meta_content = 'no';
					} else {
						$data_meta_content = 'yes';
					}

					// Set the autoplay variable
					if ( Aione()->theme_options[ 'related_posts_autoplay' ] ) {
						$data_autoplay = 'yes';
					} else {
						$data_autoplay = 'no';
					}

					// Set the touch scroll variable
					if ( Aione()->theme_options[ 'related_posts_swipe' ] ) {
						$data_swipe = 'yes';
					} else {
						$data_swipe = 'no';
					}

					$carousel_item_css = '';
					if ( sizeof( $related_posts->posts ) < Aione()->theme_options[ 'related_posts_columns' ] ) {
						$carousel_item_css = ' style="max-width: 300px;"';
					}

					$html .= sprintf( '<div class="oxo-carousel" data-imagesize="%s" data-metacontent="%s" data-autoplay="%s" data-touchscroll="%s" data-columns="%s" data-itemmargin="%s" data-itemwidth="180" data-touchscroll="yes" data-scrollitems="%s">',
									  $data_image_size, $data_meta_content, $data_autoplay, $data_swipe, Aione()->theme_options[ 'related_posts_columns' ], Aione()->theme_options[ 'related_posts_column_spacing' ], Aione()->theme_options[ 'related_posts_swipe_items' ] );
						$html .= '<div class="oxo-carousel-positioner">';
							$html .= '<ul class="oxo-carousel-holder">';
								// Loop through related posts
								while( $related_posts->have_posts() ): $related_posts->the_post();
									$html .= sprintf( '<li class="oxo-carousel-item"%s>', $carousel_item_css );
										$html .= '<div class="oxo-carousel-item-wrapper">';
											// Title on rollover layout
											if ( 'title_on_rollover' == Aione()->theme_options[ 'related_posts_layout' ] ) {
												$html .= aione_render_first_featured_image_markup( get_the_ID(), $featured_image_size, get_permalink( get_the_ID() ), TRUE, FALSE, FALSE, 'disable', 'default', 'related' );
											// Title below image layout
											} else {
												$html .= aione_render_first_featured_image_markup( get_the_ID(), $featured_image_size, get_permalink( get_the_ID() ), TRUE, FALSE, FALSE, 'disable', 'disable', 'related' );

												// Get the post title
												$html .= sprintf( '<h4 class="oxo-carousel-title"><a href="%s"%s>%s</a></h4>', get_permalink( get_the_ID() ), '_self', get_the_title() );

												$html .= '<div class="oxo-carousel-meta">';

													$html .= sprintf( '<span class="oxo-date">%s</span>', get_the_time( Aione()->theme_options[ 'date_format' ], get_the_ID() ) );

													$html .= '<span class="oxo-inline-sep">|</span>';

													$comments = $comments_link = '';
													ob_start();
													comments_popup_link( __( '0 Comments', 'Aione' ), __( '1 Comment', 'Aione' ), '% ' . __( 'Comments', 'Aione' ) );
													$comments_link = ob_get_clean();

													$html .= sprintf( '<span>%s</span>', $comments_link );

												$html .= '</div>'; // oxo-carousel-meta
											}
										$html .= '</div>'; // oxo-carousel-item-wrapper
									$html .= '</li>';
								endwhile;
							$html .= '</ul>'; // oxo-carousel-holder
							// Add navigation if needed
							if ( Aione()->theme_options[ 'related_posts_navigation' ] ) {
								$html .= '<div class="oxo-carousel-nav"><span class="oxo-nav-prev"></span><span class="oxo-nav-next"></span></div>';
							}
						$html .= '</div>'; // oxo-carousel-positioner
					$html .= '</div>'; // oxo-carousel
				$html .= '</div>'; // related-posts

				wp_reset_postdata();
			}
		}

		return $html;
	}
}


if( ! function_exists( 'aione_render_rich_snippets_for_pages' ) ) {
	/**
	 * Render the full meta data for blog archive and single layouts
	 * @param  boolean $title_tag 		Set to TRUE to render title rich snippet
	 * @param  boolean $author_tag 		Set to TRUE to render author rich snippet
	 * @param  boolean $updated_tag 	Set to TRUE to render updated rich snippet
	 *
	 * @return string 					HTML markup to display rich snippets
	 **/
	function aione_render_rich_snippets_for_pages( $title_tag = TRUE, $author_tag = TRUE, $updated_tag = TRUE ) {

		$html = '';

		if( ! Aione()->theme_options[ 'disable_date_rich_snippet_pages' ] ) {

			if( $title_tag ) {
				$html = '<span class="entry-title" style="display: none;">' . get_the_title() . '</span>';
			}

			if( $author_tag ) {
				ob_start();
				the_author_posts_link();
				$author_post_link = ob_get_clean();
				$html .= '<span class="vcard" style="display: none;"><span class="fn">' . $author_post_link . '</span></span>';
			}

			if( $updated_tag ) {
				$html .= '<span class="updated" style="display:none;">' . get_the_modified_time( 'c' ) . '</span>';
			}
		}

		return $html;
	}
}

if ( ! function_exists( 'aione_extract_shortcode_contents' ) ) {
	/**
	 * Extract text contents from all shortcodes for usage in excerpts
	 *
	 * @return string The shortcode contents
	 **/
	function aione_extract_shortcode_contents( $m ) {

		global $shortcode_tags;

		// Setup the array of all registered shortcodes
		$shortcodes = array_keys( $shortcode_tags );
		$no_space_shortcodes = array( 'dropcap' );
		$omitted_shortcodes = array( 'oxo_code', 'slide' );

		// Extract contents from all shortcodes recursively
		if ( in_array( $m[2], $shortcodes ) && ! in_array( $m[2], $omitted_shortcodes ) ) {
			$pattern = get_shortcode_regex();
			// Add space the excerpt by shortcode, except for those who should stick together, like dropcap
			$space = ' ' ;
			if ( in_array( $m[2], $no_space_shortcodes ) ) {
				$space = '' ;
			}
			$content = preg_replace_callback( "/$pattern/s", 'aione_extract_shortcode_contents', rtrim( $m[5] ) . $space );
			return $content;
		}

		// allow [[foo]] syntax for escaping a tag
		if ( $m[1] == '[' &&
			 $m[6] == ']'
		) {
			return substr($m[0], 1, -1);
		}

	   return $m[1] . $m[6];
	}
}

if ( ! function_exists( 'aione_page_title_bar' ) ) {
	/**
	 * Render the HTML markup of the page title bar
	 * @param  string $title 				Main title; page/post title or custom title set by user
	 * @param  string $subtitle 			Subtitle as custom user setting
	 * @param  string $secondary_content 	HTML markup of the secondary content; breadcrumbs or search field
	 *
	 * @return void 						Content is directly echoed
	 **/
	function aione_page_title_bar( $title, $subtitle, $secondary_content ) {
		$post_id = get_queried_object_id();

		// Check for the secondary content
		$content_type = 'none';
		if ( false !== strpos( $secondary_content, 'searchform' ) ) {
			$content_type = 'search';
		} elseif ( $secondary_content != '' ) {
			$content_type = 'breadcrumbs';
		}

		// Check the position of page title
		if ( metadata_exists( 'post', $post_id, 'pyre_page_title_text_alignment' ) && 'default' != get_post_meta( get_queried_object_id(), 'pyre_page_title_text_alignment', true ) ) {
			$alignment = get_post_meta( $post_id, 'pyre_page_title_text_alignment', true );
		} elseif ( Aione()->theme_options[ 'page_title_alignment' ] ) {
			$alignment = Aione()->theme_options[ 'page_title_alignment' ];
		}

		/**
		 * Render the page title bar
		 */
		?>
		<div class="oxo-page-title-bar oxo-page-title-bar-<?php echo $content_type; ?> oxo-page-title-bar-<?php echo $alignment; ?>">
			<div class="oxo-page-title-row">
				<div class="oxo-page-title-wrapper">
					<div class="oxo-page-title-captions">
						<?php if ( $title ) : ?>
							<?php // Add entry-title for rich snippets ?>
							<?php $entry_title_class = ( ! Aione()->theme_options[ 'disable_date_rich_snippet_pages' ] ) ? ' class="entry-title"' : ''; ?>
							<h1<?php echo $entry_title_class; ?>><?php echo $title; ?></h1>

							<?php if ( $subtitle ) : ?>
								<h3><?php echo $subtitle; ?></h3>
							<?php endif; ?>
						<?php endif; ?>

						<?php if ( 'center' == $alignment ) : // Render secondary content on center layout ?>
							<?php if ( 'none' != oxo_get_option( Aione()->theme_options[ 'page_title_bar_bs' ], 'page_title_breadcrumbs_search_bar', $post_id ) ) : ?>
								<div class="oxo-page-title-secondary"><?php echo $secondary_content; ?></div>
							<?php endif; ?>
						<?php endif; ?>
					</div>

					<?php if ( 'center' != $alignment ) : // Render secondary content on left/right layout ?>
						<?php if ( 'none' != oxo_get_option( Aione()->theme_options[ 'page_title_bar_bs' ], 'page_title_breadcrumbs_search_bar', $post_id ) ) : ?>
							<div class="oxo-page-title-secondary"><?php echo $secondary_content; ?></div>
						<?php endif; ?>
					<?php endif;?>
				</div>
			</div>
		</div>
		<?php
	}
}

add_filter( 'wp_nav_menu_items', 'aione_add_login_box_to_nav', 10, 3 );
/**
 * Add woocommerce cart to main navigation or top navigation
 * @param  string HTML for the main menu items
 * @param  args   Arguments for the WP menu
 * @return string
 */
if( ! function_exists( 'aione_add_login_box_to_nav' ) ) {
	function aione_add_login_box_to_nav( $items, $args ) {

		$ubermenu = false;

		if( function_exists( 'ubermenu_get_menu_instance_by_theme_location' ) && ubermenu_get_menu_instance_by_theme_location( $args->theme_location ) ) {
			// disable woo cart on ubermenu navigations
			$ubermenu = true;
		}

		if( $ubermenu == false ) {
			if( $args->theme_location == 'main_navigation' || $args->theme_location == 'top_navigation' || $args->theme_location == 'sticky_navigation' ) {
				if( $args->theme_location == 'main_navigation' || $args->theme_location == 'sticky_navigation' ) {
					$is_enabled = Aione()->theme_options[ 'woocommerce_acc_link_main_nav' ];
				} else if( $args->theme_location == 'top_navigation' ) {
					$is_enabled = Aione()->theme_options[ 'woocommerce_acc_link_top_nav' ];
				}

				if( class_exists( 'WooCommerce' ) && $is_enabled ) {
					$woo_account_page_link = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );
					$logout_link = wp_logout_url( get_permalink( woocommerce_get_page_id( 'myaccount' ) ) );

					if ( $woo_account_page_link ) {
						$items .= '<li class="oxo-custom-menu-item oxo-menu-login-box">';
							// If chosen in Theme Options, display the caret icon, as the my account item alyways has a dropdown
							$caret_icon = '';
							if ( Aione()->theme_options[ 'menu_display_dropdown_indicator' ] ) {
								$caret_icon = '<span class="oxo-caret"><i class="oxo-dropdown-indicator"></i></span>';
							}
							if ( 'right' == Aione()->theme_options[ 'header_position' ] ) {
								$my_account_link_contents = $caret_icon . __( 'My Account', 'Aione' );
							} else {
								$my_account_link_contents = __( 'My Account', 'Aione' ) . $caret_icon;
							}
							$items .= sprintf( '<a href="%s">%s</a>', $woo_account_page_link, $my_account_link_contents );
							if( ! is_user_logged_in() ) {
							$items .= '<div class="oxo-custom-menu-item-contents">';
								if( isset( $_GET['login'] ) && $_GET['login'] == 'failed' ) {
									$items .= sprintf( '<p class="oxo-menu-login-box-error">%s</p>', __( 'Login failed, please try again.', 'Aione' ) );
								}
								$items .= sprintf( '<form action="%s" name="loginform" method="post">', wp_login_url() );
									$items .= sprintf( '<p><input type="text" class="input-text" name="log" id="username" value="" placeholder="%s" /></p>', __( 'Username', 'Aione' ) );
									$items .= sprintf( '<p><input type="password" class="input-text" name="pwd" id="password" value="" placeholder="%s" /></p>', __( 'Password', 'Aione' ) );
									$items .= sprintf( '<p class="oxo-remember-checkbox"><label for="oxo-menu-login-box-rememberme"><input name="rememberme" type="checkbox" id="oxo-menu-login-box-rememberme" value="forever"> %s</label></p>', __( 'Remember Me', 'Aione' ) );
									$items .= '<input type="hidden" name="oxo_woo_login_box" value="true" />';
									$items .= sprintf( '<p class="oxo-login-box-submit">
															<input type="submit" name="wp-submit" id="wp-submit" class="button small default comment-submit" value="%s">
															<input type="hidden" name="redirect" value="%s">
														</p>', __( 'Log In', 'Aione' ), esc_url ( ( isset( $_SERVER['HTTP_REFERER'] ) ) ? $_SERVER['HTTP_REFERER'] : $_SERVER['REQUEST_URI'] ) );
								$items .= '</form>';
							$items .= '</div>';
							} else {
								$items .= '<ul class="sub-menu">';
									$items .= sprintf( '<li><a href="%s">%s</a></li>', $logout_link, __( 'Logout', 'Aione' ) );
								$items .= '</ul>';
							}
						$items .= '</li>';
					}
				}
			}
		}

		return $items;
	}
}

if( ! function_exists( 'aione_nav_woo_cart' ) ) {
	/**
	 * Woo Cart Dropdown for Main Nav or Top Nav
	 *
	 * @return string HTML of Dropdown
	 */
	function aione_nav_woo_cart( $position = 'main' ) {
		global $woocommerce;

		if( $position == 'main' ) {
			$is_enabled = Aione()->theme_options[ 'woocommerce_cart_link_main_nav' ];
			$main_cart_class = 'oxo-main-menu-cart';
			$cart_link_active_class = 'oxo-main-menu-icon oxo-main-menu-icon-active';
			$cart_link_active_text = '';

			if( Aione()->theme_options[ 'woocommerce_cart_counter'] ) {
					$cart_link_active_text = '<span class="oxo-widget-cart-number">' . $woocommerce->cart->get_cart_contents_count() . '</span>';
					$main_cart_class .= ' oxo-widget-cart-counter';
			}

			if( ! Aione()->theme_options[ 'woocommerce_cart_counter'] && $woocommerce->cart->get_cart_contents_count() ) {
				$main_cart_class .= ' oxo-active-cart-icons';
			}

			$cart_link_inactive_class = 'oxo-main-menu-icon';
			$cart_link_inactive_text = '';
		} else if( $position ='secondary' ) {
			$is_enabled = Aione()->theme_options[ 'woocommerce_cart_link_top_nav' ];
			$main_cart_class = 'oxo-secondary-menu-cart';
			$cart_link_active_class = 'oxo-secondary-menu-icon';
			$cart_link_active_text = sprintf('%s %s <span class="oxo-woo-cart-separator">-</span> %s', $woocommerce->cart->get_cart_contents_count(), __( 'Item(s)', 'Aione' ),wc_price( $woocommerce->cart->subtotal ) );
			$cart_link_inactive_class = $cart_link_active_class;
			$cart_link_inactive_text = __( 'Cart', 'Aione' );
		}

		if( class_exists( 'WooCommerce' ) && $is_enabled ) {
			$woo_cart_page_link = get_permalink( get_option( 'woocommerce_cart_page_id' ) );

			$items = sprintf( '<li class="oxo-custom-menu-item oxo-menu-cart %s">', $main_cart_class );
				if( $woocommerce->cart->get_cart_contents_count() ) {
					$checkout_link = get_permalink( get_option('woocommerce_checkout_page_id') );

					$items .= sprintf( '<a class="%s" href="%s">%s</a>', $cart_link_active_class, $woo_cart_page_link, $cart_link_active_text );

					$items .= '<div class="oxo-custom-menu-item-contents oxo-menu-cart-items">';
						foreach( $woocommerce->cart->cart_contents as $cart_item ) {
							$product_link = get_permalink( $cart_item['product_id'] );
							$thumbnail_id = ( $cart_item['variation_id'] && has_post_thumbnail( $cart_item['variation_id'] )  ) ? $cart_item['variation_id'] : $cart_item['product_id'];
							$items .= '<div class="oxo-menu-cart-item">';
								$items .= sprintf( '<a href="%s">', $product_link );
									$items .= get_the_post_thumbnail( $thumbnail_id, 'recent-works-thumbnail' );
									$items .= '<div class="oxo-menu-cart-item-details">';
										$items .= sprintf( '<span class="oxo-menu-cart-item-title">%s</span>', $cart_item['data']->post->post_title );
										$items .= sprintf( '<span class="oxo-menu-cart-item-quantity">%s x %s</span>', $cart_item['quantity'], $woocommerce->cart->get_product_subtotal( $cart_item['data'], 1 ) );
									$items .= '</div>';
								$items .= '</a>';
							$items .= '</div>';
						}
						$items .= '<div class="oxo-menu-cart-checkout">';
							$items .= sprintf( '<div class="oxo-menu-cart-link"><a href="%s">%s</a></div>', $woo_cart_page_link, __('View Cart', 'Aione') );
							$items .= sprintf( '<div class="oxo-menu-cart-checkout-link"><a href="%s">%s</a></div>', $checkout_link, __('Checkout', 'Aione') );
						$items .= '</div>';
					$items .= '</div>';
				} else {
					$items .= sprintf( '<a class="%s" href="%s">%s</a>', $cart_link_inactive_class, $woo_cart_page_link, $cart_link_inactive_text );
				}
			$items .= '</li>';

			return $items;
		}
	}
}

if( ! function_exists( 'oxo_add_woo_cart_to_widget_html' ) ) {
	function oxo_add_woo_cart_to_widget_html() {
		global $woocommerce;

		if( class_exists( 'WooCommerce') ) {
			$counter = '';
			$class = '';
			$items = '';

			if( Aione()->theme_options[ 'woocommerce_cart_counter'] ) {
					$counter = '<span class="oxo-widget-cart-number">' . $woocommerce->cart->get_cart_contents_count() . '</span>';
					$class = 'oxo-widget-cart-counter';
			}

			if( ! Aione()->theme_options[ 'woocommerce_cart_counter'] && $woocommerce->cart->get_cart_contents_count() ) {
				$class .= ' oxo-active-cart-icon';
			}

			$items .= '<li class="oxo-widget-cart ' . $class .'">
			<a href="' . get_permalink( get_option( 'woocommerce_cart_page_id' ) ) . '" class="">
				<span class="oxo-widget-cart-icon"></span>
				' . $counter . '
			</a>
			</li>';
		}

		return $items;
	}
}

if( class_exists( 'WooCommerce' ) ) {
	add_filter( 'wp_nav_menu_items', 'aione_add_woo_cart_to_nav', 10, 3 );
}
/**
 * Add woocommerce cart to main navigation or top navigation
 * @param  string HTML for the main menu items
 * @param  args   Arguments for the WP menu
 * @return string
 */
if( ! function_exists( 'aione_add_woo_cart_to_nav' ) ) {
	function aione_add_woo_cart_to_nav( $items, $args ) {
		global $woocommerce;

		$ubermenu = false;

		if( function_exists( 'ubermenu_get_menu_instance_by_theme_location' ) && ubermenu_get_menu_instance_by_theme_location( $args->theme_location ) ) {
			// disable woo cart on ubermenu navigations
			$ubermenu = true;
		}

		if( $ubermenu == false && $args->theme_location == 'main_navigation' || $args->theme_location == 'sticky_navigation' ) {
			$items .= aione_nav_woo_cart( 'main' );
		} else if( $ubermenu == false && $args->theme_location == 'top_navigation' ) {
			$items .= aione_nav_woo_cart( 'secondary' );
		}

		return $items;
	}
}
add_filter( 'wp_nav_menu_items', 'aione_add_search_to_main_nav', 20, 4 );
/**
 * Add search to the main navigation
 * @param  string HTML for the main menu items
 * @param  args   Arguments for the WP menu
 * @return string
 */
if( ! function_exists( 'aione_add_search_to_main_nav' ) ) {
	function aione_add_search_to_main_nav( $items, $args ) {
		$ubermenu = false;

		if( function_exists( 'ubermenu_get_menu_instance_by_theme_location' ) && ubermenu_get_menu_instance_by_theme_location( $args->theme_location ) ) {
			// disable woo cart on ubermenu navigations
			$ubermenu = true;
		}

		if( $ubermenu == false ) {
			if( $args->theme_location == 'main_navigation'  || $args->theme_location == 'sticky_navigation' ) {
				if( Aione()->theme_options[ 'main_nav_search_icon' ] ) {
					$items .= '<li class="oxo-custom-menu-item oxo-main-menu-search">';
						$items .= '<a class="oxo-main-menu-icon"></a>';
						$items .= '<div class="oxo-custom-menu-item-contents">';
							$items .= get_search_form( false );
						$items .= '</div>';
					$items .= '</li>';
				}
			}
		}

		return $items;
	}
}

if( ! function_exists( 'aione_update_featured_content_for_split_terms' ) ) {
	function aione_update_featured_content_for_split_terms( $old_term_id, $new_term_id, $term_taxonomy_id, $taxonomy ) {
		if( 'portfolio_category' == $taxonomy ) {
			$pages = get_pages();

			if( $pages ) {
				foreach( $pages as $page ) {
					$page_id = $page->ID;
					$categories = get_post_meta( $page_id, 'pyre_portfolio_category', true );
					$new_categories = array();
					if( $categories ) {
						foreach( $categories as $category ) {
							if( $category != '0' ) {
								if ( isset( $category ) && $old_term_id == $category ) {
									$new_categories[] = $new_term_id;
								} else {
									$new_categories[] = $category;
								}
							} else {
								$new_categories[] = '0';
							}
						}

						update_post_meta( $page_id, 'pyre_portfolio_category', $new_categories );
					}
				}
			}
		}
	}

	add_action( 'split_shared_term', 'aione_update_featured_content_for_split_terms', 10, 4 );
}

// Omit closing PHP tag to avoid "Headers already sent" issues.