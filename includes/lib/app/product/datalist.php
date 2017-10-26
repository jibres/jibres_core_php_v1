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
	public static function list($_args = [])
	{
		if(!\lib\user::id())
		{
			return false;
		}

		if(!\lib\store::id())
		{
			return false;
		}

		$search           = null;
		$meta             = [];
		$meta['store_id'] = \lib\store::id();
		$result           = \lib\db\products::search($search, $meta);
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