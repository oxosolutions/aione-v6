<?php
// Template Name: Portfolio Five Column
get_header(); ?>
	<div id="content" <?php Aione()->layout->add_class( 'content_class' ); ?> <?php Aione()->layout->add_style( 'content_style' ); ?>>
		<?php get_template_part( 'templates/portfolio', 'layout' ); ?>
	</div>
	<?php do_action( 'oxo_after_content' ); ?>
<?php get_footer();

// Omit closing PHP tag to avoid "Headers already sent" issues.
