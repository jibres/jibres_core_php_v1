<?php
namespace lib\app\product;
use \lib\utility;
use \lib\debug;

trait add
{

	/**
	 * add new product
	 *
	 * @param      array          $_args  The arguments
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function add($_args = [])
	{
		\lib\app::variable($_args);

		$log_meta =
		[
			'data' => null,
			'meta' =>
			[
				'input' => \lib\app::request(),
			]
		];

		if(!\lib\user::id())
		{
			\lib\app::log('api:product:user_id:notfound', null, $log_meta);
			debug::error(T_("User not found"), 'user');
			return false;
		}

		if(!\lib\store::id())
		{
			\lib\app::log('api:product:store_id:notfound', null, $log_meta);
			debug::error(T_("Store not found"), 'subdomain');
			return false;
		}

		// check args
		$args = self::check();

		if($args === false || !\lib\debug::$status)
		{
			return false;
		}

		$args['store_id'] = \lib\store::id();
		$args['creator']  = \lib\user::id();

		$return = [];

		// \lib\temp::set('last_product_added', isset($args['slug'])? $args['slug'] : null);

		$product_id = \lib\db\products::insert($args);

		if(!$product_id)
		{
			$args['slug'] = self::slug_fix($args);
			$product_id     = \lib\db\products::insert($args);
		}

		if(!$product_id)
		{
			\lib\app::log('api:product:no:way:to:insert:product', \lib\user::id(), $log_meta);
			debug::error(T_("No way to insert product"), 'db', 'system');
			return false;
		}

		$return['product_id'] = \lib\utility\shortURL::encode($product_id);

		if(debug::$status)
		{
			debug::true(T_("Store successfuly added"));
		}

		return $return;
	}


	/**
	 * fix duplicate slug
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public static function slug_fix($_args)
	{
		if(!isset($_args['slug']))
		{
			$_args['slug'] = (string) \lib\user::id(). (string) rand(1000,5000);
		}

		$new_slug     = null;
		$similar_slug = \lib\db\products::get_similar_slug($_args['slug']);
		$count        = count($similar_slug);
		$i            = 1;
		$new_slug     = (string) $_args['slug']. (string) ((int) $count +  (int) $i);
		while (in_array($new_slug, $similar_slug))
		{
			$i++;
			$new_slug = (string) $_args['slug']. (string) ((int) $count +  (int) $i);
		}

		\lib\temp::set('last_product_added', $new_slug);
		return $new_slug;
	}
}
?>