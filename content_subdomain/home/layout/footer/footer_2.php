<footer>
  <div class="copyright"><a href="<?php echo \dash\url::kingdom(); ?>"><?php echo \dash\get::index(\lib\store::detail(), 'store_data', 'title'); ?></a></div>
<?php if(isset($website['footer_customized']['footer_menu_1']) && isset($website['menu'][$website['footer_customized']['footer_menu_1']]['list'])) {?>
  <nav>
    <?php foreach ($website['menu'][$website['footer_customized']['footer_menu_1']]['list'] as $menuValue) {?>
      <a <?php if(\dash\get::index($menuValue, 'target')) {echo 'target="_blank" data-direct ';} ?> href="<?php echo \dash\get::index($menuValue, 'url'); ?>"><?php echo \dash\get::index($menuValue, 'title'); ?></a>
    <?php }// endfor ?>
  </nav>
<?php }// endif ?>

<?php if(isset($website['footer_customized']['footer_menu_2']) && isset($website['menu'][$website['footer_customized']['footer_menu_2']]['list'])) {?>
  <nav>
    <?php foreach ($website['menu'][$website['footer_customized']['footer_menu_2']]['list'] as $menuValue) {?>
      <a <?php if(\dash\get::index($menuValue, 'target')) {echo 'target="_blank" data-direct ';} ?> href="<?php echo \dash\get::index($menuValue, 'url'); ?>"><?php echo \dash\get::index($menuValue, 'title'); ?></a>
    <?php }// endfor ?>
  </nav>
<?php }// endif ?>

</footer>
