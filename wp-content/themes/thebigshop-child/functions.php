<?php

function thebigshop_child_scripts() {
wp_enqueue_style('thebigshop-parent-style', get_parent_theme_file_uri('style.css'));
}

add_action('wp_enqueue_scripts', 'thebigshop_child_scripts',20);


add_filter('subcategory_archive_thumbnail_size','customize_subcategory_archive_thumbnail_size');
function customize_subcategory_archive_thumbnail_size()
{
 return 'thebigshop_featured_image';
}