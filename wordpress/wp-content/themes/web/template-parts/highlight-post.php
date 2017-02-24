<div class="highlight-post">
    <div class="row">
        <?php
        $args = array(
            'post_type' => array('post'), 
            'posts_per_page' => 1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'post_format',
                    'field' => 'slug',
                    'terms' => array(
                        'post-format-gallery',
                        'post-format-link',
                        'post-format-image',
                        'post-format-quote',
                        'post-format-audio',
                        'post-format-video'
                    ),
                    'operator' => 'NOT IN'
                )
            )
        );
        $loop = new WP_Query($args);
        ?>
        
        <?php if ( $loop->have_posts() ): ?>
            <?php while ( $loop->have_posts() ): ?>
                <?php $loop->the_post(); ?>
                <?php
                $catid = wp_get_post_categories($post->ID, array('fields' => 'ids'));
                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full')[0];
                if (!$thumb) $thumb = get_template_directory_uri()."/assets/images/front-default.jpg";
                $idDestacado = $post->ID;
                ?>
           
           <div class="div-responsive highlight-image" style="background-image: url(<?= $thumb ?>)"></div>
           
           <div class="firstPost">
                <div class="col-md-2 col-xs-12 wow animated fadeInLeft" data-wow-duration="1s">
                    <time class="icon">
                        <em><?= get_the_time('Y') ?></em>
                        <strong><?= get_the_time('F') ?></strong>
                        <span><?= get_the_time('j')?></span>
                    </time>
                </div>

                <div class="col-md-10 col-xs-12 wow animated bounceInRight" data-wow-duration="1s">

                    <h3> <?php the_title(); ?> </h3>    

                    <ul class="list-inline blogInfo">
                        <li>
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <!--<a href="#"><?php //the_author(); ?></a>-->
                            <?php esc_url(the_author_posts_link());?>
                        </li>
                        <li>
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <a href="<?php
                                $anio  = get_the_time('Y');
                                $mes   = get_the_time('F');
                                $dia   = get_the_time('j');
                                echo get_day_link( $anio, $mes, $dia );?>"><?= get_the_time('j. M Y');?> </a>
                        </li>

                        <li>
                            <i class="fa fa-tags" aria-hidden="true"></i>
                            <?php the_tags();?>
                        </li>
                        <li>
                            <i class="fa fa-comments" aria-hidden="true"></i>
                            <?php echo comments_number('Sin comentarios', '1 comentario', '% comentarios'); ?>
                        </li>

                    </ul>
                    <div class="about-two"><?php the_excerpt();?></div>
                	<div class="about-btn highlight-btn">
                		<a href="<?= get_permalink() ?>"><?= __("Read more", "web") ?></a>
                	</div>		
				</div>
            </div>
        </div>
           
        <?php endwhile; ?>    
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
</div>