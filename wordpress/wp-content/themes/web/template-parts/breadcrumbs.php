<?php
$breadcrumbs = get_breadcrumbs();

?>
<ol class="breadcrumb">
    <?php
    $current_url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    foreach($breadcrumbs as $breadcrumb){
        $bread_permalink = $breadcrumb["permalink"];
        $bread_title = $breadcrumb["title"];
        $bread_page = $breadcrumb["page"];
        if ($bread_permalink == $current_url) {
            ?>
            <li rel="<?= $bread_page ?>" class="<?= $bread_class ?>"><?= $bread_title ?></li>
            <?php
        } else {
            ?>
            <li class="active"><a href="<?= $bread_permalink ?>"><?= $bread_title ?></a></li>
            <?php
        }
        ?>
        <?php
    }
    ?>
</ol>
