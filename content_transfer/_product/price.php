<?php
namespace content_transfer\_product;

class price
{
	public static function run()
	{

		\content_transfer\say::info('Transfer productprice ...');
		self::transfer_price();
	}





	private static function transfer_price()
	{
		$query =
		"
			SELECT

				productprices.*,
				products.new_id AS `new_product_id`,
				stores.new_id AS `new_store_id`,
				userstores.new_id AS `new_user_id`

			FROM productprices

			INNER JOIN products ON products.id = productprices.product_id
			INNER JOIN stores ON stores.id = products.store_id
			INNER JOIN userstores ON userstores.user_id = productprices.creator and userstores.store_id = products.store_id


			WHERE productprices.new_id IS NULL
			limit 2

		";

		$result = \dash\db::get($query, null, false, 'local', ['database' => 'jibres_transfer']);

		foreach ($result as $key => $value)
		{
			$buyprice = \lib\price::up($value['buyprice']);
			$price    = \lib\price::up($value['price']);
			$discount = \lib\price::up($value['discount']);

			$new_productprices =
			[

				'product_id'      => $value['new_product_id'],
				'last'            => null,
				'creator'         => $value['new_user_id'],
				'startdate'       => $value['startdate'],
				'enddate'         => $value['enddate'],
				'buyprice'        => $buyprice,
				'price'           => $price,
				'compareatprice'  => intval($price) + intval($discount),
				'discount'        => $discount,
				'discountpercent' => null,
				'finalprice'      => null,
				'datecreated'     => $value['datecreated'],
				'datemodified'    => $value['datemodified'],

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
				\content_transfer\say::end('Can not add product! '.  json_encode($new_productprices, JSON_UNESCAPED_UNICODE). ' '. $value['new_store_id'] );
			}

			$query = "UPDATE productprices SET productprices.new_id = $product_new_id WHERE productprices.id = $value[id] LIMIT 1";
			\dash\db::query($query, 'local', ['database' => 'jibres_transfer']);
		}
	}
}
?>