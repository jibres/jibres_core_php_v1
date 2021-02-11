<?php $data = \dash\data::dataRow(); $arvanclouds3 = \dash\data::arvanclouds3(); ?>

<div class="avand-sm impact zero">
  <form method="post" autocomplete="off" id='aThirdParty'>
    <div  class="box">
        <img class="block" src="<?php echo \dash\url::cdn(); ?>/img/thirdparty/arvancloud-banner.jpg" alt='ArvanCloud'>
      <div class="body">
        <div class="msg">
          <p><?php echo T_("ArvanCloud allows you to save any kind of data on Cloud Storage in a completely encrypted format. You can have stable access to a reliable storage system from all around the world, without worrying about data loss.") ?></p>
        </div>

        <div class="switch1">
          <input type="checkbox" name="status" id="istatus" <?php if(a($arvanclouds3, 'status')) { echo 'checked'; }; ?>>
          <label for="istatus"></label>
          <label for="istatus"><?php echo T_("Upload your file to ArvanCloud S3 platform") ?></label>
        </div>
        <div class="ltr" data-response='status' <?php if(!a($arvanclouds3, 'status')) { echo 'data-response-hide'; }; ?>>
          <label for="iaccesskey">Accesskey <span class="fc-red">*</span></label>
          <div class="input ltr">
            <input type="text" name="accesskey" id="iaccesskey" value="<?php echo a($arvanclouds3, 'accesskey'); ?>" maxlength='300' minlength="1">
          </div>

          <label for="isecretkey">Secretkey <span class="fc-red">*</span></label>
          <div class="input ltr">
            <input type="text" name="secretkey" id="isecretkey" value="<?php echo a($arvanclouds3, 'secretkey'); ?>" maxlength='300' minlength="1">
          </div>

          <label for="iendpoint">Endpoint <span class="fc-red">*</span></label>
          <div class="input ltr">
            <input type="text" name="endpoint" id="iendpoint" value="<?php echo a($arvanclouds3, 'endpoint'); ?>" maxlength='300' minlength="1">
          </div>

          <label for="ibucket"><?php echo T_("Bucket") ?> <span class="fc-red">*</span></label>
          <div class="input ltr">
            <input type="text" name="bucket" id="ibucket" value="<?php echo a($arvanclouds3, 'bucket'); ?>" maxlength='300' minlength="1">
          </div>
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


