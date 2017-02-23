<?php

get_header();
/**
 * Menu que genera un header menu nav segun como lo tengas configurado en el 
 * Back end del wordpress
 * 
 */ 
 
echo create_bootstrap_menu_teaching();
get_template_part('template-parts/banner');
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <?php $query = new WP_Query_Activity(array('profesor' => 'carmelo')); ?>
                
                <?php if (! $query->have_activities() ): ?>
                    
                    <?php while( $query->have_activities() ) : $query->the_activity(); ?>
                        
                        <pre>
                            <p><?php $query->the_title(); ?></p>
                            <p><?php $query->the_teacher();?></p>
                            <p><?php $query->the_thumbnail_activity(); ?></p>
                            <p><?php $query->the_excerpt(); ?></p>
                            <p><?php $query->the_content(); ?></p>
                            <p><?php $query->the_date(); ?></p>
                            <p><?php $query->the_time(); ?></p>
                            <p><?php $query->the_time(true); ?></p>
                                
                        </pre>
                    <?php endwhile; ?>
                <?php else : ?>
                    
                    <p>No hay actividades</p>
                    
                <?php endif; ?>

            <?php $query->wp_reset_activitydata(); ?>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-8">
                    
        <?php
            $page = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $args = array(
                'post_type' => array('post', 'chartjs'), 
                'posts_per_page' => 5,
                'paged' => $page
            );
                          
            $loop = new WP_Query($args);
            if ( $loop->have_posts() ) {
            	while ( $loop->have_posts() ) {
            		$loop->the_post(); 
            	
                    get_template_part( 'template-parts/content', get_post_type() );
                
            	} 
            	
            	
				echo get_paginate_page_link();
            }
            
            wp_reset_postdata();
        ?>
      
        </div>
        <div class="col-lg-4">
            <div class="well">
                <?php get_sidebar() ?>
            </div>
        </div>
    </div>
</div>
<?php 
get_footer(); 

//require_once "template-parts/portfolio.php";
?>
