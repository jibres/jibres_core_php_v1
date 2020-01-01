<?php
namespace content_transfer\_product;

class price
{
	public static function run()
	{
		\content_transfer\say::info('Transfer productprice ...');
		self::transfer_price();


		\content_transfer\say::info('Set last productprices record as master price ...');
		self::set_last();

	}


	private static function set_last()
	{
		$query = "SELECT * FROM store";

		$result = \dash\db::get($query, null, false, 'local', ['database' => 'jibres']);
		foreach ($result as $key => $value)
		{
			$customer_db = 'jibres_'. $value['id'];

			$last_id_query =
			"
				SELECT
					MAX(productprices.id) AS `id`
				FROM
					productprices
				GROUP BY productprices.product_id
			";

			$last_product_ids = \dash\db::get($last_id_query, 'id', false, 'local', ['database' => $customer_db]);
			if(!$last_product_ids)
			{
				continue;
			}

			$last_product_ids = implode(',', $last_product_ids);

			$set_last =
			"
				UPDATE
					productprices
				SET
					productprices.last = 'yes'

				WHERE
					productprices.enddate IS NULL AND
					productprices.id IN ($last_product_ids)
			";

			$ok = \dash\db::query($set_last, 'local', ['database' => $customer_db]);
		}

	}



	private static function transfer_price()
	{
		$query =
		"
			SELECT

				productprices.*,
				productprices.id AS `xid`,
				products.new_id AS `new_product_id`,
				stores.new_id AS `new_store_id`,
				userstores.new_id AS `new_user_id`

			FROM productprices

			INNER JOIN products ON products.id = productprices.product_id
			INNER JOIN stores ON stores.id = products.store_id
			INNER JOIN userstores ON userstores.user_id = productprices.creator and userstores.store_id = products.store_id


			WHERE productprices.new_id IS NULL


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

			$new_productprices =
			[

				'product_id'      => $value['new_product_id'],
				'last'            => null,
				'creator'         => $value['new_user_id'],
				'startdate'       => $value['startdate'],
				'enddate'         => $value['enddate'],
				'buyprice'        => $buyprice,
				'price'           => $finalprice,
				'compareatprice'  => $price,
				'discount'        => $discount,
				'discountpercent' => $discountpercent,
				'finalprice'      => $finalprice,
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
				\content_transfer\say::end('Can not add product price! '.  json_encode($new_productprices, JSON_UNESCAPED_UNICODE). ' '. $value['new_store_id'] );
			}

			$query = "UPDATE productprices SET productprices.new_id = $product_new_id WHERE productprices.id = $value[xid] LIMIT 1";
			\dash\db::query($query, 'local', ['database' => 'jibres_transfer']);
		}
	}
}
?>