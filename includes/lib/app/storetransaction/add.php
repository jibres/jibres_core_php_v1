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
		// start transaction of db
		\dash\db::transaction();

		\dash\app::variable($_args);

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
				'input' => \dash\app::request(),
			]
		];

		if(!\dash\user::id())
		{
			\dash\app::log('api:storetransaction:user_id:notfound', null, $log_meta);
			if($_option['debug']) \dash\notif::error(T_("User not found"), 'user');
			\dash\db::rollback();
			return false;
		}

		if(!\lib\store::id())
		{
			\dash\app::log('api:storetransaction:store_id:notfound', null, $log_meta);
			if($_option['debug']) \dash\notif::error(T_("Store not found"), 'subdomain');
			\dash\db::rollback();
			return false;
		}

		// check args
		$args = self::check($_option);

		if($args === false || !\dash\engine\process::status())
		{
			\dash\db::rollback();
			return false;
		}

		$args['store_id'] = \lib\store::id();

		$storetransaction_id = \lib\db\storetransactions::insert($args);

		if(!$storetransaction_id)
		{
			\dash\db::rollback();
			\dash\notif::error(T_("No way to insert this transaction"));
			return false;
		}

		\dash\db::commit();

		$return = [];

		$return['storetransaction_id'] = \dash\coding::encode($storetransaction_id);

		if(\dash\engine\process::status())
		{
			\dash\notif::ok(T_("Transaction successfuly saved"));
		}

		return $return;
	}
}
?>
