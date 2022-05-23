<div class="main-footer_wrapper">
  <?php get_template_part('assets/template-parts/contact-us-block/contact-us-block'); ?>
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
</div>
<?php wp_footer() ?>
</body>

</html>