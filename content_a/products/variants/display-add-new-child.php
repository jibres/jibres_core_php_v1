<form method="post" autocomplete="off">
  <div class="avand-md">
    <div class="box">
      <div class="body">
        <p>
          <?php echo T_("You have already added variants to this product. You can now add a specific type to one of the added variants types"); ?>
        </p>
        <?php for ($i=1; $i <= 3 ; $i++) {?>
        <?php if(\dash\get::index($variantsList, 'variants', 'option'. $i, 'name')) {?>
        <div class="f">
          <div class="cauto mB10">
            <label><?php echo T_("Property #:val", ['val' => \dash\fit::number($i)]); ?></label>
            <div class="input">
              <input disabled type="text" name="optionname<?php echo $i; ?>" value="<?php echo \dash\get::index($variantsList, 'variants', 'option'. $i, 'name'); ?>">
            </div>
          </div>

          <div class="c pLa5 mB10">
            <div>
              <label>&nbsp;</label>
              <select name="optionvalue<?php echo $i; ?>[]" id="optionvalue<?php echo $i; ?>" class="select22" data-model="tag" multiple="multiple">
                <?php if(isset($variantsList['variants']['option'. $i]['value']) && is_array($variantsList['variants']['option'. $i]['value'])) { foreach ($variantsList['variants']['option'. $i]['value'] as $key => $value) {?>
                  <option value="<?php echo $value; ?>" selected ><?php echo $value; ?></option>
                <?php } } //endfor //endif  ?>
              </select>
            </div>
          </div>

        </div>
        <?php } //endif ?>
        <?php } //endfor ?>

        <?php for ($i=1; $i <= 3 ; $i++) {?>
        <?php if(!\dash\get::index($variantsList, 'variants', 'option'. $i, 'name')) {?>
        <div class="f">
          <div class="cauto mB10">
            <label><?php echo T_("Property #:val", ['val' => \dash\fit::number($i)]); ?></label>
            <div class="input">
              <input type="text" name="optionname<?php echo $i; ?>" value="<?php echo \dash\get::index($variantsList, 'variants', 'option'. $i, 'name'); ?>">
            </div>
          </div>

          <div class="c pLa5 mB10">
            <div>
              <label>&nbsp;</label>
              <select name="optionvalue<?php echo $i; ?>[]" id="optionvalue<?php echo $i; ?>" class="select22" data-model="tag" multiple="multiple">
                <?php if(isset($variantsList['variants']['option'. $i]['value']) && is_array($variantsList['variants']['option'. $i]['value'])) { foreach ($variantsList['variants']['option'. $i]['value'] as $key => $value) {?>
                  <option value="<?php echo $value; ?>" selected><?php echo $value; ?></option>
                <?php } } //endfor //endif  ?>
              </select>
            </div>
          </div>

        </div>
        <?php } //endif ?>
        <?php } //endfor ?>




      </div>
      <footer class="txtRa">
        <button class="btn master" name="submitall" value="makevariantsagain"><?php echo T_("Add"); ?></button>
      </footer>
    </div>
  </div>

</form>
