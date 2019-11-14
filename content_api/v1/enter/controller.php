<?php
namespace content_api\v1\enter;


class controller
{
	public static function routing()
	{

		$subchild = \dash\url::subchild();

		if(!$subchild || $subchild === 'verify')
		{
			\content_api\v1\enter\enter::fire();
		}
		else
		{
			\content_api\v1::invalid_url();
		}
	}
}
?>