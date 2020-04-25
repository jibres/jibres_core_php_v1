<?php
namespace lib\app\nic_domainbilling;

class search
{

	public static function my_list($_query_string, $_args)
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$_args['user_id'] = \dash\user::id();

		return self::list($_query_string, $_args);
	}



	public static function list($_query_string, $_args)
	{

		$condition =
		[
			'order'     => 'order',
			'sort'      => ['enum' => ['id',]],
			'domain_id' => 'code',
			'user_id'   => 'id',
			'user'   => 'code',
			'lastyear'  => 'bit',
			'action'    => 'string_100',
			'is_admin'  => 'bit',
		];

		$require = [];

		$meta =
		[
			'field_title' =>
			[

			],
		];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$and           = [];
		$meta          = [];
		$or            = [];


		if($data['domain_id'])
		{
			$data['domain_id'] = \dash\coding::decode($data['domain_id']);
			$and[]         = " domainbilling.domain_id = $data[domain_id] ";
		}

		if($data['user'])
		{
			$data['user_id'] = \dash\coding::decode($data['user']);
		}

		if($data['user_id'])
		{
			$and[]         = " domainbilling.user_id = $data[user_id] ";
		}


		if($data['lastyear'])
		{
			$lastyear = date("Y-m-d", strtotime("-365 days"));

			$and[]         = " DATE(domainbilling.datecreated) > DATE('$lastyear') ";
		}

		if($data['action'])
		{
			$and[]         = " domainbilling.action = '$data[action]' ";
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

		}

		$meta['limit'] = 20;

		$order_sort    = " ORDER BY domainbilling.id DESC";

		$list = \lib\db\nic_domainbilling\search::list($and, $or, $order_sort, $meta);

		if(!is_array($list))
		{
			$list = [];
		}

		$load_transaction_detail = [];
		$transaction_id          = array_column($list, 'transaction_id');
		$transaction_id          = array_filter($transaction_id);
		$transaction_id          = array_unique($transaction_id);
		if($transaction_id)
		{
			$load_transaction_detail = \dash\db\transactions::load_multi_id(implode(',', $transaction_id));
			if(!is_array($load_transaction_detail))
			{
				$load_transaction_detail = [];
			}

			$load_transaction_detail = array_combine(array_column($load_transaction_detail, 'id'), $load_transaction_detail);
		}

		if($data['is_admin'])
		{

			$users_id = array_column($list, 'user_id');
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
				if(isset($value['user_id']) && $value['user_id'] && isset($load_some_user[$value['user_id']]))
				{
					$user_detail = $load_some_user[$value['user_id']];
					$user_detail = \dash\app\user::ready($user_detail);
					$list[$key]['user_detail'] = $user_detail;
				}
				else
				{
					$list[$key]['user_detail'] = \dash\app::fix_avatar([]);
				}
			}

		}

		foreach ($list as $key => $value)
		{
			$list[$key] = \lib\app\nic_domainbilling\ready::row($value, $load_transaction_detail);
		}

		return $list;
	}


	public static function buyers($_query_string, $_args)
	{

		$condition =
		[
			'order'     => 'order',
			'sort'      => ['enum' => ['id',]],
			'domain_id' => 'code',
			'user_id'   => 'id',
			'user'   => 'code',
			'lastyear'  => 'bit',
			'action'    => 'string_100',
			'is_admin'  => 'bit',
		];

		$require = [];

		$meta =
		[
			'field_title' =>
			[

			],
		];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$and           = [];
		$meta          = [];
		$or            = [];


		if($data['domain_id'])
		{
			$data['domain_id'] = \dash\coding::decode($data['domain_id']);
			$and[]         = " domainbilling.domain_id = $data[domain_id] ";
		}

		if($data['user'])
		{
			$data['user_id'] = \dash\coding::decode($data['user']);
		}

		if($data['user_id'])
		{
			$and[]         = " domainbilling.user_id = $data[user_id] ";
		}


		if($data['lastyear'])
		{
			$lastyear = date("Y-m-d", strtotime("-365 days"));

			$and[]         = " DATE(domainbilling.datecreated) > DATE('$lastyear') ";
		}

		if($data['action'])
		{
			$and[]         = " domainbilling.action = '$data[action]' ";
		}


		if(mb_strlen($_query_string) > 50)
		{
			\dash\notif::error(T_("Please search by keyword less than 50 characters"), 'q');
			return false;
		}

		$query_string = \dash\validate::search($_query_string);


		if($query_string)
		{
			// $or[]        = " domain.name LIKE '%$query_string%'";

		}

		$meta['limit'] = 20;

		$order_sort    = " ORDER BY MAX(domainbilling.id) DESC";

		$list = \lib\db\nic_domainbilling\search::buyers($and, $or, $order_sort, $meta);

		if(!is_array($list))
		{
			$list = [];
		}

		$load_transaction_detail = [];
		$transaction_id          = array_column($list, 'transaction_id');
		$transaction_id          = array_filter($transaction_id);
		$transaction_id          = array_unique($transaction_id);
		if($transaction_id)
		{
			$load_transaction_detail = \dash\db\transactions::load_multi_id(implode(',', $transaction_id));
			if(!is_array($load_transaction_detail))
			{
				$load_transaction_detail = [];
			}

			$load_transaction_detail = array_combine(array_column($load_transaction_detail, 'id'), $load_transaction_detail);
		}

		if($data['is_admin'])
		{

			$users_id = array_column($list, 'user_id');
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
				if(isset($value['user_id']) && $value['user_id'] && isset($load_some_user[$value['user_id']]))
				{
					$user_detail = $load_some_user[$value['user_id']];
					$user_detail = \dash\app\user::ready($user_detail);
					$list[$key]['user_detail'] = $user_detail;
				}
				else
				{
					$list[$key]['user_detail'] = \dash\app::fix_avatar([]);
				}
			}

		}

		foreach ($list as $key => $value)
		{
			$list[$key] = \lib\app\nic_domainbilling\ready::row($value, $load_transaction_detail);
		}

		return $list;
	}
}
?>