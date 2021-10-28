<?php

$pluginDetail = \dash\data::pluginDetail();
$currency = \lib\store::currency();

$is_activated = \lib\app\plugin\business::is_activated(\dash\data::pluginKey());

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

				if(a($pluginDetail, 'price') === 0)
				{
					$html .= '<div class="text-green-500">'.  T_("Free"). '</div>';
				}
				else
				{
					$html .= '<div class="">'.  \dash\fit::number(a($pluginDetail, 'price')). '</div>';
				}

				if(!$is_activated)
				{
					if(\dash\data::myBudget() && a($pluginDetail, 'price'))
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
							$html .= '<input type="checkbox" name="use_budget" id="use_budget">';
							$html .= '<label for="use_budget">Use budget</label>';
						}
						$html .= '</div>';
					}
				}
				else
				{
					$html .= '<div class="text-green-500 font-bold">'.  T_('Activated'). '</div>';
				}


			}
			$html .= '</div>';

			if(!$is_activated)
			{
				$html .= '<footer>';
				{
					if(a($pluginDetail, 'price'))
					{
						$html .= '<button class="btn-danger">'. T_("Buy"). '</button>';
					}
					else
					{
						$html .= '<button class="btn-success">'. T_("Get it for free"). '</button>';
					}
				}
				$html .= '</footer>';
			}

		}
		$html .= '</div>';
		/*=====  End of plugin  ======*/


	}
	$html .= '</form>';

}
$html .= '</div>';


echo $html;
?>