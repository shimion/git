<?php get_header(); ?>

<ul class="double-cloumn clearfix">
    <li id="left-column">		
		<p><?php _e("Results for", "ocmx");?> "<em><?php the_search_query(); ?></em>"</p>
        <ul class="blog-main-post-container">
			<?php if (have_posts()) :
                global $show_author;
                $show_author = 1;
                while (have_posts()) :	the_post(); setup_postdata($post);
                	get_template_part("/functions/fetch-list");
                endwhile;
            else :
                ocmx_no_posts();
            endif; ?>
        </ul> 
                <?php motionpic_pagination("clearfix", "pagination clearfix"); ?>
    	<?php comments_template(); ?>
	</li>
	<?php get_sidebar(); ?>
</ul>
<?php get_footer(); ?>