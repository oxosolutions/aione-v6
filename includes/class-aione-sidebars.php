<?php

class Aione_Sidebars {

    public function __construct() {
        add_action( 'widgets_init', array( $this, 'widgets_init' ) );
    }

    /**
     * Register our sidebars
     */
    public function widgets_init() {

    	register_sidebar( array(
    		'name'          => 'Blog Sidebar',
    		'id'            => 'aione-blog-sidebar',
    		'description'   => __( 'Default Sidebar of Aione', 'Aione' ),
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<div class="heading"><h4 class="widget-title">',
    		'after_title'   => '</h4></div>',
    	) );

    	$columns = Aione()->theme_options[ 'footer_widgets_columns' ] + 1;

        // Register he footer widgets
        for ( $i = 1; $i < $columns; $i++ ) {

            register_sidebar( array(
                'name'          => sprintf( 'Footer Widget %s', $i ),
    			'id'            => 'aione-footer-widget-' . $i,
    			'before_widget' => '<div id="%1$s" class="oxo-footer-widget-column widget %2$s">',
    			'after_widget'  => '<div style="clear:both;"></div></div>',
    			'before_title'  => '<h4 class="widget-title">',
    			'after_title'   => '</h4>',
    		) );

        }

        $columns = Aione()->theme_options[ 'slidingbar_widgets_columns' ] + 1;

        // Register the slidingbar widgets
        for ( $i = 1; $i < $columns; $i++ ) {

    		register_sidebar( array(
                'name'          => sprintf( 'Slidingbar Widget %s', $i ),
    			'id'            => 'aione-slidingbar-widget-' . $i,
    			'before_widget' => '<div id="%1$s" class="oxo-slidingbar-widget-column widget %2$s">',
    			'after_widget'  => '<div style="clear:both;"></div></div>',
    			'before_title'  => '<h4 class="widget-title">',
    			'after_title'   => '</h4>',
    		) );

    	}

    }

}

// Omit closing PHP tag to avoid "Headers already sent" issues.
