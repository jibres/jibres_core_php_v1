<?php $dashboardDetail = \dash\data::dashboardDetail(); ?>
<div class="row">
  <div class="c-xs-12 c-sm-12 c-md-8">
    <div id="chartdivcrmhome" class="box chart x450" data-abc='crm/homepage' data-hint='123'>
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
        <a class="item f" href="<?php echo \dash\url::here();?>/member">
          <i class="sf-users"></i>
          <div class="key"><?php echo T_('Customers');?></div>
          <div class="value"><?php echo \dash\fit::number(a($dashboardDetail, 'users')); ?></div>
          <div class="go search"></div>
        </a>
      </li>
       <li>
        <a class="item f" href="<?php echo \dash\url::here();?>/member/add">
          <i class="sf-user-plus"></i>
          <div class="key"><?php echo T_('Add new Customer');?></div>
          <div class="go plus"></div>
        </a>
      </li>
     </ul>
   </nav>

   <nav class="items long">
     <ul>
      <li>
       <a class="item f" href="<?php echo \dash\url::here();?>/staff">
        <i class="sf-user-close-security"></i>
        <div class="key"><?php echo T_('Staffs');?></div>
        <div class="go"></div>
       </a>
      </li>
       <li>
       <a class="item f" href="<?php echo \dash\url::here();?>/permission">
        <i class="sf-unlock-alt"></i>
        <div class="key"><?php echo T_('Permissions');?></div>
        <div class="value"><?php echo \dash\fit::number(a($dashboardDetail, 'permissions')); ?></div>
        <div class="go"></div>
       </a>
      </li>
     </ul>
   </nav>


   <nav class="items long">
     <ul>

       <li>
        <a class="item f" href="<?php echo \dash\url::here();?>/transactions">
        <i class="sf-money"></i>
          <div class="key"><?php echo T_('Successful payments');?></div>
          <div class="value"><?php echo \dash\fit::number(a($dashboardDetail, 'transactions')); ?></div>
          <div class="go"></div>
        </a>
      </li>

       <li>
        <a class="item f" href="<?php echo \dash\url::here();?>/transactions/all">
        <i class="sf-receipt-shopping-streamline"></i>
          <div class="key"><?php echo T_('All payments');?></div>
          <div class="go"></div>
        </a>
      </li>


     </ul>
   </nav>


   <nav class="items long">
     <ul>

       <li>
        <a class="item f" href="<?php echo \dash\url::here();?>/ticket">
          <i class="sf-chat-alt-fill"></i>
          <div class="key"><?php echo T_('Tickets');?></div>
          <div class="value"><?php echo \dash\fit::number(a($dashboardDetail, 'tickets')); ?></div>
          <div class="go"></div>
        </a>
      </li>

       <li>
        <a class="item f" href="<?php echo \dash\url::here();?>/notification">
          <i class="sf-bell"></i>
          <div class="key"><?php echo T_('Notifications');?></div>
          <div class="go"></div>
        </a>
      </li>


     </ul>
   </nav>

   <nav class="items long">
     <ul>
       <li>
        <a class="item f" href="<?php echo \dash\url::here();?>/sms">
          <i class="sf-envelope"></i>
          <div class="key"><?php echo T_('Sended SMS list');?></div>
          <div class="go"></div>
        </a>
      </li>
       <li>
        <a class="item f" href="<?php echo \dash\url::here();?>/log">
          <i class="sf-camera-surveillance"></i>
          <div class="key"><?php echo T_('Users Action Log');?></div>
          <div class="go"></div>
        </a>
      </li>

     </ul>
   </nav>

  </div>
</div>

<section class="row">
 <div class="c-xs-12 c-sm-6 c-md-4">
  <a href="<?php echo \dash\url::this() ?>/transactions" class="circularChartBox">
   <?php $myPercent= a($dashboardDetail, 'success_percent', 'today');$myColor='auto';include core.'layout/elements/circularChart.php';?>
   <h3><?php echo T_("Success Payments - Today");?></h3>
  </a>
 </div>
 <div class="c-xs-12 c-sm-6 c-md-4">
  <a href="<?php echo \dash\url::this() ?>/transactions" class="circularChartBox">
   <?php $myPercent= a($dashboardDetail, 'success_percent', 'month');$myColor='auto';include core.'layout/elements/circularChart.php';?>
   <h3><?php echo T_("Success Payments - This month");?></h3>
  </a>
 </div>

 <div class="c-xs-12 c-sm-12 c-md-4">
  <a href="<?php echo \dash\url::this() ?>/transactions" class="circularChartBox">
   <?php $myPercent= a($dashboardDetail, 'success_percent', 'all');$myColor='auto';include core.'layout/elements/circularChart.php';?>
   <h3><?php echo T_("Total Success transactions percent");?></h3>
  </a>
 </div>
</section>

<div class="row font-14 mT5">
  <div class="c-xs-12 c-sm-12 c-md-4">
    <p class="mB5-f font-14"><?php echo T_("Last customers") ?></p>
  <?php if(\dash\data::dashboardDetail_latestMember()) {?>
    <nav class="items long">
       <ul>
  <?php foreach (\dash\data::dashboardDetail_latestMember() as $key => $value) {?>
         <li>
          <a class="item f" href="<?php echo \dash\url::here(); ?>/member/glance?id=<?php echo $value['id']; ?>">
            <img src="<?php echo a($value, 'avatar'); ?>" alt="Avatar - <?php echo a($value, 'displayname'); ?>">
            <div class="key"><?php if(isset($value['displayname']) && $value['displayname']) { echo $value['displayname']; }else{ echo T_("Without name");} ?></div>
            <div class="value"><?php echo \dash\fit::date_human($value['datecreated']); ?></div>
          </a>
        </li>
  <?php } //endfor ?>
       </ul>
     </nav>
<?php } else { ?>
  <p class="msg"><?php echo T_("No customers have been registered yet"); ?></p>
<?php } //endif ?>
  </div>

  <div class="c-xs-12 c-sm-6 c-md-4">
    <p class="mB5-f font-14"><?php echo T_("Last login") ?></p>
    <?php if(\dash\data::dashboardDetail_latestLogs()) {?>
    <nav class="items long">
       <ul>
  <?php foreach (\dash\data::dashboardDetail_latestLogs() as $key => $value) { ?>
         <li>
          <a class="item f" href="<?php echo \dash\url::here(); ?>/member/glance?id=<?php echo \dash\coding::encode($value['from']); ?>">
            <img src="<?php echo a($value, 'avatar'); ?>" alt="Avatar - <?php echo a($value, 'displayname'); ?>">
            <div class="key"><?php if(isset($value['displayname']) && $value['displayname']) { echo $value['displayname']; }else{ echo T_("Without name");} ?></div>
            <div class="value"><?php echo \dash\fit::date_human($value['datecreated']); ?></div>
          </a>
        </li>
  <?php } //endfor ?>
       </ul>
     </nav>

  </div>
<?php } else { ?>
  <p class="msg"><?php echo T_("No entries have been made so far"); ?></p>
<?php } //endif ?>

  <div class="c-xs-12 c-sm-6 c-md-4">
    <p class="mB5-f font-14"><?php echo T_("Last tickets") ?></p>
    <?php if(\dash\data::dashboardDetail_latestTicket()) {?>
    <nav class="items long">
       <ul>
  <?php foreach (\dash\data::dashboardDetail_latestTicket() as $key => $value) { ?>
        <li>
          <a class="f align-center" href="<?php echo \dash\url::here(). '/ticket/view?id='. $value['id'] ?>">
            <div class="key"><?php echo T_("Ticket"). ' #'. $value['id'];  ?></div>
            <div class="value s0"><?php echo \dash\fit::mobile(a($value, 'displayname')); ?></div>
            <div class="value txtB s0"><?php echo \dash\fit::mobile(a($value, 'mobile')); ?></div>
            <div class="value"><?php echo \dash\fit::date_human($value['datecreated']); ?></div>
            <div class="go"></div>
          </a>
         </li>
  <?php } //endfor ?>
       </ul>
     </nav>

  </div>
<?php } else { ?>
  <p class="msg"><?php echo T_("No ticket have been received so far"); ?></p>
<?php } //endif ?>

</div>
