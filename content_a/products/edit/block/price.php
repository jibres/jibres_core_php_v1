<?php $showPriceWholeEdit = true; ?>
<?php if($have_variant_child) {?>
<div class="box">
  <div class="pad">

      <div class="f">
        <div class="cauto">
          <div class="check1">
            <input type="checkbox" name="wholeeditequalprice" id="wholeeditequalprice" <?php if(a(\dash\data::productDataRow(), 'allPriceIsEqual')) { echo 'checked'; }else{$showPriceWholeEdit = false; } ?>>
            <label for="wholeeditequalprice"><?php echo T_("Change all child price") ?></label>
          </div>
        </div>
        <div class="c"></div>
        <div class="cauto">
          <a class="btn-link" href="<?php echo \dash\url::this(). '/child?id='. \dash\request::get('id') ?>"><?php echo T_("Manage each independently"); ?> </a>
        </div>
      </div>
  </div>
</div>
<?php } //endif ?>
<?php if($have_variant_child) {?>
<div data-response='wholeeditequalprice' <?php if($showPriceWholeEdit) {/*nothing*/}else{echo 'data-response-hide'; } //endif ?>>
<?php } //endif ?>
 <div class="box">
      <div class="pad jboxPrice">

        <div class="f ">
          <div class="c s12 pRa5">
            <label for='price'><?php echo T_("Sale Price"); ?></label>
            <div class="input fix ltr mB5-f">
              <input type="tel" name="price" id="price" data-format='price' value="<?php echo a($productDataRow,'price'); ?>" maxlength="18" data-run-input='calcProductMargin'>
            </div>
          </div>
          <div class="c s12">
            <label for='discount'><?php echo T_("Discount"); ?></label>
            <div class="input fix ltr mB5-f">
              <input type="tel" name="discount" id="discount" data-format='price' value="<?php echo a($productDataRow,'discount'); ?>" maxlength="18" data-run-input='calcProductMargin'>
              <div class="addon text-sm" id='discountRate'></div>
            </div>
          </div>
        </div>



        <?php if(isset($storData['tax_status']) && $storData['tax_status']) {?>
          <div class="alert2" data-desc>
            <div class="f align-center">
              <div class="c pRa5">
                <div class="check1 mb-0">
                  <input type="checkbox" name="vat" id="vat" data-rate='0.09' data-run-input='calcProductMargin' <?php if(\dash\data::productDataRow_vat()) { echo 'checked'; } ?> >
                  <label for="vat"><?php echo T_("Charge taxes"); ?><span class="inline-block mLa10 font-bold"><?php echo \dash\fit::number(\lib\vat::percent()); ?>%</span></label>
                </div>
              </div>
              <div class="cauto"><?php echo T_("VAT"); ?></div>
              <div class="cauto ltr text-left px-1" id="vatCost"></div>
              <div class="cauto"><?php echo a($storData,'currency_detail','symbol_native'); ?></div>
            </div>
          </div>
        <?php } //endif ?>
        <div>
          <div class="alert2" data-desc>
            <div class="f align-center">
                <div class="cauto">
                  <?php echo T_("Final Price"); ?>
                    <?php if(is_null(a($productDataRow,'finalprice')) && \dash\url::child() !== 'add') {?>
                      <a class="link-dark text-left" href="<?php echo \dash\url::here(). '/setting/product/free'; ?>"><?php echo T_("Set the buy button for products without price") ?></a>
                    <?php }elseif((string) a($productDataRow,'finalprice') === '0') {?>
                      <span class="text-green-700 font-bold"><?php echo T_("Free") ?></span>
                    <?php }else{ ?>
                    <?php } //endif ?>
                  </div>
                <div class="c ltr txtRa px-1" id="finalPrice"><?php echo a($productDataRow,'finalprice'); ?></div>
                <div class="cauto" id="moneyUnit"><?php echo a($storData,'currency_detail','symbol_native'); ?></div>
            </div>
          </div>
          <?php if(\dash\language::current() === 'fa') {?>
            <div class="alert-info font-bold finalPriceToman"></div>
          <?php } //endif ?>
        </div>
         <div class="f" data-response='type' data-response-where='product' <?php if(!$productDataRow || \dash\data::productDataRow_type() === 'product'){}else{ echo 'data-response-hide';}?>  >
          <div class="c s12 pRa5">
            <label for='buyprice'><?php echo T_("Buy cost"); ?> <small><?php echo T_("Customers won’t see this") ?></small></label>
            <div class="input fix ltr">
              <input type="tel" name="buyprice" id="buyprice" data-format='price' value="<?php echo a($productDataRow,'buyprice'); ?>" maxlength="18" data-run-input='calcProductMargin'>
            </div>
          </div>
          <div class="c s12">
            <div class="grossProfitMargin hideIn">
              <label for='buyprice'><?php echo T_("Gross profit"); ?></label>
              <div class="" data-percent='11' data-desc>
                <div class="f">
                  <div class="c"></div>
                  <div class="cauto"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php if($have_variant_child) {?>
</div>
<?php } //endif ?>