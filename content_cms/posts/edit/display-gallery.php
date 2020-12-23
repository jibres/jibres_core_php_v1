<?php $dataRow = \dash\data::dataRow();  ?>

<section class="f" data-option='cms-post-thumb'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Featured image")?></h3>
      <div class="body">
        <p><?php echo T_("Setting up a post featured image helps you to publish your post professionally on social networks") ?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" >
    <div class="action" data-uploader data-name='thumb' <?php echo \dash\data::ratioHtml() ?> data-final='#finalImageThumb' data-autoSend <?php if(\dash\data::dataRow_thumb()) { echo "data-fill";}?> data-file-max-size='<?php echo \dash\data::maxFileSize() ?>'>
      <input type="hidden" name="runaction_setthumb" value="1">
      <input type="file" accept="image/jpeg, image/png" id="image1thumb">
      <label for="image1thumb"><?php echo T_('Drag &amp; Drop your files or Browse'); ?></label>
      <?php if(\dash\data::dataRow_thumb()) {?><label for="image1thumb"><img alt="<?php echo T_("Featured image"); ?>" id="finalImageThumb" src="<?php echo \dash\data::dataRow_thumb() ?>"></label><?php } //endif ?>
    </div>
  </form>

  <?php if(\dash\data::dataRow_thumb()) {?>
    <footer class="txtRa">
     <div data-confirm data-data='{"remove_thumb": "remove_thumb"}' class="btn link fc-red"><?php echo T_("Remove featured image") ?></div>
    </footer>
  <?php } //endif ?>
</section>


<?php if(a($dataRow, 'subtype') === 'audio') {?>
<section class="f" data-option='cms-post-audio'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Audio")?></h3>
      <div class="body">
        <p><?php echo T_("Add your audio") ?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" >
    <div class="action" data-uploader data-name='gallery' data-autoSend data-file-max-size='<?php echo \dash\data::maxFileSize() ?>' <?php if(a($dataRow, 'gallery_array', 0, 'path')) { echo "data-fill";}?>>
      <input type="file" accept="audio/*" id="audio1">
        <label for="audio1"><?php echo T_('Drag &amp; Drop your files or Browse'); ?></label>
      <?php if(a($dataRow, 'gallery_array', 0, 'path')) {?>
        <label for="audio1">
          <audio controls>
            <source src="<?php echo a($dataRow, 'gallery_array', 0, 'path') ?>" type="<?php echo a($dataRow, 'gallery_array', 0, 'mime') ?>">
          </audio>
        </label>
      <?php } //endif ?>
    </div>
  </form>

  <?php if(a($dataRow, 'gallery_array', 0, 'path')) {?>
    <footer class="txtRa">
     <div data-confirm data-data='{"remove_thumb": "remove_thumb"}' class="btn link fc-red"><?php echo T_("Remove audio") ?></div>
    </footer>
  <?php } //endif ?>
</section>

<?php } //endif



if(a($dataRow, 'subtype') === 'video') {?>
<section class="f" data-option='cms-post-video'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Video")?></h3>
      <div class="body">
        <p><?php echo T_("Add your video") ?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" >
    <div class="action" data-uploader data-name='gallery' data-autoSend data-file-max-size='<?php echo \dash\data::maxFileSize() ?>' <?php if(a($dataRow, 'gallery_array', 0, 'path')) { echo "data-fill";}?>>
      <input type="file" accept="video/*" id="video1">
        <label for="video1"><?php echo T_('Drag &amp; Drop your files or Browse'); ?></label>
      <?php if(a($dataRow, 'gallery_array', 0, 'path')) {?>
        <label for="video1">
          <video width="320" height="240" controls>
            <source src="<?php echo a($dataRow, 'gallery_array', 0, 'path') ?>" type="<?php echo a($dataRow, 'gallery_array', 0, 'mime') ?>">
          </video>
        </label>
      <?php } //endif ?>
    </div>
  </form>

  <?php if(a($dataRow, 'gallery_array', 0, 'path')) {?>
    <footer class="txtRa">
     <div data-confirm data-data='{"remove_thumb": "remove_thumb"}' class="btn link fc-red"><?php echo T_("Remove video") ?></div>
    </footer>
  <?php } //endif ?>
</section>

<?php } //endif




if(in_array(a($dataRow, 'subtype'), ['standard', 'gallery']))
{
  // show the gallery box
  $gallery = \dash\data::dataRow_gallery_array();
  if(!is_array($gallery))
  {
    $gallery = [];
  }
?>
<form method="post" autocomplete="off">
    <div class="box">
      <div class="pad1">
        <?php if(is_array(\dash\data::dataRow_gallery_array()) && count(\dash\data::dataRow_gallery_array()) > 10) {?>
          <div class="msg minimal mB0 warn2"><?php echo T_("Product gallery is full!"); ?></div>
        <?php }else{ ?>
          <div data-uploader data-max-w="1000" data-file-max-size='<?php echo \dash\data::maxFileSize() ?>' data-max-h="1000" data-name='gallery' data-ratio-free <?php if(\dash\url::child() === 'edit') { echo 'data-autoSend'; }?>>
            <input type="file" id="file1">
            <label for="file1"><abbr><?php echo T_('Drag &amp; Drop your files or Browse'); ?></abbr>
              <?php if(count($gallery) >= 3) {?>
                <a href="<?php echo \dash\url::this().'/gallerysort?'. \dash\request::fix_get() ?>" class="link"><?php echo T_("Sort images") ?></a>
              <?php } //endif ?>
            <small class="fc-mute block"><?php echo T_("Maximum file size"). ' '. \dash\data::maxUploadSize(); ?></small></label>

        <?php if(\dash\data::dataRow_gallery_array()) {?>
          <div class="previewList">
            <?php foreach (\dash\data::dataRow_gallery_array() as $key => $value) {?>
                <div class="fileItem" data-removeElement data-type='<?php echo a($value, 'type'); ?>'>
                  <?php if(a($value, 'type') === 'video') {?>
                    <video controls>
                      <source src="<?php echo a($value, 'path'); ?>" type="<?php echo a($value, 'mime'); ?>">
                    </video>
                  <?php } else { ?>
                    <img src="<?php echo a($value, 'path'); ?>" alt="<?php echo a(\dash\data::dataRow(), 'title'); ?>">
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
  </form>
<?php
} // don't show gallery bo
// the gallery box only show when the post subtype is standart or gallery
 ?>