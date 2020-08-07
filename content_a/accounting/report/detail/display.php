<div class="avand">
  <?php if(!\dash\data::reportDetail()) {?>
    <div class="msg"><?php echo T_("No detail was founded") ?></div>
  <?php }else{ ?>
    <div class="fs14">

        <table class="tbl1 v2">
          <thead>
            <tr>
              <th><?php echo T_("Accounting Group") ?></th>
              <th><?php echo T_("Accounting total") ?></th>
              <th><?php echo T_("Accounting assistant") ?></th>
              <th><?php echo T_("Accounting details") ?></th>
              <th><?php echo T_("Debtor") ?></th>
              <th><?php echo T_("Creditor") ?></th>
              <th><?php echo T_("Remain Debtor") ?></th>
              <th><?php echo T_("Remain Creditor") ?></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach (\dash\data::reportDetail() as $key => $value) {?>
              <tr>
                <td><?php echo \dash\get::index($value, 'group_title') ?></td>
                <td><?php echo \dash\get::index($value, 'total_title') ?></td>
                <td><?php echo \dash\get::index($value, 'assistant_title') ?></td>
                <td><?php echo \dash\get::index($value, 'details_title') ?></td>
                <td><?php echo \dash\fit::number(\dash\get::index($value, 'debtor')) ?></td>
                <td><?php echo \dash\fit::number(\dash\get::index($value, 'creditor')) ?></td>
                <td><?php echo \dash\fit::number(\dash\get::index($value, 'remain_debtor')) ?></td>
                <td><?php echo \dash\fit::number(\dash\get::index($value, 'remain_creditor')) ?></td>
              </tr>
            <?php } //endif ?>
          </tbody>
        </table>
    </div>
  <?php } //endif ?>
</div>