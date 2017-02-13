<?php
/*
	Template Name: portfolio
*/
get_header();
echo create_bootstrap_menu_teaching();
get_template_part('template-parts/banner');

?>
<div class="portfolio">
	<div class="container">
		<h3 class="head head2">P<span>Latest <i>portfolio</i> grids</span></h3>

            <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
				<ul id="myTab" class="nav nav-tabs" role="tablist">
				    <?php 
				    $portfolio =array(
				    'home'=>'All',    
				    'learning'=>'Learning',
				    'playing'=>'Playing',
				    'painting'=>'Painting',
				    'school'=>'School',
				    );
				    $i = 1;
				    foreach($portfolio as $key => $value) {
				    ?>
					    <li role="presentation" <?php if( $i == 1 ):?> class="active" <?php endif; ?>>
					        <a href="#<?= $key ?>" id="<?= $key ?>-tab" role="tab" data-toggle="tab" aria-controls="<?= $key ?>" <?php if( $i == 1 ):?> aria-expanded="true" <?php endif; ?>><?= $value ?></a>
				        </li>
					<?php
					$i++;
				    }
					?>
					</ul>
				<div id="myTabContent" class="tab-content">
				    <?php
				    $i = 1;
				    foreach($portfolio as $key => $value) {
                    ?>
					<div role="tabpanel" class="tab-pane fade <?php if($i==1): ?> in active <?php endif; ?>" id="<?=$key?>" aria-labelledby="<?=$key?>-tab">
						<div class="w3_tab_img">
						    <?php
						    $imagenes = array(1,6,7,8,9,10,11,12,13);
						    shuffle($imagenes);
						    foreach($imagenes as $imagen) {
						    ?>
							<div class="col-md-4 w3_tab_img_left">
								<div class="demo">
									<a class="cm-overlay" href="<?=get_template_directory_uri()?>/assets/images/<?=$imagen?>.jpg">
									  <figure class="imghvr-shutter-in-out-diag-2"><img src="<?=get_template_directory_uri()?>/assets/images/<?=$imagen?>.jpg" alt=" " class="img-responsive" />
										<figcaption>
										  <h3>Teaching</h3>
										  <p>Phasellus elementum ullamcorper urna, 
											eu rhoncus lacus rutrum non.</p>
										</figcaption>
									  </figure>
									</a>
								</div>
							</div>
							<?php
							}
							?>
							<div class="clearfix"> </div>
						</div>
					</div>
					<?php
					$i++;
				    }
					?>
					
				</div>
			</div>
			<script src="<?=get_template_directory_uri()?>/assets/js/jquery.tools.min.js"></script>
			<script src="<?=get_template_directory_uri()?>/assets/js/jquery.mobile.custom.min.js"></script>
			<script src="<?=get_template_directory_uri()?>/assets/js/jquery.cm-overlay.js"></script>
			<script>
				$(document).ready(function(){
					$('.cm-overlay').cmOverlay();
				});
			</script>
		</div>
		
	</div>
<!-- //portfolio -->
<?php
get_footer();
?>
