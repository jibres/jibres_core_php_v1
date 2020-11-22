<?php if(\dash\url::child() === 'products') { $editMode = true; }else{ $editMode = false; } ?>

<?php if(\dash\get::index($orderDetail, 'factor_detail')) {?>
  <div class="box cartPage">
    <div class="pad">
      <?php foreach (\dash\get::index($orderDetail, 'factor_detail') as $key => $value) {?>
        <div class="cartItem">
          <div class="row align-center">
            <div class="c-auto">
              <img src="<?php echo \dash\get::index($value, 'thumb') ?>" alt="<?php echo \dash\get::index($value, 'title') ?>">
            </div>
            <div class="c">
              <h3 class="title"><a href="<?php echo \dash\get::index($value, 'edit_url') ?>"><?php echo \dash\get::index($value, 'title') ?></a></h3>
              <div class="priceShow" data-cart>
                <span class="price"><?php echo \dash\fit::number(\dash\get::index($value, 'price')); ?></span>
                <span class="unit"><?php echo \lib\store::currency(); ?></span>

              </div>
                <?php if(\dash\get::index($value, 'discount')) {?>
                  <div class="fc-mute mB5 font-12">
                    <span class=""><?php echo T_("Discount") ?></span>
                    <span class="price"><?php echo \dash\fit::number(\dash\get::index($value, 'discount')); ?></span>
                    <span class="unit"><?php echo \lib\store::currency(); ?></span>
                  </div>
                <?php } //endif ?>

                <?php if(\dash\get::index($value, 'vat')) {?>
                  <div class="fc-mute mB5 font-12">
                    <span class=""><?php echo T_("Vat") ?></span>
                    <span class="price"><?php echo \dash\fit::number(\dash\get::index($value, 'vat')); ?></span>
                    <span class="unit"><?php echo \lib\store::currency(); ?></span>
                  </div>
                <?php } //endif ?>
              <span class="compact ltr fc-mute font-12"><?php echo \dash\fit::date_time(\dash\get::index($value, 'datecreated')); ?></span>
            </div>
            <div class="c">
              <div class="priceShow" data-cart>
                    <span class=""><?php echo T_("Total") ?></span>
                    <span class="price"><?php echo \dash\fit::number(\dash\get::index($value, 'sum')); ?></span>
                    <span class="unit"><?php echo \lib\store::currency(); ?></span>
                  </div>
            </div>
            <div class="c">
               <div class="itemOperation">
              <?php if($editMode) {?>
                  <div class="productCount">
                    <div class="input">
                      <?php

                      $json =
                      [
                        'product_id'       => \dash\get::index($value, 'product_id'),
                        'type'             => null,
                        'count'            => 1,
                        'factor_detail_id' => \dash\get::index($value, 'id'),
                      ];

                      $plus   = json_encode(array_merge($json, ['type' => 'plus_count']));
                      $minus  = json_encode(array_merge($json, ['type' => 'minus_count']));
                      $remove = json_encode(array_merge($json, ['type' => 'remove']));

                      ?>
                      <form method="post" autocomplete="off">
                        <input type="hidden" name="product_id" value="<?php echo \dash\get::index($value, 'product_id') ?>">
                        <input type="hidden" name="type" value="edit_count">
                        <input type="hidden" name="factor_detail_id" value="<?php echo \dash\get::index($value, 'id') ?>">
                        <div class="input">
                          <button class="addon fc-blue sf-floppy-o" title="<?php echo T_("Save") ?>"></button>
                          <input step="0.001" type="number" name="count" value="<?php echo \dash\get::index($value, 'count'); ?>" >
                        </div>
                      </form>
                    </div>

                  </div>

                  <div class="productDel" data-confirm data-data='<?php echo $remove ?>' title='<?php echo T_("Delete") ?>'><i class="sf-trash-o"></i></div>

              <?php }else{ ?>
                <span class="txtB"><?php echo \dash\fit::number_decimal(\dash\get::index($value, 'count')) ?></span>
                  <small><?php echo \dash\get::index($value, 'unit') ?></small>
              <?php } //endif ?>
                </div>
            </div>
          </div>
        </div>
      <?php } //endfor ?>
    </div>
  </div>
<?php }else{ ?>
  <div class="msg info2 fs14 txtB"><?php echo T_("This order is empty") ?></div>
<?php } ?>
