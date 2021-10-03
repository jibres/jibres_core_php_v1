<?php
$report    = \dash\data::masterReport();
$reportRaw = a($report, 'raw');

if(!is_array($reportRaw))
{
	$reportRaw = [];
}

$html = '';

$html .= '<div class="avand">';
{
	$html .= '<div class="tblBox">';
	{
		$html .= '<table class="tbl1 v1">';
		{
			$html .= '<thead>';
			{
				$html .= '<tr>';
				{
					$html .= '<th>'. T_("Date"). '</th>';
					$html .= '<th>'. T_("Count"). '</th>';
					$html .= '<th>'. T_("Qty"). '</th>';
					$html .= '<th>'. T_("Total"). '</th>';
				}
				$html .= '</tr>';
			}
			$html .= '</thead>';

			$html .= '<tbody>';
			{
				foreach ($reportRaw as $key => $value)
				{
					$html .= '<tr>';
					{
						$html .= '<td>'. \dash\fit::date(a($value, 'date')). '</td>';
						$html .= '<td>'. \dash\fit::number_en(a($value, 'count')). '</td>';
						$html .= '<td>'. \dash\fit::number_en(a($value, 'qty')). '</td>';
						$html .= '<td>'. \dash\fit::price(a($value, 'total')). '</td>';
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
$html .= '</div>';

echo $html;

?>