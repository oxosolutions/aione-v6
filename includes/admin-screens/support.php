<?php
$aione_theme = wp_get_theme();
if($aione_theme->parent_theme) {
    $template_dir =  basename(get_template_directory());
    $aione_theme = wp_get_theme($template_dir);
}
$aione_version = $aione_theme->get( 'Version' );
$theme_oxo_url = 'https://oxosolutions.com/';
?>
<div class="wrap about-wrap aione-wrap">
	<h1><?php echo __( "Welcome to Aione!", "Aione" ); ?></h1>
	<div class="about-text"><?php echo __( "Aione is now installed and ready to use!  Get ready to build something beautiful. Please register your purchase to get support and automatic theme updates. Read below for additional information. We hope you enjoy it! <a href='//www.youtube.com/embed/dn6g_gJDAIk?rel=0&TB_iframe=true&height=540&width=960' class='thickbox' title='Guided Tour of Aione'>Watch Our Quick Guided Tour!</a>", "Aione" ); ?></div>
    <div class="aione-logo"><span class="aione-version"><?php echo __( "Version", "Aione" ); ?> <?php echo $aione_version; ?></span></div>
	<h2 class="nav-tab-wrapper">
    	<?php
		printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=aione' ), __( "Product Registration", "Aione" ) );
		printf( '<a href="#" class="nav-tab nav-tab-active">%s</a>', __( "Support", "Aione" ) );
		printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=aione-demos' ), __( "Install Demos", "Aione" ) );
		printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=aione-plugins' ), __( "Plugins", "Aione" ) );
        printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=aione-system-status' ), __( "System Status", "Aione" ) );
		?>
	</h2>
    <div class="aione-important-notice">
		<p class="about-description"><?php echo __( "To access our support forum and resources, you first must register your purchase.<br />
See the", "Aione" ); ?> <?php printf( '<a href="%s">%1s</a> %2s', admin_url( 'admin.php?page=aione' ), __( "Product Registration", "Aione" ), __("tab for instructions on how to complete registration.", "Aione" ) ); ?></p>
    </div>
	<div class="aione-registration-steps">
    	<div class="feature-section col three-col">
        	<div class="col">
				<h3><span class="dashicons dashicons-sos"></span><?php echo __( "Submit A Ticket", "Aione" ); ?></h3>
				<p><?php echo __( "We offer excellent support through our advanced ticket system. Make sure to register your purchase first to access our support services and other resources.", "Aione" ); ?></p>
                <?php printf( '<a href="%s" class="button button-large button-primary aione-large-button" target="_blank">%s</a>', $theme_oxo_url . 'support-ticket/', __( "Submit A Ticket", "Aione" ) ); ?>
            </div>
            <div class="col">
				<h3><span class="dashicons dashicons-book"></span><?php echo __( "Documentation", "Aione" ); ?></h3>
				<p><?php echo __( "This is the place to go to reference different aspects of the theme. Our online documentaiton is an incredible resource for learning the ins and outs of using Aione.", "Aione" ); ?></p>
                <?php printf( '<a href="%s" class="button button-large button-primary aione-large-button" target="_blank">%s</a>', $theme_oxo_url . 'support/documentation/aione-documentation/', __( "Documentation", "Aione" ) ); ?>
            </div>
        	<div class="col last-feature">
				<h3><span class="dashicons dashicons-portfolio"></span><?php echo __( "Knowledgebase", "Aione" ); ?></h3>
				<p><?php echo __( "Our knowledgebase contains additional content that is not inside of our documentation. This information is more specific and unique to various versions or aspects of Aione.", "Aione" ); ?></p>
                <?php printf( '<a href="%s" class="button button-large button-primary aione-large-button" target="_blank">%s</a>', $theme_oxo_url . 'support/knowledgebase/', __( "Knowledgebase", "Aione" ) ); ?>
            </div>
            <div class="col">
            	<h3><span class="dashicons dashicons-format-video"></span><?php echo __( "Video Tutorials", "Aione" ); ?></h3>
				<p><?php echo __( "Nothing is better than watching a video to learn. We have a growing library of high-definititon, narrated video tutorials to help teach you the different aspects of using Aione.", "Aione" ); ?></p>
                <?php printf( '<a href="%s" class="button button-large button-primary aione-large-button" target="_blank">%s</a>', $theme_oxo_url . 'support/video-tutorials/aione-videos/', __( "Watch Videos", "Aione" ) ); ?>
            </div>
			<div class="col">
				<h3><span class="dashicons dashicons-groups"></span><?php echo __( "Community Forum", "Aione" ); ?></h3>
				<p><?php echo __( "We also have a community forum for user to user interactions. Ask another Aione user! Please note that OXOSolutions does not provide product support here.", "Aione" ); ?></p>
                <?php printf( '<a href="%s" class="button button-large button-primary aione-large-button" target="_blank">%s</a>', $theme_oxo_url . 'support/forum/', __( "Community Forum", "Aione" ) ); ?>
            </div>            
            <div class="col last-feature">
				<h3><span class="dashicons dashicons-facebook"></span><?php echo __( "Facebook Group", "Aione" ); ?></h3>
				<p><?php echo __( "We have an amazing Facebook Group! Come and share with other Aione users and help grow our community. Please note, OXOSolutions does not provide support here.", "Aione" ); ?></p>
                <?php printf( '<a href="https://www.facebook.com/groups/AioneUsers/" class="button button-large button-primary aione-large-button" target="_blank">%s</a>', __( "Facebook Group", "Aione" ) ); ?>
            </div>            
        </div>
    </div>
    <div class="aione-thanks">
    	<p class="description"><?php echo __( "Thank you for choosing Aione. We are honored and are fully dedicated to making your experience perfect.", "Aione" ); ?></p>
    </div>
</div>
