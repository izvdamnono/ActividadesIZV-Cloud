<?php
if (have_posts()) :
    the_post();
    ?>
    <article id="post-<?php the_ID(); ?>" class="blog-post" data-id="<?php the_ID(); ?>">
        <div class="blog-post-image">
            <?php the_post_thumbnail('large'); ?>
        </div>
        <div class="blog-post-body">
            <h2><a href="<?= get_the_permalink() ?>"><?php the_title(); ?></a></h2>
            <div class="post-meta">
                <span>by <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'), get_the_author_meta('user_nicename')); ?>"><?php the_author(); ?></a></span>/
                <span><i class="fa fa-clock-o"></i><a href="<?= get_day_link(get_the_time('Y'), get_the_time('m'), get_the_time('d')); ?>"><?php the_time('M j, Y'); ?></a></span>/
                <span><i class="fa fa-comment-o"></i> <a href="<?= get_comments_link() ?>"><?= get_comments_number() ?></a></span>
            </div>
            <?php the_excerpt(); ?>
            <div class="read-more"><a class="read-more" href="<?php the_permalink(); ?>"><?php _e('Read More →', 'ascent'); ?></a></div>
        </div>
    </article>
    <?php
else :
    ?>
    
    <?php
endif;
?>
