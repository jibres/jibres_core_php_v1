
<div class="avand-sm">

  <div class="mB50">
  	<img class="profileAvatar" id='finalImage' src="<?php echo \dash\data::dataRow_avatar() ?>" alt='<?php echo T_("Your avatar") ?>'>
  </div>

  <form method="post" autocomplete="off" enctype="multipart/form-data">
  	<div class="box min-y120" data-uploader data-name='avatar' data-ratio="1" data-final='#finalImage' data-preview-circle data-autoSend>
      <input type="file" accept="image/jpeg, image/png" id="image1">
      <label for="image1"><?php echo T_('Drag &amp; Drop your files or Browse'); ?></label>
    </div>
  </form>

</div>

