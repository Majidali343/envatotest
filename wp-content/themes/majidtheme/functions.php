<?php
if ( ! defined( 'ABSPATH' ) ) exit; // No direct access


// Theme setup
add_action('after_setup_theme', function() {
// Core supports
add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_theme_support('custom-logo', [
'height' => 60,
'width' => 200,
'flex-height' => true,
'flex-width' => true,
]);
add_theme_support('html5', [ 'search-form','comment-form','comment-list','gallery','caption','style','script','navigation-widgets' ]);
add_theme_support('automatic-feed-links');
add_theme_support('align-wide');
add_theme_support('responsive-embeds');
add_theme_support('editor-styles'); // Gutenberg editor styling (optional for Elementor)
add_editor_style('assets/css/editor.css');


// Menus
register_nav_menus([
'primary' => __('Primary Menu', 'portfolia'),
'footer' => __('Footer Menu', 'portfolia'),
]);
});


// Content width
add_action('after_setup_theme', function(){ $GLOBALS['content_width'] = 1200; }, 0);


// Assets
add_action('wp_enqueue_scripts', function() {
$theme = wp_get_theme();
$ver = $theme ? $theme->get('Version') : '1.0.0';


$style_path = get_template_directory() . '/assets/css/style.css';
$script_path = get_template_directory() . '/assets/js/theme.js';
$style_ver = file_exists($style_path) ? filemtime($style_path) : $ver;
$script_ver = file_exists($script_path) ? filemtime($script_path) : $ver;


// Main stylesheet (separate from style.css header for cache-busting)
wp_enqueue_style('portfolia', get_template_directory_uri() . '/assets/css/style.css', [], $style_ver);
// Script
wp_enqueue_script('portfolia', get_template_directory_uri() . '/assets/js/theme.js', ['jquery'], $script_ver, true);
});


// Widgets / sidebars
add_action('widgets_init', function() {
register_sidebar([
'name' => __('Sidebar', 'portfolia'),
'id' => 'sidebar-1',
'before_widget' => '<section id="%1$s" class="widget %2$s">',
'after_widget' => '</section>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
]);
});


// === Portfolio CPT (demo; ideally move to a plugin to keep content portable) ===
add_action('init', function(){
});