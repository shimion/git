<?php 
/*
Template Name: Widgetized Page */
get_header();
global $post; 
$widgetpage = $post->post_title; 
?>
<?php dynamic_sidebar($widgetpage." Slider Widget"); ?> 
	<div id="widget-block" class="clearfix">
		<ul class="widget-list">
			<?php dynamic_sidebar($widgetpage." Body"); ?>
		</ul>
	</div>
<?php if (have_posts()) : while (have_posts()) : the_post();?>
<div class="full-width clearfix">
	<div class="copy clearfix">
		<?php the_content(); ?>
	</div>
</div>
<?php endwhile; endif; ?>
<?php  get_footer(); ?>