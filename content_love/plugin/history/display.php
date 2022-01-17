
<div class="tblBox">

<table class="tbl1 v1 fs12 selectable">
  <thead>
    <tr>

      <th><?php echo T_("Business"); ?></th>
      <th><?php echo T_("Plugin"); ?></th>
      <th><?php echo T_("Action"); ?></th>
      <th><?php echo T_("Status"); ?></th>
      <th><?php echo T_("Price"); ?></th>
      <th><?php echo T_("Date"); ?></th>
      <th><?php echo T_("Expire date"); ?></th>
      <th><?php echo T_("Description"); ?></th>






    </tr>
  </thead>
  <tbody>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>
      <tr>
        <td><a href="<?php echo \dash\url::here(). '/store?q='. a($value, 'store_id') ?>"><?php echo a($value, 'title') ?></a></td>
        <td><?php echo a($value, 'plugin_title') ?></td>
        <td><?php echo a($value, 'taction') ?></td>
        <td><?php echo a($value, 'tplugin_status') ?></td>
        <td><a href="<?php echo \dash\url::kingdom(). '/crm/transactions/detail?id='. a($value, 'transaction_id'); ?>"><?php echo \dash\fit::number(a($value, 'finalprice')) ?> <small><?php echo \lib\currency::jibres_currency(true); ?></small></a></td>
        <td><?php echo \dash\fit::date_time(a($value, 'datecreated')) ?></td>
        <td><?php echo \dash\fit::date_time(a($value, 'expiredate')) ?></td>
        <td><?php echo a($value, 'desc') ?></td>
    </tr>

    <?php } //endfor ?>
  </tbody>
</table>
</div>


<?php \dash\utility\pagination::html(); ?>


