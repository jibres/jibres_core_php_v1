<div class="row">
  <div class="c-xs-12 c-sm-12 c-md-8">



  </div>
  <div class="c-xs-12 c-sm-12 c-md-4">
    <nav class="items long">
     <ul>
       <li>
        <a class="item f" href="<?php echo \dash\url::this(). '/coding'; ?>">
          <img class="bg-gray-100 hover:bg-gray-200 p-2" src="<?php echo \dash\utility\icon::url('code'); ?>">
          <div class="key"><?php echo T_('Accounting Coding');?></div>
          <div class="go"></div>
        </a>
      </li>
       <li>
        <a class="item f" href="<?php echo \dash\url::this(). '/year'; ?>">
          <img class="bg-gray-100 hover:bg-gray-200 p-2" src="<?php echo \dash\utility\icon::url('archive'); ?>">
          <div class="key"><?php echo T_('Accounting Year');?></div>
          <div class="go"></div>
        </a>
      </li>
     </ul>
   </nav>



  </div>
</div>













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
      <a class="dcard x1" href='<?php echo \dash\url::this(); ?>/factor/add?type=cost'>
        <div class="statistic red">
          <div class="value"><i class="sf-plus"></i></div>
          <div class="label"><?php echo T_("Add cost"); ?></div>
        </div>
      </a>
    </div>

    <div class="c s12">
      <a class="dcard x1" href='<?php echo \dash\url::this(); ?>/factor/add?type=income'>
        <div class="statistic red">
          <div class="value"><i class="sf-plus"></i></div>
          <div class="label"><?php echo T_("Add income"); ?></div>
        </div>
      </a>
    </div>

    <div class="c s12">
      <a class="dcard x1" href='<?php echo \dash\url::this(); ?>/factor/add?type=petty_cash'>
        <div class="statistic red">
          <div class="value"><i class="sf-plus"></i></div>
          <div class="label"><?php echo T_("Add petty cash"); ?></div>
        </div>
      </a>
    </div>

     <div class="c s12">
      <a class="dcard x1" href='<?php echo \dash\url::this(); ?>/factor/add?type=partner'>
        <div class="statistic red">
          <div class="value"><i class="sf-plus"></i></div>
          <div class="label"><?php echo T_("Add petty cash from Accounting Partner"); ?></div>
        </div>
      </a>
    </div>





    <div class="c s12">
      <a class="dcard x1" href='<?php echo \dash\url::this(); ?>/factor'>
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





<div class="row font-14 mT5">
  <div class="c-xs-12 c-sm-12 c-md-4">
    <p class="mB5-f font-14"><?php echo T_("4 Column Accounting reports") ?></p>
    <nav class="items long">
       <ul>
         <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/report/group'; ?>">
            <img class="bg-gray-100 hover:bg-gray-200 p-2" src="<?php echo \dash\utility\icon::url('list'); ?>">
            <div class="key"><?php echo T_("Report on group level"); ?></div>
            <div class="go"></div>
          </a>
        </li>
         <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/report/total'; ?>">
            <img class="bg-gray-100 hover:bg-gray-200 p-2" src="<?php echo \dash\utility\icon::url('list'); ?>">
            <div class="key"><?php echo T_("Report on total level"); ?></div>
            <div class="go"></div>
          </a>
        </li>
         <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/report/assistant'; ?>">
            <img class="bg-gray-100 hover:bg-gray-200 p-2" src="<?php echo \dash\utility\icon::url('list'); ?>">
            <div class="key"><?php echo T_("Report on assistant level"); ?></div>
            <div class="go"></div>
          </a>
        </li>
         <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/report/detail'; ?>">
            <img class="bg-gray-100 hover:bg-gray-200 p-2" src="<?php echo \dash\utility\icon::url('list'); ?>">
            <div class="key"><?php echo T_("Report on detail level"); ?></div>
            <div class="go"></div>
          </a>
        </li>
       </ul>
     </nav>
  </div>

  <div class="c-xs-12 c-sm-12 c-md-4">
    <p class="mB5-f font-14"><?php echo T_("6 Column Accounting reports") ?></p>
    <nav class="items long">
       <ul>
         <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/report/group?show=col6'; ?>">
            <img class="bg-gray-100 hover:bg-gray-200 p-2" src="<?php echo \dash\utility\icon::url('hint'); ?>">
            <div class="key"><?php echo T_("Report on group level"); ?></div>
            <div class="go"></div>
          </a>
        </li>
         <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/report/total?show=col6'; ?>">
            <img class="bg-gray-100 hover:bg-gray-200 p-2" src="<?php echo \dash\utility\icon::url('hint'); ?>">
            <div class="key"><?php echo T_("Report on total level"); ?></div>
            <div class="go"></div>
          </a>
        </li>
         <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/report/assistant?show=col6'; ?>">
            <img class="bg-gray-100 hover:bg-gray-200 p-2" src="<?php echo \dash\utility\icon::url('hint'); ?>">
            <div class="key"><?php echo T_("Report on assistant level"); ?></div>
            <div class="go"></div>
          </a>
        </li>
         <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/report/detail?show=col6'; ?>">
            <img class="bg-gray-100 hover:bg-gray-200 p-2" src="<?php echo \dash\utility\icon::url('hint'); ?>">
            <div class="key"><?php echo T_("Report on detail level"); ?></div>
            <div class="go"></div>
          </a>
        </li>
       </ul>
     </nav>
  </div>

  <div class="c-xs-12 c-sm-12 c-md-4">
    <p class="mB5-f font-14"><?php echo T_("Trial balance") ?></p>
    <nav class="items long">
       <ul>
         <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/report/group?show=balancesheet'; ?>">
            <img class="bg-gray-100 hover:bg-gray-200 p-2" src="<?php echo \dash\utility\icon::url('reports'); ?>">
            <div class="key"><?php echo T_("Trial balance at group level"); ?></div>
            <div class="go"></div>
          </a>
        </li>
         <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/report/total?show=balancesheet'; ?>">
            <img class="bg-gray-100 hover:bg-gray-200 p-2" src="<?php echo \dash\utility\icon::url('reports'); ?>">
            <div class="key"><?php echo T_("Trial balance at total level"); ?></div>
            <div class="go"></div>
          </a>
        </li>
         <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/report/assistant?show=balancesheet'; ?>">
            <img class="bg-gray-100 hover:bg-gray-200 p-2" src="<?php echo \dash\utility\icon::url('reports'); ?>">
            <div class="key"><?php echo T_("Trial balance at assistant level"); ?></div>
            <div class="go"></div>
          </a>
        </li>
         <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/report/detail?show=balancesheet'; ?>">
            <img class="bg-gray-100 hover:bg-gray-200 p-2" src="<?php echo \dash\utility\icon::url('reports'); ?>">
            <div class="key"><?php echo T_("Trial balance at detail level"); ?></div>
            <div class="go"></div>
          </a>
        </li>
       </ul>
     </nav>
  </div>

</div>
