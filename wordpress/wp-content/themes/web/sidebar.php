<div class="abt-1">
	<h3><?= __('Tag Cloud', 'web'); ?></h3>
	<div>
		<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar Widgets')) { ?>
			<div class="abt-one">
				<p>Sorry, no widgets instaled for this theme. Go to the admin area and drag your widgets into the sidebar.</p>
			</div>
		<?php } ?>
	</div>
</div>
<div class="abt-2">
	<?php global $post;  ?>
	<?php if ($post->post_title == 'Actividades' ) : ?>
		<?php get_template_part('template-parts/search-activity'); ?>
	<?php endif;?>
	
	<h3><?= __("Featured Post", 'web') ?></h3>
	<?php 
		$args = array('posts_per_page' => 1,
					  'orderby' => 'comment_count');
					  
		$query = new WP_Query($args);			  
	?>
	<?php if ($query->have_posts()): ?>
		<?php while($query->have_posts()): $query->the_post(); ?>
		
			<?php
			
				$post_title = strip_tags( $post->post_title );
				$get_the_post_thumbnail_url =  get_the_post_thumbnail_url($post->ID);
				$get_permalink_of_post = get_permalink($post->ID);
				$the_excerpt_of_feature_post = strip_tags( the_excerpt_max_charlength($post->post_content, 300, false ) );
				$archive_year = get_the_time('Y', $post->ID); 
				$archive_month = get_the_time('m', $post->ID); 
				$archive_day = get_the_time('d', $post->ID);
				$get_day_link = get_day_link( $archive_year, $archive_month, $archive_day);
				$get_the_time = get_the_time("j. M Y", $post->ID);
				$get_author_posts_url = get_author_posts_url(get_the_author_meta('ID', $post->post_author)); 
				$get_author_name = get_the_author_meta("first_name", $post->post_author);
			?>
			<div class="abt-one">
				<h4><?= $post_title ?></h3>
				<?php  if ( $get_the_post_thumbnail_url != "" ):?>
					<img src="<?= $get_the_post_thumbnail_url ?>" alt="<?= $post_title ?>" class="img-responsive" />
				<?php endif; ?>
				<p><?= $the_excerpt_of_feature_post ?></p>
				<div class="a-btn">
					<a href="<?= $get_permalink_of_post ?>"><?=__("Read more", 'web')?></a>
				</div>
			</div>
		<?php endwhile;?>
		
		<?php wp_reset_postdata(); ?>
	<?php endif;?>
	
</div>
<?php do_action('before_sidebar'); ?>
<!--
<div class="abt-2">
	<h3><?=__("Search")?></h3>
	<div class="news">
		<form>
			<input type="text" placeholder="<?=__("Search")?>"/>
			<input type="submit" value="<?=__("Search")?>">
		</form>
	</div>
</div>
-->
<div class="abt-2">
	<h3><?=__("Recent Posts",'web')?></h3>
	<?php
    $recent_posts = wp_get_recent_posts(array('numberposts' => 3));
    $recent_posts_count =  count($recent_posts);
    $i = 1;
	foreach ( $recent_posts as $recent ) {
		$post = get_post($recent["ID"]);
		$post_title = strip_tags( $post->post_title );
		$get_the_post_thumbnail_url =  get_the_post_thumbnail_url($post->ID);
		if (!$get_the_post_thumbnail_url) $get_the_post_thumbnail_url = get_template_directory_uri()."/assets/images/front-default.jpg";
		$get_permalink_of_post = get_permalink($post->ID);
		$the_excerpt_of_sidebar = strip_tags( the_excerpt_max_charlength($post->post_content, 100) );
		$archive_year = get_the_time('Y', $post->ID); 
		$archive_month = get_the_time('m', $post->ID); 
		$archive_day = get_the_time('d', $post->ID);
		$get_day_link = get_day_link( $archive_year, $archive_month, $archive_day);
		$get_the_time = get_the_time("j. M Y", $post->ID);
		$get_author_posts_url = get_author_posts_url(get_the_author_meta('ID', $post->post_author)); 
		$get_author_name = get_the_author_meta("first_name", $post->post_author);
		?>
		<article data-id="<?=$post->ID?>">
			<div class="might-grid">
				
				<?php 
					$recent_post_less_img = "";
					if($get_the_post_thumbnail_url != "") {
					?>
					<div class="grid-might">
						<a href="<?= $get_permalink_of_post ?>">
							<div class="div-responsive sidebar" style="background-image:url(<?=$get_the_post_thumbnail_url?>)"></div>
							<!--<img src="<?= $get_the_post_thumbnail_url ?>" class="img-responsive" alt="<?= $post_title ?>"> </a>-->
					</div>
					<?php 
					} else {
					$recent_post_less_img = "recent-post-less-img";		
				} 
				?>
				<div class="might-top <?= $recent_post_less_img ?>">
					<h4><a href="<?= $get_permalink_of_post ?>"><?= $post_title ?></a></h4>
					<p>
						by <a href="<?= $get_author_posts_url ?>"><?= $get_author_name ?></a> / 
						<a href="<?= $get_day_link ?>"><?= $get_the_time ?></a>
						<br>
						<?= $the_excerpt_of_sidebar ?>
					</p> 
				</div>
				<div class="clearfix"></div>
				<?php if ($recent_posts_count != $i ) { ?> <hr> <?php } ?>
			</div>	
		</article>
		<?php
		$i++;
	}
	?>
</div>
<div class="abt-2">
	<h3><?= __('Categories', 'web'); ?></h3>
	<ul class="categories">
		<?php wp_list_categories(array('title_li' => '')); ?>
	</ul>	
</div>
<div class="abt-2">
	<h3><?= __("Archives", 'web') ?></h3>
	<ul class="archives">
	<?php wp_get_archives(); ?>
	</ul>
</div>
<div class="abt-2">
	<h3><?=__("Author", 'web')?></h3>
	<ul class="author">
		<?php wp_list_authors(); ?>
	</ul>
</div>
<div class="abt-2">
	<h3><?=__("Pages", 'web')?></h3>
	<ul class="pages">
		<?php wp_list_pages(array('title_li' => '')); ?>
	</ul>
</div>
<div class="abt-2">
	<h3><?=__("Social media", 'web')?></h3>
	<ul class="social-media">
		<?php
		$social_media = array(
			"facebook", 
			"twitter", 
			"instagram", 
			"google"
			);
		foreach ($social_media as $media) {
			?>
			<li>
				<a class="btn btn-social-icon btn-<?= $media ?>">
					<span class="fa fa-<?= $media ?>"></span>
				</a>
				<!--<span class="fa fa-<?= $media ?>"></span><a href="#"> <?= $media ?> </a></li>-->
			<?php
		}
		?>
	</ul>
</div>
<div class="abt-2">
	<h3><?= __('Meta', 'web'); ?></h3>
    <ul>
        <?php wp_register(); ?>
        <li><?php wp_loginout(); ?></li>
        <?php wp_meta(); ?>
    </ul>
</div>

