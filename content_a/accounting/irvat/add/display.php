<?php
$dataRow = \dash\data::dataRow();

$docIsLock = a($dataRow, 'tax_document', 'status') === 'lock';

$disableInput = $docIsLock ? 'disabled' : null;

$title = null;
if(\dash\data::editMode())
{
  $title = a($dataRow, 'tax_document', 'desc');
}
else
{
  switch(\dash\data::myType())
  {
    case 'cost': if(\dash\data::editMode()) {  $title = T_("Edit cost factor"); } else {  $title = T_("Add cost factor"); } break;
    case 'income': if(\dash\data::editMode()) {  $title = T_("Edit income factor"); } else {  $title = T_("Add income factor"); } break;
  }
}
?>
<?php if(a($dataRow, 'tax_document', 'status') === 'temp' || a($dataRow, 'tax_document', 'status') === 'lock') {?>

<?php } //endif ?>
<form method="post" autocomplete="off"  enctype="multipart/form-data" id="form1">
  <div class="avand-lg">
    <div class="box">
      <header><h2><?php echo $title; ?></h2></header>
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
          <label for="put_on"><?php echo T_("Cost type") ?> <small class="fc-red"><?php echo T_("Required") ?></small></label>
          <select class="select22" name="put_on" <?php echo $disableInput; ?>>
            <option value=""><?php echo T_("Cost type") ?></option>
            <?php foreach (\dash\data::detailsList() as $key => $value) {?>
              <option value="<?php echo a($value, 'id') ?>" <?php if(a($dataRow, 'fill_value', 'put_on', 'details_id') === a($value, 'id')) { echo 'selected'; } ?>><?php echo a($value, 'full_title'); ?></option>
            <?php } // endfor ?>
          </select>
          <label for="thirdparty"><?php echo T_("Thirdparty") ?></label>
          <select class="select22" name="thirdparty" <?php echo $disableInput; ?>>
            <option value=""><?php echo T_("Thirdparty") ?></option>
            <?php foreach (\dash\data::detailsList() as $key => $value) {?>
              <option value="<?php echo a($value, 'id') ?>" <?php if(a($dataRow, 'fill_value', 'thirdparty', 'details_id') === a($value, 'id')) { echo 'selected'; } ?>><?php echo a($value, 'full_title'); ?></option>
            <?php } // endfor ?>
          </select>
          <label for="pay_from"><?php echo T_("Payer") ?></label>
          <select class="select22" name="pay_from" <?php echo $disableInput; ?>>
            <option value=""><?php echo T_("Payer") ?></option>
            <?php foreach (\dash\data::detailsList() as $key => $value) {?>
              <option value="<?php echo a($value, 'id') ?>" <?php if(a($dataRow, 'fill_value', 'pay_from', 'details_id') === a($value, 'id')) { echo 'selected'; } ?>><?php echo a($value, 'full_title'); ?></option>
            <?php } // endfor ?>
          </select>
        <?php } // endif ?>
        <div class="mT20"></div>
        <?php if(\dash\data::editMode()) {?>
          <label for="title"><?php echo T_("Description"); ?></label>
          <div class="input">
            <input type="text" name="title" value="<?php echo a($dataRow, 'tax_document', 'desc'); ?>" id="title" maxlength="100" placeholder='<?php echo T_('Leave it null to fill by default') ?>' <?php echo $disableInput ?>>
          </div>
        <?php } //endif ?>
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

         <?php if(\dash\data::editMode()) {?>
          <nav class="items long mT10">
            <ul>
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

      echo '<input type="hidden" name="uploaddoc" value="uploaddoc">';
      require_once(root. 'dash/layout/post/admin-gallery-box.php');

    ?>
  </div>
</form>