<?php
namespace lib\app\nic_domain;

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


	public static function list_admin($_query_string, $_args)
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
			'dns'    => null,

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


		if($_args['dns'])
		{
			$dns_id = \dash\coding::decode($_args['dns']);
			if($dns_id)
			{
				$and[]                      = " domain.dns = $dns_id ";
				self::$filter_args[T_("DNS")] = $_args['dns'];
				self::$is_filtered          = true;
			}
		}


		if(mb_strlen($_query_string) > 50)
		{
			\dash\notif::error(T_("Please search by keyword less than 50 characters"), 'q');
			return false;
		}

		$query_string = \dash\safe::forQueryString($_query_string);


		if($query_string)
		{
			$or[]        = " domain.name LIKE '%$query_string%'";



			self::$is_filtered = true;
		}


		if($_args['sort'] && !$order_sort)
		{
			if(in_array($_args['sort'], ['name', 'dateexpire', 'dateregister', 'dateupdate', 'id']))
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
			$order_sort = " ORDER BY domain.id DESC";
		}



		$list = \lib\db\nic_domain\search::list($and, $or, $order_sort, $meta);

		if(is_array($list))
		{
			// $list = array_map(['\\lib\\app\\nic_domain\\ready', 'row'], $list);
		}
		else
		{
			$list = [];
		}

		$users_id = array_column($list, 'user_id');
		$users_id = array_filter($users_id);
		$users_id = array_unique($users_id);

		if($users_id)
		{
			$load_some_user = \dash\db\users\get::by_multi_id(implode(',', $users_id));
			if(is_array($load_some_user))
			{
				$load_some_user = array_combine(array_column($load_some_user, 'id'), $load_some_user);
				foreach ($list as $key => $value)
				{
					if(isset($value['user_id']) && $value['user_id'] && isset($load_some_user[$value['user_id']]))
					{
						$user_detail = $load_some_user[$value['user_id']];
						$user_detail = \dash\app\user::ready($user_detail);
						$list[$key]['user_detail'] = $user_detail;
					}
					else
					{
						$list[$key]['user_detail'] = [];
					}
				}
			}
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


	public static function list($_query_string, $_args)
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$userId = \dash\user::id();

		$default_args =
		[
			'order'  => null,
			'sort'   => null,
			'holder' => null,
			'admin'  => null,
			'tech'   => null,
			'bill'   => null,
			'dns'    => null,

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


		if($_args['dns'])
		{
			$dns_id = \dash\coding::decode($_args['dns']);
			if($dns_id)
			{
				$and[]                      = " domain.dns = $dns_id ";
				self::$filter_args[T_("DNS")] = $_args['dns'];
				self::$is_filtered          = true;
			}
		}


		if(mb_strlen($_query_string) > 50)
		{
			\dash\notif::error(T_("Please search by keyword less than 50 characters"), 'q');
			return false;
		}

		$query_string = \dash\safe::forQueryString($_query_string);


		if($query_string)
		{
			$or[]        = " domain.name LIKE '%$query_string%'";



			self::$is_filtered = true;
		}


		if($_args['sort'] && !$order_sort)
		{
			if(in_array($_args['sort'], ['name', 'dateexpire', 'dateregister', 'dateupdate', 'id']))
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
			$order_sort = " ORDER BY domain.id DESC";
		}

		$and[] = " domain.status IN ('enable', 'disable') ";

		$and[] = " domain.user_id = $userId ";


		$list = \lib\db\nic_domain\search::list($and, $or, $order_sort, $meta);

		if(is_array($list))
		{
			// <div class="ibtn wide"><span>تمدید خودکار</span><i class="sf-refresh fc-blue"></i></div>
			$list = array_map(['\\lib\\app\\nic_domain\\ready', 'row'], $list);

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

		$list = \lib\db\nic_domain\get::user_list(\dash\user::id());

		return $list;

	}




}
?>