<?php
$layout = '';
if(is_archive()) {
	$layout = Aione()->theme_options[ 'blog_archive_layout' ];
} elseif(is_search()) {

	if ( Aione()->theme_options[ 'search_featured_images' ] ) {
		return;
	}

	$layout = Aione()->theme_options[ 'search_layout' ];
} else {
	$layout = Aione()->theme_options[ 'blog_layout' ];
}
?>
<?php if ( $layout != 'Grid' && $layout != 'Timeline' ) {
	$styles = '';

	if ( get_post_meta( $post->ID, 'pyre_fimg_width', true ) && get_post_meta( $post->ID, 'pyre_fimg_width', true ) != 'auto' ) {
		$styles .= sprintf('
			#post-%s .oxo-post-slideshow{
				max-width:%s!important;
			}', $post->ID, get_post_meta( $post->ID, 'pyre_fimg_width', true )
		);
	}

	if ( get_post_meta( $post->ID, 'pyre_fimg_height', true ) && get_post_meta( $post->ID, 'pyre_fimg_height', true ) != 'auto' ) {
		$styles .= sprintf('
			#post-%s .oxo-post-slideshow,
			#post-%s .oxo-post-slideshow .oxo-image-wrapper img{
				max-height:%s!important;
			}', $post->ID, $post->ID, get_post_meta( $post->ID, 'pyre_fimg_height', true)
		);
	}

	if ( get_post_meta( $post->ID, 'pyre_fimg_width', true ) && get_post_meta( $post->ID, 'pyre_fimg_width', true ) == 'auto' ) {
		$styles .= sprintf('
			#post-%s .oxo-post-slideshow .oxo-image-wrapper img{
				width:auto;
			}', $post->ID
		);
	}

	if ( get_post_meta( $post->ID, 'pyre_fimg_height', true ) && get_post_meta( $post->ID, 'pyre_fimg_height', true ) == 'auto' ) {
		$styles .= sprintf('
			#post-%s .oxo-post-slideshow .oxo-image-wrapper img{
				height:auto;
			}', $post->ID
		);
	}

	if( get_post_meta($post->ID, 'pyre_fimg_height', true) && get_post_meta($post->ID, 'pyre_fimg_width', true) &&
		get_post_meta($post->ID, 'pyre_fimg_height', true) != 'auto' && get_post_meta($post->ID, 'pyre_fimg_width', true) != 'auto'
	) {
		$styles .= sprintf('
			@media only screen and (max-width: 479px){
				#post-%s .oxo-post-slideshow,
				#post-%s .oxo-post-slideshow .oxo-image-wrapper img{
					width:auto !important;
					height:auto !important;
				}
			}', $post->ID, $post->ID
		);
	}

	if ( $styles ) {
		printf( '<style type="text/css">%s</style>', $styles );
	}
}

$permalink = get_permalink($post->ID);

if(is_archive()) {
	if(Aione()->theme_options[ 'blog_archive_sidebar' ] == 'None' && Aione()->theme_options[ 'blog_archive_sidebar_2' ] == 'None') {
		$size = 'full';
	} else {
		$size = 'blog-large';
	}
} else {
	if(! Aione()->template->has_sidebar()) {
		$size = 'full';
	} else {
		$size = 'blog-large';
	}
}

if($layout == 'Medium' || $layout == 'Medium Alternate') {
	$size = 'blog-medium';
}

if(
	get_post_meta($post->ID, 'pyre_fimg_height', true) && get_post_meta($post->ID, 'pyre_fimg_width', true) &&
	get_post_meta($post->ID, 'pyre_fimg_height', true) != 'auto' && get_post_meta($post->ID, 'pyre_fimg_width', true) != 'auto'
) {
	$size = 'full';
}

if(
	get_post_meta($post->ID, 'pyre_fimg_height', true) == 'auto' ||
	get_post_meta($post->ID, 'pyre_fimg_width', true) == 'auto'
) {
	$size = 'full';
}

if($layout == 'Grid' || $layout == 'Timeline') {
	$size = 'full';
}
?>

<?php
if( ( has_post_thumbnail() || get_post_meta(get_the_ID(), 'pyre_video', true) ) &&
	! post_password_required( get_the_ID() )
):
?>
<div class="oxo-flexslider flexslider oxo-flexslider-loading oxo-post-slideshow">
	<ul class="slides">
		<?php if(get_post_meta(get_the_ID(), 'pyre_video', true)): ?>
		<li>
			<div class="full-video">
				<?php echo get_post_meta(get_the_ID(), 'pyre_video', true); ?>
			</div>
		</li>
		<?php endif; ?>
		<?php if(has_post_thumbnail()): ?>
		<?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
		<?php $attachment_data = wp_get_attachment_metadata(get_post_thumbnail_id()); ?>
		<li>
			<?php echo aione_render_first_featured_image_markup( $post->ID, $size, $permalink ); ?>
		</li>
		<?php endif; ?>
		<?php
		$i = 2;
		while($i <= Aione()->theme_options[ 'posts_slideshow_number' ]):
		$attachment_id = kd_mfi_get_featured_image_id('featured-image-'.$i, 'post');
		if($attachment_id):
		?>
		<?php $attachment_image = wp_get_attachment_image_src($attachment_id, $size); ?>
		<?php $full_image = wp_get_attachment_image_src($attachment_id, 'full'); ?>
		<?php $attachment_data = wp_get_attachment_metadata($attachment_id); ?>
		<?php if( is_array( $attachment_data ) ): ?>
		<li>
			<div class="oxo-image-wrapper">
				<a href="<?php the_permalink(); ?>"><img src="<?php echo $attachment_image[0]; ?>" alt="<?php echo $attachment_data['image_meta']['title']; ?>" /></a>
				<a style="display:none;" href="<?php echo $full_image[0]; ?>" data-rel="iLightbox[gallery<?php echo $post->ID; ?>]"  title="<?php echo get_post_field('post_excerpt', $attachment_id); ?>" data-title="<?php echo get_post_field('post_title', $attachment_id); ?>" data-caption="<?php echo get_post_field('post_excerpt', $attachment_id); ?>"><?php if(get_post_meta($attachment_id, '_wp_attachment_image_alt', true)): ?><img style="display:none;" alt="<?php echo get_post_meta($attachment_id, '_wp_attachment_image_alt', true); ?>" /><?php endif; ?></a>
			</div>
		</li>
		<?php endif; ?>
		<?php endif; $i++; endwhile; ?>
	</ul>
</div>
<?php endif;

// Omit closing PHP tag to avoid "Headers already sent" issues.
