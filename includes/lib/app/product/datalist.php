<?php
namespace lib\app\product;

trait datalist
{
	/**
	 * Gets the product.
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     <type>  The product.
	 */
	public static function list($_string = null, $_args = [])
	{
		if(!\lib\user::id())
		{
			return false;
		}

		if(!\lib\store::id())
		{
			return false;
		}

		$default_args =
		[
			'order'  => null,
			'sort'   => null,
		];

		if(!is_array($_args))
		{
			$_args = [];
		}

		$meta             = [];
		$meta             = array_merge($default_args, $_args);
		$meta['store_id'] = \lib\store::id();
		$result           = \lib\db\products::search($_string, $meta);
		$temp             = [];

		foreach ($result as $key => $value)
		{
			$check = self::ready($value);
			if($check)
			{
				$temp[] = $check;
			}
		}

		return $temp;
	}
}
?>