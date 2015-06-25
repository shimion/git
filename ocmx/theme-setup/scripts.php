<?php
function ocmx_add_scripts()
	{
		global $themeid;
		
		//Add support for 2.9 and 3.0 functions and setup jQuery for theme
		wp_enqueue_script("jquery");
		if(!is_admin() && !(in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) ) ) ):
			// Include stylesheets
			wp_enqueue_style( $themeid.'-jplayer', get_template_directory_uri().'/ocmx/jplayer.css');
			wp_enqueue_style( $themeid.'-customizer', home_url().'/?stylesheet=custom');
			wp_enqueue_style( $themeid.'-custom', get_template_directory_uri().'/custom.css');
			
			wp_enqueue_script( "superfish", get_bloginfo("template_directory")."/scripts/superfish.js", array( "jquery" ) );
			wp_enqueue_script( "resize", get_bloginfo("template_directory")."/scripts/jquery.resize.end.js", array( "jquery" ) );
			wp_enqueue_script( $themeid."-jquery", get_bloginfo("template_directory")."/scripts/".$themeid."_jquery.js", array( "jquery" ) );
			wp_enqueue_script( "jplayer", get_bloginfo("template_directory")."/scripts/jquery.jplayer.min.js", array( "jquery" ) );
			wp_enqueue_script( "selfhosted", get_bloginfo("template_directory")."/scripts/selfhosted.js", array( "jquery" ) );
			wp_enqueue_script( "fitvid", get_bloginfo("template_directory")."/scripts/jquery.fitvids.js", array( "jquery" ) );

			if(is_single() && get_option('ocmx_product_gallery') =="overlay") : 
				wp_register_style( $themeid.'-overlay', get_bloginfo("template_directory")."/woo-gallery-overlay.css");
	        			wp_enqueue_style( $themeid.'-overlay');
			elseif(is_single() && get_option('ocmx_product_gallery') =="gallery") : 
				wp_register_style( $themeid.'-woogallery', get_bloginfo("template_directory")."/woo-gallery.css");
	        			wp_enqueue_style( $themeid.'-woogallery');
			endif;

			wp_register_style( $themeid.'-cabin', 'http://fonts.googleapis.com/css?family=Cabin:regular,regularitalic,500,600,bold&v1');
	        		wp_enqueue_style( $themeid.'-cabin');
			if ( is_singular() || is_page() ) { wp_enqueue_script( $obox_themeid."-sharing", "//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-539072aa132cc69d"); }
			
		if ( is_singular() ) wp_enqueue_script( "comment-reply" ); 
			//Localization
			wp_localize_script( $themeid."-jquery", "ThemeAjax", array( "ajaxurl" => admin_url( "admin-ajax.php" ) ) );
		else :
		/* Back-end */
			wp_enqueue_script( 'jquery-ui-draggable' );
			wp_enqueue_script( 'jquery-ui-droppable' );
			wp_enqueue_script( 'jquery-ui-sortable' );
			wp_enqueue_script( 'jquery-ui-tabs' );
			wp_enqueue_script( "ajaxupload", get_template_directory_uri()."/scripts/ajaxupload.js", array( "jquery" ) );
			wp_enqueue_script( "ocmx-jquery", get_template_directory_uri()."/scripts/ocmx_jquery.js", array( "jquery" ) );
			wp_enqueue_script( "ocmx-multifile", get_template_directory_uri()."/scripts/multifile.js", array( "jquery" ) );
			wp_localize_script( "ocmx-jquery", "ThemeAjax", array( "ajaxurl" => admin_url( "admin-ajax.php" ) ) );
		
			wp_enqueue_style( 'welcome-page', get_template_directory_uri() . '/ocmx/welcome-page.css');
		endif;
		
	}
add_action('wp_enqueue_scripts', 'ocmx_add_scripts');
add_action('admin_enqueue_scripts', 'ocmx_add_scripts');

function ocmx_add_ajax_calls(){
	//AJAX Functions
	add_action( 'wp_ajax_nopriv_ocmx_cart_display', 'ocmx_cart_display'  );
	add_action( 'wp_ajax_ocmx_cart_display', 'ocmx_cart_display' );
		
	add_action( 'wp_ajax_ocmx_save-options', 'update_ocmx_options');
	add_action( 'wp_ajax_ocmx_reset-options', 'reset_ocmx_options');
	add_action( 'wp_ajax_ocmx_ads-refresh', 'ocmx_ads_refresh' );
	add_action( 'wp_ajax_ocmx_ads-remove', 'ocmx_ads_remove' );
	add_action( 'wp_ajax_ocmx_layout-refresh', 'ocmx_layout_refresh' );
	add_action( 'wp_ajax_ocmx_ajax-upload', 'ocmx_ajax_upload' );
	add_action( 'wp_ajax_ocmx_remove-image', 'ocmx_ajax_remove_image' );
}
add_action('init', 'ocmx_add_ajax_calls');
?>