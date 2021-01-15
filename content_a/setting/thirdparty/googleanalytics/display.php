<?php $storeData = \dash\data::store_store_data(); ?>

<div class="avand-sm zero">
  <form method="post" autocomplete="off" id='aThirdParty'>
    <div class="box impact">
      <div class="body">
        <img class="block" src="<?php echo \dash\url::cdn(); ?>/img/thirdparty/google-analytics-banner.png" alt='Google Analytics'>
        <p class="msg"><?php echo T_("Google Analytics is a web analytics service offered by Google that tracks and reports website traffic, currently as a platform inside the Google Marketing Platform brand. As of 2019, Google Analytics is the most widely used web analytics service on the web. Google Analytics provides an SDK that allows gathering usage data from iOS and Android app, known as Google Analytics for Mobile Apps."); ?></p>

          <label for="igoogleanalytics"><?php echo T_("Your Google Analytics Tracking ID"); ?> <span class="fc-red">*</span></label>
          <div class="input ltr">
            <input type="text" name="google_analytics" id="igoogleanalytics" placeholder="UA-123456789-0"  value="<?php echo a($storeData, 'google_analytics'); ?>" <?php \dash\layout\autofocus::html() ?> maxlength='20' minlength="1">
          </div>
      </div>
<?php if (!\dash\detect\device::detectPWA()) { ?>
      <footer class="txtRa">
        <button class="btn success" ><?php echo T_("Save"); ?></div>
      </footer>
<?php } ?>
    </div>
  </form>
</div>


