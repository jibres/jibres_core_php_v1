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
	public static function inline_get($_id)
	{

		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store id not found"));
			return false;
		}

		$id = \dash\coding::decode($_id);

		if(!$id)
		{
			return false;
		}

		$result = \lib\db\products::get(['id' => $id, 'store_id' => \lib\store::id(), 'limit' => 1]);

		if(!$result)
		{
			return false;
		}

		return $result;
	}


	/**
	 * Gets the product.
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     <type>  The product.
	 */
	public static function get($_id, $_option = [])
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

		if(!\dash\user::id())
		{
			\dash\notif::error(T_("User id not found"));
			return false;
		}

		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store id not found"));
			return false;
		}


		$id = $_id;
		$id = \dash\coding::decode($id);
		if(!$id)
		{
			\dash\notif::error(T_("Store id or shortname not set"));
			return false;
		}

		$result = \lib\db\products::get(['id' => $id, 'store_id' => \lib\store::id(), 'limit' => 1]);

		if(!$result)
		{
			\dash\notif::error(T_("Can not access to load this product details"));
			return false;
		}

		$result = self::ready($result);

		return $result;
	}
}
?>