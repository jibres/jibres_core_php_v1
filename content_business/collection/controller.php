<?php
namespace content_business\collection;


class controller
{
	public static function routing()
	{
		$url = \dash\url::kingdom(). '/category';

		if(\dash\url::child())
		{
			$url .= '/'. \dash\url::child();
		}

		\dash\redirect::to($url);

	}
}
?>
