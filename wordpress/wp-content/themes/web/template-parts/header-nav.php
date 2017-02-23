<?php
$nav_menu_array = nav_menu_array();
$current_url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<!--start-header-->
<div class="header">
	<div class="container">
		<div class="head">
			<div class="navigation">
			 	<span class="menu"></span> 
				<ul class="navig">
					<?php
					foreach ($nav_menu_array as $nav_object) {
		                $active = ( $nav_object->url == $current_url) ? ' class="active" ' : '';
						?>
						<li><a href="<?=$nav_object->url?>" <?=$active?>><?=$nav_object->title?></a></li>
						<?php
					}
					?>
				</ul>	<!-- script-for-menu -->
			</div>
			<div class="header-right">
				<div class="search-bar">
					<?php get_search_form(); ?>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>	
<!-- header-end -->

<script>
	$("span.menu").click(function(){
		$(" ul.navig").slideToggle("slow" , function(){});
	});
</script>
<!-- script-for-menu -->