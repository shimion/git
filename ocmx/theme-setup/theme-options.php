<?php
global $obox_meta, $theme_options;

/* Setup Post Image Sizes */
add_image_size("post", 590, 350, true);

$theme_options = array();

$theme_options["general_site_options"] =
		array(
				array("label" => "Custom Logo", "description" => "Full URL or folder path to your custom logo.", "name" => "ocmx_custom_logo", "default" => "", "id" => "upload_button", "input_type" => "file", "args" => array("width" => 90, "height" => 75)),
				array("label" => "Favicon", "description" => "Select a favicon for your site", "name" => "ocmx_custom_favicon", "default" => "", "id" => "upload_button_favicon", "input_type" => "file", "sub_title" => "favicon", "args" => array("width" => 16, "height" => 16)),
				array(
					"main_section" => "Facebook Sharing Options",
					"main_description" => "Set a default image URL to appear on Facebook shares if no featured image is found. Recommended size 200x200.",
					"sub_elements" =>
						array(
							array("label" => "Disable OpenGraph?", "description" => "Select No if you want to disable the theme's OpenGraph support(do this only if using a conflicting plugin)", "name" => "ocmx_open_graph", "default" => "no", "id" => "ocmx_open_graph", "input_type" => 'select', 'options' => array('Yes' => 'yes', 'No' => 'no')
							),

							array("label" => "Image URL", "description" => "", "name" => "ocmx_site_thumbnail", "sub_title" => "Open Graph image", "default" => "", "id" => "upload_button_ocmx_site_thumbnail", "input_type" => "file", "args" => array("width" => 80, "height" => 80)
							)
						)
				),
				array("label" => "Color Options", "description" => "Select your desired colour option.", "name" => "ocmx_theme_style", "default" => "light", "id" => "", "input_type" => "select", "options" => array("Light (Default)" => "light", "Dark" => "dark", "Minimal" => "minimal")),
				array(
					"main_section" => "Custom Styling",
					"main_description" => "Set your own custom CSS for any element you wish to restyle.",
					"sub_elements" =>
						array(
							array("label" => "Custom CSS", "description" => "Enter changed classes from the theme stylesheet, or custom CSS here.", "name" => "ocmx_custom_css", "default" => "", "id" => "ocmx_custom_css", "input_type" => "memo"),
							 )
					),
				array(
				"main_section" => "Full Posts or Excerpts?",
				"main_description" => "Select whether to show full posts or excerpts in your archives/ blog list.",
				"sub_elements" => 
				array(
						array("label" => "Content Length", "description" => "Selecting excerpts will show the Read More link.","name" => "ocmx_content_length", "default" => "yes", "id" => "ocmx_content_length", "input_type" => 'select', 'options' => array('Show Excerpts' => 'yes', 'Show Full Post Content' => 'no'))
		                 )
				     ),
				array(
				"main_section" => "Post Meta",
				"main_description" => "These settings control which post meta is displayed in the post sidebar.",
				"sub_elements" =>
					array(
						array("label" => "Author Link", "description" => "Uncheck to hide the author name/link", "name" => "ocmx_meta_author", "default" => "on", "id" => "ocmx_meta_author", "input_type" => "checkbox"),
						array("label" => "Category", "description" => "Uncheck to hide the category", "name" => "ocmx_meta_category", "default" => "on", "id" => "ocmx_meta_category", "input_type" => "checkbox"),
						array("label" => "Show Sidebar Post Meta", "description" => "Hide all post meta from appearing in the sidebar on single posts?", "name" => "ocmx_post_meta", "default" => "on", "id" => "ocmx_post_meta", "input_type" => "select", "options" => array("Show Meta" => "on", "Hide Meta" => "off")),
						array("label" => "Author Bio", "description" => "Check to show the author bio", "name" => "ocmx_meta_author_bio", "default" => "off", "id" => "ocmx_meta_author_bio", "input_type" => "checkbox"),
						array("label" => "Date", "description" => "Uncheck to hide the date on posts", "name" => "ocmx_meta_date", "default" => "on", "id" => "ocmx_meta_date", "input_type" => "checkbox"),
						array("label" => "Social Sharing", "description" => "Uncheck to hide the sharing buttons", "name" => "ocmx_meta_social", "default" => "on", "id" => "ocmx_meta_social", "input_type" => "checkbox"),
						array("label" => "Short URL", "description" => "Uncheck to hide the short url", "name" => "ocmx_meta_shorturl", "default" => "on", "id" => "ocmx_meta_shorturl", "input_type" => "checkbox"),
						array("label" => "Tag List", "description" => "Uncheck to hide tags on posts", "name" => "ocmx_meta_tags", "default" => "on", "id" => "ocmx_meta_tags", "input_type" => "checkbox"),
						array("label" => "Next & Previous Posts", "description" => "Uncheck to hide the Next and Previous post links", "name" => "ocmx_meta_post_links", "default" => "on", "id" => "ocmx_meta_post_links", "input_type" => "checkbox"),
						array("label" => "Related Posts", "description" => "", "name" => "ocmx_meta_related_posts", "default" => "off", "id" => "ocmx_meta_related_posts", "input_type" => "checkbox"),
					)
				),
				array(
				"main_section" => "Page Meta",
				"main_description" => "These settings control which post meta is displayed on Pages.",
				"sub_elements" =>
					array(
						array("label" => "Show Social Sharing on Pages?", "description" => "Select whether to show or hide social sharing on your pages.", "name" => "ocmx_page_meta", "default" => "on", "id" => "ocmx_page_meta", "input_type" => "select", "options" => array("Show Social Sharing" => "on", "Hide Social Sharing" => "off")),
					)
				),
				array(
					"main_section" => "Press Trends Analytics",
					"main_description" => "Select Yes Opt out. No personal data is collected.",
						"sub_elements" =>
						array(
							array("label" => "Disable Press Trends?", "description" => "PressTrends helps Obox build better themes and provide awesome support by retrieving aggregated stats. PressTrends also provides a <a href='http://wordpress.org/extend/plugins/presstrends/' title='PressTrends Plugin for WordPress' target='_blank'>plugin for you</a> that delivers stats on how your site is performing against similar sites like yours. <a href='http://www.presstrends.me' title='PressTrends' target='_blank'>Learn more...</a>","name" => "ocmx_disable_press_trends", "default" => "no", "id" => "ocmx_disable_press_trends", "input_type" => 'select', 'options' => array('Yes' => 'yes', 'No' => 'no'))
									)
							 )
		);

$theme_options["footer_options"] = array(
	array("label" => "Custom Footer Text", "description" => "", "name" => "ocmx_custom_footer", "default" => "Copyright ".date("Y").". Gigawatt was created in WordPress by Obox Themes.", "id" => "ocmx_custom_footer", "input_type" => "memo"),

	array("label" => "Hide Obox Logo", "description" => "Hide the Obox Logo from the footer.", "name" => "ocmx_logo_hide", "default" => "false", "id" => "ocmx_logo_hide", "input_type" => "checkbox"),
	
	array("label" => "Site Analytics", "description" => "Enter in the Google Analytics Script here.","name" => "ocmx_googleAnalytics", "default" => "", "id" => "","input_type" => "memo")
);

$theme_options["layout_options"] = array(
	array(
		"label" => "Home Page Layout",
		"description" => "Set your home page to either display as a blog, mimic our theme demo or take full control by using widgets.",
		"name" => "ocmx_home_page_layout", "default" => "blog",
		"id" => "ocmx_home_page_layout",
		"input_type" => "hidden",
		"default" => "blog",
		"options" =>
			array(
					"blog" => array("label" => "Blog", "description" => "Set your home page to display like a normal blog.", "load_options" => "widget_home_options"),
					"preset" => array("label" => "Preset", "description" => "Mimic the exact layout of our theme demo.", "load_options" => "preset_home_options"),
					"widget" => array("label" => "Widget Driven", "description" => "Take control by setting up your home page with widgets.")
				)
	)
);

$theme_options["ecommerce_options"] = array(
	array(
		"main_section" => "Header Cart",
		"main_description" => "These settings control the header cart.",
		"sub_elements" =>
			array(
				array("label" => "Header Cart", "description" => "Choose whether to display the header cart","name" => "ocmx_header_cart", "default" => "true", "id" => "ocmx_header_cart", "input_type" => "select", "options" => array("Enabled" => "yes", "Disabled" => "no")
				)
			)
	),
	array(
		"main_section" => "eCommerce Images",
		"main_description" => "These settings control how attachments appear on single products if Gigawatt eCommerce is used.",
		"sub_elements" =>
			array(
				array("label" => "Product Gallery or Slider?", "description" => "Choose whether to display additional product images in a full-width slider, or if you want to enable support for the WooCommerce Product Gallery thumbnails","name" => "ocmx_product_gallery", "default" => "false", "id" => "ocmx_product_gallery", "input_type" => "select", "options" => array("Gigawatt Image Slider" => "slider", "WooCommerce Product Gallery" => "gallery", "Image Overlay" => "overlay")
				)
			)
	)

);

$theme_options["seo_options"] = array(
							array("label" => "Use OCMX SEO", "description" => "Select \"No\" if you are using an SEO plugin.", "name" => "ocmx_seo", "default" => "yes", "input_type" => "select", "options" => array("Yes" => "yes", "No" => "no")),
							array("label" => "Separator", "description" => "Define a new seperator character for your page titles.", "name" => "ocmx_seperator", "default" => "|", "input_type" => "text"),
							array("label" => "Site Wide Title", "description" => "Set your site's meta title.", "name" => "ocmx_meta_title", "default" =>  get_bloginfo("title"), "input_type" => "text"),
							array("label" => "Site Keywords", "description" => "", "name" => "ocmx_meta_keywords", "default" => "", "input_type" => "text"),
							array("label" => "Site Description", "description" => "Use a custom meta description.", "name" => "ocmx_meta_description", "default" => get_bloginfo("description"), "input_type" => "memo")

						);
$theme_options["small_ad_options"] = array(
						array(
								"label" => "Number of Small Ads",
								"description" => "When using the select box, you must click \"Save Changes\" before the blocks are added or removed.",
								"name" => "ocmx_small_ads",
								"id" =>  "ocmx_small_ads",
								"prefix" => "ocmx_small_ad",
								"default" => "0",
								"input_type" => "select",
								"options" => array("None" => "0", "1" => "1", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6", "7" => "7", "8" => "8", "9" => "9", "10" => "10"),
								"args" => array("width" => 125, "height" => "125")
							)
					  );

$theme_options["medium_ad_options"] = array(
						array(
								"label" => "Number of Medium Ads",
								"description" => "",
								"name" => "ocmx_medium_ads",
								"id" =>  "ocmx_medium_ads",
								"prefix" => "ocmx_medium_ad",
								"default" => "0",
								"input_type" => "select",
								"options" => array("None" => "0", "1" => "1", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6", "7" => "7", "8" => "8", "9" => "9", "10" => "10"),
								"args" => array("width" => 300, "height" => "250")
							)
						);

$theme_options["custom_advert_options"] = array(
						array(
							"main_section" => "Header Ad",
							"main_description" => "These settings allow you to manage your custom adverts which display in the header of your site. (Recommended size for the header ad is 468px by 60px)",
							"sub_elements" =>
								array(
									array("label" => "Advert Title", "description" => "", "name" => "ocmx_header_ad_title", "default" => "", "id" =>  "ocmx_header_ad_title", "input_type" => "text"),
									array("label" => "Advert Link", "description" => "", "name" => "ocmx_header_ad_link", "default" => "", "id" =>  "ocmx_header_ad_link", "input_type" => "text"),
									array("label" => "Image URL", "description" => "", "name" => "ocmx_header_ad_image", "default" => "", "id" =>  "ocmx_header_ad_image", "input_type" => "text"),
									array("label" => "Advert Script", "description" => "", "name" => "ocmx_header_ad_buysell_id", "default" => "", "id" => "ocmx_header_buysell_id", "input_type" => "memo"),
								)
						)
					);

$theme_options["preset_home_options"] =
	array(
		array(
				"main_section" => "Feature Slider",
				"main_description" => "Select which pages will be used for the Feature Slider.",
				"sub_elements" =>
					array(
						array("label" => "Category", "description" => "", "name" => "ocmx_feature_post_cat", "default" => "0", "id" => "ocmx_feature_post_cat", "input_type" => "select", "options" => "loop_categories"),

						array("label" => "Post Count", "description" => "", "name" => "ocmx_feature_post_count", "default" => "0", "id" => "ocmx_feature_post_count", "input_type" => "select", "options" => array("1" => "1", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6", "7" => "7", "8" => "8", "9" => "9", "10" => "10")),

						array("label" => "Order By", "description" => "", "name" => "ocmx_slider_orderby", "default" => "0", "id" => "", "input_type" => "select", "options" => array("Date" => "date", "Post Title" => "title", "Random" => "rand", "Comment Count" => "count", "Manual Order" => "menu_order")),

						array("label" => "Thumbnails ", "description" => "", "name" => "ocmx_slider_thumbs", "default" => "1", "zero_wording" => "Post Feature Image", "id" => "", "input_type" => "select", "options" => array("Post Feature Image" => "1", "Videos" => "0")),

						array("label" => "Slider Interval", "description" => "Automatically slide through posts. Set to 0 for no auto sliding.", "name" => "ocmx_slider_interval", "default" => "", "id" => "", "input_type" => "text"),

						array("label" => "Slider Dot Position", "description" => "Where would you like the slider dots to appear?", "name" => "ocmx_slider_dots", "default" => "1", "id" => "ocmx_slider_dots", "input_type" => "select", "options" => array("Vertical" => "1", "Horizontal" => "2"))

					)
			),
		array(
				"main_section" => "Social Links",
				"main_description" => "Full urls linking to your different social profiles.",
				"sub_elements" =>
					array(
						array("label" => "Twitter", "description" => "", "name" => "ocmx_twitter", "default" => "", "id" => "", "input_type" => "text"),
						array("label" => "Facebook", "description" => "", "name" => "ocmx_facebook", "default" => "", "id" => "", "input_type" => "text"),
						array("label" => "flickr", "description" => "", "name" => "ocmx_flickr", "default" => "", "id" => "", "input_type" => "text"),
						array("label" => "YouTube", "description" => "", "name" => "ocmx_youtube", "default" => "", "id" => "", "input_type" => "text"),
						array("label" => "Vimeo", "description" => "", "name" => "ocmx_vimeo", "default" => "", "id" => "", "input_type" => "text"),
						array("label" => "Google Plus", "description" => "", "name" => "ocmx_google", "default" => "", "id" => "", "input_type" => "text"),
						array("label" => "Reverbnation", "description" => "", "name" => "ocmx_reverbnation", "default" => "", "id" => "", "input_type" => "text"),
						array("label" => "Soundcloud", "description" => "", "name" => "ocmx_soundcloud", "default" => "", "id" => "", "input_type" => "text"),
						array("label" => "last.fm", "description" => "", "name" => "ocmx_lastfm", "default" => "", "id" => "", "input_type" => "text"),
						array("label" => "Pinterest", "description" => "", "name" => "ocmx_pinterest", "default" => "", "id" => "", "input_type" => "text"),
						array("label" => "LinkedIn", "description" => "", "name" => "ocmx_linkedin", "default" => "", "id" => "", "input_type" => "text"),
						array("label" => "Instagram", "description" => "", "name" => "ocmx_instagram", "default" => "", "id" => "", "input_type" => "text"),
						array("label" => "RSS", "description" => "", "name" => "ocmx_rss", "default" => "", "id" => "", "input_type" => "text")
					)

			),
		array(
				"main_section" => "Featured Content",
				"main_description" => "Select a category for the Four Column widget on the home page..",
				"sub_elements" =>
					array(
						array("label" => "Category", "description" => "", "name" => "ocmx_content_cat", "default" => "0", "zero_wording" => "Exclude this Widget", "id" => "ocmx_content_cat", "input_type" => "select", "options" => "loop_categories"),

						array("label" => "Column Layout", "description" => "", "name" => "ocmx_content_columns", "default" => "4", "id" => "", "input_type" => "select", "options" => array("2" => "two", "3" => "three", "4" => "four")),

						array("label" => "Post Count", "description" => "", "name" => "ocmx_content_post_count", "default" => "4", "id" => "", "input_type" => "select", "options" => array("2" => "2", "3" => "3", "4" => "4", "6" => "6", "8" => "8", "9" => "9", "10" => "10", "12" => "12")),

						array("label" => "Order By", "description" => "", "name" => "ocmx_content_orderby", "default" => "0", "id" => "", "input_type" => "select", "options" => array("Date" => "date", "Post Title" => "title", "Random" => "rand", "Comment Count" => "count", "Manual Order" => "menu_order")),

						array("label" => "Thumbnails ", "description" => "", "name" => "ocmx_content_thumbs", "default" => "1", "zero_wording" => "Post Feature Image", "id" => "", "input_type" => "select", "options" => array("None" => "none", "Post Feature Image" => "1", "Videos" => "0")),

						array("label" => "Show Post Dates", "description" => "", "name" => "ocmx_content_meta", "default" => "0", "zero_wording" => "Yes", "id" => "", "input_type" => "select", "options" => array("Yes" => "on", "No" => "off")),

						array("label" => "Show Excerpt", "description" => "", "name" => "ocmx_content_excerpt", "default" => "0", "zero_wording" => "Yes", "id" => "", "input_type" => "select", "options" => array("Yes" => "on", "No" => "off")),

						array("label" => "Content Length ", "description" => "(Character Amount)", "name" => "ocmx_excerpt_length", "default" => "", "id" => "", "input_type" => "text"),

						array("label" => "Show Read More", "description" => "", "name" => "ocmx_content_continue", "default" => "0", "zero_wording" => "Yes", "id" => "", "input_type" => "select", "options" => array("Yes" => "on", "No" => "off")),

					)
			)
	);

$theme_options["delete_gallery"] = array(
						array(
								"label" => "Confirm",
								"description" => "Are you sure you want to delete this gallery?",
								"name" => "ocmx_delete_gallery_confirm",
								"id" =>  "ocmx_delete_gallery_confirm",
								"default" => "0",
								"input_type" => "select",
								"options" => array("Yes" => "yes", "No" => "no")
							)
						);
/***************************************************************************/
/* Setup Defaults for this theme for optiosn which aren't set in this page */

update_option("ocmx_general_font_style_default", "'Helvetica Neue', Helvetica, Arial, sans-serif");
update_option("ocmx_navigation_font_style_default", "'Helvetica Neue', Helvetica, Arial, sans-serif");
update_option("ocmx_sub_navigation_font_style_default", "'Helvetica Neue', Helvetica, Arial, sans-serif");
update_option("ocmx_post_font_titles_style_default", "'Helvetica Neue', Helvetica, Arial, sans-serif");
update_option("ocmx_post_font_meta_style_default", "'Droid Serif', Georgia, 'Times New Roman', Times, serif");
update_option("ocmx_post_font_copy_font_style_default", "'Helvetica Neue', Helvetica, Arial, sans-serif");
update_option("ocmx_widget_font_titles_font_style_default", "'Helvetica Neue', Helvetica, Arial, sans-serif");
update_option("ocmx_widget_footer_titles_font_size_default", "'Helvetica Neue', Helvetica, Arial, sans-serif");

update_option("ocmx_general_font_size_default", "13");
update_option("ocmx_navigation_font_size_default", "12");
update_option("ocmx_sub_navigation_font_size_default", "12");
update_option("ocmx_post_titles_font_size_default", "25");
update_option("ocmx_post_meta_font_size_default", "11");
update_option("ocmx_post_copy_font_size_default", "13");
update_option("ocmx_widget_titles_font_size_default", "13");
update_option("ocmx_widget_footer_titles_font_size_default", "13");

update_option("allow_gallery_effect", "1");

add_action("switch_theme", "remove_ocmx_gallery_effects");
function remove_ocmx_gallery_effects(){delete_option("allow_gallery_effect");};
?>