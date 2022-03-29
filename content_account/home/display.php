
<section class="text-center mb-4 select-none">
  <a href="<?php echo \dash\url::here(); ?>/my/avatar" class="inline-block mb-2">
    <?php if(\dash\user::detail('avatar'))  {?>
      <img class="w-36 rounded-full" src="<?php echo \dash\user::detail('avatar'); ?>" alt='<?php echo T_("Avatar of you"); ?> <?php echo \dash\user::detail('displayname'); ?>'>
    <?php }elseif(\dash\user::id()) {?>
      <img class="w-36 rounded-full" src="<?php echo \dash\url::siftal(); ?>/images/default/avatar.png" alt='<?php echo T_("Default Avatar"); ?>'>
    <?php } // endif ?>
  </a>
  <h2 class="leading-loose text-lg"><?php echo T_("Welcome"); ?><?php echo T_(","); ?> <span class="font-bold"><?php echo \dash\user::detail('fullname'); ?></span></h2>
  <p class="leading-loose text-sm text-zinc-600"><?php echo T_("Manage your info, privacy, and security to make us work better for you"); ?></p>
</section>

<?php if(!\dash\user::detail('verifymobile'))  {?>
  <a href="<?php echo \dash\url::kingdom(). '/enter/verify'; ?>" target="_blank" class="alert-warning text-center font-bold block mb-2"><?php echo T_("Your account is not verify! Please verify your mobile number."); ?></a>
<?php }//endif ?>

<div class="flex flex-row flex-wrap text-sm select-none">
  <div class="basis-full lg:basis-1/2 p-2">

    <section class="bg-white rounded-lg border">
      <div class="flex items-center p-4">
        <div class="grow">
          <h3 class="text-xl font-bold leading-loose"><?php echo T_("Personal info"); ?></h3>
          <p class="text-zinc-500 leading-5"><?php echo T_("Basic info, like your name and photo, that you use on our services"); ?></p>
        </div>
        <div class="flex-none">
          <img class="w-16 h-16" src="<?php echo \dash\url::cdn(); ?>/img/account/profile.png" alt='<?php echo T_("profile"); ?>'>
        </div>
      </div>
      <footer class="border-t">
        <a class="px-4 py-2 block btn-outline-primary transition" href="<?php echo \dash\url::here(); ?>/my"><?php echo T_("Manage profile"); ?></a>
      </footer>
    </section>
  </div>


  <div class="basis-full lg:basis-1/2 p-2">
    <section class="bg-white rounded-lg border">
      <div class="flex items-center p-4">
        <div class="grow">
          <h3 class="text-xl font-bold leading-loose"><?php echo T_("Security"); ?></h3>
          <p class="text-zinc-500 leading-5"><?php echo T_("Settings and recommendations to help you keep your account secure"); ?></p>
        </div>
        <div class="flex-none">
          <img class="w-16 h-16" src="<?php echo \dash\url::cdn(); ?>/img/account/security.png" alt='<?php echo T_("Security"); ?>'>
        </div>
      </div>
      <footer class="border-t">
        <a class="px-4 py-2 block btn-outline-primary transition" href="<?php echo \dash\url::here(); ?>/security"><?php echo T_("Keep your account protected"); ?></a>
      </footer>
    </section>

  </div>

  <div class="basis-full lg:basis-1/2 p-2">

    <section class="bg-white rounded-lg border">
      <div class="flex items-center p-4">
        <div class="grow">
          <h3 class="text-xl font-bold leading-loose"><?php echo T_("Billing"); ?></h3>
          <p class="text-zinc-500 leading-5"><?php echo T_("Check your account balance, charge your account, and bill your invoices!"); ?></p>
        </div>
        <div class="flex-none">
          <img class="w-16 h-16" src="<?php echo \dash\url::cdn(); ?>/img/account/billing.png" alt='<?php echo T_("Billing"); ?>'>
        </div>
      </div>
      <footer class="border-t">
        <a class="px-4 py-2 block btn-outline-primary transition" href="<?php echo \dash\url::here(); ?>/billing"><?php echo T_("Check"); ?></a>
      </footer>
    </section>

  </div>

  <div class="basis-full lg:basis-1/2 p-2">

    <section class="bg-white rounded-lg border">
      <div class="flex items-center p-4">
        <div class="grow">
          <h3 class="text-xl font-bold leading-loose"><?php echo T_("Notifications"); ?></h3>
          <p class="text-zinc-500 leading-5"><?php echo T_("Check your last messages."); ?> <?php echo T_("Maybe some messages need your action!"); ?></p>
        </div>
        <div class="flex-none">
          <img class="w-16 h-16" src="<?php echo \dash\url::cdn(); ?>/img/account/notification.png" alt='<?php echo T_("Notifications"); ?>'>
        </div>
      </div>
      <footer class="border-t">
        <a class="px-4 py-2 block btn-outline-primary transition" href="<?php echo \dash\url::here(); ?>/notification"><?php echo T_("Read your messages"); ?></a>
      </footer>
    </section>
  </div>


  <div class="basis-full lg:basis-1/2 p-2">

    <section class="bg-white rounded-lg border">
      <div class="flex items-center p-4">
        <div class="grow">
          <h3 class="text-xl font-bold leading-loose"><?php echo T_("Support"); ?></h3>
          <p class="text-zinc-500 leading-5"><?php echo T_("Get expert answers and advice on our service or contact our legendary support team"); ?></p>
        </div>
        <div class="flex-none">
          <img class="w-16 h-16" src="<?php echo \dash\url::cdn(); ?>/img/account/support.png" alt='<?php echo T_("Support"); ?>'>
        </div>
      </div>
      <footer class="border-t">
        <a class="px-4 py-2 block btn-outline-primary transition" href="<?php echo \dash\url::kingdom(). '/my/ticket'; ?>"><?php echo T_("Tickets"); ?></a>
      </footer>
    </section>

  </div>

  <div class="basis-full lg:basis-1/2 p-2">
    <section class="bg-white rounded-lg border">
      <div class="body pad f">
        <div class="c">

          <?php echo T_("Logout from your account!"); ?>
        </div>
        <div class="cauto os">
          <i class="sf-log-out fs14"></i>
        </div>

      </div>
      <footer class="border-t">
        <a class="px-4 py-2 block btn-outline-primary transition" href="<?php echo \dash\url::sitelang(); ?>/logout"><?php echo T_("Logout"); ?></a>
      </footer>
    </section>
  </div>


</div>

<div class="text-center text-xs select-none">
  <div class="alert-light"><?php echo T_("Only you can see your settings."); ?> <?php echo T_("We are committed to protecting your privacy and security."); ?> <a href="<?php echo \dash\url::kingdom(); ?>/privacy" target="_blank"><?php echo T_("Learn more"); ?></a></div>
</div>
