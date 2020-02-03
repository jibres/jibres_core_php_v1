<?php
namespace content_cms\posts\add;

class controller
{
	public static function routing()
	{
		$myType = \dash\request::get('type');
		if($myType)
		{
			switch ($myType)
			{
				case 'page':
					\dash\permission::access('cpPageAdd');
					break;

				case 'help':
					\dash\permission::access('cpHelpCenterAdd');
					break;

				case 'post':
					\dash\permission::access('cpPostsAdd');
					break;

				default:
					\dash\header::status(404);
					break;
			}
		}
		else
		{
			\dash\permission::access('cpPostsAdd');
		}
	}
}
?>