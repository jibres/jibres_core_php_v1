<?php
$myType                 = \dash\data::myType();
$dataRow                = \dash\data::dataRow();

$docIsLock              = a($dataRow, 'tax_document', 'status') === 'lock';

$disableInput           = $docIsLock ? 'disabled' : null;

$accountingSettingSaved = \lib\app\setting\get::accounting_setting();

$currency = null;
if(a($accountingSettingSaved, 'currency'))
{
  $currency = a($accountingSettingSaved, 'currency');
  $currency = \lib\currency::name($currency);
}

$default_cost_payer = a($accountingSettingSaved, 'default_cost_payer');
$default_cost_bank  = a($accountingSettingSaved, 'default_cost_bank');
$default_partner  = a($accountingSettingSaved, 'default_partner');



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
            <div class="c-xs-12 c-sm-4">
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
            <div class="c-xs-12 c-sm">
              <label for="factordate" ><?php echo T_("Date"); ?> <b><?php echo T_("yyyy/mm/dd"); ?></b></label>
              <div class="input">
                <input class="ltr" type="text" placeholder="yyyy/mm/dd" data-format="date" name="factordate" value="<?php echo \dash\utility\convert::to_en_number(\dash\fit::date(a($dataRow, 'tax_document', 'date'))); ?>" id="factordate" value="<?php echo \dash\request::get('date'); ?>" autocomplete='off' <?php echo $disableInput ?>>
              </div>
            </div>
            <?php if(in_array($myType, ['cost', 'income'])) {?>
              <div class="c-xs-12 c-sm">
                <label for="serialnumber"><?php echo T_("Factor serial number"); ?></label>
                <div class="input ltr">
                  <input type="text" name="serialnumber" value="<?php echo a($dataRow, 'tax_document', 'serialnumber');  ?>" id="serialnumber" maxlength="100"  <?php echo $disableInput ?>>
                </div>
              </div>
            <?php } //endif ?>
          </div>
          <?php if(\dash\data::detailsList()) {?>
            <?php if(in_array($myType, ['cost', 'income', 'asset', 'bill'])) {?>
              <div class="">
                <label for="put_on"><?php if($myType === 'cost') {echo T_("Cost type"); }elseif($myType === 'asset'){echo T_("Asset type");}else{echo T_("Income type");} ?> <small class="fc-red"><?php echo T_("Required") ?></small></label>
                <select class="select22" name="put_on" <?php echo $disableInput; ?> data-placeholder='<?php echo T_("Cost type") ?>'>
                  <option value="0"><?php echo T_("None") ?></option>
                  <?php foreach (\dash\data::detailsList() as $key => $value) { if(in_array(substr(a($value, 'code'), 0, 1), ['1', '7'])) {if($myType === 'cost' && substr(a($value, 'code'), 0, 1) === '1'){continue;}elseif($myType === 'asset' && substr(a($value, 'code'), 0, 1) === '7'){continue;}}else{continue;} ?>
                    <option value="<?php echo a($value, 'id') ?>" <?php if(a($dataRow, 'fill_value', 'put_on', 'details_id') === a($value, 'id') || \dash\request::get('put_on') === a($value, 'id')) { echo 'selected'; } ?>><?php echo a($value, 'full_title'); ?></option>
                  <?php } // endfor ?>
                </select>
              </div>
              <div class="mT10">
                <label for="thirdparty"><?php echo T_("Seller") ?> <small><?php echo T_("If the seller is not selected, a direct payment document will be made") ?></small></label>
                <select class="select22" name="thirdparty" <?php echo $disableInput; ?> data-placeholder='<?php echo T_("Thirdparty") ?>'>
                  <option value="0"><?php echo T_("None") ?></option>
                  <?php foreach (\dash\data::detailsList() as $key => $value) { if(in_array(substr(a($value, 'code'), 0, 1), ['5'])) {/*ok*/}else{continue;}?>
                    <option value="<?php echo a($value, 'id') ?>" <?php if(a($dataRow, 'fill_value', 'thirdparty', 'details_id') === a($value, 'id') || \dash\request::get('thirdparty') === a($value, 'id')) { echo 'selected'; } ?>><?php echo a($value, 'full_title'); ?></option>
                  <?php } // endfor ?>
                </select>
              </div>
              <div class="mT10">
                <label for="pay_from"><?php echo T_("Payer") ?> <small><?php echo T_("In case of non-payment, the credit document will be registered") ?></small></label>
                <select class="select22" name="pay_from" <?php echo $disableInput; ?> data-placeholder='<?php echo T_("Payer") ?>'>
                  <option value="0"><?php echo T_("None") ?></option>
                  <?php foreach (\dash\data::detailsList() as $key => $value) { if(in_array(substr(a($value, 'code'), 0, 2), ['26'])) {/*ok*/}else{continue;}?>
                    <option value="<?php echo a($value, 'id') ?>" <?php if(a($dataRow, 'fill_value', 'pay_from', 'details_id') === a($value, 'id') || \dash\request::get('pay_from') === a($value, 'id') || $default_cost_payer === a($value, 'id')) { echo 'selected'; } ?>><?php echo a($value, 'full_title'); ?></option>
                  <?php } // endfor ?>
                </select>
              </div>
            <?php } //endif ?>
            <?php if(in_array($myType, ['petty_cash', 'partner'])) {?>
              <div class="mT10">
                <label for="petty_cash"><?php echo T_("Petty cash") ?></label>
                <select class="select22" name="petty_cash" <?php echo $disableInput; ?> data-placeholder='<?php echo T_("Petty cash") ?>'>
                  <option value="0"><?php echo T_("None") ?></option>
                  <?php foreach (\dash\data::detailsList() as $key => $value) { if(in_array(substr(a($value, 'code'), 0, 4), ['2605'])) {/*ok*/}else{continue;}?>
                    <option value="<?php echo a($value, 'id') ?>" <?php if(a($dataRow, 'fill_value', 'pay_from', 'details_id') === a($value, 'id') || \dash\request::get('pay_from') === a($value, 'id') || $default_cost_payer === a($value, 'id')) { echo 'selected'; } ?>><?php echo a($value, 'full_title'); ?></option>
                  <?php } // endfor ?>
                </select>
              </div>
            <?php } // endif ?>

            <?php if(in_array($myType, ['petty_cash'])) {?>
              <div class="mT10">
                <label for="bank"><?php echo T_("Bank") ?></label>
                <select class="select22" name="bank" <?php echo $disableInput; ?> data-placeholder='<?php echo T_("Bank") ?>'>
                  <option value="0"><?php echo T_("None") ?></option>
                  <?php foreach (\dash\data::detailsList() as $key => $value) {if(in_array(substr(a($value, 'code'), 0, 2), ['26'])) { if(substr(a($value, 'code'), 0, 4) === '2605'){continue;}/*ok*/}else{continue;}?>
                    <option value="<?php echo a($value, 'id') ?>" <?php if(a($dataRow, 'fill_value', 'bank', 'details_id') === a($value, 'id') || \dash\request::get('bank') === a($value, 'id') || $default_cost_bank === a($value, 'id')) { echo 'selected'; } ?>><?php echo a($value, 'full_title'); ?></option>
                  <?php } // endfor ?>
                </select>
              </div>

            <?php } // endif ?>


            <?php if(in_array($myType, ['partner'])) {?>
              <div class="mT10">
                <label for="partner"><?php echo T_("Accounting Partner") ?></label>
                <select class="select22" name="partner" <?php echo $disableInput; ?> data-placeholder='<?php echo T_("Accounting Partner") ?>'>
                  <option value="0"><?php echo T_("None") ?></option>
                  <?php foreach (\dash\data::detailsList() as $key => $value) { if(in_array(substr(a($value, 'code'), 0, 4), ['5208'])) {/*ok*/}else{continue;}?>
                    <option value="<?php echo a($value, 'id') ?>" <?php if(a($dataRow, 'fill_value', 'partner', 'details_id') === a($value, 'id') || \dash\request::get('partner') === a($value, 'id') || $default_partner === a($value, 'id')) { echo 'selected'; } ?>><?php echo a($value, 'full_title'); ?></option>
                  <?php } // endfor ?>
                </select>
              </div>

            <?php } // endif ?>
          <?php } // endif ?>
          <div class="mT10"></div>
          <div class="hide">
            <label for="title"><?php echo T_("Description"); ?></label>
            <div class="input">
              <input type="text" name="title" value="<?php echo a($dataRow, 'tax_document', 'desc'); ?>" id="title" maxlength="100" placeholder='<?php echo T_('Leave it null to fill by default') ?>'>
            </div>
          </div>
            <?php if(in_array($myType, ['cost', 'income', 'asset', 'bill'])) {?>

          <div class="row">
            <div class="c-md-4">
              <label for="total"><?php echo T_("Total payment before deducting discount"); ?></label>
              <div class="input ltr">
                <?php if($currency) {?><label class="btn addon" for="total"><?php echo $currency ?></label><?php } //endif ?>
                <input type="tel" name="total" value="<?php echo round(a($dataRow, 'tax_document', 'total')); ?>" id="total" max="9999999" data-format='price' <?php echo $disableInput ?>>
              </div>
            </div>
            <div class="c-md-4">
              <label for="totaldiscount"><?php echo T_("Total discount"); ?></label>
              <div class="input ltr">
                <?php if($currency) {?><label class="btn addon" for="totaldiscount"><?php echo $currency ?></label><?php } //endif ?>
                <input type="tel" name="totaldiscount" value="<?php echo round(a($dataRow, 'tax_document', 'totaldiscount'));  ?>" id="totaldiscount" max="9999999" data-format='price' <?php echo $disableInput ?>>
              </div>
            </div>
            <div class="c-md-4">
              <label for="totalvat"><?php echo T_("Total vat/tax"); ?> <?php if(!$docIsLock) {?><small class="link"><?php echo T_("Auto Calculate") ?></small><?php } ?></label>
              <div class="input ltr">
                <?php if($currency) {?><label class="btn addon" for="totalvat"><?php echo $currency ?></label><?php } //endif ?>
                <input type="tel" name="totalvat" value="<?php echo round(a($dataRow, 'tax_document', 'totalvat'));  ?>" id="totalvat" max="9999999" data-format='price' <?php echo $disableInput ?>>
              </div>
            </div>
          </div>
        <?php } //endif ?>
            <?php if(in_array($myType, ['petty_cash', 'partner'])) {?>
              <label for="total"><?php echo T_("Total"); ?></label>
              <div class="input ltr">
                <?php if($currency) {?><label class="btn addon" for="total"><?php echo $currency ?></label><?php } //endif ?>
                <input type="tel" name="total" value="<?php echo round(a($dataRow, 'tax_document', 'total'));  ?>" id="total" max="9999999" data-format='price' <?php echo $disableInput ?>>
              </div>
        <?php } //endif ?>

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
      $gallery_is_not_free = true;
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
          <table class="tbl1 v11 txtC">
            <thead>
              <tr>
                <th><?php echo T_("Subtotal"); ?></th>
                <th><?php echo T_("Total Discount"); ?></th>
                <th><?php echo T_("Total After Discount"); ?></th>
                <th><?php echo T_("Total Vat"); ?></th>
                <th><?php echo T_("Net Amount"); ?></th>
              </tr>
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
                <td data-copy='<?php echo $total; ?>' class="font-12 ltr fc-black"><code><?php echo \dash\fit::number($total, true, 'en') ?></code></td>
                <td data-copy='<?php echo $totaldiscount; ?>' class="font-12 ltr fc-black"><code><?php echo \dash\fit::number($totaldiscount, true, 'en') ?></code></td>
                <td data-copy='<?php echo $total_after_discount; ?>' class="font-12 ltr fc-black"><code><?php echo \dash\fit::number($total_after_discount, true, 'en') ?></code></td>
                <td data-copy='<?php echo $totalvat; ?>' class="font-12 ltr fc-red"><code><?php echo \dash\fit::number($totalvat, true, 'en') ?></code></td>
                <td data-copy='<?php echo $final; ?>' class="font-12 ltr txtB fc-green"><code><?php echo \dash\fit::number($final, true, 'en') ?></code></td>
              </tr>
            </tbody>
          </table>
        </div>

      <?php } //endif ?>

    </div>
  </div>
</form>