<?php
namespace lib\app\nic_contact;

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

		$default_args =
		[
			'order'  => null,
			'sort'   => null,
			'holder' => null,
			'admin'  => null,
			'tech'   => null,
			'bill'   => null,

		];

		if(!is_array($_args))
		{
			$_args = [];
		}

		$_args       = array_merge($default_args, $_args);

		$and         = [];
		$meta        = [];
		$or          = [];

		$meta['limit'] = 20;


		$order_sort  = null;


		if($_args['admin'])
		{
			$and[]                      = " contact.admin = 1 ";
			self::$filter_args['admin'] = '*'. T_('Admin');
			self::$is_filtered          = true;
		}

		if($_args['holder'])
		{
			$and[]                      = " contact.holder = 1 ";
			self::$filter_args['holder'] = '*'. T_('Holder');
			self::$is_filtered          = true;
		}

		if($_args['tech'])
		{
			$and[]                      = " contact.tech = 1 ";
			self::$filter_args['tech'] = '*'. T_('Technical');
			self::$is_filtered          = true;
		}

		if($_args['bill'])
		{
			$and[]                      = " contact.bill = 1 ";
			self::$filter_args['bill'] = '*'. T_('Billing');
			self::$is_filtered          = true;
		}


		if(mb_strlen($_query_string) > 50)
		{
			\dash\notif::error(T_("Please search by keyword less than 50 characters"), 'q');
			return false;
		}

		$query_string = \dash\safe::forQueryString($_query_string);


		if($query_string)
		{
			$or[]        = " contact.title LIKE '%$query_string%'";
			$or[]        = " contact.nic_id LIKE '$query_string%'";


			self::$is_filtered = true;
		}


		if($_args['sort'] && !$order_sort)
		{
			if(in_array($_args['sort'], ['title', 'nicid', 'status']))
			{

				$sort = mb_strtolower($_args['sort']);
				$order = null;
				if($_args['order'])
				{
					$order = mb_strtolower($_args['order']);
				}

				$order_sort = " ORDER BY $sort $order";
			}
		}

		if(!$order_sort)
		{
			$order_sort = " ORDER BY contact.id DESC";
		}

		$and[] = " contact.status != 'deleted' ";
		$and[] = " contact.user_id = ". \dash\user::id();

		$list = \lib\db\nic_contact\search::list($and, $or, $order_sort, $meta);

		if(is_array($list))
		{
			// $list = array_map(['\\lib\\app\\nic_contact\\ready', 'row'], $list);
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

		$list = \lib\db\nic_contact\get::user_list(\dash\user::id());

		return $list;

	}




}
?>