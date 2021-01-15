<?php $storeData = \dash\data::store_store_data(); ?>


<div class="avand-sm zero">
  <form method="post" autocomplete="off" id='aThirdParty'>
    <div  class="box impact mB25-f">
      <header><h2><?php echo T_("Set raychat live chat setting");?></h2></header>
        <div class="body">
          <p class="mB0-f"><?php echo T_("If you want to have live chat in your website, enter your raychat token code here. \nTo do this, you need to register on raychat.to and get the code from there"); ?></p>
            <label for="iraychat"><?php echo T_("Raychat code"); ?> <span class="fc-red">*</span></label>
            <div class="input ltr">
            <input type="text" name="addon_raychat" id="iraychat" value="<?php echo a($storeData, 'addon_raychat'); ?>" <?php \dash\layout\autofocus::html() ?> maxlength='50' minlength="1"  required>
            </div>
        </div>
<?php if (!\dash\detect\device::detectPWA()) { ?>
        <footer class="txtRa">
          <button  class="btn success" ><?php echo T_("Save"); ?></div>
        </footer>
<?php } ?>
    </div>
  </form>
</div>


