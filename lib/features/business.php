<?php
namespace lib\features;

/**
 * This class describes a business.
 */
class business
{
	/**
	 * Only get enable features list
 	 * This function call from api r10
	 */
	public static function list($_business_id)
	{
		$business_id = \dash\validate::id($_business_id);

		if(!$business_id)
		{
			return false;
		}

		$business_features_list = \lib\db\store_features\get::active_by_business_id($business_id);

		if(!is_array($business_features_list))
		{
			$business_features_list = [];
		}

		$new_list = [];

		foreach ($business_features_list as $key => $value)
		{
			$new_list[] =
			[
				'feature_key' => a($value, 'feature_key'),
				'status'      => a($value, 'status'),
				'expiredate'  => a($value, 'expiredate'),
			];
		}

		return $new_list;
	}


	/**
	 * This function call from api r10
	 */
	public static function sync_required()
	{
		\lib\app\setting\tools::update('features', 'sync_required', date("Y-m-d H:i:s"));
		\lib\app\setting\tools::update('features', 'synced', null);
	}


	/**
	 * Get all features of one business
	 *
	 * @param      <type>  $_business_id  The business identifier
	 *
	 * @return     bool    ( description_of_the_return_value )
	 */
	public static function admin_list($_business_id)
	{
		$business_id = \dash\validate::id($_business_id);

		if(!$business_id)
		{
			return false;
		}

		$business_features_list = \lib\db\store_features\get::by_business_id($business_id);

		if(!is_array($business_features_list))
		{
			$business_features_list = [];
		}

		$business_features_list = array_map(['\\lib\\features\\ready', 'row'], $business_features_list);

		return $business_features_list;

	}
}
?>