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
  <?php get_template_part('assets/template-parts/header-parallax'); ?>
    <div class="hd-navbar">
      <div class="hd-navbar_content content_wrapper">
        <div class="logo"><a href="<?php echo get_home_url(); ?>">
            <?php echo get_theme_mod('header_setting') ?>
          </a>
          <?php if (get_theme_mod('header_subtitle')) { ?>
            <p class="site-description">
              <?php echo get_bloginfo('description', 'display'); ?>
            </p>
          <?php } ?>
        </div>
        <nav class="main-nav desktop_menu_el" id="main-desktop-nav">
          <?php $has_items_prim = wp_nav_menu(array('theme_location' => 'primary-menu', 'echo' => false)) !== false; ?>
          <?php if ($has_items_prim) {
            wp_nav_menu(array(
              'theme_location' => 'primary-menu'
            ));
          } else wp_nav_menu(array('menu' => 'primary')); ?>
        </nav>

        <?php if (get_theme_mod('contactbtn_menu_primary_show', true)) { ?>
          <?php if (get_theme_mod('contactbtn_menu_primary_innewwindow', false)) { ?>
            <a href="<?php echo get_theme_mod('contactbtn_menu_primary_link', '#contact-us') ?>" target='_blank' rel="noopener noreferrer" class="btn btn_contact desktop_menu_el">
            <?php } else { ?>
              <a href="<?php echo get_theme_mod('contactbtn_menu_primary_link', '#contact-us') ?>" class="btn btn_contact desktop_menu_el">
              <?php } ?>
              <span><?php echo get_theme_mod('contactbtn_menu_primary_text', 'Contact Us') ?></span>
              </a>
            <?php } ?>
            <button class="btn btn_mobmenu" id="mob_mn_btn">
              <span class="line_1">Menu</span>
              <span class="line_2"></span>
              <span class="line_3"></span>
            </button>
      </div>
      <nav class="main-mob-nav mobile_menu_el" id="main-mob-nav">
        <?php $has_items_prim = wp_nav_menu(array('theme_location' => 'primary-menu', 'echo' => false)) !== false; ?>
        <?php if ($has_items_prim) {
          wp_nav_menu(array(
            'theme_location' => 'primary-menu'
          ));
        } else wp_nav_menu(array('menu' => 'any')); ?>
      </nav>
      <div class="bg"></div>
    </div>

    <?php get_template_part('assets/template-parts/header-block-main'); ?>
    </div>
  </header>

  <?php get_template_part('assets/template-parts/video-dt-block'); ?>
  <?php get_template_part('assets/template-parts/posts-gallery-block'); ?>
  <?php get_template_part('assets/template-parts/benefits-block'); ?>
  <?php get_template_part('assets/template-parts/plans-block'); ?>
  <?php get_template_part('assets/template-parts/transp-block'); ?>
  <?php get_template_part('assets/template-parts/features-block'); ?>
  <?php get_template_part('assets/template-parts/slider-block-bl'); ?>
  <?php get_template_part('assets/template-parts/lastpost-block'); ?>