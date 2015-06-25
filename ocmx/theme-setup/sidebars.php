<?php 
// Create Dynamic Sidebars
if (function_exists('register_sidebar')) :
	register_sidebar(array("name" => "Sidebar", "id" => "sidebar", "description" => "Place the PURPLE (Obox) widgets here.", "before_title" => '<h4 class="widgettitle">', "after_title" => '</h4>', 'before_widget' => '<li id="%1$s" class="widget %2$s"><div class="content">', 'after_widget' => '</div></li>'));
	register_sidebar(array("name" => "Slider", "id" => "slider", "description" => "Place the BLUE (Obox) widget here."));
	register_sidebar(array("name" => "Home Page", "id" => "homepage", "description" => "Place the ORANGE (Obox) widgets here.", "before_title" => '<h4 class="widgettitle">', "after_title" => '</h4><div class="content">', 'before_widget' => '<li id="%1$s" class="widget %2$s">', 'after_widget' => '</div></li>'));
	register_sidebar(array("name" => "Shop Sidebar", "id" => "shop-sidebar", "description" => "Place the (WooCommerce) widgets here.", "before_title" => '<h4 class="widgettitle">', "after_title" => '</h4>', 'before_widget' => '<li id="%1$s" class="widget %2$s"><div class="content">', 'after_widget' => '</div></li>'));
	register_sidebar(array("name" => "Footer", "id" => "footers", "description" => "Please note that this widget area can only contain two widgets.", "before_title" => "<h4>", "after_title" => "</h4>", "before_widget" => "<li class=\"column\">", "after_widget" => "</li>"));
endif;

?>