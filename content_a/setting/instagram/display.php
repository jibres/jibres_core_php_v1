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
      </div>
        <?php if(\dash\data::instagramUserId()) {?>
        <p data-token='<?php echo \dash\data::instagramAccessToken() ?>' data-userid='<?php echo \dash\data::instagramUserId() ?>' class="alert2-success"><?php echo T_("Connected.") ?></p>
        <?php if(\dash\data::myInstagramPosts()) {?>
          <div class="row">
          <?php foreach (\dash\data::myInstagramPosts() as $key => $value) { ?>
            <div class="c-xs-4 c-sm-4">
              <img src="<?php echo a($value, 'media_url') ?>" class='w-28'>
            </div>
          <?php } //endif ?>
          </div>
        <?php }//endif ?>
        <?php } //endif ?>

    </div>
    <footer class="">
      <div class="row">
        <div class="c-auto">
          <?php if(\dash\data::instagramUserId()) {?>
            <div data-confirm data-data='{"ig_action": "remove_token"}' data-method='post' class="btn-danger" ><?php echo T_("Remove"); ?></div>
          <?php } //endif ?>
        </div>
        <div class="c"></div>
        <div class="c-auto">
          <div data-ajaxify data-data='{"ig_action": "login"}' data-method='post' class="btn-primary" ><?php echo T_("Connect"); ?></div>
        </div>
      </div>
    </footer>
  </div>

<?php } //endif ?>
</div>

