<form method="get" autocomplete="off" action="<?php echo \dash\url::current() ?>" class="p0">
  <?php if(\dash\request::get('contain')) {?><input type="hidden" name="contain" value="<?php echo \dash\request::get('contain'); ?>"><?php }//endif ?>
  <div class="box">
    <div class="pad">
      <?php if(\dash\url::child() === 'doc' || \dash\url::child() === 'factor') {?>
        <div class="row">
          <div class="c-xs-12 c-sm-6 c-md">
            <div class="input">
              <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\validate::search_string(); ?>" <?php \dash\layout\autofocus::html() ?> autocomplete='off'>
            </div>
          </div>
          <div class="c-xs-12 c-sm-3 c-md">
            <select class="select22" name="month">
              <option value=""><?php echo T_("Choose month") ?></option>
              <?php for ($i=1; $i <= 12 ; $i++) {?>
                <option value="<?php echo $i ?>" <?php if(\dash\request::get('month') == $i) {echo 'selected';} ?>><?php echo \dash\fit::number($i); ?></option>
              <?php } // endfor ?>
            </select>
          </div>
          <div class="c-xs-12 c-sm-3 c-md">
            <select class="select22" name="status">
              <option value=""><?php echo T_("Choose status") ?></option>
              <!-- <option value="draft" <?php if(\dash\request::get('status') === 'draft') {echo 'selected';} ?>><?php echo T_("Draft") ?></option> -->
              <option value="lock" <?php if(\dash\request::get('status') === 'lock') {echo 'selected';} ?>><?php echo T_("Lock") ?></option>
              <option value="temp" <?php if(\dash\request::get('status') === 'temp') {echo 'selected';} ?>><?php echo T_("Temporary") ?></option>
              <option value="deleted" <?php if(\dash\request::get('status') === 'deleted') {echo 'selected';} ?>><?php echo T_("Deleted") ?></option>
            </select>
          </div>
          <?php if(\dash\url::child() === 'factor') {?>
            <div class="c-xs-12 c-sm-6 c-md">
              <select class="select22" name="template">
                <option value=""><?php echo T_("Choose template") ?></option>
              <?php foreach (\lib\app\tax\doc\ready::factor_template_list() as $key => $value) {?>
                  <option value="<?php echo $value ?>" <?php if(\dash\request::get('template') == $value) {echo 'selected';} ?>><?php echo \lib\app\tax\doc\ready::factor_type_translate($value); ?></option>
                <?php } // endfor ?>
              </select>
            </div>
          <?php } //endif ?>

        </div>
      <?php } //endif ?>
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
        <?php if(\dash\url::subchild() != 'balancesheet') {?>
          <div class="c-xs-12 c-sm">
            <label for="startdate" ><?php echo T_("Start date"); ?></label>
            <div class="input mB0-f">
              <input class="ltr" type="text" placeholder="yyyy/mm/dd" data-format="date" name="startdate" id="startdate" value="<?php echo \dash\request::get('startdate'); ?>" autocomplete='off'>
            </div>
          </div>
          <div class="c-xs-12 c-sm">
            <label for="enddate" ><?php echo T_("End date"); ?></label>
            <div class="input mB0-f">
              <input class="ltr" type="text" placeholder="yyyy/mm/dd" data-format="date" name="enddate" id="enddate" value="<?php echo \dash\request::get('enddate'); ?>" autocomplete='off'>
            </div>
          </div>
        <?php } //endif ?>
          <?php if(\dash\url::child() === 'factor') {?>
          <div class="c-xs-12 c-sm">
            <label for="totallarger" ><?php echo T_("Total larger than"); ?></label>
            <div class="input mB0-f">
              <input class="ltr" type="tel" data-format="price" maxlength="24" name="totallarger" id="totallarger" value="<?php echo \dash\request::get('totallarger'); ?>" autocomplete='off'>
            </div>
          </div>
            <div class="c-xs-12 c-sm">
            <label for="totalless" ><?php echo T_("Total less than"); ?></label>
            <div class="input mB0-f">
              <input class="ltr" type="tel" data-format="price" maxlength="24" name="totalless" id="totalless" value="<?php echo \dash\request::get('totalless'); ?>" autocomplete='off'>
            </div>
          </div>
          <?php } //endif ?>

        <?php if(\dash\url::child() === 'report' && \dash\url::subchild() != 'balancesheet') {?>
          <div class="c-xs-12 c-sm-5">
            <label for="show" ><?php echo T_("Report type"); ?></label>
            <div class="row">
              <div class="c">
                <div class="radio3">
                  <input type="radio" name="show" value="col2" id="col2" <?php if(\dash\request::get('show') === 'col2') { echo 'checked';} ?>>
                  <label for="col2"><?php echo T_("2 column"); ?></label>
                </div>
              </div>
              <div class="c">
                <div class="radio3">
                  <input type="radio" name="show" value="col4" id="col4" <?php if(\dash\request::get('show') === 'col4' || !\dash\request::get('show')) { echo 'checked';} ?>>
                  <label for="col4"><?php echo T_("4 column"); ?></label>
                </div>
              </div>
              <div class="c">
                <div class="radio3">
                  <input type="radio" name="show" value="col6" id="col6" <?php if(\dash\request::get('show') === 'col6') { echo 'checked';} ?>>
                  <label for="col6"><?php echo T_("6 column"); ?></label>
                </div>
              </div>

              <div class="c">
                <div class="radio3">
                  <input type="radio" name="show" value="balancesheet" id="balancesheet" <?php if(\dash\request::get('show') === 'balancesheet') { echo 'checked';} ?>>
                  <label for="balancesheet"><?php echo T_("Balance sheet"); ?></label>
                </div>
              </div>

            </div>
          </div>
        <?php } //endif ?>
        <div class="c-xs-12 c-sm-auto p0">
          <div class="mT25 txtRa">
            <?php if(\dash\url::subchild() != 'balancesheet') {?>
              <?php if(\dash\request::get('year_id') || \lib\app\tax\year\get::default_year('id')) {?>
                <div class="btn outline" data-title='<?php echo T_("Reset document number?") ?>' data-confirm data-data='{"resetnumber": "resetnumber", "year_id" : "<?php echo \dash\request::get('year_id'); ?>"}'><i class="sf-refresh"></i></div>
              <?php } //endif ?>
            <?php } //endif ?>
            <?php if(\dash\request::get()) {?>
              <a href="<?php echo \dash\url::current() ?>" class="btn-secondary outline"><?php echo T_("Clear filter") ?></a>
            <?php } //endif ?>
            <button class="btn"><?php echo T_("Apply") ?></button>
          </div>
        </div>

      </div>
    </div>

  </div>
</form>