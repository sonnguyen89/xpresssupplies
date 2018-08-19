<?php

function thebigshop_child_scripts() {
wp_enqueue_style('thebigshop-parent-style', get_parent_theme_file_uri('style.css'));
}

add_action('wp_enqueue_scripts', 'thebigshop_child_scripts',20);