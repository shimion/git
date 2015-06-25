<?php global $wpdb;	
	//DISTINCT YEAR(post_date) AS year, MONTH(post_date) AS month, count(ID) as posts  
	$fetch_archive = $wpdb->get_results("SELECT * FROM " . $wpdb->posts . " WHERE post_status='publish' AND post_type = 'post' GROUP BY $wpdb->posts.ID ORDER BY post_date DESC");
	$last_month = date_i18n("m Y", strtotime($fetch_archive[0]->post_date));
	get_header(); 
?>
<div id="hd-container">
    <div class="post-title-block">
       <h3 class="section-title"><?php _e("Ohh Snap! 404 Error", "ocmx"); ?></h3>
        <p><?php _e("The page you are looking for does not exist.", "ocmx"); ?></p>
    </div>
</div>
<ul class="clearfix">
    <li id="left-column">	
    	<div class="archives">
            <ul class="archives_list">
            <?php
                foreach($fetch_archive as $archive_data) :
                    global $post;
                    $post = $archive_data;
                    $category_id = get_the_category($archive_data->ID);
                    $this_category = get_category($category_id[0]->term_id);
                    $this_category_link = get_category_link($category_id[0]->term_id);
                    $link = get_permalink($archive_data->ID);
                    $args  = array('postid' => $post->ID, 'width' => 300, 'height' => 169, 'hide_href' => false, 'exclude_video' => true, 'imglink' => false, 'imgnocontainer' => true, 'resizer' => '300x169');
					$image = get_obox_media($args); ?>
                    <li>
                    	<?php if($image !="") : ?> 
			            	<div class="post-image fitvid"> 
			            		 <?php echo $image; ?>
			                </div>
		                <?php endif; ?>

                     	<?php if(get_option("ocmx_meta_date") != "false"): ?>
	                        <span class="date">
	                            <?php echo date('F dS', strtotime($archive_data->post_date)); ?>
	                        </span>
                        <?php endif; ?>
                        <a href="<?php echo get_permalink($archive_data->ID); ?>" class="post-title"><?php echo substr($archive_data->post_title, 0, 45); ?></a>
                        <span class="label">
                            <a href="<?php echo $this_category_link; ?>" title="View all posts in <?php echo $this_category->name; ?>" rel="category tag"><?php echo $this_category->name; ?></a>
                        </span>
                    </li>
                <?php
                    $last_month = date("m Y", strtotime($archive_data->post_date));
                endforeach;
            ?>
       
        </ul>
	  </div>	
	</li>
	<?php get_sidebar(); ?>
</ul>
<?php get_footer(); ?>