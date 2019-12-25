<?php
namespace content_transfer\_store;

class db
{
	public static function run()
	{
		\content_transfer\say::info('Start convert stores ...');
		self::convert_store();
	}


	private static function convert_store()
	{
		$query = "SELECT * FROM stores";
		$result = \dash\db::get($query, null, false, 'local', ['database' => 'jibres_transfer']);
		j($result);
	}


}
?>