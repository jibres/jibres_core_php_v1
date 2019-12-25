<?php
namespace content_transfer\_ready;

class check
{
	public static function run()
	{
		\content_transfer\say::info('Check something');

		self::check_exist_database();
		self::sum_all_record();
	}


	private static function check_exist_database()
	{
		$query = "SHOW DATABASES";
		$result = \dash\db::get($query, 'Database', false, 'local', ['database' => 'mysql']);

		if(in_array('jibres_transfer', $result))
		{
			\content_transfer\say::ok('Database jibres_transfer OK');
		}
		else
		{
			\content_transfer\say::end('Database jibres_transfer Not founded');
		}
	}

	private static function sum_all_record()
	{
		$query = "SELECT SUM(TABLE_ROWS) AS `sum` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'jibres_transfer' ";
		$result = \dash\db::get($query, 'sum', true, 'local', ['database' => 'mysql']);

		if($result)
		{
			\content_transfer\say::ok('Count record to transfer '. number_format($result));
		}
		else
		{
			\content_transfer\say::end('Database jibres_transfer Not founded');
		}
	}


}
?>