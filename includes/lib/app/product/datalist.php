<?php
namespace lib\app\product;

trait datalist
{

	public static $sort_field =
	[
		'title',
		'cat',
		'buyprice',
		'price',
		'discount',
		'discountpercent',
		'stock',
	];


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

		if($meta['order'])
		{
			if(!in_array($meta['order'], ['asc', 'desc']))
			{
				unset($meta['order']);
			}
		}

		if($meta['sort'])
		{
			if(!in_array($meta['sort'], self::$sort_field))
			{
				unset($meta['sort']);
			}
		}

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