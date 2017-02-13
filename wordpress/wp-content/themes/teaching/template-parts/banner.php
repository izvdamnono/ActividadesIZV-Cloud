<!-- banner banner-img-<?= rand(1,3); ?> -->
	<div class="banner " style="background-image:url('<?php header_image(); ?>');">
		<div class="w3agile_banner_info">
			<div class="container">
				<h3><?=get_bloginfo('name')?></h3>
				<a href="http://w3layouts.com/"><?=get_bloginfo('description')?></a>
			</div>
		</div>
		<div class="w3_scroll">
			<div class="scroll-down">
			  <span class="dot"> </span>
			</div>
		</div>
		<?php /*<div class="w3_banner_pos">
			<img src="<?= get_template_directory_uri(); ?>/assets/images/1.png" alt=" " class="img-responsive animated wow slideInUp" data-wow-delay=".1ms" />
		</div> */?>
	</div>
<!-- //banner -->