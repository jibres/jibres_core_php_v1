<div id="chartdivcrmtransaction" class="box chart x285 s0" data-abc='crm/transaction' data-abc-v='4'>
  <div class="hide">
    <div id="chardatatitle"><?php echo T_("Minus") ?></div>
    <div id="chardatatitleplus"><?php echo T_("Plus") ?></div>
    <div id="charttitle"><?php echo T_("Transaction Minus Plus in last year") ?></div>
    <div id="chartcategory"><?php echo a(\dash\data::reportDetail(), 'category') ?></div>
    <div id="chartdataplus"><?php echo a(\dash\data::reportDetail(), 'plus') ?></div>
    <div id="chartdatadraft"><?php echo a(\dash\data::reportDetail(), 'minus') ?></div>
  </div>
</div>

<?php if(a(\dash\data::reportDetail(), 'plus_table')) {?>
  <div class="avand-md font-14">

  <div class="tblBox">
    <table class="tbl1 v1">
      <thead>
        <tr>
          <th><?php echo T_("Month") ?></th>
          <th><?php echo T_("Amount") ?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach (a(\dash\data::reportDetail(), 'plus_table') as $key => $value) {
          $std = sprintf('%s/01', str_replace('-', '/', $key));
          $end = sprintf('%s/31', str_replace('-', '/', $key));
          $args = ['std' => $std, 'end' => $end, 'verify'=> 'y'];
          ?>
          <tr>
            <td><a href="<?php echo \dash\url::this(). \dash\request::full_get($args) ?>"><?php echo \dash\fit::number_en($key) ?></a></td>
            <td class="txtB"><?php echo \dash\fit::number_en($value) ?></td>
          </tr>
        <?php } //endif ?>
      </tbody>
    </table>
  </div>
  </div>
<?php } //endif ?>