<?php
namespace content_transfer\_product;

class ready
{
	public static function run()
	{
		\content_transfer\say::info('Transfer unit ...');
		self::transfer_unit();

		\content_transfer\say::info('Transfer cat ...');
		self::transfer_cat();

		\content_transfer\say::info('Transfer company ...');
		self::transfer_company();

	}



	private static function transfer_unit()
	{
		$query =
		"
			SELECT
			productunit.*,
			stores.new_id AS `new_store_id`
			FROM productunit
			INNER JOIN stores ON stores.id = productunit.store_id
		";

		$result = \dash\db::get($query, null, false, 'local', ['database' => 'jibres_transfer']);

		foreach ($result as $key => $value)
		{
			$new_productunit =
			[
				"title"        => $value['title'],

			];

			$productunit_id = null;

			$check_query = "SELECT * FROM productunit WHERE title = '$value[title]' LIMIT 1";
			$check       = \dash\db::get($check_query, null, true, 'local', ['database' => 'jibres_'. $value['new_store_id']]);

			if(isset($check['id']))
			{
				$productunit_id = $check['id'];
			}
			else
			{
				$set = \dash\db\config::make_set($new_productunit, ['type' => 'insert']);

				$query = " INSERT INTO productunit SET $set ";

				$inserr_new_store = \dash\db::query($query, 'local', ['database' => 'jibres_'. $value['new_store_id']]);

				if($inserr_new_store)
				{
					$productunit_id = \dash\db::insert_id();
				}
			}

			if(!$productunit_id)
			{
				\content_transfer\say::end('Can not add productunit! '.  json_encode($new_productunit, JSON_UNESCAPED_UNICODE));
			}

			$query = "UPDATE productunit SET productunit.new_id = $productunit_id WHERE productunit.id = $value[id] LIMIT 1";
			\dash\db::query($query, 'local', ['database' => 'jibres_transfer']);
		}
	}



	private static function transfer_cat()
	{
		$query =
		"
			SELECT
			productterms.*,
			stores.new_id AS `new_store_id`
			FROM productterms
			INNER JOIN stores ON stores.id = productterms.store_id
			WHERE productterms.type = 'cat'
		";

		$result = \dash\db::get($query, null, false, 'local', ['database' => 'jibres_transfer']);

		foreach ($result as $key => $value)
		{
			$new_productterms =
			[
				"title"        => $value['title'],
				"slug"         => $value['slug'],
				"status"       => $value['status'],
				"datecreated"  => $value['datecreated'],

			];

			$productterms_id = null;

			$check_query = "SELECT * FROM productcategory WHERE title = '$value[title]' LIMIT 1";
			$check       = \dash\db::get($check_query, null, true, 'local', ['database' => 'jibres_'. $value['new_store_id']]);

			if(isset($check['id']))
			{
				$productterms_id = $check['id'];
			}
			else
			{
				$set = \dash\db\config::make_set($new_productterms, ['type' => 'insert']);

				$query = " INSERT INTO productcategory SET $set ";

				$inserr_new_store = \dash\db::query($query, 'local', ['database' => 'jibres_'. $value['new_store_id']]);

				if($inserr_new_store)
				{
					$productterms_id = \dash\db::insert_id();
				}
			}

			if(!$productterms_id)
			{
				\content_transfer\say::end('Can not add productterms! '.  json_encode($new_productterms, JSON_UNESCAPED_UNICODE));
			}

			$query = "UPDATE productterms SET productterms.new_id = $productterms_id WHERE productterms.id = $value[id] LIMIT 1";
			\dash\db::query($query, 'local', ['database' => 'jibres_transfer']);
		}
	}


	private static function transfer_company()
	{
		$query =
		"
			SELECT
			productcompany.*,
			stores.new_id AS `new_store_id`
			FROM productcompany
			INNER JOIN stores ON stores.id = productcompany.store_id
		";

		$result = \dash\db::get($query, null, false, 'local', ['database' => 'jibres_transfer']);


		foreach ($result as $key => $value)
		{
			$new_productcompany =
			[
				"title"           => $value['title'],
			];


			$productcompany_id = null;

			$check_query = "SELECT * FROM productcompany WHERE title = '$value[title]' LIMIT 1";
			$check       = \dash\db::get($check_query, null, true, 'local', ['database' => 'jibres_'. $value['new_store_id']]);

			if(isset($check['id']))
			{
				$productcompany_id = $check['id'];
			}
			else
			{
				$set = \dash\db\config::make_set($new_productcompany, ['type' => 'insert']);

				$query = " INSERT INTO productcompany SET $set ";

				$inserr_new_store = \dash\db::query($query, 'local', ['database' => 'jibres_'. $value['new_store_id']]);

				if($inserr_new_store)
				{
					$productcompany_id = \dash\db::insert_id();
				}
			}

			if(!$productcompany_id)
			{
				\content_transfer\say::end('Can not add productcompany! '.  json_encode($new_productcompany, JSON_UNESCAPED_UNICODE));
			}

			$query = "UPDATE productcompany SET productcompany.new_id = $productcompany_id WHERE productcompany.id = $value[id] LIMIT 1";
			\dash\db::query($query, 'local', ['database' => 'jibres_transfer']);
		}
	}



}
?>