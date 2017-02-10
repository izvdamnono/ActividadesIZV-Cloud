<?php
if (have_posts()) :
    while (have_posts()) :
        the_post();
        ?>
        <div class="box" id="post-<?php the_ID(); ?>" <?php post_class(); ?>
             data-id="<?php the_ID(); ?>">
            <div class="post-header">
                <p class="small">
                    <span class="author">Autor:
                        <a href="<?= get_author_posts_url(get_the_author_meta('ID'), get_the_author_meta('user_nicename')); ?>">
                            <?php the_author(); ?>
                        </a>
                    </span><br>
                    <span class="date">Fecha:
                        <a href="<?= get_day_link(get_the_time('Y'), get_the_time('m'), get_the_time('d')); ?>"><?php the_time('j. M. Y'); ?></a>
                    </span>
                </p>
                <h3>
                    <?= get_post_format_spam(); ?>
                    <a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
                        <?= get_the_title(); ?>
                    </a>
                </h3>
            </div>
            <hr>

            <div class="entry clear">
                <?php if (function_exists('add_theme_support')) the_post_thumbnail('post-thumbnail', ['class' => 'img-responsive']); ?>
                <?php
                the_content();
                ?>
            </div>

            <hr>
            <div class="post-footer">
                <div class="categories">Categorias: <?php the_category(' &gt; '); ?></div>
                <div class="comments">
                    <?php comments_popup_link('Deja un comentario ', '1 Comentario', '% Comentario'); ?>
                </div>
                <div class="tags"><?php the_tags('Tags: ', ', '); ?></div>
                <?php edit_post_link(); ?>
                <?php wp_link_pages(); ?>
                <?php

                ?>
            </div>
        </div>
        <?php
    endwhile;
else :
    ?>

    <?php
endif;
?>
