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
function belon_enqueue_styles($post_suffix){
 if (strpos($post_suffix, 'belon') !== false) {
  wp_enqueue_style('my-theme-settings', get_template_directory_uri() . '/assets/styles/theme-settings.css');
 }
 wp_enqueue_style('my-theme-settings', get_template_directory_uri() . '/assets/styles/admin-settings.css');
}add_action('admin_enqueue_scripts', 'belon_enqueue_styles', 10);
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
  null,
  '32'
 );

 add_submenu_page(
  'belon_pro_menu',
  'Main Settings - Belon Pro Theme',
  'Main Settings',
  'administrator',
  'belon_pro_menu',
  'belon_pro_header_display'
 );

 add_submenu_page(
  'belon_pro_menu',
  'Header Settings - Belon Pro Theme',
  'Header',
  'administrator',
  'belon_pro_header',
  'belon_pro_header_display'
 );

 add_submenu_page(
  'belon_pro_menu',
  'Contact Us Settings - Belon Pro Theme',
  'Contact Us',
  'administrator',
  'belon_pro_contact_us',
  'belon_pro_contactus_display'
 );

 add_submenu_page(
  'belon_pro_menu',
  'Slider Settings - Belon Pro Theme',
  'Slider',
  'administrator',
  'belon_pro_slider',
  'belon_pro_slider_display'
 );
 add_submenu_page(
  'belon_pro_menu',
  'Social Icons Settings - Belon Pro Theme',
  'Social Icons',
  'administrator',
  'belon_pro_soc_icons',
  'belon_pro_menu_soc_icons_display'
 );
}
add_action('admin_menu', 'belon_create_menu_page');

function belon_pro_menu_soc_icons_display(){
?>
 <div class="wrap">
  <h2>Настройки Social Icons</h2>
  <!-- вывод ошибок -->
  <?php settings_errors(); ?>
  <form method="post" action="options.php" class="h2_hidden">
   <?php settings_fields('belon_theme_sect1_options'); ?>
   <?php do_settings_sections('belon_theme_sect1_options'); ?>
   <?php submit_button(); ?>
  </form>
 </div>
<?php
}

function belon_pro_contactus_display(){
 ?>
  <div class="wrap">
   <h2>Настройки Contact Us Section</h2>
   <!-- вывод ошибок -->
   <?php settings_errors(); ?>
   <form method="post" action="options.php" class="h2_hidden">
    <?php settings_fields('belon_theme_contact_options'); ?>
    <?php do_settings_sections('belon_theme_contact_options'); ?>
    <?php submit_button(); ?>
   </form>
  </div>
 <?php
 }

 function belon_pro_header_display() {
  ?>
  <div class="wrap">
   <h2>Настройки Header Section</h2>
   <!-- вывод ошибок -->
   <?php settings_errors(); ?>
   <form method="post" action="options.php" class="h2_hidden">
    <?php settings_fields('belon_theme_header_options'); ?>
    <?php do_settings_sections('belon_theme_header_options'); ?>
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
  'belon_op_field_callback',
  'belon_theme_sect1_options',
  'belon_sect1',
  array(
   'id' => 'twitter',
   'option' => 'belon_theme_sect1_options',
   'type' => 'text',
   'placeholder' => 'link'
  )
 );
 add_settings_field(
  'facebook',
  'Facebook',
  'belon_op_field_callback',
  'belon_theme_sect1_options',
  'belon_sect1',
  array(
   'id' => 'facebook',
   'option' => 'belon_theme_sect1_options',
   'type' => 'text',
   'placeholder' => 'link'
  )
 );
 add_settings_field(
  'linkedin',
  'Linkedin',
  'belon_op_field_callback',
  'belon_theme_sect1_options',
  'belon_sect1',
  array(
   'id' => 'linkedin',
   'option' => 'belon_theme_sect1_options',
   'type' => 'text',
   'placeholder' => 'link'
  )
 );
 add_settings_field(
  'youtube',
  'YouTube',
  'belon_op_field_callback',
  'belon_theme_sect1_options',
  'belon_sect1',
  array(
   'id' => 'youtube',
   'option' => 'belon_theme_sect1_options',
   'type' => 'text',
   'placeholder' => 'link'
  )
 );
 add_settings_field(
  'instagram',
  'Instagram',
  'belon_op_field_callback',
  'belon_theme_sect1_options',
  'belon_sect1',
  array(
   'id' => 'instagram',
   'option' => 'belon_theme_sect1_options',
   'type' => 'text',
   'placeholder' => 'link'
  )
 );
 add_settings_field(
  'dribble',
  'Dribble',
  'belon_op_field_callback',
  'belon_theme_sect1_options',
  'belon_sect1',
  array(
   'id' => 'dribble',
   'option' => 'belon_theme_sect1_options',
   'type' => 'text',
   'placeholder' => 'link'
  )
 );
 add_settings_field(
  'github',
  'GitHub',
  'belon_op_field_callback',
  'belon_theme_sect1_options',
  'belon_sect1',
  array(
   'id' => 'github',
   'option' => 'belon_theme_sect1_options',
   'type' => 'text',
   'placeholder' => 'link'
  )
 );

 register_setting(
  'belon_theme_sect1_options',
  'belon_theme_sect1_options',
  'belon_theme_sanitize_urls'
 );
}
add_action('admin_init', 'belon_theme_init_sect1_options');


//**** init & set contact subpage ****//
function belon_theme_init_contact_options()
{
 if (false == get_option('belon_theme_contact_options')) {
  add_option('belon_theme_contact_options');
 }
 add_settings_section(
  'belon_contact_hd',
  'Header and title',
  'belon_contact_hd_callback',
  'belon_theme_contact_options'
 );

 add_settings_field(
  'belon_contact_hd_title',
  'Section Title',
  'belon_op_field_callback',
  'belon_theme_contact_options',
  'belon_contact_hd',
  array(
   'id' => 'belon_contact_hd_title',
   'type' => 'text',
   'option' => 'belon_theme_contact_options'
  )
 );

 add_settings_field(
  'belon_contact_hd_desc',
  'Section Descritpion',
  'belon_op_field_callback',
  'belon_theme_contact_options',
  'belon_contact_hd',
  array(
   'id' => 'belon_contact_hd_desc',
   'type' => 'textarea',
   'option' => 'belon_theme_contact_options'
  )
 );
 add_settings_field(
  'belon_contact_hd_placeholder',
  'Input placeholder value',
  'belon_op_field_callback',
  'belon_theme_contact_options',
  'belon_contact_hd',
  array(
   'id' => 'belon_contact_hd_placeholder',
   'type' => 'text',
   'option' => 'belon_theme_contact_options'
  )
 );

 add_settings_field(
  'belon_contact_hd_btn_text',
  'Button text value',
  'belon_op_field_callback',
  'belon_theme_contact_options',
  'belon_contact_hd',
  array(
   'id' => 'belon_contact_hd_btn_text',
   'type' => 'text',
   'option' => 'belon_theme_contact_options'
  )
 );

 add_settings_field(
  'belon_contact_hd_hide',
  'Hide Section',
  'belon_op_field_callback',
  'belon_theme_contact_options',
  'belon_contact_hd',
  array(
   'id' => 'belon_contact_hd_hide',
   'type' => 'checkbox',
   'option' => 'belon_theme_contact_options'
  )
 );

 register_setting(
  'belon_theme_contact_options',
  'belon_theme_contact_options'
 );
}
add_action('admin_init', 'belon_theme_init_contact_options');

//**** init & set header subpage ****//
function belon_theme_init_header_options()
{
 if (false === get_option('belon_theme_header_options')) {
  add_option('belon_theme_header_options');
 }
 add_settings_section(
  'belon_header_hd',
  'Header Block Options',
  'belon_header_hd_callback',
  'belon_theme_header_options'
 );

 add_settings_section(
  'belon_header_btn_hd',
  'Header Button Options',
  'belon_header_btn_hd_callback',
  'belon_theme_header_options'
 );

 add_settings_section(
  'belon_header_il_hd',
  'Header Illustration Options',
  'belon_header_il_hd_callback',
  'belon_theme_header_options'
 );

 add_settings_field(
  'belon_header_hd_title',
  'Header Title',
  'belon_op_field_callback',
  'belon_theme_header_options',
  'belon_header_hd',
  array(
   'id' => 'belon_header_hd_title',
   'type' => 'text',
   'option' => 'belon_theme_header_options'
  )
 );
 add_settings_field(
  'belon_header_hd_desc',
  'Header Description',
  'belon_op_field_callback',
  'belon_theme_header_options',
  'belon_header_hd',
  array(
   'id' => 'belon_header_hd_desc',
   'type' => 'text',
   'option' => 'belon_theme_header_options'
  )
 );

 add_settings_field(
  'belon_header_hd_btn_title',
  'Button text',
  'belon_op_field_callback',
  'belon_theme_header_options',
  'belon_header_btn_hd',
  array(
   'id' => 'belon_header_hd_btn_title',
   'type' => 'text',
   'option' => 'belon_theme_header_options'
  )
 );
 add_settings_field(
  'belon_header_hd_btn_link',
  'Button Link',
  'belon_op_field_callback',
  'belon_theme_header_options',
  'belon_header_btn_hd',
  array(
   'id' => 'belon_header_hd_btn_link',
   'type' => 'text',
   'option' => 'belon_theme_header_options'
  )
 );

 add_settings_field(
  'belon_header_hd_btn_newtab',
  'Open in a new tab',
  'belon_op_field_callback',
  'belon_theme_header_options',
  'belon_header_btn_hd',
  array(
   'id' => 'belon_header_hd_btn_newtab',
   'type' => 'checkbox',
   'option' => 'belon_theme_header_options'
  )
 );

 add_settings_field(
  'belon_header_hd_il_choose',
  'Select Illustration',
  'belon_op_field_callback',
  'belon_theme_header_options',
  'belon_header_il_hd',
  array(
   'id' => 'belon_header_hd_il_choose',
   'type' => 'text',
   'option' => 'belon_theme_header_options'
  )
 );

 register_setting(
  'belon_theme_header_options',
  'belon_theme_header_options'
 );
}
add_action('admin_init', 'belon_theme_init_header_options');


//callbacks for show info
function belon_sect1_callback(){
 echo '<p>Укажите ссылки на социальные сети:</p>';}

//callbacks for contact us
function belon_contact_hd_callback(){
 echo '<p>Заполните данные секции:</p>';}

function belon_op_field_callback($args) {
 $id = $args['id'];
 $option = $args['option'];
 $options = get_option($option);
 $val = '';
 $placeholder = '';
 if (isset($options[$id])) {
  $val = $options[$id];
 } 
 if($args['placeholder'] === 'link') {
  $placeholder = 'https://'. $id .'.com/*';
 }
 if($args['type'] === 'textarea') {
 echo '<textarea size="36" rows="8" cols="36" style="resize: none;" id="' . $id . '" name="'. $option .'[' . $id . ']">'. $val .'</textarea>';
 }else if($args['type'] === 'checkbox') {
  echo '<input type="checkbox" id="' . $id . '" name="'. $option .'[' . $id . ']" value="1" ' . checked(1, $options[$id], false) . '/>';
 } else {
  echo '<input type="' . $args['type'] . '" placeholder="'. $placeholder .'" size="36" id="' . $id . '" name="'. $option .'[' . $id . ']" value="' . $val . '"/>';
 }
}

//callbacks for header section
function belon_header_hd_callback() {
 echo '<h3>Заголовок и подзаголовок:</h3>';
}
function belon_header_btn_hd_callback() {
 echo '<h3>Настройки кнопки:</h3>';
}

function belon_header_il_hd_callback() {
 echo '<h3>Настройки иллюстрации:</h3>';
 }


//default values setters
function set_default_contact_hd(){
 $options = get_option('belon_theme_contact_options');
 $setdefault = array_merge($options, array(
  'belon_contact_hd_title' => $options['belon_contact_hd_title'] ? $options['belon_contact_hd_title'] : 'Contact Us',
  'belon_contact_hd_desc' => $options['belon_contact_hd_desc'] ? $options['belon_contact_hd_desc'] : 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci aliquam libero laudantium cumque, aperiam quos nesciunt tempore, assumenda error veniam dolorum quidem.',
  'belon_contact_hd_placeholder' => $options['belon_contact_hd_placeholder'] ? $options['belon_contact_hd_placeholder'] : 'Your email',
  'belon_contact_hd_btn_text' => $options['belon_contact_hd_btn_text'] ? $options['belon_contact_hd_btn_text'] : 'Send',
  'belon_contact_hd_hide' => $options['belon_contact_hd_hide'],
 ));
 update_option('belon_theme_contact_options', $setdefault);
} set_default_contact_hd();

function set_default_header_hd(){
 $options = get_option('belon_theme_header_options');
 $setdefault = array_merge($options, array(
  'belon_header_hd_title' => $options['belon_header_hd_title'] ? $options['belon_header_hd_title'] : 'Remotus Amoleos',
  'belon_header_hd_desc' => $options['belon_header_hd_desc'] ? $options['belon_header_hd_desc'] : 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis nulla neque, ratione sequi vel hic eveniet qui sit fuga laboriosam autem maxime ipsa nesciunt ipsum nisi fugit assumenda, consequatur blanditiis!',
  'belon_header_hd_btn_title' => $options['belon_header_hd_btn_title'] ? $options['belon_header_hd_btn_title'] : 'Explore',
  'belon_header_hd_btn_link' => $options['belon_header_hd_btn_link'] ? $options['belon_header_hd_btn_link'] : '#section-1',
 ));
 update_option('belon_theme_header_options', $setdefault);
} set_default_header_hd();

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