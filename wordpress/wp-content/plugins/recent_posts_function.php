<?php
/**
 * Recent post shortcode
 *
 * @package     PluginPackage
 * @author      Antonio Mudarra Machuca
 * @copyright   2016 Antonio Mudarra Machuca
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: Recent post shortcode
 * Plugin URI:  https://example.com/plugin-name
 * Description: Recent post shortcode. Muestra los ultimos post con el shortcode [recent-post num_posts=”5″]Most recent post [/recent-post]
 * Version:     1.0.0
 * Author:      Antonio Mudarra Machuca
 * Author URI:  https://example.com
 * Text Domain: notebook social media
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * Date: 8/2/17
 * Time: 13:09
 */

function recent_posts_function($atts, $content) {
    $num_posts = 1;
    extract(shortcode_atts(array(
        'num_posts' => 1,
    ), $atts));
    $return_string = "<h3>" . $content . "</h3>";
    $return_string .= "<ul>";
    query_posts(array(
        'order_by' => 'date',
        'order' => 'DESC',
        'showposts' => $num_posts
    ));
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            $return_string .= "<li><a href='" . get_permalink() . "'>" . get_the_title() . "</a></li>";
        }
    }
    $return_string .= "</ul>";

    wp_reset_query();
    return $return_string;
}

function register_shortcode() {
    add_shortcode("recent-post", "recent_posts_function");
}

add_action("init", "register_shortcode");