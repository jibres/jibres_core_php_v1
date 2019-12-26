<?php
namespace content_transfer\_ready;

class db
{
	public static function run()
	{
		\content_transfer\say::info('Alter table to add field stores.new_id To save store id in old db');
		self::store_new_id();

		\content_transfer\say::info('Alter table to add field userstores.new_id To save new user store id in old db');
		self::userstores_new_id();

		\content_transfer\say::info('Alter table to add field product.new_id To save new product id in old db');
		self::product_new_id();


		\content_transfer\say::info('Alter table to add field productcompany.new_id To save new productcompany id in old db and fix &quot; from title of company');
		self::productcompany_new_id();


		\content_transfer\say::info('Alter table to add field productterms.new_id');
		self::productterms_new_id();
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



	private static function product_new_id()
	{
		$query  = "ALTER TABLE jibres_transfer.products ADD `new_id` int(10) unsigned NULL DEFAULT NULL AFTER `id` ";
		$result = \dash\db::query($query, 'local', ['database' => 'jibres_transfer']);
	}


	private static function productcompany_new_id()
	{
		$query  = "ALTER TABLE jibres_transfer.productcompany ADD `new_id` int(10) unsigned NULL DEFAULT NULL AFTER `id` ";
		$result = \dash\db::query($query, 'local', ['database' => 'jibres_transfer']);

		$query  = "UPDATE jibres_transfer.productcompany SET productcompany.title = REPLACE(productcompany.title, '&quot;', '') ";
		$result = \dash\db::query($query, 'local', ['database' => 'jibres_transfer']);
	}

	private static function productterms_new_id()
	{
		$query  = "ALTER TABLE jibres_transfer.productterms ADD `new_id` int(10) unsigned NULL DEFAULT NULL AFTER `id` ";
		$result = \dash\db::query($query, 'local', ['database' => 'jibres_transfer']);

	}


}
?>