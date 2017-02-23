<?php
$name_site = get_bloginfo('name');
$get_bloginfo_description = get_bloginfo('description');
$home_url = home_url();
$custom_logo_id = get_theme_mod( 'custom_logo' );
$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
$image[0] = $image[0]?:"";
?>
<!--header-top-starts-->
<div class="header-top">
	<div class="container">
		<div class="head-main">
			<div class="col-lg-4 col-md-4">
				<h3><a href="<?= $home_url ?>"><img class="img-responsive" src="<?= $image[0] ?>" alt="<?= $name_site ?>"></a></h3>
			</div>
			<div class="col-lg-8 col-md-8 text-left">
				<h4 class="text-logo">
					<?= $name_site ?><br>
					<?= $get_bloginfo_description ?>
				</h4>
			</div>
		</div>
	</div>
</div>
<!--header-top-end-->