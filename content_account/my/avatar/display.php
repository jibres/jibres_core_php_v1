
<div class="avand-sm">

  <form method="post" autocomplete="off" enctype="multipart/form-data">


  	<div data-uploader data-name='avatar' data-ratio="1" data-final='#finalImage' data-preview-circle data-autoSend data-uploader-circle>
      <input type="file" accept="image/jpeg, image/png" id="image1">
      <label for="image1"><?php echo T_('Drag &amp; Drop your picture or Browse'); ?></label>

  	<?php if(\dash\data::dataRow_avatar()) {?>
      <img id='finalImage' src="<?php echo \dash\data::dataRow_avatar() ?>" alt='<?php echo T_("Your avatar") ?>'>
  	<?php }?>
    </div>
  </form>

</div>

