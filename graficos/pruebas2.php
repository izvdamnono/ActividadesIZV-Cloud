<!DOCTYPE html>
<html>
<head>
    <title>Leyenda de actividades</title>
    <script src="node_modules/chart.js/dist/Chart.bundle.js"></script>
    <script src="node_modules/chart.js/samples/utils.js"></script>
    <style>
        canvas {
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
        }
        .chart-container {
            width: 80%;
            height: 80%;
            margin: 0 auto;
            padding: 40px;
        }
        .container {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="chart-container">
            <canvas id="chart-legend-normal"></canvas>
        </div>
    </div>
    <?php 
        require_once('../clases/AutoLoad.php');
        $bootstrap = new Bootstrap();
        $gestor  = $bootstrap->getEntityManager();
        /*
        $qb = $gestor->createQueryBuilder();
        $qb->select('count(a.id)');
        $qb->from('Actividad','a');
        $qb->where("YEAR(a.fecha) = 2017");
        
        $count = $qb->getQuery();
        
        /*
        SELECT COUNT (a.id) 
        FROM Actividad a
        WHERE YEAR(a.fecha) = 2017
            AND MONTH(a.fecha) = 2
        https://github.com/beberlei/DoctrineExtensions
        */ 
        $year = (!empty($_REQUEST["year"]) and is_numeric($_REQUEST["year"])) ? $_REQUEST["year"] : 2017;
        $month = !empty($_REQUEST["month"]) ? $_REQUEST["month"] : 1;
    ?>
    
    <script>
        var color = Chart.helpers.color;
        function createConfig(colorName) {
            return {
                type: 'line',
                data: {
                    labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                    datasets: [{
                        label: "Actividades",
                        data: [
                            <?php
                                //Muy bestia pero funciona
                                $db = $gestor->getConnection();
                                for($i=1; $i<=12; $i++) {
                                    $sql = "
                                    SELECT COUNT(a.id) as total
                                    FROM actividad a
                                    WHERE YEAR(a.fecha) = ". $year ."
                                    AND MONTH(a.fecha) = $i
                                    ";
                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();        
                                    $count = $stmt->fetchAll()[0]["total"];
                                    echo $count.",";
                                }
                            ?>
                        ],
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
                                labelString: 'Mes'
                            }
                        }],
                        yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Valor'
                            }
                        }]
                    },
                    title: {
                        display: true,
                        text: 'Meses de actividades'
                    }
                }
            };
        }

        function createPointStyleConfig(colorName) {
            var config = createConfig(colorName);
            config.options.legend.labels.usePointStyle = true;
            config.options.title.text = 'Point Style Legend';
            return config;
        }

        window.onload = function() {
            [{
                id: 'chart-legend-normal',
                config: createConfig('red')
            }].forEach(function(json_controller) {
                var ctx = document.getElementById(json_controller.id).getContext('2d');
                new Chart(ctx, json_controller.config)
            })
        };
    </script>
</body>

</html>
