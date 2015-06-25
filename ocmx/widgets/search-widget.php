<?php

class searchbox_widget extends WP_Widget {

	

	function searchbox_widget() {

		$widget_ops = array('classname' => 'search-form', 'description' => __( "Home Page Widget - Search box ","ocmx") );

		$this->WP_Widget('search', __("(Obox) Search Box", "ocmx"), $widget_ops);

	}



	/** @see WP_Widget::widget */

	function widget($args, $instance) {

		if(isset($instance["title"]))

			$title = $instance["title"];

?>

	<li class="widget search-form obox-search-widget">

		<form action="<?php bloginfo("url"); ?>" method="get">

			<input type="text" name="s" id="s" class="search" maxlength="50" value="" placeholder="<?php _e("Video Search", "ocmx"); ?>" />

			<input type="submit" class="search_button" value="<?php _e("Search", "ocmx"); ?>" />

            <input type="hidden" value="post" name="post_type" />

		</form>

	</li>

<?php

	}



	/** @see WP_Widget::update */

	function update($new_instance, $old_instance) {

		return $new_instance;



			

	} // form



}// class



//This sample widget can then be registered in the widgets_init hook:



// register FooWidget widget

add_action('widgets_init', create_function('', 'return register_widget("searchbox_widget");'));



?>