<?php
namespace lib\app\form\generate;


trait timeLimit
{


	private static function timeLimitMessage()
	{
		if(self::$startTime && self::$formTimeLimited)
		{
			$totalTime = a(self::$formDetail, 'setting', 'timelimit');

			$startTime = \dash\fit::date_time(date("Y-m-d H:i:s", self::$startTime));
			$endTime   = \dash\fit::date_time(date("Y-m-d H:i:s", (self::$startTime + $totalTime)));

			self::$html .= '<div class="alert-info text-center font-bold">';
			{
				self::$html .= T_("You must answer this form within :val seconds", [
					'val' => \dash\fit::number($totalTime), 'min' => '2',
				]);
				self::$html .= '<br>';
				self::$html .= T_("Your start time is :val", ['val' => $startTime]);
				self::$html .= '<br>';
				self::$html .= T_("And your end time is :val", ['val' => $endTime]);
			}
			self::$html .= '</div>';
		}
	}


}
