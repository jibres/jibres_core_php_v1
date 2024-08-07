<?php
namespace lib\app\tax\doc;


class report
{
	// use in /report/journal
	public static function analyze_args($_args)
	{
		$condition =
		[
			'year_id'   => 'id',
			'startdate' => 'date',
			'enddate'   => 'date',
			'daily'     => 'bit',
		];

		$require = [];
		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$year_id = $data['year_id'];

		if($year_id)
		{
			$load_year = \lib\app\tax\year\get::get($year_id);
			if(!isset($load_year['id']))
			{
				$data['year_id'] = null;
			}

			$data['yearDetail'] = $load_year;
		}

		return $data;

	}


	public static function detail_report($_args)
	{
		$data = self::analyze_args($_args);


		$result = \lib\db\tax_document\get::detail_report($data);

		if(!is_array($result))
		{
			$result = [];
		}

		$coding  = a($result, 'coding');
		$normal  = a($result, 'normal');
		$opening = a($result, 'opening');

		$coding = array_combine(array_column($coding, 'id'), $coding);

		if(!is_array($coding))
		{
			$coding = [];
		}

		if(!is_array($normal))
		{
			$normal = [];
		}

		if(!is_array($opening))
		{
			$opening = [];
		}

		$opening = array_map(['\\lib\\app\\tax\\doc\\ready', 'report'], $opening);

		foreach ($opening as $key => $value)
		{
			if(isset($value['assistant_id']) && isset($coding[$value['assistant_id']]) && $coding[$value['assistant_id']]['title'])
			{
				$opening[$key]['assistant_title'] = $coding[$value['assistant_id']]['title'];
			}

			if(isset($value['total_id']) && isset($coding[$value['total_id']]) && $coding[$value['total_id']]['title'])
			{
				$opening[$key]['total_title'] = $coding[$value['total_id']]['title'];
			}

			if(isset($value['total_id']) && isset($coding[$value['total_id']]) && $coding[$value['total_id']]['code'])
			{
				$opening[$key]['total_code'] = $coding[$value['total_id']]['code'];
			}

			if(isset($value['assistant_id']) && isset($coding[$value['assistant_id']]) && $coding[$value['assistant_id']]['code'])
			{
				$opening[$key]['assistant_code'] = $coding[$value['assistant_id']]['code'];
			}

			if(isset($value['group_id']) && isset($coding[$value['group_id']]) && $coding[$value['group_id']]['title'])
			{
				$opening[$key]['group_title'] = $coding[$value['group_id']]['title'];
			}
		}

		$normal = array_map(['\\lib\\app\\tax\\doc\\ready', 'report'], $normal);

		foreach ($normal as $key => $value)
		{
			if(isset($value['assistant_id']) && isset($coding[$value['assistant_id']]) && $coding[$value['assistant_id']]['title'])
			{
				$normal[$key]['assistant_title'] = $coding[$value['assistant_id']]['title'];
			}

			if(isset($value['total_id']) && isset($coding[$value['total_id']]) && $coding[$value['total_id']]['title'])
			{
				$normal[$key]['total_title'] = $coding[$value['total_id']]['title'];
			}


			if(isset($value['total_id']) && isset($coding[$value['total_id']]) && $coding[$value['total_id']]['code'])
			{
				$normal[$key]['total_code'] = $coding[$value['total_id']]['code'];
			}

			if(isset($value['assistant_id']) && isset($coding[$value['assistant_id']]) && $coding[$value['assistant_id']]['code'])
			{
				$normal[$key]['assistant_code'] = $coding[$value['assistant_id']]['code'];
			}

			if(isset($value['group_id']) && isset($coding[$value['group_id']]) && $coding[$value['group_id']]['title'])
			{
				$normal[$key]['group_title'] = $coding[$value['group_id']]['title'];
			}
		}


		$check_opening = array_combine(array_column($opening, 'string_id'), $opening);
		foreach ($normal as $key => $value)
		{
			$string_id = null;
			if(isset($value['string_id']))
			{
				$string_id = $value['string_id'];
			}

			if(isset($check_opening[$string_id]))
			{
				$opening_debtor   = $check_opening[$string_id]['debtor'];
				$opening_creditor = $check_opening[$string_id]['creditor'];

				$normal[$key]['opening_debtor'] = $opening_debtor;
				$normal[$key]['opening_creditor'] = $opening_creditor;

				$current_debtor   = $value['debtor'];
				$current_creditor = $value['creditor'];

				$new_debtor       = floatval($opening_debtor) + floatval($current_debtor);
				$new_creditor     = floatval($opening_creditor) + floatval($current_creditor);


				$normal[$key]['sum_debtor'] = $new_debtor;
				$normal[$key]['sum_creditor'] = $new_creditor;

				$diff = floatval($new_debtor) - floatval($new_creditor);

				if($diff > 0)
				{
					$normal[$key]['remain_debtor'] = abs($diff);
					$normal[$key]['remain_creditor'] = 0;
				}
				else
				{
					$normal[$key]['remain_debtor'] = 0;
					$normal[$key]['remain_creditor'] = abs($diff);
				}


				$diff_opening = floatval($opening_debtor) - floatval($opening_creditor);

				$normal[$key]['opening'] = $diff_opening;

				$diff_current = floatval($current_debtor) - floatval($current_creditor);

				$normal[$key]['current'] = $diff_current;

				unset($check_opening[$string_id]);
			}
			else
			{

				$current_debtor   = $value['debtor'];
				$current_creditor = $value['creditor'];

				$normal[$key]['sum_debtor'] = $current_debtor;
				$normal[$key]['sum_creditor'] = $current_creditor;

				$normal[$key]['opening_debtor'] = 0;
				$normal[$key]['opening_creditor'] = 0;

				$diff_current = floatval($current_debtor) - floatval($current_creditor);
				$normal[$key]['opening'] = 0;
				$normal[$key]['current'] = $diff_current;
			}
		}


		if(!empty($check_opening))
		{
			$check_opening = array_values($check_opening);
			foreach ($check_opening as $key => $value)
			{
				$check_opening[$key]['opening_debtor'] = $value['debtor'];
				$check_opening[$key]['opening_creditor'] = $value['creditor'];

				$check_opening[$key]['debtor'] = 0;
				$check_opening[$key]['creditor'] = 0;

				$opening_debtor   = $value['debtor'];
				$opening_creditor = $value['creditor'];

				$diff_opening = floatval($opening_debtor) - floatval($opening_creditor);

				$check_opening[$key]['opening'] = $diff_opening;
				$check_opening[$key]['current'] = 0;


			}
			$normal = array_merge($normal, $check_opening);
		}


		$sort = array_column($normal, 'string_id');

		if(count($sort) === count($normal))
		{
			array_multisort($normal, SORT_DESC, SORT_NUMERIC, $sort);
		}

		foreach ($normal as $key => $value)
		{
			$normal[$key]['end_value'] = floatval($value['opening']) + floatval($value['current']);
		}

		$sum                     = [];
		$sum['remain_debtor']    = self::my_array_sum(array_column($normal, 'remain_debtor'));
		$sum['remain_creditor']  = self::my_array_sum(array_column($normal, 'remain_creditor'));
		$sum['sum_debtor']       = self::my_array_sum(array_column($normal, 'sum_debtor'));
		$sum['sum_creditor']     = self::my_array_sum(array_column($normal, 'sum_creditor'));
		$sum['opening_debtor']   = self::my_array_sum(array_column($normal, 'opening_debtor'));
		$sum['opening_creditor'] = self::my_array_sum(array_column($normal, 'opening_creditor'));
		$sum['debtor']           = self::my_array_sum(array_column($normal, 'debtor'));
		$sum['creditor']         = self::my_array_sum(array_column($normal, 'creditor'));
		$sum['opening']          = self::my_array_sum(array_column($normal, 'opening'));
		$sum['current']          = self::my_array_sum(array_column($normal, 'current'));
		$sum['end_value']          = self::my_array_sum(array_column($normal, 'end_value'));



		return ['list' => $normal, 'sum' => $sum, 'pretty' => self::pretty_table($normal)];

	}


	public static function assistant_report($_args)
	{
		$data = self::analyze_args($_args);


		$result = \lib\db\tax_document\get::assistant_report($data);

		if(!is_array($result))
		{
			$result = [];
		}

		$coding  = a($result, 'coding');
		$normal  = a($result, 'normal');
		$opening = a($result, 'opening');

		$coding = array_combine(array_column($coding, 'id'), $coding);

		if(!is_array($coding))
		{
			$coding = [];
		}

		if(!is_array($normal))
		{
			$normal = [];
		}

		if(!is_array($opening))
		{
			$opening = [];
		}

		$opening = array_map(['\\lib\\app\\tax\\doc\\ready', 'report'], $opening);

		foreach ($opening as $key => $value)
		{

			if(isset($value['total_id']) && isset($coding[$value['total_id']]) && $coding[$value['total_id']]['title'])
			{
				$opening[$key]['total_title'] = $coding[$value['total_id']]['title'];
			}


			if(isset($value['total_id']) && isset($coding[$value['total_id']]) && $coding[$value['total_id']]['code'])
			{
				$opening[$key]['total_code'] = $coding[$value['total_id']]['code'];
			}

			if(isset($value['assistant_id']) && isset($coding[$value['assistant_id']]) && $coding[$value['assistant_id']]['code'])
			{
				$opening[$key]['assistant_code'] = $coding[$value['assistant_id']]['code'];
			}


			if(isset($value['group_id']) && isset($coding[$value['group_id']]) && $coding[$value['group_id']]['title'])
			{
				$opening[$key]['group_title'] = $coding[$value['group_id']]['title'];
			}
		}

		$normal = array_map(['\\lib\\app\\tax\\doc\\ready', 'report'], $normal);

		foreach ($normal as $key => $value)
		{
			if(isset($value['total_id']) && isset($coding[$value['total_id']]) && $coding[$value['total_id']]['title'])
			{
				$normal[$key]['total_title'] = $coding[$value['total_id']]['title'];
			}

			if(isset($value['total_id']) && isset($coding[$value['total_id']]) && $coding[$value['total_id']]['code'])
			{
				$normal[$key]['total_code'] = $coding[$value['total_id']]['code'];
			}

			if(isset($value['assistant_id']) && isset($coding[$value['assistant_id']]) && $coding[$value['assistant_id']]['code'])
			{
				$normal[$key]['assistant_code'] = $coding[$value['assistant_id']]['code'];
			}

			if(isset($value['group_id']) && isset($coding[$value['group_id']]) && $coding[$value['group_id']]['title'])
			{
				$normal[$key]['group_title'] = $coding[$value['group_id']]['title'];
			}
		}


		$check_opening = array_combine(array_column($opening, 'string_id'), $opening);
		foreach ($normal as $key => $value)
		{
			$string_id = null;
			if(isset($value['string_id']))
			{
				$string_id = $value['string_id'];
			}

			if(isset($check_opening[$string_id]))
			{
				$opening_debtor   = $check_opening[$string_id]['debtor'];
				$opening_creditor = $check_opening[$string_id]['creditor'];

				$normal[$key]['opening_debtor'] = $opening_debtor;
				$normal[$key]['opening_creditor'] = $opening_creditor;

				$current_debtor   = $value['debtor'];
				$current_creditor = $value['creditor'];

				$new_debtor       = floatval($opening_debtor) + floatval($current_debtor);
				$new_creditor     = floatval($opening_creditor) + floatval($current_creditor);

				$normal[$key]['sum_debtor'] = $new_debtor;
				$normal[$key]['sum_creditor'] = $new_creditor;

				$diff = floatval($new_debtor) - floatval($new_creditor);

				if($diff > 0)
				{
					$normal[$key]['remain_debtor'] = abs($diff);
					$normal[$key]['remain_creditor'] = 0;
				}
				else
				{
					$normal[$key]['remain_debtor'] = 0;
					$normal[$key]['remain_creditor'] = abs($diff);
				}

				$diff_opening = floatval($opening_debtor) - floatval($opening_creditor);

				$normal[$key]['opening'] = $diff_opening;

				$diff_current = floatval($current_debtor) - floatval($current_creditor);

				$normal[$key]['current'] = $diff_current;

				unset($check_opening[$string_id]);
			}
			else
			{

				$current_debtor   = $value['debtor'];
				$current_creditor = $value['creditor'];

				$normal[$key]['sum_debtor'] = $current_debtor;
				$normal[$key]['sum_creditor'] = $current_creditor;

				$normal[$key]['opening_debtor'] = 0;
				$normal[$key]['opening_creditor'] = 0;

				$diff_current = floatval($current_debtor) - floatval($current_creditor);
				$normal[$key]['opening'] = 0;
				$normal[$key]['current'] = $diff_current;
			}
		}


		if(!empty($check_opening))
		{
			$check_opening = array_values($check_opening);
			foreach ($check_opening as $key => $value)
			{
				$check_opening[$key]['opening_debtor'] = $value['debtor'];
				$check_opening[$key]['opening_creditor'] = $value['creditor'];

				$check_opening[$key]['debtor'] = 0;
				$check_opening[$key]['creditor'] = 0;


				$opening_debtor   = $value['debtor'];
				$opening_creditor = $value['creditor'];

				$diff_opening = floatval($opening_debtor) - floatval($opening_creditor);

				$check_opening[$key]['opening'] = $diff_opening;
				$check_opening[$key]['current'] = 0;

			}
			$normal = array_merge($normal, $check_opening);
		}


		$sort = array_column($normal, 'string_id');

		if(count($sort) === count($normal))
		{
			array_multisort($normal, SORT_DESC, SORT_NUMERIC, $sort);
		}

		foreach ($normal as $key => $value)
		{
			$normal[$key]['end_value'] = floatval($value['opening']) + floatval($value['current']);
		}

		$sum                     = [];
		$sum['remain_debtor']    = self::my_array_sum(array_column($normal, 'remain_debtor'));
		$sum['remain_creditor']  = self::my_array_sum(array_column($normal, 'remain_creditor'));
		$sum['sum_debtor']       = self::my_array_sum(array_column($normal, 'sum_debtor'));
		$sum['sum_creditor']     = self::my_array_sum(array_column($normal, 'sum_creditor'));
		$sum['opening_debtor']   = self::my_array_sum(array_column($normal, 'opening_debtor'));
		$sum['opening_creditor'] = self::my_array_sum(array_column($normal, 'opening_creditor'));
		$sum['debtor']           = self::my_array_sum(array_column($normal, 'debtor'));
		$sum['creditor']         = self::my_array_sum(array_column($normal, 'creditor'));
		$sum['opening']          = self::my_array_sum(array_column($normal, 'opening'));
		$sum['current']          = self::my_array_sum(array_column($normal, 'current'));
		$sum['end_value']          = self::my_array_sum(array_column($normal, 'end_value'));


		return ['list' => $normal, 'sum' => $sum, 'pretty' => self::pretty_table($normal)];



	}


	public static function total_report($_args)
	{

		$data = self::analyze_args($_args);

		$result = \lib\db\tax_document\get::total_report($data);

		// var_dump($result);exit;
		if(!is_array($result))
		{
			$result = [];
		}

		$coding  = a($result, 'coding');
		$normal  = a($result, 'normal');
		$opening = a($result, 'opening');

		$coding = array_combine(array_column($coding, 'id'), $coding);

		if(!is_array($coding))
		{
			$coding = [];
		}

		if(!is_array($normal))
		{
			$normal = [];
		}

		if(!is_array($opening))
		{
			$opening = [];
		}

		$opening = array_map(['\\lib\\app\\tax\\doc\\ready', 'report'], $opening);
		$normal = array_map(['\\lib\\app\\tax\\doc\\ready', 'report'], $normal);

		foreach ($opening as $key => $value)
		{
			if(isset($value['group_id']) && isset($coding[$value['group_id']]) && $coding[$value['group_id']]['title'])
			{
				$opening[$key]['group_title'] = $coding[$value['group_id']]['title'];
			}

			if(isset($value['total_id']) && isset($coding[$value['total_id']]) && $coding[$value['total_id']]['title'])
			{
				$opening[$key]['total_title'] = $coding[$value['total_id']]['title'];
			}

			if(isset($value['total_id']) && isset($coding[$value['total_id']]) && $coding[$value['total_id']]['code'])
			{
				$opening[$key]['total_code'] = $coding[$value['total_id']]['code'];
			}
		}

		$normal = array_map(['\\lib\\app\\tax\\doc\\ready', 'report'], $normal);

		foreach ($normal as $key => $value)
		{
			if(isset($value['group_id']) && isset($coding[$value['group_id']]) && $coding[$value['group_id']]['title'])
			{
				$normal[$key]['group_title'] = $coding[$value['group_id']]['title'];
			}

			if(isset($value['total_id']) && isset($coding[$value['total_id']]) && $coding[$value['total_id']]['title'])
			{
				$normal[$key]['total_title'] = $coding[$value['total_id']]['title'];
			}

			if(isset($value['total_id']) && isset($coding[$value['total_id']]) && $coding[$value['total_id']]['code'])
			{
				$normal[$key]['total_code'] = $coding[$value['total_id']]['code'];
			}

		}


		$check_opening = array_combine(array_column($opening, 'string_id'), $opening);
		foreach ($normal as $key => $value)
		{
			$string_id = null;
			if(isset($value['string_id']))
			{
				$string_id = $value['string_id'];
			}

			if(isset($check_opening[$string_id]))
			{
				$opening_debtor   = $check_opening[$string_id]['debtor'];
				$opening_creditor = $check_opening[$string_id]['creditor'];

				$normal[$key]['opening_debtor'] = $opening_debtor;
				$normal[$key]['opening_creditor'] = $opening_creditor;

				$current_debtor   = $value['debtor'];
				$current_creditor = $value['creditor'];


				$new_debtor       = floatval($opening_debtor) + floatval($current_debtor);
				$new_creditor     = floatval($opening_creditor) + floatval($current_creditor);

				$normal[$key]['sum_debtor'] = $new_debtor;
				$normal[$key]['sum_creditor'] = $new_creditor;

				$diff = floatval($new_debtor) - floatval($new_creditor);

				if($diff > 0)
				{
					$normal[$key]['remain_debtor'] = abs($diff);
					$normal[$key]['remain_creditor'] = 0;
				}
				else
				{
					$normal[$key]['remain_debtor'] = 0;
					$normal[$key]['remain_creditor'] = abs($diff);
				}

				$diff_opening = floatval($opening_debtor) - floatval($opening_creditor);

				$normal[$key]['opening'] = $diff_opening;

				$diff_current = floatval($current_debtor) - floatval($current_creditor);

				$normal[$key]['current'] = $diff_current;

				unset($check_opening[$string_id]);
			}
			else
			{

				$current_debtor   = $value['debtor'];
				$current_creditor = $value['creditor'];

				$normal[$key]['sum_debtor'] = $current_debtor;
				$normal[$key]['sum_creditor'] = $current_creditor;

				$normal[$key]['opening_debtor'] = 0;
				$normal[$key]['opening_creditor'] = 0;

				$diff_current = floatval($current_debtor) - floatval($current_creditor);
				$normal[$key]['opening'] = 0;
				$normal[$key]['current'] = $diff_current;
			}
		}


		if(!empty($check_opening))
		{
			$check_opening = array_values($check_opening);
			foreach ($check_opening as $key => $value)
			{
				$check_opening[$key]['opening_debtor'] = $value['debtor'];
				$check_opening[$key]['opening_creditor'] = $value['creditor'];

				$check_opening[$key]['debtor'] = 0;
				$check_opening[$key]['creditor'] = 0;


				$opening_debtor   = $value['debtor'];
				$opening_creditor = $value['creditor'];

				$diff_opening = floatval($opening_debtor) - floatval($opening_creditor);

				$check_opening[$key]['opening'] = $diff_opening;
				$check_opening[$key]['current'] = 0;

			}

			$normal = array_merge($normal, $check_opening);
		}


		$sort = array_column($normal, 'string_id');

		if(count($sort) === count($normal))
		{
			array_multisort($normal, SORT_DESC, SORT_NUMERIC, $sort);
		}

		foreach ($normal as $key => $value)
		{
			$normal[$key]['end_value'] = floatval($value['opening']) + floatval($value['current']);
		}


		$sum                     = [];
		$sum['remain_debtor']    = self::my_array_sum(array_column($normal, 'remain_debtor'));
		$sum['remain_creditor']  = self::my_array_sum(array_column($normal, 'remain_creditor'));
		$sum['sum_debtor']       = self::my_array_sum(array_column($normal, 'sum_debtor'));
		$sum['sum_creditor']     = self::my_array_sum(array_column($normal, 'sum_creditor'));
		$sum['opening_debtor']   = self::my_array_sum(array_column($normal, 'opening_debtor'));
		$sum['opening_creditor'] = self::my_array_sum(array_column($normal, 'opening_creditor'));
		$sum['debtor']           = self::my_array_sum(array_column($normal, 'debtor'));
		$sum['creditor']         = self::my_array_sum(array_column($normal, 'creditor'));
		$sum['opening']          = self::my_array_sum(array_column($normal, 'opening'));
		$sum['current']          = self::my_array_sum(array_column($normal, 'current'));
		$sum['end_value']          = self::my_array_sum(array_column($normal, 'end_value'));

		return ['list' => $normal, 'sum' => $sum, 'pretty' => self::pretty_table($normal)];


	}


	public static function group_report($_args)
	{
		$data = self::analyze_args($_args);
		$result = \lib\db\tax_document\get::group_report($data);

		if(!is_array($result))
		{
			$result = [];
		}


		$normal  = a($result, 'normal');
		$opening = a($result, 'opening');
		$coding = a($result, 'coding');

		if(!is_array($normal))
		{
			$normal = [];
		}

		if(!is_array($opening))
		{
			$opening = [];
		}

		if(!is_array($coding))
		{
			$coding = [];
		}

		$coding = array_combine(array_column($coding, 'id'), $coding);


		$opening = array_map(['\\lib\\app\\tax\\doc\\ready', 'report'], $opening);
		$normal = array_map(['\\lib\\app\\tax\\doc\\ready', 'report'], $normal);


		$check_opening = array_combine(array_column($opening, 'group_id'), $opening);
		foreach ($normal as $key => $value)
		{
			$group_id = null;
			if(isset($value['group_id']))
			{
				$group_id = $value['group_id'];
			}

			if(isset($check_opening[$group_id]))
			{
				$opening_debtor   = $check_opening[$group_id]['debtor'];
				$opening_creditor = $check_opening[$group_id]['creditor'];

				$normal[$key]['opening_debtor'] = $opening_debtor;
				$normal[$key]['opening_creditor'] = $opening_creditor;

				$current_debtor   = $value['debtor'];
				$current_creditor = $value['creditor'];

				$new_debtor       = floatval($opening_debtor) + floatval($current_debtor);
				$new_creditor     = floatval($opening_creditor) + floatval($current_creditor);

				$normal[$key]['sum_debtor'] = $new_debtor;
				$normal[$key]['sum_creditor'] = $new_creditor;

				$diff = floatval($new_debtor) - floatval($new_creditor);

				if($diff > 0)
				{
					$normal[$key]['remain_debtor'] = abs($diff);
					$normal[$key]['remain_creditor'] = 0;
				}
				else
				{
					$normal[$key]['remain_debtor'] = 0;
					$normal[$key]['remain_creditor'] = abs($diff);
				}


				$diff_opening = floatval($opening_debtor) - floatval($opening_creditor);

				$normal[$key]['opening'] = $diff_opening;

				$diff_current = floatval($current_debtor) - floatval($current_creditor);

				$normal[$key]['current'] = $diff_current;


				unset($check_opening[$group_id]);
			}
			else
			{

				$current_debtor   = $value['debtor'];
				$current_creditor = $value['creditor'];

				$normal[$key]['sum_debtor'] = $current_debtor;
				$normal[$key]['sum_creditor'] = $current_creditor;

				$normal[$key]['opening_debtor'] = 0;
				$normal[$key]['opening_creditor'] = 0;

				$diff_current = floatval($current_debtor) - floatval($current_creditor);
				$normal[$key]['opening'] = 0;
				$normal[$key]['current'] = $diff_current;
			}
		}


		if(!empty($check_opening))
		{
			$check_opening = array_values($check_opening);
			foreach ($check_opening as $key => $value)
			{
				$check_opening[$key]['opening_debtor'] = $value['debtor'];
				$check_opening[$key]['opening_creditor'] = $value['creditor'];

				$check_opening[$key]['debtor'] = 0;
				$check_opening[$key]['creditor'] = 0;


				$opening_debtor   = $value['debtor'];
				$opening_creditor = $value['creditor'];

				$diff_opening = floatval($opening_debtor) - floatval($opening_creditor);

				$check_opening[$key]['opening'] = $diff_opening;
				$check_opening[$key]['current'] = 0;
			}

			$normal = array_merge($normal, $check_opening);
		}

		foreach ($normal as $key => $value)
		{
			if(isset($value['group_id']))
			{
				if(isset($coding[$value['group_id']]) && $coding[$value['group_id']]['title'])
				{
					$normal[$key]['group_title'] = $coding[$value['group_id']]['title'];
				}

				if(isset($coding[$value['group_id']]) && $coding[$value['group_id']]['code'])
				{
					$normal[$key]['group_code'] = $coding[$value['group_id']]['code'];
				}
			}
		}


		$sort = array_column($normal, 'group_id');

		if(count($sort) === count($normal))
		{
			array_multisort($normal, SORT_DESC, SORT_NUMERIC, $sort);
		}

		foreach ($normal as $key => $value)
		{
			$normal[$key]['end_value'] = floatval($value['opening']) + floatval($value['current']);
		}


		$sum                     = [];
		$sum['remain_debtor']    = self::my_array_sum(array_column($normal, 'remain_debtor'));
		$sum['remain_creditor']  = self::my_array_sum(array_column($normal, 'remain_creditor'));
		$sum['sum_debtor']       = self::my_array_sum(array_column($normal, 'sum_debtor'));
		$sum['sum_creditor']     = self::my_array_sum(array_column($normal, 'sum_creditor'));
		$sum['opening_debtor']   = self::my_array_sum(array_column($normal, 'opening_debtor'));
		$sum['opening_creditor'] = self::my_array_sum(array_column($normal, 'opening_creditor'));
		$sum['debtor']           = self::my_array_sum(array_column($normal, 'debtor'));
		$sum['creditor']         = self::my_array_sum(array_column($normal, 'creditor'));
		$sum['opening']          = self::my_array_sum(array_column($normal, 'opening'));
		$sum['current']          = self::my_array_sum(array_column($normal, 'current'));
		$sum['end_value']          = self::my_array_sum(array_column($normal, 'end_value'));

		return ['list' => $normal, 'sum' => $sum];

	}



	public static function group_report_balancesheet($_args)
	{
		$data = self::analyze_args($_args);
		$result = \lib\db\tax_document\get::group_report_balancesheet($data);

		if(!is_array($result))
		{
			$result = [];
		}


		$normal  = a($result, 'normal');
		$opening = a($result, 'opening');
		$coding = a($result, 'coding');

		if(!is_array($normal))
		{
			$normal = [];
		}

		if(!is_array($opening))
		{
			$opening = [];
		}

		if(!is_array($coding))
		{
			$coding = [];
		}

		$coding = array_combine(array_column($coding, 'id'), $coding);


		$opening = array_map(['\\lib\\app\\tax\\doc\\ready', 'report'], $opening);
		$normal = array_map(['\\lib\\app\\tax\\doc\\ready', 'report'], $normal);


		$check_opening = array_combine(array_column($opening, 'group_id'), $opening);
		foreach ($normal as $key => $value)
		{
			$group_id = null;
			if(isset($value['group_id']))
			{
				$group_id = $value['group_id'];
			}

			if(isset($check_opening[$group_id]))
			{
				$opening_debtor   = $check_opening[$group_id]['debtor'];
				$opening_creditor = $check_opening[$group_id]['creditor'];

				$normal[$key]['opening_debtor'] = $opening_debtor;
				$normal[$key]['opening_creditor'] = $opening_creditor;

				$current_debtor   = $value['debtor'];
				$current_creditor = $value['creditor'];

				$new_debtor       = floatval($opening_debtor) + floatval($current_debtor);
				$new_creditor     = floatval($opening_creditor) + floatval($current_creditor);

				$normal[$key]['sum_debtor'] = $new_debtor;
				$normal[$key]['sum_creditor'] = $new_creditor;

				$diff = floatval($new_debtor) - floatval($new_creditor);

				if($diff > 0)
				{
					$normal[$key]['remain_debtor'] = abs($diff);
					$normal[$key]['remain_creditor'] = 0;
				}
				else
				{
					$normal[$key]['remain_debtor'] = 0;
					$normal[$key]['remain_creditor'] = abs($diff);
				}


				$diff_opening = floatval($opening_debtor) - floatval($opening_creditor);

				$normal[$key]['opening'] = $diff_opening;

				$diff_current = floatval($current_debtor) - floatval($current_creditor);

				$normal[$key]['current'] = $diff_current;


				unset($check_opening[$group_id]);
			}
			else
			{

				$current_debtor   = $value['debtor'];
				$current_creditor = $value['creditor'];

				$normal[$key]['sum_debtor'] = $current_debtor;
				$normal[$key]['sum_creditor'] = $current_creditor;

				$normal[$key]['opening_debtor'] = 0;
				$normal[$key]['opening_creditor'] = 0;

				$diff_current = floatval($current_debtor) - floatval($current_creditor);
				$normal[$key]['opening'] = 0;
				$normal[$key]['current'] = $diff_current;
			}
		}


		if(!empty($check_opening))
		{
			$check_opening = array_values($check_opening);
			foreach ($check_opening as $key => $value)
			{
				$check_opening[$key]['opening_debtor'] = $value['debtor'];
				$check_opening[$key]['opening_creditor'] = $value['creditor'];

				$check_opening[$key]['debtor'] = 0;
				$check_opening[$key]['creditor'] = 0;


				$opening_debtor   = $value['debtor'];
				$opening_creditor = $value['creditor'];

				$diff_opening = floatval($opening_debtor) - floatval($opening_creditor);

				$check_opening[$key]['opening'] = $diff_opening;
				$check_opening[$key]['current'] = 0;
			}

			$normal = array_merge($normal, $check_opening);
		}

		foreach ($normal as $key => $value)
		{
			if(isset($value['group_id']))
			{
				if(isset($coding[$value['group_id']]) && $coding[$value['group_id']]['title'])
				{
					$normal[$key]['group_title'] = $coding[$value['group_id']]['title'];
				}

				if(isset($coding[$value['group_id']]) && $coding[$value['group_id']]['code'])
				{
					$normal[$key]['group_code'] = $coding[$value['group_id']]['code'];
				}
			}
		}


		$sort = array_column($normal, 'group_id');

		if(count($sort) === count($normal))
		{
			array_multisort($normal, SORT_DESC, SORT_NUMERIC, $sort);
		}

		foreach ($normal as $key => $value)
		{
			$normal[$key]['end_value'] = floatval($value['opening']) + floatval($value['current']);
		}



		$sum                     = [];
		$sum['remain_debtor']    = self::my_array_sum(array_column($normal, 'remain_debtor'));
		$sum['remain_creditor']  = self::my_array_sum(array_column($normal, 'remain_creditor'));
		$sum['sum_debtor']       = self::my_array_sum(array_column($normal, 'sum_debtor'));
		$sum['sum_creditor']     = self::my_array_sum(array_column($normal, 'sum_creditor'));
		$sum['opening_debtor']   = self::my_array_sum(array_column($normal, 'opening_debtor'));
		$sum['opening_creditor'] = self::my_array_sum(array_column($normal, 'opening_creditor'));
		$sum['debtor']           = self::my_array_sum(array_column($normal, 'debtor'));
		$sum['creditor']         = self::my_array_sum(array_column($normal, 'creditor'));
		$sum['opening']          = self::my_array_sum(array_column($normal, 'opening'));
		$sum['current']          = self::my_array_sum(array_column($normal, 'current'));
		$sum['end_value']          = self::my_array_sum(array_column($normal, 'end_value'));

		return ['list' => $normal, 'sum' => $sum];

	}


	// use in /report/journal
	public static function my_array_sum($_data)
	{
		$sum = 0;
		foreach ($_data as $key => $value)
		{
			$sum += floatval($value);
		}
		return $sum;
	}


	// use in /report/journal
	public static function pretty_table($_data)
	{
		$pretty = [];
		foreach ($_data as $key => $value)
		{
			if(isset($value['group_id']) && $value['group_id'])
			{
				$group_id = $value['group_id'];
				if(!isset($pretty[$group_id]))
				{
					$detail = ['group_id' => $group_id, 'title' => a($value, 'group_title')];
					$pretty[$group_id] = ['detail' => $detail, 'list' => [], 'sum' => []];
				}

				$pretty[$group_id]['list'][] = $value;
			}
		}
		foreach ($pretty as $key => $value)
		{

			$sum                     = [];
			$sum['remain_debtor']    = self::my_array_sum(array_column($value['list'], 'remain_debtor'));
			$sum['remain_creditor']  = self::my_array_sum(array_column($value['list'], 'remain_creditor'));
			$sum['sum_debtor']       = self::my_array_sum(array_column($value['list'], 'sum_debtor'));
			$sum['sum_creditor']     = self::my_array_sum(array_column($value['list'], 'sum_creditor'));
			$sum['opening_debtor']   = self::my_array_sum(array_column($value['list'], 'opening_debtor'));
			$sum['opening_creditor'] = self::my_array_sum(array_column($value['list'], 'opening_creditor'));
			$sum['debtor']           = self::my_array_sum(array_column($value['list'], 'debtor'));
			$sum['creditor']         = self::my_array_sum(array_column($value['list'], 'creditor'));
			$sum['opening']          = self::my_array_sum(array_column($value['list'], 'opening'));
			$sum['current']          = self::my_array_sum(array_column($value['list'], 'current'));
			$sum['end_value']          = self::my_array_sum(array_column($value['list'], 'end_value'));
			$pretty[$key]['sum'] = $sum;
		}

		return $pretty;
	}




}
?>