<?php
$propertyList       = \dash\data::propertyList();
$storData           = \dash\data::store_store_data();
$productDataRow     = \dash\data::productDataRow();
$have_variant_child = \dash\data::productDataRow_variant_child();
$child_list         = \dash\data::productDataRow_child();

?>


<form method="post" autocomplete="off" id="form1">
  <div class="avand-md">


  <div class="box">
    <header><h2><?php echo T_("Organization") ?></h2></header>
    <div class="pad">
      <?php if(\dash\data::productDataRow_parent() || $have_variant_child) { /* Show the unit and type*/}else{ /*Hide the unit and type*/ ?>
      <div class="row padLess mB5">
        <div class="c">
          <div class="radio3">
            <input type="radio" name="type" value="product" id="typeProduct" <?php if(!\dash\data::productDataRow() || \dash\data::productDataRow_type() === 'product') {echo 'checked';} ?> >
            <label for="typeProduct"><?php echo T_("Product"); ?></label>
          </div>
        </div>
        <div class="c">
          <div class="radio3">
            <input type="radio" name="type" value="service" id="typeService" <?php if(\dash\data::productDataRow_type() == 'service') { echo 'checked'; } if($have_variant_child || \dash\data::productDataRow_parent()) { echo ' disabled ';} ?>  >
            <label for="typeService"><?php echo T_("Service"); ?></label>
          </div>
        </div>

        <?php if(false) {?>
        <div class="c">
          <div class="radio3">
            <input type="radio" name="type" value="file" id="typeFile" <?php if(\dash\data::productDataRow_type() == 'file') { echo 'checked'; } if($have_variant_child || \dash\data::productDataRow_parent()) { echo ' disabled ';} ?>>
            <label for="typeFile"><?php echo T_("File"); ?></label>
          </div>
        </div>
      <?php } //endif ?>
      </div>
    <?php } //endif ?>
      <div class="mB10">
        <div class="row align-center">
          <div class="c"><label for='unit'><?php echo T_("Unit"); ?></label></div>
          <div class="c-auto os"><a class="font-12"<?php if(!\dash\detect\device::detectPWA()) { echo " target='_blank' ";} ?>href="<?php echo \dash\url::here(); ?>/units"><?php echo T_("Manage"); ?> <i class="sf-link-external"></i></a></div>
        </div>
        <select name="unit" id="unit" class="select22" data-model='tag' data-placeholder='<?php echo T_("like Qty, kg, etc"); ?>' <?php if(\dash\data::productDataRow_parent()) echo 'disabled'; ?> >
            <option value=""><?php echo T_("like Qty, kg, etc"); ?></option>
          <?php if(\dash\data::productDataRow_unit_id()) {?>
            <option value="0"><?php echo T_("Without unit"); ?></option>
          <?php } //endif ?>
<?php foreach (\dash\data::listUnits() as $key => $value) {?>
            <option value="<?php echo $value['title']; ?>" <?php if($value['id'] == \dash\data::productDataRow_unit_id()) { echo 'selected'; } ?> ><?php echo $value['title']; ?></option>
<?php } //endfor ?>
        </select>
      </div>

      <div class="mB10">
        <div class="row align-center">
          <div class="c"><label for='company'><?php echo T_("Brand"); ?></label></div>
          <div class="c-auto os"><a class="font-12"<?php if(!\dash\detect\device::detectPWA()) { echo " target='_blank' ";} ?>href="<?php echo \dash\url::here(); ?>/company"><?php echo T_("Manage"); ?> <i class="sf-link-external"></i></a></div>
        </div>
        <select name="company" id="company" class="select22" data-model="tag" data-placeholder='<?php echo T_("Product Brand"); ?>'>
          <option value=""><?php echo T_("Product Brand"); ?></option>
          <?php if(\dash\data::productDataRow_company_id()) {?>
            <option value="0"><?php echo T_("Without Brand"); ?></option>
          <?php } //endif ?>
<?php foreach (\dash\data::listCompanies() as $key => $value) {?>
            <option value="<?php echo $value['title']; ?>" <?php if($value['id'] == \dash\data::productDataRow_company_id()) { echo 'selected'; } ?> ><?php echo $value['title']; ?></option>
<?php } //endfor ?>

        </select>
      </div>

    </div>
  </div>

  <?php if(!$have_variant_child) {?>

  <section class="box">
        <header><h2><?php echo T_("Cart limit"); ?></h2></header>
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
    <?php } //endif ?>

  </div>

</form>