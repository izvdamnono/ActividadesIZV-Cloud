<?php
the_post();
$teacher_name = get_post_meta($post->ID, "teacher_name", true);
$teacher_departament = get_post_meta($post->ID, "teacher_departament", true);
$teacher_image = get_post_meta($post->ID, "teacher_image", true);
?>

<article data-id="<?=$post->ID?>">
    <div class="single-top">
        <div class="single-grid">
            <div class="row">
                <div class="col-lg-6">
                    <?php if (!empty($teacher_image)) { ?>
                        <a href="<?= $get_permalink_of_post ?>"><img class="img-responsive" src="<?= $teacher_image ?>" alt="<?= $teacher_name ?>"></a>
                    <?php } ?>
                </div>
                <div class="col-lg-6">
                    <h2><?= $teacher_name ?></h2>
                    <h3><?= $teacher_departament ?></h3>
                </div>
            </div>
            <hr>
            <div class="the_content">
                <?php the_content(); ?>
            </div>
        </div>
        <?php comments_template(); ?>
    </div>
</article>