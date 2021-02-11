<?php $data = \dash\data::dataRow(); $digitaloceans3 = \dash\data::digitaloceans3(); ?>

<div class="avand-sm impact zero">
  <form method="post" autocomplete="off" id='aThirdParty'>
    <div  class="box">
      <img class="block" src="<?php echo \dash\url::cdn(); ?>/img/thirdparty/digitalocean-banner.jpg" alt='DigitalOcean'>
      <div class="body">
        <div class="msg">
          <p><?php echo T_("Spaces is an S3-compatible object storage service that lets you store and serve large amounts of data. Each Space is a bucket for you to store and serve files.") ?></p>
        </div>

        <div class="switch1">
          <input type="checkbox" name="status" id="istatus" <?php if(a($digitaloceans3, 'status')) { echo 'checked'; }; ?>>
          <label for="istatus"></label>
          <label for="istatus"><?php echo T_("Upload your file to DigitalOcean S3 platform") ?></label>
        </div>
        <div class="ltr" data-response='status' <?php if(!a($digitaloceans3, 'status')) { echo 'data-response-hide'; }; ?>>
          <label for="iaccesskey">Accesskey <span class="fc-red">*</span></label>
          <div class="input ltr">
            <input type="text" name="accesskey" id="iaccesskey" value="<?php echo a($digitaloceans3, 'accesskey'); ?>" maxlength='300' minlength="1">
          </div>

          <label for="isecretkey">Secretkey <span class="fc-red">*</span></label>
          <div class="input ltr">
            <input type="text" name="secretkey" id="isecretkey" value="<?php echo a($digitaloceans3, 'secretkey'); ?>" maxlength='300' minlength="1">
          </div>

          <label for="iendpoint">Endpoint <span class="fc-red">*</span></label>
          <div class="input ltr">
            <input type="text" name="endpoint" id="iendpoint" value="<?php echo a($digitaloceans3, 'endpoint'); ?>" maxlength='300' minlength="1">
          </div>

          <label for="ibucket">Bucket <span class="fc-red">*</span></label>
          <div class="input ltr">
            <input type="text" name="bucket" id="ibucket" value="<?php echo a($digitaloceans3, 'bucket'); ?>" maxlength='300' minlength="1">
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


