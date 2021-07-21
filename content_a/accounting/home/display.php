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

   <nav class="items long">
     <ul>
      <li>
        <a class="item f" href="<?php echo \dash\url::this(). '/doc'; ?>">
          <img class="bg-gray-100 hover:bg-gray-200 p-2" src="<?php echo \dash\utility\icon::url('Categories'); ?>">
          <div class="key"><?php echo T_('Accounting Documents');?></div>
          <div class="go"></div>
        </a>
      </li>
      <li>
        <a class="item f" href="<?php echo \dash\url::this(). '//doc/add'; ?>">
          <img class="bg-gray-100 hover:bg-gray-200 p-2" src="<?php echo \dash\utility\icon::url('Add Note'); ?>">
          <div class="key"><?php echo T_('Add Accounting Document');?></div>
          <div class="go plus"></div>
        </a>
      </li>
     </ul>
   </nav>

   <nav class="items long">
     <ul>
      <li>
        <a class="item f" href="<?php echo \dash\url::this(). '/turnover'; ?>">
          <img class="bg-gray-100 hover:bg-gray-200 p-2" src="<?php echo \dash\utility\icon::url('refresh'); ?>">
          <div class="key"><?php echo T_('Turnover');?></div>
          <div class="go"></div>
        </a>
      </li>
     </ul>
   </nav>

   <p class="mB5-f font-14"><?php echo T_("Legal offices Monthly") ?></p>
   <nav class="items long">
     <ul>
      <li>
        <a class="item f" href="<?php echo \dash\url::this(). '/report/journal'; ?>">
          <img class="bg-gray-100 hover:bg-gray-200 p-2" src="<?php echo \dash\utility\icon::url('column with text'); ?>">
          <div class="key"><?php echo T_("General Journal") ?></div>
          <div class="value"><?php echo T_("Monthly"); ?></div>
          <div class="go"></div>
        </a>
      </li>
      <li>
        <a class="item f" href="<?php echo \dash\url::this(). '/report/ledger'; ?>">
          <img class="bg-gray-100 hover:bg-gray-200 p-2" src="<?php echo \dash\utility\icon::url('column with text'); ?>">
          <div class="key"><?php echo T_("Ledger") ?></div>
          <div class="value"><?php echo T_("Monthly"); ?></div>
          <div class="go"></div>
        </a>
      </li>
     </ul>
   </nav>

   <p class="mB5-f font-14"><?php echo T_("Legal offices Daily") ?></p>
   <nav class="items long">
     <ul>
      <li>
        <a class="item f" href="<?php echo \dash\url::this(). '/report/journal?daily=1'; ?>">
          <img class="bg-gray-100 hover:bg-gray-200 p-2" src="<?php echo \dash\utility\icon::url('edit'); ?>">
          <div class="key"><?php echo T_("General Journal") ?></div>
          <div class="value"><?php echo T_("Daily"); ?></div>
          <div class="go"></div>
        </a>
      </li>
      <li>
        <a class="item f" href="<?php echo \dash\url::this(). '/report/Ledger?daily=1'; ?>">
          <img class="bg-gray-100 hover:bg-gray-200 p-2" src="<?php echo \dash\utility\icon::url('edit'); ?>">
          <div class="key"><?php echo T_("Ledger") ?></div>
          <div class="value"><?php echo T_("Daily"); ?></div>
          <div class="go"></div>
        </a>
      </li>
     </ul>
   </nav>

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
