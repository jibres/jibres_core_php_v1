<?php
namespace lib\app\tax\doc\report;


class journal
{
	private static $coding = [];

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

		switch($_mode)
		{
			case 'end_of_page':
				$message  = T_("End of page");
				break;

			case 'start_new_page':
				$message  = T_("Start new page");
				break;

			case 'opening':
				$message  = T_("For opening document");
				break;

			case 'next_part':
				$message  = T_("For tax document");
				break;


		}
		$break_message['message']     = $message;

		return array_merge($break_message, $_args);
	}


	/**
	 * Get Journal report
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public static function report($_args)
	{

		$data = \lib\app\tax\doc\report::analyze_args($_args);

		$year = date("Y");

		if(isset($data['yearDetail']['startdate']) && $data['yearDetail']['startdate'] && is_string($data['yearDetail']['startdate']))
		{
			$year = substr($data['yearDetail']['startdate'], 0, 4);
		}

		$year_jalali = \dash\utility\jdate::date("Y", strtotime($year. '-05-01 00:00:00'), false);

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
			[$year_jalali. '-12-01', $year_jalali. '-12-30'],
		];


		// laod coding once
		{
			$coding = \lib\db\tax_document\get::report_journal_coding();
			$coding = array_combine(array_column($coding, 'id'), $coding);
			self::$coding = $coding;
		}

		$total_report = [];

		foreach ($month_list as $key => $month)
		{
			$my_data              = [];
			$my_data['year_id']   = $data['year_id'];

			if($key === 0)
			{
				$my_data['type'] = 'opening';

				$result = \lib\db\tax_document\get::report_journal($my_data);

				$total_report[] = self::one_month($result);

			}

			$my_data['startdate'] = \dash\validate::date($month[0]);
			$my_data['enddate']   = \dash\validate::date($month[1]);
			$my_data['type']      = 'normal';

			$result = \lib\db\tax_document\get::report_journal($my_data);

			$total_report[] = self::one_month($result);

		}

		$final_report         = [];

		$counter              = 0;
		$sum_debtor_on_page   = 0;
		$sum_creditor_on_page = 0;
		$sum_current_on_page  = 0;

		foreach ($total_report as $key => $one_month)
		{
			foreach ($one_month as $result)
			{
				$result['myNumber'] = $key + 1;

				$final_report[] = $result;

				$counter++;

				if($counter >= 26)
				{
					$page_report =
					[
						'sum_debtor_on_page'   => $sum_debtor_on_page,
						'sum_creditor_on_page' => $sum_creditor_on_page,
						'sum_current_on_page'  => $sum_current_on_page
					];

					$final_report[]       = self::break_message($key, 'end_of_page', $page_report);
					$final_report[]       = self::break_message($key, 'start_new_page', $page_report);
					$counter              = 0;
					$sum_debtor_on_page   = 0;
					$sum_creditor_on_page = 0;
					$sum_current_on_page  = 0;
				}

				$sum_current_on_page  += $result['current'];
				$sum_creditor_on_page += $result['sum_creditor'];
				$sum_debtor_on_page   += $result['sum_debtor'];


			}


			if($key === 0)
			{
				$final_report[] = self::break_message($key, 'opening');
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
					'sum_current_on_page'  => $sum_current_on_page
				];

				$final_report[]       = self::break_message($key, 'end_of_page', $page_report);
				$final_report[]       = self::break_message($key, 'start_new_page', $page_report);
				$counter              = 0;
				$sum_debtor_on_page   = 0;
				$sum_creditor_on_page = 0;
				$sum_current_on_page  = 0;
			}

		}

		return $final_report;


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