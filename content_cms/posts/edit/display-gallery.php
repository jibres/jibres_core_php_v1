<?php $dataRow = \dash\data::dataRow();  ?>

<?php if(a($dataRow, 'subtype') === 'audio') {?>
<section class="f" data-option='cms-post-audio'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Podcast")?></h3>
      <div class="body">
        <p><?php echo T_("We enable you to upload audio clips and share them with the world. Sharing your talent is simple!") ?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" >
    <div class="action" data-uploader data-name='gallery' data-autoSend data-file-max-size='<?php echo \dash\data::maxFileSize() ?>' <?php if(a($dataRow, 'gallery_array', 0, 'path')) { echo "data-fill";}?>>
      <input type="file" accept="audio/*" id="audio1">
        <label for="audio1"><?php echo T_('Drag &amp; Drop your files or Browse'); ?></label>
      <?php if(a($dataRow, 'gallery_array', 0, 'path')) {?>
        <label for="audio1">
          <audio controls preload='meta'>
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
        <p><?php echo T_("Share your video with the world.") ?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" >
    <div class="action" data-uploader data-name='gallery' data-autoSend data-file-max-size='<?php echo \dash\data::maxFileSize() ?>' <?php if(a($dataRow, 'gallery_array', 0, 'path')) { echo "data-fill";}?>>
      <input type="file" accept="video/*" id="video1">
        <label for="video1"><?php echo T_('Drag &amp; Drop your files or Browse'); ?></label>
      <?php if(a($dataRow, 'gallery_array', 0, 'path')) {?>
        <label for="video1">
          <video controls preload='meta'<?php if(a($dataRow, 'poster')) { echo " poster='". \lib\filepath::fix(a($dataRow, 'poster')). "'";} ?>>
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
          <div data-uploader data-max-w="1600" data-max-h="1600" data-file-max-size='<?php echo \dash\data::maxFileSize() ?>' data-name='gallery' data-ratio-free <?php if(\dash\url::child() === 'edit') { echo 'data-autoSend'; }?>>
            <input type="file" id="file1">
            <label for="file1"><abbr><?php echo T_('Drag &amp; Drop your files or Browse'); ?></abbr>
              <?php if(count($gallery) >= 3) {?>
                <a href="<?php echo \dash\url::this().'/gallerysort?'. \dash\request::fix_get() ?>" class="link"><?php echo T_("Sort images") ?></a>
              <?php } //endif ?>
            <small class="fc-mute block"><?php echo T_("Maximum file size"). ' '. \dash\data::maxFileSizeTitle(); ?></small></label>

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


<section class="f" data-option='cms-post-thumb'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Featured Image")?></h3>
      <div class="body">
        <p><?php echo T_("The Featured Image is a Jibres theme feature that allows theme you to using a representative image. Featured Image is a primary image for your post."); ?></p>
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

    <footer class="txtRa">
      <div class="f">
        <div class="cauto">
          <a class="btn link" href="<?php echo \dash\url::here(). '/files/choose?'. \dash\request::build_query(['related' => 'poststhumb', 'related_id' => \dash\request::get('id'), 'type' => 'image']) ?>"><?php echo T_("Choose from gallery") ?></a>
        </div>
        <div class="c"></div>
        <div class="cauto">
          <?php if(\dash\data::dataRow_thumb()) {?>
            <div data-confirm data-data='{"remove_thumb": "remove_thumb"}' class="btn link fc-red"><?php echo T_("Remove featured image") ?></div>
          <?php } //endif ?>
        </div>
      </div>

    </footer>
</section>

