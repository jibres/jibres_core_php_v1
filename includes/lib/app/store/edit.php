<?php
namespace lib\app\store;


trait edit
{

	public static function edit_meta($_meta)
	{
		$meta = json_encode($_meta, JSON_UNESCAPED_UNICODE);
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"), 'id', 'permission');
			return false;
		}

		$result = \lib\db\stores::update(['meta' => $meta], \lib\store::id());

		if($result)
		{
			\lib\store::clean();
		}

		return  $result;
	}

	/**
	 * edit a store
	 *
	 * @param      <type>   $_args  The arguments
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function edit($_args)
	{
		\dash\app::variable($_args);

		$log_meta =
		[
			'data' => null,
			'meta' =>
			[
				'input' => \dash\app::request(),
			]
		];

		if(!\lib\store::id())
		{
			\dash\app::log('api:store:method:put:id:not:set', \dash\user::id(), $log_meta);
			\dash\notif::error(T_("Id not set"), 'id', 'permission');
			return false;
		}

		$check_is_admin = \lib\db\stores::get(['id' => \lib\store::id(), 'creator' => \dash\user::id(), 'limit' => 1]);
		if(!$check_is_admin || !isset($check_is_admin['id']))
		{
			\dash\app::log('api:store:edit:permission:denide', \dash\user::id(), $log_meta);
			\dash\notif::error(T_("Can not access to edit store"), 'store');
			return false;
		}


		$args = self::check();

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		if(!\dash\app::isset_request('name'))    unset($args['name']);
		if(!\dash\app::isset_request('slug'))    unset($args['slug']);
		if(!\dash\app::isset_request('website')) unset($args['website']);
		if(!\dash\app::isset_request('desc'))    unset($args['desc']);
		if(!\dash\app::isset_request('language'))unset($args['lang']);
		if(!\dash\app::isset_request('parent'))  unset($args['parent']);
		if(!\dash\app::isset_request('country')) unset($args['country']);
		if(!\dash\app::isset_request('province'))unset($args['province']);
		if(!\dash\app::isset_request('city'))    unset($args['city']);
		if(!\dash\app::isset_request('zipcode')) unset($args['zipcode']);
		if(!\dash\app::isset_request('desc'))    unset($args['desc']);
		if(!\dash\app::isset_request('status'))  unset($args['status']);
		if(!\dash\app::isset_request('address')) unset($args['address']);
		if(!\dash\app::isset_request('phone'))   unset($args['phone']);
		if(!\dash\app::isset_request('mobile'))  unset($args['mobile']);
		if(!\dash\app::isset_request('logo'))    unset($args['logo']);
		if(!\dash\app::isset_request('plan'))    unset($args['plan']);

		if(array_key_exists('name', $args) && !$args['name'])
		{
			\dash\app::log('api:store:name:not:set:edit', \dash\user::id(), $log_meta);
			\dash\notif::error(T_("Name of store can not be null"), 'name', 'arguments');
			return false;
		}

		if(array_key_exists('slug', $args) && !$args['slug'])
		{
			\dash\app::log('api:store:slug:not:set:edit', \dash\user::id(), $log_meta);
			\dash\notif::error(T_("slug of store can not be null"), 'slug', 'arguments');
			return false;
		}

		if(!empty($args))
		{
			$update = \lib\db\stores::update($args, $check_is_admin['id']);

			if(isset($args['slug']))
			{
				if(!$update)
				{
					$args['slug'] = self::slug_fix($args);
					$update = \lib\db\stores::update($args, $check_is_admin['id']);
				}
				// user change slug
				if($check_is_admin['slug'] != $args['slug'])
				{
					\dash\app::log('api:store:change:slug', \dash\user::id(), $log_meta);
				}
			}
			// clean chach
			\lib\store::clean();
		}

		if(\dash\engine\process::status())
		{
			\dash\notif::ok(T_("Your store successfully update"));
		}
	}



	public static function edit_logo($_logo_url)
	{
		if(!$_logo_url || !is_string($_logo_url))
		{
			return false;
		}
		// check below line
		$log_meta = null;
		if(!\lib\store::id())
		{
			\dash\app::log('api:store:method:put:id:not:set', \dash\user::id(), $log_meta);
			\dash\notif::error(T_("Id not set"), 'id', 'permission');
			return false;
		}

		$check_is_admin = \lib\db\stores::get(['id' => \lib\store::id(), 'creator' => \dash\user::id(), 'limit' => 1]);
		if(!$check_is_admin || !isset($check_is_admin['id']))
		{
			\dash\app::log('api:store:edit:permission:denide', \dash\user::id(), $log_meta);
			\dash\notif::error(T_("Can not access to edit store"), 'store');
			return false;
		}

		if(\lib\store::detail('logo') === $_logo_url)
		{
			\dash\notif::warn(T_("No change in store logo"));
			return null;
		}

		$update = \lib\db\stores::update(['logo' => $_logo_url], \lib\store::id());

		if($update)
		{
			\lib\store::clean();
			\dash\notif::ok(T_("The store logo updated"));
			return true;
		}

		return false;
	}
}
?>
