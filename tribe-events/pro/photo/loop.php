<?php
/**
 * Photo View Loop
 * This file sets up the structure for the photo view events loop
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/photo/loop.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

global $more;
$more = false;

?>


<div id="posts-container" class="oxo-blog-layout-grid oxo-blog-layout-grid-<?php echo Aione()->theme_options[ 'blog_grid_columns' ]; ?> isotope oxo-blog-pagination oxo-blog-archive oxo-clearfix">

	<?php while ( have_posts() ) : the_post(); ?>
		<?php do_action( 'tribe_events_inside_before_loop' ); ?>

		<!-- Event  -->
		<div id="post-<?php the_ID() ?>" class="post oxo-clearfix oxo-post-grid">
			<?php tribe_get_template_part( 'pro/photo/single', 'event' ) ?>
		</div><!-- .hentry .vevent -->


		<?php do_action( 'tribe_events_inside_after_loop' ); ?>
	<?php endwhile; ?>

</div>
