<?php
$myData = \dash\data::dashboardDetail();
?>

<section class="f">
  <div class="c pRa10">
    <a href="" class="stat">
      <h3><?php echo T_("Sale Count - Today");?></h3>
      <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'sale_count_today'));?></div>
    </a>
  </div>
  <div class="c pRa10">
    <a href="" class="stat">
      <h3><?php echo T_("Sale Count - Yesterday");?></h3>
      <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'sale_count_yesterday'));?></div>
    </a>
  </div>
  <div class="c pRa10">
    <a href="" class="stat">
      <h3><?php echo T_("Sale Count - Last Week");?></h3>
      <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'sale_count_last_week'));?></div>
    </a>
  </div>
  <div class="c pRa10">
    <a href="" class="stat">
      <h3><?php echo T_("Sale Count - Last Month");?></h3>
      <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'sale_count_last_month'));?></div>
    </a>
  </div>
  <div class="c3 s12">
    <a href="" class="stat">
      <h3><?php echo T_("Sale Count - Total");?></h3>
      <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'sale_count_total'));?></div>
    </a>
  </div>
</section>

<section class="f">
  <div class="c9 s12 pRa10">
    <div id="chartdivdomain" class="box chart x210" data-hint1='Domain buy & renew & transfer & whois & total buy in lasy 30 days'></div>
  </div>
  <div class="c3 s12">
    <a href="<?php echo \dash\url::this(). '/buyers'; ?>" class="stat">
      <h3><?php echo T_("Total Buyers");?></h3>
      <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'total_buyers'));?></div>
    </a>
    <a href="" class="stat">
      <h3><?php echo T_("Total Log");?></h3>
      <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'total_log'));?></div>
    </a>
  </div>
</section>




<section class="f">
  <div class="c3 s6 pRa10">
    <a href="<?php echo \dash\url::this() ?>/billing?action=register" class="stat">
      <h3><?php echo T_("Total Domain Buy");?></h3>
      <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'total_domain_buy'));?></div>
    </a>
  </div>
  <div class="c3 s6 pRa10">
    <a href="<?php echo \dash\url::this() ?>/billing?action=renew" class="stat">
      <h3><?php echo T_("Total Domain Renew");?></h3>
      <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'total_domain_renew'));?></div>
    </a>
  </div>
  <div class="c3 s6 pRa10">
    <a href="<?php echo \dash\url::this() ?>/billing?action=transfer" class="stat">
      <h3><?php echo T_("Total Domain Transfer");?></h3>
      <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'total_domain_transfer'));?></div>
    </a>
  </div>
  <div class="c3 s6">
    <a href="" class="stat">
      <h3><?php echo T_("Total Whois");?></h3>
      <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'total_domain_whois'));?></div>
    </a>
  </div>
</section>


<div id="chartdiv" class="box chart x200"></div>

<div class="f">
  <div class="c3 s12 pRa10">
   <nav class="items">
     <ul>
       <li>
          <a class="f" href="<?php echo \dash\url::this();?>/all">
            <div class="key"><?php echo T_('Domains');?></div>
            <div class="go"></div>
          </a>
       </li>
       <li>
          <a class="f" href="<?php echo \dash\url::this();?>/irnic">
            <div class="key"><?php echo T_('IRNIC handlers');?></div>
            <div class="go"></div>
          </a>
       </li>
       <li>
          <a class="f" href="<?php echo \dash\url::this();?>/polls">
            <div class="key"><?php echo T_('IRNIC Polls');?></div>
            <div class="go"></div>
          </a>
       </li>
     </ul>
   </nav>

  </div>
  <div class="c3 s12 pRa10">
   <nav class="items">
     <ul>
       <li>
          <a class="f" href="<?php echo \dash\url::this();?>/billing">
            <div class="key"><?php echo T_('Payments');?></div>
            <div class="go"></div>
          </a>
       </li>
       <li>
          <a class="f" href="<?php echo \dash\url::this();?>/action">
            <div class="key"><?php echo T_('Domain action');?></div>
            <div class="go"></div>
          </a>
       </li>
     </ul>
   </nav>
  </div>

  <div class="c3 s12 pRa10">
   <nav class="items">
     <ul>
       <li>
          <a class="f" href="<?php echo \dash\url::this();?>/log">
            <div class="key"><?php echo T_('Logs');?></div>
            <div class="go"></div>
          </a>
       </li>

      <li>
          <a class="f" href="<?php echo \dash\url::this();?>/nicdetail">
            <div class="key"><?php echo T_('IRNIC detail');?></div>
            <div class="go"></div>
          </a>
       </li>


       <li>
          <a class="f" href="<?php echo \dash\url::this();?>/fetch?short=1">
            <div class="key"><?php echo T_('Short domains');?></div>
            <div class="go"></div>
          </a>
       </li>
     </ul>
   </nav>
  </div>

  <div class="c3 s12">

   <nav class="items">
     <ul>
       <li>
          <a class="f" href="<?php echo \dash\url::this();?>/domaininfo">
            <div class="key"><?php echo T_('Domain info');?></div>
            <div class="go"></div>
          </a>
       </li>
       <li>
          <a class="f" href="<?php echo \dash\url::this();?>/domainbuy">
            <div class="key"><?php echo T_('Force register domain');?></div>
            <div class="go"></div>
          </a>
       </li>
     </ul>
   </nav>

  </div>
</div>


<div class="hide">
  <div id="chartdomaintitle"><?php echo T_("Domain buy & renew & transfer & whois & total buy in lasy 30 days"); ?></div>
  <div id="chartdomaincategory"><?php echo \dash\get::index($myData, 'domain_action_chart', 'categories'); ?></div>
  <div id="chartdomaincountregister"><?php echo \dash\get::index($myData, 'domain_action_chart', 'register'); ?></div>
  <div id="chartdomaincountrenew"><?php echo \dash\get::index($myData, 'domain_action_chart', 'renew'); ?></div>
  <div id="chartdomaincounttransfer"><?php echo \dash\get::index($myData, 'domain_action_chart', 'transfer'); ?></div>
  <div id="charttitletransfer"><?php echo T_("Transfer"); ?></div>
  <div id="charttitlerenew"><?php echo T_("Renew"); ?></div>
  <div id="charttitleregister"><?php echo T_("Register"); ?></div>

  <div id="charttitlecount"><?php echo T_("Count"); ?></div>

  <div id="chartlogtitle"><?php echo T_("All API request in 60 last days"); ?></div>
  <div id="chartlogcategory"><?php echo \dash\get::index($myData, 'domain_log_chart', 'categories'); ?></div>
  <div id="chartlogcount"><?php echo \dash\get::index($myData, 'domain_log_chart', 'count'); ?></div>
  <div id="charttitlelog"><?php echo T_("Log"); ?></div>


</div>

