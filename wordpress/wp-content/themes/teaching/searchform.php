<form role="search" method="get" id="searchform" action="<?php echo home_url('/'); ?>">
    <div class="input-group">
        <input type="text" class="form-control" id="s" name="s" placeholder="<?php _e('Search'); ?>" value="<?= get_search_query() ?>"/>
            <span class="input-group-btn">
                <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-search"></i> <?php _e('Search'); ?></button>
            </span>
    </div>
</form>