<?php
class dual_category extends WP_Widget {
	/** constructor */
	function dual_category() {
		parent::WP_Widget( false, $name = __("(Obox) - Dual Category Posts", "ocmx"), array( "description" => __("Home Page Widget - Display different post types from two seperate categories side by side.","ocmx") ) );	
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance) {	 
	// Turn $instance array into variables
		if (class_exists( 'Woocommerce' )) {
			global $woocommerce;
		}?>
  
	 <!--Begin Column One -->     
	<ul class="two-column">
	
	<?php for ($i = 1; $i < 3; $i++) {
		// Setup variables for this column
		if(isset($instance["title_".$i]))
			$title = $instance["title_".$i];
		if(isset($instance['post_count_'.$i]))
			$post_count = $instance['post_count_'.$i];
		if(isset($instance['show_images_'.$i]))
			$show_images = $instance['show_images_'.$i];
		if(isset($instance['show_excerpts_'.$i]))
			$show_excerpts = $instance['show_excerpts_'.$i];
		if(isset($instance['show_dates_'.$i]))
			$show_dates = $instance['show_dates_'.$i];
	
			
		if(isset($instance['post_category_'.$i]))
			$post_category = $instance['post_category_'.$i];    
		$posttype = $instance["posttype_".$i]; 
		$postfilter = $instance["postfilter_".$i];
		$filtername = $postfilter."_".$i;
		$filterval = $instance[$filtername]; 
		
		if( isset( $postfilter ) && $postfilter != "" && $filterval != "0" ) :
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
		//Set the post Aguments and Query accordingly
			$count = 0;
			$numposts = 0;
			$left_posts = new WP_Query( $args ); ?>
			
				<li class="column">
					<h4 class="section-title"><?php if(isset($title)) {echo $title; }?></h4>
					<ul>
						<?php while ($left_posts->have_posts()) : $left_posts->the_post();
							global $post, $product;
							$link = get_permalink($post->ID);
							$args  = array( 'postid' => $post->ID, 'width' => 460, 'hide_href' => false, 'exclude_video' => true, 'imglink' => false, 'imgnocontainer' => true, 'resizer' => '460' );
							$image = get_obox_media($args); 
							if(isset($show_images) &&  $show_images != "on" || $image == "" ) : $maxlen = 120; else : $maxlen = 119; endif; ?>
							<li>				
								 <?php if(isset($show_images) && $show_images =="on" && $image !="" ) : ?> 
									<!--Show the oEmbed Thumbnail if checked in Theme Options -->        			
									<div class="post-image fitvid">
										<?php echo $image;?>
									</div>
								<?php else : 
									$image = $woocommerce->plugin_url().'/assets/images/placeholder.png'; ?>
									<div class="post-image fitvid">
										<img src="<?php echo $image; ?>" alt="<?php the_title(); ?>" width="460px" height="120px" />
									</div>
								<?php endif; ?>
								<!--Show Date -->
								<?php if($posttype !="product" && isset($show_dates) && $show_dates == "on" ) : ?>
									<h5 class="date"><?php echo the_time( get_option( 'date_format' ) ); ?></h5>
								<?php endif; ?>
								<!--Show the Title -->
								<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); if($posttype == "product") {echo " - ".$product->get_price_html();} ?></a></h2>
								<!--Show Excerpt -->
								<?php if(isset($show_excerpts) && $show_excerpts == "on" ) :
									if( $post->post_excerpt != "" ) :
										echo "<p>".substr( strip_tags( $post->post_excerpt ), 0, $maxlen )."...</p>";
									else :
										the_excerpt("");
									endif;
								endif; ?>
								<?php if (isset($show_continue) && $show_continue =="on") :
									if($posttype =="product") : 
										do_action( 'woocommerce_after_shop_loop_item' ); 
									endif; 
								endif;?>
							</li>				
						<?php endwhile; ?>
					</ul>
				</li>
			<?php }; ?>
		</ul>
	<?php
	}
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	/** @see WP_Widget::form */
	function form($instance) {
	
	for ($i = 1; $i < 3; $i++) {
		if(isset($instance["title_".$i]))
			$title = $instance["title_".$i];
		if(isset($instance['post_count_'.$i]))
			$post_count = $instance['post_count_'.$i];
		if(isset($instance['show_images_'.$i]))
			$show_images = $instance['show_images_'.$i];
		if(isset($instance['show_excerpts_'.$i]))
			$show_excerpts = $instance['show_excerpts_'.$i];
		if(isset($instance['show_dates_'.$i]))
			$show_dates = $instance['show_dates_'.$i];
 
		if( isset( $instance['post_category_'.$i] ) )
			$post_category = $instance['post_category_'.$i];
		
		$post_type_args = array("public" => true, "exclude_from_search" => false, "show_ui" => true);
		$post_types = get_post_types( $post_type_args, "objects" );

		if( isset( $instance["posttype_".$i] ) ){
			$posttype = $instance["posttype_".$i]; 
		}

		if( isset( $instance["postfilter_".$i] ) ){
			$postfilter = $instance["postfilter_".$i]; 
			$filtername = $postfilter."_".$i;
			if( isset( $instance[$filtername] ) ){
				$filterval = $instance[$filtername];
			}
		}

?>
		<h3><?php _e("Column $i","ocmx"); ?></h3>
		<p>
			<label for="<?php echo $this->get_field_id('title_'.$i); ?>">Title<input class="widefat" id="<?php echo $this->get_field_id('title_'.$i); ?>" name="<?php echo $this->get_field_name('title_'.$i); ?>" type="text" value="<?php if(isset($instance['title_'.$i])) echo $instance['title_'.$i]; ?>" /></label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('posttype_'.$i); ?>">Display</label>
			<select size="1" class="widefat" id="<?php echo $this->get_field_id("posttype_".$i); ?>" name="<?php echo $this->get_field_name("posttype_".$i); ?>">
				<option <?php if(isset($posttype) && $posttype == "" ) { echo "selected=\"selected\""; } ?> value="">--- Select a Content Type ---</option>
				<?php foreach( $post_types as $post_type => $details ) : ?>
					<option <?php if(isset($posttype) && $posttype == $post_type ) { echo "selected=\"selected\""; } ?> value="<?php echo $post_type; ?>"><?php echo $details->labels->name; ?></option>
				<?php endforeach; ?>
			</select>
		</p>
			<?php if(isset($posttype) && $posttype != "") :
				if($posttype != "page") : ?>
					<?php $taxonomyargs = array('post_type' => $posttype, "public" => true, "exclude_from_search" => false, "show_ui" => true); 
					$taxonomies = get_object_taxonomies( $taxonomyargs, 'objects' );
					if( !empty( $taxonomies ) ) : ?>
						<p>
							<label for="<?php echo $this->get_field_id('postfilter_'.$i); ?>">Filter by</label>
							<select size="1" class="widefat" id="<?php echo $this->get_field_id("postfilter_".$i); ?>" name="<?php echo $this->get_field_name("postfilter_".$i); ?>">
								<option <?php if(isset($postfilter) && $postfilter == "" ) { echo "selected=\"selected\""; } ?> value="">--- Select a Filter ---</option>
								<?php foreach( $taxonomies as $taxonomy => $details ) : ?>
									<option <?php if(isset($postfilter) && $postfilter == $taxonomy ) { echo "selected=\"selected\""; } ?> value="<?php echo $taxonomy; ?>"><?php echo $details->labels->name; ?></option>
								<?php $validtaxes[] = $taxonomy;
								endforeach; ?>
							</select>
						</p>
					<?php endif;
					if(isset($postfilter) && $postfilter != "" && ( ( is_array( $validtaxes ) && in_array( $postfilter, $validtaxes ) ) || !is_array( $validtaxes ) ) ) :
						$tax = get_taxonomy( $postfilter );
						$terms = get_terms( $postfilter, "orderby=name&hide_empty=0" ); ?>
						<p><label for="<?php echo $this->get_field_id($filtername); ?>"><?php echo $tax->labels->name; ?></label>
						   <select size="1" class="widefat" id="<?php echo $this->get_field_id($filtername); ?>" name="<?php echo $this->get_field_name($filtername); ?>">
								<option <?php if(isset($filterval) && $filterval == 0 ) { echo "selected=\"selected\""; } ?> value="0">All</option>
								<?php foreach( $terms as $term => $details ) :?>
									<option  <?php if(isset($filterval) && $filterval == $details->slug ){ echo "selected=\"selected\""; } ?> value="<?php echo $details->slug; ?>"><?php echo $details->name; ?></option>
								<?php endforeach;?>
							</select>
						</p>
					<?php endif; ?>
					<?php if(isset($instance["postfilter"])) : ?>
				
				<p>
					<label for="<?php echo $this->get_field_id('post_count'); ?>">Post Count</label>
					<select size="1" class="widefat" id="<?php echo $this->get_field_id('post_count'); ?>" name="<?php echo $this->get_field_name('post_count'); ?>">
						<?php $i = 1;
						while($i < 13) :?>
							<option <?php if( $post_count == $i ) : ?>selected="selected"<?php endif; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
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
		<?php endif; ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('post_count_'.$i); ?>">Post Count</label>
			<select size="1" class="widefat" id="<?php echo $this->get_field_id('post_count_'.$i); ?>" name="<?php echo $this->get_field_name('post_count_'.$i); ?>">
				<?php for($counter = 1; $counter <= 12; $counter++) : ?>
					<option <?php if(isset($post_count) && $post_count == $counter) : ?>selected="selected"<?php endif; ?> value="<?php echo $counter; ?>"><?php echo $counter; ?></option>
				<?php endfor; ?>
			</select>
		</p>
		<p>
		
			<label for="<?php echo $this->get_field_id('show_images_'.$i); ?>">
				<input type="checkbox" <?php if(isset($show_images) && $show_images == "on") : ?>checked="checked"<?php endif; ?> id="<?php echo $this->get_field_id('show_images_'.$i); ?>" name="<?php echo $this->get_field_name('show_images_'.$i); ?>">
				Show Images
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('show_excerpts_'.$i); ?>">
				<input type="checkbox" <?php if(isset($show_excerpts) && $show_excerpts == "on") : ?>checked="checked"<?php endif; ?> id="<?php echo $this->get_field_id('show_excerpts_'.$i); ?>" name="<?php echo $this->get_field_name('show_excerpts_'.$i); ?>">
				Show Excerpts
			</label>
		</p>
		<?php if(isset($posttype) && $posttype !="product") : ?>
		<p>
			<label for="<?php echo $this->get_field_id('show_dates_'.$i); ?>">
				<input type="checkbox" <?php if(isset($show_dates) && $show_dates == "on") : ?>checked="checked"<?php endif; ?> id="<?php echo $this->get_field_id('show_dates_'.$i); ?>" name="<?php echo $this->get_field_name('show_dates_'.$i); ?>">
				Show Date
			</label>
		</p>
	 <?php endif;
	 if(isset($posttype) && $posttype == "product") : ?>
	<p>
		<label for="<?php echo $this->get_field_id('show_continue_'.$i); ?>">
			<input type="checkbox" <?php if(isset($show_continue) && $show_continue == "on") : ?>checked="checked"<?php endif; ?> id="<?php echo $this->get_field_id('show_continue_'.$i); ?>" name="<?php echo $this->get_field_name('show_continue_'.$i); ?>">
			Show Buy Button
		</label>
	</p>
<?php endif;
		}
	} // form

}// class

//This sample widget can then be registered in the widgets_init hook:

// register FooWidget widget
add_action('widgets_init', create_function('', 'return register_widget("dual_category");'));

?>