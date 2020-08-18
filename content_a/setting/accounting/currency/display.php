<form method="post" autocomplete="off">

<div class="avand-md">

  <div  class="box impact mB25-f">
    <header><h2><?php echo T_("Set Accounting currency");?></h2></header>
      <div class="body">

        <div class="c4 s12" method="post" autocomplete="off">
          <div class="action f">

    <div class="mB10">
          <label for='currency'><?php echo T_("Accounting Currency"); ?></label>
          <select class="select22" name="currency" id="currency">
            <?php if(!\dash\data::dataRow_currency()) {?>

            <option disabled selected></option>

            <?php } //endif ?>

            <?php foreach (\dash\data::currencyList() as $key => $value) {?>


                <option value="<?php echo $key; ?>" <?php if(\dash\data::accountingSettingSaved_currency() == $key) { echo 'selected';}elseif(\dash\data::dataRow_country() == 'IR' && $key == 'IRT' && !\dash\data::dataRow_currency()) {echo 'selected';} ?> ><?php echo \dash\get::index($value, 'name'); ?> - <?php echo \dash\get::index($value, 'symbol_native'); ?></option>

              <?php } //endfor ?>
          </select>
        </div>


          </div>
        </div>
      </div>
      <footer class="txtRa">
        <button  class="btn success" ><?php echo T_("Save"); ?></button>
      </footer>
  </div>
</div>

</form>