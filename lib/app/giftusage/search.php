<?php
namespace lib\app\giftusage;

class search
{
	private static $filter_message = null;
	private static $filter_args    = [];
	private static $is_filtered    = false;


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
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$condition =
		[
			'order' => 'order',
			'sort'  => ['enum' => ['dateexpire', 'datecreated']],
			'dns'   => 'code',
		];

		$require = [];

		$meta =
		[
			'field_title' =>
			[

			],
		];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		$and         = [];
		$meta        = [];
		$or          = [];

		$meta['limit'] = 20;


		$order_sort  = null;


		// if($data['dns'])
		// {
		// 	$dns_id = \dash\coding::decode($data['dns']);
		// 	if($dns_id)
		// 	{
		// 		$and[]                      = " gift.dns = $dns_id ";
		// 		self::$filter_args[T_("DNS")] = $data['dns'];
		// 		self::$is_filtered          = true;
		// 	}
		// }



		$query_string = \dash\validate::search($_query_string, false);


		if($query_string)
		{
			$or[]        = " gift.code LIKE '%$query_string%'";



			self::$is_filtered = true;
		}


		if($data['sort'] && !$order_sort)
		{
			if(in_array($data['sort'], ['name', 'dateexpire', 'dateregister', 'dateupdate', 'id']))
			{

				$sort = mb_strtolower($data['sort']);
				$order = null;
				if($data['order'])
				{
					$order = mb_strtolower($data['order']);
				}

				$order_sort = " ORDER BY $sort $order";
			}
		}

		if(!$order_sort)
		{
			$order_sort = " ORDER BY giftusage.id DESC";
		}

		$list = \lib\db\giftusage\search::list($and, $or, $order_sort, $meta);

		if(is_array($list))
		{
			$list = array_map(['\\lib\\app\\giftusage\\ready', 'row'], $list);
		}
		else
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