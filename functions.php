<?php
//connect styles & fonts
function enqueue_styles()
{
 wp_enqueue_style('styles', get_stylesheet_uri());
 wp_register_style('font-montserrat', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap');
 wp_register_style('font-roboto', 'https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap');
 wp_enqueue_style('font-montserrat');
 wp_enqueue_style('font-roboto');
}
add_action('wp_enqueue_scripts', 'enqueue_styles');

//connect js files, etc
function enqueue_scripts()
{
 wp_register_script('index-js', get_template_directory_uri() . '/assets/js/main.js','','',true);
 wp_register_script('index-js_2', get_template_directory_uri() . '/assets/js/main_2.js','','',true);
 wp_enqueue_script('index-js');
 wp_enqueue_script('index-js_2');
}
add_action('wp_enqueue_scripts', 'enqueue_scripts');



//add theme support
if (function_exists('add_theme_support')) {
 add_theme_support('menus');
}

//disable admin bar by default
add_filter( 'show_admin_bar', '__return_false' );












//add new menu for theme-options page with page callback theme-options-page.

/* ---------------------------------------------------------------- 
 * Регистрация настроек 
 * ----------------------------------------------------------------
*/

/* Инициализация страницы опций темы, регистрация секций, полей и настроек.
 * Эта функция регистрируется с помощью хука  admin_init. 
*/
function sandbox_initialize_theme_options()
{
 //Сначала мы регистрируем секцию. Это необходимо, так как объявляемые далее опции будут принадлежать именно к этой секции.
 add_settings_section(
  'general_settings_section',           // ID, который будет использоваться для идентификации этой секции и по которому мы будем регистрировать опции
  'Опции Sandbox',                      // Заголовок, который будет отображаться на странице административной панели
  'sandbox_general_options_callback',   // Вызов, который используется для отображения описания секции  
  'general'                             // Страница, на которую будет добавлена секция  
 );
 // Далее, мы создадим поле для переключения видимости контейнеров в шаблоне  
 add_settings_field(
  'show_header',                      // Идентификатор, используемый для идентификации поля внутри темы  
  'Контейнер header',                 // Метка слева от элемента интерфейса
  'sandbox_toggle_header_callback',   // Имя функции, ответственной за вывод элемента интерфейса  
  'general',                          // Страница, на которую будет выведена опция  
  'general_settings_section',         // Имя секции, которой принадлежит поле
  array(                              // Массив-аргументов, передаваемый callback-функции. В нашем случае просто описание.  
   'Активируйте эту опцию, чтобы отобразить контейнер header.'
  )
 );
 add_settings_field(  
  'show_content',  
  'Контейнер content',  
  'sandbox_toggle_content_callback',  
  'general',  
  'general_settings_section',  
  array(  
      'Активируйте эту опцию, чтобы отобразить контейнер content.'  
  )  
);
add_settings_field(  
 'show_footer',  
 'Контейнер footer',  
 'sandbox_toggle_footer_callback',  
 'general',  
 'general_settings_section',  
 array(  
     'Активируйте эту опцию, чтобы отобразить контейнер footer.'  
 )  
);
 // Регистрируем поля в WordPress  
 register_setting(
  'general',
  'show_header'
 );
 register_setting(
  'general',
  'show_content'
 );
 register_setting(
  'general',
  'show_footer'
 );
} // Конец функции sandbox_initialize_theme_options

add_action('admin_init', 'sandbox_initialize_theme_options');  
  
/* ----------------------------------------------------------------
 * Callback-функции для секций
 * ----------------------------------------------------------------
*/   
  
/* 
 * Эта функция предоставляет простое описание страницы "Общие настройки".  
 * Она вызывается из функции sandbox_initialize_theme_options и передается в нее как параметр
*/  

function sandbox_general_options_callback() {  
    echo '<p>Выберите, какие секции вы хотите показывать на странице.</p>';  
} // Конец функции sandbox_general_options_callback  



/** 
 * Эта функция выводит элемент интерфейса для изменения видимости контейнера header. 
 *  
 * Она получает массив аргументов, в котором первым идет описание,
 * которое будет отображено после чекбокса. 
 */  
function sandbox_toggle_header_callback($args) {  
      
 // Заметьте, что идентификатор и имя атрибута элемента должны совпадать с указанными в функции add_settings_field  
 $html = '<input type="checkbox" id="show_header" name="show_header" value="1" ' . checked(1, get_option('show_header'), false) . '/>';  
   
 // Берем первый элемент массива и добавляем его к метке чекбокса  
 $html .= '<label for="show_header"> '  . $args[0] . '</label>';  
   
 echo $html;  
   
} // конец функции sandbox_toggle_header_callback

function sandbox_toggle_content_callback($args) {
 $html = '<input type="checkbox" id="show_content" name="show_content" value="1" ' . checked(1, get_option('show_content'), false) . '/>'; 
 $html .= '<label for="show_content"> '  . $args[0] . '</label>'; 
 echo $html;
}

function sandbox_toggle_footer_callback($args) {
 $html = '<input type="checkbox" id="show_footer" name="show_footer" value="1" ' . checked(1, get_option('show_footer'), false) . '/>'; 
 $html .= '<label for="show_footer"> '  . $args[0] . '</label>'; 
 echo $html;
}



//add the new menu page (admin panel)

function sandbox_create_menu_page() {  
 add_menu_page(  
  'Belon Pro Theme Settings',              // Текст заголовка для данного меню в браузере
  'Belon Pro',                    // Текст пункта меню  
  'administrator',              // Пользователи, которые могут видеть этот пункт меню  
  'sandbox',                    // Уникальный идентификатор для данного пункта меню  
  'sandbox_menu_page_display',   // Имя функции, вызываемой при отображении меню
  'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4KPHN2ZyB3aWR0aD0iNTQ0cHgiIGhlaWdodD0iNTQ0cHgiIHZpZXdCb3g9IjAgMCA1NDQgNTQ0IiB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPgogICAgPHRpdGxlPm5vdW4tdGVtcGxhdGUtMzIxODA3MzwvdGl0bGU+CiAgICA8ZyBpZD0iUGFnZS0xIiBzdHJva2U9Im5vbmUiIHN0cm9rZS13aWR0aD0iMSIgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIj4KICAgICAgICA8ZyBpZD0ibm91bi10ZW1wbGF0ZS0zMjE4MDczIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgwLjc2MDMwMCwgMC43NTUzMDApIiBmaWxsPSIjMDAwMDAwIiBmaWxsLXJ1bGU9Im5vbnplcm8iPgogICAgICAgICAgICA8cG9seWdvbiBpZD0iUGF0aCIgcG9pbnRzPSI2OS45ODk3IDEzOS45OTQ3IDg3LjQ4OTcgMTM5Ljk5NDcgODcuNDg5NyAxNTcuNDk0NyA2OS45ODk3IDE1Ny40OTQ3Ij48L3BvbHlnb24+CiAgICAgICAgICAgIDxwb2x5Z29uIGlkPSJQYXRoIiBwb2ludHM9IjEwNC45ODk3IDEzOS45OTQ3IDEyMi40ODk3IDEzOS45OTQ3IDEyMi40ODk3IDE1Ny40OTQ3IDEwNC45ODk3IDE1Ny40OTQ3Ij48L3BvbHlnb24+CiAgICAgICAgICAgIDxwb2x5Z29uIGlkPSJQYXRoIiBwb2ludHM9IjEzOS45ODk3IDEzOS45OTQ3IDE1Ny40ODk3IDEzOS45OTQ3IDE1Ny40ODk3IDE1Ny40OTQ3IDEzOS45ODk3IDE1Ny40OTQ3Ij48L3BvbHlnb24+CiAgICAgICAgICAgIDxwYXRoIGQ9Ik01MTcuMDE5Nyw0MDEuMDQ0NyBMNTI4LjgzOTcsMzgwLjM0OTcgTDUyMi4zMjgsMzczLjgzOCBDNTM1LjY2LDM0MS4yNzYgNTQyLjQ5MiwzMDYuODA3IDU0Mi40OTIsMjcxLjI0OCBDNTQyLjQ5MiwyMDguNzEzIDUyMC43MzgsMTQ3LjkxOCA0ODEuMjQyLDk5LjYyOCBMNDgxLjI0Miw3Ni4wOTcgTDQzNy40OTIsMTAuNDcyIEw0MTYuMzE2LDQyLjIzNCBDMzcyLjkyNSwxNC42ODMgMzIzLjAwNywwIDI3MS4yNDYsMCBDMTg2LjYyNSwwIDEwOC44MzYsMzguMjU0IDU3LjAxNiwxMDUgTDM1LDEwNSBMMzUsMTM4LjAzOSBDMTIuMTQ1LDE3OC41MTYgMCwyMjQuNDg4IDAsMjcxLjI0OSBDMCw0MjAuODA5IDEyMS42OCw1NDIuNDk5NiAyNzEuMjUsNTQyLjQ5OTYgQzMwNi44MDEsNTQyLjQ5OTYgMzQxLjI2Niw1MzUuNjY3IDM3My44NCw1MjIuMzMxIEwzODAuMzQsNTI4Ljg0MjcgTDQwMS4wNTEsNTE3LjAzMDcgQzQwMy4wMzU0LDUxNy45NDA4NiA0MDUuMDMxNSw1MTguNzgwNyA0MDcuMDM1NCw1MTkuNTM0NiBMNDEzLjMyMDYsNTQyLjQ5OTYgTDQ2MS42Nzk2LDU0Mi40OTk2IEw0NjcuOTYwOCw1MTkuNTMwNiBDNDY5Ljk2NDcsNTE4Ljc3NjY5IDQ3MS45NjA4LDUxNy45NDg2IDQ3My45NDUyLDUxNy4wMjY3IEw0OTQuNjU2Miw1MjguODM4NyBMNTI4Ljg0NDIsNDk0LjY0MzcgTDUxNy4wMjQyLDQ3My45NDg3IEM1MTcuOTM0MzYsNDcxLjk3MjEgNTE4Ljc3NDIsNDY5Ljk2ODIgNTE5LjUyODEsNDY3Ljk1NjUgTDU0Mi41MDUxLDQ2MS42NzUzIEw1NDIuNTA1MSw0MTMuMzIzMyBMNTE5LjUzNjEsNDA3LjA0MjEgQzUxOC43ODIxOSw0MDUuMDI2NSA1MTcuOTQyMyw0MDMuMDIyNiA1MTcuMDMyMiw0MDEuMDQ2IEw1MTcuMDE5Nyw0MDEuMDQ0NyBaIE01MjQuOTkyNCwyNzEuMjQ0NyBDNTI0Ljk5MjQsMzAyLjAzNzcgNTE5LjU4NjIsMzMxLjk3MTcgNTA4Ljg5MDQsMzYwLjM5NjcgTDQ5NC42NDQ0LDM0Ni4xNTA3IEw0ODEuMjQyNCwzNTMuNzk5MSBMNDgxLjI0MjQsMTI5LjAxOTEgQzUwOS41MzE0LDE3MC44MDAxIDUyNC45OTI0LDIyMC4zODYxIDUyNC45OTI0LDI3MS4yMzkxIEw1MjQuOTkyNCwyNzEuMjQ0NyBaIE0zNTcuOTYyNCw0MDEuMDQ0NyBDMzU3LjA1MjI0LDQwMy4wMjEzIDM1Ni4yMTI0LDQwNS4wMjUyIDM1NS40NTg1LDQwNy4wMzY5IEwzMzIuNDg5NSw0MTMuMzIyMSBMMzMyLjQ4OTUsNDE5Ljk5NzkgTDY1Ljg0OTUsNDE5Ljk5NzkgQzYxLjA4MzksNDEzLjQzNTQgNTYuNjE5LDQwNi42Mzg5IDUyLjQ5MDUsMzk5LjYxODkgTDUyLjQ5MDUsMTkyLjQ5ODkgTDM5My43NDA1LDE5Mi40OTg5IEwzOTMuNzQwNSwzNTMuNzk4OSBMMzgwLjMzNDUsMzQ2LjE1MDUgTDM0Ni4xNDY1LDM4MC4zNDU1IEwzNTcuOTYyNCw0MDEuMDQ0NyBaIE00MTEuMjM5NCw4Ny40OTQ3IEw0MjguNzM5NCw4Ny40OTQ3IEw0MjguNzM5NCwzMzIuNDk0NyBMNDEzLjMwNTQsMzMyLjQ5NDcgTDQxMS4yMzksMzQwLjA1MzMgTDQxMS4yMzk0LDg3LjQ5NDcgWiBNNDQ2LjIzOTQsODcuNDk0NyBMNDYzLjczOTQsODcuNDk0NyBMNDYzLjczOTQsMzQwLjA1NDcgTDQ2MS42NzMsMzMyLjQ5NjEgTDQ0Ni4yMzksMzMyLjQ5NjEgTDQ0Ni4yMzk0LDg3LjQ5NDcgWiBNNDU2LjE0NTYsNjkuOTk0NyBMNDE4Ljg0NDYsNjkuOTk0NyBMNDM3LjQ4OTYsNDIuMDIxNyBMNDU2LjE0NTYsNjkuOTk0NyBaIE0yNzEuMjM1NiwxNy40OTQ3IEMzMTkuNTM2NiwxNy40OTQ3IDM2Ni4xMDI2LDMxLjE1NDcgNDA2LjYwNTYsNTYuNzgzNyBMMzkzLjczNDYsNzYuMDkyNyBMMzkzLjczNDYsMTA0Ljk5NDcgTDc5LjU5NDYsMTA0Ljk5NDcgQzEyNy44Njc2LDQ5LjE5NzcgMTk2LjcxNDYsMTcuNDk0NyAyNzEuMjM0NiwxNy40OTQ3IEwyNzEuMjM1NiwxNy40OTQ3IFogTTM5My43MzU2LDEyMi40OTQ3IEwzOTMuNzM1NiwxNzQuOTk0NyBMNTIuNDg1NiwxNzQuOTk0NyBMNTIuNDg1NiwxMjIuNDk0NyBMMzkzLjczNTYsMTIyLjQ5NDcgWiBNMzQuOTg1NiwxNzguODI2NyBMMzQuOTg1NiwzNjMuNjY2NyBDMjMuNzMxNiwzMzUuMDAyNyAxNy40ODU2LDMwMy44NTA3IDE3LjQ4NTYsMjcxLjI0ODcgQzE3LjQ4NTYsMjM5LjQ4NjcgMjMuNTQwMywyMDguMTM1NyAzNC45ODU2LDE3OC44MzA3IEwzNC45ODU2LDE3OC44MjY3IFogTTI3MS4yMzU2LDUyNC45OTcxIEMxOTQuODc2Niw1MjQuOTk3MSAxMjYuMzM1Niw0OTEuMDQ3NyA3OS43NzU2LDQzNy40OTY3IEwzMzIuNDg1Niw0MzcuNDk2NyBMMzMyLjQ4NTYsNDYxLjY3MjcgTDM1NS40NTQ2LDQ2Ny45NTM5IEMzNTYuMjA4NTEsNDY5Ljk2NTYgMzU3LjA0ODQsNDcxLjk2OTUgMzU3Ljk1ODUsNDczLjk0NjEgTDM0Ni4xMzg1LDQ5NC42NDExIEwzNjAuMzkyNSw1MDguODk1MSBDMzMxLjk2MjUsNTE5LjU3OTEgMzAyLjAyOTUsNTI0Ljk5NzEgMjcxLjIzNjUsNTI0Ljk5NzEgTDI3MS4yMzU2LDUyNC45OTcxIFogTTUyNC45ODU2LDQ0OC4zMjA3IEw1MDUuNzk3Niw0NTMuNTcwNyBMNTA0LjM4NzQsNDU4LjE2NDUgQzUwMy4xMjU3LDQ2Mi4yMTUzIDUwMS40NDYsNDY2LjI1MDQgNDk5LjM4MzUsNDcwLjE0NDUgTDQ5Ny4xMjU3LDQ3NC4zOTg0IEw1MDcuMDEyNCw0OTEuNzE0NCBMNDkxLjcwNzQsNTA3LjAyNjQgTDQ3NC4zOTE0LDQ5Ny4xNDc1IEw0NzAuMTQ5Miw0OTkuMzg1OCBDNDY2LjIxMTcsNTAxLjQ2NzggNDYyLjE2ODcsNTAzLjE0NzUgNDU4LjE1MzIsNTA0LjM4OTcgTDQ1My41NjczLDUwNS44MDc3IEw0NDguMzAxNyw1MjQuOTk1NyBMNDI2LjY2MDcsNTI0Ljk5NTcgTDQyMS40MDI5LDUwNS44MDc3IEw0MTYuODE3LDUwNC4zODk3IEM0MTIuODAxNCw1MDMuMTQ3NSA0MDguNzU4NCw1MDEuNDY3OCA0MDQuODIxLDQ5OS4zODU4IEw0MDAuNTc4OCw0OTcuMTQ3NSBMMzgzLjI2MjgsNTA3LjAyNjQgTDM2Ny45NTc4LDQ5MS43MTQ0IEwzNzcuODQ0NSw0NzQuMzk4NCBMMzc1LjU4NjcsNDcwLjE0NDUgQzM3My41MjAzLDQ2Ni4yNSAzNzEuODMyOCw0NjIuMjE4NyAzNzAuNTgyOCw0NTguMTY0NSBMMzY5LjE3MjYsNDUzLjU3MDcgTDM0OS45ODQ2LDQ0OC4zMjA3IEwzNDkuOTg0Niw0MjYuNjcyNyBMMzY5LjE3MjYsNDIxLjQyMjcgTDM3MC41ODI4LDQxNi44Mjg5IEMzNzEuODQ0NSw0MTIuNzc4MSAzNzMuNTI0Miw0MDguNzQzIDM3NS41ODY3LDQwNC44NDg5IEwzNzcuODQ0NSw0MDAuNTk1IEwzNjcuOTU3OCwzODMuMjc5IEwzODMuMjYyOCwzNjcuOTY3IEw0MDAuNTc4OCwzNzcuODQ1OSBMNDA0LjgyMSwzNzUuNjA3NiBDNDA4Ljc1ODUsMzczLjUyNTYgNDEyLjgwMTUsMzcxLjg0NTkgNDE2LjgxNywzNzAuNjAzNyBMNDIxLjQwMjksMzY5LjE4NTcgTDQyNi42Njg1LDM0OS45OTc3IEw0NDguMzA5NSwzNDkuOTk3NyBMNDUzLjU2NzMsMzY5LjE4NTcgTDQ1OC4xNTMyLDM3MC42MDM3IEM0NjIuMTY4OCwzNzEuODQ1OSA0NjYuMjExOCwzNzMuNTI1NiA0NzAuMTQ5MiwzNzUuNjA3NiBMNDc0LjM5MTQsMzc3Ljg0NTkgTDQ5MS43MDc0LDM2Ny45NjcgTDUwNy4wMTI0LDM4My4yNzkgTDQ5Ny4xMjU3LDQwMC41OTUgTDQ5OS4zODM1LDQwNC44NDg5IEM1MDEuNDQ5OSw0MDguNzQzNCA1MDMuMTM3NCw0MTIuNzc0NyA1MDQuMzg3NCw0MTYuODI4OSBMNTA1Ljc5NzYsNDIxLjQyMjcgTDUyNC45ODU2LDQyNi42NzI3IEw1MjQuOTg1Niw0NDguMzIwNyBaIiBpZD0iU2hhcGUiPjwvcGF0aD4KICAgICAgICAgICAgPHBhdGggZD0iTTQzNy40ODk3LDM4NC45OTQ3IEM0MDguNTM2NywzODQuOTk0NyAzODQuOTg5Nyw0MDguNTQxNyAzODQuOTg5Nyw0MzcuNDk0NyBDMzg0Ljk4OTcsNDY2LjQ0NzcgNDA4LjUzNjcsNDg5Ljk5NDcgNDM3LjQ4OTcsNDg5Ljk5NDcgQzQ2Ni40NDI3LDQ4OS45OTQ3IDQ4OS45ODk3LDQ2Ni40NDc3IDQ4OS45ODk3LDQzNy40OTQ3IEM0ODkuOTg5Nyw0MDguNTQxNyA0NjYuNDQyNywzODQuOTk0NyA0MzcuNDg5NywzODQuOTk0NyBaIE00MzcuNDg5Nyw0NzIuNDk0NyBDNDE4LjE4ODcsNDcyLjQ5NDcgNDAyLjQ4OTcsNDU2Ljc5NTcgNDAyLjQ4OTcsNDM3LjQ5NDcgQzQwMi40ODk3LDQxOC4xOTM3IDQxOC4xODg3LDQwMi40OTQ3IDQzNy40ODk3LDQwMi40OTQ3IEM0NTYuNzkwNyw0MDIuNDk0NyA0NzIuNDg5Nyw0MTguMTkzNyA0NzIuNDg5Nyw0MzcuNDk0NyBDNDcyLjQ4OTcsNDU2Ljc5NTcgNDU2Ljc5MDcsNDcyLjQ5NDcgNDM3LjQ4OTcsNDcyLjQ5NDcgWiIgaWQ9IlNoYXBlIj48L3BhdGg+CiAgICAgICAgICAgIDxwYXRoIGQ9Ik0yNDQuOTg5NywyMDkuOTk0NyBMNjkuOTg5NywyMDkuOTk0NyBMNjkuOTg5NywyOTcuNDk0NyBMMjQ0Ljk4OTcsMjk3LjQ5NDcgTDI0NC45ODk3LDIwOS45OTQ3IFogTTIyNy40ODk3LDI3OS45OTQ3IEw4Ny40ODk3LDI3OS45OTQ3IEw4Ny40ODk3LDIyNy40OTQ3IEwyMjcuNDg5NywyMjcuNDk0NyBMMjI3LjQ4OTcsMjc5Ljk5NDcgWiIgaWQ9IlNoYXBlIj48L3BhdGg+CiAgICAgICAgICAgIDxwb2x5Z29uIGlkPSJQYXRoIiBwb2ludHM9IjI2Mi40ODk3IDIwOS45OTQ3IDM3Ni4yMzk3IDIwOS45OTQ3IDM3Ni4yMzk3IDIyNy40OTQ3IDI2Mi40ODk3IDIyNy40OTQ3Ij48L3BvbHlnb24+CiAgICAgICAgICAgIDxwb2x5Z29uIGlkPSJQYXRoIiBwb2ludHM9IjI2Mi40ODk3IDI0NC45OTQ3IDM3Ni4yMzk3IDI0NC45OTQ3IDM3Ni4yMzk3IDI2Mi40OTQ3IDI2Mi40ODk3IDI2Mi40OTQ3Ij48L3BvbHlnb24+CiAgICAgICAgICAgIDxwb2x5Z29uIGlkPSJQYXRoIiBwb2ludHM9IjM1OC43Mzk3IDI3OS45OTQ3IDM3Ni4yMzk3IDI3OS45OTQ3IDM3Ni4yMzk3IDI5Ny40OTQ3IDM1OC43Mzk3IDI5Ny40OTQ3Ij48L3BvbHlnb24+CiAgICAgICAgICAgIDxwb2x5Z29uIGlkPSJQYXRoIiBwb2ludHM9IjI2Mi40ODk3IDI3OS45OTQ3IDM0MS4yMzk3IDI3OS45OTQ3IDM0MS4yMzk3IDI5Ny40OTQ3IDI2Mi40ODk3IDI5Ny40OTQ3Ij48L3BvbHlnb24+CiAgICAgICAgICAgIDxwYXRoIGQ9Ik02OS45ODk3LDQwMi40OTQ3IEwxOTIuNDg5Nyw0MDIuNDk0NyBMMTkyLjQ4OTcsMzE0Ljk5NDcgTDY5Ljk4OTcsMzE0Ljk5NDcgTDY5Ljk4OTcsNDAyLjQ5NDcgWiBNODcuNDg5NywzMzIuNDk0NyBMMTc0Ljk4OTcsMzMyLjQ5NDcgTDE3NC45ODk3LDM4NC45OTQ3IEw4Ny40ODk3LDM4NC45OTQ3IEw4Ny40ODk3LDMzMi40OTQ3IFoiIGlkPSJTaGFwZSI+PC9wYXRoPgogICAgICAgICAgICA8cGF0aCBkPSJNMjA5Ljk4OTcsNDAyLjQ5NDcgTDMzMi40ODk3LDQwMi40OTQ3IEwzMzIuNDg5NywzMTQuOTk0NyBMMjA5Ljk4OTcsMzE0Ljk5NDcgTDIwOS45ODk3LDQwMi40OTQ3IFogTTIyNy40ODk3LDMzMi40OTQ3IEwzMTQuOTg5NywzMzIuNDk0NyBMMzE0Ljk4OTcsMzg0Ljk5NDcgTDIyNy40ODk3LDM4NC45OTQ3IEwyMjcuNDg5NywzMzIuNDk0NyBaIiBpZD0iU2hhcGUiPjwvcGF0aD4KICAgICAgICA8L2c+CiAgICA8L2c+Cjwvc3ZnPg==',
  '30'
);
add_submenu_page(  
 'sandbox',                  // Регистрация подпункта под определенным выше пунктом меню  
 'Настройки слайдера',            // Текст заголовка браузера при активированном пункте меню  
 'Слайдер',                    // Текст для этого подпункта  
 'administrator',            // Группа пользователей, которой доступен этот подпункт  
 'sandbox_options',          // Уникальный ID - псевдоним – для данного подпункта меню  
 'sandbox_options_display'   // Функция, используемая для вывода содержимого этого пункта меню  
);
}  

add_action('admin_menu', 'sandbox_create_menu_page');  
  
function sandbox_menu_page_display() {  
 $html = '<div class="wrap">';  
 $html .= '<h2>Belon Pro Theme Settings</h2>';  
$html .= '</div>';  
echo $html;
}

function sandbox_options_display() {
 $html = '<div class="wrap">';  
 $html .= '<h2>Slider Settings</h2>';  
$html .= '</div>';  
echo $html;
}

function add_newline_theme_menu() {
 add_theme_page(
  'Тема Sandbox',             // Текст в заголовке браузера  
  'Тема Sandbox',             // Текст самого пункта меню в боковом меню WordPress  
  'administrator',            // Группы пользователей, имеющих доступ к данному меню  
  'sandbox_theme_options',    // Уникальный ID -псевдоним – для данного пункта меню  
  'sandbox_theme_display' 
 );
}

add_action('admin_menu', 'add_newline_theme_menu');  


function sandbox_theme_display() {
 $html = '<div class="wrap">';  
 $html .= '<h2>Theme Settings</h2>';  
$html .= '</div>';  
echo $html;
}



//Theme customizer.php new settings

 function true_header_title($wp_customize){ 
 $wp_customize->add_section('header_sect_title',array(
     'title'=>'Header settings',
     'priority'=>10,
 ));

 $wp_customize->add_setting('header_setting',array(
     'validate_callback' => 'true_validate_header',
     'sanitize_callback' => 'true_sanitize_header',
     'default' => 'Belon'
 ));

 $wp_customize->add_setting('header_subtitle',array(
  'default' => false
));
 
 $wp_customize->add_control('header_title_control',array(
     'label'=>'Change header title',
     'type'=>'text',
     'section'=>'header_sect_title',
     'settings'=>'header_setting',
 ));

 $wp_customize->add_control('header_subtitle_control',array(
  'label'=>'Show header description',
  'type'=>'checkbox',
  'section'=>'header_sect_title',
  'settings'=>'header_subtitle',
 )); 
}   
 add_action('customize_register','true_header_title');



 function set_menus_panel($wp_customize) {
  $wp_customize -> add_panel('menu_select_panel', 
  array(
   'title' => 'Menu settings',
   'description' => "Settings for the primary and secondary menu's",
   'priority' => 10,
  )
  );
  //primary section
  $wp_customize -> add_section('menu_primary_section', 
  array(
   'title' => 'Primary Menu',
   'priority' => 10,
   'panel' => 'menu_select_panel'
  ));
  $wp_customize -> add_setting('menu_primary_select', 
  array(
   'default' => 'Belon'
  )
 );
  $wp_customize -> add_control('menu_primary_control',
  array(
   'label'=>'Select Primary Menu',
   'type'=>'text',
   'section'=>'menu_primary_section',
    'settings'=>'menu_primary_select',
  ));
  //primary section end
  //secondary section
  $wp_customize -> add_section('menu_secondary_section', 
  array(
   'title' => 'Secondary Menu',
   'priority' => 10,
   'panel' => 'menu_select_panel'
  ));
  $wp_customize -> add_setting('menu_secondary_select', 
  array(
   'default' => 'Belon'
  )
 );
  $wp_customize -> add_control('menu_secondary_control',
  array(
   'label'=>'Select Secondary Menu',
   'type'=>'text',
   'section'=>'menu_secondary_section',
    'settings'=>'menu_secondary_select',
  ));
  //secondary section end
 } add_action('customize_register','set_menus_panel');




//Валидатор и санитайзер
function true_sanitize_header( $value ) {
	return sanitize_text_field( $value );
}

function true_validate_header( $validity, $value ){
 
	if( '' === $value ) { // если значение пустое, то валидацию не проходит
		$validity->add( 'empty_copy', 'Header title cannot be empty' );
	} else if(strlen($value) > 12) {
		$validity->add( 'empty_copy', 'Header title cannot be greater that 12 symbols' );
 }
 
	return $validity;
}

//Добавляение кастомного меню
function wpb_custom_new_menu() {
 register_nav_menus(
   array(
     'primary-menu' => __( 'Primary' ),
     'footer-menu' => __( 'Footer Menu 1' ),
     'footer-menu-2' => __( 'Footer Menu 2' ),
     'footer-menu-3' => __( 'Footer Menu 3' ),
   )
 );
}
add_action( 'init', 'wpb_custom_new_menu' );