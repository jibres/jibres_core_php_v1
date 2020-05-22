
<div class="avand-sm">

  <img id='finalImage' src="<?php echo \dash\data::dataRow_avatar() ?>" alt='<?php echo T_("Your avatar") ?>'>

  <form method="post" autocomplete="off" enctype="multipart/form-data">

    <div class="box min-y120" data-uploader data-name='avatar' >
      <input type="file" data-cropper-file accept="image/gif, image/jpeg, image/png" id="image1" data-max-files data-max-size=2>
      <label for="image1"><?php echo T_('Drag &amp; Drop your files or <span class="txtB">Browse</span>'); ?></label>
    </div>

  </form>

</div>