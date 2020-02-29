


<div class="f justify-center">
  <div class="c4 s12">
    <div class="cbox">

      <a href="https://api.jibres.<?php echo \dash\url::tld(); ?>" class="btn block outline"><?php echo \dash\data::myTitle(); ?></a>


      <?php if(!\dash\user::detail('verifymobile')) {?>

      <a href="<?php echo \dash\url::kingdom(); ?>/enter/verify?referer=<?php echo \dash\url::pwd(); ?>" target="_blank"  class="msg block warn txtB txtC mT10"><?php echo T_("To make your appkey you must verify your mobile"); ?></a>
      <?php }else{ ?>
        <div class="msg warn2 mT20">
          <div><?php echo T_("Protect this key like a password!"); ?></div>
          <div><?php echo T_("By this code you can build new application to manage your account and manage other customer"); ?></div>
        </div>
      <?php } //endif ?>

      <form method="post">
        <input type="hidden" name="add" value="appkey">
        <div class="input">
          <label><?php echo T_("YOUR APPKEY"); ?></label>
          <input type="text" name="appkey" value="<?php echo \dash\data::appkey_auth(); ?>" readonly  class="txtC" placeholder='<?php echo T_("GENERATE YOUR APPKEY"); ?>'>
        </div>

    	<?php if(\dash\data::appkey_auth()) {?>

        <div class="msg info2 mT20">
          <div><?php echo T_("If you want to revoke or remove this appkey"); ?> <a href="<?php echo \dash\url::kingdom(); ?>/support/ticket/add?title=remove appkey"><?php echo T_("Contact us"); ?></a></div>
        </div>

      <?php }else{ ?>

        <button data-confirm data-data='{"add" : "appkey"}' class="btn primary mT5 block"><?php echo T_("Make appkey"); ?></button>
      <?php } //endif ?>

      </form>

    </div>


    <?php if(\dash\data::listStore_owner() && is_array(\dash\data::listStore_owner())) {?>

      <div class="cbox">
        <h3><?php echo T_("Your Stores code to use in api"); ?></h3>

          <?php foreach (\dash\data::listStore_owner() as $key => $value) {?>

          <div class="" >
            <div href='<?php echo \dash\get::index($value, 'url'); ?>/a' class="scard">
              <img src="<?php echo \dash\get::index($value, 'logo'); ?>" alt="<?php echo \dash\get::index($value, 'title'); ?>">
              <div class="body">
                <h2><?php echo \dash\get::index($value, 'title'); ?></h2>
                <div class="position txtRa">
                  <code class="ltr"><?php echo \dash\coding::encode(\dash\get::index($value, 'store_id')); ?></code>
                </div>

              </div>
            </div>
          </div>
        <?php } //endfor ?>

      </div>
      <?php } //endif ?>


    </div>

  </div>

</div>
