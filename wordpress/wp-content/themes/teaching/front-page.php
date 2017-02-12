<?php
/*
 * Template Name: blog teaching
 */

get_header();

get_template_part('template-parts/banner');
?>

<!-- banner-bottom -->
	<div id="about" class="banner-bottom">
		<div class="container">
			<h3 class="head">A<span>brief description <i>about</i> teaching</span></h3>
			<div class="agileits_banner_bottom_grids">
				<div class="col-md-6 agileits_banner_bottom_grid_l">
					<h4>Aliquam a nunc non erat lobortis</h4>
					<p><i>Vestibulum nec consequat nisl. Aliquam vehicula egestas commodo. 
						Pellentesque lorem magna, pulvinar sed lacinia et, venenatis in mi.</i>Nullam sodales rutrum nisl, gravida porttitor lectus porta et. 
						Duis purus arcu, semper at magna faucibus, elementum maximus ligula. 
						Etiam imperdiet posuere odio gravida vehicula. Nulla consectetur massa 
						eget tincidunt suscipit. Integer vitae ex eros. Cras ornare dignissim 
						scelerisque.</p>
				</div>
				<div class="col-md-6 agileits_banner_bottom_grid_r">
					<div class="agileits_banner_btm_grid_r">
						<img src="<?php bloginfo('template_directory');?>/assets/images/3.jpg" alt=" " class="img-responsive" />
						<div class="agileits_banner_btm_grid_r_pos">
							<img src="<?php bloginfo('template_directory');?>/assets/images/2.jpg" alt=" " class="img-responsive" />
						</div>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
<!-- //banner-bottom -->
<!---728x90--->
<!-- banner-bottom1 -->
	<div class="banner-bottom1">
		<div class="col-md-6 agile_banner_bottom1_left">
		</div>
		<div class="col-md-6 agile_banner_bottom1_right">
			<h4>Duis at enim sit amet velit mattis</h4>
			<p>Aliquam a tellus nec leo commodo imperdiet sit amet sit amet lacus. 
				Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac 
				turpis egestas.</p>
			<ul>
				<li><span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span>Morbi eu velit eget libero pretium</li>
				<li><span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span>Pellentesque habitant morbi</li>
				<li><span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span>Senectus et netus et malesuada</li>
				<li><span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span>Fames ac turpis egestas</li>
				<li><span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span>Tellus nec leo commodo imperdiet</li>
				<li><span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span>Habitant morbi tristique senectus</li>
			</ul>
		</div>
		<div class="clearfix"> </div>
	</div>
<!-- //banner-bottom1 -->
<!---728x90--->
<!-- testimonials -->
	<div class="testimonials">
		<div class="container">
			<h3 class="head head1">C<span>our <i>clients</i> says</span></h3>
			<ul id="flexiselDemo1">			
				<li>
					<div class="wthree_testimonials_grid_main">
						<div class="wthree_testimonials_grid">
							<h4>Suspendisse sagittis nibh sit amet nisi imperdiet</h4>
							<p>Donec laoreet eu purus eu viverra. Vestibulum sed convallis massa,
								eu aliquet massa. Suspendisse lacinia rutrum tincidunt. Integer id erat porta, 
								convallis tortor a, ullamcorper magna.</p>
							<div class="wthree_testimonials_grid_pos">
								<img src="<?php bloginfo('template_directory');?>/assets/images/2.png" alt=" " class="img-responsive" />
							</div>
						</div>
						<div class="wthree_testimonials_grid1">
							<h5>Mark Henry</h5>
							<p>Teacher</p>
						</div>
					</div>
				</li>
				<li>
					<div class="wthree_testimonials_grid_main">
						<div class="wthree_testimonials_grid">
							<h4>Vestibulum sed convallis massa tincidunt</h4>
							<p>Donec laoreet eu purus eu viverra. Vestibulum sed convallis massa,
								eu aliquet massa. Suspendisse lacinia rutrum tincidunt. Integer id erat porta, 
								convallis tortor a, ullamcorper magna.</p>
							<div class="wthree_testimonials_grid_pos">
								<img src="<?php bloginfo('template_directory');?>/assets/images/4.png" alt=" " class="img-responsive" />
							</div>
						</div>
						<div class="wthree_testimonials_grid1">
							<h5>Linda Carl</h5>
							<p>Teacher</p>
						</div>
					</div>
				</li>
				<li>
					<div class="wthree_testimonials_grid_main">
						<div class="wthree_testimonials_grid">
							<h4>Integer id erat porta convallis tortor</h4>
							<p>Donec laoreet eu purus eu viverra. Vestibulum sed convallis massa,
								eu aliquet massa. Suspendisse lacinia rutrum tincidunt. Integer id erat porta, 
								convallis tortor a, ullamcorper magna.</p>
							<div class="wthree_testimonials_grid_pos">
								<img src="<?php bloginfo('template_directory');?>/assets/images/3.png" alt=" " class="img-responsive" />
							</div>
						</div>
						<div class="wthree_testimonials_grid1">
							<h5>Michael Paul</h5>
							<p>Teacher</p>
						</div>
					</div>
				</li>
			</ul>
			<script type="text/javascript">
					$(window).load(function() {
						$("#flexiselDemo1").flexisel({
							visibleItems:1,
							animationSpeed: 1000,
							autoPlay: true,
							autoPlaySpeed: 3000,    		
							pauseOnHover: true,
							enableResponsiveBreakpoints: true,
							responsiveBreakpoints: { 
								portrait: { 
									changePoint:480,
									visibleItems: 1
								}, 
								landscape: { 
									changePoint:640,
									visibleItems:1
								},
								tablet: { 
									changePoint:768,
									visibleItems: 1
								}
							}
						});
						
					});
			</script>
			<script type="text/javascript" src="<?=get_template_directory_uri()?>/assets/js/jquery.flexisel.js"></script>
		</div>
	</div>
<!-- //testimonials -->
<!-- newsletter -->
	<div class="newsletter">
		<div class="container">
			<div class="col-md-7 w3ls_newsletter_left">
				<h3>N<span>Subscribe to our newsletter</span></h3>
				<p>Suspendisse lacinia rutrum tincidunt.</p>
			</div>
			<div class="col-md-5 w3ls_newsletter_right">
				<form action="#" method="post">
					<input type="email" name="Email" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" required="">
					<input type="submit" value=" ">
				</form>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>

<?php 
get_footer(); 

//require_once "template-parts/portfolio.php";

?>
