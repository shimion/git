<?php 
// Fetch the Portfolio Categories
$term = get_term_by( 'slug', get_query_var('term' ), get_query_var( 'taxonomy' ) );
$cat_list = get_terms("portfolio-category", "orderby=count&hide_empty=0");
$parentpage = get_template_link("portfolio.php");
$layout = get_post_meta($parentpage->ID, "layout", true);

if($layout == "one-column") :
	$nextul = 1;
elseif($layout == "two-column") :
	$nextul = 2;
else :
	$nextul = 3;
endif;
$i = 1;
get_header();?>
<h2 class="section-title"><a href="<?php  echo get_permalink($parentpage->ID); ?>"><?php echo $parentpage->post_title; ?></a> <span>/ <?php echo $term->name; ?></span></h2>
<ul class="portfolio clearfix">    
    <li id="category-column">        
        <?php if ($cat_list != "") : ?>
            <h4><?php _e("Categories","ocmx"); ?></h4>
            <ul class="clearfix">
                <li><a href="<?php  echo get_permalink($parentpage->ID); ?>"><?php _e("All", "ocmx"); ?></a></li>
                <?php foreach($cat_list as $tax) :
                    $link = get_term_link($tax->slug, "portfolio-category");
					$class = "";
					if($tax->term_id == $term->term_id)
						$class = "class=\"selected\"";
                    echo "<li><a href=\"$link\" $class>".$tax->name."</a></li>";
                endforeach; ?>
            </ul>
        <?php endif; ?>        
    </li>
    <li id="content-column">
        <ul class="portfolio-list <?php echo $layout; ?>">
             <?php if (have_posts()) :
                while (have_posts()) :	the_post();
					if($i > $nextul)
						echo "\n\t</ul>\n\t<ul class=\"portfolio-list $layout\">"; $i = 1;
							get_template_part("/functions/portfolio-list");
						$i++;
                endwhile;
            else :
                ocmx_no_posts();
            endif; ?>
        </ul>
        <?php motionpic_pagination("clearfix", "pagination clearfix"); ?>
	</li>    
</ul>
<?php get_footer(); ?>