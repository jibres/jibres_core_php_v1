<?php
namespace lib\app\business_domain;


class add
{
	private static $debug = true;

	public static function from_domain_update($_domain)
	{
		return self::from_domain_approved($_domain);
	}

	public static function from_domain_approved($_domain)
	{
		$domain = \dash\validate::domain($_domain, false);

		if(!$domain)
		{
			return;
		}

		$domain_detail = \lib\db\nic_domain\get::domain_anyone($domain);

		if(!isset($domain_detail['id']))
		{
			// domain not founded
			return;
		}

		$domain_detail = \lib\app\nic_domain\ready::row($domain_detail);

		if(isset($domain_detail['jibres_dns']) && $domain_detail['jibres_dns'])
		{

		}
		else
		{
			// is not jibres dns
			return;
		}

		$load_domain = \lib\db\business_domain\get::by_domain($domain);

		if(isset($load_domain['id']))
		{
			// this domain is already added to business domain list
			return;
		}

		$add =
		[
			'domain_id' => \dash\coding::decode($domain_detail['id']),
			'domain'    => $domain,
		];

		self::$debug = false;

		return self::add($add);
	}


	public static function store_add($_args)
	{
		$store_id = \lib\store::id();
		if(!$store_id)
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		$count_store_domain = \lib\db\business_domain\get::count_store_domain($store_id);

		if($count_store_domain > 100)
		{
			\dash\log::oops('maximumCapacityAddStoreDomain', T_("Your business domain capacity is full!"));
			return false;
		}

		$_args['store_id'] = $store_id;

		\lib\app\store\edit::selfedit(['redirect_jibres_subdomain_to_master' => 1]);

		\dash\notif::clean();

		return self::add($_args);
	}


	public static function add($_args)
	{
		$condition =
		[
			'domain'    => 'domain',
			'store_id'  => 'id',
			'domain_id' => 'id',
		];

		$require = ['domain'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		$domain = \dash\validate::domain($data['domain'], false);

		if(!$domain)
		{
			\dash\notif::error(T_("Domain is not valid"));
			return false;
		}



		$update_store_id = null;

		$check_duplicate = \lib\db\business_domain\get::by_domain($domain);

		if(isset($check_duplicate['id']))
		{
			if($check_duplicate['status'] === 'deleted')
			{
				$update_store_id = $check_duplicate['id'];
				// nothing
			}
			else
			{

				$have_error = true;
				$msg        = T_("Duplicate domain. This domain already added to domains list");

				if(floatval($check_duplicate['store_id']) === floatval(\lib\store::id()))
				{
					$msg = T_("This domain is alreay exists in your business domain list");
				}
				elseif(isset($check_duplicate['store_id']))
				{
					$msg = T_("Duplicate domain. This domain already taken by another business");
				}
				else
				{
					// domain was connected to jibres but not in any store. we connecte first to this store by update this record and set store id in this record
					$have_error      = false;
					$update_store_id = $check_duplicate['id'];
				}

				if($check_duplicate['status'] === 'pending_delete')
				{
					$msg = T_("This domain is pending for delete. Please try it later");
				}

				if($have_error)
				{
					if(self::$debug)
					{
						\dash\notif::error($msg, ['element' => 'domain', 'alerty' => true, 'domain_name' => $domain]);
					}
					return false;
				}
			}
		}

		$my_domain = $data['domain'];
		$return_domain = $my_domain;

		$parse_url = \dash\validate\url::parseUrl($my_domain);
		if(!$parse_url)
		{
			\dash\notif::error(T_("Invalid domain"));
			return false;
		}

		if(
			\dash\str::strpos($parse_url['root'], 'jibres') !== false ||
			\dash\str::strpos($parse_url['domain'], 'jibres') !== false ||
			\dash\str::strpos($parse_url['subdomain'], 'jibres') !== false)
		{
			\dash\notif::error(T_("Can not use jibres keywork in domain!"));
			return false;
		}

		if(!\dash\url::isLocal() && \dash\str::strpos($parse_url['tld'], 'local') !== false)
		{
			\dash\notif::error(T_("Can not use local domain!"));
			return false;
		}


		$cdn = 'arvancloud';

		$ir_domain = \dash\validate::ir_domain($domain, false);
		if($ir_domain)
		{
			$domainRaw = $parse_url['root']. '.'. $parse_url['tld'];
			$fetch_domain = \lib\app\nic_domain\get::only_info($domainRaw);
			if(isset($fetch_domain[$domain]['status']) && is_array($fetch_domain[$domain]['status']))
			{
				if(in_array('ok', $fetch_domain[$domain]['status']))
				{
					// ok
				}
				else
				{
					\dash\notif::error(T_("This domain is not activate yet in nic provider"));
					return false;
				}
			}
			else
			{
				if(isset($fetch_domain['available']) && $fetch_domain['available'] === true)
				{
					\dash\notif::error(T_("Domain not exist!"));
					return false;
				}
				else
				{
					\dash\notif::error(T_("Can not fetch domain detail from nic provider"));
					return false;
				}
			}
		}
		else
		{
			// $cdn = 'cloudflare'; // not ready yet
			$cdn = 'arvancloud';
		}


		$master_domain = null;

		if(\lib\store::id())
		{
			$master_domain = \lib\app\business_domain\get::my_business_master_domain();
			if(!$master_domain)
			{
				$master_domain = 1;
			}
			else
			{
				$master_domain =  null;
			}
		}

		if($update_store_id)
		{
			$add_by_update =
			[
				'status'   => 'pending',
				'store_id' => $data['store_id'],
				'master'   => $master_domain,
			];

			// if my dns is not ok remove it
			if(!a($check_duplicate, 'dnsok'))
			{
				$add_by_update['checkdns']            = null;
				$add_by_update['cdnpanel']            = null;
				$add_by_update['httpsrequest']        = null;
				$add_by_update['httpsverify']         = null;
				$add_by_update['dnsok']               = null;
				$add_by_update['arvan_result']        = null;

			}

			\lib\app\business_domain\edit::edit_raw($add_by_update, $update_store_id);
			$business_domain_id = $update_store_id;

			\lib\app\business_domain\action::new_action($business_domain_id, 'update_store_id');

		}
		else
		{
			if($parse_url['subdomain'] === 'www')
			{
				$parse_url['subdomain'] = null;
				$parse_url['domain'] = $parse_url['root']. '.'. $parse_url['tld'];
				$return_domain = $parse_url['domain'];
			}


			$insert =
			[
				'domain'      => $parse_url['domain'],
				'status'      => 'pending',
				'user_id'     => \dash\user::jibres_user(),
				'subdomain'   => $parse_url['subdomain'],
				'master'      => $master_domain,
				'root'        => $parse_url['root'],
				'tld'         => $parse_url['tld'],
				'store_id'    => $data['store_id'],
				'domain_id'   => $data['domain_id'],
				'cdn'         => $cdn,
				'datecreated' => date("Y-m-d H:i:s"),
			];

			// all subdomain need to verify
			if($insert['subdomain'])
			{
				$base_domain = $parse_url['root']. '.'. $parse_url['tld'];

				$insert['status'] = 'pending_verify';

				$json_verify_process =
				[
					'domain'             => $base_domain,
					'verifytype'         => 'txtrecord',
					'txt_record_name'    => '@',
					'txt_record_content' => 'jibres-site-verification='. md5(json_encode(array_merge($insert, ['time' => microtime()]))),
				];

				$insert['verifyprocess'] = json_encode($json_verify_process);
			}

			$business_domain_id = \lib\db\business_domain\insert::new_record($insert);

			if(!$business_domain_id)
			{
				\dash\log::oops('dbBusinessDomainInsertError');
				return false;
			}

			\lib\app\business_domain\action::new_action($business_domain_id, 'add_domain');
		}


		\lib\app\business_domain\edit::reset_redirect_domain_setting();

		if($data['store_id'])
		{
			\lib\app\business_domain\business::reset_list($data['store_id']);
		}

		\lib\store::reset_cache();

		if(self::$debug)
		{
			\dash\notif::create(T_("Domain added"), ['domain_name' => $domain]);
		}



		return ['id' => $business_domain_id, 'domain' => $return_domain];
	}
}
?>