<?php

class Aione_Updater {

    public function __construct() {
        add_action( 'admin_init', array( $this, 'auto_updater' ) );
    }

    /**
     * Auto Updater
     */
    public function auto_updater() {

        $aione_options = get_option( 'Aione_Key' );

    	if ( isset( $aione_options['tf_username'] ) && ! empty( $aione_options['tf_username'] ) && isset( $aione_options['tf_api'] ) && ! empty( $aione_options['tf_api'] ) && isset( $aione_options['tf_purchase_code'] ) && ! empty( $aione_options['tf_purchase_code'] ) ) {

    		$theme_info = wp_get_theme();

    		if ( $theme_info->parent_theme ) {

    			$template_dir =  basename( get_template_directory() );
    			$theme_info = wp_get_theme( $template_dir );

    		}

    		$name = $theme_info->get( 'Name' );
    		$slug = $theme_info->get_template();

    		$theme_update = new Aione_Theme_Updater( 'http://updates.oxosolutions.com/aione-theme.php', $name, $slug );

    	}

    }

}

// Omit closing PHP tag to avoid "Headers already sent" issues.
