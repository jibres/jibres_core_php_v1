<?php
namespace lib\app\nic_domain;


class get
{
	public static function is_my_domain($_domain)
	{
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

		return $load_domain;


	}

	private static function update_fetch($_domain, $_load_domain)
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
			$update_domain['roid'] = $fetch['roid'];
		}

		if(isset($fetch['crDate']))
		{
			$update_domain['dateregister'] = $fetch['crDate'];
		}


		if(isset($fetch['exDate']))
		{
			$update_domain['dateexpire'] = $fetch['exDate'];
		}

		if(isset($fetch['upDate']))
		{
			$update_domain['dateupdate'] = $fetch['upDate'];
		}

		if(isset($fetch['status']) && is_array($fetch['status']))
		{
			$update_domain['nicstatus'] = json_encode($fetch['status'], JSON_UNESCAPED_UNICODE);
		}



		if(isset($fetch['holder']))
		{
			$update_domain['holder'] = $fetch['holder'];
		}

		if(isset($fetch['admin']))
		{
			$update_domain['admin'] = $fetch['admin'];
		}

		if(isset($fetch['bill']))
		{
			$update_domain['bill'] = $fetch['bill'];
		}

		if(isset($fetch['tech']))
		{
			$update_domain['tech'] = $fetch['tech'];
		}

		if(isset($fetch['reseller']))
		{
			$update_domain['reseller'] = $fetch['reseller'];
		}

		$update_domain['lastfetch'] = date("Y-m-d H:i:s");

		\lib\db\nic_domain\update::update($update_domain, $_load_domain['id']);

	}


	public static function check($_domain)
	{
		if(!\lib\app\nic_domain\check::syntax($_domain))
		{
			return false;
		}

		$result = \lib\nic\exec\domain_check::check($_domain);

		return $result;

	}


	public static function info($_domain)
	{
		if(!\lib\app\nic_domain\check::syntax($_domain))
		{
			return false;
		}

		$result = \lib\nic\exec\domain_info::info($_domain);

		return $result;

	}



	public static function by_id($_id)
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		if(!is_numeric($_id))
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
}
?>