<?php
namespace lib\db\sync;


class update
{

	public static function status($_status, $_id)
	{
		$query = "UPDATE sync SET sync.status = '$_status' WHERE sync.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}

}
?>