<?php
namespace lib\app\store;

trait dashboard
{
	/**
	 * dashboard detail
	 *
	 * @param      <type>         $_store_id  The store identifier
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function dashboard_detail($_store_id)
	{
		if(!$_store_id || !is_numeric($_store_id))
		{
			return false;
		}

		$result = [];

		$store_detail = \lib\db\stores::get(['id' => $_store_id, 'limit' => 1]);
		if(isset($store_detail['creator']))
		{
			$result['count_store'] = self::count_store_by_creator($store_detail['creator']);
		}

		return $result;
	}


	/**
	 * Counts the number of store by creator.
	 *
	 * @param      <type>   $_creator_id  The creator identifier
	 *
	 * @return     boolean  Number of store by creator.
	 */
	public static function count_store_by_creator($_creator_id)
	{
		if(!$_creator_id || !is_numeric($_creator_id))
		{
			return false;
		}

		return intval(\lib\db\stores::get_count_store_by_creator($_creator_id));
	}

}
?>
