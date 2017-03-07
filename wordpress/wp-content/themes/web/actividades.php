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
    			
                    $args   = array('departamento'  => isset($_POST['filter-departamento']) ? $_POST['filter-departamento'] : '', 
                                    'profesor'      => isset($_POST['filter-profesor']) ? $_POST['filter-profesor'] : '',
                                    'fecha'         => isset($_POST['filter-fecha']) ? $_POST['filter-fecha'] : '');
                    $query  = new WP_Query_Activity($args);
                            
                ?>
            
            <?php if ($query->have_activities() ) :  ?>
                
                <div class="alert alert-info" role="alert">
                    
                    <strong>
        				<?=  __("Result",'web').': ' ?>
        			</strong>
        			<?php $num = $query->activity_count(); ?>
        		    <?= $num.' '.__("founded ".($num ===1 ? 'activity' : 'activities'), 'web') ?>
                    
                </div>
                
            <?php   while( $query->have_activities() ) : ?>
            
            <?php       $query->the_activity(); ?>
                
                <article>
                	<header>
                	    <div class="about-one">
                	    	<h3><?= $query->get_the_title() ?></h3>
                	    </div>
                	</header>
                    <div class="about-two actividad">
                        <img src="<?= $query->get_thumbnail_activity() ?>" alt="">
                    	
                    	    <span class="profesor">
                    	         <?= __("Teacher", 'web') ?>: <?php echo $query->the_teacher(); ?>
                	        </span><br>
                    	    <span class="fecha">
                    	        <?= __("Date", 'web') ?>:  <?php echo $query->the_date(); ?>
                    	    </span> 
                    	
                    	
                    	<p><?= $query->get_the_excerpt() ?></p>
                    	
                    	
                    </div>
               </article>
                    
            <?php   endwhile; ?>
            
            <?php else: ?>
                
                <div class="alert alert-danger" role="alert">
                    
                    <strong>
                        <?= __("Not founded activities", 'web') ?>
                    </strong>
                    
                </div>
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