<?php 
function ocmx_welcome_page(){
	global $pagenow;
	global $wp_version;
	global $productid;
	global $themename;
	global $themeid;
	$themes = wp_get_themes();
	$current_theme =  wp_get_theme();
	
function ocmx_admin_tabs( $current = 'step1' ) {
    $tabs = array( 
	'step1' => 'Step 1', 
	'step2' => 'Step 2', 
	'step3' => 'Step 3' );
    echo '<div id="obox-wrapper">';
	echo'<h2 class="obox-theme-name">';
	echo isset($themename); echo isset($themename)." ".isset($current_theme->Version); 
	echo '</h2>';
    echo '<h2 class="nav-tab-wrapper">';
    foreach( $tabs as $tab => $name ){
        $class = ( $tab == $current ) ? ' nav-tab-active' : '';
        echo "<a class='nav-tab$class' href='?page=obox-help&tab=$tab'>$name</a>";

    }
    echo '</h2>';
}

	if ( isset ( $_GET['tab'] ) ) ocmx_admin_tabs($_GET['tab']); else ocmx_admin_tabs('step1');

	if ( isset ( $_GET['tab'] ) ) $tab = $_GET['tab'];
	else $tab = 'step1';

	echo '<div class="obox-content">'; ?>
   
        <div class="section">
	        <div class="columns-1 grid">
		        <div class="column">
			        <div class="obox-help-buttons">
				        <a target="blank" href="http://kb.oboxsites.com/wp-content/uploads/2012/12/<?php echo $themeid; ?>-demo-content.zip" class="demo-content"><span>Demo Content</span></a>
				        <a target="blank" href="http://kb.oboxsites.com/documentation/<?php echo $themeid; ?>-docs/" class="documentation" target="_blank"><span>Documentation</span></a>
				        <a href="http://oboxthemes.com/forum/post/" class="support-forums" target="_blank"><span>Get Support</span></a>
			        </div>
			        <h2 class="settings-title">Welcome to <?php echo $themename; ?> by Obox Themes</h2>
			        <p class="settings-intro">If you need step-by-step instructions for setting up and using the theme, check out our <a href="http://kb.oboxsites.com/documentation/<?php echo $themeid; ?>-docs" target="_blank"><?php echo $themename; ?> Theme documentation</a>. If know your way around WordPress, you can use our Quick Setup steps below.</p>
		        </div>
	        </div>
        </div>
            
  <?php switch ( $tab ){
      case 'step2' :
         ?>
			<div class="section">

	            <div class="instructions">
	                <h3 class="instruction-title">2. Setup Home Page & Widgets</h3>
	                <p class="instruction-intro">Now that you’ve added your content and configured the theme,  you will be able to setup your Home page and move on to customizing the theme.</p>
					<p class="instruction-intro">On the right you will see a number of panels that you can expand. Each widget area specific to your theme has been color coded to make setup easy. Simply drag the widgets you need into the corresponding panels. </p>
	                <p class="instruction-intro">At the top of the page you will find a yellow ribbon containing a handy “Click Here” link, which will display the recommended widget setup if you get lost. <a href="http://kb.oboxsites.com/<?php echo $themeid; ?>-setup-your-widgets" target="blank">Read our documentation on each widget for detailed information</a></p>
	                <ul class="columns-4 action-list">
                    	<li class="column"><a href="<?php echo admin_url('admin.php?page=ocmx-home.php'); ?>" class="to-do" target="blank">Choose a Home Layout</a></li>
	                    <li class="column"><a href="<?php echo admin_url('widgets.php'); ?>" class="to-do" target="blank">Setup Your Widgets</a></li>
                        <li class="column"><a href="<?php echo admin_url('nav-menus.php'); ?>" class="to-do" target="blank">Setup Your Menus</a></li>
	                    <li class="column"><a href="?page=obox-help&tab=step3" class="next-step">Next Step &rarr;</a></li>
	                </ul>
	            </div> 
			</div>
         <?php
      break;
      case 'step3' :
         ?>
    		<div class="section">
                <div class="instructions">
                    <h3 class="instruction-title">3. Final step! Time to customize your theme!</h3>
                    <p class="instruction-intro">Now that you’ve added your content and setup your widgets it’s time to customize your theme. You can configure several aspects of the theme, and add your own logo, header image and color scheme. Click the Theme Documentation icon above for details on each option available in the WordPress Customizer.</p>
                </div>
                <ul class="columns-3 action-list">
                    <li class="column"><a href="<?php echo admin_url('admin.php?page=functions.php'); ?>" class="to-do" target="blank">Configure Theme Options</a></li>
                    <li class="column"><a href="<?php echo admin_url('options-permalink.php'); ?>" class="to-do" target="blank">Enable Permalinks</a></li>
                    <li class="column"><a href="<?php echo admin_url('customize.php'); ?>" class="to-do" target="blank">Customize</a></li>   
                </ul>
            </div>
         <?php
      break;
      case 'step1' :
         ?>
                            
            <div class="section">
                <div class="instructions">
                    <h3 class="instruction-title">1. Add your Content</h3>
                    <p class="instruction-intro">Before we can really get started, you first need to add content to WordPress. There are a number of different content types that you can create with <?php echo $themename; ?>, including Post Types and Post Formats.</p>
                    <p class="instruction-intro">If you prefer to pre-load our demo content into your theme to get a head start, you may use our demo content file linked from the first icon above. Note that this file cannot setup widgets or Theme Options – continue with the documentation or this quick guide even after loading this file to learn how to use the theme.</p>
                </div>
                <ul class="columns-4 action-list">
                	<li class="column"><a href="<?php echo admin_url('post-new.php'); ?>" class="to-do" target="blank">Add Some Posts</a></li>
                    <li class="column"><a href="<?php echo admin_url('post-new.php?post_type=portfolio'); ?>" class="to-do" target="blank">Add a Portfolio</a></li>
                    <li class="column"><a href="<?php echo admin_url('post-new.php?post_type=page'); ?>" class="to-do" target="blank">Create the Pages</a></li>
                    <li class="column"><a href="?page=obox-help&tab=step2" class="next-step">Next Step &rarr;</a></li>
                </ul>
            </div>
         <?php
      break;
   }
   echo '</div><!-- /obox-content -->';
   
echo '</div><!-- /obox-wrapper -->';
}
function ocmx_check_welcome(){
	global $pagenow, $themeid;
	if(!get_option($themeid."_welcome") && isset($_GET["activated"]) && $pagenow == "themes.php") :
		update_option($themeid."_welcome", 1);
	    wp_redirect(admin_url('admin.php?page=obox-help'));
	endif; 
}
add_action("init", "ocmx_check_welcome");