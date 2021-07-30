<?php
namespace content_a\accounting\report;


class view
{
	public static function config()
	{
		$title = T_('Report Accounting');

		\dash\face::title($title);

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());


		self::generate_report_list();
	}


	private static function getMonthNames($_month)
	{
		if(\dash\language::current() === 'fa')
		{
			$months =
			[
            	'فروردین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور', 'مهر', 'آبان', 'آذر', 'دی', 'بهمن', 'اسفند'
			];

        	return $months[$_month - 1];
		}
		else
		{
			$dateObj   = \DateTime::createFromFormat('!m', $_month);
			$monthName = $dateObj->format('F'); // March
			return $monthName;
		}
	}


	private static function generate_report_list()
	{
		$reportLinks   = [];

		$templates      =
		[
			'doc',
			'income',
			'cost' ,
			// 'petty_cash',
			// 'partner',
			'asset',
			// 'bank_partner',
			'costasset',
		];

		if(\dash\language::current() === 'fa')
		{
			$quarter_title = ['1' => T_("Spring"), '2' => T_("Summer") , '3' => T_("Autumn"), '4' => T_("Winter")];
		}
		else
		{
			$quarter_title = ['1' => T_("Winter"), '2' => T_("Spring") , '3' => T_("Summer"), '4' => T_("Autumn")];
		}


		$year_detail   = \lib\app\tax\year\get::default_year();

		$startdate     = a($year_detail, 'startdate');

		$myYear        = \dash\utility\convert::to_en_number(\dash\fit::date(date("Y-m-d", strtotime($startdate))));
		$myYear        = substr($myYear, 0, 4);

		$quarter       = [];

		$quarter[1] = ["$myYear-01-01", "$myYear-03-31"];
		$quarter[2] = ["$myYear-04-01", "$myYear-06-31"];
		$quarter[3] = ["$myYear-07-01", "$myYear-09-30"];
		$quarter[4] = ["$myYear-10-01", "$myYear-12-30"];

		$urlThis = \dash\url::this();
		$urlFactors = $urlThis. '/factor';
		$urlDoc = $urlThis. '/doc';

		foreach ($templates as $template)
		{

			$myUrl = $urlFactors;

			if($template === 'doc')
			{
				$myUrl = $urlDoc;
			}
			foreach ($quarter as $one_quarter => $start_end_date)
			{
				$temp = [];
				$temp['title'] = \lib\app\tax\doc\ready::factor_type_translate($template). ' - '. a($quarter_title, $one_quarter);
				$temp['list'] = [];

				if($template !== 'doc')
				{
					$get['template'] = $template;
				}
				$get['startdate'] = $start_end_date[0];
				$get['enddate']   = $start_end_date[1];
				$temp['list'][]   = ['title' => T_("The whole season :val", ['val' => a($quarter_title, $one_quarter)]), 'link' => $myUrl.'?'. \dash\request::build_query($get)];

				for ($i = ((($one_quarter - 1) * 3) + 1); $i <= ($one_quarter * 3) ; $i++)
				{
					$end_month = 31;
					if($i > 6)
					{
						$end_month = 30;
					}

					$month = $i;
					if($month < 10)
					{
						$month = '0'. $month;
					}

					$get['startdate'] = $myYear. '-'. $month. '-01';
					$get['enddate']   = $myYear. '-'. $month. '-'. $end_month;

					$temp['list'][] = ['title' => self::getMonthNames($i), 'link' => $myUrl.'?'. \dash\request::build_query($get)];
				}



				$reportLinks[] = $temp;
			}
		}



		\dash\data::reportLinks($reportLinks);

	}
}
?>
