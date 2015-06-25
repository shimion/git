<?php
class ocmx_social_widget extends WP_Widget {
	/** constructor */
	function ocmx_social_widget() {
		parent::WP_Widget(false, $name = '(Obox) Social Links', $widget_options = '"Home Page Widget - Link people up to your social Profiles.');
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance) {
		extract( $args );

		$defaults = array( 'twitter' => '', 'facebook' => '', 'youtube' => '', 'vimeo' => '', 'flickr' => '', 'reverbnation' => '', 'google' => '', 'lastfm' => '', 'linkedin' => '', 'pinterest' => '', 'soundcloud' => '', 'instagram' => '', 'rss' => '');
		$instance = wp_parse_args( (array) $instance, $defaults );

		$twitter = $instance["twitter"];
		$facebook = $instance["facebook"];
		$youtube = $instance["youtube"];
		$vimeo = $instance["vimeo"];
		$flickr = $instance["flickr"];
		$reverbnation = $instance["reverbnation"];
		$google = $instance["google"];
		$lastfm = $instance["lastfm"];
		$linkedin = $instance["linkedin"];
		$pinterest = $instance["pinterest"];
		$soundcloud = $instance["soundcloud"];
		$instagram = $instance["instagram"];
		$rss = $instance["rss"];
?>
			<?php echo $before_widget; ?>
				<?php echo $before_title;
					_e("Connect", "ocmx");
				echo $after_title; ?>
				<ul class="social-bookmarks">
					<?php if ($facebook !== "") : ?><li><a target="_blank" href="<?php echo $facebook; ?>" class="facebook"></a></li><?php endif; ?>
					<?php if ($twitter !== "") : ?><li><a target="_blank" href="<?php echo $twitter; ?>" class="twitter"></a></li><?php endif; ?>
					<?php if ($flickr !== "") : ?><li><a target="_blank" href="<?php echo $flickr; ?>" class="flickr"></a></li><?php endif; ?>
					<?php if ($youtube !== "") : ?><li><a target="_blank" href="<?php echo $youtube; ?>" class="youtube"></a></li><?php endif; ?>
					<?php if ($vimeo !== "") : ?><li><a target="_blank" href="<?php echo $vimeo; ?>" class="vimeo"></a></li><?php endif; ?>
					<?php if ($reverbnation !== "") : ?><li><a target="_blank" href="<?php echo $reverbnation; ?>" class="reverbnation"></a></li><?php endif; ?>
					<?php if ($google !== "") : ?><li><a target="_blank" href="<?php echo $google; ?>" class="google"></a></li><?php endif; ?>
					<?php if ($lastfm !== "") : ?><li><a target="_blank" href="<?php echo $lastfm; ?>" class="lastfm"></a></li><?php endif; ?>
					<?php if ($linkedin !== "") : ?><li><a target="_blank" href="<?php echo $linkedin; ?>" class="linkedin"></a></li><?php endif; ?>
					<?php if ($pinterest !== "") : ?><li><a target="_blank" href="<?php echo $pinterest; ?>" class="pinterest"></a></li><?php endif; ?>
					<?php if ($soundcloud !== "") : ?><li><a target="_blank" href="<?php echo $soundcloud; ?>" class="soundcloud"></a></li><?php endif; ?>
					<?php if ($instagram !== "") : ?><li><a target="_blank" href="<?php echo $instagram; ?>" class="instagram"></a></li><?php endif; ?>
					<?php if ($rss !== "") : ?><li><a target="_blank" href="<?php echo $rss; ?>" class="rss"></a></li><?php endif; ?>

				</ul>
			<?php echo $after_widget; ?>
		<?php
	}

	/** @see WP_Widget::update */
	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	/** @see WP_Widget::form */
	function form($instance) { ?>
			<h3 class="social-instruction">
				<?php _e("Enter the full URL to your profiles. Example: http://www.facebook.com/oboxthemes","ocmx"); ?>
			</h3>
			<p><label for="<?php echo $this->get_field_id('facebook'); ?>">Facebook<input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php if(isset($instance["facebook"])) : echo $instance["facebook"]; endif; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('twitter'); ?>">Twitter<input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php if(isset($instance["twitter"])) : echo $instance["twitter"]; endif; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('flickr'); ?>">Flickr<input class="widefat" id="<?php echo $this->get_field_id('flickr'); ?>" name="<?php echo $this->get_field_name('flickr'); ?>" type="text" value="<?php if(isset($instance["flickr"])) : echo $instance["flickr"]; endif; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('youtube'); ?>">Youtube<input class="widefat" id="<?php echo $this->get_field_id('youtube'); ?>" name="<?php echo $this->get_field_name('youtube'); ?>" type="text" value="<?php if(isset($instance["youtube"])) : echo $instance["youtube"]; endif; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('vimeo'); ?>">Vimeo<input class="widefat" id="<?php echo $this->get_field_id('vimeo'); ?>" name="<?php echo $this->get_field_name('vimeo'); ?>" type="text" value="<?php if(isset($instance["vimeo"])) : echo $instance["vimeo"]; endif; ?>" /></label></p>
			   <p><label for="<?php echo $this->get_field_id('google'); ?>">Google Plus<input class="widefat" id="<?php echo $this->get_field_id('google'); ?>" name="<?php echo $this->get_field_name('google'); ?>" type="text" value="<?php if(isset($instance["google"])) : echo $instance["google"]; endif; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('reverbnation'); ?>">Reverbnation<input class="widefat" id="<?php echo $this->get_field_id('reverbnation'); ?>" name="<?php echo $this->get_field_name('reverbnation'); ?>" type="text" value="<?php if(isset($instance["reverbnation"])) : echo $instance["reverbnation"]; endif; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('soundcloud'); ?>">Soundcloud<input class="widefat" id="<?php echo $this->get_field_id('soundcloud'); ?>" name="<?php echo $this->get_field_name('soundcloud'); ?>" type="text" value="<?php if(isset($instance["soundcloud"])) : echo $instance["soundcloud"]; endif; ?>" /></label></p>
					<p><label for="<?php echo $this->get_field_id('lastfm'); ?>">last.fm<input class="widefat" id="<?php echo $this->get_field_id('lastfm'); ?>" name="<?php echo $this->get_field_name('lastfm'); ?>" type="text" value="<?php if(isset($instance["lastfm"])) : echo $instance["lastfm"]; endif; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('pinterest'); ?>">Pinterest<input class="widefat" id="<?php echo $this->get_field_id('pinterest'); ?>" name="<?php echo $this->get_field_name('pinterest'); ?>" type="text" value="<?php if(isset($instance["pinterest"])) : echo $instance["pinterest"]; endif; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('linkedin'); ?>">LinkedIn<input class="widefat" id="<?php echo $this->get_field_id('linkedin'); ?>" name="<?php echo $this->get_field_name('linkedin'); ?>" type="text" value="<?php if(isset($instance["linkedin"])) : echo $instance["linkedin"]; endif; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('instagram'); ?>">Instagram<input class="widefat" id="<?php echo $this->get_field_id('instagram'); ?>" name="<?php echo $this->get_field_name('instagram'); ?>" type="text" value="<?php if(isset($instance["instagram"])) : echo $instance["instagram"]; endif; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('rss'); ?>">RSS<input class="widefat" id="<?php echo $this->get_field_id('rss'); ?>" name="<?php echo $this->get_field_name('rss'); ?>" type="text" value="<?php if(isset($instance["rss"])) : echo $instance["rss"]; endif; ?>" /></label></p>


		<?php
	}

} // class FooWidget

//This sample widget can then be registered in the widgets_init hook:

// register FooWidget widget
add_action('widgets_init', create_function('', 'return register_widget("ocmx_social_widget");'));

?>