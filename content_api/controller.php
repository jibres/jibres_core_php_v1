<?php
namespace content_api;


class controller
{
	public static function routing()
	{
		switch (\dash\url::module())
		{
			case 'v1':
				\content_api\v1\check::basic_api_detail();
				break;

			default:
				break;
		}
	}
}
?>