<?php
namespace lib\app\tax\doc\report;


class journal
{
	private static $coding = [];

	private static $page_counter = 1;

	/**
	 * Break message
	 *
	 * @param      <type>  $_mode  The mode
	 *
	 * @return     array   ( description_of_the_return_value )
	 */
	private static function break_message($_index, $_mode, $_args = [])
	{
		$break_message             = [];
		$break_message['type']     = 'break_message';
		$break_message['mode']     = $_mode;
		$message                   = T_("For tax document");
		$break_message['myNumber'] = $_index + 1;

		$page = self::$page_counter;

		switch($_mode)
		{
			case 'end_of_page':
				$message  = T_("Quote to page :page", ['page' => \dash\fit::number(self::$page_counter +1)]);
				break;

			case 'start_new_page':
				if($_index === null)
				{
					$message  = T_("Quote from page :page", ['page' => '&nbsp;']);
				}
				else
				{
					$message  = T_("Quote from page :page", ['page' => \dash\fit::number(self::$page_counter - 1)]);
				}
				break;

			case 'opening':
				// $message  = T_("Based on the details of the opening document");
				$message  = T_("As described in the accounting document"). ' - '. T_("Opening document");
				break;

			case 'closing':
				// $message  = T_("Based on the details of the closing document");
				$message  = T_("As described in the accounting document"). ' - '. T_("Closing document");
				break;

			case 'next_part':
				$message  = T_("As described in the accounting document");
				break;

			case 'empty_record':
				$message  = "&nbsp;";
				break;

			case 'other':
				$message  = "&nbsp;";
				break;

			case 'sum_of_page':
				$break_message['mode']     = 'end_of_page';
				$message  = T_("Quote to page :page", ['page' => '&nbsp;']);
				break;

			case 'sum_start_new_page':
				$break_message['mode']     = 'start_new_page';
				$message  = T_("Quote from page :page", ['page' => '&nbsp;']);
				break;



		}
		$break_message['message']     = $message;

		$break_message['page']     = self::$page_counter;

		return array_merge($break_message, $_args);
	}



	/**
	 * Some define
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     array   ( description_of_the_return_value )
	 */
	private static function args_defined($_args)
	{

		$data = \lib\app\tax\doc\report::analyze_args($_args);

		$year = date("Y");

		if(isset($data['yearDetail']['startdate']) && $data['yearDetail']['startdate'] && is_string($data['yearDetail']['startdate']))
		{
			$year = substr($data['yearDetail']['startdate'], 0, 4);
		}


		$year_jalali = \dash\utility\jdate::date("Y", strtotime($year. '-05-01 00:00:00'), false);

		$end_of_year = \dash\utility\jdate::day_of_end_of_year($year_jalali);

		if($data['daily'])
		{
			$month_list = [];
			for ($i=1; $i <= 12 ; $i++)
			{
				for ($j=1; $j <= 31; $j++)
				{
					if($i > 6 && $j === 31)
					{
						continue;
					}

					if($i == 12 && $j > $end_of_year)
					{
						continue;
					}

					$month = $i;
					if($month < 10)
					{
						$month = '0'. $month;
					}

					$day = $j;
					if($day < 10)
					{
						$day = '0'. $day;
					}


					$month_list[] = [$year_jalali. '-'. $month. '-'. $day, $year_jalali. '-'. $month. '-'. $day];
				}
			}

		}
		else
		{
			// show monthly
			$month_list =
			[
				[$year_jalali. '-01-01', $year_jalali. '-01-31'],
				[$year_jalali. '-02-01', $year_jalali. '-02-31'],
				[$year_jalali. '-03-01', $year_jalali. '-03-31'],
				[$year_jalali. '-04-01', $year_jalali. '-04-31'],
				[$year_jalali. '-05-01', $year_jalali. '-05-31'],
				[$year_jalali. '-06-01', $year_jalali. '-06-31'],
				[$year_jalali. '-07-01', $year_jalali. '-07-30'],
				[$year_jalali. '-08-01', $year_jalali. '-08-30'],
				[$year_jalali. '-09-01', $year_jalali. '-09-30'],
				[$year_jalali. '-10-01', $year_jalali. '-10-30'],
				[$year_jalali. '-11-01', $year_jalali. '-11-30'],
				[$year_jalali. '-12-01', $year_jalali. '-12-'. $end_of_year],
			];

		}

		// laod coding once
		{
			$coding = \lib\db\tax_document\get::report_journal_coding();
			$coding = array_combine(array_column($coding, 'id'), $coding);
			self::$coding = $coding;
		}

		return
		[
			'year'        => $year,
			'year_jalali' => $year_jalali,
			'month_list'  => $month_list,
			'data'        => $data,
		];

	}


	/**
	 * Get Journal report
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public static function report($_args)
	{

		extract(self::args_defined($_args));


		$total_report = [];

		foreach ($month_list as $key => $month)
		{
			$my_data              = [];
			$my_data['year_id']   = $data['year_id'];
			$my_data['startdate'] = \dash\validate::date($month[0]);
			$my_data['enddate']   = \dash\validate::date($month[1]);

			if($key === 0)
			{
				$my_data['type'] = 'opening';

				$result = \lib\db\tax_document\get::report_journal($my_data);

				$temp = self::one_month($result);
				if($temp)
				{
					$total_report[] = $temp;
				}

			}

			$my_data['type']      = 'normal';

			$result = \lib\db\tax_document\get::report_journal($my_data);

			$temp = self::one_month($result);
			if($temp)
			{
				$total_report[] = $temp;
			}

		}

		// add closing record
		{

			$my_data['type']      = 'closing';

			$result = \lib\db\tax_document\get::report_journal($my_data);

			$temp = self::one_month($result);
			if($temp)
			{
				$total_report[] = $temp;
			}
		}


		$final_report         = [];

		$counter              = 0;
		$sum_debtor_on_page   = 0;
		$sum_creditor_on_page = 0;


		$all_key = array_keys($total_report);
		$end_key = end($all_key);


		$final_report[]       = self::break_message(null, 'start_new_page', []);

		foreach ($total_report as $key => $one_month)
		{
			$need_break_message = false;

			foreach ($one_month as $result)
			{
				$need_break_message = true;
				$result['myNumber'] = $key + 1;

				$final_report[] = $result;

				$counter++;

				if($result['mode'] === 'creditor')
				{
					$sum_creditor_on_page += $result['show_value'];
				}
				else
				{
					$sum_debtor_on_page   += $result['show_value'];
				}

				if($counter >= 26)
				{
					$page_report =
					[
						'sum_debtor_on_page'   => $sum_debtor_on_page,
						'sum_creditor_on_page' => $sum_creditor_on_page,

					];

					$final_report[]       = self::break_message($key, 'end_of_page', $page_report);
					self::$page_counter++;
					$final_report[]       = self::break_message($key, 'start_new_page', $page_report);
					$counter              = 0;

				}
			}


			if($need_break_message)
			{
				if($key === 0)
				{
					$final_report[] = self::break_message($key, 'opening');
				}
				elseif($key == $end_key)
				{
					$final_report[] = self::break_message($key, 'closing');
				}
				else
				{
					$final_report[] = self::break_message($key, 'next_part');
				}

				$counter++;

				if($counter >= 26)
				{
					$page_report =
					[
						'sum_debtor_on_page'   => $sum_debtor_on_page,
						'sum_creditor_on_page' => $sum_creditor_on_page,

					];

					$final_report[]       = self::break_message($key, 'end_of_page', $page_report);
					self::$page_counter++;
					$final_report[]       = self::break_message($key, 'start_new_page', $page_report);
					$counter              = 0;

				}
			}
		}

		if($counter < 26)
		{
			for ($i=1; $i <= 26 - $counter ; $i++)
			{
				$final_report[] = self::break_message(null, 'empty_record', []);
			}
		}

		$page_report =
		[
			'sum_debtor_on_page'   => $sum_debtor_on_page,
			'sum_creditor_on_page' => $sum_creditor_on_page,
		];

		$final_report[]       = self::break_message($key, 'end_of_page', $page_report);

		return $final_report;


	}





	/**
	 * Get Journal report
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public static function ledger($_args)
	{

		extract(self::args_defined($_args));


		$total_report = [];

		foreach ($month_list as $key => $month)
		{
			$my_data              = [];
			$my_data['year_id']   = $data['year_id'];
			$my_data['startdate'] = \dash\validate::date($month[0]);
			$my_data['enddate']   = \dash\validate::date($month[1]);

			if($key === 0)
			{
				$my_data['type'] = 'opening';

				$result = \lib\db\tax_document\get::report_journal($my_data);

				$temp = self::one_month($result);
				if($temp)
				{
					$total_report[] = $temp;
				}

			}

			$my_data['type']      = 'normal';

			$result = \lib\db\tax_document\get::report_journal($my_data);

			$temp = self::one_month($result);
			if($temp)
			{
				$total_report[] = $temp;
			}

		}

		// add closing report
		{
			$my_data['type']      = 'closing';

			$result = \lib\db\tax_document\get::report_journal($my_data);

			$temp = self::one_month($result);
			if($temp)
			{
				$total_report[] = $temp;
			}
		}


		$final_report         = [];

		foreach ($total_report as $key => $one_month)
		{
			foreach ($one_month as $result)
			{
				$result['myNumber'] = $key + 1;

				if(!isset($final_report[$result['total_id']]))
				{
					$final_report[$result['total_id']] = [];
				}

				$final_report[$result['total_id']][] = $result;
			}
		}
		foreach ($final_report as $key => $value)
		{
			$remain_value = 0;
			foreach ($value as $k => $result)
			{
				if($result['mode'] === 'debtor')
				{
					$remain_value = floatval($remain_value) + floatval($result['show_value']);
				}
				else
				{
					$remain_value = floatval($remain_value) - floatval($result['show_value']);
				}

				if($remain_value < 0)
				{
					$final_report[$key][$k]['detect_title'] = 'بس'; // T_("Debtor");
				}
				elseif($remain_value > 0)
				{
					$final_report[$key][$k]['detect_title'] = 'بد'; // T_("Creditor");
				}

				$final_report[$key][$k]['remain_value'] = $remain_value;
			}
		}


		$final_report = array_values($final_report);


		foreach ($final_report as $key => $value)
		{
			foreach ($value as $k => $v)
			{
				if(a($v, 'type') === 'opening')
				{
					$final_report[$key][$k]['show_title'] = T_("As described in the general journal"). ' - '. T_("Opening document");
				}
				elseif(a($v, 'type') === 'closing')
				{
					$final_report[$key][$k]['show_title'] = T_("As described in the general journal"). ' - '. T_("Closing document");
				}
				else
				{
					$final_report[$key][$k]['show_title'] = T_("As described in the general journal");
				}
			}
		}

		$final_report_per_page = [];

		$counter               = 0;
		$sum_debtor_on_page    = 0;
		$sum_creditor_on_page  = 0;
		$sum_remain_on_page    = 0;

		$final_report_per_page[]       = self::break_message(null, 'start_new_page', []);


		foreach ($final_report as $key => $one_total)
		{
			$counter              = 0;
			$sum_debtor_on_page   = 0;
			$sum_creditor_on_page = 0;
			$sum_remain_on_page   = 0;

			foreach ($one_total as $k => $v)
			{
				$final_report_per_page[] = $v;

				$counter++;

				if($v['mode'] === 'creditor')
				{
					$sum_creditor_on_page += $v['show_value'];
				}
				else
				{
					$sum_debtor_on_page   += $v['show_value'];
				}

				// $sum_remain_on_page   += $v['remain_value'];

				if($counter >= 26)
				{
					if(count($one_total) > 26)
					{
						$page_report =
						[
							'sum_debtor_on_page'   => $sum_debtor_on_page,
							'sum_creditor_on_page' => $sum_creditor_on_page,
							'sum_remain_on_page'   => $sum_debtor_on_page - $sum_creditor_on_page,

						];

						$final_report_per_page[]       = self::break_message($key, 'end_of_page', $page_report);
						self::$page_counter++;
						$final_report_per_page[]       = self::break_message($key, 'start_new_page', $page_report);
						$counter              = 0;
					}

				}

			}

			if($counter < 26)
			{
				for ($i=1; $i <= 26 - $counter ; $i++)
				{
					$final_report_per_page[] = self::break_message(null, 'empty_record', []);
				}
			}

			$page_report =
			[
				'sum_debtor_on_page'   => $sum_debtor_on_page,
				'sum_creditor_on_page' => $sum_creditor_on_page,
				'sum_remain_on_page' => $sum_debtor_on_page - $sum_creditor_on_page,
			];

			$final_report_per_page[]       = self::break_message($key, 'sum_of_page', $page_report);

			self::$page_counter++;

			$final_report_per_page[]       = self::break_message(null, 'sum_start_new_page', []);

		}

		array_pop($final_report_per_page);

		return $final_report_per_page;

	}





	private static function one_month($result)
	{

		if(!is_array($result))
		{
			$result = [];
		}

		$coding = self::$coding;

		$result = array_map(['\\lib\\app\\tax\\doc\\ready', 'report'], $result);

		foreach ($result as $key => $value)
		{
			if(isset($value['group_id']) && isset($coding[$value['group_id']]) && $coding[$value['group_id']]['title'])
			{
				$result[$key]['group_title'] = $coding[$value['group_id']]['title'];
			}

			if(isset($value['total_id']) && isset($coding[$value['total_id']]) && $coding[$value['total_id']]['title'])
			{
				$result[$key]['total_title'] = $coding[$value['total_id']]['title'];
			}

			if(isset($value['total_id']) && isset($coding[$value['total_id']]) && $coding[$value['total_id']]['code'])
			{
				$result[$key]['total_code'] = $coding[$value['total_id']]['code'];
			}
		}


		foreach ($result as $key => $value)
		{
			$string_id = null;
			if(isset($value['string_id']))
			{
				$string_id = $value['string_id'];
			}

			$current_debtor   = $value['debtor'];
			$current_creditor = $value['creditor'];

			$result[$key]['sum_debtor'] = $current_debtor;
			$result[$key]['sum_creditor'] = $current_creditor;

			$diff_current = floatval($current_debtor) - floatval($current_creditor);

			$result[$key]['current'] = $diff_current;

			if($value['type'] === 'opening')
			{
				$result[$key]['show_date'] = $value['startdate'];
			}
			else
			{
				$result[$key]['show_date'] = $value['enddate'];
			}

		}



		$sort = array_column($result, 'string_id');

		if(count($sort) === count($result))
		{
			array_multisort($result, SORT_DESC, SORT_NUMERIC, $sort);
		}

		$new_sort = [];

		foreach ($result as $key => $value)
		{
			if($value['sum_debtor'] > 0)
			{
				$value['mode']       = 'debtor';
				$value['show_value'] = $value['sum_debtor'];

				$new_sort[] = $value;
			}
		}


		foreach ($result as $key => $value)
		{
			if($value['sum_creditor'] > 0)
			{
				$value['mode']       = 'creditor';
				$value['show_value'] = $value['sum_creditor'];

				$new_sort[] = $value;
			}
		}

		return $new_sort;
	}
}
?>