<?php
$dataRow = \dash\data::dataRow();

 ?>
<form method="post" autocomplete="off"  enctype="multipart/form-data">
  <div class="avand-lg">
  <div class="box">
     <?php if(\dash\request::get('type') === 'cost') {?>
        <header><h2><?php echo T_("Add new cost"); ?></h2></header>
      <?php }elseif(\dash\request::get('type') === 'income'){ ?>
        <header><h2><?php echo T_("Add new income"); ?></h2></header>
      <?php }else{ ?>
        <header><h2><?php echo T_("Add new factor"); ?></h2></header>
      <?php } ?>
    <div class="pad">
      <?php if(\dash\data::accountingYear()) {?>
        <label for="parent"><?php echo T_("Accounting year") ?></label>
        <select class="select22" name="year_id">
          <option value=""><?php echo T_("Please choose year") ?></option>
          <?php foreach (\dash\data::accountingYear() as $key => $value) {?>
            <option value="<?php echo a($value, 'id') ?>" <?php if((!a($dataRow, 'tax_document', 'year_id') && a($value, 'isdefault')) || (a($value, 'id') === a($dataRow, 'tax_document', 'year_id'))) { echo 'selected';} ?>><?php echo a($value, 'title'); ?></option>
          <?php } // endfor ?>
        </select>
      <?php } // endif ?>

      <?php if(\dash\data::detailsList()) {?>
        <label for="pay_from"><?php echo T_("Pay from") ?> <small class="fc-red"><?php echo T_("Required") ?></small></label>
        <select class="select22" name="pay_from">
          <option value=""><?php echo T_("Please choose pay_from") ?></option>
          <?php foreach (\dash\data::detailsList() as $key => $value) {?>
            <option value="<?php echo a($value, 'id') ?>" <?php if(a($dataRow, 'fill_value', 'pay_from', 'details_id') === a($value, 'id')) { echo 'selected'; } ?>><?php echo a($value, 'full_title'); ?></option>
          <?php } // endfor ?>
        </select>
        <label for="put_on"><?php echo T_("Put ON") ?> <small class="fc-red"><?php echo T_("Required") ?></small></label>
        <select class="select22" name="put_on">
          <option value=""><?php echo T_("Please choose put_on") ?></option>
          <?php foreach (\dash\data::detailsList() as $key => $value) {?>
            <option value="<?php echo a($value, 'id') ?>" <?php if(a($dataRow, 'fill_value', 'put_on', 'details_id') === a($value, 'id')) { echo 'selected'; } ?>><?php echo a($value, 'full_title'); ?></option>
          <?php } // endfor ?>
        </select>

        <label for="thirdparty"><?php echo T_("Thirdparty") ?> <small class="fc-red"><?php echo T_("Required") ?></small></label>
        <select class="select22" name="thirdparty">
          <option value=""><?php echo T_("Please choose thirdparty") ?></option>
          <?php foreach (\dash\data::detailsList() as $key => $value) {?>
            <option value="<?php echo a($value, 'id') ?>" <?php if(a($dataRow, 'fill_value', 'thirdparty', 'details_id') === a($value, 'id')) { echo 'selected'; } ?>><?php echo a($value, 'full_title'); ?></option>
          <?php } // endfor ?>
        </select>
      <?php } // endif ?>


      <div class="mT20"></div>


      <label for="title"><?php echo T_("Description"); ?></label>

      <div class="input">
        <input type="text" name="title" value="<?php echo a($dataRow, 'tax_document', 'desc'); ?>" id="title" maxlength="100" placeholder='<?php echo T_('Leave it null to fill by default') ?>'>
      </div>
      <div class="row">
        <div class="c-md-6">
          <label for="factordate" ><?php echo T_("Factor date"); ?> <b><?php echo T_("yyyy/mm/dd"); ?></b></label>
          <div class="input">
            <input class="ltr" type="text" placeholder="yyyy/mm/dd" data-format="date" name="factordate" value="<?php echo a($dataRow, 'tax_document', 'date'); ; ?>" id="factordate" value="<?php echo \dash\request::get('date'); ?>" autocomplete='off'>
          </div>
        </div>
        <div class="c-md-6">
          <label for="serialnumber"><?php echo T_("Factor serial number"); ?></label>
          <div class="input ltr">
            <input type="text" name="serialnumber" value="<?php echo a($dataRow, 'tax_document', 'serialnumber');  ?>" id="serialnumber" maxlength="100" >
          </div>
        </div>
      </div>
      <div class="row">
        <div class="c-md-4">
          <label for="total"><?php echo T_("Total pay"); ?></label>
          <div class="input ltr">
            <input type="tel" name="total" value="<?php echo a($dataRow, 'tax_document', 'total'); ?>" id="total" max="9999999" data-format='price'>
          </div>
        </div>
         <div class="c-md-4">
          <label for="totaldiscount"><?php echo T_("Total discount"); ?></label>
          <div class="input ltr">
            <input type="tel" name="totaldiscount" value="<?php echo a($dataRow, 'tax_document', 'totaldiscount');  ?>" id="totaldiscount" max="9999999" data-format='price'>
          </div>
        </div>
        <div class="c-md-4">
          <label for="totalvat"><?php echo T_("Total vat/tax"); ?></label>
          <div class="input ltr">
            <input type="tel" name="totalvat" value="<?php echo a($dataRow, 'tax_document', 'totalvat');  ?>" id="totalvat" max="9999999" data-format='price'>
          </div>
        </div>
      </div>

       <?php if(\dash\data::detailsList()) {?>
        <label for="tax"><?php echo T_("Tax") ?> <small class="fc-red"><?php echo T_("Required") ?></small></label>
        <select class="select22" name="tax">
          <option value=""><?php echo T_("Please choose tax") ?></option>
          <?php foreach (\dash\data::detailsList() as $key => $value) {?>
            <option value="<?php echo a($value, 'id') ?>" <?php if(a($dataRow, 'fill_value', 'tax', 'details_id') === a($value, 'id')) { echo 'selected'; } ?>><?php echo a($value, 'full_title'); ?></option>
          <?php } // endfor ?>
        </select>
        <label for="vat"><?php echo T_("Vat") ?> <small class="fc-red"><?php echo T_("Required") ?></small></label>
        <select class="select22" name="vat">
          <option value=""><?php echo T_("Please choose vat") ?></option>
          <?php foreach (\dash\data::detailsList() as $key => $value) {?>
            <option value="<?php echo a($value, 'id') ?>" <?php if(a($dataRow, 'fill_value', 'vat', 'details_id') === a($value, 'id')) { echo 'selected'; } ?>><?php echo a($value, 'full_title'); ?></option>
          <?php } // endfor ?>
        </select>
      <?php } // endif ?>

    </div>
    <footer class="txtRa">
      <button class="btn master"><?php echo T_("Add") ?></button>
    </footer>
  </div>
  </div>
</form>

