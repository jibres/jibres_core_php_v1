<?php $showPriceWholeEdit = true; ?>
<?php if($have_variant_child) {?>
<div class="box">
  <div class="pad">

      <div class="f">
        <div class="cauto">
          <div class="check1">
            <input type="checkbox" name="wholeeditequalprice" id="wholeeditequalprice" <?php if(\dash\get::index(\dash\data::productDataRow(), 'allPriceIsEqual')) { echo 'checked'; }else{$showPriceWholeEdit = false; } ?>>
            <label for="wholeeditequalprice"><?php echo T_("Change all child price") ?></label>
          </div>
        </div>
        <div class="c"></div>
        <div class="cauto">
          <a class="link btn" href="<?php echo \dash\url::this(). '/child?id='. \dash\request::get('id') ?>"><?php echo T_("Manage each independently"); ?> </a>
        </div>
      </div>
  </div>
</div>
<?php } //endif ?>
<div data-response='wholeeditequalprice' data-response-effect='slide' <?php if($showPriceWholeEdit) {/*nothing*/}else{echo 'data-response-hide'; } //endif ?>>

 <div class="box">
      <div class="pad jboxPrice">


        <div class="f" data-response='type' data-response-where='product' <?php if(!$productDataRow || \dash\data::productDataRow_type() === 'product'){}else{ echo 'data-response-hide';}?>  >
          <div class="c s12 pRa5">
            <label for='buyprice'><?php echo T_("Buy cost"); ?></label>
            <div class="input fix ltr">
              <input type="tel" name="buyprice" id="buyprice" data-format='price' value="<?php echo \dash\get::index($productDataRow,'buyprice'); ?>" maxlength="18" data-run-input='calcProductMargin'>
            </div>
          </div>
          <div class="c s12">
            <div class="grossProfitMargin hideIn">
              <label for='buyprice'><?php echo T_("Gross profit"); ?></label>
              <div class="msg h36" data-percent='11'>
                <div class="f">
                  <div class="c"></div>
                  <div class="cauto"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="f mB10">
          <div class="c s12 pRa5">
            <label for='price'><?php echo T_("Sale Price"); ?></label>
            <div class="input fix ltr mB5-f">
              <input type="tel" name="price" id="price" data-format='price' value="<?php echo \dash\get::index($productDataRow,'price'); ?>" maxlength="18" data-run-input='calcProductMargin'>
            </div>
          </div>
          <div class="c s12">
            <label for='discount'><?php echo T_("Discount"); ?></label>
            <div class="input fix ltr mB5-f">
              <input type="tel" name="discount" id="discount" data-format='price' value="<?php echo \dash\get::index($productDataRow,'discount'); ?>" maxlength="18" data-run-input='calcProductMargin'>
              <div class="addon fs09" id='discountRate'></div>
            </div>
          </div>
        </div>

        <?php if(isset($storData['tax_status']) && $storData['tax_status']) {?>
          <div class="msg h36 dark2">
            <div class="f align-center">
              <div class="c pRa5">
                <div class="check1 mB0">
                  <input type="checkbox" name="vat" id="vat" data-rate='0.09' data-run-input='calcProductMargin' <?php if(\dash\data::productDataRow_vat()) { echo 'checked'; } ?> >
                  <label for="vat"><?php echo T_("Charge taxes"); ?><span class="compact mLa10 txtB"><?php echo \dash\fit::number(9); ?>%</span></label>
                </div>
              </div>
              <div class="cauto"><?php echo T_("VAT"); ?></div>
              <div class="cauto ltr txtL pLR5" id="vatCost"></div>
              <div class="cauto"><?php echo \dash\get::index($storData,'currency_detail','symbol_native'); ?></div>
            </div>
          </div>
        <?php } //endif ?>
        <div>
          <div class="msg mT10 mB0 minimal">
            <div class="f align-center">
              <div class="cauto"><?php echo T_("Final Price"); ?></div>
              <div class="c ltr txtRa pLR5 fs16" id="finalPrice"><?php echo \dash\get::index($productDataRow,'finalprice'); ?></div>
              <div class="cauto" id="moneyUnit"><?php echo \dash\get::index($storData,'currency_detail','symbol_native'); ?></div>
            </div>
          </div>
          <?php if(\dash\language::current() === 'fa') {?>
            <div class="msg info2 txtB finalPriceToman"></div>
          <?php } //endif ?>
        </div>
      </div>
    </div>
</div>