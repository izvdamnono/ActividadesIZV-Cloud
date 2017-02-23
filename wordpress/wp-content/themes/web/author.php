<?php
/**
 * Created by PhpStorm.
 * User: NonoDev96
 * Date: 19/1/17
 * Time: 20:11
 */
get_header();

get_template_part("template-parts/header", "nav");
$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
?>
<div class="about">
    <div class="container">
        <div class="about-main">
            <div class="row">
                <div class="col-md-8 about-left">
                    <div class="alert alert-info"><strong><?= __("Posts", 'web') ?></strong></div>  
                        <?php
                        $page = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        $args = array(
                            'post_type' => array('post', 'chartjs'), 
                            'posts_per_page' => 5,
                            'paged' => $page,
                            'author' => $curauth->ID,
                        );
                        $loop = new WP_Query($args);
                        if ($loop->have_posts()) {
                            ?>
                            <table class="table">
                            <tr>
                                <th><?= __('Date', 'web') ?></th>
                                <th><?= __('Post', 'web') ?></th>
                            </tr>
                                <?php
                                while ($loop->have_posts()) {
                                    $loop->the_post();
                                    ?>
                                    <tr>
                                        <td><?= get_the_date() ?></td>
                                        <td>
                                            <a href="<?= get_the_permalink() ?>"><?= get_the_title() ?></a><br>
                                            <?= the_excerpt_max_charlength(get_the_excerpt(), 120, true) ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </table>
                            <?php
                        } else {
                            ?>
                            <h3><?= __('No posts found','web').' '.$curauth->display_name ?></h3>
                            <?php
                        }
                        ?>
                </div>
                <div class="col-md-4 about-right heading">
                    <?php get_template_part("template-parts/sidebar", "author") ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();