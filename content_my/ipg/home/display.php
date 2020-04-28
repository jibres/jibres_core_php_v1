<?php require_once(root. 'content_my/ipg/setupGuide.php'); ?>

<?php $myData = \dash\data::dashboardDetail(); ?>


<div class="f">
  <div class="c9 s12 pRa10">

    <section class="f">
      <div class="c s12 pRa10">
        <a href="<?php echo \dash\url::this() ?>/gateway" class="stat">
          <h3><?php echo T_("Gateways");?></h3>
          <div class="val"><?php echo \dash\fit::stats(5);?></div>
        </a>
      </div>
      <div class="c s6 pRa10">
        <a href="<?php echo \dash\url::this(). '/wallet'; ?>" class="stat">
          <h3><?php echo T_("Wallet");?></h3>
          <div class="val"><?php echo \dash\fit::stats(8);?></div>
        </a>
      </div>
      <div class="c s6">
        <a href="<?php echo \dash\url::this(). '/iban'; ?>" class="stat">
          <h3><?php echo T_("IBAN");?></h3>
          <div class="val"><?php echo \dash\fit::stats(2);?></div>
        </a>
      </div>
    </section>

    <div id="chartdiv" class="box chart x210" ></div>

    <section class="f">
      <div class="c pRa10">
        <a href="<?php echo \dash\url::this() ?>/payments" class="stat">
          <h3><?php echo T_("Total Payments");?></h3>
          <div class="val"><?php echo \dash\fit::number(rand(5000, 500000));?></div>
        </a>
      </div>

      <div class="c pRa10">
        <a href="<?php echo \dash\url::this() ?>/payments?time=365" class="stat">
          <h3><?php echo T_("Last Year Payments");?></h3>
          <div class="val"><?php echo \dash\fit::number(rand(5000, 500000));?></div>
        </a>
      </div>

      <div class="c pRa10">
        <a href="<?php echo \dash\url::kindgom() ?>/account/billing?from=domain" class="stat">
          <h3><?php echo T_("Your Current Balance");?></h3>
          <div class="val"><?php echo \dash\fit::number(rand(5000, 500000));?></div>
        </a>
      </div>

      <div class="c">
        <a href="<?php echo \dash\url::this() ?>/predict" class="stat">
          <h3><?php echo T_("Total settlement");?></h3>
          <div class="val"><?php echo \dash\fit::number(rand(5000, 500000));?></div>
        </a>
      </div>
    </section>

  </div>


  <div class="c3 s12">




    <nav class="items">
      <ul>
        <li>
          <a class="f" href="<?php echo \dash\url::this();?>/payments">
            <div class="key"><?php echo T_('Payments');?></div>
            <div class="go next"></div>
          </a>
        </li>
        <li>
          <a class="f" href="<?php echo \dash\url::this();?>/history">
            <div class="key"><?php echo T_('Payments history');?></div>
            <div class="go next"></div>
          </a>
        </li>
        <li>
          <a class="f" href="<?php echo \dash\url::this();?>/settlement">
            <div class="key"><?php echo T_('Settlement');?></div>
            <div class="go next"></div>
          </a>
        </li>
      </ul>
    </nav>

    <nav class="items">
      <ul>
        <li>
          <a class="f" href="<?php echo \dash\url::this();?>/profile">
            <div class="key"><?php echo T_('Profile');?></div>
            <div class="go next"></div>
          </a>
        </li>
      </ul>
    </nav>

    <nav class="items">
      <ul>
        <li>
          <a class="f" target="_blank" href="<?php echo \dash\url::api('developers');?>/docs">
            <div class="key"><?php echo T_('IPG API');?></div>
            <div class="go next"></div>
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
