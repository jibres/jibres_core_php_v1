<?php
namespace lib\app\product;


class add
{
	public static function for_import($_args, $_overwrite = [])
	{
		\dash\db::transaction();

		foreach ($_args as $key => $value)
		{
			if(isset($value['id']) && is_numeric($value['id']))
			{
				if(in_array(intval($value['id']), $_overwrite))
				{
					$result = \lib\app\product\edit::edit($value, $value['id'], ['debug' => false, 'multi_add' => true, 'transaction' => true]);
				}
				else
				{
					$result = self::add($value, ['debug' => false, 'multi_add' => true, 'transaction' => true]);
				}
			}
			else
			{
				$result = self::add($value, ['debug' => false, 'multi_add' => true, 'transaction' => true]);
			}

			if(!\dash\engine\process::status())
			{
				\dash\db::rollback();
				return false;
			}
		}

		\dash\db::commit();

		return true;
	}

	public static function multi_add($_args)
	{
		\dash\db::transaction();

		foreach ($_args as $key => $value)
		{
			$result = self::add($value, ['debug' => false, 'multi_add' => true, 'transaction' => true]);
			if(!\dash\engine\process::status())
			{
				\dash\db::rollback();
				return false;
			}
		}

		\dash\db::commit();

		return true;
	}

	/**
	 * add new product
	 *
	 * @param      array          $_args  The arguments
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function add($_args, $_option = [])
	{
		\dash\permission::access('productAdd');


		if(!\lib\store::id())
		{
			if($_option['debug'])
			{
				\dash\notif::error(T_("Store not found"));
			}
			return false;
		}

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


		$args = \lib\app\product\check::variable($_args, null, $_option);

		if(!$args || !\dash\engine\process::status())
		{
			return false;
		}


		$args['datecreated'] = date("Y-m-d H:i:s");

		if(!isset($args['status']) || (isset($args['status']) && !$args['status']))
		{
			$args['status']  = 'available';
		}

		if(!$_option['multi_add'])
		{
			if(!isset($args['title']) || (isset($args['title']) && !$args['title']))
			{
				if($_option['debug'])
				{
					\dash\notif::error(T_("Product title can not be null"), 'title');
				}
				return false;
			}
		}


		// the transaction not start. neet to statr
		if(!$_option['transaction'])
		{
			\dash\db::transaction();
		}


		if($args['unit'])
		{
			\lib\app\product\unit::$debug = false;
			$add_unit                     = \lib\app\product\unit::check_add($args['unit']);
			if(isset($add_unit['id']))
			{
				$args['unit_id'] = $add_unit['id'];
			}
		}

		unset($args['unit']);

		if($args['unit_id'])
		{
			\lib\app\product\unit::$debug = false;
			$check_unit                     = \lib\app\product\unit::inline_get($args['unit_id']);
			if(isset($check_unit['id']))
			{
				$args['unit_id'] = $check_unit['id'];
			}
		}


		if($args['company'])
		{
			\lib\app\product\company::$debug = false;
			$add_company                     = \lib\app\product\company::check_add($args['company']);
			if(isset($add_company['id']))
			{
				$args['company_id'] = $add_company['id'];
			}
		}

		unset($args['company']);

		if($args['company_id'])
		{
			\lib\app\product\company::$debug = false;
			$check_company                     = \lib\app\product\company::inline_get($args['company_id']);
			if(isset($check_company['id']))
			{
				$args['company_id'] = $check_company['id'];
			}
		}


		// if($args['cat_id'])
		// {
		// 	$load_cat = \lib\app\category\get::inline_get($args['cat_id']);
		// 	if(!isset($load_cat['id']))
		// 	{
		// 		\dash\notif::error(T_("Category not found"));
		// 		return false;
		// 	}
		// }

		$my_cat = [];
		if(array_key_exists('cat', $args))
		{
			if($args['cat'])
			{
				$my_cat = $args['cat'];
			}

		}

		$my_tag = [];
		if(array_key_exists('tag', $args))
		{
			if($args['tag'])
			{
				$my_tag = $args['tag'];
			}

		}

		unset($args['tag']);
		unset($args['cat']);

		$stock = null;
		if($args['stock'])
		{
			$stock = $args['stock'];
		}

		unset($args['stock']);


		// --------------- add new product
		$product_id = \lib\db\products\insert::new_record($args);

		if(!$product_id)
		{
			\dash\log::set('product:no:way:to:insert');
			if($_option['debug'])
			{
				\dash\notif::error(T_("No way to insert product"));
			}

			if(!$_option['transaction'])
			{
				\dash\db::rollback();
			}

			return false;
		}


		if($my_tag)
		{
			\lib\app\product\tag::add($my_tag, $product_id);
			if(!\dash\engine\process::status())
			{
				return false;
			}
		}



		if($my_cat)
		{
			\lib\app\category\add::product_cat($my_cat, $product_id);

			if(!\dash\engine\process::status())
			{
				if($_option['debug'])
				{
					\dash\notif::error(T_("No way to insert product price"));
				}

				if(!$_option['transaction'])
				{
					\dash\db::rollback();
				}

				return false;
			}
		}

		if(isset($args['infinite']) && $args['infinite'] === 'yes')
		{
			if($stock)
			{
				\lib\app\product\inventory::initial($stock, $product_id);
			}
		}


		if($args['buyprice'] ||	$args['price'] || $args['discount'])
		{
			// the product was inserted
			// set the productprice record
			$insert_productprices =
			[
				'last'            => 'yes',
				'product_id'      => $product_id,
				'creator'         => \dash\user::id(),
				'startdate'       => date("Y-m-d H:i:s"),
				'enddate'         => null,
				'buyprice'        => $args['buyprice'],
				'price'           => $args['price'],
				// 'compareatprice'  => $args['compareatprice'],
				'discount'        => $args['discount'],
				'discountpercent' => $args['discountpercent'],
				'finalprice'      => $args['finalprice'],
				'vatprice'        => $args['vatprice'],
			];

			$productprices_id = \lib\db\productprices\insert::new_record($insert_productprices);

			if(!$productprices_id)
			{
				\dash\log::set('productprice:no:way:to:insert');
				if($_option['debug'])
				{
					\dash\notif::error(T_("No way to insert product price"));
				}

				if(!$_option['transaction'])
				{
					\dash\db::rollback();
				}

				return false;
			}
		}

		$return     = [];
		$args['ok'] = true;

		if(\dash\engine\process::status())
		{
			if($_option['debug'])
			{
				\dash\notif::ok(T_("Product successfuly added"));
			}
		}

		if(!$_option['multi_add'])
		{
			$return['id']       = $product_id;
		}

		if(!$_option['transaction'])
		{
			\dash\db::commit();
		}

		return $return;
	}



	/**
	 * Create duplicate from one product
	 *
	 * @param      <type>   $_id    The identifier
	 * @param      <type>   $_args  The arguments
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function duplicate($_id, $_args)
	{
		$load = \lib\app\product\get::get($_id);
		if(!$load)
		{
			return false;
		}

		if(!isset($_args['title']) || (isset($_args['title']) && !$_args['title']))
		{
			\dash\notif::error(T_("Please set product title"), 'title');
			return false;
		}

		$load = array_merge($load, $_args);

		$check_duplicate_title = \lib\db\products\get::check_duplicate_title($load['title'], $load['id']);

		if($check_duplicate_title)
		{
			\dash\notif::error(T_("Please change the product name to copy"), 'title');
			return false;
		}

		$copy_product = [];
		foreach ($load as $key => $value)
		{
			switch ($key)
			{

				case 'title':
				case 'title2':
				case 'seotitle':
				case 'discount':
				case 'price':
				case 'buyprice':
				case 'seodesc':
				case 'desc':
				case 'cat_id':
				case 'unit_id':
				case 'company_id':
				case 'salestep':
				case 'minstock':
				case 'maxstock':
				case 'minsale':
				case 'maxsale':
				case 'carton':
				case 'scalecode':
				case 'weight':
				case 'length':
				case 'width':
				case 'height':
				case 'filesize':
				case 'fileaddress':
				case 'type':
				case 'status':
				case 'vat':
				case 'infinite':
				case 'oversale':
				case 'saleonline':
				case 'saletelegram':
				case 'saleapp':
					$copy_product[$key] = $value;
					break;

				default:
					// skip othe field
					break;
			}
		}

		$result = \lib\app\product\add::add($copy_product);

		return $result;

	}
}
?>