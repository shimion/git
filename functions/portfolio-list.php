<?php
global $post, $layout;
if($layout == "one-column") :
	$resize = "940x529";
	$width = 940;
	$height = 529;
elseif($layout == "two-column") :
	$resize = "460x259";
	$width = 460;
	$height = 259;
elseif($layout == "three-column") :
	$resize = "300x169";
	$width = 300;
	$height = 169;
else :
	$resize = "300x169";
	$width = 300;
	$height = 169;
endif;

$link = get_permalink($post->ID); 
$args  = array('postid' => $post->ID, 'width' => $width, 'height' => $height, 'hide_href' => false, 'exclude_video' => true, 'imglink' => false, 'imgnocontainer' => true, 'resizer' => $resize);
$image = get_obox_media($args); ?>

<li class="column">

    <?php if($image !="") : ?> 
    	<div class="portfolio-image fitvid"> 
    		 <?php echo $image; ?>
        </div>
    <?php endif; ?>

	<h4 class="post-title"><a href="<?php echo $link; ?>"><?php the_title(); ?></a></h4>
	<?php if($post->post_excerpt !== "") :
		the_excerpt();
	else :
		the_content("");
	endif; ?>
    
</li>		