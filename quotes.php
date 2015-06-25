<?php 
/* Template Name: Quotes */
	global $wp_query;
	$get_quotes = new WP_Query("post_type=quotes&post_status=publish&posts_per_page=-1&orderby=date");
	get_header(); 
?>
<div id="full-width" class="clearfix">
	<?php if (have_posts()) : while ($get_quotes->have_posts()) : $get_quotes->the_post();	
        global $post;		
        $link = get_post_meta($post->ID, "info_box_link", true);
       ?>    
			<div class="featured-quote">   
                <blockquote>
                    <?php the_excerpt(); ?>
                </blockquote>
                <cite>~ <a href="<?php echo $link; ?>"><?php the_title(); ?></a></cite>
			</div>
			<?php endwhile;
				else :
					ocmx_no_posts();
				endif; ?>
</div>
<?php get_footer(); ?>
