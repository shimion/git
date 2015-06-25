<?php $link = get_permalink($post->ID); ?>
<li id="right-column">
	<?php if( is_singular( 'product' ) ): ?>
		<?php do_action( 'woocommerce_before_single_product', $post, isset( $_product ) ); ?>
        <div class="purchase-options-container">
            <?php if ( have_posts() ) while ( have_posts() ) : the_post();
                global $product;
                $_product = $product; ?>
                <div class="product-price">
               
                    <?php do_action( 'woocommerce_single_product_summary', $post, $_product ); ?>
                </div>
            <?php endwhile; ?>
        </div>
	<?php if( get_option( "ocmx_meta_social" ) !="false" || get_option( "ocmx_page_meta" ) !="false" ): ?>
        <!-- Go to www.addthis.com/dashboard to customize your tools -->
        <div class="social addthis_sharing_toolbox"></div>
	<?php endif; ?>
	<?php elseif( is_single() && !is_singular( 'product' ) && get_option( "ocmx_post_meta" ) != "false" ): ?>
		<ul class="post-meta">
			<?php if( get_option( "ocmx_meta_author_bio" ) != "false" ): ?>
				<li class="meta-item post-author">
					<?php echo get_avatar( get_the_author_meta('email'), "56" ); ?>
					<div class="author-desc">
						<h4><?php the_author_meta('nickname'); ?></h4>
						<?php the_author_meta('description'); ?>
					</div>
				</li>
			<?php endif; 
			if( get_option( "ocmx_meta_date" ) != "false" ): ?>
				<li class="meta-item post-date">
					<span><?php _e("Post Date", "ocmx"); ?></span>
					<?php echo date_i18n( 'd F Y', strtotime( $post->post_date ) ); ?>
				</li>
			<?php endif; 
			if( get_option( "ocmx_meta_social" ) != "false" ): ?>
					<!-- Go to www.addthis.com/dashboard to customize your tools -->
        			<li class="social socialz addthis_sharing_toolbox"></div>
			<?php endif; 
			if( get_option( "ocmx_meta_shorturl" ) != "false" ): ?>
				<li class="meta-item short-url">
					<span><?php _e("Short Url", "ocmx"); ?></span>
					<input type="text" value="<?php echo wp_get_shortlink($post->ID); ?>" />
				</li>
			<?php endif; 
			if( get_option( "ocmx_meta_tags" ) != "false" && has_tag() ): ?>
					<li class="meta-item post-tags">
						<span><?php _e("Post Tags", "ocmx"); ?></span>
						<?php the_tags('',', ', ''); ?>
					</li>
			<?php endif; 
			if( get_option( "ocmx_meta_post_links") != "false" ): ?>
				<?php if(!is_page() && get_adjacent_post(false, '', true)): ?>
					<li class="meta-item previous-post">
						<span><?php _e("Previous", "ocmx"); ?></span>
						<?php previous_post_link( "%link", "%title" ); ?>
					</li>
				<?php endif; ?>
				<?php if( !is_page() && get_adjacent_post( false, '', false ) ): // if there are newer posts ?>
					<li class="meta-item next-post">
						<span><?php _e("Next", "ocmx"); ?></span>
						<?php next_post_link( "%link", "%title" ); ?>
					</li>
				<?php endif; ?>
			<?php endif; 
			if( get_option( "ocmx_meta_related_posts" ) != "false" ): ?>
					<?php $categories = get_the_category(); 	
					$tags = wp_get_post_tags($post->ID);
					
					$catarray = array();
					foreach($categories as $cat) :
						$catarray[] = $cat->term_id;
					endforeach;
					$catlist = implode(",", $catarray);
				
					$tagarray = array();	
					foreach($tags as $tags) :
						$tagarray[] = $tags->term_id;
					endforeach;
					$args= array(
						'cat' => $catlist,
						'tag__in' => $tagarray,
						'post__not_in' => array($post->ID),
						'showposts'=>3,
					);
					$my_query = new WP_Query( $args );
					
					if( $my_query->have_posts() ) : ?>
					<li class="meta-item post-related">
						<span><?php _e("Related", "ocmx"); ?></span>
						<ul class="clearfix">
							<?php while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
								<li class="related-posts">
									<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
										<?php the_title(); ?>
									</a>
								</li>
							<?php endwhile; ?>
						</ul>
					</li>
				<?php endif;  ?>
			<?php endif; ?>
		</ul>
		<?php endif;?>
		<ul class="widget-list">
			<?php if(is_post_type_archive( 'product' ) || ( get_post_type() == "product")) :
				//Shop Sidebar
				dynamic_sidebar('shop-sidebar');
			else :
				//Blog Sidebar
				dynamic_sidebar('sidebar');
			endif; ?>
		</ul>
</li>	