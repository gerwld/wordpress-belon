<!-- //**** CONTACT US COMPONENT ****// -->
<?php $contactus_options = get_option('belon_theme_contact_options'); ?>

<?php if(!$contactus_options['belon_contact_hd_hide']) { ?>
<div class="constact-us-block ft_block_1_wrapper" id="contact-us">
 <div class="content_wrapper">
  <div class="ft_block_1">
   <div class="ft_contact">
    <h2><?php echo $contactus_options['belon_contact_hd_title']?></h2>
    <p><?php echo $contactus_options['belon_contact_hd_desc']?></p>
   </div>
   <form class="ft_form" id="ft_form">
    <input type="email" name="email" placeholder="<?php echo $contactus_options['belon_contact_hd_placeholder']?>" required />
    <button class="btn btn_th_0 btn_sz_1 btn_hover" type="submit"><?php echo $contactus_options['belon_contact_hd_btn_text']?></button>
   </form>
  </div>
 </div>
</div>
<?php } ?>

<!-- 
  values
belon_contact_hd_title
belon_contact_hd_desc
belon_contact_hd_placeholder
belon_contact_hd_btn_text
belon_contact_hd_hide -->