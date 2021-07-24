<?php $savedValue = \dash\data::accountingSettingSaved(); ?>
<section class="f" data-option='accounting-setting-doc-number'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Reset accounting document number");?></h3>
      <div class="body">
        <p><?php echo T_("Reset accounting document number");?></p>
      </div>
    </div>
  </div>
  <div class="c4 s12" >
    <div class="action">
      <a class="btn master" href="<?php echo \dash\url::that(). '/resetnumber' ?>"><?php echo T_("Choose accounting year") ?></a>
    </div>
  </div>
</section>

<section class="f" data-option='setting-accounting-currency' id="setting-accounting-currency">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Set Accounting currency"); ?></h3>
      <div class="body">
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_currency" value="1">
    <div class="action">
      <select class="select22" name="currency" id="currency">
        <?php if(!\dash\data::dataRow_currency()) {?>
          <option disabled selected></option>
        <?php } //endif ?>
        <?php foreach (\dash\data::currencyList() as $key => $value) {?>
          <option value="<?php echo $key; ?>" <?php if(\dash\data::accountingSettingSaved_currency() == $key) { echo 'selected';}elseif(\dash\data::dataRow_country() == 'IR' && $key == 'IRT' && !\dash\data::dataRow_currency()) {echo 'selected';} ?> ><?php echo a($value, 'name'); ?> - <?php echo a($value, 'symbol_native'); ?></option>
        <?php } //endfor ?>
      </select>
    </div>
  </form>
</section>


<?php if(\dash\data::assistantList()) {?>
  <section class="f" data-option='assistant_close_harmful_profit' id="set_assistant_close_harmful_profit">
    <div class="c8 s12">
      <div class="data">
        <h3><?php echo T_("Default assistant id in close all harmful-profit document"); ?></h3>
        <div class="body"><p><?php echo T_("On default used from :code Accounting assistant code. if exists", ['code' => \dash\fit::text(3803)]) ?></p></div>
      </div>
    </div>
    <form class="c4 s12" method="post" data-patch>
      <input type="hidden" name="set_assistant_close_harmful_profit" value="1">
      <div class="action">
        <select class="select22" name="assistant_close_harmful_profit" data-placeholder='<?php echo T_("Please choose assistant_id") ?>'>
          <option value=""><?php echo T_("Please choose assistant_id") ?></option>
          <?php show_assistant_list_html('assistant_close_harmful_profit') ?>
        </select>
      </div>
    </form>
  </section>


  <section class="f" data-option='assistant_close_accumulated' id="set_assistant_close_accumulated">
    <div class="c8 s12">
      <div class="data">
        <h3><?php echo T_("Default assistant id in move all harmful-profit to accumulated harmful-profit document"); ?></h3>
        <div class="body"><p><?php echo T_("On default used from :code Accounting assistant code. if exists", ['code' => \dash\fit::text(3701)]) ?></p></div>
      </div>
    </div>
    <form class="c4 s12" method="post" data-patch>
      <input type="hidden" name="set_assistant_close_accumulated" value="1">
      <div class="action">
        <select class="select22" name="assistant_close_accumulated" data-placeholder='<?php echo T_("Please choose assistant_id") ?>'>
          <option value=""><?php echo T_("Please choose assistant_id") ?></option>
          <?php show_assistant_list_html('assistant_close_accumulated') ?>
        </select>
      </div>
    </form>
  </section>

  <section class="f" data-option='assistant_closing' id="set_assistant_closing">
    <div class="c8 s12">
      <div class="data">
        <h3><?php echo T_("Default assistant id in closing year document"); ?></h3>
        <div class="body"><p><?php echo T_("On default used from :code Accounting assistant code. if exists", ['code' => \dash\fit::text(1901)]) ?></p></div>
      </div>
    </div>
    <form class="c4 s12" method="post" data-patch>
      <input type="hidden" name="set_assistant_closing" value="1">
      <div class="action">
        <select class="select22" name="assistant_closing" data-placeholder='<?php echo T_("Please choose assistant_id") ?>'>
          <option value=""><?php echo T_("Please choose assistant_id") ?></option>
          <?php show_assistant_list_html('assistant_closing') ?>
        </select>
      </div>
    </form>
  </section>
<?php } // endif ?>



<section class="f" data-option='default_cost_vat' id="set_default_cost_vat">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Default vat code in cost factors"); ?></h3>
      <div class="body"><p><?php echo T_("On default used from :code Accounting assistant code. if exists", ['code' => \dash\fit::text(21061)]) ?></p></div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_default_cost_vat" value="1">
    <div class="action">
      <select class="select22" name="default_cost_vat" data-placeholder='<?php echo T_("Please choose detail id") ?>'>
        <option value=""><?php echo T_("Please choose assistant_id") ?></option>
        <?php show_assistant_list_html('default_cost_vat', true) ?>
      </select>
    </div>
  </form>
  <?php if(!a($savedValue, 'default_cost_vat')) {?>
    <footer class="txtRa">
      <?php htmlLinkAddNewDetail(2106, 'default_cost_vat'); ?>
    </footer>
  <?php } //endif ?>
</section>

<section class="f" data-option='default_cost_tax' id="set_default_cost_tax">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Default toll code in cost factors"); ?></h3>
      <div class="body"><p><?php echo T_("On default used from :code Accounting assistant code. if exists", ['code' => \dash\fit::text(21062)]) ?></p></div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_default_cost_tax" value="1">
    <div class="action">
      <select class="select22" name="default_cost_tax" data-placeholder='<?php echo T_("Please choose detail id") ?>'>
        <option value=""><?php echo T_("Please choose assistant_id") ?></option>
        <?php show_assistant_list_html('default_cost_tax', true) ?>
      </select>
    </div>
  </form>
  <?php if(!a($savedValue, 'default_cost_tax')) {?>
    <footer class="txtRa">
      <?php htmlLinkAddNewDetail(2106, 'default_cost_tax'); ?>
    </footer>
  <?php } //endif ?>
</section>


<section class="f" data-option='default_income_vat' id="set_default_income_vat">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Default vat code in income factor"); ?></h3>
      <div class="body"><p><?php echo T_("On default used from :code Accounting assistant code. if exists", ['code' => \dash\fit::text(52071)]) ?></p></div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_default_income_vat" value="1">
    <div class="action">
      <select class="select22" name="default_income_vat" data-placeholder='<?php echo T_("Please choose detail id") ?>'>
        <option value=""><?php echo T_("Please choose assistant_id") ?></option>
        <?php show_assistant_list_html('default_income_vat', true) ?>
      </select>
    </div>
  </form>
  <?php if(!a($savedValue, 'default_income_vat')) {?>
    <footer class="txtRa">
      <?php htmlLinkAddNewDetail(5207, 'default_income_vat'); ?>
    </footer>
  <?php } //endif ?>
</section>

<section class="f" data-option='default_income_tax' id="set_default_income_tax">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Default toll code in income factor"); ?></h3>
      <div class="body"><p><?php echo T_("On default used from :code Accounting assistant code. if exists", ['code' => \dash\fit::text(52072)]) ?></p></div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_default_income_tax" value="1">
    <div class="action">
      <select class="select22" name="default_income_tax" data-placeholder='<?php echo T_("Please choose detail id") ?>'>
        <option value=""><?php echo T_("Please choose assistant_id") ?></option>
        <?php show_assistant_list_html('default_income_tax', true) ?>
      </select>
    </div>
  </form>
  <?php if(!a($savedValue, 'default_income_tax')) {?>
    <footer class="txtRa">
      <?php htmlLinkAddNewDetail(5207, 'default_income_tax'); ?>
    </footer>
  <?php } //endif ?>
</section>



<section class="f" data-option='default_cost_payer' id="set_default_cost_payer">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Default payer in cost factors"); ?></h3>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_default_cost_payer" value="1">
    <div class="action">
      <select class="select22" name="default_cost_payer" data-placeholder='<?php echo T_("Please choose detail id") ?>'>
        <option value=""><?php echo T_("Please choose assistant_id") ?></option>
        <?php show_assistant_list_html('default_cost_payer', true) ?>
      </select>
    </div>
  </form>
  <?php if(!a($savedValue, 'default_cost_payer')) {?>
    <footer class="txtRa">
      <?php htmlLinkAddNewDetail(2605, 'default_cost_payer'); ?>
    </footer>
  <?php } //endif ?>
</section>



<section class="f" data-option='default_cost_bank' id="set_default_cost_bank">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Default bank in cost factors"); ?></h3>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_default_cost_bank" value="1">
    <div class="action">
      <select class="select22" name="default_cost_bank" data-placeholder='<?php echo T_("Please choose detail id") ?>'>
        <option value=""><?php echo T_("Please choose assistant_id") ?></option>
        <?php show_assistant_list_html('default_cost_bank', true) ?>
      </select>
    </div>
  </form>
  <?php if(!a($savedValue, 'default_cost_bank')) {?>
    <footer class="txtRa">
      <?php htmlLinkAddNewDetail(2601, 'default_cost_bank'); ?>
    </footer>
  <?php } //endif ?>
</section>





<section class="f" data-option='default_partner' id="set_default_partner">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Default partner"); ?></h3>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_default_partner" value="1">
    <div class="action">
      <select class="select22" name="default_partner" data-placeholder='<?php echo T_("Please choose detail id") ?>'>
        <option value=""><?php echo T_("Please choose assistant_id") ?></option>
        <?php show_assistant_list_html('default_partner', true) ?>
      </select>
    </div>
  </form>
  <?php if(!a($savedValue, 'default_partner')) {?>
    <footer class="txtRa">
      <?php htmlLinkAddNewDetail(5208, 'default_partner'); ?>
    </footer>
  <?php } //endif ?>
</section>





<?php

function htmlLinkAddNewDetail($_parent_code = null, $_default_type = null)
{
  // $list = \dash\data::detailsList();
  // if(!$list)
  {
    $get = [];
    $get['type'] = 'details';

    if($_default_type)
    {
      $get['from'] = $_default_type;
    }

    if($_parent_code)
    {
      $get_coding_id = \lib\db\tax_coding\get::by_code($_parent_code);
      if(isset($get_coding_id['id']))
      {
        $get['parent'] = $get_coding_id['id'];
      }
    }
    echo '<a class="link" target="_blank" href="'. \dash\url::this(). '/coding/add?'.\dash\request::build_query($get).'"><i class="sf-external-link"></i> '. T_("Add new accounting details").'</a>';
  }
}

function show_assistant_list_html($_index, $_details_mode = false)
{
  $savedValue = \dash\data::accountingSettingSaved();

  if($_details_mode)
  {
    $list = \dash\data::detailsList();
  }
  else
  {
    $list = \dash\data::assistantList();
  }


  $lastCat = null;
  $showCat = null;
  foreach ($list as $key => $value)
  {
    if($lastCat !== a($value, 'total_title'))
    {
      $showCat = true;
    }
    else
    {
      $showCat = false;
    }
    // set lastCat for next loop
    $lastCat = a($value, 'total_title');

    if($showCat && !$_details_mode)
    {
      echo '<optgroup label="';
      echo a($value, 'total_title');
      echo '">';
    }
    {
      echo '<option value="';
      echo a($value, 'id');
      echo '"';
      if(a($savedValue, $_index) === a($value, 'id'))
      {
        echo ' selected';
      }
      echo '>';
      if($_details_mode)
      {
        echo a($value, 'full_title');
      }
      else
      {
        echo a($value, 'code');
        echo ' - ';
        echo a($value, 'title');
      }
      echo '</option>';
    }
    if($showCat)
    {
      echo "</optgroup>";
    }
}

}
?>