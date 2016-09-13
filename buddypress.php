<?php get_header(); ?>
	<div id="content" <?php Aione()->layout->add_class( 'content_class' ); ?> <?php Aione()->layout->add_style( 'content_style' ); ?>>
		<?php
		if(have_posts()): the_post();
		?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php echo aione_render_rich_snippets_for_pages(); ?>
			<?php if( ! post_password_required($post->ID) ): ?>
			<?php if(!Aione()->theme_options[ 'featured_images_pages' ] && has_post_thumbnail()): ?>
			<div class="image">
				<?php the_post_thumbnail('blog-large'); ?>
			</div>
			<?php endif; ?>
			<?php endif; // password check ?>
			<h3 class="entry-title"><?php the_title(); ?></h3>
			<div class="post-content">
				<?php the_content(); ?>
				<?php aione_link_pages(); ?>
			</div>
			<?php if( ! post_password_required($post->ID) ): ?>
			<?php if(class_exists('WooCommerce')): ?>
			<?php if(Aione()->theme_options[ 'comments_pages' ] && !is_cart() && !is_checkout() && !is_account_page() && !is_page(get_option('woocommerce_thanks_page_id'))): ?>
				<?php
				wp_reset_query();
				comments_template();
				?>
			<?php endif; ?>
			<?php else: ?>
			<?php if(Aione()->theme_options[ 'comments_pages' ]): ?>
				<?php
				wp_reset_query();
				comments_template();
				?>
			<?php endif; ?>
			<?php endif; ?>
			<?php endif; // password check ?>
		</div>
		<?php endif; ?>
	</div>
	<?php do_action( 'oxo_after_content' ); ?>
<?php get_footer();

// Omit closing PHP tag to avoid "Headers already sent" issues.
