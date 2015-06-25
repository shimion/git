<?php
class quotes_widget extends WP_Widget {
    /** constructor */
    function quotes_widget() {
        parent::WP_Widget(false, $name = "(Obox) Quotes", array("description" => "Home Page Widget - Show your quotes on the home page."));	
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
		global $wp_query;
		$get_quotes = new WP_Query("post_type=quotes&post_status=publish&posts_per_page=1&orderby=rand"); ?>
        <li class="featured-quote">
        	<?php while ($get_quotes->have_posts()) : $get_quotes->the_post();	
				global $post;		
				$link = get_post_meta($post->ID, "info_box_link", true);
				?>    
                <blockquote>
                    <?php the_excerpt(); ?>
                </blockquote>
                <cite>~ <a href="<?php echo $link; ?>"><?php the_title(); ?></a></cite>
			<?php endwhile; ?>
        </li>
<?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {
        return $new_instance;
    }

}// class

//This sample widget can then be registered in the widgets_init hook:

// register FooWidget widget
add_action('widgets_init', create_function('', 'return register_widget("quotes_widget");'));

?>