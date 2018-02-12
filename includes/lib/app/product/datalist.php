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
		'datemodified',
	];

	public static $search_in =
	[
		'cat',
		'buyprice',
		'price',
		'discount',
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
			'order'    => null,
			'sort'     => null,
			'cat'      => null,
			'buyprice' => null,
			'price'    => null,
			'discount' => null,
			'unit'     => null,
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

		// search in current field
		if($option['price'])
		{
			$field['price'] = $option['price'];
			$option['just_search_in_one_field'] = true;
		}

		if($option['cat'])
		{
			$field['cat'] = $option['cat'];
			$option['just_search_in_one_field'] = true;
		}

		if($option['buyprice'])
		{
			$field['buyprice'] = $option['buyprice'];
			$option['just_search_in_one_field'] = true;
		}

		if($option['discount'])
		{
			$field['discount'] = $option['discount'];
			$option['just_search_in_one_field'] = true;
		}

		if($option['unit'])
		{
			$field['unit'] = $option['unit'];
			$option['just_search_in_one_field'] = true;
		}

		if(!$option['order'])
		{
			$option['order'] = 'DESC';
		}

		if (isset($_args['barcode']) && $_args['barcode'])
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