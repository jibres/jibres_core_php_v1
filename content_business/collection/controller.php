<?php
namespace content_business\collection;


class controller
{
	public static function routing()
	{
		$url = \dash\url::kingdom(). '/tag';

		if(\dash\url::child())
		{
			$url .= '/'. \dash\url::child();
		}

		\dash\redirect::to($url);

	}
}
?>
