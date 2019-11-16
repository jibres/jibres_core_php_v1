<?php
namespace content_api\v2\home;


class controller
{
	public static function routing()
	{
		$url = \dash\url::dir();

		// $url[0] is v2
		if(!isset($url[0]))
		{
			\dash\header::status(404);
		}

		$store = isset($url[1]) ? $url[1] : null;
		if(!$store)
		{
			\dash\header::status(404, '$STORE not set');
		}

		$store_id = \dash\coding::decode($store);
		if(!$store_id)
		{
			\dash\header::status(403, 'Invalid $STORE');
		}

		$module_url = $url;
		unset($module_url[0]);
		unset($module_url[1]);

		$module_url = implode('/', $module_url);

		switch ($module_url)
		{
			case 'app':
				\content_api\v2\app\controller::api_routing();
				break;

			default:
				j($module_url);
				break;
		}

		// if(\dash\url::child() && !\dash\url::subchild() && in_array(\dash\url::child(), ['mission', 'vision', 'about', 'contact']))
		// {
		// 	\content_api\v2\static_page::run(\dash\url::child());
		// }
		// else
		// {
		// 	\content_api\home\controller::routing();
		// }

	}
}
?>