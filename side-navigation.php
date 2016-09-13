<?php
// Template Name: Side Navigation
get_header(); ?>
	<div id="content" <?php Aione()->layout->add_class( 'content_class' ); ?> <?php Aione()->layout->add_style( 'content_style' ); ?>>
		<?php while(have_posts()): the_post();
		$page_id = get_the_ID();
		?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php echo aione_render_rich_snippets_for_pages(); ?>
			<?php echo aione_featured_images_for_pages(); ?>
			<div class="post-content">
				<?php the_content(); ?>
				<?php aione_link_pages(); ?>
			</div>
			<?php if( ! post_password_required($post->ID) ): ?>
			<?php if(Aione()->theme_options[ 'comments_pages' ]): ?>
				<?php
				wp_reset_query();
				comments_template();
				?>
			<?php endif; ?>
			<?php endif; ?>
		</div>
		<?php endwhile; ?>
	</div>
	<?php do_action( 'oxo_after_content' ); ?>
	<?php wp_reset_query(); ?>
<?php get_footer();

// Omit closing PHP tag to avoid "Headers already sent" issues.
