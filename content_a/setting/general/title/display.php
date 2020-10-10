<?php
$storeData = \dash\data::store_store_data();
?>

<div class="avand-md">

  <div class="cbox">
   <form method="post" autocomplete="off">

      <?php \dash\csrf::html(); ?>
      <label for="ititle"><?php echo T_("Name"); ?> <span class="fc-red">*</span></label>
      <div class="input">
        <input type="text" name="title" id="ititle" placeholder='<?php echo T_("Name"); ?>' value="<?php echo \dash\get::index($storeData, 'title'); ?>" <?php \dash\layout\autofocus::html() ?> maxlength='50' minlength="1"  required>
      </div>

      <label for="desc"><?php echo T_("Description"); ?></label>
      <textarea class="txt mB10" name="desc"  maxlength='2000' rows="3"><?php echo \dash\get::index($storeData, 'desc'); ?></textarea>

      <div class="txtRa">
        <button class="btn success"><?php echo T_("Save"); ?></button>
      </div>
   </form>
  </div>


 </div>



