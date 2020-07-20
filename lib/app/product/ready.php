<?php
namespace lib\app\product;


class ready
{

	public static function row($_data, $_option = [])
	{
		$default_option =
		[
			'load_gallery' => false,
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


		$store_unit = \lib\currency::name(\lib\store::detail('currency'));



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

				case 'slug':
					$result[$key] = isset($value) ? (string) $value : null;
					if(isset($result['url']))
					{
						$result['url'] = $result['url']. '/'. $value;
					}
					break;

				case 'thumb':
					$result[$key] = isset($value) ? \lib\filepath::fix($value) : \dash\app::static_image_url();
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
					$result['unit'] = $store_unit;
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

				case 'country':
				case 'city':
				case 'province':
				case 'zipcode':
				case 'name':
				case 'title':
				case 'desc':
				case 'alias':
				case 'status':
				default:
					$result[$key] = isset($value) ? (string) $value : null;
					break;
			}
		}

		$result['category_list'] = [];

		$allow_shop = false;

		if(isset($result['status']) && $result['status'] === 'available')
		{
			if(array_key_exists('trackquantity', $result))
			{
				if($result['trackquantity'])
				{
					if(isset($result['instock']) && $result['instock'])
					{
						$allow_shop = true;
					}
				}
				else
				{
					$allow_shop = true;
				}
			}
		}

		if(isset($result['variant_child']) && $result['variant_child'])
		{
			$allow_shop = false;
		}

		$result['allow_shop'] = $allow_shop;

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

		$store_unit = \lib\currency::name(\lib\store::detail('currency'));

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