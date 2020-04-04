<?php
namespace lib\app\store;


class domain
{
	public static function set($_args)
	{
		$condition =
		[
			'domain1' => 'domain',
			'domain2' => 'domain',

		];

		$require = [];

		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		if($data['domain1'])
		{
			$data['domain1'] = self::clean_domain($data['domain1']);
		}

		if($data['domain2'])
		{
			$data['domain2'] = self::clean_domain($data['domain2']);
		}

		$load_domain_1 = \lib\db\setting\get::by_cat_key('store_setting', 'domain1');

		self::check_domain_file($load_domain_1, $data['domain1']);

		if(isset($load_domain_1['value']) && \dash\validate::is_equal($load_domain_1['value'], $data['domain1']))
		{
			unset($data['domain1']);
		}

		$load_domain_2 = \lib\db\setting\get::by_cat_key('store_setting', 'domain2');

		self::check_domain_file($load_domain_2, $data['domain2']);

		if(isset($load_domain_1['value']) && \dash\validate::is_equal($load_domain_2['value'], $data['domain2']))
		{
			unset($data['domain2']);
		}

		// have error in domain file
		if(!\dash\engine\process::status())
		{
			return false;
		}

		if(!empty($data))
		{
			foreach ($data as $key => $value)
			{
				\lib\app\setting\tools::update('store_setting', $key, $value);
			}

			\dash\notif::ok(T_("Your domain connected to your store"));
			return true;
		}
		else
		{
			\dash\notif::info(T_("Your domain detail saved without change"));
			return true;
		}
	}


	private static function clean_domain($_domain)
	{
		$_domain = str_replace('http://', '', $_domain);
		$_domain = str_replace('https://', '', $_domain);
		$_domain = str_replace('/', '', $_domain);
		return $_domain;
	}


	private static function check_domain_file($_old_record, $_new_domain)
	{
		$old_domain = null;
		if(isset($_old_record['value']) && $_old_record['value'])
		{
			$old_domain = $_old_record['value'];
		}

		$domain_addr = \dash\engine\store::customer_domain_addr();

		if(!\dash\file::exists($domain_addr))
		{
			\dash\file::makeDir($domain_addr, null, true);
		}

		if($old_domain)
		{
			if(!is_file($domain_addr. $old_domain))
			{
				\dash\file::write($domain_addr. $old_domain, \lib\store::id());
			}
		}

		if(\dash\validate::is_equal($old_domain, $_new_domain))
		{
			// every thing is ok
			return true;
		}

		if(is_file($domain_addr. $_new_domain))
		{
			\dash\notif::error(T_("This domain is reserved. Can not choose it"));
			return false;
		}

		if($old_domain)
		{
			\dash\file::delete($domain_addr. $old_domain);
		}

		if($_new_domain)
		{
			\dash\file::write($domain_addr. $_new_domain, \lib\store::id());
		}
	}
}
?>