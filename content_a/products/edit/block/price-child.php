<section class="box">
  <div class="pad jboxPrice">

  	    <?php if(\dash\data::productDataRow_child()) {?>
  	    	<input type="hidden" name="wholeeditchild" value="wholeeditchild">

              <div class="tblBox mT10">
                <table class="tbl1 v4 fs09">
                  <thead>
                    <tr>
                      <th class="collapsing"><?php echo T_("Variants") ?></th>
                      <th><?php echo T_("Price"); ?></th>
                      <th><?php echo T_("Discount"); ?></th>
                      <th><?php echo T_("Stock"); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach (\dash\data::productDataRow_child() as $key => $value) {?>

                    <?php $myId = \dash\get::index($value, 'id'); ?>

                      <tr>

                      	<td class="collapsing txtB">
                        	<a href="<?php echo \dash\url::this(). '/edit?id='. \dash\get::index($value, 'id'); ?>">
                        	<?php $myArrayName = array_filter([\dash\get::index($value, 'optionvalue1'), \dash\get::index($value, 'optionvalue2'), \dash\get::index($value, 'optionvalue3')]); ?>
                        	<?php echo implode(' / ', $myArrayName); ?>
                        	</a>
                        </td>

                        <td>
                          <div class="input">
                            <input type="number" name="whole_price_<?php echo $myId; ?>" placeholder='<?php echo T_("Price"); ?>' value="<?php echo \dash\get::index($value, 'price'); ?>">
                          </div>
                        </td>

                        <td>
                          <div class="input">
                            <input type="number" name="whole_discount_<?php echo $myId; ?>" placeholder='<?php echo T_("Discount"); ?>' value="<?php echo \dash\get::index($value, 'discount'); ?>">
                          </div>
                        </td>

                        <td>
                          <div class="input">
                            <input type="number" name="whole_stock_<?php echo $myId; ?>" placeholder='<?php echo T_("Stock"). ' '. \dash\fit::number(\dash\get::index($value, 'stock')); ?>'>
                          </div>
                        </td>

                      </tr>
                    <?php } //endfor ?>
                  </tbody>
                </table>
              </div>




          <?php } //endif ?>
  </div>
</section>
