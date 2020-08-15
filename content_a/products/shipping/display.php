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
    <header><h2><?php echo T_("Shipping") ?></h2></header>
    <div class="pad">
      <label for="iweight"><?php echo T_("Weight"); ?></label>
      <div class="input mB0-f">
        <input type="text" name="weight" id="iweight" value="<?php echo \dash\get::index($productDataRow,'weight'); ?>" autocomplete="off" maxlength="7" data-format='number'>
        <div class="addon small"><?php echo \dash\get::index($storData,'mass_detail','name'); ?></div>
      </div>

      <label for="ipreparationtime"><?php echo T_("Preparation time"); ?></label>
          <div class="input">
            <input type="text" name="preparationtime" id="ipreparationtime" value="<?php echo \dash\get::index($productDataRow,'preparationtime'); ?>"  autocomplete="off" maxlength="3" data-format='number'>
            <div class="addon"><?php echo T_("Hour"); ?></div>
          </div>
    </div>
  </div>

  </div>

</form>