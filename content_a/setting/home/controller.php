<?php
namespace content_a\setting\home;

class controller
{
	public static function routing()
	{
		\dash\permission::access('settingView');

		$new_url = \dash\url::this(). '/general';

		\dash\redirect::to($new_url);

	}
}
?>