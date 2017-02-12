<?php

function get_post_format_spam() {
    $ret = "";
    switch (get_post_format()) {
        case 'quote':
            $ret = '<i class="fa fa-quote-left"></i>';
            break;
        case'video':
            $ret = '<i class="fa fa-video-camera"></i>';
            break;
        case 'gallery':
            $ret = '<i class="fa fa-picture-o"></i>';
            break;
        case'audio':
            $ret = '<i class="fa fa-music" ></i>';
            break;
        case 'aside':
            $ret = '<i class="fa fa-align-left"></i>';
            break;
        case 'link';
            $ret = '<i class="fa fa-link"></i>';
            break;
        default:
            $ret = '<span class="glyphicon glyphicon-align-left"></span>';
            break;
    }
    return $ret;
}

function do_something_cool() {
    
    global $wpdb;
    
    $query = "select * from (select * from ( select * from actividad where DATE_FORMAT(fecha, '%Y-%m-%d') >= DATE_FORMAT(now(), '%Y-%m-%d' ) order by fecha asc, hini asc) a1 union all select * from ( select * from actividad where DATE_FORMAT(fecha, '%Y-%m-%d') < DATE_FORMAT(now(), '%Y-%m-%d' ) order by fecha desc) a2) q";
    $results = $wpdb->get_results($query);

    var_dump($results);
}
   


require_once ("functions/hooks.php");