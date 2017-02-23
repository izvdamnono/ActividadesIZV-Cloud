<?php

get_header();
/**
 * Menu que genera un header menu nav segun como lo tengas configurado en el 
 * Back end del wordpress
 * 
 */ 
 
echo create_bootstrap_menu_teaching();
get_template_part('template-parts/banner');
?>

<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <article class="post_single">
                <header class="text-center">
                    <?php the_post();?>
                    <h2><?=get_the_title()?></h2><br>
                    <span class="glyphicon glyphicon-user"></span>
                    <a href="<?= get_author_posts_url(get_the_author_meta('ID'), get_the_author_meta('user_nicename')) ?>"><?= get_the_author(); ?></a> / 
                    <span class="glyphicon glyphicon-time"></span> 
                    <a href="<?= get_day_link(get_the_time('Y'), get_the_time('m'), get_the_time('d')); ?>"><?php the_time('M j, Y'); ?></a> / 
                    <span class="glyphicon glyphicon-comment"></span>
                    <a href="<?= get_comments_link() ?>"><?= get_comments_number('') ?></a>
                </header>
                <hr>
                <?php
                    the_content();
                ?>
                <hr>
                <footer>
                    <p>Categorias: 
                    <?php
                    $categories = get_the_category();
                    $categories_count = count($categories);
                    $i=1;
                    foreach ($categories as $categorie) {
                        echo "<a href='".get_category_link($categorie->term_id)."'>".$categorie->name."</a>";
                        if($categories_count != $i ){
                            echo ", ";
                        }
                        $i++;
                    }
                    ?>
                    </p>
                    <p><?= get_the_tag_list('<p>Tags: ',', ','</p>'); ?></p>
                    <div>
                        <?php comments_popup_link('Deja un comentario ', '1 Comentario', '% Comentario'); ?>
                    </div>
                    <p><php the_tags('Tags: ', ', '); ?></p>
                    <?php edit_post_link(); ?>
                    <?php wp_link_pages(); ?>
                </footer>
            </article>
                    
        
      
        </div>
        <div class="col-lg-4">
            <div class="well">
                <?php get_sidebar() ?>
            </div>
        </div>
    </div>
</div>
<?php 
get_footer(); 

//require_once "template-parts/portfolio.php";
?>
s