<?php $storeData = \dash\data::store_store_data(); ?>

<div class="avand-sm impact zero">
  <form method="post" autocomplete="off" id='aThirdParty'>
    <div class="box">
        <img class="block" src="<?php echo \dash\url::cdn(); ?>/img/thirdparty/livechat/tidio-banner-2.jpg" alt='tidio'>
        <div class="body">
          <div class="msg">
            <p><?php echo T_("Tidio is an all-round marketing and communication tool for growing your online business. See what else you can accomplish. Integration with messenger. Tidio uniquely merges live chat, Bots, and Marketing Automation."); ?></p>
            <p><?php echo T_("By adding Tidio Chat to your store you empower your customers with the quickest and most effective form of contact. Research shows that live chat can boost sales by as much as 40%. Next time your customer faces an issue, they won’t go to the competitors or waste time - they’ll contact you."); ?></p>
          </div>

          <label for="itidio">Tidio Project ID <span class="fc-red">*</span></label>
          <div class="input ltr">
            <input type="text" name="addon_tidio" id="itidio" value="<?php echo a($storeData, 'addon_tidio'); ?>" <?php \dash\layout\autofocus::html() ?> maxlength='50' minlength="1">
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


