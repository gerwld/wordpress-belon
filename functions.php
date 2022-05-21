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