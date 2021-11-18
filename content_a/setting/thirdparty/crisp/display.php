<?php $storeData = \dash\data::store_store_data(); ?>

<div class="avand-sm impact zero">
  <form method="post" autocomplete="off" id='aThirdParty'>
    <div class="box">
        <img class="block" src="<?php echo \dash\url::cdn(); ?>/img/thirdparty/livechat/crisp-banner.png" alt='crisp'>
        <div class="body">
          <div class="alert2">
            <p><?php echo T_("Crisp Live Chat is a free and beautiful chat for your website. Crisp allows you to embed a free live chat module to your website and let site visitors chat with you."); ?></p>
          </div>

          <label for="itawk">Crisp Website ID <span class="fc-red">*</span></label>
          <div class="input ltr">
            <input type="text" name="addon_crisp" id="itawk" value="<?php echo a($storeData, 'addon_crisp'); ?>" <?php \dash\layout\autofocus::html() ?> maxlength='50' minlength="1">
          </div>
        </div>
<?php if (!\dash\detect\device::detectPWA()) { ?>
        <footer class="txtRa">
          <button  class="btn-success" ><?php echo T_("Save"); ?></div>
        </footer>
<?php } ?>
    </div>
  </form>
</div>


