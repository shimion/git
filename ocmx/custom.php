<?php 

// Custom fields for WP write panel



$obox_meta = array(

		"media" => array (

			"name"			=> "other_media",

			"default" 		=> "",

			"label" 		=> "Image",

			"desc"      	=> "Select a feature image to use for your post.",

			"input_type"  	=> "image",

			"input_size"	=> "50",

			"img_width"		=> "535",

			"img_height"	=> "255",

			"effects" => array("None" => "0", "Grey Scale" => "2", "Negative" => "1", "Brightness" => "3", "Contrast" => "5", "Gaussian Blur" => "8", "Colorize" => "4")

		),	

		"video" => array (

			"name"			=> "video_link",

			"default" 		=> "",

			"label" 		=> "Video Link",

			"desc"      	=> "Provide your video link instead of the embed code and we'll use <a href='http://codex.wordpress.org/Embeds' target='_blank'>oEmbed</a> to translate that into a video.",

			"input_type"  	=> "text"

		),	

		"embed" => array (

			"name"			=> "main_video",

			"default" 		=> "",

			"label" 		=> "Embed Code",

			"desc"      	=> "Input the embed code of your video here.",

			"input_type"  	=> "textarea"

		),

		"hostedvideo" => array (

			"name"			=> "video_hosted",

			"default" 		=> "",

			"label" 		=> "Self Hosted Video Formats: .MP4 or .MPV",

			"desc"      	=> "Please paste in your self hosted video link. To upload videos <a href='".get_bloginfo("url")."/wp-admin/media-new.php'>click here</a>",

			"input_type"  	=> "text"

		),

		"hostedvideo_ogv" => array (

			"name"			=> "video_hosted_ogv",

			"default" 		=> "",

			"label" 		=> "Self Hosted Video Formats: .OGV (for non HTML5 browsers)",

			"desc"      	=> "Please paste in your self hosted video link. To upload videos <a href='".get_bloginfo("url")."/wp-admin/media-new.php'>click here</a>",

			"input_type"  	=> "text"

		)

	);

$layout = array (

				"name"			=> "layout",

				"default" 		=> "",

				"label" 		=> "Layout",

				"desc"      	=> "Select the layout of your Portfolio list when using the \"Portfolio List\" page template",

				"input_type"  	=> "select",

				"options" => array("Single Column" => "one-column", "Two Column" => "two-column", "Three Column" => "three-column", "Four Column" => "four-column")

			);

function create_meta_box_ui() {

	global $post, $obox_meta, $layout;

	if(get_post_type($post) == "page") :

		array_unshift($obox_meta, $layout);

	endif;

	post_meta_panel($post->ID, $obox_meta);

}

function insert_obox_metabox($pID) {

	global $post, $obox_meta, $meta_added, $layout;

	if(get_post_type($post) == "page") :

		array_unshift($obox_meta, $layout);

	endif;

	if(!isset($meta_added))

		post_meta_update($pID, $obox_meta);

	$meta_added = 1;

}

if(function_exists("ocmx_change_metatype")) {}



function add_obox_meta_box() {

	if (function_exists('add_meta_box') ) {

		add_meta_box('obox-meta-box',$GLOBALS['themename'].' Options','create_meta_box_ui','post','normal','high');

		add_meta_box('obox-meta-box',$GLOBALS['themename'].' Options','create_meta_box_ui','page','normal','high');

		add_meta_box('obox-meta-box',$GLOBALS['themename'].' Options','create_meta_box_ui','portfolio','normal','high');

	}

}



function my_page_excerpt_meta_box() {

	add_meta_box( 'postexcerpt', __('Excerpt'), 'post_excerpt_meta_box', 'page', 'normal', 'core' );

}



add_action('admin_menu', 'add_obox_meta_box');

add_action('admin_menu', 'my_page_excerpt_meta_box');

add_action('admin_head-post-new.php', 'ocmx_change_metatype');

add_action('admin_head-post.php', 'ocmx_change_metatype');

add_action('save_post', 'insert_obox_metabox');

add_action('publish_post', 'insert_obox_metabox');  ?>