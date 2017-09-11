<?php

class Aione_Head {

	public function __construct() {
		// add_action( 'wp_head', array( $this, 'x_ua_meta' ), 1 );
		// add_action( 'wp_head', array( $this, 'the_meta' ) );
		// add_action( 'wp_head', array( $this, 'insert_og_meta' ), 5 );
		// add_filter( 'language_attributes', array( $this, 'add_opengraph_doctype' ) );
		
		add_filter( 'document_title_separator', array( $this, 'document_title_separator' ) );
		add_filter( 'pre_get_document_title', array( $this, 'render_document_title' ) );
	}
	  
	/**
	 * Adding the Open Graph in the Language Attributes
	 */
	public function add_opengraph_doctype( $output ) {
		return $output . ' prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#"';
	}

	/**
	 * Aione extra OpenGraph tags
	 * These are added to the <head> of the page using the 'wp_head' action.
	 */
	public function insert_og_meta() {

		global $post;
		global $theme_options;

		$settings = Aione::settings();

		// Early exit if we don't need to continue any further
		if ( $settings['status_opengraph'] ) {
			return;
		}

		// Early exit if this is not a singular post/page/cpt
		if ( ! is_singular() ) {
			return;
		}

		$image = '';
		if ( ! has_post_thumbnail( $post->ID ) ) {
			if ( $theme_options['logo'] ) {
				$image = $theme_options['logo'];
			}
		} else {
			$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
			$image = esc_attr( $thumbnail_src[0] );
		}

		?>

		<?php
		$c_pageID = Aione::c_pageID();
		$pyre_title_tag = get_post_meta( $c_pageID, 'pyre_title_tag', true );
		$pyre_og_title = get_post_meta( $c_pageID, 'pyre_og_title', true );
		$pyre_og_description = get_post_meta( $c_pageID, 'pyre_og_description', true );
		$pyre_og_image = get_post_meta( $c_pageID, 'pyre_og_image', true );
		$pyre_og_url = get_post_meta( $c_pageID, 'pyre_og_url', true );
		if($pyre_og_title != "" && $pyre_og_title != false){
			?>
			<meta property="og:title" content="<?php echo strip_tags( str_replace( array( '"', "'" ), array( '&quot;', '&#39;' ), $pyre_og_title ) ); ?>"/>
			<?php
		} else {
			?>
			<meta property="og:title" content="<?php echo strip_tags( str_replace( array( '"', "'" ), array( '&quot;', '&#39;' ), $post->post_title ) ); ?>"/>
			<?php
		}
		if($pyre_og_description != "" && $pyre_og_description != false){
			?>
			<meta property="og:description" content="<?php echo Aione()->blog->get_content_stripped_and_excerpted( 55, $pyre_og_description ); ?>"/>
			<?php
		} else {
			?>
			<meta property="og:description" content="<?php echo Aione()->blog->get_content_stripped_and_excerpted( 55, $post->post_content ); ?>"/>
			<?php
		}
		if($pyre_og_image != "" && $pyre_og_image != false){
			?>
			<meta property="og:image" content="<?php echo $pyre_og_image; ?>"/>
			<?php
		} else {
			?>
			<meta property="og:image" content="<?php echo $image; ?>"/>
			<?php
		}
		if($pyre_og_url != "" && $pyre_og_url != false){
			?>
			<meta property="og:url" content="<?php echo $pyre_og_url; ?>"/>
			<?php
		} else {
			?>
			<meta property="og:url" content="<?php echo get_permalink(); ?>"/>
			<?php
		}
		if($pyre_title_tag != "" && $pyre_title_tag != false){
			?>
			<meta property="og:site_name" content="<?php echo $pyre_title_tag; ?>"/>
			<?php
		} else {
			?>
			<meta property="og:site_name" content="<?php echo get_bloginfo( 'name' ); ?>"/>
			<?php
		}
		?>
		<meta property="og:type" content="article"/>
		<?php

	}

	/**
	 * Add X-UA-Compatible meta when needed.
	 */
	public function x_ua_meta() {

		if ( isset( $_SERVER['HTTP_USER_AGENT'] ) && ( false !== strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE' ) ) ) : ?>
			<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<?php endif;

	}

	/**
	 * Set the document title separator
	 */
	public function document_title_separator() {
		return '-';
	}

	public function render_document_title($title){
		$c_pageID = Aione::c_pageID();
		$pyre_title_tag = get_post_meta( $c_pageID, 'pyre_title_tag', true );
		if($pyre_title_tag != "" && $pyre_title_tag != false){
			$title = $pyre_title_tag;
		} 
		return $title;
	}
}

// Omit closing PHP tag to avoid "Headers already sent" issues.
