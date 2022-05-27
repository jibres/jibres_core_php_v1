<?php
namespace lib\app\plugin\items\report;


class report_professional
{


	public static function detail() : array
	{
		return
		[
			'title'         => T_("professional report"),
			'name'          => 'report_professional',
			'type'          => 'periodic',
			'price_list'  =>
			[
				[
					'key'           => 'monthly',
					'plus_day'      => 31, // day
					'title'         => T_("One month"),
					'comperatprice' => 100000,
					'price'         => 100000,
				],
				[
					'key'           => 'yearly',
					'plus_day'      => 366, // day
					'title'         => T_("One year"),
					'default'       => true,
					'comperatprice' => 1200000,
					'price'         => 1000000,
				],
			],
			'max_period'  => '+400day', // +400 day 366+31 = 397 ~ 400
			'relase_date' => '2022-05-27',
			'last_update' => '2022-05-27',
			'icon'        => ['Reports', 'major', '#6366f1', 'text-indigo-500 p-1'],
			'description' => self::desc(),
			'keywords'    => [T_("Report"), T_("Management")],
			'currency'    => \lib\currency::jibres_currency(true),
		];

	}


	public static function more_detail() : string
	{
		$html  = '';

		$html .= '<div>';
		{

			$html .= T_("These features include");
			$html .= '<br>';
			$html .= T_("Report sales over time by custom date");
			$html .= '<br>';
			$html .= T_("Report product sales over time in year");
			$html .= '<br>';
			$html .= T_("Change group-by report to hour, day, month and year");
			$html .= '<br>';
			$html .= T_("And something else");
		}
		$html .= '</div>';

		return $html;

	}


	private static function desc() : string
	{
		return T_("By activating this plugin, you can use the advanced reporting features");
	}


}
?>