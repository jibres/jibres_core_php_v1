<div class="jibresBanner">
 <div class="avand impact">

  <div class="tblBox">
    <table class="tbl1 v4" data-datatable="pricing">
      <thead>
        <tr>
        <th class="collapsing"></th>
        <th><?php echo T_("TLD") ?></th>
        <th><?php echo T_("Price") ?> <small><?php echo T_("Toman"); ?></small></th>
        <?php if(\dash\permission::supervisor()) {?>
          <th><?php echo T_("Price") ?> <small><?php echo T_("Dollar"); ?></small></th>
         <?php } //endif ?>
        </tr>
      </thead>
      <tbody>
        <?php $count = 0; foreach (\dash\data::dataTable() as $key => $value) { $count++;?>
          <tr>
            <td class="collapsing"><?php echo \dash\fit::number($count); ?></td>
            <td class="ltr"><?php echo a($value, 'tld') ?></td>
            <td class="txtB"><?php echo \dash\fit::number(a($value, 'price')) ?></td>
            <?php if(\dash\permission::supervisor()) {?>
              <td class="txtB"><?php echo \dash\fit::text(a($value, 'dollar')) ?></td>
            <?php } //endif ?>

          </tr>
        <?php } // endfor ?>
      </tbody>
    </table>
  </div>
</div>
</div>
