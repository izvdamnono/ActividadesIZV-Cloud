
<script>
    function createPointStyleConfig(colorName) {
        var config = createConfig(colorName);
        config.options.legend.labels.usePointStyle = true;
        config.options.title.text = 'Point Style Legend';
        return config;
    }

    window.onload = function() {
        chartjs_custom_post_var.forEach(function(json_controller) {
            var ctx = document.getElementById(json_controller.id).getContext('2d');
            new Chart(ctx, json_controller.config)
        })
    };
</script>
