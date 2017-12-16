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
		\lib\db::transaction();

		$default_option =
		[
			'debug'     => true,
			'factor_id' => null,
			'type'      => 'sell',
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
				'input' => \lib\app::request(),
			]
		];

		if(!\lib\user::id())
		{
			\lib\app::log('api:factor:user_id:notfound', null, $log_meta);
			if($_option['debug']) \lib\debug::error(T_("User not found"), 'user');
			\lib\db::rollback();
			return false;
		}

		if(!\lib\store::id())
		{
			\lib\app::log('api:factor:store_id:notfound', null, $log_meta);
			if($_option['debug']) \lib\debug::error(T_("Store not found"), 'subdomain');
			\lib\db::rollback();
			return false;
		}

		\lib\app::variable($_factor);
		// check args
		$factor = self::check_factor($_option);

		if($factor === false || !\lib\debug::$status)
		{
			\lib\db::rollback();
			return false;
		}

		$factor['store_id'] = \lib\store::id();


		\lib\app::variable($_factor_detail);
		$factor_detail = self::check_factor_detail($_option);

		if($factor_detail === false || !\lib\debug::$status)
		{
			\lib\db::rollback();
			return false;
		}

		$return = [];

		$factor['type']           = $_option['type'];
		$factor['detailsum']      = array_sum(array_column($factor_detail, 'price'));
		$factor['detaildiscount'] = array_sum(array_column($factor_detail, 'discount'));;
		$factor['detailtotalsum'] = array_sum(array_column($factor_detail, 'sum'));;
		$factor['detailcount']    = array_sum(array_column($factor_detail, 'count'));;
		$factor['vat']            = null;
		$factor['discount']       = null;
		$factor['sum']            = floatval($factor['detailtotalsum']) - floatval($factor['discount']);

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
			\lib\app::log('api:factor:no:way:to:insert:factor', \lib\user::id(), $log_meta);
			if($_option['debug']) \lib\debug::error(T_("No way to insert factor"), 'db', 'system');
			\lib\db::rollback();
			return false;
		}

		$return['factor_id'] = \lib\utility\shortURL::encode($factor_id);

		foreach ($factor_detail as $key => $value)
		{
			$factor_detail[$key]['factor_id'] = $factor_id;
		}

		$add_detail = \lib\db\factordetails::multi_insert($factor_detail);

		if(!$add_detail)
		{
			\lib\db::rollback();
		}

		if(\lib\debug::$status)
		{
			\lib\db::commit();
			if($_option['debug']) \lib\debug::true(T_("Factor successfuly added"));
		}

		return $return;
	}
}
?>
