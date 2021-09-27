<?php

$dataRow = \dash\data::dataRow();
$currency = \lib\store::currency();
$dedicated = \dash\data::discountDedicate();


$html = '';
$html .= '<div class="max-w-xl m-auto">';
{
	$html .= '<form method="post" autocomplete="off" id="discountadd">';
	{
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
						$html .= '<label for="code">'. T_("Discount code"). '</label>';
					}
					$html .= '</div>';


				}
				$html .= '</div>';
				$html .= '<div class="input ltr">';
				{
					$html .= '<input type="text" name="code" value="'.a($dataRow, 'code').'" placeholder="'.T_("e.g. SPRINGSALE").'">';
				}
				$html .= '</div>';
			}
			$html .= '</div>';

			$html .= '<footer>';
			{
				$html .= '<button class="btn-success">'. T_("Make duplicate"). '</button>';
			}
			$html .= '</footer>';

		}
		$html .= '</div>';
		/*=====  End of Discount code  ======*/


	}
	$html .= '</form>';

}
$html .= '</div>';


echo $html;
?>