<?php $data = \dash\data::dataRow(); $awss3 = \dash\data::awss3(); ?>

<div class="avand-sm impact zero">
  <form method="post" autocomplete="off" id='aThirdParty'>
    <div  class="box">
      <div class="body">
        <img class="block mB20" src="<?php echo \dash\url::cdn(); ?>/img/thirdparty/aws-banner.svg" alt='AWS'>
        <div class="msg">
          <p><?php echo T_("DWe make it simple to launch in the cloud and scale up as you grow – with an intuitive control panel, predictable pricing, team accounts, and more.") ?></p>
        </div>

        <div class="switch1">
          <input type="checkbox" name="status" id="istatus" <?php if(a($awss3, 'status')) { echo 'checked'; }; ?>>
          <label for="istatus"></label>
          <label for="istatus"><?php echo T_("Upload your file to AWS S3 platform") ?></label>
        </div>
        <div data-response='status' data-response-effect='slide' <?php if(!a($awss3, 'status')) { echo 'data-response-hide'; }; ?>>
          <label for="iaccesskey"><?php echo T_("Accesskey"); ?> <span class="fc-red">*</span></label>
          <div class="input ltr">
            <input type="text" name="accesskey" id="iaccesskey" value="<?php echo a($awss3, 'accesskey'); ?>" maxlength='300' minlength="1">
          </div>

          <label for="isecretkey"><?php echo T_("Secretkey"); ?> <span class="fc-red">*</span></label>
          <div class="input ltr">
            <input type="text" name="secretkey" id="isecretkey" value="<?php echo a($awss3, 'secretkey'); ?>" maxlength='300' minlength="1">
          </div>

          <label for="iendpoint"><?php echo T_("Endpoint"); ?> <span class="fc-red">*</span></label>
          <div class="input ltr">
            <input type="text" name="endpoint" id="iendpoint" value="<?php echo a($awss3, 'endpoint'); ?>" maxlength='300' minlength="1">
          </div>

          <label for="ibucket"><?php echo T_("Bucket"); ?> <span class="fc-red">*</span></label>
          <div class="input ltr">
            <input type="text" name="bucket" id="ibucket" value="<?php echo a($awss3, 'bucket'); ?>" maxlength='300' minlength="1">
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


