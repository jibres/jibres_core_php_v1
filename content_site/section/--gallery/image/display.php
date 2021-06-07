<?php

$section_detail = \dash\data::currentSectionDetail();

?>
<form method="post" autocomplete="off" >
  <div data-uploader data-name='image' data-final='#finalImage' data-file-max-size='<?php echo \dash\data::maxFileSize() ?>' data-autoSend <?php if(\dash\data::dataRow_imageurl()) { echo "data-fill ";} echo \dash\data::ratioHtml(); ?>>
    <input type="file" accept="image/jpeg, image/png" id="image1">
    <label for="image1"><?php echo T_('Drag &amp; Drop your files or Browse'); ?></label>
    <?php if(\dash\data::dataRow_imageurl()) {?>
      <?php $myExt = substr(\dash\data::dataRow_imageurl(), -3); ?>
      <?php if(in_array($myExt, ['png', 'jpg', 'gif'])) {?>
        <label for="image1"><img id="finalImage" src="<?php echo \dash\data::dataRow_imageurl(); ?>" alt="<?php echo \dash\data::dataRow_title(); ?>"></label>
      <?php }//endif ?>
    <?php } else {//endif ?>
      <label for="image1"><img id="finalImage" alt="<?php echo \dash\data::dataRow_title(); ?>"></label>
    <?php }//endif ?>
  </div>

  <label for="alt"><?php echo T_("Title"); ?></label>
  <div class="input">
    <input type="text" name="alt" id="alt" value="<?php echo \dash\data::dataRow_alt() ?>" maxlength="200"  >
  </div>
  <label for="url"><?php echo T_("Url"); ?></label>
  <div class="input ltr">
    <input type="text" name="url" id="url" value="<?php echo \dash\data::dataRow_url() ?>" maxlength="200" >
  </div>
  <div class="switch1 mB5">
    <input type="checkbox" name="target" id="target" <?php if(\dash\data::dataRow_target()) {echo 'checked';} ?>>
    <label for="target"></label>
    <label for="target"><?php echo T_("Open in New tab"); ?><small></small></label>
  </div>

  <div data-ajaxify data-data='{"removeimage":"removeimage"}'><img class="avatar" src="<?php echo \dash\utility\icon::url('Delete', 'minor'); ?>"></div>
</form>