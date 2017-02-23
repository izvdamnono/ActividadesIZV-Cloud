<?php
$get_comments = get_comments(array(
   'post_id'=> $post->ID
));
?>

<?php if ( count($get_comments) > 0 ) : ?>
    <div class="comments heading" id="comments">
        <h3><?= __("Comments", 'web') ?></h3>
        <?php
        foreach ($get_comments as $comment) {
            $comment_author = $comment->comment_author;
            $comment_content = $comment->comment_content;
            $comment_author_email = $comment->comment_author_email;
            $get_author_posts_url = get_author_posts_url($comment->user_id);
            $get_avatar = get_avatar_url($comment_author_email);
            $comment_date = new DateTime($comment->comment_date);
            $comment_datetime = $comment_date->format('Y-m-d h:m');
            $comment_date_ymd = $comment_date->format('Y-m-d');
            $comment_date_hms = $comment_date->format('H:s');
            if ($comment->comment_approved) {
                ?>
                <div class="media">
                    <div class="media-body">
                        <h4 class="media-heading"> <?= $comment_author ?></h4>
                        <p><?= $comment_content ?> </p>
                    </div>
                    <div class="media-right">
                        <a href="<?= $get_author_posts_url ?>"><img src="<?= $get_avatar ?>" alt=""> </a>
                        <time datetime="<?= $comment_datetime ?>"><?= $comment_date_ymd ?><br><?= $comment_date_hms ?></time>
                    </div>
                </div>
            <?php
            }
        }
        ?>
        
        
    </div>
<?php endif; ?>
<div class="comment-bottom heading">
    <?php comment_form() ?>
</div>