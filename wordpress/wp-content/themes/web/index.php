<?php
get_header();
get_template_part("template-parts/header","top");
get_template_part("template-parts/header","nav");

?>
<div class="about">
	<div class="container">
		<div class="about-main">
			<div class="col-md-8 about-left">
			    <?php get_template_part("template-parts/breadcrumbs") ?>
                <?php
                    $page = (get_query_var('paged')) ? get_query_var('paged') : 1;
    
                    $args = array(
                        'post_type' => array('post', 'chartjs'), 
                        /*'posts_per_page' => 4,*/
                        'paged' => $page
                    );
                    
                    $loop = new WP_Query($args);
                    if ( $loop->have_posts() ) {
                        while ( $loop->have_posts() ) {
                            $loop->the_post(); 
                            get_template_part( 'template-parts/content', get_post_type() );
                        }
                        
						echo get_paginate_page_link($loop->max_num_pages, 'list');
                    }
                    
                    wp_reset_postdata();
                    
                ?>
                
			</div>
			<div class="col-md-4 about-right heading">
			    <?php get_sidebar(); ?>
			</div>
			<div class="clearfix"></div>			
		</div>		
	</div>
</div>

<?php get_footer();?>
