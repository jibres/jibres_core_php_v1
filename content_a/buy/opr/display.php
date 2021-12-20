<?php
$html = '';


$html .= \dash\layout\elements\form::form(['method' => 'post']);
{
	$html .= '<div class="tblBox">';
	{
		$html .= '<table class="tbl1 v1">';
		{
			$html .= '<thead>';
			{
				$html .= '<tr>';
				{
					$html .= '<th>'. T_("Title"). '</th>';
					$html .= '<th>'. T_("Buy price"). '</th>';
					$html .= '<th>'. T_("Price"). '</th>';
					$html .= '<th>'. T_("Discount"). '</th>';
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
						$html .= '<td>';
						{
							$html .= \dash\layout\elements\input::hidden(['name' => 'product_id[]', 'value' => a($value, 'product_id')]);

							$html .= \dash\layout\elements\input::text(['name' => 'title[]', 'value' => a($value, 'title')]);
						}
						$html .= '</td>';

						$html .= '<td>';
						{
							$html .= \dash\fit::number(a($value, 'product_buyprice'));
						}
						$html .= '</td>';

						$html .= '<td>';
						{
							$html .= \dash\layout\elements\input::text(['name' => 'price[]', 'value' => a($value, 'product_price')]);
						}
						$html .= '</td>';

						$html .= '<td>';
						{
							$html .= \dash\layout\elements\input::text(['name' => 'discount[]', 'value' => a($value, 'product_discount')]);
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

	$html .= '<button class="btn-success">'. T_("Save"). '</button>';
}
$html .= \dash\layout\elements\form::_form();



echo $html;


?>