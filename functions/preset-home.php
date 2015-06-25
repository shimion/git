<?php
//SLIDER
the_widget("feature_posts_widget", array(
	"post_type" => "post",
	"postfilter" => "category",
	"category" => get_option("ocmx_feature_post_cat"),
	"post_thumb" => get_option("ocmx_slider_thumbs"),
	"display_limit" => get_option("ocmx_feature_post_count"), 
	"post_order_by" => get_option("ocmx_slider_orderby"),
	"post_order" => "DESC",
	"slider_dots" => get_option("ocmx_slider_dots"),
	"auto_interval" => get_option("ocmx_slider_interval"),
));
?>

<div class="home-sidebar">
	<div id="widget-block" class="clearfix">
		<ul class="widget-list">

			<?php 
			//SEARCH
			the_widget("searchbox_widget");

			//SOCIAL
			the_widget("ocmx_social_widget", array(
				"twitter" => get_option("ocmx_twitter"),
				"facebook" => get_option("ocmx_facebook"),
				"youtube" => get_option("ocmx_youtube"),
				"vimeo" => get_option("ocmx_vimeo"),
				"flickr" => get_option("ocmx_flickr"),
				"reverbnation" => get_option("ocmx_reverbnation"),
				"google" => get_option("ocmx_google"),
				"lastfm" => get_option("ocmx_lastfm"), 
				"linkedin" => get_option("ocmx_linkedin"), 
				"pinterest" => get_option("ocmx_pinterest"), 
				"soundcloud" => get_option("ocmx_soundcloud"), 
				"instagram" => get_option("ocmx_instagram"), 
				"rss" => get_option("ocmx_rss"), 
			));

			//CONTENT WIDGET
			if (get_option("ocmx_content_cat") != '0') :
				// SERVICES THREE COL
				the_widget("obox_content_widget", array(

					"posttype" => "post",
					"postfilter" => "category",
					"category" => get_option("ocmx_content_cat"),
					"layout_columns" => get_option("ocmx_content_columns"),
					"post_count" => get_option("ocmx_content_post_count"), 
					"post_order_by" => get_option("ocmx_content_orderby"),
					"post_order" => "DESC",
					"post_thumb" => get_option("ocmx_content_thumbs"),
					"show_date" => get_option("ocmx_content_meta"),
					"show_excerpts" => get_option("ocmx_content_excerpt"),  
					"excerpt_length" => get_option("ocmx_excerpt_length"),
					"read_more" => get_option("ocmx_content_continue"),
				));
			endif; 
			?>

		</ul>
	</div>
</div>	