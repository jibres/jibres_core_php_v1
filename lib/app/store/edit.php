<?php
namespace lib\app\store;


class edit
{
	public static function change_owner($_id, $_new_owner_mobile)
	{
		$_id = \dash\validate::id($_id);
		if(!$_id)
		{
			return false;
		}

		$load_store = \lib\db\store\get::data($_id);
		if(!isset($load_store['id']))
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		$load_store_id = \lib\db\store\get::by_id($load_store['id']);

		$mobile = \dash\validate::mobile($_new_owner_mobile);

		if(!$mobile)
		{
			return false;
		}

		$load_user = \dash\db\users::get_by_mobile($mobile);
		if(!$load_user)
		{
			\dash\notif::error(T_("Invalid user"));
			return false;
		}

		if(floatval(a($load_store, 'owner')) === floatval(a($load_user, 'id')))
		{
			\dash\notif::error(T_("New owner and current owner is iqual!"));
			return false;
		}

		\lib\db\store\update::owner($load_user['id'], $load_store['id']);

		$my_store_db          = \dash\engine\store::make_database_name($load_store['id']);

		\lib\db\setting\update::overwirte_cat_key_fuel($load_user['id'], 'store_setting', 'owner', $load_store_id['fuel'], $my_store_db);

		$new_owner_store_user = \lib\db\store_user\get::by_store_id_user_id($load_store['id'], $load_user['id']);
		if(!$new_owner_store_user)
		{
			$new_record_store_user =
			[
				'store_id'    => $load_store['id'],
				'user_id'     => $load_user['id'],
				'staff'       => 'yes',
				'datecreated' => date("Y-m-d H:i:s"),
			];
			\lib\db\store_user\insert::jibres_new_record($new_record_store_user);
		}
		else
		{
			\lib\db\store_user\update::jibres_store_user_update($load_store['id'], $load_user['id'], ['staff' => 'yes']);
		}

		\lib\db\store_user\update::jibres_store_user_update($load_store['id'], $load_store['owner'], ['staff' => 'no']);


		\lib\store::reset_cache($load_store['id'], $load_store_id['subdomain']);

		\dash\log::set('businessOwnerUpdate', ['old_owner' => $load_store['owner'], 'new_owner' => $load_user['id'] ]);

		\dash\notif::ok(T_("Owner was changed"));

		return true;
	}


	public static function change_subdomain($_subdomain, $_id)
	{
		$subdomain = \dash\validate::subdomain_admin($_subdomain);
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
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		\lib\db\store\update::subdomain($subdomain, $load_store['id']);

		$my_store_db          = \dash\engine\store::make_database_name($load_store['id']);

		\lib\db\setting\update::overwirte_cat_key_fuel($subdomain, 'store_setting', 'subdomain', $load_store['fuel'], $my_store_db);

		\lib\store::reset_cache($load_store['id'], $load_store['subdomain']);

		\dash\log::set('businessSubdomainUpdate', ['old_subdomain' => $load_store['subdomain'], 'new_subdomain' => $subdomain ]);

		\dash\notif::ok(T_("Subdomain was changed"));

		return true;
	}


	public static function change_enterprise($_enterprise, $_id)
	{
		$_enterprise = \dash\validate::string_100($_enterprise);

		if($_enterprise && !in_array($_enterprise, ['rafiei']))
		{
			\dash\notif::error(T_("Invalid enterprise"));
			return false;
		}

		if(!$_enterprise)
		{
			$_enterprise = null;
		}


		$load_store = \lib\db\store\get::by_id($_id);
		if(!isset($load_store['id']))
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		\lib\db\store\update::enterprise($_enterprise, $load_store['id']);

		$my_store_db          = \dash\engine\store::make_database_name($load_store['id']);

		\lib\db\setting\update::overwirte_cat_key_fuel($_enterprise, 'store_setting', 'enterprise', $load_store['fuel'], $my_store_db);

		\lib\store::reset_cache($load_store['id'], $load_store['subdomain']);

		$current_store_data = \lib\db\store\get::data($_id);

		\dash\log::set('businessEnterpriceUpdated', ['old_enterprise' => a($current_store_data, 'enterprise'), 'new_enterprise' => $_enterprise ]);

		\dash\notif::ok(T_("Enterprice was changed"));

		return true;
	}



	public static function change_storage($_storage, $_uploadsize, $_id)
	{
		$_storage = \dash\validate::bigint($_storage);

		if(!$_storage)
		{
			$_storage = null;
		}

		$_uploadsize = \dash\validate::bigint($_uploadsize);

		if(!$_uploadsize)
		{
			$_uploadsize = 0;
		}

		$uploadsize = $_uploadsize;
		$storage    = $_storage;

		$load_store = \lib\db\store\get::by_id($_id);

		if(!isset($load_store['id']))
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		$my_store_db          = \dash\engine\store::make_database_name($load_store['id']);

		$current_store_data = \lib\db\store\get::data($_id);

		if($storage)
		{
			\lib\db\store\update::storage($storage, $load_store['id']);
			\lib\db\setting\update::overwirte_cat_key_fuel($storage, 'store_setting', 'storage', $load_store['fuel'], $my_store_db);
		}

		if($uploadsize)
		{
			\lib\db\store\update::uploadsize($uploadsize, $load_store['id']);
			\lib\db\setting\update::overwirte_cat_key_fuel($uploadsize, 'store_setting', 'uploadsize', $load_store['fuel'], $my_store_db);
		}


		\lib\store::reset_cache($load_store['id'], $load_store['subdomain']);

		$log =
		[
			'old_storage'    => a($current_store_data, 'storage'),
			'new_storage'    => $storage,
			'old_uploadsize' => a($current_store_data, 'uploadsize'),
			'new_uploadsize' => $uploadsize,
		];
		\dash\log::set('businessStorageUpdatedAndUploadsize', $log);

		\dash\notif::ok(T_("Storage was changed"));

		return true;
	}

	public static function social($_args)
	{
		$condition =
		[
			'instagram' => 'socialnetwork',
			'telegram'  => 'socialnetwork',
			'youtube'   => 'socialnetwork',
			'twitter'   => 'socialnetwork',
			'linkedin'  => 'socialnetwork',
			'whatsapp'  => 'socialnetwork',
			'github'    => 'socialnetwork',
			'facebook'  => 'socialnetwork',
			'email'     => 'email',
			'aparat'    => 'socialnetwork',
			'eitaa'     => 'socialnetwork',
			'whatsapp'  => 'mobile',
		];

		$require = [];

		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		$data = \dash\cleanse::patch_mode($_args, $data);

		foreach ($data as $key => $value)
		{
			\lib\app\setting\tools::update('store_setting', $key, $value);
			// \lib\app\menu\update::socialnetwork($key, $value, true);
		}

		\lib\store::reset_cache();

		\dash\notif::ok(T_("Your social network was saved"));
	}



	public static function selfedit($_args, $_option = [])
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

		if(isset($_option['silent']) && $_option['silent'])
		{
			// silient mode
		}
		else
		{
			\dash\notif::ok(T_("Your setting was saved"));
		}

		return true;
	}



	/**
	 * Uploads a logo.
	 * call from setting upload logo and setup upload logo
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function upload_logo($_silent = false)
	{
		if(!\lib\store::in_store())
		{
			if(!$_silent)
			{
				\dash\notif::error(T_("Your are not in this store!"));
			}
			return false;
		}

		$file = \dash\upload\store_logo::set();

		$old_logo = \lib\app\setting\tools::get('store_setting', 'logo');

		if(!$file && !$old_logo)
		{
			if(!$_silent)
			{
				\dash\notif::error(T_("Please choose yoru file"), 'loog');
			}
			return false;
		}

		if($file)
		{
			\lib\app\store\edit::selfedit(['logo' => $file]);
		}
		return true;
	}

}
?>