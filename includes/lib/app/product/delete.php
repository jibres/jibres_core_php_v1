<?php
namespace lib\app\product;

trait delete
{
	/**
	 * Gets the product.
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     <type>  The product.
	 */
	public static function delete($_id, $_option = [])
	{
		if(!\lib\user::id())
		{
			return false;
		}

		if(!\lib\store::id())
		{
			return false;
		}

		$id = \lib\utility\shortURL::decode($_id);
		if(!$id)
		{
			\lib\app::log('api:product:title:not:set', \lib\user::id(), $log_meta);
			if($_option['debug']) debug::error(T_("Product title can not be null"), 'title');
			return false;
		}
	}
}
?>