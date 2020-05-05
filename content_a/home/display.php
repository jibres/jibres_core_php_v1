<?php $dashboardData = \dash\data::dashboardData(); ?>


<div class="f">
  <div class="c8 x9 s12 pRa10">
<?php if(\dash\permission::check('staffAccess')) {?>
   <div id="chartdiv" class="box chart x400" data-abc='a/homepage'></div>
<?php } //endif ?>
  </div>
  <div class="c4 x3 s12">
   <nav class="items">
     <ul>
<?php if(\dash\permission::check('productList')) {?>
       <li>
        <a class="f" href="<?php echo \dash\url::here();?>/products">
          <div class="key"><?php echo T_('Products');?></div>
          <div class="value"><?php echo \dash\fit::number(\dash\get::index($dashboardData, 'product_count')); ?></div>
          <div class="go"></div>
        </a>
      </li>
<?php } //endif ?>
<?php if(\dash\permission::check('productAdd')) {?>
       <li>
        <a class="f" href="<?php echo \dash\url::here();?>/products/add">
          <div class="key"><?php echo T_('Add new Product');?></div>
          <div class="go plus"></div>
        </a>
      </li>
<?php } //endif ?>
     </ul>
   </nav>
   <nav class="items">
     <ul>
       <li>
        <a class="f" href="<?php echo \dash\url::here();?>/factor">
          <div class="key"><?php echo T_('Orders');?></div>
          <div class="go"></div>
        </a>
       </li>
<?php if(\dash\permission::check('factorSaleAdd')) {?>
       <li>
        <a class="f" href="<?php echo \dash\url::here();?>/sale">
          <div class="key"><?php echo T_('Sale Invoicing');?></div>
          <div class="go plus"></div>
        </a>
       </li>
<?php } //endif ?>
<?php if(\dash\permission::check('factorBuyAdd')) {?>
       <li>
        <a class="f" href="<?php echo \dash\url::here();?>/buy">
          <div class="key"><?php echo T_('Buy Invocing');?></div>
          <div class="go plus"></div>
        </a>
       </li>
<?php } //endif ?>
     </ul>
   </nav>
   <nav class="items">
     <ul>
<?php if(\dash\permission::check('customerAccess')) {?>
       <li>
        <a class="f" href="<?php echo \dash\url::kingdom();?>/crm">
          <div class="key"><?php echo T_('Customer');?></div>
          <div class="value"><?php echo \dash\fit::number(\dash\get::index($dashboardData, 'customer_count')); ?></div>
          <div class="go"></div>
        </a>
       </li>
<?php } //endif ?>
<?php if(\dash\permission::check('staffAccess')) {?>
       <li>
        <a class="f" href="<?php echo \dash\url::kingdom();?>/crm">
          <div class="key"><?php echo T_('Staff');?></div>
          <div class="value"><?php echo \dash\fit::number(\dash\get::index($dashboardData, 'staff_count')); ?></div>
          <div class="go"></div>
        </a>
       </li>
<?php } //endif ?>
     </ul>
   </nav>

    <nav class="items">
      <ul>
        <li><a class="f" href="<?php echo \dash\url::here(); ?>/android"><div class="key"><?php echo T_("Android app"); ?></div><div class="go"></div></a></li>
      </ul>
    </nav>

    <?php if(\dash\url::isLocal()) {?>
      <nav class="items">
      <ul>
        <li><a class="f" href="<?php echo \dash\url::here(); ?>/website"><div class="key"><?php echo T_("Website setting"); ?></div><div class="go"></div></a></li>
      </ul>
    </nav>
  <?php } //endif ?>

   <nav class="items">
     <ul>
       <li>
        <a class="f" href="<?php echo \dash\url::here();?>/setting">
          <div class="key"><?php echo T_('Setting');?></div>
          <div class="go"></div>
        </a>
       </li>
     </ul>
   </nav>
  </div>

</div>


  <div class="c4 s hide">
   <div class="dcard">
     <div class="block">
      <div class="f">
        <h5 class="c fc-mute"><?php echo \dash\datetime::fit("now", 'F'); ?></h5>
        <h4 class="cauto fc-info fs30 txtra"><?php echo \dash\datetime::fit("now", 'd'); ?></h4>
      </div>
      <div class="f">
       <div class="progress" data-percent='<?php echo \dash\get::index($dashboardData, 'month_detail' ,'left'); ?>'>
        <div class="bar"></div>
       </div>
      </div>
     </div>
    </div>
  </div>
</div>



<div class="hide">
  <div id="chartcategory"><?php echo \dash\get::index(\dash\data::dashboardData(), 'chart', 'categories'); ?></div>
  <div id="chartsum"><?php echo \dash\get::index(\dash\data::dashboardData(), 'chart', 'sum'); ?></div>
  <div id="chartcount"><?php echo \dash\get::index(\dash\data::dashboardData(), 'chart', 'count'); ?></div>
  <div id="charttitle"><?php echo T_("Sum factor price and count of it group by hours"); ?></div>
  <div id="charttitlesum"><?php echo T_("Sum price"); ?></div>
  <div id="charttitlecount"><?php echo T_("Count"); ?></div>
  <div id="charttitleunit"><?php echo \lib\currency::unit(); ?></div>
</div>