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

		$log_meta =
		[
			'data' => null,
			'meta' =>
			[
				'input' => \lib\app::request(),
			]
		];

		$id = \lib\app::request('id');
		$id = \lib\utility\shortURL::decode($id);

		if(!$id || !is_numeric($id))
		{
			\lib\app::log('api:product:method:put:id:not:set', \lib\user::id(), $log_meta);
			debug::error(T_("Id not set"));
			return false;
		}

		if(!\lib\store::id())
		{
			\lib\app::log('api:product:edit:store:id:not:set', \lib\user::id(), $log_meta);
			debug::error(T_("Id not set"));
			return false;
		}

		$load_product = \lib\db\products::get(['id' => $id, 'store_id' => \lib\store::id(), 'limit' => 1]);

		if(empty($load_product) || !$load_product || !isset($load_product['id']))
		{
			\lib\app::log('api:product:edit:product:not:found', \lib\user::id(), $log_meta);
			debug::error(T_("Can not access to edit it"), 'product', 'permission');
			return false;
		}

		$args = self::check();

		if($args === false || !\lib\debug::$status)
		{
			return false;
		}

		if(!\lib\app::isset_request('title'))          unset($args['title']);
		if(!\lib\app::isset_request('name'))           unset($args['name']);
		if(!\lib\app::isset_request('slug'))           unset($args['slug']);
		if(!\lib\app::isset_request('company'))        unset($args['company']);
		if(!\lib\app::isset_request('shortcode'))      unset($args['shortcode']);
		if(!\lib\app::isset_request('unit'))           unset($args['unit']);
		if(!\lib\app::isset_request('barcode'))        unset($args['barcode']);
		if(!\lib\app::isset_request('barcode2'))       unset($args['barcode2']);
		if(!\lib\app::isset_request('buyprice'))       unset($args['buyprice']);
		if(!\lib\app::isset_request('price'))          unset($args['price']);
		if(!\lib\app::isset_request('discount'))       unset($args['discount']);
		if(!\lib\app::isset_request('vat') )           unset($args['vat']);
		if(!\lib\app::isset_request('initialbalance')) unset($args['initialbalance']);
		if(!\lib\app::isset_request('minstock'))       unset($args['minstock']);
		if(!\lib\app::isset_request('maxstock'))       unset($args['maxstock']);
		if(!\lib\app::isset_request('status'))         unset($args['status']);
		if(!\lib\app::isset_request('sold'))           unset($args['sold']);
		if(!\lib\app::isset_request('stock'))          unset($args['stock']);
		if(!\lib\app::isset_request('service'))        unset($args['service']);
		if(!\lib\app::isset_request('sellonline'))     unset($args['sellonline']);
		if(!\lib\app::isset_request('sellstore'))      unset($args['sellstore']);
		if(!\lib\app::isset_request('carton'))         unset($args['carton']);

		if(array_key_exists('title', $args) && !$args['title'])
		{
			\lib\app::log('api:product:title:not:set:edit', \lib\user::id(), $log_meta);
			debug::error(T_("Store title of product can not be null"), 'title');
			return false;
		}

		// check archive of price if price or discount or buyprice sended
		if(array_key_exists('price', $args) || array_key_exists('discount', $args) || array_key_exists('buyprice', $args))
		{
			self::buyprice_check($load_product['id'], $args);
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
					\lib\app::log('api:product:change:slug', \lib\user::id(), $log_meta);
				}
			}
		}

		$return = [];

		return $return;
	}
}
?>