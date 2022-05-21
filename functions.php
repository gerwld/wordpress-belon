<?php
function enqueue_styles()
{
 wp_enqueue_style('styles', get_stylesheet_uri());
 wp_register_style('font-montserrat', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap');
 wp_register_style('font-roboto', 'https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap');
 wp_enqueue_style('font-montserrat');
 wp_enqueue_style('font-roboto');
}
add_action('wp_enqueue_scripts', 'enqueue_styles');

function enqueue_scripts()
{
 wp_register_script('index-js', get_template_directory_uri() . '/assets/js/main.js','','',true);
 wp_register_script('index-js_2', get_template_directory_uri() . '/assets/js/main_2.js','','',true);
 wp_enqueue_script('index-js');
 wp_enqueue_script('index-js_2');
}
add_action('wp_enqueue_scripts', 'enqueue_scripts');




if (function_exists('add_theme_support')) {
 add_theme_support('menus');
}

add_filter( 'show_admin_bar', '__return_false' );