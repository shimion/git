
<div id="footer" class="clearfix">

	<ul class="footer-two-column clearfix">

		<?php if (function_exists('dynamic_sidebar')) :

			dynamic_sidebar('footer');

		endif; ?>

	</ul>

	<div class="footer-text">

		<div id="footer-navigation-container">

			<?php if (function_exists("wp_nav_menu")) :	

				wp_nav_menu(array(

					'menu' => 'Footer menu',

					'menu_id' => 'footer-nav',

					'menu_class' => 'clearfix',

					'sort_column' 	=> 'menu_order',

					'theme_location' => 'secondary',

					'container' => 'ul',

					'fallback_cb' => 'ocmx_fallback_secondary')

					);

				endif; ?>

			</div>

		<p><?php echo stripslashes(get_option("ocmx_custom_footer")); ?></p>

		

		<?php if(get_option("ocmx_logo_hide") != "true") : ?>

			<div class="obox-credit">

				<p><a href="http://oboxthemes.com/blogging">WordPress Video Theme</a> by <a href="http://www.oboxthemes.com"><img src="<?php bloginfo("template_directory"); ?>/images/obox-logo.png" alt="Theme created by Obox" /></a></p>

			</div>

		<?php endif; ?>

	</div>

</div>

<div id="template-directory" class="no_display"><?php echo bloginfo("template_directory"); ?></div>
</div>
</div>

<?php wp_footer(); ?>

<?php 

	if(get_option("ocmx_googleAnalytics")) :

		echo stripslashes(get_option("ocmx_googleAnalytics"));

	endif;

?>

<script>

  jQuery(document).ready(function(){

	jQuery(".fitvid").fitVids();

  });

</script>

</body>

</html>