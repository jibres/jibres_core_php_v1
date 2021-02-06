<?php $data = \dash\data::dataRow(); $awss3 = \dash\data::awss3(); ?>

<div class="avand-sm impact zero">
  <form method="post" autocomplete="off" id='aThirdParty'>
    <div  class="box">
      <div class="body">
        <img class="block mB20" src="<?php echo \dash\url::cdn(); ?>/img/thirdparty/aws-banner.svg" alt='AWS'>
        <div class="msg">
          <p><?php echo T_("Amazon S3 or Amazon Simple Storage Service is a service offered by Amazon Web Services (AWS) that provides object storage through a web service interface. Amazon S3 uses the same scalable storage infrastructure that Amazon.com uses to run its global e-commerce network") ?></p>
        </div>

        <div class="switch1">
          <input type="checkbox" name="status" id="istatus" <?php if(a($awss3, 'status')) { echo 'checked'; }; ?>>
          <label for="istatus"></label>
          <label for="istatus"><?php echo T_("Upload your file to AWS S3 platform") ?></label>
        </div>
        <div class="ltr" data-response='status' <?php if(!a($awss3, 'status')) { echo 'data-response-hide'; }; ?>>
          <label for="iaccesskey">Accesskey <span class="fc-red">*</span></label>
          <div class="input ltr">
            <input type="text" name="accesskey" id="iaccesskey" value="<?php echo a($awss3, 'accesskey'); ?>" maxlength='300' minlength="1">
          </div>

          <label for="isecretkey">Secretkey <span class="fc-red">*</span></label>
          <div class="input ltr">
            <input type="text" name="secretkey" id="isecretkey" value="<?php echo a($awss3, 'secretkey'); ?>" maxlength='300' minlength="1">
          </div>

          <label for="iendpoint">Endpoint <span class="fc-red">*</span></label>
          <div class="input ltr">
            <input type="text" name="endpoint" id="iendpoint" value="<?php echo a($awss3, 'endpoint'); ?>" maxlength='300' minlength="1">
          </div>

          <label for="ibucket">Bucket <span class="fc-red">*</span></label>
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


