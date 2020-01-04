<?php
namespace lib\app\sync;

/**
 * This class describes logo.
 */
class store
{

	/**
	 * Start sync logo from stores to jibres
	 */
	public static function logo($_logo, $_store_id)
	{
		$query_string = \lib\db\store\get_string::update_logo($_logo, $_store_id);

		\lib\app\sync\tools::add($query_string, 'master', 'update_store_logo');

	}


	public static function title($_title, $_store_id)
	{
		$query_string = \lib\db\store\get_string::update_title($_title, $_store_id);

		\lib\app\sync\tools::add($query_string, 'master', 'update_store_title');
	}
}
?>