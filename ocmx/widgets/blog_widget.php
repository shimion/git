<?php
class blog_widget extends WP_Widget {
	/** constructor */
	function blog_widget() {
		parent::WP_Widget(false, $name = "(Obox) Blog List", array("description" => "Home Page Widget - Display posts from a specific category in the same format as the regular layout."));	
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance) {		
		extract( $args );

		global $woocommerce;
		$instance_defaults = array ('excerpt_length' => 80, 'post_thumb' => 1);
		$instance_args = wp_parse_args( $instance, $instance_defaults );
		extract( $instance_args, EXTR_SKIP );
		if( isset( $instance["title"] ) )
			$title = esc_attr($instance["title"] );
		if( isset( $instance["title_link"] ) )
			$title_link = esc_attr($instance["title_link"] );

		// Setup the post filter if it's defined
		if(isset($postfilter) && isset($instance[$postfilter]))
			$filterval = esc_attr($instance[$postfilter]);
		else
			$filterval = 0;

		// Set the base query args
		if(isset($postfilter) && $postfilter != "" && $filterval != "0") :
			$args = array(
				"post_type" => $posttype,
				"posts_per_page" => $post_count,
				"tax_query" => array(
					array(
						"taxonomy" => $postfilter,
						"field" => "slug",
						"terms" => $filterval
					)
				)		
			);
		else :
			$args = array(
				"post_type" => $posttype,
				"posts_per_page" => $post_count
			);
		endif;

		$loop = new WP_Query($args);
		
		$count = 0;
		$numposts = 0;
		
		?>
			<?php if(isset($title)) : ?>
				<h4 class="widgettitle">
					<a href="<?php if(isset ($title_link)) {echo $title_link;} ?>"><?php echo $title; ?></a>
				</h4>
			<?php endif; ?>
			<ul class="double-cloumn clearfix">
				<li id="left-column">	
					<ul class="blog-main-post-container clearfix">
						<?php 
						if ($loop->have_posts()) : while ($loop->have_posts()) :  $loop->the_post(); 
							global $post;
							$args  = array('postid' => $post->ID, 'width' => 550, 'height' => 309, 'hide_href' => false, 'exclude_video' => $post_thumb, 'imglink' => false, 'imgnocontainer' => true, 'resizer' => '550x309');
							$image = get_obox_media($args);
							$link = get_permalink($post->ID); ?>
							
                            <li class="post">		
							
								<?php if($image !="" && $post_thumb !="none") : ?> 
									<div class="post-image fitvid"> 
										<?php echo $image; ?>
									</div>
								<?php endif; ?>
                                
								<h5 class="date">
									<?php if(get_option("ocmx_meta_date") != "false"): echo date_i18n('d F Y', strtotime($post->post_date)); endif; ?>, <?php _e("written by", "ocmx"); ?> <?php the_author_posts_link(); ?>
								</h5>
                                
								<h2 class="post-title"><a href="<?php echo $link; ?>"><?php the_title(); ?></a></h2>
								
								<div class="copy clearfix">
									<?php if(isset($show_excerpts) && $show_excerpts !="false"):
										the_excerpt(); ?>
										<p><a href="<?php echo $link; ?>" class="action-link"><?php _e("Continue Reading &rarr;", "ocmx"); ?></a></p>
									<?php endif; ?>
								
								</div>    
							</li>   
							<?php endwhile;
						else :
							ocmx_no_posts(); wp_reset_postdata();
						endif; ?>
					</ul>
				</li>
				<?php get_sidebar(); ?>
			</ul>

<?php
	}

	 /** @see WP_Widget::update */
	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	/** @see WP_Widget::form */
	function form($instance) {
		$instance_defaults = array ('show_excerpts' => true, 'post_thumb' => 1, 'posttype' => 'post', 'postfilter' => '0', 'post_count' => 4, 'show_images' => true);
		$instance_args = wp_parse_args( $instance, $instance_defaults );
		extract( $instance_args, EXTR_SKIP );

		// Setup the post filter if it's defined
		if(isset($postfilter) && isset($instance[$postfilter]))
			$filterval = esc_attr($instance[$postfilter]);
		else
			$filterval = 0;

		$post_type_args = array("public" => true, "exclude_from_search" => false, "show_ui" => true);
		$post_types = get_post_types( $post_type_args, "objects");
		if( isset( $instance["title"] ) )
			$title = esc_attr($instance["title"] );
		if( isset( $instance["title_link"] ) )
			$title_link = esc_attr($instance["title_link"] );
?>
		<p><em><?php _e("Click Save after selecting a filter from each menu to load the next filter", "ocmx"); ?></em></p>

	<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e("Title", "ocmx"); ?><input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php if(isset($title)){ echo $title; }?>" /></label>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('title_link'); ?>"><?php _e('Custom Title Link', 'ocmx'); ?><input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title_link'); ?>" type="text" value="<?php if(isset($title_link)){ echo $title_link; }?>" /></label>
	</p>

		<p>
			<label for="<?php echo $this->get_field_id('posttype'); ?>">Display</label>
			<select size="1" class="widefat" id="<?php echo $this->get_field_id("posttype"); ?>" name="<?php echo $this->get_field_name("posttype"); ?>">
				<option <?php if($posttype == ""){echo "selected=\"selected\"";} ?> value="">--- Select a Content Type ---</option>
				<?php foreach($post_types as $post_type => $details) : ?>
					<option <?php if($posttype == $post_type){echo "selected=\"selected\"";} ?> value="<?php echo $post_type; ?>"><?php echo $details->labels->name; ?></option>
				<?php endforeach; ?>
			</select>
		</p>

		<?php if($posttype != "") :
			if($posttype != "page") : ?>
				<?php $taxonomyargs = array('post_type' => $posttype, "public" => true, "exclude_from_search" => false, "show_ui" => true); 
				$taxonomies = get_object_taxonomies($taxonomyargs,'objects');
				if(!empty($taxonomies)) : ?>
					<p>
						<label for="<?php echo $this->get_field_id('postfilter'); ?>">Filter by</label>
						<select size="1" class="widefat" id="<?php echo $this->get_field_id("postfilter"); ?>" name="<?php echo $this->get_field_name("postfilter"); ?>">
							<option <?php if($postfilter == ""){echo "selected=\"selected\"";} ?> value="">--- Select a Filter ---</option>
							<?php foreach($taxonomies as $taxonomy => $details) : ?>
								<option <?php if($postfilter == $taxonomy){echo "selected=\"selected\"";} ?> value="<?php echo $taxonomy; ?>"><?php echo $details->labels->name; ?></option>
							<?php $validtaxes[] = $taxonomy;
							endforeach; ?>
						</select>
					</p>
				<?php endif;
				if($postfilter != "" && ( (is_array($validtaxes) && in_array($postfilter, $validtaxes)) || !is_array($validtaxes) ) ) :
					$tax = get_taxonomy($postfilter);
					$terms = get_terms($postfilter, "orderby=count&hide_empty=0"); ?>
					<p><label for="<?php echo $this->get_field_id($postfilter); ?>"><?php echo $tax->labels->name; ?></label>
					   <select size="1" class="widefat" id="<?php echo $this->get_field_id($postfilter); ?>" name="<?php echo $this->get_field_name($postfilter); ?>">
							<option <?php if($filterval == 0){echo "selected=\"selected\"";} ?> value="0">All</option>
							<?php foreach($terms as $term => $details) :?>
								<option  <?php if($filterval == $details->slug){echo "selected=\"selected\"";} ?> value="<?php echo $details->slug; ?>"><?php echo $details->name; ?></option>
							<?php endforeach;?>
						</select>
					</p>
				<?php endif; ?>
				<?php if(isset($instance["postfilter"])) : ?>
				
					<p>
						<label for="<?php echo $this->get_field_id('post_count'); ?>">Post Count</label>
						<select size="1" class="widefat" id="<?php echo $this->get_field_id('comment_count'); ?>" name="<?php echo $this->get_field_name('post_count'); ?>">
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
				<?php endif; ?>
			<?php endif; ?>
		   <?php if($posttype != "") : ?>
				<p>
					<label for="<?php echo $this->get_field_id('post_thumb'); ?>"><?php _e("Show Images or Videos?", "ocmx"); ?></label>
					<select size="1" class="widefat" id="<?php echo $this->get_field_id('post_thumb'); ?>" name="<?php echo $this->get_field_name('post_thumb'); ?>">
							<option <?php if($post_thumb == "none") : ?>selected="selected"<?php endif; ?> value="none"><?php _e("None", "ocmx"); ?></option>
							<option <?php if($post_thumb == "1") : ?>selected="selected"<?php endif; ?> value="1"><?php _e("Featured Thumbnails", "ocmx"); ?></option>
							<option <?php if($post_thumb == "0") : ?>selected="selected"<?php endif; ?> value="0"><?php _e("Videos", "ocmx"); ?></option>
					</select>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('show_excerpts'); ?>">
						<input type="checkbox" <?php if($show_excerpts == "on") : ?>checked="checked"<?php endif; ?> id="<?php echo $this->get_field_id('show_excerpts'); ?>" name="<?php echo $this->get_field_name('show_excerpts'); ?>">
						Show Excerpts
					</label>
				</p>
			<?php endif;
		endif;  
	} // form

}// class
add_action('widgets_init', create_function('', 'return register_widget("blog_widget");'));

?>