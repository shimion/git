<?php 
/*
Template Name: Portfolio List */
// Fetch the Portfolio Categories
$cat_list = get_terms("portfolio-category", "orderby=count&hide_empty=0");
$parentpage = get_template_link("portfolio.php");
$layout = get_post_meta($post->ID, "layout", true);
if($layout == "one-column") :
	$nextul = 1;
elseif($layout == "two-column") :
	$nextul = 2;
elseif($layout == "three-column") :
	$nextul = 3;
else :
	$nextul = 4;
endif;
$i = 1;
$args = array(
	"post_type" => "portfolio",
	"showposts" => "-1"
	);
$query = new WP_Query($args);
get_header(); ?>
<h2 class="section-title"><?php the_title(); ?></h2>
<ul class="double-column portfolio clearfix">    
    <li id="category-column">        
        <?php if ($cat_list != "") : ?>
            <ul class="clearfix">
                <?php foreach($cat_list as $tax) :
                    $link = get_term_link($tax->slug, "portfolio-category");
                    echo "<li><a href=\"$link\">".$tax->name."</a></li>";
                endforeach; ?>
            </ul>
        <?php endif; ?>
    </li>
    <li id="content-column">
         <ul class="portfolio-list <?php echo $layout; ?>">
             <?php if ($query->have_posts()) :
                while ($query->have_posts()) :	$query->the_post();
					if($i > $nextul)
						echo "\n\t</ul>\n\t<ul class=\"portfolio-list $layout\">"; $i = 1;
					get_template_part("/functions/portfolio-list");
					$i++;
                endwhile;
            else :
                ocmx_no_posts();
            endif; ?>
		</ul>
    </li>    
</ul>
<?php get_footer(); ?>