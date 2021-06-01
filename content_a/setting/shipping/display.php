


<section class="f" data-option='setting-shipping-setting' id="setting-shipping-setting">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Shipping option"); ?></h3>
      <div class="body">
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <div class="action">
      <a class="btn primary" href="<?php echo \dash\url::that(); ?>/setting"><?php echo T_("Set") ?></a>
    </div>
  </form>
</section>



<section class="f" data-option='setting-shipping-text' id="setting-shipping-text">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Shipping default page text"); ?></h3>
      <div class="body">
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <div class="action">
      <a class="btn primary" href="<?php echo \dash\url::that(); ?>/text"><?php echo T_("Set") ?></a>
    </div>
  </form>
</section>


<section class="f" data-option='setting-shipping-calculate-post-price' id="setting-shipping-calculate-post-price">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Calculate IR POST Shipping price"); ?></h3>
      <div class="body">
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <div class="action">
      <a class="btn" href="<?php echo \dash\url::that(); ?>/irpost"><?php echo T_("Calcuate") ?></a>
    </div>
  </form>
</section>