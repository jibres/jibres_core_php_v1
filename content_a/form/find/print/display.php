<?php
$html = '';

if(\dash\data::specailPage())
{
	$html .= \dash\data::specailPage();
}
else
{
	$html .= '<div class="printArea" data-size="A4">';
	{

		$html .= '<div class="alert-info text-left ltr font-bold text-sm">';
		{

			$html .= '<div class="f">';
			{

				$html .= '<div class="cauto">';
				{

					$html .= '<span>' . T_("Answer ID") . '</span>';
					$html .= '<span><code class="inline-block font-bold">' . \dash\request::get('id') . '_' . \dash\request::get('aid') . '</code></span>';
				}
				$html .= '</div>';

				$html .= '<div class="c"></div>';

				$html .= '<div class="cauto">';
				{
					$html .= '<a class="font-14 print:hidden" href="' . \dash\url::current() . \dash\request::full_get(['print' => null]) . '">' . T_("Back") . '</a>';
				}
				$html .= '</div>';
			}
			$html .= '</div>';
		}
		$html .= '</div>';

		$html .= '<table class="tbl1 v6">';
		{

			$html .= '<tbody class="text-sm">';
			{

				$i = 0;
				foreach (\dash\data::dataTable() as $key => $value)
				{
					$i++;
					if($i % 2)
					{
						$html .= '<tr>';
					}

					$html .= '<th class="">' . a($value, 'item_title') . '</th>';
					$html .= '<td class="">';
					{
						$html .= \lib\app\form\answer\get::HTMLshowDetaiRecrod($value);
					}
					$html .= '</td>';
					if(!($i % 2))
					{
						$html .= '</tr>';
					}
				}
			}
			$html .= '</tbody>';
		}
		$html .= '</table>';

	}
	$html .= '</div>';

	$html .= \dash\utility\pagination::html(true);


}

echo $html;
?>