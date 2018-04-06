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
	public static function edit($_args, $_option = [])
	{
		$default_option =
		[
			'debug' => true,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);

		\dash\app::variable($_args);

		$log_meta =
		[
			'data' => null,
			'meta' =>
			[
				'input' => \dash\app::request(),
			]
		];

		$id = \dash\app::request('id');
		$id = \dash\coding::decode($id);

		if(!$id || !is_numeric($id))
		{
			\dash\app::log('api:product:method:put:id:not:set', \lib\user::id(), $log_meta);
			if($_option['debug']) \lib\notif::error(T_("Id not set"));
			return false;
		}

		if(!\lib\store::id())
		{
			\dash\app::log('api:product:edit:store:id:not:set', \lib\user::id(), $log_meta);
			if($_option['debug']) \lib\notif::error(T_("Id not set"));
			return false;
		}

		$load_product = \lib\db\products::get(['id' => $id, 'store_id' => \lib\store::id(), 'limit' => 1]);

		if(empty($load_product) || !$load_product || !isset($load_product['id']))
		{
			\dash\app::log('api:product:edit:product:not:found', \lib\user::id(), $log_meta);
			if($_option['debug']) \lib\notif::error(T_("Can not access to edit it"), 'product', 'permission');
			return false;
		}

		$args = self::check($_option);

		if($args === false || !\lib\engine\process::status())
		{
			return false;
		}

		if(!\dash\app::isset_request('title'))          unset($args['title']);
		if(!\dash\app::isset_request('name'))           unset($args['name']);
		if(!\dash\app::isset_request('cat'))            unset($args['cat']);
		if(!\dash\app::isset_request('slug'))           unset($args['slug']);
		if(!\dash\app::isset_request('company'))        unset($args['company']);
		if(!\dash\app::isset_request('shortcode'))      unset($args['shortcode']);
		if(!\dash\app::isset_request('unit'))           unset($args['unit']);
		if(!\dash\app::isset_request('barcode'))        unset($args['barcode']);
		if(!\dash\app::isset_request('barcode2'))       unset($args['barcode2']);
		if(!\dash\app::isset_request('buyprice'))       unset($args['buyprice']);
		if(!\dash\app::isset_request('price'))          unset($args['price']);
		if(!\dash\app::isset_request('discount'))       unset($args['discount']);
		if(!\dash\app::isset_request('vat') )           unset($args['vat']);
		if(!\dash\app::isset_request('initialbalance')) unset($args['initialbalance']);
		if(!\dash\app::isset_request('minstock'))       unset($args['minstock']);
		if(!\dash\app::isset_request('maxstock'))       unset($args['maxstock']);
		if(!\dash\app::isset_request('status'))         unset($args['status']);
		if(!\dash\app::isset_request('sold'))           unset($args['sold']);
		if(!\dash\app::isset_request('stock'))          unset($args['stock']);
		if(!\dash\app::isset_request('service'))        unset($args['service']);
		if(!\dash\app::isset_request('saleonline'))     unset($args['saleonline']);
		if(!\dash\app::isset_request('salestore'))      unset($args['salestore']);
		if(!\dash\app::isset_request('carton'))         unset($args['carton']);
		if(!\dash\app::isset_request('code'))           unset($args['code']);
		if(!\dash\app::isset_request('checkstock'))     unset($args['checkstock']);
		if(!\dash\app::isset_request('desc'))           unset($args['desc']);

		if(array_key_exists('title', $args) && !$args['title'])
		{
			\dash\app::log('api:product:title:not:set:edit', \lib\user::id(), $log_meta);
			if($_option['debug']) \lib\notif::error(T_("Title of product can not be null"), 'title');
			return false;
		}

		// check archive of price if price or discount or buyprice sended
		if(array_key_exists('price', $args) || array_key_exists('discount', $args) || array_key_exists('buyprice', $args))
		{
			self::buyprice_check($load_product['id'], $args);
		}

		if(array_key_exists('barcode', $args) && $args['barcode'] != '')
		{
			$args['barcode'] = "$args[barcode]";
		}

		if(array_key_exists('barcode2', $args) && $args['barcode2'] != '')
		{
			$args['barcode2'] = "$args[barcode2]";
		}

		if(!empty($args))
		{
			$update = \lib\db\products::update($args, $load_product['id']);

			if(isset($args['slug']))
			{
				if(!$update)
				{
					$args['slug'] = self::slug_fix($args);
					$update = \lib\db\products::update($args, $load_product['id']);
				}
				// user change slug
				if($load_product['slug'] != $args['slug'])
				{
					\dash\app::log('api:product:change:slug', \lib\user::id(), $log_meta);
				}
			}
		}

		$return = [];

		if(\lib\engine\process::status())
		{
			\lib\notif::ok(T_("Your product successfully updated"));
		}

		self::clean_cache('var');

		return $return;
	}
}
?>
