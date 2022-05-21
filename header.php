<?php
/**
 * Header file for the Belon Pro theme.
 *
 * @link https://gerwld.github.io
 *
 * @package Gerwld Studio
 * @subpackage Belon_Pro
 * @since Belon Pro 1.1
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-type" content="text/html; charset=<?php bloginfo('charset'); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <title><?php wp_title('-', true, 'right'); ?> <?php bloginfo('name'); ?></title>
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php
  wp_body_open();
  ?>
  <header class="main-header" id="mn_header">
    <div class="anim_bg" id="anim_bg">
      <div class="block_1" style="background-image: url('<?php echo esc_url(get_template_directory_uri() . "/assets/images/hd_bg/oval_1.svg"); ?>');"></div>
      <div class="block_2" style="background-image: url('<?php echo esc_url(get_template_directory_uri() . "/assets/images/hd_bg/oval_2.svg"); ?>');"></div>
      <div class="block_3" style="background-image: url('<?php echo esc_url(get_template_directory_uri() . "/assets/images/hd_bg/oval_3.svg"); ?>');"></div>
      <div class="block_4" style="background-image: url('<?php echo esc_url(get_template_directory_uri() . "/assets/images/hd_bg/oval_4.svg"); ?>');"></div>
    </div>
    <div class="hd-navbar">
      <div class="hd-navbar_content content_wrapper">
        <div class="logo"><a href="<?php echo get_home_url(); ?>">Belon</a></div>
        <nav class="main-nav desktop_menu_el">
          <?php wp_nav_menu(array('menu' => 'primary')); ?>
        </nav>
        <button class="btn btn_contact desktop_menu_el" type="button">Contact Us</button>
        <button class="btn btn_mobmenu" id="mob_mn_btn">
          <span class="line_1">Menu</span>
          <span class="line_2"></span>
          <span class="line_3"></span>
        </button>
      </div>
      <nav class="main-mob-nav mobile_menu_el" id="main-mob-nav">
        <?php wp_nav_menu(array('menu' => 'primary')); ?>
      </nav>
      <div class="bg"></div>
    </div>

    <?php if(get_option('show_header', true)) {?>
    <div class="content_wrapper">
      <div class="hd-blocks">
        <div class="hd-info h3-height-hotfix">
          <h1>Remotus Amoleos</h1>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis nulla neque, ratione sequi vel hic eveniet qui
            sit fuga laboriosam autem maxime ipsa nesciunt ipsum nisi fugit assumenda, consequatur blanditiis!</p>
          <a href="#" class="btn btn_explore">Explore <span></span></a>
        </div>
        <div class="hd-image h3-height-hotfix" id="hd_img" style="background-image: url('<?php echo esc_url(get_template_directory_uri() . "/assets/images/hd_bg.svg"); ?>');">
          <div class="hd-image_tablet">
            <img src="<?php echo esc_url(get_template_directory_uri() . "/assets/images/hd_bg_tablet.svg"); ?>" alt="Header img">
          </div>
          <nav>
            <ul class="sc_icons">
              <li class="fb"><a href="#">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="transparent" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook">
                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                  </svg>
                </a>
              </li>
              <li class="in"><a href="#">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="transparent" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-linkedin">
                    <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                    <rect x="2" y="9" width="4" height="12"></rect>
                    <circle cx="4" cy="4" r="2"></circle>
                  </svg>
                </a></li>
              <li class="tw"><a href="#">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="transparent" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter">
                    <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z">
                    </path>
                  </svg>
                </a></li>
            </ul>
          </nav>
        </div>
      </div>
      <?php }?>
    </div>
  </header>