<?php
namespace lib\app\store;


class domain
{
	public static function remove($_args)
	{
		$condition =
		[
			'domain' => 'domain',
			'id'     => 'code',
		];

		$require = ['domain', 'id'];

		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$id = \dash\coding::decode($data['id']);
		if(!is_numeric($id))
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

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

		$check_duplicate_domain = \lib\db\store_domain\get::check_duplicate($data['domain']);

		if(!isset($check_duplicate_domain['id']))
		{
			// BUG!!!
			// nothing
			// needless to delete record
		}
		else
		{
			if(isset($check_duplicate_domain['store_id']) && $check_duplicate_domain['store_id'] && intval($check_duplicate_domain['store_id']) === intval(\lib\store::id()))
			{
				// delete record
				\lib\db\store_domain\delete::record($check_duplicate_domain['id']);
			}
			else
			{
				// bug
				\dash\log::oops('db');
			}
		}

		\lib\db\setting\delete::record($load_setting_record['id']);

		$domain_addr = \dash\engine\store::customer_domain_addr();

		if(is_file($domain_addr. $data['domain']))
		{
			\dash\file::delete($domain_addr. $data['domain']);
		}


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
			if(isset($check_duplicate_domain['store_id']) && $check_duplicate_domain['store_id'] && intval($check_duplicate_domain['store_id']) === intval(\lib\store::id()))
			{
				// needless to update domain
				// exactly this domain exists for this store
				\dash\notif::info(T_("Your domain detail saved without change"));
				return true;
			}
			else
			{
				\dash\notif::error(T_("This domain is reserved. Can not choose it"));
				return false;
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
		$domain_list = \lib\db\setting\get::by_cat_key_all('store_setting', 'domain');
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
					# code...
					break;
			}
		}

		return $result;
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