<?php
namespace lib\app\store;

trait edit
{
	/**
	 * edit a store
	 *
	 * @param      <type>   $_args  The arguments
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function edit($_args)
	{
		\lib\app::variable($_args);

		$id = \lib\app::request('id');
		$id = \lib\utility\shortURL::decode($id);
		if(!$id || !is_numeric($id))
		{
			\lib\app::log('api:store:method:put:id:not:set', $this->user_id, $log_meta);
			debug::error(T_("Id not set"), 'id', 'permission');
			return false;
		}

		$admin_of_store = \lib\db\stores::access_store_id($id, $this->user_id, ['action' => 'edit']);

		if(!$admin_of_store || !isset($admin_of_store['id']) || !isset($admin_of_store['slug']))
		{
			\lib\app::log('api:store:method:put:permission:denide', $this->user_id, $log_meta);
			debug::error(T_("Can not access to edit it"), 'store', 'permission');
			return false;
		}

		$args = self::check();
		if($args === false || !\lib\debug::$status)
		{
			return false;
		}

		unset($args['creator']);
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


		if(isset($args['parent']) && intval($args['parent']) === intval($id))
		{
			\lib\app::log('api:store:parent:is:the:store', $this->user_id, $log_meta);
			debug::error(T_("A store can not be the parent himself"), 'parent', 'arguments');
			return false;
		}

		if(array_key_exists('name', $args) && !$args['name'])
		{
			\lib\app::log('api:store:name:not:set:edit', $this->user_id, $log_meta);
			debug::error(T_("Store name of store can not be null"), 'name', 'arguments');
			return false;
		}

		if(array_key_exists('slug', $args) && !$args['slug'])
		{
			\lib\app::log('api:store:slug:not:set:edit', $this->user_id, $log_meta);
			debug::error(T_("slug of store can not be null"), 'slug', 'arguments');
			return false;
		}

		if(!empty($args))
		{
			$update = \lib\db\stores::update($args, $admin_of_store['id']);

			if(isset($args['slug']))
			{
				if(!$update)
				{
					$args['slug'] = $this->slug_fix($args);
					$update = \lib\db\stores::update($args, $admin_of_store['id']);
				}
				// user change slug
				if($admin_of_store['slug'] != $args['slug'])
				{
					\lib\app::log('api:store:change:slug', $this->user_id, $log_meta);
				}
			}
		}
	}
}
?>