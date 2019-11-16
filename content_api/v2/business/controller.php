<?php
namespace content_api\v2\business;


class controller
{
	public static function routing()
	{
		\content_api\v2::invalid_url();
	}

	public static function api_routing()
	{
		if(\dash\url::dir(4))
		{
			\content_api\v2::invalid_url();
		}

		$my_child = \dash\url::dir(3);

		switch ($my_child)
		{
			case 'mission':
			case 'vision':
			case 'about':
			case 'contact':
				if(!\dash\request::is('get'))
				{
					\content_api\v2::invalid_method();
				}

				\content_api\v2\static_page::run($my_child);
				break;

			default:
				\content_api\v2::invalid_url();
				break;
		}

	}
}
?>