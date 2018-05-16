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
		if(!\dash\user::id())
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


		if(isset($option['duplicatetitle']) && $option['duplicatetitle'])
		{
			$duplicate_id = \lib\db\products::get_duplicate_id(\lib\store::id());
			if(!$duplicate_id)
			{
				return [];
			}
			$duplicate_id = implode(',', $duplicate_id);
			$field['id']  = ["IN", "($duplicate_id)"];
			$result       = \lib\db\products::search($_string, $option, $field);

		}
		elseif (isset($option['hbarcode']) && $option['hbarcode'])
		{
			$field['barcode'] = [" IS NOT NULL ", " AND barcode2 IS NOT NULL"];
			$result = \lib\db\products::search($_string, $option, $field);
		}
		elseif (isset($option['hnotbarcode']) && $option['hnotbarcode'])
		{
			$field['barcode'] = [" IS NULL ", " AND barcode2 IS NULL"];
			$result = \lib\db\products::search($_string, $option, $field);
		}
		elseif (isset($option['justcode']) && $option['justcode'])
		{
			$field['code'] = [" IS NOT NULL ", " AND barcode2 IS NULL AND barcode IS NULL"];
			$result = \lib\db\products::search($_string, $option, $field);
		}
		elseif (isset($option['wcodbarcode']) && $option['wcodbarcode'])
		{
			$field['code'] = [" IS NULL ", " AND barcode2 IS NULL AND barcode IS NULL"];
			$result = \lib\db\products::search($_string, $option, $field);
		}
		elseif (isset($option['wbuyprice']) && $option['wbuyprice'])
		{
			$field['buyprice'] = [" IS ", " NULL "];
			$result = \lib\db\products::search($_string, $option, $field);
		}
		elseif (isset($option['wprice']) && $option['wprice'])
		{
			$field['price'] = [" IS ", " NULL "];
			$result = \lib\db\products::search($_string, $option, $field);
		}
		elseif (isset($option['wminstock']) && $option['wminstock'])
		{
			$field['minstock'] = [" IS ", " NULL "];
			$result = \lib\db\products::search($_string, $option, $field);
		}
		elseif (isset($option['wmaxstock']) && $option['wmaxstock'])
		{
			$field['maxstock'] = [" IS ", " NULL "];
			$result = \lib\db\products::search($_string, $option, $field);
		}
		elseif (isset($option['wdiscount']) && $option['wdiscount'])
		{
			$field['discount'] = [" IS ", " NULL "];
			$result = \lib\db\products::search($_string, $option, $field);
		}
		elseif (isset($_args['barcode']) && $_args['barcode'])
		{
			$result = \lib\db\products::search_barcode($_args['barcode'], \lib\store::id());
			$multi_record = false;
		}
		elseif (isset($_args['id']) && $_args['id'] && $id = \dash\coding::decode($_args['id']))
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