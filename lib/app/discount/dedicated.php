<?php
namespace lib\app\discount;


class dedicated
{
	public static function customer_group()
	{
		return
		[
			['key' => 'notsale', 'title' => T_("Customers who have not yet purchased")],
			['key' => 'havesale', 'title' => T_("Customers who have purchased")],
		];
	}


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

		if($result['special_products'])
		{
			$load_multi_products = \lib\db\products\get::by_multi_id(implode(',', array_column($result['special_products'], 'product_id')));

			$load_multi_products = array_combine(array_column($load_multi_products, 'id'), $load_multi_products);

			foreach ($result['special_products'] as $key => $value)
			{
				if(isset($load_multi_products[a($value, 'product_id')]['title']))
				{
					$result['special_products'][$key]['product_title'] = $load_multi_products[a($value, 'product_id')]['title'];
				}
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

			$load_multi_category = [];

			if($category)
			{
				$load_multi_category = \lib\db\productcategory\get::mulit_title($category);

				if(!is_array($load_multi_category))
				{
					$load_multi_category = [];
				}
			}


			self::sync_data($_id, $load_current_decicate, $load_multi_category, 'special_category', 'product_category_id');
		}

		if(a($_args, 'special_products'))
		{
			$products = $_args['special_products'];
			$products = array_map('floatval', $products);
			$products = array_filter($products);
			$products = array_unique($products);

			$load_multi_products = [];

			if($products)
			{
				$load_multi_products = \lib\db\products\get::by_multi_id(implode(',', $products));

				if(!is_array($load_multi_products))
				{
					$load_multi_products = [];
				}
			}

			self::sync_data($_id, $load_current_decicate, $load_multi_products, 'special_products', 'product_id');
		}

		if(a($_args, 'customer_group'))
		{
			$group_key = $_args['customer_group'];

			$all_group_list = self::customer_group();

			if(!in_array($group_key, array_column($all_group_list, 'key')))
			{
				$group = [];
			}
			else
			{
				$group = ['id' => $group_key];
			}

			self::sync_data($_id, $load_current_decicate, [$group], 'special_customer_group', 'specailvalue');
		}
	}


	private static function sync_data($_id, $_load_current_decicate, $_special_data, $_type, $_field)
	{
		$data_ids = array_column($_special_data, 'id');

		$must_insert = [];
		$must_remove = [];

		if($_load_current_decicate[$_type] && !$data_ids)
		{
			$must_remove = array_column($_load_current_decicate[$_type], 'id');
		}
		elseif(!$_load_current_decicate[$_type] && $data_ids)
		{
			$must_insert = $data_ids;
		}
		else
		{
			$current_ids = array_column($_load_current_decicate[$_type], $_field, 'id');

			$must_remove = array_keys(array_diff($current_ids, $data_ids));
			$must_insert = array_diff($data_ids, $current_ids);

		}

		if($must_insert)
		{
			$multi_insert = [];

			foreach ($must_insert as $key => $value)
			{
				$multi_insert[] =
				[
					'discount_id' => $_id,
					'type'        => $_type,
					$_field       => $value,
					'datecreated' => date("Y-m-d H:i:s"),
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
?>