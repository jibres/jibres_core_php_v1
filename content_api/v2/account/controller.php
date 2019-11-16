<?php
namespace content_api\v2\account;


class controller
{
	public static function routing()
	{
		\content_api\v2::invalid_url();
	}

	public static function api_routing()
	{
		$my_child = \dash\url::dir(3);

		switch ($my_child)
		{
			case 'token':
				\content_api\v2\account\token\controller::api_routing();
				break;

			case 'android':
				\content_api\v2\account\android\controller::api_routing();
				break;


			default:
				\content_api\v2::invalid_url(404);
				break;
		}
	}
}
?>