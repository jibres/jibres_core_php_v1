
<div class="f justify-center">
  <div class="c6 m8 x5 s12">
    <div class="cbox">

      <form method="post" autocomplete="off">

        <label for="theme"><?php echo T_("Theme"); ?></label>
        <select name="theme" class="select22" id="theme">
          <option value="" readonly><?php echo T_("Please select one theme"); ?> *</option>
            <option value="0"  <?php if(!\dash\data::dataRow_theme()) {echo "selected";} ?>><?php echo T_("Sensitive to content"); ?></option>

            <?php foreach (\dash\data::themeList() as $key => $value) {?>

            <option value="<?php echo $key; ?>" <?php if(\dash\data::dataRow_theme() === $key) { echo "selected";} ?>><?php echo \dash\get::index($value, 'name'); ?></option>

            <?php }//endfor ?>

        </select>
        <div class="txtRa">
          <button class="btn success"><?php echo T_("Save"); ?></button>
        </div>

      </form>
    </div>
  </div>
</div>