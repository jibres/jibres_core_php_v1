
<div class="avand-sm">


  <form method="post" autocomplete="off" enctype="multipart/form-data">

  	<div class="box min-y120" data-uploader data-name='avatar' data-ratio="1" data-final='#finalImage' data-preview-circle>
      <input type="file" accept="image/jpeg, image/png" id="image1">
      <label for="image1"><?php echo T_('Drag &amp; Drop your files or Browse'); ?></label>
    </div>
  </form>

  <div class="box">
  	<img id='finalImage' src="<?php echo \dash\data::dataRow_avatar() ?>" alt='<?php echo T_("Your avatar") ?>'>
  </div>
</div>