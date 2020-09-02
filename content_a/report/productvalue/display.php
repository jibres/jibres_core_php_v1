<?php $urlHere = \dash\url::here(); ?>
<div class="avand">
  <nav class="items">
    <ul>





      <?php $total_fund = \lib\report\product\get::total_fund(); if($total_fund) { ?>

        <li><a class="f" href="<?php echo \dash\url::here(). '/products'; ?>"><div class="key"><?php echo T_("The amount you spent");?> <small>(<?php echo T_("Product buyprice * stock") ?>)</small></div><div class="value"><?php echo \dash\fit::number(\dash\get::index($total_fund, 'total_buyprice'));?></div><div class="go"></div></a></li>

        <li><a class="f" href="<?php echo \dash\url::here(). '/products'; ?>"><div class="key"><?php echo T_("The amount that will be obtained after selling all products without discount");?> <small>(<?php echo T_("Product price * stock") ?>)</small></div><div class="value"><?php echo \dash\fit::number(\dash\get::index($total_fund, 'total_price'));?></div><div class="go"></div></a></li>

        <li><a class="f" href="<?php echo \dash\url::here(). '/products'; ?>"><div class="key"><?php echo T_("Total discounts");?></div><div class="value"><?php echo \dash\fit::number(\dash\get::index($total_fund, 'total_discount'));?></div><div class="go"></div></a></li>

        <li><a class="f" href="<?php echo \dash\url::here(). '/products'; ?>"><div class="key"><?php echo T_("The amount that will be obtained after selling all products");?> <small>(<?php echo T_("Product final price * stock") ?>)</small></div><div class="value"><?php echo \dash\fit::number(\dash\get::index($total_fund, 'total_finalprice'));?></div><div class="go"></div></a></li>


        <li><a class="f" href="<?php echo \dash\url::here(). '/products'; ?>"><div class="key"><?php echo T_("Total profit");?></div><div class="value"><?php echo \dash\fit::number(\dash\get::index($total_fund, 'total_profit'));?></div><div class="go"></div></a></li>
      <?php } // endif ?>



    </ul>
  </nav>

</div>
