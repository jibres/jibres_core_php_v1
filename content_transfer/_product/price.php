<?php
namespace content_transfer\_product;

class price
{
	public static function run()
	{
		\content_transfer\say::info('Fix productprice ...');
		self::transfer_price();


	}


	private static function transfer_price()
	{
		$query  = "ALTER TABLE jibres_transfer.products ADD `fix_price` int(10) unsigned NULL DEFAULT NULL AFTER `id` ";
		$result = \dash\db::query($query, 'local', ['database' => 'jibres_transfer']);

		$query =
		"
			SELECT

				products.*,

				products.id AS `xid`,
				products.new_id AS `new_product_id`,
				stores.new_id AS `new_store_id`

			FROM products

			INNER JOIN stores ON stores.id = products.store_id



			WHERE products.fix_price IS NULL



		";

		$result = \dash\db::get($query, null, false, 'local', ['database' => 'jibres_transfer']);

		foreach ($result as $key => $value)
		{
			$buyprice = \lib\price::up($value['buyprice']);
			$price    = \lib\price::up($value['price']);
			$discount = \lib\price::up($value['discount']);

			$finalprice = $price - $discount;
			if($finalprice < 0)
			{
				\content_transfer\say::error('Price is out of range! '.  json_encode($value, JSON_UNESCAPED_UNICODE). ' -- in store '. $value['new_store_id'] );
				continue;
			}


			$discountpercent = null;
			if($discount && $price && intval($price) !== 0)
			{
				$discountpercent = round((\lib\price::down($discount) * 100) / \lib\price::down($price), 2);
				$discountpercent = \lib\price::up($discountpercent);
			}

			$now = date("Y-m-d H:i:s");

			$removeLast  = "UPDATE productprices SET productprices.last = NULL , productprices.enddate = '$now' WHERE productprices.product_id = $value[new_product_id] AND productprices.last = 'yes'  LIMIT 1";
			$removeLast = \dash\db::query($removeLast, 'local', ['database' => 'jibres_'. $value['new_store_id']]);

			$new_productprices =
			[

				'product_id'      => $value['new_product_id'],
				'last'            => 'yes',
				'creator'         => 1,
				'startdate'       => date("Y-m-d H:i:s"),
				'enddate'         => null,
				'buyprice'        => $buyprice,
				'price'           => $finalprice,
				'compareatprice'  => $price,
				'discount'        => $discount,
				'discountpercent' => $discountpercent,
				'finalprice'      => $finalprice,
				'datecreated'     => date("Y-m-d H:i:s"),
				'datemodified'    => null,

			];


			$product_new_id = null;

			$set = \dash\db\config::make_set($new_productprices, ['type' => 'insert']);

			$query = " INSERT INTO productprices SET $set ";

			$inserr_new_store = \dash\db::query($query, 'local', ['database' => 'jibres_'. $value['new_store_id']]);

			if($inserr_new_store)
			{
				$product_new_id = \dash\db::insert_id();
			}


			if(!$product_new_id)
			{
				\content_transfer\say::end('Can not add product price! '.  json_encode($new_productprices, JSON_UNESCAPED_UNICODE). ' '. $value['new_store_id'] );
			}

			$query = "UPDATE products SET products.fix_price = $product_new_id WHERE products.id = $value[xid] LIMIT 1";
			\dash\db::query($query, 'local', ['database' => 'jibres_transfer']);
		}
	}
}
?>