<?php $myData = \dash\data::dashboardDetail(); ?>



<?php if(\dash\data::paymentVerifyMsg()) {?>
<div class="msg txtC <?php if(\dash\data::paymentVerifyMsgTrue()) {echo 'success';}else{ echo 'danger';}?>"><?php echo \dash\data::paymentVerifyMsg() ?></div>
<?php } //endif ?>








  <div class="f">
   <div class="c9 s12 pRa10">

    <section class="f">
     <div class="c s12 pRa10">
      <a href="<?php echo \dash\url::this() ?>/search" class="stat">
       <h3><?php echo T_("Your Domains");?></h3>
       <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'my_domain'));?></div>
      </a>
     </div>
     <div class="c s6 pRa10">
      <a href="<?php if(!\dash\get::index($myData, 'maybe_my_domain')){ echo \dash\url::this(). '/renew'; }else{ echo \dash\url::this(). '/search?list=renew'; } ?>" class="stat">
       <h3><?php echo T_("Renew Domains");?></h3>
       <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'maybe_my_domain'));?></div>
      </a>
     </div>
     <div class="c s6">
      <a href="<?php if(!\dash\get::index($myData, 'available_domain')){ echo \dash\url::this(). '/buy'; }else{ echo \dash\url::this(). '/search?list=available'; } ?>" class="stat">
       <h3><?php echo T_("Available domains");?></h3>
       <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'available_domain'));?></div>
      </a>
     </div>
    </section>

    <div id="chartdiv" class="box chart x210" ></div>




    <section class="f s0">
     <div class="c pRa10">
      <a href="<?php echo \dash\url::this() ?>/search?" class="circularChartBox">
       <?php $myPercent=\dash\get::index($myData, 'domain_autorenew_percent');$myColor='auto';include core.'layout/elements/circularChart.php';?>
       <h3><?php echo T_("Domain with Auto Renew");?></h3>
      </a>
     </div>
     <div class="c pRa10">
      <a href="<?php echo \dash\url::this() ?>/search?" class="circularChartBox">
       <?php $myPercent=\dash\get::index($myData, 'domain_lock_percent');$myColor='auto';include core.'layout/elements/circularChart.php';?>
       <h3><?php echo T_("Domain Locked");?></h3>
      </a>
     </div>

     <div class="c">
      <a href="<?php echo \dash\url::this() ?>/search?" class="circularChartBox">
       <?php $myPercent=\dash\get::index($myData, 'domain_active_percent');$myColor='auto';include core.'layout/elements/circularChart.php';?>
       <h3><?php echo T_("Active domain");?></h3>
      </a>
     </div>
   </section>






    <section class="f">
     <div class="c pRa10">
      <a href="<?php echo \dash\url::this() ?>/payments" class="stat">
       <h3><?php echo T_("Total Payments");?></h3>
       <div class="val"><?php echo \dash\fit::number(\dash\get::index($myData, 'total_payment'));?></div>
      </a>
     </div>

     <div class="c pRa10">
      <a href="<?php echo \dash\url::this() ?>/payments?time=365" class="stat">
       <h3><?php echo T_("Last Year Payments");?></h3>
       <div class="val"><?php echo \dash\fit::number(\dash\get::index($myData, 'last_year_payment'));?></div>
      </a>
     </div>

     <div class="c pRa10">
      <a href="<?php echo \dash\url::kindgom() ?>/account/billing?from=domain" class="stat">
       <h3><?php echo T_("Your Current Balance");?></h3>
       <div class="val"><?php echo \dash\fit::number(\dash\get::index($myData, 'user_budget'));?></div>
      </a>
     </div>

     <div class="c">
      <a href="<?php echo \dash\url::this() ?>/predict" class="stat">
       <h3><?php echo T_("Predict Late Payments");?></h3>
       <div class="val"><?php echo \dash\fit::number(\dash\get::index($myData, 'predict_late_payment'));?></div>
      </a>
     </div>
    </section>

   </div>


   <div class="c3 s12">

    <nav class="items">
     <ul>
      <li>
       <a class="f" href="<?php echo \dash\url::this();?>/search">
        <div class="key"><?php echo T_('My Domains');?></div>
        <div class="go"></div>
       </a>
      </li>
     </ul>
    </nav>

    <nav class="items">
     <ul>
      <li>
       <a class="f" href="<?php echo \dash\url::this();?>/buy">
        <div class="key"><?php echo T_('Buy domain');?></div>
        <div class="go"></div>
       </a>
      </li>
      <li>
       <a class="f" href="<?php echo \dash\url::this();?>/renew">
        <div class="key"><?php echo T_('Renew domain');?></div>
        <div class="go"></div>
       </a>
      </li>
      <li>
       <a class="f" href="<?php echo \dash\url::this();?>/transfer">
        <div class="key"><?php echo T_('Transfer domain');?></div>
        <div class="go"></div>
       </a>
      </li>
      <li>
       <a class="f" href="<?php echo \dash\url::this();?>/short">
        <div class="key"><?php echo T_('Buy Short domains');?></div>
        <div class="go"></div>
       </a>
      </li>
     </ul>
    </nav>

    <nav class="items">
     <ul>
      <li>
       <a class="f" href="<?php echo \dash\url::this();?>/option">
        <div class="key"><?php echo T_('Settings');?></div>
        <div class="go"></div>
       </a>
      </li>
     </ul>
    </nav>

    <nav class="items">
     <ul>
      <li>
       <a class="f" href="<?php echo \dash\url::this();?>/payments">
        <div class="key"><?php echo T_('Payments History');?></div>
        <div class="go"></div>
       </a>
      </li>
      <li>
       <a class="f" href="<?php echo \dash\url::this();?>/history">
        <div class="key"><?php echo T_('Last Activities');?></div>
        <div class="go"></div>
       </a>
      </li>
      <li>
       <a class="f" href="<?php echo \dash\url::this();?>/predict">
        <div class="key"><?php echo T_('Predict Late Payments');?></div>
        <div class="go"></div>
       </a>
      </li>
     </ul>
    </nav>

    <nav class="items">
     <ul>
      <li>
       <a class="f" target="_blank" href="<?php echo \dash\url::api('developers');?>/docs">
        <div class="key"><?php echo T_('Doamin API');?></div>
        <div class="go"></div>
       </a>
      </li>
      <li>
       <a class="f" >
        <div class="key"><?php echo T_('Build for Developers ;)');?></div>
       </a>
      </li>
     </ul>
    </nav>
   </div>
  </div>


<div class="hide">
  <div id="charttitle"><?php echo T_("Total pay per day"); ?></div>
  <div id="chartcategory"><?php echo \dash\get::index(\dash\data::dashboardDetail(), 'domain_pay_chart', 'categories'); ?></div>
  <div id="chartprice"><?php echo \dash\get::index(\dash\data::dashboardDetail(), 'domain_pay_chart', 'price'); ?></div>
  <div id="charttitleprice"><?php echo T_("Toman"); ?></div>
  <div id="charttitlepayed"><?php echo T_("Payed"); ?></div>

</div>
