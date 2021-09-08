<?php
namespace lib\features;


class sync
{
	public static function business_by_jibres()
	{
		$business_id = \lib\store::id();
		if(!$business_id)
		{
			return false;
		}

		$get_lit = jpi::sync_features($business_id);

		if(!$get_lit || !is_array($get_lit))
		{
			return false;
		}


		// remove all saved features in setting

		$insert_setting = [];
		foreach ($get_lit as $key => $value)
		{
			$insert_setting[] =
			[
				'cat'   => 'features',
				'key'   => a($value, 'feature_key'),
				'value' => a($value, 'expiredate'),
			];
		}

		\lib\app\setting\set::multi_insert($insert_setting);


	}
}
?>