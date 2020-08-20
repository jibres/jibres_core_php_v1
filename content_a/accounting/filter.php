<form method="get" autocomplete="off" action="<?php echo \dash\url::current() ?>">
  <div class="box">
    <div class="pad">
      <?php if(\dash\url::child() === 'doc') {?>
        <div class="row padLess">
          <div class="c-xs-12 c-sm-6">
        <div class="input">
        <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\request::get('q'); ?>" <?php \dash\layout\autofocus::html() ?> autocomplete='off'>
      </div>
          </div>
          <div class="c-xs-12 c-sm-6">
            <select class="select22" name="month">
              <option value=""><?php echo T_("Choose month") ?></option>
              <?php for ($i=1; $i <= 12 ; $i++) {?>
                <option value="<?php echo $i ?>" <?php if(\dash\request::get('month') == $i) {echo 'selected';} ?>><?php echo \dash\fit::number($i); ?></option>
              <?php } // endfor ?>
            </select>
          </div>

        </div>
      <?php } //endif ?>
      <div class="row padLess">
        <?php if(\dash\data::accountingYear()) {?>
          <div class="c-xs-12 c-sm-3">
            <label for="parent"><?php echo T_("Accounting year") ?></label>
            <select class="select22" name="year_id">
              <option value=""><?php echo T_("Please choose year") ?></option>
              <?php foreach (\dash\data::accountingYear() as $key => $value) {?>
                <option value="<?php echo \dash\get::index($value, 'id') ?>" <?php if((!\dash\request::get('year_id') && \dash\get::index($value, 'isdefault')) || (\dash\get::index($value, 'id') === \dash\request::get('year_id'))) { echo 'selected';} ?>><?php echo \dash\get::index($value, 'title'); ?></option>
              <?php } // endfor ?>
            </select>
          </div>
        <?php } // endif ?>
        <div class="c-xs-12 c-sm-3">
          <label for="startdate" ><?php echo T_("Start date"); ?></label>
          <div class="input mB0-f">
            <input class="ltr" type="text" placeholder="yyyy/mm/dd" data-format="date" name="startdate" id="startdate" value="<?php echo \dash\request::get('startdate'); ?>" autocomplete='off'>
          </div>
        </div>
        <div class="c-xs-12 c-sm-3">
          <label for="enddate" ><?php echo T_("End date"); ?></label>
          <div class="input mB0-f">
            <input class="ltr" type="text" placeholder="yyyy/mm/dd" data-format="date" name="enddate" id="enddate" value="<?php echo \dash\request::get('enddate'); ?>" autocomplete='off'>
          </div>
        </div>
        <div class="c-xs-12 c-sm-3">
          <div class="mT25 txtRa">
            <?php if(\dash\request::get('year_id')) {?>
              <div class="btn outline" data-title='<?php echo T_("Reset document number?") ?>' data-confirm data-data='{"resetnumber": "resetnumber", "year_id" : "<?php echo \dash\request::get('year_id'); ?>"}'><i class="sf-refresh"></i></div>
            <?php } //endif ?>
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
