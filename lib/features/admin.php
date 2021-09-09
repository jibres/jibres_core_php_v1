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

			\dash\pdo\query_template::update('store_features', ['status' => 'enable', 'datemodified' => date("Y-m-d H:i:s")], a($check, 'id'));

			\dash\notif::ok(T_("Feature exist. Re Enabled"));
		}
		else
		{
			$insert =
			[
				'store_id'    => $_business_id,
				'feature_key' => $feature_key,
				'zone'        => null,
				'status'      => 'pending',
				'addedby'     => null,
				'user_id'     => $user_id,
				'price'       => $price,
				'finalprice'  => $price,
				'datecreated' => date("Y-m-d H:i:s"),
			];

			\dash\pdo\query_template::insert('store_features', $insert);

			\dash\notif::ok(T_("Feature added"));
		}



		// send request to api.busisness.jibres to alert him the feature is payed

		\lib\jpi\bpi::sync_required($business_id);

		\dash\notif::ok(T_("Sync request sended to business"));

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
				\dash\pdo\query_template::update('store_features', ['status' => 'deleted', 'datemodified' => date("Y-m-d H:i:s")], a($check, 'id'));
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

	}
}
?>