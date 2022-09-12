<?php
namespace content_love\plan;

class planDetail
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
						$html .= '<div class="key">' . T_("Plan") . '</div>';
						$html .= '<div class="value font-bold">' . T_(ucfirst(strval(a($data, 'plan')))) . '</div>';
					}
					$html .= '</a>';
				}
				$html .= '</li>';

				$html .= '<li>';
				{
					$html .= '<a class="f item">';
					{
						$html .= '<div class="key">' . T_("Start date") . '</div>';
						$html .= '<div class="value font-bold">' . \dash\fit::date_time(a($data, 'startdate')) . '</div>';
					}
					$html .= '</a>';
				}
				$html .= '</li>';

				$html .= '<li>';
				{
					$html .= '<a class="f item">';
					{
						$html .= '<div class="key">' . T_("End date") . '</div>';
						$html .= '<div class="value font-bold">' . (a($data, 'expirydate') ? \dash\fit::date_time(a($data, 'expirydate')) : '-')  . '</div>';
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
