<?php
namespace lib\app\product;


trait add
{

	/**
	 * add new product
	 *
	 * @param      array          $_args  The arguments
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function add($_args, $_option = [])
	{
		$default_option =
		[
			'debug' => true,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);

		\dash\app::variable($_args);

		$log_meta =
		[
			'data' => null,
			'meta' =>
			[
				'input' => \dash\app::request(),
			]
		];

		if(!\dash\user::id())
		{
			\dash\app::log('api:product:user_id:notfound', \dash\user::id(), $log_meta);
			if($_option['debug']) \dash\notif::error(T_("User not found"), 'user');
			return false;
		}

		if(!\lib\store::id())
		{
			\dash\app::log('api:product:store_id:notfound', \dash\user::id(), $log_meta);
			if($_option['debug']) \dash\notif::error(T_("Store not found"), 'subdomain');
			return false;
		}

		if(!\lib\userstore::in_store())
		{
			\dash\notif::error(T_("You are not in this store"), 'subdomain');
			return false;
		}

		// check args
		$args = self::check($_option);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$args['store_id'] = \lib\store::id();
		$args['creator']  = \dash\user::id();

		if(!isset($args['status']) || (isset($args['status']) && !$args['status']))
		{
			$args['status']  = 'available';
		}

		if(!isset($args['title']) || (isset($args['title']) && !$args['title']))
		{
			\dash\app::log('api:product:title:not:set', \dash\user::id(), $log_meta);
			if($_option['debug']) \dash\notif::error(T_("Product title can not be null"), 'title');
			return false;
		}

		$return = [];

		// \dash\temp::set('last_product_added', isset($args['slug'])? $args['slug'] : null);

		$product_id = \lib\db\products::insert($args);

		if(!$product_id)
		{
			\dash\app::log('api:product:no:way:to:insert:product', \dash\user::id(), $log_meta);
			if($_option['debug']) \dash\notif::error(T_("No way to insert product"), 'db', 'system');
			return false;
		}

		// the product was inserted
		// set the productprice record
		$insert_productprices =
		[
			'product_id'      => $product_id,
			'creator'         => \dash\user::id(),
			'startdate'       => date("Y-m-d H:i:s"),
			'startshamsidate' => \dash\utility\jdate::date("Ymd", false, false),
			'enddate'         => null,
			'endshamsidate'   => null,
			'buyprice'        => $args['buyprice'],
			'price'           => $args['price'],
			'discount'        => $args['discount'],
			'discountpercent' => $args['discountpercent'],
		];
		\lib\db\productprices::insert($insert_productprices);


		$return['product_id'] = \dash\coding::encode($product_id);

		if(\dash\engine\process::status())
		{
			if($_option['debug']) \dash\notif::ok(T_("Product successfuly added"));
		}

		self::clean_cache('var');

		return $return;
	}
}
?>