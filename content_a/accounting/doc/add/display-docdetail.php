<?php if(\dash\data::editMode()) {?>



  <form method="post" autocomplete="off" class="box p0">
	 <input type="hidden" name="row" value="row">
    <div class="pad">
      <div class="row">
        <div class="c-xs-12 c-sm-12 c-md-8">
        	<?php if(\dash\data::assistantList()) {?>
            <label for="assistant_id"><?php echo T_("Accounting assistant") ?> <small class="fc-green">* <?php echo T_("Required") ?></small></label>
            <select class="select22" name="assistant_id" data-placeholder='<?php echo T_("Please choose assistant_id") ?>'>
              <option value=""><?php echo T_("Please choose assistant_id") ?></option>
<?php
$lastCat = null;
$showCat = null;
foreach (\dash\data::assistantList() as $key => $value)
{
  if($lastCat !== \dash\get::index($value, 'total_title'))
  {
    $showCat = true;
  }
  else
  {
    $showCat = false;
  }
  // set lastCat for next loop
  $lastCat = \dash\get::index($value, 'total_title');

  if($showCat)
  {
    echo '<optgroup label="';
    echo \dash\get::index($value, 'total_title');
    echo '">';
  }
  {
    echo '<option value="';
    echo \dash\get::index($value, 'id');
    echo '"';
    if(\dash\data::dataRowDetail_assistant_id() === \dash\get::index($value, 'id'))
    {
      echo ' selected';
    }
    echo '>';
    echo \dash\get::index($value, 'code');
    echo ' - ';
    echo \dash\get::index($value, 'title');
    echo '</option>';
  }
  if($showCat)
  {
    echo "</optgroup>";
  }
}
?>
          </select>
          <?php } // endif ?>


        </div>
        <div class="c-xs-12 c-sm-12 c-md-4">
          <?php if(\dash\data::detailsList()) {?>
            <label for="details_title"><?php echo T_("Accounting details") ?></label>
            <select class="select22" data-model='tag' name="details_title" data-placeholder='<?php echo T_("Please choose document details") ?>'>
              <option value=""><?php echo T_("Please choose document details") ?></option>
              <?php foreach (\dash\data::detailsList() as $key => $value) {?>
                <option value="<?php echo $value ?>" <?php if(\dash\data::dataRowDetail_details_title() === $value) {echo 'selected';} ?>><?php echo $value; ?></option>
              <?php } // endfor ?>
            </select>
          <?php }else{ ?>
            <label for="details_title"><?php echo T_("Accounting detail") ?></label>
            <div class="input mB0-f">
              <input type="text" name="details_title">
            </div>
          <?php } // endif ?>

        </div>
      </div>


      <div class="row align-end">
        <div class="c-xs-6 c-sm-3 c-md-2">
          <div class="radio3 mT10">
            <input type="radio" name="type" value="debtor" id="debtor" <?php if(\dash\data::dataRowDetail_type() === 'debtor') {echo 'checked';} ?>  >
            <label for="debtor"><?php echo T_("Debtor"); ?></label>
          </div>
        </div>
        <div class="c-xs-6  c-sm-3 c-md-2">
          <div class="radio3 mT10">
            <input type="radio" name="type" value="creditor" id="creditor" <?php if(\dash\data::dataRowDetail_type() === 'creditor') {echo 'checked';} ?>  >
            <label for="creditor"><?php echo T_("Creditor"); ?></label>
          </div>
        </div>
        <div class="c-xs-12 c-sm-6 c-md-4 c-lg-3 c-xl-3">
        	<label for="value"><?php echo T_("Amount") ?> <small class="fc-green"><?php echo T_("Required") ?></small></label>
        	<div class="input mB0-f">
        		<input type="tel" minlength="0" maxlength="18"  name="value" data-format='price' value="<?php if(\dash\data::dataRowDetail_value()) {echo \dash\data::dataRowDetail_value();}else{echo \dash\request::get('value');} ?>" required>
            <label class="addon" data-kerkere='.ShowCalcVat'><i class="sf-calculator"></i></label>
        	</div>
        </div>
        <div class="c-xs-12 c-sm c-md c">
        	<label for="desc"><?php echo T_("Description") ?></label>
        	<div class="input mB0-f">
        		<input type="text" name="desc" value="<?php echo \dash\data::dataRowDetail_desc(); ?>">
        	</div>
        </div>
        <div class="c-auto">
          <?php if(\dash\data::editModeDetail()) {?>
        	 <button class="btn mT10 master save"><?php echo T_("Edit") ?></button>
          <?php }else{ ?>
           <button class="btn mT10 master add"><?php echo T_("Add") ?></button>
          <?php } //endif ?>
        </div>
      </div>
    </div>

  </form>

  <form method="get" class="p0 ShowCalcVat" action="<?php echo \dash\url::current(); ?>"  autocomplete="off" <?php if(\dash\request::get('calcvat')){}else{?> data-kerkere-content='hide' <?php } //endif ?>>
    <div class="box">
      <div class="pad">


        <input type="hidden" name="id" value="<?php echo \dash\request::get('id') ?>">
        <input type="hidden" name="did" value="<?php echo \dash\request::get('did') ?>">

        <div class="row">
          <div class="c-xs-12 c-sm-4">
            <label for="calcvat"><small><?php echo T_("Calculate Vat price") ?></small></label>
            <div class="input">
              <input type="tel" id="calcvat" name="calcvat" data-format='price' value="<?php echo \dash\request::get('calcvat') ?>">
              <button class="btn primary2"><?php echo T_("Calculate vat") ?></button>
            </div>

          </div>
          <div class="c-xs-12 c-sm-4">

            <?php if(\dash\data::vatCalc()) {?>
               <label for="vat"><small><?php echo T_("Vat price") ?></small></label>
            <div class="input">
              <input type="tel" id="vat"  data-format='price' value="<?php echo \dash\data::vatValue(); ?>">
              <a href="<?php echo \dash\data::vatCalc() ?>" class="btn addon" ><i class="sf-upload"></i></a>
            </div>

            <?php } //endif ?>
          </div>
          <div class="c-xs-12 c-sm-4">

             <?php if(\dash\data::taxCalc()) {?>
               <label for="tax"><small><?php echo T_("Tax price") ?></small></label>
            <div class="input">
              <input type="tel" id="tax"  data-format='price' value="<?php echo \dash\data::taxValue(); ?>">
              <a href="<?php echo \dash\data::taxCalc() ?>" class="btn addon" ><i class="sf-upload"></i></a>
            </div>

            <?php } //endif ?>
          </div>
        </div>

      </div>
  </div>
</form>
<?php } //endif ?>

