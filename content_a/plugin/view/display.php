<?php

$pluginDetail = \dash\data::pluginDetail();

$currency     = \lib\store::currency();

$is_activated = \lib\app\plugin\business::is_activated(\dash\data::pluginKey());

$payable      = (!$is_activated || a($pluginDetail, 'type') !== 'once');

$html = '';
$html .= '<div class="">';
{
	$html .= '<form method="post" autocomplete="off" id="pluginadd">';
	{
		$html .= '<div class="bg-white rounded-lg">';
		{
			$html .= '<div class="p-4">';
			{
				$html .= '<h1 class="text-3xl">';
				{
					$html .= a($pluginDetail, 'title');
				}
				$html .= '</h1>';

				$html .= '<p class="mb-4">';
				{
					$html .= a($pluginDetail, 'description');
				}
				$html .= '</p>';

				if($more_detail = \lib\app\plugin\get::more_detail(a($pluginDetail, 'name')))
				{
					$html .= $more_detail;
				}

				if(a($pluginDetail, 'keywords'))
				{
					$html .= '<div class="mt-3">';
					{
						foreach ($pluginDetail['keywords'] as $tag)
						{
							$link = \dash\url::this(). \dash\request::full_get(['category' => $tag]);

							$html .= '<a href="'.$link.'" class="link-primary p-3">';
							{
								$html .= '#'. $tag;
							}
							$html .= '</a>';
						}
					}
					$html .= '</div>';
				}

				$html .= '<div class="alert-info">';
				{
					$html .= '<span class=""> '.  T_("Price"). ' </span>';

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
							$html .= '<span class="text-green-500">'.  T_("Free"). '</span>';
						}
						else
						{
							$html .= '<span class="">';
							{
								$html .= \dash\fit::number(a($pluginDetail, 'price'));

								$html .= '<small class=""> ';
								{
									$html .= a($pluginDetail, 'currency');
								}
								$html .= '</small>';

							}
							$html .= '</span>';
						}
					}
				}
				$html .= '</div>';


				if($payable)
				{
					if(\dash\data::myBudget() && a($pluginDetail, 'price'))
					{
						$html .= '<div class=" rounded-lg">';
						{

							$html .= '<div class="check1">';
							{
								$html .= '<input type="checkbox" name="use_budget" id="use_budget">';
								$html .= '<label for="use_budget">';
								{
									$html .= T_('Use from budget');
									$html .= '( ';
									{
										$html .= \dash\fit::number(\dash\data::myBudget_budget());
										$html .= ' ';
										$html .= \dash\data::myBudget_currency();
									}
									$html .= ' )';

								}
								$html .= '</label>';
							}
							$html .= '</div>';
						}
						$html .= '</div>';


					}
				}
				else
				{
					$html .= '<div class="alert-success mt-4 font-bold">'.  T_('This plugin is active in your business'). '</div>';
				}


			}
			$html .= '</div>';

			if($payable)
			{
				$html .= '<div class="p-4">';
				{
					if(a($pluginDetail, 'price'))
					{
						$html .= '<button class="btn-success">'. T_("Buy"). '</button>';
					}
					else
					{
						$html .= '<button class="btn-success">'. T_("Get it for free"). '</button>';
					}
				}
				$html .= '</div>';
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