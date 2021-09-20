<?php
namespace lib\app\discount;


class dedicated
{
	public static function load_all_dedicated($_id, $_raw = false)
	{
		$id = \dash\validate::id($_id);
		if(!$id)
		{
			return false;
		}

		$list = \lib\db\discount_dedicated\get::by_discount_id($_id);

		if($_raw)
		{
			return $list;
		}

		/*=======================================
		=            Define variable            =
		=======================================*/
		$result                           = [];
		$result['special_products']       = [];
		$result['special_category']       = [];
		$result['special_customer_group'] = [];
		$result['special_customer']       = [];
		$result['special_country']        = [];
		$result['special_province']       = [];
		$result['special_city']           = [];
		$result['other']                  = [];
		/*=====  End of Define variable  ======*/

		foreach ($list as $key => $value)
		{
			if(array_key_exists(a($value, 'type'), $result))
			{
				$result[$value['type']][] = $value;
			}
		}
		return $result;
	}


	public static function sync($_args, $_id)
	{

		// `discount_id` bigint UNSIGNED DEFAULT NULL,
		// `type` enum(
		// 	'special_products',
		// 	'special_category',
		// 	'special_customer_group',
		// 	'special_customer',
		// 	'special_country',
		// 	'special_province',
		// 	'special_city',
		// 	'other') DEFAULT NULL,
		// `product_id` bigint UNSIGNED DEFAULT NULL,
		// `customer_id` bigint UNSIGNED DEFAULT NULL,
		// `product_category_id` bigint UNSIGNED DEFAULT NULL,
		// `specailvalue` varchar(200) DEFAULT NULL,
		// `datecreated` timestamp NULL DEFAULT NULL,


		$load_current_decicate = self::load_all_dedicated($_id);

		if(!$load_current_decicate)
		{
			return false;
		}

		if(a($_args, 'product_category'))
		{
			$category = $_args['product_category'];
			$category = array_filter($category);
			$category = array_unique($category);

			$load_multi_category = \lib\db\productcategory\get::mulit_title($category);

			if(!is_array($load_multi_category))
			{
				$load_multi_category = [];
			}
			
			$category_ids = array_column($load_multi_category, 'id');

			$must_insert = [];
			$must_remove = [];

			if($load_current_decicate['special_category'] && !$category_ids)
			{
				$must_remove = array_column($load_current_decicate['special_category'], 'id');
			}
			elseif(!$load_current_decicate['special_category'] && $category_ids)
			{
				$must_insert = $category_ids;
			}
			else
			{
				$current_ids = array_column($load_current_decicate['special_category'], 'product_category_id', 'id');

				$must_remove = array_keys(array_diff($current_ids, $category_ids));
				$must_insert = array_diff($category_ids, $current_ids);

			}

			if($must_insert)
			{
				$multi_insert = [];

				foreach ($must_insert as $key => $value)
				{
					$multi_insert[] =
					[
						'discount_id'         => $_id,
						'type'                => 'special_category',
						'product_category_id' => $value,
						'datecreated'         => date("Y-m-d H:i:s"),
					];
				}

				\lib\db\discount_dedicated\insert::multi_insert($multi_insert);
			}

			if($must_remove)
			{
				\lib\db\discount_dedicated\delete::multi_remove($must_remove);
			}
		}
	}

}
?>