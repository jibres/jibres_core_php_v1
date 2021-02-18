<?php
namespace lib\app\nic_domain;


class lock
{
	public static function lock_id($_id)
	{
		$_id = \dash\validate::code($_id);
		$_id = \dash\coding::decode($_id);
		if(!$_id)
		{
			return false;
		}

		$load_domain = \lib\app\nic_domain\get::only_by_id($_id);

		if(isset($load_domain['name']))
		{
			return self::lock($load_domain['name']);
		}

		return false;
	}

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

		$_domain = \dash\validate::domain($_domain);
		if(!$_domain)
		{
			\dash\notif::error(T_("Invalid domain syntax"));
			return false;
		}

		\lib\app\domains\detect::domain('lock', $_domain);

		$load_domain = \lib\db\nic_domain\get::domain_user($_domain, \dash\user::id());
		if(!isset($load_domain['id']))
		{
			\dash\notif::error(T_("Invalid domain"));
			return false;
		}

		if(\lib\app\nic_domain\ready::is_verify($load_domain))
		{

		}
		else
		{
			\dash\notif::error(T_("You can not edit this domain setting"));
			return false;
		}

		if(isset($load_domain['status']) && $load_domain['status'] != 'deleted')
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

			$domain_action_detail =
			[
				'domain_id'      => $load_domain['id'],
			];

			\lib\app\nic_domainaction\action::set('domain_lock', $domain_action_detail);


			\dash\notif::ok(T_("Domain is locked"));
			return true;

		}

		\dash\notif::error(T_("Can not lock your domain"));
		return false;

	}


	public static function unlock_id($_id)
	{
		$_id = \dash\validate::code($_id);
		$_id = \dash\coding::decode($_id);
		if(!$_id)
		{
			return false;
		}

		$load_domain = \lib\app\nic_domain\get::only_by_id($_id);

		if(isset($load_domain['name']))
		{
			return self::unlock($load_domain['name']);
		}

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

		$_domain = \dash\validate::domain($_domain);
		if(!$_domain)
		{
			\dash\notif::error(T_("Invalid domain syntax"));
			return false;
		}

		\lib\app\domains\detect::domain('unlock', $_domain);


		$load_domain = \lib\db\nic_domain\get::domain_user($_domain, \dash\user::id());
		if(!isset($load_domain['id']))
		{
			\dash\notif::error(T_("Invalid domain"));
			return false;
		}

		if(\lib\app\nic_domain\ready::is_verify($load_domain))
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
			$_domain_id = \lib\db\nic_domain\update::update(['lock' => 0], $load_domain['id']);

			$domain_action_detail =
			[
				'domain_id'      => $load_domain['id'],
			];

			\lib\app\nic_domainaction\action::set('domain_unlock', $domain_action_detail);


			\dash\notif::ok(T_("Domain is unlocked"));
			return true;

		}

		\dash\notif::error(T_("Can not unlock your domain"));
		return false;

	}
}
?>