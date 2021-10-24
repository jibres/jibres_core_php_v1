<?php
namespace lib\app\premium;

/**
 * Add premium by admin to business
 */
class admin
{
	public static function add($_business_id, $_premium)
	{

		$business_id = \dash\validate::id($_business_id);
		$premium = \dash\validate::string_100($_premium);

		if(!$business_id || !$premium)
		{
			\dash\notif::error(T_("Business or premium is required"));
			return false;
		}

		$check = \lib\db\store_premium\get::by_business_id_premium($business_id, $premium);

		if(isset($check['id']))
		{
			if(a($check, 'status') === 'enable')
			{
				\dash\notif::error(T_("This premium already enable on this business"));
				return;
			}

			\lib\db\store_premium\update::record(['status' => 'enable', 'datemodified' => date("Y-m-d H:i:s")], a($check, 'id'));

			\dash\notif::ok(T_("Feature exist. Re Enabled"));
		}
		else
		{
			$price  = floatval(get::price($premium));

			$insert =
			[
				'store_id'    => $_business_id,
				'premium_key' => $premium,
				'zone'        => get::zone($premium),
				'status'      => 'enable',
				'addedby'     => 'admin',
				'user_id'     => \dash\user::id(),
				'price'       => $price,
				'finalprice'  => $price,
				'datecreated' => date("Y-m-d H:i:s"),
			];

			\lib\db\store_premium\insert::new_record($insert);

			\dash\notif::ok(T_("Feature added"));
		}



		// send request to api.busisness.jibres to alert him the premium is payed

		\lib\jpi\bpi::sync_required($business_id);


		\dash\notif::ok(T_("Sync request sended to business"));


		// send notif to supervisor
		$load_busness_detail = \lib\app\store\get::data_by_id($business_id);
		$log =
		[
			'my_premium_add_by_admin' => true,
			'my_premium_key'          => $premium,
			'my_business_id'          => $business_id,
			'my_user_id'              => \dash\user::id(),
			'my_business_title'       => a($load_busness_detail, 'title'),

		];

		\dash\log::set('business_premium', $log);

	}

	public static function remove($_business_id, $_premium)
	{

		$business_id = \dash\validate::id($_business_id);
		$premium = \dash\validate::string_100($_premium);

		if(!$business_id || !$premium)
		{
			\dash\notif::error(T_("Business or premium is required"));
			return false;
		}

		$check = \lib\db\store_premium\get::by_business_id_premium($business_id, $premium);

		if(isset($check['id']))
		{
			if(a($check, 'status') === 'enable')
			{
				\lib\db\store_premium\update::record(['status' => 'deleted', 'datemodified' => date("Y-m-d H:i:s")], a($check, 'id'));
				\dash\notif::ok(T_("Feature removed"));
			}
			else
			{
				\dash\notif::warn(T_("Feature already removed"));
				return false;
			}


		}
		else
		{
			\dash\notif::error(T_("Feature not exist"));
			return false;
		}



		// send request to api.busisness.jibres to alert him the premium is payed

		\lib\jpi\bpi::sync_required($business_id);

		\dash\notif::ok(T_("Sync request sended to business"));


		// send notif to supervisor
		$load_busness_detail = \lib\app\store\get::data_by_id($business_id);
		$log =
		[
			'my_premium_removed' => true,
			'my_premium_key'     => $premium,
			'my_business_id'     => $business_id,
			'my_user_id'         => \dash\user::id(),
			'my_business_title'  => a($load_busness_detail, 'title'),

		];

		\dash\log::set('business_premium', $log);


	}
}
?>