  <div class="blogEx sample">
    <header data-scroll>
      <h1><a href="<?php echo \dash\url::kingdom(); ?>"><?php echo \dash\get::index(\lib\store::detail(), 'store_data', 'title'); ?></a></h1>
      <h2><?php echo \dash\get::index(\lib\store::detail(), 'store_data', 'desc'); ?></h2>
    </header>
    <nav>
      <a href="#"><?php echo T_("Homepage"); ?></a>
      <a href="#"><?php echo T_("About"); ?></a>
      <a href="#"><?php echo T_("Contact"); ?></a>

    </nav>
    <nav>
      <a href="#"><?php echo T_("Homepage"); ?></a>
      <a href="#"><?php echo T_("About"); ?></a>
      <a href="#"><?php echo T_("Contact"); ?></a>

    </nav>


    <footer>
      <div class="copyright"><a href="<?php echo \dash\url::kingdom(); ?>"><?php echo \dash\get::index(\lib\store::detail(), 'store_data', 'title'); ?></a></div>
    </footer>
  </div>