
<article id="post-<?php the_ID(); ?>" class="blog-post" data-id="<?php the_ID(); ?>">
    <div class="blog-post-image">
        <?php the_post_thumbnail('large'); ?>
    </div>
    <div class="blog-post-body">
        <h2><a href="<?= get_the_permalink() ?>"><?php the_title(); ?></a></h2>
        <?php the_content(); ?>
    </div>
<hr>
<p>
<a class="read-more" href="<?php the_permalink(); ?>"><?php _e('Read More', 'ascent'); ?></a>
</p>
</article>

