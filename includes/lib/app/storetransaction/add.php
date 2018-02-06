<?php
namespace lib\app\storetransaction;


trait add
{

	/**
	 * add new storetransaction
	 *
	 * @param      array          $_args  The arguments
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function add($_args, $_option = [])
	{
		$default_option =
		[
			'debug'     => true,
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
			\lib\app::log('api:storetransaction:user_id:notfound', null, $log_meta);
			if($_option['debug']) \lib\debug::error(T_("User not found"), 'user');
			\lib\db::rollback();
			return false;
		}

		if(!\lib\store::id())
		{
			\lib\app::log('api:storetransaction:store_id:notfound', null, $log_meta);
			if($_option['debug']) \lib\debug::error(T_("Store not found"), 'subdomain');
			\lib\db::rollback();
			return false;
		}

		\lib\app::variable($_storetransaction);
		// check args
		$args = self::check($_option);

		if($args === false || !\lib\debug::$status)
		{
			\lib\db::rollback();
			return false;
		}

		$args['store_id'] = \lib\store::id();

		$storetransaction_id = \lib\db\storetransactions::insert($args);


		if(!$storetransaction_id)
		{
			\lib\debug::error(T_("No way to insert this transaction"));
			return false;
		}

		$return = [];
		$return['storetransaction_id'] = \lib\utility\shortURL::encode($storetransaction_id);

		if(\lib\debug::$status)
		{
			\lib\debug::true(T_("Transaction successfuly saved"));
		}

		return $return;
	}
}
?>
