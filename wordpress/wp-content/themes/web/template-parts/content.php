<?php
	$post = get_post();
	$post_title = strip_tags( $post->post_title );
	$get_the_category_array_object = get_the_category();
	$category_array = array();
	foreach ($get_the_category_array_object as $category_object) {
		$category_array[] = array(
			'name' => $category_object->name,	
			'permalink' => get_category_link($category_object->term_id),	
		);
	}
	$get_the_post_thumbnail_url =  get_the_post_thumbnail_url($post->ID);
	$get_permalink_of_post = get_permalink($post->ID);
	$the_excerpt = strip_tags( the_excerpt_max_charlength($post->post_content, 300, false) );
	$get_the_time_link = get_day_link( $archive_year, $archive_month, $archive_day);
	$get_the_time = get_the_time("j. M Y", $post->ID);
	$get_author_posts_url = get_author_posts_url(get_the_author_meta('ID', $post->post_author)); 
	$get_author_name = get_the_author_meta("first_name", $post->post_author);
	$get_comments_number = get_comments_number( $post->ID );
	$get_comments_link = get_comments_link( $post->ID );
?>
<article data-id="<?=$post->ID?>">
	<header>
	    <div class="about-one">
	    	<?php if($category_array!=null) { ?>
		    	<p>
		    		<?php foreach ($category_array as $category) { ?>
						<a href="<?= $category["permalink"] ?>"><?= $category["name"] ?></a>
					<?php } ?>
		    	</p>
	    	<?php } ?>
	    	<h3><?= $post_title ?></h3>
	    </div>
	</header>
    <div class="about-two">
        <?php if ($get_the_post_thumbnail_url!="") { ?>
        	<a href="<?= $get_permalink_of_post ?>"><img src="<?= $get_the_post_thumbnail_url ?>" alt=""></a>
        <?php } ?>
    	<p><?= __("By") ?> <a href="<?= $get_author_posts_url ?>"><?=$get_author_name?></a> on <a href="<?= $get_the_time_link ?>"><?= $get_the_time ?></a> <a href="<?= $get_comments_link ?>"><?= __("comments", 'web') ?>(<?= $get_comments_number ?>)</a></p>
    	<p><?= $the_excerpt ?></p>
    	
    	
    	<div class="about-btn">
    		<a href="<?=$get_permalink_of_post?>"><?= __("Read more", "web") ?></a>
    	</div>
    </div>
</article>
<hr>