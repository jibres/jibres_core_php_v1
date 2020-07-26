  <?php
  $propertyList   = \dash\data::propertyList();
  $storData       = \dash\data::store_store_data();
  $productDataRow = \dash\data::productDataRow();

  ?>

  <form method="post" autocomplete="off" id="form1">
    <div class="avand-md">
      <section class="box">
        <header><h2><?php echo T_("General property"); ?></h2></header>
        <div class="body">
          <div data-response='type' data-response-where='file' <?php if(\dash\data::productDataRow_type() == 'file'){}else{echo 'data-response-hide';} ?>>
            <label for="iFileSize"><?php echo T_("File Size"); ?></label>
            <div class="input">
              <input type="text" name="filesize" id="iFileSize" value="<?php echo \dash\get::index($productDataRow,'filesize'); ?>"  autocomplete="off" maxlength="11" data-format='number'>
              <div class="addon"><?php echo T_("MB"); ?></div>
            </div>
            <label for="iFileAddress"><?php echo T_("File Address"); ?></label>
            <div class="input">
              <input type="url" name="fileaddress" id="iFileAddress" value="<?php echo \dash\get::index($productDataRow,'fileaddress'); ?>"   maxlength="500">
            </div>
          </div>
          <div class="f">
            <div class="c s12 pRa5">
              <label for='minsale'><?php echo T_("Min quantity per order"); ?></label>
              <div class="input">
                <input type="text" name="minsale" id="minsale" data-format='number' value="<?php echo \dash\get::index($productDataRow,'minsale'); ?>" maxlength="7">
              </div>
            </div>
            <div class="c s12">
              <label for='maxsale'><?php echo T_("Max quantity per order"); ?></label>
              <div class="input">
                <input type="text" name="maxsale" id="maxsale" data-format='number' value="<?php echo \dash\get::index($productDataRow,'maxsale'); ?>" maxlength="7">
              </div>
            </div>
          </div>
          <label for='salestep'><?php echo T_("Step quantity"); ?></label>
          <div class="input">
            <input type="text" name="salestep" id="salestep" data-format='number' value="<?php echo \dash\get::index($productDataRow,'salestep'); ?>" maxlength="7">
          </div>
          <label for="ipreparationtime"><?php echo T_("Preparation time"); ?></label>
          <div class="input">
            <input type="text" name="preparationtime" id="ipreparationtime" value="<?php echo \dash\get::index($productDataRow,'preparationtime'); ?>"  autocomplete="off" maxlength="3" data-format='number'>
            <div class="addon"><?php echo T_("Hour"); ?></div>
          </div>
        </div>
      </section>
    </div>
  </div>
</form>