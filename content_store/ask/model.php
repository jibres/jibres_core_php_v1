<?php
namespace content_store\ask;


class model
{
	public static function post()
	{
		\dash\redirect::to(\dash\url::here(). '/subdomain');
	}
}
?>
