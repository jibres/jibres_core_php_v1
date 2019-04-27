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
	public static function edit($_args, $_id, $_option = [])
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

		$id = \dash\coding::decode($_id);

		if(!$id || !is_numeric($id))
		{
			\dash\notif::error(T_("Id not set"));
			return false;
		}

		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Id not set"));
			return false;
		}

		if(!\lib\userstore::in_store())
		{
			\dash\notif::error(T_("You are not in this store"), 'subdomain');
			return false;
		}

		$load_product = \lib\db\products::get(['id' => $id, 'store_id' => \lib\store::id(), 'limit' => 1]);

		if(empty($load_product) || !$load_product || !isset($load_product['id']))
		{
			\dash\notif::error(T_("Can not access to edit it"), 'product', 'permission');
			return false;
		}

		$args = self::check($id);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		if(!\dash\app::isset_request('title'))          unset($args['title']);
		if(!\dash\app::isset_request('name'))           unset($args['name']);

		if(!\dash\app::isset_request('cat'))
		{
		    unset($args['cat']);
		    unset($args['cat_id']);
		}

		if(!\dash\app::isset_request('slug'))           unset($args['slug']);
		if(!\dash\app::isset_request('company'))        unset($args['company']);
		if(!\dash\app::isset_request('shortcode'))      unset($args['shortcode']);
		if(!\dash\app::isset_request('unit'))           unset($args['unit']);
		if(!\dash\app::isset_request('barcode'))        unset($args['barcode']);
		if(!\dash\app::isset_request('barcode2'))       unset($args['barcode2']);
		if(!\dash\app::isset_request('buyprice'))       unset($args['buyprice']);
		if(!\dash\app::isset_request('price'))          unset($args['price']);
		if(!\dash\app::isset_request('discount'))       unset($args['discount']);
		if(!\dash\app::isset_request('discount'))       unset($args['discountpercent']);
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
		if(!\dash\app::isset_request('quickcode'))      unset($args['quickcode']);
		if(!\dash\app::isset_request('checkstock'))     unset($args['checkstock']);
		if(!\dash\app::isset_request('desc'))           unset($args['desc']);
		if(!\dash\app::isset_request('scalecode'))      unset($args['scalecode']);
		if(!\dash\app::isset_request('thumb'))          unset($args['thumb']);
		if(!\dash\app::isset_request('salesite')) 		unset($args['salesite']);
		if(!\dash\app::isset_request('saletelegram')) 	unset($args['saletelegram']);
		if(!\dash\app::isset_request('saleapp')) 		unset($args['saleapp']);
		if(!\dash\app::isset_request('salephysical')) 	unset($args['salephysical']);
		if(!\dash\app::isset_request('weight'))		 	unset($args['weight']);
		if(!\dash\app::isset_request('infinite'))		 	unset($args['infinite']);




		if(array_key_exists('title', $args) && !$args['title'])
		{
			\dash\notif::error(T_("Title of product can not be null"), 'title');
			return false;
		}

		// check archive of price if price or discount or buyprice sended
		if(array_key_exists('price', $args) || array_key_exists('discount', $args) || array_key_exists('buyprice', $args))
		{
			\lib\app\product\buyprice::check($load_product['id'], $args);
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
			if(!$update)
			{
				\dash\notif::error(T_("Can not update product, try again"));
			}
		}

		$return = [];

		if(\dash\engine\process::status())
		{
			\dash\notif::ok(T_("Your product successfully updated"));
			\lib\app\product\dashboard::clean_cache('var');
		}

		return $return;
	}
}
?>
