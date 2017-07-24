<?php
$aione_theme = wp_get_theme();
if($aione_theme->parent_theme) {
	$template_dir =  basename(get_template_directory());
	$aione_theme = wp_get_theme($template_dir);
}
$aione_version = $aione_theme->get( 'Version' );
$plugins = TGM_Plugin_Activation::$instance->plugins;
$installed_plugins = get_plugins();
?>
<div class="wrap about-wrap aione-wrap">
	<h1><?php echo __( "Welcome to Aione!", "Aione" ); ?></h1>
	<?php add_thickbox(); ?>
	<div class="about-text"><?php echo __( "Aione is now installed and ready to use!  Get ready to build something beautiful. Please register your purchase to get support and automatic theme updates. Read below for additional information. We hope you enjoy it! <a href='//www.youtube.com/embed/dn6g_gJDAIk?rel=0&TB_iframe=true&height=540&width=960' class='thickbox' title='Guided Tour of Aione'>Watch Our Quick Guided Tour!</a>", "Aione" ); ?></div>
	<div class="aione-logo"><span class="aione-version"><?php echo __( "Version", "Aione"); ?> <?php echo $aione_version; ?></span></div>
	<h2 class="nav-tab-wrapper">
		<?php
		printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=aione' ), __( "Product Registration", "Aione" ) );
		printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=aione-support' ), __( "Support", "Aione" ) );
		printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=aione-demos' ), __( "Install Demos", "Aione" ) );
		printf( '<a href="#" class="nav-tab nav-tab-active">%s</a>', __( "Plugins", "Aione" ) );
		printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=aione-system-status' ), __( "System Status", "Aione" ) );
		?>
	</h2>
	 <div class="aione-important-notice">
		<p class="about-description"><?php echo __( "These are plugins we include or offer design integration for with Aione. Oxo Core is the only required plugin needed to use Aione. You can activate, deactivate or update the plugins from this tab. <a href='http://oxosolutions.us2.list-manage2.com/subscribe?u=4345c7e8c4f2826cc52bb84cd&id=af30829ace' target='_blank'>Subscribe to our newsletter</a> to be notified about new products being released in the future!", "Aione" ); ?></p>
	</div>
	<div class="aione-demo-themes aione-install-plugins">
		<div class="feature-section theme-browser rendered">
			<?php
			foreach( $plugins as $plugin ):
				$class = '';
				$plugin_status = '';
				$file_path = $plugin['file_path'];
				$plugin_action = $this->plugin_link( $plugin );

				if( is_plugin_active( $file_path ) ) {
					$plugin_status = 'active';
					$class = 'active';
				}
			?>
			<div class="theme <?php echo $class; ?>">
				<div class="theme-wrapper">
					<div class="theme-screenshot">
						<img src="<?php echo $plugin['image_url']; ?>" alt="" />
						<div class="plugin-info">
						<?php if( isset( $installed_plugins[$plugin['file_path']] ) ): ?>
							<?php echo sprintf('%s %s | <a href="%s" target="_blank">%s</a>', __( 'Version:', 'Aione' ), $installed_plugins[$plugin['file_path']]['Version'], $installed_plugins[$plugin['file_path']]['AuthorURI'], $installed_plugins[$plugin['file_path']]['Author'] ); ?>
						<?php elseif ( $plugin['source_type'] == 'bundled' ) : ?>
							<?php echo sprintf('%s %s', __( 'Available Version:', 'Aione' ), $plugin['version'] ); ?>					
						<?php endif; ?>
						</div>
					</div>
					<h3 class="theme-name">
						<?php
						if( $plugin_status == 'active' ) {
							echo sprintf( '<span>%s</span> ', __( 'Active:', 'Aione' ) );
						}
						echo $plugin['name'];
						?>
					</h3>
					<div class="theme-actions">
						<?php foreach( $plugin_action as $action ) { echo $action; } ?>
					</div>
					<?php if( isset( $plugin_action['update'] ) && $plugin_action['update'] ): ?>
					<div class="theme-update">Update Available: Version <?php echo $plugin['version']; ?></div>
					<?php endif; ?>
					<?php if( $plugin['required'] ): ?>
					<div class="plugin-required">
						<?php _e( 'Required', 'Aione' ); ?>
					</div>
					<?php endif; ?>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="aione-thanks">
		<p class="description"><?php echo __( "Thank you for choosing Aione. We are honored and are fully dedicated to making your experience perfect.", "Aione" ); ?></p>
	</div>
</div>
<div class="oxo-clearfix" style="clear: both;"></div>