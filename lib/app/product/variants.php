<?php
namespace lib\app\product;


class variants
{
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


	public static function set($_variants, $_id)
	{
		// load main product detail
		$product_detail = \lib\app\product\get::inline_get($_id);

		if(!$product_detail)
		{
			return false;
		}
		// set option variants to app variable
		\dash\app::variable($_variants);

		$variants = self::check_option_variable();
		if(!$variants)
		{
			return false;
		}

		$count = $variants['count'];

		$variants_json = json_encode($variants, JSON_UNESCAPED_UNICODE);
		$result = \lib\db\products\variants::update($variants_json, $product_detail['id']);

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


	private static function check_option_variable()
	{

		$optionname1 = self::check_option_name('optionname1');
		$optionname2 = self::check_option_name('optionname2');
		$optionname3 = self::check_option_name('optionname3');

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

		$optionvalue1 = self::check_option_value('optionvalue1');
		$optionvalue2 = self::check_option_value('optionvalue2');
		$optionvalue3 = self::check_option_value('optionvalue3');

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

		$variants['count'] = $count;

		if($count > 100)
		{
			if(\dash\url::isLocal())
			{
				\dash\notif::info("Count product variants = ". $count);
			}

			\dash\notif::error(T_("You can set maximum 100 variants"), ['element' => ['optionvalue1', 'optionvalue2', 'optionvalue3', 'optionname1', 'optionname2', 'optionname3']]);
			return false;
		}

		return $variants;
	}


	private static function check_option_name($_option_name)
	{
		$optionname = \dash\app::request($_option_name);
		if($optionname && mb_strlen($optionname) >= 100)
		{
			\dash\notif::error(T_("Please set option name less than 100 characters"), $_option_name);
			return false;
		}

		return $optionname;
	}


	private static function check_option_value($_option_value)
	{
		$optionvalue = \dash\app::request($_option_value);
		$optionvalue = explode(',', $optionvalue);
		if(is_array($optionvalue))
		{
			foreach ($optionvalue as $key => $value)
			{
				if(mb_strlen($value) >= 100)
				{
					\dash\notif::error(T_("Please set option value less than 100 characters"), $_option_value);
					return false;
				}
				$optionvalue[$key] = \dash\safe::safe($value);
			}
		}

		$optionvalue = array_unique($optionvalue);
		$optionvalue = array_filter($optionvalue);

		return $optionvalue;
	}


	/**
	 * clean json of variants
	 */
	public static function clean_product($_product_id)
	{
		if($_product_id && is_numeric($_product_id))
		{
			\dash\temp::set('productHasChange', true);
			\lib\db\products\variants::clean_product($_product_id);
		}
	}


	public static function set_product($_variants, $_product_id)
	{
		$load_product = \lib\app\product\get::inline_get($_product_id);
		if(!$load_product || !isset($load_product['id']))
		{
			// product not found
			return false;
		}

		$load_option_name = isset($load_product['variants']) ? $load_product['variants'] : null;
		if(!$load_option_name)
		{
			\dash\notif::error(T_("This product not ready to set variants"));
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

		$load_child = \lib\db\products\variants::have_child($load_product['id']);
		if($load_child)
		{
			\dash\notif::error(T_("This product have some child and can not set variants"));
			return false;
		}

		$option1_name = isset($load_option_name['variants']['option1']['name']) ? $load_option_name['variants']['option1']['name'] : null;
		$option2_name = isset($load_option_name['variants']['option2']['name']) ? $load_option_name['variants']['option2']['name'] : null;
		$option3_name = isset($load_option_name['variants']['option3']['name']) ? $load_option_name['variants']['option3']['name'] : null;

		$multi_product = [];

		foreach ($_variants as $key => $value)
		{
			$temp =
			[
				'parent'       => $load_product['id'],
				'optionname1'  => $option1_name,
				'optionvalue1' => array_key_exists('option1', $value) ? $value['option1'] : null,
				'optionname2'  => $option2_name,
				'optionvalue2' => array_key_exists('option2', $value) ? $value['option2'] : null,
				'optionname3'  => $option3_name,
				'optionvalue3' => array_key_exists('option3', $value) ? $value['option3'] : null,
				'stock'        => array_key_exists('stock', $value) ? $value['stock'] : null,
				'barcode'      => array_key_exists('barcode', $value) ? $value['barcode'] : null,
				'price'        => array_key_exists('price', $value) ? $value['price'] : null,
				'sku'          => array_key_exists('sku', $value) ? $value['sku'] : null,
			];


			if(!$temp['stock'] || !is_numeric($temp['stock']))
			{
				\dash\notif::error(T_("Zero stock!"));
				return false;
			}


			if(!$temp['price'] || !is_numeric($temp['price']))
			{
				\dash\notif::error(T_("Zero price!"));
				return false;
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
		if(!$_parent || !is_numeric($_parent))
		{
			return false;
		}

		$load_child = \lib\db\products\variants::load_child($_parent);
		if(is_array($load_child))
		{
			$load_child = array_map(['\\lib\\app\\product\\ready', 'row'], $load_child);
		}

		return $load_child;
	}

}
?>