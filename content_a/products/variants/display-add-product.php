<form method="post" autocomplete="off">
  <div class="avand-xl">
    <div class="box">
      <div class="body">

         <?php if(isset($variantsList['temp_product']) && is_array($variantsList['temp_product'])) {?>

                <p>
                    <?php echo T_("You have :val different models of this product", ['val' => \dash\fit::number(count($variantsList['temp_product']))]) ?>
                    <br>
                    <?php echo T_("Remove any products you do not need"); ?>
                    <br>
                    <?php echo T_("Please enter the price and inventory of each product and then click the save button"); ?>
                  </p>


              <?php $myCount = 0; ?>


              <input type="hidden" name="setvariants" value="1">
              <div class="tblBox mT10">
                <table class="tbl1 v4 fs09">
                  <thead>
                    <tr>
                      <th class="collapsing"></th>
                      <th class="collapsing"><?php echo \dash\get::index($variantsList, 'variants', 'option1', 'name'); ?></th>
                      <?php if(isset($variantsList['variants']['option2']['value']) && $variantsList['variants']['option2']['value']) {?><th class="collapsing"><?php echo \dash\get::index($variantsList, 'variants', 'option2', 'name'); ?></th><?php } //endif ?>
                      <?php if(isset($variantsList['variants']['option3']['value']) && $variantsList['variants']['option3']['value']) {?><th class="collapsing"><?php echo \dash\get::index($variantsList, 'variants', 'option3', 'name'); ?></th><?php } //endif ?>
                      <th><?php echo T_("Stock"); ?></th>
                      <th><?php echo T_("Price"); ?></th>
                      <th><?php echo T_("Discount"); ?></th>
                      <th class="collapsing"></th>


                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($variantsList['temp_product'] as $key => $value) {?>

                    <?php $myCount++; ?>

                      <tr data-removeElement>
                        <td class="collapsing"><?php echo \dash\fit::number($myCount); ?>
                            <div class="hide">
                              <input type="hidden" name="avalible_<?php echo $myCount; ?>" value="1">
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
                            <input type="number" name="discount_<?php echo $myCount; ?>" placeholder='<?php echo T_("Discount"); ?>' value="<?php echo \dash\data::productDataRow_discount(); ?>">
                          </div>
                        </td>

                        <td class="collapsing">
                          <div><i data-removeElTrigger class="sf-trash fc-red fs14"></i></div>
                        </td>

                      </tr>
                    <?php } //endfor ?>
                  </tbody>
                </table>
              </div>




          <?php } //endif ?>

      </div>
      <footer class="f">
        <div class="cauto"><a class="btn secondary outline" href="<?php echo \dash\url::that(). '?id='. \dash\data::productDataRow_id(). '&makevariants=1'; ?>"><?php echo T_("Edit options") ?></a></div>
        <div class="c"></div>
        <div class="cauto"><button class="btn master" name="submitall" value="savevariants"><?php echo T_("Save"); ?></button></div>


      </footer>
    </div>
  </div>

</form>
