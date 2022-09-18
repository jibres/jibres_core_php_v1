<?php

$pluginDetail           = \dash\data::pluginDetail();

$currency               = \lib\store::currency();

$plugin                 = \dash\data::pluginKey();

$is_activated           = false;

$business_plugin_detail = \lib\app\plugin\business::detail($plugin);

$expiredate = a($business_plugin_detail, 'expiredate');

$in_discount_time       = \lib\app\plugin\get::in_discount_time($plugin);

$payable                = \lib\app\plugin\get::can_start_new_pay($is_activated, $plugin, $expiredate);

$html = '';


if(\dash\data::activatedList())
{
	$html .= '<div class="mt-4">';
	{
		$html .= '<table class="tbl1 v9">';
		{
			$html .= '<thead>';
			{
				$html .= '<tr>';
				{
					$html .= '<th colspan="4">'. T_("Active package").'</th>';
				}
				$html .= '</tr>';
				$html .= '<tr>';
				{
					$html .= '<th>'. T_("Date register").'</th>';
					$html .= '<th>'. T_("Package count").'</th>';
					$html .= '<th>'. T_("Usage count").'</th>';
					$html .= '<th>'. T_("Remain count").'</th>';
				}
				$html .= '</tr>';
			}
			$html .= '</thead>';

			$html .= '<tbody>';
			{
				foreach (\dash\data::activatedList() as $key => $value)
				{
					$html .= '<tr>';
					{
						$html .= '<td>'. \dash\fit::date_time(a($value, 'datecreated')) .'</td>';
						$html .= '<td>'. \dash\fit::number(a($value, 'packagecount')) .'</td>';
						$html .= '<td>'. \dash\fit::number(a($value, 'usagecount')) .'</td>';
						$html .= '<td>'. \dash\fit::number(a($value, 'remaincount')) .'</td>';
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

$html .= '<div class="">';
{
	$html .= '<form method="post" autocomplete="off" id="pluginadd">';
	{
		$html .= '<div class="bg-white rounded-lg">';
		{
			$html .= '<div class="p-4">';
			{
				$html .= '<div class="flex">';
				{
					$html .= '<div class="flex-grow">';
					{

						$html .= '<h1 class="text-3xl">';
						{
							$html .= a($pluginDetail, 'title');
						}
						$html .= '</h1>';
					}
					$html .= '</div>';

					$html .= '<div class="w-16 text-indigo-500 ">';
					{
						if(a($pluginDetail, 'icon') && is_array($pluginDetail['icon']))
						{
							$icon = $pluginDetail['icon'];
							$html .= \dash\utility\icon::svg(...$icon);
						}
						elseif(a($pluginDetail, 'icon') && is_string($pluginDetail['icon']))
						{
							$html .= $pluginDetail['icon'];
						}
					}
					$html .= '</div>';
				}
				$html .= '</div>';

				$html .= '<p class="mb-4">';
				{
					$html .= a($pluginDetail, 'description');
				}
				$html .= '</p>';

				if($more_detail = \lib\app\plugin\get::more_detail(a($pluginDetail, 'name')))
				{
					$html .= '<div class="mb-4">';
					{
						$html .= $more_detail;
					}
					$html .= '</div>';
				}

				if($in_discount_time && $payable)
				{
					$html .= '<div class="alert-primary font-bold">';
					{
						$html .= '<div>';
						{
							$html .= T_("All plugin are offered with a %90 discount up to one week after their release date");
						}
						$html .= '</div>';

						$html .= '<div>';
						{
							$html .= T_("You are currently in the %90 discount period");
						}
						$html .= '</div>';

						$html .= '<div>';
						{
							$html .= T_("So do not miss the opportunity and get the plugin right now");
						}
						$html .= '</div>';
					}
					$html .= '</div>';

				}

				if($payable)
				{

					if(in_array(a($pluginDetail, 'type'), ['periodic', 'counting_package']) && is_array(a($pluginDetail, 'price_list')))
					{
						if(a($pluginDetail, 'type') === 'periodic')
						{
							$html .= '<div class="mb-2"> '.  T_("Please choose one periodic"). ' </div>';
							$select_name = 'periodic';
						}
						else
						{
							$html .= '<div class="mb-2"> '.  T_("Please choose one package"). ' </div>';
							$select_name = 'package';
						}

						foreach ($pluginDetail['price_list'] as $key => $value)
						{
							$checked = null;
							if(a($value, 'default'))
							{
								$checked = 'checked';
							}

							$html .= '<div class="radio4">';
							{

								$html .= '<input id="'.$select_name. $key.'" type="radio" name="'.$select_name.'" value="'.a($value, 'key').'" '. $checked. '>';

								$html .= '<label for="'.$select_name. $key.'">';
								{
									$html .= '<div>';
									{
										$html .= '<span class="font-bold mx-2">';
										{
											$html .= a($value, 'title');
										}
										$html .= '</span>';


										$html .= '<span>';
										{
											$html .= \dash\fit::number(\lib\app\plugin\get::payable_price($plugin, a($value, 'price')));
										}
										$html .= '</span>';

										if(a($value, 'comperatprice') && a($value, 'comperatprice') > \lib\app\plugin\get::payable_price($plugin, a($value, 'price')))
										{
											$html .= '<span class="mx-2 line-through decoration-red-700" style="text-decoration-color: red; text-decoration-thickness: 1px;">';
											{
												$html .= \dash\fit::number(a($value, 'comperatprice'));
											}
											$html .= '</span>';
										}

										$html .= '<span class="mx-2">';
										{
											$html .= a($pluginDetail, 'currency');
										}
										$html .= '</span>';

										// if($in_discount_time)
										// {
										// 	$html .= '('.\dash\fit::number(90). T_("%"). ' '.T_("Discount").')';
										// }

									}
									$html .= '</div>';
								}
								$html .= '</label>';
							}
							$html .= '</div>';
						}
					}
					else
					{
						$html .= '<div class="mb-2"> '.  T_("Price"). ' </div>';

						$html .= '<div class="alert-info">';
						{

							if(a($pluginDetail, 'price') === 0)
							{
								$html .= '<span class="text-green-500">'.  T_("Free"). '</span>';
							}
							else
							{
								$html .= '<span class="">';
								{
									$html .= \dash\fit::number(\lib\app\plugin\get::payable_price($plugin, a($pluginDetail, 'price')));

									$html .= '<small class=""> ';
									{
										$html .= a($pluginDetail, 'currency');
									}
									$html .= '</small>';

								}
								$html .= '</span>';
							}
						}
						$html .= '</div>';
					}

				}

				if($payable)
				{
					if(\dash\data::myBudget())
					{
						$html .= '<div class="p-2">';
						{

							$html .= '<div class="switch1">';
							{
								$html .= '<input type="checkbox" name="use_budget" id="use_budget">';
								$html .= '<label for="use_budget"></label>';
								$html .= '<label for="use_budget">';
								{
									$html .= T_('Use from budget');
									$html .= ' ( ';
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

				if($is_activated)
				{

					if($expiredate)
					{
						$html .= '<div class="alert-success mt-4 font-bold">'.  T_('Your plugin is activated until :date', ['date' => \dash\fit::date($expiredate, 'j F Y')]). '</div>';
					}
					else
					{
						$html .= '<div class="alert-success mt-4 font-bold">'.  T_('This plugin is active in your business'). '</div>';
					}

				}
			}
			$html .= '</div>';

			$html .= '<div class="row">';
			{
				$html .= '<div class="c-auto">';
				{

					if($payable)
					{
						$html .= '<div class="p-4">';
						{
							if(a($pluginDetail, 'price') || a($pluginDetail, 'price_list'))
							{
								$html .= '<button class="btn-success">'. T_("Buy now"). '</button>';
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

				$html .= '<div class="c"></div>';
				$html .= '<div class="c-auto">';
				{
					if(a($pluginDetail, 'keywords'))
					{
						$html .= '<div class="p-4">';
						{
							foreach ($pluginDetail['keywords'] as $tag)
							{
								$link = \dash\url::this(). \dash\request::full_get(['category' => $tag]);

								$html .= '<a href="'.$link.'" class="link-primary p-2">';
								{
									$html .= '#'. $tag;
								}
								$html .= '</a>';
							}
						}
						$html .= '</div>';
					}
				}
				$html .= '</div>';
			}
			$html .= '</div>';


		}
		$html .= '</div>';
		/*=====  End of plugin  ======*/


	}
	$html .= '</form>';

}
$html .= '</div>';


echo $html;
?>