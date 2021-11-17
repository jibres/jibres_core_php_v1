<?php
$storeData = \dash\data::store_store_data();
?>

<form method="post" autocomplete="off">
  <?php echo \dash\csrf::html(); ?>
  <div class="avand-md">
    <div class="box">
      <div class="pad">
        <label for="ititle"><?php echo T_("Title"); ?> <span class="fc-red">*</span></label>
        <div class="input">
          <input type="text" name="title" id="ititle"  value="<?php echo a($storeData, 'title'); ?>" <?php \dash\layout\autofocus::html() ?> maxlength='50' minlength="1"  required>
        </div>
        <label for="desc"><?php echo T_("Description"); ?></label>
        <textarea class="txt mB10" name="desc"  maxlength='2000' rows="3"><?php echo a($storeData, 'desc'); ?></textarea>
      </div>
        <footer class="txtRa">
          <button class="btn-success"><?php echo T_("Save"); ?></button>
        </footer>
    </div>
  </div>
</form>