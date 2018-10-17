<?php
namespace lib\app\storetransaction;


class account
{

	/**
	 * add new storetransaction
	 *
	 * @param      array          $_args  The arguments
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function charge($_args, $_option = [])
	{
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


		if(!\dash\user::id())
		{
			\dash\notif::error(T_("User not found"), 'user');
			return false;
		}

		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"), 'subdomain');
			return false;
		}

		if(!\lib\userstore::in_store())
		{
			\dash\notif::error(T_("You are not in this store"), 'subdomain');
			return false;
		}

		// check args
		$args = \lib\app\storetransaction::check($_option);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$args['store_id'] = \lib\store::id();

		$storetransaction_id = \lib\db\storetransactions::insert($args);

		if(!$storetransaction_id)
		{
			\dash\notif::error(T_("No way to insert this transaction"));
			return false;
		}

		$return = [];

		$return['storetransaction_id'] = \dash\coding::encode($storetransaction_id);

		// if(\dash\engine\process::status())
		// {
		// 	\dash\notif::ok(T_("Transaction successfuly saved"));
		// }

		return $return;
	}
}
?>
