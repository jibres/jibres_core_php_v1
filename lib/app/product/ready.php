<?php
namespace lib\app\product;


class ready
{
	public static function row_quick($_data)
	{
		$args =
		[
			'load_gallery'     => false,
			'parent_thumb'     => false,
			'check_allow_shop' => false,
			'check_cart_limit' => false,
		];

		return self::row($_data, $args);
	}


	public static function row($_data, $_option = [])
	{
		$default_option =
		[
			'load_gallery'     => false,
			'parent_thumb'     => null,
			'check_allow_shop' => true,
			'check_cart_limit' => true,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);

		$result = [];

		if(!is_array($_data))
		{
			return null;
		}


		$currency = \lib\currency::name(\lib\store::detail('currency'));


		foreach ($_data as $key => $value)
		{

			switch ($key)
			{
				case 'id':
					$result[$key] = $value;
					$result['url'] = \lib\store::url(). '/p/'. $value;
					if(\dash\url::content() === 'a')
					{
						$result['edit_url'] = \dash\url::here(). '/products/edit?id='. $value;
					}
					break;

				case 'unit_id':
					$result[$key] = $value;
					break;

				case 'creator':
					if(isset($value))
					{
						$result[$key] = \dash\coding::encode($value);
					}
					else
					{
						$result[$key] = null;
					}
					break;

				case 'title':
					$result['title'] = isset($value) ? (string) $value : null;
					if(a($_data, 'optionname1') && a($_data, 'optionvalue1'))
					{
						$result['title'] .= ' - '. a($_data, 'optionname1'). ' '. a($_data, 'optionvalue1');
					}

					if(a($_data, 'optionname2') && a($_data, 'optionvalue2'))
					{
						$result['title'] .= ' - '. a($_data, 'optionname2'). ' '. a($_data, 'optionvalue2');
					}

					if(a($_data, 'optionname3') && a($_data, 'optionvalue3'))
					{
						$result['title'] .= ' - '. a($_data, 'optionname3'). ' '. a($_data, 'optionvalue3');
					}
					break;

				case 'slug':
					$result[$key] = $value;
					if(isset($result['url']))
					{
						$result['url'] = $result['url']. '/'. $value;
					}
					break;

				case 'thumb':
					if(!$value)
					{
						if(isset($_option['parent_thumb']) && $_option['parent_thumb'])
						{
							$result[$key] = $_option['parent_thumb'];
						}
						else
						{
							if(isset($value))
							{
								$result[$key] = \lib\filepath::fix($value);
							}
							else
							{
								$result[$key] = \dash\app::static_image_url();
								$result['thumb_default'] = true;
							}
						}
					}
					else
					{
						if(isset($value))
						{
							$result[$key] = \lib\filepath::fix($value);
						}
						else
						{
							$result[$key] = \dash\app::static_image_url();
							$result['thumb_default'] = true;
						}
					}
					break;


				case 'gallery':
					if($value)
					{
						$result['gallery_array'] = json_decode($value, true);
						if($_option['load_gallery'] && is_array($result['gallery_array']) && $result['gallery_array'])
						{
							$result['gallery_array'] = \lib\app\product\gallery::load_detail($result['gallery_array']);
						}
					}
					else
					{
						$result['gallery_array'] = null;
					}
					break;

				case 'bullet':
					if($value)
					{
						$result[$key] = json_decode($value, true);
					}
					else
					{
						$result[$key] = [];
					}
					break;

				case 'sold_price':
					if($value)
					{
						$result[$key] = \lib\price::total_down($value);
					}
					else
					{
						$result[$key] = $value;
					}

					break;

				case 'sold_count': // get from report
				case 'weight':
				case 'stock':
				case 'sold':
				case 'bought':
					if($value)
					{
						$result[$key] = \lib\number::down($value);
					}
					else
					{
						$result[$key] = $value;
					}
					break;

				case 'price':
				case 'buyprice':
				case 'discount':
				case 'discountpercent':
				case 'finalprice':
					$result['currency'] = $currency;
					if($value)
					{
						$result[$key] = \lib\price::down($value);
					}
					else
					{
						$result[$key] = $value;
					}
					break;

				case 'intrestrate':
				case 'intrestrate_impure':
					$result[$key] = isset($value) ? (float) $value : null;
					break;

				case 'vat':
				case 'trackquantity':
				case 'instock':
				case 'oversale':
				case 'saleonline':
				case 'saletelegram':
				case 'saleapp':
					if($value === 'yes')
					{
						$value = true;
					}
					else
					{
						$value = false;
					}
					$result[$key] = $value;
					break;

				case 'preparationtime':
					$result[$key]          = $value;
					$preparationdate       = null;
					$preparationdatestring = null;
					if($value && is_numeric($value))
					{
						$value = floatval($value);

						$product_setting = \lib\app\setting\get::product_setting();
						if(isset($product_setting['preparationtime']) && is_numeric($product_setting['preparationtime']))
						{
							$value = floatval($product_setting['preparationtime']) + floatval($value);
						}

						$value = $value * 60 * 60;

						$preparationdate = date("Y-m-d", time() + $value);

						if($value < (60*60*24))
						{
							if(date("H") > 12)
							{
								$preparationdatestring = T_("Tomorrow");
							}
							else
							{
								$preparationdatestring = T_("Today");
							}
						}
						elseif($value < (60*60*24*2))
						{
							$preparationdatestring = T_("Tomorrow");
						}
						else
						{
							$preparationdatestring = \dash\datetime::fit($preparationdate, 'l j F Y', 'date');
						}

					}
					$result['preparationdate'] = $preparationdate;
					$result['preparationdatestring'] = $preparationdatestring;
					break;

				case 'desc':

					$result[$key] = \lib\shortcode::analyze_desc_html($value);

					if(\dash\engine\content::is('content_business'))
					{
						if(isset($_data['tags']) && $_data['tags'] && is_array($_data['tags']))
						{
							$result[$key] = \dash\app\terms\find::tags_link($result[$key], $_data['tags']);
						}
					}
					break;

				case 'country':
				case 'city':
				case 'province':
				case 'zipcode':
				case 'name':
				case 'alias':
				case 'status':
				default:
					$result[$key] = $value;
					break;
			}
		}

		$result['category_list'] = [];

		if($_option['check_allow_shop'])
		{
			self::allow_shop($result);
		}

		if($_option['check_cart_limit'])
		{
			self::cart_limit($result);
		}

		return $result;
	}


	private static function cart_limit(&$result)
	{
		$max_cart_limit = 100;
		$minsale        = 1;
		$maxsale        = $max_cart_limit;
		$salestep       = 1;

		$cart_setting = \lib\app\setting\get::cart_setting();

		if(isset($cart_setting['maxproductincart']) && is_numeric($cart_setting['maxproductincart']) && $cart_setting['maxproductincart'])
		{
			$max_cart_limit = floatval($cart_setting['maxproductincart']);
		}

		if(isset($result['minsale']) && is_numeric($result['minsale']) && $result['minsale'])
		{
			$minsale = floatval($result['minsale']);
		}

		if(isset($result['maxsale']) && is_numeric($result['maxsale']) && $result['maxsale'])
		{
			$maxsale = floatval($result['maxsale']);
		}
		else
		{
			$maxsale = $max_cart_limit;
		}

		if(isset($result['salestep']) && is_numeric($result['salestep']) && $result['salestep'])
		{
			$salestep = floatval($result['salestep']);
		}

		if(isset($result['stock']) && $result['stock'] && isset($result['trackquantity']) && $result['trackquantity'])
		{
			$maxsale = floatval($result['stock']);
		}

		if(isset($result['oversale']) && $result['oversale'])
		{
			$maxsale = $max_cart_limit;
		}

		if(isset($result['type']) && $result['type'] === 'file')
		{
			$minsale = 1;
			$maxsale = 1;
			$salestep = 1;
		}


		$result['cart_limit']                   = [];
		$result['cart_limit']['min_sale']       = $minsale;
		$result['cart_limit']['max_sale']       = $maxsale;
		$result['cart_limit']['sale_step']      = $salestep;
		$result['cart_limit']['sale_step_list'] = [];
		if($maxsale <= 100)
		{
			for ($i = $minsale; $i <= $maxsale ; $i = $i + $salestep)
			{
				if($i <= 0)
				{
					// nothing
				}
				else
				{
					$result['cart_limit']['sale_step_list'][] = $i;
				}
			}
		}
		else
		{
			$result['cart_limit']['sale_step_input'] = true;
		}
	}

	/**
	 * Check allow shop product
	 *
	 * @param      <type>  $result  The result
	 */
	private static function allow_shop(&$result)
	{
		$allow_shop = false;
		$shop_message = T_("Product is not available for shop");

		if(isset($result['status']))
		{
			if($result['status'] === 'active')
			{
				if(isset($result['type']) && $result['type'] === 'file')
				{
					$allow_shop = true;
					$shop_message = T_("Product is ready for shop");
				}
				else
				{
					if(array_key_exists('trackquantity', $result))
					{
						if($result['trackquantity'])
						{
							if(isset($result['instock']) && $result['instock'])
							{
								$allow_shop = true;
								$shop_message = T_("Buy now");
							}
							else
							{
								$allow_shop = false;
								$shop_message = T_("Temporary out of stock");
							}
						}
						else
						{
							$allow_shop = true;
							$shop_message = T_("Buy now");
						}
					}
					else
					{
						$allow_shop = true;
						$shop_message = T_("Buy now");
					}
				}
			}
			else
			{
				$allow_shop = false;
				switch ($result['status'])
				{

					case 'deleted':
						$shop_message = T_("Product was deleted");
						break;

					default:
						$shop_message = T_("Product is not available");
						break;
				}
			}
		}

		if(isset($result['variant_child']) && $result['variant_child'])
		{
			$allow_shop = false;
			$shop_message = T_("Please choose a variants of this product to buy");
		}

		$result['allow_shop'] = $allow_shop;
		$result['shop_message'] = $shop_message;
	}


	/**
	 * ready record for export
	 */
	public static function export($_data, $_option = [])
	{
		$_data = self::row($_data);

		if(!is_array($_data))
		{
			return null;
		}

		foreach ($_data as $key => $value)
		{
			if(is_array($value))
			{
				$value = null;
			}

			switch ($key)
			{
				case 'creator':
				case 'preparationdatestring':
				case 'category_list':
				case 'allow_shop':
				case 'shop_message':
				case 'gallery_array':
				case 'saleonline':
				case 'saletelegram':
				case 'saleapp':
				case 'saleonline':
				case 'carton':
				case 'variants':
				case 'cart_limit':
				case 'preparationdate':
				case 'thumb':
				case 'cat_id':
				case 'thumb_default':

					// skipp show this fields
					break;

				default:
					$result[$key] = $value;
					break;
			}

		}

		return $result;
	}



	public static function pricehistory($_data, $_option = [])
	{


		if(!is_array($_data))
		{
			return null;
		}

		$currency = \lib\currency::name(\lib\store::detail('currency'));

		foreach ($_data as $key => $value)
		{
			switch ($key)
			{

				case 'creator':
				case 'id':
				case 'last':
					break;

				case 'price':
				case 'buyprice':
				case 'discount':
				case 'discountpercent':
				case 'finalprice':
					if($value)
					{
						$result[$key] = \lib\price::down($value);
					}
					else
					{
						$result[$key] = $value;
					}
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}

		return $result;
	}



}
?>