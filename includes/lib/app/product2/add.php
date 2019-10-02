<?php
namespace lib\app\product2;


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

		\lib\app\product\dashboard::clean_cache('var');

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

		\dash\app::variable($_args);


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

		if(!\lib\userstore::in_store())
		{
			\dash\notif::error(T_("You are not in this store"));
			return false;
		}


		$args = \lib\app\product2\check::variable(null, $_option);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$args['store_id']    = \lib\store::id();
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


		if(!\lib\app\plan_limit::check('product'))
		{
			return false;
		}

		// the transaction not start. neet to statr
		if(!$_option['transaction'])
		{
			\dash\db::transaction();
		}

		$product_id = \lib\db\products2\db::insert($args, \lib\store::id());

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


		// the product was inserted
		// set the productprice record
		$insert_productprices =
		[
			'product_id'      => $product_id,
			'creator'         => \dash\user::id(),
			'startdate'       => date("Y-m-d H:i:s"),
			'enddate'         => null,
			'buyprice'        => $args['buyprice'],
			'price'           => $args['price'],
			'discount'        => $args['discount'],
			'discountpercent' => $args['discountpercent'],
		];

		\lib\db\productprices::insert($insert_productprices);

		$return = [];

		$return['product_id'] = \dash\coding::encode($product_id);

		if(\dash\engine\process::status())
		{
			if($_option['debug']) \dash\notif::ok(T_("Product successfuly added"));
		}

		if(!$_option['multi_add'])
		{
			\lib\app\product\dashboard::clean_cache('var');
		}

		if(!$_option['transaction'])
		{
			\dash\db::commit();
		}

		return $return;
	}
}
?>