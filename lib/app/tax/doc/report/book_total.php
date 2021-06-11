<?php
namespace lib\app\tax\doc\report;


class book_total
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