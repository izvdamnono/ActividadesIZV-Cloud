<?php
/**
 * Created by PhpStorm.
 * User: NonoDev96
 * Date: 12/02/17
 * Time: 17:49
 */
function wp_get_menu_array() {
    $array_menu = wp_get_nav_menu_items();
    $menu = array();
    foreach ($array_menu as $m) {
        if (empty($m->menu_item_parent)) {
            $menu[$m->ID] = array();
            $menu[$m->ID]['ID'] = $m->ID;
            $menu[$m->ID]['title'] = $m->title;
            $menu[$m->ID]['url'] = $m->url;
            $menu[$m->ID]['children'] = array();
        }
    }

    $submenu = array();
    foreach ($array_menu as $m) {
        if ($m->menu_item_parent) {
            $submenu[$m->ID] = array();
            $submenu[$m->ID]['ID'] = $m->ID;
            $submenu[$m->ID]['title'] = $m->title;
            $submenu[$m->ID]['url'] = $m->url;
            $menu[$m->menu_item_parent]['children'][$m->ID] = $submenu[$m->ID];
        }
    }


    return $menu;

}


/**
 * Falta adaptarla a nuestro tema
 */ 
function create_bootstrap_menu($theme_location = "primary") {
    global $social_networks;
    $curauth = get_userdata(1);
    if (($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location])) {

        $menu_list = '<header>' . "\n";
        $menu_list .= '<nav class="navbar navbar-inverse navbar-fixed-top">' . "\n";

        $menu_list .= '<div class="container">' . "\n";
        $menu_list .= '<div class="navbar-header">' . "\n";
        $menu_list .= '<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">' . "\n";
        $menu_list .= '<span class="sr-only">Toggle navigation</span>' . "\n";
        $menu_list .= '<span class="icon-bar"></span>' . "\n";
        $menu_list .= '<span class="icon-bar"></span>' . "\n";
        $menu_list .= '<span class="icon-bar"></span>' . "\n";
        $menu_list .= '</button>' . "\n";
        $menu_list .= '<a class="navbar-brand" href="' . home_url() . '">' . bloginfo() . '</a>';
        $menu_list .= '</div>' . "\n";

        $menu_list .= '<!-- Collect the nav links, forms, and other content for toggling -->';


        $menu = get_term($locations[$theme_location], 'nav_menu');
        $menu_items = wp_get_nav_menu_items($menu->term_id);

        $menu_list .= '<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">' . "\n";
        $menu_list .= '<ul class="nav navbar-nav">' . "\n";

        foreach ($menu_items as $menu_item) {
            if ($menu_item->menu_item_parent == 0) {

                $parent = $menu_item->ID;
                $bool = false;
                $menu_array = array();
                foreach ($menu_items as $submenu) {
                    if ($submenu->menu_item_parent == $parent) {
                        $bool = true;
                        $menu_array[] = '<li><a href="' . $submenu->url . '">' . $submenu->title . '</a></li>' . "\n";
                    }
                }
                if ($bool == true && count($menu_array) > 0) {

                    $menu_list .= '<li class="dropdown">' . "\n";
                    $menu_list .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">' . $menu_item->title . ' <span class="caret"></span></a>' . "\n";

                    $menu_list .= '<ul class="dropdown-menu">' . "\n";
                    $menu_list .= implode("\n", $menu_array);
                    $menu_list .= '</ul>' . "\n";

                } else {

                    $menu_list .= '<li>' . "\n";
                    $menu_list .= '<a href="' . $menu_item->url . '">' . $menu_item->title . '</a>' . "\n";
                }

            }

            // end <li>
            $menu_list .= '</li>' . "\n";
        }

        $menu_list .= '</ul>' . "\n";
        $menu_list .= '<ul class="nav navbar-nav navbar-right">';
        foreach ($social_networks as $meta) {
            $value = get_the_author_meta($meta, $curauth->ID);
            if (!empty($value)) {
                $menu_list .= '<li><a href="' . $value . '"><i class="fa fa-' . $meta . '"></i></a></li>' . "\n";
            }
        }
        $menu_list .= '</ul >' . "\n";
        $menu_list .= '</div>' . "\n";
        $menu_list .= '</div><!-- /.container-fluid -->' . "\n";
        $menu_list .= '</nav>' . "\n";
        $menu_list .= '</header>' . "\n";

    } else {
        $menu_list = '<!-- no menu defined in location "' . $theme_location . '" -->';
    }

    return $menu_list;
}


function nav_menu_array($theme_location = "primary") {
    if (($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location])) {
        $menu_list = array();
        
        $menu = get_term($locations[$theme_location], 'nav_menu');
        $menu_items = wp_get_nav_menu_items($menu->term_id);
        
        $menu_list = $menu_items;
        
        return $menu_list;
    }
    return null;
}


function create_bootstrap_menu_teaching($theme_location = "primary") {
    if (($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location])) {
        $name_site = get_bloginfo('name');
        $count_name_site = count($name_site);
        $name_site_first_letter = substr($name_site, 0, 1);
        $name_site_less_first_letter = substr($name_site, 1 );
        $menu_list = '
<div class="header">
    <div class="container">
        <nav class="navbar navbar-default">
            <div class="navbar-header navbar-left">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            <h1><a class="navbar-brand" href="' . home_url() . '"><span>'.$name_site_first_letter.'</span>'.$name_site_less_first_letter.'</a></h1>
            </div>';


        $menu = get_term($locations[$theme_location], 'nav_menu');
        $menu_items = wp_get_nav_menu_items($menu->term_id);

        $menu_list .= '
            <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
                <nav class="menu menu--shylock">
                    <div class="agileinfo_social_icons">
                        <ul class="agileinfo_social_icons1">
                            <li><a href="#" class="facebook"></a></li>
                            <li><a href="#" class="twitter"></a></li>
                            <li><a href="#" class="google"></a></li>
                            <li><a href="#" class="pinterest"></a></li>
                        </ul>
                    </div>
                    <ul class="nav navbar-nav">';


        foreach ($menu_items as $menu_item) {
            if ($menu_item->menu_item_parent == 0) {
                $parent = $menu_item->ID;
                $bool = false;
                $menu_array = array();
                /**
                 * Con wp 
                 */ 
                $current_url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                // $current_url = home_url(add_query_arg(array(),$wp->request))."/";   
                
                $active = ( $menu_item->url == $current_url) ? ' class="active" ' : '';
                        
                foreach ($menu_items as $submenu) {
                    if ($submenu->menu_item_parent == $parent) {
                        $bool = true;
                        $menu_array[] = '
                        <li '. $active .'><a class="hvr-bounce-to-bottom" href="' . $submenu->url . '">' . $submenu->title . '</a></li>
                        ';
                    }
                }
                if ($bool == true && count($menu_array) > 0) {

                    $menu_list .= '
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">' . $menu_item->title . ' <span class="caret"></span></a>
                        <ul class="dropdown-menu">';
                    $menu_list .= implode("\n", $menu_array);
                    $menu_list .= '
                        </ul>
                    </li>
                    ';
                    
                } else {
                    $menu_list .= '
                    <li ' . $active . ' ><a class="hvr-bounce-to-bottom" href="' . $menu_item->url . '">' . $menu_item->title . '</a></li>
                    ';
                }

            }

            // end <li>
        }

        $menu_list .= '
                    </ul>
    		        <div class="clearfix"> </div>
    		    </nav>
			</div>
		</nav>	
	</div>
</div>';

    } else {
        $menu_list = '<!-- no menu defined in location "' . $theme_location . '" -->';
    }

    return $menu_list;
}

?>
