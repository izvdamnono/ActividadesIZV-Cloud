<?php
$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
$email_author = $curauth->user_email;
$display_name_author = $curauth->display_name;
$first_name_author = $curauth->first_name;
$last_name_author = $curauth->last_name;
$get_avatar_url = get_avatar_url($email_author);
setlocale(LC_ALL,"es_ES");
$user_registered = new DateTime($curauth->user_registered);
$user_registered = $user_registered->format('j. m Y');
$roles = implode($curauth->roles, ", ");

?>
<div class="abt-1">
    <div class="alert alert-info"><?= $display_name_author ?></div>

    <img src="<?= $get_avatar_url ?>" class="img-responsive img-author" />
    <h5><strong><?= $first_name_author ?></strong></h5>
    <h5><strong><?= $last_name_author ?></strong></h5>

    <div class="text-left">
        <h5><?= __("Email",'web').': ' ?> <a href="mailto:<?= $email_author ?>"><?= $email_author ?></a></h5>
        <h5><?= $user_registered ?></h5>
        <h5><?= __("Rol", 'web').': '.$roles ?></h5>
        <blockquote class="small">
            <p><strong><?= __('Description','web').':' ?> </strong></p>
            <?= $curauth->description ?>
        </blockquote>
    
        <?php
        $progress_bar = array("info", "success", "warning", "danger");
        for ($i = 0; $i <= 3; $i++) { ?>
            
            <p class="small"><strong><?= get_the_author_meta("skill_" . $i . "_name", $curauth->ID) ?></strong></p>
            
            <div class="progress progress-striped active" style="height: 10px">
                <div class="progress-bar progress-bar-<?= $progress_bar[$i] ?>" style="width: <?= get_the_author_meta("skill_" . $i . "_value", $curauth->ID) ?>%; "></div>
            </div>
                
        <?php } ?>
    
    </div>
</div>