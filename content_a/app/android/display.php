<?php if(!\dash\data::appQueue()) {?>

<div class="welcome">
  <p><?php echo T_("Easily Create your store application"); ?></p>
  <h2><?php echo T_("Create a custom app for your store"); ?></h2>

  <div class="buildBtn">
    <a class="btn xl master" href="<?php echo \dash\url::that(); ?>/splash"><?php echo T_("Build it now"); ?></a>
  </div>

</div>


<?php }else{ ?>


<?php } //endif ?>


