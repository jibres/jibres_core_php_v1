<?php
namespace content_transfer\_ready;

class db
{
	public static function run()
	{
		\content_transfer\say::info('Add field stores.new_id To save store id in old db');
		self::store_new_id();

		\content_transfer\say::info('Add field userstores.new_id To save new user store id in old db');
		self::userstores_new_id();
	}


	private static function store_new_id()
	{
		$query  = "ALTER TABLE jibres_transfer.stores ADD `new_id` int(10) unsigned NULL DEFAULT NULL AFTER `id` ";
		$result = \dash\db::query($query, 'local', ['database' => 'jibres_transfer']);
	}


	private static function userstores_new_id()
	{
		$query  = "ALTER TABLE jibres_transfer.userstores ADD `new_id` int(10) unsigned NULL DEFAULT NULL AFTER `id` ";
		$result = \dash\db::query($query, 'local', ['database' => 'jibres_transfer']);
	}


}
?>