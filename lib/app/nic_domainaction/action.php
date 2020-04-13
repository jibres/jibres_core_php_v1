<?php
namespace lib\app\nic_domainaction;

class action
{

	public static function set($_caller, $_args = [])
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$insert =
		[
			'action'         => $_caller,
			'datecreated'    => date("Y-m-d H:i:s"),
			'user_id'        => \dash\user::id(),

			'status'         => isset($_args['status']) 			? $_args['status'] 			: 'enable',
			'mode'           => isset($_args['mode']) 				? $_args['mode'] 			: 'manual',
			'category'       => isset($_args['category']) 			? $_args['category'] 		: null,
			'domain_id'      => isset($_args['domain_id']) 			? $_args['domain_id'] 		: null,
			'domainname'     => isset($_args['domain']) 			? $_args['domain'] 			: null,
			'detail'         => isset($_args['detail']) 			? $_args['detail'] 			: null,
			'date'           => isset($_args['date']) 				? $_args['date'] 			: null,
			'price'          => isset($_args['price']) 				? $_args['price'] 			: null,
			'discount'       => isset($_args['discount']) 			? $_args['discount'] 		: null,
			'transaction_id' => isset($_args['transaction_id']) 	? $_args['transaction_id'] 	: null,

		];

		$domain_action_id = \lib\db\nic_domainaction\insert::new_record($insert);

	}

	public static function ready_buy_domain($_domain)
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		// unique every domain every day

		$load_old_action = \lib\db\nic_domainaction\get::caller_domain_user_id_date('ready_buy_domain', $_domain, \dash\user::id(), date("Y-m-d"));
		if(isset($load_old_action['id']))
		{
			return false;
		}

		return self::set('ready_buy_domain', ['domain' => $_domain]);
	}
}
?>