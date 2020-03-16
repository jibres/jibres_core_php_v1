<?php
$dashboardData = \dash\data::dashboardData();

?>
<div class="f">
 <?php if(\dash\permission::check('factorSaleAdd')) {?>
  <div class="c6 s6">
    <a class="dcard x2" href='<?php echo \dash\url::here(); ?>/sale'>
     <div class="statistic teal">
      <div class="value"><i class="sf-basket"></i></div>
      <div class="label"><?php echo T_("Sale Invoicing"); ?></div>
     </div>
    </a>
  </div>
<?php } //endif ?>


 <?php if(\dash\permission::check('factorBuyAdd')) {?>
  <div class="c6 s6">
    <a class="dcard x2 disabled">
     <div class="statistic gray">
      <div class="value"><i class="sf-basket"></i></div>
      <div class="label"><?php echo T_("Buy Invocing"); ?></div>
     </div>
    </a>
  </div>
<?php } //endif ?>


</div>

<div class="f">
 <?php if(\dash\permission::check('productList')) {?>
  <div class="c6 s6">
    <a class="dcard x1" href='<?php echo \dash\url::here(); ?>/products'>
     <div class="statistic">
      <div class="value"><span><?php echo \dash\fit::number(\dash\get::index($dashboardData, 'product_count')); ?></span></div>
      <div class="label"><?php echo T_("Product"); ?></div>
     </div>
    </a>
  </div>
<?php } //endif ?>


 <?php if(\dash\permission::check('productAdd')) {?>
  <div class="c6 s6">
    <a class="dcard x1" href='<?php echo \dash\url::here(); ?>/products/add'>
     <div class="statistic green">
      <div class="value"><i class="sf-plus"></i></div>
      <div class="label"><?php echo T_("Add new Product"); ?></div>
     </div>
    </a>
  </div>
<?php } //endif ?>


</div>

<div class="f">
 <?php if(\dash\permission::check('customerAccess')) {?>
  <div class="c4 s6">
    <a class="dcard" href='<?php echo \dash\url::kingdom(); ?>/crm'>
     <div class="statistic gray">
      <div class="value"><i class="sf-user"></i><span><?php echo \dash\fit::number(\dash\get::index($dashboardData, 'customer_count')); ?></span></div>
      <div class="label"><?php echo T_("Customer"); ?></div>
     </div>
    </a>
  </div>
<?php } //endif ?>


 <?php if(\dash\permission::check('staffAccess')) {?>
  <div class="c4 s6">
    <a class="dcard" href='<?php echo \dash\url::kingdom(); ?>/crm'>
     <div class="statistic orange">
      <div class="value"><i class="sf-user-4"></i><span><?php echo \dash\fit::number(\dash\get::index($dashboardData, 'staff_count')); ?></span></div>
      <div class="label"><?php echo T_("Staff"); ?></div>
     </div>
    </a>
  </div>
<?php } //endif ?>


  <div class="c4 s6">
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


<?php if(\dash\permission::check('staffAccess')) {?>
  <div class="dcard x3 pA0">
   <div id="chartdiv" class="chart" ></div>
  </div>

<?php } //endif ?>










