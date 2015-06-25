<?php dynamic_sidebar('slider');
if (function_exists('dynamic_sidebar') && is_active_sidebar('homepage')) : ?> 
	<div class="home-sidebar">	
		<div id="widget-block" class="clearfix">
			<ul class="widget-list">
				<?php dynamic_sidebar('homepage'); ?>
			</ul>
		</div>
	</div>	
<?php endif; ?>