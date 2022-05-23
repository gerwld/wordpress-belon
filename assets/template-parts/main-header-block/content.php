<!-- //**** MAIN HEADER BLOCK COMPONENT ****// -->
<?php $mainheader_options = get_option('belon_theme_header_options'); ?>

<?php if (get_option('sandbox_theme_display_options', true)['show_header']) { ?>
 <div class="content_wrapper">
  <div class="hd-blocks">
   <div class="hd-info h3-height-hotfix">
    <h1><?php echo $mainheader_options['belon_header_hd_title'] ?></h1>
    <p><?php echo $mainheader_options['belon_header_hd_desc'] ?></p>
    <a href="<?php echo $mainheader_options['belon_header_hd_btn_link'] ?>" <?php echo $mainheader_options['belon_header_hd_btn_newtab'] ? "target='_blank' rel='noopener noreferrer'" : '' ?> class="btn btn_explore"><?php echo $mainheader_options['belon_header_hd_btn_title'] ?><span></span></a>
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


 <!-- 
belon_header_hd_title
belon_header_hd_desc
belon_header_hd_btn_title
belon_header_hd_btn_link
belon_header_hd_btn_newtab
TODO:belon_header_hd_il_choose -->