<div class="box">
  <div class="pad">
    <form method="get" autocomplete="off" data-patch action="<?php echo \dash\url::current() ?>">
      <?php if(\dash\data::accountingYear()) {?>
        <label for="parent"><?php echo T_("Accounting year") ?></label>
        <select class="select22" name="year_id">
          <option value=""><?php echo T_("Please choose year") ?></option>
          <?php foreach (\dash\data::accountingYear() as $key => $value) {?>
            <option value="<?php echo \dash\get::index($value, 'id') ?>" <?php if((!\dash\request::get('year_id') && \dash\get::index($value, 'isdefault')) || (\dash\get::index($value, 'id') === \dash\request::get('year_id'))) { echo 'selected';} ?>><?php echo \dash\get::index($value, 'title'); ?></option>
          <?php } // endfor ?>
        </select>
      <?php }else{ ?>
        <div class="msg warn2"><a class="btn link" href="<?php echo \dash\url::here(). '/accounting/year/add' ?>"><?php echo T_("Add new accounting year") ?></a></div>
      <?php } // endif ?>
    </form>
  </div>
</div>



  <?php if(!\dash\data::reportDetail()) {?>
    <div class="msg"><?php echo T_("No detail was founded") ?></div>
  <?php }else{ ?>

    <table class="tbl1 v1 font-10">
      <thead>
        <tr class="font-10">
          <th><?php echo T_("Accounting Group") ?></th>
          <th><?php echo T_("Accounting total") ?></th>
          <th class="txtR"><?php echo T_("Debtor") ?></th>
          <th class="txtR"><?php echo T_("Creditor") ?></th>
          <th class="txtR"><?php echo T_("Remain Debtor") ?></th>
          <th class="txtR"><?php echo T_("Remain Creditor") ?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach (\dash\data::reportDetail() as $key => $value) {?>
          <tr>
            <td><?php echo \dash\get::index($value, 'group_title') ?></td>
            <td><?php echo \dash\get::index($value, 'total_title') ?></td>

          <td class="font-12 ltr txtR fc-red"><code><?php echo \dash\fit::number(\dash\get::index($value, 'debtor'), true, 'en') ?></code></td>
          <td class="font-12 ltr txtR fc-green"><code><?php echo \dash\fit::number(\dash\get::index($value, 'creditor'), true, 'en') ?></code></td>
          <td class="font-12 ltr txtR fc-red"><code><?php echo \dash\fit::number(\dash\get::index($value, 'remain_debtor'), true, 'en') ?></code></td>
          <td class="font-12 ltr txtR fc-green"><code><?php echo \dash\fit::number(\dash\get::index($value, 'remain_creditor'), true, 'en') ?></code></td>
          </tr>
        <?php } //endif ?>
      </tbody>
    </table>
  <?php } //endif ?>
