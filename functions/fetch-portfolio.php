<?php global $post, $blog_id;
//Meta for this item
$link = get_permalink($post->ID); 
$args  = array('postid' => $post->ID, 'width' => 680, 'height' => '', 'hide_href' => true, 'exclude_video' => false, 'imglink' => true, 'imgnocontainer' => true, 'resizer' => '680');
$image = get_obox_media($args); ?>

<li id="portfolio-content" class="clearfix">        
	<h4><a href="<?php echo $link; ?>"><?php the_title(); ?></a></h4>
	<div class="copy">
		<?php the_content(""); ?>
	</div>
</li>

<li id="portfolio-image">
	<ul class="portfolio-list">
		<li>
			<?php if($image !="") : ?> 
				<div class="portfolio-image fitvid">
					<?php echo $image; ?>
				</div>
			<?php endif; ?>
		</li>
		<?php $attach_args = array("post_type" => "attachment", "post_parent" => $post->ID, "offset"=> 0, "orderby" => "menu_order", "order" => "ASC", "posts_per_page" => -1);
			$attachments = get_posts($attach_args);
			foreach($attachments as $attachement => $this_attachment) :  
				$image = wp_get_attachment_image_src($this_attachment->ID, '680');
				$full = wp_get_attachment_image_src($this_attachment->ID,  "full");
				$thumbs = $image[0];
				if(is_multisite()) :					
					$thumbs = str_replace(get_site_url($blog_id), "", $thumbs);
					$thumbs = str_replace("/files/", "/wp-content/blogs.dir/$blog_id/files/", $thumbs); 
				endif; ?>
				<li>
					<div class="portfolio-image fitvid"> 
						<a href="<?php echo $full[0]; ?>" rel="lightbox">
							<img src="<?php echo $thumbs; ?>" alt="" />
						</a>
					</div>
				</li>
		<?php endforeach; ?>
	</ul>           
	<ul class="next-prev-post-nav">
		<li>
			<?php if (get_adjacent_post(false, '', true)): // if there are older posts ?>
				&larr;  <?php previous_post_link("%link", "%title"); ?>
			<?php else : ?>
				&nbsp;
			<?php endif; ?>
		</li>
		<li>
			<?php if (get_adjacent_post(false, '', false)): // if there are newer posts ?>
				<?php next_post_link("%link", "%title"); ?> &rarr;
			<?php else : ?>
				&nbsp;
			<?php endif; ?>    
		</li>
	</ul>
</li>
