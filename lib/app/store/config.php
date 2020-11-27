<?php
namespace lib\app\store;


class config
{


	public static function init($_store_id, $_fuel, $_database, $_detail = [])
	{
		if(!$_store_id)
		{
			return null;
		}

		// set default unit
		if(\dash\url::tld() === 'com')
		{
			$currency = 'USD';
		}
		else
		{
			$currency = 'IRT';
		}

		\lib\db\setting\insert::default_setting('store_setting', 'currency', $currency, $_fuel, $_database);

		\lib\db\setting\insert::default_setting('store_setting', 'redirect_all_domain_to_master', '1', $_fuel, $_database);

		\lib\db\setting\insert::default_setting('store_setting', 'length_unit', 'cm', $_fuel, $_database);

		\lib\db\setting\insert::default_setting('store_setting', 'mass_unit', 'kg', $_fuel, $_database);

		\lib\db\setting\insert::default_setting('product_setting', 'comment', '1', $_fuel, $_database);

		\lib\db\setting\insert::default_setting('store_setting', 'lang', \dash\language::current(), $_fuel, $_database);

	}


	/**
	 * After create store user login in store and run this function
	 */
	public static function first_setup()
	{
		$setup_before = \lib\db\setting\get::by_cat_key('business_first_setup_data', 'execute');
		if(!$setup_before)
		{
			\lib\db\setting\set::cat_key_value('business_first_setup_data', 'execute', date("Y-m-d H:i:s"));
			// continue function to init setup
		}
		else
		{
			// setup execute before needless to run again
			return false;
		}

		// first init website header, footer, body
		\lib\app\website\init::first_init();

		self::add_example_product();

		\dash\notif::clean();
	}



	private static function add_example_product()
	{
		$args =
		[
			'title'         => T_("Example product 1"),
			'stock'         => 10,
			'weight'        => 10,
			'desc'          => T_("Description of example product 1"),
			'trackquantity' => 1,
			'sku'           => '123456',
			'sharetext'     => T_("Share this product by this text"),
			'buyprice'      => 1000,
			'price'         => 1500,
			'discount'      => 100,
			'company'       => T_("Example company"),
			'tag'           => [T_("Example tag 1"), T_("Example tag 2")],
			'cat'           => [T_("Example category 1")],
			'unit'          => T_("Number"), // in add manual user send the unit
		];

		$product_id = \lib\app\product\add::add($args);

		if(isset($product_id['id']))
		{
			$file_detail =
			[
				'path' => \dash\url::cdn(). "/images/slider-sample/food/". rand(1, 40).".jpg",
				'id' => null,
			];

			\lib\app\product\gallery::gallery($product_id['id'], $file_detail, 'add');
		}


		\dash\notif::clean();
		\dash\engine\process::continue();

		$args =
		[
			'title'         => T_("Example product 2"),
			'stock'         => 10,
			'weight'        => 10,
			'desc'          => T_("Description of example product 2"),
			'trackquantity' => 1,
			'sku'           => '654321',
			'sharetext'     => T_("Share this product by this text"),
			'buyprice'      => 1000,
			'price'         => 1500,
			'discount'      => 100,
			'company'       => T_("Example company"),
			'tag'           => [T_("Example tag 1"), T_("Example tag 2")],
			'cat'           => [T_("Example category 1")],
			'unit'          => T_("Number"), // in add manual user send the unit
		];

		$product_id = \lib\app\product\add::add($args);

		if(isset($product_id['id']))
		{
			$file_detail =
			[
				'path' => \dash\url::cdn(). "/images/slider-sample/food/". rand(1, 40).".jpg",
				'id' => null,
			];

			\lib\app\product\gallery::gallery($product_id['id'], $file_detail, 'add');

		}

			\dash\notif::clean();
		\dash\engine\process::continue();

		$args =
		[
			'title'         => T_("Example product 3"),
			'stock'         => 10,
			'weight'        => 10,
			'desc'          => T_("Description of example product 3"),
			'trackquantity' => 1,
			'sku'           => null,
			'sharetext'     => T_("Share this product by this text"),
			'buyprice'      => 1000,
			'price'         => 1500,
			'discount'      => 100,
			'company'       => T_("Example company"),
			'tag'           => [T_("Example tag 1"), T_("Example tag 2")],
			'cat'           => [T_("Example category 2")],
			'unit'          => T_("Box"), // in add manual user send the unit
		];

		$product_id = \lib\app\product\add::add($args);

		if(isset($product_id['id']))
		{
			$file_detail =
			[
				'path' => \dash\url::cdn(). "/images/slider-sample/food/". rand(1, 40).".jpg",
				'id' => null,
			];

			\lib\app\product\gallery::gallery($product_id['id'], $file_detail, 'add');

		}

		\dash\notif::clean();
		\dash\engine\process::continue();

		$args =
		[
			'title'         => T_("Example product 4"),
			'stock'         => 10,
			'weight'        => 10,
			'desc'          => T_("Description of example product 4"),
			'trackquantity' => 1,
			'sku'           => null,
			'sharetext'     => T_("Share this product by this text"),
			'buyprice'      => 1000,
			'price'         => 1500,
			'discount'      => 100,
			'company'       => T_("Example company"),
			'tag'           => [T_("Example tag 1"), T_("Example tag 2")],
			'cat'           => [T_("Example category 1")],
			'unit'          => T_("Box"), // in add manual user send the unit
		];

		$product_id = \lib\app\product\add::add($args);

		if(isset($product_id['id']))
		{
			$file_detail =
			[
				'path' => \dash\url::cdn(). "/images/slider-sample/food/". rand(1, 40).".jpg",
				'id' => null,
			];

			\lib\app\product\gallery::gallery($product_id['id'], $file_detail, 'add');

		}

		\dash\notif::clean();
		\dash\engine\process::continue();

		$args =
		[
			'title'         => T_("Example product 5"),
			'stock'         => 10,
			'weight'        => 10,
			'desc'          => T_("Description of example product 5"),
			'trackquantity' => 1,
			'sku'           => null,
			'sharetext'     => T_("Share this product by this text"),
			'buyprice'      => 1000,
			'price'         => 1500,
			'discount'      => 100,
			'company'       => T_("Example company"),
			'tag'           => [T_("Example tag 1"), T_("Example tag 2")],
			'cat'           => [T_("Example category 1")],
			'unit'          => T_("Number"), // in add manual user send the unit
		];

		$product_id = \lib\app\product\add::add($args);

		if(isset($product_id['id']))
		{
			$file_detail =
			[
				'path' => \dash\url::cdn(). "/images/slider-sample/food/". rand(1, 40).".jpg",
				'id' => null,
			];

			\lib\app\product\gallery::gallery($product_id['id'], $file_detail, 'add');

		}


		$args =
		[
			'title'         => T_("Example product 6"),
			'stock'         => 10,
			'weight'        => 10,
			'desc'          => T_("Description of example product 6"),
			'trackquantity' => 1,
			'sku'           => null,
			'sharetext'     => T_("Share this product by this text"),
			'buyprice'      => 1000,
			'price'         => 1500,
			'discount'      => 100,
			'company'       => T_("Example company"),
			'tag'           => [T_("Example tag 1"), T_("Example tag 2")],
			'cat'           => [T_("Example category 1")],
			'unit'          => T_("Number"), // in add manual user send the unit
		];

		$product_id = \lib\app\product\add::add($args);

		if(isset($product_id['id']))
		{
			$file_detail =
			[
				'path' => \dash\url::cdn(). "/images/slider-sample/food/". rand(1, 40).".jpg",
				'id' => null,
			];

			\lib\app\product\gallery::gallery($product_id['id'], $file_detail, 'add');

		}


		$args =
		[
			'title'         => T_("Example product 7"),
			'stock'         => 10,
			'weight'        => 10,
			'desc'          => T_("Description of example product 7"),
			'trackquantity' => 1,
			'sku'           => null,
			'sharetext'     => T_("Share this product by this text"),
			'buyprice'      => 1000,
			'price'         => 1500,
			'discount'      => 100,
			'company'       => T_("Example company"),
			'tag'           => [T_("Example tag 1"), T_("Example tag 2")],
			'cat'           => [T_("Example category 1")],
			'unit'          => T_("Number"), // in add manual user send the unit
		];

		$product_id = \lib\app\product\add::add($args);

		if(isset($product_id['id']))
		{
			$file_detail =
			[
				'path' => \dash\url::cdn(). "/images/slider-sample/food/". rand(1, 40).".jpg",
				'id' => null,
			];

			\lib\app\product\gallery::gallery($product_id['id'], $file_detail, 'add');

		}
	}

}
?>