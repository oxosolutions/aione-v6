<?php get_header(); ?>
	<div id="content" <?php Aione()->layout->add_class( 'content_class' ); ?> <?php Aione()->layout->add_style( 'content_style' ); ?>>
		<?php
		/**
		 * aione_author_info hook
		 *
		 * @hooked aione_render_author_info - 10 (renders the HTML markup of the author info)
		 */
		do_action( 'aione_author_info' );
		?>

		<?php get_template_part( 'templates/blog', 'layout' ); ?>
	</div>
	<?php do_action( 'oxo_after_content' ); ?>
<?php get_footer();

// Omit closing PHP tag to avoid "Headers already sent" issues.
