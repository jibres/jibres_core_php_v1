<?php if(\dash\url::child() === 'products') { $editMode = true; }else{ $editMode = false; } ?>

<?php if(a($orderDetail, 'factor_detail')) {?>
  <div class="box cartPage">
    <div class="pad">
      <?php foreach (a($orderDetail, 'factor_detail') as $key => $value) {?>
        <div class="cartItem2">
          <div class="row align-center">
            <div class="c-auto">
              <img class="w-20" src="<?php echo a($value, 'thumb') ?>" alt="<?php echo a($value, 'title') ?>">
            </div>
            <div class="c">
              <h3 class="title"><a href="<?php echo a($value, 'edit_url') ?>"><?php echo a($value, 'title') ?></a></h3>
              <div class="priceShow" data-cart>
                <span class="price"><?php echo \dash\fit::number(a($value, 'price')); ?></span>
                <span class="unit"><?php echo \lib\store::currency(); ?></span>

              </div>
                <?php if(a($value, 'discount')) {?>
                  <div class="fc-mute mB5 text-sm">
                    <span class=""><?php echo T_("Discount") ?></span>
                    <span class="price"><?php echo \dash\fit::number(a($value, 'discount')); ?></span>
                    <span class="unit"><?php echo \lib\store::currency(); ?></span>
                  </div>
                <?php } //endif ?>

                <?php if(a($value, 'vat')) {?>
                  <div class="fc-mute mB5 text-sm">
                    <span class=""><?php echo T_("Vat") ?></span>
                    <span class="price"><?php echo \dash\fit::number(a($value, 'vat')); ?></span>
                    <span class="unit"><?php echo \lib\store::currency(); ?></span>
                  </div>
                <?php } //endif ?>
              <span class="compact ltr fc-mute text-sm"><?php echo \dash\fit::date_time(a($value, 'datecreated')); ?></span>
            </div>
            <div class="c">
              <div class="priceShow" data-cart>
                    <span class=""><?php echo T_("Total") ?></span>
                    <span class="price"><?php echo \dash\fit::number(a($value, 'sum')); ?></span>
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
                        'product_id'       => a($value, 'product_id'),
                        'type'             => null,
                        'count'            => 1,
                        'factor_detail_id' => a($value, 'id'),
                      ];

                      $plus   = json_encode(array_merge($json, ['type' => 'plus_count']));
                      $minus  = json_encode(array_merge($json, ['type' => 'minus_count']));
                      $remove = json_encode(array_merge($json, ['type' => 'remove']));

                      ?>
                      <form method="post" autocomplete="off">
                        <input type="hidden" name="product_id" value="<?php echo a($value, 'product_id') ?>">
                        <input type="hidden" name="type" value="edit_count">
                        <input type="hidden" name="factor_detail_id" value="<?php echo a($value, 'id') ?>">
                        <div class="input">
                          <button class="addon" title="<?php echo T_("Save") ?>"><img class="w-3" src="<?php echo \dash\utility\icon::url('Save', 'minor') ?>"></button>
                          <input step="0.001" type="number" name="count" value="<?php echo a($value, 'count'); ?>" >
                        </div>
                      </form>
                    </div>

                  </div>

                  <span  data-confirm data-data='<?php echo $remove ?>' title='<?php echo T_("Delete") ?>'><img class="w-3" src="<?php echo \dash\utility\icon::url('Delete') ?>"></span>

              <?php }else{ ?>
                <span class="font-bold"><?php echo \dash\fit::number_decimal(a($value, 'count')) ?></span>
                  <small><?php echo a($value, 'unit') ?></small>
              <?php } //endif ?>
                </div>
            </div>
          </div>
        </div>
      <?php } //endfor ?>
    </div>
  </div>
<?php }else{ ?>
  <div class="alert-info fs14 font-bold"><?php echo T_("This order is empty") ?></div>
<?php } ?>
