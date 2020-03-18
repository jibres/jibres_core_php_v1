<?php
namespace lib\app\factor;


class edit
{
	/**
	 * edit a factor
	 *
	 * @param      <type>   $_factor  The arguments
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function edit($_id, $_factor, $_factor_detail, $_option = [])
	{
		\dash\notif::errot('Not ready');
		return;

		// $default_option =
		// [
		// 	'debug' => true,
		// ];

		// if(!is_array($_option))
		// {
		// 	$_option = [];
		// }

		// $_option = array_merge($default_option, $_option);

		// \dash\app::variable($_factor);

		// $log_meta =
		// [
		// 	'data' => null,
		// 	'meta' =>
		// 	[
		// 		'input' => \dash\app::request(),
		// 	]
		// ];

		// $id = \dash\coding::decode($_id);

		// if(!$id || !is_numeric($id))
		// {
		// 	\dash\app::log('api:factor:method:put:id:not:set', \dash\user::id(), $log_meta);
		// 	if($_option['debug']) \dash\notif::error(T_("Id not set"));
		// 	return false;
		// }

		// if(!\lib\store::id())
		// {
		// 	\dash\app::log('api:factor:edit:store:id:not:set', \dash\user::id(), $log_meta);
		// 	if($_option['debug']) \dash\notif::error(T_("Id not set"));
		// 	return false;
		// }

		// if(!\lib\store::in_store())
		// {
		// 	\dash\notif::error(T_("You are not in this store"));
		// 	return false;
		// }

		// $load_factor = \lib\db\factors::get(['id' => $id, 'store_id' => \lib\store::id(), 'limit' => 1]);

		// if(empty($load_factor) || !$load_factor || !isset($load_factor['id']))
		// {
		// 	\dash\app::log('api:factor:edit:factor:not:found', \dash\user::id(), $log_meta);
		// 	if($_option['debug']) \dash\notif::error(T_("Can not access to edit it"), 'factor', 'permission');
		// 	return false;
		// }

		// \lib\db\factordetails::remove_factor($load_factor['id']);

		// $return = \lib\app\factor::add($_factor, $_factor_detail, ['factor_id' => $load_factor['id'], 'debug' => false]);

		// if(\dash\engine\process::status())
		// {
		// 	\dash\notif::ok(T_("Your factor successfully updated"));
		// }

		// return $return;
	}
}
?>
