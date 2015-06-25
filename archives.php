<?php
	/*Template Name: Archives */
		global $wpdb;
	//DISTINCT YEAR(post_date) AS year, MONTH(post_date) AS month, count(ID) as posts
	global $wpquery;
	if (is_paged()) :
		$fetch_archive = query_posts( "paged=".get_query_var('paged' ) );
	else :
		$fetch_archive = query_posts( "paged=1" );
	endif;

	get_header();
?>

<div id="hd-container">
	<div class="post-title-block">
		<h2 class="post-title typography-title"><?php the_title(); ?></h2>
	</div>
</div>
<ul id="archives-page" class="clearfix">
	<li id="left-column">
		<div class="archives">
			<ul class="archives_list">
			<?php
				foreach( $fetch_archive as $archive_data ) :
					global $post;
					$post = $archive_data;
					$category_id = get_the_category( $archive_data->ID );
					$this_category = get_category( $category_id[0]->term_id );
					$this_category_link = get_category_link( $category_id[0]->term_id );
					$link = get_permalink( $archive_data->ID );
					$args  = array('postid' => $post->ID, 'width' => 300, 'height' => 169, 'hide_href' => false, 'exclude_video' => true, 'imglink' => false, 'imgnocontainer' => true, 'resizer' => '300x169');
					$image = get_obox_media( $args ); ?>
					<li>
					<?php if($image !="") : ?>
					  <div class="fitvid post-image">
						<?php echo $image; ?>
					  </div>
					 <?php endif; ?>
					 <?php if( get_option("ocmx_meta_date") != "false" ): ?>
						<span class="date">
							<?php echo date( 'F dS', strtotime( $archive_data->post_date ) ); ?>
						</span>
						<?php endif; ?>
						<a href="<?php echo get_permalink( $archive_data->ID ); ?>" class="post-title"><?php echo substr($archive_data->post_title, 0, 45); ?></a>
						<a href="<?php echo get_permalink( $archive_data->ID ); ?>/#comments" class="comment-count" title="Comment on <?php echo get_permalink( $archive_data->post_title ); ?>">
							<?php echo $archive_data->comment_count; ?> <?php _e("comments", 'ocmx'); ?>
						</a>
						<span class="label">
							<a href="<?php echo $this_category_link; ?>" title="View all posts in <?php echo $this_category->name; ?>" rel="category tag"><?php echo $this_category->name; ?></a>
						</span>
					</li>
				<?php
					$last_month = date( "m Y", strtotime( $archive_data->post_date ) );
				endforeach;
				?>
			</ul>
			<?php motionpic_pagination("clearfix", "pagination clearfix"); ?>
		</div>
	</li>
	<?php get_sidebar(); ?>
</ul>
<?php get_footer(); ?>