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
	$html .= '<div class="tblBox">';
	{
		$html .= '<table class="tbl1 v6">';
		{
			$html .= '<thead>';
			{
				$html .= '<tr>';
				{
					$html .= '<th class="collapsing">'. T_("Count"). '</th>';
					$html .= '<th>'. T_("Title"). '</th>';
					$html .= '<th>'. T_("Buy price"). '</th>';
					$html .= '<th>'. T_("Sale Price"). '</th>';
					$html .= '<th>'. T_("Sale Discount"). '</th>';
					$html .= '<th class="collapsing"></th>';
				}
				$html .= '</tr>';
			}
			$html .= '</thead>';

			$html .= '<tbody>';
			{
				foreach (\dash\data::orderDetail() as $key => $value)
				{
					$html .= '<tr>';
					{
						$html .= '<td class="collapsing">';
						{
							$html .= \dash\fit::number(a($value, 'suggestion', 'count'));

							if(a($value, 'suggestion', 'multiple'))
							{
								$html .= '<span class="text-red-500 text-xl font-bold"> * </span>';
							}
						}
						$html .= '</td>';

						$html .= '<td>';
						{
							$html .= \dash\layout\elements\input::hidden(['name' => 'product_id[]', 'value' => a($value, 'product_id')]);

							$html .= \dash\layout\elements\input::text(['name' => 'title[]', 'value' => a($value, 'title')]);
						}
						$html .= '</td>';

						$html .= '<td>';
						{
							$html .= \dash\layout\elements\input::text(['name' => 'buyprice[]', 'value' => a($value, 'suggestion', 'buyprice')]);
						}
						$html .= '</td>';

						$html .= '<td>';
						{
							$html .= \dash\layout\elements\input::text(['name' => 'price[]', 'value' => a($value, 'suggestion', 'price')]);
						}
						$html .= '</td>';

						$html .= '<td>';
						{
							$html .= \dash\layout\elements\input::text(['name' => 'discount[]', 'value' => a($value, 'suggestion', 'discount')]);
						}
						$html .= '</td>';

						$html .= '<td class="collapsing">';
						{
							$html .= '<a class="" data-fancybox data-type="iframe" target="_blank" href="'. \dash\url::here(). '/products/quick?id='. a($value, 'product_id'). '&iframe=buy">'. \dash\utility\icon::svg('box-arrow-up-right', 'bootstrap', 'blue', ' h-3 w-3'). '</a>';
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
$html .= \dash\layout\elements\form::_form();



echo $html;


?>