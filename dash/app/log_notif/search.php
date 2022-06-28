<?php
namespace dash\app\log_notif;


class search
{

	private static $filter_message = null;
	private static $filter_args    = [];
	private static $is_filtered    = false;


	public static function group_by()
	{
		$get_list_group_by = \dash\db\log_notif\get::group_by();
		return $get_list_group_by;
	}




	public static function filter_message()
	{
		return self::$filter_message;
	}


	public static function is_filtered()
	{
		return self::$is_filtered;
	}


	public static function list($_query_string, $_args)
	{

		$condition =
		[
			'order'   => 'order',
			'sort'    => ['enum' => ['title', 'id']],

		];

		$require = [];

		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$and   = [];
		$meta  = [];
		$or    = [];
		$param = [];

		$meta['limit'] = 20;
		// $meta['pagination'] = false;

		$order_sort  = null;



		$query_string = \dash\validate::search($_query_string, false);

		if($query_string)
		{
			$or[] = " log_notif.type LIKE :search1 ";
			$or[] = " log_notif.message LIKE :search2 ";
			$or[] = " log_notif.datecreated LIKE :search2 ";
			$param[':search1'] = '%'. $query_string. '%';
			$param[':search2'] = '%'. $query_string. '%';
			$param[':search3'] = $query_string. '%';
			self::$is_filtered = true;
		}


		if($data['sort'] && !$order_sort)
		{
			if(in_array($data['sort'], ['datecreated']))
			{
				$sort = \dash\str::mb_strtolower($data['sort']);
				$order = null;
				if($data['order'])
				{
					$order = \dash\str::mb_strtolower($data['order']);
				}

				$order_sort = " ORDER BY $sort $order";
			}
		}

		if(!$order_sort)
		{
			$order_sort = " ORDER BY log_notif.id DESC";
		}

		$list = \dash\db\log_notif\search::list($param, $and, $or, $order_sort, $meta);

		if(!is_array($list))
		{
			$list = [];
		}


		$filter_args_data = [];

		foreach (self::$filter_args as $key => $value)
		{
			if(isset($list[0][$key]) && substr($value, 0, 1) === '*')
			{
				$filter_args_data[substr($value, 1)] = $list[0][$key];
			}
			else
			{
				$filter_args_data[$key] = $value;
			}
		}

		self::$filter_message = \dash\app\sort::createFilterMsg($query_string, $filter_args_data);

		return $list;
	}

}
?>