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
	/*=============================
	=            Chart            =
	=============================*/
	$html .= '<div id="chartdivreportsale" class="box chart x400" data-abc="report/sale"></div>';
	$html .= '<div class="hide">';
	{
  		$html .= '<div id="charttitle">'. T_("Sale report").'</div>';
  		$html .= '<div id="chartcategory">'. a($report, 'chart', 'categories').'</div>';
  		$html .= '<div id="chartvalue">'. a($report, 'chart', 'chartvalue').'</div>';

	}
	$html .= '</div>';
	/*=====  End of Chart  ======*/

	$html .= '<div class="tblBox fs12">';
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
						$html .= '<td>'. \dash\fit::date(a($value, 'groupbykey')). '</td>';
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