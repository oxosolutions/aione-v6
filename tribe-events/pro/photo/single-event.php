<?php
/**
 * Photo View Single Event
 * This file contains one event in the photo view
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/photo/single_event.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>

<?php

global $post;

?>

<div class="oxo-post-wrapper">

	<?php if ( has_post_thumbnail() ) : ?>
	<div class="oxo-flexslider flexslider oxo-post-slideshow">
		<ul class="slides">
			<li class="hover-type-<?php echo Aione()->settings->get( 'ec_hover_type' ); ?>">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'full' ); ?></a>
			</li>
		</ul>
	</div>
	<?php endif; ?>

	<div class="oxo-post-content-wrapper">

		<div class="oxo-post-content post-content">

			<!-- Event Title -->
			<?php do_action( 'tribe_events_before_the_event_title' ); ?>
			<h2 class="entry-title">
				<a class="url" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title() ?>" rel="bookmark">
					<?php the_title(); ?>
				</a>
			</h2>
			<?php do_action( 'tribe_events_after_the_event_title' ); ?>

			<!-- Event Meta -->
			<?php do_action( 'tribe_events_before_the_meta' ); ?>
			<div class="oxo-single-line-meta">
				<div class="updated published time-details">
					<?php if ( ! empty( $post->distance ) ) : ?>
						<strong>[<?php echo tribe_get_distance_with_unit( $post->distance ); ?>]</strong>
					<?php endif; ?>
					<?php echo tribe_events_event_schedule_details(); ?>
				</div>
			</div><!-- .tribe-events-event-meta -->
			<?php do_action( 'tribe_events_after_the_meta' ); ?>

			<div class="oxo-content-sep"></div>

			<!-- Event Content -->
			<?php do_action( 'tribe_events_before_the_content' ); ?>
			<div class="oxo-post-content-container">
				<?php echo tribe_events_get_the_excerpt() ?>
			</div>
			<?php do_action( 'tribe_events_after_the_content' ) ?>

			<div class="oxo-meta-info">
				<div class="oxo-alignleft">
					<?php
						if ( ! Aione()->theme_options[ 'post_meta_read' ] ) {
							$link_target = '';
							if( oxo_get_page_option( 'link_icon_target', get_the_ID() ) == 'yes' ||
								oxo_get_page_option( 'post_links_target', get_the_ID() ) == 'yes' ) {
								$link_target = ' target="_blank"';
							}
							echo sprintf( '<a href="%s" class="oxo-read-more"%s>%s</a>', get_permalink(), $link_target, __( 'Find Out More', 'Aione' ) );
						}
					?>
				</div>
			</div>

		</div>

	</div><!-- /.tribe-events-event-details -->

</div><!-- /.tribe-events-photo-event-wrap -->
