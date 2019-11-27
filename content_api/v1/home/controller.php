<?php
namespace content_api\v1\home;


class controller
{
	public static function routing()
	{

		if(\dash\url::directory() === 'v1')
		{
			\content_api\home\controller::routing();
			return;
		}

		$url = \dash\url::dir();

		// $url[0] is v1
		if(!isset($url[0]))
		{
			\content_api\v1::stop(404);
		}

		// y88y
		$store = isset($url[1]) ? $url[1] : null;

		// route location query whitout store
		if($store === 'location')
		{
			\content_api\v1\location\controller::routing();
			return;
		}

		if(!$store)
		{
			\content_api\v1::stop(404, '$STORE not set');
		}

		$store_id = \dash\coding::decode($store);
		if(!$store_id)
		{
			\content_api\v1::stop(403, 'Invalid $STORE');
		}

		if(intval($store_id) < 1000000 || \dash\number::is_larger($store_id, 9999999))
		{
			\content_api\v1::stop(403, 'Invalid $STORE id');
		}

		\content_api\v1::check_appkey();

		\content_api\v1::check_store_init();

		// check store is exsist

		$module_url = isset($url[2]) ? $url[2] : null;

		switch ($module_url)
		{
			case 'app':
				\content_api\v1\app\controller::api_routing();
				break;

			case 'product':
				\content_api\v1\product\controller::api_routing();
				break;

			case 'products':
				\content_api\v1\products\controller::api_routing();
				break;

			case 'collection':
				\content_api\v1\collection\controller::api_routing();
				break;

			case 'category':
				\content_api\v1\category\controller::api_routing();
				break;

			case 'company':
				\content_api\v1\company\controller::api_routing();
				break;

			case 'profile':
				\content_api\v1\profile\controller::api_routing();
				break;

			case 'orders':
				\content_api\v1\orders\controller::api_routing();
				break;

			case 'cart':
				\content_api\v1\cart\controller::api_routing();
				break;

			case 'ticket':
				\content_api\v1\ticket\controller::api_routing();
				break;

			case 'account':
				\content_api\v1\account\controller::api_routing();
				break;

			case 'business':
				\content_api\v1\business\controller::api_routing();
				break;

			case 'language':
				\content_api\v1\language\controller::api_routing();
				break;

			case 'product':
				\content_api\v1\product\controller::api_routing();
				break;

			case 'user':
				\content_api\v1\user\controller::api_routing();
				break;

			default:
				\content_api\v1::stop(404);
				break;
		}

		// if(\dash\url::child() && !\dash\url::subchild() && in_array(\dash\url::child(), ['mission', 'vision', 'about', 'contact']))
		// {
		// 	\content_api\v1\static_page::run(\dash\url::child());
		// }
		// else
		// {
		// 	\content_api\home\controller::routing();
		// }

	}
}
?>