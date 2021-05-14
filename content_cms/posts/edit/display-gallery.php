<?php
  $dataRow = \dash\data::dataRow();
  $chooseTxt = T_('Drag &amp; Drop your files or Browse');
  if(\dash\detect\device::detectPWA())
  {
    $chooseTxt = T_('Choose File');
  }
?>

<?php if(a($dataRow, 'subtype') === 'audio') {?>
<section class="f mB10-f" data-option='cms-post-audio'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Podcast")?></h3>
      <div class="body">
        <p><?php echo T_("We enable you to upload audio clips and share them with the world. Sharing your talent is simple!") ?></p>
        <p class="fc-mute block"><?php echo T_("Maximum file size"). ' '. \dash\data::maxFileSizeTitle(); ?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" >
    <div class="action" data-uploader data-name='gallery' data-type='audio' data-autoSend data-file-max-size='<?php echo \dash\data::maxFileSize() ?>' <?php if(a($dataRow, 'gallery_array', 0, 'path')) { echo "data-fill";}?>>
      <input type="file" accept="audio/*" id="audio1">
        <label for="audio1"><?php echo $chooseTxt; ?></label>
      <?php if(a($dataRow, 'gallery_array', 0, 'path')) {?>
        <label for="audio1">
          <audio controls preload='meta'>
            <source src="<?php echo a($dataRow, 'gallery_array', 0, 'path') ?>" type="<?php echo a($dataRow, 'gallery_array', 0, 'mime') ?>">
          </audio>
        </label>
      <?php } //endif ?>
    </div>
  </form>
  <footer>
    <div class="row">
        <div class="cauto"><a class="link" href="<?php echo \dash\url::here(). '/files/choose?'. \dash\request::build_query(['related' => 'postsgalleryaudio', 'type' => 'audio', 'related_id' => \dash\request::get('id')]); ?>"><?php echo T_("Choose from gallery") ?></a></div>
        <div class="c"></div>
      <?php if(a($dataRow, 'gallery_array', 0, 'path')) {?>
        <div class="cauto">
          <div data-confirm data-data='{"redirect":"yes", "fileaction": "remove", "fileid" : "<?php echo a($dataRow, 'gallery_array', 0, 'id'); ?>"}' class="link fc-red"><?php echo T_("Remove audio") ?></div>
        </div>
      <?php } //endif ?>
      </div>
  </footer>
</section>
<?php } //endif



if(a($dataRow, 'subtype') === 'video') {?>
<section class="f mB10-f" data-option='cms-post-video'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Video")?></h3>
      <div class="body">
        <p><?php echo T_("Share your video with the world.") ?></p>
        <p class="fc-mute block"><?php echo T_("Maximum file size"). ' '. \dash\data::maxFileSizeTitle(); ?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" >
    <div class="action" data-uploader data-name='gallery' data-type='video' data-autoSend data-file-max-size='<?php echo \dash\data::maxFileSize() ?>' <?php if(a($dataRow, 'gallery_array', 0, 'path')) { echo "data-fill";}?>>
      <input type="file" accept="video/*" id="video1">
        <label for="video1"><?php echo $chooseTxt ?></label>
      <?php if(a($dataRow, 'gallery_array', 0, 'path')) {?>
        <label for="video1">
          <video controls preload='meta'<?php if(a($dataRow, 'poster')) { echo " poster='". \lib\filepath::fix(a($dataRow, 'poster')). "'";} ?>>
            <source src="<?php echo a($dataRow, 'gallery_array', 0, 'path') ?>" type="<?php echo a($dataRow, 'gallery_array', 0, 'mime') ?>">
          </video>
        </label>
      <?php } //endif ?>
    </div>
  </form>
  <footer>
    <div class="row">
        <div class="cauto"><a class="link" href="<?php echo \dash\url::here(). '/files/choose?'. \dash\request::build_query(['related' => 'postsgalleryvideo', 'type' => 'video', 'related_id' => \dash\request::get('id')]); ?>"><?php echo T_("Choose from gallery") ?></a></div>
        <div class="c"></div>
      <?php if(a($dataRow, 'gallery_array', 0, 'path')) {?>
        <div class="cauto">
          <div data-confirm data-data='{"redirect":"yes", "fileaction": "remove", "fileid" : "<?php echo a($dataRow, 'gallery_array', 0, 'id'); ?>"}' class="link fc-red"><?php echo T_("Remove video") ?></div>
        </div>
      <?php } //endif ?>
      </div>
  </footer>
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

  $add_html_form = true;
  $is_auto_send = \dash\url::child() === 'edit';
  $gallery_array = $gallery;

  $choose_gallery_link = \dash\url::here(). '/files/choose?'. \dash\request::build_query(['related' => 'postsgallery', 'related_id' => \dash\request::get('id')]);

  require_once(root. 'dash/layout/post/admin-gallery-box.php');
} // don't show gallery bo
// the gallery box only show when the post subtype is standart or gallery




// load thumb
$thumbUrl = \dash\data::dataRow_thumb();
if(\dash\data::dataRow_thumbFromContent())
{
  $thumbUrl = null;
}
?>


<section class="f mB10-f" data-option='cms-post-thumb'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Featured Image")?></h3>
      <div class="body">
        <p><?php echo T_("The Featured Image is a Jibres theme feature that allows theme you to using a representative image. Featured Image is a primary image for your post."); ?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" >
    <div class="action" data-uploader data-name='thumb' <?php echo \dash\data::ratioHtml() ?> data-final='#finalImageThumb' data-autoSend <?php if($thumbUrl) { echo "data-fill";}?> data-file-max-size='<?php echo \dash\data::maxFileSize() ?>' data-type='featureImage'>
      <input type="hidden" name="runaction_setthumb" value="1">
      <input type="file" accept="image/jpeg, image/png" id="image1thumb">
      <label for="image1thumb"><?php echo $chooseTxt ?></label>
      <?php if($thumbUrl) {?><label for="image1thumb"><img src="<?php echo \dash\fit::img($thumbUrl, 460) ?>" alt="<?php echo T_("Featured image"); ?>" id="finalImageThumb"></label><?php } //endif ?>
    </div>
  </form>

    <footer class="txtRa">
      <div class="row">
        <div class="c-auto">
          <a class="link" href="<?php echo \dash\url::here(). '/files/choose?'. \dash\request::build_query(['related' => 'poststhumb', 'related_id' => \dash\request::get('id'), 'type' => 'image', 'ratio' => \dash\data::ratioHtmlDetail_ratio_string()]) ?>"><?php echo T_("Choose from gallery") ?></a>
        </div>
        <div class="c"></div>
        <div class="c-auto">
          <?php if($thumbUrl) {?>
            <div data-confirm data-data='{"remove_thumb": "remove_thumb"}' class="link fc-red"><?php echo T_("Remove featured image") ?></div>
          <?php } //endif ?>
        </div>
      </div>

    </footer>
</section>

