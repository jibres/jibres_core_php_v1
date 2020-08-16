<form method="post" autocomplete="off">
  <div class="avand-md">
    <div class="box">
      <div class="body">

        <p class="msg"><?php echo T_("You can differentiate your product in terms of three features"); ?></p>

        <div class="f">
          <div class="cauto mB10">
            <label><?php echo T_("Property #1"); if(!\dash\get::index($variantsList, 'variants', 'option1', 'name')) {?> <small><?php echo T_("For example: Color") ?></small><?php } // endif ?></label>
            <div class="input">
              <input type="text" name="optionname1" value="<?php echo \dash\get::index($variantsList, 'variants', 'option1', 'name'); ?>">
            </div>
          </div>

          <div class="c pLa5 mB10">
            <div>
              <label>&nbsp;</label>
              <select name="optionvalue1[]" id="optionvalue1" class="select22" data-model="tag" multiple="multiple">
                <?php if(isset($variantsList['variants']['option1']['value']) && is_array($variantsList['variants']['option1']['value'])) { foreach ($variantsList['variants']['option1']['value'] as $key => $value) {?>
                  <option value="<?php echo $value; ?>" selected><?php echo $value; ?></option>
                <?php } } //endfor //endif  ?>
              </select>
            </div>
          </div>

        </div>

        <div class="f">
          <div class="cauto mB10">
            <label><?php echo T_("Property #2"); if(!\dash\get::index($variantsList, 'variants', 'option2', 'name')) {?> <small><?php echo T_("For example: Size") ?></small><?php } // endif ?></label>
            <div class="input">
              <input type="text" name="optionname2" value="<?php echo \dash\get::index($variantsList, 'variants', 'option2', 'name'); ?>">
            </div>
          </div>

          <div class="c pLa5 mB10">
            <div>
              <label>&nbsp;</label>
              <select name="optionvalue2[]" id="optionvalue2" class="select22" data-model="tag" multiple="multiple">
                <?php if(isset($variantsList['variants']['option2']['value']) && is_array($variantsList['variants']['option2']['value'])) { foreach ($variantsList['variants']['option2']['value'] as $key => $value) {?>
                  <option value="<?php echo $value; ?>" selected><?php echo $value; ?></option>
                <?php } } //endfor //endif  ?>
              </select>
            </div>
          </div>

        </div>

        <div class="f">
          <div class="cauto mB10">
            <label><?php echo T_("Property #3"); if(!\dash\get::index($variantsList, 'variants', 'option3', 'name')) {?> <small><?php echo T_("For example: Material") ?></small><?php } // endif ?></label>
            <div class="input">
              <input type="text" name="optionname3" value="<?php echo \dash\get::index($variantsList, 'variants', 'option3', 'name'); ?>">
            </div>
          </div>

          <div class="c pLa5 mB10">
            <div>
            <label>&nbsp;</label>
              <select name="optionvalue3[]" id="optionvalue3" class="select22" data-model="tag" multiple="multiple">
                <?php if(isset($variantsList['variants']['option3']['value']) && is_array($variantsList['variants']['option3']['value'])) { foreach ($variantsList['variants']['option3']['value'] as $key => $value) {?>
                  <option value="<?php echo $value; ?>" selected><?php echo $value; ?></option>
                <?php } } //endfor //endif  ?>
              </select>
            </div>
          </div>

        </div>

      </div>
      <footer class="txtRa">
        <button class="btn master" name="submitall" value="makevariants"><?php echo T_("Next"); ?></button>
      </footer>
    </div>
  </div>

</form>
