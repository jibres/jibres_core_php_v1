<?php
namespace lib\app\product;


class add
{

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

		$args = \lib\app\product\check::variable(null, $_option);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$args_price = \lib\app\product\check::price(null, $_option);
		if($args_price === false || !\dash\engine\process::status())
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

		if(array_filter($args_price))
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
				'buyprice'        => $args_price['buyprice'],
				'price'           => $args_price['price'],
				'compareatprice'  => $args_price['compareatprice'],
				'discount'        => $args_price['discount'],
				'discountpercent' => $args_price['discountpercent'],
				'finalprice'      => $args_price['finalprice'],
				'vatprice'        => $args_price['vatprice'],
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


	public static function duplicate($_id, $_args)
	{
		$load = \lib\app\product\get::inline_get($_id);
		if(!$load)
		{
			return false;
		}

		\dash\app::variable($_args);

		$args = \lib\app\product\check::variable();

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$copy_product = [];
		foreach ($load as $key => $value)
		{
			switch ($key)
			{
				case 'id':
				case 'variants':
				case 'barcode':
				case 'barcode2':
				case 'sku':
				case 'datemodified':
				case 'datecreated':
				case 'slug':
					break;

				case 'title':
					$copy_product[$key] = $args['title'];
					break;

				default:
					$copy_product[$key] = $value;
					break;
			}
		}

		\dash\notif::warn("Not ready!");
		return false;

		j($copy_product);

	}
}
?>