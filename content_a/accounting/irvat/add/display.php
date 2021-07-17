<?php
$dataRow = \dash\data::dataRow();

$docIsLock = a($dataRow, 'tax_document', 'status') === 'lock';

$disableInput = $docIsLock ? 'disabled' : null;

$title = null;
switch(\dash\data::myType())
{
  case 'cost': if(\dash\data::editMode()) {  $title = T_("Edit cost factor"); } else {  $title = T_("Add cost factor"); } break;
  case 'income': if(\dash\data::editMode()) {  $title = T_("Edit income factor"); } else {  $title = T_("Add income factor"); } break;
}
?>

<?php if(a($dataRow, 'tax_document', 'status') === 'temp' || a($dataRow, 'tax_document', 'status') === 'lock') {?>
  <form method="post" id="formlock1">
    <input type="hidden" name="newlockstatus" value="<?php if(a($dataRow, 'tax_document', 'status') === 'temp') { echo 'lock'; }elseif(a($dataRow, 'tax_document', 'status') === 'lock'){ echo 'temp';} ?>">
  </form>
<?php } //endif ?>
<form method="post" autocomplete="off"  enctype="multipart/form-data">
  <div class="avand-lg">
  <div class="box">
    <header><h2><?php echo $title; ?></h2></header>
    <div class="pad">
      <?php if(\dash\data::editMode()) {?>
           <nav class="items">
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
      <?php } //endif ?>
      <?php if(\dash\data::accountingYear()) {?>
        <label for="parent"><?php echo T_("Accounting year") ?></label>
        <select class="select22" name="year_id" <?php echo $disableInput; ?>>
          <option value=""><?php echo T_("Please choose year") ?></option>
          <?php foreach (\dash\data::accountingYear() as $key => $value) {?>
            <option value="<?php echo a($value, 'id') ?>" <?php if((!a($dataRow, 'tax_document', 'year_id') && a($value, 'isdefault')) || (a($value, 'id') === a($dataRow, 'tax_document', 'year_id'))) { echo 'selected';} ?>><?php echo a($value, 'title'); ?></option>
          <?php } // endfor ?>
        </select>
      <?php } // endif ?>

      <?php if(\dash\data::detailsList()) {?>
        <label for="pay_from"><?php echo T_("Pay from") ?> <small class="fc-red"><?php echo T_("Required") ?></small></label>
        <select class="select22" name="pay_from" <?php echo $disableInput; ?>>
          <option value=""><?php echo T_("Please choose pay_from") ?></option>
          <?php foreach (\dash\data::detailsList() as $key => $value) {?>
            <option value="<?php echo a($value, 'id') ?>" <?php if(a($dataRow, 'fill_value', 'pay_from', 'details_id') === a($value, 'id')) { echo 'selected'; } ?>><?php echo a($value, 'full_title'); ?></option>
          <?php } // endfor ?>
        </select>
        <label for="put_on"><?php echo T_("Put ON") ?> <small class="fc-red"><?php echo T_("Required") ?></small></label>
        <select class="select22" name="put_on" <?php echo $disableInput; ?>>
          <option value=""><?php echo T_("Please choose put_on") ?></option>
          <?php foreach (\dash\data::detailsList() as $key => $value) {?>
            <option value="<?php echo a($value, 'id') ?>" <?php if(a($dataRow, 'fill_value', 'put_on', 'details_id') === a($value, 'id')) { echo 'selected'; } ?>><?php echo a($value, 'full_title'); ?></option>
          <?php } // endfor ?>
        </select>

        <label for="thirdparty"><?php echo T_("Thirdparty") ?> <small class="fc-red"><?php echo T_("Required") ?></small></label>
        <select class="select22" name="thirdparty" <?php echo $disableInput; ?>>
          <option value=""><?php echo T_("Please choose thirdparty") ?></option>
          <?php foreach (\dash\data::detailsList() as $key => $value) {?>
            <option value="<?php echo a($value, 'id') ?>" <?php if(a($dataRow, 'fill_value', 'thirdparty', 'details_id') === a($value, 'id')) { echo 'selected'; } ?>><?php echo a($value, 'full_title'); ?></option>
          <?php } // endfor ?>
        </select>
      <?php } // endif ?>


      <div class="mT20"></div>


      <label for="title"><?php echo T_("Description"); ?></label>

      <div class="input">
        <input type="text" name="title" value="<?php echo a($dataRow, 'tax_document', 'desc'); ?>" id="title" maxlength="100" placeholder='<?php echo T_('Leave it null to fill by default') ?>' <?php echo $disableInput ?>>
      </div>
      <div class="row">
        <div class="c-md-6">
          <label for="factordate" ><?php echo T_("Factor date"); ?> <b><?php echo T_("yyyy/mm/dd"); ?></b></label>
          <div class="input">
            <input class="ltr" type="text" placeholder="yyyy/mm/dd" data-format="date" name="factordate" value="<?php echo \dash\utility\convert::to_en_number(\dash\fit::date(a($dataRow, 'tax_document', 'date'))); ?>" id="factordate" value="<?php echo \dash\request::get('date'); ?>" autocomplete='off' <?php echo $disableInput ?>>
          </div>
        </div>
        <div class="c-md-6">
          <label for="serialnumber"><?php echo T_("Factor serial number"); ?></label>
          <div class="input ltr">
            <input type="text" name="serialnumber" value="<?php echo a($dataRow, 'tax_document', 'serialnumber');  ?>" id="serialnumber" maxlength="100"  <?php echo $disableInput ?>>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="c-md-4">
          <label for="total"><?php echo T_("Total pay"); ?></label>
          <div class="input ltr">
            <input type="tel" name="total" value="<?php echo a($dataRow, 'tax_document', 'total'); ?>" id="total" max="9999999" data-format='price' <?php echo $disableInput ?>>
          </div>
        </div>
         <div class="c-md-4">
          <label for="totaldiscount"><?php echo T_("Total discount"); ?></label>
          <div class="input ltr">
            <input type="tel" name="totaldiscount" value="<?php echo a($dataRow, 'tax_document', 'totaldiscount');  ?>" id="totaldiscount" max="9999999" data-format='price' <?php echo $disableInput ?>>
          </div>
        </div>
        <div class="c-md-4">
          <label for="totalvat"><?php echo T_("Total vat/tax"); ?></label>
          <div class="input ltr">
            <input type="tel" name="totalvat" value="<?php echo a($dataRow, 'tax_document', 'totalvat');  ?>" id="totalvat" max="9999999" data-format='price' <?php echo $disableInput ?>>
          </div>
        </div>
      </div>

       <?php if(\dash\data::detailsList()) {?>
        <label for="tax"><?php echo T_("Tax") ?> <small class="fc-red"><?php echo T_("Required") ?></small></label>
        <select class="select22" name="tax" <?php echo $disableInput; ?>>
          <option value=""><?php echo T_("Please choose tax") ?></option>
          <?php foreach (\dash\data::detailsList() as $key => $value) {?>
            <option value="<?php echo a($value, 'id') ?>" <?php if(a($dataRow, 'fill_value', 'tax', 'details_id') === a($value, 'id')) { echo 'selected'; } ?>><?php echo a($value, 'full_title'); ?></option>
          <?php } // endfor ?>
        </select>
        <label for="vat"><?php echo T_("Vat") ?> <small class="fc-red"><?php echo T_("Required") ?></small></label>
        <select class="select22" name="vat" <?php echo $disableInput; ?>>
          <option value=""><?php echo T_("Please choose vat") ?></option>
          <?php foreach (\dash\data::detailsList() as $key => $value) {?>
            <option value="<?php echo a($value, 'id') ?>" <?php if(a($dataRow, 'fill_value', 'vat', 'details_id') === a($value, 'id')) { echo 'selected'; } ?>><?php echo a($value, 'full_title'); ?></option>
          <?php } // endfor ?>
        </select>
      <?php } // endif ?>

    </div>
    <?php if(!$disableInput) {?>
    <footer class="txtRa">
      <?php if(\dash\data::editMode()) {?>
        <button class="btn primary"><?php echo T_("Edit") ?></button>
      <?php }else{ ?>
        <button class="btn success"><?php echo T_("Add") ?></button>
      <?php } //endif ?>
    </footer>
  <?php } //endif ?>
  </div>

  <?php
    if(\dash\data::editMode())
    {
      \dash\data::dataRow_gallery_array(a($dataRow, 'tax_document', 'gallery_array'));
      require_once(root. 'content_a/accounting/doc/add/display-gallery.php');
    }
  ?>

  </div>
</form>

