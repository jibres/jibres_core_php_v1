<?php $dashboardDetail = \dash\data::dashboardDetail(); ?>
<div class="row">
  <div class="c-xs-12 c-sm-12 c-md-8">
    <div id="chartdiv" class="box chart x310" data-abc='crm/homepage'></div>
  </div>
  <div class="c-xs-12 c-sm-12 c-md-4">
    <nav class="items long">
     <ul>

       <li>
        <a class="item f" href="<?php echo \dash\url::here();?>/member">
          <div class="key"><?php echo T_('Customers');?></div>
          <div class="value"><?php echo \dash\fit::number(\dash\get::index($dashboardDetail, 'users')); ?></div>
          <div class="go"></div>
        </a>
      </li>

       <li>
        <a class="item f" href="<?php echo \dash\url::here();?>/member">
          <div class="key"><?php echo T_('Buyers');?></div>
          <div class="go"></div>
        </a>
      </li>

     </ul>
   </nav>

     <nav class="items long">
     <ul>

       <li>
        <a class="item f" href="<?php echo \dash\url::here();?>/permission">
          <div class="key"><?php echo T_('Permissions');?></div>
          <div class="value"><?php echo \dash\fit::number(\dash\get::index($dashboardDetail, 'permissions')); ?></div>
          <div class="go"></div>
        </a>
      </li>

       <li>
        <a class="item f" href="<?php echo \dash\url::here();?>/member?permission">
          <div class="key"><?php echo T_('User have permission');?></div>
          <div class="go"></div>
        </a>
      </li>


     </ul>
   </nav>


   <nav class="items long">
     <ul>

       <li>
        <a class="item f" href="<?php echo \dash\url::here();?>/transactions">
          <div class="key"><?php echo T_('Transactions');?></div>
          <div class="value"><?php echo \dash\fit::number(\dash\get::index($dashboardDetail, 'transactions')); ?></div>
          <div class="go"></div>
        </a>
      </li>

       <li>
        <a class="item f" href="<?php echo \dash\url::here();?>/transactions">
          <div class="key"><?php echo T_('Success transaction');?></div>
          <div class="go"></div>
        </a>
      </li>


     </ul>
   </nav>

   <nav class="items long">
     <ul>

       <li>
        <a class="item f" href="<?php echo \dash\url::here();?>/log">
          <div class="key"><?php echo T_('Logs');?></div>
          <div class="go"></div>
        </a>
      </li>

     </ul>
   </nav>

  </div>
</div>

<section class="row">
 <div class="c-xs-12 c-sm-6 c-md-4">
  <a href="<?php echo \dash\url::this() ?>/search?" class="circularChartBox">
   <?php $myPercent= \dash\get::index($dashboardDetail, 'success_percent', 'today');$myColor='auto';include core.'layout/elements/circularChart.php';?>
   <h3><?php echo T_("Success transactions today");?></h3>
  </a>
 </div>
 <div class="c-xs-12 c-sm-6 c-md-4">
  <a href="<?php echo \dash\url::this() ?>/search?" class="circularChartBox">
   <?php $myPercent= \dash\get::index($dashboardDetail, 'success_percent', 'month');$myColor='auto';include core.'layout/elements/circularChart.php';?>
   <h3><?php echo T_("Success transactions in month");?></h3>
  </a>
 </div>

 <div class="c-xs-12 c-sm-12 c-md-4">
  <a href="<?php echo \dash\url::this() ?>/search?" class="circularChartBox">
   <?php $myPercent= \dash\get::index($dashboardDetail, 'success_percent', 'all');$myColor='auto';include core.'layout/elements/circularChart.php';?>
   <h3><?php echo T_("Total Success transactions percent");?></h3>
  </a>
 </div>
</section>

<div class="row">
  <?php if(\dash\data::dashboardDetail_latestMember()) {?>
  <div class="c-xs-12 c-sm-6 c-md-6">
    <label><?php echo T_("Last customers") ?></label>
    <nav class="items long">
       <ul>
  <?php foreach (\dash\data::dashboardDetail_latestMember() as $key => $value) {?>
         <li>
          <a class="item f" href="<?php echo \dash\url::here(); ?>/member/glance?id=<?php echo $value['id']; ?>">
            <div class="key"><?php if(isset($value['displayname']) && $value['displayname']) { echo $value['displayname']; }else{ echo T_("Without name");} ?></div>
            <div class="value"><?php echo \dash\fit::date_human($value['datecreated']); ?></div>
          </a>
        </li>
  <?php } //endfor ?>
       </ul>
     </nav>

  </div>
<?php } //endif ?>

  <div class="c-xs-12 c-sm-6 c-md-6">
    <?php if(\dash\data::dashboardDetail_latestLogs()) {?>

    <label><?php echo T_("Last login") ?></label>
    <nav class="items long">
       <ul>
  <?php foreach (\dash\data::dashboardDetail_latestLogs() as $key => $value) { ?>
         <li>
          <a class="item f">
            <div class="key"><?php if(isset($value['displayname']) && $value['displayname']) { echo $value['displayname']; }else{ echo T_("Without name");} ?></div>
            <div class="value"><?php echo \dash\fit::date_human($value['datecreated']); ?></div>
          </a>
        </li>
  <?php } //endfor ?>
       </ul>
     </nav>

  </div>
<?php } //endif ?>
</div>

<div class="hide">



<div id="charttitleunit"><?php echo T_("Count") ?></div>
<div id="chartverifytitle"><?php echo T_("Success transactions") ?></div>
<div id="chartunverifytitle"><?php echo T_("Unsuccess transactions") ?></div>

  <div id="charttitle"><?php echo T_("Chart transactions per day in last 3 month") ?></div>
  <div id="chartcategory"><?php echo \dash\get::index($dashboardDetail, 'chart', 'category') ?></div>
  <div id="chartverify"><?php echo \dash\get::index($dashboardDetail, 'chart', 'verify') ?></div>
  <div id="chartunverify"><?php echo \dash\get::index($dashboardDetail, 'chart', 'unverify') ?></div>
</div>