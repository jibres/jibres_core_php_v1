<?php $storeData = \lib\store::detail(); ?>

<div class="avand-sm impact zero">
  <form method="post" autocomplete="off" id='aThirdParty'>
    <div  class="box">
      <img class="block" src="<?php echo \dash\url::cdn(); ?>/img/thirdparty/torob-logo.svg" alt='torob'>
      <div class="body">
        <div class="msg">
          <p><?php echo T_("Active torob api module") ?></p>
        </div>

        <div class="switch1">
          <input type="checkbox" name="torob_api" id="istatus" <?php if(a($storeData, 'store_data', 'torob_api')) { echo 'checked'; }; ?>>
          <label for="istatus"></label>
          <label for="istatus"><?php echo T_("Active torob") ?></label>
        </div>

        <?php if(a($storeData, 'store_data', 'torob_api')) { $torob_link = \lib\store::url(). '/hook/torob/'. md5(\lib\store::url('raw')); ?>
          <pre class="" data-copy="<?php echo $torob_link ?>"><?php echo $torob_link ?></pre>
          <div class="msg"><?php echo T_("On this link all your porduct returned by api") ?></div>
        <?php } //endif ?>
      </div>
      <?php if (!\dash\detect\device::detectPWA()) { ?>
        <footer class="txtRa">
          <button  class="btn success" ><?php echo T_("Save"); ?></div>
          </footer>
        <?php } ?>
      </div>
   </form>
</div>


