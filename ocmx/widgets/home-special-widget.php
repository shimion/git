<?php

class special_widget extends WP_Widget {

	

	function special_widget() {

		$widget_ops = array('classname' => 'special-wd', 'description' => __( "Home Page Special box ","ocmx") );

		$this->WP_Widget('special_wd', __("Home Page Special box", "ocmx"), $widget_ops);

	}



	/** @see WP_Widget::widget */

	function widget($args, $instance) {

		if(isset($instance["title"]))

			$title = $instance["title"];

?>

	<li class="widget search-form obox-search-widget special-widget" style="list-style:none;">

		<div class="special-left">
        	<h4 class="widgettitle">About Tight Line Media</h4>
                <div class="sim_contnet_sectopm">
                <p class="last_word">From the first word...</p>
                <p>Options are the inspiration behind Tight Line Media. CEO Kris Millgate recognized the meshing of the mediums and made the bold move from traditional TV journalism to multi-media productions in 2006.
    Tight Line Media earned its first Telly Award in 2008 for the documentary Idaho Meth Project. Tight Line Media also earned Outstanding Service for Wildlife Conservation in 2013. Kris also has multiple honors for her coverage of outdoor and environmental issues for video and print news outlets.
    Tight Line Media's film Sanctuary, about recovering elk habitat in New Mexico, won best outdoor story in the nation in 2012 and Tight Line Media film, Restoring Hope, toured nationwide with the Wild and Scenic Film Festival in 2014.
    Tight Line Media produces award-winning journalistic content for video and print. It also produces quality content for corporations, government entities and non-profit organizations.
    Tight Line Media is a leader in the multi-media movement delivering exceptional productions from the first word to the final edit.</p>
    <p class="last_word"> ...to the final edit.</p>
                </div>
        </div>
		<div class="special-right">
        	<h4 class="widgettitle">About Kris Millgate</h4>
                <div class="sim_contnet_sectopm">
                <img style="float:left; padding-right:10px;" src="/wp-content/uploads/2015/05/about-image.png" />
                <p>The quiet cast of a fly line cures writer's block for outdoor journalist and filmmaker Kris Millgate. Millgate investigates outdoor and environment issues for TV and web with cross publication in newspapers and magazines. Millgate graduated from the Uni. versity of Utah with a degree in broadcast journalism in 1997 then worked for TV stations for a decade. Millgate recognized the meshing of the mediums in 2006 and made the bold move to multi-media as a freelancer with her production company Tight Line Media. She manages every aspect of a production from the first word to the final edit. Millgate has won a variety of awards, recently placing in National Geographic's Top 10 film competition and her film Restoring Hope toured the nation with the Wild and Scenic Film Festival in 2014. She Her 20 years of experience and several cross-country moves prove she'll go anywhere for a good story. Contact Millgate at info@tightlinemedia.com.</p>
                </div>
            <p></p>
        </div>
        


	</li>

<?php

	}



	/** @see WP_Widget::update */

	function update($new_instance, $old_instance) {

		return $new_instance;



			

	} // form



}// class



//This sample widget can then be registered in the widgets_init hook:



// register FooWidget widget

add_action('widgets_init', create_function('', 'return register_widget("special_widget");'));



?>