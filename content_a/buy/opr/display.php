<?php
$html = '';

$html .= '<div class="alert-danger">';
{
	$html .= T_("On this page you can edit the buy price, sales price and product sales discount");
	$html .= '<br>'. T_("Products marked with * indicate that more than one item of this product has been found in the buy order and displayed buy price is sugeested.");
}
$html .= '</div>';


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
							$html .= '<img class="w-20" src="'. a($value, 'thumb') .'" alt="'. a($value, 'title') .'">';
						}
						$html .= '</div>';

						$html .= '<div class="c">';
						{

							$html .= '<h3 class="title"><a href="'. a($value, 'edit_url') .'">'. a($value, 'title') .'</a></h3>';
							$html .= '<div class="priceShow" data-cart>';
							{

								$html .= '<span class="price font-bold"> '. \dash\fit::number(a($value, 'price')) .'</span>';
								$html .= '<span class="unit"> '. \lib\store::currency() .'</span>';
							}
							$html .= '</div>';

							if(a($value, 'discount'))
							{
									$html .= '<div class="fc-mute mB5 text-sm">';
								{
									$html .= '<span class="">'. T_("Discount") .'</span>';
									$html .= '<span class="price font-bold"> '. \dash\fit::number(a($value, 'discount')) .'</span>';
									$html .= '<span class="unit"> '. \lib\store::currency() .'</span>';
								}
								$html .= '</div>';
							}

							if(a($value, 'vat'))
							{
								$html .= '<div class="fc-mute mB5 text-sm">';
								{
									$html .= '<span class="">'. T_("Vat") .'</span>';
									$html .= '<span class="price font-bold"> '. \dash\fit::number(a($value, 'vat')) .'</span>';
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
										$html .= \dash\fit::number(a($value, 'count'));
									}
									$html .= '</span> ';
									$html .= a($value, 'unit');
								}
								$html .= '</div>';

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
					$html .= '<div class="alert-primary mt-2"> * '. T_("Multiple product in this order").' </div>';
				}


				$html .= \dash\layout\elements\input::hidden(['name' => 'product_id[]', 'value' => a($value, 'product_id')]);

				$html .= '<div class="row">';
				{
					$html .= '<div class="c">';
					{
						$html .= '<label>'. T_("Buy price"). '</label>';
						$html .= \dash\layout\elements\input::text(['name' => 'buyprice[]', 'value' => a($value, 'suggestion', 'buyprice')]);
					}
					$html .= '</div>';

					$html .= '<div class="c">';
					{
						$html .= '<label>'. T_("Sale Price"). '</label>';
						$html .= \dash\layout\elements\input::text(['name' => 'price[]', 'value' => a($value, 'suggestion', 'price')]);

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