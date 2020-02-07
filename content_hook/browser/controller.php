<?php
namespace content_hook\browser;

class controller
{
	public static function routing()
	{
		if(\dash\url::child() === null)
		{
			\dash\code::jsonBoom(\dash\utility\browserDetection::browser_detection('full_assoc'));
		}

	}
}
?>