<?php
/*
 * Template Name: blog teaching
 */
get_header();
get_template_part('template-parts/banner');
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <?php do_something_cool(); ?>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">


        <?php get_template_part('template-parts/the_loop'); ?>

        </div>
        <div class="col-lg-4">
            <div class="box">

                <?php get_sidebar() ?>

            </div>
        </div>
    </div>
</div>
<?php 
get_footer(); 
?>
