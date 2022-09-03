<?php

namespace lib\app\store_user;

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
				'sort'        => ['enum' => ['datecreated', 'id']],
				'staff'       => 'bit',
				'user'        => 'code',
				'customer'    => 'bit',
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

		if ($data['user'])
		{
			$user_id = \dash\coding::decode($data['user']);
			if ($user_id)
			{
				$and[]             = " store_user.user_id = :user_id ";
				$param[':user_id'] = $user_id;
				self::$is_filtered = true;
			}
		}


		$meta['join'][] = " LEFT JOIN store_data ON store_data.id = store_user.store_id ";

		$meta['fields'] =
			"
			store_user.*,
			store_data.title
		";


		$query_string = \dash\validate::search($_query_string, false);

		if ($query_string)
		{
			$or[]         = " store_data.title LIKE :q1 ";
			$param[':q1'] = "%$query_string%";

			if(is_numeric($query_string))
			{

				$or[]         = " store_user.id = :q6 ";
				$param[':q6'] = $query_string;

				$or[]         = " store_user.store_id = :q2 ";
				$param[':q2'] = $query_string;
			}

			$meta['join'][] = " LEFT JOIN users ON users.id = store_data.owner ";

			$or[]         = " users.displayname LIKE :q3 ";
			$or[]         = " users.mobile LIKE :q4 ";
			$param[':q3'] = "%$query_string%";
			$param[':q4'] = "%$query_string%";

			if ($my_store_id = \dash\store_coding::decode('$' . $query_string))
			{
				$or[]         = " store.id = :q5 ";
				$param[':q5'] = $my_store_id;
			}

			self::$is_filtered = true;
		}

		$check_order_trust = \lib\app\store_user\filter::check_allow($data['sort'], $data['order']);

		if ($check_order_trust)
		{
			$sort = \dash\str::mb_strtolower($data['sort']);
			if ($data['order'])
			{
				$order = \dash\str::mb_strtolower($data['order']);
			}

			$order_sort = " ORDER BY store_user.$sort $order";
		}


		if (!$order_sort)
		{
			$order_sort = " ORDER BY store_user.id DESC";
		}

		$list = \lib\db\store_user\search::list($param ,$and, $or, $order_sort, $meta);

		if (!is_array($list))
		{
			$list = [];
		}


		$users_id = array_column($list, 'user_id');
		$users_id = array_filter($users_id);
		$users_id = array_unique($users_id);

		if ($users_id)
		{
			$load_some_user = \dash\db\users\get::by_multi_id(implode(',', $users_id));
			if (is_array($load_some_user))
			{
				$load_some_user = array_combine(array_column($load_some_user, 'id'), $load_some_user);
				foreach ($list as $key => $value)
				{
					if (isset($value['user_id']) && $value['user_id'] && isset($load_some_user[$value['user_id']]))
					{
						$user_detail               = $load_some_user[$value['user_id']];
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
			if (isset($list[0][$key]) && substr($value, 0, 1) === '*')
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


