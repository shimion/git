<?php
class feature_posts_widget extends WP_Widget {
	/** constructor */
	function feature_posts_widget() {
		parent::WP_Widget(false, $name = "(Obox) Slider", array("description" => "Display fading posts and images from a specific category"));
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance) {
		// Turn $args array into variables.
		extract( $args );
		global $post;
		// Turn $instance array into variables
		if (class_exists( 'Woocommerce' )) {
			global $woocommerce;
		}
		$instance_defaults = array ( 'title' => '', 'display_limit' => '', 'auto_interval' => '', 'post_thumb' => true);
		$instance_args = wp_parse_args( $instance, $instance_defaults );
		extract( $instance_args, EXTR_SKIP );
		
		
		// Setup the post filter if it's defined
		if(isset($postfilter) && isset($instance[$postfilter]))
			$filterval = esc_attr($instance[$postfilter]);
		else
			$filterval = 0;

		// Set the base query args

		if(isset($posttype)) :
			$args = array(
				"post_type" => $posttype,
				"posts_per_page" => $display_limit
			);
		endif;

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

		// Set the post order
		if(isset($post_order_by)) :
			$args['order'] = $post_order;
			$args['orderby'] = $post_order_by;
		
		endif;
		$count = 0;
		$numposts = 0;
		$ocmx_posts = new WP_Query($args); ?>

	<div class="slider clearfix">

		<ul class="gallery-container">
			<?php while ($ocmx_posts->have_posts()) : $ocmx_posts->the_post();
				global $product;
				$args  = array('postid' => $post->ID, 'width' => 940, 'height' => 530, 'hide_href' => false, 'exclude_video' => $post_thumb, 'imglink' => false, 'imgnocontainer' => true, 'resizer' => '940x529');
				$image = get_obox_media($args); ?>

				<li>
					<?php if(isset($image) && $image !="") : ?>
						<div class="post-image fitvid">
							 <?php echo add_video_wmode_transparent($image); ?>
						</div>
					<?php endif; ?>
					<?php if(isset($posttype) && $posttype =="product") : ?>
						<div class="overlay">
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?> - <?php echo $product->get_price_html(); ?></a></h3>
							<?php the_excerpt(); ?>                  		
						</div>
					<?php endif; ?>
				</li>
			<?php
				$count++;
			endwhile; ?>
		</ul>

		<div class="slider-dots" <?php if($slider_dots != 1) : ?>id="overlay"<?php endif; ?>>
			<?php for($i=0; $i < $count; $i++) : ?>
				<a href="#" rel="<?php echo ($i-1); ?>" class="dot <?php if($i == 0) : ?>dot-selected<?php endif; ?>"><?php echo $i; ?></a>
			<?php endfor; ?>
		</div>

		<?php $count=1;  ?>

		<div id="slider-number-<?php echo $use_category; ?>" class="no_display">0</div>
		<div id="slider-auto-<?php echo $use_category; ?>" class="no_display"><?php echo $auto_interval; ?></div>
	</div>

<?php
	}

	/** @see WP_Widget::update */
	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	/** @see WP_Widget::form */
	function form($instance) {
		$defaults = array( 'title' => '', 'display_limit' => '', 'auto_interval' => '');
		$instance_args = wp_parse_args( $instance, $defaults );
		extract( $instance_args, EXTR_SKIP );
		// Setup the post filter if it's defined
		if(isset($postfilter) && isset($instance[$postfilter]))
			$filterval = esc_attr($instance[$postfilter]);
		else
			$filterval = 0;
		$post_type_args = array("public" => true, "exclude_from_search" => false, "show_ui" => true);
		$post_types = get_post_types( $post_type_args, "objects");

?>
        <p><em><?php _e("Click Save after selecting a filter from each menu to load the next filter", "ocmx"); ?></em></p>
	   <p>
		<label for="<?php echo $this->get_field_id('posttype'); ?>"><?php _e("Display", "ocmx"); ?></label>
		<select size="1" class="widefat" id="<?php echo $this->get_field_id("posttype"); ?>" name="<?php echo $this->get_field_name("posttype"); ?>">
			<option <?php if(!isset($posttype) || $posttype == ""){echo "selected=\"selected\"";} ?> value="">--- Select a Content Type ---</option>
			<?php foreach($post_types as $post_type => $details) : ?>
				<option <?php if(isset($posttype) && $posttype == $post_type){echo "selected=\"selected\"";} ?> value="<?php echo $post_type; ?>"><?php echo $details->labels->name; ?></option>
			<?php endforeach; ?>
		</select>
	</p>

	<?php if(isset($posttype) && $posttype != "") :
		if(isset($posttype) && $posttype != "page") :
			$taxonomyargs = array('post_type' => $posttype, "public" => true, "exclude_from_search" => false, "show_ui" => true);
			$taxonomies = get_object_taxonomies($taxonomyargs,'objects');
			if(is_array($taxonomies) && !empty($taxonomies)) : ?>
				<p>
					<label for="<?php echo $this->get_field_id('postfilter'); ?>"><?php _e("Filter by", "ocmx"); ?></label>
					<select size="1" class="widefat" id="<?php echo $this->get_field_id("postfilter"); ?>" name="<?php echo $this->get_field_name("postfilter"); ?>">
						<option <?php if(isset($postfilter) && $postfilter == ""){echo "selected=\"selected\"";} ?> value="">--- Select a Filter ---</option>
						<?php foreach($taxonomies as $taxonomy => $details) : ?>
							<option <?php if(isset($postfilter) && $postfilter == $taxonomy){echo "selected=\"selected\"";} ?> value="<?php echo $taxonomy; ?>"><?php echo $details->labels->name; ?></option>
						<?php $validtaxes[] = $taxonomy;
						endforeach; ?>
					</select>
				</p>
			<?php endif; // !empty($taxonomies)

			if(isset($validtaxes) && isset($postfilter) && $postfilter != "" && ( (is_array($validtaxes) && in_array($postfilter, $validtaxes)) || !is_array($validtaxes) ) ) :
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
					<label for="<?php echo $this->get_field_id('display_limit'); ?>"><?php _e("Post Count", "ocmx"); ?></label>
					<select size="1" class="widefat" id="<?php echo $this->get_field_id('display_limit'); ?>" name="<?php echo $this->get_field_name('display_limit'); ?>">
						<?php $i = 1;
						while($i < 13) :?>
							<option <?php if($display_limit == $i) : ?>selected="selected"<?php endif; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
						<?php if($i < 1) :
								$i++;
							else:
								$i=($i+1);
							endif;
						endwhile; ?>
					</select>
				</p>

		<?php  // Setup the order values
	$order_params = array("date" => "Date", "title" => "Title", "rand" => "Random", "count" => "Comment Count", "menu_order" => "Manual Order(Portfolio Only)"); ?>
	<p>
		<label for="<?php echo $this->get_field_id('post_order_by'); ?>"><?php _e("Order By", "ocmx"); ?></label>
		<select size="1" class="widefat" id="<?php echo $this->get_field_id('post_order_by'); ?>" name="<?php echo $this->get_field_name('post_order_by'); ?>">
			<?php foreach($order_params as $value => $label) :?>
				<option  <?php if(isset($post_order_by) && $post_order_by == $value){echo "selected=\"selected\"";} ?> value="<?php echo $value; ?>"><?php echo $label; ?></option>
			<?php endforeach;?>
		</select>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('post_order'); ?>"><?php _e("Order", "ocmx"); ?></label>
		<select size="1" class="widefat" id="<?php echo $this->get_field_id('post_order'); ?>" name="<?php echo $this->get_field_name('post_order'); ?>">
			<option <?php if(!isset($post_order) || isset($post_order) && $post_order == "DESC") : ?>selected="selected"<?php endif; ?> value="DESC"><?php _e("Descending", 'ocmx'); ?></option>
			<option <?php if(isset($post_order) && $post_order == "ASC") : ?>selected="selected"<?php endif; ?> value="ASC"><?php _e("Ascending", 'ocmx'); ?></option>
		</select>
	</p>
		<p>
			<label for="<?php echo $this->get_field_id('post_thumb'); ?>"><?php _e("Show Images or Videos?", "ocmx"); ?></label>
			<select size="1" class="widefat" id="<?php echo $this->get_field_id('post_thumb'); ?>" name="<?php echo $this->get_field_name('post_thumb'); ?>">
					<option <?php if(isset($post_thumb) && $post_thumb == "1") : ?>selected="selected"<?php endif; ?> value="1"><?php _e("Featured Thumbnails", "ocmx"); ?></option>
					<option <?php if(isset($post_thumb) && $post_thumb == "0") : ?>selected="selected"<?php endif; ?> value="0"><?php _e("Videos", "ocmx"); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('slider_dots'); ?>">Slider Dots Placement</label>
			<select size="1" class="widefat" id="<?php echo $this->get_field_id('slider_dots'); ?>" name="<?php echo $this->get_field_name('slider_dots'); ?>">
					<option <?php if(isset($slider_dots) && $slider_dots == "1") : ?>selected="selected"<?php endif; ?> value="1">Vertical Overlay</option>
					<option <?php if(isset($slider_dots) && $slider_dots == "2") : ?>selected="selected"<?php endif; ?> value="2">Horizontal Overlay</option>
			</select>
		</p>
			<p><label for="<?php echo $this->get_field_id('auto_interval'); ?>">Auto Slide Interval (seconds)<input class="shortfat" id="<?php echo $this->get_field_id('auto_interval'); ?>" name="<?php echo $this->get_field_name('auto_interval'); ?>" type="text" value="<?php if(isset($auto_interval)) { echo $auto_interval; } ?>" /><br /><em><?php _e("(Set to 0 for no auto-sliding or if showing videos)", "ocmx"); ?></em></label></p>
<?php
	} // form

}// class

//This sample widget can then be registered in the widgets_init hook:

// register FooWidget widget
add_action('widgets_init', create_function('', 'return register_widget("feature_posts_widget");'));

?>