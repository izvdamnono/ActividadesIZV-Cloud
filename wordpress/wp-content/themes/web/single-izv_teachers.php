<?php
get_header();
get_template_part("template-parts/header","top");
get_template_part("template-parts/header","nav");
?>
<div class="about">
	<div class="container">
	    <div class="single-top">
		    <?php get_template_part("template-parts/breadcrumbs") ?>
            <?php get_template_part( 'template-parts/single', 'izv_teachers'); ?>
		</div>		
	</div>
</div>

<?php get_footer();?>
