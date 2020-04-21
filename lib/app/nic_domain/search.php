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

		$condition =
		[
			'order' => 'order',
			'sort'  => ['enum' => ['name', 'dateexpire', 'dateregister', 'dateupdate', 'id']],
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


		if($data['dns'])
		{
			$dns_id = \dash\coding::decode($data['dns']);
			if($dns_id)
			{
				$and[]                      = " domain.dns = $dns_id ";
				self::$filter_args[T_("DNS")] = $data['dns'];
				self::$is_filtered          = true;
			}
		}


		if(mb_strlen($_query_string) > 50)
		{
			\dash\notif::error(T_("Please search by keyword less than 50 characters"), 'q');
			return false;
		}

		$query_string = \dash\validate::search($_query_string);


		if($query_string)
		{
			$or[]        = " domain.name LIKE '%$query_string%'";



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
			$order_sort = " ORDER BY domain.id DESC";
		}



		$list = \lib\db\nic_domain\search::list($and, $or, $order_sort, $meta);

		if(is_array($list))
		{
			$list = array_map(['\\lib\\app\\nic_domain\\ready', 'row'], $list);
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

		$condition =
		[
			'order'     => 'order',
			'sort'      => ['enum' => ['name', 'dateexpire', 'dateregister', 'dateupdate', 'id']],
			'action'    => ['enum' => ['active', 'deactive']],
			'lock'      => ['enum' => ['on', 'off', 'unknown']],
			'autorenew' => ['enum' => ['on', 'off']],
			'predict'   => 'bit',

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


		if(mb_strlen($_query_string) > 50)
		{
			\dash\notif::error(T_("Please search by keyword less than 50 characters"), 'q');
			return false;
		}

		$query_string = \dash\validate::search($_query_string);


		if($query_string)
		{
			$or[]        = " domain.name LIKE '%$query_string%'";



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
			$order_sort = " ORDER BY domain.id DESC";
		}

		if($data['predict'])
		{
			$next_year = date("Y-m-d", strtotime("+365 days"));
			$and[] = " DATE(domain.dateexpire) <= DATE('$next_year') ";
			$and[] = " domain.status != 'deleted' ";
		}
		else
		{
			if($data['autorenew'] === 'on')
			{
				$and[] = " domain.autorenew = 1 ";
				self::$is_filtered          = true;
				self::$filter_args[T_("Autorenew")] = T_("Active");

			}
			elseif($data['autorenew'] === 'off')
			{
				$and[] = " ( domain.autorenew IS NULL OR domain.autorenew = 0 ) ";
				self::$is_filtered          = true;
				self::$filter_args[T_("Autorenew")] = T_("Deactive");
			}

			if($data['lock'] === 'on')
			{
				$and[] = " domain.lock = 1 ";
				self::$is_filtered          = true;
				self::$filter_args[T_("Lock")] = T_("Active");
			}
			elseif($data['lock'] === 'off')
			{
				$and[] = " domain.lock = 0 ";
				self::$is_filtered          = true;
				self::$filter_args[T_("Lock")] = T_("Deactive");
			}
			elseif($data['lock'] === 'unknown')
			{
				$and[] = " domain.lock IS NULL  ";
				self::$is_filtered          = true;
				self::$filter_args[T_("Lock")] = T_("Unknown");
			}


			if($data['action'] === 'active')
			{
				// $and[] = " domain.status = 'enable' ";
				$and[] = " domain.verify = 1 AND domain.available = 0 ";
				self::$is_filtered          = true;
				self::$filter_args[T_("Status")] = T_("Active");
			}
			elseif($data['action'] === 'deactive')
			{
				// $and[] = " domain.status NOT IN ('deleted', 'enable') ";
				$and[] = " ( domain.verify = 0 OR domain.verify IS NULL OR domain.available = 1 OR domain.available IS NULL ) ";

				self::$is_filtered          = true;
				self::$filter_args[T_("Status")] = T_("Deactive");
			}
		}

		$and[] = " domain.status != 'deleted' ";

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