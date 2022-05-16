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

<?php if(\dash\data::dataTable()) { ?>
<div class="tblBox">
  <table class="tbl1 v1">
    <thead>
      <tr>
        <th><?php echo T_("Product") ?></th>
        <th><?php echo T_("Count") ?></th>
        <th><?php echo T_("Price") ?></th>
        <th><?php echo T_("Vat") ?></th>
        <th><?php echo T_("Discount") ?></th>
        <th><?php echo T_("Final price") ?></th>
        <th><?php echo T_("Qty") ?></th>
        <th><?php echo T_("Sum") ?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach (\dash\data::dataTable() as $key => $value) { ?>
        <tr>
          <td><a href="<?php echo \dash\url::here(). '/products/edit?id='. a($value, 'product_id') ?>"><?php echo a($value, 'product_title') ?></a></td>
          <td><?php echo \dash\fit::number(a($value, 'count')) ?></td>
          <td><?php echo \dash\fit::number(a($value, 'price')) ?></td>
          <td><?php echo \dash\fit::number(a($value, 'vat')) ?></td>
          <td><?php echo \dash\fit::number(a($value, 'discount')) ?></td>
          <td><?php echo \dash\fit::number(a($value, 'finalprice')) ?></td>
          <td><?php echo \dash\fit::number(a($value, 'qty')) ?></td>
          <td><?php echo \dash\fit::number(a($value, 'sum')) ?></td>
        </tr>
      <?php } //endfor ?>
    </tbody>
  </table>
</div>
<?php \dash\utility\pagination::html(); ?>
<?php }else{ ?>
  <div class="alert-info text-center"><?php echo T_("No product was sale in this date") ?></div>
<?php } //endif ?>