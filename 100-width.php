<?php
// Template Name: 100% Width
get_header(); ?>
	<div id="content" class="full-width">
		<?php while(have_posts()): the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php echo aione_render_rich_snippets_for_pages(); ?>
			<?php echo aione_featured_images_for_pages(); ?>
			<div class="post-content">
				<?php the_content(); ?>
				<?php aione_link_pages(); ?>
			</div>
			<?php if( ! post_password_required($post->ID) ): ?>
			<?php if ( Aione()->theme_options[ 'comments_pages'] ): ?>
				<?php
				wp_reset_query();
				comments_template();
				?>
			<?php endif; ?>
			<?php endif; ?>
		</div>
		<?php endwhile; ?>
	</div>
<?php get_footer();

// Omit closing PHP tag to avoid "Headers already sent" issues.
