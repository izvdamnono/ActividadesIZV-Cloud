<?php

get_header();
get_template_part('template-parts/nav');
require_once('functions/WP_Query_Activity.php');

?>

<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <?php $query = new WP_Query_Activity(); ?>
                
                <?php if ( $query->have_activities() ): ?>
                    
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

    <div class="row">
        <div class="col-lg-8">


        <?php get_template_part('template-parts/the_loop'); ?>

        </div>
        <div class="col-lg-4">
            <div class="box">

                <?php get_sidebar() ?>

            </div>
        </div>
    </div>
</div>
<?php 
get_footer(); 

//require_once "template-parts/portfolio.php";
?>
