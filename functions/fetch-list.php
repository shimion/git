<?php $link = get_permalink($post->ID);
$hosted_m4v = get_post_meta($post->ID, "video_hosted", true);
$hosted_ogv = get_post_meta($post->ID, "video_hosted_ogv", true);
$args  = array('postid' => $post->ID, 'width' => 550, 'height' => 309, 'hide_href' => false, 'exclude_video' => false, 'imglink' => false, 'imgnocontainer' => true, 'resizer' => '550x309');
$image = get_obox_media($args);?>

<li class="post">		
	<!--Show the Featured Image -->
	<?php if($image !="") : ?> 
    	<div class="post-image fitvid"> 
    		 <?php echo $image; ?>
        </div>
    <?php endif; ?>
	<!--Show the Meta if enabled in Theme Options -->
    <?php if( get_option( "ocmx_post_meta" ) != "false" ) : ?>
    	<h5 class="date">
			<?php if(get_option("ocmx_meta_date") != "false"){ echo date_i18n('d F Y', strtotime($post->post_date)); } ?>&nbsp; 
            <?php if(get_option("ocmx_meta_author") !="false") { _e("written by ", "ocmx"); the_author_posts_link(); }?>
           	<?php if(get_option("ocmx_meta_category") !="false") { _e(" in ", "ocmx"); the_category(); }?>
        </h5>
    <?php endif; ?>
    <h2 class="post-title"><a href="<?php echo $link; ?>"><?php the_title(); ?></a></h2>
    <div class="copy clearfix">
    	<!--Begin Excerpt -->
        <div class="copy <?php echo $image_class; ?>">
            <?php if( get_option( "ocmx_content_length" ) != "no" ) : 
                the_excerpt(); ?>
                <p><a href="<?php echo $link; ?>" class="action-link"><?php _e("Continue Reading &rarr;", "ocmx"); ?></a></p>
           	<?php else : 
                the_content();
            endif; ?>
        </div>
        
    </div>    
</li>                        
