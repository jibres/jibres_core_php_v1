<?php
$lineSetting = \dash\data::lineSetting();
?>
<section class="f" data-option='website-header-upload-logo'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Your Website Logo")?></h3>
      <div class="body">
        <p><?php echo T_("Work on your branding and add your logo. If you are not have logo don not worry, we are use your website title until you prepare your innovative logo. Manage and grow your business online with Jibres."); ?></p>
        <p class="meta"><?php echo T_("Maximum file size"); ?> <b><?php echo \dash\data::maxFileSizeTitle(); ?></b></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" >
    <div class="action" data-uploader data-name='logo' data-ratio="1" data-final='#finalImage' data-file-max-size='<?php echo \dash\data::maxFileSize() ?>' data-autoSend <?php if(a($lineSetting, 'detail', 'logourl')) { echo "data-fill";}?>>
      <input type="file" accept="image/jpeg, image/png" id="image1">
      <label for="image1"><?php echo T_('Drag &amp; Drop your files or Browse'); ?></label>
      <?php if(a($lineSetting, 'detail', 'logo')) {?><label for="image1"><img id="finalImage" src="<?php echo a($lineSetting, 'detail', 'logourl') ?>"></label><?php } //endif ?></label>
    </div>
  </form>

  <?php if(a($lineSetting, 'detail', 'logo')) {?>
    <footer class="txtRa">
     <div data-confirm data-data='{"remove_header_logo": "logo"}' class="btn link fc-red"><?php echo T_("Remove header logo") ?></div>
    </footer>
  <?php } //endif ?>
</section>
