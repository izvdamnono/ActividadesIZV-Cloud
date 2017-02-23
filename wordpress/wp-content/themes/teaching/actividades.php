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
                $args   = array(isset($_POST['filter']) ? $_POST['filter'] : '' => 
                              isset($_POST['field']) ? $_POST['field'] : '');
                              
                $query  = new WP_Query_Activity($args);
                        
            ?>
            
            <?php if ($query->have_activities() ) :  ?>
            
            <?php   while( $query->have_activities() ) : ?>
            
            <?php       $query->the_activity(); ?>
                
                    <?php $query->the_title(); ?>
                    
            <?php   endwhile; ?>
            
            <?php endif; ?>
            
            <?php $query->wp_reset_activitydata();?>
            
        </div>
			<div class="col-md-4 about-right heading">
			    <?php get_sidebar(); ?>
			</div>
			<div class="clearfix"></div>			
		</div>		
	</div>
</div>

<?php get_footer();?>