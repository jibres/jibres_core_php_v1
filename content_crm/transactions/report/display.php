  <div id="chartdivcrmtransaction" class="box chart x285 s0" data-abc='crm/transaction' data-abc-v='4'>
      <div class="hide">
        <div id="chardatatitle"><?php echo T_("Minus") ?></div>
        <div id="chardatatitleplus"><?php echo T_("Plus") ?></div>
        <div id="charttitle"><?php echo T_("Transaction Minus Plus in last year") ?></div>
        <div id="chartcategory"><?php echo a(\dash\data::reportDetail(), 'chart', 'category') ?></div>
        <div id="chartdataplus"><?php echo a(\dash\data::reportDetail(), 'chart', 'plus') ?></div>
        <div id="chartdatadraft"><?php echo a(\dash\data::reportDetail(), 'chart', 'minus') ?></div>
      </div>
    </div>