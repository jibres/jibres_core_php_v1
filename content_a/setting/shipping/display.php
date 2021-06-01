<section class="f" data-option='setting-shipping-physical-delivery' id="setting-shipping-physical-delivery">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Do you have shipping?"); ?></h3>
      <div class="body">
        <p><?php echo T_("Selling physical products? You need to ship them!"); ?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_shipping_status" value="1">
    <div class="action">
      <div class="switch1">
        <input type="checkbox" name="shipping_status" id="shippingshipping_status" <?php if(\dash\data::shippingSettingSaved_shipping_status()) { echo 'checked'; } ?>>
        <label for="shippingshipping_status" data-on='<?php echo T_("Yes") ?>' data-off="<?php echo T_("No") ?>"></label>
      </div>
    </div>
  </form>
</section>



<div data-response='shipping_status'  <?php if(!\dash\data::shippingSettingSaved_shipping_status()) {echo 'data-response-hide'; }  ?>>


  <section class="f" data-option='setting-shipping-physical-delivery' id="setting-shipping-physical-delivery">
    <div class="c8 s12">
      <div class="data">
        <h3><?php echo T_("Deliver in store place?"); ?></h3>
        <div class="body">

        </div>
      </div>
    </div>
    <form class="c4 s12" method="post" data-patch>
      <input type="hidden" name="set_deliverinstoreplace" value="1">
      <div class="action">
        <div class="switch1">
          <input type="checkbox" name="deliverinstoreplace" id="shippingdeliverinstoreplace" <?php if(\dash\data::shippingSettingSaved_deliverinstoreplace()) { echo 'checked'; } ?>>
          <label for="shippingdeliverinstoreplace" data-on='<?php echo T_("Yes") ?>' data-off="<?php echo T_("No") ?>"></label>
        </div>
      </div>
    </form>
  </section>



  <section class="f" data-option='setting-shipping-send-by-post' id="setting-shipping-send-by-post">
    <div class="c8 s12">
      <div class="data">
        <h3><?php echo T_("Shipping cost by post?"); ?></h3>
        <div class="body">

        </div>
      </div>
    </div>
    <form class="c4 s12" method="post" data-patch autocomplete="off">
      <input type="hidden" name="set_sendbypostprice" value="1">
      <div class="action">
        <div class="input">
          <input type="tel" name="sendbypostprice" id="sendbypostprice" placeholder="<?php echo \dash\data::storeCurrency(); ?>" value="<?php echo \dash\data::shippingSettingSaved_sendbypostprice(); ?>" data-format="price" maxlength="12">
          <button class="btn addon master"><?php echo T_("Save") ?></button>
        </div>
      </div>
    </form>
  </section>




  <section class="f" data-option='setting-shipping-send-by-post' id="setting-shipping-send-by-post">
    <div class="c8 s12">
      <div class="data">
        <h3><?php echo T_("Have free shipping?"); ?></h3>
        <div class="body">
          <p>
            <?php echo T_("Shipping larger than this value is free") ?>
          </p>

        </div>
      </div>
    </div>
    <form class="c4 s12" method="post" data-patch autocomplete="off">
      <input type="hidden" name="set_freeshippingprice" value="1">
      <div class="action">
        <div class="input">
          <input type="tel" name="freeshippingprice" id="freeshippingprice" placeholder="<?php echo \dash\data::storeCurrency(); ?>" value="<?php echo \dash\data::shippingSettingSaved_freeshippingprice(); ?>" data-format="price" maxlength="12">
          <button class="btn addon master"><?php echo T_("Save") ?></button>
        </div>
      </div>
    </form>
  </section>



</div>



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