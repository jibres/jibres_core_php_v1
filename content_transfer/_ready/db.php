<?php
namespace content_transfer\_ready;

class db
{
	public static function run()
	{
		\content_transfer\say::info('Ready database - Add some field to transfer database to ready to convert');
		self::add_field();
	}


	private static function add_field()
	{
		$query = "ALTER TABLE jibres_transfer.stores ADD `new_id` int(10) unsigned NULL DEFAULT NULL AFTER `id` ";
		$result = \dash\db::query($query, 'local', ['database' => 'jibres_transfer']);
	}


}
?>