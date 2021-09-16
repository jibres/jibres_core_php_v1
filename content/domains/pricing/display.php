<div class="jibresBanner">
 <div class="avand impact">

  <div class="tblBox1 ltr">
    <table class="tbl1 v4" data-datatable="pricing">
      <thead>
        <tr>
          <th class="collapsing txtL"></th>
          <th class="txtL"><?php echo T_("TLD") ?></th>
          <th class="txtL"><?php echo T_("Register") ?></th>
          <th class="txtL"><?php echo T_("Renew") ?></th>
          <th class="txtL"><?php echo T_("Transfer") ?></th>
        </tr>
      </thead>
      <tbody>
        <?php $count = 0; foreach (\dash\data::dataTable() as $key => $value) { $count++;?>
          <tr>
            <td class="collapsing" data-order="<?php echo $count; ?>"><?php echo \dash\fit::number($count); ?></td>
            <td class="ltr txtL"><?php echo a($value, 'TLD') ?></td>
            <td class="txtB txtL" data-order="<?php echo a($value, 'register'); ?>"><?php echo \content\domains\pricing\controller::priceEl(a($value, 'register')); ?></td>
            <td class="txtB txtL" data-order="<?php echo a($value, 'register'); ?>"><?php echo \content\domains\pricing\controller::priceEl(a($value, 'renew')) ?></td>
            <td class="txtB txtL" data-order="<?php echo a($value, 'register'); ?>"><?php echo \content\domains\pricing\controller::priceEl(a($value, 'transfer')) ?></td>
          </tr>
        <?php } // endfor ?>
      </tbody>
    </table>
  </div>
</div>
</div>
