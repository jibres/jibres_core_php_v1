<?php
namespace lib\app\product;


class edit
{
	public static function out_of_stock($_id)
	{
		$update = \lib\db\products\update::record(['instock' => 'no'], $_id);
	}

	public static function in_stock($_id)
	{
		$update = \lib\db\products\update::record(['instock' => 'yes'], $_id);
	}



	public static function whole_edit($_args, $_id)
	{
		$id = \dash\validate::id($_id);


		$ids = array_keys($_args);
		$ids = array_filter($ids);
		$ids = array_unique($ids);
		if(!$ids)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$check_all_is_child = \lib\db\products\get::check_all_is_child($id, implode(',', $ids));
		if(!$check_all_is_child)
		{
			\dash\notif::error(T_("Some detail is wrong!"));
			return false;
		}

		if($check_all_is_child && is_numeric($check_all_is_child) && floatval($check_all_is_child) != count($ids))
		{
			\dash\notif::error(T_("Some detail is wrong!"));
			return false;
		}

		$productHasChange = false;

		foreach ($_args as $key => $value)
		{
			self::edit($value, $key, ['multi_edit' => true]);

			if(\dash\temp::get('productHasChange'))
			{
				$productHasChange = true;
			}

			if(!\dash\engine\process::status())
			{
				return false;
			}
			else
			{
				\dash\notif::clean();
			}
		}

		\dash\temp::set('productHasChange', $productHasChange);
		\dash\temp::set('productNoChangeNotRedirect', false);
		return true;

	}

	public static function edit($_args, $_id, $_option = [])
	{
		\dash\permission::access('productEdit');

		$default_option =
		[
			'debug'       => true,
			'multi_add'   => false,
			'transaction' => false,
			'multi_edit'  => false,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);


		if(!\lib\store::id())
		{
			if($_option['debug'])
			{
				\dash\notif::error(T_("Store not found"));
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

		$args = \lib\app\product\check::variable($_args, $id, $_option);

		if(!$args || !\dash\engine\process::status())
		{
			return false;
		}


		if(is_numeric($args['price']) || is_numeric($args['discount']) || is_numeric($args['buyprice']))
		{
			// check archive of price if price or discount or buyprice sended
			\lib\app\product\updateprice::check($id, $args);

			// to not remove in patch_mode function
			$_args['discountpercent'] = $args['discountpercent'];
			$_args['finalprice']      = $args['finalprice'];
			$_args['vatprice']        = $args['vatprice'];
		}


		$args = \dash\cleanse::patch_mode($_args, $args);


		if(array_key_exists('unit', $args))
		{
			if($args['unit'])
			{
				\lib\app\product\unit::$debug = false;
				$add_unit                     = \lib\app\product\unit::check_add($args['unit']);
				if(isset($add_unit['id']))
				{
					$args['unit_id'] = $add_unit['id'];
				}
			}
			else
			{
				$args['unit_id'] = null;
			}
		}

		unset($args['unit']);

		if(array_key_exists('unit_id', $args))
		{
			if($args['unit_id'])
			{
				\lib\app\product\unit::$debug = false;
				$check_unit                     = \lib\app\product\unit::inline_get($args['unit_id']);
				if(isset($check_unit['id']))
				{
					$args['unit_id'] = $check_unit['id'];
				}
			}
		}


		if(array_key_exists('company', $args))
		{
			if($args['company'])
			{
				\lib\app\product\company::$debug = false;
				$add_company                     = \lib\app\product\company::check_add($args['company']);
				if(isset($add_company['id']))
				{
					$args['company_id'] = $add_company['id'];
				}
			}
			else
			{
				$args['company_id'] = null;
			}
		}

		unset($args['company']);

		if(array_key_exists('company_id', $args))
		{
			if($args['company_id'])
			{
				\lib\app\product\company::$debug = false;
				$check_company                     = \lib\app\product\company::inline_get($args['company_id']);
				if(isset($check_company['id']))
				{
					$args['company_id'] = $check_company['id'];
				}
			}
		}


		if(array_key_exists('tag', $args))
		{
			\lib\app\product\tag::add($args['tag'], $id);
			if(!\dash\engine\process::status())
			{
				return false;
			}
		}


		if(array_key_exists('cat', $args))
		{

			\lib\app\category\add::product_cat($args['cat'], $id);
			if(!\dash\engine\process::status())
			{
				return false;
			}


		}

		unset($args['tag']);
		unset($args['cat']);

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

		// the parent
		// if the product have child the type of product locked!
		if(isset($product_detail['variant_child']) && $product_detail['variant_child'])
		{
			// unset($args['desc']);
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

		if(array_key_exists('title', $args) && !$args['title'] && $args['title'] !== '0')
		{
			\dash\notif::error(T_("Title of product can not be null"), 'title');
			return false;
		}



		$stock = null;
		if(isset($args['stock']))
		{
			$stock = $args['stock'];
		}

		unset($args['stock']);


		if($stock !== null)
		{
			\dash\temp::set('productHasChange', true);

			\lib\app\product\inventory::manual($stock, $id);
		}

		if(isset($args['trackquantity']) && $args['trackquantity'] === 'yes')
		{
			if(\lib\app\product\inventory::get($id) > 0)
			{
				\lib\app\product\edit::in_stock($id);
			}
			else
			{
				\lib\app\product\edit::out_of_stock($id);
			}
		}

		if(isset($args['trackquantity']) && $args['trackquantity'] === 'no')
		{
			\lib\app\product\edit::in_stock($id);
		}

		if(isset($args['status']) && $args['status'])
		{
			if($args['status'] === 'available')
			{
				\lib\app\product\edit::in_stock($id);
			}
			else
			{
				\lib\app\product\edit::out_of_stock($id);
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