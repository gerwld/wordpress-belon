<?php
//console.log alternative
function consolelog($data){ $output = $data; if (is_array($output)) $output = implode(',', $output); echo "<script>console.log('Debug Objects: " . $output . "' );</script>";}

//connect theme styles & fonts
function enqueue_styles()
{
 wp_enqueue_style('styles', get_stylesheet_uri());
 wp_register_style('font-montserrat', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap');
 wp_register_style('font-roboto', 'https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap');
 wp_enqueue_style('font-montserrat');
 wp_enqueue_style('font-roboto');
} add_action('wp_enqueue_scripts', 'enqueue_styles');

//connect theme js files, etc
function enqueue_scripts()
{
 wp_register_script('main-js', get_template_directory_uri() . '/assets/js/main.js', '', '', true);
 wp_register_script('glob-js', get_template_directory_uri() . '/assets/js/main_2.js', '', '', true);
 wp_enqueue_script('main-js');
 wp_enqueue_script('glob-js');
}
add_action('wp_enqueue_scripts', 'enqueue_scripts');

//*** add theme functional with hooks / params ***//
//add logo
if (function_exists('add_theme_support')) {
 add_theme_support( 'custom-logo', [
  'height'      => 50,
  'width'       => 140,
  'flex-width'  => false,
  'flex-height' => false,
  'header-text' => '',
  'unlink-homepage-logo' => false, 
 ] );
};

//disable admin bar by default
add_filter('show_admin_bar', '__return_false');

//Add menu sections
function wpb_custom_new_menu(){
 register_nav_menus(
  array(
   'primary-menu' => __('Primary'),
   'footer-menu' => __('Footer Menu 1'),
   'footer-menu-2' => __('Footer Menu 2'),
   'footer-menu-3' => __('Footer Menu 3'),
  )
 );} add_action('init', 'wpb_custom_new_menu');

 // //Add admin panel css styles
function my_admin_enqueue($suffix){
 if (strpos($suffix, 'belon') !== false) {
  wp_enqueue_style('my-theme-settings', get_template_directory_uri() . '/assets/styles/theme-settings.css');
 }
}
add_action('admin_enqueue_scripts', 'my_admin_enqueue', 10);
//*** add theme functional with hooks / params (end) ***//



//add Belon menu page
function belon_create_menu_page()
{
 add_menu_page(
  'Belon Pro Theme Settings',
  'Belon Pro',
  'administrator',
  'belon_pro_menu',
  'belon_pro_menu_display',
  'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4KPHN2ZyB3aWR0aD0iNTQ0cHgiIGhlaWdodD0iNTQ0cHgiIHZpZXdCb3g9IjAgMCA1NDQgNTQ0IiB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPgogICAgPHRpdGxlPm5vdW4tdGVtcGxhdGUtMzIxODA3MzwvdGl0bGU+CiAgICA8ZyBpZD0iUGFnZS0xIiBzdHJva2U9Im5vbmUiIHN0cm9rZS13aWR0aD0iMSIgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIj4KICAgICAgICA8ZyBpZD0ibm91bi10ZW1wbGF0ZS0zMjE4MDczIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgwLjc2MDMwMCwgMC43NTUzMDApIiBmaWxsPSIjMDAwMDAwIiBmaWxsLXJ1bGU9Im5vbnplcm8iPgogICAgICAgICAgICA8cG9seWdvbiBpZD0iUGF0aCIgcG9pbnRzPSI2OS45ODk3IDEzOS45OTQ3IDg3LjQ4OTcgMTM5Ljk5NDcgODcuNDg5NyAxNTcuNDk0NyA2OS45ODk3IDE1Ny40OTQ3Ij48L3BvbHlnb24+CiAgICAgICAgICAgIDxwb2x5Z29uIGlkPSJQYXRoIiBwb2ludHM9IjEwNC45ODk3IDEzOS45OTQ3IDEyMi40ODk3IDEzOS45OTQ3IDEyMi40ODk3IDE1Ny40OTQ3IDEwNC45ODk3IDE1Ny40OTQ3Ij48L3BvbHlnb24+CiAgICAgICAgICAgIDxwb2x5Z29uIGlkPSJQYXRoIiBwb2ludHM9IjEzOS45ODk3IDEzOS45OTQ3IDE1Ny40ODk3IDEzOS45OTQ3IDE1Ny40ODk3IDE1Ny40OTQ3IDEzOS45ODk3IDE1Ny40OTQ3Ij48L3BvbHlnb24+CiAgICAgICAgICAgIDxwYXRoIGQ9Ik01MTcuMDE5Nyw0MDEuMDQ0NyBMNTI4LjgzOTcsMzgwLjM0OTcgTDUyMi4zMjgsMzczLjgzOCBDNTM1LjY2LDM0MS4yNzYgNTQyLjQ5MiwzMDYuODA3IDU0Mi40OTIsMjcxLjI0OCBDNTQyLjQ5MiwyMDguNzEzIDUyMC43MzgsMTQ3LjkxOCA0ODEuMjQyLDk5LjYyOCBMNDgxLjI0Miw3Ni4wOTcgTDQzNy40OTIsMTAuNDcyIEw0MTYuMzE2LDQyLjIzNCBDMzcyLjkyNSwxNC42ODMgMzIzLjAwNywwIDI3MS4yNDYsMCBDMTg2LjYyNSwwIDEwOC44MzYsMzguMjU0IDU3LjAxNiwxMDUgTDM1LDEwNSBMMzUsMTM4LjAzOSBDMTIuMTQ1LDE3OC41MTYgMCwyMjQuNDg4IDAsMjcxLjI0OSBDMCw0MjAuODA5IDEyMS42OCw1NDIuNDk5NiAyNzEuMjUsNTQyLjQ5OTYgQzMwNi44MDEsNTQyLjQ5OTYgMzQxLjI2Niw1MzUuNjY3IDM3My44NCw1MjIuMzMxIEwzODAuMzQsNTI4Ljg0MjcgTDQwMS4wNTEsNTE3LjAzMDcgQzQwMy4wMzU0LDUxNy45NDA4NiA0MDUuMDMxNSw1MTguNzgwNyA0MDcuMDM1NCw1MTkuNTM0NiBMNDEzLjMyMDYsNTQyLjQ5OTYgTDQ2MS42Nzk2LDU0Mi40OTk2IEw0NjcuOTYwOCw1MTkuNTMwNiBDNDY5Ljk2NDcsNTE4Ljc3NjY5IDQ3MS45NjA4LDUxNy45NDg2IDQ3My45NDUyLDUxNy4wMjY3IEw0OTQuNjU2Miw1MjguODM4NyBMNTI4Ljg0NDIsNDk0LjY0MzcgTDUxNy4wMjQyLDQ3My45NDg3IEM1MTcuOTM0MzYsNDcxLjk3MjEgNTE4Ljc3NDIsNDY5Ljk2ODIgNTE5LjUyODEsNDY3Ljk1NjUgTDU0Mi41MDUxLDQ2MS42NzUzIEw1NDIuNTA1MSw0MTMuMzIzMyBMNTE5LjUzNjEsNDA3LjA0MjEgQzUxOC43ODIxOSw0MDUuMDI2NSA1MTcuOTQyMyw0MDMuMDIyNiA1MTcuMDMyMiw0MDEuMDQ2IEw1MTcuMDE5Nyw0MDEuMDQ0NyBaIE01MjQuOTkyNCwyNzEuMjQ0NyBDNTI0Ljk5MjQsMzAyLjAzNzcgNTE5LjU4NjIsMzMxLjk3MTcgNTA4Ljg5MDQsMzYwLjM5NjcgTDQ5NC42NDQ0LDM0Ni4xNTA3IEw0ODEuMjQyNCwzNTMuNzk5MSBMNDgxLjI0MjQsMTI5LjAxOTEgQzUwOS41MzE0LDE3MC44MDAxIDUyNC45OTI0LDIyMC4zODYxIDUyNC45OTI0LDI3MS4yMzkxIEw1MjQuOTkyNCwyNzEuMjQ0NyBaIE0zNTcuOTYyNCw0MDEuMDQ0NyBDMzU3LjA1MjI0LDQwMy4wMjEzIDM1Ni4yMTI0LDQwNS4wMjUyIDM1NS40NTg1LDQwNy4wMzY5IEwzMzIuNDg5NSw0MTMuMzIyMSBMMzMyLjQ4OTUsNDE5Ljk5NzkgTDY1Ljg0OTUsNDE5Ljk5NzkgQzYxLjA4MzksNDEzLjQzNTQgNTYuNjE5LDQwNi42Mzg5IDUyLjQ5MDUsMzk5LjYxODkgTDUyLjQ5MDUsMTkyLjQ5ODkgTDM5My43NDA1LDE5Mi40OTg5IEwzOTMuNzQwNSwzNTMuNzk4OSBMMzgwLjMzNDUsMzQ2LjE1MDUgTDM0Ni4xNDY1LDM4MC4zNDU1IEwzNTcuOTYyNCw0MDEuMDQ0NyBaIE00MTEuMjM5NCw4Ny40OTQ3IEw0MjguNzM5NCw4Ny40OTQ3IEw0MjguNzM5NCwzMzIuNDk0NyBMNDEzLjMwNTQsMzMyLjQ5NDcgTDQxMS4yMzksMzQwLjA1MzMgTDQxMS4yMzk0LDg3LjQ5NDcgWiBNNDQ2LjIzOTQsODcuNDk0NyBMNDYzLjczOTQsODcuNDk0NyBMNDYzLjczOTQsMzQwLjA1NDcgTDQ2MS42NzMsMzMyLjQ5NjEgTDQ0Ni4yMzksMzMyLjQ5NjEgTDQ0Ni4yMzk0LDg3LjQ5NDcgWiBNNDU2LjE0NTYsNjkuOTk0NyBMNDE4Ljg0NDYsNjkuOTk0NyBMNDM3LjQ4OTYsNDIuMDIxNyBMNDU2LjE0NTYsNjkuOTk0NyBaIE0yNzEuMjM1NiwxNy40OTQ3IEMzMTkuNTM2NiwxNy40OTQ3IDM2Ni4xMDI2LDMxLjE1NDcgNDA2LjYwNTYsNTYuNzgzNyBMMzkzLjczNDYsNzYuMDkyNyBMMzkzLjczNDYsMTA0Ljk5NDcgTDc5LjU5NDYsMTA0Ljk5NDcgQzEyNy44Njc2LDQ5LjE5NzcgMTk2LjcxNDYsMTcuNDk0NyAyNzEuMjM0NiwxNy40OTQ3IEwyNzEuMjM1NiwxNy40OTQ3IFogTTM5My43MzU2LDEyMi40OTQ3IEwzOTMuNzM1NiwxNzQuOTk0NyBMNTIuNDg1NiwxNzQuOTk0NyBMNTIuNDg1NiwxMjIuNDk0NyBMMzkzLjczNTYsMTIyLjQ5NDcgWiBNMzQuOTg1NiwxNzguODI2NyBMMzQuOTg1NiwzNjMuNjY2NyBDMjMuNzMxNiwzMzUuMDAyNyAxNy40ODU2LDMwMy44NTA3IDE3LjQ4NTYsMjcxLjI0ODcgQzE3LjQ4NTYsMjM5LjQ4NjcgMjMuNTQwMywyMDguMTM1NyAzNC45ODU2LDE3OC44MzA3IEwzNC45ODU2LDE3OC44MjY3IFogTTI3MS4yMzU2LDUyNC45OTcxIEMxOTQuODc2Niw1MjQuOTk3MSAxMjYuMzM1Niw0OTEuMDQ3NyA3OS43NzU2LDQzNy40OTY3IEwzMzIuNDg1Niw0MzcuNDk2NyBMMzMyLjQ4NTYsNDYxLjY3MjcgTDM1NS40NTQ2LDQ2Ny45NTM5IEMzNTYuMjA4NTEsNDY5Ljk2NTYgMzU3LjA0ODQsNDcxLjk2OTUgMzU3Ljk1ODUsNDczLjk0NjEgTDM0Ni4xMzg1LDQ5NC42NDExIEwzNjAuMzkyNSw1MDguODk1MSBDMzMxLjk2MjUsNTE5LjU3OTEgMzAyLjAyOTUsNTI0Ljk5NzEgMjcxLjIzNjUsNTI0Ljk5NzEgTDI3MS4yMzU2LDUyNC45OTcxIFogTTUyNC45ODU2LDQ0OC4zMjA3IEw1MDUuNzk3Niw0NTMuNTcwNyBMNTA0LjM4NzQsNDU4LjE2NDUgQzUwMy4xMjU3LDQ2Mi4yMTUzIDUwMS40NDYsNDY2LjI1MDQgNDk5LjM4MzUsNDcwLjE0NDUgTDQ5Ny4xMjU3LDQ3NC4zOTg0IEw1MDcuMDEyNCw0OTEuNzE0NCBMNDkxLjcwNzQsNTA3LjAyNjQgTDQ3NC4zOTE0LDQ5Ny4xNDc1IEw0NzAuMTQ5Miw0OTkuMzg1OCBDNDY2LjIxMTcsNTAxLjQ2NzggNDYyLjE2ODcsNTAzLjE0NzUgNDU4LjE1MzIsNTA0LjM4OTcgTDQ1My41NjczLDUwNS44MDc3IEw0NDguMzAxNyw1MjQuOTk1NyBMNDI2LjY2MDcsNTI0Ljk5NTcgTDQyMS40MDI5LDUwNS44MDc3IEw0MTYuODE3LDUwNC4zODk3IEM0MTIuODAxNCw1MDMuMTQ3NSA0MDguNzU4NCw1MDEuNDY3OCA0MDQuODIxLDQ5OS4zODU4IEw0MDAuNTc4OCw0OTcuMTQ3NSBMMzgzLjI2MjgsNTA3LjAyNjQgTDM2Ny45NTc4LDQ5MS43MTQ0IEwzNzcuODQ0NSw0NzQuMzk4NCBMMzc1LjU4NjcsNDcwLjE0NDUgQzM3My41MjAzLDQ2Ni4yNSAzNzEuODMyOCw0NjIuMjE4NyAzNzAuNTgyOCw0NTguMTY0NSBMMzY5LjE3MjYsNDUzLjU3MDcgTDM0OS45ODQ2LDQ0OC4zMjA3IEwzNDkuOTg0Niw0MjYuNjcyNyBMMzY5LjE3MjYsNDIxLjQyMjcgTDM3MC41ODI4LDQxNi44Mjg5IEMzNzEuODQ0NSw0MTIuNzc4MSAzNzMuNTI0Miw0MDguNzQzIDM3NS41ODY3LDQwNC44NDg5IEwzNzcuODQ0NSw0MDAuNTk1IEwzNjcuOTU3OCwzODMuMjc5IEwzODMuMjYyOCwzNjcuOTY3IEw0MDAuNTc4OCwzNzcuODQ1OSBMNDA0LjgyMSwzNzUuNjA3NiBDNDA4Ljc1ODUsMzczLjUyNTYgNDEyLjgwMTUsMzcxLjg0NTkgNDE2LjgxNywzNzAuNjAzNyBMNDIxLjQwMjksMzY5LjE4NTcgTDQyNi42Njg1LDM0OS45OTc3IEw0NDguMzA5NSwzNDkuOTk3NyBMNDUzLjU2NzMsMzY5LjE4NTcgTDQ1OC4xNTMyLDM3MC42MDM3IEM0NjIuMTY4OCwzNzEuODQ1OSA0NjYuMjExOCwzNzMuNTI1NiA0NzAuMTQ5MiwzNzUuNjA3NiBMNDc0LjM5MTQsMzc3Ljg0NTkgTDQ5MS43MDc0LDM2Ny45NjcgTDUwNy4wMTI0LDM4My4yNzkgTDQ5Ny4xMjU3LDQwMC41OTUgTDQ5OS4zODM1LDQwNC44NDg5IEM1MDEuNDQ5OSw0MDguNzQzNCA1MDMuMTM3NCw0MTIuNzc0NyA1MDQuMzg3NCw0MTYuODI4OSBMNTA1Ljc5NzYsNDIxLjQyMjcgTDUyNC45ODU2LDQyNi42NzI3IEw1MjQuOTg1Niw0NDguMzIwNyBaIiBpZD0iU2hhcGUiPjwvcGF0aD4KICAgICAgICAgICAgPHBhdGggZD0iTTQzNy40ODk3LDM4NC45OTQ3IEM0MDguNTM2NywzODQuOTk0NyAzODQuOTg5Nyw0MDguNTQxNyAzODQuOTg5Nyw0MzcuNDk0NyBDMzg0Ljk4OTcsNDY2LjQ0NzcgNDA4LjUzNjcsNDg5Ljk5NDcgNDM3LjQ4OTcsNDg5Ljk5NDcgQzQ2Ni40NDI3LDQ4OS45OTQ3IDQ4OS45ODk3LDQ2Ni40NDc3IDQ4OS45ODk3LDQzNy40OTQ3IEM0ODkuOTg5Nyw0MDguNTQxNyA0NjYuNDQyNywzODQuOTk0NyA0MzcuNDg5NywzODQuOTk0NyBaIE00MzcuNDg5Nyw0NzIuNDk0NyBDNDE4LjE4ODcsNDcyLjQ5NDcgNDAyLjQ4OTcsNDU2Ljc5NTcgNDAyLjQ4OTcsNDM3LjQ5NDcgQzQwMi40ODk3LDQxOC4xOTM3IDQxOC4xODg3LDQwMi40OTQ3IDQzNy40ODk3LDQwMi40OTQ3IEM0NTYuNzkwNyw0MDIuNDk0NyA0NzIuNDg5Nyw0MTguMTkzNyA0NzIuNDg5Nyw0MzcuNDk0NyBDNDcyLjQ4OTcsNDU2Ljc5NTcgNDU2Ljc5MDcsNDcyLjQ5NDcgNDM3LjQ4OTcsNDcyLjQ5NDcgWiIgaWQ9IlNoYXBlIj48L3BhdGg+CiAgICAgICAgICAgIDxwYXRoIGQ9Ik0yNDQuOTg5NywyMDkuOTk0NyBMNjkuOTg5NywyMDkuOTk0NyBMNjkuOTg5NywyOTcuNDk0NyBMMjQ0Ljk4OTcsMjk3LjQ5NDcgTDI0NC45ODk3LDIwOS45OTQ3IFogTTIyNy40ODk3LDI3OS45OTQ3IEw4Ny40ODk3LDI3OS45OTQ3IEw4Ny40ODk3LDIyNy40OTQ3IEwyMjcuNDg5NywyMjcuNDk0NyBMMjI3LjQ4OTcsMjc5Ljk5NDcgWiIgaWQ9IlNoYXBlIj48L3BhdGg+CiAgICAgICAgICAgIDxwb2x5Z29uIGlkPSJQYXRoIiBwb2ludHM9IjI2Mi40ODk3IDIwOS45OTQ3IDM3Ni4yMzk3IDIwOS45OTQ3IDM3Ni4yMzk3IDIyNy40OTQ3IDI2Mi40ODk3IDIyNy40OTQ3Ij48L3BvbHlnb24+CiAgICAgICAgICAgIDxwb2x5Z29uIGlkPSJQYXRoIiBwb2ludHM9IjI2Mi40ODk3IDI0NC45OTQ3IDM3Ni4yMzk3IDI0NC45OTQ3IDM3Ni4yMzk3IDI2Mi40OTQ3IDI2Mi40ODk3IDI2Mi40OTQ3Ij48L3BvbHlnb24+CiAgICAgICAgICAgIDxwb2x5Z29uIGlkPSJQYXRoIiBwb2ludHM9IjM1OC43Mzk3IDI3OS45OTQ3IDM3Ni4yMzk3IDI3OS45OTQ3IDM3Ni4yMzk3IDI5Ny40OTQ3IDM1OC43Mzk3IDI5Ny40OTQ3Ij48L3BvbHlnb24+CiAgICAgICAgICAgIDxwb2x5Z29uIGlkPSJQYXRoIiBwb2ludHM9IjI2Mi40ODk3IDI3OS45OTQ3IDM0MS4yMzk3IDI3OS45OTQ3IDM0MS4yMzk3IDI5Ny40OTQ3IDI2Mi40ODk3IDI5Ny40OTQ3Ij48L3BvbHlnb24+CiAgICAgICAgICAgIDxwYXRoIGQ9Ik02OS45ODk3LDQwMi40OTQ3IEwxOTIuNDg5Nyw0MDIuNDk0NyBMMTkyLjQ4OTcsMzE0Ljk5NDcgTDY5Ljk4OTcsMzE0Ljk5NDcgTDY5Ljk4OTcsNDAyLjQ5NDcgWiBNODcuNDg5NywzMzIuNDk0NyBMMTc0Ljk4OTcsMzMyLjQ5NDcgTDE3NC45ODk3LDM4NC45OTQ3IEw4Ny40ODk3LDM4NC45OTQ3IEw4Ny40ODk3LDMzMi40OTQ3IFoiIGlkPSJTaGFwZSI+PC9wYXRoPgogICAgICAgICAgICA8cGF0aCBkPSJNMjA5Ljk4OTcsNDAyLjQ5NDcgTDMzMi40ODk3LDQwMi40OTQ3IEwzMzIuNDg5NywzMTQuOTk0NyBMMjA5Ljk4OTcsMzE0Ljk5NDcgTDIwOS45ODk3LDQwMi40OTQ3IFogTTIyNy40ODk3LDMzMi40OTQ3IEwzMTQuOTg5NywzMzIuNDk0NyBMMzE0Ljk4OTcsMzg0Ljk5NDcgTDIyNy40ODk3LDM4NC45OTQ3IEwyMjcuNDg5NywzMzIuNDk0NyBaIiBpZD0iU2hhcGUiPjwvcGF0aD4KICAgICAgICA8L2c+CiAgICA8L2c+Cjwvc3ZnPg==',
  '30'
 );
 add_submenu_page(
  'belon_pro_menu',
  'Slider Settings',
  'Slider',
  'administrator',
  'belon_pro_menu_slider',
  'belon_pro_slider_display'
 );
 add_submenu_page(
  'belon_pro_menu',
  'Social Icons Settings',
  'Social Navbar',
  'administrator',
  'belon_pro_menu_soc_icons',
  'belon_pro_soc_icons_display'
 );
}
add_action('admin_menu', 'belon_create_menu_page');

function belon_pro_menu_display(){
?>
 <div class="wrap">
  <h2>Настройки темы Belon Pro</h2>
  <!-- вывод ошибок -->
  <?php settings_errors(); ?>
  <form method="post" action="options.php">
   <?php settings_fields('belon_theme_sect1_options'); ?>
   <?php do_settings_sections('belon_theme_sect1_options'); ?>
   <?php submit_button(); ?>
  </form>
 </div>
<?php
}


//**** set main page in admin panel ****//
function belon_theme_init_sect1_options()
{
 if (false == get_option('belon_theme_sect1_options')) {
  add_option('belon_theme_sect1_options');
 }
 add_settings_section(
  'belon_sect1',
  'Social Icons',
  'belon_sect1_callback',
  'belon_theme_sect1_options'
 );

 add_settings_field(
  'twitter',
  'Twitter',
  'sect1_twitter_callback',
  'belon_theme_sect1_options',
  'belon_sect1',
 );
 add_settings_field(
  'facebook',
  'Facebook',
  'sect1_facebook_callback',
  'belon_theme_sect1_options',
  'belon_sect1',
 );
 add_settings_field(
  'linkedin',
  'Linkedin',
  'sect1_linkedin_callback',
  'belon_theme_sect1_options',
  'belon_sect1',
 );

 register_setting(
  'belon_theme_sect1_options',
  'belon_theme_sect1_options',
  'belon_theme_sanitize_urls'
 );
}
add_action('admin_init', 'belon_theme_init_sect1_options');


//callbacks for show info
function belon_sect1_callback(){
 echo '<p>Укажите ссылки на социальные сети:</p>';}

function sect1_twitter_callback(){
 $options = get_option('belon_theme_sect1_options');
 $url = '';
 if (isset($options['twitter'])) {
  $url = $options['twitter'];
 } echo '<input type="text" id="twitter" name="belon_theme_sect1_options[twitter]" value="' . $url . '" />';
}

function sect1_facebook_callback(){
 $options = get_option('belon_theme_sect1_options');
 $url = '';
 if (isset($options['facebook'])) {
  $url = $options['facebook'];
 } echo '<input type="text" id="facebook" name="belon_theme_sect1_options[facebook]" value="' . $url . '" />';
}

function sect1_linkedin_callback(){
 $options = get_option('belon_theme_sect1_options');
 $url = '';
 if (isset($options['linkedin'])) {
  $url = $options['linkedin'];
 } echo '<input type="text" id="linkedin" name="belon_theme_sect1_options[linkedin]" value="' . $url . '" />';
}

//**** set main page in admin panel end ****//



//Theme customizer.php new settings
function set_menus_panel($wp_customize)
{
 $wp_customize->add_panel(
  'menu_select_panel',
  array(
   'title' => 'Header settings',
   'description' => "Most important settings for the elements in the header section.",
   'priority' => 10,
  )
 );

 //header title settings
 $wp_customize->add_section('header_sect_title', array(
  'title' => 'Header Title',
  'priority' => 10,
  'panel' => 'menu_select_panel'
 ));

 $wp_customize->add_setting('header_setting', array(
  'validate_callback' => 'true_validate_header',
  'sanitize_callback' => 'true_sanitize_header',
  'default' => 'Belon'
 ));

 $wp_customize->add_setting('header_subtitle', array(
  'default' => false
 ));

 $wp_customize->add_control('header_title_control', array(
  'label' => 'Change header title',
  'type' => 'text',
  'section' => 'header_sect_title',
  'settings' => 'header_setting',
 ));

 $wp_customize->add_control('header_subtitle_control', array(
  'label' => 'Show header description',
  'description' => "*for change the description go to the site settings tab.",
  'type' => 'checkbox',
  'section' => 'header_sect_title',
  'settings' => 'header_subtitle',
 ));
 //header title settings end

 //primary section contact button
 $wp_customize->add_section(
  'contactbtn_menu_primary_section',
  array(
   'title' => 'Header Button',
   'priority' => 10,
   'panel' => 'menu_select_panel'
  )
 );

 $wp_customize->add_setting(
  'contactbtn_menu_primary_text',
  array(
   'validate_callback' => 'true_validate_cbtn_text',
   'sanitize_callback' => 'sanitize_text_field',
   'default' => 'Contact Us'
  )
 );
 $wp_customize->add_setting(
  'contactbtn_menu_primary_link',
  array(
   'validate_callback' => 'true_validate_cbtn_link',
   'sanitize_callback' => 'sanitize_text_field',
   'default' => '#contact-us'
  )
 );
 $wp_customize->add_setting(
  'contactbtn_menu_primary_show',
  array(
   'default' => true
  )
 );
 $wp_customize->add_setting(
  'contactbtn_menu_primary_innewwindow',
  array(
   'default' => false
  )
 );

 $wp_customize->add_control(
  'contactbtn_menu_primary_control-3',
  array(
   'label' => 'Show button',
   'type' => 'checkbox',
   'section' => 'contactbtn_menu_primary_section',
   'settings' => 'contactbtn_menu_primary_show',
  )
 );

 $wp_customize->add_control(
  'contactbtn_menu_primary_control-1',
  array(
   'label' => 'Button text',
   'type' => 'text',
   'section' => 'contactbtn_menu_primary_section',
   'settings' => 'contactbtn_menu_primary_text',
  )
 );

 $wp_customize->add_control(
  'contactbtn_menu_primary_control-2',
  array(
   'label' => 'Button link',
   'type' => 'text',
   'description' => 'http://*, https://*, /* or #id',
   'section' => 'contactbtn_menu_primary_section',
   'settings' => 'contactbtn_menu_primary_link',
  )
 );

 $wp_customize->add_control(
  'contactbtn_menu_primary_control-4',
  array(
   'label' => 'Open link in a new tab',
   'type' => 'checkbox',
   'section' => 'contactbtn_menu_primary_section',
   'settings' => 'contactbtn_menu_primary_innewwindow',
  )
 );
 //primary section contact button end
}
add_action('customize_register', 'set_menus_panel');



//Валидатор и санитайзер
function true_sanitize_header($value)
{
 return sanitize_text_field($value);
}

function true_validate_header($validity, $value)
{
 if ('' === $value) {
  $validity->add('empty_copy', 'Header title cannot be empty');
 } else if (strlen($value) > 12) {
  $validity->add('empty_copy', 'Header title cannot be greater that 12 symbols');
 }
 return $validity;
}

function true_validate_cbtn_link($validity, $value)
{
 if ('' === $value) {
  $validity->add('empty_copy', 'Button link cannot be empty');
 }
 return $validity;
}

function true_validate_cbtn_text($validity, $value)
{
 if ('' === $value) {
  $validity->add('empty_copy', 'Button text value cannot be empty');
 } else if (strlen($value) > 15) {
  $validity->add('empty_copy', 'Button text value cannot be greater that 15 symbols');
 }
 return $validity;
}

function belon_theme_sanitize_urls($input)
{
 $output = array();
 foreach ($input as $key => $v) {
  if (isset($input[$key])) {
   $output[$key] = esc_url_raw(strip_tags(stripslashes($input[$key])));
  }
 }
 return apply_filters('belon_theme_sanitize_urls', $output, $input);
}

//Test code