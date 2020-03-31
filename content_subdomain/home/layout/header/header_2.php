
    <header data-scroll>
      <h1><a href="<?php echo \dash\url::kingdom(); ?>"><?php echo \dash\get::index(\lib\store::detail(), 'store_data', 'title'); ?></a></h1>
      <h2><?php echo \dash\get::index(\lib\store::detail(), 'store_data', 'desc'); ?></h2>
    </header>
    <?php \lib\app\website_menu\generate::menu('header_menu_1'); ?>
    <?php \lib\app\website_menu\generate::menu('header_menu_2'); ?>
