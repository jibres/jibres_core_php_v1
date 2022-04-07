<div class="avand-md">
  <div class="box">
    <div class="body">
      <a target="_blank" href="https://jibres.<?php echo \dash\url::tld(); ?>/api" class="btn block outline"><?php echo \dash\data::myTitle(); ?></a>
      <?php if(!\dash\user::detail('verifymobile')) {?>
        <a href="<?php echo \dash\url::kingdom(); ?>/enter/verify?referer=<?php echo urlencode(\dash\url::location()); ?>" target="_blank"  class="msg block warn font-bold text-center mt-2"><?php echo T_("To make your appkey you must verify your mobile"); ?></a>
      <?php }else{ ?>
        <div class="alert-warning mt-4">
          <div><?php echo T_("Protect this key like a password!"); ?></div>
          <div><?php echo T_("By this code you can build new application to manage your account and manage other customer"); ?></div>
        </div>
      <?php } //endif ?>
      <div class="input">
        <label><?php echo T_("YOUR APPKEY"); ?></label>
        <input type="text" name="appkey" value="<?php echo \dash\data::appkey_auth(); ?>" readonly  class="text-center" placeholder='<?php echo T_("GENERATE YOUR APPKEY"); ?>' data-copy="<?php echo \dash\data::appkey_auth(); ?>">
      </div>
      <?php if(\dash\data::appkey_auth()) {?>
        <div class="alert-info mt-4">
          <div><?php echo T_("If you want to revoke or remove this appkey"); ?> <a href="<?php echo \dash\url::kingdom(); ?>/my/ticket/add?title=remove appkey"><?php echo T_("Contact us"); ?></a></div>
        </div>
      <?php }else{ ?>
        <button data-confirm data-data='{"add" : "appkey" <?php echo \dash\csrf::get_json(); ?>}' class="btn-primary mT5 block"><?php echo T_("Make appkey"); ?></button>
      <?php } //endif ?>
    </div>
  </div>

<?php if(\dash\data::listStore_owner() && is_array(\dash\data::listStore_owner())) {?>
  <div class="box">
    <div class="body">
      <h3 class="mb-4"><?php echo T_("Your Stores code to use in api"); ?></h3>
      <nav class="items">
       <?php foreach (\dash\data::listStore_owner() as $key => $value) {?>
        <ul class="item">
         <li>
          <div href='<?php echo a($value, 'url'); ?>/a' class="item f">
            <img src="<?php echo a($value, 'logo'); ?>" alt="<?php echo a($value, 'title'); ?>">
            <div class="key"><?php echo a($value, 'title'); ?></div>
            <code class="value"><?php echo a($value, 'store_code'); ?></code>
          </div>
         </li>
        </ul>
      <?php } //endfor ?>
      </nav>
    </div>
  </div>
<?php } //endif ?>
</div>