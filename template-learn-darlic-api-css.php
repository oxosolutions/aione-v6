<?php

// Template Name: Darlic Learn Content API CSS
header('Access-Control-Allow-Origin: *');  
header('Content-Type: application/json');

global $post;



$before_tag = "&lt;";
$after_tag = "&gt;";
$args = array(
	'orderby'			=> 'title',
	'order'				=> 'ASC',
	'post_type'			=> 'css3-property',
	'post_status'		=> 'publish',
	'posts_per_page'	=> -1
);
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) {
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		
		$css_property_rank = get_field( "css_property_rank" );
		$css_property_key_notes = get_field( "css_property_key_notes" );
		//$css_property_browser_compatibility = get_field( "css_property_browser_compatibility" );
		$css_property_version = get_field( "css_property_version" );
		$rows = get_field('css_properties_examples');
		$css_property_browser_compatibility = get_field('css_properties_browser_compatibility');
		$examples = array();
			if($rows)
			{
				foreach($rows as $row_key => $row)
				{
					 $css_property_example_html = $row['css_property_example_html'] ;
					 $css_property_example_css = $row['css_property_example_css'] ;
					 $css_property_example_js = $row['css_property_example_js'] ;
					 $examples[$row_key] = array ($css_property_example_html,$css_property_example_css,$css_property_example_js);
				}

			}
		$output[] = array (
			'slug'			=>	the_slug_custom(),
			'description'	=>	get_the_content(),
			'keynotes'	=>	$css_property_key_notes,
			'rank'	=>	$css_property_rank,
			'browser_compatibility'	=>	$css_property_browser_compatibility,
			'version'	=>	$css_property_version,
			'examples'	=>	$examples,
		);


	}
}
//wp_reset_postdata();
//return json_encode($output);
echo json_encode($output);
/*echo '<pre>'; 
print_r($output);
echo '</pre>'; */


function the_slug_custom($echo){
  $slug = basename(get_permalink());
  do_action('before_slug', $slug);
  $slug = apply_filters('slug_filter', $slug);
  if( $echo ) //echo $slug;
  do_action('after_slug', $slug);
  return $slug;
}