
  <div class="f">

    <div class="c4 s12">
      <a class="dcard x1" href='<?php echo \dash\url::this(). '/doc'; ?>'>
        <div class="statistic green">
          <div class="value"><i class="sf-list-ul"></i></div>
          <div class="label"><?php echo T_("Accounting Document"); ?></div>
        </div>
      </a>
    </div>

    <div class="c4 s12">
      <a class="dcard x1" href='<?php echo \dash\url::this(). '/doc/add'; ?>'>
        <div class="statistic red">
          <div class="value"><i class="sf-plus"></i></div>
          <div class="label"><?php echo T_("Add Accounting Document"); ?></div>
        </div>
      </a>
    </div>


    <div class="c2 s12">
      <a class="dcard x1" href='<?php echo \dash\url::this(). '/doc/add?type=opening'; ?>'>
        <div class="statistic brown">
          <div class="value"><i class="sf-new-sign"></i></div>
          <div class="label"><?php echo T_("Add Opening document"); ?></div>
        </div>
      </a>
    </div>


     <div class="c2 s12">
      <a class="dcard x1" href='<?php echo \dash\url::this(). '/doc/printall'; ?>'>
        <div class="statistic brown">
          <div class="value"><i class="sf-print"></i></div>
          <div class="label"><?php echo T_("Print All Document"); ?></div>
        </div>
      </a>
    </div>

    <div class="c4 s12">
      <a class="dcard x1" href='<?php echo \dash\url::this(). '/coding'; ?>'>
        <div class="statistic blue">
          <div class="value"><i class="sf-align-left"></i></div>
          <div class="label"><?php echo T_("Accounting Coding"); ?></div>
        </div>
      </a>
    </div>


    <div class="c4 s12">
      <a class="dcard x1" href='<?php echo \dash\url::this(). '/coding/all'; ?>'>
        <div class="statistic blue">
          <div class="value"><i class="sf-list-ul"></i></div>
          <div class="label"><?php echo T_("Accounting Coding list"); ?></div>
        </div>
      </a>
    </div>


     <div class="c4 s12">
      <a class="dcard x1" href='<?php echo \dash\url::this(). '/year'; ?>'>
        <div class="statistic red">
          <div class="value"><i class="sf-asterisk"></i></div>
          <div class="label"><?php echo T_("Accounting Year"); ?></div>
        </div>
      </a>
    </div>





    <div class="c12 s12">
      <a class="dcard x1" href='<?php echo \dash\url::this(). '/turnover'; ?>'>
        <div class="statistic gold">
          <div class="value"><i class="sf-retweet"></i></div>
          <div class="label"><?php echo T_("Turnover"); ?></div>
        </div>
      </a>
    </div>


  </div>

  <h2 class="mTB20"><?php echo T_("Income-cost management") ?></h2>
  <div class="f">
    <div class="c s12">
      <a class="dcard x1" href='<?php echo \dash\url::this(); ?>/irvat/add?type=cost'>
        <div class="statistic red">
          <div class="value"><i class="sf-plus"></i></div>
          <div class="label"><?php echo T_("Add cost"); ?></div>
        </div>
      </a>
    </div>

    <div class="c s12">
      <a class="dcard x1" href='<?php echo \dash\url::this(); ?>/irvat/add?type=income'>
        <div class="statistic red">
          <div class="value"><i class="sf-plus"></i></div>
          <div class="label"><?php echo T_("Add income"); ?></div>
        </div>
      </a>
    </div>

    <div class="c s12">
      <a class="dcard x1" href='<?php echo \dash\url::this(); ?>/irvat/all'>
        <div class="statistic red">
          <div class="value"><i class="sf-list-ul"></i></div>
          <div class="label"><?php echo T_("List"); ?></div>
        </div>
      </a>
    </div>

  </div>



  <h2><?php echo T_("Accounting Reports") ?></h2>

  <div class="f">

    <div class="c s12">
      <a class="dcard x1" href='<?php echo \dash\url::this(). '/report/group'; ?>'>
        <div class="statistic">
          <div class="value"><i class="sf-chart"></i></div>
          <div class="label"><?php echo T_("Report on group level"); ?></div>
        </div>
      </a>
    </div>


    <div class="c s12">
      <a class="dcard x1" href='<?php echo \dash\url::this(). '/report/total'; ?>'>
        <div class="statistic">
          <div class="value"><i class="sf-chart"></i></div>
          <div class="label"><?php echo T_("Report on total level"); ?></div>
        </div>
      </a>
    </div>

    <div class="c s12">
      <a class="dcard x1" href='<?php echo \dash\url::this(). '/report/assistant'; ?>'>
        <div class="statistic">
          <div class="value"><i class="sf-chart"></i></div>
          <div class="label"><?php echo T_("Report on assistant level"); ?></div>
        </div>
      </a>
    </div>

     <div class="c s12">
      <a class="dcard x1" href='<?php echo \dash\url::this(). '/report/detail'; ?>'>
        <div class="statistic">
          <div class="value"><i class="sf-chart"></i></div>
          <div class="label"><?php echo T_("Report on detail level"); ?></div>
        </div>
      </a>
    </div>



  </div>

   <div class="f">

    <div class="c s12">
      <a class="dcard x1" href='<?php echo \dash\url::this(). '/report/group?show=balancesheet'; ?>'>
        <div class="statistic blue">
          <div class="value"><i class="sf-chart"></i></div>
          <div class="label"><?php echo T_("Balance sheet on group level"); ?></div>
        </div>
      </a>
    </div>


    <div class="c s12">
      <a class="dcard x1" href='<?php echo \dash\url::this(). '/report/total?show=balancesheet'; ?>'>
        <div class="statistic blue">
          <div class="value"><i class="sf-chart"></i></div>
          <div class="label"><?php echo T_("Balance sheet on total level"); ?></div>
        </div>
      </a>
    </div>


    <div class="c s12">
      <a class="dcard x1" href='<?php echo \dash\url::this(). '/report/assistant?show=balancesheet'; ?>'>
        <div class="statistic blue">
          <div class="value"><i class="sf-chart"></i></div>
          <div class="label"><?php echo T_("Balance sheet on assistant level"); ?></div>
        </div>
      </a>
    </div>

     <div class="c s12">
      <a class="dcard x1" href='<?php echo \dash\url::this(). '/report/detail?show=balancesheet'; ?>'>
        <div class="statistic blue">
          <div class="value"><i class="sf-chart"></i></div>
          <div class="label"><?php echo T_("Balance sheet on detail level"); ?></div>
        </div>
      </a>
    </div>



  </div>

  <div class="f">
     <div class="c s12">
      <a class="dcard x1" href='<?php echo \dash\url::this(). '/report/journal'; ?>'>
        <div class="statistic pink">
          <div class="value mB10"><img alt='Report' class="w-12 h-12" src="<?php echo \dash\utility\icon::url('column with text');?>"></div>
          <div class="label"><?php echo T_("General Journal"). ' - '. T_("Monthly"); ?></div>
        </div>
      </a>
    </div>
    <div class="c s12">
      <a class="dcard x1" href='<?php echo \dash\url::this(). '/report/journal?daily=1'; ?>'>
        <div class="statistic pink">
          <div class="value mB10"><img alt='Report' class="w-12 h-12" src="<?php echo \dash\utility\icon::url('column with text');?>"></div>
          <div class="label"><?php echo T_("General Journal"). ' - '. T_("Daily"); ?></div>
        </div>
      </a>
    </div>
        <div class="c s12">
      <a class="dcard x1" href='<?php echo \dash\url::this(). '/report/ledger'; ?>'>
        <div class="statistic pink">
          <div class="value mB10"><img alt='Report' class="w-12 h-12" src="<?php echo \dash\utility\icon::url('column with text');?>"></div>
          <div class="label"><?php echo T_("Ledger"). ' - '. T_("Monthly"); ?></div>
        </div>
      </a>
    </div>

       <div class="c s12">
      <a class="dcard x1" href='<?php echo \dash\url::this(). '/report/ledger?daily=1'; ?>'>
        <div class="statistic pink">
          <div class="value mB10"><img alt='Report' class="w-12 h-12" src="<?php echo \dash\utility\icon::url('column with text');?>"></div>
          <div class="label"><?php echo T_("Ledger"). ' - '. T_("Daily"); ?></div>
        </div>
      </a>
    </div>
  </div>






