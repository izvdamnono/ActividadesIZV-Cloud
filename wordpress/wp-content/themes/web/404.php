<!DOCTYPE html>
<html>
    <head>
        <title>Recurso no encontrado</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="" />
        <link rel="stylesheet" type="text/css" href="<?=get_template_directory_uri()?>/assets/css/404.css">
    </head>
   <body>	
        <div class="background">
            
                <div class="container">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <h1>ERROR 404</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-6">
                            
                            <a href="<?= get_option('home')?>">
                                <img src="<?= get_template_directory_uri()?>/assets/images/404/astronauta404.png" class="floating img-responsive">
                            </a>
                                
                        </div> 
                        <div class="col-md-6">
                            <!-- Houston tenemos un problema parece que me he perdido -->
                            <h3><?= __("404", "web") ?></h3>
                        </div>
                    </div>
                </div>
        </div>
        
         
    <script src="<?= get_template_directory_uri() ?>/assets/js/jquery.min.js"></script>
	<script type="text/javascript">
        if($(window).width() > 991) {
    		$('.background').mousemove(function(e){
    		    
    			var x = -(e.pageX + this.offsetLeft) / 20;
    			var y = -(e.pageY + this.offsetTop) / 20;
    			$(this).css('background-position', x + 'px ' + y + 'px');
    		});
    	}
    </script>	
    
    </body>
</html>
