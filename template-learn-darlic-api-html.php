<?php

// Template Name: Darlic Learn Content API HTML
header('Access-Control-Allow-Origin: *');  
header('Content-Type: application/json');

global $post;



$before_tag = "&lt;";
$after_tag = "&gt;";
$args = array(
	'orderby'			=> 'title',
	'order'				=> 'ASC',
	'post_type'			=> 'html-tag',
	'post_status'		=> 'publish',
	'posts_per_page'	=> -1
);
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) {
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		
		$html_tag_rank = get_field( "html_tag_rank" );
		$html_tag_keynotes = get_field( "html_tag_keynotes" );
		$html_tag_browser_compatibility = get_field( "html_tag_browser_compatibility" );
		$html_tag_version = get_field( "html_tag_version" );
		$rows = get_field('html_tag_examples');
		$examples = array();
			if($rows)
			{
				foreach($rows as $row_key => $row)
				{
					 $html_tag_example_html = $row['html_tag_example_html'] ;
					 $html_tag_example_css = $row['html_tag_example_css'] ;
					 $html_tag_example_js = $row['html_tag_example_js'] ;
					 $examples[$row_key] = array ($html_tag_example_html,$html_tag_example_css,$html_tag_example_js);
				}

			}
		$output[] = array (
			'slug'			=>	the_slug_custom(),
			'description'	=>	get_the_content(),
			'keynotes'	=>	$html_tag_keynotes,
			'rank'	=>	$html_tag_rank,
			'browser_compatibility'	=>	$html_tag_browser_compatibility,
			'version'	=>	$html_tag_version,
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
?>