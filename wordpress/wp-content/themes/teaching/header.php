<!DOCTYPE html>
<html>
<head>
    <?php //wp_head(); ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php bloginfo('html_type'); ?>">
    <meta name="author" content="Antonio & Fernando">

    <meta charset="<?php bloginfo('charset'); ?>">
    <title>
        <?php
        if (function_exists('is_tag') && is_tag()) {
            single_tag_title('Tag Archive for &quot;');
            echo '&quot; - ';
        } elseif (is_archive()) {
            wp_title('');
            echo ' Archivo - ';
        } elseif (is_search()) {
            echo 'Search for &quot;' . wp_specialchars(!empty($s) ? $s : "") . '&quot; - ';
        } elseif (!(is_404()) && (is_single()) || (is_page())) {

        } elseif (is_404()) {
            echo 'Recurso no encontrado - ';
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

    <script type="application/x-javascript">
        addEventListener("load", function () {
                setTimeout(hideURLbar, 0);
        }, false);
        function hideURLbar() {
            window.scrollTo(0, 1);
        } 
    </script>

    <!-- CSS -->
    <link href="<?= get_stylesheet_uri() ?>" rel="stylesheet">
    <!-- CSS -->
    <link href="https://fonts.googleapis.com/css?family=Capriola" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic" rel="stylesheet" type="text/css">
    <!-- //CSS -->
    
    <!-- JS -->
        <!-- start-smoth-scrolling -->
        
    <script type="text/javascript" src="<?= get_template_directory_uri() ?>/assets/js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="<?= get_template_directory_uri() ?>/assets/js/wow.min.js"></script>
    
    <script type="text/javascript" src="<?= get_template_directory_uri() ?>/assets/js/jquery.flexisel.js"></script>
    <script type="text/javascript" src="<?= get_template_directory_uri() ?>/assets/js/bootstrap.js"></script>
    
    <script type="text/javascript" src="<?= get_template_directory_uri() ?>/assets/js/move-top.js"></script>
    <script type="text/javascript" src="<?= get_template_directory_uri() ?>/assets/js/easing.js"></script>

    <script>
    $(document).ready(function(){
        $('.cm-overlay').cmOverlay();
    });
    </script>
    <!-- //js -->
    
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $(".scroll").click(function (event) {
                event.preventDefault();
                $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1000);
            });
        });
    </script>
    
    <script>
        new WOW().init();
    </script>
</head>
<body>