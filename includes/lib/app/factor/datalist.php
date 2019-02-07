<?php
namespace lib\app\factor;

trait datalist
{

	public static $sort_field =
	[
		'title',
		'date',
		'detailsum',
		'detailtotalsum',
		'detaildiscount',
		'item',
		'qty',
		'customer',

	];


	/**
	 * Gets the factor.
	 *
	 * @param      <type>  $_option  The arguments
	 *
	 * @return     <type>  The factor.
	 */
	public static function list($_string = null, $_option = [])
	{
		if(!\dash\user::id())
		{
			return false;
		}


		if(!\lib\store::id())
		{
			return false;
		}

		$default_option =
		[
			'order'        => null,
			'sort'         => null,
			'type'         => null,
			'customer'     => null,
			'load_product' => false,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);

		if($_option['order'])
		{
			if(!in_array($_option['order'], ['asc', 'desc']))
			{
				unset($_option['order']);
			}
		}

		if($_option['sort'])
		{
			if(!in_array($_option['sort'], self::$sort_field))
			{
				unset($_option['sort']);
			}
		}

		$field             = [];
		$field['factors.store_id'] = \lib\store::id();

		if($_option['type'])
		{
			$field['factors.type']     = $_option['type'];
		}

		if(!\dash\permission::check('factorAccess'))
		{
			return [];
		}

		if($_option['type'])
		{
			switch ($_option['type'])
			{
				case 'buy':
					if(!\dash\permission::check('factorBuyList'))
					{
						return [];
					}
					break;

				case 'sale':
					if(!\dash\permission::check('factorSaleList'))
					{
						return [];
					}
					break;
			}
		}
		else
		{
			$just_in  = [];

			if(\dash\permission::check('factorBuyList'))
			{
				array_push($just_in, "'buy'");
			}

			if(\dash\permission::check('factorSaleList'))
			{
				array_push($just_in, "'sale'");
			}

			if(!empty($just_in))
			{
				$just_in               = implode(',', $just_in);
				$field['factors.type'] = [" IN ", "($just_in)"];
			}
			else
			{
				return [];
			}
		}

		if($_option['customer'])
		{
			$customer_id = \dash\coding::decode($_option['customer']);
			if($customer_id)
			{
				$field['factors.customer']     = $customer_id;
			}
		}

		$result            = \lib\db\factors::search($_string, $_option, $field);
		$temp              = [];

		if(isset($_option['load_product']) && $_option['load_product'] && is_array($result))
		{
			$factors_id = array_column($result, 'id');
			$factors_id = array_unique($factors_id);
			$factors_id = array_filter($factors_id);

			if($factors_id)
			{
				// load all product in this factor
				$factors_id    = implode(',', $factors_id);
				$factor_detail = \lib\db\factordetails::get(['factor_id' => ["IN", "($factors_id)"]]);
				// load all product in this factors
				$products_id   = [];
				if(is_array($factor_detail))
				{
					$products_id = array_column($factor_detail, 'product_id');
					$products_id = array_unique($products_id);
					$products_id = array_filter($products_id);

					if($products_id)
					{
						$products_id = implode(',', $products_id);
						$product_detail = \lib\db\products::get(['id' => ["IN", "($products_id)"]]);
						if($product_detail && is_array($product_detail))
						{
							$result = self::merge_detail($result, $factor_detail, $product_detail);
						}
					}

				}

			}
		}

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


	private static function merge_detail($_result, $_factor_detail, $_produect_detail)
	{
		$product_detail = array_combine(array_column($_produect_detail, 'id'), $_produect_detail);

		$factor_product = [];
		foreach ($_factor_detail as $key => $value)
		{
			if(!isset($factor_product[$value['factor_id']]))
			{
				$factor_product[$value['factor_id']] = [];
			}
			$temp = [];
			if(isset($product_detail[$value['product_id']]['title']))
			{
				$temp_title = $product_detail[$value['product_id']]['title'];
				$temp['title'] = $temp_title;
			}

			$temp['count'] = $value['count'];
			$temp['id']    = \dash\coding::encode($value['product_id']);
			if(count($factor_product[$value['factor_id']]) >= 10)
			{
				continue;
			}

			$factor_product[$value['factor_id']][] = $temp;
		}

		foreach ($_result as $key => $value)
		{
			if(isset($factor_product[$value['id']]))
			{
				$_result[$key]['productInFactor'] = $factor_product[$value['id']];
			}
		}

		return $_result;
	}
}
?>
