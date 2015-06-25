<?php
get_header();
global $post;
$terms = get_the_terms($post->ID, 'portfolio-category');
if(is_array($terms))
	$first_term = array_shift( $terms );
$parentpage = get_template_link("portfolio.php");
$cat_list = get_terms("portfolio-category", "orderby=count&hide_empty=0");?>

<h2 class="section-title">
	<a href="<?php  echo get_permalink($parentpage->ID); ?>"><?php echo $parentpage->post_title; ?></a>
	<?php if(is_array($terms) && $first_term->name !='') : ?>
		/ <a href="<?php echo bloginfo('url').'/'.$first_term->taxonomy.'/'.$first_term->slug.'/'; ?>"><?php echo $first_term->name; ?></a></span>
	<?php endif; ?>
</h2>
	<ul class="double-column portfolio clearfix">
	<?php if (have_posts()) :
		global $post;
		while (have_posts()) : the_post(); setup_postdata($post);
			get_template_part("/functions/fetch-portfolio");
		endwhile;
	else :
		ocmx_no_posts();
	endif; ?>
</ul>
<?php get_footer(); ?>