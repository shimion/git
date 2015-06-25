<?php //OCMX Custom logo and Favicon

function ocmx_logo_register($wp_customize){
    
    $wp_customize->add_section('ocmx_general', array(
        'title'    => __('General Theme Settings', 'ocmx'),
        'priority' => 30,
    ));
	
	$wp_customize->add_setting('ocmx_ignore_colours', array(
        'default'        => 'no',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));

    $wp_customize->add_control('header_color_scheme', array(
        'label'      => __('Use Theme Default Color Scheme', 'ocmx'),
        'section'    => 'ocmx_general',
        'settings'   => 'ocmx_ignore_colours',
        'type'       => 'radio',
        'priority' => 0,
        'choices'    => array(
            'yes' => 'Yes',
            'no' => 'No'
        ),
    ));
 
    $wp_customize->add_setting('ocmx_custom_logo', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'ocmx_custom_logo', array(
        'label'    => __('Custom Logo', 'ocmx'),
        'section'  => 'ocmx_general',
        'settings' => 'ocmx_custom_logo',
    )));
    
    $wp_customize->add_setting('ocmx_custom_favicon', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'ocmx_custom_favicon', array(
        'label'    => __('Custom Favicon', 'ocmx'),
        'section'  => 'ocmx_general',
        'settings' => 'ocmx_custom_favicon',
    )));
    
}

add_action('customize_register', 'ocmx_logo_register');

// OCMX Color Options 

function ocmx_customize_register($wp_customize) {

	$wp_customize->add_section(
		'color_scheme', array(
		'title' => __( 'Theme Color Scheme', 'ocmx' ),
		'priority' => 35,
		)
	);
	
	//Custom Colors
	$wp_customize->add_setting( 'ocmx_logo_color', array(
		'default' => '#000000',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_logo_color', array(
		'label' => __( 'Header Text Color', 'ocmx' ),
		'section' => 'color_scheme',
		'settings' => 'ocmx_logo_color',
		'priority' => 1,
	)));
	
	$wp_customize->add_setting( 'ocmx_navigation_links', array(
		'default' => '#A6A6A6',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_navigation_links', array(
		'label' => __( 'Navigation Links', 'ocmx' ),
		'section' => 'color_scheme',
		'settings' => 'ocmx_navigation_links',
		'priority' => 5,
	)));
	
	$wp_customize->add_setting( 'ocmx_navigation_hover', array(
		'default' => '#b79a82',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_navigation_hover', array(
		'label' => __( 'Navigation Hover', 'ocmx' ),
		'section' => 'color_scheme',
		'settings' => 'ocmx_navigation_hover',
		'priority' => 10,
	)));
    $wp_customize->add_setting( 'ocmx_post_titles', array(
		'default' => '#4A4A4A',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_post_titles', array(
		'label' => __( 'Post Titles Color', 'ocmx' ),
		'section' => 'color_scheme',
		'settings' => 'ocmx_post_titles',
		'priority' => 20,
	)));
	
	$wp_customize->add_setting( 'ocmx_post_titles_hover', array(
		'default' => '#895931',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_post_titles_hover', array(
		'label' => __( 'Post Titles Hover Color', 'ocmx' ),
		'section' => 'color_scheme',
		'settings' => 'ocmx_post_titles_hover',
		'priority' => 25,
	)));
    
    $wp_customize->add_setting( 'ocmx_section_title', array(
		'default' => '#4A4A4A',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_section_title', array(
		'label' => __( 'Post Meta', 'ocmx' ),
		'section' => 'color_scheme',
		'settings' => 'ocmx_section_title',
		'priority' => 30,
	)));
	
	$wp_customize->add_setting( 'ocmx_body_text', array(
		'default' => '#7D7D7D',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_body_text', array(
		'label' => __( 'General Body Text Color', 'ocmx' ),
		'section' => 'color_scheme',
		'settings' => 'ocmx_body_text',
		'priority' => 35,
	)));
	
	$wp_customize->add_setting( 'ocmx_body_links', array(
		'default' => '#895931',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_body_links', array(
		'label' => __( 'General Link Color', 'ocmx' ),
		'section' => 'color_scheme',
		'settings' => 'ocmx_body_links',
		'priority' => 40,
	)));
	
	$wp_customize->add_setting( 'ocmx_body_links_hover', array(
		'default' => '#000',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_body_links_hover', array(
		'label' => __( 'General Link Color Hover', 'ocmx' ),
		'section' => 'color_scheme',
		'settings' => 'ocmx_body_links_hover',
		'priority' => 45,
	)));
	
	$wp_customize->add_setting( 'ocmx_border_color', array(
		'default' => '#C7C7C7',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_border_color', array(
		'label' => __( 'Border Colors', 'ocmx' ),
		'section' => 'color_scheme',
		'settings' => 'ocmx_border_color',
		'priority' => 47,
	)));
	
	$wp_customize->add_setting( 'ocmx_footer_nav_links', array(
		'default' => '#868686',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_footer_nav_links', array(
		'label' => __( 'Footer Navigation Links Color', 'ocmx' ),
		'section' => 'color_scheme',
		'settings' => 'ocmx_footer_nav_links',
		'priority' => 50,
	)));
	
	$wp_customize->add_setting( 'ocmx_footer_links_hover', array(
		'default' => '#000000',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_footer_links_hover', array(
		'label' => __( 'Footer Navigation Links Hover Color', 'ocmx' ),
		'section' => 'color_scheme',
		'settings' => 'ocmx_footer_links_hover',
		'priority' => 55,
	)));
	
	$wp_customize->add_setting( 'ocmx_copyright_text', array(
		'default' => '#C7C7C7',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_copyright_text', array(
		'label' => __( 'Footer Copyright Text Color', 'ocmx' ),
		'section' => 'color_scheme',
		'settings' => 'ocmx_copyright_text',
		'priority' => 60,
	)));
	

	
	wp_reset_query();

//ADD JQUERY

if ( $wp_customize->is_preview() && ! is_admin() )
	add_action( 'wp_footer', 'ocmx_customize_preview', 21);
	
	function ocmx_customize_preview() {
	?>
	<script type="text/javascript">

	( function( $ ){
		
		wp.customize('ocmx_logo_color',function( value ) {
			value.bind(function(to) {
				jQuery('.logo h1 a').css({'color': to});
			});
		});
		
		wp.customize('ocmx_navigation_links',function( value ) {
			value.bind(function(to) {
				jQuery('ul#nav li a, .tabs-nav li a').css({'color': to});
			});
		});

		wp.customize('ocmx_navigation_hover',function( value ) {
			value.bind(function(to) {
				jQuery('ul#nav li a:hover').css({'borderColor': to});
			});
		});
		
		wp.customize('ocmx_body_text',function( value ) {
			value.bind(function(to) {
				jQuery('body, #footer, #footer ul li.column ul li').css({'color': to});
			});
		});
		
		wp.customize('ocmx_body_links',function( value ) {
			value.bind(function(to) {
				jQuery('.action-link, .obox-credit a, .copy a, .widget .content a, ul.widget-list li.widget a, .date a, .portfolio #category-column ul li a').css({'color': to});
			});
		});
		
		wp.customize('ocmx_body_links_hover',function( value ) {
			value.bind(function(to) {
				jQuery('.action-link:hover, .obox-credit a:hover, .copy a:hover, .widget .content a:hover, ul.widget-list li.widget a:hover, .date a:hover, #footer a:hover, .portfolio #category-column ul li a:hover').css({'color': to});
			});
		});
		
		wp.customize('ocmx_section_title',function( value ) {
			value.bind(function(to) {
				jQuery('h3.widgettitle, .contact-details .details h4, #footer h4, h5, .about-me .post-title ').css({'color': to});
			});
		});
		
		wp.customize('ocmx_post_titles',function( value ) {
			value.bind(function(to) {
				jQuery('.post-title, .post-title a, .page-title, .four-column .post-title a, #portfolio-content h4 a').css({'color': to});
			});
		});
		
		wp.customize('ocmx_post_titles_hover',function( value ) {
			value.bind(function(to) {
				jQuery('.post-title:hover, .post-title a:hover, .page-title:hover, .four-column .post-title a:hover, #portfolio-content h4 a:hover').css({'color': to});
			});
		});
		
		wp.customize('ocmx_footer_nav_links',function( value ) {
			value.bind(function(to) {
				jQuery('ul#footer-nav li a').css({'color': to});
			});
		});
		
		wp.customize('ocmx_footer_links_hover',function( value ) {
			value.bind(function(to) {
				jQuery(' #footer a:hover, .obox-credit a:hover').css({'color': to});
			});
		});
		
		wp.customize('ocmx_footer_text',function( value ) {
			value.bind(function(to) {
				jQuery('#footer, #footer ul li.column ul li').css({'color': to});
			});
		});
		
		wp.customize('ocmx_copyright_text',function( value ) {
			value.bind(function(to) {
				jQuery('.footer-text p').css({'color': to});
			});
		});
		
		wp.customize('ocmx_border_color',function( value ) {
			value.bind(function(to) {
				jQuery('#footer, .footer-text, ul.widget-list li.widget, .pagination .next a, .pagination .previous a, .post-meta li, #right-column .widget-list .widget, .purchase-options-container, table.shop_table td, table.cart td, table.shop_table th, table.cart th, .cart_totals table td, .cart_totals table th, table.shop_table, table.cart, .cart_totals table').css({'border-color': to});
			});
		});
	} )( jQuery );
	</script>
<?php } 

//ADD POST MESSAGE

}
add_action( 'customize_register', 'ocmx_customize_register' );

function ocmx_add_query_vars($query_vars) {
	$query_vars[] = 'stylesheet';
	return $query_vars;
}
add_filter( 'query_vars', 'ocmx_add_query_vars' );
function ocmx_takeover_css() {
	    $style = get_query_var('stylesheet');
	    if($style == "custom") {
		    include_once(TEMPLATEPATH . '/style.php');
	        exit;
	    }
	}
add_action( 'template_redirect', 'ocmx_takeover_css');