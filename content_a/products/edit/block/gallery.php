<?php
  $gallery = \dash\data::productDataRow_gallery_array();
  if(!is_array($gallery))
  {
    $gallery = [];
  }
?>
    <div class="box">
      <div class="pad1">
        <?php if(is_array(\dash\data::productDataRow_gallery_array()) && count(\dash\data::productDataRow_gallery_array()) > 10) {?>
          <div class="msg minimal mB0 warn2"><?php echo T_("Product gallery is full!"); ?></div>
        <?php }else{ ?>
          <div data-uploader data-max-w="1000" data-max-h="1000" data-name='gallery' <?php echo \dash\data::productImageRatioHtml(); ?> <?php if(\dash\url::child() === 'edit') { echo 'data-autoSend'; }?>>
            <input type="file" id="file1">
            <label for="file1"><abbr><?php echo T_('Drag &amp; Drop your files or Browse'); ?></abbr>
              <?php if(count($gallery) >= 3) {?>
                <a href="<?php echo \dash\url::this().'/gallerysort?'. \dash\request::fix_get() ?>" class="link"><?php echo T_("Sort images") ?></a>
              <?php } //endif ?>
            <small class="fc-mute block"><?php echo T_("Maximum file size"). ' '. \dash\data::maxUploadSize(); ?></small></label>

        <?php if(\dash\data::productDataRow_gallery_array()) {?>
          <div class="previewList">
            <?php foreach (\dash\data::productDataRow_gallery_array() as $key => $value) {?>
                <div class="fileItem" data-removeElement data-type='<?php echo a($value, 'type'); ?>'>
                  <?php if(a($value, 'type') === 'video') {?>
                    <video controls>
                      <source src="<?php echo a($value, 'path'); ?>" type="<?php echo a($value, 'mime'); ?>">
                    </video>
                  <?php } else { ?>
                  <img src="<?php echo a($value, 'path'); ?>" alt="<?php echo a($productDataRow, 'title'); ?>">
                    <?php if($key === 0) {?>
                    <?php }else{ ?>
                      <div class='setFeatureImg' data-ajaxify data-refresh data-data='{"fileaction": "setthumb", "fileid" : "<?php echo a($value, 'id'); ?>"}'><?php echo T_("Set as cover"); ?></div>
                    <?php }// endid ?>
                  <?php } ?>
                  <div>
                    <div class="imageDel" data-ajaxify data-data='{"fileaction": "remove", "fileid" : "<?php echo a($value, 'id'); ?>"}'></div>
                  </div>
                </div>
            <?php } //endfor ?>
          </div>
        <?php } //endif ?>
          </div>
        <?php } //endif ?>
      </div>
    </div>

<?php if(a(\dash\data::productSettingSaved(), 'product_suggestion')) {?>
  <?php if(\dash\data::productDataRow_title()) { // if have not product title not suggest product image. for example in add product module?>
      <div class="row" data-digikala-crawl='<?php echo \dash\data::productDataRow_title(); ?>'></div>
  <?php } //endif ?>
<?php } //endif ?>
