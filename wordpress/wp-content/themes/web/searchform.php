<form role="search" method="get" class="searchform group" action="<?php echo home_url('/'); ?>">
    <input name="s" id="s" type="text" placeholder="<?= __("Search", 'web') ?>" value="<?= get_search_query();?>">
    <input type="submit" value="">
</form>