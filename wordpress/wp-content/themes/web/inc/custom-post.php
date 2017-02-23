<?php
/**
 * Custom post de chart js
 * Pendiente de hacer los custom post de portfolio.
 * Created by PhpStorm.
 * User: dam
 * Date: 3/2/17
 * Time: 12:31
 */

function reg_post_type_chartjs() {
    $supports = array(
        'title',
        'editor',
        'author',
        'thumbnail',
        'excerpt',
        'comments',
        'custom-fields',
        'comments',
        'revisions',
        'post-formats',
    );

    $labels = array(
        'name' => _x('chartjss', 'plural'),
        'singular_name' => _x('chartjs', 'singular'),
        'menu_name' => _x('chartjss', 'admin menu'),
        'name_admin_bar' => _x('chartjs', 'admin bar'),
        'add_new' => _x('Add New', 'add new chartjs'),
        //
        'add_new_item' => __('Add New chartjs'),
        'new_item' => __('New chartjs'),
        'edit_item' => __('Edit chartjs'),
        'view_item' => __('View chartjs'),
        'all_items' => __('All chartjss'),
        'search_items' => __('Search chartjss'),
        'parent_item_colon' => __('Parent chartjss:'),
        'not_found' => __('No chartjss found.'),
        'not_found_in_trash' => __('No chartjss found in Trash.')
    );

    $args = array(
        'labels' => $labels,
        'supports' => $supports,
        'public' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'chartjs'),
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 5,

    );

    register_post_type('chartjs', $args);
}

add_action('init', 'reg_post_type_chartjs');

function chartjs_meta_box_callback($post) {
    wp_nonce_field("chartjs_save_meta_box_data", "chartjs_meta_box_nonce");
    $value1 = get_post_meta($post->id, "chartjs_name", true);
    $value2 = get_post_meta($post->id, "chartjs_price", true);
    $value3 = get_post_meta($post->id, "chartjs_from", true);
    $value4 = get_post_meta($post->id, "chartjs_type", true);
    ?>
    <label for="chartjs_name"><?php _e("Name", "chartjs_textdomain"); ?></label>
    <input type="text" id="chartjs_name" name="chartjs_name" value="<?= esc_attr($value1) ?>">

    <label for="chartjs_price"><?php _e("Price", "chartjs_textdomain"); ?></label>
    <input type="text" id="chartjs_price" name="chartjs_price" value="<?= esc_attr($value2) ?>">

    <label for="chartjs_from"><?php _e("From", "chartjs_textdomain"); ?></label>
    <input type="text" id="chartjs_from" name="chartjs_from" value="<?= esc_attr($value3) ?>">

    <label for="chartjs_type"><?php _e("Type", "chartjs_textdomain"); ?></label>
    <input type="text" id="chartjs_type" name="chartjs_type" value="<?= esc_attr($value4) ?>">
    <?php
}

function chartjs_add_meta_box() {
    $screens = array('chartjs');
    foreach ($screens as $screen) {
        add_meta_box(
            "chartjs_sectionid",
            __("chartjs details", "chartjs_textdomain"),
            "chartjs_meta_box_callback",
            $screen,
            "normal"
        );
    }
}

add_action("add_meta_boxes", "chartjs_add_meta_box");