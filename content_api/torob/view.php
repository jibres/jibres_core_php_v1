<?php
namespace content_api\torob;


class view
{

	public static function config()
	{
		$args = [];
		$args['limit'] = 100;
		$myProductList  = \lib\app\product\search::website_all_product_search(null, $args);

		if(!is_array($myProductList))
		{
			$myProductList = [];
		}

		$myProductList = array_map(['self', 'torob_api'], $myProductList);

		\dash\notif::api($myProductList);
	}


	private static function torob_api($_data)
	{
		if(!is_array($_data))
		{
			return null;
		}

		$resul = [];

		foreach ($_data as $key => $value)
		{
			switch ($key)
			{


				case 'id':
					$result['product_id'] = $value;
					break;

				case 'title':
					$result['title'] = $value;
					break;

				case 'url':
					$result['page_url'] = $value;
					break;

				case 'finalprice':
					$result['price'] = $value;
					break;

				case 'price':
					$result['old_price'] = $value;
					break;

				case 'allow_shop':
					$result['availability'] = $value ? 'instock' : false;
					break;

				default:
					// nothing
					break;
			}
		}

		return $result;
	}

}
?>