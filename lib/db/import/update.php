<?php
namespace lib\db\import;


class update
{
	public static function set_running($_id)
	{
		$query   = "UPDATE importexport SET importexport.status = 'running' WHERE importexport.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}


	public static function set_done($_id, $_link)
	{
		$query   = "UPDATE importexport SET importexport.status = 'done', importexport.file = '$_link' WHERE importexport.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}

	public static function set_failed($_id)
	{
		$query   = "UPDATE importexport SET importexport.status = 'failed' WHERE importexport.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}


	public static function whole_status_expire($_ids)
	{
		$query   = "UPDATE importexport SET importexport.status = 'expire' WHERE importexport.id IN ($_ids)";
		$result = \dash\db::query($query);
		return $result;
	}



}
?>