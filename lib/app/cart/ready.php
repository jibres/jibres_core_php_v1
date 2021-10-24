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
				case 'instock':
				case 'status':
				case 'title':
				case 'optionname1':
				case 'optionvalue1':
				case 'optionname2':
				case 'optionvalue2':
				case 'optionname3':
				case 'optionvalue3':
				case 'oversale':
				case 'minsale':
				case 'maxsale':
				case 'type':
					$get_from_product[$key] = $value;
					break;

				case 'thumb':
					$result['thumbraw'] = $value;
					$result[$key] = isset($value) ? \lib\filepath::fix($value) : \dash\app::static_image_url();
					break;

				case 'stock':
					if($value)
					{
						$result[$key] = floatval($value);
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
				case 'vatprice':
					if($value)
					{
						$result[$key] = floatval($value);
					}
					else
					{
						$result[$key] = $value;
					}
					break;


				// case 'qty':
				// case 'count':
				// 	$value = floatval($value);
				// 	$result[$key] = $value;
				// 	break;

				// case 'subvat':
				// case 'subdiscount':
				// case 'subprice':
				// case 'subtotal':
				// case 'total':
				case 'sum':
					$value = floatval($value);
					$value = floatval($value);
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


			$result['oversale']      = a($get_from_product, 'oversale');
			$result['minsale']       = a($get_from_product, 'minsale');
			$result['maxsale']       = a($get_from_product, 'maxsale');
			$result['url']           = a($get_from_product, 'url');
			$result['edit_url']      = a($get_from_product, 'edit_url');
			$result['trackquantity'] = a($get_from_product, 'trackquantity');
			$result['instock']       = a($get_from_product, 'instock');
			$result['title']         = a($get_from_product, 'title');
			$result['status']        = a($get_from_product, 'status');
			$result['type']        	 = a($get_from_product, 'type');
			$result['allow_shop']    = a($get_from_product, 'allow_shop');



		}

		return $result;
	}


}
?>