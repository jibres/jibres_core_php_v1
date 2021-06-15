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


		$load_domain = \lib\db\nic_domain\get::load_domain_user($_domain, \dash\user::id());
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


	public static function force_fetch($_domain)
	{
		$load_domain = \lib\db\nic_domain\get::domain_anyone($_domain);
		if(!isset($load_domain['id']))
		{
			return false;
		}

		self::update_fetch($_domain, $load_domain);
	}


	public static function update_fetch($_domain, $_load_domain)
	{
		if(!\dash\validate::ir_domain($_domain, false))
		{
			self::com_domain_fetch($_domain, $_load_domain);
		}
		else
		{
			self::ir_domain_fetch($_domain, $_load_domain);
		}

		$load_domain = \lib\app\nic_domain\ready::row($_load_domain);

		if(a($load_domain, 'ns1') && a($load_domain, 'ns2') && a($load_domain, 'jibres_dns') === false)
		{
			// if exists in business domain remove it
			\lib\app\business_domain\dns::check_remove($_domain, $load_domain);
		}
		else
		{
			\lib\app\business_domain\add::from_domain_update($_domain);
		}

	}

	private static function com_domain_fetch($_domain, $_load_domain)
	{

		$get_domain_info = \lib\onlinenic\api::info_domain($_domain);

		if(!isset($get_domain_info['data']))
		{
			return false;
		}

		$fetch = $get_domain_info['data'];

		$update_domain = [];

		if(isset($fetch['status']))
		{
			$update_domain['nicstatus'] = $fetch['status'];
		}

		if(isset($fetch['regdate']))
		{
			$update_domain['dateregister'] = \dash\validate::string($fetch['regdate'], false);
		}

		if(isset($fetch['expdate']))
		{
			$update_domain['dateexpire'] = \dash\validate::string($fetch['expdate'], false);
		}

		if(isset($fetch['registrant']))
		{
			$update_domain['reseller'] = \dash\validate::string($fetch['registrant'], false);
		}


		if(isset($fetch['admin']))
		{
			$update_domain['admin'] = \dash\validate::string($fetch['admin'], false);
		}

		if(isset($fetch['tech']))
		{
			$update_domain['tech'] = \dash\validate::string($fetch['tech'], false);
		}

		if(isset($fetch['billing']))
		{
			$update_domain['bill'] = \dash\validate::string($fetch['billing'], false);
		}

		if(isset($fetch['dns1']))
		{
			$update_domain['ns1'] = \dash\validate::string($fetch['dns1'], false);
		}
		else
		{
			$update_domain['ns1'] = null;
		}


		if(isset($fetch['dns2']))
		{
			$update_domain['ns2'] = \dash\validate::string($fetch['dns2'], false);
		}
		else
		{
			$update_domain['ns2'] = null;
		}

		$update_domain['lastfetch'] = date("Y-m-d H:i:s");

		if(!\dash\url::isLocal())
		{
			\lib\db\nic_domain\update::update_by_dumain($update_domain, $_load_domain['name']);
		}

		return $fetch;
	}


	private static function ir_domain_fetch($_domain, $_load_domain)
	{
		if(\dash\temp::get('update_fetch_from_info_function'))
		{
			$fetch = \dash\temp::get('update_fetch_from_info_function_result');
		}
		else
		{
			$fetch = self::info($_domain);
		}

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
			$update_domain['roid'] = \dash\validate::string($fetch['roid'], false);
		}

		if(isset($fetch['crDate']))
		{
			$update_domain['dateregister'] = \dash\validate::string($fetch['crDate'], false);
		}


		if(isset($fetch['exDate']))
		{
			$update_domain['dateexpire'] = \dash\validate::string($fetch['exDate'], false);
		}

		if(isset($fetch['upDate']))
		{
			$update_domain['dateupdate'] = \dash\validate::string($fetch['upDate'], false);
		}

		if(isset($fetch['status']) && is_array($fetch['status']))
		{
			$update_domain['nicstatus'] = json_encode($fetch['status'], JSON_UNESCAPED_UNICODE);
		}

		$have_holder = false;

		if(isset($fetch['holder']))
		{
			$update_domain['holder'] = \dash\validate::string($fetch['holder'], false);
			$have_holder = true;
		}

		if(isset($fetch['admin']))
		{
			$update_domain['admin'] = \dash\validate::string($fetch['admin'], false);
		}
		else
		{
			if($have_holder)
			{
				$update_domain['admin'] = null;
			}
		}

		if(isset($fetch['bill']))
		{
			$update_domain['bill'] = \dash\validate::string($fetch['bill'], false);
		}
		else
		{
			if($have_holder)
			{
				$update_domain['bill'] = null;
			}
		}


		if(isset($fetch['tech']))
		{
			$update_domain['tech'] = \dash\validate::string($fetch['tech'], false);
		}
		else
		{
			if($have_holder)
			{
				$update_domain['tech'] = null;
			}
		}


		if(isset($fetch['reseller']))
		{
			$update_domain['reseller'] = \dash\validate::string($fetch['reseller'], false);
		}
		else
		{
			if($have_holder)
			{
				$update_domain['reseller'] = null;
			}
		}



		if(isset($fetch['ns'][0]))
		{
			$update_domain['ns1'] = \dash\validate::string($fetch['ns'][0], false);
		}
		else
		{
			$update_domain['ns1'] = null;
		}

		if(isset($fetch['ns'][1]))
		{
			$update_domain['ns2'] = \dash\validate::string($fetch['ns'][1], false);
		}
		else
		{
			$update_domain['ns2'] = null;
		}

		if(isset($fetch['ns'][2]))
		{
			$update_domain['ns3'] = \dash\validate::string($fetch['ns'][2], false);
		}
		else
		{
			$update_domain['ns3'] = null;
		}

		if(isset($fetch['ns'][3]))
		{
			$update_domain['ns4'] = \dash\validate::string($fetch['ns'][3], false);
		}
		else
		{
			$update_domain['ns4'] = null;
		}

		self::update_domain_status($_domain, $_load_domain, $fetch);

		$update_domain['available'] = 0;

		if(isset($fetch['available']) && $fetch['available'])
		{
			// this domain is not enable for this user
			// nic rejected this domain
			// $update_domain['status']       = 'disable';
			$update_domain['available']    = 1;

			$update_domain['lock']         = null;
			$update_domain['autorenew']    = null;

			$update_domain['holder']       = null;
			$update_domain['admin']        = null;
			$update_domain['tech']         = null;
			$update_domain['bill']         = null;

			$update_domain['ns1']          = null;
			$update_domain['ns2']          = null;
			$update_domain['ns3']          = null;
			$update_domain['ns4']          = null;

			$update_domain['dateregister'] = null;
			$update_domain['dateexpire']   = null;
		}

		$update_domain['lastfetch'] = date("Y-m-d H:i:s");

		if(!\dash\url::isLocal())
		{
			\lib\db\nic_domain\update::update_by_dumain($update_domain, $_load_domain['name']);
		}
	}


	private static function update_domain_status($_domain, $_load_domain, $_fetch)
	{
		$get_current_domain_status = \lib\db\nic_domainstatus\get::by_domain($_domain);
		if(!is_array($get_current_domain_status))
		{
			$get_current_domain_status = [];
		}

		$current_status = array_column($get_current_domain_status, 'status');

		$new_status = [];

		if(isset($_fetch['status']) && is_array($_fetch['status']))
		{
			$new_status = $_fetch['status'];
		}

		$must_add    = array_diff($new_status, $current_status);
		$must_remove = array_diff($current_status, $new_status);

		if(!empty($must_add))
		{

			$add_multi = [];
			foreach ($must_add as $key => $value)
			{
				$add_multi[] =
				[
					'domain'      => $_domain,
					'status'      => $value,
					'active'      => 1,
					'datecreated' => date("Y-m-d H:i:s"),
				];
			}

			\lib\db\nic_domainstatus\insert::multi_insert($add_multi);
		}

		if(!empty($must_remove))
		{
			foreach ($must_remove as $key => $value)
			{
				$update = ['active' => 0, 'datemodified' => date("Y-m-d H:i:s")];
				$where  = ['domain' => $_domain, 'active' => 1, 'status' => $value];
				\lib\db\nic_domainstatus\update::update_where($update, $where);
			}
		}

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

		\dash\temp::set('update_fetch_from_info_function', true);
		\dash\temp::set('update_fetch_from_info_function_result', $result);

		self::force_fetch($_domain);

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


	public static function get($_id)
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$id = \dash\coding::decode($_id);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$load = \lib\db\nic_domain\get::by_id_user_id($id, \dash\user::id());

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

		if(isset($load['lastfetch']) && $load['lastfetch'])
		{
			// fetch every 1 hour
			if(time() - strtotime($load['lastfetch']) > (60*60))
			{
				self::update_fetch($load['name'], $load);
			}
		}
		else
		{
			self::update_fetch($load['name'], $load);
		}

		return $load;

	}
}
?>