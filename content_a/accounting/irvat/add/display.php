<form method="post" autocomplete="off"  enctype="multipart/form-data">
  <div class="avand-lg">
  <div class="box">
    <div class="pad">
      <?php if(\dash\data::accountingYear()) {?>
        <label for="parent"><?php echo T_("Accounting year") ?></label>
        <select class="select22" name="year_id">
          <option value=""><?php echo T_("Please choose year") ?></option>
          <?php foreach (\dash\data::accountingYear() as $key => $value) {?>
            <option value="<?php echo a($value, 'id') ?>" <?php if((!\dash\request::get('year_id') && a($value, 'isdefault')) || (a($value, 'id') === \dash\request::get('year_id'))) { echo 'selected';} ?>><?php echo a($value, 'title'); ?></option>
          <?php } // endfor ?>
        </select>
      <?php } // endif ?>
      <h6><?php echo T_("Accounting Coding") ?></h6>
      <?php if(\dash\data::detailsList()) {?>
        <label for="pay_from"><?php echo T_("Pay from") ?> <small class="fc-red"><?php echo T_("Required") ?></small></label>
        <select class="select22" name="pay_from">
          <option value=""><?php echo T_("Please choose pay_from") ?></option>
          <?php foreach (\dash\data::detailsList() as $key => $value) {?>
            <option value="<?php echo a($value, 'id') ?>"><?php echo a($value, 'full_title'); ?></option>
          <?php } // endfor ?>
        </select>
        <label for="put_on"><?php echo T_("Put ON") ?> <small class="fc-red"><?php echo T_("Required") ?></small></label>
        <select class="select22" name="put_on">
          <option value=""><?php echo T_("Please choose put_on") ?></option>
          <?php foreach (\dash\data::detailsList() as $key => $value) {?>
            <option value="<?php echo a($value, 'id') ?>"><?php echo a($value, 'full_title'); ?></option>
          <?php } // endfor ?>
        </select>
      <?php } // endif ?>
      <div class="mT10">
        <label class="customer"><?php echo T_("Choose customer") ?></label>
        <select name="customer" class="select22"  data-model='html'  data-ajax--url='<?php echo \dash\url::kingdom(); ?>/crm/api?type=sale&json=true&list=customer' data-shortkey-search data-placeholder='<?php echo T_("Choose customer"); ?>'>
        </select>
      </div>

      <div class="mT20"></div>
      <?php if(\dash\request::get('type') === 'cost') {?>
        <h6><?php echo T_("Add new cost"); ?></h6>
      <?php }elseif(\dash\request::get('type') === 'income'){ ?>
        <h6><?php echo T_("Add new income"); ?></h6>
      <?php }else{ ?>
        <h6><?php echo T_("Add new factor"); ?></h6>
      <?php } ?>

      <label for="title"><?php echo T_("Title"); ?></label>

      <div class="input">
        <input type="text" name="title" value="<?php echo \dash\data::dataRow_title(); ?>" id="title" maxlength="100" placeholder='need to fill by default'>
      </div>
      <div class="row">
        <div class="c-md-6">
          <label for="factordate" ><?php echo T_("Factor date"); ?> <b><?php echo T_("yyyy/mm/dd"); ?></b></label>
          <div class="input">
            <input class="ltr" type="text" placeholder="yyyy/mm/dd" data-format="date" name="factordate" value="<?php echo \dash\data::dataRow_factordate_raw(); ?>" id="factordate" value="<?php echo \dash\request::get('date'); ?>" autocomplete='off'>
          </div>
        </div>
        <div class="c-md-6">
          <label for="serialnumber"><?php echo T_("Factor serial number"); ?></label>
          <div class="input ltr">
            <input type="text" name="serialnumber" value="<?php echo \dash\data::dataRow_serialnumber(); ?>" id="serialnumber" maxlength="100" >
          </div>
        </div>
      </div>
      <div class="row">
        <div class="c-md-4">
          <label for="total"><?php echo T_("Total pay"); ?></label>
          <div class="input ltr">
            <input type="tel" name="total" value="<?php echo \dash\data::dataRow_total(); ?>" id="total" max="9999999" data-format='price'>
          </div>
        </div>
         <div class="c-md-4">
          <label for="totaldiscount"><?php echo T_("Total discount"); ?></label>
          <div class="input ltr">
            <input type="tel" name="totaldiscount" value="<?php echo \dash\data::dataRow_totaldiscount(); ?>" id="totaldiscount" max="9999999" data-format='price'>
          </div>
        </div>
        <div class="c-md-4">
          <label for="totalvat"><?php echo T_("Total vat/tax"); ?></label>
          <div class="input ltr">
            <input type="tel" name="totalvat" value="<?php echo \dash\data::dataRow_totalvat(); ?>" id="totalvat" max="9999999" data-format='price'>
          </div>
        </div>
      </div>

       <?php if(\dash\data::detailsList()) {?>
        <label for="tax"><?php echo T_("Tax") ?> <small class="fc-red"><?php echo T_("Required") ?></small></label>
        <select class="select22" name="tax">
          <option value=""><?php echo T_("Please choose tax") ?></option>
          <?php foreach (\dash\data::detailsList() as $key => $value) {?>
            <option value="<?php echo a($value, 'id') ?>"><?php echo a($value, 'full_title'); ?></option>
          <?php } // endfor ?>
        </select>
        <label for="vat"><?php echo T_("Vat") ?> <small class="fc-red"><?php echo T_("Required") ?></small></label>
        <select class="select22" name="vat">
          <option value=""><?php echo T_("Please choose vat") ?></option>
          <?php foreach (\dash\data::detailsList() as $key => $value) {?>
            <option value="<?php echo a($value, 'id') ?>"><?php echo a($value, 'full_title'); ?></option>
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

