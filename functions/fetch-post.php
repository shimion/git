<?php 

$link = get_permalink($post->ID); 

$args  = array( 'postid' => $post->ID, 'width' => 940, 'height' => 530, 'hide_href' => false, 'exclude_video' => false, 'imglink' => false, 'imgnocontainer' => true, 'resizer' => '940x529' );

$image = get_obox_media($args);

global $post;

?>



<?php if($image !="") : ?> 

	<div class="post-image fitvid"> 

		 <?php echo $image; ?>

    </div>

<?php endif; ?>



<ul class="double-cloumn clearfix">

    <?php if (have_posts()) :

        global $show_author, $post;

        $show_author = 1;

        while (have_posts()) : the_post(); setup_postdata($post); ?>

        <li id="left-column">

        	<!--Show Title -->

            <h2 class="post-title"><a href="<?php echo $link; ?>"><?php the_title(); ?></a></h2>

           

            <!--Begin Content -->

            <div class="copy clearfix">

                <?php the_content(""); ?>

                 <?php wp_link_pages( $args ); ?>

            </div>

            <?php if(comments_open($post->ID)){comments_template();}?>

        </li>

        

    <?php endwhile;

    else :

        ocmx_no_posts();

    endif; ?> 

	<?php get_sidebar(); ?>

</ul>