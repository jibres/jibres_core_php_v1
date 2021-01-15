<?php $storeData = \dash\data::store_store_data(); ?>

<div class="avand-sm impact zero">
  <form method="post" autocomplete="off" id='aThirdParty'>
    <div  class="box">
        <div class="body">
          <img class="block mB20" src="<?php echo \dash\url::cdn(); ?>/img/thirdparty/imber-banner.png" alt='Imber'>
          <div class="msg">
            <p><?php echo T_("Imber is an all-in-one marketing automation platform built for customer support with live chat, sales, and marketing. All together. 7 day free trial.") ?></p>
          </div>
            <label for="iimber"><?php echo T_("Imber Token"); ?> <span class="fc-red">*</span></label>
            <div class="input ltr">
            <input type="text" name="addon_imber" id="iimber" value="<?php echo a($storeData, 'addon_imber'); ?>" <?php \dash\layout\autofocus::html() ?> maxlength='50' minlength="1">
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


