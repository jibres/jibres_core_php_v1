<?php $dashboardDetail = \dash\data::dashboardDetail(); ?>
<div class="row">
  <div class="c-xs-12 c-sm-12 c-md-8">
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

    <section class="row">
     <div class="c-xs-0 c-sm-4 c-md-4">
      <a href="<?php echo \dash\url::this() ?>/transactions/report" class="circularChartBox">
       <?php $myPercent= a($dashboardDetail, 'success_percent', 'today');$myColor='auto';include core.'layout/elements/circularChart.php';?>
       <h3><?php echo T_("Success Payments - Today");?></h3>
      </a>
     </div>
     <div class="c-xs-6 c-sm-4 c-md-4">
      <a href="<?php echo \dash\url::this() ?>/transactions/report" class="circularChartBox">
       <?php $myPercent= a($dashboardDetail, 'success_percent', 'month');$myColor='auto';include core.'layout/elements/circularChart.php';?>
       <h3><?php echo T_("Success Payments - This month");?></h3>
      </a>
     </div>

     <div class="c-xs-6 c-sm-4 c-md-4">
      <a href="<?php echo \dash\url::this() ?>/transactions/report" class="circularChartBox">
       <?php $myPercent= a($dashboardDetail, 'success_percent', 'all');$myColor='auto';include core.'layout/elements/circularChart.php';?>
       <h3><?php echo T_("Total Success transactions percent");?></h3>
      </a>
     </div>
    </section>

  </div>
  <div class="c-xs-12 c-sm-12 c-md-4">
    <nav class="items long">
     <ul>
       <li>
        <a class="item f" href="<?php echo \dash\url::here();?>/member">
          <?php echo \dash\utility\icon::svg('Customers'); ?>
          <div class="key"><?php echo T_('Customers');?></div>
          <div class="value"><?php echo \dash\fit::number(a($dashboardDetail, 'users')); ?></div>
          <div class="go search"></div>
        </a>
      </li>
       <li>
        <a class="item f" href="<?php echo \dash\url::here();?>/member/add">
          <?php echo \dash\utility\icon::svg('Customer Plus'); ?>
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
        <?php echo \dash\utility\icon::svg('profile'); ?>
        <div class="key"><?php echo T_('Staffs');?></div>
        <div class="go"></div>
       </a>
      </li>
       <li>
       <a class="item f" href="<?php echo \dash\url::here();?>/permission">
        <?php echo \dash\utility\icon::svg('lock'); ?>
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
        <a class="item f" href="<?php echo \dash\url::here();?>/transactions?verify=y">
          <?php echo \dash\utility\icon::svg('Capture Payment', 'minor'); ?>
          <div class="key"><?php echo T_('Successful payments');?></div>
          <div class="value"><?php echo \dash\fit::number(a($dashboardDetail, 'transactions')); ?></div>
          <div class="go"></div>
        </a>
      </li>

       <li>
        <a class="item f" href="<?php echo \dash\url::here();?>/transactions">
          <?php echo \dash\utility\icon::svg('Payments'); ?>
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
          <?php echo \dash\utility\icon::svg('Chat'); ?>
          <div class="key"><?php echo T_('Tickets');?></div>
          <div class="value"><?php echo \dash\fit::number(a($dashboardDetail, 'tickets')); ?></div>
          <div class="go"></div>
        </a>
      </li>

       <li>
        <a class="item f" href="<?php echo \dash\url::here();?>/notification">
          <?php echo \dash\utility\icon::svg('Notification'); ?>
          <div class="key"><?php echo T_('Notifications');?></div>
          <div class="go"></div>
        </a>
      </li>


     </ul>
   </nav>

   <nav class="items long">
    <ul>
    <?php if(\dash\permission::check('_group_form')) {?>
      <li><a class="item f" href="<?php echo \dash\url::kingdom(); ?>/a/form">
        <?php echo \dash\utility\icon::svg('Forms'); ?>
        <div class="key"><?php echo T_("Form Builder"); ?></div>
        <div class="go"></div>
      </a></li>
    <?php } //endif ?>
     </ul>
   </nav>

   <nav class="items long">
     <ul>
       <li>
        <a class="item f" href="<?php echo \dash\url::here();?>/sms">
          <?php echo \dash\utility\icon::svg('chat-left-text', 'bootstrap'); ?>
          <div class="key"><?php echo T_('SMS');?></div>
          <div class="go"></div>
        </a>
      </li>
      <li>
        <a class="item f" href="<?php echo \dash\url::here();?>/telegram">
          <?php echo \dash\utility\icon::svg('telegram', 'bootstrap'); ?>
          <div class="key"><?php echo T_('Telegram');?></div>
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

<div class="row font-14 mT5">
  <div class="c-xs-12 c-sm-12 c-md-4">
    <p class="mB5-f font-14"><a class="fc-black" href="<?php echo \dash\url::this(). '/member?sort=datecreated&order=desc' ?>"><?php echo T_("Last customers") ?></a></p>
  <?php if(\dash\data::dashboardDetail_latestMember()) {?>
    <nav class="items long">
       <ul>
  <?php foreach (\dash\data::dashboardDetail_latestMember() as $key => $value) {?>
         <li>
          <a class="item f" href="<?php echo \dash\url::here(); ?>/member/glance?id=<?php echo $value['id']; ?>">
            <img src="<?php echo \dash\fit::img(a($value, 'avatar')); ?>" alt="Avatar - <?php echo a($value, 'displayname'); ?>">
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

  <div class="c-xs-12 c-sm-12 c-md-4">
    <p class="mB5-f font-14"><a class="fc-black" href="<?php echo \dash\url::this(). '/log/enter' ?>"><?php echo T_("Last login") ?></a></p>
    <?php if(\dash\data::dashboardDetail_latestLogs()) {?>
    <nav class="items long">
       <ul>
  <?php foreach (\dash\data::dashboardDetail_latestLogs() as $key => $value) { ?>
         <li>
          <a class="item f" href="<?php echo \dash\url::here(); ?>/member/glance?id=<?php echo \dash\coding::encode($value['from']); ?>">
            <img src="<?php echo \dash\fit::img(a($value, 'avatar')); ?>" alt="Avatar - <?php echo a($value, 'displayname'); ?>">
            <div class="key"><?php if(isset($value['displayname']) && $value['displayname']) { echo $value['displayname']; }else{ echo T_("Without name");} ?></div>
            <div class="value"><?php echo \dash\fit::date_human($value['datecreated']); ?></div>
          </a>
        </li>
  <?php } //endfor ?>
       </ul>
     </nav>
<?php } else { ?>
  <p class="msg"><?php echo T_("No entries have been made so far"); ?></p>
<?php } //endif ?>
  </div>

  <div class="c-xs-12 c-sm-12 c-md-4">
    <p class="mB5-f font-14"><a class="fc-black" href="<?php echo \dash\url::this(). '/ticket/datalist?act=y' ?>"><?php echo T_("Last tickets") ?></a></p>
    <?php if(\dash\data::dashboardDetail_latestTicket()) {?>
    <nav class="items long">
       <ul>
  <?php foreach (\dash\data::dashboardDetail_latestTicket() as $key => $value) { ?>
        <li>
          <a class="f align-center" href="<?php echo \dash\url::here(). '/ticket/view?id='. $value['id'] ?>">
            <img src="<?php echo \dash\fit::img(a($value, 'avatar')); ?>" alt="Avatar - <?php echo a($value, 'displayname'); ?>">
            <div class="key"><?php echo \dash\fit::mobile(a($value, 'displayname')); ?></div>

            <div class="key"><?php echo T_("Ticket"). ' '. \dash\fit::text($value['id']);  ?></div>
            <div class="value"><?php echo \dash\fit::date_human($value['datecreated']); ?></div>
            <div class="go"></div>
          </a>
         </li>
  <?php } //endfor ?>
       </ul>
     </nav>
<?php } else { ?>
  <p class="msg"><?php echo T_("No ticket have been received so far"); ?></p>
<?php } //endif ?>

  </div>

</div>
