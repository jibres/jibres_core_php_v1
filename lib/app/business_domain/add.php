<?php
namespace lib\app\business_domain;


class add
{
	private static $debug = true;

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

		self::add($_args);

		return true;
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

		$cdn = 'arvancloud';

		$ir_domain = \dash\validate::ir_domain($domain, false);
		if(!$ir_domain)
		{
			// $cdn = 'cloudflare'; // not ready yet
			$cdn = 'arvancloud';
		}

		$update_store_id = null;

		$check_duplicate = \lib\db\business_domain\get::by_domain($domain);

		if(isset($check_duplicate['id']))
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
					\dash\notif::error($msg, ['element' => 'domain', 'alerty' => true]);
				}
				return false;
			}
		}

		$my_domain = $data['domain'];

		$parse_url = \dash\validate\url::parseUrl($my_domain);
		if(!$parse_url)
		{
			\dash\notif::error(T_("Invalid domain"));
			return false;
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
			\lib\app\business_domain\edit::edit_raw(['store_id' => $data['store_id'], 'master' => $master_domain], $update_store_id);
			$business_domain_id = $update_store_id;
		}
		else
		{
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

			$business_domain_id = \lib\db\business_domain\insert::new_record($insert);

			if(!$business_domain_id)
			{
				\dash\log::oops('dbBusinessDomainInsertError');
				return false;
			}

		}

		\lib\app\business_domain\action::new_action($business_domain_id, 'add_domain');

		\lib\app\business_domain\edit::reset_redirect_domain_setting();

		\lib\store::reset_cache();

		if(self::$debug)
		{
			\dash\notif::create(T_("Domain added"));
		}



		return ['id' => $business_domain_id];
	}
}
?>