<?php
namespace content_api\v1\product\tools;
use \lib\utility;
use \lib\debug;
use \lib\db\logs;
trait add
{

	use product_check_args;

	public function add_product($_args = [])
	{
		$edit_mode = false;
		$default_args =
		[
			'method' => 'post',
		];

		if(!is_array($_args))
		{
			$_args = [];
		}

		$_args = array_merge($default_args, $_args);

		// debug::title(T_("Operation Faild"));

		$log_meta =
		[
			'data' => null,
			'meta' =>
			[
				'input' => utility::request(),
			]
		];

		if(!$this->user_id)
		{
			logs::set('api:product:user_id:notfound', null, $log_meta);
			debug::error(T_("User not found"), 'user', 'permission');
			return false;
		}

		$args             = [];

		$return_func = $this->product_check_args($_args, $args, $log_meta);
		if($return_func === false || !debug::$status)
		{
			return false;
		}


		$args['name']     = $name;
		$args['slug']     = $slug;
		$args['creator']  = $this->user_id;
		$args['website']  = $website;
		$args['desc']     = $desc;
		$args['lang']     = $lang;
		$args['logo']     = $logo_url;
		$args['parent']   = $parent ? $parent : null;
		$args['country']  = $country;
		$args['province'] = $province;
		$args['city']     = $city;
		$args['phone']    = $tel;
		$args['zipcode']  = $zipcode;

		$return = [];

		\lib\temp::set('last_product_added', $slug);

		if($_args['method'] === 'post')
		{
			$product_id = \lib\db\products::insert($args);

			if(!$product_id)
			{
				// $args['slug'] = $this->slug_fix($args);
				$product_id     = \lib\db\products::insert($args);
			}

			if(!$product_id)
			{
				logs::set('api:product:no:way:to:insert:product', $this->user_id, $log_meta);
				debug::error(T_("No way to insert product"), 'db', 'system');
				return false;
			}

			$return['product_id'] = \lib\utility\shortURL::encode($product_id);
			$return['slug']     = $args['slug'];

		}
		elseif ($_args['method'] === 'patch')
		{
			$edit_mode = true;
			$id = utility::request('id');
			$id = \lib\utility\shortURL::decode($id);
			if(!$id || !is_numeric($id))
			{
				logs::set('api:product:method:put:id:not:set', $this->user_id, $log_meta);
				debug::error(T_("Id not set"), 'id', 'permission');
				return false;
			}

			$admin_of_product = \lib\db\products::access_product_id($id, $this->user_id, ['action' => 'edit']);

			if(!$admin_of_product || !isset($admin_of_product['id']) || !isset($admin_of_product['slug']))
			{
				logs::set('api:product:method:put:permission:denide', $this->user_id, $log_meta);
				debug::error(T_("Can not access to edit it"), 'product', 'permission');
				return false;
			}

			unset($args['creator']);
			if(!utility::isset_request('name'))             unset($args['name']);
			if(!utility::isset_request('slug'))       unset($args['slug']);
			if(!utility::isset_request('website'))          unset($args['website']);
			if(!utility::isset_request('desc'))             unset($args['desc']);

			if(!utility::isset_request('language'))         unset($args['lang']);

			if(!utility::isset_request('parent'))           unset($args['parent']);

			if(!utility::isset_request('country'))          unset($args['country']);
			if(!utility::isset_request('province'))         unset($args['province']);
			if(!utility::isset_request('city'))             unset($args['city']);
			if(!utility::isset_request('tel'))              unset($args['phone']);

			if(!utility::isset_request('zipcode'))          unset($args['zipcode']);
			if(!utility::isset_request('desc'))             unset($args['desc']);

			if(!utility::isset_request('status'))           unset($args['status']);


			if(isset($args['parent']) && intval($args['parent']) === intval($id))
			{
				logs::set('api:product:parent:is:the:product', $this->user_id, $log_meta);
				debug::error(T_("A product can not be the parent himself"), 'parent', 'arguments');
				return false;
			}

			if(array_key_exists('name', $args) && !$args['name'])
			{
				logs::set('api:product:name:not:set:edit', $this->user_id, $log_meta);
				debug::error(T_("Product name of product can not be null"), 'name', 'arguments');
				return false;
			}

			if(array_key_exists('slug', $args) && !$args['slug'])
			{
				logs::set('api:product:slug:not:set:edit', $this->user_id, $log_meta);
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
						// $args['slug'] = $this->slug_fix($args);
						$update = \lib\db\products::update($args, $admin_of_product['id']);
					}
					// user change slug
					if($admin_of_product['slug'] != $args['slug'])
					{
						logs::set('api:product:change:slug', $this->user_id, $log_meta);
					}
				}
			}
		}
		else
		{
			logs::set('api:product:method:invalid', $this->user_id, $log_meta);
			debug::error(T_("Invalid method of api"), 'method', 'permission');
			return false;
		}


		if(debug::$status)
		{
			debug::title(T_("Operation Complete"));
			if($edit_mode)
			{
				debug::true(T_("Product successfuly edited"));
			}
			else
			{
				debug::true(T_("Product successfuly added"));
			}
		}

		return $return;
	}


}
?>