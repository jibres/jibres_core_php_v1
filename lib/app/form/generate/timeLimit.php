<?php
namespace lib\app\form\generate;


trait timeLimit
{


	private static function timeLimitMessage()
	{
		$totalTime = a(self::$formDetail, 'setting', 'timelimit');
		if($totalTime)
		{
			self::$html .= '<div class="alert-info text-center font-bold">';
			{
				self::$html .= T_("You must answer this form within :val seconds", [
					'val' => \dash\fit::number($totalTime),
				]);

				if(isset(self::$formDetail['formLoad']['starttime']) && self::$formDetail['formLoad']['starttime'])
				{
					$startTimeInt = strtotime(self::$formDetail['formLoad']['starttime']);

					$startTime = \dash\fit::date_time(date("Y-m-d H:i:s", $startTimeInt));
					$endTime   = \dash\fit::date_time(date("Y-m-d H:i:s", ($startTimeInt + $totalTime)));

					self::$html .= '<br>';
					self::$html .= T_("Your start time is :val", ['val' => $startTime]);
					self::$html .= '<br>';
					self::$html .= T_("And your end time is :val", ['val' => $endTime]);
				}

			}
			self::$html .= '</div>';
		}
	}


}
