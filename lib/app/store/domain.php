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


		$data['domain'] = self::clean_domain($data['domain']);

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

		\dash\notif::ok(T_("Your domain connected to your store"));
		return true;

	}


	private static function clean_domain($_domain)
	{
		$_domain = str_replace('http://', '', $_domain);
		$_domain = str_replace('https://', '', $_domain);

		if(strpos($_domain, '/') !== false)
		{
			$_domain = str_replace(substr($_domain, strpos($_domain, '/')), '', $_domain);
		}

		$_domain = str_replace('/', '', $_domain);

		if(!\dash\validate::domain($_domain, false))
		{
			\dash\notif::error(T_("This domain is not a valid domain"), 'domain');
			return null;
		}

		return $_domain;
	}



	public static function get_domain_list()
	{
		// $domain_list = \lib\db\setting\get::by_cat_key_all('store_setting', 'domain');
		$domain_list = \lib\db\store_domain\get::by_store_id(\lib\store::id());
		$domain_list = array_map(['self', 'ready'], $domain_list);
		return $domain_list;
	}


	private static function ready($_data)
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

				default:
					$result[$key] = $value;
					break;
			}
		}

		return $result;
	}


	public static function domain_action($_type, $_domain)
	{
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


	public static function add_domain_arvan($_domain)
	{

		$store_domain = \lib\db\store_domain\get::by_domain($_domain);
		if(!isset($store_domain['id']))
		{
			\dash\notif::error(T_("Domain is not connected to your store"));
			return false;
		}

		$store_domain_id = $store_domain['id'];

		$jibres_ip = \dash\setting\dns_server::ip();

		$check_exist_domain = \lib\arvancloud\api::get_domain($_domain);

		if(!$check_exist_domain || !is_array($check_exist_domain))
		{

			\lib\db\store_domain\update::record(['status' => 'failed', 'message' => T_('Can not connect to arvancloud API'), 'datemodified' => date("Y-m-d H:i:s")], $store_domain_id);
			self::send_to_supervisor('Can not connect to arvancloud API On domain: '. $_domain);
			\dash\notif::error(T_("Sorry, Can not connect to CDN API to connect your domain. Please Try again"));
			return false;
		}

		\lib\db\store_domain\update::record(['status' => 'pending', 'datemodified' => date("Y-m-d H:i:s")], $store_domain_id);

		$must_add   = [];
		$mus_update = [];
		$nothing    = [];
		$add_https  = false;
		if(array_key_exists('status', $check_exist_domain) && !$check_exist_domain['status'])
		{
			// domain not found need to add to arvand
			$add_domain = \lib\arvancloud\api::add_domain($_domain);

			if(isset($add_domain['data']['id']))
			{
				// add a record
				$must_add['@'] = [];
				$must_add['*'] = [];

				\lib\arvancloud\api::check_dns_record($_domain);

				$check_exist_domain = \lib\arvancloud\api::get_domain($_domain);

				if(isset($check_exist_domain['data']['services']['dns']) && $check_exist_domain['data']['services']['dns'] === 'active')
				{
					// add https
					$add_https = true;
				}

			}
			else
			{
				self::send_to_supervisor('Can not connect add domain to arvand panel. domain: '. $_domain);
				\dash\notif::error(T_("Can not add domain to arvand panel"));
				return false;
			}
		}
		elseif(isset($check_exist_domain['data']['id']))
		{
			$get_dns_record = \lib\arvancloud\api::get_dns_record($_domain);
			if(!$get_dns_record || !is_array($get_dns_record) || !isset($get_dns_record['data']) || (isset($get_dns_record['data']) && !is_array($get_dns_record['data'])))
			{
				self::send_to_supervisor('Can not connect get domain dns record from arvand panel. domain: '. $_domain);
				\dash\notif::error(T_("Can not get domain dns record from arvand panel"));
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

			$result_add = \lib\arvancloud\api::add_dns_record($_domain, $add_dns);

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
			$result_update = \lib\arvancloud\api::update_dns_record($_domain, $add_dns, $value['id']);

			\lib\db\store_domain\update::record(['dnsrecord' => 1, 'datemodified' => date("Y-m-d H:i:s")], $store_domain_id);
		}


		if($add_https)
		{
			$get_https_setting = \lib\arvancloud\api::get_arvan_request($_domain);

			if(isset($get_https_setting['data']) && is_array($get_https_setting['data']))
			{
				if(array_key_exists('ar_wildcard', $get_https_setting['data']) && !$get_https_setting['data']['ar_wildcard'])
				{
					$add_https_args =
					[
						// "ar_sub_domains": [],
						"ar_wildcard" => true,
					];

					$set_https = \lib\arvancloud\api::set_arvan_request($_domain, $add_https_args);

					\lib\db\store_domain\update::record(['https' => 1, 'status' => 'ok', 'datemodified' => date("Y-m-d H:i:s")], $store_domain_id);
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