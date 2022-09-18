<?php


$pluginList = \dash\data::pluginList();

if(!is_array($pluginList))
{
	$pluginList = [];
}

$pluginKeywords = \dash\data::pluginKeywords();

if(!is_array($pluginKeywords))
{
	$pluginKeywords = [];
}


$html = '';


// foreach ($pluginKeywords as $key => $value)
// {
// 	$html.= '<a class="btn-outline-primary mr-5" href="'. \dash\url::that(). \dash\request::full_get(['category' => $value]). '">#'. $value. '</a>';
// }
// if(\dash\request::get())
// {
// 	$html.= '<a class="btn-outline-primary mr-5" href="'. \dash\url::that(). '">'. T_("Clear filter"). '</a>';
// }
// 	$html.= '<a class="btn-outline-primary mr-5" href="'. \dash\url::that(). \dash\request::full_get(['activated' => 1]). '">'. T_("Activated"). '</a>';


/*========================================
=            search in plugin            =
========================================*/
// $html .= '<form method="get" class="mt-5 mb-5" autocomplete="off" action="'.\dash\url::that().'">';
// {
// 	$html .= '<div class="input">';
// 	{
// 		$html .= '<input type="text" name="q" value="'. \dash\request::get('q'). '">';
// 		$html .= '<button class="addon btn"><img class="w-3" src="'. \dash\utility\icon::url('Search'). '"></button>';
// 	}
// 	$html .= '</div>';
// }
// $html .= '</form>';



/*=====  End of search in plugin  ======*/


$html .= '<section class="text-gray-600 body-font">';
{

	$html .= '<div class="row">';
	{
		foreach ($pluginList as $key => $value)
		{
			$html .= '<div class="c-xs-12 c-sm-12 c-md-6 c-lg-4 flex p-2">';
			{
				$is_activated = false;

				$html .= '<div class="bg-white rounded-xl w-full">';
				{

					$html .= '<div class="p-4 flex">';
					{

						$html .= '<div class="flex flex-col">';
						{
							$html .= '<div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-4 flex-shrink-0 shrink-0 p-1">';
							{
								$icon = a($value, 'icon');

								if($icon && is_array($icon))
								{
									$html .= \dash\utility\icon::svg(...$icon);
								}
								elseif(is_string($icon))
								{
									$html .= $icon;
								}

							}
							$html .= '</div>';

							if($is_activated)
							{
								$html .= '<div class="w-8 h-8 inline-flex items-center justify-center rounded-full mb-4 flex-shrink-0 shrink-0 p-1" title="'.T_("Activated").'">';
								{
									$html .= \dash\utility\icon::svg('check-circle-fill', 'bootstrap', 'green');
								}
								$html .= '</div>';
							}
							else
							{
								$html .= '<div class="w-8 h-8 inline-flex items-center justify-center rounded-full mb-4 flex-shrink-0 shrink-0 p-1"></div>';

							}
						}
						$html .= '</div>';

						$html .= '<div class="flex-grow pl-6 pr-6">';
						{

							$html .= '<h2 class="text-gray-900 text-lg title-font font-medium mb-2">';
							{
								$html .= a($value, 'title');
							}
							$html .= '</h2>';

							// if(a($value, 'price') === 0)
							// {
							// 	$html .= '<div class="text-green-500">'.  T_("Free"). '</div>';
							// }
							// else
							// {
							// 	$html .= '<div class="">';
							// 	{
							// 		$html .= '<span class="">';
							// 		{
							// 			$html .= T_("Price");
							// 		}
							// 		$html .= '</span> ';

							// 		$html .= '<span class="">';
							// 		{
							// 			$html .= \dash\fit::number(a($value, 'price'));
							// 		}
							// 		$html .= '</span>';


							// 	}
							// 	$html .= '</div>';
							// }

							$html .= '<p class="leading-relaxed text-base">';
							{
								$html .= a($value, 'description');
							}
							$html .= '</p>';

							$html .= '<a class="mt-3 text-indigo-500 inline-flex items-center" href="'. \dash\url::that(). '/view/'.  a($value, 'plugin'). '">';
							{
								if($is_activated)
								{
									$html .= T_("View detail");

								}
								else
								{
									$html .= T_("Add plugin");
								}
							}
							$html .= '</a>';
						}
						$html .= '</div>';
					}
					$html .= '</div>';
				}
				$html .= '</div>';


			}
			$html .= '</div>';
		} // end for
	}
	$html .= '</div>';

}
$html .= '</section>';


echo $html;

\dash\utility\pagination::html();
?>