<?php
namespace lib\app\onlinenic;


class edit
{
	public static function dns($_args, $_domain, $_id)
	{
		$_id = \dash\validate::code($_id);
		if(!$_id)
		{
			return false;
		}

		$_id = \dash\coding::decode($_id);

		$load_domain = \lib\app\nic_domain\get::by_id($_id);
		if(!$load_domain || !isset($load_domain['id']))
		{
			return false;
		}

		if(empty($_args))
		{
			\dash\notif::info(T_("No change in domain"));
			return true;
		}

		if(\lib\app\nic_domain\ready::is_verify($load_domain))
		{
			// no problem
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
		];

		$require = ['ns1', 'ns2'];

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


		\lib\app\domains\detect::domain('update', $load_domain['name']);
		\lib\app\domains\detect::dns($ns1);
		\lib\app\domains\detect::dns($ns2);
		\lib\app\domains\detect::dns($ns3);
		\lib\app\domains\detect::dns($ns4);


		unset($data['ip1']);
		unset($data['ip2']);
		unset($data['ip3']);
		unset($data['ip4']);

		$update_domian_record = [];
		$old                  = [];
		$new                  = [];
		$have_update          = false;

		if($load_domain['ns1'] != $ns1)
		{
			$update_domian_record['ns1'] = $ns1;
			$have_update                 = true;

			$old['ns1']                  = $load_domain['ns1'];
			$new['ns1']                  = $ns1;
		}
		else
		{
			$update_domian_record['ns1'] = $load_domain['ns1'];
			$old['ns1']                  = $load_domain['ns1'];
		}

		if($load_domain['ns2'] != $ns2)
		{
			$update_domian_record['ns2'] = $ns2;
			$have_update                 = true;
			$old['ns2']                  = $load_domain['ns2'];
			$new['ns2']                  = $ns2;
		}
		else
		{
			$update_domian_record['ns2'] = $load_domain['ns2'];
			$old['ns2']                  = $load_domain['ns2'];
		}

		if($load_domain['ns3'] != $ns3)
		{
			$update_domian_record['ns3'] = $ns3;
			$have_update                 = true;
			$old['ns3']                  = $load_domain['ns3'];
			$new['ns3']                  = $ns3;
		}
		else
		{
			$update_domian_record['ns3'] = $load_domain['ns3'];
			$old['ns3']                  = $load_domain['ns3'];
		}


		if($load_domain['ns4'] != $ns4)
		{
			$update_domian_record['ns4'] = $ns4;
			$have_update                 = true;
			$old['ns4']                  = $load_domain['ns4'];
			$new['ns4']                  = $ns4;
		}
		else
		{
			$update_domian_record['ns4'] = $load_domain['ns4'];
			$old['ns4']                  = $load_domain['ns4'];
		}



		if(!$have_update)
		{
			\dash\notif::info(T_("No change in DNS"));
			return true;
		}

		$ready =
		[
			'domain' => $load_domain['name'],
			'dns1'   => $update_domian_record['ns1'],
			'dns2'   => $update_domian_record['ns2'],
		];

		if(isset($update_domian_record['ns3']))
		{
			$ready['dns3'] = $update_domian_record['ns3'];
		}

		if(isset($update_domian_record['ns4']))
		{
			$ready['dns4'] = $update_domian_record['ns4'];
		}

		if($have_update)
		{
			$result = \lib\onlinenic\api::update_domain_dns($ready);

			if(isset($result['code']) && $result['code'] == 1000)
			{

				$update_dns_detail        = [];
				$update_dns_detail['old'] = $old;
				$update_dns_detail['new'] = $new;

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


				\lib\db\nic_domain\update::update($update_domian_record, $_id);
				\dash\notif::ok(T_("Domain detail updated"));
				return true;

			}
			else
			{
				\dash\notif::error(T_("Can not update DNS record at this time"));
				return false;
			}
		}

	}







	public static function domain($_args, $_id, $_type = null)
	{


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


		if(!empty($update_domian_record))
		{


		}
		else
		{
			\dash\notif::wan(T_("No change in you domain detail"));
			return true;
		}

	}

}
?>