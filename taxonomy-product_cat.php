<?php
/* Template Name: Shop */
?>

<?php get_header(); ?>

<?php 
	$shop_page_id = get_option('woocommerce_shop_page_id');
	$shop_page = get_post($shop_page_id);
	$shop_page_title = (get_option('woocommerce_shop_page_title')) ? get_option('woocommerce_shop_page_title') : $shop_page->post_title;
?>

<?php if (is_search()) : ?>		
	<h1 class="page-title"><?php _e('Search Results:', 'woothemes'); ?> &ldquo;<?php the_search_query(); ?>&rdquo; <?php if (get_query_var('paged')) echo ' &mdash; Page '.get_query_var('paged'); ?></h1>
<?php else : ?>
	<h2 class="section-title"><?php echo apply_filters('the_title', $shop_page_title); ?></h2>
<?php endif; ?>

<ul class="shop-content clearfix">
	<li id="left-column">	
		<?php  do_action('woocommerce_before_shop_loop'); ?>
		<ul class="products">
			<?php if (have_posts()) :
				woocommerce_product_subcategories(); 
				while (have_posts()) :	the_post(); setup_postdata($post);
					woocommerce_get_template_part( 'content', 'product' );
				endwhile;
			else :
				ocmx_no_posts();
			endif; ?>
		</ul>
		<?php motionpic_pagination("clearfix", "pagination clearfix"); ?>
	</li>
	<li id="right-column">
		<ul class="widget-list">
			<?php dynamic_sidebar('shop-sidebar'); ?>
		</ul>
	</li>
</ul>
<?php get_footer(); ?>