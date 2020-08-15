<?php
$myChildList = \dash\data::productDataRow_child();
if(!is_array($myChildList))
{
  $myChildList = [];
}
$option = [];
$option = array_merge($option, array_filter(array_unique(array_column($myChildList, 'optionname1'))));
$option = array_merge($option, array_filter(array_unique(array_column($myChildList, 'optionname2'))));
$option = array_merge($option, array_filter(array_unique(array_column($myChildList, 'optionname3'))));
$option = array_filter($option);

?>
<?php if($myChildList) {?>
<div class="box">
        <header><h2><?php echo T_("List of product variants"); ?></h2></header>
  <div class="pad jboxPrice">

  	    	<input type="hidden" name="wholeeditchild" value="wholeeditchild">

              <div class="tblBox mT10">
                <table class="tbl1 v5 fs09 responsive">
                  <tbody>
                    <?php foreach ($myChildList as $key => $value) {?>

                    <?php $myId = \dash\get::index($value, 'id'); ?>

                      <tr>
                        <td class="collapsing"><?php echo \dash\fit::number($key + 1); ?></td>
                        <?php if(\dash\get::index($value, 'optionname1')) {?>
                          <td>
                          <div class="input">
                            <label class="addon small" for="whole_optionvalue1_<?php echo $myId; ?>"><?php echo \dash\get::index($value, 'optionname1'); ?></label>
                            <input  type="text" name="whole_optionvalue1_<?php echo $myId; ?>" id="whole_optionvalue1_<?php echo $myId; ?>" placeholder2='<?php echo T_("Price"); ?>' value="<?php echo \dash\get::index($value, 'optionvalue1'); ?>" >
                          </div>

                          </td>
                        <?php } //endif ?>

                        <?php if(\dash\get::index($value, 'optionname2')) {?>
                          <td>
                          <div class="input">
                            <label class="addon small" for="whole_optionvalue2_<?php echo $myId; ?>"><?php echo \dash\get::index($value, 'optionname2'); ?></label>
                            <input  type="text" name="whole_optionvalue2_<?php echo $myId; ?>" id="whole_optionvalue2_<?php echo $myId; ?>" placeholder2='<?php echo T_("Price"); ?>' value="<?php echo \dash\get::index($value, 'optionvalue2'); ?>" >
                          </div>

                          </td>

                        <?php } //endif ?>

                        <?php if(\dash\get::index($value, 'optionname3')) {?>
                          <td>
                          <div class="input">
                            <label class="addon small" for="whole_optionvalue3_<?php echo $myId; ?>"><?php echo \dash\get::index($value, 'optionname3'); ?></label>
                            <input  type="text" name="whole_optionvalue3_<?php echo $myId; ?>" id="whole_optionvalue3_<?php echo $myId; ?>" placeholder2='<?php echo T_("Price"); ?>' value="<?php echo \dash\get::index($value, 'optionvalue3'); ?>" >
                          </div>

                          </td>
                        <?php } //endif ?>

                        <td>
                          <div class="input">
                            <label class="addon small" for="whole_buyprice_<?php echo $myId; ?>"><?php echo T_("Buy price"); ?></label>
                            <input  type="text" name="whole_buyprice_<?php echo $myId; ?>" id="whole_buyprice_<?php echo $myId; ?>" placeholder2='<?php echo T_("Price"); ?>' value="<?php echo \dash\get::index($value, 'buyprice'); ?>" data-format='price' minlength="0" maxlength="15">
                          </div>
                        </td>

                        <td>
                          <div class="input">
                            <label class="addon small" for="whole_price_<?php echo $myId; ?>"><?php echo T_("Price"); ?></label>
                            <input  type="text" name="whole_price_<?php echo $myId; ?>" id="whole_price_<?php echo $myId; ?>" placeholder2='<?php echo T_("Price"); ?>' value="<?php echo \dash\get::index($value, 'price'); ?>" data-format='price' minlength="0" maxlength="15">
                          </div>
                        </td>

                        <td>
                          <div class="input">
                            <label class="addon small" for="whole_discount_<?php echo $myId; ?>"><?php echo T_("Discount"); ?></label>
                            <input  type="text" name="whole_discount_<?php echo $myId; ?>" id="whole_discount_<?php echo $myId; ?>" placeholder2='<?php echo T_("Discount"); ?>' value="<?php echo \dash\get::index($value, 'discount'); ?>" data-format='price' minlength="0" maxlength="15">
                          </div>
                        </td>

                        <td>
                          <div class="input">
                          <label class="addon small" for="whole_stock_<?php echo $myId; ?>"><?php echo T_("Stock"); ?></label>
                            <input  type="text" name="whole_stock_<?php echo $myId; ?>" id="whole_stock_<?php echo $myId; ?>" placeholder='<?php echo \dash\fit::number(\dash\get::index($value, 'stock')); ?>' data-format='price' minlength="0" maxlength="15">
                          </div>
                        </td>

                        <td>
                          <div data-confirm data-data='{"remove": "remove", "id": "<?php echo \dash\get::index($value, 'id'); ?>"}'><i class="sf-trash fc-red fs12"></i></div>
                        </td>

                      </tr>


                    <?php } //endfor ?>
                  </tbody>
                </table>
              </div>




  </div>
</div>
          <?php } //endif ?>
