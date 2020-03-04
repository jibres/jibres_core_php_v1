<?php if(!\dash\data::appQueue()) {?>

<div class="welcome">
  <p><?php echo T_("Easily Create your store application"); ?></p>
  <h2><?php echo T_("Create a custom app for your store"); ?></h2>

  <div class="buildBtn">
    <a class="btn xl master" href="<?php echo \dash\url::that(); ?>/splash"><?php echo T_("Build it now"); ?></a>
  </div>

</div>


<?php }else{ ?>


<div class="welcome">
  <h2><?php echo T_("Your application in build queue"); ?></h2>
  <p><?php echo \dash\fit::date_time(\dash\data::appQueue_daterequest()); ?></p>

  <div class="buildBtn">
    <a class="btn xl master" href="<?php echo \dash\url::that(); ?>/build"><?php echo T_("Check"); ?></a>
  </div>
</div>



<?php } //endif ?>


