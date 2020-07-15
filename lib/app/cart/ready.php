<?php
namespace lib\app\cart;


class ready
{
	public static function row($_data)
	{
		if(!is_array($_data))
		{
			return false;
		}

		$get_from_product = [];

		$result = [];

		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'user_id':
					$result[$key] = \dash\coding::encode($value);
					break;

				case 'product_id':
					$result[$key] = $value;
					$get_from_product['id'] = $value;
					break;


				case 'slug':
				case 'trackquantity':
					$get_from_product[$key] = $value;
					break;

				case 'thumb':
					$result[$key] = isset($value) ? \lib\filepath::fix($value) : \dash\app::static_image_url();
					break;

				case 'stock':
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
				case 'product_price':
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

		if(!empty($get_from_product))
		{

			$get_from_product = \lib\app\product\ready::row($get_from_product);
			if(isset($get_from_product['url']))
			{
				$result['url'] = $get_from_product['url'];
			}

			if(array_key_exists('trackquantity', $get_from_product))
			{
				$result['trackquantity'] = $get_from_product['trackquantity'];
			}

		}

		return $result;
	}


}
?>