<?php

$pluginDetail = \dash\data::pluginDetail();
$currency = \lib\store::currency();

$html = '';
$html .= '<div class="max-w-xl m-auto">';
{
	$html .= '<form method="post" autocomplete="off" id="pluginadd">';
	{
		/*=====================================
		=            plugin                  =
		=====================================*/
		$html .= '<div class="box">';
		{
			$html .= '<div class="body">';
			{
				$html .= a($pluginDetail, 'title');
				$html .= '<br>';
				$html .= a($pluginDetail, 'description');

				$html .= '<br>';
				$html .= 'Price';
				$html .= '<br>';
				$html .= a($pluginDetail, 'price');

				if(\dash\data::myBudget())
				{
					$html .= '<div class="msg">';
					{
						$html .= 'Your jibres budget';
						$html .= '<br>';
						$html .= \dash\data::myBudget_budget();
						$html .= '<br>';
						$html .= \dash\data::myBudget_currency();
					}
					$html .= '</div>';

					$html .= '<div class="check1">';
					{
						$html .= '<input type="checkbox" name="useasbudget" id="useasbudget">';
						$html .= '<label for="useasbudget">Use as budget</label>';
					}
					$html .= '</div>';
				}

			}
			$html .= '</div>';

			$html .= '<footer>';
			{
				$html .= '<button class="btn-danger">'. T_("Buy"). '</button>';
			}
			$html .= '</footer>';

		}
		$html .= '</div>';
		/*=====  End of plugin  ======*/


	}
	$html .= '</form>';

}
$html .= '</div>';


echo $html;
?>