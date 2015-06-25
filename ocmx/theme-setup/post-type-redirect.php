<?php 
add_action("template_redirect",'my_template_redirect');
function my_template_redirect()
{
	global $wp, $ocmx_post_types;
	$wp->query_vars["post_type"] = "";
	$ocmx_post_types = array();
	$ocmx_post_types[] = "quote";
	$ocmx_post_types[] = "info-box";
	$ocmx_post_types[] = "portfolio";
	
	if (in_array($wp->query_vars["post_type"], $ocmx_post_types))
	{
		if ( is_robots() ) :
			do_action('do_robots');
			return;
		elseif ( is_feed() ) :
			do_feed();
			return;
		elseif ( is_trackback() ) :
			include( ABSPATH . 'wp-trackback.php' );
			return;
		elseif($wp->query_vars["name"]):
			include(TEMPLATEPATH . "/single-".$wp->query_vars["post_type"].".php");
			die();
		else:
			include(TEMPLATEPATH . "/".$wp->query_vars["post_type"].".php");
			die();
		endif;

	}
}
?>