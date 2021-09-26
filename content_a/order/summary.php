<?php $orderDetail = \dash\data::orderDetail(); ?>
<div class="tblBox">
	<table class="tbl1 v4">
		<tbody>
              <?php if(a($orderDetail, 'factor', 'subprice')) {?>
              <tr class="">
                <td class="collapsing fc-mute"><?php echo T_("Subprice") ?></td>
                <td colspan="3" class=""><?php echo \dash\fit::number(a($orderDetail, 'factor', 'subprice')). ' '. \lib\store::currency(); ?></td>
              </tr>
            <?php } //endif ?>

              <?php if(a($orderDetail, 'factor', 'subdiscount')) {?>
              <tr class="">
                <td class="collapsing fc-mute"><?php echo T_("Subdiscount") ?></td>
                <td colspan="3" class=""><?php echo \dash\fit::number(a($orderDetail, 'factor', 'subdiscount')). ' '. \lib\store::currency(); ?></td>
              </tr>
            <?php } //endif ?>


            <?php if(a($orderDetail, 'factor', 'subvat')) {?>
              <tr class="">
                <td class="collapsing fc-mute"><?php echo T_("Vat") ?></td>
                <td colspan="3" class=""><?php echo \dash\fit::number(a($orderDetail, 'factor', 'subvat')). ' '. \lib\store::currency(); ?></td>
              </tr>
            <?php } //endif ?>

              <?php if(a($orderDetail, 'factor', 'discount')) {?>
                <tr>
                  <td class="collapsing fc-mute"><?php echo T_("Discount") ?></td>
                  <td colspan="3"><?php echo \dash\fit::number(a($orderDetail, 'factor', 'discount')). ' '. \lib\store::currency(); ?></td>
                </tr>
              <?php } //endif ?>


              <?php if(a($orderDetail, 'factor', 'discount2')) {?>
                <tr class="active">
                  <td class="collapsing fc-mute"><?php echo T_("Discount code") ?></td>
                  <td><?php echo \dash\fit::number(a($orderDetail, 'factor', 'discount2')). ' '. \lib\store::currency(); ?></td>
                  <td><code><?php echo a($orderDetail, 'discount_code', 'code') ?></code></td>
                  <td><a class="link sm" href="<?php echo \dash\url::here(). '/discount/edit?id='. a($orderDetail, 'factor', 'discount_id') ?>" data-direct><?php echo T_("Show Discount") ?></a></td>
                  <td class="collapsing">
                    <?php if(\dash\url::child() === 'discount') {?>
                    <div class="btn linkDel" data-confirm data-data='{"removediscount": "removediscount"}'><?php echo T_("Remove discount") ?></div>
                    <?php } //endif ?>
                  </td>
                </tr>
              <?php } //endif ?>

                <tr>
                  <td class="collapsing fc-mute"><?php echo T_("Shipping") ?></td>
              		<?php if(a($orderDetail, 'factor', 'shipping')) {?>
                  		<td colspan="3"><?php echo \dash\fit::number(a($orderDetail, 'factor', 'shipping')). ' '. \lib\store::currency(); ?></td>
	              	<?php }else{ ?>
	              		<td colspan="3"><span class="fc-green"><?php echo T_("Free") ?></span></td>
	              	<?php } //endif ?>
                </tr>


              <tr class="active">
                <td class="collapsing fc-mute"><?php echo T_("Total") ?></td>
                <td colspan="3" class="txtB font-16"><?php echo \dash\fit::number(a($orderDetail, 'factor', 'total')). ' '. \lib\store::currency(); ?></td>
              </tr>

		</tbody>
	</table>

</div>
