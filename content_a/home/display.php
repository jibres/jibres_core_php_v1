<?php $dashboardData = \dash\data::dashboardData(); ?>


<div class="row">
  <div class="c-9 c-xs-12">
<?php if(\dash\permission::check('_group_products')) {?>
   <div id="chartdiv" class="box chart x400" data-abc='a/homepage'></div>
<?php } //endif ?>
  </div>
  <div class="c-3 c-xs-12">
   <nav class="items long">
     <ul>
<?php if(\dash\permission::check('_group_products')) {?>
       <li>
        <a class="item f" href="<?php echo \dash\url::here();?>/products">
          <div class="key"><?php echo T_('Products');?></div>
          <div class="value"><?php echo \dash\fit::number(\dash\get::index($dashboardData, 'product_count')); ?></div>
          <div class="go"></div>
        </a>
      </li>
<?php } //endif ?>
<?php if(\dash\permission::check('productAdd')) {?>
       <li>
        <a class="item f" href="<?php echo \dash\url::here();?>/products/add">
          <div class="key"><?php echo T_('Add new Product');?></div>
          <div class="go plus"></div>
        </a>
      </li>
<?php } //endif ?>
     </ul>
   </nav>
   <nav class="items long">
     <ul>

<?php if(\dash\permission::check('_group_orders')) {?>
       <li>
        <a class="item f" href="<?php echo \dash\url::here();?>/order">
          <div class="key"><?php echo T_('Orders');?></div>
          <div class="go"></div>
        </a>
       </li>
      <li><a class="item f" href="<?php echo \dash\url::here(); ?>/cart"><div class="key"><?php echo T_("Cart"); ?></div><div class="go"></div></a></li>
<?php } //endif ?>
<?php if(\dash\permission::check('factorSaleAdd')) {?>
       <li>
        <a class="item f" href="<?php echo \dash\url::here();?>/sale">
          <div class="key"><?php echo T_('Sale Invoicing');?></div>
          <div class="go plus"></div>
        </a>
       </li>
<?php } //endif ?>

     </ul>
   </nav>
   <nav class="items long">
     <ul>
<?php if(\dash\permission::check('customerAccess')) {?>
       <li>
        <a class="item f" href="<?php echo \dash\url::kingdom();?>/crm">
          <div class="key"><?php echo T_('Customer');?></div>
          <div class="value"><?php echo \dash\fit::number(\dash\get::index($dashboardData, 'customer_count')); ?></div>
          <div class="go"></div>
        </a>
       </li>
<?php } //endif ?>
<?php if(\dash\permission::check('staffAccess')) {?>
       <li>
        <a class="item f" href="<?php echo \dash\url::kingdom();?>/crm">
          <div class="key"><?php echo T_('Staff');?></div>
          <div class="value"><?php echo \dash\fit::number(\dash\get::index($dashboardData, 'staff_count')); ?></div>
          <div class="go"></div>
        </a>
       </li>
<?php } //endif ?>
     </ul>
   </nav>

    <nav class="items long">
      <ul>
        <?php if(\dash\permission::check('_group_setting')) {?>
        <li><a class="item f" href="<?php echo \dash\url::here(); ?>/website"><div class="key"><?php echo T_("Website setting"); ?></div><div class="go"></div></a></li>
      <?php } //endif ?>
      <?php if(\dash\permission::check('_group_application')) {?>
        <li><a class="item f" href="<?php echo \dash\url::here(); ?>/android"><div class="key"><?php echo T_("Android app"); ?></div><div class="go"></div></a></li>
      <?php } //endif ?>
      </ul>
    </nav>

    <nav class="items long">
      <ul>

        <?php if(\dash\permission::check('_group_form')) {?>
          <li><a class="item f" href="<?php echo \dash\url::here(); ?>/form"><i class="sf-edit"></i><div class="key"><?php echo T_("Form Builder"); ?></div><div class="go"></div></a></li>
        <?php } //endif ?>

        <?php if(\dash\permission::check('_group_accounting')) {?>
          <li><a class="item f" href="<?php echo \dash\url::here(); ?>/accounting"><i class="sf-book"></i><div class="key"><?php echo T_("Accounting"); ?></div><div class="go"></div></a></li>
        <?php  }//endif ?>

      </ul>
    </nav>


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