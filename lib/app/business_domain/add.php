<?php
namespace lib\app\business_domain;


class add
{
	public static function store_add($_args)
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		$_args['store_id'] = \lib\store::id();

		return self::add($_args);
	}
	public static function add($_args)
	{
		$condition =
		[
			'domain'   => 'domain',
			'store_id' => 'id',
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

		$check_duplicate = \lib\db\business_domain\get::by_domain($domain);
		if(isset($check_duplicate['id']))
		{
			\dash\notif::error(T_("Duplicate domain. This domain already added to domains list"), 'domain');
			return false;
		}

		$insert =
		[
			'domain'      => $domain,
			'status'      => 'pending',
			'user_id'     => \dash\user::jibres_user(),
			'subdomain'   => null,
			'root'        => null,
			'tld'         => null,
			'store_id'    => $data['store_id'],
			'domain_id'   => null,
			'cdn'         => $cdn,
			'datecreated' => date("Y-m-d H:i:s"),
		];

		$business_domain_id = \lib\db\business_domain\insert::new_record($insert);

		if(!$business_domain_id)
		{
			\dash\log::oops('dbBusinessDomainInsertError');
			return false;
		}

		\lib\app\business_domain\action::new_action($business_domain_id, 'add_domain');

		\dash\notif::create(T_("Domain added"));

		return ['id' => $business_domain_id];
	}
}
?>