  <h2><?php echo T_("Accounting") ?></h2>

  <div class="f">

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
          <div class="value"><i class="sf-list"></i></div>
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


    <div class="c4 s12">
      <a class="dcard x1" href='<?php echo \dash\url::this(). '/doc'; ?>'>
        <div class="statistic green">
          <div class="value"><i class="sf-list"></i></div>
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


    <div class="c4 s12">
      <a class="dcard x1" href='<?php echo \dash\url::this(). '/doc/add?type=opening'; ?>'>
        <div class="statistic brown">
          <div class="value"><i class="sf-new-sign"></i></div>
          <div class="label"><?php echo T_("Add Opening document"); ?></div>
        </div>
      </a>
    </div>





    <div class="c4 s12">
      <a class="dcard x1" href='<?php echo \dash\url::this(). '/docdetail'; ?>'>
        <div class="statistic gold">
          <div class="value"><i class="sf-spin-alt"></i></div>
          <div class="label"><?php echo T_("Account flow"); ?></div>
        </div>
      </a>
    </div>


  </div>

  <h2><?php echo T_("Accounting Reports") ?></h2>

  <div class="f">

    <div class="c3 s12">
      <a class="dcard x1" href='<?php echo \dash\url::this(). '/report/group'; ?>'>
        <div class="statistic">
          <div class="value"><i class="sf-chart"></i></div>
          <div class="label"><?php echo T_("Report on group level"); ?></div>
        </div>
      </a>
    </div>


    <div class="c3 s12">
      <a class="dcard x1" href='<?php echo \dash\url::this(). '/report/total'; ?>'>
        <div class="statistic">
          <div class="value"><i class="sf-chart"></i></div>
          <div class="label"><?php echo T_("Report on total level"); ?></div>
        </div>
      </a>
    </div>


    <div class="c3 s12">
      <a class="dcard x1" href='<?php echo \dash\url::this(). '/report/assistant'; ?>'>
        <div class="statistic">
          <div class="value"><i class="sf-chart"></i></div>
          <div class="label"><?php echo T_("Report on assistant level"); ?></div>
        </div>
      </a>
    </div>

     <div class="c3 s12">
      <a class="dcard x1" href='<?php echo \dash\url::this(). '/report/detail'; ?>'>
        <div class="statistic">
          <div class="value"><i class="sf-chart"></i></div>
          <div class="label"><?php echo T_("Report on detail level"); ?></div>
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
          <div class="value"><i class="sf-list"></i></div>
          <div class="label"><?php echo T_("List"); ?></div>
        </div>
      </a>
    </div>


  </div>

