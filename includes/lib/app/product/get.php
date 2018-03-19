<?php
namespace lib\app\product;


trait get
{


	/**
	 * Gets the product.
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     <type>  The product.
	 */
	public static function get($_args, $_option = [])
	{
		\lib\app::variable($_args);

		$default_option =
		[
			'debug' => true,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);

		if($_option['debug'])
		{
			\lib\notif::title(T_("Operation Faild"));
		}

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
			\lib\app::log('api:product:user:id:not:found', \lib\user::id(), $log_meta);
			if($_option['debug']) \lib\notif::error(T_("User id not found"));
			return false;
		}

		if(!\lib\store::id())
		{
			\lib\app::log('api:product:store:id:not:found', \lib\user::id(), $log_meta);
			if($_option['debug']) \lib\notif::error(T_("Store id not found"));
			return false;
		}


		$id = \lib\app::request("id");
		$id = \lib\coding::decode($id);
		if(!$id)
		{

			\lib\app::log('api:product:id:shortname:not:set', \lib\user::id(), $log_meta);
			if($_option['debug']) \lib\notif::error(T_("Store id or shortname not set"), 'id', 'arguments');
			return false;
		}

		$result = \lib\db\products::get(['id' => $id, 'store_id' => \lib\store::id(), 'limit' => 1]);

		if(!$result)
		{
			\lib\app::log('api:product:access:denide', \lib\user::id(), $log_meta);
			if($_option['debug']) \lib\notif::error(T_("Can not access to load this product details"), 'product');
			return false;
		}

		$result = self::ready($result);

		return $result;
	}
}
?>