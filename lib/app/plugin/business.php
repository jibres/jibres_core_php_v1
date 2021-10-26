<?php
namespace lib\app\plugin;

/**
 * This class describes a business.
 */
class business
{
	/**
	 * Only get enable plugin list
 	 * This function call from api r10
	 */
	public static function list($_business_id)
	{
		$business_id = \dash\validate::id($_business_id);

		if(!$business_id)
		{
			return false;
		}

		$business_plugin_list = \lib\db\store_plugin\get::active_by_business_id($business_id);

		if(!is_array($business_plugin_list))
		{
			$business_plugin_list = [];
		}

		$new_list = [];

		foreach ($business_plugin_list as $key => $value)
		{
			$new_list[] =
			[
				'plugin' => a($value, 'plugin'),
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
		\lib\app\setting\tools::update('plugin', 'sync_required', date("Y-m-d H:i:s"));
		\lib\app\setting\tools::update('plugin', 'synced', null);
	}


	/**
	 * Get all plugin of one business
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

		$business_plugin_list = \lib\db\store_plugin\get::by_business_id($business_id);

		if(!is_array($business_plugin_list))
		{
			$business_plugin_list = [];
		}

		$business_plugin_list = array_map(['\\lib\\plugin\\ready', 'row'], $business_plugin_list);

		return $business_plugin_list;

	}
}
?>