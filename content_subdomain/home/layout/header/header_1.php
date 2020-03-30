
    <header data-scroll>
      <h1><a href="<?php echo \dash\url::kingdom(); ?>"><?php echo \dash\get::index(\lib\store::detail(), 'store_data', 'title'); ?></a></h1>
      <h2><?php echo \dash\get::index(\lib\store::detail(), 'store_data', 'desc'); ?></h2>
    </header>
<?php if(isset($website['header_customized']['header_menu_2']) && isset($website['menu'][$website['header_customized']['header_menu_2']]['list'])) {?>
  <nav>
    <?php foreach ($website['menu'][$website['header_customized']['header_menu_2']]['list'] as $menuValue) {?>
      <a <?php if(\dash\get::index($menuValue, 'target')) {echo 'target="_blank" data-direct ';} ?> href="<?php echo \dash\get::index($menuValue, 'url'); ?>"><?php echo \dash\get::index($menuValue, 'title'); ?></a>
    <?php }// endfor ?>
  </nav>
<?php }// endif ?>
