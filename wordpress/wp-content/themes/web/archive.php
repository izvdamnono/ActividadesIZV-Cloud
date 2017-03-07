<?php
/*
Template Name: Archives
*/
get_header();
get_template_part("template-parts/header","top");
get_template_part("template-parts/header","nav");
?>
<!--gallery-starts-->
<?php /*<div class="gallery">
	<div class="container">
		<div class="gallery-top heading">
			<h3><?= __("Archives") ?></h3>
		</div>
		<section>
			<ul id="da-thumbs" class="da-thumbs">
				<?php
				$page = (get_query_var('paged')) ?: 1;
				$archive_args = array(
					'post_type' => array('post', 'chartjs'), 
					'posts_per_page'=> 9,
					'paged' => $page

				);
				
				$archive_query = new WP_Query( $archive_args );
				while ( $archive_query->have_posts() ) {
					$archive_query->the_post();
					$get_the_title = strip_tags( get_the_title() );
					$get_the_time = get_the_time("jS M, Y");
					$the_excerpt_of_archive = strip_tags( the_excerpt_max_charlength(get_the_content(), 60) );
					$get_the_post_thumbnail_url =  get_the_post_thumbnail_url() ?:get_template_directory_uri()."/template/images/g-1.jpg";
					$get_permalink_of_post = get_permalink();
					?>
					<li>
						<a href="<?= $get_permalink_of_post ?>" rel="title" class="b-link-stripe b-animate-go  thickbox" title="<?php the_title_attribute(); ?>">
							<img src="<?= $get_the_post_thumbnail_url ?>" alt="" />
							<div>
								<h5><?= $get_the_title ?></h5>
								<span><?= $the_excerpt_of_archive ?></span>
								<span><?= $get_the_time ?> </span>
							</div>
						</a>
					</li>
					<?php
				}
				?>
				<?php wp_reset_postdata(); ?>
				<div class="clearfix"> </div>
			</ul>
			<div class="text-center">
				<?= custom_pagination( $page , $archive_query) ?>
			</div>
		</section>
    </div>
</div>*/?>
<!--gallery-end-->
<div class="about">
	<div class="container">
		<div class="row">
			<div class="about-main">
				<div class="col-md-8 about-left">
					
				    <?php get_template_part("template-parts/breadcrumbs") ?>
				    
				    <div class="about-tre">
				    	
		                <?php $indrow = 1;  ?>   
		                
		                 <?php if ( have_posts() ) : ?>
		                 	<?php while ( have_posts() ) : the_post(); ?>
			                	<?php
									//Variable que controla que cerremos la etiqueta contenedora
									$cl = false;
									$catid = wp_get_post_categories(null, array('fields' => 'ids'));
									$thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full')[0];
									if (!$thumb) {
										$thumb = get_post_type() === 'izv_teachers' ? get_post_meta($post->ID, "teacher_image", true) : get_template_directory_uri()."/assets/images/front-default.jpg";
									}
								?>
		                    	<?= $indrow % 2 != 0 ? '<div class="a-1">' : '' ?>
		                    	
		                    		<div class="col-md-6 col-sm-12 col-xs-12 abt-left front ">
    								<a href="<?php the_permalink(); ?>">
										<div class="div-responsive front-thumbnail" style ="background-image: url(<?= $thumb ?>)">
										</div>
									</a>	
    								<h6><?= get_my_categoty_links($catid); ?></h6>
    								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    								<?php the_excerpt(); ?>
    								<label><?= get_the_time('M d, Y') ?></label>
    							</div>
		                    	
		                    	<?php 
		                    		
		                    		if ( $indrow++ % 2 == 0 ) {
		                    			$cl = true;
		                    			echo '<div class="clearfix"></div></div>';
		                    		}
		                    	?>	
		                            
			                    <?php endwhile; ?>
			                        
	    						<?= !$cl ? '<div class="clearfix"></div></div>' : ''?>
								<?= get_paginate_page_link(0,'list'); ?>
									
			                <?php endif; ?>
			                <?php   wp_reset_postdata();  ?>
				    	
				    </div>	
				</div>
				<div class="col-md-4 about-right heading">
					<?php get_sidebar(); ?>		
				</div>	
			</div>
		</div>
	</div>
	
</div>

<?php 
	get_footer();
?>
