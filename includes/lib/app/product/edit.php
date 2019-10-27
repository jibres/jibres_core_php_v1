<?php
namespace lib\app\product;


class edit
{

	public static function edit($_args, $_id, $_option = [])
	{
		$default_option =
		[
			'debug'       => true,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);

		\dash\app::variable($_args, \lib\app\product\check::variable_args());

		if(!\dash\user::id())
		{
			if($_option['debug'])
			{
				\dash\notif::error(T_("User not found"));
			}
			return false;
		}

		if(!\lib\store::id())
		{
			if($_option['debug'])
			{
				\dash\notif::error(T_("Store not found"));
			}
			return false;
		}

		// if(!\lib\userstore::in_store())
		// {
		// 	\dash\notif::error(T_("You are not in this store"));
		// 	return false;
		// }

		$product_detail = \lib\app\product\get::inline_get($_id);
		if(!$product_detail || !isset($product_detail['id']))
		{
			\dash\notif::error(T_("Invalid product id"));
			return false;
		}

		$_option['product_detail'] = $product_detail;
		$id = $product_detail['id'];

		$args = \lib\app\product\check::variable($id, $_option);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		if(!\dash\app::isset_request('title')) unset($args['title']);
		if(!\dash\app::isset_request('slug')) unset($args['slug']);
		if(!\dash\app::isset_request('barcode')) unset($args['barcode']);
		if(!\dash\app::isset_request('barcode2')) unset($args['barcode2']);
		if(!\dash\app::isset_request('minstock')) unset($args['minstock']);
		if(!\dash\app::isset_request('maxstock')) unset($args['maxstock']);
		if(!\dash\app::isset_request('weight')) unset($args['weight']);
		if(!\dash\app::isset_request('status')) unset($args['status']);
		if(!\dash\app::isset_request('thumbid')) unset($args['thumbid']);
		if(!\dash\app::isset_request('vat')) unset($args['vat']);
		if(!\dash\app::isset_request('saleonline')) unset($args['saleonline']);
		if(!\dash\app::isset_request('carton')) unset($args['carton']);
		if(!\dash\app::isset_request('desc')) unset($args['desc']);
		if(!\dash\app::isset_request('saletelegram')) unset($args['saletelegram']);
		if(!\dash\app::isset_request('saleapp')) unset($args['saleapp']);
		if(!\dash\app::isset_request('infinite')) unset($args['infinite']);
		if(!\dash\app::isset_request('parent')) unset($args['parent']);
		if(!\dash\app::isset_request('scalecode')) unset($args['scalecode']);
		if(!\dash\app::isset_request('optionname1')) unset($args['optionname1']);
		if(!\dash\app::isset_request('optionvalue1')) unset($args['optionvalue1']);
		if(!\dash\app::isset_request('optionname2')) unset($args['optionname2']);
		if(!\dash\app::isset_request('optionvalue2')) unset($args['optionvalue2']);
		if(!\dash\app::isset_request('optionname3')) unset($args['optionname3']);
		if(!\dash\app::isset_request('optionvalue3')) unset($args['optionvalue3']);
		if(!\dash\app::isset_request('sku')) unset($args['sku']);
		if(!\dash\app::isset_request('seotitle')) unset($args['seotitle']);
		if(!\dash\app::isset_request('seodesc')) unset($args['seodesc']);
		if(!\dash\app::isset_request('salestep')) unset($args['salestep']);
		if(!\dash\app::isset_request('minsale')) unset($args['minsale']);
		if(!\dash\app::isset_request('maxsale')) unset($args['maxsale']);
		if(!\dash\app::isset_request('weightunit')) unset($args['weightunit']);
		if(!\dash\app::isset_request('type')) unset($args['type']);
		if(!\dash\app::isset_request('gallery')) unset($args['gallery']);
		if(!\dash\app::isset_request('oversale')) unset($args['oversale']);

		if(array_key_exists('title', $args) && !$args['title'] && $args['title'] !== '0')
		{
			\dash\notif::error(T_("Title of product can not be null"), 'title');
			return false;
		}

		$args_price = \lib\app\product\check::price($id, $_option);
		if($args_price === false || !\dash\engine\process::status())
		{
			return false;
		}

		if(!\dash\app::isset_request('price')) unset($args['price']);
		if(!\dash\app::isset_request('discount')) unset($args['discount']);
		if(!\dash\app::isset_request('buyprice')) unset($args['buyprice']);

		// check archive of price if price or discount or buyprice sended
		if(array_key_exists('price', $args_price) || array_key_exists('discount', $args_price) || array_key_exists('buyprice', $args_price))
		{
			\lib\app\product\updateprice::check($id, $args_price);
		}


		$unit = \dash\app::request('unit');
		if($unit)
		{
			\lib\app\product\unit::$debug = false;
			$add_unit                     = \lib\app\product\unit::check_add($unit);
			if(isset($add_unit['id']))
			{
				$args['unit_id'] = $add_unit['id'];
			}

		}

		$company = \dash\app::request('company');
		if($company)
		{
			\lib\app\product\company::$debug = false;
			$add_company                     = \lib\app\product\company::check_add($company);
			if(isset($add_company['id']))
			{
				$args['company_id'] = $add_company['id'];
			}
		}

		$category = \dash\app::request('category');
		if($category)
		{
			\lib\app\product\category::$debug = false;
			$add_category                     = \lib\app\product\category::check_add($category);
			if(isset($add_category['id']))
			{
				$args['cat_id'] = $add_category['id'];
			}
		}


		$tag = \dash\app::request('tag');
		if($tag)
		{
			\lib\app\product\tag::add($tag, $id, \lib\store::id());
			if(!\dash\engine\process::status())
			{
				return false;
			}
		}


		if(!empty($args))
		{
			foreach ($args as $key => $value)
			{
				if(array_key_exists($key, $product_detail) && self::isEqual($product_detail[$key], $value))
				{
					unset($args[$key]);
				}
			}

			if(!empty($args))
			{
				$update = \lib\db\products\db::update($args, $id);
				if(!$update)
				{
					\dash\log::set('productUpdateDbError', ['code' => $id]);
					\dash\notif::error(T_("Can not update product"));
					return false;
				}

				if(\dash\engine\process::status())
				{
					\dash\notif::ok(T_("Your product successfully updated"));
				}
			}
			else
			{
				// no change
				\dash\notif::info(T_("Your product saved without change"));
			}
		}
		else
		{
			\dash\notif::warn(T_("No value found for editing"));
		}

		return true;
	}


	private static function isEqual($_a, $_b)
	{
		if($_a === $_b)
		{
			return true;
		}

		if((string) $_a == (string) $_b)
		{
			return true;
		}

		if(($_a == '' || is_null($_a) || $_a == null) && ($_b == '' || is_null($_b) || $_b == null))
		{
			return true;
		}

		return false;
	}
}
?>