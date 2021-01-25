<?php $dashboardDetail = \dash\data::dashboardDetail(); ?>
<div class="row">
  <div class="c-xs-12 c-sm-12 c-md-8">
    <div id="chartdivcmsticket" class="box chart x310 s0" data-abc='crm/tickets'>
      <div class="hide">
        <div id="charttitleunit"><?php echo T_("Count") ?></div>
        <div id="charttickettitle"><?php echo T_("Ticket") ?></div>
        <div id="chartmessagetitle"><?php echo T_("Message") ?></div>

        <div id="charttitle"><?php echo T_("Thicket and message in last years") ?></div>
        <div id="chartcategory"><?php echo a($dashboardDetail, 'chart', 'category') ?></div>
        <div id="chartdataticket"><?php echo a($dashboardDetail, 'chart', 'dataticket') ?></div>
        <div id="chartdatamessage"><?php echo a($dashboardDetail, 'chart', 'datamessage') ?></div>
      </div>
    </div>

  </div>
  <div class="c-xs-12 c-sm-12 c-md-4">
    <nav class="items long">
     <ul>
       <li>
        <a class="item f" href="<?php echo \dash\url::this();?>/datalist">
          <i class="sf-heart-o"></i>
          <div class="key"><?php echo T_('All tickets');?></div>
          <div class="value"><?php echo \dash\fit::number(a($dashboardDetail, 'tickets')); ?></div>
          <div class="go search"></div>
        </a>
      </li>
       <li>
        <a class="item f" href="<?php echo \dash\url::this();?>/add">
          <i class="sf-asterisk"></i>
          <div class="key"><?php echo T_('Add new ticket');?></div>
          <div class="go plus"></div>
        </a>
      </li>
     </ul>
   </nav>

   <nav class="items long">
     <ul>
      <li>
       <a class="item f" href="<?php echo \dash\url::this();?>/datalist?status=awaiting">
        <i class="sf-spin-alt fc-hot"></i>
        <div class="key"><?php echo T_('Awaiting answer');?></div>
        <div class="value txtB"><?php echo \dash\fit::number(a($dashboardDetail, 'awaiting')); ?></div>
        <div class="go"></div>
       </a>
      </li>
       <li>
       <a class="item f" href="<?php echo \dash\url::this();?>/datalist?status=close">
        <i class="sf-archive"></i>
        <div class="key"><?php echo T_('Closed tickets');?></div>
        <div class="value"><?php echo \dash\fit::number(a($dashboardDetail, 'close')); ?></div>
        <div class="go"></div>
       </a>
      </li>
     </ul>
   </nav>

   <nav class="items long">
     <ul>
      <li>
       <a class="item f" href="<?php echo \dash\url::this();?>/datalist?so=y">
        <i class="sf-check"></i>
        <div class="key"><?php echo T_('Solved tickets');?></div>
        <div class="value"><?php echo \dash\fit::number(a($dashboardDetail, 'solved')); ?></div>
        <div class="go"></div>
       </a>
      </li>
       <li>
       <a class="item f" href="<?php echo \dash\url::this();?>/datalist?so=n">
        <i class="sf-exclamation-triangle"></i>
        <div class="key"><?php echo T_('Unsolved tickets');?></div>
        <div class="value"><?php echo \dash\fit::number(a($dashboardDetail, 'unsolved')); ?></div>
        <div class="go"></div>
       </a>
      </li>
     </ul>
   </nav>



   <nav class="items long">
     <ul>
      <li>
       <a class="item f" href="<?php echo \dash\url::this();?>/message">
        <i class="sf-align-left"></i>
        <div class="key"><?php echo T_('All messages');?></div>
        <div class="value"><?php echo \dash\fit::number(a($dashboardDetail, 'message')); ?></div>
        <div class="go"></div>
       </a>
      </li>
     </ul>
   </nav>


  </div>
</div>

</div>
