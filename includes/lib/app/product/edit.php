<?php
namespace lib\app\product;

trait edit
{
	/**
	 * edit a product
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
			\lib\app::log('api:product:method:put:id:not:set', $this->user_id, $log_meta);
			debug::error(T_("Id not set"), 'id', 'permission');
			return false;
		}

		$admin_of_product = \lib\db\products::access_product_id($id, $this->user_id, ['action' => 'edit']);

		if(!$admin_of_product || !isset($admin_of_product['id']) || !isset($admin_of_product['slug']))
		{
			\lib\app::log('api:product:method:put:permission:denide', $this->user_id, $log_meta);
			debug::error(T_("Can not access to edit it"), 'product', 'permission');
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
			\lib\app::log('api:product:parent:is:the:product', $this->user_id, $log_meta);
			debug::error(T_("A product can not be the parent himself"), 'parent', 'arguments');
			return false;
		}

		if(array_key_exists('name', $args) && !$args['name'])
		{
			\lib\app::log('api:product:name:not:set:edit', $this->user_id, $log_meta);
			debug::error(T_("Store name of product can not be null"), 'name', 'arguments');
			return false;
		}

		if(array_key_exists('slug', $args) && !$args['slug'])
		{
			\lib\app::log('api:product:slug:not:set:edit', $this->user_id, $log_meta);
			debug::error(T_("slug of product can not be null"), 'slug', 'arguments');
			return false;
		}

		if(!empty($args))
		{
			$update = \lib\db\products::update($args, $admin_of_product['id']);

			if(isset($args['slug']))
			{
				if(!$update)
				{
					$args['slug'] = $this->slug_fix($args);
					$update = \lib\db\products::update($args, $admin_of_product['id']);
				}
				// user change slug
				if($admin_of_product['slug'] != $args['slug'])
				{
					\lib\app::log('api:product:change:slug', $this->user_id, $log_meta);
				}
			}
		}
	}
}
?>