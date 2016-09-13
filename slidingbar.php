<?php

$is_open_class = '';
if ( Aione()->theme_options[ 'slidingbar_open_on_load' ] ) {
	$is_open_class = ' open_onload';
}

?>
<div id="slidingbar-area" class="slidingbar-area oxo-widget-area<?php echo $is_open_class; ?>">
	<div id="slidingbar">
		<div class="oxo-row">
			<div class="oxo-columns row oxo-columns-<?php echo Aione()->theme_options[ 'slidingbar_widgets_columns' ]; ?> columns columns-<?php echo Aione()->theme_options[ 'slidingbar_widgets_columns' ]; ?>">
				<?php
				$column_width = 12 / Aione()->theme_options[ 'slidingbar_widgets_columns' ];
				if( Aione()->theme_options[ 'slidingbar_widgets_columns' ] == '5' ) {
					$column_width = 2;
				}

				// Render as many widget columns as have been chosen in Theme Options
				for ( $i = 1; $i < 7; $i++ ) {
					if ( Aione()->theme_options[ 'slidingbar_widgets_columns' ] >= $i ) {
						if ( Aione()->theme_options[ 'slidingbar_widgets_columns' ] == $i ) {
							echo sprintf( '<div class="oxo-column oxo-column-last col-lg-%s col-md-%s col-sm-%s">', $column_width, $column_width, $column_width );
						} else {
							echo sprintf( '<div class="oxo-column col-lg-%s col-md-%s col-sm-%s">', $column_width, $column_width, $column_width );
						}						

							if (  function_exists( 'dynamic_sidebar' ) &&
								 dynamic_sidebar( 'aione-slidingbar-widget-' . $i )
							) {
								// All is good, dynamic_sidebar() already called the rendering
							}
						echo '</div>';
					}
				}
				?>
				<div class="oxo-clearfix"></div>
			</div>
		</div>
	</div>
	<div class="sb-toggle-wrapper">
		<a class="sb-toggle" href="#"></a>
	</div>
</div>
<?php wp_reset_postdata();

// Omit closing PHP tag to avoid "Headers already sent" issues.
