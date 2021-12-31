<?php
$orderMeta = \dash\data::orderMeta();
$currency = \lib\store::currency();

$eshantion_html = '<span class="text-green-700">'. T_("This product is a bonus"). '</span>';
$html = '';

$html .= '<div class="alert-danger">';
{
	$html .= T_("On this page you can edit the buy price, sales price and product sales discount");
	$html .= '<br>'. T_("Products marked with * indicate that more than one item of this product has been found in the buy order and displayed buy price is sugeested.");
}
$html .= '</div>';


// if(a($orderMeta, 'profit'))
// {
// 	$html .= '<div class="alert-success">';
// 	{
// 		$html .= T_("Total profit on this order");
// 		$html .= '<span class="font-bold"> '. \dash\fit::number($orderMeta['profit']). ' </span>';
// 		$html .= $currency;
// 	}
// 	$html .= '</div>';
// }

// if(a($orderMeta, 'eshantion'))
// {
// 	$html .= '<div class="alert-primary">';
// 	{
// 		$html .= T_("Total prize on this order");
// 		$html .= '<span class="font-bold"> '. \dash\fit::number($orderMeta['eshantion']). ' </span>';
// 		$html .= $currency;
// 	}
// 	$html .= '</div>';
// }

$html .= \dash\layout\elements\form::form(['method' => 'post', 'id' => 'saveOpt']);
{
	foreach (\dash\data::orderDetail() as $key => $value)
	{
		$html .= '<div class="box cartPage">';
		{
			$html .= '<div class="pad">';
			{
				$html .= '<div class="cartItem2">';
				{
					$html .= '<div class="row align-center">';
					{
						$html .= '<div class="c-auto">';
						{
							$html .= '<img class="w-20 rounded-lg" src="'. a($value, 'thumb') .'" alt="'. a($value, 'title') .'">';
						}
						$html .= '</div>';

						$html .= '<div class="c">';
						{

							$html .= '<h3 class="title"><a href="'. a($value, 'edit_url') .'">'. a($value, 'title') .'</a></h3>';
							$html .= '<div class="priceShow" data-cart>';
							{

								$html .= '<span class="">'. T_("Current buy price") .'</span>';
								$html .= '<span class="price font-bold"> '. \dash\fit::number(a($value, 'price')) .'</span>';
								$html .= '<span class="unit"> '. $currency .'</span>';
							}
							$html .= '</div>';

							if(a($value, 'suggestion', 'discount'))
							{
								$html .= '<div class="fc-mute mB5 text-sm">';
								{
									$html .= '<span class="">'. T_("Discount") .'</span>';
									$html .= '<span class="price font-bold"> '. \dash\fit::number(a($value, 'discount')) .'</span>';
									$html .= '<span class="unit"> '. $currency .'</span>';
								}
								$html .= '</div>';
							}

							if(a($value, 'suggestion', 'vat'))
							{
								$html .= '<div class="fc-mute mB5 text-sm">';
								{
									$html .= '<span class="">'. T_("Vat") .'</span>';
									$html .= '<span class="price font-bold"> '. \dash\fit::number(a($value, 'suggestion', 'vat')) .'</span>';
									$html .= '<span class="unit"> '. $currency .'</span>';
								}
								$html .= '</div>';
							}

							$html .= '<span class="compact ltr fc-mute text-sm">'. \dash\fit::date_time(a($value, 'datecreated')) .'</span>';
						}
						$html .= '</div>';


						$html .= '<div class="c">';
						{

							$html .= '<div class="itemOperation">';
							{
								$html .= '<div class="productCount">';
								{
									$html .= '<span class="font-bold">';
									{
										$html .= \dash\fit::number(a($value, 'suggestion', 'count'));
									}
									$html .= '</span> ';
									$html .= a($value, 'unit');
								}
								$html .= '</div>';

								if(a($value, 'oprmerger', 'multiple_count') < 2 && a($value, 'suggestion', 'eshantion'))
								{
									$html .= $eshantion_html;
								}

							}
							$html .= '</div>';
						}
						$html .= '</div>';


						$html .= '<div class="c">';
						{
							$html .= '<div class="priceShow" data-cart>';
							{
								$html .= '<span class="">'. T_("Total payed in this order") .'</span>';
								$html .= '<span class="price font-bold"> '. \dash\fit::number(a($value, 'sum')) .'</span>';
								$html .= '<span class="unit"> '. $currency .'</span>';
							}
							$html .= '</div>';
						}
						$html .= '</div>';
					}
					$html .= '</div>';
				}
				$html .= '</div>';

				if(a($value, 'suggestion', 'multiple'))
				{
					$html .= '<div data-kerkere=".showMore" data-kerkere-icon="close" class="alert-primary mt-2">'. \dash\utility\icon::svg('asterisk', 'bootstrap', null, 'w-3 inline-block mx-3') . T_("More than one row of this product is registered in the order").' </div>';

					$html .= '<div class="showMore tblBox px-5" data-kerkere-content="hide">';
					{
						$html .= '<table class="tbl1 v4">';
						{
							$html .= '<thead>';
							{
								$html .= '<tr>';
								{
									$html .= '<th class="collapsing">#</th>';
									$html .= '<th>'. T_("Buy price"). '</th>';
									$html .= '<th>'. T_("Buy Discount"). '</th>';
									$html .= '<th>'. T_("Count"). '</th>';
									$html .= '<th>'. T_("Total"). '</th>';
									$html .= '<th></th>';
								}
								$html .= '</tr>';
							}
							$html .= '</thead>';

							$html .= '<tbody>';
							{
								for ($i = 0; $i < a($value, 'oprmerger', 'multiple_count') ; $i++)
								{
									$tr_class = null;

									if(a($value, 'oprmerger', 'eshantion', $i))
									{
										$tr_class = 'positive';
									}

									$html .= '<tr class="'. $tr_class.'">';
									{
										$html .= '<td class="collapsing">'. \dash\fit::number($i + 1). '</td>';
										$html .= '<td>'. \dash\fit::number(a($value, 'oprmerger', 'buyprice', $i)). ' '. $currency. '</td>';
										$html .= '<td>'. \dash\fit::number(a($value, 'oprmerger', 'discount', $i)). ' '. $currency. '</td>';
										$html .= '<td>'. \dash\fit::number(a($value, 'oprmerger', 'count', $i)). '</td>';
										$html .= '<td>'. \dash\fit::number(a($value, 'oprmerger', 'finalprice', $i)). ' '. $currency. '</td>';

										$html .= '<td>';
										{
											if(a($value, 'oprmerger', 'eshantion', $i))
											{
												$html .= $eshantion_html;
											}
										}
										$html .= '</td>';
									}
									$html .= '</tr>';
								}
							}
							$html .= '</tbody>';
						}
						$html .= '</table>';
					}
					$html .= '</div>';

				}


				$html .= \dash\layout\elements\input::hidden(['name' => 'product_id[]', 'value' => a($value, 'product_id')]);

				$html .= '<div class="row">';
				{
					$html .= '<div class="c">';
					{
						$html .= '<label>';
						{
							$buyprice = a($value, 'product_buyprice');

							if(a($value, 'suggestion', 'buyprice'))
							{
								$html .= T_("Buy price");

								$html .= ' <span class="text-gray-500"> ( ';
								$html .= T_("Based on the prize in the order"). ' ';
								$html .= '<b>'. \dash\fit::number(round(a($value, 'suggestion', 'buyprice'))). ' </b>';
								$html .= ' '. $currency;
								$html .= ' ) <span> ';

								$buyprice = a($value, 'suggestion', 'buyprice');
							}
							else
							{
								$html .= T_("Buy price");
							}

						}
						$html .= '</label>';

						$html .= '<div class="input">';
						{
							$html .= '<input type="tel" name="buyprice[]" value="'.$buyprice.'">';
							$html .= '<label class="addon">'. $currency. '</label>';
						}
						$html .= '</div>';

					}
					$html .= '</div>';

					$html .= '<div class="c">';
					{
						$html .= '<label>'. T_("Sale Price"). '</label>';

						$html .= '<div class="input">';
						{
							$html .= '<input type="tel" name="price[]" value="'. a($value, 'product_price').'" placeholder="'. a($value, 'product_price').'">';
							$html .= '<label class="addon">'. $currency. '</label>';
						}
						$html .= '</div>';
					}
					$html .= '</div>';

					$html .= '<div class="c">';
					{
						$html .= '<label>'. T_("Sale Discount"). '</label>';

						$html .= '<div class="input">';
						{
							$html .= '<input type="tel" name="discount[]" value="'. a($value, 'product_discount').'" placeholder="'. a($value, 'product_discount').'">';
							$html .= '<label class="addon">'. $currency. '</label>';
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
}
$html .= \dash\layout\elements\form::_form();






echo $html;


function html_show_min_max_avg($_value, $_field)
{
	$html = '';
	if(a($_value, 'oprmerger', 'multiple_count') > 1)
	{

		$html .= '<div class="text-sm">';
		{
			$html .= '<div class="row"><div class="c">'. T_("Minimum"). '</div><div class="c text-left ml-5">'. \dash\fit::number(min(a($_value, 'oprmerger', $_field))). '</div></div>';
			$html .= '<div class="row"><div class="c">'. T_("Average"). '</div><div class="c text-left ml-5">'. \dash\fit::number(array_sum(a($_value, 'oprmerger', $_field)) / count(a($_value, 'oprmerger', $_field))). '</div></div>';
			$html .= '<div class="row"><div class="c">'. T_("Maximum"). '</div><div class="c text-left ml-5">'. \dash\fit::number(max(a($_value, 'oprmerger', $_field))). '</div></div>';
		}
		$html .= '</div>';

	}
	return $html;
}
?>