<div class="avand-md">

  <form method="post" autocomplete="off" id='form1'>
    <section class="box">
      <div class="body">
        <label for="icatname"><?php echo T_("Title"); ?></label>
        <div class="input">
          <input type="text" name="title" id="icatname" placeholder='<?php echo T_("Category name"); ?>' value="<?php echo \dash\data::dataRow_title(); ?>" <?php \dash\layout\autofocus::html() ?> maxlength='50' minlength="1" required>
        </div>

        <label for="iurl"><?php echo T_("Url"); ?></label>
        <div class="input ltr">
          <input type="text" name="url" id="iurl" placeholder='<?php echo T_("Category url"); ?>' value="<?php echo \dash\data::dataRow_url(); ?>" maxlength='50' minlength="1">
        </div>

      </div>
      <footer class="txtRa">
        <button class="btn master"><?php echo T_("Save") ?></button>
      </footer>
    </section>
  </form>
</div>
