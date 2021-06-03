<?php
namespace content_love\email;


class controller
{
	public static function routing()
	{
		$templatePath = core. 'email/'.\dash\url::child(). '.php';

		if(is_file($templatePath))
		{
			require_once $templatePath;
			\dash\code::boom();
		}
	}
}
?>
