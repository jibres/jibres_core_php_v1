<?php
namespace lib\app\product;


class variants
{

	// this field must be copy to child and update it whene the parent was updated
	public static function parent_field()
	{
		return ['title', 'slug', 'cat_id', 'unit_id', 'type', 'trackquantity', 'oversale', 'status'];
	}


	public static function get($_id)
	{
		// load main product detail
		$product_detail = \lib\app\product\get::get($_id);

		if(!$product_detail)
		{
			return false;
		}

		$variants = [];
		if(isset($product_detail['variants']) && $product_detail['variants'] && is_string($product_detail['variants']))
		{
			$variants = json_decode($product_detail['variants'], true);
		}

		if(!is_array($variants))
		{
			$variants = [];
		}
		if(isset($variants['variants']) && is_array($variants['variants']))
		{
			$myVariants = $variants['variants'];
			$temp_product = [];

			if(isset($myVariants['option1']['value']) && is_array($myVariants['option1']['value']))
			{
				foreach ($myVariants['option1']['value'] as $optionname1)
				{
					if(isset($myVariants['option2']['value']) && is_array($myVariants['option2']['value']))
					{
						foreach ($myVariants['option2']['value'] as $optionname2)
						{
							if(isset($myVariants['option3']['value']) && is_array($myVariants['option3']['value']))
							{
								foreach ($myVariants['option3']['value'] as $optionname3)
								{
									$temp_product[] = [$myVariants['option1']['name'] => $optionname1, $myVariants['option2']['name'] => $optionname2, $myVariants['option3']['name'] => $optionname3];
								}
							}
							else
							{
								$temp_product[] = [$myVariants['option1']['name'] => $optionname1, $myVariants['option2']['name'] => $optionname2];
							}
						}
					}
					else
					{
						$temp_product[] = [$myVariants['option1']['name'] => $optionname1];
					}
				}
			}

			$variants['temp_product'] = $temp_product;
		}

		return $variants;

	}



	/**
	 * make json of variants
	 */
	public static function set($_variants, $_id)
	{
		if(!\lib\store::in_store())
		{
			\dash\notif::error(T_("Your are not in this store!"));
			return false;
		}

		// load main product detail
		$product_detail = \lib\app\product\get::inline_get($_id);

		if(!$product_detail || !isset($product_detail['type']))
		{
			return false;
		}

		if($product_detail['type'] !== 'product')
		{
			\dash\notif::error(T_("Variants not avalible on product by type :type", ['type' => T_(ucfirst($product_detail['type']))]));
			return false;
		}

		if(isset($product_detail['parent']) && $product_detail['parent'])
		{
			\dash\notif::error(T_("This product was child of another product and can not set variantable"));
			return false;
		}

		if(isset($product_detail['variant_child']) && $product_detail['variant_child'])
		{
			\dash\notif::error(T_("This product have some child and can not be set variants"));
			return false;
		}


		if(\lib\app\product\get::first_sale($_id))
		{
			\dash\notif::error(T_("Can not set variants after sale, buy or any factor type of this products"));
			return false;
		}

		$variants = self::check_option_variable($_variants);
		if(!$variants)
		{
			return false;
		}

		$count = $variants['count'];

		$variants_json = json_encode($variants, JSON_UNESCAPED_UNICODE);
		$result = \lib\db\products\update::variants_update($variants_json, $product_detail['id']);

		if($result)
		{
			\dash\notif::ok(T_("Your variants was created"));
			return true;
		}
		else
		{
			\dash\log::set('dbErrorProductVariants');
			\dash\notif::error(T_("Sorry!, Cannot insert or update data"));
			return false;
		}
	}


	private static function check_option_variable($_args)
	{

		$condition =
		[
			'optionname1'  => 'string_20',
			'optionname2'  => 'string_20',
			'optionname3'  => 'string_20',
			'optionvalue1' => 'tag',
			'optionvalue2' => 'tag',
			'optionvalue3' => 'tag',
		];


		$require = [];
		$meta    = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		$optionname1 = $data['optionname1'];
		$optionname2 = $data['optionname2'];
		$optionname3 = $data['optionname3'];

		if(!\dash\engine\process::status())
		{
			return false;
		}

		if(($optionname1 || $optionname2) && $optionname1 === $optionname2)
		{
			\dash\notif::error(T_("Duplicate option name"), ['element' => ['optionname1', 'optionname2']]);
			return false;
		}

		if(($optionname3 || $optionname2) && $optionname3 === $optionname2)
		{
			\dash\notif::error(T_("Duplicate option name"), ['element' => ['optionname3', 'optionname2']]);
			return false;
		}

		if(($optionname3 || $optionname1) && $optionname3 === $optionname1)
		{
			\dash\notif::error(T_("Duplicate option name"), ['element' => ['optionname3', 'optionname1']]);
			return false;
		}

		$optionvalue1 = $data['optionvalue1'];
		$optionvalue2 = $data['optionvalue2'];
		$optionvalue3 = $data['optionvalue3'];

		if(!\dash\engine\process::status())
		{
			return false;
		}

		$variants = [];
		$number   = 0;
		$count    = 1;
		if($optionname1 && $optionvalue1)
		{
			$number++;
			$variants['variants']['option'. $number] = ['name' => $optionname1, 'value' => $optionvalue1];
			$count *= count($optionvalue1);
		}

		if($optionname2 && $optionvalue2)
		{
			$number++;
			$variants['variants']['option'. $number] = ['name' => $optionname2, 'value' => $optionvalue2];
			$count *= count($optionvalue2);
		}

		if($optionname3 && $optionvalue3)
		{
			$number++;
			$variants['variants']['option'. $number] = ['name' => $optionname3, 'value' => $optionvalue3];
			$count *= count($optionvalue3);
		}

		if(!$number)
		{
			\dash\notif::error(T_("Please fill variants detail"), ['element' => ['optionvalue1', 'optionvalue2', 'optionvalue3', 'optionname1', 'optionname2', 'optionname3']]);
			return false;
		}

		$variants['count'] = $count;


		if($count > 100)
		{
			if(\dash\url::isLocal())
			{
				\dash\notif::info("Local Message: Count product variants = ". $count);
			}

			\dash\notif::error(T_("You can set maximum 100 variants"), ['element' => ['optionvalue1', 'optionvalue2', 'optionvalue3', 'optionname1', 'optionname2', 'optionname3']]);
			return false;
		}

		return $variants;
	}



	/**
	 * clean json of variants
	 */
	public static function clean_product($_product_id)
	{
		if(!\lib\store::in_store())
		{
			\dash\notif::error(T_("Your are not in this store!"));
			return false;
		}

		$_product_id = \dash\validate::id($_product_id);
		if($_product_id)
		{
			\dash\temp::set('productHasChange', true);
			\lib\db\products\update::variants_clean_product($_product_id);
		}
	}


	public static function set_product($_variants, $_product_id)
	{
		if(!\lib\store::in_store())
		{
			\dash\notif::error(T_("Your are not in this store!"));
			return false;
		}

		$load_product = \lib\app\product\get::inline_get($_product_id);
		if(!$load_product || !isset($load_product['id']) || !isset($load_product['type']))
		{
			// product not found
			return false;
		}

		if($load_product['type'] !== 'product')
		{
			\dash\notif::error(T_("Variants not avalible on product by type :type", ['type' => T_(ucfirst($load_product['type']))]));
			return false;
		}


		$load_option_name = isset($load_product['variants']) ? $load_product['variants'] : null;
		if(!$load_option_name)
		{
			\dash\notif::error(T_("This product not ready to set variants"));
			return false;
		}

		if(isset($load_product['variant_child']) && $load_product['variant_child'])
		{
			\dash\notif::error(T_("This product have some child and can not set variants"));
			return false;
		}

		if(is_string($load_option_name))
		{
			$load_option_name = json_decode($load_option_name, true);
		}

		if(!is_array($load_option_name) || !isset($load_option_name['variants']))
		{
			\dash\notif::error(T_("Variants of product not found"));
			\dash\log::set('ProductVariantsJsonNotFound');
			return false;
		}

		$option1_name = isset($load_option_name['variants']['option1']['name']) ? $load_option_name['variants']['option1']['name'] : null;
		$option2_name = isset($load_option_name['variants']['option2']['name']) ? $load_option_name['variants']['option2']['name'] : null;
		$option3_name = isset($load_option_name['variants']['option3']['name']) ? $load_option_name['variants']['option3']['name'] : null;

		$multi_product = [];

		$parent_fields = self::parent_field();
		$condition =
		[
			'list'  =>
			[
				'option1'  => 'string_20',
				'option2'  => 'string_20',
				'option3'  => 'string_20',
				'stock'    => 'int',
				'barcode'  => 'barcode',
				'price'    => 'price',
				'buyprice' => 'price',
				'discount' => 'price',
				// 'sku'      => 'sku',
			]
		];


		$require = [];
		$meta    = [];

		$data = \dash\cleanse::input(['list' => $_variants], $condition, $require, $meta);

		$variants_list = $data['list'];

		foreach ($variants_list as $key => $value)
		{
			$temp =
			[
				'parent'        => $load_product['id'],
				'optionname1'   => $option1_name,
				'optionvalue1'  => array_key_exists('option1', $value) ? $value['option1'] : null,
				'optionname2'   => $option2_name,
				'optionvalue2'  => array_key_exists('option2', $value) ? $value['option2'] : null,
				'optionname3'   => $option3_name,
				'optionvalue3'  => array_key_exists('option3', $value) ? $value['option3'] : null,
				'stock'         => array_key_exists('stock', $value) ? $value['stock'] : null,
				'trackquantity' => (isset($value['stock']) && $value['stock']) ? 'yes' : null,
				'barcode'       => array_key_exists('barcode', $value) ? $value['barcode'] : null,
				'price'         => array_key_exists('price', $value) ? $value['price'] : null,
				'buyprice'      => array_key_exists('buyprice', $value) ? $value['buyprice'] : null,
				'discount'      => array_key_exists('discount', $value) ? $value['discount'] : null,
				// 'sku'           => array_key_exists('sku', $value) ? $value['sku'] : null,
				'title2'        => isset($load_product['title2']) ? $load_product['title2'] : null,
			];

			// if(!$temp['stock'] || !is_numeric($temp['stock']))
			// {
			// 	\dash\notif::error(T_("Zero stock!"));
			// 	return false;
			// }

			// if(!$temp['price'] || !is_numeric($temp['price']))
			// {
			// 	\dash\notif::error(T_("Zero price!"));
			// 	return false;
			// }

			foreach ($parent_fields as $parent_field)
			{
				if(isset($load_product[$parent_field]))
				{
					$temp[$parent_field] = $load_product[$parent_field];
				}
			}

			$multi_product[] = $temp;
		}


		if(empty($multi_product))
		{
			\dash\notif::error(T_("No avalible product to insert"));
			return false;
		}

		$result = \lib\app\product\add::multi_add($multi_product);

		if($result)
		{
			\lib\db\products\update::variant_child($_product_id);

			\lib\db\productinventory\delete::by_product_id($_product_id);

			\dash\notif::ok(T_("Your products was inserted"));
			return true;
		}
		else
		{
			\dash\notif::error(T_("Can not add product"));
			return false;
		}
	}

	// load every product by this parent id
	public static function family($_parent)
	{
		$_parent = \dash\validate::id($_parent);
		if(!$_parent)
		{
			return false;
		}

		$load_child = \lib\db\products\get::variants_load_child($_parent);
		if(is_array($load_child))
		{
			$load_child = array_map(['\\lib\\app\\product\\ready', 'row'], $load_child);
		}

		return $load_child;
	}




	public static function edit_option($_args, $_id)
	{

		$condition =
		[
			'optionname1'  => 'string_20',
			'optionname2'  => 'string_20',
			'optionname3'  => 'string_20',
			'optionvalue1' => 'string_30',
			'optionvalue2' => 'string_30',
			'optionvalue3' => 'string_30',
		];


		$require = [];
		$meta    = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$product_detail = \lib\app\product\load::one($_id);

		if(!$product_detail || !isset($product_detail['type']))
		{
			return false;
		}

		if($product_detail['type'] !== 'product')
		{
			\dash\notif::error(T_("Variants not avalible on product by type :type", ['type' => T_(ucfirst($product_detail['type']))]));
			return false;
		}

		if(isset($product_detail['parent']) && $product_detail['parent'])
		{
			\dash\notif::error(T_("This product was child of another product and can not set variantable"));
			return false;
		}

		if(!\dash\get::index($product_detail, 'variant_child'))
		{
			\dash\notif::error(T_("This product have not child!"));
			return false;
		}


		$child = \dash\get::index($product_detail, 'child');
		if(!is_array($child))
		{
			$child = [];
		}

		if(empty($child))
		{
			\dash\notif::error(T_("This product have not child!"));
			return false;
		}

		$all_optionname = [];

		$current_optionname1  = array_column($child, 'optionname1');
		$current_optionname1  = array_filter($current_optionname1);
		$current_optionname1  = array_unique($current_optionname1);
		if($current_optionname1 && isset($current_optionname1[0]))
		{
			$all_optionname[] = $current_optionname1[0];
		}

		$current_optionname2  = array_column($child, 'optionname2');
		$current_optionname2  = array_filter($current_optionname2);
		$current_optionname2  = array_unique($current_optionname2);
		if($current_optionname2 && isset($current_optionname2[0]))
		{
			$all_optionname[] = $current_optionname2[0];
		}

		$current_optionname3  = array_column($child, 'optionname3');
		$current_optionname3  = array_filter($current_optionname3);
		$current_optionname3  = array_unique($current_optionname3);
		if($current_optionname3 && isset($current_optionname3[0]))
		{
			$all_optionname[] = $current_optionname3[0];
		}

		$current_optionvalue1 = array_column($child, 'optionvalue1');
		$current_optionvalue1 = array_filter($current_optionvalue1);
		$current_optionvalue1 = array_unique($current_optionvalue1);

		$current_optionvalue2 = array_column($child, 'optionvalue2');
		$current_optionvalue2 = array_filter($current_optionvalue2);
		$current_optionvalue2 = array_unique($current_optionvalue2);

		$current_optionvalue3 = array_column($child, 'optionvalue3');
		$current_optionvalue3 = array_filter($current_optionvalue3);
		$current_optionvalue3 = array_unique($current_optionvalue3);

		$count_empty = 0;
		$update      = [];

		if(($current_optionname1 && $current_optionvalue1) && ($current_optionname2 && $current_optionvalue2) && ($current_optionname3 && $current_optionvalue3))
		{
			\dash\notif::error(T_("Variants option of this product is full"));
			return false;
		}
		elseif(($current_optionname1 && $current_optionvalue1) && ($current_optionname2 && $current_optionvalue2) && (!$current_optionname3 && !$current_optionvalue3))
		{

			if($data['optionname1'] && $data['optionvalue1'])
			{
				$update['optionname3']  = $data['optionname1'];
				$update['optionvalue3'] = $data['optionvalue1'];
			}
			elseif($data['optionname2'] && $data['optionvalue2'])
			{
				$update['optionname3']  = $data['optionname2'];
				$update['optionvalue3'] = $data['optionvalue2'];
			}
			elseif($data['optionname3'] && $data['optionvalue3'])
			{
				$update['optionname3']  = $data['optionname3'];
				$update['optionvalue3'] = $data['optionvalue3'];
			}
		}
		elseif(($current_optionname1 && $current_optionvalue1) && (!$current_optionname2 && !$current_optionvalue2) && (!$current_optionname3 && !$current_optionvalue3))
		{
			if($data['optionname1'] && $data['optionvalue1'])
			{
				$update['optionname2']  = $data['optionname1'];
				$update['optionvalue2'] = $data['optionvalue1'];
			}

			if($data['optionname2'] && $data['optionvalue2'])
			{
				if(isset($update['optionname2']))
				{
					$update['optionname3']  = $data['optionname2'];
					$update['optionvalue3'] = $data['optionvalue2'];
				}
				else
				{
					$update['optionname2']  = $data['optionname2'];
					$update['optionvalue2'] = $data['optionvalue2'];
				}
			}

			if($data['optionname3'] && $data['optionvalue3'])
			{
				if(isset($update['optionname2']))
				{
					$update['optionname3']  = $data['optionname3'];
					$update['optionvalue3'] = $data['optionvalue3'];
				}
				else
				{
					$update['optionname2']  = $data['optionname3'];
					$update['optionvalue2'] = $data['optionvalue3'];
				}
			}


		}
		elseif((!$current_optionname1 && !$current_optionvalue1) && (!$current_optionname2 && !$current_optionvalue2) && (!$current_optionname3 && !$current_optionvalue3))
		{
			\dash\notif::error(T_("Variants option is empty. Please contact to administrator"));
			return false;
		}
		elseif((!$current_optionname1 && !$current_optionvalue1) && ($current_optionname2 && $current_optionvalue2) && ($current_optionname3 && $current_optionvalue3))
		{

			if($data['optionname1'] && $data['optionvalue1'])
			{
				$update['optionname1']  = $data['optionname1'];
				$update['optionvalue1'] = $data['optionvalue1'];
			}
			elseif($data['optionname2'] && $data['optionvalue2'])
			{
				$update['optionname1']  = $data['optionname2'];
				$update['optionvalue1'] = $data['optionvalue2'];
			}
			elseif($data['optionname3'] && $data['optionvalue3'])
			{
				$update['optionname1']  = $data['optionname3'];
				$update['optionvalue1'] = $data['optionvalue3'];
			}
		}
		elseif((!$current_optionname1 && !$current_optionvalue1) && (!$current_optionname2 && !$current_optionvalue2) && ($current_optionname3 && $current_optionvalue3))
		{

			if($data['optionname1'] && $data['optionvalue1'])
			{
				$update['optionname1']  = $data['optionname1'];
				$update['optionvalue1'] = $data['optionvalue1'];
			}

			if($data['optionname2'] && $data['optionvalue2'])
			{
				if(isset($update['optionname1']))
				{
					$update['optionname2']  = $data['optionname2'];
					$update['optionvalue2'] = $data['optionvalue2'];
				}
				else
				{
					$update['optionname1']  = $data['optionname2'];
					$update['optionvalue1'] = $data['optionvalue2'];
				}
			}

			if($data['optionname3'] && $data['optionvalue3'])
			{
				if(isset($update['optionname1']))
				{
					$update['optionname2']  = $data['optionname3'];
					$update['optionvalue2'] = $data['optionvalue3'];
				}
				else
				{
					$update['optionname1']  = $data['optionname3'];
					$update['optionvalue1'] = $data['optionvalue3'];
				}
			}

		}
		elseif(($current_optionname1 && $current_optionvalue1) && (!$current_optionname2 && !$current_optionvalue2) && ($current_optionname3 && $current_optionvalue3))
		{

			if($data['optionname1'] && $data['optionvalue1'])
			{
				$update['optionname2']  = $data['optionname1'];
				$update['optionvalue2'] = $data['optionvalue1'];
			}
			elseif($data['optionname2'] && $data['optionvalue2'])
			{
				$update['optionname2']  = $data['optionname2'];
				$update['optionvalue2'] = $data['optionvalue2'];
			}
			elseif($data['optionname3'] && $data['optionvalue3'])
			{
				$update['optionname2']  = $data['optionname3'];
				$update['optionvalue2'] = $data['optionvalue3'];
			}
		}
		elseif((!$current_optionname1 && !$current_optionvalue1) && ($current_optionname2 && $current_optionvalue2) && (!$current_optionname3 && !$current_optionvalue3))
		{
			if($data['optionname1'] && $data['optionvalue1'])
			{
				$update['optionname1']  = $data['optionname1'];
				$update['optionvalue1'] = $data['optionvalue1'];
			}

			if($data['optionname2'] && $data['optionvalue2'])
			{
				if(isset($update['optionname1']))
				{
					$update['optionname3']  = $data['optionname2'];
					$update['optionvalue3'] = $data['optionvalue2'];
				}
				else
				{
					$update['optionname1']  = $data['optionname2'];
					$update['optionvalue1'] = $data['optionvalue2'];
				}
			}

			if($data['optionname3'] && $data['optionvalue3'])
			{
				if(isset($update['optionname1']))
				{
					$update['optionname3']  = $data['optionname3'];
					$update['optionvalue3'] = $data['optionvalue3'];
				}
				else
				{
					$update['optionname1']  = $data['optionname3'];
					$update['optionvalue1'] = $data['optionvalue3'];
				}
			}

		}
		else
		{
			\dash\log::oops('variantsChild');
			return false;
		}



		// check not duplocate in other option
		if(empty($update))
		{
			\dash\notif::error(T_("Please add the new option"));
			return false;
		}

		$check_duplicate = [];
		foreach ($update as $key => $value)
		{
			if(substr($key, 0, 10) === 'optionname')
			{
				$check_duplicate[] = $value;
				if(in_array($value, $all_optionname))
				{
					\dash\notif::error(T_("This option is exist. Try another option"), ['element' => ['optionname1', 'optionname2', 'optionname3']]);
					return false;
				}
			}
		}

		if(count($check_duplicate) !== count(array_unique($check_duplicate)))
		{
			\dash\notif::error(T_("Duplicate option name"), ['element' => ['optionname1', 'optionname2', 'optionname3']]);
			return false;
		}


		\lib\db\products\update::edit_option($update, $product_detail['id']);
		\dash\notif::ok(T_("Product variants option updated"));
		return true;
	}

}
?>