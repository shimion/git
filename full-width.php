<?php 
/* Template Name: Full Width */
get_header(); ?>
<div id="full-width" class="clearfix">
	<?php if (have_posts()) :
		global $show_author, $post;
		$show_author = 1;
		while (have_posts()) : the_post(); setup_postdata($post);
			$link = get_permalink($post->ID); 
			$args  = array( 'postid' => $post->ID, 'width' => 940, 'hide_href' => false, 'exclude_video' => false, 'imglink' => false, 'imgnocontainer' => true, 'resizer' => '940' );
			$image = get_obox_media($args); ?>
            <div class="post-content clearfix">
            	<!--Show featured image if there is one -->
            	<?php if ( $image !="" ) : ?>
                    <div class="post-image fitvid">
                        <?php echo $image ?>
                    </div>
                <?php endif; ?>
                <!--Show Page title -->
                <h2 class="post-title typography-title"><a href="<?php echo $link; ?>"><?php the_title(); ?></a></h2>
				<!--Show Content -->  
                <div class="copy clearfix">
                     <?php the_content(""); ?>
                </div>
            </div>
			<?php 
			if(comments_open($post->ID)){comments_template();}
			endwhile;
		else :
			ocmx_no_posts();
		endif; ?> 

</div>
<?php get_footer(); ?>
