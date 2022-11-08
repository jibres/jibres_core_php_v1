<?php
require_once(root . 'content_a/products/productName.php');

$storData           = \dash\data::store_store_data();
$productDataRow     = \dash\data::productDataRow();
$have_variant_child = \dash\data::productDataRow_variant_child();
$child_list         = \dash\data::productDataRow_child();

if(!is_array($child_list))
{
	$child_list = [];
}

?>
<form method="post" autocomplete="off" id="form1">

	<?php

	if($have_variant_child)
	{
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

		if($myChildList)
		{

			?>
            <div class="box">
                <div class="pad jboxPrice">
                    <div class="f">
                        <div class="cauto"><p><?php echo T_("Manage each variant product independently"); ?></p></div>
                        <div class="c"></div>
                        <div class="cauto"><a class="btn-link"
                                              href="<?php echo \dash\url::this() . '/variants?id=' . \dash\request::get('id'); ?>"><?php echo T_("Edit options") ?></a>
                        </div>
                    </div>

                    <input type="hidden" name="wholeeditchild" value="wholeeditchild">

                    <div class="tblBox mt-2">
                        <table class="tbl1 v5 fs09 responsive">
                            <tbody>
							<?php foreach ($myChildList as $key => $value) { ?>

								<?php $myId = a($value, 'id'); ?>

                                <tr data-removeElement>
                                    <td class="collapsing"><?php echo \dash\fit::number($key + 1); ?></td>
									<?php if(a($value, 'optionname1')) { ?>
                                        <td>
                                            <div class="input">
                                                <label class="addon small"
                                                       for="whole_optionvalue1_<?php echo $myId; ?>"><?php echo a($value, 'optionname1'); ?></label>
                                                <input type="text" name="whole_optionvalue1_<?php echo $myId; ?>"
                                                       id="whole_optionvalue1_<?php echo $myId; ?>"
                                                       value="<?php echo a($value, 'optionvalue1'); ?>">
                                            </div>

                                        </td>
									<?php } //endif ?>

									<?php if(a($value, 'optionname2')) { ?>
                                        <td>
                                            <div class="input">
                                                <label class="addon small"
                                                       for="whole_optionvalue2_<?php echo $myId; ?>"><?php echo a($value, 'optionname2'); ?></label>
                                                <input type="text" name="whole_optionvalue2_<?php echo $myId; ?>"
                                                       id="whole_optionvalue2_<?php echo $myId; ?>"
                                                       value="<?php echo a($value, 'optionvalue2'); ?>">
                                            </div>

                                        </td>

									<?php } //endif ?>

									<?php if(a($value, 'optionname3')) { ?>
                                        <td>
                                            <div class="input">
                                                <label class="addon small"
                                                       for="whole_optionvalue3_<?php echo $myId; ?>"><?php echo a($value, 'optionname3'); ?></label>
                                                <input type="text" name="whole_optionvalue3_<?php echo $myId; ?>"
                                                       id="whole_optionvalue3_<?php echo $myId; ?>"
                                                       value="<?php echo a($value, 'optionvalue3'); ?>">
                                            </div>

                                        </td>
									<?php } //endif ?>

                                    <td>
                                        <div class="input">
                                            <label class="addon small"
                                                   for="whole_buyprice_<?php echo $myId; ?>"><?php echo T_("Buy price"); ?></label>
                                            <input type="tel" name="whole_buyprice_<?php echo $myId; ?>"
                                                   id="whole_buyprice_<?php echo $myId; ?>"
                                                   value="<?php echo a($value, 'buyprice'); ?>" data-format='price'
                                                   minlength="0" maxlength="15">
                                        </div>
                                    </td>

                                    <td>
                                        <div class="input">
                                            <label class="addon small"
                                                   for="whole_price_<?php echo $myId; ?>"><?php echo T_("Price"); ?></label>
                                            <input type="tel" name="whole_price_<?php echo $myId; ?>"
                                                   id="whole_price_<?php echo $myId; ?>"
                                                   value="<?php echo a($value, 'price'); ?>" data-format='price'
                                                   minlength="0" maxlength="15">
                                        </div>
                                    </td>

                                    <td>
                                        <div class="input">
                                            <label class="addon small"
                                                   for="whole_discount_<?php echo $myId; ?>"><?php echo T_("Discount"); ?></label>
                                            <input type="tel" name="whole_discount_<?php echo $myId; ?>"
                                                   id="whole_discount_<?php echo $myId; ?>"
                                                   value="<?php echo a($value, 'discount'); ?>" data-format='price'
                                                   minlength="0" maxlength="15">
                                        </div>
                                    </td>

                                    <td>
                                        <div class="input">
                                            <label class="addon small"
                                                   for="whole_stock_<?php echo $myId; ?>"><?php echo T_("Stock"); ?></label>
                                            <input type="tel" name="whole_stock_<?php echo $myId; ?>"
                                                   id="whole_stock_<?php echo $myId; ?>"
                                                   placeholder='<?php echo \dash\fit::number(a($value, 'stock')); ?>'
                                                   data-format minlength="0" maxlength="15">
                                        </div>
                                    </td>

                                    <td>
                                        <div data-confirm
                                             data-data='{"remove": "remove", "id": "<?php echo a($value, 'id'); ?>"}'><?php echo \dash\utility\icon::svg('trash', 'bootstrap', 'red', 'w-3') ?></div>
                                    </td>

                                </tr>


							<?php } //endfor
							?>
                            </tbody>
                        </table>
                    </div>
                    <div class="addNewLine" data-kerkere-content='hide'>
                        <div class="tblBox">
                            <table class="tbl1 v5 fs09 responsive">
                                <tbody>
                                <tr>
                                    <td class="collapsing"><i class="sf-asterisk text-red-800"></i></td>
									<?php if(a($value, 'optionname1')) { ?>
                                        <td>
                                            <div class="input">
                                                <label class="addon small"
                                                       for="new_optionvalue1"><?php echo a($value, 'optionname1'); ?></label>
                                                <input type="text" name="new_optionvalue1" id="new_optionvalue1">
                                            </div>

                                        </td>
									<?php } //endif
									?>

									<?php if(a($value, 'optionname2')) { ?>
                                        <td>
                                            <div class="input">
                                                <label class="addon small"
                                                       for="new_optionvalue2"><?php echo a($value, 'optionname2'); ?></label>
                                                <input type="text" name="new_optionvalue2" id="new_optionvalue2">
                                            </div>

                                        </td>

									<?php } //endif
									?>

									<?php if(a($value, 'optionname3')) { ?>
                                        <td>
                                            <div class="input">
                                                <label class="addon small"
                                                       for="new_optionvalue3"><?php echo a($value, 'optionname3'); ?></label>
                                                <input type="text" name="new_optionvalue3" id="new_optionvalue3">
                                            </div>

                                        </td>
									<?php } //endif
									?>

                                    <td>
                                        <div class="input">
                                            <label class="addon small"
                                                   for="new_buyprice"><?php echo T_("Buy price"); ?></label>
                                            <input type="tel" name="new_buyprice" id="new_buyprice" data-format='price'
                                                   minlength="0" maxlength="15">
                                        </div>
                                    </td>

                                    <td>
                                        <div class="input">
                                            <label class="addon small"
                                                   for="new_price"><?php echo T_("Price"); ?></label>
                                            <input type="tel" name="new_price" id="new_price" data-format='price'
                                                   minlength="0" maxlength="15">
                                        </div>
                                    </td>

                                    <td>
                                        <div class="input">
                                            <label class="addon small"
                                                   for="new_discount"><?php echo T_("Discount"); ?></label>
                                            <input type="tel" name="new_discount" id="new_discount" data-format='price'
                                                   minlength="0" maxlength="15">
                                        </div>
                                    </td>

                                    <td>
                                        <div class="input">
                                            <label class="addon small"
                                                   for="new_stock"><?php echo T_("Stock"); ?></label>
                                            <input type="tel" name="new_stock" id="whole_stock" data-format
                                                   minlength="0"
                                                   maxlength="15">
                                        </div>
                                    </td>

                                    <td>
                                    </td>

                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="btn-link" data-kerkere='.addNewLine'><?php echo T_("Add new variants") ?></div>
                </div>
            </div>
		<?php } else { /*have variant child but no child is founded. this is a bug!*/ ?>

            <div class="box">
                <div class="body">
                    <div class="f">
                        <div class="cauto"><p><?php echo T_("This product have not variants"); ?></p></div>
                        <div class="c"></div>
                        <div class="cauto"><a class="btn-link"
                                              href="<?php echo \dash\url::this() . '/variants?id=' . \dash\request::get('id'); ?>"><?php echo T_("Edit options") ?></a>
                        </div>
                    </div>
                </div>
            </div>

		<?php } //endif
		?>


	<?php } else { ?>
        <div class="box">
            <div class="body">
                <div class="f">
                    <div class="cauto"><p><?php echo T_("This product have not variants"); ?></p></div>
                    <div class="c"></div>
                    <div class="cauto"><a class="btn-link"
                                          href="<?php echo \dash\url::this() . '/variants?id=' . \dash\request::get('id'); ?>"><?php echo T_("Edit options") ?></a>
                    </div>
                </div>
            </div>
        </div>


	<?php } //endif ?>

</form>