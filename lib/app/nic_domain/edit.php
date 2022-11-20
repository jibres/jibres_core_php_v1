<?php
namespace lib\app\nic_domain;


class edit
{
	public static function domain($_args, $_id, $_type = null, $_only_update_database = false, $_admin_edit = false)
	{
		$_id = \dash\validate::code($_id);
		if(!$_id)
		{
			return false;
		}

		$_id = \dash\coding::decode($_id);

		if($_only_update_database)
		{
			$load_domain = \lib\app\nic_domain\get::only_by_id($_id);
		}
		else
		{
			if(\dash\url::content() === 'sudo')
			{
				$load_domain = \lib\app\nic_domain\get::only_by_id($_id);
			}
			else
			{
				$load_domain = \lib\app\nic_domain\get::by_id($_id);
			}

		}

		if(!$load_domain || !isset($load_domain['id']))
		{
			return false;
		}

		if(empty($_args))
		{
			\dash\notif::info(T_("No change in domain"));
			return true;
		}

		if(\lib\app\nic_domain\ready::is_verify($load_domain, $_type))
		{
			// no problem
		}
		else
		{
			if($_admin_edit)
			{
				// ok
			}
			else
			{
				\dash\notif::error(T_("You can not edit this domain setting"));
				return false;
			}
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

		if(isset($load_domain['name']) && \dash\validate::ir_domain($load_domain['name'], false))
		{
			// ok. No problem
		}
		else
		{
			\dash\notif::error(T_("Can not change international domain holder"));
			return false;
		}

		$condition =
		[
			'ns1'    => 'dns',
			'ns2'    => 'dns',
			'ns3'    => 'dns',
			'ns4'    => 'dns',

			'ip1'    => 'ip',
			'ip2'    => 'ip',
			'ip3'    => 'ip',
			'ip4'    => 'ip',

			'dnsid'  => 'string',
			'admin'  => 'irnic_id',
			'holder' => 'irnic_id',
			'tech'   => 'irnic_id',
			'bill'   => 'irnic_id',
			// 'reseller'   => 'irnic_id',
		];

		$require = [];

		$meta =
		[
			'field_title' =>
			[

			],
		];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$ns1   = $data['ns1'];
		$ip1   = $data['ip1'];

		$ns2   = $data['ns2'];
		$ip2   = $data['ip2'];

		$ns3   = $data['ns3'];
		$ip3   = $data['ip3'];

		$ns4   = $data['ns4'];
		$ip4   = $data['ip4'];


		$holder = $data['holder'];
		$admin  = $data['admin'];
		$tech   = $data['tech'];
		$bill   = $data['bill'];
		// $reseller   = $data['reseller'];

		\lib\app\domains\detect::domain('update', $load_domain['name']);
		\lib\app\domains\detect::dns($ns1);
		\lib\app\domains\detect::dns($ns2);
		\lib\app\domains\detect::dns($ns3);
		\lib\app\domains\detect::dns($ns4);


		$args                        = [];
		$update_domian_record        = [];
		$update_holder               = false;
		$update_holder_detail        = [];
		$update_holder_detail['old'] = [];
		$update_holder_detail['new'] = [];

		if($_type == 'dns')
		{
			if($load_domain['ns1'] != $ns1)
			{
				$args['old_ns1']     = $load_domain['ns1'];
				$args['new_ns1']     = $ns1;
				$update_domian_record['ns1'] = $ns1;
			}
			else
			{
				$update_domian_record['ns1'] = $load_domain['ns1'];
			}

			if($load_domain['ns2'] != $ns2)
			{
				$args['old_ns2']     = $load_domain['ns2'];
				$args['new_ns2']     = $ns2;
				$update_domian_record['ns2'] = $ns2;
			}
			else
			{
				$update_domian_record['ns2'] = $load_domain['ns2'];
			}

			if($load_domain['ns3'] != $ns3)
			{
				$args['old_ns3']     = $load_domain['ns3'];
				$args['new_ns3']     = $ns3;
				$update_domian_record['ns3'] = $ns3;
			}
			else
			{
				$update_domian_record['ns3'] = $load_domain['ns3'];
			}

			if($load_domain['ns4'] != $ns4)
			{
				$args['old_ns4']     = $load_domain['ns4'];
				$args['new_ns4']     = $ns4;
				$update_domian_record['ns4'] = $ns4;
			}
			else
			{
				$update_domian_record['ns4'] = $load_domain['ns4'];
			}




			if($load_domain['ip1'] != $ip1)
			{
				$args['old_ip1']     = $load_domain['ip1'];
				$args['new_ip1']     = $ip1;
				$update_domian_record['ip1'] = $ip1;
			}
			else
			{
				$update_domian_record['ip1'] = $load_domain['ip1'];
			}


			if($load_domain['ip2'] != $ip2)
			{
				$args['old_ip2']     = $load_domain['ip2'];
				$args['new_ip2']     = $ip2;
				$update_domian_record['ip2'] = $ip2;
			}
			else
			{
				$update_domian_record['ip2'] = $load_domain['ip2'];
			}


			if($load_domain['ip3'] != $ip3)
			{
				$args['old_ip3']     = $load_domain['ip3'];
				$args['new_ip3']     = $ip3;
				$update_domian_record['ip3'] = $ip3;
			}
			else
			{
				$update_domian_record['ip3'] = $load_domain['ip3'];
			}


			if($load_domain['ip4'] != $ip4)
			{
				$args['old_ip4']     = $load_domain['ip4'];
				$args['new_ip4']     = $ip4;
				$update_domian_record['ip4'] = $ip4;
			}
			else
			{
				$update_domian_record['ip4'] = $load_domain['ip4'];
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

			// if(array_key_exists('reseller', $load_domain) && $load_domain['reseller'] != $reseller)
			// {
			// 	$args['reseller']                        = $reseller;
			// 	$update_domian_record['reseller']        = $reseller;
			// 	$update_holder_detail['old']['reseller'] = $load_domain['reseller'];
			// 	$update_holder_detail['new']['reseller'] = $reseller;
			// 	$update_holder                       = true;
			// }
		}

		if(empty($args))
		{
			\dash\notif::info(T_("No change in domain"));
			return true;
		}

		$args['domain']  = $load_domain['name'];

		if($_only_update_database)
		{
			// not send record to nic
		}
		else
		{
			$update_domian = \lib\api\nic\exec\domain_update::update($args);
			if(!$update_domian)
			{
				\dash\notif::error(T_("Can not update your domain detail now!"));
				return false;
			}
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

			\lib\app\nic_domain\get::force_fetch($load_domain['name']);

			\dash\notif::ok(T_("Domain detail updated"));
			return true;
		}
		else
		{
			\dash\notif::wan(T_("No change in you domain detail"));
			return true;
		}

	}


	public static function remove_last_fetch($_id)
	{
		$_id = \dash\validate::code($_id);
		if(!$_id)
		{
			return false;
		}

		$_id = \dash\coding::decode($_id);

		$load_domain = \lib\app\nic_domain\get::only_by_id($_id);
		if(!$load_domain || !isset($load_domain['id']))
		{
			\dash\notif::error(T_("Domain not found"));
			return false;
		}

		\dash\session::set('lastDomainFetched', null);

		\lib\db\nic_domain\update::update(['lastfetch' => null], $load_domain['id']);

	}


	public static function edit($_args, $_id, $_admin_edit = false)
	{
		$_id = \dash\validate::code($_id);
		if(!$_id)
		{
			return false;
		}

		$_id = \dash\coding::decode($_id);

		if($_admin_edit === true)
		{
			$load_domain = \lib\app\nic_domain\get::only_by_id($_id);

			if(!$load_domain || !isset($load_domain['id']))
			{
				return false;
			}
		}
		else
		{
			$load_domain = \lib\app\nic_domain\get::by_id($_id);

			if(!$load_domain || !isset($load_domain['id']))
			{
				return false;
			}
		}


		$condition =
		[
			'autorenew' => 'bit3',
			'verify'    => 'bit',
			'status'    => ['enum' => ['awaiting','failed','pending','enable','disable','deleted','expire']],
		];

		$require = [];

		$meta =
		[
			'field_title' =>
			[

			],
		];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$args = \dash\cleanse::patch_mode($_args, $data);

		if(!empty($args))
		{
			\lib\db\nic_domain\update::update($args, $load_domain['id']);
		}

		if(array_key_exists('autorenew', $args))
		{
			$domain_action_detail =
			[
				'domain_id'      => $load_domain['id'],
			];

			if($args['autorenew'])
			{
				\lib\app\nic_domainaction\action::set('domain_enable_autorenew', $domain_action_detail);
			}
			else
			{
				\lib\app\nic_domainaction\action::set('domain_disable_autorenew', $domain_action_detail);
			}



		}

		if(isset($args['status']) && $args['status'] === 'deleted')
		{
			\dash\notif::ok(T_("Domain removed"));

		}
		else
		{
			\dash\notif::ok(T_("Detail updated"));
		}
		return true;

	}


	public static function edit_holder($_args, $_id, $_admin_edit = false)
	{
		$_id = \dash\validate::code($_id);
		if(!$_id)
		{
			return false;
		}

		$_id = \dash\coding::decode($_id);

		if($_admin_edit === true)
		{
			$load_domain = \lib\app\nic_domain\get::only_by_id($_id);

			if(!$load_domain || !isset($load_domain['id']))
			{
				return false;
			}
		}
		else
		{
			$load_domain = \lib\app\nic_domain\get::by_id($_id);

			if(!$load_domain || !isset($load_domain['id']))
			{
				return false;
			}
		}


		$condition =
		[
			'holder' => 'string_100',
			'admin'  => 'string_100',
			'tech'   => 'string_100',
			'bill'   => 'string_100',
			'reseller'   => 'string_100',

		];

		$require = [];

		$meta =
		[
			'field_title' =>
			[

			],
		];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$args = \dash\cleanse::patch_mode($_args, $data);

		if(!empty($args))
		{
			\lib\db\nic_domain\update::update($args, $load_domain['id']);
		}



		\dash\notif::ok(T_("Detail updated"));

		return true;

	}
}
?>