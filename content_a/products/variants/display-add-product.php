<form method="post" autocomplete="off">
  <div class="avand-xl">
    <div class="box">
      <div class="body">

         <?php if(isset($variantsList['temp_product']) && is_array($variantsList['temp_product'])) {?>

                <p><?php echo T_("You have :val different models of this product", ['val' => \dash\fit::number(count($variantsList['temp_product']))]) ?></p>
                <p>
                  <?php echo T_("Only product by check the need box can add to your product list!"); ?>
                </p>

              <?php $myCount = 0; ?>


              <input type="hidden" name="setvariants" value="1">
              <div class="tblBox mT10">
                <table class="tbl1 v4 fs09">
                  <thead>
                    <tr>
                      <th class="collapsing"><?php echo T_("Avalible?"); ?></th>
                      <th class="collapsing"><?php echo \dash\get::index($variantsList, 'variants', 'option1', 'name'); ?></th>
                      <?php if(isset($variantsList['variants']['option2']['value']) && $variantsList['variants']['option2']['value']) {?><th class="collapsing"><?php echo \dash\get::index($variantsList, 'variants', 'option2', 'name'); ?></th><?php } //endif ?>
                      <?php if(isset($variantsList['variants']['option3']['value']) && $variantsList['variants']['option3']['value']) {?><th class="collapsing"><?php echo \dash\get::index($variantsList, 'variants', 'option3', 'name'); ?></th><?php } //endif ?>
                      <th><?php echo T_("Stock"); ?></th>
                      <th><?php echo T_("Price"); ?></th>
                      <th><?php echo T_("Discount"); ?></th>


                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($variantsList['temp_product'] as $key => $value) {?>

                    <?php $myCount++; ?>

                      <tr>
                        <td class="collapsing">
                          <div class="check1">
                                  <input type="checkbox" name="avalible_<?php echo $myCount; ?>" value="1" id="sChk<?php echo $myCount; ?>"  checked>
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
                          <div class="input">
                            <input type="number" name="price_<?php echo $myCount; ?>" placeholder='<?php echo T_("Price"); ?>' value="<?php echo \dash\data::productDataRow_price(); ?>">
                          </div>
                        </td>

                        <td>
                          <div class="input">
                            <input type="number" name="discount_<?php echo $myCount; ?>" placeholder='<?php echo T_("Price"); ?>' value="<?php echo \dash\data::productDataRow_discount(); ?>">
                          </div>
                        </td>

                      </tr>
                    <?php } //endfor ?>
                  </tbody>
                </table>
              </div>




          <?php } //endif ?>

      </div>
      <footer class="f">
        <div class="cauto"><a class="btn secondary outline" href="<?php echo \dash\url::that(). '?id='. \dash\data::productDataRow_id(). '&makevariants=1'; ?>"><?php echo T_("Change variants model") ?></a></div>
        <div class="c"></div>
        <div class="cauto"><button class="btn master" name="submitall" value="savevariants"><?php echo T_("Add variants products"); ?></button></div>


      </footer>
    </div>
  </div>

</form>
