<?php global $woocommerce; ?>

<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?> xmlns:fb="http://ogp.me/ns/fb#">

<head prefix="og: http://ogp.me/ns# object: http://ogp.me/ns/object#">

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">

<!--Get Obox SEO -->

<?php if(get_option("ocmx_seo") == "yes") {

    echo ocmx_site_title();

    echo ocmx_meta_description();

    echo ocmx_meta_keywords();

} else { ?>

        <title>

                <?php

                        global $page, $paged, $post;

                        wp_title( '|', true, 'right' );

                        bloginfo( 'name' );

                        $site_description = get_bloginfo( 'description', 'display' );

                        if ( $site_description && ( is_home() || is_front_page() ) )

                                echo " | $site_description";



                        if ( $paged >= 2 || $page >= 2 )

                                echo ' | ' . sprintf( __( 'Page %s', 'ocmx' ), max( $paged, $page ) );

                ?>

        </title>

<?php } ?>

<!-- Setup OpenGraph support-->

<?php if(get_option("ocmx_open_graph") !="yes") {

    $default_thumb = get_option('ocmx_site_thumbnail');

    $fb_image = get_fbimage();

    if(is_home()) : ?>

        <meta property="og:title" content="<?php bloginfo('name'); ?>"/>

        <meta property="og:description" content="<?php bloginfo('description'); ?>"/>

        <meta property="og:url" content="<?php echo home_url(); ?>"/>

        <meta property="og:image" content="<?php if(isset($default_thumb) && $default_thumb !==""){echo $default_thumb; } else {echo $fb_image;}?>"/>

        <meta property="og:type" content="<?php echo "website";?>"/>

        <meta property="og:site_name" content="<?php bloginfo('name'); ?>"/>

        <?php else : ?>

        <meta property="og:title" content="<?php the_title(); ?>"/>

        <meta property="og:description" content="<?php echo strip_tags($post->post_excerpt); ?>"/>

        <meta property="og:url" content="<?php the_permalink(); ?>"/>

        <meta property="og:image" content="<?php if($fb_image !=""){echo $fb_image;} else {echo $default_thumb;} ?>"/>

        <meta property="og:type" content="<?php echo "article"; ?>"/>

        <meta property="og:site_name" content="<?php bloginfo('name'); ?>"/>

        <?php endif;

} ?>



<!-- Begin Styling -->

<?php if(get_option("ocmx_custom_favicon") != "") : ?>

<link href="<?php echo get_option("ocmx_custom_favicon"); ?>" rel="icon" type="image/png" />

<?php endif; ?>



<link href="<?php bloginfo('template_directory'); ?>/style.css" rel="stylesheet" type="text/css" />

<link href="<?php bloginfo('template_directory'); ?>/responsive.css" rel="stylesheet" type="text/css" />



<?php if(get_option("ocmx_theme_style") !="") :

 echo theme_colour_styles();

else : ?>

 <link href="<?php bloginfo('template_directory'); ?>/color-styles/light/style.css" rel="stylesheet" type="text/css" />

<?php endif; ?>



<?php if(get_option("ocmx_rss_url")) : ?>

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php echo get_option("ocmx_rss_url"); ?>" />

<?php else : ?>

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />

<?php endif; ?>



<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />



<!--[if lt IE 9]>

   <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/ie.css" media="screen" />

<![endif]-->



<?php wp_head(); ?>



</head>



<body <?php body_class(''); ?>>


<div class="bg_white">
<div id="header-container">

        <?php

        $headercart = get_option("ocmx_header_cart");

        if(isset($headercart) && $headercart == "yes") :

                get_template_part("/functions/header-cart");

        endif;

        ?>



        <div id="header" class="clearfix">

                <div class="logo">

                        <h1>

                                <a href="<?php bloginfo('url'); ?>">

                                        <?php if(get_option("ocmx_custom_logo")) : ?>

                                                <img src="<?php echo get_option("ocmx_custom_logo"); ?>" alt="<?php bloginfo('name'); ?>" />

                                        <?php else : ?>

                                                <?php bloginfo('name'); ?>

                                        <?php endif; ?>

                                </a>

                        </h1>
						<div class="right_section">
                        	<div class="social_section">
                            	<a href="#"><img src="http://tightlinemedia.webimpakt-green.com/wp-content/uploads/2015/05/social.png" /></a>
                            </div>
                            <div class="sim_address">
                            PO BOX 50242<br>Idaho Falls, ID 83405<br>info@tightlinemedia.com
                            </div>
                        </div>
                </div>



                <div id="navigation-container">

                        <a id="menu-drop-button" href="#"></a>

                        <?php if (function_exists("wp_nav_menu")) :

                                wp_nav_menu(array(

                                        'menu' => 'Gigawatt Header Nav',

                                        'menu_id' => 'nav',

                                        'menu_class' => 'clearfix',

                                        'sort_column'   => 'menu_order',

                                        'theme_location' => 'primary',

                                        'container' => 'ul',

                                        'fallback_cb' => 'ocmx_fallback_primary')

                                );

                        endif; ?>

                </div>

        </div>

</div>



<div id="content-container" class="clearfix">