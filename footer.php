<div class="ft_block_1_wrapper content_wrapper">
  <div class="ft_block_1">
    <div class="ft_contact">
      <h2>Contact Us</h2>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci aliquam libero laudantium cumque, aperiam quos
        nesciunt tempore, assumenda error veniam dolorum quidem.</p>
    </div>
    <form class="ft_form" id="ft_form">
      <input type="email" name="email" placeholder="Your email" required>
      <button class="btn btn_th_0 btn_sz_1 btn_hover" type="submit">Send</button>
    </form>
  </div>
</div>
<footer class="main-footer">
  <div class="content_wrapper">
    <div class="ft_block_2">
      <nav class="footer_nav">
        <ul><?php echo wp_get_nav_menu_name('footer-menu') ?>
          <?php wp_nav_menu(array(
            'theme_location' => 'footer-menu'
          )); ?>
        </ul>
        <ul><?php echo wp_get_nav_menu_name('footer-menu-2') ?>
          <?php wp_nav_menu(array(
            'theme_location' => 'footer-menu-2'
          )); ?>
        </ul>
        <ul><?php echo wp_get_nav_menu_name('footer-menu-3') ?>
          <?php wp_nav_menu(array(
            'theme_location' => 'footer-menu-3'
          )); ?>
        </ul>
        <div class="cp_block">
          <div class="sc_icons__dark">
            <?php get_template_part('assets/template-parts/social-icons'); ?>
          </div>
          <span class="th_copyright" id="th_copyright"><span>Copyright &copy; <script>
                document.write(new Date().getFullYear())
              </script>. </span><span>All Rights Reserved.</span></span>
        </div>
      </nav>
    </div>
  </div>
</footer>
<?php wp_footer() ?>
</body>

</html>