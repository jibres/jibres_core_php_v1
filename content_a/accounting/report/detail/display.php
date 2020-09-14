<?php require_once(root. '/content_a/accounting/filter.php'); ?>
<?php if(!\dash\data::reportDetail()) {?>
  <div class="msg"><?php echo T_("No detail was founded") ?></div>
<?php }else{ ?>
  <?php foreach (\dash\data::reportDetail_pretty() as $group) {?>
    <h5 class="mT50"><?php echo \dash\get::index($group, 'detail', 'title'); ?></h5>
    <table class="tbl1 v4 font-10">
    <thead>
      <tr class="font-10">
        <th class="collapsing"></th>
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
          <?php if(\dash\request::get('show') === 'balancesheet') {?>
          <th class="txtR"><?php echo T_("End value") ?></th>
          <th class="txtR"><?php echo T_("Opening value") ?></th>
        <?php }else{ ?>
          <th class="txtR"><?php echo T_("Remain Debtor") ?></th>
          <th class="txtR"><?php echo T_("Remain Creditor") ?></th>
          <?php } //endif ?>
      </tr>
    </thead>
    <tbody>

      <?php foreach ($group['list'] as $key => $value) {?>
        <tr>
          <td class="collapsing"><?php echo \dash\fit::number(floatval($key) + 1); ?></td>
          <td>
            <a href="<?php echo \dash\url::this(). '/turnover?'. http_build_query(['year_id' => \dash\request::get('year_id'), 'group' => \dash\get::index($value, 'group_id'), 'total' => \dash\get::index($value, 'total_id')]); ?>"><?php echo \dash\get::index($value, 'total_title') ?></a>
          </td>
          <td>
            <a href="<?php echo \dash\url::this(). '/turnover?'. http_build_query(['year_id' => \dash\request::get('year_id'), 'group' => \dash\get::index($value, 'group_id'), 'total' => \dash\get::index($value, 'total_id'), 'assistant' => \dash\get::index($value, 'assistant_id')]); ?>"><?php echo \dash\get::index($value, 'assistant_title') ?></a>
          </td>
            <td><a href="<?php echo \dash\url::this(). '/turnover?'. http_build_query(['year_id' => \dash\request::get('year_id'), 'group' => \dash\get::index($value, 'group_id'), 'total' => \dash\get::index($value, 'total_id'), 'assistant' => \dash\get::index($value, 'assistant_id'), 'details' => \dash\get::Index($value, 'details_id')]); ?>"><?php echo \dash\get::index($value, 'details_title') ?></a></td>
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
          <?php if(\dash\request::get('show') === 'balancesheet') {?>
            <td data-copy="<?php echo \dash\get::index($value, 'end_value') ?>" class="font-12 ltr txtR fc-black"></i><code><?php echo \dash\fit::number(\dash\get::index($value, 'end_value'), true, 'en') ?></code></td>
            <td data-copy="<?php echo \dash\get::index($value, 'opening') ?>" class="font-12 ltr txtR fc-black"></i><code><?php echo \dash\fit::number(\dash\get::index($value, 'opening'), true, 'en') ?></code></td>
          <?php }else{ ?>
            <td class="font-12 ltr txtR fc-green"><code><?php echo \dash\fit::number(\dash\get::index($value, 'remain_debtor'), true, 'en') ?></code></td>
            <td class="font-12 ltr txtR fc-red"><code><?php echo \dash\fit::number(\dash\get::index($value, 'remain_creditor'), true, 'en') ?></code></td>
          <?php } //endif ?>
        </tr>
      <?php } //endif ?>
    </tbody>
     <tfoot>

          <tr>
            <td class="collapsing"><?php echo T_("Total") ?></td>
            <td></td>
            <td></td>
            <td></td>

          <?php if(\dash\request::get('show') === 'col6') {?>
            <td class="font-12 ltr txtR"><code><?php echo \dash\fit::number(\dash\get::index($group['sum'], 'opening_debtor'), true, 'en') ?></code></td>
            <td class="font-12 ltr txtR"><code><?php echo \dash\fit::number(\dash\get::index($group['sum'], 'opening_creditor'), true, 'en') ?></code></td>
            <td class="font-12 ltr txtR"><code><?php echo \dash\fit::number(\dash\get::index($group['sum'], 'debtor'), true, 'en') ?></code></td>
            <td class="font-12 ltr txtR"><code><?php echo \dash\fit::number(\dash\get::index($group['sum'], 'creditor'), true, 'en') ?></code></td>
          <?php } //endif ?>

          <?php if(\dash\request::get('show') === 'col4' || !\dash\request::get('show')) {?>
            <td class="font-12 ltr txtR"><code><?php echo \dash\fit::number(\dash\get::index($group['sum'], 'sum_debtor'), true, 'en') ?></code></td>
            <td class="font-12 ltr txtR"><code><?php echo \dash\fit::number(\dash\get::index($group['sum'], 'sum_creditor'), true, 'en') ?></code></td>
          <?php } //endif ?>

            <?php if(\dash\request::get('show') === 'balancesheet') {?>
          <td class="font-12 ltr txtR"><code><?php echo \dash\fit::number(\dash\get::index($group['sum'], 'end_value'), true, 'en') ?></code></td>
          <td class="font-12 ltr txtR"><code><?php echo \dash\fit::number(\dash\get::index($group['sum'], 'opening'), true, 'en') ?></code></td>
        <?php }else{ ?>
          <td class="font-12 ltr txtR"><code><?php echo \dash\fit::number(\dash\get::index($group['sum'], 'remain_debtor'), true, 'en') ?></code></td>
          <td class="font-12 ltr txtR"><code><?php echo \dash\fit::number(\dash\get::index($group['sum'], 'remain_creditor'), true, 'en') ?></code></td>

          <?php } //endif ?>
          </tr>
      </tfoot>
  </table>

  <?php } //endfor ?>
  <h5 class="mT50"><?php echo T_("Total") ?></h5>
    <table class="tbl1 v6 font-10">
    <thead>
      <tr class="font-10">
        <th class="collapsing"></th>

        <th></th>
        <th></th>
        <th></th>
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
          <th class="txtR"><?php echo T_("End value") ?></th>
          <th class="txtR"><?php echo T_("Opening value") ?></th>
        <?php }else{ ?>
          <th class="txtR"><?php echo T_("Remain Debtor") ?></th>
          <th class="txtR"><?php echo T_("Remain Creditor") ?></th>
          <?php } //endif ?>
      </tr>
    </thead>

     <tfoot>

          <tr>
            <td class="collapsing"><?php echo T_("Total") ?></td>
            <td></td>
            <td></td>
            <td></td>

          <?php if(\dash\request::get('show') === 'col6') {?>
            <td class="font-12 ltr txtR"><code><?php echo \dash\fit::number(\dash\get::index(\dash\data::reportDetail_sum(), 'opening_debtor'), true, 'en') ?></code></td>
            <td class="font-12 ltr txtR"><code><?php echo \dash\fit::number(\dash\get::index(\dash\data::reportDetail_sum(), 'opening_creditor'), true, 'en') ?></code></td>
            <td class="font-12 ltr txtR"><code><?php echo \dash\fit::number(\dash\get::index(\dash\data::reportDetail_sum(), 'debtor'), true, 'en') ?></code></td>
            <td class="font-12 ltr txtR"><code><?php echo \dash\fit::number(\dash\get::index(\dash\data::reportDetail_sum(), 'creditor'), true, 'en') ?></code></td>
          <?php } //endif ?>

          <?php if(\dash\request::get('show') === 'col4' || !\dash\request::get('show')) {?>
            <td class="font-12 ltr txtR"><code><?php echo \dash\fit::number(\dash\get::index(\dash\data::reportDetail_sum(), 'sum_debtor'), true, 'en') ?></code></td>
            <td class="font-12 ltr txtR"><code><?php echo \dash\fit::number(\dash\get::index(\dash\data::reportDetail_sum(), 'sum_creditor'), true, 'en') ?></code></td>
          <?php } //endif ?>

            <?php if(\dash\request::get('show') === 'balancesheet') {?>
          <td class="font-12 ltr txtR"><code><?php echo \dash\fit::number(\dash\get::index(\dash\data::reportDetail_sum(), 'end_value'), true, 'en') ?></code></td>
          <td class="font-12 ltr txtR"><code><?php echo \dash\fit::number(\dash\get::index(\dash\data::reportDetail_sum(), 'opening'), true, 'en') ?></code></td>
        <?php }else{ ?>
          <td class="font-12 ltr txtR"><code><?php echo \dash\fit::number(\dash\get::index(\dash\data::reportDetail_sum(), 'remain_debtor'), true, 'en') ?></code></td>
          <td class="font-12 ltr txtR"><code><?php echo \dash\fit::number(\dash\get::index(\dash\data::reportDetail_sum(), 'remain_creditor'), true, 'en') ?></code></td>

          <?php } //endif ?>
          </tr>
      </tfoot>
  </table>

<?php } //endif ?>