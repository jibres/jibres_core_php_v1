<?php $myData = \dash\data::dashboardDetail(); ?>

<?php require_once(root. 'content_my/changeDomanPriceAlert.php'); ?>


<div class="f">
  <div class="c9 s12 pRa10">
    <section class="box domainQuickBuy s0">
      <h3><a class="leading-loose font-bold text-xl" href="<?php echo \dash\url::this() ?>/buy"><?php echo T_("Search for your dream domain"); ?></a></h3>
      <p class="leading-loose mb-4"><?php echo T_("Every website start with a great domain name"); ?></p>
      <form method="get" action="<?php echo \dash\url::here(); ?>/domain/buy" autocomplete='off' data-timeout="0">
        <div class="input">
          <input type="search" name="q" autocomplete="off" maxlength="65" placeholder='<?php echo T_('Enter your idea for domain name') ?>'>
          <button class="addon btn-warning"><?php echo T_("Register Domain"); ?></button>
        </div>
      </form>
    </section>
    <section class="row">
      <div class="c">
        <a href="<?php echo \dash\url::this() ?>/payments" class="stat x70">
          <h3><?php echo T_("Total Payments");?> <small>(<?php echo \lib\currency::unit(); ?>)</small></h3>
          <div class="val"><?php echo \dash\fit::number(a($myData, 'total_payment'));?></div>
        </a>
      </div>
      <div class="c">
        <a href="<?php echo \dash\url::kingdom(); ?>/account/billing?from=domain" class="stat x70<?php if(a($myData, 'user_budget')>0) echo " green"; ?>">
          <h3><?php echo T_("Your Current Balance");?> <small>(<?php echo \lib\currency::unit(); ?>)</small></h3>
          <div class="val"><?php echo \dash\fit::number(a($myData, 'user_budget'));?></div>
        </a>
      </div>
    </section>
    <section class="row">
      <div class="c">
        <a href="<?php echo \dash\url::this() ?>/search?expireat=week" class="stat x70">
          <h3><?php echo T_("Expire in next week");?></h3>
          <div class="val"><?php echo \dash\fit::number(a($myData, 'expire_week'));?></div>
        </a>
      </div>
      <div class="c">
        <a href="<?php echo \dash\url::this() ?>/search?expireat=month" class="stat x70">
          <h3><?php echo T_("Expire in next month");?></h3>
          <div class="val"><?php echo \dash\fit::number(a($myData, 'expire_month'));?></div>
        </a>
      </div>
      <div class="c">
        <a href="<?php echo \dash\url::this() ?>/search?expireat=year" class="stat x70">
          <h3><?php echo T_("Expire in next year");?></h3>
          <div class="val"><?php echo \dash\fit::number(a($myData, 'expire_year'));?></div>
        </a>
      </div>
    </section>
    <section class="row s0">
      <div class="c">
        <a href="<?php echo \dash\url::this() ?>/search?autorenew=on" class="circularChartBox">
          <?php $myPercent=a($myData, 'domain_autorenew_percent');$myPercentTitle=a($myData, 'domain_autorenew_percent_title'); $myColor='auto';include core.'layout/elements/circularChart.php';?>
          <h3><?php echo T_("Domain with Auto Renew");?></h3>
        </a>
      </div>
      <div class="c">
        <a href="<?php echo \dash\url::this() ?>/search?lock=on" class="circularChartBox">
          <?php $myPercent=a($myData, 'domain_lock_percent');$myPercentTitle=a($myData, 'domain_lock_percent_title'); $myColor='auto';include core.'layout/elements/circularChart.php';?>
          <h3><?php echo T_("Domain Locked");?></h3>
        </a>
      </div>
      <div class="c">
        <a href="<?php echo \dash\url::this() ?>/search" class="circularChartBox">
          <?php $myPercent=a($myData, 'domain_active_percent');$myPercentTitle=a($myData, 'domain_active_percent_title'); $myColor='auto';include core.'layout/elements/circularChart.php';?>
          <h3><?php echo T_("Active domain");?></h3>
        </a>
      </div>
    </section>
  </div>
  <div class="c3 s12">
    <nav class="items long">
      <ul>
        <li>
          <a class="f" href="<?php echo \dash\url::this();?>/search">
            <div class="key"><?php echo T_('My Domains');?></div>
            <div class="go next"></div>
          </a>
        </li>
        <li>
          <a class="f" href="<?php echo \dash\url::this();?>/other">
            <div class="key"><?php echo T_('Other domain');?></div>
            <div class="go next"></div>
          </a>
        </li>
      </ul>
    </nav>
    <nav class="items long">
      <ul>
        <li>
          <a class="f" href="<?php echo \dash\url::this();?>/buy">
            <div class="key"><?php echo T_('Buy domain');?></div>
            <div class="go next"></div>
          </a>
        </li>
        <li>
          <a class="f" href="<?php echo \dash\url::this();?>/renew">
            <div class="key"><?php echo T_('Renew domain');?></div>
            <div class="go next"></div>
          </a>
        </li>
        <li>
          <a class="f" href="<?php echo \dash\url::this();?>/transfer">
            <div class="key"><?php echo T_('Transfer domain');?></div>
            <div class="go next"></div>
          </a>
        </li>
        <li class="item">
          <a class="f" href="<?php echo \dash\url::this();?>/short">
            <div class="key"><?php echo T_('Buy 3 letter domains');?></div>
            <div class="go next"></div>
          </a>
        </li>
      </ul>
    </nav>
    <nav class="items long">
      <ul>
        <li>
          <a class="f" href="<?php echo \dash\url::this();?>/option">
            <div class="key"><?php echo T_('Settings');?></div>
            <div class="go next"></div>
          </a>
        </li>
      </ul>
    </nav>
    <nav class="items long">
      <ul>
        <li>
          <a class="f" href="<?php echo \dash\url::this();?>/payments">
            <div class="key"><?php echo T_('Payments History');?></div>
            <div class="go next"></div>
          </a>
        </li>
        <li>
          <a class="f" href="<?php echo \dash\url::this();?>/history">
            <div class="key"><?php echo T_('Last Activities');?></div>
            <div class="go next"></div>
          </a>
        </li>
        <li>
          <a class="f" href="<?php echo \dash\url::this();?>/predict">
            <div class="key"><?php echo T_('Predict Late Payments');?></div>
            <div class="go next"></div>
          </a>
        </li>
      </ul>
    </nav>
    <nav class="items long s0">
      <ul>
        <li>
          <a class="f" target="_blank" href="<?php echo \dash\url::api('developers');?>/docs">
            <div class="key"><?php echo T_('Domain API');?></div>
            <div class="go next"></div>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</div>