<?php
namespace content_a\products\poof;


class model
{
	public static function post()
	{
		$url = \dash\request::post('url');
		if($url)
		{
			\lib\app\product\gallery::upload_from_url(\dash\request::get('id'), $url);
			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this(). '/edit?'. \dash\request::fix_get());
			}
		}
	}
}
?>