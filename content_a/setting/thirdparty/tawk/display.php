<?php $storeData = \dash\data::store_store_data(); ?>

<div class="avand-sm impact zero">
  <form method="post" autocomplete="off" id='aThirdParty'>
    <div class="box">
        <img class="block" src="<?php echo \dash\url::cdn(); ?>/img/thirdparty/tawk-banner.jpg" alt='tawk.to'>
        <div class="body">
          <div class="msg">
            <p><?php echo T_("tawk.to is the world's #1 most widely used live chat software. More than 35% of all websites that use live chat. tawk.to is a 100% free live chat application designed to increase the effectiveness in managing the online customer engagement experience, enabling multiple websites and agents in a single dashboard interface to chat with the visitors on your website."); ?></p>
            <p><?php echo T_("tawk.to offers iOS, Android, Windows and Mac OSX apps to stay connected, or you can log in via any modern browser."); ?></p>
          </div>

          <label for="itawk">tawk.to Property ID <span class="fc-red">*</span></label>
          <div class="input ltr">
            <input type="text" name="addon_tawk" id="itawk" value="<?php echo a($storeData, 'addon_tawk'); ?>" <?php \dash\layout\autofocus::html() ?> maxlength='50' minlength="1">
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


