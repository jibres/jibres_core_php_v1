
<div id="get_started_card">
  <div class="body">
    <div class="pad">
      <h1><?php echo \dash\face::title(); ?></h1>
      <p><?php echo T_("Please choose your store default units."); ?></p>

      <form method="post" autocomplete="off">

        <div class="mB10">
          <label for='currency'><?php echo T_("Store Currency"); ?></label>
          <select class="select22" name="currency" id="currency">
            <?php if(!\dash\data::dataRow_currency()) {?>

            <option disabled selected></option>

            <?php } //endif ?>

            <?php foreach (\dash\data::currencyList() as $key => $value) {?>


                <option value="<?php echo $key; ?>" <?php if(\dash\data::dataRow_currency() == $key) { echo 'selected';}elseif(\dash\data::dataRow_country() == 'IR' && $key == 'IRT' && !\dash\data::dataRow_currency()) {echo 'selected';} ?> ><?php echo \dash\get::index($value, 'name'); ?> - <?php echo \dash\get::index($value, 'symbol_native'); ?></option>

              <?php } //endfor ?>
          </select>
          <p class="mT10 fc-mute"><?php echo T_("This is the currency your products are sold in."); ?> <b><?php echo T_("After your first sale, currency is locked in and can't be changed."); ?></b></p>
        </div>

        <br>
        <div class="mB10">
          <label for='mass'><?php echo T_("Weight Unit"); ?></label>
          <select name="mass_unit" id="mass" class="select22">

            <?php if(!\dash\data::dataRow_mass_unit()) {?>
              <option disabled selected></option>
            <?php } //endif ?>

            <?php foreach (\dash\data::massList() as $key => $value) {?>

            <option value="<?php echo $key; ?>" <?php if(\dash\data::dataRow_mass_unit() == $key) { echo 'selected'; } ?> ><?php echo \dash\get::index($value, 'name'); ?></option>

            <?php } //endfor ?>

          </select>
          <p class="mT10 fc-mute"><?php echo T_("This is the unit for your product weight."); ?></p>
        </div>

        <br>
        <div class="mB10">
          <label for='length'><?php echo T_("Dimensions Unit"); ?></label>
          <select name="length_unit" id="length" class="select22">
             <?php if(!\dash\data::dataRow_length_unit()) {?>
              <option disabled selected></option>
            <?php } //endif ?>

            <?php foreach (\dash\data::lengthList() as $key => $value) {?>
            <option value="<?php echo $key; ?>" <?php if(\dash\data::dataRow_length_unit() == $key) { echo 'selected'; } ?> ><?php echo \dash\get::index($value, 'name'); ?></option>
            <?php } //endfor ?>

          </select>
          <p class="mT10 fc-mute"><?php echo T_("We are get product dimensions in this unit."); ?></p>
        </div>

        <div class="f align-center mB10">
          <div class="c fc-mute"><?php echo \dash\data::stepDesc(); ?></div>
          <div class="cauto os"><button class="btn primary"><?php echo T_("Save"); ?></button></div>
        </div>

      </form>
    </div>
  </div>
</div>
