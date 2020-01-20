<?php
namespace content_api\v1\account\android;


class controller
{
	public static function routing()
	{
		\content_api\v1\tools::invalid_url();
	}

	public static function api_routing()
	{
		switch (\dash\url::dir(4))
		{
			case 'add':
				if(!\dash\request::is('post'))
				{
					\content_api\v1\tools::invalid_method();
				}

				\content_api\v1\account\android\user\add::add();
				break;

			default:
				\content_api\v1\tools::invalid_url();
				break;
		}
	}


}
?>