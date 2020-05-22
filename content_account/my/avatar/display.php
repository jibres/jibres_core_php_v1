
<div class="avand-sm">

  <img id='finalImage' src="<?php echo \dash\data::dataRow_avatar() ?>" alt='<?php echo T_("Your avatar") ?>'>

  <form method="post" autocomplete="off" enctype="multipart/form-data">

  	<div class="box min-y120" data-uploader data-name='avatar' data-ratio="1" data-preview='#finalImage'>
      <input type="file" data-cropper-file accept="image/jpeg, image/png" id="image1" data-max-size=1 >
      <label for="image1"><?php echo T_('Drag &amp; Drop your files or Browse'); ?></label>
    </div>


  </form>

</div>