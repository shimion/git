<?php
class single_column_widget extends WP_Widget {
	/** constructor */
	function single_column_widget() {
		parent::WP_Widget(false, $name = "(Obox) - Single Column", array("description" => "Home Page Widget - Display posts from a specific category in a list form."));	
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance) {	
		// Turn $instance array into variables
		if (class_exists( 'Woocommerce' )) {
			global $woocommerce;
		}	
		$instance_defaults = array ('title' => '', 'title_link' => '', 'post_count' => '', 'show_images' => true, 'post_thumb' => true, 'show_dates' => false, 'show_excerpts' => false);
		$instance_args = wp_parse_args( $instance, $instance_defaults );
		extract( $instance_args, EXTR_SKIP );


		// Setup the post filter if it's defined
		if(isset($postfilter) && isset($instance[$postfilter]))
			$filterval = esc_attr($instance[$postfilter]);
		else
			$filterval = 0;

		// Set the base query args
		$args = array(
			"post_type" => $posttype,
			"posts_per_page" => $post_count
		);

		// Filter by the chosen taxonomy
		if(isset($postfilter) && $postfilter != "" && $filterval != "0") :
			$args['tax_query'] = array(
					array(
						"taxonomy" => $postfilter,
						"field" => "slug",
						"terms" => $filterval
					)
				);
		endif;

		// Main Post Query

		$get_posts = new WP_Query($args);  ?> 
		
		
			<?php if(isset($title)) : ?>
				<h4 class="widgettitle">
					<a href="<?php if(isset ($title_link)) {echo $title_link;} ?>"><?php echo $title; ?></a>
				</h4>
			<?php endif; ?>
		<ul class="single-column">
			<?php while ( $get_posts->have_posts() ) : $get_posts->the_post(); 
				global $post;
				$link = get_permalink($post->ID);
				$args  = array('postid' => $post->ID, 'width' => 940, 'height' => 529, 'hide_href' => false,  'imglink' => false, 'exclude_video' => $post_thumb, 'imgnocontainer' => true, 'resizer' => '940x529');
				$image = get_obox_media($args); 
				if($show_images != "on" || $image == "") : $maxlen = 90; else : $maxlen = 75; endif;  ?>
				<li class="column">				
					<?php if($show_images != false && $image !="") : ?>
					<div class="post-image fitvid">
						<?php echo $image; ?>
					</div>
					<?php endif; ?>
					<?php if($show_dates != false) : ?><h5 class="date"><?php echo date('d M Y', strtotime($post->post_date)); ?></h5><?php endif; ?>
						<h2 class="post-title"><a href="<?php echo $link; ?>"><?php the_title(); ?></a></h2>
				   
					<?php if($show_excerpts != false) :
						if($post->post_excerpt != "") :
							echo "<p>".substr(strip_tags($post->post_excerpt), 0, $maxlen)."...</p>";
						else :
							the_content("");
						endif;
					endif; ?>
				</li>				
			<?php endwhile; ?>
		</ul>
<?php
	}

	/** @see WP_Widget::update */
	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	/** @see WP_Widget::form */
	function form($instance) {
		$instance_defaults = array ('title' => '', 'title_link' => '', 'post_thumb' => 1, 'post_count' => '', 'posttype' => 'post', 'postfilter' => '0');
		$instance_args = wp_parse_args( $instance, $instance_defaults );
		extract( $instance_args, EXTR_SKIP );
		// Setup the post filter if it's defined
		if(isset($postfilter) && isset($instance[$postfilter]))
			$filterval = esc_attr($instance[$postfilter]);

		$post_type_args = array("public" => true, "exclude_from_search" => false, "show_ui" => true);
		$post_types = get_post_types( $post_type_args, "objects");

	 ?>
	<p><em><?php _e("Click Save after selecting a filter from each menu to load the next filter", "ocmx"); ?></em></p>

	<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e("Title", "ocmx"); ?><input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php if(isset($title)) echo $title; ?>" /></label>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('title_link'); ?>"><?php _e('Custom Title Link', 'ocmx'); ?><input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title_link'); ?>" type="text" value="<?php if(isset($title_link)) {echo $title_link;} ?>" /></label>
	</p>
	   
	   <p>
		<label for="<?php echo $this->get_field_id('posttype'); ?>"><?php _e("Display", "ocmx"); ?></label>
		<select size="1" class="widefat" id="<?php echo $this->get_field_id("posttype"); ?>" name="<?php echo $this->get_field_name("posttype"); ?>">
			<option <?php if(!isset($posttype) || $posttype == ""){echo "selected=\"selected\"";} ?> value="">--- Select a Content Type ---</option>
			<?php foreach($post_types as $post_type => $details) : ?>
				<option <?php if(isset($posttype) && $posttype == $post_type){echo "selected=\"selected\"";} ?> value="<?php echo $post_type; ?>"><?php echo $details->labels->name; ?></option>
			<?php endforeach; ?>
		</select>
		</p>

	<?php if($posttype != "") :
		if($posttype != "page") :
			$taxonomyargs = array('post_type' => $posttype, "public" => true, "exclude_from_search" => false, "show_ui" => true);
			$taxonomies = get_object_taxonomies($taxonomyargs,'objects');
			if(is_array($taxonomies) && !empty($taxonomies)) : ?>
				<p>
					<label for="<?php echo $this->get_field_id('postfilter'); ?>"><?php _e("Filter by", "ocmx"); ?></label>
					<select size="1" class="widefat" id="<?php echo $this->get_field_id("postfilter"); ?>" name="<?php echo $this->get_field_name("postfilter"); ?>">
						<option <?php if($postfilter == ""){echo "selected=\"selected\"";} ?> value="">--- Select a Filter ---</option>
						<?php foreach($taxonomies as $taxonomy => $details) : ?>
							<option <?php if($postfilter == $taxonomy){echo "selected=\"selected\"";} ?> value="<?php echo $taxonomy; ?>"><?php echo $details->labels->name; ?></option>
						<?php $validtaxes[] = $taxonomy;
						endforeach; ?>
					</select>
				</p>
			<?php endif; // !empty($taxonomies)

			if(isset($validtaxes) && $postfilter != "" && ( (is_array($validtaxes) && in_array($postfilter, $validtaxes)) || !is_array($validtaxes) ) ) :
				$tax = get_taxonomy($postfilter);
				$terms = get_terms($postfilter, "orderby=count&hide_empty=0"); ?>
				<p><label for="<?php echo $this->get_field_id($postfilter); ?>"><?php echo $tax->labels->name; ?></label>
				   <select size="1" class="widefat" id="<?php echo $this->get_field_id($postfilter); ?>" name="<?php echo $this->get_field_name($postfilter); ?>">
						<option <?php if(isset($filterval) && $filterval == 0){echo "selected=\"selected\"";} ?> value="0">All</option>
						<?php foreach($terms as $term => $details) :?>
							<option  <?php if(isset($filterval) && $filterval == $details->slug){echo "selected=\"selected\"";} ?> value="<?php echo $details->slug; ?>"><?php echo $details->name; ?></option>
						<?php endforeach;?>
					</select>
				</p>
			<?php endif; // isset($postfilter) && $postfilter != ""
		 endif;  // $posttype != "page"
	endif;  // $posttype != "" ?>
	<p>
		<label for="<?php echo $this->get_field_id('post_count'); ?>"><?php _e("Post Count", "ocmx"); ?></label>
		<select size="1" class="widefat" id="<?php echo $this->get_field_id('post_count'); ?>" name="<?php echo $this->get_field_name('post_count'); ?>">
			<?php $i = 1;
			while($i < 13) :?>
				<option <?php if($post_count == $i) : ?>selected="selected"<?php endif; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
			<?php if($i < 1) :
					$i++;
				else:
					$i=($i+1);
				endif;
			endwhile; ?>
		</select>
	</p>
		   <?php if($posttype != "") : ?>
				<p>
					<label for="<?php echo $this->get_field_id('post_thumb'); ?>"><?php _e("Show Images or Videos?", "ocmx"); ?></label>
					<select size="1" class="widefat" id="<?php echo $this->get_field_id('post_thumb'); ?>" name="<?php echo $this->get_field_name('post_thumb'); ?>">
							<option <?php if(isset($post_thumb) && $post_thumb == "none") : ?>selected="selected"<?php endif; ?> value="none"><?php _e("None", "ocmx"); ?></option>
							<option <?php if(isset($post_thumb) && $post_thumb == "1") : ?>selected="selected"<?php endif; ?> value="1"><?php _e("Featured Thumbnails", "ocmx"); ?></option>
							<option <?php if(isset($post_thumb) && $post_thumb == "0") : ?>selected="selected"<?php endif; ?> value="0"><?php _e("Videos", "ocmx"); ?></option>
					</select>
				</p>
				<?php if($posttype != "product") : ?>
				<p>
					<label for="<?php echo $this->get_field_id('show_dates'); ?>">
						<input type="checkbox" <?php if(isset($show_dates) && $show_dates == "on") : ?>checked="checked"<?php endif; ?> id="<?php echo $this->get_field_id('show_dates'); ?>" name="<?php echo $this->get_field_name('show_dates'); ?>">
						<?php _e("Show Dates", "ocmx"); ?>
					</label>
				</p>
				<?php endif; ?>
				<p>
					<label for="<?php echo $this->get_field_id('show_excerpts'); ?>">
						<input type="checkbox" <?php if(isset($show_excerpts) && $show_excerpts == "on") : ?>checked="checked"<?php endif; ?> id="<?php echo $this->get_field_id('show_excerpts'); ?>" name="<?php echo $this->get_field_name('show_excerpts'); ?>">
						Show Excerpts
					</label>
				</p>
			<?php endif;
		
	} // form

}// class

//This sample widget can then be registered in the widgets_init hook:

// register FooWidget widget
add_action('widgets_init', create_function('', 'return register_widget("single_column_widget");'));

?>