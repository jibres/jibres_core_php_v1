<form method="post" autocomplete="off">
    <div class="box">
      <div class="pad1">
        <?php if(is_array(\dash\data::dataRow_gallery_array()) && count(\dash\data::dataRow_gallery_array()) > 100) {?>
          <div class="msg minimal mB0 warn2"><?php echo T_("Gallery is full!"); ?></div>
        <?php }else{ ?>
          <div data-uploader data-max-w="1600" data-max-h="1600" data-file-max-size='<?php echo \dash\data::maxFileSize() ?>' data-name='gallery' data-ratio-free data-type='gallery' <?php if(\dash\url::child() === 'edit') { echo 'data-autoSend'; }?>>
            <input type="file" id="file1">
            <label for="file1">
              <div class="block"><?php echo T_("Gallery") ?></div>
              <abbr><?php echo $chooseTxt; ?></abbr>

            <small class="fc-mute block"><?php echo T_("Maximum file size"). ' '. \dash\data::maxFileSizeTitle(); ?></small>
            </label>

        <?php if(\dash\data::dataRow_gallery_array()) {?>
          <div class="previewList">
            <div class="row">
            <?php foreach (\dash\data::dataRow_gallery_array() as $key => $value) {?>
<?php
$myGalleryClass = 'c-xs-6 c-sm-4 c-md-3 c-lg-3 c-xxl-2';
switch (a($value, 'type'))
{
  case 'video':
    $myGalleryClass = 'c-xs-12 c-sm-12 c-md-6 c-xxl-4';
    break;

  case 'audio':
    $myGalleryClass = 'c-xs-12 c-sm-12';
    break;
}
 ?>
                <div class="fileItem <?php echo $myGalleryClass; ?>" data-removeElement data-type='<?php echo a($value, 'type'); ?>'>
                  <?php if(a($value, 'type') === 'video') {?>
                    <video controls>
                      <source src="<?php echo a($value, 'path'); ?>" type="<?php echo a($value, 'mime'); ?>">
                    </video>
                  <?php } else if(a($value, 'type') === 'audio') {?>
                    <audio controls>
                      <source src="<?php echo a($value, 'path'); ?>" type="<?php echo a($value, 'mime'); ?>">
                    </audio>
                  <?php } else if(a($value, 'type') === 'image') {?>
                    <img src="<?php echo \dash\fit::img(a($value, 'path'), 460); ?>" alt="<?php echo a(\dash\data::dataRow(), 'title'); ?>">
                  <?php } else if(a($value, 'type') === 'pdf') {?>
                    <div class="file"><i class="sf-file-pdf-o"></i><?php echo T_("PDF"); ?></div>
                  <?php } else if(a($value, 'type') === 'zip') {?>
                    <div class="file"><i class="sf-file-archive-o"></i><?php echo T_("ZIP"); ?></div>
                  <?php } else { ?>
                    <div class="file"><i class="sf-file-o"></i><?php echo T_("File"); ?></div>
                  <?php } ?>
                  <div>
                    <div class="imageDel" data-ajaxify data-data='{"fileaction": "remove", "fileid" : "<?php echo a($value, 'id'); ?>"}'></div>
                  </div>
                </div>
            <?php } //endfor ?>
            </div>
          </div>
        <?php } //endif ?>
          </div>
        <?php } //endif ?>
      </div>

        <footer>
          <div class="row">
            <div class="cauto">
              <?php if(isset($choose_gallery_link)) {?>
                <a class="link" href="<?php echo $choose_gallery_link ?>"><?php echo T_("Choose from gallery") ?></a>
              <?php } //endif ?>
            </div>
            <div class="c"></div>
            <div class="cauto"><?php echo \dash\data::convertPostTo();  if(count($gallery) >= 2) {?><a class="block" href="<?php echo \dash\url::this().'/gallerysort?'. \dash\request::fix_get() ?>" class="link"><?php echo T_("Sort Gallery") ?></a><?php } //endif ?></div>
          </div>
        </footer>

    </div>
  </form>