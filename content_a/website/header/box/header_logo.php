<section class="f" data-option='website-header-upload-logo'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Your Website Logo")?></h3>
      <div class="body">
        <p><?php
$desc = \dash\get::index($box_detail, 'desc');
if($desc)
{
  echo $desc;
}
else
{
  echo T_("Work on your branding and add your logo. If you are not have logo don not worry, we are use your website title until you prepare your innovative logo. Manage and grow your business online with Jibres.");
}
?></p>
        <p class="meta"><?php echo T_("Maximum file size"); ?> <b><?php echo \dash\data::maxUploadSize(); ?></b></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" >
    <div class="action" data-uploader data-name='logo' data-ratio="1" data-final='#finalImage' data-autoSend <?php if(\dash\get::index($header_detail, 'saved', 'header_logo')) { echo "data-fill";}?>>

      <input type="file" accept="image/jpeg, image/png" id="image1">
      <label for="image1"><?php echo T_('Drag &amp; Drop your files or Browse'); ?></label>
      <?php if(\dash\get::index($header_detail, 'saved', 'header_logo')) {?><label for="image1"><img id="finalImage" src="<?php echo \dash\get::index($header_detail, 'saved', 'header_logo') ?>"></label><?php } //endif ?></label>
    </div>
  </form>

  <?php if(\dash\get::index($header_detail, 'saved', 'header_logo')) {?>
    <footer class="txtRa">
     <div data-confirm data-data='{"remove_header": "logo"}' class="btn link fc-red"><?php echo T_("Remove header logo") ?></div>
    </footer>
  <?php } //endif ?>
</section>
