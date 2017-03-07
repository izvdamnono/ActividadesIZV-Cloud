<?php
	get_header();
	get_template_part("template-parts/header", "top");
	get_template_part("template-parts/header", "nav");
	get_template_part("template-parts/banner");
?>
<div class="about">
	<div class="container">
		<div class="team-top heading wow fadeInUp">
			<h3><?= __("Last news", 'web') ?></h3>
		</div>
		
		<div class="row">
		<div class="about-main">
			<div class="col-md-12 about-left">
			    <div class="about-tre">
					
					<?php
					
						$args  = array(	'posts_per_page' => 4,
										'tax_query' => array(
                                            array(
                                                'taxonomy' => 'post_format',
                                                'field' => 'slug',
                                                'terms' => array(
                                                    'post-format-gallery',
                                                    'post-format-link',
                                                    'post-format-image',
                                                    'post-format-quote',
                                                    'post-format-audio',
                                                    'post-format-video'
                                                ),
                                                'operator' => 'NOT IN'
                                            )));
                                            
						$query = new WP_Query($args);
						
						$indrow = 1;	
					?>
						
					<?php if ( $query->have_posts() ) : ?>
							
						<?php while( $query->have_posts() ): $query->the_post() ?>	
						
							<?php
							
								$catid = wp_get_post_categories($post->ID, array('fields' => 'ids'));
								$thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full')[0];
								if (!$thumb) $thumb = get_template_directory_uri()."/assets/images/front-default.jpg";
								$ind   = 0;
							?>
							
							<?= $indrow % 2 != 0 ? '<div class="a-1">' : '' ?>
							
								<?php $wow = $indrow % 2 != 0 ? 'fadeInLeft' : 'fadeInRight'; ?>
								<div class="col-md-6 col-sm-12 col-xs-12 abt-left front wow <?=$wow?>" data-wow-delay="<?= (0.5-$ind++).'s'?>">
    								<a href="<?php the_permalink(); ?>">
										<div class="div-responsive front-thumbnail" style ="background-image: url(<?= $thumb ?>)">
										</div>
									</a>	
    								<h6><?= get_my_categoty_links($catid); ?></h6>
    								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    								<?php the_excerpt(); ?>
    								<label><?= get_the_time('M d, Y') ?></label>
    							</div>
							<?= $indrow++ % 2 == 0 ? '<div class="clearfix"></div></div>' : '' ?>
							<?php $ind = $indrow % 2 == 0 ? 0 : $ind; ?>
						<?php endwhile; ?>
					<?php else : echo "No hay posts :(" ?>
					<?php endif; ?>
					<?php wp_reset_postdata(); ?>
				</div>
			</div>
			<!--<div class="col-md-4 about-right heading">
		    </div>-->
		</div>
		</div>
	</div>
</div>

<div class="team">
	<div class="container">
		<div class="team-top heading wow fadeInUp">
			<h3><?= __("Our teachers", 'web') ?></h3>
		</div>
			<div class="team-bottom">
				
				<?php
					
					$args  = array(	'posts_per_page' => 4,
									'post_type' => 'izv_teachers');
					$query = new WP_Query($args);
					
					$indpr = 1;
				?>
				
				<?php if ( $query->have_posts() ) : ?>
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>
						
						<?php
							$name		 = get_post_meta($post->ID, "teacher_name", true);
							$departament = get_post_meta($post->ID, "teacher_departament", true);
							$image		 = get_post_meta($post->ID, "teacher_image", true);
						?>
					
						<div class="col-md-3 team-left front wow bounceInLeft" data-wow-delay="<?= (1-($indpr++*0.25))."s" ?>">
							<img class="front-teacher" src="<?= $image ?>" alt="" />
							<h4><?= $name ?></h4>
							<p><?= $departament ?></p>
						</div>
						
					<?php endwhile; ?>
				<?php else: echo "no hay profesores!" ?>
				<?php endif;?>
				<?php wp_reset_postdata(); ?>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!--team-end-->

<?php /*
<!--slide-starts-->
<div class="slide">
	<div class="container">
		<div class="fle-xsel">
			<ul id="flexiselDemo3">
				<li>
					<a href="#">
						<div class="banner-1">
							<img src="<?= get_template_directory_uri() ?>/assets/images/s-1.jpg" class="img-responsive" alt="">
						</div>
					</a>
				</li>
				<li>
					<a href="#">
						<div class="banner-1">
							<img src="<?= get_template_directory_uri() ?>/assets/images/s-2.jpg" class="img-responsive" alt="">
						</div>
					</a>
				</li>			
				<li>
					<a href="#">
						<div class="banner-1">
							<img src="<?= get_template_directory_uri() ?>/assets/images/s-3.jpg" class="img-responsive" alt="">
						</div>
					</a>
				</li>		
				<li>
					<a href="#">
						<div class="banner-1">
							<img src="<?= get_template_directory_uri() ?>/assets/images/s-4.jpg" class="img-responsive" alt="">
						</div>
					</a>
				</li>	
				<li>
					<a href="#">
						<div class="banner-1">
							<img src="<?= get_template_directory_uri() ?>/assets/images/s-5.jpg" class="img-responsive" alt="">
						</div>
					</a>
				</li>	
				<li>
					<a href="#">
						<div class="banner-1">
							<img src="<?= get_template_directory_uri() ?>/assets/images/s-6.jpg" class="img-responsive" alt="">
						</div>
					</a>
				</li>				
			</ul>
							
			<script type="text/javascript">
				$(window).load(function() {
									
					$("#flexiselDemo3").flexisel({
						visibleItems: 5,
						animationSpeed: 1000,
						autoPlay: true,
						autoPlaySpeed: 3000,    		
						pauseOnHover: true,
						enableResponsiveBreakpoints: true,
						responsiveBreakpoints: { 
							portrait: { 
								changePoint:480,
								visibleItems: 2
							}, 
							landscape: { 
								changePoint:640,
								visibleItems: 3
							},
							tablet: { 
								changePoint:768,
								visibleItems: 3
							}
						}
					});
							
				});
			</script>
		<div class="clearfix"> </div>
		</div>
	</div>
</div>	
<!--slide-end-->*/?>
<?php $maps = 'https://maps.googleapis.com/maps/api/js?v=3&callback=initialize&key=AIzaSyB9u42SvYiBvnL4BJu3GbA8i_6ZgpdIUXM'; ?>
<div class="contact">
	<div class="container">
		<div class="contact-top heading wow fadeInUp">
			<h3><?= ucfirst(__('Contact us','web')) ?></h3>
		</div>
		<div class="container">
		
			<div class="row">
				
				<div class="col-md-12">
					
					<div class="contact-bottom">
						
						<div id="cd-google-map" class="wow bounceInUp">
							<!-- #google-container will contain the map  -->
							<div id="google-container"></div>
							<!-- #cd-zoom-in and #zoom-out will be used to create our custom buttons for zooming-in/out -->
							<div id="cd-zoom-in"></div>
							<div id="cd-zoom-out"></div>
						</div>
						<script type="text/javascript" src="<?= get_template_directory_uri()?>/assets/js/map.js"></script>
						<script src="<?= $maps ?>" async defer></script>
						
						<div class="contact-text">
							<div class="col-md-4 contact-left wow bounceInLeft">
								<h4><?= __('Contact us', "web") ?></h4>
								<p><?= __('Do you need information? Just ask', "web")?></p>
								<div class="address">
									<h4><?= ucfirst(__('Direction', "web")) ?></h4>
									<ul class="contact-list">
										<li class="direccion"><?= 'Avda. Primavera, 26-28 (18008) Granada' ?></li>
										<li class="telefono"><?= '958 89 38 50' ?></li>
										<li class="correo"><?= 'secretaria.ieszaidinvergeles@gmail.com'?></li>
									</ul>
								</div>
							</div>	
							<div class="col-md-8 contact-right wow bounceInRight">
								<input placeholder="<?= ucfirst(__('Name')) ?>" type="text" required>
								<input placeholder="<?= ucfirst(__('Email', "web")) ?>" type="text" required>
								<textarea placeholder="<?= ucfirst(__('Message', "web")) ?>" required></textarea>
									<div class="submit-btn">
										<form>
											<input type="submit" value="<?= ucfirst(__('Submit','web'))?>">
										</form>
									</div>
							</div>
							<div class="clearfix"></div>
						</div>
    				</div>
    				
				</div>
			</div>
			
		</div>
	</div>
</div>
<!--end-contact-->

<?php get_footer("full"); ?>
<?php get_footer(); ?>