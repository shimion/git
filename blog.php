<?php
/*
Template Name: Blog
*/ 

get_header(); ?>

<ul class="double-cloumn clearfix">
    <li id="left-column">	
        <ul class="blog-main-post-container clearfix">
			<?php query_posts('post_type=post&post_status=publish&paged='.$paged);
			if (have_posts()) :
                while (have_posts()) :the_post(); 
                    get_template_part("/functions/fetch-list");
                endwhile;
            else :
                ocmx_no_posts(); wp_reset_query();
            endif; ?>
        </ul>
		<?php motionpic_pagination("clearfix", "pagination clearfix"); ?>
	</li>
	<?php get_sidebar(); ?>
</ul>
<?php get_footer(); ?>		