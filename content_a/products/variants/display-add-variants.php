<form method="post" autocomplete="off">
  <div class="avand-md">
    <div class="box">
      <div class="body">

        <p class="msg"><?php echo T_("You can differentiate your product in terms of three features"); ?></p>

        <div class="row msg minimal">
          <div class="c-xs-12 c-sm-12 c-md-4">
            <label><?php echo T_("Property #1"); ?></label>
            <div class="input">
              <input type="text" name="optionname1" value="<?php echo a($variantsList, 'variants', 'option1', 'name'); ?>" placeholder="<?php echo T_("Like Size") ?>">
            </div>
          </div>

          <div class="c-xs-12 c-sm-12 c-md-8">
            <label><?php echo T_("Value"); ?></label>
            <div>
              <select name="optionvalue1[]" id="optionvalue1" class="select22" data-model="tag" multiple="multiple" data-placeholder="<?php echo T_("Like Medium, Large, xLarge, xxLarge") ?>">
                <?php if(isset($variantsList['variants']['option1']['value']) && is_array($variantsList['variants']['option1']['value'])) { foreach ($variantsList['variants']['option1']['value'] as $key => $value) {?>
                  <option value="<?php echo $value; ?>" selected><?php echo $value; ?></option>
                <?php } } //endfor //endif  ?>
              </select>
            </div>
          </div>

        </div>

        <div class="row msg minimal">
          <div class="c-xs-12 c-sm-12 c-md-4">
            <label><?php echo T_("Property #2"); ?></label>
            <div class="input">
              <input type="text" name="optionname2" value="<?php echo a($variantsList, 'variants', 'option2', 'name'); ?>" placeholder="<?php echo T_("Like Color") ?>">
            </div>
          </div>

          <div class="c-xs-12 c-sm-12 c-md-8">
            <label><?php echo T_("Value"); ?></label>
            <div>
              <select name="optionvalue2[]" id="optionvalue2" class="select22" data-model="tag" multiple="multiple" data-placeholder="<?php echo T_("Like Red, Blue, Green") ?>">
                <?php if(isset($variantsList['variants']['option2']['value']) && is_array($variantsList['variants']['option2']['value'])) { foreach ($variantsList['variants']['option2']['value'] as $key => $value) {?>
                  <option value="<?php echo $value; ?>" selected><?php echo $value; ?></option>
                <?php } } //endfor //endif  ?>
              </select>
            </div>
          </div>

        </div>

        <div class="row msg minimal">
          <div class="c-xs-12 c-sm-12 c-md-4">
            <label><?php echo T_("Property #3"); ?></label>
            <div class="input">
              <input type="text" name="optionname3" value="<?php echo a($variantsList, 'variants', 'option3', 'name'); ?>" placeholder="<?php echo T_("Like Material") ?>">
            </div>
          </div>

          <div class="c-xs-12 c-sm-12 c-md-8">
            <label><?php echo T_("Value"); ?></label>
            <div>
              <select name="optionvalue3[]" id="optionvalue3" class="select22" data-model="tag" multiple="multiple" data-placeholder="<?php echo T_("Like Wood, Bamboo, xlarge") ?>">
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
