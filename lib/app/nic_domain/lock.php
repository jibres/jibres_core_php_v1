<?php
namespace lib\app\nic_domain;


class lock
{
	public static function lock($_domain)
	{

		if(!\dash\user::id())
		{
			return;
		}

		if(!$_domain)
		{
			\dash\notif::error(T_("Please set domain"));
			return false;
		}


		if(!\dash\validate::domain($_domain))
		{
			\dash\notif::error(T_("Invalid domain syntax"));
			return false;
		}

		$load_domain = \lib\db\nic_domain\get::domain_user($_domain, \dash\user::id());
		if(!isset($load_domain['id']))
		{
			\dash\notif::error(T_("Invalid domain"));
			return false;
		}

		if(isset($load_domain['verify']) && $load_domain['verify'])
		{

		}
		else
		{
			\dash\notif::error(T_("You can not edit this domain setting"));
			return false;
		}

		if(isset($load_domain['status']) && $load_domain['status'] === 'enable')
		{
			// no problem
		}
		else
		{
			\dash\notif::error(T_("You can not edit this domain setting"));
			return false;
		}


		if(array_key_exists('lock', $load_domain) && $load_domain['lock'])
		{
			\dash\notif::info(T_("This domain is already locked"));
			return true;
		}

		$result = \lib\nic\exec\domain_lock::lock($_domain);
		if($result)
		{
			$_domain_id = \lib\db\nic_domain\update::update(['lock' => 1], $load_domain['id']);

			$insert_action =
			[
				'domain_id'      => $load_domain['id'],
				'user_id'        => \dash\user::id(),
				'status'         => 'enable', // 'enable', 'disable', 'deleted', 'expire'
				'action'         => 'lock', // 'register', 'renew', 'transfer', 'unlock', 'lock', 'changedns', 'updateholder', 'delete', 'expire'
				'mode'           => 'manual', // 'auto', 'manual'
				'detail'         => null,
				'date'           => date("Y-m-d H:i:s"),
				'price'          => null,
				'discount'       => null,
				'transaction_id' => null,
				'datecreated'    => date("Y-m-d H:i:s"),
			];

			$domain_action_id = \lib\db\nic_domainaction\insert::new_record($insert_action);


			\dash\notif::ok(T_("Domain is locked"));
			return true;

		}

		\dash\notif::error(T_("Can not lock your domain"));
		return false;

	}


	public static function unlock($_domain)
	{

		if(!\dash\user::id())
		{
			return;
		}

		if(!$_domain)
		{
			\dash\notif::error(T_("Please set domain"));
			return false;
		}


		if(!\dash\validate::domain($_domain))
		{
			\dash\notif::error(T_("Invalid domain syntax"));
			return false;
		}

		$load_domain = \lib\db\nic_domain\get::domain_user($_domain, \dash\user::id());
		if(!isset($load_domain['id']))
		{
			\dash\notif::error(T_("Invalid domain"));
			return false;
		}

		if(isset($load_domain['verify']) && $load_domain['verify'])
		{

		}
		else
		{
			\dash\notif::error(T_("You can not edit this domain setting"));
			return false;
		}


		if(isset($load_domain['status']) && $load_domain['status'] === 'enable')
		{
			// no problem
		}
		else
		{
			\dash\notif::error(T_("You can not edit this domain setting"));
			return false;
		}


		if(array_key_exists('lock', $load_domain) && !$load_domain['lock'])
		{
			\dash\notif::info(T_("This domain is already unlocked"));
			return true;
		}

		$result = \lib\nic\exec\domain_lock::unlock($_domain);
		if($result)
		{
			$_domain_id = \lib\db\nic_domain\update::update(['lock' => null], $load_domain['id']);

			$insert_action =
			[
				'domain_id'      => $load_domain['id'],
				'user_id'        => \dash\user::id(),
				'status'         => 'enable', // 'enable', 'disable', 'deleted', 'expire'
				'action'         => 'unlock', // 'register', 'renew', 'transfer', 'unlock', 'lock', 'changedns', 'updateholder', 'delete', 'expire'
				'mode'           => 'manual', // 'auto', 'manual'
				'detail'         => null,
				'date'           => date("Y-m-d H:i:s"),
				'price'          => null,
				'discount'       => null,
				'transaction_id' => null,
				'datecreated'    => date("Y-m-d H:i:s"),
			];

			$domain_action_id = \lib\db\nic_domainaction\insert::new_record($insert_action);


			\dash\notif::ok(T_("Domain is unlocked"));
			return true;

		}

		\dash\notif::error(T_("Can not unlock your domain"));
		return false;

	}
}
?>