<?php
namespace content_api;


class controller
{
	public static function routing()
	{
		switch (\dash\url::module())
		{
			case 'v1':
				// \dash\header::status(410, T_("This version of api is expired"));

				\content_api\v1\check::basic_api_detail();
				break;

			default:
				break;
		}
	}
}
?>