 <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">                              
    <div class="input-group btn-block">
        <input id="search" type="text" name="s" value="<?php the_search_query(); ?>" placeholder="<?php echo esc_attr_x('Search &hellip;', 'placeholder', 'thebigshop'); ?>" class="form-control input-lg" />
  <span class="input-group-btn"><button type="submit" class="button-search btn btn btn-primary"><i class="fa fa-search"></i></button></span>
    </div>                     
</form>  