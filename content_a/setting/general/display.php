<?php
$storeData = \dash\data::store_store_data();
\dash\data::storeData($storeData);

?>
<section class="f" data-option='setting-title'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Business Title");?></h3>
      <div class="body">
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <div class="action">
      <a class="btn primary" href="<?php echo \dash\url::that(). '/title' ?>"><?php echo T_("Business title") ?></a>
    </div>
  </form>
</section>

<section class="f" data-option='setting-logo'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Business Logo");?></h3>
      <div class="body">
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <div class="action">
      <a class="btn primary" href="<?php echo \dash\url::this(). '/logo' ?>"><?php echo T_("Business logo") ?></a>
    </div>
  </form>
</section>

<section class="f" data-option='setting-currency'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Store Currency"); ?></h3>
      <div class="body">
        <p><?php echo T_("This is the currency your products are sold in."); ?> <b><?php echo T_("After your first sale, currency is locked in and can't be changed."); ?></b></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_currency" value="1">
    <div class="action">
      <select class="select22" name="currency" id="currency">
        <?php if(!\dash\data::storeData_currency()) {?>
          <option disabled selected></option>
        <?php } //endif ?>
        <?php foreach (\dash\data::currencyList() as $key => $value) {?>
          <option value="<?php echo $key; ?>" <?php if(\dash\data::storeData_currency() == $key) { echo 'selected';}elseif(\dash\data::storeData_country() == 'IR' && $key == 'IRT' && !\dash\data::storeData_currency()) {echo 'selected';} ?> ><?php echo a($value, 'name'); ?> - <?php echo a($value, 'symbol_native'); ?></option>
        <?php } //endfor ?>
      </select>
    </div>
  </form>
</section>


<section class="f" data-option='setting-weight'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Weight Unit"); ?></h3>
      <div class="body">
        <p><?php echo T_("This is the unit for your product weight."); ?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_mass" value="1">
    <div class="action">
      <select name="mass_unit" id="mass" class="select22">
        <?php if(!\dash\data::storeData_mass_unit()) {?>
          <option disabled selected></option>
        <?php } //endif ?>
        <?php foreach (\dash\data::massList() as $key => $value) {?>
          <option value="<?php echo $key; ?>" <?php if(\dash\data::storeData_mass_unit() == $key) { echo 'selected'; } ?> ><?php echo a($value, 'name'); ?></option>
        <?php } //endfor ?>
      </select>
    </div>
  </form>
</section>


<section class="f" data-option='setting-length'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Dimensions Unit"); ?></h3>
      <div class="body">
        <p><?php echo T_("We are get product dimensions in this unit."); ?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_length" value="1">
    <div class="action">
      <select name="length_unit" id="length" class="select22">
        <?php if(!\dash\data::storeData_length_unit()) {?>
          <option disabled selected></option>
        <?php } //endif ?>
        <?php foreach (\dash\data::lengthList() as $key => $value) {?>
          <option value="<?php echo $key; ?>" <?php if(\dash\data::storeData_length_unit() == $key) { echo 'selected'; } ?> ><?php echo a($value, 'name'); ?></option>
        <?php } //endfor ?>
      </select>
    </div>
  </form>
</section>

<section class="f" data-option='setting-lang'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Business language"); ?></h3>
      <div class="body">
        <p><?php echo T_("Please choose your business default language"); ?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_lang" value="1">
    <div class="action">
      <select name="lang" class="select22">
        <option value=""><i><?php echo T_("Please select one item"); ?></i></option>
        <?php foreach (\dash\language::all(true) as $key => $value) {?>
          <option value="<?php echo $key; ?>" <?php if(a($storeData, 'lang') == $key) {echo 'selected';} ?>><?php echo $value; ?></option>
        <?php } //endfor ?>
      </select>
    </div>
  </form>
</section>


<section class="f" data-option='setting-nosale'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Is your business not able to sell goods or services?"); ?></h3>
      <div class="body">
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_nosale" value="1">
    <div class="action">
      <div class="switch1">
        <input id="inosale" type="checkbox" name="nosale" <?php if(\dash\data::storeData_nosale()){ echo 'checked'; } ?>>
        <label for="inosale" data-on="<?php echo T_("Yes"); ?>" data-off="<?php echo T_("No") ?>"></label>
      </div>
    </div>
  </form>
</section>


<section class="f" data-option='setting-allow-enter'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Allow customer to enter in your business");?></h3>
      <div class="body">
        <p><?php echo T_("If this feature is off no body can enter or signup in your business");?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_enterdisallow" value="1">
    <div class="action">
      <div class="switch1">
        <input id="ienterdisallow" type="checkbox" name="enterdisallow" <?php if(\dash\data::storeData_enterdisallow()) {}else{ echo 'checked'; } ?>>
        <label for="ienterdisallow"></label>
      </div>
    </div>
  </form>
</section>


<div data-response='enterdisallow' <?php if(\dash\data::storeData_enterdisallow()) { echo "data-response-hide";} ?>>
  <section class="f" data-option='setting-allow-signup'>
    <div class="c8 s12">
      <div class="data">
        <h3><?php echo T_("Allow customer to signup in your business");?></h3>
        <div class="body">
          <p><?php echo T_("If this feature is off no body can signup in your business");?></p>
        </div>
      </div>
    </div>
    <form class="c4 s12" method="post" data-patch>
      <input type="hidden" name="set_entersignupdisallow" value="1">
      <div class="action">
        <div class="switch1">
          <input id="ientersignupdisallow" type="checkbox" name="entersignupdisallow" <?php if(\dash\data::storeData_entersignupdisallow()) {}else{ echo 'checked'; } ?>>
          <label for="ientersignupdisallow"></label>
        </div>
      </div>
    </form>
  </section>
</div>

<section class="f" data-option='setting-remove'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Remove business");?></h3>
      <div class="body">
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <div class="action">
      <a class="btn danger" href="<?php echo \dash\url::that(). '/remove' ?>"><?php echo T_("Remove Business") ?></a>
    </div>
  </form>
</section>