<?php
namespace content_love\plan;

class storeDetail
{
	public static function html($data)
	{
		$html = '';
		$html .= '<nav class="items">';
		{
			$html .= '<ul>';
			{
				$html .= '<li>';
				{
					$html .= '<a class="f item">';
					{
						$html .= '<div class="key">' . T_("ID") . '</div>';
						$html .= '<div class="value font-bold">' . a($data, 'id') . '</div>';
					}
					$html .= '</a>';
				}
				$html .= '</li>';

				$html .= '<li>';
				{
					$html .= '<a class="f item">';
					{
						$html .= '<div class="key">' . T_("Business title") . '</div>';
						$html .= '<div class="value font-bold">' . a($data, 'title') . '</div>';
					}
					$html .= '</a>';
				}
				$html .= '</li>';

				$html .= '<li>';
				{
					$html .= '<a class="f item">';
					{
						$html .= '<div class="key">' . T_("Current plan") . '</div>';
						$html .= '<div class="value font-bold">' . T_(ucfirst(strval(a($data, 'plan')))) . '</div>';
					}
					$html .= '</a>';
				}
				$html .= '</li>';


				$html .= '<li>';
				{
					$html .= '<a class="f item">';
					{
						$html .= '<div class="key">' . T_("Current plan expire date") . '</div>';
						$html .= '<div class="value font-bold">' . (a($data, 'planexp') ? \dash\fit::date_time(a($data, 'planexp')) : '-') . '</div>';
					}
					$html .= '</a>';
				}
				$html .= '</li>';

				$html .= '<li>';
				{
					$html .= '<a class="f item" href="' . \dash\url::this() . '/datalist?business_id=' . a($data, 'id') . '">';
					{
						$html .= '<div class="key"></div>';
						$html .= '<div class="value">' . T_("Go to plan list") . '</div>';
					}
					$html .= '</a>';
				}
				$html .= '</li>';
			}
			$html .= '</ul>';
		}
		$html .= '</nav>';

		return $html;
	}
}
