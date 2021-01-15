<?php $storeData = \dash\data::store_store_data(); ?>

<div class="avand-sm impact zero">
  <form method="post" autocomplete="off" id='aThirdParty'>
    <div class="box">
          <img class="block mB10" src="<?php echo \dash\url::cdn(); ?>/img/thirdparty/tawk-banner.jpg" alt='tawk.to'>
        <div class="body">
          <p class="msg"><?php echo T_("Google Analytics is a web analytics service offered by Google that tracks and reports website traffic, currently as a platform inside the Google Marketing Platform brand. As of 2019, Google Analytics is the most widely used web analytics service on the web. Google Analytics provides an SDK that allows gathering usage data from iOS and Android app, known as Google Analytics for Mobile Apps."); ?></p>

          <p class="mB0-f"><?php echo T_("If you want to have live chat in your website, enter your tawk token code here. \nTo do this, you need to register on tawk.to and get the code from there"); ?></p>
            <label for="itawk"><?php echo T_("Tawk code"); ?> <span class="fc-red">*</span></label>
            <div class="input ltr">
            <input type="text" name="addon_tawk" id="itawk" value="<?php echo a($storeData, 'addon_tawk'); ?>" <?php \dash\layout\autofocus::html() ?> maxlength='50' minlength="1"  required>
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


