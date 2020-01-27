<?php
namespace lib\db\export;


class update
{
	public static function set_running($_id)
	{
		$query   = "UPDATE export SET export.status = 'running' WHERE export.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}


	public static function set_done($_id, $_link)
	{
		$query   = "UPDATE export SET export.status = 'done', export.file = '$_link' WHERE export.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}

	public static function set_failed($_id)
	{
		$query   = "UPDATE export SET export.status = 'failed' WHERE export.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}



}
?>