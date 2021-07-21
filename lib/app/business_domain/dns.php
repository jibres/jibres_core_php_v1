<?php
namespace lib\app\business_domain;

class dns
{
	public static function check_remove($_domain, $_detail = [])
	{

		$_domain = \dash\validate::string_200($_domain, false);
		if($_domain)
		{
			$get     = \lib\db\business_domain\get::check_is_customer_domain($_domain);

			if(isset($get['id']) && isset($get['status']) && $get['status'] !== 'pending_delete' && $get['status'] !== 'deleted')
			{
				\lib\app\business_domain\remove::force_remove($get['id']);

				$log                           = [];
				$log['ns1']                    = a($_detail, 'ns1');
				$log['ns2']                    = a($_detail, 'ns2');
				$log['jibres_dns']             = a($_detail, 'jibres_dns');
				$log['business_domain_status'] = a($get, 'status');

				\dash\log::to_supervisor('#Remove_domain_from_cdn Domain <b>'. $_domain .'</b> removed from ArvanCloud CDN panel. <br> ``` '. json_encode($log, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT). '```');

			}
		}
	}

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

		$get_dns = self::search_in_our_domain_record($load['domain']);

		if(!$get_dns)
		{
			$get_dns = self::get_from_php_dns_function($load['domain']);

			if(!$get_dns)
			{
				$get_dns = self::get_from_whois($load['domain']);

				if(!$get_dns)
				{
					// not found
				}
			}
		}

		if(!$get_dns)
		{

			\lib\app\business_domain\edit::set_date($_id, 'datemodified');
			\lib\app\business_domain\action::new_action($_id, 'dns_failed', ['meta' => json_encode($get_dns)]);
			\dash\notif::error(T_("Can not get DNS detail!"));
			return false;
		}

		\lib\app\business_domain\edit::set_date($_id, 'checkdns');
		\lib\app\business_domain\action::new_action($_id, 'dns_resolved', ['meta' => json_encode($get_dns)]);

		$arvan_ns1 = \lib\app\nic_usersetting\defaultval::ns1();
		$arvan_ns2 = \lib\app\nic_usersetting\defaultval::ns2();

		if(in_array($arvan_ns1, $get_dns) && in_array($arvan_ns2, $get_dns))
		{
			\lib\app\business_domain\edit::set_date($_id, 'dnsok');
			\lib\app\business_domain\action::new_action($_id, 'dns_ok', ['meta' => json_encode($get_dns), 'desc' => T_("DNS was set on our default DNS record")]);
		}


		\dash\notif::ok(T_("DNS detail saved"));
		return true;
	}


	private static function search_in_our_domain_record($_domain)
	{
		$load_record = \lib\db\nic_domain\get::search_in_our_domain_record($_domain);

		if(!$load_record || !is_array($load_record))
		{
			return false;
		}

		$dns = [];

		if(count($load_record) === 1)
		{
			if(isset($load_record[0]['ns1']))
			{
				$dns[] = $load_record[0]['ns1'];
			}

			if(isset($load_record[0]['ns2']))
			{
				$dns[] = $load_record[0]['ns2'];
			}

		}
		else
		{
			// need to foreach
		}

		return $dns;
	}


	private static function get_from_php_dns_function($_domain)
	{
		// $get_dns = \lib\app\business_domain\dns_broker::local_get($load['domain']);
		$get_dns = \lib\app\business_domain\dns_broker::get($_domain);


		if(!$get_dns || !is_array($get_dns))
		{
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

		return $dns;
	}


	private static function get_from_whois($_domain)
	{
		$whois = \lib\app\whois\who::is($_domain);

		$dns = [];

		if(isset($whois['name_servers']['ns1']))
		{
			$dns[] = $whois['name_servers']['ns1'];
		}

		if(isset($whois['name_servers']['ns2']))
		{
			$dns[] = $whois['name_servers']['ns2'];
		}

		return $dns;

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
					else
					{
						$server_list = \dash\setting\servername::dns_provider();
						foreach ($server_list as $server_ip => $server_detail)
						{
							if(strpos($value, $server_ip) !== false)
							{
								$value = T_("Connected to Jibres CDN");
							}
						}
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
				($result['key'] === 'www' && $result['type'] === 'CNAME') ||
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
			if(!\dash\temp::get('force_remove_dns_change_provider'))
			{
				\dash\notif::error(T_("Can not remove this dns recrod from your domain"));
				return false;
			}
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


	/**
	 * User try to add any dns record
	 *
	 * @param      <type>  $_id    The identifier
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function add_by_user($_id, $_args)
	{
		return self::add($_id, $_args, true);
	}



	public static function add($_id, $_args, $_add_by_user = false)
	{
		$condition =
		[
			'type'             => ['enum' => ['A', 'AAAA', 'ANAME', 'CNAME','MX','NS','PTR',/*'SOA','SRV',*/ 'TXT']],
			'key'              => 'string_100',
			'value'            => 'string_100',
			'priority'         => 'int',
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

		if($_add_by_user)
		{
			if($data['key'] === '*')
			{
				\dash\notif::error(T_("Can not add * in dns record"));
				return false;
			}

			if($data['key'] === 'www' || $data['key'] === '@')
			{
				if(in_array($data['type'], ['A', 'AAAA', 'ANAME', 'CNAME', 'NS']))
				{
					\dash\notif::error(T_("Can not add @ in dns record"));
					return false;
				}
			}
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
			'priority'           => $data['priority'],
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
						$priority = 1;
						if(isset($load_dns_record['priority']) && $load_dns_record['priority'])
						{
							$priority = $load_dns_record['priority'];
						}

						$value = ['host' => $load_dns_record['value'], "priority" =>  $priority]; // get static value from user
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


	public static function force_update_all_dns()
	{
		$list = \lib\db\business_domain\get::dns_by_value_100();

		if(!$list || !is_array($list))
		{
			\dash\notif::error(T_("No DNS record found by this ip"));
			return false;
		}

		$start_time = time();

		$i = 0;

		foreach ($list as $key => $value)
		{
			$i++;
			$domain = a($value, 'domain');

			if(!$domain)
			{
				continue;
			}


			self::fetch(a($value, 'id'));


			\dash\engine\process::continue();

			// if($domain !== 'chelchin.ir')
			// {
			// 	continue;
			// }


			// // start update dns record
			// $get_list_dns_record = \lib\arvancloud\api::get_dns_record($domain);

			// if(!is_array($get_list_dns_record) || !isset($get_list_dns_record['data']))
			// {
			// 	continue;
			// }


			// foreach ($get_list_dns_record['data'] as $dns_detail)
			// {
			// 	if(isset($dns_detail['type']) && strtolower($dns_detail['type']) === 'a' && isset($dns_detail['name']) && strtolower($dns_detail['name']) === '*')
			// 	{
			// 		$id = a($dns_detail, 'id');

			// 		$result_remove = \lib\arvancloud\api::remove_dns_record($value['domain'], $id);

			// 		\lib\db\business_domain\delete::dns_record($value['id']);

			// 		self::add(a($value, 'business_domain_id'), ['addtocdnpaneldns' => true, 'type' => 'CNAME', 'key' => 'www', 'value' => $value['domain']]);

			// 		// if(isset($dns_detail['value']))
			// 		// {

			// 		// 	$temp = [["ip" => $_new_ip, /*"port" => null, "weight" => null , "country" => null*/]];

			// 		// 	$temp = json_encode($temp);

			// 		// 	$update_dns =
			// 		// 	[
			// 		// 		"type"           =>  $dns_detail['type'],
			// 		// 		"name"           =>  $dns_detail['name'],
			// 		// 		"value"          =>  $temp,
			// 		// 		"ttl"            =>  120,
			// 		// 		"cloud"          =>  true,
			// 		// 		"upstream_https" =>  "default",
			// 		// 		"ip_filter_mode" => json_encode(["count"=>"single","order"=>"none","geo_filter" =>"none"]),
			// 		// 	];

			// 		// 	$put_dns = \lib\arvancloud\api::update_dns_record($domain, $update_dns, $dns_detail['id']);
			// 		// 	if($put_dns)
			// 		// 	{
			// 		// 		\lib\db\business_domain\update::update_dns(['value' => $_new_ip], $value['id']);
			// 		// 	}
			// 		// }

			// 	}
			// }

			// end update dns record

			if(time() - $start_time > 59)
			{
				// \dash\notif::info("Timeout. Update count :". $i);
				// return true;
			}
		}

		\dash\notif::ok("Operation complete successfull");
		return true;

	}



	public static function changeserver($_id, $_new_server)
	{

		$dnsList = \lib\app\business_domain\dns::list($_id);


		$server_key = array_column($dnsList, 'serverkey');
		$server_key = array_filter($server_key);
		$server_key = array_unique($server_key);
		$server_key = array_values($server_key);

		if(count($server_key) === 1 && isset($server_key[0]))
		{
			if($server_key[0] == $_new_server)
			{
				\dash\notif::info(T_("No change in dns provider"));
				return false;
			}
		}
		else
		{
			\dash\notif::error(T_("Current dns provider not found"));
			return false;
		}

		$server_list = \dash\setting\servername::dns_provider();
		foreach ($server_list as $server_ip => $server_detail)
		{
			if(isset($server_detail['code']) && $server_detail['code'] === $_new_server)
			{

				\dash\temp::set('force_remove_dns_change_provider', true);

				foreach ($dnsList as $key => $value)
				{
					if(isset($value['type']) && $value['type'] === 'A' && isset($value['key']) && in_array($value['key'], ['@', '*']))
					{
						self::remove_by_user($_id, $value['id']);
					}
				}

				self::add($_id, ['type' => 'A', 'key' => '@', 'value' => $server_ip]);
				// self::add($_id, ['type' => 'CNAME', 'key' => 'www', 'value' => '@']);

				if(\dash\engine\process::status())
				{
					\dash\notif::ok(T_("DNS provider changed"));
				}

				return;
			}
		}

		\dash\notif::error(T_("Invalid dns provider server key!"));

		return false;
	}


	public static function jibres_dns($_id)
	{
		$jibres_ip = \dash\setting\dns_server::ip();

		self::add($_id, ['addtocdnpaneldns' => true, 'type' => 'A', 'key' => '@', 'value' => $jibres_ip]);

		$load = \lib\app\business_domain\get::get($_id);
		if(isset($load['domain']))
		{
			self::add($_id, ['addtocdnpaneldns' => true, 'type' => 'CNAME', 'key' => 'www', 'value' => $load['domain']]);
		}


		// self::add($_id, ['addtocdnpaneldns' => true, 'type' => 'TXT', 'key' => '@', 'value' => 'v=spf1 mx include:spf.jibres.ir ~all']);
		// self::add($_id, ['addtocdnpaneldns' => true, 'type' => 'TXT', 'key' => '_dmarc', 'value' => 'v=DMARC1; p=reject; pct=100; rua=mailto:dmarc@jibres.ir']);
		// self::add($_id, ['addtocdnpaneldns' => true, 'type' => 'TXT', 'key' => 'default._bimi', 'value' => 'v=BIMI1; l=https://cdn.jibres.ir/logo/icon/svg/Jibres-Logo-icon.svg;']);

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
				if(
					($value['type'] === 'A' && in_array($value['key'], ['@']) && strpos($value['value'], $jibres_ip) !== false) ||
					($value['type'] === 'CNAME' && in_array($value['key'], ['www']))
				  )
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
				if(
					($value['type'] === 'A' && in_array($value['key'], ['@']) && strpos($value['value'], $jibres_ip) !== false) ||
					($value['type'] === 'CNAME' && in_array($value['key'], ['www']))
				  )
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