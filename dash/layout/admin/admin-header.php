  <div class="f">
   <div class="sidenavHandler c0 sauto mauto"><i class="sf-ellipsis-v"></i></div>


   <a class="cauto logo" href="<?php echo \dash\url::kingdom(); ?>" ><img src="<?php echo \dash\data::site_logo(); ?>" alt='<?php echo \dash\data::site_title(); ?>'></a>
   <h1 class='c'><a href="<?php echo \dash\url::kingdom(); ?>"><?php echo \dash\data::site_title(); ?></a></h1>




   <div class='hm right flex cauto os'>

    <a href="<?php echo \dash\url::sitelang(); ?>/support" title='<?php echo T_("Help Center"); ?>' class="support s0"><i class="sf-life-ring"></i></a>

<?php if(\dash\user::id()) { ?>
    <a href="<?php echo \dash\url::sitelang(); ?>/account/notification" title='<?php echo T_("Notifications"); ?>' class="notification"><i class="sf-bell"></i></a>

    <div class="profileShow" title='<?php echo \dash\data::site_title(); ?><br><?php echo \dash\data::userBadge_desc(); ?>'
    data-desc='<?php echo \dash\data::userBadge_desc(); ?>'
    data-footer='<?php echo \dash\data::userBadge_footer(); ?>'
    data-confirmTxt='<?php echo T_("Account"); ?> <i class="sf-user"></i>' data-confirmLink='<?php echo \dash\url::kingdom(); ?>/account'
    data-cancelTxt='<?php echo T_("Logout"); ?> <i class="sf-out mLa10"></i>'
    data-logoutConfirmTxt='<?php echo T_("You really want to go?"); ?>'
    data-logoutTxt='<?php echo T_("We are waiting for you to come back:)"); ?> ☺️'
    data-logoutUrl='<?php echo \dash\url::kingdom(); ?>/logout'>
<?php if(\dash\user::detail('avatar')) { ?>
     <img src="<?php echo \dash\user::detail('avatar'); ?>" alt='<?php echo T_("Avatar of you"); ?> <?php echo \dash\user::detail('displayname'); ?>'>
<?php }elseif(\dash\user::id()){ ?>
     <img src="<?php echo \dash\url::cdn(); ?>/siftal/images/default/avatar.png" alt='<?php echo T_("Default Avatar"); ?>'>
<?php }else{ ?>

     <img src="<?php echo \dash\url::cdn(); ?>/siftal/images/avatar/guest.png" alt='<?php echo T_("Default Avatar"); ?>'>

<?php } //endif ?>
    </div>
<?php }else{ ?>
    <a href="<?php echo \dash\url::kingdom(); ?>/enter?referer={{url.pwd}}" title='<?php echo T_("Enter to have better experience"); ?>'><i class="sf-hand-stop"></i></a>

<?php } //endif ?>


   </div>
  </div>