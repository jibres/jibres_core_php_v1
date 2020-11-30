<?php
namespace lib\app\store;


class edit
{
	public static function change_subdomain($_subdomain, $_id)
	{
		$subdomain = \dash\validate::subdomain($_subdomain);
		if(!$subdomain)
		{
			return false;
		}

		$check_exist = \lib\db\store\get::subdomain_exist($subdomain);
		if(isset($check_exist['id']))
		{
			if(floatval($check_exist['id']) === floatval($_id))
			{
				\dash\notif::info(T_("No change in business subdomain"));
				return true;
			}
			else
			{
				\dash\notif::error(T_("This subdomain is already occupied"), 'subdomain');
				return false;
			}
		}

		$load_store = \lib\db\store\get::by_id($_id);
		if(!isset($load_store['id']))
		{
			\dash\notif::error(T_("Store not founde"));
			return false;
		}

		\lib\db\store\update::subdomain($subdomain, $load_store['id']);

		$my_store_db          = \dash\engine\store::make_database_name($load_store['id']);

		\lib\db\setting\update::overwirte_cat_key_fuel($subdomain, 'store_setting', 'subdomain', $load_store['fuel'], $my_store_db);

		\lib\store::reset_cache($load_store['id']);

		$addr = \dash\engine\store::subdomain_addr(). $load_store['subdomain']. \dash\engine\store::$ext;
		if(is_file($addr))
		{
			\dash\file::delete($addr);
		}

		\dash\log::set('businessSubdomainUpdate', ['old_subdomain' => $load_store['subdomain'], 'new_subdomain' => $subdomain ]);

		\dash\notif::ok(T_("Subdomain was changed"));

		return true;
	}

	public static function social($_args)
	{
		$condition =
		[
			'instagram' => 'string_50',
			'telegram'  => 'string_50',
			'youtube'   => 'string_50',
			'twitter'   => 'string_50',
			'linkedin'  => 'string_50',
			'github'    => 'string_50',
			'facebook'  => 'string_50',
			'email'     => 'string_50',
			'aparat'    => 'string_50',
			'eitaa'     => 'string_50',
		];

		$require = [];

		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		foreach ($data as $key => $value)
		{
			\lib\app\setting\tools::update('store_setting', $key, $value);
		}

		\lib\store::reset_cache();

		\dash\notif::ok(T_("Your social network was saved"));
	}



	public static function selfedit($_args)
	{
		if(!\lib\store::in_store())
		{
			\dash\notif::error(T_("Your are not in this store!"));
			return false;
		}



		$args = \lib\app\store\check::variable($_args);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$args = \dash\cleanse::patch_mode($_args, $args);

		if(!empty($args))
		{
			foreach ($args as $key => $value)
			{
				\lib\app\setting\tools::update('store_setting', $key, $value);
			}
		}

		$store_id = \lib\store::id();

		if($store_id)
		{
			if(array_key_exists('logo', $args))
			{
				\lib\db\store\update::store_data('logo', $args['logo'], $store_id);
			}

			if(array_key_exists('title', $args))
			{
				\lib\db\store\update::store_data('title', $args['title'], $store_id);
			}

			if(array_key_exists('desc', $args))
			{
				\lib\db\store\update::store_data('description', $args['desc'], $store_id);
			}


			if(array_key_exists('lang', $args))
			{
				\lib\db\store\update::store_data('lang', $args['lang'], $store_id);
			}
		}

		\lib\store::reset_cache();

		\dash\notif::ok(T_("Your setting was saved"));
		return true;
	}
}
?>