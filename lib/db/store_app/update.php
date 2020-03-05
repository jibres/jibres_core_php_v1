<?php
namespace lib\db\store_app;


class update
{

	public static function set_status($_id, $_status)
	{
		$query  = "UPDATE store_app SET store_app.status = '$_status' WHERE  store_app.id = $_id  LIMIT 1";
		$result = \dash\db::query($query, 'master');
		return $result;
	}

}
?>
