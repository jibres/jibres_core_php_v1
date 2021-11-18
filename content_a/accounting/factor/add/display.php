<?php
$myType                 = \dash\data::myType();
$dataRow                = \dash\data::dataRow();

$docIsLock              = a($dataRow, 'tax_document', 'status') === 'lock';

$disableInput           = $docIsLock ? 'disabled' : null;

\dash\data::docIsLock($docIsLock);

$accountingSettingSaved = \lib\app\setting\get::accounting_setting();

$currency = null;
if(a($accountingSettingSaved, 'currency'))
{
  $currency = a($accountingSettingSaved, 'currency');
  $currency = \lib\currency::name($currency);
}

$default_cost_payer  = null;
$default_cost_bank   = null;
$default_partner     = null;
$default_bank_profit = null;

if(!\dash\data::editMode())
{
  $default_cost_bank   = a($accountingSettingSaved, 'default_cost_bank');
  $default_cost_payer  = a($accountingSettingSaved, 'default_cost_payer');
  $default_partner     = a($accountingSettingSaved, 'default_partner');
  $default_bank_profit = a($accountingSettingSaved, 'default_bank_profit');
}

$myTotal         = round(a($dataRow, 'tax_document', 'total'));
if(!$myTotal && \dash\request::get('total'))
{
  $myTotal = \dash\request::get('total');
}

$myTotalDiscount = round(a($dataRow, 'tax_document', 'totaldiscount'));
if(!$myTotalDiscount && \dash\request::get('totaldiscount'))
{
  $myTotalDiscount = \dash\request::get('totaldiscount');
}

$myTotalVat      = round(a($dataRow, 'tax_document', 'totalvat'));
if(!$myTotalVat && \dash\request::get('totalvat'))
{
  $myTotalVat = \dash\request::get('totalvat');
}

?>
<form method="post" autocomplete="off"  enctype="multipart/form-data" id="form2" class="hide">
  <input type="hidden" name="newlockstatus" value='temp'>
</form>

<form method="post" autocomplete="off"  enctype="multipart/form-data" id="form1">
  <div class="row align-center justify-center">
    <div class="c-xs-12 c-sm-12">
      <div class="box">
        <div class="pad">
          <div class="row">
            <div class="c-xs-6 c-sm-2 c-xxl-1 c-xl-1">
              <?php if(\dash\data::accountingYear()) {?>
                <label for="parent"><?php echo T_("Accounting year") ?></label>
                <select class="select22" name="year_id" <?php echo $disableInput; ?>>
                  <option value=""><?php echo T_("Please choose year") ?></option>
                  <?php foreach (\dash\data::accountingYear() as $key => $value) {?>
                    <option value="<?php echo a($value, 'id') ?>" <?php if((!a($dataRow, 'tax_document', 'year_id') && a($value, 'isdefault')) || (a($value, 'id') === a($dataRow, 'tax_document', 'year_id'))) { echo 'selected';} ?>><?php echo a($value, 'title'); ?></option>
                  <?php } // endfor ?>
                </select>
              <?php } // endif ?>
            </div>
            <div class="c-xs-6 c-sm-2 c-xxl-1">
              <label for="factordate" ><?php echo T_("Date"); ?> <b><?php echo T_("yyyy/mm/dd"); ?></b></label>
              <div class="input">
                <input class="ltr" type="text" placeholder="yyyy/mm/dd" data-format="date" name="factordate" value="<?php if(a($dataRow, 'tax_document', 'date')) { echo \dash\utility\convert::to_en_number(\dash\fit::date(a($dataRow, 'tax_document', 'date'))); }elseif(\dash\request::get('date') && \dash\validate::date(\dash\request::get('date'), false)) {echo \dash\request::get('date');} ?>" id="factordate" value="<?php echo \dash\request::get('date'); ?>" <?php \dash\layout\autofocus::html(); ?> autocomplete='off' <?php echo $disableInput ?>>
              </div>
            </div>
            <?php if(in_array($myType, ['cost', 'income', 'asset', ])) {?>


              <div class="c-xs-6 c-sm-2 c-xxl-1">
                <label for="serialnumber"><?php echo T_("Factor serial number"); ?></label>
                <div class="input ltr">
                  <input type="text" name="serialnumber" value="<?php echo a($dataRow, 'tax_document', 'serialnumber');  ?>" id="serialnumber" maxlength="100"  <?php echo $disableInput ?>>
                </div>
              </div>
              <div class="c-xs-6 c-sm-3 c-xl-2 c-xxl-2">
                <label for="producttitle"><?php echo T_("Product title"); ?></label>
                <div class="input">
                  <input type="text" name="producttitle" value="<?php echo a($dataRow, 'tax_document', 'producttitle'); ?>" id="producttitle" maxlength="100"  <?php echo $disableInput ?>>
                </div>
              </div>

            <?php } //endif ?>
              <div class="c-xs-6 c-sm">
                <label for="title"><?php echo T_("Description"); ?></label>
                <div class="input">
                  <input type="text" name="title" value="<?php echo a($dataRow, 'tax_document', 'desc'); ?>" id="title" maxlength="100" placeholder='<?php echo T_('Leave it null to fill by default') ?>' <?php echo $disableInput ?>>
                </div>
              </div>
          </div>
          <?php if(!\dash\data::detailsList()) {?>
            <div class="alert-warning">
              <?php echo T_("You need to add some accounting details to add quick factor") ?>
              <a target="_blank" class="link fs08" href="<?php echo \dash\url::this(). '/coding/add?type=details' ?>"><i class="sf-external-link"></i> <?php echo T_("Add new accounting details") ?></a>
            </div>
          <?php } //endif ?>
          <?php if(\dash\data::detailsList()) {?>
            <?php if(in_array($myType, ['cost', 'income', 'asset', ])) {?>
              <div class="">
                <div class="row">
                  <div class="c-auto">
                    <label for="put_on"><?php if($myType === 'cost') {echo T_("Cost type"); }elseif($myType === 'asset'){echo T_("Asset type");}else{echo T_("Income from");} ?> <?php htmlTurnoverLink('put_on') ?></label>
                  </div>
                  <div class="c">
                    <?php if(in_array($myType, ['cost', 'asset',]) && !$docIsLock && \dash\data::editMode()) {?>
                      <?php if(a($dataRow, 'tax_document', 'template') === 'cost') {?>
                        <div class="link fs08 mT5" data-confirm data-data='{"changetemplate": "asset"}'><?php echo T_("Convert to asset factor"); ?></div>
                      <?php }else{ ?>
                        <div class="link fs08 mT5" data-confirm data-data='{"changetemplate": "cost"}'><?php echo T_("Convert to cost factor"); ?></div>
                      <?php } //endif ?>
                    <?php } //endif ?>

                  </div>
                  <div class="c-auto"><a target="_blank" class="link fs08" href="<?php echo \dash\url::this(). '/coding/add?type=details' ?>"><i class="sf-external-link"></i> <?php echo T_("Add new accounting details") ?></a></div>
                </div>

                <select class="select22" name="put_on" <?php echo $disableInput; ?> data-placeholder='<?php echo T_("Cost type") ?>'>
                  <option value="0"><?php echo T_("None") ?></option>
                    <?php htmlDetailsSelectList('put_on'); ?>
                </select>
              </div>
              <div class="mT10">
                <label for="thirdparty"><?php if($myType === 'income'){echo T_("Buyer");}else{ echo T_("Seller"); } ?> <small><?php if($myType === 'income'){/*some message if have not buy from*/}else{ echo T_("If the seller is not selected, a direct payment document will be made"); }  ?></small> <?php htmlTurnoverLink('thirdparty') ?></label>
                <select class="select22" name="thirdparty" <?php echo $disableInput; ?> data-placeholder='<?php echo T_("Thirdparty") ?>'>
                  <option value="0"><?php echo T_("None") ?></option>
                  <?php htmlDetailsSelectList('thirdparty'); ?>
                </select>
              </div>
              <div class="mT10">
                <label for="pay_from"><?php if($myType === 'income'){echo T_("Recipient of money");}else{ echo T_("Payer"); } ?> <small><?php if($myType === 'income'){/*some message if have not buy from*/}else{  echo T_("In case of non-payment, the credit document will be registered"); }  ?></small> <?php htmlTurnoverLink('pay_from') ?></label>
                <select class="select22" name="pay_from" <?php echo $disableInput; ?> data-placeholder='<?php echo T_("Payer") ?>'>
                  <option value="0"><?php echo T_("None") ?></option>
                    <?php htmlDetailsSelectList('pay_from', $default_cost_payer); ?>
                </select>
              </div>
            <?php } //endif ?>
            <?php if(in_array($myType, ['petty_cash', 'partner'])) {?>
              <div class="mT10">
                <label for="petty_cash"><?php echo T_("Petty cash") ?> <?php htmlTurnoverLink('petty_cash') ?></label>
                <select class="select22" name="petty_cash" <?php echo $disableInput; ?> data-placeholder='<?php echo T_("Petty cash") ?>'>
                  <option value="0"><?php echo T_("None") ?></option>
                  <?php htmlDetailsSelectList('petty_cash', $default_cost_payer); ?>
                </select>
              </div>
            <?php } // endif ?>

            <?php if(in_array($myType, ['petty_cash', 'bank_partner', 'bank_profit'])) {?>
              <div class="mT10">
                 <div class="row">
                  <div class="c-auto">
                    <label for="bank"><?php echo T_("Bank") ?> <?php htmlTurnoverLink('bank') ?></label>
                  </div>
                  <div class="c"></div>
                  <div class="c-auto"><a target="_blank" class="link fs08" href="<?php echo \dash\url::this(). '/coding/add?type=details' ?>"><i class="sf-external-link"></i> <?php echo T_("Add new accounting details") ?></a></div>
                </div>
                <select class="select22" name="bank" <?php echo $disableInput; ?> data-placeholder='<?php echo T_("Bank") ?>'>
                  <option value="0"><?php echo T_("None") ?></option>
                  <?php htmlDetailsSelectList('bank', $default_cost_bank); ?>
                </select>
              </div>

            <?php } // endif ?>

            <?php if(in_array($myType, ['bank_profit'])) {?>
              <div class="mT10">
                 <div class="row">
                  <div class="c-auto">
                    <label for="bank_profit"><?php echo T_("Bank profit") ?> <?php htmlTurnoverLink('profit') ?></label>
                  </div>
                  <div class="c"></div>
                  <div class="c-auto"><a target="_blank" class="link fs08" href="<?php echo \dash\url::this(). '/coding/add?type=details' ?>"><i class="sf-external-link"></i> <?php echo T_("Add new accounting details") ?></a></div>
                </div>
                <select class="select22" name="bank_profit" <?php echo $disableInput; ?> data-placeholder='<?php echo T_("Bank profit") ?>'>
                  <option value="0"><?php echo T_("None") ?></option>
                  <?php htmlDetailsSelectList('bank_profit', $default_bank_profit); ?>
                </select>
              </div>

            <?php } // endif ?>


            <?php if(in_array($myType, ['partner', 'bank_partner'])) {?>
              <div class="mT10">
                 <div class="row">
                  <div class="c-auto">
                    <label for="partner"><?php echo T_("Accounting Partner") ?> <?php htmlTurnoverLink('partner') ?></label>
                  </div>
                  <div class="c"></div>
                  <div class="c-auto"><a target="_blank" class="link fs08" href="<?php echo \dash\url::this(). '/coding/add?type=details' ?>"><i class="sf-external-link"></i> <?php echo T_("Add new accounting details") ?></a></div>
                </div>
                <select class="select22" name="partner" <?php echo $disableInput; ?> data-placeholder='<?php echo T_("Accounting Partner") ?>'>
                  <option value="0"><?php echo T_("None") ?></option>
                  <?php htmlDetailsSelectList('partner', $default_partner); ?>
                </select>
              </div>

            <?php } // endif ?>
          <?php } // endif ?>
          <div class="mT10"></div>

          <div class="row">
            <div class="c">

            <?php if(in_array($myType, ['cost', 'income', 'asset', ])) {?>

          <div class="row">
            <div class="c-md-4">
              <label for="total"><?php echo T_("Total payment before deducting discount"); ?></label>
              <div class="input ltr">
                <?php if($currency) {?><label class="btn addon" for="total"><?php echo $currency ?></label><?php } //endif ?>
                <input type="tel" name="total" id="input-total" value="<?php echo $myTotal; ?>" id="total" maxlength="20" data-format='price' <?php echo $disableInput ?>>
              </div>
            </div>
            <div class="c-md-4">
              <label for="totaldiscount"><?php echo T_("Total discount"); ?></label>
              <div class="input ltr">
                <?php if($currency) {?><label class="btn addon" for="totaldiscount"><?php echo $currency ?></label><?php } //endif ?>
                <input type="tel" name="totaldiscount" id="input-totaldiscount" value="<?php echo $myTotalDiscount;  ?>" id="totaldiscount" maxlength="20" data-format='price' <?php echo $disableInput ?>>
              </div>
            </div>
            <div class="c-md-4">
              <label for="totalvat"><?php echo T_("Total vat/tax"); ?> <?php if(!$docIsLock) {?><small id="factor-auto-calculate-vat" class="link cursor-pointer"><?php echo T_("Auto Calculate") ?></small><?php } ?></label>
              <div class="input ltr">
                <?php if($currency) {?><label class="btn addon" for="totalvat"><?php echo $currency ?></label><?php } //endif ?>
                <input type="tel" name="totalvat" id="input-totalvat" value="<?php echo $myTotalVat;  ?>" id="totalvat" maxlength="20" data-format='price' <?php echo $disableInput ?>>
              </div>
            </div>
          </div>
        <?php } //endif ?>
            <?php if(in_array($myType, ['petty_cash', 'partner', 'bank_partner', 'bank_profit'])) {?>
              <label for="total"><?php echo T_("Total"); ?></label>
              <div class="input ltr">
                <?php if($currency) {?><label class="btn addon" for="total"><?php echo $currency ?></label><?php } //endif ?>
                <input type="tel" name="total" value="<?php echo $myTotal;  ?>" id="total" maxlength="20" data-format='price' <?php echo $disableInput ?>>
              </div>
        <?php } //endif ?>
            </div>
            <?php if(in_array($myType, ['cost', 'income', 'asset', ])) {?>
            <div class="cauto">
        <div class="switch1 mT25 <?php if($docIsLock) { echo 'disabled'; } ?>">
          <input type="checkbox" name="quarterlyreport" id="quarterlyreport" <?php echo $disableInput;  if(a($dataRow, 'tax_document', 'quarterlyreport') === 'yes' || !a($dataRow, 'tax_document', 'quarterlyreport')) {echo ' checked';} ?>>
          <label for="quarterlyreport"><?php echo T_("Calculate in quarterly report") ?></label>
          <label for="quarterlyreport"><?php echo T_("Calculate in quarterly report") ?></label>
        </div>
            </div>
            <?php }else{ ?>
              <input type="hidden" name="quarterlyreport" value="0">
            <?php } //endif ?>
          </div>


        </div>
      </div>

      <?php
      \dash\data::dataRow_gallery_array(a($dataRow, 'tax_document', 'gallery_array'));
      $gallery = \dash\data::dataRow_gallery_array();

      if(!is_array($gallery))
      {
        $gallery = [];
      }

      $gallery_capacity    = 10;
      $gallery_is_not_free = false;
      $add_html_form       = false;
      $is_auto_send        = \dash\data::editMode() ? true : false;
      $no_footer           = true;
      $gallery_array       = a($dataRow, 'tax_document', 'gallery_array');
      if($docIsLock)
      {
        $gallery_lockMode    = true;
      }

      echo '<input type="hidden" name="uploaddoc" value="uploaddoc">';
      require_once(root. 'dash/layout/post/admin-gallery-box.php');

      ?>


      <?php if(\dash\data::editMode() && $docIsLock) {?>
        <div class="tblBox">
          <table class="tbl1 v11 text-center">
            <thead>
              <tr>
                <th><?php echo T_("Subtotal"); ?></th>
                <th><?php echo T_("Total Discount"); ?></th>
                <th><?php echo T_("Total After Discount"); ?></th>
                <th><?php echo T_("Total Vat"); ?></th>
                <th><?php echo T_("Net Amount"); ?></th>
            </thead>
            <tbody>
              <tr>
                <?php
                $total                = floatval(a($dataRow, 'tax_document', 'total'));
                $totaldiscount        = floatval(a($dataRow, 'tax_document', 'totaldiscount'));
                $totalvat             = floatval(a($dataRow, 'tax_document', 'totalvat'));
                $total_after_discount = $total - $totaldiscount;
                $final = $total_after_discount + $totalvat;
                ?>
                <td data-copy='<?php echo $total; ?>' class="text-sm ltr fc-black"><code><?php echo \dash\fit::number($total, true, 'en') ?></code></td>
                <td data-copy='<?php echo $totaldiscount; ?>' class="text-sm ltr fc-black"><code><?php echo \dash\fit::number($totaldiscount, true, 'en') ?></code></td>
                <td data-copy='<?php echo $total_after_discount; ?>' class="text-sm ltr fc-black"><code><?php echo \dash\fit::number($total_after_discount, true, 'en') ?></code></td>
                <td data-copy='<?php echo $totalvat; ?>' class="text-sm ltr fc-red"><code><?php echo \dash\fit::number($totalvat, true, 'en') ?></code></td>
                <td data-copy='<?php echo $final; ?>' class="text-sm ltr font-bold fc-green"><code><?php echo \dash\fit::number($final, true, 'en') ?></code></td>
              </tr>
            </tbody>
          </table>
        </div>
        <?php if(a($dataRow, 'tax_document', 'totalincludevat') || a($dataRow, 'tax_document', 'totalnotincludevat')) {?>
          <div class="row">
            <div class="c-xs-12 c-sm-6">
              <nav class="items">
                <ul>
                  <li>
                    <a class="item f">
                      <div class="key"><?php echo T_("Total taxable amount") ?></div>
                      <div class="value" data-copy='<?php echo a($dataRow, 'tax_document', 'totalincludevat'); ?>' class="text-sm ltr font-bold fc-green"><code><?php echo \dash\fit::number(a($dataRow, 'tax_document', 'totalincludevat'), true, 'en') ?></code></div>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
            <div class="c-xs-12 c-sm-6">
              <nav class="items">
                <ul>
                  <li>
                    <a class="item f">
                      <div class="key"><?php echo T_("Total amount exempt from tax") ?></div>
                      <div class="value" data-copy='<?php echo a($dataRow, 'tax_document', 'totalnotincludevat'); ?>' class="text-sm ltr font-bold fc-green"><code><?php echo \dash\fit::number(a($dataRow, 'tax_document', 'totalnotincludevat'), true, 'en') ?></code></div>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
          <?php } //endif ?>
        <?php } //endif ?>
    </div>
  </div>
</form>


<?php
function htmlTurnoverLink($_type)
{
  $docIsLock = \dash\data::docIsLock();
  $dataRow = \dash\data::dataRow();

  if($docIsLock && a($dataRow, 'fill_value', $_type, 'details_id'))
  {
    echo '<a class="link" target="_blank" href="'. \dash\url::this(). '/turnover?contain='. a($dataRow, 'fill_value', $_type, 'details_id'). '"><i class="sf-external-link"></i> '. T_("Turnover"). '</a>';
  }
}


function htmlDetailsSelectList($_type, $_default_selected = null)
{
  $dataRow = \dash\data::dataRow();
  $myType = \dash\data::myType();

  foreach (\dash\data::detailsList() as $key => $value)
  {
    if($_type === 'put_on')
    {
      if($myType === 'asset')
      {
        if(in_array(substr(a($value, 'code'), 0, 1), ['1']) || in_array(substr(a($value, 'code'), 0, 2), ['22', '27']))
        {
          /*ok*/
        }
        else
        {
          continue;
        }
      }
      elseif($myType === 'cost')
      {
        if(in_array(substr(a($value, 'code'), 0, 1), ['7']))
        {
          /*ok*/
        }
        else
        {
          continue;
        }
      }
      elseif($myType === 'income')
      {
        if(in_array(substr(a($value, 'code'), 0, 1), ['6']))
        {
          /*ok*/
        }
        else
        {
          continue;
        }
      }
    }
    elseif($_type === 'pay_from')
    {
      if($myType === 'income')
      {
        if(in_array(substr(a($value, 'code'), 0, 2), ['26', '52']))
        {
          /*ok*/
        }
        else
        {
          continue;
        }
      }
      else
      {
        if(in_array(substr(a($value, 'code'), 0, 2), ['26']) || in_array(substr(a($value, 'code'), 0, 4), ['5208']))
        {
          /*ok*/
        }
        else
        {
          continue;
        }
      }

    }
    elseif($_type === 'petty_cash')
    {
      if(in_array(substr(a($value, 'code'), 0, 4), ['2605']))
      {
        /*ok*/
      }
      else
      {
        continue;
      }
    }
    elseif($_type === 'thirdparty')
    {
      if($myType === 'income')
      {
        if(in_array(substr(a($value, 'code'), 0, 2), ['23']))
        {
          /*ok*/
        }
        else
        {
        continue;
        }
      }
      else
      {
        if(in_array(substr(a($value, 'code'), 0, 1), ['5']))
        {
          /*ok*/
        }
        else
        {
          continue;
        }
      }
    }
    elseif($_type === 'bank')
    {
      if(in_array(substr(a($value, 'code'), 0, 2), ['26']))
      {
        if(substr(a($value, 'code'), 0, 4) === '2605')
        {
          continue;
        }
        /*ok*/
      }
      else
      {
        continue;
      }
    }
    elseif($_type === 'partner')
    {
      if(in_array(substr(a($value, 'code'), 0, 4), ['5208']))
      {
        /*ok*/
      }
      else
      {
        continue;
      }
    }
    elseif($_type === 'bank_profit')
    {
      if(in_array(substr(a($value, 'code'), 0, 4), ['7704']))
      {
        /*ok*/
      }
      else
      {
        continue;
      }
    }

    echo '<option value="'. a($value, 'id'). '" ';
    if(a($dataRow, 'fill_value', $_type, 'details_id') === a($value, 'id') || \dash\request::get($_type) === a($value, 'id') || $_default_selected === a($value, 'id'))
    {
      echo 'selected';
    }
    echo '> '. a($value, 'full_title'). '</option>';
  }

}

?>
