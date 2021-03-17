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

			return json_encode($_data);
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

		// $get_dns = \lib\app\business_domain\dns_broker::local_get($load['domain']);
		$get_dns = \lib\app\business_domain\dns_broker::get($load['domain']);


		if(!$get_dns || !is_array($get_dns))
		{
			\lib\app\business_domain\edit::set_date($_id, 'datemodified');
			\lib\app\business_domain\action::new_action($_id, 'dns_failed', ['meta' => json_encode($get_dns)]);

			if(isset($load['datecreated']) && $load['datecreated'] && (time() - strtotime($load['datecreated']) > (60*60*24*7)))
			{
				\lib\app\business_domain\action::new_action($_id, 'dns_failed_for_long_time', ['meta' => json_encode($get_dns)]);
				// \lib\app\business_domain\edit::edit_raw(['status' => 'dns_not_resolved'], $_id);
			}

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

		$jibres_ip = \dash\setting\dns_server::ip();


		$result = [];
		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'status':
					if($value === 'pending_delete')
					{
						$result['tstatus'] = T_("Pending Delete");
					}
					else
					{
						$result['tstatus'] = T_($value);
					}
					$result[$key] = $value;

					break;

				default:
					if(strpos($value, $jibres_ip) !== false)
					{
						$value = T_("Connected to Jibres CDN");
					}
					$result[$key] = $value;
					break;
			}
		}

		$result['allow_remove'] = true;
		if(isset($result['key']) && isset($result['type']))
		{
			if(
				($result['key'] === '@' && $result['type'] === 'NS') ||
				($result['key'] === '*' && $result['type'] === 'A') ||
				($result['key'] === '@' && $result['type'] === 'A')
			  )
			{
				$result['allow_remove'] = false;
			}


		}

		$result['servertitle'] = null;
		$result['serverkey']   = null;

		$server_list = \dash\setting\servername::dns_provider();

		if(is_array($server_list))
		{
			if(isset($_data['key']) && isset($_data['value']))
			{
				foreach ($server_list as $server_ip => $server_detail)
				{
					if($server_ip == $_data['value'])
					{
						$result['servertitle'] = a($server_detail, 'title');
						$result['serverkey'] = a($server_detail, 'code');
					}
				}
			}
		}

		return $result;
	}


	public static function remove_by_user($_id, $_dns_id)
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

		$load = \lib\app\business_domain\get::get($_id);
		if(!$load || !isset($load['domain']))
		{
			return false;
		}

		$domain = $load['domain'];

		$load_dns_record = \lib\db\business_domain\get::dns_record($dns_id);

		$ready = self::ready($load_dns_record);

		if(isset($ready['allow_remove']) && $ready['allow_remove'])
		{
			/* no problem to remove*/
		}
		else
		{
			\dash\notif::error(T_("Can not remove this dns recrod from your domain"));
			return false;
		}

		if(isset($load_dns_record['id']))
		{
			if(isset($load_dns_record['business_domain_id']) && floatval($load_dns_record['business_domain_id']) === floatval($id) )
			{
				$delete = \lib\db\business_domain\delete::dns_record_by_user($dns_id);
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

		$load = \lib\app\business_domain\get::get($_id);
		if(!$load || !isset($load['domain']))
		{
			return false;
		}

		$domain = $load['domain'];


		$load_dns_record = \lib\db\business_domain\get::dns_record($dns_id);
		if(isset($load_dns_record['id']))
		{
			if(isset($load_dns_record['business_domain_id']) && floatval($load_dns_record['business_domain_id']) === floatval($id) )
			{
				if(isset($load_dns_record['status']) && ($load_dns_record['status'] === 'ok' || $load_dns_record['status'] === 'pending_delete'))
				{
					$current_list = self::get_dns_from_cdn_panel($_id);
					$find = false;
					$cdn_id = null;
					foreach ($current_list as $key => $value)
					{
						if(\dash\validate::is_equal($value['type'], $load_dns_record['type']) && \dash\validate::is_equal($value['key'], $load_dns_record['key']) && \dash\validate::is_equal($value['value'], $load_dns_record['value']))
						{
							$find = true;
							$cdn_id = $value['id'];
							break;
						}
					}

					if(!$cdn_id)
					{
						\dash\notif::warn(T_("We can not find this record on CDN panel"));
					}

					$result_remove = \lib\arvancloud\api::remove_dns_record($domain, $cdn_id);
					\lib\app\business_domain\action::new_action($_id, 'arvancloud_dns_remove', ['meta' => self::meta($result_remove)]);

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
			'type'             => ['enum' => ['A', 'AAAA', 'ANAME', 'CNAME','MX','NS','PTR',/*'SOA','SRV',*/ 'TXT']],
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


		$count_store_domain_dns = \lib\db\business_domain\get::count_domain_dns($load['id']);

		if($count_store_domain_dns > 50)
		{
			\dash\log::oops('maximumCapacityAddDomainDNS', T_("Your business domain dns capacity is full!"));
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

				$value = [];
				switch ($load_dns_record['type'])
				{
					case 'TXT':
						$value = ['text' => $load_dns_record['value']];
						break;

					case 'CNAME':
						$value = ['host' => $load_dns_record['value'], "host_header" =>  "source"];
						break;

					case 'NS':
						$value = ['host' => $load_dns_record['value']];
						break;

					case 'PTR':
						$value = ['domain' => $load_dns_record['value']];
						break;

					case 'MX':
						$value = ['host' => $load_dns_record['value'], "priority" =>  1]; // get static value from user
						break;

					case 'SRV':
						$value = ['target' => $load_dns_record['value'], "port" => 80, "weight" => 1]; // get static value from user
						break;

					case 'ANAME':
						$value = ['location' => $load_dns_record['value'], "host_header" =>  "source"];
						break;

					case 'A':
					default:
						$value = [["ip" => $load_dns_record['value'], /*"port" => null, "weight" => null , "country" => null*/]];
						break;
				}

				$value = json_encode($value);

				$add_dns =
				[
					"type"           =>  $load_dns_record['type'],
					"name"           =>  $load_dns_record['key'],
					"value"          =>  $value,
					"ttl"            =>  120,
					"cloud"          =>  true,
					"upstream_https" =>  "default",
					"ip_filter_mode" => json_encode(["count"=>"single","order"=>"none","geo_filter" =>"none"]),
				];

				$result_add = \lib\arvancloud\api::add_dns_record($domain, $add_dns);

				$meta = $result_add;

				if(isset($result_add['data']['id']))
				{
					$meta['args'] = ['type' => $add_dns['type'], 'name' => $add_dns['name'], 'value' => $load_dns_record['value']];
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
		$load = \lib\app\business_domain\get::get($_id);
		if(!$load || !isset($load['domain']))
		{
			return false;
		}

		$domain = $load['domain'];

		$get_dns_record = \lib\arvancloud\api::get_dns_record($domain);

		if(!is_array($get_dns_record))
		{
			$get_dns_record = [];
		}

		if(array_key_exists('status', $get_dns_record) && $get_dns_record['status'] === false)
		{
			\lib\app\business_domain\action::new_action($_id, 'arvancloud_fetch_dns_error', ['meta' => self::meta($get_dns_record)]);
			\dash\notif::warn(T_("Can not get DNS record from CDN panel"));
			return [];
		}

		if(!isset($get_dns_record['data']))
		{
			\lib\app\business_domain\action::new_action($_id, 'arvancloud_fetch_dns_error', ['meta' => self::meta($get_dns_record)]);
			\dash\notif::error(T_("Can not connect to CDN panel"));
			return false;
		}

		$cdn_panel_list = $get_dns_record['data'];
		if(!is_array($cdn_panel_list))
		{
			$cdn_panel_list = [];
		}

		$current_list = [];

		foreach ($cdn_panel_list as $key => $value)
		{
			if(isset($value['type']) && isset($value['name']) && isset($value['value']) && isset($value['id']))
			{
				$temp =
				[
					'id'   => $value['id'],
					'type' => mb_strtoupper($value['type']),
					'key'  => $value['name'],

				];

				$this_value = null;
				switch ($temp['type'])
				{
					case 'TXT':
						$this_value = isset($value['value']['text']) ? $value['value']['text'] : null;
						break;

					case 'CNAME':
						$this_value = isset($value['value']['host']) ? $value['value']['host'] : null;
						break;

					case 'NS':
						$this_value = isset($value['value']['host']) ? $value['value']['host'] : null;
						break;

					case 'PTR':
						$this_value = isset($value['value']['domain']) ? $value['value']['domain'] : null;
						break;

					case 'MX':
						$this_value = isset($value['value']['host']) ? $value['value']['host'] : null;
						break;

					case 'SRV':
						$this_value = isset($value['value']['target']) ? $value['value']['target'] : null;
						break;

					case 'ANAME':
						$this_value = isset($value['value']['location']) ? $value['value']['location'] : null;
						break;

					case 'A':
					default:
						$this_value = isset($value['value'][0]['ip']) ? $value['value'][0]['ip'] : null;
						break;
				}

				$temp['value'] = $this_value;

				$current_list[] = $temp;
			}
		}

		return $current_list;
	}


	public static function changeserver($_id, $_new_server)
	{
		var_dump(func_get_args());exit();
	}


	public static function jibres_dns($_id)
	{
		$jibres_ip = \dash\setting\dns_server::ip();

		self::add($_id, ['addtocdnpaneldns' => true, 'type' => 'A', 'key' => '@', 'value' => $jibres_ip]);
		self::add($_id, ['addtocdnpaneldns' => true, 'type' => 'A', 'key' => '*', 'value' => $jibres_ip]);

		self::add($_id, ['addtocdnpaneldns' => true, 'type' => 'TXT', 'key' => '@', 'value' => 'v=spf1 mx include:spf.jibres.ir ~all']);
		self::add($_id, ['addtocdnpaneldns' => true, 'type' => 'TXT', 'key' => '_dmarc', 'value' => 'v=DMARC1; p=reject; pct=100; rua=mailto:dmarc@jibres.ir']);
		self::add($_id, ['addtocdnpaneldns' => true, 'type' => 'TXT', 'key' => 'default._bimi', 'value' => 'v=BIMI1; l=https://cdn.talambar.ir/logo/icon/svg/Jibres-Logo-icon.svg;']);

		if(!\dash\engine\process::status())
		{
			return false;
		}

		\dash\notif::clean();

		\dash\notif::ok(T_("Jibres DNS record added"));

		return true;
	}


	public static function check_if_not_exist_add($_id)
	{
		$local_list = \lib\db\business_domain\get::dns_list($_id);
		if(!is_array($local_list))
		{
			$local_list = [];
		}


		$jibres_ip = \dash\setting\dns_server::ip();


		$count_founded = 0;
		foreach ($local_list as $key => $value)
		{
			if(isset($value['type']) && isset($value['key']) && isset($value['value']) && isset($value['status']) && $value['status'] === 'ok')
			{
				if($value['type'] === 'A' && in_array($value['key'], ['*', '@']) && strpos($value['value'], $jibres_ip) !== false)
				{
					$count_founded++;
				}
			}
		}

		if($count_founded >= 2)
		{
			return true;
		}

		self::fetch($_id);

		$local_list = \lib\db\business_domain\get::dns_list($_id);
		if(!is_array($local_list))
		{
			$local_list = [];
		}

		$jibres_ip = \dash\setting\dns_server::ip();


		$count_founded = 0;
		foreach ($local_list as $key => $value)
		{
			if(isset($value['type']) && isset($value['key']) && isset($value['value']) && isset($value['status']) && $value['status'] === 'ok')
			{
				if($value['type'] === 'A' && in_array($value['key'], ['*', '@']) && strpos($value['value'], $jibres_ip) !== false)
				{
					$count_founded++;
				}
			}
		}

		if($count_founded >= 2)
		{
			return true;
		}

		self::jibres_dns($_id);

	}


	public static function fetch($_id)
	{
		$current_list = self::get_dns_from_cdn_panel($_id);

		if(!\dash\engine\process::status())
		{
			return false;
		}

		$multi_insert = [];
		foreach ($current_list as $key => $value)
		{
			$multi_insert[] =
			[
				'business_domain_id' => $_id,
				'type'               => $value['type'],
				'key'                => $value['key'],
				'value'              => $value['value'],
				'datecreated'        => date("Y-m-d H:i:s"),
				'status'             => 'ok',
				'verify'             => 0,
			];
		}


		$local_list = \lib\db\business_domain\get::dns_list($_id);
		if(!is_array($local_list))
		{
			$local_list = [];
		}


		if($local_list)
		{
			\lib\db\business_domain\delete::all_domain_dns($_id);
		}

		if(!empty($multi_insert))
		{
			\lib\db\business_domain\insert::multi_dns($multi_insert);
		}

		\lib\app\business_domain\action::new_action($_id, 'arvancloud_fetch_dns_ok', ['meta' => self::meta($current_list)]);

		\dash\notif::ok(T_("Fetch DNS successfully"));

		return true;
	}
}
?>