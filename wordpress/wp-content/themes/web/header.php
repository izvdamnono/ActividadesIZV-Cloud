<!DOCTYPE html>
<html>
<head>
    <title>
    <?php
        if (function_exists('is_tag') && is_tag()) {
            single_tag_title(__('Archivos por etiqueta','web').'&quot;');
            echo '&quot; - ';
        } elseif (is_archive()) {
            wp_title('');
            echo __('Archive','web'),' - ';
        } elseif (is_search()) {
            echo __('Search', 'web')." ".__("by", "web").": ".'&quot;' . wp_specialchars(!empty($s) ? $s : "") . '&quot; - ';
        } elseif (!(is_404()) && (is_single()) || (is_page())) {
        
        } elseif (is_404()) {
            echo __('404','web').'- ';
        }
        if (is_home()) {
            bloginfo('name');
            echo ' - ';
            bloginfo('description');
        } else {
            bloginfo('name');
        }
        if (!empty($paged) and $paged > 1) {
            echo ' - page ' . $paged;
        }
    ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />
    
    
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <link href="<?= get_stylesheet_uri() ?>" rel='stylesheet' type='text/css' />
    
    <script src="<?= get_template_directory_uri() ?>/assets/js/jquery.min.js"></script>
    <script src="<?= get_template_directory_uri() ?>/assets/js/bootstrap.js"></script>
    <script src="<?= get_template_directory_uri() ?>/assets/js/bootstrap-select.min.js"></script>
    
    <!-- start-smoth-scrolling -->
    <script type="text/javascript" src="<?= get_template_directory_uri() ?>/assets/js/move-top.js"></script>
    <script type="text/javascript" src="<?= get_template_directory_uri() ?>/assets/js/easing.js"></script>
    <script type="text/javascript" src="<?= get_template_directory_uri() ?>/assets/js/knob.js"></script>
    
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			
			$(".scroll").click(function(event){		
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
			});
			/*
			$('.gallery a').Chocolat({
                leftImg : '<?= get_template_directory_uri() ?>/assets/images/left.gif',	
                rightImg : '<?= get_template_directory_uri() ?>/assets/images/right.gif',	
                closeImg : '<?= get_template_directory_uri() ?>/assets/images/close.gif',		
                loadingImg : '<?= get_template_directory_uri() ?>/assets/images/loading.gif',		
			});
			*/
			$(' #da-thumbs > li ').each( function() { 
				$(this).hoverdir(); 
			});
			
			$(".dial").knob({
                "readOnly": true,
                "angleArc": 180,
                "fgColor": "#8b9dc3",
                "bgColor": "#Dfe3ee",
                "rotation": "anticlockwise",
                "angleOffset": 270,
                "width": "60%"
            });
			
		});
	</script>
	
	<script src="<?= get_template_directory_uri() ?>/assets/js/modernizr.custom.97074.js"></script>
	<script src="<?= get_template_directory_uri() ?>/assets/js/isotope.min.js"></script>
	<script src="<?= get_template_directory_uri() ?>/assets/js/jquery.chocolat.js"></script>
	<script src="<?= get_template_directory_uri() ?>/assets/js/jquery.flexisel.js"></script>
	
	<!--light-box-files -->
	<script  src="<?= get_template_directory_uri() ?>/assets/js/jquery.hoverdir.js"></script>
	<?php get_template_part('template-parts/chartjs_load_header') ?>
	<?php wp_head(); ?>
</head>