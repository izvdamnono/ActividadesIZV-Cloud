<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Chart.js Demo</title>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
</head>
<body>

  <canvas id="piechart" width="400" height="400"></canvas>
  
  <?php
    $data = array(
        array(
            'value' => 300,
            'color' => '#F7464A',
            'highlight' => '#FF5A5F',
            'label' => 'hola1',
        ),  
        array(
            'value' => 200,
            'color' => '#2196ff',
            'highlight' => '#21a6f3',
            'label' => 'hola2',
        ),    
    );
  ?>
  
  <script type="text/javascript">
    // Get the context of the canvas element we want to select
    var ctx = document.getElementById("piechart").getContext("2d");
    var data = [
    <?php
        foreach($data as $key => $value):
    ?>
    
    {
        value: "<?= $value["value"] ?>",
        color: "<?= $value["color"] ?>",
        highlight: "<?= $value["highlight"] ?>",
        label: "<?= $value["label"] ?>"
    },
   
    <?php
        endforeach;
    ?>
    
    ];
    
    var options = {
      animateScale: true
    };

    var myNewChart = new Chart(ctx).Pie(data,options);

  </script>
</body>
</html>