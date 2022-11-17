<div class="avand">
  <div class="row">
    <div class="c-xs-12 c-sm-12 c-lg-4 d-lg-block c-xl-3">
      <?php require_once(root. 'content_business/profile/display-menu.php'); ?>
    </div>
    <div class="c-xs-12 c-sm-12 c-lg-8 c-xl-9">

      <?php if(\dash\data::satisfactionSurveyForm()) { echo \lib\app\form\generator::full_html(\dash\data::satisfactionSurveyForm());} ?>
      <div class="box">
        <div class="body">
          <div class="row">
            <div class="c-auto">
              <div class="badge pA10-f mb-2 text-sm light"><?php echo T_("Order number") ?> <code class="link-primary"><?php echo a(\dash\data::dataRow_order(), 'id'); ?></code></div>
            </div>
            <div class="c-auto">
              <div class="badge pA10-f mb-2 text-sm light"><?php echo T_("Order status") ?> <span class="link-primary"><?php echo a(\dash\data::dataRow_order(), 't_status'); ?></span></div>
            </div>

            <div class="c-auto">
              <div class="badge pA10-f mb-2 text-sm light"><?php echo T_("Order date") ?> <span class="link-primary"><?php echo \dash\fit::date_time(a(\dash\data::dataRow_order(), 'date')); ?></span></div>
            </div>

          </div>


           <?php $address = a(\dash\data::dataRow(), 'address'); if(a($address, 'address')){ ?>
          <div class="alert2">
            <span class=" link"><?php echo T_("Address") ?></span>
            <?php if(isset($address['country']) && $address['country']) {?><i class="flag <?php echo \dash\str::mb_strtolower($address['country']); ?>"></i><?php } //endif ?>
            <span ><?php echo a($address, 'location_string'); ?></span>
            <span><?php echo a($address, 'address'); ?></span>
            <?php if(isset($address['postcode']) && $address['postcode']) {?>
              <span title='<?php echo T_("Postal code"); ?>' class="inline-block"><?php echo \dash\fit::text($address['postcode']); ?><i class="sf-crosshairs mRL5"></i></span>
            <?php }//endif ?>
            <?php echo a($address, 'name'); ?>
            <?php if(isset($address['phone']) && $address['phone']) {?>
              <div title='<?php echo T_("Phone"); ?>'><i class="sf-phone"></i> <?php echo \dash\fit::text($address['phone']); ?></div>
            <?php } //endif ?>
            <?php if(isset($address['mobile']) && $address['mobile']) {?>
              <div title='<?php echo T_("Mobile"); ?>' class="mT5"><i class="sf-mobile"></i> <?php echo \dash\fit::mobile($address['mobile']); ?></div>
            <?php } //endif ?>
          </div>
            <?php } //endif ?>

          <?php if(\dash\data::trackingDetail()) { $tracking_number = \dash\data::trackingDetail_desc(); ?>
            <div class="alert-success">
              <div class="font-20 font-bold"><?php echo T_("Your tracking number is") ?>
                <code data-copy='<?php echo $tracking_number ?>'><?php echo $tracking_number ?></code>
              </div>
              <?php if(\dash\validate::post_track_id($tracking_number, false)) {?>
              <p><?php echo T_("By opening the following link, you can track the status of sending your order through the post site"); ?></p>
              <a class="btn master" target="_blank" href="<?php echo sprintf('https://tracking.post.ir/?id=%s', $tracking_number) ?>"><?php echo T_("Tracking By Post") ?></a>
            <?php } //endif ?>
            </div>
          <?php } //endif ?>

        </div>

        <?php if(a(\dash\data::dataRow_order(), 'paystatus') !== 'successful_payment' && a(\dash\data::dataRow_order(), 'status') !== 'cancel') {?>
          <footer class="txtRa">
            <div class="btn-warning" data-confirm data-data='{"set_status": "cancel"}'><?php echo T_("Cancel order") ?></div>
          </footer>
        <?php } //endif ?>
      </div>

      <?php if(\dash\data::dataRow_products() && is_array(\dash\data::dataRow_products())) {?>

           <div class="box cartPage">
    <div class="pad">
        <?php  foreach (\dash\data::dataRow_products() as $key => $value) { ?>


        <div class="cartItem">
          <div class="row align-center">
            <div class="c-auto">
              <img src="<?php echo a($value, 'thumb') ?>" alt="<?php echo a($value, 'title') ?>">
            </div>
            <div class="c">
              <h3 class="title"><a href="<?php echo a($value, 'url'); ?>"><?php echo a($value, 'title') ?></a></h3>

              <div class="priceShow" data-cart>
                <span class="price"><?php echo \dash\fit::number(a($value, 'price')); ?></span>
                <span class="currency text-gray-400"><?php echo \lib\store::currency(); ?></span>
              </div>


                <div class="priceShow" data-cart>
                    <?php if(!a($value, 'unit')) { ?>
                        <span class="unit text-gray-400"><?php echo T_("Count"); ?></span>
                    <?php } // endif ?>
                    <span class="count"><?php echo \dash\fit::number_decimal(a($value, 'count')); ?></span>
                    <span class="unit text-gray-400"><?php echo a($value, 'unit'); ?></span>
                </div>


            </div>


            <div class="c-auto c-xs-12">
              <?php if(false) {?>
                <div class="availability" data-red data-type='view'><?php echo T_("This product was removed from your cart"); ?></div>
              <?php }else{ ?>
                <div class="itemOperation">
                  <div class="productCount">
                  </div>
                </div>

                <?php if(a($value, 'type') === 'file' && in_array(a(\dash\data::dataRow(), 'order', 'paystatus' ), ['successful_payment'])) {?>
                  <?php if(a($value, 'fileaddress')) {?>
                    <a data-action class="btn-success" href="<?php echo a($value, 'fileaddress') ?>" download target="_blank"><?php echo T_("Download file") ?></a>
                    <?php if(\dash\request::is_pwa()) {?>
                      <div class="msg mt-2"><?php echo T_("File Address"). ' '. a($value, 'fileaddress') ?>
                        <a class="btn master mt-2" data-copy="<?php echo a($value, 'fileaddress') ?>"><?php echo T_("Copy To Download") ?></a>
                      </div>
                    <?php } //endif ?>
                  <?php }else{ ?>
                    <div class="text-red-800"><?php echo T_("File have not address!") ?></div>
                  <?php } //endif ?>
                <?php } //endif ?>
              <?php } // endif ?>

            </div>
          </div>
        </div>


      <?php } //endfor ?>
    </div>
  </div>

      <?php } //endif ?>



    </div>
  </div>
</div>
