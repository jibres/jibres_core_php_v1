<?php
namespace lib\app\factor;


trait add
{

	/**
	 * add new factor
	 *
	 * @param      array          $_args  The arguments
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function add($_factor, $_factor_detail, $_option = [])
	{

		$default_option =
		[
			'debug'     => true,
			'factor_id' => null,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);

		$log_meta =
		[
			'data' => null,
			'meta' =>
			[
				'input' => \dash\app::request(),
			]
		];

		if(!\dash\user::id())
		{
			\dash\app::log('api:factor:user_id:notfound', \dash\user::id(), $log_meta);
			if($_option['debug']) \dash\notif::error(T_("User not found"), 'user');
			return false;
		}

		if(!\lib\store::id())
		{
			\dash\app::log('api:factor:store_id:notfound', \dash\user::id(), $log_meta);
			if($_option['debug']) \dash\notif::error(T_("Store not found"), 'subdomain');
			return false;
		}

		if(!\lib\userstore::in_store())
		{
			\dash\notif::error(T_("You are not in this store"), 'subdomain');
			return false;
		}
		// start transaction of db
		\dash\db::transaction();

		\dash\app::variable($_factor);
		// check args
		$factor          = self::check_factor($_option);
		$_option['type'] = $factor['type'];

		if($factor === false || !\dash\engine\process::status())
		{
			\dash\db::rollback();
			return false;
		}

		$factor['store_id'] = \lib\store::id();

		\dash\app::variable($_factor_detail);

		$factor_detail = self::check_factor_detail($_option);

		if($factor_detail === false || !\dash\engine\process::status())
		{
			\dash\db::rollback();
			return false;
		}

		$return = [];

		$qty_sum = 0;

		foreach ($factor_detail as $key => $value)
		{
			$sum                      = (floatval($value['price']) * floatval($value['count']));
			$discount = 0;

			if(isset($value['discount']))
			{
				$discount                 = (floatval($value['discount']) * floatval($value['count']));
			}

			if(isset($value['count']))
			{
				$qty_sum                 += floatval($value['count']);
			}

			$factor['detailsum']      += $sum;
			$factor['detaildiscount'] += $discount;
			$factor['detailtotalsum'] += $sum - $discount;
		}

		// $factor['qty']      = array_sum(array_column($factor_detail, 'count'));
		$factor['qty']      = $qty_sum;
		$factor['item']     = count($factor_detail);
		$factor['vat']      = null;
		$factor['discount'] = null;
		$factor['status']   = 'draft';
		$factor['sum']      = floatval($factor['detailtotalsum']) - floatval($factor['discount']);

		if(!$_option['factor_id'])
		{
			$factor_id = \lib\db\factors::insert($factor);
		}
		else
		{
			$factor_id = $_option['factor_id'];
		}


		if(!$factor_id)
		{
			\dash\app::log('api:factor:no:way:to:insert:factor', \dash\user::id(), $log_meta);
			if($_option['debug']) \dash\notif::error(T_("No way to insert factor"), 'db', 'system');
			\dash\db::rollback();
			return false;
		}

		$return['factor_id'] = \dash\coding::encode($factor_id);

		foreach ($factor_detail as $key => $value)
		{
			$factor_detail[$key]['factor_id'] = $factor_id;
		}

		$add_detail = \lib\db\factordetails::multi_insert($factor_detail);

		if(!$add_detail)
		{
			\dash\db::rollback();
			return false;
		}

		// calc and save metafield
		if(isset($factor['customer']) && $factor['customer'] && is_numeric($factor['customer']))
		{
			if($factor['type'] === 'sale')
			{
				\lib\app\thirdparty\metafield::customer($factor['customer']);
			}
			elseif($factor['type'] === 'buy')
			{
				\lib\app\thirdparty\metafield::supplier($factor['customer']);
			}
			else
			{
				// ??
			}
		}

		if(isset($factor['seller']) && $factor['seller'] && is_numeric($factor['seller']))
		{
			\lib\app\thirdparty\metafield::staff($factor['seller'], $factor['type']);
		}

		\lib\app\thirdparty\metafield::save();


		if(\dash\engine\process::status())
		{
			\dash\db::commit();
			if($_option['debug']) \dash\notif::ok(T_("Factor successfuly added"));
		}

		return $return;
	}
}
?>
