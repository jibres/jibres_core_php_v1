<?php $storeData = \dash\data::store_store_data(); ?>

<div class="avand-sm impact zero">
  <form method="post" autocomplete="off" id='aThirdParty'>
    <div class="box">
        <div class="body">
          <img class="block mB10" src="<?php echo \dash\url::cdn(); ?>/img/thirdparty/raychat-banner.png" alt='raychat'>
          <div class="msg">
            <p><?php echo T_("Raychat is a free customer messaging platform. Chat with your customers and make them a loyal customer.") ?></p>
          </div>

          <label for="iraychat"><?php echo T_("Raychat Token"); ?> <span class="fc-red">*</span></label>
          <div class="input ltr">
            <input type="text" name="addon_raychat" id="iraychat" value="<?php echo a($storeData, 'addon_raychat'); ?>" <?php \dash\layout\autofocus::html() ?> maxlength='50' minlength="1">
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


