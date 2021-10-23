<?php
namespace content_business\tag;


class controller
{
	public static function routing()
	{
		$url = \dash\url::here(). '/category';
		if(\dash\url::child())
		{
			$url .= '/'. \dash\url::child();
		}

		\dash\redirect::to($url);

	}
}
?>
