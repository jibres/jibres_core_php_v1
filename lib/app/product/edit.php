<?php
namespace lib\app\product;


class edit
{

	public static function edit($_args, $_id, $_option = [])
	{
		\dash\permission::access('productEdit');

		$default_option =
		[
			'debug'       => true,
			'multi_add'   => false,
			'transaction' => false,
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

		if(!\lib\store::in_store())
		{
			if($_option['debug'])
			{
				\dash\notif::error(T_("Your are not in this store!"));
			}
			return false;
		}


		$product_detail = \lib\app\product\get::inline_get($_id);
		if(!$product_detail || !isset($product_detail['id']))
		{
			\dash\notif::error(T_("Invalid product id"));
			return false;
		}

		$_option['product_detail'] = $product_detail;
		$id = $product_detail['id'];

		$isChild = false;
		// in child mode remove some setting
		if(isset($product_detail['parent']) && $product_detail['parent'])
		{
			$isChild = true;
		}

		$_option['isChild'] = $isChild;

		$args = \lib\app\product\check::variable($id, $_option);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}


		if(!\dash\app::isset_request('title')) 			unset($args['title']);
		if(!\dash\app::isset_request('slug')) 			unset($args['slug']);
		if(!\dash\app::isset_request('barcode')) 		unset($args['barcode']);
		if(!\dash\app::isset_request('barcode2')) 		unset($args['barcode2']);
		if(!\dash\app::isset_request('minstock')) 		unset($args['minstock']);
		if(!\dash\app::isset_request('maxstock')) 		unset($args['maxstock']);
		if(!\dash\app::isset_request('weight')) 		unset($args['weight']);
		if(!\dash\app::isset_request('status')) 		unset($args['status']);
		if(!\dash\app::isset_request('thumb')) 			unset($args['thumb']);
		if(!\dash\app::isset_request('vat')) 			unset($args['vat']);
		if(!\dash\app::isset_request('saleonline')) 	unset($args['saleonline']);
		if(!\dash\app::isset_request('carton')) 		unset($args['carton']);
		if(!\dash\app::isset_request('desc')) 			unset($args['desc']);
		if(!\dash\app::isset_request('saletelegram')) 	unset($args['saletelegram']);
		if(!\dash\app::isset_request('saleapp')) 		unset($args['saleapp']);
		if(!\dash\app::isset_request('infinite')) 		unset($args['infinite']);
		if(!\dash\app::isset_request('parent')) 		unset($args['parent']);
		if(!\dash\app::isset_request('scalecode')) 		unset($args['scalecode']);
		if(!\dash\app::isset_request('optionname1')) 	unset($args['optionname1']);
		if(!\dash\app::isset_request('optionvalue1')) 	unset($args['optionvalue1']);
		if(!\dash\app::isset_request('optionname2')) 	unset($args['optionname2']);
		if(!\dash\app::isset_request('optionvalue2')) 	unset($args['optionvalue2']);
		if(!\dash\app::isset_request('optionname3')) 	unset($args['optionname3']);
		if(!\dash\app::isset_request('optionvalue3')) 	unset($args['optionvalue3']);
		if(!\dash\app::isset_request('sku')) 			unset($args['sku']);
		if(!\dash\app::isset_request('seotitle')) 		unset($args['seotitle']);
		if(!\dash\app::isset_request('seodesc')) 		unset($args['seodesc']);
		if(!\dash\app::isset_request('salestep')) 		unset($args['salestep']);
		if(!\dash\app::isset_request('minsale')) 		unset($args['minsale']);
		if(!\dash\app::isset_request('maxsale')) 		unset($args['maxsale']);
		if(!\dash\app::isset_request('type')) 			unset($args['type']);
		if(!\dash\app::isset_request('gallery')) 		unset($args['gallery']);
		if(!\dash\app::isset_request('oversale')) 		unset($args['oversale']);
		if(!\dash\app::isset_request('length')) 		unset($args['length']);
		if(!\dash\app::isset_request('width')) 			unset($args['width']);
		if(!\dash\app::isset_request('height')) 		unset($args['height']);
		if(!\dash\app::isset_request('filesize')) 		unset($args['filesize']);
		if(!\dash\app::isset_request('fileaddress')) 	unset($args['fileaddress']);
		if(!\dash\app::isset_request('price')) 			unset($args['price']);
		if(!\dash\app::isset_request('discount')) 		unset($args['discount']);
		if(!\dash\app::isset_request('buyprice')) 		unset($args['buyprice']);
		if(!\dash\app::isset_request('compareatprice')) unset($args['compareatprice']);

		if(array_key_exists('title', $args) && !$args['title'] && $args['title'] !== '0')
		{
			\dash\notif::error(T_("Title of product can not be null"), 'title');
			return false;
		}

		if(\dash\app::isset_request('price') || \dash\app::isset_request('discount') || \dash\app::isset_request('buyprice') || \dash\app::isset_request('compareatprice'))
		{
			// check archive of price if price or discount or buyprice sended
			\lib\app\product\updateprice::check($id, $args);
		}


		$unit = \dash\app::request('unit');
		if($unit && is_string($unit))
		{
			\lib\app\product\unit::$debug = false;
			$add_unit                     = \lib\app\product\unit::check_add($unit);
			if(isset($add_unit['id']))
			{
				$args['unit_id'] = $add_unit['id'];
			}

		}

		if(\dash\app::isset_request('unit') && !$unit)
		{
			$args['unit_id'] = null;
		}

		$company = \dash\app::request('company');
		if($company && is_string($company))
		{
			\lib\app\product\company::$debug = false;
			$add_company                     = \lib\app\product\company::check_add($company);
			if(isset($add_company['id']))
			{
				$args['company_id'] = $add_company['id'];
			}
		}

		if(\dash\app::isset_request('company') && !$company)
		{
			$args['company_id'] = null;
		}

		$cat_id = \dash\app::request('cat_id');
		if($cat_id && !is_numeric($cat_id))
		{
			\dash\notif::error(T_("Invalid category id"));
			return false;
		}

		if($cat_id)
		{
			$load_cat = \lib\app\category\get::inline_get($cat_id);
			if(!isset($load_cat['id']))
			{
				\dash\notif::error(T_("Category not found"));
				return false;
			}
		}

		if($cat_id)
		{
			$args['cat_id'] = $cat_id;
		}

		if(\dash\app::isset_request('cat_id') && !$cat_id)
		{
			$args['cat_id'] = null;
		}


		if(\dash\app::isset_request('tag'))
		{
			$tag = \dash\app::request('tag');
			\lib\app\product\tag::add($tag, $id);
			if(!\dash\engine\process::status())
			{
				return false;
			}
		}

		if(isset($args['type']))
		{
			switch ($args['type'])
			{
				case 'product':
					// nothing
					unset($args['filesize']);
					unset($args['fileaddress']);
					break;

				case 'service':
					unset($args['filesize']);
					unset($args['fileaddress']);
					//no break!
				case 'file':
					unset($args['length']);
					unset($args['height']);
					unset($args['width']);
					unset($args['weight']);
					unset($args['minsale']);
					unset($args['maxsale']);
					unset($args['salestep']);
					unset($args['scalecode']);
					break;
			}
		}

		// if the product have child the type of product locked!
		if(isset($product_detail['variant_child']) && $product_detail['variant_child'])
		{
			unset($args['type']);
		}

		$parent_field = \lib\app\product\variants::parent_field();

		if($isChild)
		{
			foreach ($parent_field as $must_unset)
			{
				unset($args[$must_unset]);
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
				$update = \lib\db\products\update::record($args, $id);
				if(!$update)
				{
					\dash\log::set('productUpdateDbError', ['code' => $id]);
					\dash\notif::error(T_("Can not update product"));
					return false;
				}

				if(\dash\engine\process::status())
				{
					if(!$isChild)
					{
						$update_child = [];

						foreach ($parent_field as $field)
						{
							if(array_key_exists($field, $args))
							{
								$update_child[$field] = $args[$field];
							}
						}

						if(!empty($update_child))
						{
							\lib\db\products\update::variants_update_all_child($id, $update_child);
						}
					}

					if($_option['debug'])
					{
						\dash\notif::ok(T_("Your product successfully updated"));
					}
				}
			}
			else
			{
				if(\dash\temp::get('productHasChange'))
				{
					if($_option['debug'])
					{
						\dash\notif::ok(T_("Your product successfully updated"));
					}
				}
				else
				{
					\dash\temp::set('productNoChangeNotRedirect', true);
					// no change
					if($_option['debug'])
					{
						\dash\notif::info(T_("Your product saved without change"));
					}
				}
			}
		}
		else
		{
			if($_option['debug'])
			{
				\dash\notif::warn(T_("No value found for editing"));
			}
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