<?php dynamic_sidebar('slider');?>
<ul class="double-column clearfix">
	<li id="left-column">
		<ul class="blog-main-post-container">
			<?php if (have_posts()) :
				while (have_posts()) :  the_post(); setup_postdata($post);
					get_template_part("/functions/fetch-list");
				endwhile;
			else :
				ocmx_no_posts();
			endif; ?>
		</ul>
		<?php motionpic_pagination("clearfix", "pagination clearfix"); ?>
	</li>
	<?php get_sidebar(); ?>
</ul>