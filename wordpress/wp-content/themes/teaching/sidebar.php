<?php
/**
 * Created by PhpStorm.
 * User: NonoDev96
 * Date: 3/12/16
 * Time: 11:10
 */
?>

<div id="primary" class="sidebar">
    <?php do_action('before_sidebar'); ?>
    <?php if (!dynamic_sidebar('sidebar-primary')) : ?>

        <form role="search" method="get" id="searchform" action="<?php echo home_url('/'); ?>">
            <div class="input-group">
                <input type="text" class="form-control" id="s" name="s" placeholder="<?php _e('Search'); ?>" value="<?= get_search_query() ?>"/>
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-search"></i> <?php _e('Search'); ?></button>
                </span>
            </div>
        </form>
        <h2 class="widget-title"><?php _e('Tags cloud', 'shape'); ?></h2>
        <div class="widgets">
            <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar Widgets')) { ?>
                <!--<div class="warning">Sorry, no widgets instaled for this theme. Go to the admin area and drag your widgets into the sidebar.</div>-->
            <?php } ?>
        </div>

        <h2 class="widget-title"><?php _e('Last Entries', 'shape'); ?></h2>
        <ul>
            <?php
            wp_get_archives(
                array(
                    'type' => 'postbypost',
                    'limit' => '5',
                    'post_type' => 'post'
                )
            );
            ?>
        </ul>

    
        <h2 class="widget-title"><?php _e('Categories', 'shape'); ?></h2>
        <ul>
            <?php wp_list_categories(
                array(
                    'orderby' => 'id',
                    'show_count' => true,
                    'title_li' => ''
                )
            );
            ?>
        </ul>

        <?php
            if(count_users()["total_users"] > 0) {
        ?>
            <h2 class="widget-title"><?php _e('Author'); ?></h2>
            <ul>
            <?php
            wp_list_authors(array(
                'show_fullname' => true,
                'optioncount' => true,
                'orderby' => 'post_count',
                'order' => 'DESC',
                'number' => 3
            ));
            ?>
            </ul>
        <?php
            }
        ?>

        <h2 class="widget-title"><?php _e('Archives'); ?></h2>
        <ul>
            <?php
            wp_get_archives(
                array(
                    "show_post_count" => 1
                )
            );
            ?>
        </ul>

        <h2 class="widget-title"><?php _e('Pages'); ?></h2>
        <ul>
            <?php
            wp_list_pages(
                array(
                    'orderby' => 'menu_order',
                    'title_li' => ''
                )
            );
            ?>
        </ul>
        <h2 class="widget-title"><?php _e('Meta'); ?></h2>
        <ul>
            <?php wp_register(); ?>
            <li><?php wp_loginout(); ?></li>
            <?php wp_meta(); ?>
        </ul>
    <?php endif; ?>
</div>

