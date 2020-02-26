


<div class="txtC fs14 mTB10">
  <div class="avatar">
    <a href="<?php echo \dash\url::here(); ?>/my/avatar" class="compact">
<?php if(\dash\user::detail('avatar'))  {?>
      <img class="box100 circle" src="<?php echo \dash\user::detail('avatar'); ?>" alt='<?php echo T_("Avatar of you"); ?> <?php echo \dash\user::detail('displayname'); ?>'>
<?php }elseif(\dash\user::id()) {?>
      <img class="box100 circle" src="<?php echo \dash\url::siftal(); ?>/images/default/avatar.png" alt='<?php echo T_("Default Avatar"); ?>'>
<?php } // endif ?>
    </a>
  </div>
  <h2><?php echo T_("Welcome"); ?><?php echo T_(","); ?> <?php echo \dash\user::detail('fullname'); ?></h2>
  <p><?php echo T_("Manage your info, privacy, and security to make us work better for you"); ?></p>
</div>

<div class="f fs14">
  <div class="c6 x4 s12 pA10">

    <div class="panel">
      <div class="body pad f">
        <div class="c9 s12">
          <h3><?php echo T_("Personal info"); ?></h3>
          <p><?php echo T_("Basic info, like your name and photo, that you use on our services"); ?></p>
        </div>
        <div class="c3 s12">
          <img class="box100" src="<?php echo \dash\url::siftal(); ?>/images/account/profile.png" alt='<?php echo T_("profile"); ?>'>
        </div>
      </div>
      <hr>
      <footer>
        <a class="special pad" href="<?php echo \dash\url::here(); ?>/my"><?php echo T_("Manage profile"); ?></a>
      </footer>
    </div>
  </div>


  <div class="c6 x4 s12 pA10">
      <div class="panel">
        <div class="body pad f">
          <div class="c9 s12">
            <h3><?php echo T_("Security"); ?></h3>
            <p><?php echo T_("Settings and recommendations to help you keep your account secure"); ?></p>
          </div>
          <div class="c3 s12">
            <img class="box100" src="<?php echo \dash\url::siftal(); ?>/images/account/security.png" alt='<?php echo T_("Security"); ?>'>
          </div>
        </div>
        <hr>
        <footer>
          <a class="special pad" href="<?php echo \dash\url::here(); ?>/security"><?php echo T_("Keep your account protected"); ?></a>
        </footer>
      </div>

  </div>


  <div class="c6 x4 s12 pA10">

      <div class="panel">
        <div class="body pad f">
          <div class="c9 s12">
            <h3><?php echo T_("Personalization"); ?></h3>
            <p><?php echo T_("See the data in your account and choose what activity is saved to personalize your experience"); ?></p>
          </div>
          <div class="c3 s12">
            <img class="box100" src="<?php echo \dash\url::siftal(); ?>/images/account/personalization.png" alt='<?php echo T_("Personalization"); ?>'>
          </div>
        </div>
        <hr>
        <footer>
          <a class="special pad" href="<?php echo \dash\url::here(); ?>/personalization"><?php echo T_("Manage your data & personalization"); ?></a>
        </footer>
      </div>


  </div>
  <div class="c6 x4 s12 pA10">

      <div class="panel">
        <div class="body pad f">
          <div class="c9 s12">
            <h3><?php echo T_("Notifications"); ?></h3>
            <p><?php echo T_("Check your last messages."); ?> <?php echo T_("Maybe some messages need your action!"); ?></p>
          </div>
          <div class="c3 s12">
            <img class="box100" src="<?php echo \dash\url::siftal(); ?>/images/account/notification.png" alt='<?php echo T_("Notifications"); ?>'>
          </div>
        </div>
        <hr>
        <footer>
          <a class="special pad" href="<?php echo \dash\url::here(); ?>/notification"><?php echo T_("Read your messages"); ?></a>
        </footer>
      </div>
  </div>


  <div class="c6 x4 s12 pA10">

      <div class="panel">
        <div class="body pad f">
          <div class="c9 s12">
            <h3><?php echo T_("Support"); ?></h3>
            <p><?php echo T_("Get expert answers and advice on our service or contact our legendary support team"); ?></p>
          </div>
          <div class="c3 s12">
            <img class="box100" src="<?php echo \dash\url::siftal(); ?>/images/account/support.png" alt='<?php echo T_("Support"); ?>'>
          </div>
        </div>
        <hr>
        <footer>
          <a class="special pad" href="<?php echo \dash\url::kingdom(); ?>/support"><?php echo T_("Get help"); ?></a>
        </footer>
      </div>

  </div>

  <div class="c6 x4 s12 pA10">

      <div class="panel">
        <div class="body pad f">
          <div class="c9 s12">
            <h3><?php echo T_("Billing"); ?></h3>
            <p><?php echo T_("Check your account balance, charge your account, and bill your invoices!"); ?></p>
          </div>
          <div class="c3 s12">
            <img class="box100" src="<?php echo \dash\url::siftal(); ?>/images/account/billing.png" alt='<?php echo T_("Billing"); ?>'>
          </div>
        </div>
        <hr>
        <footer>
          <a class="special pad" href="<?php echo \dash\url::here(); ?>/billing"><?php echo T_("Check"); ?></a>
        </footer>
      </div>

  </div>

</div>

<div class="txtC fs14 mT5 pLR10">
  <div class="msg mB0"><?php echo T_("Only you can see your settings."); ?> <?php echo T_("We are committed to protecting your privacy and security."); ?> <a href="<?php echo \dash\url::kingdom(); ?>/privacy" target="_blank"><?php echo T_("Learn more"); ?></a></div>
</div>
