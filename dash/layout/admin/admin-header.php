<?php
  if(\dash\engine\store::inStore())
  {
    $masterUrl  = \lib\store::url();
    $targetLink = ' target="_blank"';
  }
  else
  {
    $masterUrl  = \dash\url::kingdom();
    $targetLink = '';
  }
?>

  <div class="f">
   <div class="sidenavHandler c0 sauto mauto"><i class="sf-ellipsis-v"></i></div>
   <a class="cauto logo" <?php echo $targetLink; ?> href="<?php echo $masterUrl ?>" ><img src="<?php echo \dash\face::logo(); ?>" alt='<?php echo \dash\face::site(); ?>'></a>
   <h1 class='c'><a <?php echo $targetLink; ?> href="<?php echo $masterUrl ?>"><?php echo \dash\face::site(); ?></a></h1>
   <div class='hm right flex cauto os'>
    <a href="<?php echo \dash\url::sitelang(); ?>/support" title='<?php echo T_("Help Center"); ?>' class="support s0"><i class="sf-life-ring"></i></a>
<?php if(\dash\user::id()) { ?>
    <a href="<?php echo \dash\url::sitelang(); ?>/account/notification" title='<?php echo T_("Notifications"); ?>' class="notification"><i class="sf-bell"></i></a>
    <a class="profileShow" href="<?php echo \dash\url::kingdom(). '/account';?>">
<?php if(\dash\user::detail('avatar')) { ?>
     <img src="<?php echo \dash\user::detail('avatar'); ?>" alt='<?php echo T_("Avatar of you"); ?> <?php echo \dash\user::detail('displayname'); ?>'>
<?php }elseif(\dash\user::id()){ ?>
     <img src="<?php echo \dash\url::siftal(); ?>/images/default/avatar.png" alt='<?php echo T_("Default Avatar"); ?>'>
<?php }else{ ?>
     <img src="<?php echo \dash\url::cdn(); ?>/img/avatar/guest.png" alt='<?php echo T_("Default Avatar"); ?>'>
<?php } //endif ?>
    </a>
<?php }else{ ?>
    <a href="<?php echo \dash\url::kingdom(); ?>/enter?referer=<?php echo \dash\url::pwd() ?>" title='<?php echo T_("Enter to have better experience"); ?>'><i class="sf-hand-stop"></i></a>
<?php } //endif ?>
   </div>
  </div>