

<div class="f justify-center">
  <div class="c6 m8 x5 s12">
    <div class="cbox">

      <form method="post" autocomplete="off">

        <label for="language"><?php echo T_("Language"); ?></label>
        <select name="language" class="select ui dropdown" id="language">
          <option value="" readonly><?php echo T_("Please select one language"); ?> *</option>

          <?php foreach (\dash\data::langList() as $key => $value) {?>

            <option value="<?php echo @$value['name']; ?>" <?php if(\dash\data::dataRow_language() === @$value['name']) {echo 'selected';} ?>><?php echo @$value['localname']; ?></option>

          <?php } //endfor ?>

        </select>

        <div class="txtRa">
          <button class="btn success"><?php echo T_("Save"); ?></button>
        </div>

      </form>
    </div>
  </div>
</div>
