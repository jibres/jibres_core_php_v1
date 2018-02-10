<?php
namespace lib\app\product;
use \lib\debug;


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
			if($_option['debug']) debug::error(T_("Id not set"));
			return false;
		}

		if(!\lib\store::id())
		{
			\lib\app::log('api:product:edit:store:id:not:set', \lib\user::id(), $log_meta);
			if($_option['debug']) debug::error(T_("Id not set"));
			return false;
		}

		$load_product = \lib\db\products::get(['id' => $id, 'store_id' => \lib\store::id(), 'limit' => 1]);

		if(empty($load_product) || !$load_product || !isset($load_product['id']))
		{
			\lib\app::log('api:product:edit:product:not:found', \lib\user::id(), $log_meta);
			if($_option['debug']) debug::error(T_("Can not access to edit it"), 'product', 'permission');
			return false;
		}

		$args = self::check($_option);

		if($args === false || !\lib\debug::$status)
		{
			return false;
		}

		if(!\lib\app::isset_request('title'))          unset($args['title']);
		if(!\lib\app::isset_request('name'))           unset($args['name']);
		if(!\lib\app::isset_request('cat'))            unset($args['cat']);
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
		if(!\lib\app::isset_request('saleonline'))     unset($args['saleonline']);
		if(!\lib\app::isset_request('salestore'))      unset($args['salestore']);
		if(!\lib\app::isset_request('carton'))         unset($args['carton']);
		if(!\lib\app::isset_request('code'))           unset($args['code']);
		if(!\lib\app::isset_request('checkstock'))     unset($args['checkstock']);
		if(!\lib\app::isset_request('desc'))           unset($args['desc']);

		if(array_key_exists('title', $args) && !$args['title'])
		{
			\lib\app::log('api:product:title:not:set:edit', \lib\user::id(), $log_meta);
			if($_option['debug']) debug::error(T_("Title of product can not be null"), 'title');
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
					\lib\app::log('api:product:change:slug', \lib\user::id(), $log_meta);
				}
			}
		}

		$return = [];

		if(\lib\debug::$status)
		{
			\lib\debug::true(T_("Your product successfully updated"));
		}

		self::clean_cache('var');

		return $return;
	}
}
?>
