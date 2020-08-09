<?php
$storeData = \dash\data::store_store_data();
?>
<form method="post" autocomplete="off">

  <div class="avand-md">

    <div class="box">
      <div class="body">
        <?php \dash\utility\hive::html(); ?>

        <label for="lang"><?php echo T_("Please choose your business default language"); ?></label>
        <div>

        <select name="lang" class="select22">
          <option value=""><i><?php echo T_("Please select one item"); ?></i></option>
          <?php foreach (\dash\language::all(true) as $key => $value) {?>
            <option value="<?php echo $key; ?>" <?php if(\dash\get::index($storeData, 'lang') == $key) {echo 'selected';} ?>><?php echo $value; ?></option>
          <?php } //endfor ?>
        </select>
        </div>
      </div>
      <footer class="txtRa">
        <button class="btn success"><?php echo T_("Save"); ?></button>
      </footer>
    </div>


  </div>
</form>



