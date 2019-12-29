<?php
namespace content_transfer\_product;

class transfer
{
	public static function run()
	{

		\content_transfer\say::info('Transfer product ...');
		self::transfer_product();
	}





	private static function transfer_product()
	{
		$query =
		"
			SELECT

				products.*,
				products.id AS `xid`,
				productcompany.new_id AS `new_company_id`,
				productunit.new_id AS `new_unit_id`,
				productterms.new_id AS `new_cat_id`,
				stores.new_id AS `new_store_id`

			FROM products

			INNER JOIN stores ON stores.id = products.store_id
			LEFT JOIN productcompany ON productcompany.id = products.company_id
			LEFT JOIN productunit ON productunit.id = products.unit_id
			LEFT JOIN productterms ON productterms.id = products.cat_id

			WHERE products.new_id IS NULL
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
				"vat"             => $value['vat'] ? 'yes' : 'no',
				"infinite"        => $value['infinite'] ? 'yes' : 'no',
				"gallery"         => $value['gallery'],

				"datecreated"     => $value['datecreated'],
				"datemodified"    => $value['datemodified'],

				"cat_id"          => $value['new_cat_id'],
				"company_id"      => $value['new_company_id'],
				"unit_id"         => $value['new_unit_id'],

			];

			$product_new_id = null;

			$set = \dash\db\config::make_set($new_product, ['type' => 'insert']);

			$query = " INSERT INTO products SET $set ";

			$inserr_new_store = \dash\db::query($query, 'local', ['database' => 'jibres_'. $value['new_store_id']]);

			if($inserr_new_store)
			{
				$product_new_id = \dash\db::insert_id();
			}


			if(!$product_new_id)
			{
				\content_transfer\say::end('Can not add product! '.  json_encode($new_product, JSON_UNESCAPED_UNICODE));
			}

			$query = "UPDATE products SET products.new_id = $product_new_id WHERE products.id = $value[xid] LIMIT 1";
			\dash\db::query($query, 'local', ['database' => 'jibres_transfer']);
		}
	}
}
?>