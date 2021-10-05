<?php
$report    = \dash\data::masterReport();
$reportRaw = a($report, 'raw');

if(!is_array($reportRaw))
{
	$reportRaw = [];
}

$reportDate = a($report, 'date');

$html = '';



$html .= '<div class="avand">';
{
	/*====================================
	=            Filter chart            =
	====================================*/
	$html .= '<div class="box">';
	{
		// Date range
		$date_range = \lib\app\report\sale\get::date_range();

		// Group by
		$group_by   = \lib\app\report\sale\get::group_by();

		$html .= '<form method="get" autocomplete="off" action="'.\dash\url::that().'">';
		{
			$html .= '<div class="body">';
			{
				$html .= '<div class="row">';
				{
					$html .= '<div class="c-xs-12 c-sm-6 c-md-3">';
					{

						$html .= '<label for="daterange">'. T_("Date range"). '</label>';
						$html .= '<select class="select22" name="daterange">';
						{
							foreach ($date_range as $key => $value)
							{
								$selected = null;
								if(a($report, 'daterange') === $key)
								{
									$selected = 'selected';
								}
								$html .= "<option value='$key' $selected>$value</option>";
							}
						}
						$html .= '</select>';
					}
					$html .= '</div>';



					$html .= '<div class="c-xs-12 c-sm-6 c-md-3">';
					{

						$html .= '<label for="groupby">'. T_("Group by"). '</label>';
						$html .= '<select class="select22" name="groupby">';
						{
							foreach ($group_by as $key => $value)
							{
								$selected = null;
								if(a($report, 'groupby') === $key)
								{
									$selected = 'selected';
								}
								$html .= "<option value='$key' $selected>$value</option>";
							}
						}
						$html .= '</select>';
					}
					$html .= '</div>';

				}
				$html .= '</div>';

				$data_response_hide = 'data-response-hide';
				if(\dash\request::get('daterange') === 'custom')
				{
					$data_response_hide = '';
				}

				$html .= '<div data-response="daterange" data-response-where="custom" '. $data_response_hide.'>';
				{
					$html .= '<div class="row">';
					{

						$html .= '<div class="c-xs-12 c-sm-6 c-md-2">';
						{

							$html .= '<label for="startdate">'. T_("Start date"). '</label>';
							$html .= '<div class="input">';
							{
								$html .= '<input type="tel" name="startdate" value="'.a($reportDate, 'startdate').'" data-format="date">';
							}
							$html .= '</div>';
						}
						$html .= '</div>';

						$html .= '<div class="c-xs-12 c-sm-6 c-md-1">';
						{
							$html .= '<label for="starttime">'. T_("Start time"). '</label>';
							$html .= '<div class="input">';
							{
								$html .= '<input type="tel" name="starttime" value="'.a($reportDate, 'starttime').'" data-format="time">';
							}
							$html .= '</div>';
						}
						$html .= '</div>';

						$html .= '<div class="c-xs-12 c-sm-6 c-md-2">';
						{
							$html .= '<label for="enddate">'. T_("End date"). '</label>';
							$html .= '<div class="input">';
							{
								$html .= '<input type="tel" name="enddate" value="'.a($reportDate, 'enddate').'" data-format="date">';
							}
							$html .= '</div>';
						}
						$html .= '</div>';

						$html .= '<div class="c-xs-12 c-sm-6 c-md-1">';
						{
							$html .= '<label for="endtime">'. T_("End time"). '</label>';
							$html .= '<div class="input">';
							{
								$html .= '<input type="tel" name="endtime" value="'.a($reportDate, 'endtime').'" data-format="time">';
							}
							$html .= '</div>';
						}
						$html .= '</div>';

					}
					$html .= '</div>';
				}
				$html .= '</div>';

			}
			$html .= '</div>';
			$html .= '<footer class="txtRa">';
			{
				$html .= '<button class="btn master">'. T_("Apply"). '</button>';
			}
			$html .= '</footer>';
		}
		$html .= '</form>';
	}
	$html .= '</div>';
	/*=====  End of Filter chart  ======*/


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