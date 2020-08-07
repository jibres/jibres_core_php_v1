
    <div class="box">
      <div class="pad1">
        <?php if(is_array(\dash\data::productDataRow_gallery_array()) && count(\dash\data::productDataRow_gallery_array()) > 10) {?>
          <div class="msg minimal mB0 warn2"><?php echo T_("Product gallery is full!"); ?></div>
        <?php }else{ ?>
          <div data-uploader data-max-w="1000" data-max-h="1000" data-name='gallery' <?php echo \dash\data::productImageRatioHtml(); ?> <?php if(\dash\url::child() === 'edit') { echo 'data-autoSend'; }?>>
            <input type="file" id="file1">
            <label for="file1"><abbr><?php echo T_('Drag &amp; Drop your files or Browse'); ?></abbr> <small class="fc-mute block"><?php echo T_("Maximum file size"). ' '. \dash\data::maxUploadSize(); ?></small></label>

        <?php if(\dash\data::productDataRow_gallery_array()) {?>
          <div class="previewList">
            <?php foreach (\dash\data::productDataRow_gallery_array() as $key => $value) {?>
                <div class="fileItem" data-removeElement data-type='<?php echo \dash\get::index($value, 'type'); ?>'>
                  <?php if(\dash\get::index($value, 'type') === 'image') {?>
                  <img src="<?php echo \dash\get::index($value, 'path'); ?>" alt="<?php echo \dash\get::index($productDataRow, 'title'); ?>">
                  <?php } else { ?>
                    <video controls>
                      <source src="<?php echo \dash\get::index($value, 'path'); ?>" type="<?php echo \dash\get::index($value, 'mime'); ?>">
                    </video>
                  <?php } ?>
                  <div>
                    <div class="imageDel" data-ajaxify data-data='{"fileaction": "remove", "fileid" : "<?php echo \dash\get::index($value, 'id'); ?>"}'></div>
                    <?php if($key === 0) {?>
                    <?php }else{ ?>
                      <div class='setFeatureImg' data-ajaxify data-refresh data-data='{"fileaction": "setthumb", "fileid" : "<?php echo \dash\get::index($value, 'id'); ?>"}'><?php echo T_("Set as cover"); ?></div>
                    <?php }// endid ?>
                  </div>
                </div>
            <?php } //endfor ?>
          </div>
        <?php } //endif ?>
          </div>
        <?php } //endif ?>
      </div>
    </div>
