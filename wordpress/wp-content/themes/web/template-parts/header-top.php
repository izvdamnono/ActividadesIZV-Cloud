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
	<div class="container padre">
		<div class="head-main">
			<div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
				<a href="<?= $home_url ?>"><img class="img-responsive" src="<?= $image[0] ?>" alt="<?= $name_site ?>"></a>
			</div>
			<div class="col-lg-8 col-md-8 col-xs-8 col-sm-8 text-left">
				<h4 class="text-logo">
					<?= $name_site ?><br>
					<?= $get_bloginfo_description ?>
				</h4>
			</div>
			<?php
				$locale = get_locale();
				
				$en		= '<span class="flag-icon flag-icon-gb"></span> '.__("English", "web");
				$es		= '<span class="flag-icon flag-icon-es"></span> '.__("Spanish", "web");
				$fr		= '<span class="flag-icon flag-icon-fr"></span> '.__("French", "web");
			?>
			<select class="selectpicker lang-iosapplication" data-width="fit">
			    <option data-content='<?= $en ?>' value="en_US" <?= $locale =="en_EN" ? "selected" : ''?>>
			    	<?=__("English", "web")?>
			    </option>
				<option data-content='<?= $es ?>' value="es_ES" <?= $locale =="es_ES" ? "selected" : ''?>>
					<?=__("Spanish", "web")?>
				</option>
				<option data-content='<?= $fr ?>' value="fr_FR" <?= $locale =="fr_FR" ? "selected" : ''?>>
					<?=__("French", "web")?>
				</option>
			</select>
		</div>
		
	</div>
</div>
<!--header-top-end-->