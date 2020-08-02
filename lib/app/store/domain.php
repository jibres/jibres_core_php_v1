<?php
namespace lib\app\store;


class domain
{
	public static function set_master($_args)
	{
		$condition =
		[
			'domain' => 'domain',
		];

		$require = ['domain'];

		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$domain_list = \lib\db\setting\get::by_cat_key_all('store_setting', 'domain');

		$id = null;
		foreach ($domain_list as $key => $value)
		{
			if(isset($value['value']) && $value['value'] === $data['domain'])
			{
				$id = $value['id'];
				break;
			}
		}

		if($id)
		{
			$load_setting_record = \lib\db\setting\get::by_id($id);

			if(isset($load_setting_record['value']) && $load_setting_record['value'] === $data['domain'])
			{
				// no problem
			}
			else
			{
				\dash\notif::error(T_("This domain not found in your domain list!"));
				return false;
			}
		}
		else
		{
			\dash\notif::error(T_("This domain not found in your domain list!"));
			return false;
		}

		\lib\app\setting\tools::update('store_setting', 'domain_master', $data['domain']);
		\lib\db\store_domain\update::change_master(\lib\store::id(), $data['domain']);

		\lib\store::reset_catch();

		\dash\notif::ok(T_("Primary domain saved"));
		return true;
	}


	public static function remove($_args)
	{
		$condition =
		[
			'domain' => 'domain',
		];

		$require = ['domain'];

		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$domain_list = \lib\db\setting\get::by_cat_key_all('store_setting', 'domain');

		$id = null;
		foreach ($domain_list as $key => $value)
		{
			if(isset($value['value']) && $value['value'] === $data['domain'])
			{
				$id = $value['id'];
				break;
			}
		}

		if($id)
		{
			$load_setting_record = \lib\db\setting\get::by_id($id);

			if(isset($load_setting_record['value']) && $load_setting_record['value'] === $data['domain'])
			{
				// no problem
			}
			else
			{
				\dash\notif::error(T_("This domain not found in your domain list!"));
				return false;
			}
		}
		else
		{
			\dash\notif::error(T_("This domain not found in your domain list!"));
			return false;
		}

		$check_duplicate_domain = \lib\db\store_domain\get::check_duplicate($data['domain']);

		if(!isset($check_duplicate_domain['id']))
		{
			// BUG!!!
			// nothing
			// needless to delete record
		}
		else
		{
			if(isset($check_duplicate_domain['store_id']) && $check_duplicate_domain['store_id'] && floatval($check_duplicate_domain['store_id']) === floatval(\lib\store::id()))
			{
				$is_master = false;
				if(isset($check_duplicate_domain['master']) && $check_duplicate_domain['master'])
				{
					// try to remove the master. we need to set master on other domain if exists
					$is_master = true;
				}
				// delete record
				\lib\db\store_domain\delete::record($check_duplicate_domain['id']);

				// remove catch file
				$customer_domain_addr = \dash\engine\store::customer_domain_addr();
				$customer_domain_addr .= $data['domain'];
				if(is_file($customer_domain_addr))
				{
					\dash\file::delete($customer_domain_addr);
				}

				if($is_master)
				{
					$load_all_store_domain = \lib\db\store_domain\get::by_store_id(\lib\store::id());

					if(isset($load_all_store_domain[0]['domain']))
					{
						self::set_master(['domain' =>$load_all_store_domain[0]['domain']]);
					}
					else
					{
						\lib\db\setting\delete::by_cat_key('store_setting', 'domain_master');
					}
				}
			}
			else
			{
				// bug
				\dash\log::oops('db');
				return false;
			}
		}

		\lib\db\setting\delete::record($id);

		$domain_addr = \dash\engine\store::customer_domain_addr();

		if(is_file($domain_addr. $data['domain']))
		{
			\dash\file::delete($domain_addr. $data['domain']);
		}

		\lib\store::clean();

		// to make ajax for remove domain
		\dash\session::set('businessRemoveDomain', $data['domain']);

		\lib\store::reset_catch();

		\dash\notif::ok(T_("Domain disconnected"));
		return true;

	}


	public static function set($_args)
	{
		$condition =
		[
			'domain' => 'domain',
		];

		$require = ['domain'];

		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		// have error in domain file
		if(!\dash\engine\process::status())
		{
			return false;
		}

		$domain    = $data['domain'];
		$subdomain = null;
		$root      = null;
		$tld       = null;

		$my_domain = $data['domain'];
		$my_domain = explode('.', $my_domain);
		// remove empty character for example reza.
		$my_domain = array_filter($my_domain);

		if(count($my_domain) >= 4)
		{
			$subdomain = $my_domain[0];

			array_shift($my_domain);
			reset($my_domain);

			$root      = $my_domain[0];

			array_shift($my_domain);
			reset($my_domain);

			$tld       = implode('.', $my_domain);
		}
		elseif(count($my_domain) === 3)
		{
			$subdomain = $my_domain[0];
			$root      = $my_domain[1];
			$tld       = $my_domain[2];
		}
		elseif(count($my_domain) === 2)
		{
			$root      = $my_domain[0];
			$tld       = $my_domain[1];
		}
		else
		{
			\dash\notif::error(T_("Domain is not valid"), 'domain');
			return false;
		}

		$check_duplicate_domain = \lib\db\store_domain\get::check_duplicate($domain);

		if(!isset($check_duplicate_domain['id']))
		{
			// nothing
			// no duplicate domain
		}
		else
		{
			if(isset($check_duplicate_domain['store_id']) && $check_duplicate_domain['store_id'] && floatval($check_duplicate_domain['store_id']) === floatval(\lib\store::id()))
			{
				// needless to update domain
				// exactly this domain exists for this store
				\dash\notif::info(T_("This domain was added to your business"));
				return null;
			}
			else
			{
				\dash\notif::error(T_("This domain is reserved. Can not choose it"));
				return false;
			}
		}

		$domain_list = \lib\db\setting\get::by_cat_key_all('store_setting', 'domain');
		if(is_array($domain_list) && count($domain_list) >= 10)
		{
			\dash\notif::error(T_("You have used the maximum capacity of connection to the store. Can not connect new domain!"), 'domain');
			return false;
		}

		$master = null;
		$load_all_store_domain = \lib\db\store_domain\get::by_store_id(\lib\store::id());
		if(!$load_all_store_domain)
		{
			$master = 1;
		}
		else
		{
			if(is_array($load_all_store_domain))
			{
				$master = 1;
				foreach ($load_all_store_domain as $key => $value)
				{
					if(isset($value['master']) && $value['master'])
					{
						$master = null;
					}
				}
			}
		}

		$insert =
		[
			'store_id'    => \lib\store::id(),
			'user_id'     => \dash\user::jibres_user(),
			'domain'      => $domain,
			'subdomain'   => $subdomain,
			'root'        => $root,
			'tld'         => $tld,
			'master'      => $master,
			'datecreated' => date("Y-m-d H:i:s"),
		];

		$insert_domain = \lib\db\store_domain\insert::new_record($insert);
		if(!$insert_domain)
		{
			\dash\log::oops('db');
			return false;
		}

		$insert_setting_args =
		[
			'platform' => null,
			'cat'      => 'store_setting',
			'key'      => 'domain',
			'value'    => $domain,
		];

		$insert_setting = \lib\db\setting\insert::new_record($insert_setting_args);

		if(!$insert_domain)
		{
			\dash\log::oops('db');
			return false;
		}

		if($master)
		{
			\lib\app\setting\tools::update('store_setting', 'domain_master', $domain);
		}

		\lib\store::clean();

		// set ajax
		\dash\session::set('businessNewDomain', $domain);

		\lib\store::reset_catch();

		\dash\notif::ok(T_("Your domain connected to your store"));
		return true;

	}



	public static function get_domain_list()
	{
		// $domain_list = \lib\db\setting\get::by_cat_key_all('store_setting', 'domain');
		$domain_list = \lib\db\store_domain\get::by_store_id(\lib\store::id());
		$domain_list = array_map(['self', 'ready'], $domain_list);
		return $domain_list;
	}


	public static function ready($_data)
	{
		if(!is_array($_data))
		{
			$_data = [];
		}

		$result = [];

		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'id':
					$result[$key] = \dash\coding::encode($value);
					break;

				case 'value':
					$result['domain'] = $value;
					break;

				case 'message':
					switch ($value)
					{
						case 'Can not get dns record':
							$result[$key] = T_("We can not get your domain DNS record");
							// $result['helplink'] = \dash\url::sitelang(). '/support/dnsrecord';
							break;

						case 'DNS record not set on our dns':
							$result[$key] = T_("DNS record not set on our dns");
							break;

						case 'dns record not found':
							$result[$key] = T_("dns record not found");
							break;

						case 'Can not connect to CDN Service':
							$result[$key] = T_("Can not connect to CDN Service");
							break;

						case 'This domain is already is use in CDN panel':
							$result[$key] = T_("This domain is already is use in CDN panel");
							break;

						case 'Can not add domain to CND Service':
							$result[$key] = T_("Can not add domain to CND Service");
							break;

						case 'Can not connect get domain a record':
							$result[$key] = T_("Can not connect get domain a record");
							break;

						case 'request of https was sended':
							$result[$key] = T_("request of https was sended");
							break;

						default:
							$result['message'] = T_($value);
							break;
					}
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}

		return $result;
	}


	public static function get_detail($_id)
	{
		$id = \dash\validate::code($_id);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$id = \dash\coding::decode($id);

		$load = \lib\db\store_domain\get::by_id($id);

		if(!is_array($load))
		{
			$load = [];
		}

		$load = self::ready($load);

		return $load;
	}



	public static function multi_check_business_domain($_type)
	{
		// cronjobstatus
		// cronjobdate
		// sslrequestdate
		$ssl_mode   = false;
		$one_domain = null;

		if($_type === 'new')
		{
			$one_domain = \lib\db\store_domain\get::cronjob_list_new();
		}
		elseif($_type === 'ssl')
		{
			$ssl_mode = true;
			$date = date("Y-m-d H:i:s", time() - (60*10));
			$one_domain = \lib\db\store_domain\get::cronjob_list_ssl($date);
		}
		else
		{
			$one_domain = \lib\db\store_domain\get::cronjob_list_other();
		}

		if(!isset($one_domain['id']))
		{
			return false;
		}



		$store_domain_id = $one_domain['id'];

		\lib\db\store_domain\update::record(['status' => 'pending', 'datemodified' => date("Y-m-d H:i:s"), 'cronjobdate' => date("Y-m-d H:i:s"),], $store_domain_id);

		self::add_domain_arvan($one_domain['domain'], $ssl_mode);
	}


	public static function domain_action($_type, $_domain)
	{
		return;
		$_domain       = \dash\validate::domain($_domain);

		$add_domain    = \dash\session::get('businessNewDomain');
		$remove_domain = \dash\session::get('businessRemoveDomain');

		\dash\session::set('businessNewDomain', null);
		\dash\session::set('businessRemoveDomain', null);

		if($_type === 'add')
		{
			if($add_domain !== $_domain)
			{
				\dash\notif::error(T_("Dont!"));
				return false;
			}
			return self::add_domain_arvan($add_domain);
		}
		elseif($_type === 'remove')
		{
			if($remove_domain !== $_domain)
			{
				\dash\notif::error(T_("Dont!"));
				return false;
			}

			return self::remove_domain_arvan($remove_domain);
		}
		else
		{
			\dash\log::oops('DomainActionInvalidTypeArvan');
		}
	}


	private static function check_dns($_domain)
	{

		$dns_record = [];

		try
		{
			$dns_record = @dns_get_record($_domain, DNS_NS);
			if($dns_record === false)
			{
				// can not get dns record
				return null;
			}
		}
		catch (\Exception $e)
		{
			\dash\notif::error(T_("Can not get DNS record"));
			return null;
		}

		if(!is_array($dns_record))
		{
			$dns_record = [];
		}

		$dns = array_column($dns_record, 'target');

		$arvan_ns1 = \lib\app\nic_usersetting\defaultval::ns1();
		$arvan_ns2 = \lib\app\nic_usersetting\defaultval::ns2();

		if(in_array($arvan_ns1, $dns) && in_array($arvan_ns2, $dns))
		{
			// dns is ok
			return $dns;
		}
		else
		{
			\dash\notif::error(T_("DNS not set on our dns record"));
			return false;
		}
	}




	public static function add_domain_arvan($_domain, $_ssl_mode = false)
	{
		$domain = \dash\validate::domain($_domain, false);
		if(!$domain)
		{
			\dash\notif::error(T_("Invalid domain"));
			return false;
		}

		$store_domain = \lib\db\store_domain\get::by_domain($domain);
		if(!isset($store_domain['id']))
		{
			\dash\notif::error(T_("Domain is not connected to your store"));
			return false;
		}

		$store_domain_id = $store_domain['id'];

		if(isset($store_domain['status']) && $store_domain['status'] === 'ok')
		{
			\dash\notif::error(T_("This domain is already connected to your business successfully"));
			return false;
		}

		if(isset($store_domain['subdomain']) && $store_domain['subdomain'])
		{
			\lib\db\store_domain\update::record(['status' => 'ok', 'datemodified' => date("Y-m-d H:i:s")], $store_domain_id);
			return false;
		}


		\lib\db\store_domain\update::record(['status' => 'pending', 'datemodified' => date("Y-m-d H:i:s")], $store_domain_id);

		// $check_dns = self::check_dns($domain);

		// if($check_dns)
		// {
		// 	$update                 = [];
		// 	$update['message']      = 'dns record ok';
		// 	$update['datemodified'] = date("Y-m-d H:i:s");

		// 	if(is_array($check_dns) && isset($check_dns[0]) && isset($check_dns[1]))
		// 	{
		// 		$update['dns1'] = $check_dns[0];
		// 		$update['dns2'] = $check_dns[1];
		// 	}

		// 	\lib\db\store_domain\update::record($update, $store_domain_id);

		// }
		// else
		// {
		// 	if($check_dns === null)
		// 	{
		// 		$msg = 'Can not get dns record';
		// 	}
		// 	elseif($check_dns === false)
		// 	{
		// 		$msg = 'DNS record not set on our dns';
		// 	}
		// 	else
		// 	{
		// 		$msg = 'dns record not found';
		// 	}

		// 	\dash\notif::error(T_($msg));

		// 	\lib\db\store_domain\update::record(['status' => 'failed', 'message' => $msg, 'datemodified' => date("Y-m-d H:i:s")], $store_domain_id);
		// 	return false;
		// }


		$jibres_ip = \dash\setting\dns_server::ip();

		$check_exist_domain = \lib\arvancloud\api::get_domain($domain);


		if(!$check_exist_domain || !is_array($check_exist_domain))
		{
			\lib\db\store_domain\update::record(['status' => 'failed', 'message' => 'Can not connect to CDN Service', 'datemodified' => date("Y-m-d H:i:s")], $store_domain_id);
			self::send_to_supervisor('Can not connect to arvancloud API On domain: '. $domain);
			\dash\notif::error(T_("Sorry, Can not connect to CDN API to connect your domain. Please Try again"));
			return false;
		}


		$must_add   = [];
		$mus_update = [];
		$nothing    = [];
		$add_https  = false;

		if(array_key_exists('status', $check_exist_domain) && !$check_exist_domain['status'])
		{
			// domain not found need to add to arvand
			$add_domain = \lib\arvancloud\api::add_domain($domain);


			if(isset($add_domain['data']['id']))
			{
				// add a record
				$must_add['@'] = [];
				$must_add['*'] = [];

				\lib\arvancloud\api::check_dns_record($domain);

				$check_exist_domain = \lib\arvancloud\api::get_domain($domain);

				if(isset($check_exist_domain['data']['services']['dns']) && $check_exist_domain['data']['services']['dns'] === 'active')
				{
					// add https
					$add_https = true;
				}

			}
			elseif(isset($add_domain['message']) && $add_domain['message'] === 'The given data was invalid.')
			{
				// this domain is already added to arvand cdn
				\lib\db\store_domain\update::record(['status' => 'failed', 'message' => 'This domain is already is use in CDN panel', 'datemodified' => date("Y-m-d H:i:s")], $store_domain_id);
				self::send_to_supervisor('Domain is alreay added to arvand panel. domain: '. $domain);
				\dash\notif::error(T_("This domain is already in use in CDN panel"));
				return false;
			}
			else
			{
				\lib\db\store_domain\update::record(['status' => 'failed', 'message' => 'Can not add domain to CND Service', 'datemodified' => date("Y-m-d H:i:s")], $store_domain_id);
				self::send_to_supervisor('Can not connect add domain to arvand panel. domain: '. $domain);
				\dash\notif::error(T_("Can not add domain to CND Service"));
				return false;
			}
		}

		if(isset($check_exist_domain['data']['id']))
		{
			$get_dns_record = \lib\arvancloud\api::get_dns_record($domain);
			if(!$get_dns_record || !is_array($get_dns_record) || !isset($get_dns_record['data']) || (isset($get_dns_record['data']) && !is_array($get_dns_record['data'])))
			{
				\lib\db\store_domain\update::record(['status' => 'failed', 'message' => 'Can not connect get domain a record', 'datemodified' => date("Y-m-d H:i:s")], $store_domain_id);
				self::send_to_supervisor('Can not connect get domain dns record from arvand panel. domain: '. $domain);
				\dash\notif::error(T_("Can not get domain dns record from CDN panel"));
				return false;
			}


			if(isset($check_exist_domain['data']['services']['dns']) && $check_exist_domain['data']['services']['dns'] === 'active')
			{
				// add https
				$add_https = true;
			}


			foreach ($get_dns_record['data'] as $key => $value)
			{
				if(isset($value['id']))
				{
					if(isset($value['type']) && $value['type'] === 'a')
					{
						if(isset($value['name']) && $value['name'] === '@' || $value['name'] === '*')
						{
							if(isset($value['value']) && is_array($value['value']))
							{
								if(count($value['value']) === 1)
								{

									if(isset($value['value'][0]['ip']))
									{
										if($value['value'][0]['ip'] === $jibres_ip)
										{
											$nothing[$value['name']] =
											[
												'id' => $value['id'],
											];
										}
										else
										{
											$mus_update[$value['name']] =
											[
												'id' => $value['id'],
											];
										}
									}
								}
								else
								{
									$mus_update[$value['name']] =
									[
										'id' => $value['id'],
									];
								}
							}
						}
					}
				}
			}
		}

		if(isset($mus_update['@']))
		{
			// notihg
		}
		elseif(!isset($nothing['@']))
		{
			$must_add['@'] = [];
		}

		if(isset($mus_update['*']))
		{
			// nothing
		}
		elseif(!isset($nothing['*']))
		{
			$must_add['*'] = [];
		}

		foreach ($must_add as $key => $value)
		{
			$add_dns =
			[
				"type"           =>  "a",
				"name"           =>  $key,
				"value"          =>  json_encode([["ip" => $jibres_ip, /*"port" => null, "weight" => null , "country" => null*/]]),
				"ttl"            =>  120,
				"cloud"          =>  true,
				"upstream_https" =>  "default",
				"ip_filter_mode" => json_encode(["count"=>"single","order"=>"none","geo_filter" =>"none"]),
			];

			$result_add = \lib\arvancloud\api::add_dns_record($domain, $add_dns);

			\lib\db\store_domain\update::record(['dnsrecord' => 1, 'datemodified' => date("Y-m-d H:i:s")], $store_domain_id);
		}


		foreach ($mus_update as $key => $value)
		{
			$add_dns =
			[
				"type"           =>  "a",
				"name"           =>  $key,
				"value"          =>  json_encode([["ip" => $jibres_ip, /*"port" => null, "weight" => null , "country" => null*/]]),
				"ttl"            =>  120,
				"cloud"          =>  true,
				"upstream_https" =>  "default",
				"ip_filter_mode" => json_encode(["count"=>"single","order"=>"none","geo_filter" =>"none"]),
			];
			$result_update = \lib\arvancloud\api::update_dns_record($domain, $add_dns, $value['id']);

			\lib\db\store_domain\update::record(['dnsrecord' => 1, 'datemodified' => date("Y-m-d H:i:s")], $store_domain_id);
		}

		\lib\arvancloud\api::set_caching($domain, ['cache_status' => 'query_string']);
		\lib\arvancloud\api::https_upstram($domain);


		if($add_https)
		{
			$get_https_setting = \lib\arvancloud\api::get_arvan_request($domain);

			if(isset($get_https_setting['data']) && is_array($get_https_setting['data']))
			{
				if(array_key_exists('ar_wildcard', $get_https_setting['data']) && !$get_https_setting['data']['ar_wildcard'])
				{
					if(!$_ssl_mode)
					{
						$add_https_args =
						[
							// "ar_sub_domains": [],
							"ar_wildcard" => true,
						];

						$set_https = \lib\arvancloud\api::set_arvan_request($domain, $add_https_args);

						\lib\db\store_domain\update::record(['message' => 'request of https was sended', 'sslrequestdate' => date("Y-m-d H:i:s"), 'datemodified' => date("Y-m-d H:i:s")], $store_domain_id);
					}
					else
					{
						\lib\db\store_domain\update::record(['message' => 'ssl failed', 'sslfailed' => date("Y-m-d H:i:s"), 'datemodified' => date("Y-m-d H:i:s")], $store_domain_id);
					}
				}
				elseif(array_key_exists('ar_wildcard', $get_https_setting['data']) && $get_https_setting['data']['ar_wildcard'])
				{
					\lib\db\store_domain\update::record(['status' => 'ok', 'message' => 'domain successfully connected', 'datemodified' => date("Y-m-d H:i:s")], $store_domain_id);
				}
			}
		}

	}


	private static function remove_domain_arvan($_domain)
	{

	}


	private static function send_to_supervisor($_text)
	{
		$log =
		[
			'my_text' => $_text,
		];

		\dash\log::set('sendToSupervisor', $log);
	}


	// private static function check_domain_file($_old_record, $_new_domain)
	// {
	// 	$old_domain = null;
	// 	if(isset($_old_record['value']) && $_old_record['value'])
	// 	{
	// 		$old_domain = $_old_record['value'];
	// 	}

	// 	$domain_addr = \dash\engine\store::customer_domain_addr();

	// 	if(!\dash\file::exists($domain_addr))
	// 	{
	// 		\dash\file::makeDir($domain_addr, null, true);
	// 	}

	// 	if($old_domain)
	// 	{
	// 		if(!is_file($domain_addr. $old_domain))
	// 		{
	// 			\dash\file::write($domain_addr. $old_domain, \lib\store::id());
	// 		}
	// 	}

	// 	if(\dash\validate::is_equal($old_domain, $_new_domain))
	// 	{
	// 		// every thing is ok
	// 		return true;
	// 	}

	// 	if(is_file($domain_addr. $_new_domain))
	// 	{
	// 		\dash\notif::error(T_("This domain is reserved. Can not choose it"));
	// 		return false;
	// 	}

	// 	if($old_domain)
	// 	{
	// 		\dash\file::delete($domain_addr. $old_domain);
	// 	}

	// 	if($_new_domain)
	// 	{
	// 		\dash\file::write($domain_addr. $_new_domain, \lib\store::id());
	// 	}
	// }
}
?>