<?php require_once('before_header.php'); ?>
<div id='jHeader100' class="avand" data-circleEffect>
  <div class="actionBar row align-center">
    <div class="c-auto c-xs-0">
      <a class="logo" href="<?php echo \dash\url::kingdom(); ?>"><?php
$logo = \lib\website::logo();
if($logo)
{
  echo '<img src="'. $logo. '" alt="'. \dash\face::site(). '">';
  echo '<h1>'. \dash\face::site(). '</h1>';
}
else
{
  echo '<h1>'. \dash\face::site(). '</h1>';
}
?></a>
    </div>
    <div class="c s0"></div>
    <div class="c-auto">
      <a class="search" href="<?php echo \dash\url::kingdom(); ?>/search"></a>
    </div>
    <div class="c-auto">
      <a class="cart" href="<?php echo \dash\url::kingdom(); ?>/cart" data-count="<?php echo \dash\fit::number(\lib\website::cart_count()); ?>"><span class="d-xs-none"><?php echo T_("Cart"); ?></span></a>
    </div>
    <div class="c-auto">
      <?php if(\dash\user::login()) {?>
        <a class="enter" href="<?php echo \dash\url::kingdom(); ?>/profile"><?php echo T_("Profile"); ?></a>
      <?php }else{ ?>
        <a class="enter" href="<?php echo \dash\url::kingdom(); ?>/enter"><?php echo T_("Enter to account"); ?></a>
      <?php } //endif ?>
    </div>
  </div>

  <?php if(\lib\website::have_header_menu()) {?>
  <div class="menuBar row">
    <div class="c"><?php \lib\website::menu('header_menu_1'); ?></div>
    <div class="c-auto os"><?php \lib\website::menu('header_menu_2', 'xs0'); ?></div>
  </div>
<?php } //endif ?>

</div>
