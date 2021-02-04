<?php $dashboardDetail = \dash\data::dashboardDetail(); ?>
<div class="row">
  <div class="c-xs-12 c-sm-12 c-md-8">
    <div id="chartdivcmsticket" class="box chart x350 s0" data-abc='crm/tickets'>
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
          <i class="sf-bell"></i>
          <div class="key"><?php echo T_('All notifications');?></div>
          <div class="value"><?php echo \dash\fit::number(a($dashboardDetail, 'sms')); ?></div>
          <div class="go search"></div>
        </a>
      </li>
     </ul>
   </nav>

   <nav class="items long">
     <ul>
       <li>
        <a class="item f" href="<?php echo \dash\url::this();?>/send">
          <i class="sf-out"></i>
          <div class="key"><?php echo T_('Send notifications');?></div>
          <div class="go"></div>
        </a>
      </li>

      <li>
        <a class="item f" href="<?php echo \dash\url::this();?>/sendgroup">
          <i class="sf-users"></i>
          <div class="key"><?php echo T_('Send group notifications');?></div>
          <div class="go"></div>
        </a>
      </li>
     </ul>
   </nav>



  </div>
</div>

</div>
