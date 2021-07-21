<?php $dashboardDetail = \dash\data::dashboardDetail(); ?>
<div class="row">
  <div class="c-xs-12 c-sm-12 c-md-8">

    <div class="row">
      <div class="c-12">
      </div>

      <div class="c-4">
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
      <div class="c-8">

        <section class="row">
          <div class="c-xs-0 c-sm-6 c-md-6">
            <a href="<?php echo \dash\url::this() ?>/doc" class="circularChartBox">
              <?php $myPercent= a($dashboardDetail, 'percent_lock');$myColor='auto';include core.'layout/elements/circularChart.php';?>
              <h3><?php echo T_("Percent lock Accounting Document");?></h3>
            </a>
          </div>

          <div class="c-xs-6 c-sm-6 c-md-6">
            <a href="<?php echo \dash\url::this() ?>/doc" class="circularChartBox">
              <?php $myPercent= a($dashboardDetail, 'percent_attachment');$myColor='auto';include core.'layout/elements/circularChart.php';?>
              <h3><?php echo T_("Percent have attachment");?></h3>
            </a>
          </div>
        </section>

      </div>

    </div>

   <div id="chartdivcrmhome" class="box chart x370 s0" data-abc='crm/homepage'>
      <div class="hide">
        <div id="charttitleunit"><?php echo T_("Count") ?></div>
        <div id="chartverifytitle"><?php echo T_("Success transactions") ?></div>
        <div id="chartunverifytitle"><?php echo T_("Unsuccess transactions") ?></div>

        <div id="charttitle"><?php echo T_("Chart transactions per day in last 3 month") ?></div>
        <div id="chartcategory"><?php echo a($dashboardDetail, 'chart', 'category') ?></div>
        <div id="chartverify"><?php echo a($dashboardDetail, 'chart', 'verify') ?></div>
        <div id="chartunverify"><?php echo a($dashboardDetail, 'chart', 'unverify') ?></div>
      </div>
    </div>




  </div>
  <div class="c-xs-12 c-sm-12 c-md-4">
   <nav class="items long">
     <ul>
      <li>
        <a class="item f" href="<?php echo \dash\url::this(). '/coding'; ?>">
          <img class="bg-gray-100 hover:bg-gray-200 p-2" src="<?php echo \dash\utility\icon::url('code'); ?>">
          <div class="key"><?php echo T_('Accounting Coding');?></div>
          <div class="value"><?php echo \dash\fit::number(a($dashboardDetail, 'count_all_coding')) ?></div>
          <div class="go"></div>
        </a>
      </li>
      <li>
        <a class="item f" href="<?php echo \dash\url::this(). '/year'; ?>">
          <img class="bg-gray-100 hover:bg-gray-200 p-2" src="<?php echo \dash\utility\icon::url('archive'); ?>">
          <div class="key"><?php echo T_('Accounting Year');?></div>
          <div class="value"><?php echo \dash\fit::number(a($dashboardDetail, 'count_all_year')) ?></div>
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
          <div class="value"><?php echo \dash\fit::number(a($dashboardDetail, 'count_all_doc')) ?></div>
          <div class="go"></div>
        </a>
      </li>
      <li>
        <a class="item f" href="<?php echo \dash\url::this(). '/doc/add'; ?>">
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
      <li>
        <a class="item f" href="<?php echo \dash\url::this(). '/turnover?123'; ?>">
          <img class="bg-gray-100 hover:bg-gray-200 p-2" src="<?php echo \dash\utility\icon::url('Exchange'); ?>">
          <div class="key"><?php echo T_('Petty Cash Turnover');?></div>
          <div class="go"></div>
        </a>
      </li>
     </ul>
   </nav>


   <nav class="items long">
     <ul>
      <li>
        <a class="item f" href="<?php echo \dash\url::this(). '/factor?template=cost'; ?>">
          <img class="bg-gray-100 hover:bg-gray-200 p-2" src="<?php echo \dash\utility\icon::url('Point Of Sale'); ?>">
          <div class="key"><?php echo T_("Cost purchases") ?></div>
          <div class="value"><?php echo \dash\fit::number(a($dashboardDetail, 'factor_type', 'cost')) ?></div>
          <div class="go"></div>
        </a>
      </li>
      <li>
        <a class="item f" href="<?php echo \dash\url::this(). '/factor?template=asset'; ?>">
          <img class="bg-gray-100 hover:bg-gray-200 p-2" src="<?php echo \dash\utility\icon::url('capital'); ?>">
          <div class="key"><?php echo T_("Buy assets") ?></div>
          <div class="value"><?php echo \dash\fit::number(a($dashboardDetail, 'factor_type', 'asset')) ?></div>
          <div class="go"></div>
        </a>
      </li>
      <li>
        <a class="item f" href="<?php echo \dash\url::this(). '/factor?template=bill'; ?>">
          <img class="bg-gray-100 hover:bg-gray-200 p-2" src="<?php echo \dash\utility\icon::url('Payments'); ?>">
          <div class="key"><?php echo T_("Payment bills") ?></div>
          <div class="value"><?php echo \dash\fit::number(a($dashboardDetail, 'factor_type', 'bill')) ?></div>
          <div class="go"></div>
        </a>
      </li>
     </ul>
   </nav>

   <nav class="items long">
     <ul>
      <li>
        <a class="item f" href="<?php echo \dash\url::this(). '/factor?template=income'; ?>">
          <img class="bg-gray-100 hover:bg-gray-200 p-2" src="<?php echo \dash\utility\icon::url('Managed Store'); ?>">
          <div class="key"><?php echo T_("Revenues and sales invoices") ?></div>
          <div class="value"><?php echo \dash\fit::number(a($dashboardDetail, 'factor_type', 'income')) ?></div>
          <div class="go"></div>
        </a>
      </li>
     </ul>
   </nav>

   <nav class="items long">
     <ul>
      <li>
        <a class="item f" href="<?php echo \dash\url::this(). '/factor?template=petty_cash'; ?>">
          <img class="bg-gray-100 hover:bg-gray-200 p-2" src="<?php echo \dash\utility\icon::url('Bank'); ?>">
          <div class="key"><?php echo T_("Charge Petty Cash from bank") ?></div>
          <div class="value"><?php echo \dash\fit::number(a($dashboardDetail, 'factor_type', 'petty_cash')) ?></div>
          <div class="go"></div>
        </a>
      </li>
      <li>
        <a class="item f" href="<?php echo \dash\url::this(). '/factor?template=partner'; ?>">
          <img class="bg-gray-100 hover:bg-gray-200 p-2" src="<?php echo \dash\utility\icon::url('Incoming'); ?>">
          <div class="key"><?php echo T_("Charge Petty Cash from partners") ?></div>
          <div class="value"><?php echo \dash\fit::number(a($dashboardDetail, 'factor_type', 'partner')) ?></div>
          <div class="go"></div>
        </a>
      </li>
     </ul>
   </nav>

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
