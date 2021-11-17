<?php $storeData = \dash\data::store_store_data(); ?>

<div class="avand-sm impact zero">
  <form method="post" autocomplete="off" id='aThirdParty'>
    <div  class="box">
        <div class="body">
          <img class="block mB20" src="<?php echo \dash\url::cdn(); ?>/img/thirdparty/livechat/goftino-banner.png" alt='Goftino'>
          <div class="msg">
            <p><?php echo T_("Capabilities that you need in attracting customers and better service support") ?></p>
          </div>
            <label for="igoftino"><?php echo T_("Goftino ID"); ?> <span class="fc-red">*</span></label>
            <div class="input ltr">
            <input type="text" name="addon_goftino" id="igoftino" value="<?php echo a($storeData, 'addon_goftino'); ?>" <?php \dash\layout\autofocus::html() ?> maxlength='50' minlength="1">
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


