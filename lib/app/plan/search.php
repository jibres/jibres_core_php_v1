<?php
namespace lib\app\plan;

class search
{

	private static $filter_message = null;
	private static $filter_args = [];
	private static $is_filtered = false;


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
				'order'       => 'order',
				'sort'        => filter::sort_enum(),
				'action'      => ['enum' => ['set', 'upgrade', 'downgrade', 'extends',]],
				'status'      => ['enum' => ['active', 'deactive',]],
				'user'        => 'code',
				'plan'        => 'string_100',
				'reason'      => 'string_100',
				'periodtype'  => 'string_100',
				'business_id' => 'id',
			];

		$require = [];
		$meta    = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		$and          = [];
		$meta         = [];
		$or           = [];
		$param        = [];
		$meta['join'] = [];

		$meta['limit'] = 20;


		$order_sort = null;

		if($data['user'])
		{
			$user_id = \dash\coding::decode($data['user']);
			if($user_id)
			{
				$and[]             = " store_data.owner = :user_id ";
				$param[':user_id'] = $user_id;
				self::$is_filtered = true;
			}
		}


		$query_string = \dash\validate::search($_query_string, false);

		$meta['join'][] = " LEFT JOIN store ON store_plan_history.store_id = store.id ";
		$meta['join'][] = " LEFT JOIN store_data ON store_data.id = store.id ";

		$meta['fields'] =
			"
			store_plan_history.*,
			store.status AS `store_status`,
			store.subdomain,
			store_data.owner AS `owner`
		";


		if($data['status'])
		{
			$and[]            = "store_plan_history.status = :status ";
			$param[':status'] = $data['status'];

			self::$is_filtered = true;
		}

		if($data['reason'])
		{
			$and[]            = "store_plan_history.reason = :reason ";
			$param[':reason'] = $data['reason'];

			self::$is_filtered = true;
		}

		if($data['plan'])
		{
			$and[]          = "store_plan_history.plan = :plan ";
			$param[':plan'] = $data['plan'];

			self::$is_filtered = true;
		}

		if($data['periodtype'])
		{
			$and[]                = "store_plan_history.periodtype = :periodtype ";
			$param[':periodtype'] = $data['periodtype'];

			self::$is_filtered = true;
		}


		if($data['action'])
		{
			$and[]            = "store_plan_history.action = :action ";
			$param[':action'] = $data['action'];

			self::$is_filtered = true;
		}

		if($data['business_id'])
		{
			$and[]                 = "store_plan_history.store_id = :business_id ";
			$param[':business_id'] = $data['business_id'];

			self::$is_filtered = true;
		}


		if($query_string)
		{
			$meta['join'][] = " LEFT JOIN users ON users.id = store_data.owner ";

			$or[] = " store_plan_history.plan LIKE :q0 ";
			$or[] = " store_data.title LIKE :q1 ";
			$or[] = " store.subdomain LIKE :q2 ";
			$or[] = " store.id LIKE :q3 ";
			$or[] = " users.displayname LIKE :q4";
			$or[] = " users.mobile LIKE :q5 ";

			$param[':q0'] = "%$query_string%";
			$param[':q1'] = "%$query_string%";
			$param[':q2'] = "%$query_string%";
			$param[':q3'] = "%$query_string%";
			$param[':q4'] = "%$query_string%";
			$param[':q5'] = "%$query_string%";


			self::$is_filtered = true;
		}

		$check_order_trust = filter::check_allow($data['sort'], $data['order']);


		if($check_order_trust)
		{
			$sort = \dash\str::mb_strtolower($data['sort']);
			if($data['order'])
			{
				$order = \dash\str::mb_strtolower($data['order']);
			}

			$order_sort = " ORDER BY store_plan_history.$sort $order";
		}


		if(!$order_sort)
		{
			$order_sort = " ORDER BY store_plan_history.id DESC";
		}


		$list = \lib\db\store_plan_history\search::list($param, $and, $or, $order_sort, $meta);

		if(!is_array($list))
		{
			$list = [];
		}


		$users_id = array_column($list, 'owner');
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
					if(isset($value['owner']) && $value['owner'] && isset($load_some_user[$value['owner']]))
					{
						$user_detail               = $load_some_user[$value['owner']];
						$user_detail               = \dash\app\user::ready($user_detail);
						$list[$key]['user_detail'] = $user_detail;
					}
					else
					{
						$list[$key]['user_detail'] = [];
					}
				}
			}
		}
		$list = array_map(['\\lib\\app\\store\\ready', 'row'], $list);

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


	public static function list_analytics($_query_string, $_args)
	{

		$field_list = \lib\app\store\analytics::field_list();

		$condition =
			[
				'order' => 'order',
				'sort'  => ['enum' => ['name', 'id']],
				'f'     => ['enum' => array_keys($field_list)],
			];

		$require = ['f'];

		$meta =
			[
				'field_title' =>
					[
						'f' => T_("Field"),
					],
			];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		$and  = [];
		$meta = [];
		$or   = [];

		$meta['limit'] = 20;

		$order_sort = null;


		$query_string = \dash\validate::search($_query_string, false);


		if($query_string)
		{
			$or[] = " store_data.title LIKE '%$query_string%'";

			self::$is_filtered = true;
		}


		if($data['sort'] && !$order_sort)
		{
			if(in_array($data['sort'], ['name', 'id']))
			{

				$sort  = \dash\str::mb_strtolower($data['sort']);
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
			$order_sort = " ORDER BY store_analytics.$data[f] DESC";
		}


		$list = \lib\db\store\search::list_analytics($and, $or, $order_sort, $meta, $data['f']);

		if(!is_array($list))
		{
			$list = [];
		}


		$users_id = array_column($list, 'creator');
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
					if(isset($value['creator']) && $value['creator'] && isset($load_some_user[$value['creator']]))
					{
						$user_detail               = $load_some_user[$value['creator']];
						$user_detail               = \dash\app\user::ready($user_detail);
						$list[$key]['user_detail'] = $user_detail;
					}
					else
					{
						$list[$key]['user_detail'] = [];
					}
				}
			}
		}
		$list = array_map(['\\lib\\app\\store\\ready', 'row'], $list);

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


	public static function list_domain($_query_string, $_args)
	{

		$condition =
			[
				'order' => 'order',
				'sort'  => ['enum' => ['name', 'id']],
			];

		$require = [];
		$meta    = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		$and  = [];
		$meta = [];
		$or   = [];

		$meta['limit'] = 20;

		$order_sort = null;


		$query_string = \dash\validate::search($_query_string, false);


		if($query_string)
		{
			$or[] = " store_data.title LIKE '%$query_string%'";

			self::$is_filtered = true;
		}


		if($data['sort'] && !$order_sort)
		{
			if(in_array($data['sort'], ['domain', 'id']))
			{

				$sort  = \dash\str::mb_strtolower($data['sort']);
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
			$order_sort = " ORDER BY store_domain.id DESC";
		}


		$list = \lib\db\store\search::list_domain($and, $or, $order_sort, $meta);

		if(!is_array($list))
		{
			$list = [];
		}


		$users_id = array_column($list, 'creator');
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
					if(isset($value['creator']) && $value['creator'] && isset($load_some_user[$value['creator']]))
					{
						$user_detail               = $load_some_user[$value['creator']];
						$user_detail               = \dash\app\user::ready($user_detail);
						$list[$key]['user_detail'] = $user_detail;
					}
					else
					{
						$list[$key]['user_detail'] = [];
					}
				}
			}
		}

		$list = array_map(['\\lib\\app\\store\\ready', 'row'], $list);
		$list = array_map(['\\lib\\app\\store\\domain', 'ready'], $list);

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