<div class="box">
  <div class="pad jboxCodes">
    <?php if(isset($quick_mode) && $quick_mode) { ?>
      <div>
      <div>
    <?php }else{ ?>
      <div class="mB10" data-kerkere='.showBarcodeBlock' data-kerkere-icon data-ajaxify data-data='{"set_barcodesetting": "save"}'><?php echo T_("Enable barcode"); ?></div>
      <div class="showBarcodeBlock" <?php if((isset($storData['barcode']) && $storData['barcode'])) {/*nothing*/}else{echo 'data-kerkere-content="hide"';}?>>
    <?php }// endif ?>

      <div class="f">
        <div class="c s12 pRa5">
          <label for="barcode"><?php echo T_("Barcode"); ?></label>
          <div class="input">
            <input type="text" name="barcode" id="barcode" placeholder='<?php echo T_("Scan Barcode here..."); ?>' value="<?php if(\dash\data::productDataRow_barcode()) { echo \dash\data::productDataRow_barcode(); }elseif(\dash\request::get('barcode')){ echo \dash\request::get('barcode');} ?>" class="barCode text-center ltr" data-lock autocomplete="off" maxlength="30">
            <span class="addon flag"><img class="none" src="<?php echo \dash\url::icon(); ?>" alt="Jibres"/></span>
          </div>
          <div class="text-center mB10">
            <svg class="barcodePrev" data-val="#barcode"></svg>
          </div>
        </div>
        <div class="c s12">
          <label for="barcode2"><?php echo T_("Barcode2"); ?></label>
          <div class="input">
            <input type="text" name="barcode2" id="barcode2" placeholder='<?php echo T_("Scan Barcode2 here..."); ?>' value="<?php echo a($productDataRow,'barcode2'); ?>" class="barCode text-center ltr" data-lock autocomplete="off" maxlength="30">
            <span class="addon flag"><img class="none" src="<?php echo \dash\url::icon(); ?>" alt="Jibres"/></span>
          </div>
          <div class="text-center mB10">
            <svg class="barcodePrev" data-val="#barcode2"></svg>
          </div>
        </div>
      </div>
      <?php if(isset($quick_mode) && $quick_mode) {/*nothing*/}else{ ?>
      <div class="f">
        <div data-response='type' data-response-where='product' <?php if(!$productDataRow || \dash\data::productDataRow_type() === 'product'){}else{ echo 'data-response-hide';}?> >
          <div class="c6 s12">
            <label for="codeOnScale"><?php echo T_("Code on scale"); ?></label>
            <div class="input">
              <input type="text" name="scalecode" id="codeOnScale" value="<?php echo a($productDataRow,'scalecode'); ?>" class="text-center ltr" autocomplete="off" data-format='int' maxlength="5">
            </div>
          </div>
        </div>
      </div>
    <?php } //endif ?>
    </div>
  </div>
</div>