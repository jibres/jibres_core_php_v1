<?php
namespace lib\db\store;

/**
 * Class for master jibres database
 */
class jibres
{
	/**
	 * update title in master jibres database -> table store
	 *
	 * @param      <type>  $_title     The title
	 */
	public static function update_title($_title, $_store_id)
	{
		$fuel     = \dash\engine\fuel::master();
		$query = "UPDATE store_data SET store_data.title = '$_title' WHERE store_data.id = $_store_id LIMIT 1";
		$result = \dash\db::query($query, ['fuel' => $fuel]);
		return $result;
	}
}
?>