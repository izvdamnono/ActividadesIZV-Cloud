<?php
/*
    Template Name: portfolio
*/
get_header();
get_template_part("template-parts/header","top");
get_template_part("template-parts/header","nav");
// The Query
$the_query = new WP_Query( array(
    'posts_per_page' => -1,
    'post_type' => array( "chartjs", "post")
));
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <br>
            <div class="btn-group btn-group-justified" id="filters">
                <a class="btn btn-default" data-filter="*" ><?= __('Alls posts', 'web')?></a>
                <a class="btn btn-default" data-filter=".chartjs" ><?= __('chartjs', 'web')?></a>
                <!--<a class="btn btn-default" data-filter=".izv_teachers" ><?= __('Teachers', 'web')?></a>-->
                <a class="btn btn-default" data-filter=".post" ><?= __('Posts', 'web')?></a>
            </div>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?php
            // The Loop
            if ( $the_query->have_posts() ) {
            	?>
                <div class="portfolio text-center">
                    <?php
                	while ( $the_query->have_posts() ) {
                		$the_query->the_post();
                	    $post_ID = get_the_ID();
                	    $get_post_permalink = get_post_permalink($post_ID);
                		$get_the_post_thumbnail_url = get_the_post_thumbnail_url();
                		if (!$get_the_post_thumbnail_url) $get_the_post_thumbnail_url = get_template_directory_uri()."/assets/images/front-default.jpg";
                	    if(get_post_type() == "izv_teachers") $get_the_post_thumbnail_url = get_post_meta($post->ID,"teacher_image", true);
                		?>
                        <div class="panel-portfolio <?= get_post_type() ?>" style="background:url(<?= $get_the_post_thumbnail_url ?>);">
                            <div class="panel-portfolio-header">
                                <a class="small" href="<?= $get_post_permalink ?>"><?= get_the_title() ?></a>
                            </div>
                        </div>                
                		<?php
                	}
                    ?>
                </div>
                <br>
                <hr>
                <?php
                wp_reset_postdata();
            }
            ?>
        </div>
    </div>
    <script type="text/javascript">
        var $grid = $('.portfolio').isotope({
            itemSelector: '.panel-portfolio',
            layoutMode: 'fitRows',
            getSortData: {
                name: '.name',
            }
        });
        $('#filters > a').on( 'click', function() {
            var filterValue = $( this ).attr('data-filter');
            $grid.isotope({ filter: filterValue });
        });
    </script>
</div>


<?php
get_footer();
?>