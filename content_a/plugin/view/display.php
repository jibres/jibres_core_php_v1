<?php

$pluginDetail = \dash\data::pluginDetail();
$currency     = \lib\store::currency();

$is_activated = \lib\app\plugin\business::is_activated(\dash\data::pluginKey());

$payable      = (!$is_activated || a($pluginDetail, 'type') !== 'once');

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

				if(a($pluginDetail, 'type') === 'periodic' && is_array(a($pluginDetail, 'price_list')))
				{
					foreach ($pluginDetail['price_list'] as $key => $value)
					{

						$html .= '<div class="radio3">';
						{
							$checked = null;
							if(a($value, 'default'))
							{
								$checked = 'checked';
							}

							$html .= '<input type="radio" name="periodic" value="'.a($value, 'key').'" id="periodic_'.a($value, 'key').'" '.$checked.'>';
							$html .= '<label for="periodic_'.a($value, 'key').'">'.a($value, 'title').'</label>';
						}
						$html .= '</div>';
					}
				}
				else
				{
					if(a($pluginDetail, 'price') === 0)
					{
						$html .= '<div class="text-green-500">'.  T_("Free"). '</div>';
					}
					else
					{
						$html .= '<div class="">'.  \dash\fit::number(a($pluginDetail, 'price')). '</div>';
					}
				}

				if($payable)
				{
					if(\dash\data::myBudget() && a($pluginDetail, 'price'))
					{
						$html .= '<div class="alert2">';
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

			if($payable)
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