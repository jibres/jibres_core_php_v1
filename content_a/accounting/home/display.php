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
          <div class="go"></div>
        </a>
      </li>
      <li>
        <a class="item f" href="<?php echo \dash\url::this(). '/factor?template=asset'; ?>">
          <img class="bg-gray-100 hover:bg-gray-200 p-2" src="<?php echo \dash\utility\icon::url('capital'); ?>">
          <div class="key"><?php echo T_("Buy assets") ?></div>
          <div class="go"></div>
        </a>
      </li>
      <li>
        <a class="item f" href="<?php echo \dash\url::this(). '/factor?template=bill'; ?>">
          <img class="bg-gray-100 hover:bg-gray-200 p-2" src="<?php echo \dash\utility\icon::url('Payments'); ?>">
          <div class="key"><?php echo T_("Payment bills") ?></div>
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
          <div class="go"></div>
        </a>
      </li>
      <li>
        <a class="item f" href="<?php echo \dash\url::this(). '/factor?template=partner'; ?>">
          <img class="bg-gray-100 hover:bg-gray-200 p-2" src="<?php echo \dash\utility\icon::url('Incoming'); ?>">
          <div class="key"><?php echo T_("Charge Petty Cash from partners") ?></div>
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
