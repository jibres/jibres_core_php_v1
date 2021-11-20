<div class="avand-sm">
  <form method="post" autocomplete="off">
    <div  class="box">
      <div class="body">
        <img src="<?php echo \dash\url::cdn(); ?>/img/logo/social/instagram.svg" alt='Instagram'>
        <div class="alert2">
          <p><?php echo T_("Enter your account username in instagram.") ?></p>
        </div>
        <div class="input ltr">
          <input type="text" name="instagram" id="instagram" maxlength="50" value="<?php echo \lib\store::social('instagram', true); ?>">
        </div>
      </div>
      <footer class="txtRa">
        <button  class="btn-success" ><?php echo T_("Save"); ?></button>
      </footer>
    </div>
  </form>
  <?php if(\dash\permission::supervisor()) {?>
  <div  class="box">
    <div class="body">
      <div class="alert2">
        <p><?php echo T_("Connect to your instagram account.") ?></p>
        <?php if(\dash\data::instagramUserId()) {?>
        <p class="alert2-success"><?php echo T_("Connected.") ?></p>
        <code><?php echo \dash\data::instagramAccessToken() ?></code>
        <code><?php echo \dash\data::instagramUserId(); ?></code>

        <div data-confirm data-data='{"instagram": "remove_token"}' data-method='post' class="btn-danger" ><?php echo T_("Remove"); ?></div>
        <?php } //endif ?>
      </div>
    </div>
    <footer class="txtRa">
      <div data-ajaxify data-data='{"instagram": "login"}' data-method='post' class="btn-primary" ><?php echo T_("Connect"); ?></div>
    </footer>
  </div>
<?php } //endif ?>
</div>
