<?php
namespace lib\app\domains;

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

		return self::get_list($_query_string, $_args);
	}


	public static function list_admin($_query_string, $_args)
	{
		return self::get_list($_query_string, $_args);
	}


	private static function get_list($_query_string, $_args)
	{


		$condition =
		[
			'order'     => 'order',
			'sort'      => ['enum' => ['name', 'dateexpire', 'dateregister', 'dateupdate', 'id']],
			'domainlen' => 'smallint',
			'available' => 'bit',
			'tld'       => 'string_50',
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

		$meta['limit'] = 30;


		$order_sort  = null;


		if($data['available'])
		{
			$and[] = " (SELECT domainactivity.available FROM domainactivity WHERE domainactivity.domain_id = domains.id ORDER BY domainactivity.id DESC LIMIT 1) = 1 ";
		}

		if($data['domainlen'])
		{
			$and[] = " domains.domainlen = $data[domainlen] ";
		}

		if($data['tld'])
		{
			$and[] = " domains.tld = '$data[tld]' ";
		}


		if(mb_strlen($_query_string) > 50)
		{
			\dash\notif::error(T_("Please search by keyword less than 50 characters"), 'q');
			return false;
		}

		$query_string = \dash\validate::search($_query_string);


		if($query_string)
		{
			$or[]        = " domains.domain LIKE '$query_string%'";
			self::$is_filtered = true;
		}


		if($data['sort'] && !$order_sort)
		{
			if(in_array($data['sort'], ['domain', 'tld']))
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
			$order_sort = " ORDER BY domains.id DESC";
		}



		$list = \lib\db\domains\search::list($and, $or, $order_sort, $meta);

		if(is_array($list))
		{
			$list = array_map(['\\lib\\app\\domains\\ready', 'row'], $list);
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