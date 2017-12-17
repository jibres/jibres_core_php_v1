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
		'finalprice',
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

		$option             = [];
		$option             = array_merge($default_args, $_args);

		if($option['order'])
		{
			if(!in_array($option['order'], ['asc', 'desc']))
			{
				unset($option['order']);
			}
		}

		if($option['sort'])
		{
			if(!in_array($option['sort'], self::$sort_field))
			{
				unset($option['sort']);
			}
		}

		$field             = [];
		$field['store_id'] = \lib\store::id();
		$multi_record      = true;

		if(isset($_args['barcode']) && $_args['barcode'])
		{
			$result = \lib\db\products::search_barcode($_args['barcode'], \lib\store::id());
			$multi_record = false;
		}
		elseif (isset($_args['id']) && $_args['id'] && $id = \lib\utiility\shortURL::decode($_args['id']))
		{
			$result = \lib\db\products::search_id($id, \lib\store::id());
			$multi_record = false;
		}
		else
		{
			$result = \lib\db\products::search($_string, $option, $field);
		}

		if($multi_record)
		{
			$temp             = [];

			foreach ($result as $key => $value)
			{
				$check = self::ready($value);
				if($check)
				{
					$temp[] = $check;
				}
			}

		}
		else
		{
			$temp = self::ready($result);
		}

		return $temp;
	}
}
?>