<?php

$dataRow   = \dash\data::dataRow();
$currency  = \lib\store::currency();
$dedicated = \dash\data::discountDedicate();


$html = '';
$html .= '<div class="max-w-xl m-auto">';
{
	$html .= '<form method="post" autocomplete="off" id="discountadd">';
	{
		if(a($dataRow, 'status') === 'deleted')
		{
			$html .= '<div class="alert-danger font-bold">';
			{
				$html .= T_("This discount code was deleted");
			}
			$html .= '</div>';
		}
		elseif(a($dataRow, 'status') === 'draft')
		{
			$html .= '<div class="alert-primary" data-ajaxify data-data=\'{"status" : "enable", "setstatus" : "1"}\' data-method="post">';
			{
				$html .= T_("To publish discount code click here");
			}
			$html .= '</div>';
		}
		/*=====================================
		=            Discount code            =
		=====================================*/
		$html .= '<div class="box">';
		{
			$html .= '<div class="body">';
			{
				$html .= '<div class="flex">';
				{
					$html .= '<div class="flex-1">';
					{
						$html .= '<label for="code">' . T_("Discount code") . '</label>';
					}
					$html .= '</div>';

					if(false)
					{
						$html .= '<div class="">';
						{
							$html .= '<button class="link-secondary text-xs" for="code">' . T_("Generate code") . ' Only in local mode </button>';
						}
						$html .= '</div>';
					}

				}
				$html .= '</div>';
				$html .= '<div class="input ltr">';
				{
					$html .= '<input type="text" name="code" value="' . a($dataRow, 'code') . '" placeholder="' . T_("e.g. SPRINGSALE") . '">';
				}
				$html .= '</div>';

				$html .= '<label for="code" class=""><small>' . T_("Customers will enter this discount code at checkout.") . '</small></label>';

				if(false)
				{
					$html .= '<textarea name="desc" class="txt" row="3" placeholder="' . T_("Description") . '">' . a($dataRow, 'desc') . '</textarea>';
				}
			}
			$html .= '</div>';
		}
		$html .= '</div>';
		/*=====  End of Discount code  ======*/


		/*=============================
		=            types            =
		=============================*/
		$html .= '<div class="box">';
		{
			$html .= '<div class="body">';
			{
				$html .= '<h2>' . T_("Type") . '</h2>';

				$html .= '<div class="radio1">';
				{
					$html .= '<input type="radio" name="type" value="percentage" id="type-percentage" ' . ((a($dataRow, 'type') === 'percentage' || !a($dataRow, 'type')) ? 'checked' : '') . '>';
					$html .= '<label for="type-percentage">' . T_("Percentage") . '</label>';
				}
				$html .= '</div>';

				$html .= '<div class="radio1">';
				{
					$html .= '<input type="radio" name="type" value="fixed_amount" id="type-fixed_amount" ' . (a($dataRow, 'type') === 'fixed_amount' ? 'checked' : '') . '>';
					$html .= '<label for="type-fixed_amount">' . T_("Fixed amount") . '</label>';
				}
				$html .= '</div>';

				$html .= '<div class="radio1">';
				{
					$html .= '<input type="radio" name="type" value="free_shipping" id="type-free_shipping" ' . (a($dataRow, 'type') === 'free_shipping' ? 'checked' : '') . '>';
					$html .= '<label for="type-free_shipping">' . T_("Free shipping") . '</label>';
				}
				$html .= '</div>';
			}
			$html .= '</div>';
		}
		$html .= '</div>';
		/*=====  End of types  ======*/


		/*=============================
		=            value            =
		=============================*/
		$data_response_hide = null;
		if(a($dataRow, 'type') === 'free_shipping')
		{
			$data_response_hide = 'data-response-hide';
		}

		$html .= '<div data-response="type" data-response-where="percentage|fixed_amount" ' . $data_response_hide . '>';
		{
			$html .= '<div class="box">';
			{

				$html .= '<div class="body">';
				{
					$html .= '<h2>' . T_("Value") . '</h2>';

					$data_response_hide = 'data-response-hide';
					if(a($dataRow, 'type') === 'percentage' || !a($dataRow, 'type'))
					{
						$data_response_hide = null;
					}

					$html .= '<div data-response="type" data-response-where="percentage" ' . $data_response_hide . '>';
					{
						$html .= '<label for="percentage">' . T_("Discount value") . ' (' . T_("%") . ') </label>';
						$html .= '<div class="input">';
						{
							$html .= '<input type="tel" name="percentage" id="percentage" value="' . a($dataRow, 'percentage') . '"  maxlength="3">';
							$html .= '<label for="percentage" class="addon" >' . T_("%") . '</lable>';
						}
						$html .= '</div>';


						$html .= '<label for="maxamount">' . T_("Maximum amount") . '</label>';
						$html .= '<div class="input">';
						{
							$html .= '<input type="tel" name="maxamount" id="maxamount" value="' . round(floatval(a($dataRow, 'maxamount'))) . '" placeholder="' . $currency . '" data-format="price" maxlength="18">';
							$html .= '<label for="maxamount" class="addon" >' . $currency . '</lable>';

						}
						$html .= '</div>';

					}
					$html .= '</div>';

					$data_response_hide = 'data-response-hide';
					if(a($dataRow, 'type') === 'fixed_amount')
					{
						$data_response_hide = null;
					}

					$html .= '<div data-response="type" data-response-where="fixed_amount" ' . $data_response_hide . '>';
					{
						$html .= '<label for="fixedamount">' . T_("Discount value") . ' (' . $currency . ') </label>';
						$html .= '<div class="input">';
						{
							$html .= '<input type="tel" name="fixedamount" id="fixedamount" value="' . round(floatval(a($dataRow, 'fixedamount'))) . '" placeholder="' . $currency . '" data-format="price" maxlength="18">';
							$html .= '<label for="fixedamount" class="addon" >' . $currency . '</lable>';
						}
						$html .= '</div>';
					}
					$html .= '</div>';

				}
				$html .= '</div>';
			}
			$html .= '</div>';
		}
		$html .= '</div>';
		/*=====  End of value  ======*/


		/*================================
		=            apply to            =
		================================*/
		$html .= '<div class="box">';
		{

			$html .= HTML_discount_professional_is_not_activate();


			$html .= '<div class="body">';
			{
				$html .= '<h2>' . T_("Apply to") . '</h2>';

				$html .= '<div class="radio1">';
				{
					$html .= '<input type="radio" name="applyto" value="all_products" id="applyto-all_products" ' . ((a($dataRow, 'applyto') === 'all_products' || !a($dataRow, 'applyto')) ? 'checked' : '') . '>';
					$html .= '<label for="applyto-all_products">' . T_("All product") . '</label>';
				}
				$html .= '</div>';

				$html .= '<div class="radio1">';
				{
					$html .= '<input type="radio" name="applyto" value="special_category" id="applyto-special_category" ' . (a($dataRow, 'applyto') === 'special_category' ? 'checked' : '') . '>';
					$html .= '<label for="applyto-special_category">' . T_("Special category") . '123</label>';
				}
				$html .= '</div>';

				$data_response_hide = 'data-response-hide';
				if(a($dataRow, 'applyto') === 'special_category')
				{
					$data_response_hide = null;
				}

				$html .= '<div data-response="applyto" data-response-where="special_category" ' . $data_response_hide . '>';
				{
					$html .= '<select name="product_category[]" id="product_category" class="select22" multiple="multiple" data-ajax--delay="100" data-ajax--url="' . \dash\url::kingdom() . '/a/category/api?json=true&getid=1' . '" >';
					{
						$current_category_id = [];

						if(is_array(a($dedicated, 'special_category')))
						{
							$current_category_id = array_column($dedicated['special_category'], 'product_category_id');
						}

						if(is_array(a($dedicated, 'special_category')))
						{
							foreach ($dedicated['special_category'] as $key => $value)
							{
								$html .= '<option value="' . $value['title'] . '" ';
								$html .= ' selected';
								$html .= '>';
								$html .= $value['title'];
								$html .= '</option>';
							}
						}

					}
					$html .= '</select>';
				}
				$html .= '</div>';


				$html .= '<div class="radio1">';
				{
					$html .= '<input type="radio" name="applyto" value="special_products" id="applyto-special_products" ' . (a($dataRow, 'applyto') === 'special_products' ? 'checked' : '') . '>';
					$html .= '<label for="applyto-special_products">' . T_("Special products") . '</label>';
				}
				$html .= '</div>';

				$data_response_hide = 'data-response-hide';
				if(a($dataRow, 'applyto') === 'special_products')
				{
					$data_response_hide = null;
				}

				$html .= '<div data-response="applyto" data-response-where="special_products" ' . $data_response_hide . '>';
				{
					$html .= '<select name="special_products[]" id="special_products" class="select22" data-model="tag" multiple="multiple" data-ajax--delay="100" data-ajax--url="' . \dash\url::kingdom() . '/a/products/api?json=true&mode=text' . '" data-placeholder="' . T_('Search in products') . '">';

					$current_products = [];

					if(is_array(a($dedicated, 'special_products')))
					{
						$current_products = $dedicated['special_products'];
					}

					foreach ($current_products as $key => $value)
					{
						$html .= '<option value="' . a($value, 'product_id') . '" selected>' . a($value, 'product_title') . '</option>';
					}
					$html .= '</select>';
				}
				$html .= '</div>';

			}
			$html .= '</div>';
		}
		$html .= '</div>';
		/*=====  End of apply to  ======*/


		/*============================================
		=            Minimum requirements            =
		============================================*/
		$html .= '<div class="box">';
		{
			$html .= HTML_discount_professional_is_not_activate();
			$html .= '<div class="body">';
			{
				$html .= '<h2>' . T_("Minimum requirements") . '</h2>';

				$html .= '<div class="radio1">';
				{
					$html .= '<input type="radio" name="minrequirements" value="none" id="minimum-none" checked>';
					$html .= '<label for="minimum-none">' . T_("None") . '</label>';
				}
				$html .= '</div>';

				$html .= '<div class="radio1">';
				{
					$html .= '<input type="radio" name="minrequirements" value="amount" id="minimum-amount">';
					$html .= '<label for="minimum-amount">' . T_("Minimum purchase amount :currency", ['currency' => '(' . $currency . ')']) . '</label>';
				}
				$html .= '</div>';

				$data_response_hide = 'data-response-hide';
				if(a($dataRow, 'minrequirements') === 'amount')
				{
					$data_response_hide = null;
				}

				$html .= '<div data-response="minrequirements" data-response-where="amount" ' . $data_response_hide . '>';
				{
					$html .= '<div class="input">';
					{
						$html .= '<input type="tel" name="minpurchase" value="' . round(floatval(a($dataRow, 'minpurchase'))) . '" placeholder="' . $currency . '" data-format="price" maxlength="18">';
						$html .= '<label for="minpurchase" class="addon" >' . $currency . '</lable>';
					}
					$html .= '</div>';
				}
				$html .= '</div>';

				$html .= '<div class="radio1">';
				{
					$html .= '<input type="radio" name="minrequirements" value="quantity" id="minimum-quantity">';
					$html .= '<label for="minimum-quantity">' . T_("Minimum quantity of items") . '</label>';
				}
				$html .= '</div>';

				$data_response_hide = 'data-response-hide';
				if(a($dataRow, 'minrequirements') === 'quantity')
				{
					$data_response_hide = null;
				}

				$html .= '<div data-response="minrequirements" data-response-where="quantity" ' . $data_response_hide . '>';
				{
					$html .= '<div class="input">';
					{
						$html .= '<input type="tel" name="minquantity" value="' . a($dataRow, 'minquantity') . '" data-format="price" maxlength="4">';
					}
					$html .= '</div>';
				}
				$html .= '</div>';

			}
			$html .= '</div>';
		}
		$html .= '</div>';
		/*=====  End of Minimum requirements  ======*/


		/*============================================
		=            Customer eligibility            =
		============================================*/
		$html .= '<div class="box">';
		{
			$html .= HTML_discount_professional_is_not_activate();
			$html .= '<div class="body">';
			{
				$html .= '<h2>' . T_("Customer eligibility") . '</h2>';

				$html .= '<div class="radio1">';
				{
					$html .= '<input type="radio" name="customer" value="everyone" id="customer-everyone" ' . ((a($dataRow, 'customer') === 'everyone' || !a($dataRow, 'customer')) ? 'checked' : '') . '>';
					$html .= '<label for="customer-everyone">' . T_("Everyone") . '</label>';
				}
				$html .= '</div>';

				$html .= '<div class="radio1">';
				{
					$html .= '<input type="radio" name="customer" value="special_customer_group" id="customer-special_customer_group" ' . (a($dataRow, 'customer') === 'special_customer_group' ? 'checked' : '') . '>';
					$html .= '<label for="customer-special_customer_group">' . T_("Special group of customers") . '</label>';
				}
				$html .= '</div>';

				$data_response_hide = 'data-response-hide';
				if(a($dataRow, 'customer') === 'special_customer_group')
				{
					$data_response_hide = null;
				}

				$html .= '<div data-response="customer" data-response-where="special_customer_group" ' . $data_response_hide . '>';
				{
					$html .= '<select name="customer_group" id="customer_group" class="select22">';
					{
						$customer_group = \lib\app\discount\dedicated::customer_group();

						$current_group = [];

						if(is_array(a($dedicated, 'special_customer_group')))
						{
							$current_group = array_column($dedicated['special_customer_group'], 'specailvalue');
						}

						foreach ($customer_group as $key => $value)
						{
							$html .= '<option value="' . $value['key'] . '" ';

							if(in_array($value['key'], $current_group))
							{
								$html .= ' selected';
							}
							$html .= '>';

							$html .= $value['title'];
							$html .= '</option>';
						}
					}
					$html .= '</select>';
				}
				$html .= '</div>';

				$html .= '<div class="radio1">';
				{
					$html .= '<input type="radio" name="customer" value="special_customer" id="customer-special_customer" ' . (a($dataRow, 'customer') === 'special_customer' ? 'checked' : '') . '>';
					$html .= '<label for="customer-special_customer">' . T_("Special customers") . '</label>';
				}
				$html .= '</div>';

				$data_response_hide = 'data-response-hide';
				if(a($dataRow, 'customer') === 'special_customer')
				{
					$data_response_hide = null;
				}

				$html .= '<div data-response="customer" data-response-where="special_customer" ' . $data_response_hide . '>';
				{
					$html .= '<select name="special_customer[]" id="special_customer" class="select22" multiple="multiple" data-ajax--delay="100" data-ajax--url="' . \dash\url::kingdom() . '/crm/api?json=true&mode=text' . '" data-placeholder="' . T_('Search in customers123') . '">';

					$current_customer = [];

					if(is_array(a($dedicated, 'special_customer')))
					{
						$current_customer = $dedicated['special_customer'];
					}


					foreach ($current_customer as $key => $value)
					{
						$html .= '<option value="' . \dash\coding::encode(a($value, 'customer_id')) . '" selected>' . a($value, 'customer_name') . '</option>';
					}

					$html .= '</select>';
				}
				$html .= '</div>';

			}
			$html .= '</div>';
		}
		$html .= '</div>';
		/*=====  End of Customer eligibility  ======*/


		/*===================================
		=            Usage limit            =
		===================================*/
		$html .= '<div class="box">';
		{

			$html .= '<div class="body">';
			{
				$html .= '<h2>' . T_("Usage limits") . '</h2>';

				$html .= '<div class="check1">';
				{
					$html .= '<input type="checkbox" name="set_usagetotal"  id="set_usagetotal" ' . (a($dataRow, 'usagetotal') ? 'checked' : '') . '>';
					$html .= '<label for="set_usagetotal">' . T_("Limit number of times this discount can be used in total") . '</label>';
				}
				$html .= '</div>';


				$data_response_hide = 'data-response-hide';
				if(a($dataRow, 'usagetotal'))
				{
					$data_response_hide = null;
				}

				$html .= '<div data-response="set_usagetotal" ' . $data_response_hide . '>';
				{
					$html .= '<div class="input">';
					{
						$html .= '<input type="tel" id="usagetotal" name="usagetotal" value="' . a($dataRow, 'usagetotal') . '" data-format="price" maxlength="9">';
						$html .= '<label for="usagetotal" class="addon" >' . T_("Times") . '</lable>';
					}
					$html .= '</div>';
				}
				$html .= '</div>';

				$html .= HTML_discount_professional_is_not_activate();
				$html .= '<div class="check1">';
				{
					$html .= '<input type="checkbox" name="usageperuser"  id="usageperuser" ' . (a($dataRow, 'usageperuser') ? 'checked' : '') . '>';
					$html .= '<label for="usageperuser">' . T_("Limit to one use per customer") . '</label>';
				}
				$html .= '</div>';

			}
			$html .= '</div>';
		}
		$html .= '</div>';
		/*=====  End of Usage limit  ======*/


		/*===================================
		=            Active date            =
		===================================*/
		$html .= '<div class="box">';
		{
			$html .= '<div class="body">';
			{
				$html .= '<h2>' . T_("Active date") . '</h2>';

				$html .= '<div class="flex">';
				{
					$html .= '<div class="flex-1">';
					{
						$html .= '<label for="startdate">' . T_("Start date") . '</label>';
						$html .= '<div class="input ltr">';
						{
							$html .= '<input type="text" name="startdate" value="' . \dash\fit::date_en(a($dataRow, 'startdate')) . '" id="startdate" placeholder="' . \dash\fit::date_en(date("Y-m-d")) . '" data-format="date">';
						}
						$html .= '</div>';
					}
					$html .= '</div>';;

					$html .= '<div class="flex-1 mr-1 ml-1">';
					{
						$html .= '<label for="starttime">' . T_("Time") . '</label>';
						$html .= '<div class="input ltr">';
						{
							$html .= '<input type="text" name="starttime" value="' . date("H:i", (a($dataRow, 'startdate') ? strtotime(a($dataRow, 'startdate')) : null)) . '" id="starttime" placeholder="' . date("H:i") . '" data-format="time">';
						}
						$html .= '</div>';
					}
					$html .= '</div>';

				}
				$html .= '</div>';

				$html .= HTML_discount_professional_is_not_activate();
				$html .= '<div class="check1">';
				{
					$html .= '<input type="checkbox" name="setenddate"  id="setenddate" ' . (a($dataRow, 'enddate') ? 'checked' : '') . '>';
					$html .= '<label for="setenddate">' . T_("Set end date") . '</label>';
				}
				$html .= '</div>';


				$data_response_hide = 'data-response-hide';
				if(a($dataRow, 'enddate'))
				{
					$data_response_hide = null;
				}

				$html .= '<div data-response="setenddate" ' . $data_response_hide . '>';
				{
					$html .= '<div class="flex">';
					{
						$html .= '<div class="flex-1">';
						{
							$html .= '<label for="enddate">' . T_("End date") . '</label>';
							$html .= '<div class="input ltr">';
							{
								$html .= '<input type="text" name="enddate" value="' . \dash\fit::date_en(a($dataRow, 'enddate')) . '" id="enddate" placeholder="' . \dash\fit::date_en(date("Y-m-d")) . '" data-format="date">';
							}
							$html .= '</div>';
						}
						$html .= '</div>';


						$html .= '<div class="flex-1 mr-1 ml-1">';
						{
							$html .= '<label for="endtime">' . T_("Time") . '</label>';
							$html .= '<div class="input ltr">';
							{
								$html .= '<input type="text" name="endtime" value="' . date("H:i", (a($dataRow, 'enddate') ? strtotime(a($dataRow, 'enddate')) : null)) . '" id="endtime" placeholder="' . date("H:i") . '" data-format="time">';
							}
							$html .= '</div>';
						}
						$html .= '</div>';
					}
					$html .= '</div>';
				}
				$html .= '</div>';
			}
			$html .= '</div>';
		}
		$html .= '</div>';
		/*=====  End of Active date  ======*/


		$html .= '<div class="box">';
		{
			$html .= '<div class="body">';
			{
				$html .= '<h2>' . T_("Message after applying the discount code") . '</h2>';

				$html .= '<textarea name="msgsuccess" rows="2" class="txt" placeholder="' . T_("Discount code applied") . '">' . a($dataRow, 'msgsuccess') . '</textarea>';
				$html .= '<div class="text-gray-400">' . T_("This message displayed after applying discount by customer") . '</div>';
			}
			$html .= '</div>';
		}
		$html .= '</div>';


		/*==============================
		=            Status            =
		==============================*/
		$html .= '<div class="box">';
		{
			$html .= '<div class="body">';
			{
				$html .= '<h2>' . T_("Status") . '</h2>';

				$html .= '<div class="radio1">';
				{
					$html .= '<input type="radio" name="status" value="draft" id="status-draft" ' . ((a($dataRow, 'status') === 'draft' || !a($dataRow, 'status')) ? 'checked' : '') . '>';
					$html .= '<label for="status-draft">' . T_("Draft") . '</label>';
				}
				$html .= '</div>';

				$html .= '<div class="radio1 green">';
				{
					$html .= '<input type="radio" name="status" value="enable" id="status-enable" ' . (a($dataRow, 'status') === 'enable' ? 'checked' : '') . '>';
					$html .= '<label for="status-enable">' . T_("Enable") . '</label>';
				}
				$html .= '</div>';

				if(a($dataRow, 'status') === 'deleted')
				{
					$html .= '<div class="radio1 red">';
					{
						$html .= '<input type="radio" name="status" value="deleted" id="status-deleted" ' . (a($dataRow, 'status') === 'deleted' ? 'checked' : '') . '>';
						$html .= '<label for="status-deleted">' . T_("Deleted") . '</label>';
					}
					$html .= '</div>';
				}
			}
			$html .= '</div>';
		}
		$html .= '</div>';
		/*=====  End of Status  ======*/

	}
	$html .= '</form>';

	if(\dash\data::editMode() && a($dataRow, 'status') !== 'deleted')
	{
		$html .= '<button class="btn-outline-danger mb-5" data-confirm data-data=\'{"remove": "remove"}\'>' . T_("Remove Discount code") . '</button>';
	}
}
$html .= '</div>';


function HTML_discount_professional_is_not_activate()
{

	$plugin_discount_is_activated = \lib\app\plan\planCheck::access('professionalDiscount');

	if(!$plugin_discount_is_activated)
	{
		$title = \lib\app\plan\planMessage::needUpgrade();
		$link  = \lib\app\plan\planMessage::getLink();
		return '<a class="alert2 alert-danger content-center p-3 block" href="' . $link . '" data-direct target="_blank">' . $title . '</a>';
	}

	return null;
}

echo $html;
?>