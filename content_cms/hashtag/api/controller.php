<?php
namespace content_cms\hashtag\api;


class controller
{
	public static function routing()
	{
		if(!\dash\permission::has_permission())
		{
			\dash\permission::deny();
		}
	}
}
?>
