<?php
the_post();
$post = get_post();
$post_title = $post->post_title;
$get_the_category_array_object = get_the_category();
$category_array = array();
foreach ($get_the_category_array_object as $category_object) {
	$category_array[] = array(
		'name' => $category_object->name,	
		'permalink' => get_category_link($category_object->term_id),	
	);
}
$get_the_post_thumbnail_url =  get_the_post_thumbnail_url($post->ID);
$get_permalink_of_post = get_permalink($post->ID);
$the_content = $post->post_content;
$the_excerpt = the_excerpt_max_charlength($post->post_content, 300);
$get_the_time_link = get_day_link( $archive_year, $archive_month, $archive_day);
$get_the_time = get_the_time("j. M Y", $post->ID);
$get_author_posts_url = get_author_posts_url(get_the_author_meta('ID', $post->post_author)); 
$get_author_name = get_the_author_meta("first_name", $post->post_author);
$get_comments_number = get_comments_number( $post->ID );
$get_comments_link = get_comments_link( $post->ID );
?>

<article data-id="<?=$post->ID?>">
    <div class="single-top">
        <?php if (!empty($get_the_post_thumbnail_url)) { ?>
            <a href="<?= $get_permalink_of_post ?>"><img class="img-responsive" src="<?= $get_the_post_thumbnail_url ?>" alt="<?= $post_title ?>"></a>
        <?php } ?>
        <div class=" single-grid">
            <h4><?= $post_title ?></h4>
            <ul class="blog-ic">
                <li><a href="<?= $get_author_posts_url ?>"><span> <i class="glyphicon glyphicon-user"> </i><?= $get_author_name ?></span> </a></li>
                <li><span><i class="glyphicon glyphicon-time"> </i> <a href="<?= $get_the_time_link ?>"><?= $get_the_time ?></a> </span></li>
                <li><span><i class="glyphicon glyphicon-eye-open"> </i><a href="<?= $get_comments_link ?>"><?= __("Comments") ?>: <?= $get_comments_number ?></a></span></li>
            </ul>
            <div class="the_content">
                <?php the_content(); ?>
            </div>
            <?php wp_link_pages(array(
                'before'           => '<ul class="page-numbers"><li>',
                'after'            => '</li></ul>',
                'link_before'      => '',
                'link_after'       => '',
                'next_or_number'   => 'number',
                'separator'        => '</li><li>',
                'nextpagelink'     => __( 'Next page' ),
                'previouspagelink' => __( 'Previous page' ),
                'pagelink'         => '<span class="page-numbers current">%</span>',
                'echo'             => 1,
                
            )) ?>
            <br>
        </div>
        <?php comments_template(); ?>
    </div>
</article>