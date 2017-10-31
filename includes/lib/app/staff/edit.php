<?php
namespace lib\app\staff;
use \lib\debug;

trait edit
{
	/**
	 * edit a staff
	 *
	 * @param      <type>   $_args  The arguments
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function edit($_args)
	{
		\lib\app::variable($_args);

		$log_meta =
		[
			'data' => null,
			'meta' =>
			[
				'input' => \lib\app::request(),
			]
		];

		if(!\lib\staff::id())
		{
			\lib\app::log('api:staff:method:put:id:not:set', \lib\user::id(), $log_meta);
			debug::error(T_("Id not set"), 'id', 'permission');
			return false;
		}

		$check_is_admin = \lib\db\staffs::get(['id' => \lib\staff::id(), 'creator' => \lib\user::id(), 'limit' => 1]);
		if(!$check_is_admin || !isset($check_is_admin['id']))
		{
			\lib\app::log('api:staff:edit:permission:denide', \lib\user::id(), $log_meta);
			debug::error(T_("Can not access to edit staff"), 'staff');
			return false;
		}


		$args = self::check();

		if($args === false || !\lib\debug::$status)
		{
			return false;
		}

		if(!\lib\app::isset_request('name'))             unset($args['name']);
		if(!\lib\app::isset_request('slug'))      		 unset($args['slug']);
		if(!\lib\app::isset_request('website'))          unset($args['website']);
		if(!\lib\app::isset_request('desc'))             unset($args['desc']);
		if(!\lib\app::isset_request('language'))         unset($args['lang']);
		if(!\lib\app::isset_request('parent'))           unset($args['parent']);
		if(!\lib\app::isset_request('country'))          unset($args['country']);
		if(!\lib\app::isset_request('province'))         unset($args['province']);
		if(!\lib\app::isset_request('city'))             unset($args['city']);
		if(!\lib\app::isset_request('tel'))              unset($args['phone']);
		if(!\lib\app::isset_request('zipcode'))          unset($args['zipcode']);
		if(!\lib\app::isset_request('desc'))             unset($args['desc']);
		if(!\lib\app::isset_request('status'))           unset($args['status']);

		if(array_key_exists('name', $args) && !$args['name'])
		{
			\lib\app::log('api:staff:name:not:set:edit', \lib\user::id(), $log_meta);
			debug::error(T_("Store name of staff can not be null"), 'name', 'arguments');
			return false;
		}

		if(array_key_exists('slug', $args) && !$args['slug'])
		{
			\lib\app::log('api:staff:slug:not:set:edit', \lib\user::id(), $log_meta);
			debug::error(T_("slug of staff can not be null"), 'slug', 'arguments');
			return false;
		}

		if(!empty($args))
		{
			$update = \lib\db\staffs::update($args, $check_is_admin['id']);

			if(isset($args['slug']))
			{
				if(!$update)
				{
					$args['slug'] = $this->slug_fix($args);
					$update = \lib\db\staffs::update($args, $check_is_admin['id']);
				}
				// user change slug
				if($check_is_admin['slug'] != $args['slug'])
				{
					\lib\app::log('api:staff:change:slug', \lib\user::id(), $log_meta);
				}
			}
			// clean chach
			\lib\staff::clean();
		}
	}
}
?>