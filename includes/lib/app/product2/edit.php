<?php
namespace lib\app\product2;


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

		$product_detail = \lib\app\product2\get::get_inline($_id);
		if(!$product_detail || !isset($product_detail['id']))
		{
			\dash\notif::error(T_("Invalid product id"));
			return false;
		}

		$_option['product_detail'] = $product_detail;
		$id = $product_detail['id'];

		$args = \lib\app\product2\check::variable($id, $_option);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$args_price = \lib\app\product2\check::price(null, $_option);
		if($args_price === false || !\dash\engine\process::status())
		{
			return false;
		}

		$args['datemodified'] = date("Y-m-d H:i:s");


		// check plan limitation
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
				'discount'        => $args_price['discount'],
				'discountpercent' => $args_price['discountpercent'],
			];

			$productprices_id = \lib\db\productprices::insert($insert_productprices);

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
			$return['product_id'] = \dash\coding::encode($product_id);
			$return['code']       = \lib\db\products2\db::get_one_field($product_id, 'code');
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