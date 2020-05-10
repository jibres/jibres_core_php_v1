<?php require_once('before_header.php'); ?>
<div id='jHeader100' class="avand" data-circleEffect>
  <div class="actionBar f align-center">
    <div class="cauto pRa10">
      <a class="logo" href="<?php echo \dash\url::kingdom(); ?>">
        <img src="<?php echo \lib\filepath::fix(\dash\get::index(\dash\data::website(), 'header_customized', 'header_logo')); ?>" alt="<?php echo \dash\face::site(); ?>">
      </a>
    </div>
    <div class="c">
    </div>
    <div class="cauto pRa20">
      <a class="search" href="<?php echo \dash\url::kingdom(); ?>/search"></a>
    </div>
    <div class="cauto pRa20">
      <a class="cart" href="<?php echo \dash\url::kingdom(); ?>/cart" data-count="۲"><?php echo T_("Cart"); ?></a>
    </div>
    <div class="cauto">
      <a class="enter" href="<?php echo \dash\url::kingdom(); ?>/enter"><?php echo T_("Enter to account"); ?></a>
    </div>
  </div>

  <div class="menuBar f">
    <div class="c"><?php \lib\app\website\menu\generate::menu('header_menu_1'); ?></div>
    <div class="cauto os"><?php \lib\app\website\menu\generate::menu('header_menu_2', 'xs0'); ?></div>
  </div>

</div>
