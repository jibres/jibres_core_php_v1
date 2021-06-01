<?php

$add_html_form      = isset($add_html_form); // check defined this variable
$is_auto_send       = isset($is_auto_send) && $is_auto_send;
$product_suggestion = isset($product_suggestion) && $product_suggestion;
$gallery_capacity = isset($gallery_capacity) ? $gallery_capacity : 100;

if(!isset($gallery_array) || (isset($gallery_array) && !is_array($gallery_array)))
{
  $gallery_array = [];
}

if($add_html_form)
{
 echo '<form method="post" autocomplete="off">';
}

$chooseTxt = T_('Drag &amp; Drop your files or Browse');
if(\dash\detect\device::detectPWA())
{
  $chooseTxt = T_('Choose File');
}

?>
    <div class="box">
      <div class="pad1">
        <?php if(is_array($gallery_array) && count($gallery_array) > $gallery_capacity) {?>
          <div class="msg minimal mB0 warn2"><?php echo T_("Gallery is full!"); ?></div>
        <?php }else{ ?>
          <div data-uploader data-max-w="1600" data-max-h="1600" data-file-max-size='<?php echo \dash\data::maxFileSize() ?>' <?php echo \dash\data::ratioHtml(); if(isset($gallery_special_attr)){ echo $gallery_special_attr; } ?> data-name='gallery' <?php if(isset($gallery_is_not_free) && $gallery_is_not_free) {/*nothing*/}else{echo 'data-ratio-free';} ?>  data-type='gallery' <?php if($is_auto_send) { echo 'data-autoSend'; }?>>
            <input type="file" id="file1">
            <label for="file1">
              <div class="block"><?php echo T_("Gallery") ?></div>
              <abbr><?php echo $chooseTxt; ?></abbr>
            <small class="fc-mute block"><?php echo T_("Maximum file size"). ' '. \dash\data::maxFileSizeTitle(); ?></small>
            </label>
        <?php if($gallery_array) {?>
          <div class="previewList">
            <div class="row">
            <?php foreach ($gallery_array as $key => $value) {?>
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
              <?php if($product_suggestion) {?>
                  <div class="link" data-ajaxify data-data='{"runaction_product_suggestion" : 1, "product_suggestion": "<?php echo !$product_suggestion_status ?>"}' data-kerkere='.showProductSuggestion' ><?php echo T_("Image suggestion") ?></div>
              <?php } //endif ?>
            </div>
            <div class="c"></div>
            <div class="cauto"><?php echo \dash\data::convertPostTo();  if(count($gallery) >= 2) {?><a class="block" href="<?php echo \dash\url::this().'/gallerysort?'. \dash\request::fix_get() ?>" class="link"><?php echo T_("Sort Gallery") ?></a><?php } //endif ?></div>
          </div>
        </footer>
    </div>

<?php
if($add_html_form)
{
 echo '</form>';
}
?>