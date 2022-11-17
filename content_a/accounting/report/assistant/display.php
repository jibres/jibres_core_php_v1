<?php require_once(root. '/content_a/accounting/filter.php'); ?>
<?php require_once(root. '/content_a/accounting/report/report_header.php'); ?>

<?php if(!\dash\data::reportDetail()) {?>
  <div class="alert2"><?php echo T_("No detail was founded") ?></div>
<?php }else{ ?>
  <?php foreach (\dash\data::reportDetail_pretty() as $group) {?>
   <div class="break-inside-avoid">
    <h5 class="mt-6 font-black"><?php echo a($group, 'detail', 'title'); ?></h5>
    <table class="tbl1 v4 text-xs minimal">
    <thead>
      <tr class="text-xs">
        <th class="collapsing"></th>
        <th><?php echo T_("Accounting total") ?></th>
          <th><?php echo T_("Accounting assistant") ?></th>
        <?php if(\dash\request::get('show') === 'col6') {?>
          <th><?php echo T_("Opening debtor") ?></th>
          <th><?php echo T_("Opening creditor") ?></th>
          <th class="text-right"><?php echo T_("Current Debtor") ?></th>
          <th class="text-right"><?php echo T_("Current Creditor") ?></th>
        <?php } //endif ?>
        <?php if(\dash\request::get('show') === 'col4' || !\dash\request::get('show')) {?>
          <th class="text-right"><?php echo T_("Sum Debtor") ?></th>
          <th class="text-right"><?php echo T_("Sum Creditor") ?></th>
        <?php } //endif ?>
          <?php if(\dash\request::get('show') === 'balancesheet') {?>
          <th class="text-right"><?php echo T_("End value") ?></th>
          <th class="text-right"><?php echo T_("Opening value") ?></th>
        <?php }else{ ?>
          <th class="text-right"><?php echo T_("Remain Debtor") ?></th>
          <th class="text-right"><?php echo T_("Remain Creditor") ?></th>
          <?php } //endif ?>
      </tr>
    </thead>
    <tbody>

      <?php foreach ($group['list'] as $key => $value) {?>
        <tr>
          <td class="collapsing"><?php echo \dash\fit::number(floatval($key) + 1); ?></td>
          <td>
            <a href="<?php echo \dash\url::this(). '/turnover?'. http_build_query(['year_id' => \dash\request::get('year_id'), 'group' => a($value, 'group_id'), 'total' => a($value, 'total_id')]); ?>">
              <code><?php echo a($value, 'total_code') ?></code>
            <?php echo a($value, 'total_title') ?></a>
          </td>
            <td class="text-sm"><a href="<?php echo \dash\url::this(). '/turnover?'. http_build_query(['year_id' => \dash\request::get('year_id'), 'group' => a($value, 'group_id'), 'total' => a($value, 'total_id'), 'assistant' => a($value, 'assistant_id')]); ?>">
              <code><?php echo a($value, 'assistant_code') ?></code>
              <?php echo a($value, 'assistant_title') ?></a>
            </td>
          <?php if(\dash\request::get('show') === 'col6') {?>
            <td data-copy='<?php echo a($value, 'opening_debtor'); ?>' class="text-sm ltr text-right text-green-700"><code><?php echo \dash\fit::number(a($value, 'opening_debtor'), true, 'en') ?></code></td>
            <td data-copy='<?php echo a($value, 'opening_creditor'); ?>' class="text-sm ltr text-right text-red-800"><code><?php echo \dash\fit::number(a($value, 'opening_creditor'), true, 'en') ?></code></td>
            <td data-copy='<?php echo a($value, 'debtor'); ?>' class="text-sm ltr text-right text-green-700"><code><?php echo \dash\fit::number(a($value, 'debtor'), true, 'en') ?></code></td>
            <td data-copy='<?php echo a($value, 'creditor'); ?>' class="text-sm ltr text-right text-red-800"><code><?php echo \dash\fit::number(a($value, 'creditor'), true, 'en') ?></code></td>
          <?php } //endif ?>
          <?php if(\dash\request::get('show') === 'col4' || !\dash\request::get('show')) {?>
            <td data-copy='<?php echo a($value, 'sum_debtor'); ?>' class="text-sm ltr text-right text-green-700"><code><?php echo \dash\fit::number(a($value, 'sum_debtor'), true, 'en') ?></code></td>
            <td data-copy='<?php echo a($value, 'sum_creditor'); ?>' class="text-sm ltr text-right text-red-800"><code><?php echo \dash\fit::number(a($value, 'sum_creditor'), true, 'en') ?></code></td>
          <?php } //endif ?>
          <?php if(\dash\request::get('show') === 'balancesheet') {?>
            <td data-copy="<?php echo a($value, 'end_value') ?>" class="text-sm ltr text-right fc-black"></i><code><?php echo \dash\fit::number(a($value, 'end_value'), true, 'en') ?></code></td>
            <td data-copy="<?php echo a($value, 'opening') ?>" class="text-sm ltr text-right fc-black"></i><code><?php echo \dash\fit::number(a($value, 'opening'), true, 'en') ?></code></td>
          <?php }else{ ?>
            <td data-copy='<?php echo a($value, 'remain_debtor'); ?>' class="text-sm ltr text-right text-green-700"><code><?php echo \dash\fit::number(a($value, 'remain_debtor'), true, 'en') ?></code></td>
            <td data-copy='<?php echo a($value, 'remain_creditor'); ?>' class="text-sm ltr text-right text-red-800"><code><?php echo \dash\fit::number(a($value, 'remain_creditor'), true, 'en') ?></code></td>
          <?php } //endif ?>
        </tr>
      <?php } //endif ?>
    </tbody>
     <tfoot class="dontRepeatFoot">

          <tr>
            <td class="collapsing"><?php echo T_("Total") ?></td>
            <td></td>
            <td></td>

          <?php if(\dash\request::get('show') === 'col6') {?>
            <td data-copy='<?php echo a($group['sum'], 'opening_debtor'); ?>' class="text-sm ltr text-right"><code><?php echo \dash\fit::number(a($group['sum'], 'opening_debtor'), true, 'en') ?></code></td>
            <td data-copy='<?php echo a($group['sum'], 'opening_creditor'); ?>' class="text-sm ltr text-right"><code><?php echo \dash\fit::number(a($group['sum'], 'opening_creditor'), true, 'en') ?></code></td>
            <td data-copy='<?php echo a($group['sum'], 'debtor'); ?>' class="text-sm ltr text-right"><code><?php echo \dash\fit::number(a($group['sum'], 'debtor'), true, 'en') ?></code></td>
            <td data-copy='<?php echo a($group['sum'], 'creditor'); ?>' class="text-sm ltr text-right"><code><?php echo \dash\fit::number(a($group['sum'], 'creditor'), true, 'en') ?></code></td>
          <?php } //endif ?>

          <?php if(\dash\request::get('show') === 'col4' || !\dash\request::get('show')) {?>
            <td data-copy='<?php echo a($group['sum'], 'sum_debtor'); ?>' class="text-sm ltr text-right"><code><?php echo \dash\fit::number(a($group['sum'], 'sum_debtor'), true, 'en') ?></code></td>
            <td data-copy='<?php echo a($group['sum'], 'sum_creditor'); ?>' class="text-sm ltr text-right"><code><?php echo \dash\fit::number(a($group['sum'], 'sum_creditor'), true, 'en') ?></code></td>
          <?php } //endif ?>

            <?php if(\dash\request::get('show') === 'balancesheet') {?>
          <td data-copy='<?php echo a($group['sum'], 'end_value'); ?>' class="text-sm ltr text-right"><code><?php echo \dash\fit::number(a($group['sum'], 'end_value'), true, 'en') ?></code></td>
          <td data-copy='<?php echo a($group['sum'], 'opening'); ?>' class="text-sm ltr text-right"><code><?php echo \dash\fit::number(a($group['sum'], 'opening'), true, 'en') ?></code></td>
        <?php }else{ ?>
          <td data-copy='<?php echo a($group['sum'], 'remain_debtor'); ?>' class="text-sm ltr text-right"><code><?php echo \dash\fit::number(a($group['sum'], 'remain_debtor'), true, 'en') ?></code></td>
          <td data-copy='<?php echo a($group['sum'], 'remain_creditor'); ?>' class="text-sm ltr text-right"><code><?php echo \dash\fit::number(a($group['sum'], 'remain_creditor'), true, 'en') ?></code></td>

          <?php } //endif ?>
          </tr>
      </tfoot>
    </table>
   </div>

  <?php } //endfor ?>
  <h5 class="mt-6 font-black"><?php echo T_("Total") ?></h5>
    <table class="tbl1 v6 text-xs break-inside-avoid minimal">
    <thead>
      <tr class="text-xs">
        <th class="collapsing"></th>

        <th></th>
        <th></th>
        <?php if(\dash\request::get('show') === 'col6') {?>
          <th><?php echo T_("Opening debtor") ?></th>
          <th><?php echo T_("Opening creditor") ?></th>
          <th class="text-right"><?php echo T_("Current Debtor") ?></th>
          <th class="text-right"><?php echo T_("Current Creditor") ?></th>
        <?php } //endif ?>
        <?php if(\dash\request::get('show') === 'col4' || !\dash\request::get('show')) {?>
          <th class="text-right"><?php echo T_("Sum Debtor") ?></th>
          <th class="text-right"><?php echo T_("Sum Creditor") ?></th>
        <?php } //endif ?>
          <?php if(\dash\request::get('show') === 'balancesheet') {?>
          <th class="text-right"><?php echo T_("Opening value") ?></th>
          <th class="text-right"><?php echo T_("Current value") ?></th>
        <?php }else{ ?>
          <th class="text-right"><?php echo T_("Remain Debtor") ?></th>
          <th class="text-right"><?php echo T_("Remain Creditor") ?></th>
          <?php } //endif ?>
      </tr>
    </thead>

     <tfoot>

          <tr>
            <td class="collapsing"><?php echo T_("Total") ?></td>
            <td></td>
            <td></td>

          <?php if(\dash\request::get('show') === 'col6') {?>
            <td data-copy='<?php echo a(\dash\data::reportDetail_sum(), 'opening_debtor') ?>' class="text-sm ltr text-right"><code><?php echo \dash\fit::number(a(\dash\data::reportDetail_sum(), 'opening_debtor'), true, 'en') ?></code></td>
            <td data-copy='<?php echo a(\dash\data::reportDetail_sum(), 'opening_creditor') ?>' class="text-sm ltr text-right"><code><?php echo \dash\fit::number(a(\dash\data::reportDetail_sum(), 'opening_creditor'), true, 'en') ?></code></td>
            <td data-copy='<?php echo a(\dash\data::reportDetail_sum(), 'debtor') ?>' class="text-sm ltr text-right"><code><?php echo \dash\fit::number(a(\dash\data::reportDetail_sum(), 'debtor'), true, 'en') ?></code></td>
            <td data-copy='<?php echo a(\dash\data::reportDetail_sum(), 'creditor') ?>' class="text-sm ltr text-right"><code><?php echo \dash\fit::number(a(\dash\data::reportDetail_sum(), 'creditor'), true, 'en') ?></code></td>
          <?php } //endif ?>

          <?php if(\dash\request::get('show') === 'col4' || !\dash\request::get('show')) {?>
            <td data-copy='<?php echo a(\dash\data::reportDetail_sum(), 'sum_debtor') ?>' class="text-sm ltr text-right"><code><?php echo \dash\fit::number(a(\dash\data::reportDetail_sum(), 'sum_debtor'), true, 'en') ?></code></td>
            <td data-copy='<?php echo a(\dash\data::reportDetail_sum(), 'sum_creditor') ?>' class="text-sm ltr text-right"><code><?php echo \dash\fit::number(a(\dash\data::reportDetail_sum(), 'sum_creditor'), true, 'en') ?></code></td>
          <?php } //endif ?>

            <?php if(\dash\request::get('show') === 'balancesheet') {?>
          <td data-copy='<?php echo a(\dash\data::reportDetail_sum(), 'end_value') ?>' class="text-sm ltr text-right"><code><?php echo \dash\fit::number(a(\dash\data::reportDetail_sum(), 'end_value'), true, 'en') ?></code></td>
          <td data-copy='<?php echo a(\dash\data::reportDetail_sum(), 'opening') ?>' class="text-sm ltr text-right"><code><?php echo \dash\fit::number(a(\dash\data::reportDetail_sum(), 'opening'), true, 'en') ?></code></td>
        <?php }else{ ?>
          <td data-copy='<?php echo a(\dash\data::reportDetail_sum(), 'remain_debtor') ?>' class="text-sm ltr text-right"><code><?php echo \dash\fit::number(a(\dash\data::reportDetail_sum(), 'remain_debtor'), true, 'en') ?></code></td>
          <td data-copy='<?php echo a(\dash\data::reportDetail_sum(), 'remain_creditor') ?>' class="text-sm ltr text-right"><code><?php echo \dash\fit::number(a(\dash\data::reportDetail_sum(), 'remain_creditor'), true, 'en') ?></code></td>

          <?php } //endif ?>
          </tr>
      </tfoot>
  </table>

<?php } //endif ?>