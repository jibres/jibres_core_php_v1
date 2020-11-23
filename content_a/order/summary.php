<?php $orderDetail = \dash\data::orderDetail(); ?>
<div class="tblBox">
	<table class="tbl1 v4">
		<tbody>
              <?php if(\dash\get::index($orderDetail, 'factor', 'subprice')) {?>
              <tr class="">
                <td class="collapsing fc-mute"><?php echo T_("Subprice") ?></td>
                <td class=""><?php echo \dash\fit::number(\dash\get::index($orderDetail, 'factor', 'subprice')). ' '. \lib\store::currency(); ?></td>
              </tr>
            <?php } //endif ?>

              <?php if(\dash\get::index($orderDetail, 'factor', 'subdiscount')) {?>
              <tr class="">
                <td class="collapsing fc-mute"><?php echo T_("Subdiscount") ?></td>
                <td class=""><?php echo \dash\fit::number(\dash\get::index($orderDetail, 'factor', 'subdiscount')). ' '. \lib\store::currency(); ?></td>
              </tr>
            <?php } //endif ?>


            <?php if(\dash\get::index($orderDetail, 'factor', 'subvat')) {?>
              <tr class="">
                <td class="collapsing fc-mute"><?php echo T_("Vat") ?></td>
                <td class=""><?php echo \dash\fit::number(\dash\get::index($orderDetail, 'factor', 'subvat')). ' '. \lib\store::currency(); ?></td>
              </tr>
            <?php } //endif ?>

              <?php if(\dash\get::index($orderDetail, 'factor', 'discount')) {?>
                <tr>
                  <td class="collapsing fc-mute"><?php echo T_("Discount") ?></td>
                  <td><?php echo \dash\fit::number(\dash\get::index($orderDetail, 'factor', 'discount')). ' '. \lib\store::currency(); ?></td>
                </tr>
              <?php } //endif ?>
                <tr>
                  <td class="collapsing fc-mute"><?php echo T_("Shipping") ?></td>
              		<?php if(\dash\get::index($orderDetail, 'factor', 'shipping')) {?>
                  		<td><?php echo \dash\fit::number(\dash\get::index($orderDetail, 'factor', 'shipping')). ' '. \lib\store::currency(); ?></td>
	              	<?php }else{ ?>
	              		<td><span class="fc-green"><?php echo T_("Free") ?></span></td>
	              	<?php } //endif ?>
                </tr>


              <tr class="active">
                <td class="collapsing fc-mute"><?php echo T_("Total") ?></td>
                <td class="txtB font-16"><?php echo \dash\fit::number(\dash\get::index($orderDetail, 'factor', 'total')). ' '. \lib\store::currency(); ?></td>
              </tr>

		</tbody>
	</table>

</div>
