<?php require_once(root. '/content_a/accounting/filter.php'); ?>
<?php if(!\dash\data::reportDetail()) {?>
  <div class="msg"><?php echo T_("No detail was founded") ?></div>
<?php }else{ ?>
  <table class="tbl1 v1 font-10">
    <thead>
      <tr class="font-10">
        <th class="collapsing"></th>

        <th><?php echo T_("Accounting total") ?></th>
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
          <?php if(\dash\request::get('show') === 'balancesheet') {?>
          <th class="txtR"><?php echo T_("Opening value") ?></th>
          <th class="txtR"><?php echo T_("Current value") ?></th>
        <?php }else{ ?>
          <th class="txtR"><?php echo T_("Remain Debtor") ?></th>
          <th class="txtR"><?php echo T_("Remain Creditor") ?></th>
          <?php } //endif ?>
      </tr>
    </thead>
    <tbody>
      <?php $lastGroup = null; ?>
      <?php foreach (\dash\data::reportDetail_list() as $key => $value) {?>
        <?php if($lastGroup !== a($value, 'group_title')) {?>
          <?php $lastGroup = a($value, 'group_title'); ?>
          <tr class="positive">
            <td colspan="8" class="txtB fs14"><a href="<?php echo \dash\url::this(). '/turnover?'. http_build_query(['year_id' => \dash\request::get('year_id'), 'group' => a($value, 'group_id')]); ?>"><?php echo a($value, 'group_title') ?></a></td>
          </tr>
        <?php } //endif ?>
        <tr>
          <td class="collapsing"><?php echo \dash\fit::number(floatval($key) + 1); ?></td>
          <td><a href="<?php echo \dash\url::this(). '/turnover?'. http_build_query(['year_id' => \dash\request::get('year_id'), 'group' => a($value, 'group_id'), 'total' => a($value, 'total_id')]); ?>"><?php echo a($value, 'total_title') ?></a></td>
          <?php if(\dash\request::get('show') === 'col6') {?>
            <td class="font-12 ltr txtR fc-green"><code><?php echo \dash\fit::number(a($value, 'opening_debtor'), true, 'en') ?></code></td>
            <td class="font-12 ltr txtR fc-red"><code><?php echo \dash\fit::number(a($value, 'opening_creditor'), true, 'en') ?></code></td>
            <td class="font-12 ltr txtR fc-green"><code><?php echo \dash\fit::number(a($value, 'debtor'), true, 'en') ?></code></td>
            <td class="font-12 ltr txtR fc-red"><code><?php echo \dash\fit::number(a($value, 'creditor'), true, 'en') ?></code></td>
          <?php } //endif ?>
          <?php if(\dash\request::get('show') === 'col4' || !\dash\request::get('show')) {?>
            <td class="font-12 ltr txtR fc-green"><code><?php echo \dash\fit::number(a($value, 'sum_debtor'), true, 'en') ?></code></td>
            <td class="font-12 ltr txtR fc-red"><code><?php echo \dash\fit::number(a($value, 'sum_creditor'), true, 'en') ?></code></td>
          <?php } //endif ?>
          <?php if(\dash\request::get('show') === 'balancesheet') {?>
            <td data-copy="<?php echo a($value, 'opening') ?>" class="font-12 ltr txtR fc-black"></i><code><?php echo \dash\fit::number(a($value, 'opening'), true, 'en') ?></code></td>
            <td data-copy="<?php echo a($value, 'current') ?>" class="font-12 ltr txtR fc-black"></i><code><?php echo \dash\fit::number(a($value, 'current'), true, 'en') ?></code></td>
          <?php }else{ ?>
            <td class="font-12 ltr txtR fc-green"><code><?php echo \dash\fit::number(a($value, 'remain_debtor'), true, 'en') ?></code></td>
            <td class="font-12 ltr txtR fc-red"><code><?php echo \dash\fit::number(a($value, 'remain_creditor'), true, 'en') ?></code></td>
          <?php } //endif ?>
        </tr>
      <?php } //endif ?>
    </tbody>
     <tfoot>

          <tr>
            <td class="collapsing"><?php echo T_("Total") ?></td>
            <td></td>

          <?php if(\dash\request::get('show') === 'col6') {?>
            <td class="font-12 ltr txtR"><code><?php echo \dash\fit::number(a(\dash\data::reportDetail_sum(), 'opening_debtor'), true, 'en') ?></code></td>
            <td class="font-12 ltr txtR"><code><?php echo \dash\fit::number(a(\dash\data::reportDetail_sum(), 'opening_creditor'), true, 'en') ?></code></td>
            <td class="font-12 ltr txtR"><code><?php echo \dash\fit::number(a(\dash\data::reportDetail_sum(), 'debtor'), true, 'en') ?></code></td>
            <td class="font-12 ltr txtR"><code><?php echo \dash\fit::number(a(\dash\data::reportDetail_sum(), 'creditor'), true, 'en') ?></code></td>
          <?php } //endif ?>

          <?php if(\dash\request::get('show') === 'col4' || !\dash\request::get('show')) {?>
            <td class="font-12 ltr txtR"><code><?php echo \dash\fit::number(a(\dash\data::reportDetail_sum(), 'sum_debtor'), true, 'en') ?></code></td>
            <td class="font-12 ltr txtR"><code><?php echo \dash\fit::number(a(\dash\data::reportDetail_sum(), 'sum_creditor'), true, 'en') ?></code></td>
          <?php } //endif ?>

            <?php if(\dash\request::get('show') === 'balancesheet') {?>
          <td class="font-12 ltr txtR"><code><?php echo \dash\fit::number(a(\dash\data::reportDetail_sum(), 'opening'), true, 'en') ?></code></td>
          <td class="font-12 ltr txtR"><code><?php echo \dash\fit::number(a(\dash\data::reportDetail_sum(), 'current'), true, 'en') ?></code></td>
        <?php }else{ ?>
          <td class="font-12 ltr txtR"><code><?php echo \dash\fit::number(a(\dash\data::reportDetail_sum(), 'remain_debtor'), true, 'en') ?></code></td>
          <td class="font-12 ltr txtR"><code><?php echo \dash\fit::number(a(\dash\data::reportDetail_sum(), 'remain_creditor'), true, 'en') ?></code></td>

          <?php } //endif ?>
          </tr>


      </tfoot>
  </table>
<?php } //endif ?>