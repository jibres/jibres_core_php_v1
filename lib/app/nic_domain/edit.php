<?php
namespace lib\app\nic_domain;


class edit
{
	public static function domain($_args, $_id, $_type = null)
	{
		$load_domain = \lib\app\nic_domain\get::by_id($_id);
		if(!$load_domain || !isset($load_domain['id']))
		{
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

		$ns1   = isset($_args['ns1']) 	? $_args['ns1']		: null;
		$ip1   = isset($_args['ip1']) 	? $_args['ip1']		: null;

		$ns2   = isset($_args['ns2']) 	? $_args['ns2']		: null;
		$ip2   = isset($_args['ip2']) 	? $_args['ip2']		: null;

		$ns3   = isset($_args['ns3']) 	? $_args['ns3']		: null;
		$ip3   = isset($_args['ip3']) 	? $_args['ip3']		: null;

		$ns4   = isset($_args['ns4']) 	? $_args['ns4']		: null;
		$ip4   = isset($_args['ip4']) 	? $_args['ip4']		: null;


		$holder = isset($_args['holder']) 	? $_args['holder']		: null;
		$admin  = isset($_args['admin']) 	? $_args['admin']		: null;
		$tech   = isset($_args['tech']) 	? $_args['tech']		: null;
		$bill   = isset($_args['bill']) 	? $_args['bill']		: null;

		if($holder && substr($holder, -6) !== '-irnic')
		{
			$holder = $holder. '-irnic';
		}

		if($admin && substr($admin, -6) !== '-irnic')
		{
			$admin = $admin. '-irnic';
		}

		if($bill && substr($bill, -6) !== '-irnic')
		{
			$bill = $bill. '-irnic';
		}

		if($tech && substr($tech, -6) !== '-irnic')
		{
			$tech = $tech. '-irnic';
		}

		$ns1 = \lib\app\nic_dns\add::validate_ns($ns1, 'ns1');
		$ns2 = \lib\app\nic_dns\add::validate_ns($ns2, 'ns2');
		$ns3 = \lib\app\nic_dns\add::validate_ns($ns3, 'ns3');
		$ns4 = \lib\app\nic_dns\add::validate_ns($ns4, 'ns4');

		$ip1 = \lib\app\nic_dns\add::validate_ip($ip1, 'ip1');
		$ip2 = \lib\app\nic_dns\add::validate_ip($ip2, 'ip2');
		$ip3 = \lib\app\nic_dns\add::validate_ip($ip3, 'ip3');
		$ip4 = \lib\app\nic_dns\add::validate_ip($ip4, 'ip4');

		if(!\dash\engine\process::status())
		{
			return false;
		}


		$args                        = [];
		$update_domian_record        = [];
		$args_new_dns                = [];
		$new_dns                     = false;
		$update_holder               = false;
		$update_holder_detail        = [];
		$update_holder_detail['old'] = [];
		$update_holder_detail['new'] = [];

		if($_type == 'dns')
		{

			// if(!$ns1 || !$ns2)
			// {
			// 	\dash\notif::error(T_("DNS #1 and DNS #2 is required"), ['element' => ['ns1', 'ns2']]);
			// 	return false;
			// }

			if($load_domain['ns1'] != $ns1)
			{
				$args['old_ns1']     = $load_domain['ns1'];
				$args['new_ns1']     = $ns1;
				$args_new_dns['ns1'] = $ns1;
				$new_dns             = true;
			}
			else
			{
				$args_new_dns['ns1'] = $load_domain['ns1'];
			}

			if($load_domain['ns2'] != $ns2)
			{
				$args['old_ns2']     = $load_domain['ns2'];
				$args['new_ns2']     = $ns2;
				$args_new_dns['ns2'] = $ns2;
				$new_dns             = true;
			}
			else
			{
				$args_new_dns['ns2'] = $load_domain['ns2'];
			}

			if($load_domain['ns3'] != $ns3)
			{
				$args['old_ns3']     = $load_domain['ns3'];
				$args['new_ns3']     = $ns3;
				$args_new_dns['ns3'] = $ns3;
				$new_dns             = true;
			}
			else
			{
				$args_new_dns['ns3'] = $load_domain['ns3'];
			}

			if($load_domain['ns4'] != $ns4)
			{
				$args['old_ns4']     = $load_domain['ns4'];
				$args['new_ns4']     = $ns4;
				$args_new_dns['ns4'] = $ns4;
				$new_dns             = true;
			}
			else
			{
				$args_new_dns['ns4'] = $load_domain['ns4'];
			}




			if($load_domain['ip1'] != $ip1)
			{
				$args['old_ip1']     = $load_domain['ip1'];
				$args['new_ip1']     = $ip1;
				$args_new_dns['ip1'] = $ip1;
				$new_dns             = true;
			}
			else
			{
				$args_new_dns['ip1'] = $load_domain['ip1'];
			}


			if($load_domain['ip2'] != $ip2)
			{
				$args['old_ip2']     = $load_domain['ip2'];
				$args['new_ip2']     = $ip2;
				$args_new_dns['ip2'] = $ip2;
				$new_dns             = true;
			}
			else
			{
				$args_new_dns['ip2'] = $load_domain['ip2'];
			}


			if($load_domain['ip3'] != $ip3)
			{
				$args['old_ip3']     = $load_domain['ip3'];
				$args['new_ip3']     = $ip3;
				$args_new_dns['ip3'] = $ip3;
				$new_dns             = true;
			}
			else
			{
				$args_new_dns['ip3'] = $load_domain['ip3'];
			}


			if($load_domain['ip4'] != $ip4)
			{
				$args['old_ip4']     = $load_domain['ip4'];
				$args['new_ip4']     = $ip4;
				$args_new_dns['ip4'] = $ip4;
				$new_dns             = true;
			}
			else
			{
				$args_new_dns['ip4'] = $load_domain['ip4'];
			}

		}

		if($_type == 'holder')
		{
			// if(isset($load_domain['holder']) && $load_domain['holder'] != $holder)
			// {
			// 	$args['holder']                        = $holder;
			// 	$update_domian_record['holder']        = $holder;
			// 	$update_holder_detail['old']['holder'] = $load_domain['holder'];
			// 	$update_holder_detail['new']['holder'] = $holder;
			// 	$update_holder                         = true;
			// }

			// if(isset($load_domain['admin']) && $load_domain['admin'] != $admin)
			// {
			// 	$args['admin']                        = $admin;
			// 	$update_domian_record['admin']        = $admin;
			// 	$update_holder_detail['old']['admin'] = $load_domain['admin'];
			// 	$update_holder_detail['new']['admin'] = $admin;
			// 	$update_holder                        = true;
			// }

			if(array_key_exists('tech', $load_domain) && $load_domain['tech'] != $tech)
			{
				$args['tech']                        = $tech;
				$update_domian_record['tech']        = $tech;
				$update_holder_detail['old']['tech'] = $load_domain['tech'];
				$update_holder_detail['new']['tech'] = $tech;
				$update_holder                       = true;

			}

			if(array_key_exists('bill', $load_domain) && $load_domain['bill'] != $bill)
			{
				$args['bill']                        = $bill;
				$update_domian_record['bill']        = $bill;
				$update_holder_detail['old']['bill'] = $load_domain['bill'];
				$update_holder_detail['new']['bill'] = $bill;
				$update_holder                       = true;
			}


		}

		if(empty($args))
		{
			\dash\notif::info(T_("No change in domain"));
			return true;
		}

		$args['domain']  = $load_domain['name'];

		$update_domian = \lib\nic\exec\domain_update::update($args);
		if(!$update_domian)
		{
			\dash\notif::error(T_("Can not update your domain detail now!"));
			return false;
		}

		if($new_dns)
		{
			$dns_id = \lib\app\nic_dns\add::new_record($args_new_dns);
			if(!$dns_id)
			{
				return false;
			}

			$update_domian_record['dns'] = $dns_id;
		}

		if(!empty($update_domian_record))
		{
			if($update_holder)
			{
				$insert_action =
				[
					'domain_id'      => $_id,
					'user_id'        => \dash\user::id(),
					'status'         => 'enable', // 'enable', 'disable', 'deleted', 'expire'
					'action'         => 'updateholder', // 'register', 'renew', 'transfer', 'unlock', 'lock', 'changedns', 'updateholder', 'delete', 'expire'
					'mode'           => 'manual', // 'auto', 'manual'
					'detail'         => json_encode($update_holder_detail, JSON_UNESCAPED_UNICODE),
					'date'           => date("Y-m-d H:i:s"),
					'price'          => null,
					'discount'       => null,
					'transaction_id' => null,
					'datecreated'    => date("Y-m-d H:i:s"),
				];

				$domain_action_id = \lib\db\nic_domainaction\insert::new_record($insert_action);
			}

			if($new_dns)
			{
				$update_dns_detail        = [];
				$update_dns_detail['old'] = [];
				$update_dns_detail['new'] = [];

				foreach ($args as $key => $value)
				{
					if(substr($key, 0, 4) === 'new_')
					{
						$update_dns_detail['new'][substr($key, 4)] = $value;
					}

					if(substr($key, 0, 4) === 'old_')
					{
						$update_dns_detail['old'][substr($key, 4)] = $value;
					}
				}

				$insert_action =
				[
					'domain_id'      => $_id,
					'user_id'        => \dash\user::id(),
					'status'         => 'enable', // 'enable', 'disable', 'deleted', 'expire'
					'action'         => 'changedns', // 'register', 'renew', 'transfer', 'unlock', 'lock', 'changedns', 'updateholder', 'delete', 'expire'
					'mode'           => 'manual', // 'auto', 'manual'
					'detail'         => json_encode($update_dns_detail, JSON_UNESCAPED_UNICODE),
					'date'           => date("Y-m-d H:i:s"),
					'price'          => null,
					'discount'       => null,
					'transaction_id' => null,
					'datecreated'    => date("Y-m-d H:i:s"),
				];

				$domain_action_id = \lib\db\nic_domainaction\insert::new_record($insert_action);
			}


			\lib\db\nic_domain\update::update($update_domian_record, $_id);
			\dash\notif::ok(T_("Domain detail updated"));
			return true;
		}
		else
		{
			\dash\notif::wan(T_("No change in you domain detail"));
			return true;
		}



	}


	public static function edit($_args, $_id)
	{
		$load_domain = \lib\app\nic_domain\get::by_id($_id);
		if(!$load_domain || !isset($load_domain['id']))
		{
			return false;
		}

		\dash\app::variable($_args);

		$args = \lib\app\nic_domain\check::variable();

		if(!$args || !\dash\engine\process::status())
		{
			return false;
		}


		if(!\dash\app::isset_request('autorenew')) unset($args['autorenew']);

		if(!empty($args))
		{
			\lib\db\nic_domain\update::update($args, $load_domain['id']);
		}

		\dash\notif::ok(T_("Detail updated"));
		return true;

	}
}
?>