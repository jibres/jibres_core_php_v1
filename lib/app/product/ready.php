<?php
namespace lib\app\product;


class ready
{

	public static function row($_data, $_option = [])
	{
		$default_option =
		[
			'load_gallery' => false,
			'parent_thumb' => null,
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
					break;

				case 'cat_id':
				case 'unit_id':
				case 'company_id':
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
					if(\dash\get::index($_data, 'optionname1') && \dash\get::index($_data, 'optionvalue1'))
					{
						$result['title'] .= ' - '.\dash\get::index($_data, 'optionname1'). ' '. \dash\get::index($_data, 'optionvalue1');
					}

					if(\dash\get::index($_data, 'optionname2') && \dash\get::index($_data, 'optionvalue2'))
					{
						$result['title'] .= ' - '.\dash\get::index($_data, 'optionname2'). ' '. \dash\get::index($_data, 'optionvalue2');
					}

					if(\dash\get::index($_data, 'optionname3') && \dash\get::index($_data, 'optionvalue3'))
					{
						$result['title'] .= ' - '.\dash\get::index($_data, 'optionname3'). ' '. \dash\get::index($_data, 'optionvalue3');
					}
					break;

				case 'slug':
					$result[$key] = isset($value) ? (string) $value : null;
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
							$result[$key] = isset($value) ? \lib\filepath::fix($value) : \dash\app::static_image_url();
						}
					}
					else
					{
						$result[$key] = isset($value) ? \lib\filepath::fix($value) : \dash\app::static_image_url();
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
							$preparationdatestring = \dash\fit::date($preparationdate);
						}

					}
					$result['preparationdate'] = $preparationdate;
					$result['preparationdatestring'] = $preparationdatestring;
					break;

				case 'country':
				case 'city':
				case 'province':
				case 'zipcode':
				case 'name':
				case 'desc':
				case 'alias':
				case 'status':
				default:
					$result[$key] = $value;
					break;
			}
		}

		$result['category_list'] = [];

		$allow_shop = false;
		$shop_message = T_("Product is not available for shop");

		if(isset($result['status']))
		{
			if($result['status'] === 'available')
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
			else
			{
				$allow_shop = false;
				switch ($result['status'])
				{
					case 'unset':
						$shop_message = T_("Product is not available");
						break;

					case 'unavailable':
						$shop_message = T_("Product is not available");
						break;

					case 'soon':
						$shop_message = T_("Will be available soon");
						break;

					case 'discountinued':
						$shop_message = T_("Product is discountinued");
						break;

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

		return $result;
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
			switch ($key)
			{
				case 'creator':
				case 'gallery_array':
				case 'saleonline':
				case 'saletelegram':
				case 'saleapp':
				case 'saleonline':
				case 'carton':
				case 'variants':
				case 'thumb':

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