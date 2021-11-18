<?php $storeData = \dash\data::store_store_data(); ?>

<div class="avand-sm impact zero">
  <form method="post" autocomplete="off" id='aThirdParty'>
    <div  class="box">
        <img class="block B20" src="<?php echo \dash\url::cdn(); ?>/img/thirdparty/livechat/goftino-banner.jpg" alt='Goftino'>
        <div class="body">
          <div class="alert2">
            <p><?php echo T_("Goftino is a communication service to chat with customers on your website and answer questions upon their behaviors.") ?></p>
          </div>
          <label for="igoftino"><?php echo T_("Goftino ID"); ?> <span class="fc-red">*</span></label>
          <div class="input ltr">
            <input type="text" name="addon_goftino" id="igoftino" value="<?php echo a($storeData, 'addon_goftino'); ?>" <?php \dash\layout\autofocus::html() ?> maxlength='50' minlength="1">
          </div>
          <div class="alert-danger"><?php echo T_("This service is disabled due to a security problem."); ?></div>
        </div>
<?php if (!\dash\detect\device::detectPWA()) { ?>
        <footer class="txtRa">
          <button  class="btn-success" ><?php echo T_("Save"); ?></div>
        </footer>
<?php } ?>
    </div>
  </form>
</div>


