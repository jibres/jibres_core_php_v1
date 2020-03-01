<?php
namespace content_v2\account;


class controller
{
	public static function routing()
	{
		\content_v2\tools::invalid_url();
	}

	public static function api_routing()
	{
		$my_child = \dash\url::dir(3);

		switch ($my_child)
		{
			case 'token':
				\content_v2\account\token\controller::api_routing();
				break;

			case 'android':
				\content_v2\account\android\controller::api_routing();
				break;

			case 'enter':
				\content_v2\account\enter\controller::api_routing();
				break;

			case 'smile':
				\content_v2\account\smile\controller::api_routing();
				break;

			case 'notif':
				\content_v2\account\notif\controller::api_routing();
				break;

			case 'session':
				\content_v2\account\session\controller::api_routing();
				break;

			default:
				\content_v2\tools::invalid_url(404);
				break;
		}
	}
}
?>