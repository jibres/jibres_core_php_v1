<?php
namespace lib\app\nic_domain;


class get
{
	public static function is_my_domain($_domain)
	{
		$_domain = \dash\validate::domain($_domain);
		if(!$_domain)
		{
			\dash\notif::error(T_("Please fill domain"), 'domain');
			return false;
		}

		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}


		$load_domain = \lib\db\nic_domain\get::domain_user($_domain, \dash\user::id());
		if(!isset($load_domain['id']))
		{
			\dash\notif::error(T_("Invalid domain"));
			return false;
		}

		if(isset($load_domain['status']) && $load_domain['status'] === 'enable')
		{
			if(isset($load_domain['lastfetch']) && $load_domain['lastfetch'])
			{
				// fetch every 1 hour
				if(time() - strtotime($load_domain['lastfetch']) > (60*60))
				{
					self::update_fetch($_domain, $load_domain);
					$load_domain = \lib\db\nic_domain\get::domain_user($_domain, \dash\user::id());
				}
			}
			else
			{
				self::update_fetch($_domain, $load_domain);
				$load_domain = \lib\db\nic_domain\get::domain_user($_domain, \dash\user::id());
			}
		}


		if(isset($load_domain['nicstatus']) && is_string($load_domain['nicstatus']))
		{
			$load_domain['nicstatus_array'] = json_decode($load_domain['nicstatus'], true);
		}
		$load_domain = \lib\app\nic_domain\ready::row($load_domain);
		return $load_domain;


	}

	public static function update_fetch($_domain, $_load_domain)
	{
		$fetch = self::info($_domain);

		if(isset($fetch[$_domain]))
		{
			$fetch = $fetch[$_domain];
		}

		$update_domain = [];

		if(is_array($fetch))
		{
			$update_domain['result'] = json_encode($fetch, JSON_UNESCAPED_UNICODE);
		}

		if(isset($fetch['roid']))
		{
			$update_domain['roid'] = \dash\validate::string($fetch['roid']);
		}

		if(isset($fetch['crDate']))
		{
			$update_domain['dateregister'] = \dash\validate::string($fetch['crDate']);
		}


		if(isset($fetch['exDate']))
		{
			$update_domain['dateexpire'] = \dash\validate::string($fetch['exDate']);
		}

		if(isset($fetch['upDate']))
		{
			$update_domain['dateupdate'] = \dash\validate::string($fetch['upDate']);
		}

		if(isset($fetch['status']) && is_array($fetch['status']))
		{
			$update_domain['nicstatus'] = json_encode($fetch['status'], JSON_UNESCAPED_UNICODE);
		}



		if(isset($fetch['holder']))
		{
			$update_domain['holder'] = \dash\validate::string($fetch['holder']);
		}

		if(isset($fetch['admin']))
		{
			$update_domain['admin'] = \dash\validate::string($fetch['admin']);
		}

		if(isset($fetch['bill']))
		{
			$update_domain['bill'] = \dash\validate::string($fetch['bill']);
		}

		if(isset($fetch['tech']))
		{
			$update_domain['tech'] = \dash\validate::string($fetch['tech']);
		}

		if(isset($fetch['reseller']))
		{
			$update_domain['reseller'] = \dash\validate::string($fetch['reseller']);
		}



		if(isset($fetch['force_disable']) && $fetch['force_disable'])
		{
			// this domain is not enable for this user
			// nic rejected this domain
			$update_domain['status'] = 'disable';
		}

		$update_domain['lastfetch'] = date("Y-m-d H:i:s");

		\lib\db\nic_domain\update::update_by_dumain($update_domain, $_load_domain['name']);

	}


	public static function check($_domain)
	{
		if(!\dash\validate::domain($_domain))
		{
			return false;
		}

		$result = \lib\nic\exec\domain_check::check($_domain);

		\lib\app\domains\detect::domain('check', $_domain, $result);

		return $result;

	}


	public static function info($_domain)
	{
		if(!\dash\validate::domain($_domain))
		{
			return false;
		}

		$result = \lib\nic\exec\domain_info::info($_domain);

		\lib\app\domains\detect::domain_info($_domain, $result);

		return $result;

	}



	public static function by_id($_id)
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		if(!\dash\validate::id($_id))
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$load = \lib\db\nic_domain\get::by_id_user_id($_id, \dash\user::id());

		if(!$load)
		{
			\dash\notif::error(T_("Domain not found"));
			return false;
		}

		return $load;

	}


	public static function only_by_id($_id)
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		if(!\dash\validate::id($_id))
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$load = \lib\db\nic_domain\get::by_id($_id);

		if(!$load)
		{
			\dash\notif::error(T_("Domain not found"));
			return false;
		}

		return $load;

	}
}
?>