<?php
$aione_theme = wp_get_theme();
if($aione_theme->parent_theme) {
	$template_dir =  basename(get_template_directory());
	$aione_theme = wp_get_theme($template_dir);
}
$aione_version = $aione_theme->get( 'Version' );

$theme_oxo_url = 'http://oxosolutions.com/';
$aione_url = $theme_oxo_url . 'aione/';
$demos = array(
	'classic' 			=> array(),
	'gym'				=> array( 'new' => true ),
	'modern_shop'		=> array( 'new' => true ),
	'classic_shop'		=> array( 'new' => true ),
	'landing_product'	=> array( 'new' => true ),
	'forum'				=> array( 'new' => true ),
	'church' 			=> array(),
	'cafe' 				=> array(),
	'travel' 			=> array(),
	'hotel' 			=> array(),
	'architecture' 		=> array(),
	'hosting' 			=> array(),
	'law' 				=> array(),
	'lifestyle' 		=> array(),
	'fashion' 			=> array(),
	'app'				=> array(),
	'agency' 			=> array(),
);
?>
<div class="wrap about-wrap aione-wrap">
	<h1><?php echo __( "Welcome to Aione!", "Aione" ); ?></h1>

	<div class="updated error importer-notice importer-notice-1" style="display: none;">
		<p><strong><?php echo __( "We're sorry but the demo data could not be imported. It is most likely due to low PHP configurations on your server. There are two possible solutions.", 'Aione' ); ?></strong></p>

		<p><strong><?php _e( 'Solution 1:', 'Aione' ); ?></strong> <?php _e( 'Import the demo using an alternate method.', 'Aione' ); ?><a href="https://oxosolutions.com/aione-doc/demo-content-info/alternate-demo-method/" class="button-primary" target="_blank" style="margin-left: 10px;"><?php _e( 'Alternate Method', 'Aione' ); ?></a></p>
		<p><strong><?php _e( 'Solution 2:', 'Aione' ); ?></strong> <?php echo sprintf( __( 'Fix the PHP configurations in the System Status that are reported in <strong style="color: red;">RED</strong>, then use the %s, then reimport.', 'Aione' ), '<a href="' . admin_url() . 'plugin-install.php?tab=plugin-information&amp;plugin=wordpress-reset&amp;TB_iframe=true&amp;width=830&amp;height=472' . '">Reset WordPress Plugin</a>' ); ?><a href="<?php echo admin_url( 'admin.php?page=aione-system-status' ); ?>" class="button-primary" target="_blank" style="margin-left: 10px;"><?php _e( 'System Status', 'Aione' ); ?></a></p>
	</div>

	<div class="updated importer-notice importer-notice-2" style="display: none;"><p><strong><?php echo __( "Demo data successfully imported. Now, please install and run", "Aione" ); ?> <a href="<?php echo admin_url();?>plugin-install.php?tab=plugin-information&amp;plugin=regenerate-thumbnails&amp;TB_iframe=true&amp;width=830&amp;height=472" class="thickbox" title="<?php echo __( "Regenerate Thumbnails", "Aione" ); ?>"><?php echo __( "Regenerate Thumbnails", "Aione" ); ?></a> <?php echo __( "plugin once", "Aione" ); ?>.</strong></p></div>

	<div class="updated error importer-notice importer-notice-3" style="display: none;">
		<p><strong><?php echo __( "We're sorry but the demo data could not be imported. It is most likely due to low PHP configurations on your server. There are two possible solutions.", 'Aione' ); ?></strong></p>

		<p><strong><?php _e( 'Solution 1:', 'Aione' ); ?></strong> <?php _e( 'Import the demo using an alternate method.', 'Aione' ); ?><a href="https://oxosolutions.com/aione-doc/demo-content-info/alternate-demo-method/" class="button-primary" target="_blank" style="margin-left: 10px;"><?php _e( 'Alternate Method', 'Aione' ); ?></a></p>
		<p><strong><?php _e( 'Solution 2:', 'Aione' ); ?></strong> <?php echo sprintf( __( 'Fix the PHP configurations in the System Status that are reported in <strong style="color: red;">RED</strong>, then use the %s, then reimport.', 'Aione' ), '<a href="' . admin_url() . 'plugin-install.php?tab=plugin-information&amp;plugin=wordpress-reset&amp;TB_iframe=true&amp;width=830&amp;height=472' . '">Reset WordPress Plugin</a>' ); ?><a href="<?php echo admin_url( 'admin.php?page=aione-system-status' ); ?>" class="button-primary" target="_blank" style="margin-left: 10px;"><?php _e( 'System Status', 'Aione' ); ?></a></p>
	</div>

	<div class="about-text"><?php echo __( "Aione is now installed and ready to use!  Get ready to build something beautiful. Please register your purchase to get support and automatic theme updates. Read below for additional information. We hope you enjoy it! <a href='//www.youtube.com/embed/dn6g_gJDAIk?rel=0&TB_iframe=true&height=540&width=960' class='thickbox' title='Guided Tour of Aione'>Watch Our Quick Guided Tour!</a>", "Aione" ); ?></div>
	<div class="aione-logo"><span class="aione-version"><?php echo __( "Version", "Aione" ); ?> <?php echo $aione_version; ?></span></div>
	<h2 class="nav-tab-wrapper">
		<?php
		printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=aione' ),  __( "Product Registration", "Aione" ) );
		printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=aione-support' ), __( "Support", "Aione" ) );
		printf( '<a href="#" class="nav-tab nav-tab-active">%s</a>', __( "Install Demos", "Aione" ) );
		printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=aione-plugins' ), __( "Plugins", "Aione" ) );
		printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=aione-system-status' ), __( "System Status", "Aione" ) );
		?>
	</h2>
	 <div class="aione-important-notice">
		<p class="about-description"><?php echo __( "Installing a demo provides pages, posts, images, theme options, widgets, sliders and more. IMPORTANT: The included plugins need to be installed and activated before you install a demo. Please check the 'System Status' tab to ensure your server meets all requirements for a successful import. Settings that need attention will be listed in red.", "Aione" ); ?> <?php printf( '<a href="%s" target="_blank">%s</a>', $theme_oxo_url . 'aione-doc/demo-content-info/import-xml-file/', __( "View more info here.", "Aione" ) ); ?></p>
	</div>
	<div class="aione-demo-themes">
		<div class="feature-section theme-browser rendered">
			<?php
			// Loop through all demos
			foreach ( $demos as $demo => $demo_details ) { ?>
				<div class="theme">
					<div class="theme-wrapper">
						<div class="theme-screenshot">
							<img src="<?php echo Aione()->get_framework_dir() . '/assets/images/' . $demo . '_preview.jpg'; ?>" />
						</div>
						<h3 class="theme-name" id="<?php echo $demo; ?>"><?php echo ucwords( str_replace( '_', ' ', $demo ) ); ?></h3>
						<div class="theme-actions">
							<?php printf( '<a class="button button-primary button-install-demo" data-demo-id="%s" href="#">%s</a>', strtolower( $demo ), __( "Install", "Aione" ) ); ?>
							<?php printf( '<a class="button button-primary" target="_blank" href="%1s">%2s</a>', ( $demo != 'classic' ) ? $aione_url .  str_replace( '_', '-', $demo ) : $aione_url, __( "Preview", "Aione" ) ); ?>
						</div>
						<div id="demo-preview-classic" class="screenshot-hover oxo-animated fadeInUp">
							<a href="<?php echo ( $demo != 'classic' ) ? $aione_url . $demo : $aione_url; ?>" target="_blank"><img src="<?php echo Aione()->get_framework_dir() . '/assets/images/' . $demo . '_popover.jpg'; ?>" /></a>
						</div>
						<div class="demo-import-loader preview-all"></div>
						<div class="demo-import-loader preview-<?php echo strtolower( $demo ); ?>"><i class="dashicons dashicons-admin-generic"></i></div>
						<?php if( isset( $demo_details['new'] ) && $demo_details['new'] == true ): ?>
						<div class="plugin-required">
							<?php _e( 'New', 'Aione' ); ?>
						</div>
						<?php endif; ?>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
	<div class="aione-thanks">
		<p class="description"><?php echo __( "Thank you for choosing Aione. We are honored and are fully dedicated to making your experience perfect.", "Aione" ); ?></p>
	</div>
</div>
