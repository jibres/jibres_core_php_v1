<form method="get" autocomplete="off" action="<?php echo \dash\url::that() ?>">
  <div class="box">
    <div class="pad">
      <label for="date"><?php echo T_("Date"); ?></label>
      <div class="input">
        <input type="tel" name="date" value="<?php echo \dash\data::currentDate() ?>" data-format="date" id="date">
        <button class="btn-primary addon"><?php echo T_("Report") ?></button>
      </div>
    </div>
  </div>
</form>

<?php if(\dash\data::dataTable()) {
$currency = \lib\store::currency();
?>
<div class="tblBox">
  <table class="tbl1 v1">
    <thead>
      <tr>
        <th><?php echo T_("Product") ?></th>
        <th><?php echo T_("Count Order") ?></th>
        <th><?php echo T_("Total price") ?></th>
        <th><?php echo T_("Total Vat") ?></th>
        <th><?php echo T_("Total Discount") ?></th>
        <th><?php echo T_("Total") ?></th>
        <th><?php echo T_("Qty") ?></th>
        <th><?php echo T_("Sum") ?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach (\dash\data::dataTable() as $key => $value) { ?>
        <tr>
          <td><a href="<?php echo \dash\url::here(). '/products/edit?id='. a($value, 'product_id') ?>"><?php echo a($value, 'product_title') ?></a></td>
          <td><?php echo \dash\fit::number_decimal(a($value, 'count')) ?></td>
          <td><?php echo \dash\fit::number_decimal(a($value, 'price')); if(floatval(a($value, 'price'))){ echo ' <small class="text-gray-400">'. $currency. '</small>'; }?></td>
          <td><?php echo \dash\fit::number_decimal(a($value, 'vat')); if(floatval(a($value, 'vat'))){ echo ' <small class="text-gray-400">'. $currency. '</small>'; }?></td>
          <td><?php echo \dash\fit::number_decimal(a($value, 'discount')); if(floatval(a($value, 'discount'))){ echo ' <small class="text-gray-400">'. $currency. '</small>'; }?></td>
          <td><?php echo \dash\fit::number_decimal(a($value, 'finalprice')); if(floatval(a($value, 'finalprice'))){ echo ' <small class="text-gray-400">'. $currency. '</small>'; }?></td>
          <td><?php echo \dash\fit::number_decimal(a($value, 'qty'));  if(floatval(a($value, 'qty'))){ echo ' <small class="text-gray-400">'. a($value, 'product_unit'). '</small>'; } ?></td>
          <td><?php echo \dash\fit::number_decimal(a($value, 'sum')); if(floatval(a($value, 'sum'))){ echo ' <small class="text-gray-400">'. $currency. '</small>'; }?></td>
        </tr>
      <?php } //endfor ?>
    </tbody>
  </table>
</div>
<?php echo \dash\utility\pagination::html(); ?>
<?php }else{ ?>
  <div class="alert-info text-center"><?php echo T_("No product was sale in this date") ?></div>
<?php } //endif ?>