<?php
namespace lib\features;

/**
 * Add feature by admin to business
 */
class admin
{
	public static function add($_business_id, $_feature)
	{

		$business_id = \dash\validate::id($_business_id);
		$feature = \dash\validate::string_100($_feature);

		if(!$business_id || !$feature)
		{
			\dash\notif::error(T_("Business or feature is required"));
			return false;
		}

		$check = \lib\db\store_features\get::by_business_id_feature($business_id, $feature);

		if(isset($check['id']))
		{
			if(a($check, 'status') === 'enable')
			{
				\dash\notif::error(T_("This feature already enable on this business"));
				return;
			}

			\lib\db\store_features\update::record(['status' => 'enable', 'datemodified' => date("Y-m-d H:i:s")], a($check, 'id'));

			\dash\notif::ok(T_("Feature exist. Re Enabled"));
		}
		else
		{
			$price  = floatval(get::price($feature));

			$insert =
			[
				'store_id'    => $_business_id,
				'feature_key' => $feature,
				'zone'        => get::zone($feature),
				'status'      => 'enable',
				'addedby'     => 'admin',
				'user_id'     => \dash\user::id(),
				'price'       => $price,
				'finalprice'  => $price,
				'datecreated' => date("Y-m-d H:i:s"),
			];

			\lib\db\store_features\insert::new_record($insert);

			\dash\notif::ok(T_("Feature added"));
		}



		// send request to api.busisness.jibres to alert him the feature is payed

		\lib\jpi\bpi::sync_required($business_id);


		\dash\notif::ok(T_("Sync request sended to business"));


		// send notif to supervisor
		$load_busness_detail = \lib\app\store\get::data_by_id($business_id);
		$log =
		[
			'my_feature_add_by_admin' => true,
			'my_feature_key'          => $feature,
			'my_business_id'          => $business_id,
			'my_user_id'              => \dash\user::id(),
			'my_business_title'       => a($load_busness_detail, 'title'),

		];

		\dash\log::set('business_features', $log);

	}

	public static function remove($_business_id, $_feature)
	{

		$business_id = \dash\validate::id($_business_id);
		$feature = \dash\validate::string_100($_feature);

		if(!$business_id || !$feature)
		{
			\dash\notif::error(T_("Business or feature is required"));
			return false;
		}

		$check = \lib\db\store_features\get::by_business_id_feature($business_id, $feature);

		if(isset($check['id']))
		{
			if(a($check, 'status') === 'enable')
			{
				\lib\db\store_features\update::record(['status' => 'deleted', 'datemodified' => date("Y-m-d H:i:s")], a($check, 'id'));
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



		// send request to api.busisness.jibres to alert him the feature is payed

		\lib\jpi\bpi::sync_required($business_id);

		\dash\notif::ok(T_("Sync request sended to business"));


		// send notif to supervisor
		$load_busness_detail = \lib\app\store\get::data_by_id($business_id);
		$log =
		[
			'my_feature_removed' => true,
			'my_feature_key'     => $feature,
			'my_business_id'     => $business_id,
			'my_user_id'         => \dash\user::id(),
			'my_business_title'  => a($load_busness_detail, 'title'),

		];

		\dash\log::set('business_features', $log);


	}
}
?>