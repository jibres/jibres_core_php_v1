<?php
namespace lib\app\premium;

/**
 * This class describes a business.
 */
class business
{
	/**
	 * Only get enable premium list
 	 * This function call from api r10
	 */
	public static function list($_business_id)
	{
		$business_id = \dash\validate::id($_business_id);

		if(!$business_id)
		{
			return false;
		}

		$business_premium_list = \lib\db\store_premium\get::active_by_business_id($business_id);

		if(!is_array($business_premium_list))
		{
			$business_premium_list = [];
		}

		$new_list = [];

		foreach ($business_premium_list as $key => $value)
		{
			$new_list[] =
			[
				'premium_key' => a($value, 'premium_key'),
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
		\lib\app\setting\tools::update('premium', 'sync_required', date("Y-m-d H:i:s"));
		\lib\app\setting\tools::update('premium', 'synced', null);
	}


	/**
	 * Get all premium of one business
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

		$business_premium_list = \lib\db\store_premium\get::by_business_id($business_id);

		if(!is_array($business_premium_list))
		{
			$business_premium_list = [];
		}

		$business_premium_list = array_map(['\\lib\\premium\\ready', 'row'], $business_premium_list);

		return $business_premium_list;

	}
}
?>