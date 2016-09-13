<?php
/**
 * Oxo Framework
 *
 * WARNING: This file is part of the Oxo Core Framework.
 * Do not edit the core files.
 * Add any modifications necessary under a child theme.
 *
 * @version: 1.0.0
 * @package  Oxo/Template
 * @author   OXOSolutions
 * @link	 http://oxosolutions.com
 */

// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) {
	die;
}

// Add the first level menu style dropdown to the menu fields
add_action( 'wp_nav_menu_item_custom_fields', 'aione_add_menu_button_fields', 10, 4 );
function aione_add_menu_button_fields( $item_id, $item, $depth, $args ) {
	$name  = 'menu-item-oxo-menu-style';
	?>
	<p class="description description-wide oxo-menu-style">
		<label for="<?php echo $name . '-' . $item_id; ?>>">
			<?php _e( 'Menu First Level Style', 'Aione' ); ?><br />
			<select id="<?php echo $name . '-' . $item_id; ?>" class="widefat edit-menu-item-target" name="<?php echo $name . '[' . $item_id . ']'; ?>">
				<option value="" <?php selected( $item->oxo_menu_style,  '' ); ?>><?php _e('Default Style', 'Aione' ); ?></option>
				<option value="oxo-button-small"	<?php selected( $item->oxo_menu_style,  'oxo-button-small' ); ?>	><?php _e('Button Small', 'Aione' ); ?></option>
				<option value="oxo-button-medium" <?php selected( $item->oxo_menu_style,  'oxo-button-medium' ); ?>	><?php _e('Button Medium', 'Aione' ); ?></option>
				<option value="oxo-button-large"	<?php selected( $item->oxo_menu_style,  'oxo-button-large' ); ?>	><?php _e('Button Large', 'Aione' ); ?></option>
				<option value="oxo-button-xlarge" <?php selected( $item->oxo_menu_style,  'oxo-button-xlarge' ); ?>	><?php _e('Button xLarge', 'Aione' ); ?></option>
			</select>
		</label>
	</p>
	<p class="field-megamenu-icon description description-wide">
		<label for="edit-menu-item-megamenu-icon-<?php echo $item_id; ?>">
			<?php _e( 'Menu Icon (use full font awesome name)', 'Aione' ); ?>
			<input type="text" id="edit-menu-item-megamenu-icon-<?php echo $item_id; ?>" class="widefat code edit-menu-item-megamenu-icon" name="menu-item-oxo-megamenu-icon[<?php echo $item_id; ?>]" value="<?php echo $item->oxo_megamenu_icon; ?>" />
		</label>
	</p>
<?php }

// Add the mega menu custom fields to the menu fields
if ( ! Aione()->theme_options[ 'disable_megamenu' ] ) {
	add_action( 'wp_nav_menu_item_custom_fields', 'aione_add_megamenu_fields', 20, 4 );
}
function aione_add_megamenu_fields( $item_id, $item, $depth, $args ) { ?>
	<div class="clear"></div>
	<div class="oxo-mega-menu-options">
		<p class="field-megamenu-status description description-wide">
			<label for="edit-menu-item-megamenu-status-<?php echo $item_id; ?>">
				<input type="checkbox" id="edit-menu-item-megamenu-status-<?php echo $item_id; ?>" class="widefat code edit-menu-item-megamenu-status" name="menu-item-oxo-megamenu-status[<?php echo $item_id; ?>]" value="enabled" <?php checked( $item->oxo_megamenu_status, 'enabled' ); ?> />
				<strong><?php _e( 'Enable Oxo Mega Menu (only for main menu)', 'Aione' ); ?></strong>
			</label>
		</p>
		<p class="field-megamenu-width description description-wide">
			<label for="edit-menu-item-megamenu-width-<?php echo $item_id; ?>">
				<input type="checkbox" id="edit-menu-item-megamenu-width-<?php echo $item_id; ?>" class="widefat code edit-menu-item-megamenu-width" name="menu-item-oxo-megamenu-width[<?php echo $item_id; ?>]" value="fullwidth" <?php checked( $item->oxo_megamenu_width, 'fullwidth' ); ?> />
				<?php _e( 'Full Width Mega Menu (overrides column width)', 'Aione' ); ?>
			</label>
		</p>
		<p class="field-megamenu-columns description description-wide">
			<label for="edit-menu-item-megamenu-columns-<?php echo $item_id; ?>">
				<?php _e( 'Mega Menu Number of Columns', 'Aione' ); ?>
				<select id="edit-menu-item-megamenu-columns-<?php echo $item_id; ?>" class="widefat code edit-menu-item-megamenu-columns" name="menu-item-oxo-megamenu-columns[<?php echo $item_id; ?>]">
					<option value="auto" <?php selected( $item->oxo_megamenu_columns, 'auto' ); ?>><?php _e( 'Auto', 'Aione' ); ?></option>
					<option value="1" <?php selected( $item->oxo_megamenu_columns, '1' ); ?>>1</option>
					<option value="2" <?php selected( $item->oxo_megamenu_columns, '2' ); ?>>2</option>
					<option value="3" <?php selected( $item->oxo_megamenu_columns, '3' ); ?>>3</option>
					<option value="4" <?php selected( $item->oxo_megamenu_columns, '4' ); ?>>4</option>
					<option value="5" <?php selected( $item->oxo_megamenu_columns, '5' ); ?>>5</option>
					<option value="6" <?php selected( $item->oxo_megamenu_columns, '6' ); ?>>6</option>
				</select>
			</label>
		</p>
		<p class="field-megamenu-columnwidth description description-wide">
			<label for="edit-menu-item-megamenu-columnwidth-<?php echo $item_id; ?>">
				<?php _e( 'Mega Menu Column Width (in percentage, ex: 30%)', 'Aione' ); ?>
				<input type="text" id="edit-menu-item-megamenu-columnwidth-<?php echo $item_id; ?>" class="widefat code edit-menu-item-megamenu-columnwidth" name="menu-item-oxo-megamenu-columnwidth[<?php echo $item_id; ?>]" value="<?php echo $item->oxo_megamenu_columnwidth; ?>" />
			</label>
		</p>
		<p class="field-megamenu-title description description-wide">
			<label for="edit-menu-item-megamenu-title-<?php echo $item_id; ?>">
				<input type="checkbox" id="edit-menu-item-megamenu-title-<?php echo $item_id; ?>" class="widefat code edit-menu-item-megamenu-title" name="menu-item-oxo-megamenu-title[<?php echo $item_id; ?>]" value="disabled" <?php checked( $item->oxo_megamenu_title, 'disabled' ); ?> />
				<?php _e( 'Disable Mega Menu Column Title', 'Aione' ); ?>
			</label>
		</p>
		<p class="field-megamenu-widgetarea description description-wide">
			<label for="edit-menu-item-megamenu-widgetarea-<?php echo $item_id; ?>">
				<?php _e( 'Mega Menu Widget Area', 'Aione' ); ?>
				<select id="edit-menu-item-megamenu-widgetarea-<?php echo $item_id; ?>" class="widefat code edit-menu-item-megamenu-widgetarea" name="menu-item-oxo-megamenu-widgetarea[<?php echo $item_id; ?>]">
					<option value="0"><?php _e( 'Select Widget Area', 'Aione' ); ?></option>
					<?php
					global $wp_registered_sidebars;
					if( ! empty( $wp_registered_sidebars ) && is_array( $wp_registered_sidebars ) ):
					foreach( $wp_registered_sidebars as $sidebar ):
					?>
					<option value="<?php echo $sidebar['id']; ?>" <?php selected( $item->oxo_megamenu_widgetarea, $sidebar['id'] ); ?>><?php echo $sidebar['name']; ?></option>
					<?php endforeach; endif; ?>
				</select>
			</label>
		</p>
		<a href="#" id="oxo-media-upload-<?php echo $item_id; ?>" class="oxo-open-media button button-primary oxo-megamenu-upload-thumbnail"><?php _e( 'Set Thumbnail', 'Aione' ); ?></a>
		<p class="field-megamenu-thumbnail description description-wide">
			<label for="edit-menu-item-megamenu-thumbnail-<?php echo $item_id; ?>">
				<input type="hidden" id="edit-menu-item-megamenu-thumbnail-<?php echo $item_id; ?>" class="oxo-new-media-image widefat code edit-menu-item-megamenu-thumbnail" name="menu-item-oxo-megamenu-thumbnail[<?php echo $item_id; ?>]" value="<?php echo $item->oxo_megamenu_thumbnail; ?>" />
				<img src="<?php echo $item->oxo_megamenu_thumbnail; ?>" id="oxo-media-img-<?php echo $item_id; ?>" class="oxo-megamenu-thumbnail-image" style="<?php echo ( trim( $item->oxo_megamenu_thumbnail ) ) ? 'display: inline;' : '';?>" />
				<a href="#" id="oxo-media-remove-<?php echo $item_id; ?>" class="remove-oxo-megamenu-thumbnail" style="<?php echo ( trim( $item->oxo_megamenu_thumbnail ) ) ? 'display: inline;' : '';?>">Remove Image</a>
			</label>
		</p>
	</div><!-- .oxo-mega-menu-options-->
<?php }

// Dont duplicate me!
if( ! class_exists( 'OxoCoreFrontendWalker' ) ) {
	class OxoCoreFrontendWalker extends Walker_Nav_Menu {

		/**
		 * @var string $menu_style do we use default styling or a button
		 */
		private $menu_style = "";

		/**
		 * @var string $menu_megamenu_status are we currently rendering a mega menu?
		 */
		private $menu_megamenu_status = "";

		/**
		 * @var string $menu_megamenu_width use full width mega menu?
		 */
		private $menu_megamenu_width = "";

		/**
		 * @var int $num_of_columns how many columns should the mega menu have?
		 */
		private $num_of_columns = 0;

		/**
		 * @var int $max_num_of_columns mega menu allow for 6 columns at max
		 */
		private $max_num_of_columns = 6;

		/**
		 * @var int $total_num_of_columns total number of columns for a single megamenu?
		 */
		private $total_num_of_columns = 0;

		/**
		 * @var int $num_of_rows number of rows in the mega menu
		 */
		private $num_of_rows = 1;

		/**
		 * @var array $submenu_matrix holds number of columns per row
		 */
		private $submenu_matrix = array();

		/**
		 * @var float $menu_megamenu_columnwidth how large is the width of a column?
		 */
		private $menu_megamenu_columnwidth = 0;

		/**
		 * @var array $menu_megamenu_rowwidth_matrix how large is the width of each row?
		 */
		private $menu_megamenu_rowwidth_matrix = array();

		/**
		 * @var float $menu_megamenu_maxwidth how large is the overall width of a column?
		 */
		private $menu_megamenu_maxwidth = 0;

		/**
		 * @var string $menu_megamenu_title should a colum title be displayed?
		 */
		private $menu_megamenu_title = '';

		/**
		 * @var string $menu_megamenu_widget_area should one column be a widget area?
		 */
		private $menu_megamenu_widget_area = '';

		/**
		 * @var string $menu_megamenu_icon does the item have an icon?
		 */
		private $menu_megamenu_icon = '';

		/**
		 * @var string $menu_megamenu_thumbnail does the item have a thumbnail?
		 */
		private $menu_megamenu_thumbnail = '';

		/**
		 * Sets the overall width of the megamenu wrappers
		 *
		 */
		private function set_megamenu_max_width() {

			// Set overall width of megamenu
			$site_width = (int) str_replace( 'px', '', Aione()->settings->get( 'site_width' ) );
			$megamenu_max_width = (int) str_replace( 'px', '', Aione()->settings->get( 'megamenu_max_width' ) );
			$megmanu_width = 0;

			// Site width in px
			if ( strpos( Aione()->settings->get( 'site_width' ), 'px' ) !== false ) {
				if ( $site_width > $megamenu_max_width &&
					 $megamenu_max_width > 0
				) {
					$megamenu_width = $megamenu_max_width;
				} else {
					$megamenu_width = $site_width;
				}
			// Site width in %
			} else {
				$megamenu_width = $megamenu_max_width;
			}
			$this->menu_megamenu_maxwidth = $megamenu_width;
		}

		/**
		 * @see Walker::start_lvl()
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param int $depth Depth of page. Used for padding.
		 */
		public function start_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat( "\t", $depth );

			if( $depth === 0 && $this->menu_megamenu_status == "enabled" ) {
				// set overall width of megamenu
				if( ! $this->menu_megamenu_maxwidth ) {
					$this->set_megamenu_max_width();
				}

				$output .= "\n{first_level}\n";
				$output .= "\n$indent<div class=\"oxo-megamenu-holder\" {megamenu_final_width}>\n<ul class='oxo-megamenu {megamenu_border}'>\n";
			} elseif( $depth >= 2 && $this->menu_megamenu_status == "enabled" ) {
				$output .= "\n$indent<ul class=\"sub-menu deep-level\">\n";
			} else {
				$output .= "\n$indent<ul class=\"sub-menu\">\n";
			}
		}

		/**
		 * @see Walker::end_lvl()
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param int $depth Depth of page. Used for padding.
		 */
		public function end_lvl( &$output, $depth = 0, $args = array() ) {

			$indent = str_repeat( "\t", $depth );
			$row_width = '';

			if( $depth === 0  && $this->menu_megamenu_status == "enabled" ) {

				$output .= "\n</ul>\n</div><div style='clear:both;'></div>\n</div>\n</div>\n";

				if( $this->total_num_of_columns < $this->max_num_of_columns ) {
					$col_span = " col-span-" . $this->total_num_of_columns * 2;
				} else {
					$col_span = " col-span-" . $this->max_num_of_columns * 2;
				}

				if ( $this->menu_megamenu_width == "fullwidth" ) {
					$col_span = " col-span-12 oxo-megamenu-fullwidth";
					// overall megamenu wrapper width in px is max width for fullwidth megamenu
					$wrapper_width = $this->menu_megamenu_maxwidth;
				} else {
					// calc overall megamenu wrapper width in px
					$wrapper_width = max( $this->menu_megamenu_rowwidth_matrix ) * $this->menu_megamenu_maxwidth;
				}

				$output = str_replace( "{first_level}", "<div class='oxo-megamenu-wrapper {oxo_columns} columns-".$this->total_num_of_columns . $col_span . "' data-maxwidth='" . $this->menu_megamenu_maxwidth . "'><div class='row'>", $output );

				$output = str_replace( "{megamenu_final_width}", sprintf( 'style="width:%spx;" data-width="%s"', $wrapper_width, $wrapper_width ), $output );

				if ( $this->total_num_of_columns > $this->max_num_of_columns ) {
					$output = str_replace( "{megamenu_border}","oxo-megamenu-border", $output );
				} else {
					$output = str_replace( "{megamenu_border}","", $output );
				}

				foreach($this->submenu_matrix as $row => $columns) {
					$layout_columns = 12 / $columns;
					if( $columns == '5' ) {
						$layout_columns = 2;
					}

					if( $columns < $this->max_num_of_columns ) {
						$row_width = "style=\"width:" . $columns / $this->max_num_of_columns * 100 . "%!important;\"";
					}

					$output = str_replace( "{row_width_".$row."}", $row_width, $output);

					if( ( $row - 1 ) * $this->max_num_of_columns + $columns < $this->total_num_of_columns ) {
						$output = str_replace( "{row_number_".$row."}", "oxo-megamenu-row-columns-" . $columns . " oxo-megamenu-border", $output);
					} else {
						$output = str_replace( "{row_number_".$row."}", "oxo-megamenu-row-columns-" . $columns, $output);
					}
					$output = str_replace( "{current_row_".$row."}", "oxo-megamenu-columns-".$columns." col-lg-" . $layout_columns . " col-md-" . $layout_columns . " col-sm-" . $layout_columns, $output );

					$output = str_replace( "{oxo_columns}", sprintf( 'oxo-columns-%s columns-per-row-%s', $columns, $columns ), $output );
				}
			} else {
				$output .= "$indent</ul>\n";
			}
		}

		/**
		 * @see Walker::start_el()
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $item Menu item data object.
		 * @param int $depth Depth of menu item. Used for padding.
		 * @param int $current_page Menu item ID.
		 * @param object $args
		 */
		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

			$item_output = $class_columns = '';
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

			// Set some vars
			// Megamenu is enabled
			if ( ! Aione()->theme_options[ 'disable_megamenu' ] ) {
				if( $depth === 0 ) {
					$this->menu_megamenu_status = get_post_meta( $item->ID, '_menu_item_oxo_megamenu_status', true );
					$this->menu_megamenu_width = get_post_meta( $item->ID, '_menu_item_oxo_megamenu_width', true);
					$allowed_columns = get_post_meta( $item->ID, '_menu_item_oxo_megamenu_columns', true );
					if( $allowed_columns != "auto" ) {
						$this->max_num_of_columns = $allowed_columns;
					}
					$this->num_of_columns = $this->total_num_of_columns = 0;
					$this->num_of_rows = 1;
					$this->menu_megamenu_rowwidth_matrix = array();
					$this->menu_megamenu_rowwidth_matrix[$this->num_of_rows] = 0;
				}

				$this->menu_style = get_post_meta( $item->ID, '_menu_item_oxo_menu_style', true );
				$this->menu_megamenu_title = get_post_meta( $item->ID, '_menu_item_oxo_megamenu_title', true);
				$this->menu_megamenu_widgetarea = get_post_meta( $item->ID, '_menu_item_oxo_megamenu_widgetarea', true);
				$this->menu_megamenu_icon = get_post_meta( $item->ID, '_menu_item_oxo_megamenu_icon', true);
				$this->menu_megamenu_thumbnail = get_post_meta( $item->ID, '_menu_item_oxo_megamenu_thumbnail', true);
			// Megamenu is disabled
			} else {
				$this->menu_megamenu_status = 'disabled';
				$this->menu_style = get_post_meta( $item->ID, '_menu_item_oxo_menu_style', true );
				$this->menu_megamenu_icon = get_post_meta( $item->ID, '_menu_item_oxo_megamenu_icon', true);
			}
			/* we are inside a mega menu */
			if( $depth === 1 && $this->menu_megamenu_status == "enabled" ) {

				if( get_post_meta( $item->ID, '_menu_item_oxo_megamenu_columnwidth', true) ) {
					$this->menu_megamenu_columnwidth = get_post_meta( $item->ID, '_menu_item_oxo_megamenu_columnwidth', true);
				} else {
					if ( $this->menu_megamenu_width == "fullwidth" ) {
						$this->menu_megamenu_columnwidth = 100 / $this->max_num_of_columns . '%';
					} else {
						$this->menu_megamenu_columnwidth = '16.6666%';
					}
				}

				$this->num_of_columns++;
				$this->total_num_of_columns++;

				/* check if we need to start a new row */
				if( $this->num_of_columns > $this->max_num_of_columns ) {
					$this->num_of_columns = 1;
					$this->num_of_rows++;

					// start new row width calculation
					$this->menu_megamenu_rowwidth_matrix[$this->num_of_rows] =  floatval( $this->menu_megamenu_columnwidth ) / 100;

					$output .= "\n</ul>\n<ul class=\"oxo-megamenu oxo-megamenu-row-".$this->num_of_rows." {row_number_".$this->num_of_rows."}\" {row_width_".$this->num_of_rows."}>\n";
				} else {
					$this->menu_megamenu_rowwidth_matrix[$this->num_of_rows] +=  floatval( $this->menu_megamenu_columnwidth ) / 100;
				}

				$this->submenu_matrix[$this->num_of_rows] = $this->num_of_columns;

				if( $this->max_num_of_columns < $this->num_of_columns ) {
					$this->max_num_of_columns = $this->num_of_columns;
				}

				$title = apply_filters( 'the_title', $item->title, $item->ID );

				if( !(
						( empty( $item->url ) || $item->url == "#" || $item->url == 'http://' )  &&
						$this->menu_megamenu_title == 'disabled'
					)
				) {
					$heading = do_shortcode($title);
					$link = '';
					$link_closing = '';

					if( ! empty( $item->url ) &&
						$item->url != "#" &&
						$item->url != 'http://'
					) {
						$link = '<a href="' . $item->url . '">';
						$link_closing = '</a>';
					}

					/* check if we need to set an image */
					$title_enhance = '';
					if ( ! empty( $this->menu_megamenu_thumbnail ) ) {
						$title_enhance = '<span class="oxo-megamenu-icon"><img src="' . $this->menu_megamenu_thumbnail . '"></span>';
					} elseif( ! empty( $this->menu_megamenu_icon ) ) {
						$title_enhance = '<span class="oxo-megamenu-icon"><i class="fa glyphicon ' . aione_font_awesome_name_handler( $this->menu_megamenu_icon) . '"></i></span>';
					} elseif($this->menu_megamenu_title == 'disabled') {
						$title_enhance = '<span class="oxo-megamenu-bullet"></span>';
					}

					$heading = sprintf( '%s%s%s%s', $link, $title_enhance, $title, $link_closing );

					if( $this->menu_megamenu_title != 'disabled' ) {
						$item_output .= "<div class='oxo-megamenu-title'>" . $heading . "</div>";
					} else {
						$item_output .= $heading;
					}
				}

				if( $this->menu_megamenu_widgetarea &&
					is_active_sidebar( $this->menu_megamenu_widgetarea )
				) {
					$item_output .= '<div class="oxo-megamenu-widgets-container second-level-widget">';
					ob_start();
						dynamic_sidebar( $this->menu_megamenu_widgetarea );

					$item_output .= ob_get_clean() . '</div>';
				}

				$class_columns  = ' {current_row_'.$this->num_of_rows.'}';

			} else if( $depth === 2 && $this->menu_megamenu_status == "enabled" && $this->menu_megamenu_widgetarea ) {

				if( is_active_sidebar( $this->menu_megamenu_widgetarea ) ) {
					$item_output .= '<div class="oxo-megamenu-widgets-container third-level-widget">';
					ob_start();
						dynamic_sidebar( $this->menu_megamenu_widgetarea );

					$item_output .= ob_get_clean() . '</div>';
				}

			} else {

				$atts = array();
				$atts['title']  = ! empty( $item->attr_title )	? esc_attr( $item->attr_title ) : '';
				$atts['target'] = ! empty( $item->target )		? esc_attr( $item->target ) : '';
				$atts['rel']	= ! empty( $item->xfn )			? esc_attr( $item->xfn ) : '';
				$atts['href']	= ! empty( $item->url )		 	? esc_attr( $item->url ) : '';

				$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

				$attributes = '';
				foreach ( $atts as $attr => $value ) {
					if ( ! empty( $value ) ) {
						$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
						$attributes .= ' ' . $attr . '="' . $value . '"';
					}
				}

				$item_output .= sprintf( '%s<a %s>', $args->before, $attributes );

				// For right side header add the caret icon at the beginning
				if ( $depth === 0 &&
					 $args->has_children &&
					 Aione()->theme_options[ 'menu_display_dropdown_indicator' ] &&
					 Aione()->theme_options['header_position'] == 'right'
				) {
					$item_output .= ' <span class="oxo-caret"><i class="oxo-dropdown-indicator"></i></span>';
				}


				// Check if we need to set an image
				$icon_wrapper_class = 'oxo-megamenu-icon';
				if ( $depth === 0 &&
					 $this->menu_style
				) {
					if ( is_rtl() ) {
						$icon_wrapper_class = 'button-icon-divider-right';
					} else {
						$icon_wrapper_class = 'button-icon-divider-left';
					}
				}

				$icon = '';
				if ( ! empty( $this->menu_megamenu_thumbnail ) && $this->menu_megamenu_status == "enabled" ) {
					$icon = '<span class="' . $icon_wrapper_class . ' oxo-megamenu-image"><img src="' . $this->menu_megamenu_thumbnail . '"></span>';
				} elseif( ! empty( $this->menu_megamenu_icon ) ) {
					$icon = '<span class="' . $icon_wrapper_class . '"><i class="fa glyphicon ' . $this->menu_megamenu_icon . '"></i></span>';
				} elseif ( $depth !== 0 && $this->menu_megamenu_status == "enabled" ) {
					$icon = '<span class="oxo-megamenu-bullet"></span>';
				}

				$classes = '';
				// Check if we have a menu button
				if ( $depth === 0 ) {
					if ( $this->menu_style ) {
						$classes .= sprintf( 'menu-text oxo-button button-default %s', str_replace( 'oxo-', '', $this->menu_style ) );

						// Button should have §D effect
						if ( Aione()->settings->get( 'button_type' ) == '3d' ) {
							$classes .= ' button-3d';
						}
					} else {
						$classes = 'menu-text';
					}

					$item_output .=  sprintf( '<span class="%s">%s', $classes, $icon );
				// Normal menu item
				} else {
					$item_output .=  sprintf( '%s<span class="%s">', $icon, $classes );
				}

				$title = $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

				if ( strpos( $icon, 'button-icon-divider-left' ) !== FALSE ) {
					$title =  sprintf( '<span class="oxo-button-text-left">%s</span>', $title );
				} elseif ( strpos( $icon, 'button-icon-divider-right' ) !== FALSE ) {
					$title =  sprintf( '<span class="oxo-button-text-right">%s</span>', $title );
				}

				$item_output .= $title;

				$item_output .=  '</span>';

				// For top header and left side header add the caret icon at the end
				if ( $depth === 0 &&
					 $args->has_children &&
					 Aione()->theme_options[ 'menu_display_dropdown_indicator' ] &&
					 Aione()->theme_options['header_position'] != 'right'
				) {
					$item_output .= ' <span class="oxo-caret"><i class="oxo-dropdown-indicator"></i></span>';
				}

				$item_output .= '</a>' . $args->after;

			}

			/* check if we need to apply a divider */
			if ( $this->menu_megamenu_status != "enabled" && ( ( strcasecmp( $item->attr_title, 'divider' ) == 0) ||
				 ( strcasecmp( $item->title, 'divider' ) == 0 ) )
			) {
				$output .= $indent . '<li role="presentation" class="divider">';
			} else {

				$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

				$class_names = '';
				$column_width = '';
				$classes = empty( $item->classes ) ? array() : ( array ) $item->classes;
				$classes[] = 'menu-item-' . $item->ID;

				$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );


				if( $depth === 0 && $args->has_children ) {
					if( $this->menu_megamenu_status == "enabled" ) {
						$class_names .= ' oxo-megamenu-menu';
					} else {
						$class_names .= ' oxo-dropdown-menu';
					}
				}

				if ( $depth === 0 &&
					 $this->menu_style
				) {
					$class_names .= ' oxo-menu-item-button';
				}

				if ( $depth === 1 ) {
					if( $this->menu_megamenu_status == "enabled" ) {
						$class_names .= ' oxo-megamenu-submenu';

						if( $this->menu_megamenu_title == 'disabled' ) {
							$class_names .= ' oxo-megamenu-submenu-notitle';
						}

						if ( $this->menu_megamenu_width != "fullwidth" ) {
							$width = $this->menu_megamenu_maxwidth * floatval( $this->menu_megamenu_columnwidth ) / 100;
							$column_width = sprintf( 'style="width:%spx;max-width:%spx;" data-width="%s"', $width, $width, $width );
						}
					} else {
						$class_names .= ' oxo-dropdown-submenu';
					}
				}

				$class_names = $class_names ? ' class="' . esc_attr( $class_names ). $class_columns . '"' : '';

				$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
				$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

				$output .= sprintf( '%s<li %s %s %s >', $indent, $id, $class_names, $column_width );

				$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
			}
		}

		/**
		 * @see Walker::end_el()
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $item Page data object. Not used.
		 * @param int $depth Depth of page. Not Used.
		 */
		function end_el( &$output, $item, $depth = 0, $args = array() ) {
			$output .= "</li>\n";
		}

		/**
		 * Traverse elements to create list from elements.
		 *
		 * Display one element if the element doesn't have any children otherwise,
		 * display the element and its children. Will only traverse up to the max
		 * depth and no ignore elements under that depth.
		 *
		 * This method shouldn't be called directly, use the walk() method instead.
		 *
		 * @see Walker::start_el()
		 * @since 2.5.0
		 *
		 * @param object $element Data object
		 * @param array $children_elements List of elements to continue traversing.
		 * @param int $max_depth Max depth to traverse.
		 * @param int $depth Depth of current element.
		 * @param array $args
		 * @param string $output Passed by reference. Used to append additional content.
		 * @return null Null on failure with no changes to parameters.
		 */
		public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
			if ( ! $element )
				return;

			$id_field = $this->db_fields['id'];

			// Display this element.
			if ( is_object( $args[0] ) )
			   $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );

			parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}

		/**
		 * Menu Fallback
		 * =============
		 * If this function is assigned to the wp_nav_menu's fallback_cb variable
		 * and a manu has not been assigned to the theme location in the WordPress
		 * menu manager the function with display nothing to a non-logged in user,
		 * and will add a link to the WordPress menu manager if logged in as an admin.
		 *
		 * @param array $args passed from the wp_nav_menu function.
		 *
		 */
		public static function fallback( $args ) {
			if ( current_user_can( 'manage_options' ) ) {

				extract( $args );

				$fb_output = null;

				/*if ( $container ) {
					$fb_output = '<' . $container;

					if ( $container_id )
						$fb_output .= ' id="' . $container_id . '"';

					if ( $container_class )
						$fb_output .= ' class="' . $container_class . '"';

					$fb_output .= '>';
				}

				$fb_output .= '<ul';

				if ( $menu_id )
					$fb_output .= ' id="' . $menu_id . '"';

				if ( $menu_class )
					$fb_output .= ' class="' . $menu_class . '"';

				$fb_output .= '>';
				$fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">Add a menu</a></li>';
				$fb_output .= '</ul>';
				*/
				return $fb_output;
			}
		}
	}  // end OxoCoreFrontendWalker() class
}

// Don't duplicate me!
if( ! class_exists( 'OxoCoreMegaMenus' ) ) {

	class OxoCoreMegaMenus extends Walker_Nav_Menu {

		/**
		 * Starts the list before the elements are added.
		 *
		 * @see Walker_Nav_Menu::start_lvl()
		 *
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference.
		 * @param int	$depth  Depth of menu item. Used for padding.
		 * @param array  $args   Not used.
		 */
		function start_lvl( &$output, $depth = 0, $args = array() ) {}

		/**
		 * Ends the list of after the elements are added.
		 *
		 * @see Walker_Nav_Menu::end_lvl()
		 *
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference.
		 * @param int	$depth  Depth of menu item. Used for padding.
		 * @param array  $args   Not used.
		 */
		function end_lvl( &$output, $depth = 0, $args = array() ) {}

		/**
		 * Start the element output.
		 *
		 * @see Walker_Nav_Menu::start_el()
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $item   Menu item data object.
		 * @param int	$depth  Depth of menu item. Used for padding.
		 * @param array  $args   Not used.
		 * @param int	$id	 Not used.
		 */
		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			global $_wp_nav_menu_max_depth, $wp_registered_sidebars;
			$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

			ob_start();
			$item_id = esc_attr( $item->ID );
			$removed_args = array(
				'action',
				'customlink-tab',
				'edit-menu-item',
				'menu-item',
				'page-tab',
				'_wpnonce',
			);

			$original_title = '';
			if ( 'taxonomy' == $item->type ) {
				$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
				if ( is_wp_error( $original_title ) )
					$original_title = false;
			} elseif ( 'post_type' == $item->type ) {
				$original_object = get_post( $item->object_id );
				$original_title = get_the_title( $original_object->ID );
			}

			$classes = array(
				'menu-item menu-item-depth-' . $depth,
				'menu-item-' . esc_attr( $item->object ),
				'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
			);

			$title = $item->title;

			if ( ! empty( $item->_invalid ) ) {
				$classes[] = 'menu-item-invalid';
				/* translators: %s: title of menu item which is invalid */
				$title = sprintf( __( '%s (Invalid)', 'Aione'), $item->title );
			} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
				$classes[] = 'pending';
				/* translators: %s: title of menu item in draft status */
				$title = sprintf( __('%s (Pending)', 'Aione'), $item->title );
			}

			$title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

			$submenu_text = '';
			if ( 0 == $depth )
				$submenu_text = 'style="display: none;"';

			?>
			<li id="menu-item-<?php echo $item_id; ?>" class="<?php echo implode(' ', $classes ); ?>">
				<dl class="menu-item-bar">
					<dt class="menu-item-handle">
						<span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu" <?php echo $submenu_text; ?>><?php _e( 'sub item' , 'Aione'); ?></span></span>
						<span class="item-controls">
							<span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
							<span class="item-order hide-if-js">
								<a href="<?php
									echo esc_url( wp_nonce_url(
										add_query_arg(
											array(
												'action' => 'move-up-menu-item',
												'menu-item' => $item_id,
											),
											remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
										),
										'move-menu_item'
									) );
								?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up', 'Aione'); ?>">&#8593;</abbr></a>
								|
								<a href="<?php
									echo esc_url( wp_nonce_url(
										add_query_arg(
											array(
												'action' => 'move-down-menu-item',
												'menu-item' => $item_id,
											),
											remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
										),
										'move-menu_item'
									) );
								?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down', 'Aione'); ?>">&#8595;</abbr></a>
							</span>
							<a class="item-edit" id="edit-<?php echo $item_id; ?>" title="<?php esc_attr_e('Edit Menu Item', 'Aione'); ?>" href="<?php
								echo esc_url( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) ) );
							?>"><?php _e( 'Edit Menu Item', 'Aione' ); ?></a>
						</span>
					</dt>
				</dl>

				<div class="menu-item-settings" id="menu-item-settings-<?php echo $item_id; ?>">
					<?php if( 'custom' == $item->type ) : ?>
						<p class="field-url description description-wide">
							<label for="edit-menu-item-url-<?php echo $item_id; ?>">
								<?php _e( 'URL', 'Aione' ); ?><br />
								<input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
							</label>
						</p>
					<?php endif; ?>
					<p class="description description-thin">
						<label for="edit-menu-item-title-<?php echo $item_id; ?>">
							<?php _e( 'Navigation Label', 'Aione' ); ?><br />
							<input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
						</label>
					</p>
					<p class="description description-thin">
						<label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
							<?php _e( 'Title Attribute', 'Aione' ); ?><br />
							<input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
						</label>
					</p>
					<p class="field-link-target description">
						<label for="edit-menu-item-target-<?php echo $item_id; ?>">
							<input type="checkbox" id="edit-menu-item-target-<?php echo $item_id; ?>" value="_blank" name="menu-item-target[<?php echo $item_id; ?>]"<?php checked( $item->target, '_blank' ); ?> />
							<?php _e( 'Open link in a new window/tab', 'Aione' ); ?>
						</label>
					</p>
					<p class="field-css-classes description description-thin">
						<label for="edit-menu-item-classes-<?php echo $item_id; ?>">
							<?php _e( 'CSS Classes (optional)', 'Aione' ); ?><br />
							<input type="text" id="edit-menu-item-classes-<?php echo $item_id; ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo $item_id; ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
						</label>
					</p>
					<p class="field-xfn description description-thin">
						<label for="edit-menu-item-xfn-<?php echo $item_id; ?>">
							<?php _e( 'Link Relationship (XFN)', 'Aione' ); ?><br />
							<input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
						</label>
					</p>
					<p class="field-description description description-wide">
						<label for="edit-menu-item-description-<?php echo $item_id; ?>">
							<?php _e( 'Description', 'Aione' ); ?><br />
							<textarea id="edit-menu-item-description-<?php echo $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo $item_id; ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
							<span class="description"><?php _e('The description will be displayed in the menu if the current theme supports it.', 'Aione' ); ?></span>
						</label>
					</p>

					<?php do_action( 'wp_nav_menu_item_custom_fields', $item_id, $item, $depth, $args ); ?>

					<p class="field-move hide-if-no-js description description-wide">
						<label>
							<span><?php _e( 'Move', 'Aione' ); ?></span>
							<a href="#" class="menus-move menus-move-up" data-dir="up"><?php _e( 'Up one', 'Aione' ); ?></a>
							<a href="#" class="menus-move menus-move-down" data-dir="down"><?php _e( 'Down one', 'Aione' ); ?></a>
							<a href="#" class="menus-move menus-move-left" data-dir="left"></a>
							<a href="#" class="menus-move menus-move-right" data-dir="right"></a>
							<a href="#" class="menus-move menus-move-top" data-dir="top"><?php _e( 'To the top', 'Aione' ); ?></a>
						</label>
					</p>

					<div class="menu-item-actions description-wide submitbox">
						<?php if( 'custom' != $item->type && $original_title !== false ) : ?>
							<p class="link-to-original">
								<?php printf( __('Original: %s', 'Aione' ), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
							</p>
						<?php endif; ?>
						<a class="item-delete submitdelete deletion" id="delete-<?php echo $item_id; ?>" href="<?php
						echo esc_url( wp_nonce_url(
							add_query_arg(
								array(
									'action' => 'delete-menu-item',
									'menu-item' => $item_id,
								),
								admin_url( 'nav-menus.php' )
							),
							'delete-menu_item_' . $item_id
						) ); ?>"><?php _e( 'Remove', 'Aione' ); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo $item_id; ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
							?>#menu-item-settings-<?php echo $item_id; ?>"><?php _e('Cancel', 'Aione' ); ?></a>
					</div>

					<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo $item_id; ?>]" value="<?php echo $item_id; ?>" />
					<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
					<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
					<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
					<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
					<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
				</div><!-- .menu-item-settings-->
				<ul class="menu-item-transport"></ul>
			<?php
			$output .= ob_get_clean();
		}

	} // end OxoCoreMegaMenus() class

}


// Don't duplicate me!
if( ! class_exists( 'OxoMegaMenu' ) ) {

	/**
	 * Class to manipulate menus
	 *
	 * @since 3.4
	 */
	class OxoMegaMenu extends OxoMegaMenuFramework {

		function __construct() {

			add_action( 'wp_update_nav_menu_item', array( $this, 'save_custom_menu_style_fields' ), 10, 3 );

			add_filter( 'wp_setup_nav_menu_item', array( $this, 'add_menu_style_data_to_menu' ) );

			if ( ! Aione()->theme_options[ 'disable_megamenu' ] ) {
				add_filter( 'wp_setup_nav_menu_item', array( $this, 'add_megamenu_data_to_menu' ) );

				add_action( 'wp_update_nav_menu_item', array( $this, 'save_custom_megamenu_fields' ), 20, 3 );
			}

			add_filter( 'wp_edit_nav_menu_walker', array( $this, 'add_custom_fields' ) );


		} // end __construct();


		/**
		 * Function to replace normal edit nav walker for oxo core mega menus
		 *
		 * @return string Class name of new navwalker
		 */
		function add_custom_fields() {

			return 'OxoCoreMegaMenus';

		}

		/**
		 * Add the custom menu style fields menu item data to fields in database
		 *
		 * @return void
		 */
		function save_custom_menu_style_fields( $menu_id, $menu_item_db_id, $args ) {
			if ( ! $args['menu-item-parent-id'] ) {
				$field_names = array( 'menu-item-oxo-menu-style', 'menu-item-oxo-megamenu-icon' );
			} else {
				$field_names = array( 'menu-item-oxo-megamenu-icon' );
			}

			foreach ( $field_names as $name ) {
				if ( ! isset( $_REQUEST[$name][$menu_item_db_id] ) ) {
					$_REQUEST[$name][$menu_item_db_id] = '';
				}

				$value = $_REQUEST[$name][$menu_item_db_id];
				update_post_meta( $menu_item_db_id, '_' . str_replace( '-', '_', $name ), $value );
			}
		}

		/**
		 * Add custom menu style fields data to the menu
		 *
		 * @return object the menu item
		 */
		function add_menu_style_data_to_menu( $menu_item ) {
			if ( ! $menu_item->menu_item_parent ) {
				$menu_item->oxo_menu_style = get_post_meta( $menu_item->ID, '_menu_item_oxo_menu_style', true );
			}

			$menu_item->oxo_megamenu_icon = get_post_meta( $menu_item->ID, '_menu_item_oxo_megamenu_icon', true );

			return $menu_item;
		}


		/**
		 * Add the custom megamenu fields menu item data to fields in database
		 *
		 * @return void
		 */
		function save_custom_megamenu_fields( $menu_id, $menu_item_db_id, $args ) {

			if ( ! $args['menu-item-parent-id'] ) {
				$field_name_suffix = array( 'status', 'width', 'columns', 'columnwidth', 'icon', 'thumbnail' );
			} else {
				$field_name_suffix = array( 'title', 'widgetarea', 'columnwidth', 'icon', 'thumbnail' );
			}

			foreach ( $field_name_suffix as $key ) {
				if( !isset( $_REQUEST['menu-item-oxo-megamenu-'.$key][$menu_item_db_id] ) ) {
					$_REQUEST['menu-item-oxo-megamenu-'.$key][$menu_item_db_id] = '';
				}

				$value = $_REQUEST['menu-item-oxo-megamenu-'.$key][$menu_item_db_id];
				update_post_meta( $menu_item_db_id, '_menu_item_oxo_megamenu_'.$key, $value );
			}
		}

		/**
		 * Add custom megamenu fields data to the menu
		 *
		 * @return object the menu item
		 */
		function add_megamenu_data_to_menu( $menu_item ) {

			if ( ! $menu_item->menu_item_parent ) {

				$menu_item->oxo_megamenu_status = get_post_meta( $menu_item->ID, '_menu_item_oxo_megamenu_status', true );

				$menu_item->oxo_megamenu_width = get_post_meta( $menu_item->ID, '_menu_item_oxo_megamenu_width', true );

				$menu_item->oxo_megamenu_columns = get_post_meta( $menu_item->ID, '_menu_item_oxo_megamenu_columns', true );

			} else {

				$menu_item->oxo_megamenu_title = get_post_meta( $menu_item->ID, '_menu_item_oxo_megamenu_title', true );

				$menu_item->oxo_megamenu_widgetarea = get_post_meta( $menu_item->ID, '_menu_item_oxo_megamenu_widgetarea', true );
			}

			$menu_item->oxo_megamenu_columnwidth = get_post_meta( $menu_item->ID, '_menu_item_oxo_megamenu_columnwidth', true );

			$menu_item->oxo_megamenu_icon = get_post_meta( $menu_item->ID, '_menu_item_oxo_megamenu_icon', true );

			$menu_item->oxo_megamenu_thumbnail = get_post_meta( $menu_item->ID, '_menu_item_oxo_megamenu_thumbnail', true );

			return $menu_item;

		}

	} // end OxoMegaMenu() class

}

// Omit closing PHP tag to avoid "Headers already sent" issues.
