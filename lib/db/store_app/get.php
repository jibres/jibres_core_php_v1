<?php
namespace lib\db\store_app;


class get
{

	public static function jibres_my_app_detail($_store_id)
	{
		$query  = "SELECT * FROM store_app WHERE  store_app.store_id = $_store_id ORDER BY store_app.id DESC LIMIT 1";
		$result = \dash\db::get($query, null, true, 'master');
		return $result;
	}
}
?>
