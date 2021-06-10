<form method="get" autocomplete="off" action="<?php echo \dash\url::current() ?>">
  <div class="box">
    <div class="pad">
      <div class="row">
        <?php if(\dash\data::accountingYear()) {?>
          <div class="c-xs-12 c-sm">
            <label for="parent"><?php echo T_("Accounting year") ?></label>
            <select class="select22" name="year_id">
              <option value=""><?php echo T_("Please choose year") ?></option>
              <?php foreach (\dash\data::accountingYear() as $key => $value) {?>
                <option value="<?php echo a($value, 'id') ?>" <?php if((!\dash\request::get('year_id') && a($value, 'isdefault')) || (a($value, 'id') === \dash\request::get('year_id'))) { echo 'selected';} ?>><?php echo a($value, 'title'); ?></option>
              <?php } // endfor ?>
            </select>
          </div>
        <?php } // endif ?>
        <div class="c-xs-12 c-sm-auto p0">
          <div class="mT25 txtRa">
        <?php if(\dash\request::get()) {?>
          <a href="<?php echo \dash\url::current() ?>" class="btn secondary outline"><?php echo T_("Clear filter") ?></a>
        <?php } //endif ?>
        <button class="btn master"><?php echo T_("Apply") ?></button>
          </div>
        </div>

      </div>
    </div>

  </div>
</form>
