<?php
namespace lib\db\store;

/**
 * Class for master jibres database
 */
class get_string
{

	public static function update_title($_title, $_store_id)
	{
		$query = "UPDATE store_data SET store_data.title = '$_title' WHERE store_data.id = $_store_id LIMIT 1";
		return $query;
	}


	public static function update_logo($_logo, $_store_id)
	{
		$query = "UPDATE store_data SET store_data.logo = '$_logo' WHERE store_data.id = $_store_id LIMIT 1";
		return $query;
	}


	public static function update_db_version($_version, $_versiondate, $_store_id)
	{
		$query = "UPDATE jibres.store_data SET jibres.store_data.dbversion = '$_version', jibres.store_data.dbversiondate = '$_versiondate' WHERE jibres.store_data.id = $_store_id LIMIT 1";
		return $query;
	}
}
?>