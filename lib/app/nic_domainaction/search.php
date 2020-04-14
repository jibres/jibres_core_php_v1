<?php
namespace lib\app\nic_domainaction;

class search
{

	public static function all_list($_query_string, $_args)
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$_args['user_id'] = \dash\user::id();

		return self::list($_query_string, $_args);
	}


	public static function domain_list($_query_string, $_args)
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$_args['user_id'] = \dash\user::id();

		return self::list($_query_string, $_args);
	}


	private static function list($_query_string, $_args)
	{

		$condition =
		[
			'domain_id' => 'code',
			'user_id'   => 'id',
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
			$and[]         = " domainaction.domain_id = $data[domain_id] ";
		}

		if($data['user_id'])
		{
			$and[]         = " domainaction.user_id = $data[user_id] ";
		}

		$meta['limit'] = 10;

		$order_sort    = " ORDER BY domainaction.id DESC";

		$list = \lib\db\nic_domainaction\search::list($and, $or, $order_sort, $meta);

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

		foreach ($list as $key => $value)
		{
			$list[$key] = \lib\app\nic_domainaction\ready::row($value, $load_transaction_detail);
		}

		return $list;
	}
}
?>