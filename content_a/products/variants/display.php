<?php
$variantsList = \dash\data::variantsList();
?>


<div class="f justify-center">
  <div class="jPage c9 s12 m12" >
    <div class="c8 x9 s12 pRa10">


        <section class="jbox">
          <header><h2><?php echo T_("Variants"); ?></h2></header>
          <div class="pad jboxVariants">

            <?php if(!\dash\data::productDataRow_variant_child() && !\dash\data::productDataRow_parent() && !\dash\data::productDataRow_first_sale()) {?>


            <form method="post" autocomplete="off">

              <p class="msg"><?php echo T_("You can differentiate your product in terms of three features"); ?></p>

              <div class="f">
                <div class="cauto mB10">
                  <div class="input">
                  <input type="text" name="optionname1" placeholder='<?php echo T_("Color"); ?>' value="<?php echo \dash\get::index($variantsList, 'variants', 'option1', 'name'); ?>">
                </div>
                </div>

                <div class="c pLa5 mB10">
                  <div>
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
                  <div class="input">
                  <input type="text" name="optionname2" placeholder='<?php echo T_("Size"); ?>' value="<?php echo \dash\get::index($variantsList, 'variants', 'option2', 'name'); ?>">
                </div>
                </div>

                <div class="c pLa5 mB10">
                  <div>
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
                  <div class="input">
                  <input type="text" name="optionname3" placeholder='<?php echo T_("Material"); ?>' value="<?php echo \dash\get::index($variantsList, 'variants', 'option3', 'name'); ?>">
                </div>
                </div>

                <div class="c pLa5 mB10">
                  <div>
                  <select name="optionvalue3[]" id="optionvalue3" class="select22" data-model="tag" multiple="multiple">
                    <?php if(isset($variantsList['variants']['option3']['value']) && is_array($variantsList['variants']['option3']['value'])) { foreach ($variantsList['variants']['option3']['value'] as $key => $value) {?>
                      <option value="<?php echo $value; ?>" selected><?php echo $value; ?></option>
                    <?php } } //endfor //endif  ?>
                  </select>
                </div>
                </div>

              </div>

              <div class="txtRa">

                <button class="btn master mB10" name="submitall" value="makevariants"><?php echo T_("Make product variants"); ?></button>
              </div>
            </form>
            <form method="post" autocomplete="off">

              <?php if(isset($variantsList['temp_product']) && is_array($variantsList['temp_product'])) {?>

              <?php $myCount = 0; ?>


              <input type="hidden" name="setvariants" value="1">
              <div class="tblBox mT10">
                <table class="tbl1 v1 fs08">
                  <thead>
                    <tr>
                      <th class="collapsing"><?php echo T_("Avalible?"); ?></th>
                      <th class="collapsing"><?php echo \dash\get::index($variantsList, 'variants', 'option1', 'name'); ?></th>
                      <?php if(isset($variantsList['variants']['option2']['value']) && $variantsList['variants']['option2']['value']) {?><th class="collapsing"><?php echo \dash\get::index($variantsList, 'variants', 'option2', 'name'); ?></th><?php } //endif ?>
                      <?php if(isset($variantsList['variants']['option3']['value']) && $variantsList['variants']['option3']['value']) {?><th class="collapsing"><?php echo \dash\get::index($variantsList, 'variants', 'option3', 'name'); ?></th><?php } //endif ?>
                      <th><?php echo T_("Stock"); ?></th>
                      <th><?php echo T_("Price"); ?></th>
                      <th><?php echo T_("SKU"); ?></th>
                      <th><?php echo T_("Barcode"); ?></th>

                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($variantsList['temp_product'] as $key => $value) {?>

                    <?php $myCount++; ?>

                      <tr>
                        <td class="collapsing">
                          <div class="check1">
                                  <input type="checkbox" name="avalible_<?php echo $myCount; ?>" value="1" id="sChk<?php echo $myCount; ?>" checked>
                                  <label for="sChk<?php echo $myCount; ?>"><?php echo \dash\fit::number($myCount); ?></label>
                                </div>
                        </td>
                        <?php $myOptionKey = 0; ?>

                        <?php foreach ($value as $k => $v) {?>
                          <?php $myOptionKey++; ?>

                          <td class="collapsing">
                            <input type="hidden" name="option<?php echo $myOptionKey; ?>_<?php echo $myCount; ?>" value="<?php echo $v; ?>">
                            <?php echo $v; ?>
                          </td>

                        <?php }//endfor ?>
                        <td>
                          <div class="input">
                            <input type="number" name="stock_<?php echo $myCount; ?>" placeholder='<?php echo T_("Stock"); ?>'>
                          </div>
                        </td>

                        <td>

                          <input type="hidden" name="buyprice_<?php echo $myCount; ?>" value="<?php echo \dash\data::productDataRow_buyprice(); ?>">
                          <input type="hidden" name="discount_<?php echo $myCount; ?>" value="<?php echo \dash\data::productDataRow_discount(); ?>">

                          <div class="input">
                            <input type="number" name="price_<?php echo $myCount; ?>" placeholder='<?php echo T_("Price"); ?>' value="<?php echo \dash\data::productDataRow_price(); ?>">
                          </div>
                        </td>

                        <td>
                          <div class="input">
                            <input type="text" name="sku_<?php echo $myCount; ?>" placeholder='<?php echo T_("SKU"); ?>'>
                          </div>
                        </td>

                        <td>
                          <div class="input">
                            <input type="text" name="barcode_<?php echo $myCount; ?>" placeholder='<?php echo T_("Barcode"); ?>'>
                          </div>
                        </td>
                      </tr>
                    <?php } //endfor ?>
                  </tbody>
                </table>
              </div>

                <p>
                  <?php echo T_("Only product by check the need box and set price and stock can add to your product list!"); ?>
                </p>
                <div class="txtRa">
                  <button class="btn success" name="submitall" value="savevariants"><?php echo T_("Save"); ?></button>
                </div>


          <?php } //endif ?>

            </form>

        <?php }else{ ?>
          <?php if(\dash\data::productDataRow_variant_child()) {?>

            <p class="msg warn"><?php echo T_("This product have some child and can not make variant"); ?></p>

          <?php } //endif ?>

          <?php if(\dash\data::productDataRow_parent()) {?>

            <p class="msg warn"><?php echo T_("This is child of another product"); ?></p>
          <?php }//endif ?>

           <?php if(\dash\data::productDataRow_first_sale()) {?>

            <p class="msg warn"><?php echo T_("Can not set variants after sale, buy or any factor type of this products"); ?></p>
          <?php }//endif ?>

        <?php }//endif ?>

          </div>
      </section>
    </div>
  </div>
</div>














