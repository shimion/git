<?php header('Content-type: text/css'); ?>
<?php if(get_option("ocmx_ignore_colours") != "yes"): ?>

	<?php if(get_option("ocmx_logo_color")) : ?>
		.logo h1 a{color: <?php echo get_option('ocmx_logo_color');?>;}
	<?php endif; ?>

	<?php if(get_option("ocmx_navigation_links")) : ?>
		ul#nav li a{color: <?php echo get_option('ocmx_navigation_links');?>;}
	<?php endif; ?>

	<?php if(get_option("ocmx_navigation_hover")) : ?>
		ul#nav li a:hover, .current-menu-item a{border-color: <?php echo get_option('ocmx_navigation_hover');?>;}
	<?php endif; ?>

	<?php if(get_option("ocmx_body_text")) : ?>
		body, #footer, #footer ul li.column ul li, input, textarea, input#s{color: <?php echo get_option('ocmx_body_text');?>;}
	<?php endif; ?>

	<?php if(get_option("ocmx_body_links")) : ?>
		.action-link, .copy a, .widget .content a, ul.widget-list li.widget a, .date a, .portfolio #category-column ul li a, .next-prev-post-nav a, .logged-in-as a{color: <?php echo get_option('ocmx_body_links');?>;}
	<?php endif; ?>

	<?php if(get_option("ocmx_body_links_hover")) : ?>
		.action-link:hover, .obox-credit a:hover, .copy a:hover, .widget .content a:hover, ul.widget-list li.widget a:hover, .date a:hover, #footer a:hover, .portfolio #category-column ul li a:hover, .next-prev-post-nav a:hover, .logged-in-as a:hover{color: <?php echo get_option('ocmx_body_links_hover');?>;}
	<?php endif; ?>

	<?php if(get_option("ocmx_post_titles")) : ?>
		.post-title, .post-title a, .page-title, .four-column .post-title a, #portfolio-content h4 a{color: <?php echo get_option('ocmx_post_titles');?>;}
	<?php endif; ?>

	<?php if(get_option("ocmx_post_titles_hover")) : ?>
		.post-title:hover, .post-title a:hover, .page-title:hover, .four-column .post-title a:hover, #portfolio-content h4 a:hover{color: <?php echo get_option('ocmx_post_titles_hover');?>;}
	<?php endif; ?>

	<?php if(get_option("ocmx_section_title")) : ?>
		h3.widgettitle, h4.widgettitle, .widgettitle, .section-title, .section-title a, #footer h4{color: <?php echo get_option('ocmx_section_title');?>;}
	<?php endif; ?>

	<?php if(get_option("ocmx_footer_nav_links")) : ?>
		ul#footer-nav li a, .obox-credit a, #footer a{color: <?php echo get_option('ocmx_footer_nav_links');?>;}
	<?php endif; ?>

	<?php if(get_option("ocmx_footer_links_hover")) : ?>
		#footer-nav a:hover{color: <?php echo get_option('ocmx_footer_links_hover');?>;}
	<?php endif; ?>

	<?php if(get_option("ocmx_copyright_text")) : ?>
		.footer-text p{color: <?php echo get_option('ocmx_copyright_text');?>;}
	<?php endif; ?>

	<?php if(get_option("ocmx_border_color")) : ?>
		#footer, .footer-text, ul.widget-list li.widget, .pagination .next a, .pagination .previous a, .post-meta li, #right-column .widget-list .widget, .purchase-options-container, table.shop_table td, table.cart td, table.shop_table th, table.cart th, .cart_totals table td, .cart_totals table th, table.shop_table, table.cart, .cart_totals table{border-color: <?php echo get_option('ocmx_border_color');?>;}
	<?php endif; ?>

<?php endif; ?>
<?php if(get_option("ocmx_custom_css") != ""): ?>
	<?php echo get_option("ocmx_custom_css"); ?>
<?php endif; ?>

<?php
// If we're not using the default theme (dark) then let's set the default bg to the one from this theme.
if (get_option("ocmx_theme_style") == "dark") :
	$background_image = get_template_directory_uri() . '/color-styles/dark/layout/texture.jpg';
elseif (get_option("ocmx_theme_style") == "light") :
	$background_image = get_template_directory_uri() . '/color-styles/light/layout/texture.jpg';
else :
	$background_image = get_template_directory_uri() . '/images/layout/texture.jpg';
endif; ?>

body{background-image: url('<?php echo $background_image; ?>'); background-repeat: repeat; background-position: top left; background-attachment: fixed;}

<?php
// Load header background
if(get_background_color() != "") : ?>
	body{background-image: none;}
	#widget-block{background-image: none; background: #<?php echo background_color(); ?>;}
<?php endif;