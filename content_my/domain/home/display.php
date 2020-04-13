<?php $myData = \dash\data::dashboardDetail(); ?>

  <div class="f">
   <div class="c9 s12 pRa10">

    <section class="f">
     <div class="c pRa10">
      <a href="<?php echo \dash\url::this() ?>/search" class="stat">
       <h3><?php echo T_("Your Domains");?></h3>
       <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'aa'));?></div>
      </a>
     </div>
     <div class="c pRa10">
      <a href="<?php echo \dash\url::this() ?>/search?" class="stat">
       <h3><?php echo T_("Your Active Domains");?></h3>
       <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'aa'));?></div>
      </a>
     </div>
     <div class="c">
      <a href="<?php echo \dash\url::this() ?>/search?" class="stat">
       <h3><?php echo T_("Your Deactive Domains");?></h3>
       <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'aa'));?></div>
      </a>
     </div>
    </section>

    <div id="chartdivdomain" class="box chart x210" data-hint='Domain Payments - from start'></div>


    <section class="f">
     <div class="c pRa10">
      <a href="<?php echo \dash\url::this() ?>/payments" class="stat x70">
       <h3><?php echo T_("Total Payments");?></h3>
       <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'aa'));?></div>
      </a>
     </div>

     <div class="c pRa10">
      <a href="<?php echo \dash\url::this() ?>/search?" class="stat x70">
       <h3><?php echo T_("Last Year Payments");?></h3>
       <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'aa'));?></div>
      </a>
     </div>

     <div class="c pRa10">
      <a href="<?php echo \dash\url::this() ?>/" class="stat x70">
       <h3><?php echo T_("Your Current Balance");?></h3>
       <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'aa'));?></div>
      </a>
     </div>

     <div class="c">
      <a href="<?php echo \dash\url::this() ?>/" class="stat x70">
       <h3><?php echo T_("Predict Late Payments");?></h3>
       <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'aa'));?></div>
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
     </ul>
    </nav>

    <nav class="items">
     <ul>
      <li>
       <a class="f" href="<?php echo \dash\url::this();?>/irnic">
        <div class="key"><?php echo T_('IRNIC Handle');?></div>
        <div class="go"></div>
       </a>
      </li>
      <li>
       <a class="f" href="<?php echo \dash\url::this();?>/dns">
        <div class="key"><?php echo T_('DNS');?></div>
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
       <a class="f" href="<?php echo \dash\url::this();?>/logs">
        <div class="key"><?php echo T_('Last Activities');?></div>
        <div class="go"></div>
       </a>
      </li>
     </ul>
    </nav>

   </div>
  </div>


























<?php if(\dash\data::dataRow()) {?>

  <?php if(\dash\data::dataRow_status() === 'enable') {?>

    <div class="msg success fs14 txtC">
      <b><?php echo \dash\data::dataRow_name(); ?></b>
      <br>
      <?php echo T_("Operation successfully"); ?>
      <a href="<?php echo \dash\url::this() ?>" class="btn xs secondary" ><?php echo T_("OK"); ?></a>
    </div>

  <?php }else{?>

    <div class="msg danger fs14 txtC">
      <b><?php echo \dash\data::dataRow_name(); ?></b>
      <br>
      <?php echo T_("Operation failed"); ?>
      <?php
      if(\dash\temp::get('domainFaildMessage'))
      {
       echo '<br>';
       echo \dash\temp::get('domainFaildMessage');
      }
      ?>
      <?php if(\dash\temp::get('domainHaveTransaction')) {?>
       <br>
       <?php echo T_("Your money back to your account"); ?>
      <?php } ?>
      <a href="<?php echo \dash\url::this() ?>" class="btn xs secondary" ><?php echo T_("OK"); ?></a>
    </div>

  <?php } //endif ?>

<?php } //endif ?>



