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
		// start transaction of db
		\dash\db::transaction();

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
			\dash\app::log('api:factor:user_id:notfound', null, $log_meta);
			if($_option['debug']) \dash\notif::error(T_("User not found"), 'user');
			\dash\db::rollback();
			return false;
		}

		if(!\lib\store::id())
		{
			\dash\app::log('api:factor:store_id:notfound', null, $log_meta);
			if($_option['debug']) \dash\notif::error(T_("Store not found"), 'subdomain');
			\dash\db::rollback();
			return false;
		}

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

		foreach ($factor_detail as $key => $value)
		{
			$sum                      = (floatval($value['price']) * floatval($value['count']));
			$discount                 = (floatval($value['discount']) * floatval($value['count']));
			$factor['detailsum']      += $sum;
			$factor['detaildiscount'] += $discount;
			$factor['detailtotalsum'] += $sum - $discount;
		}

		$factor['qty']      = array_sum(array_column($factor_detail, 'count'));
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
		}

		if(\dash\engine\process::status())
		{
			\dash\db::commit();
			if($_option['debug']) \dash\notif::ok(T_("Factor successfuly added"));
		}

		return $return;
	}
}
?>
