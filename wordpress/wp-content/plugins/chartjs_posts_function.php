<?php
/**
 * Chart js shortcode
 *
 * @package     PluginPackage
 * @author      Antonio Mudarra Machuca
 * @copyright   2016 Antonio Mudarra Machuca
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: Chart js shortcode
 * Plugin URI:  https://example.com/plugin-name
 * Description: Chart js shortcode. Muestra los ultimos post con el shortcode [chartjs-post num_posts=”5″]Most Chart js [/chartjs-post]
 * Version:     1.0.0
 * Author:      Antonio Mudarra Machuca
 * Author URI:  https://example.com
 * Text Domain: notebook social media
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * Date: 12/2/17
 * Time: 22:40
 */

function chart_js_function($atts, $content) {
    $return_data = "";
    $data = array();
    extract(shortcode_atts(array(
        'data' => '',
        'string_top' => '',
        'string_right' => '',
        'string_bottom' => '',
        'string_left' => '',
    ), $atts));
    $data = json_decode($data);
    // $return_data .= print_r($data,true);
    // $return_data .= print_r($content,true);
    $uniqid  = uniqid();
    $return_data .= '
    <div class="chart-container">
        <canvas id="'.$uniqid.'"></canvas>
    </div>
    <script>
     var color = Chart.helpers.color;
        function createConfig(colorName) {
            return {
                type: "line",
                data: {
                    labels: [
                        ';
    foreach($data as $key=>$value){
        $return_data .= "'".$key."',";
    }
    $return_data .= "
                    ],
                    datasets: [{
                        label: '".$content."',
                        data: [";
    foreach($data as $key=>$value){
        $return_data .= "'".$value."',";
    }                        
    $return_data .= "   ],
                        backgroundColor: color(window.chartColors[colorName]).alpha(0.5).rgbString(),
                        borderColor: window.chartColors[colorName],
                        borderWidth: 1,
                        pointStyle: 'rectRot',
                        pointRadius: 5,
                        pointBorderColor: 'rgb(0, 0, 0)'
                    }]
                },
                options: {
                    responsive: true,
                    legend: {
                        labels: {
                            usePointStyle: false
                        }
                    },
                    scales: {
                        xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: '".$string_bottom."'
                            }
                        }],
                        yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: '".$string_left."'
                            }
                        }]
                    },
                    title: {
                        display: true,
                        text: '".$content."'
                    }
                }
            };
        }
        ";
    $return_data .= "
        
            chartjs_custom_post_var.push({
                id: '".$uniqid."',
                config: createConfig('blue')
            });
    </script>";
    
    
    return $return_data;
}

function register_chartjs_shortcode() {
    add_shortcode("chartjs-post", "chart_js_function");
}

add_action("init", "register_chartjs_shortcode");