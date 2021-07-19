<?php
$dataRow                = \dash\data::dataRow();

$docIsLock              = a($dataRow, 'tax_document', 'status') === 'lock';

$disableInput           = $docIsLock ? 'disabled' : null;

$accountingSettingSaved = \lib\app\setting\get::accounting_setting();

$default_cost_payer     = a($accountingSettingSaved, 'default_cost_payer');

?>
<form method="post" autocomplete="off"  enctype="multipart/form-data" id="form1">
  <div class="row">
    <div class="c-xs-12 c-sm-12 c-md-9">
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
            <div class="c-xs-12 c-sm-4">
              <label for="factordate" ><?php echo T_("Factor date"); ?> <b><?php echo T_("yyyy/mm/dd"); ?></b></label>
              <div class="input">
                <input class="ltr" type="text" placeholder="yyyy/mm/dd" data-format="date" name="factordate" value="<?php echo \dash\utility\convert::to_en_number(\dash\fit::date(a($dataRow, 'tax_document', 'date'))); ?>" id="factordate" value="<?php echo \dash\request::get('date'); ?>" autocomplete='off' <?php echo $disableInput ?>>
              </div>
            </div>
            <div class="c-xs-12 c-sm-4">
              <label for="serialnumber"><?php echo T_("Factor serial number"); ?></label>
              <div class="input ltr">
                <input type="text" name="serialnumber" value="<?php echo a($dataRow, 'tax_document', 'serialnumber');  ?>" id="serialnumber" maxlength="100"  <?php echo $disableInput ?>>
              </div>
            </div>
          </div>
          <?php if(\dash\data::detailsList()) {?>
            <div class="">
              <label for="put_on"><?php echo T_("Cost type") ?> <small class="fc-red"><?php echo T_("Required") ?></small></label>
              <select class="select22" name="put_on" <?php echo $disableInput; ?>>
                <option value=""><?php echo T_("Cost type") ?></option>
                <?php foreach (\dash\data::detailsList() as $key => $value) {?>
                  <option value="<?php echo a($value, 'id') ?>" <?php if(a($dataRow, 'fill_value', 'put_on', 'details_id') === a($value, 'id') || \dash\request::get('put_on') === a($value, 'id')) { echo 'selected'; } ?>><?php echo a($value, 'full_title'); ?></option>
                <?php } // endfor ?>
              </select>
            </div>
            <div class="mT10">
              <label for="thirdparty"><?php echo T_("Thirdparty") ?></label>
              <select class="select22" name="thirdparty" <?php echo $disableInput; ?>>
                <option value=""><?php echo T_("Thirdparty") ?></option>
                <?php foreach (\dash\data::detailsList() as $key => $value) {?>
                  <option value="<?php echo a($value, 'id') ?>" <?php if(a($dataRow, 'fill_value', 'thirdparty', 'details_id') === a($value, 'id') || \dash\request::get('thirdparty') === a($value, 'id')) { echo 'selected'; } ?>><?php echo a($value, 'full_title'); ?></option>
                <?php } // endfor ?>
              </select>
            </div>
            <div class="mT10">
              <label for="pay_from"><?php echo T_("Payer") ?></label>
              <select class="select22" name="pay_from" <?php echo $disableInput; ?>>
                <option value=""><?php echo T_("Payer") ?></option>
                <?php foreach (\dash\data::detailsList() as $key => $value) {?>
                  <option value="<?php echo a($value, 'id') ?>" <?php if(a($dataRow, 'fill_value', 'pay_from', 'details_id') === a($value, 'id') || \dash\request::get('pay_from') === a($value, 'id') || $default_cost_payer === a($value, 'id')) { echo 'selected'; } ?>><?php echo a($value, 'full_title'); ?></option>
                <?php } // endfor ?>
              </select>
            </div>
          <?php } // endif ?>
          <div class="mT20"></div>
          <div class="hide">
            <label for="title"><?php echo T_("Description"); ?></label>
            <div class="input">
              <input type="text" name="title" value="<?php echo a($dataRow, 'tax_document', 'desc'); ?>" id="title" maxlength="100" placeholder='<?php echo T_('Leave it null to fill by default') ?>'>
            </div>
          </div>
          <div class="row">
            <div class="c-md-4">
              <label for="total"><?php echo T_("Total payment before deducting discount"); ?></label>
              <div class="input ltr">
                <input type="tel" name="total" value="<?php echo round(a($dataRow, 'tax_document', 'total')); ?>" id="total" max="9999999" data-format='price' <?php echo $disableInput ?>>
              </div>
            </div>
            <div class="c-md-4">
              <label for="totaldiscount"><?php echo T_("Total discount"); ?></label>
              <div class="input ltr">
                <input type="tel" name="totaldiscount" value="<?php echo round(a($dataRow, 'tax_document', 'totaldiscount'));  ?>" id="totaldiscount" max="9999999" data-format='price' <?php echo $disableInput ?>>
              </div>
            </div>
            <div class="c-md-4">
              <label for="totalvat"><?php echo T_("Total vat/tax"); ?></label>
              <div class="input ltr">
                <input type="tel" name="totalvat" value="<?php echo round(a($dataRow, 'tax_document', 'totalvat'));  ?>" id="totalvat" max="9999999" data-format='price' <?php echo $disableInput ?>>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php if(\dash\data::editMode()) {?>
        <div class="tblbox font-14">
          <table class="tbl1 v6">
            <thead>
              <tr>
                <th><?php echo T_("Total Before discount"); ?></th>
                <th><?php echo T_("Discount"); ?></th>
                <th><?php echo T_("Total After discount"); ?></th>
                <th><?php echo T_("Total vat"); ?></th>
                <th><?php echo T_("Total payed"); ?></th>
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
                <td data-copy='<?php echo $total; ?>' class="font-12 ltr txtR fc-black"><code><?php echo \dash\fit::number($total, true, 'en') ?></code></td>
                <td data-copy='<?php echo $totaldiscount; ?>' class="font-12 ltr txtR fc-black"><code><?php echo \dash\fit::number($totaldiscount, true, 'en') ?></code></td>
                <td data-copy='<?php echo $total_after_discount; ?>' class="font-12 ltr txtR fc-black"><code><?php echo \dash\fit::number($total_after_discount, true, 'en') ?></code></td>
                <td data-copy='<?php echo $totalvat; ?>' class="font-12 ltr txtR fc-red"><code><?php echo \dash\fit::number($totalvat, true, 'en') ?></code></td>
                <td data-copy='<?php echo $final; ?>' class="font-12 ltr txtB txtR fc-green"><code><?php echo \dash\fit::number($final, true, 'en') ?></code></td>
              </tr>
            </tbody>
          </table>
        </div>

      <?php } //endif ?>
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

      echo '<input type="hidden" name="uploaddoc" value="uploaddoc">';
      require_once(root. 'dash/layout/post/admin-gallery-box.php');

      ?>
    </div>

    <div class="c-xs-12 c-sm-12 c-md-3">


      <?php if(\dash\data::editMode()) {?>
        <nav class="items long">
          <ul>
            <li>
              <a class="item f" href="<?php echo \dash\url::this(). '/doc/edit?id='. \dash\request::get('id'); ?>">
                <div class="key"></div>
                <div class="value"><?php echo a($dataRow, 'tax_document', 'desc') ?></div>
                <div class="go detail"></div>
              </a>
            </li>
            <li>
              <a class="item f" href="<?php echo \dash\url::this(). '/doc/edit?id='. \dash\request::get('id'); ?>">
                <i class="sf-crosshairs"></i>
                <div class="key"><?php echo T_("Open document page") ?></div>
                <div class="go"></div>
              </a>
            </li>
          </ul>
        </nav>

        <nav class="items long">
          <ul>
            <?php if(a(\dash\data::dataRow(), 'tax_document', 'status') === 'temp') {?>
              <li>
                <div class="item f" data-ajaxify data-data='{"newlockstatus" : "lock"}'>
                  <i class="sf-unlock-alt fc-red"></i>
                  <div class="key"><?php echo T_("Click to lock document") ?></div>
                </div>
              </li>
            <?php }elseif(a(\dash\data::dataRow(), 'tax_document', 'status') === 'lock') {?>
              <li>
                <div class="item f" data-ajaxify data-data='{"newlockstatus" : "temp"}'>
                  <i class="sf-lock fc-green"></i>
                  <div class="key"><?php echo T_("Document is locked. Click to unlock") ?></div>
                </div>
              </li>
            <?php } // endif ?>
          </ul>
        </nav>
        <nav class="items long mT10">
          <ul>
            <li>
              <a class="item f" href="<?php echo \dash\url::that(). '/add?type='. \dash\data::myType(); ?>">
                <i class="sf-clone"></i>
                <div class="key"><?php echo T_("Add another") ?></div>
                <div class="go"></div>
              </a>
            </li>
            <li>
              <a class="item f" href="<?php echo \dash\url::that(). '/add?'. \dash\request::build_query(['type' => \dash\data::myType(), 'put_on' => a($dataRow, 'fill_value', 'put_on', 'details_id'), 'thirdparty' => a($dataRow, 'fill_value', 'thirdparty', 'details_id'), 'pay_from' => a($dataRow, 'fill_value', 'pay_from', 'details_id')]); ?>">
                <i class="sf-clone"></i>
                <div class="key"><?php echo T_("Add another by current details") ?></div>
                <div class="go"></div>
              </a>
            </li>
          </ul>
        </nav>
      <?php } //endif ?>
    </div>
  </div>
</form>