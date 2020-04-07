<?php
namespace lib\app\nic_dns;

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
			'order'  => 'order',
			'sort'   => ['enum' => ['title', 'ns1', 'status']],
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

		$query_string = \dash\validate::search($_query_string);


		if($query_string)
		{
			$or[]        = " dns.title LIKE '%$query_string%'";
			$or[]        = " dns.ns1 LIKE '$query_string%'";
			$or[]        = " dns.ns2 LIKE '$query_string%'";
			$or[]        = " dns.ns3 LIKE '$query_string%'";
			$or[]        = " dns.ns4 LIKE '$query_string%'";

			self::$is_filtered = true;
		}


		if($data['sort'] && !$order_sort)
		{
			if(in_array($data['sort'], ['title', 'ns1', 'status']))
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
			$order_sort = " ORDER BY dns.id DESC";
		}

		$and[] = " dns.status != 'deleted' ";
		$and[] = " dns.user_id = ". \dash\user::id();



		$list = \lib\db\nic_dns\search::list($and, $or, $order_sort, $meta);

		if(is_array($list))
		{
			$list = array_map(['\\lib\\app\\nic_dns\\ready', 'row'], $list);
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


	public static function my_list()
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$list = \lib\db\nic_dns\get::user_list(\dash\user::id());

		return $list;
	}
}
?>