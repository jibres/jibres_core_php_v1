<?php
namespace content_transfer\_product;

class transfer
{
	public static function run()
	{
		\content_transfer\say::info('Transfer cat ...');
		self::transfer_cat();

		\content_transfer\say::info('Transfer company ...');
		self::transfer_company();

		\content_transfer\say::info('Transfer product ...');
		self::transfer_product();
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




	private static function transfer_product()
	{
		$query =
		"
			SELECT
			products.*,
			stores.new_id AS `new_store_id`
			FROM products
			INNER JOIN stores ON stores.id = products.store_id
			LIMIT 20
		";

		$result = \dash\db::get($query, null, false, 'local', ['database' => 'jibres_transfer']);

		foreach ($result as $key => $value)
		{
			$new_product =
			[

				"title"           => $value['title'],
				"seotitle"        => $value['seotitle'],
				"slug"            => $value['slug'],
				"seodesc"         => $value['seodesc'],
				"desc"            => $value['desc'],
				"barcode"         => $value['barcode'],
				"barcode2"        => $value['barcode2'],
				"scalecode"       => $value['scalecode'],
				"carton"          => $value['carton'],
				"weight"          => $value['weight'],
				"type"            => $value['type'],
				"status"          => $value['status'],
				"thumb"           => $value['thumb'],
				"vat"             => $value['vat'],
				"infinite"        => $value['infinite'],
				"gallery"         => $value['gallery'],



				"datecreated"     => $value['datecreated'],
				"datemodified"    => $value['datemodified'],





				// "cat_id"          => $value['cat_id'],
				// "company_id"      => $value['company_id'],
				// "unit_id"         => $value['unit_id'],




				// "buyprice"        => $value['buyprice'],
				// "price"           => $value['price'],
				// "discount"        => $value['discount'],
				// "discountpercent" => $value['discountpercent'],
				// "initialbalance"  => $value['initialbalance'],
				// "minstock"        => $value['minstock'],
				// "maxstock"        => $value['maxstock'],
				// "sold"            => $value['sold'],
				// "stock"           => $value['stock'],
				// "service"         => $value['service'],
				// "saleonline"      => $value['saleonline'],
				// "salestore"       => $value['salestore'],
				// "taxable"         => $value['taxable'],
				// "seourl"          => $value['seourl'],
				// "salesite"        => $value['salesite'],
				// "saletelegram"    => $value['saletelegram'],
				// "saleapp"         => $value['saleapp'],
				// "salephysical"    => $value['salephysical'],
				// "infinite"        => $value['infinite'],
				// "variants"        => $value['variants'],
				// "optionname1"     => $value['optionname1'],
				// "optionname2"     => $value['optionname2'],
				// "optionname3"     => $value['optionname3'],
				// "optionvalue1"    => $value['optionvalue1'],
				// "optionvalue2"    => $value['optionvalue2'],
				// "optionvalue3"    => $value['optionvalue3'],
				// "parent"          => $value['parent'],
				// "sku"             => $value['sku'],
				"new_store_id"    => $value['new_store_id'],



			];

			j($new_product);
			$user_store_id = null;

			$check_query = "SELECT * FROM users WHERE users.mobile = '$value[mobile]' LIMIT 1";
			$check       = \dash\db::get($check_query, null, true, 'local', ['database' => 'jibres_'. $value['new_store_id']]);

			if(isset($check['id']))
			{
				$user_store_id = $check['id'];
			}
			else
			{
				$set = \dash\db\config::make_set($user_store, ['type' => 'insert']);

				$query = " INSERT INTO users SET $set ";

				$inserr_new_store = \dash\db::query($query, 'local', ['database' => 'jibres_'. $value['new_store_id']]);

				if($inserr_new_store)
				{
					$user_store_id = \dash\db::insert_id();
				}
			}

			if(!$user_store_id)
			{
				\content_transfer\say::end('Can not add store! '.  json_encode($new_product, JSON_UNESCAPED_UNICODE));
			}

			$query = "UPDATE userstores SET userstores.new_id = $user_store_id WHERE userstores.id = $value[id] LIMIT 1";
			\dash\db::query($query, 'local', ['database' => 'jibres_transfer']);
		}
	}
}
?>