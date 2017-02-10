<?php

    global $wpdb;
    
    $results = $wpdb->get_results("select * from ( select * from actividad where DATE_FORMAT(fecha, '%Y-%m-%d') >= DATE_FORMAT(now(), '%Y-%m-%d' ) order by fecha asc, hini asc) a1 union all select * from ( select * from actividad where DATE_FORMAT(fecha, '%Y-%m-%d') < DATE_FORMAT(now(), '%Y-%m-%d' ) order by fecha desc) a2");

    var_dump($results);
?>