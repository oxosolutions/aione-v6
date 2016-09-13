<?php
$aione_theme = wp_get_theme();
if($aione_theme->parent_theme) {
    $template_dir =  basename(get_template_directory());
    $aione_theme = wp_get_theme($template_dir);
}
$aione_version = $aione_theme->get( 'Version' );
$aione_options = get_option( 'Aione_Key' );
$registration_complete = false;
$tf_username = isset( $aione_options[ 'tf_username' ] ) ? $aione_options[ 'tf_username' ] : '';
$tf_api = isset( $aione_options[ 'tf_api' ] ) ? $aione_options[ 'tf_api' ] : '';
$tf_purchase_code = isset( $aione_options[ 'tf_purchase_code' ] ) ? $aione_options[ 'tf_purchase_code' ] : '';
if( $tf_username !== "" && $tf_api !== "" && $tf_purchase_code !== "" ) {
	$registration_complete = true;
}
$theme_oxo_url = 'https://oxosolutions.com/';
?>
<div class="wrap about-wrap aione-wrap">
	<h1><?php echo __( "Welcome to Aione!", "Aione" ); ?></h1>

	<div class="updated registration-notice-1" style="display: none;"><p><strong><?php echo __( "Thanks for registering your purchase. You will now receive the automatic updates.", "Aione" ); ?> </strong></p></div>

	<div class="updated error registration-notice-2" style="display: none;"><p><strong><?php echo __( "Please provide all the three details for registering your copy of Aione.", "Aione" ); ?>.</strong></p></div>

	<div class="updated error registration-notice-3" style="display: none;"><p><strong><?php echo __( "Something went wrong. Please verify your details and try again.", "Aione" ); ?></strong></p></div>

	<div class="about-text"><?php echo __( "Aione is now installed and ready to use!  Get ready to build something beautiful. Please register your purchase to get support and automatic theme updates. Read below for additional information. We hope you enjoy it! <a href='//www.youtube.com/embed/dn6g_gJDAIk?rel=0&TB_iframe=true&height=540&width=960' class='thickbox' title='Guided Tour of Aione'>Watch Our Quick Guided Tour!</a>", "Aione" ); ?></div>
    <div class="aione-logo"><span class="aione-version"><?php echo __( "Version", "Aione" ); ?> <?php echo $aione_version; ?></span></div>
	<h2 class="nav-tab-wrapper">
    	<?php
		printf( '<a href="#" class="nav-tab nav-tab-active">%s</a>', __( "Product Registration", "Aione" ) );
		printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=aione-support' ), __( "Support", "Aione" ) );
		printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=aione-demos' ), __( "Install Demos", "Aione" ) );
        printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=aione-plugins' ), __( "Plugins", "Aione" ) );
        printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=aione-system-status' ), __( "System Status", "Aione" ) );
		?>
	</h2>
<!--    <p class="about-description"><span class="dashicons dashicons-admin-network aione-icon-key"></span><?php echo __( "Your Purchase Must Be Registered To Receive Theme Support & Auto Updates", "Aione" ); ?></p> -->
	<div class="aione-registration-steps">
    	<div class="feature-section col three-col">
        	<div class="col">
				<h3><?php echo __( "Step 1 - Signup for Support", "Aione" ); ?></h3>
				<p><?php printf( '<a href="%s" target="_blank">%s</a> ', $theme_oxo_url . 'support/?from_theme=1', __( "Click here", "Aione" ) ); echo __("to signup at our support center.", "Aione" ); echo __( "&nbsp;View a tutorial&nbsp;", "Aione" );
				printf( '<a href="%s" target="_blank">%s</a>', $theme_oxo_url . 'aione-doc/getting-started/free-forum-support/', __( "here.", "Aione" ) );  echo __( "&nbsp;This gives you access to our documentation, knowledgebase, video tutorials and ticket system.", "Aione" ); ?></p>
            </div>
            <div class="col">
				<h3><?php echo __( "Step 2 - Generate an API Key", "Aione" ); ?></h3>
				<p><?php echo __( 'Once you registered at our support center, you need to generate a product API key under the "Licenses" section of your Themeforest account. View a tutorial&nbsp;', 'Aione' );
				printf( '<a href="%s" target="_blank">%s</a>.',$theme_oxo_url . 'aione-doc/install-update/generate-themeforest-api/',  __('here', "Aione" ) ); ?></p>
            </div>
        	<div class="col last-feature">
				<h3><?php echo __( "Step 3 - Purchase Validation", "Aione" ); ?></h3>
				<p><?php echo __( "Enter your ThemeForest username, purchase code and generated API key into the fields below. This will give you access to automatic theme updates.", "Aione" ); ?></p>
            </div>
        </div>
        <!--<div class="start_registration_button">
        	 <?php printf( '<a href="%s" class="button button-large button-primary aione-large-button" target="_blank">%s</a>', $theme_oxo_url . 'support/',  __( "Start Registration Now!", "Aione" ) ); ?>
        </div>-->
    </div>
    <div class="feature-section">
		<div class="aione-important-notice registration-form-container">
			<?php
			if( $registration_complete ) {
				echo '<p class="about-description"><span class="dashicons dashicons-yes aione-icon-key"></span>' . __("Registration Complete! You can now receive automatic updates, theme support and future goodies.", "Aione") . '</p>';
			} else {
			?>
			<p class="about-description"><?php echo __( "After Steps 1-2 are complete, enter your credentials below to complete product registration.", "Aione" ); ?></p>
			<?php } ?>
			<div class="aione-registration-form">
				<form id="aione_product_registration">
					<input type="hidden" name="action" value="aione_update_registration" />
					<input type="text" name="tf_username" id="tf_username" placeholder="<?php echo __( "Themeforest Username", "Aione" ); ?>" value="<?php echo $tf_username; ?>" />
					<input type="text" name="tf_purchase_code" id="tf_purchase_code" placeholder="<?php echo __( "Enter Themeforest Purchase Code", "Aione" ); ?>" value="<?php echo $tf_purchase_code; ?>" />
					<input type="text" name="tf_api" id="tf_api" placeholder="<?php echo __( "Enter API Key", "Aione" ); ?>" value="<?php echo $tf_api; ?>" />
				</form>
			</div>
			<button class="button button-large button-primary aione-large-button aione-register"><?php echo __( "Submit", "Aione" ); ?></button>
			<span class="aione-loader"><i class="dashicons dashicons-update loader-icon"></i><span></span></span>
		</div>
	</div>
    <div class="aione-thanks">
    	<p class="description"><?php echo __( "Thank you for choosing Aione. We are honored and are fully dedicated to making your experience perfect.", "Aione" ); ?></p>
    </div>
</div>
