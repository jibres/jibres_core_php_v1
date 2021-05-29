<?php $dashboardData = \dash\data::dashboardData(); ?>


<div class="row">
  <div class="c-xs-12 c-sm-12 c-md-8">

    <div class="box">
      <div class='font-16'>
        <select class="select22" data-model='html' data-ajax--url="<?php echo \dash\url::here() ?>/setting/search/full" data-shortkey-search data-placeholder="<?php echo T_("Search") ?>"></select>
      </div>
    </div>

    <div class="font-12">
      <?php if(a($dashboardData, 'new_order')) {?>
        <a href="<?php echo \dash\url::here(). '/order/unprocessed' ?>">
          <div class="msg success2 txtB">
            <?php echo T_("You have :val Unprocessed order", ['val' => \dash\fit::number(a($dashboardData, 'new_order'))]) ?>
          </div>
        </a>
      <?php } //endif ?>
      <?php if(a($dashboardData, 'new_ticket')) {?>
        <a href="<?php echo \dash\url::kingdom(). '/crm/ticket/datalist?status=awaiting' ?>">
          <div class="msg success2 txtB">
            <?php echo T_("You have :val Unanswered ticket", ['val' => \dash\fit::number(a($dashboardData, 'new_ticket'))]) ?>
          </div>
        </a>
      <?php } //endif ?>
       <?php if(a($dashboardData, 'new_comment')) {?>
        <a href="<?php echo \dash\url::kingdom(). '/cms/comments?status=awaiting' ?>">
          <div class="msg success2 txtB">
            <?php echo T_("You have :val awaiting comment", ['val' => \dash\fit::number(a($dashboardData, 'new_comment'))]) ?>
          </div>
        </a>
      <?php } //endif ?>



    </div>



<?php if(\dash\permission::check('_group_products')) {?>
   <div id="chartdiv" class="box chart x400" data-abc='a/homepage'></div>
<?php } //endif ?>
  </div>
  <div class="c-xs-12 c-sm-12 c-md-4">
   <nav class="items long">
     <ul>

<?php if(\dash\permission::check('_group_orders')) {?>
       <li>
        <a class="item f unprocessedOrder" href="<?php echo \dash\url::here();?>/order/unprocessed">
          <i class="sf-cart-arrow-down"></i>
          <div class="key"><?php echo T_('Unprocessed Order');?></div>
          <div class="value fc-red"></div>
          <div class="go"></div>
        </a>
       </li>
<?php } //endif ?>
<?php if(\dash\permission::check('_group_orders')) {?>
       <li>
        <a class="item f" href="<?php echo \dash\url::here();?>/order">
          <i class="sf-shopping-cart"></i>
          <div class="key"><?php echo T_('All Orders');?></div>
          <div class="go"></div>
        </a>
       </li>
<?php } //endif ?>
<?php if(\dash\permission::check('manageCart')) {?>
      <li>
        <a class="item f" href="<?php echo \dash\url::here(); ?>/cart">
          <i class="sf-bag"></i>
          <div class="key"><?php echo T_("Cart"); ?></div>
          <div class="go"></div>
        </a>
      </li>
<?php } //endif ?>
<?php if(\dash\permission::check('factorSaleAdd')) {?>
       <li>
        <a class="item f" href="<?php echo \dash\url::here();?>/sale">
          <i class="sf-cash-register"></i>
          <div class="key"><?php echo T_('Sale Invoicing');?></div>
          <div class="go plus"></div>
        </a>
       </li>
<?php } //endif ?>

     </ul>
   </nav>

   <nav class="items long">
     <ul>
<?php if(\dash\permission::check('_group_products')) {?>
       <li>
        <a class="item f" href="<?php echo \dash\url::here();?>/products">
          <i class="sf-tags"></i>
          <div class="key"><?php echo T_('Products');?></div>
          <div class="value"><?php echo \dash\fit::number(a($dashboardData, 'product_count')); ?></div>
          <div class="go search"></div>
        </a>
      </li>
<?php } //endif ?>
<?php if(\dash\permission::check('productAdd')) {?>
       <li>
        <a class="item f" href="<?php echo \dash\url::here();?>/products/add">
          <i class="sf-plus-circle"></i>
          <div class="key"><?php echo T_('Add new Product');?></div>
          <div class="go plus"></div>
        </a>
      </li>
<?php } //endif ?>
     </ul>
   </nav>

   <nav class="items long">
     <ul>
<?php if(\dash\permission::check('_group_crm')) {?>
       <li>
        <a class="item f" href="<?php echo \dash\url::kingdom();?>/crm">
          <i class="sf-atom"></i>
          <div class="key"><?php echo T_('CRM');?></div>
          <div class="go"></div>
        </a>
       </li>
       <li>
        <a class="item f" href="<?php echo \dash\url::kingdom();?>/crm/member">
          <i class="sf-users"></i>
          <div class="key"><?php echo T_('Customers');?></div>
          <div class="value"><?php echo \dash\fit::number(a($dashboardData, 'customer_count')); ?></div>
          <div class="go search"></div>
        </a>
       </li>
<?php } //endif ?>
     </ul>
   </nav>

    <nav class="items long">
      <ul>
        <?php if(\dash\permission::check('_group_cms')) {?>
        <li>
          <a class="item f" href="<?php echo \dash\url::kingdom(); ?>/cms">
            <i class="sf-file-text"></i>
            <div class="key"><?php echo T_("Content Management"). T_(" & "). T_("Blog"); ?></div>
            <div class="go"></div>
          </a>
        </li>
      <?php } //endif ?>
      </ul>
    </nav>

    <nav class="items long">
      <ul>
        <?php if(\dash\permission::check('_group_accounting')) {?>
          <li><a class="item f" href="<?php echo \dash\url::here(); ?>/accounting">
            <i class="sf-book"></i>
            <div class="key"><?php echo T_("Cloud Accounting"); ?></div>
            <div class="go"></div>
          </a></li>
        <?php  }//endif ?>

      </ul>
    </nav>

    <nav class="items long">
      <ul>
        <?php if(\dash\permission::check('_group_setting')) { $url = \lib\pagebuilder\tools\homepage::get_link(); ?>
        <li>
          <a class="item f" href="<?php echo $url ?>">
            <i class="sf-monitor"></i>
            <div class="key"><?php echo T_("Website Builder"); ?></div>
            <div class="go"></div>
          </a>
        </li>
      <?php } //endif ?>
      <?php if(\dash\permission::check('_group_application')) {?>
        <li>
          <a class="item f" href="<?php echo \dash\url::here(); ?>/android">
            <i class="sf-mobile"></i>
            <div class="key"><?php echo T_("App Builder"); ?></div>
            <div class="go"></div>
          </a>
        </li>
      <?php } //endif ?>
      </ul>
    </nav>


    <?php if(\dash\permission::check('_group_setting') && !\dash\request::is_pwa()) {?>
       <nav class="items long">
      <ul>
          <li><a class="item f" href="<?php echo \dash\url::here(); ?>/setting"><i class="sf-cogs"></i><div class="key"><?php echo T_("Settings"); ?></div><div class="go"></div></a></li>
      </ul>
    </nav>
    <?php  }//endif ?>


</div>

</div>



<div class="hide">
  <div id="chartcategory"><?php echo a(\dash\data::dashboardData(), 'chart', 'categories'); ?></div>
  <div id="chartsum"><?php echo a(\dash\data::dashboardData(), 'chart', 'sum'); ?></div>
  <div id="chartcount"><?php echo a(\dash\data::dashboardData(), 'chart', 'count'); ?></div>
  <div id="charttitle"><?php echo T_("Sum factor price and count of it group by hours"); ?></div>
  <div id="charttitlesum"><?php echo T_("Sum price"); ?></div>
  <div id="charttitlecount"><?php echo T_("Count"); ?></div>
  <div id="charttitleunit"><?php echo \lib\currency::unit(); ?></div>
</div>