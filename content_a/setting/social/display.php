<?php
$storeData = \dash\data::store_store_data();

?>

<div class="avand-md">
<form method="post" autocomplete="off" data-refresh data-autoScroll>

  <div  class="box impact mB25-f">
    <header><h2><?php echo T_("Set the social network link");?></h2></header>
      <div class="body">
        <p><?php echo T_("This item use in your website.");?></p>
        <div class="c4 s12">
          <div class="action f">
            <div class="c12 mB5">
              <label for="instagram"><?php echo T_("Instagram"); ?></label>
              <div class="input ltr">
                <input type="text" name="instagram" id="instagram" maxlength="50" value="<?php echo \dash\get::index($storeData, 'instagram'); ?>">
              </div>
            </div>
            <div class="c12 mB5">
              <div class="row">
                <div class="c-xs-12 c-sm-6">
                  <label for="channel"><?php echo T_("Channel"); ?></label>
                  <div class="input ltr">
                    <input type="text" name="channel" id="channel" maxlength="50" value="<?php echo \dash\data::telegramSettingSaved_channel(); ?>">
                  </div>
                </div>
                <div class="c-xs-12 c-sm-6">
                  <label for="telegram"><?php echo T_("Telegram Admin user"); ?></label>
                  <div class="input ltr">
                    <input type="text" name="telegram" id="telegram" maxlength="50" value="<?php echo \dash\get::index($storeData, 'telegram'); ?>">
                  </div>
                </div>
              </div>
            </div>
            <div class="c12 mB5">
              <label for="youtube"><?php echo T_("Youtube"); ?></label>
              <div class="input ltr">
                <input type="text" name="youtube" id="youtube" maxlength="50" value="<?php echo \dash\get::index($storeData, 'youtube'); ?>">
              </div>
            </div>

            <div class="c12 mB5">
              <label for="twitter"><?php echo T_("Twitter"); ?></label>
              <div class="input ltr">
                <input type="text" name="twitter" id="twitter" maxlength="50" value="<?php echo \dash\get::index($storeData, 'twitter'); ?>">
              </div>
            </div>

            <div class="c12 mB5">
              <label for="linkedin"><?php echo T_("Linkedin"); ?></label>
              <div class="input ltr">
                <input type="text" name="linkedin" id="linkedin" maxlength="50" value="<?php echo \dash\get::index($storeData, 'linkedin'); ?>">
              </div>
            </div>

            <div class="c12 mB5">
              <label for="github"><?php echo T_("Github"); ?></label>
              <div class="input ltr">
                <input type="text" name="github" id="github" maxlength="50" value="<?php echo \dash\get::index($storeData, 'github'); ?>">
              </div>
            </div>

            <div class="c12 mB5">
              <label for="facebook"><?php echo T_("Facebook"); ?></label>
              <div class="input ltr">
                <input type="text" name="facebook" id="facebook" maxlength="50" value="<?php echo \dash\get::index($storeData, 'facebook'); ?>">
              </div>
            </div>

            <div class="c12 mB5">
              <label for="email"><?php echo T_("Email"); ?></label>
              <div class="input ltr">
                <input type="text" name="email" id="email" maxlength="50" value="<?php echo \dash\get::index($storeData, 'email'); ?>">
              </div>
            </div>

            <div class="c12 mB5">
              <label for="aparat"><?php echo T_("Aparat"); ?></label>
              <div class="input ltr">
                <input type="text" name="aparat" id="aparat" maxlength="50" value="<?php echo \dash\get::index($storeData, 'aparat'); ?>">
              </div>
            </div>

            <div class="c12 mB5">
              <label for="eitaa"><?php echo T_("Eitaa"); ?></label>
              <div class="input ltr">
                <input type="text" name="eitaa" id="eitaa" maxlength="50" value="<?php echo \dash\get::index($storeData, 'eitaa'); ?>">
              </div>
            </div>






          </div>
        </div>
      </div>
      <footer class="txtRa">
        <button  class="btn success" ><?php echo T_("Save"); ?></button>
      </footer>
  </div>
</form>
</div>
