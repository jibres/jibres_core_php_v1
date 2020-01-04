<?php
namespace lib\db\sync;


class update
{

	public static function status($_status, $_id)
	{
		$now = date("Y-m-d H:i:s");
		$query = "UPDATE sync SET sync.status = '$_status', sync.datemodified = '$now' WHERE sync.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}

}
?>