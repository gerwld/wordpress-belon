<?php if (get_option('sandbox_theme_display_options', true)['show_header']) { ?>
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
     <?php get_template_part('assets/template-parts/social-icons'); ?>
    </nav>
   </div>
  </div>
 <?php } ?>