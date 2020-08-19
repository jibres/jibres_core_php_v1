<form method="get" autocomplete="off" action="<?php echo \dash\url::current() ?>">
  <div class="box">
    <div class="pad">
      <div class="row">
        <?php if(\dash\data::accountingYear()) {?>
          <div class="c-xs-12 c-sm-4">
            <label for="parent"><?php echo T_("Accounting year") ?></label>
            <select class="select22" name="year_id">
              <option value=""><?php echo T_("Please choose year") ?></option>
              <?php foreach (\dash\data::accountingYear() as $key => $value) {?>
                <option value="<?php echo \dash\get::index($value, 'id') ?>" <?php if((!\dash\request::get('year_id') && \dash\get::index($value, 'isdefault')) || (\dash\get::index($value, 'id') === \dash\request::get('year_id'))) { echo 'selected';} ?>><?php echo \dash\get::index($value, 'title'); ?></option>
              <?php } // endfor ?>
            </select>
          </div>
        <?php } // endif ?>
        <div class="c-xs-12 c-sm-4">
          <label for="startdate" ><?php echo T_("Start date"); ?></label>
          <div class="input mB0-f">
            <input class="ltr" type="text" placeholder="yyyy/mm/dd" data-format="date" name="startdate" id="startdate" value="<?php echo \dash\request::get('startdate'); ?>" autocomplete='off'>
          </div>
        </div>
        <div class="c-xs-12 c-sm-4">
          <label for="enddate" ><?php echo T_("End date"); ?></label>
          <div class="input mB0-f">
            <input class="ltr" type="text" placeholder="yyyy/mm/dd" data-format="date" name="enddate" id="enddate" value="<?php echo \dash\request::get('enddate'); ?>" autocomplete='off'>
          </div>
        </div>
      </div>
    </div>
    <footer class="txtRa">
      <button class="btn master"><?php echo T_("Apply") ?></button>
    </footer>
  </div>
</form>
