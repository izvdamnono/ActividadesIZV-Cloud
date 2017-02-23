<?php
get_header();
get_template_part("template-parts/header","top");
get_template_part("template-parts/header","nav");

?>

<div class="about">
    
    <div class="container">
        
        <div class="row">
            
            <div class="about-main">
    			<div class="col-md-12 about-left">
    			    
    			    <?php $res = $wp_the_query->found_posts != 0 ?>
    			    
    				<div class="alert alert-<?= $res ? 'info' : 'danger'?>" role="alert">
    				    <?php if ($res) : ?>
        				    <strong>
        				        <?=  __("Resultado",'web').': ' ?>
        				    </strong> 
        				    <?= $wp_the_query->found_posts.' '.__("post encontrados", 'web') ?>
        				<?php else : ?>
        				
                            <strong>
                                <?= __("No se encontraron resultados", 'web') ?>
                            </strong>
        				<?php endif; ?>
    				</div>
    				
    				<?php if ( have_posts() ) : ?>
    					
    				<?php $ind = 0; $hr = 0; ?>
    				<?php while( have_posts() ): the_post(); ?>	
    						
    				    <?php
							
							//Variable que controla que cerremos la etiqueta contenedora
							$cl = false;
							
        					$catid = wp_get_post_categories($post->ID, array('fields' => 'ids'));
        					$thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full')[0];
    						if (!$thumb) {
								$thumb = get_post_type() === 'izv_teachers' ? get_post_meta($post->ID, "teacher_image", true) : get_template_directory_uri()."/assets/images/front-default.jpg";
							}
    						
    					?>
        						
        				<?= $ind == 0  ? '<div class="row"><div class="a-1">' : '' ?>
    				    <div class="col-md-4 abt-left front">
    							        
    				        <a href="<?php the_permalink(); ?>">
							    <div class="div-responsive front-thumbnail" style ="background-image: url(<?= $thumb ?>)"></div>
    						</a>	
    						<?php 
    						    
    						    $title = get_post_type(); 
    						    
    						    switch ($title) {
    						        
    						        case "chartjs" : {
    						            
    						            $title = "grafico";
    						            break;
    						        }
    						        
    						        case "izv_teachers": {
    						            
    						            $title = "profesor";
    						            break;
    						        }
    						    }
    						?>
    						
        					<h6><?= __(ucfirst($title),'web') ?></h6>
        					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        					<?php the_excerpt(); ?>
    						<label><?= get_the_time('M d, Y') ?></label>
    					</div>
    						
    					<?php
    						
    						    if ( ++$ind == 3 ) {
    						        
    						        $ind = 0;
    						        $cl  = true;
    						        echo '<div class="clearfix"></div></div></div>';
    						    }
    						
    					?>
    					<?php endwhile; ?>
    					<?= !$cl ? '<div class="clearfix"></div></div></div>' : ''?>
    				    <?php echo get_paginate_page_link(0,'list'); ?>
    				<?php endif; ?>
    				<?php wp_reset_postdata(); ?>
    		</div>
    	</div>
            
    </div>
        
    </div>

</div>
<?php get_footer(); ?>