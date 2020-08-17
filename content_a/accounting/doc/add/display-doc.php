
<form method="post" autocomplete="off">
    <div class="box">
      <div class="pad">
        <div class="row padLess align-end">
          <div class="c-xs-12 c-sm-6 c-md-4 c-lg-3 c-xl-2">
            <?php $defaultYear = null; ?>

            <?php if(\dash\data::accountingYear()) {?>
              <label for="parent"><?php echo T_("Accounting year") ?></label>
              <select class="select22" name="year_id" <?php foreach (\dash\data::accountingYear() as $key => $value) { if((!\dash\data::dataRow_id() && \dash\get::index($value, 'isdefault')) || (\dash\get::index($value, 'id') === \dash\data::dataRow_year_id())) { $defaultYear = \dash\get::index($value, 'id'); echo 'disabled';} }?>>
                <option value=""><?php echo T_("Please choose year") ?></option>
                <?php foreach (\dash\data::accountingYear() as $key => $value) {?>
                  <option value="<?php echo \dash\get::index($value, 'id') ?>" <?php if((!\dash\data::dataRow_id() && \dash\get::index($value, 'isdefault')) || (\dash\get::index($value, 'id') === \dash\data::dataRow_year_id())) { echo 'selected';} ?>><?php echo \dash\get::index($value, 'title'); ?></option>
                <?php } // endfor ?>
              </select>
            <?php }else{ ?>
              <div class="msg warn2"><a class="btn link" href="<?php echo \dash\url::this(). '/year/add' ?>"><?php echo T_("Add new accounting year") ?></a></div>
            <?php } // endif ?>

            <?php if($defaultYear) {?>
              <input type="hidden" name="year_id" value="<?php echo $defaultYear; ?>">
            <?php } //endif ?>
          </div>

          <div class="c-xs-6 c-sm-6 c-md-4 c-lg-3 c-xl-2">
            <label for="number"><?php echo T_("Number") ?> <small class="fc-red">* <?php echo T_("Required") ?></small></label>
            <div class="input mB0-f">
              <input type="number" min="1" max="9999999999" name="number" id="number" required value="<?php echo \dash\data::dataRow_number() ?>" data-format=int>
            </div>
          </div>
          <div class="c-xs-6 c-sm-6 c-md-4 c-lg-3 c-xl-2">
            <label for="date" ><?php echo T_("Date"); ?> <small class="fc-red">* <?php echo T_("Required") ?></small></label>
        		<div class="input mB0-f">
        		<input class="ltr" type="text" placeholder="yyyy/mm/dd" data-format="date" name="date" id="date" value="<?php echo \dash\utility\convert::to_en_number(\dash\fit::date(\dash\data::dataRow_date())); ?>" autocomplete='off' required>
        		</div>
          </div>
          <div class="c-xs-12 c-sm-6 c-md-12 c-lg-3 c-xl">
            <label for="desc"><?php echo T_("Description") ?></label>
            <div class="input mB0-f">
              <input type="text" name="desc" id="desc" value="<?php echo \dash\data::dataRow_desc() ?>">
            </div>
          </div>
          <?php if(\dash\data::editMode()) {?>
          <div class="c-xs c-auto">
            <div class="btn mT10 linkDel outline" data-confirm data-data='{"remove": "remove"}'><?php echo T_("Remove") ?></div>
          </div>
          <div class="c-xs-auto c-auto">
            <button class="btn mT10 secondary outline"><?php echo T_("Edit") ?></button>
          </div>
          <?php }else{ ?>
          <div class="c-xs-12 c-auto">
            <button class="btn mT10 master"><?php echo T_("Add") ?></button>
          </div>
          <?php } //endif ?>
        </div>
      </div>


    </div>
</form>