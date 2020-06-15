<?php
namespace lib\app\nic_log;

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
			'order'       => 'order',
			'sort'        => ['enum' => ['id', 'type',]],
			'type'        => 'string_50',
			'result_code' => 'number',
			'user_id'     => 'code',
			'ip'          => 'ip',
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


		if($data['type'])
		{

			$and[]                      = " log.type = '$data[type]' ";
			self::$filter_args[T_("Type")] = $data['type'];
			self::$is_filtered          = true;

		}

		if($data['result_code'])
		{

			$and[]                      = " log.result_code = '$data[result_code]' ";
			self::$filter_args[T_("Result code")] = $data['result_code'];
			self::$is_filtered          = true;

		}

		if($data['ip'])
		{
			$ip = ip2long($data['ip']);
			$and[]                      = " log.ip = $ip ";
			self::$filter_args[T_("IP")] = $data['ip'];
			self::$is_filtered          = true;
		}

		if($data['user_id'])
		{
			$user_id = \dash\coding::decode($data['user_id']);
			$and[]                      = " log.user_id = '$user_id' ";
			self::$filter_args[T_("User")] = $data['user_id'];
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
			$mobile = \dash\validate::mobile($query_string, false);
			if($mobile)
			{
				$load_user = \dash\db\users::get_by_mobile($mobile);
				if(isset($load_user['id']))
				{
					$or[]        = " log.user_id = $load_user[id] ";
				}
			}

			$or[]        = " log.domain LIKE '%$query_string%'";
			$or[]        = " log.nic_id LIKE '%$query_string%'";



			self::$is_filtered = true;
		}


		if($data['sort'] && !$order_sort)
		{
			if(in_array($data['sort'], ['id', 'type',]))
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
			$order_sort = " ORDER BY log.id DESC";
		}



		$list = \lib\db\nic_log\search::list($and, $or, $order_sort, $meta);

		if(is_array($list))
		{
			$list = array_map(['\\lib\\app\\nic_log\\ready', 'row'], $list);
		}
		else
		{
			$list = [];
		}

		$users_id = array_column($list, 'user_id_raw');
		$users_id = array_filter($users_id);
		$users_id = array_unique($users_id);

		$load_some_user = [];

		if($users_id)
		{
			$load_some_user = \dash\db\users\get::by_multi_id(implode(',', $users_id));

			if(!is_array($load_some_user))
			{
					$load_some_user = [];
			}

			$load_some_user = array_combine(array_column($load_some_user, 'id'), $load_some_user);
		}

		foreach ($list as $key => $value)
		{
			if(isset($value['user_id_raw']) && $value['user_id_raw'] && isset($load_some_user[$value['user_id_raw']]))
			{
				$user_detail = $load_some_user[$value['user_id_raw']];
				$user_detail = \dash\app\user::ready($user_detail);
				$list[$key]['user_detail'] = $user_detail;
			}
			else
			{
				if(isset($value['gateway']) && $value['gateway'] === 'system')
				{
					$system_user_detail =
					[
						'avatar'        => \dash\url::icon(),
						'gender'        => false,
						'gender_string' => null,
						'displayname'   => T_("Jibres"),
					];

					$list[$key]['user_detail'] = $system_user_detail;
				}
				else
				{
					$list[$key]['user_detail'] = \dash\app::fix_avatar([]);
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

}
?>