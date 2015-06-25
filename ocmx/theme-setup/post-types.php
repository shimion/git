<?php
add_action( "init", "add_quotes_post_type" );
function add_quotes_post_type() {
  	register_post_type("quotes",
		array("labels" => array(
						"name" => __( "Quotes" ),
						"singular_name" => __( "Quotes" ),
						"rewrite" => array("slug" => "quote")
					),
			"query_var" => true,
			"rewrite" => true,
			"capability_type" => "post",
			'supports' => array('title','excerpt'),
			"public" => true,
			"show_ui" => true)
	);
}

/*******************************/
/* Quote Post Type Custom Meta */

function info_box_links() {
	global $post, $obox_meta;
	$link = get_post_meta($post->ID,"info_box_link",true);
?>
	<p><input type="text" class="widefat" name="info_box_link" value="<?php echo $link; ?>" /></p>
	<p><em>Redirect the user to a custom location.</em></p>
<?php
}
function insert_info_box_links($pID) {
	global $category_added;
	$i = 0;
	if(!isset($category_added) && isset($_POST["info_box_link"])) :
		add_post_meta($pID,"info_box_link",$_POST["info_box_link"],true) or update_post_meta($pID,"info_box_link",$_POST["info_box_link"]);
		$meta_added = 1;
	endif;
}

function add_custom_info_box_link() {
	add_meta_box('obox-custom-type-cats','Custom Link','info_box_links','info-box','side');
	add_meta_box('obox-custom-type-cats','Custom Link','info_box_links','quotes','side');
	add_meta_box('obox-meta-box',$GLOBALS['themename'].' Options','create_info_meta_box_ui','info-box','normal','high');
}

add_action('admin_menu', 'add_custom_info_box_link');
add_action('save_post', 'insert_info_box_links');

add_action('init', 'my_custom_init');
function my_custom_init() {
  add_post_type_support( 'quotes', 'excerpt' );
}


add_filter("manage_edit-quotes_columns", "my_quotes_columns");
add_action("manage_posts_custom_column",  "quote_custom_columns");
function my_quotes_columns($columns)
{
	$columns = array(
		"title" => "Source"
	);
	return $columns;
}

function quote_custom_columns($column){
		global $post;
		switch ($column)
		{
			case "title":
				the_title();
				break;
		}
}


?>