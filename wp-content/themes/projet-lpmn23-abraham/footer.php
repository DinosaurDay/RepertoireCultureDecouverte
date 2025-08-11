</main>
<footer class="navbar-dark bg-dark d-flex flex-wrap justify-content-between align-items-center py-3 border-top">
  <p class="col-md-4 mb-0 px-3 text-muted">© 2023 Noah ABRAHAM - LPMN - <?php bloginfo('name') ?></p>

  <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
    <!-- <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg> -->
  </a>
  <?php wp_nav_menu(['theme_location' => 'footer', 'container' => false, 'menu', 'menu_class' => 'nav col-md-4 justify-content-end']) ?>
</footer>
<?php wp_footer() ?>
</body>

</html>