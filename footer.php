					<?php do_action( 'aione_after_main_content' ); ?>				
				</div>  <!-- oxo-row -->
			</div>  <!-- #main -->
			
			<?php 
			$show_pagebottom_content = Aione()->theme_content['show_pagebottom_content'];
			$pagebottom_content = Aione()->theme_content['pagebottom_content']; 
			
			if( get_post_meta( $post->ID, 'pyre_show_pagebottom_content', true ) == 'no' ){
				$show_pagebottom_content = 1;
			}
			if( get_post_meta( $post->ID, 'pyre_show_pagebottom_content', true ) == 'yes' ){
				$show_pagebottom_content = 0;
			}
			?>
			<?php if($show_pagebottom_content){ ?>
				
					<?php if($pagebottom_content){ ?>
						<!-- content above footer -->
						<div class="pagebottom_content">
							<?php echo $pagebottom_content; ?>
						</div>
						<!-- end of content above footer -->
					<?php } ?>
				
			<?php } ?>
			
			<?php
			do_action( 'aione_after_main_container' );
			
			global $social_icons;

			if ( strpos( Aione()->theme_options[ 'footer_special_effects' ], 'footer_sticky' ) !== FALSE ) {
				echo '</div>';
			}

			// Get the correct page ID
			$c_pageID = Aione::c_pageID();

			// Only include the footer
			if ( ! is_page_template( 'blank.php' ) ) {

				$footer_parallax_class = '';
				if ( Aione()->theme_options[ 'footer_special_effects' ] == 'footer_parallax_effect' ) {
					$footer_parallax_class = ' oxo-footer-parallax';
				}

				printf( '<div class="oxo-footer%s">', $footer_parallax_class );

					// Check if the footer widget area should be displayed
					if ( ( Aione()->theme_options[ 'footer_widgets' ] && get_post_meta( $c_pageID, 'pyre_display_footer', true ) != 'no' ) ||
						 ( ! Aione()->theme_options[ 'footer_widgets' ] && get_post_meta( $c_pageID, 'pyre_display_footer', true ) == 'yes' )
					) {
						$footer_widget_area_center_class = '';
						if ( Aione()->theme_options[ 'footer_widgets_center_content' ] ) {
							$footer_widget_area_center_class = ' oxo-footer-widget-area-center';
						}

					?>
						<footer class="oxo-footer-widget-area oxo-widget-area<?php echo $footer_widget_area_center_class; ?>">
							
							<div class="oxo-row">
								<div class="oxo-columns oxo-columns-<?php echo Aione()->theme_options[ 'footer_widgets_columns' ]; ?> oxo-widget-area">

									<?php
									// Check the column width based on the amount of columns chosen in Theme Options
									$column_width = 12 / Aione()->theme_options[ 'footer_widgets_columns' ];
									if( Aione()->theme_options[ 'footer_widgets_columns' ] == '5' ) {
										$column_width = 2;
									}

									// Render as many widget columns as have been chosen in Theme Options
									for ( $i = 1; $i < 7; $i++ ) {
										if ( Aione()->theme_options[ 'footer_widgets_columns' ] >= $i ) {
											if ( Aione()->theme_options[ 'footer_widgets_columns' ] == $i ) {
												echo sprintf( '<div class="oxo-column oxo-column-last col-lg-%s col-md-%s col-sm-%s">', $column_width, $column_width, $column_width );
											} else {
												echo sprintf( '<div class="oxo-column col-lg-%s col-md-%s col-sm-%s">', $column_width, $column_width, $column_width );
											}

												if ( function_exists( 'dynamic_sidebar' ) &&
													 dynamic_sidebar( 'aione-footer-widget-' . $i )
												) {
													// All is good, dynamic_sidebar() already called the rendering
												}
											echo '</div>';
										}
									}								
									?>

									<div class="oxo-clearfix"></div>
								</div> <!-- oxo-columns -->
							</div> <!-- oxo-row -->
						</footer> <!-- oxo-footer-widget-area -->
					<?php
					} // end footer wigets check

					// Check if the footer copyright area should be displayed
					if ( ( Aione()->theme_options[ 'footer_copyright' ] && get_post_meta( $c_pageID, 'pyre_display_copyright', true ) != 'no' ) ||
						  ( ! Aione()->theme_options[ 'footer_copyright' ] && get_post_meta( $c_pageID, 'pyre_display_copyright', true ) == 'yes' )
					) {

						$footer_copyright_center_class = '';
						if ( Aione()->theme_options[ 'footer_copyright_center_content' ] ) {
							$footer_copyright_center_class = ' oxo-footer-copyright-center';
						}
					?>
						<footer id="footer" class="oxo-footer-copyright-area<?php echo $footer_copyright_center_class; ?>">
							<div class="oxo-row">
								<div class="oxo-copyright-content">

									<?php
									/**
									 * aione_footer_copyright_content hook
									 *
									 * @hooked aione_render_footer_copyright_notice - 10 (outputs the HTML for the Theme Options footer copyright text)
									 * @hooked aione_render_footer_social_icons - 15 (outputs the HTML for the footer social icons)
									 */
									do_action( 'aione_footer_copyright_content' );
									if( Aione()->theme_options['icons_footer'] ){?>
									<div class="oxo-social-links-footer">
										<div class="oxo-social-networks">
										<?php 
										 $social_sorter = Aione()->theme_options['social_sorter']; 
											foreach($social_sorter as $keys => $values){ 
											$social_icon_name = str_replace( '_link', '', $keys );
												if($values){
											?>
												<a class="oxo-social-network-icon oxo-tooltip oxo-<?php echo $values; ?> oxo-icon-<?php echo $values; ?>" href="http://<?php echo $values; ?>" target="_blank"><i class="fa fa-<?php echo $social_icon_name;?>" aria-hidden="true"></i></a>
										<?php 
											}
										} 
					
										?>
										</div>
									</div>
									<?php } ?>

								</div> <!-- oxo-oxo-copyright-content -->
							</div> <!-- oxo-row -->
						</footer> <!-- #footer -->
				<?php
				} // end footer copyright area check
				?>
				</div> <!-- oxo-footer -->
				<?php
			} // end is not blank page check
			?>
		</div> <!-- wrapper -->

		<?php
		// Check if boxed side header layout is used; if so close the #boxed-wrapper container
		if ( ( ( Aione()->theme_options['layout'] == 'Boxed' && get_post_meta( $c_pageID, 'pyre_page_bg_layout', true ) == 'default' ) || get_post_meta( $c_pageID, 'pyre_page_bg_layout', true ) == 'boxed' ) &&
			 Aione()->theme_options['header_position'] != 'top'

		) {
		?>
			</div> <!-- #boxed-wrapper -->
		<?php
		}

		?>

		<a class="oxo-one-page-text-link oxo-page-load-link"></a>

		<!-- W3TC-include-js-head -->

		<?php
		wp_footer();

		// Echo the scripts added to the "before </body>" field in Theme Options
		//echo Aione()->settings->get( 'space_body' );	
		echo Aione()->theme_content['space_body'];
		
		
		/*echo '<br>theme_options ====================== <pre>';
		print_r($theme_options);
		echo '</pre>';		
		
		$theme_content = Aione()->theme_content;
		
		echo '<br>THEME Content ======================<pre>';
		print_r($theme_content);
		echo '</pre>';

		
		
		$get_setting = Aione()->settings->get_all();
		echo '<br>avada======================<pre><pre>';
		print_r($get_setting);
		echo '</pre>';*/
		
		//Custom JS for each page
		$c_pageID = Aione::c_pageID();
		if ( '' != get_post_meta( $c_pageID, 'pyre_custom_js', true ) ) {
			$pyre_custom_js = get_post_meta( $c_pageID, 'pyre_custom_js', true );
			echo '<script type="text/javascript">';
			echo $pyre_custom_js;
			echo '</script>';
		}
		if( Aione()->theme_options['disable_right_click'] ){ ?>
			<script type="text/javascript">
			jQuery(document).ready(function () {
				//Disable Context Menu
				jQuery("body").on("contextmenu",function(e){
					return false;
				});
			});
			</script>
		<?php }
		if( Aione()->theme_options['disable_cut_copy_paste'] ){ ?>
			<script type="text/javascript">
			jQuery(document).ready(function () {
				//Disable cut copy paste
				jQuery('body').bind('cut copy paste', function (e) {
					e.preventDefault();
				});
			});
			</script>
		<?php }
		if( Aione()->theme_options['disable_text_selection'] ){ ?>
			<style>
				*{
					-moz-user-select: none;
					-khtml-user-select: none;
					-webkit-user-select: none;
					user-select: none;
				}

			</style>
		<?php }
		if( Aione()->theme_options['disable_iframe_inclusion'] ){ ?>
			<script type="text/javascript">
			jQuery(document).ready(function () {
				//Disable iFrame Inclusion
				if(top!=self){
					top.location.replace(document.location);
				}
			});
			</script>
		<?php }
		if( Aione()->theme_options['disable_drag_drop_images'] ){ ?>
			<script type="text/javascript">
			jQuery(document).ready(function () {
				//Disable Drag and Drop Images
				jQuery('img').on('dragstart', function(event) { event.preventDefault(); });
			});
			</script>
		<?php }
		?>

		<!--[if lte IE 8]>
			<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/respond.js"></script>
		<![endif]-->
	</body>
</html>
