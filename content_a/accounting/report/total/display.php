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
          <th><?php echo T_("Opening debtor") ?></th>
          <th><?php echo T_("Opening creditor") ?></th>

          <th class="txtR"><?php echo T_("Debtor") ?></th>
          <th class="txtR"><?php echo T_("Creditor") ?></th>
          <th class="txtR"><?php echo T_("Remain Debtor") ?></th>
          <th class="txtR"><?php echo T_("Remain Creditor") ?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach (\dash\data::reportDetail() as $key => $value) {?>
          <tr>
            <td class="collapsing"><?php echo \dash\fit::number($key + 1) ?></td>
            <td><a href="<?php echo \dash\url::this(). '/turnover?'. http_build_query(['year_id' => \dash\request::get('year_id'), 'group' => \dash\get::index($value, 'group_id')]); ?>"><?php echo \dash\get::index($value, 'group_title') ?></a></td>
            <td><a href="<?php echo \dash\url::this(). '/turnover?'. http_build_query(['year_id' => \dash\request::get('year_id'), 'group' => \dash\get::index($value, 'group_id'), 'total' => \dash\get::index($value, 'total_id')]); ?>"><?php echo \dash\get::index($value, 'total_title') ?></a></td>

          <td class="font-12 ltr txtR fc-green"><code><?php echo \dash\fit::number(\dash\get::index($value, 'opening_debtor'), true, 'en') ?></code></td>
          <td class="font-12 ltr txtR fc-red"><code><?php echo \dash\fit::number(\dash\get::index($value, 'opening_creditor'), true, 'en') ?></code></td>
          <td class="font-12 ltr txtR fc-green"><code><?php echo \dash\fit::number(\dash\get::index($value, 'debtor'), true, 'en') ?></code></td>
          <td class="font-12 ltr txtR fc-red"><code><?php echo \dash\fit::number(\dash\get::index($value, 'creditor'), true, 'en') ?></code></td>
          <td class="font-12 ltr txtR fc-green"><code><?php echo \dash\fit::number(\dash\get::index($value, 'remain_debtor'), true, 'en') ?></code></td>
          <td class="font-12 ltr txtR fc-red"><code><?php echo \dash\fit::number(\dash\get::index($value, 'remain_creditor'), true, 'en') ?></code></td>
          </tr>
        <?php } //endif ?>
      </tbody>
    </table>
  <?php } //endif ?>
