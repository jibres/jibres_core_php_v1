<?php
namespace content_api;


class controller
{
	public static function routing()
	{
		if(\dash\url::module() === 'v1')
		{
			\content_api\v1\check::basic_api_detail();
		}
	}
}
?>