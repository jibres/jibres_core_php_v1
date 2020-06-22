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

		foreach ($_data as $key => $value)
		{

			switch ($key)
			{
				case 'id':
					$result[$key] = $value;
					$result['url'] = \dash\url::set_subdomain(\lib\store::detail('subdomain')). '/p/'. $value;
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
				case 'compareatprice':
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

				case 'intrestrate':
				case 'intrestrate_impure':
					$result[$key] = isset($value) ? (float) $value : null;
					break;

				case 'vat':
				case 'infinite':
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
				case 'compareatprice':

					// skipp show this fields
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}

		return $result;
	}


	/**
	 * Load product for website
	 *
	 * @param      <type>  $_data    The data
	 * @param      array   $_option  The option
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function for_website($_data, $_option = [])
	{
		$_data = self::row($_data);

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
					break;

				case 'price':
					$result[$key] = $value;
					$result['unit'] = $store_unit;
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
				case 'compareatprice':
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