<?php
$orderMeta = \dash\data::orderMeta();

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
// 		$html .= \lib\store::currency();
// 	}
// 	$html .= '</div>';
// }

// if(a($orderMeta, 'eshantion'))
// {
// 	$html .= '<div class="alert-primary">';
// 	{
// 		$html .= T_("Total prize on this order");
// 		$html .= '<span class="font-bold"> '. \dash\fit::number($orderMeta['eshantion']). ' </span>';
// 		$html .= \lib\store::currency();
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

								$html .= '<span class="price font-bold"> '. \dash\fit::number(a($value, 'suggestion', 'price')) .'</span>';
								$html .= '<span class="unit"> '. \lib\store::currency() .'</span>';
							}
							$html .= '</div>';

							if(a($value, 'suggestion', 'discount'))
							{
								$html .= '<div class="fc-mute mB5 text-sm">';
								{
									$html .= '<span class="">'. T_("Discount") .'</span>';
									$html .= '<span class="price font-bold"> '. \dash\fit::number(a($value, 'suggestion', 'discount')) .'</span>';
									$html .= '<span class="unit"> '. \lib\store::currency() .'</span>';
								}
								$html .= '</div>';
							}

							if(a($value, 'suggestion', 'vat'))
							{
								$html .= '<div class="fc-mute mB5 text-sm">';
								{
									$html .= '<span class="">'. T_("Vat") .'</span>';
									$html .= '<span class="price font-bold"> '. \dash\fit::number(a($value, 'suggestion', 'vat')) .'</span>';
									$html .= '<span class="unit"> '. \lib\store::currency() .'</span>';
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
								$html .= '<span class="">'. T_("Total") .'</span>';
								$html .= '<span class="price font-bold"> '. \dash\fit::number(a($value, 'sum')) .'</span>';
								$html .= '<span class="unit"> '. \lib\store::currency() .'</span>';
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
					$html .= '<div class="alert-primary mt-2">'. \dash\utility\icon::svg('asterisk', 'bootstrap', null, 'w-3 inline-block mx-3') . T_("More than one row of this product is registered in the order").' </div>';

					$html .= '<div class="tblBox px-5">';
					{
						$html .= '<table class="tbl1 v4">';
						{
							$html .= '<thead>';
							{
								$html .= '<tr>';
								{
									$html .= '<th class="collapsing">#</th>';
									$html .= '<th>'. T_("Buy price"). '</th>';
									$html .= '<th>'. T_("Discount"). '</th>';
									$html .= '<th>'. T_("Count"). '</th>';
									$html .= '<th>'. T_("Final price"). '</th>';
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
										$html .= '<td>'. \dash\fit::number(a($value, 'oprmerger', 'buyprice', $i)). '</td>';
										$html .= '<td>'. \dash\fit::number(a($value, 'oprmerger', 'discount', $i)). '</td>';
										$html .= '<td>'. \dash\fit::number(a($value, 'oprmerger', 'count', $i)). '</td>';
										$html .= '<td>'. \dash\fit::number(a($value, 'oprmerger', 'finalprice', $i)). '</td>';

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
							$html .= T_("Buy price");

							if(a($value, 'suggestion', 'new_buyprice') != a($value, 'suggestion', 'buyprice'))
							{
								$html .= ' <span class="text-gray-500"> (';
								$html .= T_("Buy price based on the prize in the order"). ' ';
								$html .= '<b>'. \dash\fit::number(round(a($value, 'suggestion', 'new_buyprice'))). ' </b>';
								$html .= ' '. \lib\store::currency();
								$html .= ') <span> ';
							}

						}
						$html .= '</label>';

						$html .= \dash\layout\elements\input::text(['name' => 'buyprice[]', 'value' => a($value, 'suggestion', 'buyprice')]);
					}
					$html .= '</div>';

					$html .= '<div class="c">';
					{
						$html .= '<label>'. T_("Sale Price"). '</label>';
						$html .= \dash\layout\elements\input::text(['name' => 'price[]', 'value' => a($value, 'suggestion', 'price'), 'placeholder' => a($value, 'suggestion', 'price')]);

					}
					$html .= '</div>';

					$html .= '<div class="c">';
					{
						$html .= '<label>'. T_("Discount"). '</label>';
						$html .= \dash\layout\elements\input::text(['name' => 'discount[]', 'value' => a($value, 'suggestion', 'discount')]);

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