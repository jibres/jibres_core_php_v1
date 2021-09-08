<?php
namespace lib\features;


class business
{
	public static function list($_business_id)
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


	public static function sync_required()
	{
		\lib\app\setting\tools::update('features', 'sync_required', date("Y-m-d H:i:s"));
		\lib\db\setting\delete::by_cat_key('features', 'synced');
	}
}
?>