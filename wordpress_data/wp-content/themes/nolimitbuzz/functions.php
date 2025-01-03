<?php
// Enqueue styles and scripts
function theme_enqueue_assets() {
    wp_enqueue_style('theme-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'theme_enqueue_assets');

// Register navigation menus
function theme_register_menus() {
    register_nav_menus([
        'primary' => __('Primary Menu', 'my-theme'),
        'footer' => __('Footer Menu', 'my-theme'),
    ]);
}
add_action('init', 'theme_register_menus');

// Add support for post thumbnails
function theme_support_features() {
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
}
add_action('after_setup_theme', 'theme_support_features');


