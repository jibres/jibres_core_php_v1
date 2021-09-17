<?php $storeData = \dash\data::store_store_data(); ?>

<div class="avand-sm impact zero">
  <form method="post" autocomplete="off" id='aThirdParty'>
    <div class="box">
      <img class="block" src="<?php echo \dash\url::cdn(); ?>/img/thirdparty/analytics/hotjar-banner.jpg" alt='hotjar'>
      <div class="body">
        <div class="msg">
          <p><?php echo T_("Understand how users behave on your site, what they need, and how they feel, fast. Heatmaps visually represent where users click, move, and scroll on your site. With this context, you'll learn how users really behave."); ?></p>
        </div>
        <div class="ltr">
          <label for="ihotjar">Site ID <span class="fc-red">*</span></label>
          <div class="input ltr">
            <input type="text" name="addon_hotjar" id="ihotjar" placeholder="" value="<?php echo a($storeData, 'addon_hotjar'); ?>" <?php \dash\layout\autofocus::html() ?> maxlength='20' minlength="1">
          </div>
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


