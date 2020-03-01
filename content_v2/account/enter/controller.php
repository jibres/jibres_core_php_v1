<?php
namespace content_v2\account\enter;


class controller
{
	public static function routing()
	{
		\content_v2\tools::invalid_url();
	}

	public static function api_routing()
	{

		switch (\dash\url::dir(4))
		{
			case 'verify':
				if(\dash\url::dir(5))
				{
					\content_v2\tools::invalid_url();
				}

				if(!\dash\request::is('post'))
				{
					\content_v2\tools::invalid_method();
				}
				\content_v2\account\enter\enter::fire();
				break;

			case null:
				if(!\dash\request::is('post'))
				{
					\content_v2\tools::invalid_method();
				}
				\content_v2\account\enter\enter::fire();
				break;

			default:
				\content_v2\tools::invalid_url();
				break;
		}
	}
}
?>