<?php get_header();
global $woo_options;
$count = 0; ?>

<?php if (have_posts()) : while (have_posts()) : the_post();
	global $product, $post;
	$args  = array( 'postid' => $post->ID, 'width' => 940, 'hide_href' => false, 'exclude_video' => false, 'imglink' => false, 'imgnocontainer' => true, 'resizer' => '940' );
	$image = get_obox_media($args);
	$attachmentargs = array("post_type" => "attachment", "post_parent" => $post->ID,  "offset" => 1, "orderby" => "menu_order");
	$attachments = get_posts($attachmentargs);
	$attachment_ids = $product->get_gallery_attachment_ids(); ?>


	<div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php if(get_option('ocmx_product_gallery') !="false" && $attachment_ids) :  // Show the Featured Image
			do_action( 'woocommerce_product_thumbnails', $post, isset($product) );
		else : ?>

			<div class="slider clearfix">
				<ul class="gallery-container">

						<li class="product-image fitvid">
							<?php if($image !=""){ echo $image; }?>
						</li>

					<?php $count++;

					 if (!empty($attachments)) :
						foreach ($attachments as $attachment) :
						$thumbs = wp_get_attachment_url($attachment->ID, "full");
						$images = wp_get_attachment_url($attachment->ID, "940");
						?>
							<li class="product-image fitvid">
								<a rel="thumbnails" class="zoom" href="<?php echo $thumbs; ?>">
									<img src="<?php echo $images; ?>" alt="" />
								</a>
							</li>
						<?php $count++;
						endforeach;
					endif; ?>

				</ul>
				<?php if($count > 1) : ?>
					<div class="controls">
						<div class="slider-dots">
							<?php for($i=1; $i <= $count; $i++) : ?>
								<a href="#" rel="<?php echo ($i-1); ?>"class="dot <?php if($i == 1) : ?>dot-selected<?php endif; ?>"><?php echo $i; ?></a>
							<?php endfor; ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<ul class="clearfix">
			<li id="left-column">
				<?php ocmx_breadcrumbs(); ?>
				<div class="product-right clearfix">
					<h2 class="post-title"><?php the_title(); ?></h2>
					<div class="woocommerce_tabs clearfix">
						<?php do_action( 'woocommerce_after_single_product_summary', $post, isset($product) ); ?>
					</div>
				</div>

			</li>
<?php endwhile; endif; ?>

			<?php get_sidebar(); ?>
		</ul>
	</div>

<?php get_footer(); ?>