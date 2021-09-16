<div class="jibresBanner">
 <div class="avand impact">

  <div class="tblBox">
    <table class="tbl1 v4" data-datatable="pricing">
      <thead>
        <tr>
          <th class="collapsing"></th>
          <th><?php echo T_("TLD") ?></th>
          <th><?php echo T_("Register") ?></th>
          <th><?php echo T_("Renew") ?></th>
          <th><?php echo T_("Transfer") ?></th>
        </tr>
      </thead>
      <tbody>
        <?php $count = 0; foreach (\dash\data::dataTable() as $key => $value) { $count++;?>
          <tr>
            <td class="collapsing"><?php echo \dash\fit::number($count); ?></td>
            <td class="ltr"><?php echo a($value, 'TLD') ?></td>
            <td class="txtB" data-order="<?php echo a($value, 'register'); ?>"><?php echo \content\domains\pricing\controller::priceEl(a($value, 'register')); ?></td>
            <td class="txtB" data-order="<?php echo a($value, 'register'); ?>"><?php echo \content\domains\pricing\controller::priceEl(a($value, 'renew')) ?></td>
            <td class="txtB" data-order="<?php echo a($value, 'register'); ?>"><?php echo \content\domains\pricing\controller::priceEl(a($value, 'transfer')) ?></td>
          </tr>
        <?php } // endfor ?>
      </tbody>
    </table>
  </div>
</div>
</div>
