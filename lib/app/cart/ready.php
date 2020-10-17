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
				case 'identify':
					if(mb_strlen($value) === 32)
					{
						$result[$key] = $value;
					}
					else
					{
						$result[$key] = \dash\coding::encode($value);
					}
					break;

				case 'product_id':
					$result[$key] = $value;
					$get_from_product['id'] = $value;
					break;


				case 'slug':
				case 'trackquantity':
				case 'instock':
				case 'status':
				case 'title':
				case 'optionname1':
				case 'optionvalue1':
				case 'optionname2':
				case 'optionvalue2':
				case 'optionname3':
				case 'optionvalue3':

					$get_from_product[$key] = $value;
					break;

				case 'thumb':
					$result['thumbraw'] = $value;
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
				case 'shipping':
					if($value)
					{
						$result[$key] = \lib\price::down($value);
					}
					else
					{
						$result[$key] = $value;
					}
					break;


				// case 'qty':
				// case 'count':
				// 	$value = \lib\number::down($value);
				// 	$result[$key] = $value;
				// 	break;

				// case 'subvat':
				// case 'subdiscount':
				// case 'subprice':
				// case 'subtotal':
				// case 'total':
				case 'sum':
					$value = \lib\price::down($value);
					$value = \lib\number::down($value);
					$result[$key] = $value;
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

			if(array_key_exists('instock', $get_from_product))
			{
				$result['instock'] = $get_from_product['instock'];
			}

			if(array_key_exists('title', $get_from_product))
			{
				$result['title'] = $get_from_product['title'];
			}

			if(array_key_exists('status', $get_from_product))
			{
				$result['status'] = $get_from_product['status'];
			}

			if(array_key_exists('allow_shop', $get_from_product))
			{
				$result['allow_shop'] = $get_from_product['allow_shop'];
			}

		}

		// var_dump($result);exit();
		return $result;
	}


}
?>