<?php
namespace lib\app\factor;


class edit
{
	public static function user_cancel($_id)
	{
		$load_factor = \lib\app\factor\get::one($_id);

		if(!$load_factor)
		{
			return false;
		}

		if(array_key_exists('pay', $load_factor) && !$load_factor['pay'])
		{
			// no proble
		}
		else
		{
			\dash\notif::error(T_("This factor is payed. To cancel this order contact to administrator"));
			return false;
		}

		\lib\app\factor\action::add(['action' => 'cancel'], $load_factor['id']);
	}




	public static function status($_status, $_factor_id)
	{
		$factor_id = \lib\app\factor\get::fix_id($_factor_id);

		if(!$_status || !$factor_id)
		{
			return false;
		}

		$update =
		[
			'status'       => $_status,
			'datemodified' => date("Y-m-d H:i:s")
		];

		return \lib\db\factors\update::record($update, $factor_id);
	}

	public static function type($_type, $_factor_id)
	{
		$factor_id = \lib\app\factor\get::fix_id($_factor_id);

		if(!$_type || !$factor_id)
		{
			return false;
		}

		$update =
		[
			'type'       => $_type,
			'datemodified' => date("Y-m-d H:i:s")
		];

		return \lib\db\factors\update::record($update, $factor_id);
	}


	public static function edit_factor($_args, $_id)
	{
		$load_factor = \lib\app\factor\get::one($_id);

		if(!$load_factor)
		{
			return false;
		}

		$args = \lib\app\factor\check::factor($_args, ['factor_detail' => $load_factor]);

		$args = \dash\cleanse::patch_mode($_args, $args);

		if(empty($args))
		{
			\dash\notif::info(T_("Order save without change"));
			return true;
		}
		else
		{
			\lib\db\factors\update::record($args, $load_factor['id']);
			\dash\notif::ok(T_("Order updated"));
			return true;
		}
	}


	public static function edit_address($_args, $_factor_id)
	{
		$load_factor = \lib\app\factor\get::one($_factor_id);

		if(!$load_factor)
		{
			return false;
		}

		$condition =
		[
			'name'        => 'displayname',
			'mobile'      => 'mobile',
			'company'     => 'bit',
			'country'     => 'country',
			'province'    => 'province',
			'city'        => 'city',
			'address'     => 'address',
			'address2'    => 'address',
			'postcode'    => 'postcode',
			'phone'       => 'phone',
			'fax'         => 'phone',
		];

		$require = [];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		\lib\db\factoraddress\update::record($data, $load_factor['id']);

		\dash\notif::ok(T_("Order address was updated"));

		return true;
	}


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


		// $id = \dash\coding::decode($_id);

		// if(!$id || !is_numeric($id))
		// {
		// 	if($_option['debug']) \dash\notif::error(T_("Id not set"));
		// 	return false;
		// }

		// if(!\lib\store::id())
		// {
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
