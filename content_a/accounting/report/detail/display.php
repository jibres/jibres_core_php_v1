<?php require_once(root. '/content_a/accounting/filter.php'); ?>

  <?php if(!\dash\data::reportDetail()) {?>
    <div class="msg"><?php echo T_("No detail was founded") ?></div>
  <?php }else{ ?>

    <table class="tbl1 v1 font-10">
      <thead>
        <tr class="font-10">
          <th class="collapsing"></th>
          <th><?php echo T_("Accounting Group") ?></th>
          <th><?php echo T_("Accounting total") ?></th>
          <th><?php echo T_("Accounting assistant") ?></th>
          <th><?php echo T_("Accounting details") ?></th>
             <?php if(\dash\request::get('show') === 'col6') {?>
          <th><?php echo T_("Opening debtor") ?></th>
          <th><?php echo T_("Opening creditor") ?></th>
          <th class="txtR"><?php echo T_("Current Debtor") ?></th>
          <th class="txtR"><?php echo T_("Current Creditor") ?></th>
        <?php } //endif ?>
          <?php if(\dash\request::get('show') === 'col4' || !\dash\request::get('show')) {?>
          <th class="txtR"><?php echo T_("Sum Debtor") ?></th>
          <th class="txtR"><?php echo T_("Sum Creditor") ?></th>
        <?php } //endif ?>
          <th class="txtR"><?php echo T_("Remain Debtor") ?></th>
          <th class="txtR"><?php echo T_("Remain Creditor") ?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach (\dash\data::reportDetail() as $key => $value) {?>
          <tr>
            <td class="collapsing"><?php echo \dash\fit::number($key + 1) ?></td>
            <td><?php echo \dash\get::index($value, 'group_title') ?></td>
            <td><?php echo \dash\get::index($value, 'total_title') ?></td>
            <td><?php echo \dash\get::index($value, 'assistant_title') ?></td>
            <td><?php echo \dash\get::index($value, 'details_title') ?></td>

           <?php if(\dash\request::get('show') === 'col6') {?>
            <td class="font-12 ltr txtR fc-green"><code><?php echo \dash\fit::number(\dash\get::index($value, 'opening_debtor'), true, 'en') ?></code></td>
            <td class="font-12 ltr txtR fc-red"><code><?php echo \dash\fit::number(\dash\get::index($value, 'opening_creditor'), true, 'en') ?></code></td>
            <td class="font-12 ltr txtR fc-green"><code><?php echo \dash\fit::number(\dash\get::index($value, 'debtor'), true, 'en') ?></code></td>
            <td class="font-12 ltr txtR fc-red"><code><?php echo \dash\fit::number(\dash\get::index($value, 'creditor'), true, 'en') ?></code></td>
          <?php } //endif ?>
          <?php if(\dash\request::get('show') === 'col4' || !\dash\request::get('show')) {?>
            <td class="font-12 ltr txtR fc-green"><code><?php echo \dash\fit::number(\dash\get::index($value, 'sum_debtor'), true, 'en') ?></code></td>
            <td class="font-12 ltr txtR fc-red"><code><?php echo \dash\fit::number(\dash\get::index($value, 'sum_creditor'), true, 'en') ?></code></td>
          <?php } //endif ?>
          <td class="font-12 ltr txtR fc-green"><code><?php echo \dash\fit::number(\dash\get::index($value, 'remain_debtor'), true, 'en') ?></code></td>
          <td class="font-12 ltr txtR fc-red"><code><?php echo \dash\fit::number(\dash\get::index($value, 'remain_creditor'), true, 'en') ?></code></td>
          </tr>
        <?php } //endif ?>
      </tbody>
    </table>
  <?php } //endif ?>
