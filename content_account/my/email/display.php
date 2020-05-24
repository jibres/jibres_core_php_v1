
<div class="f justify-center">
  <div class="c6 m8 x5 s12">
    <div class="cbox">

      <form method="post" autocomplete="off">
          <?php \dash\utility\hive::html(); ?>
          <label for="email"><?php echo T_("Email"); ?></label>
          <div class="input">
            <input type="email" name="email" id="email" placeholder='<?php echo T_("like"); ?> abc@example.com' value="<?php echo \dash\data::dataRow_email(); ?>" maxlength='50'>
            <span class="addon"><i class="sf-mail"></i></span>
          </div>

        <div class="txtRa">
          <button class="btn success"><?php echo T_("Save"); ?></button>
        </div>

      </form>
    </div>
  </div>
</div>
