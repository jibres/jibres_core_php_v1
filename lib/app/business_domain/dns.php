<?php
namespace lib\app\business_domain;

class dns
{

	private static function meta($_data, $_data2 = [])
	{
		if(is_array($_data) || is_object($_data))
		{
			// if($_data2 && is_array($_data2))
			// {
			// 	$_data = array_merge($_data, $_data2);
			// }

			return json_encode($_data, JSON_UNESCAPED_UNICODE);
		}
		return null;
	}

	public static function check($_id)
	{
		$load = \lib\app\business_domain\get::get($_id);
		if(!$load || !isset($load['domain']))
		{
			return false;
		}

		$get_dns = \lib\app\business_domain\dns_broker::local_get($load['domain']);
		// $get_dns = \lib\app\business_domain\dns_broker::get($load['domain']);

		if(!$get_dns || !is_array($get_dns))
		{
			\dash\notif::error(T_("Can not get DNS detail!"));
			return false;
		}

		$dns = [];

		foreach ($get_dns as $key => $value)
		{
			if(isset($value['type']) && mb_strtolower($value['type']) === 'ns' && isset($value['target']))
			{
				$dns[] = $value['target'];
			}
		}

		\lib\app\business_domain\edit::set_date($_id, 'checkdns');
		\lib\app\business_domain\action::new_action($_id, 'dns_resolved', ['meta' => json_encode($dns)]);

		$arvan_ns1 = \lib\app\nic_usersetting\defaultval::ns1();
		$arvan_ns2 = \lib\app\nic_usersetting\defaultval::ns2();

		if(in_array($arvan_ns1, $dns) && in_array($arvan_ns2, $dns))
		{
			\lib\app\business_domain\edit::set_date($_id, 'dnsok');
			\lib\app\business_domain\action::new_action($_id, 'dns_ok', ['meta' => json_encode($dns), 'desc' => T_("DNS was set on our default DNS record")]);
		}


		\dash\notif::ok(T_("DNS detail saved"));
		return true;
	}


	public static function get_count($_id)
	{
		$id = \dash\validate::id($_id);
		if(!$id)
		{
			return false;
		}

		$count = \lib\db\business_domain\get::dns_count($id);

		return intval($count);
	}


	public static function ready($_data)
	{
		if(!is_array($_data))
		{
			return false;
		}

		$result = [];
		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				default:
					$result[$key] = $value;
					break;
			}
		}

		return $result;
	}


	public static function remove($_id, $_dns_id)
	{
		$dns_id = \dash\validate::id($_dns_id);
		if(!$dns_id)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}


		$id = \dash\validate::id($_id);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$load_dns_record = \lib\db\business_domain\get::dns_record($dns_id);
		if(isset($load_dns_record['id']))
		{
			if(isset($load_dns_record['business_domain_id']) && floatval($load_dns_record['business_domain_id']) === floatval($id) )
			{
				if(isset($load_dns_record['status']) && $load_dns_record['status'] === 'ok')
				{
					// must remove from cdn panel
					\dash\notif::error(__LINE__);
					\dash\notif::error('must remove from cdn panel');
					return false
				}

				$delete = \lib\db\business_domain\delete::dns_record($dns_id);
				\dash\notif::delete(T_("DNS record removed"));
				return true;

			}
			else
			{
				\dash\notif::error(T_("DNS record and domain is is not match!"));
				return false;
			}
		}
		else
		{
			\dash\notif::error(T_("DNS record not found"));
			return false;
		}
	}


	public static function list($_id)
	{
		$id = \dash\validate::id($_id);
		if(!$id)
		{
			return false;
		}

		$list = \lib\db\business_domain\get::dns_list($id);
		if(!is_array($list))
		{
			$list = [];
		}

		$list = array_map(['self', 'ready'], $list);

		return $list;
	}



	public static function add($_id, $_args)
	{
		$condition =
		[
			'type'             => ['enum' => ['A', 'AAAA','ALIAS','CNAME','MX','NS','PTR','SOA','SRV', 'TXT']],
			'key'              => 'string_100',
			'value'            => 'string_100',
			'addtocdnpaneldns' => 'bit',
		];

		$require = ['type', 'key', 'value'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$load = \lib\app\business_domain\get::get($_id);
		if(!$load || !isset($load['id']))
		{
			return false;
		}

		$check_duplicate =
		[
			'business_domain_id' => $load['id'],
			'type'               => $data['type'],
			'key'                => $data['key'],
			'value'              => $data['value'],
		];

		$check_duplicate = \lib\db\business_domain\get::dns_where_one($check_duplicate);
		if($check_duplicate)
		{
			\dash\notif::error(T_("Duplicate DNS record"));
			return false;
		}


		$insert =
		[
			'business_domain_id' => $load['id'],
			'type'               => $data['type'],
			'key'                => $data['key'],
			'value'              => $data['value'],
			'status'             => 'pending',
			'datecreated'        => date("Y-m-d H:i:s"),
		];

		$dns_id = \lib\db\business_domain\insert::new_record_dns($insert);

		if(!$dns_id)
		{
			\dash\log::oops('domainDnsNotAddDB');
			return false;
		}


		if($data['addtocdnpaneldns'])
		{
			self::add_dns_to_cdn_panel($_id, $dns_id);
		}


		\dash\notif::create(T_("DNS record saved"));
		return true;

	}


	public static function add_dns_to_cdn_panel($_id, $_dns_id)
	{
		$dns_id = \dash\validate::id($_dns_id);
		if(!$dns_id)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}


		$id = \dash\validate::id($_id);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$load_dns_record = \lib\db\business_domain\get::dns_record($dns_id);

		if(isset($load_dns_record['id']))
		{
			if(isset($load_dns_record['business_domain_id']) && floatval($load_dns_record['business_domain_id']) === floatval($id) )
			{
				$load = \lib\app\business_domain\get::get($_id);
				if(!$load || !isset($load['domain']))
				{
					return false;
				}

				$domain = $load['domain'];

				$add_dns =
				[
					"type"           =>  $load_dns_record['type'],
					"name"           =>  $load_dns_record['key'],
					"value"          =>  json_encode([["ip" => $load_dns_record['value'], /*"port" => null, "weight" => null , "country" => null*/]]),
					"ttl"            =>  120,
					"cloud"          =>  true,
					"upstream_https" =>  "default",
					"ip_filter_mode" => json_encode(["count"=>"single","order"=>"none","geo_filter" =>"none"]),
				];

				$result_add = \lib\arvancloud\api::add_dns_record($domain, $add_dns);

				if(array_key_exists('status', $result_add))
				{
					$meta = $result_add;
					$meta['args'] = ['type' => $add_dns['type'], 'name' => $add_dns['name'], 'value' => $load_dns_record['value']];

					if($result_add['status'])
					{
						\lib\app\business_domain\edit::dns_edit(['status' => 'ok', 'verify' => 1], $dns_id);
						\lib\app\business_domain\action::new_action($_id, 'arvancloud_dns_added', ['meta' => self::meta($meta)]);
					}
					else
					{

						\lib\app\business_domain\edit::dns_set_status($dns_id, 'failed');
						\lib\app\business_domain\action::new_action($_id, 'arvancloud_error_dns', ['meta' => self::meta($meta)]);
					}
				}
				else
				{
					\lib\app\business_domain\action::new_action($_id, 'arvancloud_error_dns', ['meta' => self::meta($result_add)]);
				}
			}
			else
			{
				\dash\notif::error(T_("DNS record and domain is is not match!"));
				return false;
			}
		}
		else
		{
			\dash\notif::error(T_("DNS record not found"));
			return false;
		}
	}


	public static function get_dns_from_cdn_panel($_id)
	{
		$get_dns_record = \lib\arvancloud\api::get_dns_record($domain);
			if(!$get_dns_record || !is_array($get_dns_record) || !isset($get_dns_record['data']) || (isset($get_dns_record['data']) && !is_array($get_dns_record['data'])))
			{
				\lib\db\store_domain\update::record(['status' => 'failed', 'message' => 'Can not connect get domain a record','cronjobstatus' => 'error_dns', 'datemodified' => date("Y-m-d H:i:s")], $store_domain_id);
				self::send_to_supervisor('Can not connect get domain dns record from arvan panel. domain: '. $domain);
				\dash\notif::error(T_("Can not get domain dns record from CDN panel"));
				return false;
			}
	}
}
?>